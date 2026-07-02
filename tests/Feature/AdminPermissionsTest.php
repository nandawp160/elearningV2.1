<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Pengaturan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPermissionsTest extends TestCase
{
    use RefreshDatabase;

    private $superAdmin;
    private $teacherUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create Super Admin user
        $this->superAdmin = User::create([
            'nama' => 'Super Admin Test',
            'email' => 'superadmin@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
        ]);

        // Create Teacher user
        $this->teacherUser = User::create([
            'nama' => 'Guru Test',
            'email' => 'guru@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);
    }

    public function test_super_admin_can_access_permissions_page()
    {
        $response = $this->actingAs($this->superAdmin)
                         ->withSession(['permissions_unlocked' => true])
                         ->get(route('permissions.index'));
        $response->assertStatus(200);
        $response->assertSee('Matriks Otorisasi');
    }

    public function test_non_super_admin_cannot_access_permissions_page()
    {
        $response = $this->actingAs($this->teacherUser)
                         ->withSession(['permissions_unlocked' => true])
                         ->get(route('permissions.index'));
        $response->assertStatus(403);
    }

    public function test_super_admin_can_save_permissions()
    {
        $payload = [
            'matrix' => [
                'guru' => ['view_siswa', 'view_kelas'],
                'wali_kelas' => ['view_siswa', 'view_kelas', 'approve_dispensasi'],
                'siswa' => ['view_tugas']
            ]
        ];

        $response = $this->actingAs($this->superAdmin)
                         ->withSession(['permissions_unlocked' => true])
                         ->post(route('permissions.store'), $payload);
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Check if database updated
        $this->assertEquals(json_encode(['view_siswa', 'view_kelas']), Pengaturan::getValue('permissions_guru'));
    }

    public function test_dynamic_gate_enforces_permissions()
    {
        // 1. Initially, teacher has default access to view_siswa (which is true)
        $this->actingAs($this->teacherUser);
        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('view_siswa'));

        // 2. Super admin revokes view_siswa from teacher
        Pengaturan::setValue('permissions_guru', json_encode(['view_kelas']));

        // 3. Check if Gate now denies view_siswa
        $this->assertFalse(\Illuminate\Support\Facades\Gate::allows('view_siswa'));
        $this->assertTrue(\Illuminate\Support\Facades\Gate::allows('view_kelas'));
    }
}
