<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class StudentDashboardRedesignTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_dashboard_can_be_rendered_with_redesign_elements(): void
    {
        // 1. Create a student record
        $student = Siswa::create([
            'nis' => '23241001',
            'name' => 'Siswa 1',
            'kelas' => 'X IPA 1',
            'status' => 'active',
            'phone' => '081234567890',
            'address' => 'Test Address',
            'gender' => 'Laki-laki',
            'date_of_birth' => '2009-01-01',
            'entry_year' => '2025'
        ]);

        // 2. Create the associated user
        $studentUser = User::create([
            'nama' => 'Siswa 1',
            'email' => 'siswa1@siswa.smansago.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);

        // 3. Link student and user
        $student->update(['pengguna_id' => $studentUser->id]);

        // 4. Act as student and request dashboard
        $response = $this->actingAs($studentUser)->get('/dashboard');

        // 4. Assertions
        $response->assertStatus(200);
        
        // Assert Greeting and Sapaan
        $response->assertSee('Halo');
        $response->assertSee('Mari selesaikan tugas-tugasmu hari ini.');
        
        // Assert Mascot Video Asset is present
        $response->assertSee('video autoplay loop muted playsinline');
        $response->assertSee('assets/maskot/maskot_dashboard.mp4');
        
        // Assert Log Version card details
        $response->assertSee('Log Version:');
        $response->assertSee('Fitur Baru: Aktifkan Akun E-learning Siswa');
        $response->assertSee('Fitur Baru: Penguncian tugas otomatis aktif');
        $response->assertSee('Fitur Angket: Wajib mengisi evaluasi guru');
        
        // Assert Indonesian Date in header
        $indonesianDate = Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY');
        $response->assertSee($indonesianDate);
    }
}
