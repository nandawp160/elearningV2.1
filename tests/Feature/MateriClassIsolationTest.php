<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Materi;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Siswa;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MateriClassIsolationTest extends TestCase
{
    use RefreshDatabase;

    private $teacherUser;
    private $teacher;
    private $subject;
    private $classX;
    private $classXI;
    private $studentXUser;
    private $studentXIUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create subject
        $this->subject = JadwalPelajaran::create([
            'kode' => 'IND-1',
            'nama' => 'Bahasa Indonesia',
            'deskripsi' => 'Bahasa Indonesia',
            'tingkat' => null, // null for cross grade
            'status' => 'aktif'
        ]);

        // Create classroom X 1
        $this->classX = Kelas::withoutGlobalScopes()->create([
            'name' => 'X 1',
            'grade_level' => 'X',
            'major' => 'Umum',
            'max_students' => 40,
            'academic_year' => '2025/2026'
        ]);

        // Create classroom XI F 1
        $this->classXI = Kelas::withoutGlobalScopes()->create([
            'name' => 'XI F 1',
            'grade_level' => 'XI',
            'major' => 'Umum',
            'max_students' => 40,
            'academic_year' => '2025/2026'
        ]);

        // Create teacher user
        $this->teacherUser = User::create([
            'nama' => 'Heni Setyarini',
            'email' => 'heni@guru.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
            'email_verified_at' => now(),
        ]);

        // Create teacher profile
        $this->teacher = Guru::create([
            'nip' => '198801012015011002',
            'nama' => 'Heni Setyarini',
            'email' => 'heni@guru.smansago.com',
            'no_hp' => '081234567891',
            'spesialisasi' => 'Bahasa Indonesia',
            'specialization_id' => $this->subject->id,
            'status' => 'aktif',
            'pengguna_id' => $this->teacherUser->id
        ]);

        // Attach classes to teacher
        $this->teacher->kelasDiampu()->attach([
            $this->classX->id => ['mata_pelajaran_id' => $this->subject->id],
            $this->classXI->id => ['mata_pelajaran_id' => $this->subject->id],
        ]);

        // Create student in X 1
        $this->studentXUser = User::create([
            'nama' => 'Siswa X 1',
            'email' => 'siswax@student.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
            'email_verified_at' => now(),
        ]);
        Siswa::create([
            'nis' => 'S-001',
            'nama' => 'Siswa X 1',
            'email' => 'siswax@student.smansago.com',
            'kelas' => 'X 1',
            'status' => 'aktif',
            'phone' => '081234',
            'address' => 'Addr',
            'gender' => 'Laki-laki',
            'date_of_birth' => '2009-01-01',
            'pengguna_id' => $this->studentXUser->id
        ]);

        // Create student in XI F 1
        $this->studentXIUser = User::create([
            'nama' => 'Siswa XI F 1',
            'email' => 'siswaxi@student.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
            'email_verified_at' => now(),
        ]);
        Siswa::create([
            'nis' => 'S-002',
            'nama' => 'Siswa XI F 1',
            'email' => 'siswaxi@student.smansago.com',
            'kelas' => 'XI F 1',
            'status' => 'aktif',
            'phone' => '081234',
            'address' => 'Addr',
            'gender' => 'Laki-laki',
            'date_of_birth' => '2008-01-01',
            'pengguna_id' => $this->studentXIUser->id
        ]);
    }

    public function test_teacher_can_upload_material_to_specific_class(): void
    {
        $response = $this->actingAs($this->teacherUser)->post(route('materials.store'), [
            'subject_id' => $this->subject->id,
            'title' => 'Materi XI F 1',
            'description' => 'Materi khusus XI F 1',
            'type' => 'link',
            'link_url' => 'https://example.com',
            'kelas_name' => 'XI F 1'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('materials', [
            'title' => 'Materi XI F 1',
            'kelas_id' => $this->classXI->id
        ]);
    }

    public function test_materials_class_isolation_for_students(): void
    {
        // 1. Create a material for XI F 1
        $materialXI = Materi::create([
            'subject_id' => $this->subject->id,
            'kelas_id' => $this->classXI->id,
            'title' => 'Materi XI F 1',
            'description' => 'Materi khusus XI F 1',
            'type' => 'link',
            'url' => 'https://example.com',
            'uploaded_by' => $this->teacher->id
        ]);

        // 2. Create a material for X 1
        $materialX = Materi::create([
            'subject_id' => $this->subject->id,
            'kelas_id' => $this->classX->id,
            'title' => 'Materi X 1',
            'description' => 'Materi khusus X 1',
            'type' => 'link',
            'url' => 'https://example.com',
            'uploaded_by' => $this->teacher->id
        ]);

        // 3. Student in X 1 accesses index page
        $responseX = $this->actingAs($this->studentXUser)->get(route('materials.index', ['subject_id' => $this->subject->id]));
        $responseX->assertStatus(200);
        $responseX->assertSee('Materi X 1');
        $responseX->assertDontSee('Materi XI F 1');

        // 4. Student in XI F 1 accesses index page
        $this->flushSession();
        $responseXI = $this->actingAs($this->studentXIUser)->get(route('materials.index', ['subject_id' => $this->subject->id]));
        $responseXI->assertStatus(200);
        $responseXI->assertSee('Materi XI F 1');
        $responseXI->assertDontSee('Materi X 1');
    }

    public function test_student_cannot_show_material_from_another_class(): void
    {
        $materialXI = Materi::create([
            'subject_id' => $this->subject->id,
            'kelas_id' => $this->classXI->id,
            'title' => 'Materi XI F 1',
            'description' => 'Materi khusus XI F 1',
            'type' => 'link',
            'url' => 'https://example.com',
            'uploaded_by' => $this->teacher->id
        ]);

        // Student X 1 trying to access material XI F 1
        $response = $this->actingAs($this->studentXUser)->get(route('materials.show', $materialXI->id));
        $response->assertStatus(403);
    }

    public function test_teacher_can_update_material_class(): void
    {
        $material = Materi::create([
            'subject_id' => $this->subject->id,
            'kelas_id' => $this->classX->id,
            'title' => 'Materi Awal',
            'description' => 'Materi Awal',
            'type' => 'link',
            'url' => 'https://example.com',
            'uploaded_by' => $this->teacher->id
        ]);

        $response = $this->actingAs($this->teacherUser)->put(route('materials.update', $material->id), [
            'subject_class_pair' => $this->subject->id . '-' . $this->classXI->id,
            'title' => 'Materi Diperbarui',
            'type' => 'link',
            'link_url' => 'https://example.com'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('materials', [
            'id' => $material->id,
            'title' => 'Materi Diperbarui',
            'kelas_id' => $this->classXI->id
        ]);
    }

    public function test_teacher_can_destroy_material(): void
    {
        $material = Materi::create([
            'subject_id' => $this->subject->id,
            'kelas_id' => $this->classX->id,
            'title' => 'Materi Awal',
            'description' => 'Materi Awal',
            'type' => 'link',
            'url' => 'https://example.com',
            'uploaded_by' => $this->teacher->id
        ]);

        $response = $this->actingAs($this->teacherUser)->delete(route('materials.destroy', $material->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('materials', [
            'id' => $material->id
        ]);
    }

    public function test_student_can_preview_and_download_own_class_material(): void
    {
        // Mock a file in storage
        \Illuminate\Support\Facades\Storage::fake('public');
        $filePath = 'materi/test_file.pdf';
        \Illuminate\Support\Facades\Storage::disk('public')->put($filePath, 'PDF content');

        $materialXI = Materi::create([
            'subject_id' => $this->subject->id,
            'kelas_id' => $this->classXI->id,
            'title' => 'Materi XI F 1',
            'description' => 'Materi khusus XI F 1',
            'type' => 'pdf',
            'file_path' => $filePath,
            'uploaded_by' => $this->teacher->id
        ]);

        // Student XI F 1 can preview
        $responsePreview = $this->actingAs($this->studentXIUser)->get(route('preview.material', $materialXI->id));
        $responsePreview->assertStatus(200);

        // Student XI F 1 can download
        $responseDownload = $this->actingAs($this->studentXIUser)->get(route('download.material', $materialXI->id));
        $responseDownload->assertStatus(200);
    }

    public function test_student_cannot_preview_and_download_another_class_material(): void
    {
        // Mock a file in storage
        \Illuminate\Support\Facades\Storage::fake('public');
        $filePath = 'materi/test_file.pdf';
        \Illuminate\Support\Facades\Storage::disk('public')->put($filePath, 'PDF content');

        $materialXI = Materi::create([
            'subject_id' => $this->subject->id,
            'kelas_id' => $this->classXI->id,
            'title' => 'Materi XI F 1',
            'description' => 'Materi khusus XI F 1',
            'type' => 'pdf',
            'file_path' => $filePath,
            'uploaded_by' => $this->teacher->id
        ]);

        // Student X 1 cannot preview
        $responsePreview = $this->actingAs($this->studentXUser)->get(route('preview.material', $materialXI->id));
        $responsePreview->assertStatus(403);

        // Student X 1 cannot download
        $responseDownload = $this->actingAs($this->studentXUser)->get(route('download.material', $materialXI->id));
        $responseDownload->assertStatus(403);
    }
}
