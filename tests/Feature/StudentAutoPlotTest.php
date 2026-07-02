<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Pengaturan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentAutoPlotTest extends TestCase
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

    public function test_specific_class_auto_creation_and_enrollment()
    {
        // 1. Create a student with a specific class that does not exist in class list yet
        $studentUser = User::create([
            'nama' => 'Siswa Spesifik',
            'email' => 'siswaspesifik@siswa.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);

        $student = Siswa::create([
            'nis' => '111111',
            'nama' => 'Siswa Spesifik',
            'kelas' => 'X IPA 1',
            'status' => 'aktif',
            'pengguna_id' => $studentUser->id
        ]);

        // Verify class X IPA 1 does not exist in target year 2025/2026
        $this->assertDatabaseMissing('kelas', [
            'name' => 'X IPA 1',
            'academic_year' => '2025/2026'
        ]);

        // 2. Perform auto plotting
        $response = $this->actingAs($this->admin)->post(route('students.auto-plot'), [
            'tahun_ajaran' => '2025/2026'
        ]);

        $response->assertRedirect(route('students.index'));
        $response->assertSessionHas('success');

        // 3. Assert class is created and student's class name is assigned
        $this->assertDatabaseHas('kelas', [
            'name' => 'X IPA 1',
            'academic_year' => '2025/2026',
            'grade_level' => 'X',
            'major' => 'IPA'
        ]);

        $student->refresh();
        $this->assertEquals('X IPA 1', $student->kelas);
    }

    public function test_generic_class_distribution_and_equal_split()
    {
        // 1. Create target classes of same grade/major
        Kelas::create([
            'name' => 'X IPA 1',
            'grade_level' => 'X',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 2,
        ]);

        Kelas::create([
            'name' => 'X IPA 2',
            'grade_level' => 'X',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 2,
        ]);

        // 2. Create 3 classless students with generic label 'X IPA'
        for ($i = 1; $i <= 3; $i++) {
            $studentUser = User::create([
                'nama' => "Siswa Generic {$i}",
                'email' => "generic{$i}@siswa.smansago.com",
                'password' => bcrypt('password'),
                'role' => 'siswa'
            ]);

            Siswa::create([
                'nis' => "20000{$i}",
                'nama' => "Siswa Generic {$i}",
                'kelas' => 'X IPA',
                'status' => 'aktif',
                'pengguna_id' => $studentUser->id
            ]);
        }

        // 3. Perform auto plotting
        $response = $this->actingAs($this->admin)->post(route('students.auto-plot'), [
            'tahun_ajaran' => '2025/2026'
        ]);

        $response->assertRedirect(route('students.index'));

        // 4. Assert that students are distributed evenly based on load
        // X IPA 1 should have 2 students (full capacity)
        // X IPA 2 should have 1 student
        $count1 = Siswa::where('kelas', 'X IPA 1')->count();
        $count2 = Siswa::where('kelas', 'X IPA 2')->count();

        $this->assertEquals(2, $count1);
        $this->assertEquals(1, $count2);
    }

    public function test_mixed_grades_are_safely_isolated()
    {
        // 1. Create classes for Grade X and Grade XI
        Kelas::create([
            'name' => 'X IPA 1',
            'grade_level' => 'X',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 30,
        ]);

        Kelas::create([
            'name' => 'XI IPS 1',
            'grade_level' => 'XI',
            'major' => 'IPS',
            'academic_year' => '2025/2026',
            'max_students' => 30,
        ]);

        // 2. Create a Grade X student and a Grade XI student with generic labels
        $studentUserX = User::create([
            'nama' => 'Siswa X',
            'email' => 'siswa.x@siswa.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);
        $studentX = Siswa::create([
            'nis' => '300001',
            'nama' => 'Siswa X',
            'kelas' => 'X IPA',
            'status' => 'aktif',
            'pengguna_id' => $studentUserX->id
        ]);

        $studentUserXI = User::create([
            'nama' => 'Siswa XI',
            'email' => 'siswa.xi@siswa.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);
        $studentXI = Siswa::create([
            'nis' => '300002',
            'nama' => 'Siswa XI',
            'kelas' => 'XI IPS',
            'status' => 'aktif',
            'pengguna_id' => $studentUserXI->id
        ]);

        // 3. Perform auto plotting
        $response = $this->actingAs($this->admin)->post(route('students.auto-plot'), [
            'tahun_ajaran' => '2025/2026'
        ]);

        // 4. Assert no mix-ups happened
        $studentX->refresh();
        $studentXI->refresh();

        $this->assertEquals('X IPA 1', $studentX->kelas);
        $this->assertEquals('XI IPS 1', $studentXI->kelas);
    }
}
