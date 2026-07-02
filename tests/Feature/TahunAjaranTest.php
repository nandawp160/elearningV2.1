<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Pengaturan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TahunAjaranTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed default active year
        Pengaturan::setValue('tahun_ajaran_aktif', '2025/2026');
    }

    public function test_kelas_is_automatically_filtered_by_active_academic_year()
    {
        // Create classes in different academic years
        Kelas::create([
            'name' => 'ClassAlpha',
            'grade_level' => 'X',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 36,
        ]);

        Kelas::create([
            'name' => 'ClassBeta',
            'grade_level' => 'XI',
            'major' => 'IPA',
            'academic_year' => '2026/2027',
            'max_students' => 36,
        ]);

        // Query classes - by default only the active year (2025/2026) is returned
        $classes = Kelas::all();
        $this->assertCount(1, $classes);
        $this->assertEquals('ClassAlpha', $classes->first()->name);

        // Bypassing the scope should return both classes
        $allClasses = Kelas::withoutGlobalScope('tahun_ajaran_aktif')->get();
        $this->assertCount(2, $allClasses);
    }

    public function test_admin_can_update_active_academic_year_via_settings()
    {
        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->post(route('settings.update'), [
                'school_name' => 'SMA Negeri 1 Cepogo',
                'school_email' => 'info@smansago.sch.id',
                'fonnte_token' => 'dummy-token',
                'lock_duration_hours' => 24,
                'allow_dispensations' => 1,
                'wa_notification_status' => 1,
                'tahun_ajaran_aktif' => '2025/2026',
                'tahun_ajaran_baru' => '2026/2027', // add and activate new year
            ]);

        $response->assertRedirect(route('settings.index'));
        $this->assertEquals('2026/2027', Pengaturan::getValue('tahun_ajaran_aktif'));
    }

    public function test_classrooms_index_filters_by_selected_academic_year()
    {
        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        Kelas::create([
            'name' => 'ClassAlpha',
            'grade_level' => 'X',
            'major' => 'IPA',
            'academic_year' => '2025/2026',
            'max_students' => 36,
        ]);

        Kelas::create([
            'name' => 'ClassBeta',
            'grade_level' => 'XI',
            'major' => 'IPA',
            'academic_year' => '2026/2027',
            'max_students' => 36,
        ]);

        // Default query uses active year (2025/2026)
        $response = $this->actingAs($admin)->get(route('classrooms.index'));
        $response->assertStatus(200);
        $response->assertSee('ClassAlpha');
        $response->assertDontSee('ClassBeta');

        // Explicit filter for 2026/2027
        $responseFiltered = $this->actingAs($admin)->get(route('classrooms.index', ['tahun_ajaran' => '2026/2027']));
        $responseFiltered->assertStatus(200);
        $responseFiltered->assertSee('ClassBeta');
        $responseFiltered->assertDontSee('ClassAlpha');
        
        // Explicit filter 'all'
        $responseAll = $this->actingAs($admin)->get(route('classrooms.index', ['tahun_ajaran' => 'all']));
        $responseAll->assertStatus(200);
        $responseAll->assertSee('ClassAlpha');
        $responseAll->assertSee('ClassBeta');
    }

    public function test_admin_can_add_custom_academic_year_via_ajax()
    {
        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->postJson(route('settings.add-academic-year'), [
                'tahun_ajaran' => '2027/2028',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'tahun_ajaran' => '2027/2028',
        ]);

        $this->assertEquals('2025/2026', Pengaturan::getValue('tahun_ajaran_aktif'));
        
        $custom_years = json_decode(Pengaturan::getValue('daftar_tahun_ajaran_custom'), true);
        $this->assertContains('2027/2028', $custom_years);
    }

    public function test_admin_can_delete_custom_academic_year_via_ajax()
    {
        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // First set a custom academic year
        Pengaturan::setValue('daftar_tahun_ajaran_custom', json_encode(['2027/2028']));

        $response = $this->actingAs($admin)
            ->postJson(route('settings.delete-academic-year'), [
                'tahun_ajaran' => '2027/2028',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'tahun_ajaran' => '2027/2028',
        ]);

        $custom_years = json_decode(Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
        $this->assertNotContains('2027/2028', $custom_years);
    }

    public function test_admin_cannot_delete_active_academic_year()
    {
        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Activating active year (set to 2025/2026 by default in setUp)
        $response = $this->actingAs($admin)
            ->postJson(route('settings.delete-academic-year'), [
                'tahun_ajaran' => '2025/2026',
            ]);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Tahun ajaran aktif tidak dapat dihapus. Silakan ganti tahun ajaran aktif terlebih dahulu.',
        ]);
    }

    public function test_admin_cannot_delete_academic_year_containing_class()
    {
        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Add to custom years
        Pengaturan::setValue('daftar_tahun_ajaran_custom', json_encode(['2027/2028']));

        // Create a classroom with this year
        Kelas::create([
            'name' => 'Class Gamma',
            'grade_level' => 'XII',
            'major' => 'IPA',
            'academic_year' => '2027/2028',
            'max_students' => 36,
        ]);

        $response = $this->actingAs($admin)
            ->postJson(route('settings.delete-academic-year'), [
                'tahun_ajaran' => '2027/2028',
            ]);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Tahun ajaran ini memiliki data kelas aktif di database dan tidak dapat dihapus.',
        ]);

        // Verify it was NOT deleted
        $custom_years = json_decode(Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
        $this->assertContains('2027/2028', $custom_years);
    }

    public function test_admin_can_edit_custom_academic_year_via_ajax()
    {
        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Set custom academic year
        Pengaturan::setValue('daftar_tahun_ajaran_custom', json_encode(['2023/2025']));

        $response = $this->actingAs($admin)
            ->postJson(route('settings.edit-academic-year'), [
                'old_tahun_ajaran' => '2023/2025',
                'new_tahun_ajaran' => '2023/2024',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'old_tahun_ajaran' => '2023/2025',
            'new_tahun_ajaran' => '2023/2024',
            'is_active' => false,
        ]);

        $custom_years = json_decode(Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
        $this->assertContains('2023/2024', $custom_years);
        $this->assertNotContains('2023/2025', $custom_years);
    }

    public function test_editing_active_academic_year_updates_active_setting()
    {
        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Set custom academic year and make it active
        Pengaturan::setValue('daftar_tahun_ajaran_custom', json_encode(['2023/2025']));
        Pengaturan::setValue('tahun_ajaran_aktif', '2023/2025');

        $response = $this->actingAs($admin)
            ->postJson(route('settings.edit-academic-year'), [
                'old_tahun_ajaran' => '2023/2025',
                'new_tahun_ajaran' => '2023/2024',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_active' => true,
        ]);

        $this->assertEquals('2023/2024', Pengaturan::getValue('tahun_ajaran_aktif'));
    }

    public function test_editing_academic_year_updates_classes_in_database()
    {
        $admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin.test@sekolah.sch.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Add to custom years
        Pengaturan::setValue('daftar_tahun_ajaran_custom', json_encode(['2023/2025']));

        // Create a classroom with this year
        $kelas = Kelas::create([
            'name' => 'Class Gamma',
            'grade_level' => 'XII',
            'major' => 'IPA',
            'academic_year' => '2023/2025',
            'max_students' => 36,
        ]);

        $response = $this->actingAs($admin)
            ->postJson(route('settings.edit-academic-year'), [
                'old_tahun_ajaran' => '2023/2025',
                'new_tahun_ajaran' => '2023/2024',
            ]);

        $response->assertStatus(200);

        // Verify the database class record was updated
        $updatedClass = Kelas::withoutGlobalScope('tahun_ajaran_aktif')->find($kelas->id);
        $this->assertEquals('2023/2024', $updatedClass->academic_year);
    }
}
