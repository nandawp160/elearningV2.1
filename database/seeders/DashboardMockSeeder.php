<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use App\Models\Banding;
use Carbon\Carbon;

class DashboardMockSeeder extends Seeder
{
    public function run(): void
    {
        echo "🌱 Seeding mock data for Teacher Dashboard...\n";

        // Find or create subject Matematika X
        $subject = JadwalPelajaran::where('kode', 'MTK-X')->first();
        if (!$subject) {
            $subject = JadwalPelajaran::create([
                'kode' => 'MTK-X',
                'nama' => 'Matematika X',
                'deskripsi' => 'Matematika Wajib Kelas X',
                'tingkat' => 'X',
                'status' => 'aktif',
            ]);
        }

        // Find teacher Pak Budi Santoso
        $guru = Guru::where('nama', 'like', '%Budi Santoso%')->first();
        if (!$guru) {
            echo "Guru Pak Budi Santoso not found. Seeding first...\n";
            $user = User::create([
                'nama' => 'Pak Budi Santoso',
                'email' => 'budi@guru.smansago.com',
                'password' => Hash::make('password'),
                'role' => 'guru',
            ]);
            $guru = Guru::create([
                'nip' => '197001011995031001',
                'nama' => 'Pak Budi Santoso',
                'email' => 'budi@guru.smansago.com',
                'no_hp' => '081234567890',
                'spesialisasi' => 'Matematika X',
                'specialization_id' => $subject->id,
                'status' => 'aktif',
                'pengguna_id' => $user->id,
            ]);
        }

        // Create class room if not exists
        \App\Models\Kelas::withoutGlobalScopes()->updateOrCreate(
            ['name' => 'X IPA 1'],
            [
                'grade_level' => 'X',
                'major' => 'IPA',
                'max_students' => 50,
                'academic_year' => '2025/2026',
                'homeroom_teacher_id' => $guru->id,
            ]
        );

        // Create 45 students in X IPA 1
        echo "Creating 45 students...\n";
        $students = [];
        for ($i = 1; $i <= 45; $i++) {
            $email = "siswa{$i}@siswa.smansago.com";
            $user = User::updateOrCreate(['email' => $email], [
                'nama' => "Siswa ke-$i",
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]);

            $student = Siswa::updateOrCreate(['nis' => "2025" . str_pad($i + 10, 3, '0', STR_PAD_LEFT)], [
                'nama' => "Siswa ke-$i",
                'jenis_kelamin' => $i % 2 == 0 ? 'Perempuan' : 'Laki-laki',
                'tanggal_lahir' => '2009-01-01',
                'kelas' => 'X IPA 1',
                'nama_ortu' => "Orang Tua Siswa $i",
                'no_hp_ortu' => '08123456789',
                'alamat' => 'Boyolali',
                'status' => 'aktif',
                'pengguna_id' => $user->id,
            ]);
            $students[] = $student;
        }

        // Create assignment "Tugas Harian Aljabar"
        echo "Creating assignment 'Tugas Harian Aljabar'...\n";
        $tugasAljabar = Tugas::updateOrCreate([
            'judul' => 'Tugas Harian Aljabar',
            'mata_pelajaran_id' => $subject->id,
            'guru_id' => $guru->id,
        ], [
            'deskripsi' => 'Kerjakan soal aljabar linear pada halaman 45 buku cetak.',
            'deadline' => Carbon::now()->addDays(2),
            'status' => 'aktif',
        ]);

        // Create 45 submissions for "Tugas Harian Aljabar"
        echo "Creating 45 submissions for 'Tugas Harian Aljabar'...\n";
        foreach ($students as $student) {
            Pengumpulan::updateOrCreate([
                'tugas_id' => $tugasAljabar->id,
                'siswa_id' => $student->id,
            ], [
                'tanggal_pengumpulan' => Carbon::now()->subHours(rand(1, 12)),
                'file_tugas' => 'submissions/mock_file.pdf',
                'status' => 'terkumpul',
            ]);
        }

        // Create assignment "Evaluasi Kompetensi"
        echo "Creating assignment 'Evaluasi Kompetensi'...\n";
        Tugas::updateOrCreate([
            'judul' => 'Evaluasi Kompetensi',
            'mata_pelajaran_id' => $subject->id,
            'guru_id' => $guru->id,
        ], [
            'deskripsi' => 'Mempersiapkan evaluasi akhir kompetensi dasar aljabar.',
            'deadline' => Carbon::now()->addDays(7),
            'status' => 'aktif',
        ]);

        // Create 3 pending appeals
        echo "Creating 3 pending appeals...\n";
        for ($i = 0; $i < 3; $i++) {
            Banding::updateOrCreate([
                'siswa_id' => $students[$i]->id,
                'mata_pelajaran_id' => $subject->id,
                'tugas_id' => $tugasAljabar->id,
            ], [
                'alasan' => 'Sakit dan melampirkan surat dokter.',
                'status' => 'pending', // Will be mutated to 'ditinjau'
            ]);
        }

        echo "✅ Mock data seeded successfully!\n";
    }
}
