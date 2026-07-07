<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiswaGraduationPromotionTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $student1;
    protected $student2;
    protected $student3;
    protected $classX;
    protected $classXI;
    protected $classXII;

    protected function setUp(): void
    {
        parent::setUp();

        // Create Admin
        $this->admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Classes
        $this->classX = Kelas::create([
            'name' => 'X IPA 1',
            'grade_level' => 'X',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 36,
        ]);

        $this->classXI = Kelas::create([
            'name' => 'XI IPA 1',
            'grade_level' => 'XI',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 36,
        ]);

        $this->classXII = Kelas::create([
            'name' => 'XII IPA 1',
            'grade_level' => 'XII',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 36,
        ]);

        // Create Users & Students
        $user1 = User::create([
            'nama' => 'Siswa 1',
            'email' => '1001@siswa.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);
        $this->student1 = Siswa::create([
            'nis' => '1001',
            'nama' => 'Siswa X 1',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2010-01-01',
            'kelas' => 'X IPA 1',
            'status' => 'aktif',
            'pengguna_id' => $user1->id
        ]);

        $user2 = User::create([
            'nama' => 'Siswa 2',
            'email' => '1002@siswa.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);
        $this->student2 = Siswa::create([
            'nis' => '1002',
            'nama' => 'Siswa XII 1',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '2008-01-01',
            'kelas' => 'XII IPA 1',
            'status' => 'aktif',
            'pengguna_id' => $user2->id
        ]);

        $user3 = User::create([
            'nama' => 'Siswa 3',
            'email' => '1003@siswa.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);
        $this->student3 = Siswa::create([
            'nis' => '1003',
            'nama' => 'Siswa XII 2',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2008-05-01',
            'kelas' => 'XII IPA 1',
            'status' => 'aktif',
            'pengguna_id' => $user3->id
        ]);
    }

    public function test_can_get_students_by_classes_via_ajax()
    {
        $response = $this->actingAs($this->admin)
            ->getJson(route('students.by-classes', ['kelas' => 'XII IPA 1']));

        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['nis' => '1002']);
        $response->assertJsonFragment(['nis' => '1003']);
        $response->assertJsonMissing(['nis' => '1001']); // Student in X IPA 1
    }

    public function test_bulk_graduation_with_exclusions()
    {
        // We want to graduate Student 2 (1002) but exclude Student 3 (1003)
        $response = $this->actingAs($this->admin)
            ->post(route('students.bulk-graduate'), [
                'kelas' => ['XII IPA 1'],
                'id_siswa' => [$this->student2->id], // only student 2 checked
            ]);

        $response->assertRedirect(route('students.index'));
        $response->assertSessionHas('success');

        // Check database
        $this->student2->refresh();
        $this->student3->refresh();

        // Student 2 should be graduated ('lulus') and have class null
        $this->assertEquals('lulus', $this->student2->status);
        $this->assertNull($this->student2->kelas);

        // Student 3 was excluded (not in id_siswa list) and should remain active and in class
        $this->assertEquals('active', $this->student3->status);
        $this->assertEquals('XII IPA 1', $this->student3->kelas);
    }

    public function test_bulk_promotion()
    {
        // Create another student in X IPA 1
        $user4 = User::create([
            'nama' => 'Siswa X 2',
            'email' => '1004@siswa.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);
        $student4 = Siswa::create([
            'nis' => '1004',
            'nama' => 'Siswa X 2',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '2010-06-01',
            'kelas' => 'X IPA 1',
            'status' => 'aktif',
            'pengguna_id' => $user4->id
        ]);

        // Promote X IPA 1 to XI IPA 1 using mapping payload
        $response = $this->actingAs($this->admin)
            ->post(route('students.bulk-promote'), [
                'mapping' => [
                    [
                        'asal' => 'X IPA 1',
                        'tujuan' => 'XI IPA 1',
                    ]
                ]
            ]);

        $response->assertRedirect(route('students.index'));
        $response->assertSessionHas('success');

        // Check database
        $this->student1->refresh();
        $student4->refresh();

        // Both Student 1 and Student 4 should be promoted to XI IPA 1
        $this->assertEquals('XI IPA 1', $this->student1->kelas);
        $this->assertEquals('XI IPA 1', $student4->kelas);
    }
}
