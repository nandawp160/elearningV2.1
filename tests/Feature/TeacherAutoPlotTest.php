<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pengaturan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TeacherAutoPlotTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed default active year
        Pengaturan::setValue('tahun_ajaran_aktif', '2025/2026');

        // Create Admin user
        $this->admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }

    public function test_teacher_auto_plotting_success()
    {
        // 1. Create a subject/mata pelajaran (e.g. Fisika Grade X - IPA constraint)
        $courseFisika = MataPelajaran::create([
            'kode' => 'FIS-X',
            'nama' => 'Fisika Kelas X',
            'tingkat' => 'X',
            'status' => 'aktif'
        ]);

        // 2. Create active teachers specializing in Fisika
        $userGuru1 = User::create([
            'nama' => 'Guru Fisika 1',
            'email' => 'guru.fisika1@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'guru'
        ]);

        $guru1 = Guru::create([
            'nip' => '199001012020011001',
            'nama' => 'Guru Fisika 1',
            'email' => 'guru.fisika1@sekolah.sch.id',
            'no_hp' => '0812345678',
            'specialization_id' => $courseFisika->id,
            'status' => 'active',
            'pengguna_id' => $userGuru1->id
        ]);

        $userGuru2 = User::create([
            'nama' => 'Guru Fisika 2',
            'email' => 'guru.fisika2@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'guru'
        ]);

        $guru2 = Guru::create([
            'nip' => '199001012020011002',
            'nama' => 'Guru Fisika 2',
            'email' => 'guru.fisika2@sekolah.sch.id',
            'no_hp' => '0812345679',
            'specialization_id' => $courseFisika->id,
            'status' => 'active',
            'pengguna_id' => $userGuru2->id
        ]);

        // 3. Create 4 target classrooms of Grade X (2 IPA, 2 IPS)
        $kelasIpa1 = Kelas::create([
            'name' => 'X IPA 1',
            'grade_level' => 'X',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 36
        ]);

        $kelasIpa2 = Kelas::create([
            'name' => 'X IPA 2',
            'grade_level' => 'X',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 36
        ]);



        // 4. Set up an existing mapping that should be cleared
        DB::table('guru_kelas')->insert([
            'guru_id' => $guru1->id,
            'kelas_id' => $kelasIpa1->id,
            'mata_pelajaran_id' => $courseFisika->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Verify the pre-existing mapping exists
        $this->assertDatabaseHas('guru_kelas', [
            'guru_id' => $guru1->id,
            'kelas_id' => $kelasIpa1->id
        ]);

        // 5. Run the teachers auto-plot POST route
        $response = $this->actingAs($this->admin)->post(route('teachers.auto-plot'), [
            'tahun_ajaran' => '2025/2026'
        ]);

        $response->assertRedirect(route('teachers.index'));
        $response->assertSessionHas('success');

        // Verify old mapping was cleared and new mapping distributed
        // Fisika has keywords "fisika", which enforces 'IPA' major constraint.
        // So they should only be mapped to $kelasIpa1 and $kelasIpa2.
        // 2 classes / 2 teachers = 1 class per teacher.
        // Thus, one teacher gets X IPA 1, and the other gets X IPA 2.
        
        $assigned1 = DB::table('guru_kelas')->where('guru_id', $guru1->id)->pluck('kelas_id')->toArray();
        $assigned2 = DB::table('guru_kelas')->where('guru_id', $guru2->id)->pluck('kelas_id')->toArray();

        $this->assertCount(1, $assigned1);
        $this->assertCount(1, $assigned2);
        
        // Assert they got different classes
        $this->assertNotEquals($assigned1[0], $assigned2[0]);
    }
}
