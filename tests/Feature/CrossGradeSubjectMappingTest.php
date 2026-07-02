<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tugas;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrossGradeSubjectMappingTest extends TestCase
{
    use RefreshDatabase;

    private $teacherUser;
    private $teacher;
    private $subjectGradeX;
    private $subjectGradeXII;
    private $classX;
    private $classXII;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Create specialized subject for Grade X (TIK 1)
        $this->subjectGradeX = JadwalPelajaran::create([
            'kode' => 'TIK-1',
            'nama' => 'TIK 1',
            'deskripsi' => 'Teknologi Informasi dan Komunikasi 1',
            'tingkat' => 'X',
            'status' => 'aktif'
        ]);

        // 2. Create target subject for Grade XII (Informatika Dasar)
        $this->subjectGradeXII = JadwalPelajaran::create([
            'kode' => 'INF-DASAR',
            'nama' => 'Informatika Dasar',
            'deskripsi' => 'Informatika Dasar',
            'tingkat' => 'XII',
            'status' => 'aktif'
        ]);

        // 3. Create class rooms
        $this->classX = Kelas::withoutGlobalScopes()->create([
            'name' => 'X IPA 1',
            'grade_level' => 'X',
            'major' => 'IPA',
            'max_students' => 40,
            'academic_year' => '2025/2026'
        ]);

        $this->classXII = Kelas::withoutGlobalScopes()->create([
            'name' => 'XII IPA 1',
            'grade_level' => 'XII',
            'major' => 'IPA',
            'max_students' => 40,
            'academic_year' => '2025/2026'
        ]);

        // 4. Create teacher user
        $this->teacherUser = User::create([
            'nama' => 'Guru TIK Lintas',
            'email' => 'gurutiklintas@guru.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru'
        ]);

        // 5. Create teacher profile
        $this->teacher = Guru::create([
            'nip' => '198801012015011002',
            'nama' => 'Guru TIK Lintas',
            'email' => 'gurutiklintas@guru.smansago.com',
            'no_hp' => '081234567891',
            'spesialisasi' => 'TIK 1',
            'specialization_id' => $this->subjectGradeX->id,
            'status' => 'aktif',
            'pengguna_id' => $this->teacherUser->id
        ]);

        // 6. Attach both X and XII classrooms to the teacher
        $this->teacher->kelasDiampu()->attach([$this->classX->id, $this->classXII->id]);
    }

    public function test_normalization_logic(): void
    {
        $this->assertEquals('tik', Guru::normalizeSubjectName('TIK 1'));
        $this->assertEquals('tik', Guru::normalizeSubjectName('TIK LANJUTAN'));
        $this->assertEquals('tik', Guru::normalizeSubjectName('Informatika Dasar'));
        $this->assertEquals('bahasa indonesia', Guru::normalizeSubjectName('Bahasa Indonesia X'));
        $this->assertEquals('bahasa inggris', Guru::normalizeSubjectName('Bahasa Inggris XI'));
        $this->assertEquals('pjok', Guru::normalizeSubjectName('Penjaskes XI'));
        $this->assertEquals('pjok', Guru::normalizeSubjectName('Olahraga XII'));
    }

    public function test_get_subject_for_class_resolver(): void
    {
        // For grade X class, should return TIK 1 (same level as specialization)
        $resolvedX = $this->teacher->getSubjectForClass($this->classX);
        $this->assertNotNull($resolvedX);
        $this->assertEquals($this->subjectGradeX->id, $resolvedX->id);

        // For grade XII class, should resolve to Informatika Dasar via synonym matching
        $resolvedXII = $this->teacher->getSubjectForClass($this->classXII);
        $this->assertNotNull($resolvedXII);
        $this->assertEquals($this->subjectGradeXII->id, $resolvedXII->id);
    }

    public function test_get_subject_ids_taught(): void
    {
        $ids = $this->teacher->getSubjectIdsTaught();
        $this->assertContains($this->subjectGradeX->id, $ids);
        $this->assertContains($this->subjectGradeXII->id, $ids);
        $this->assertCount(2, $ids);
    }

    public function test_jadwal_pelajaran_get_teacher_attribute(): void
    {
        // Direct specialization mapping should work
        $this->assertEquals($this->teacher->id, $this->subjectGradeX->teacher->id);

        // Cross-level dynamic mapping should resolve to the same teacher
        $this->assertEquals($this->teacher->id, $this->subjectGradeXII->teacher->id);
    }

    public function test_tugas_pages_render_without_errors(): void
    {
        $response = $this->actingAs($this->teacherUser)->get(route('assignments.index'));
        $response->assertStatus(200);

        // Assert teacher index displays resolved subject names for target classes
        $response->assertSee('TIK 1');
        $response->assertSee('Informatika Dasar');
    }

    public function test_class_teacher_isolation_for_students(): void
    {
        // 1. Create a student in class X IPA 1
        $studentUser = User::create([
            'nama' => 'Siswa Kelas X',
            'email' => 'siswa@student.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);

        $student = \App\Models\Siswa::create([
            'nis' => 'S-002',
            'nama' => 'Siswa Kelas X',
            'email' => 'siswa@student.smansago.com',
            'kelas' => 'X IPA 1',
            'status' => 'aktif',
            'phone' => '081234',
            'address' => 'Addr',
            'gender' => 'Laki-laki',
            'date_of_birth' => '2009-01-01',
            'entry_year' => '2025',
            'pengguna_id' => $studentUser->id
        ]);

        // 2. Create another teacher teaching the same subject in a different class
        $otherTeacherUser = User::create([
            'nama' => 'Guru Lain',
            'email' => 'gurulain@guru.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru'
        ]);

        $otherTeacher = Guru::create([
            'nip' => '198801012015011003',
            'nama' => 'Guru Lain',
            'email' => 'gurulain@guru.smansago.com',
            'no_hp' => '081234567892',
            'spesialisasi' => 'TIK 1',
            'specialization_id' => $this->subjectGradeX->id,
            'status' => 'aktif',
            'pengguna_id' => $otherTeacherUser->id
        ]);

        // Create class room X IPA 2
        $classX2 = Kelas::withoutGlobalScopes()->create([
            'name' => 'X IPA 2',
            'grade_level' => 'X',
            'major' => 'IPA',
            'max_students' => 40,
            'academic_year' => '2025/2026'
        ]);

        // Attach other teacher to X IPA 2 (but not X IPA 1)
        $otherTeacher->kelasDiampu()->attach($classX2->id);

        // 3. Create assignments
        // Assignment A by our teacher
        $assignmentA = Tugas::create([
            'mata_pelajaran_id' => $this->subjectGradeX->id,
            'judul' => 'Tugas Guru TIK Lintas',
            'deskripsi' => 'Deskripsi',
            'deadline' => Carbon::now()->addDays(2),
            'guru_id' => $this->teacher->id,
            'status' => 'aktif',
            'type' => 'essay'
        ]);

        // Assignment B by other teacher
        $assignmentB = Tugas::create([
            'mata_pelajaran_id' => $this->subjectGradeX->id,
            'judul' => 'Tugas Guru Lain',
            'deskripsi' => 'Deskripsi',
            'deadline' => Carbon::now()->addDays(2),
            'guru_id' => $otherTeacher->id,
            'status' => 'aktif',
            'type' => 'essay'
        ]);

        // 4. Access student detail page as Siswa Kelas X (X IPA 1)
        $response = $this->actingAs($studentUser)->get(route('assignments.student.detail', $this->subjectGradeX));
        $response->assertStatus(200);

        // Siswa should see Tugas Guru TIK Lintas, but NOT see Tugas Guru Lain
        $response->assertSee('Tugas Guru TIK Lintas');
        $response->assertDontSee('Tugas Guru Lain');
    }

    public function test_get_resolved_subjects_route(): void
    {
        $response = $this->actingAs($this->teacherUser)->get(route('teachers.resolved-subjects', $this->teacher));
        $response->assertStatus(200);
        $response->assertJson([
            $this->classX->id => [
                'id' => $this->subjectGradeX->id,
                'nama' => 'TIK 1'
            ],
            $this->classXII->id => [
                'id' => $this->subjectGradeXII->id,
                'nama' => 'Informatika Dasar'
            ]
        ]);
    }

    public function test_update_teaching_classes_saves_explicit_subject_ids(): void
    {
        $admin = User::create([
            'nama' => 'Admin',
            'email' => 'admin@school.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->post(route('teachers.update-teaching-classes', $this->teacher), [
            'kelas' => [$this->classX->id, $this->classXII->id],
            'subject_ids' => [
                $this->classX->id => $this->subjectGradeX->id,
                $this->classXII->id => $this->subjectGradeXII->id
            ]
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('guru_kelas', [
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->classX->id,
            'mata_pelajaran_id' => $this->subjectGradeX->id
        ]);

        $this->assertDatabaseHas('guru_kelas', [
            'guru_id' => $this->teacher->id,
            'kelas_id' => $this->classXII->id,
            'mata_pelajaran_id' => $this->subjectGradeXII->id
        ]);
    }
}
