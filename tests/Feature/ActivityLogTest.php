<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Kelas;
use App\Models\ActivityLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityLogTest extends TestCase
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

    public function test_super_admin_can_access_activity_logs_page()
    {
        // Log an activity first
        ActivityLog::log('TEST', 'Uji coba log aktivitas');

        $response = $this->actingAs($this->superAdmin)->get(route('activity-logs.index'));
        $response->assertStatus(200);
        $response->assertSee('Log Aktivitas');
        $response->assertSee('Uji coba log aktivitas');
    }

    public function test_non_super_admin_cannot_access_activity_logs_page()
    {
        $response = $this->actingAs($this->teacherUser)->get(route('activity-logs.index'));
        $response->assertStatus(403);
    }

    public function test_creating_classroom_records_activity_log()
    {
        $response = $this->actingAs($this->superAdmin)->post(route('classrooms.store'), [
            'name' => 'X IPA Test',
            'tingkat' => 'X',
            'jurusan' => 'IPA',
            'tahunAjaran' => '2025/2026',
            'kapasitasMaksimal' => 36,
        ]);

        $response->assertRedirect(route('classrooms.index'));

        // Assert database has the class
        $this->assertDatabaseHas('kelas', [
            'name' => 'X IPA Test',
        ]);

        // Assert database has the activity log
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'CLASS',
            'user_id' => $this->superAdmin->id,
        ]);

        $latestLog = ActivityLog::latest()->first();
        $this->assertStringContainsString('Membuat kelas baru: X IPA Test', $latestLog->description);
    }
}
