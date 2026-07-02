<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\JadwalPelajaran;
use App\Models\Tugas;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        echo "\n🌱 Seeding database using Indonesian Schema...\n\n";

        // 1. Create Subjects (Mata Pelajaran)
        echo "📚 Creating subjects...\n";
        $matematika = JadwalPelajaran::updateOrCreate(['kode' => 'MTK-X'], [
            'nama' => 'Matematika X',
            'deskripsi' => 'Matematika Wajib Kelas X',
            'tingkat' => 'X',
            'status' => 'aktif'
        ]);

        $fisika = JadwalPelajaran::updateOrCreate(['kode' => 'FIS-X'], [
            'nama' => 'Fisika X',
            'deskripsi' => 'Fisika Kelas X',
            'tingkat' => 'X',
            'status' => 'aktif'
        ]);

        $kimia = JadwalPelajaran::updateOrCreate(['kode' => 'KIM-X'], [
            'nama' => 'Kimia X',
            'deskripsi' => 'Kimia Kelas X',
            'tingkat' => 'X',
            'status' => 'aktif'
        ]);

        // 2. Create Users & Teachers
        echo "👨‍🏫 Creating teachers...\n";
        
        $pakBudiUser = User::updateOrCreate(['email' => 'budi@guru.smansago.com'], [
            'nama' => 'Pak Budi Santoso',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);
        $pakBudi = Guru::updateOrCreate(['nip' => '197001011995031001'], [
            'nama' => 'Pak Budi Santoso',
            'email' => 'budi@guru.smansago.com',
            'no_hp' => '081234567890',
            'spesialisasi' => 'Matematika X',
            'specialization_id' => $matematika->id,
            'status' => 'aktif',
            'pengguna_id' => $pakBudiUser->id
        ]);

        $ibuSitiUser = User::updateOrCreate(['email' => 'siti@guru.smansago.com'], [
            'nama' => 'Ibu Siti Aminah',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);
        $ibuSiti = Guru::updateOrCreate(['nip' => '197505051996032002'], [
            'nama' => 'Ibu Siti Aminah',
            'email' => 'siti@guru.smansago.com',
            'no_hp' => '081234567891',
            'spesialisasi' => 'Fisika X',
            'specialization_id' => $fisika->id,
            'status' => 'aktif',
            'pengguna_id' => $ibuSitiUser->id
        ]);

        $pakAhmadUser = User::updateOrCreate(['email' => 'ahmad@guru.smansago.com'], [
            'nama' => 'Pak Ahmad Yani',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);
        $pakAhmad = Guru::updateOrCreate(['nip' => '198002021997031003'], [
            'nama' => 'Pak Ahmad Yani',
            'email' => 'ahmad@guru.smansago.com',
            'no_hp' => '081234567892',
            'spesialisasi' => 'Kimia X',
            'specialization_id' => $kimia->id,
            'status' => 'aktif',
            'pengguna_id' => $pakAhmadUser->id
        ]);

        // 3. Create Students
        echo "👨‍🎓 Creating students...\n";
        
        $andiUser = User::updateOrCreate(['email' => 'andi@siswa.smansago.com'], [
            'nama' => 'Andi Pratama',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);
        $andi = Siswa::updateOrCreate(['nis' => '2025001'], [
            'nama' => 'Andi Pratama',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2009-05-15',
            'kelas' => 'X IPA 1',
            'nama_ortu' => 'Bapak Pratama',
            'no_hp_ortu' => '081234567801',
            'alamat' => 'Jl. Merdeka No. 1, Boyolali',
            'status' => 'aktif',
            'pengguna_id' => $andiUser->id
        ]);

        $budiUser = User::updateOrCreate(['email' => 'budi@siswa.smansago.com'], [
            'nama' => 'Budi Santoso',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);
        $budi = Siswa::updateOrCreate(['nis' => '2025002'], [
            'nama' => 'Budi Santoso',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2009-03-20',
            'kelas' => 'X IPA 1',
            'nama_ortu' => 'Bapak Santoso',
            'no_hp_ortu' => '081234567802',
            'alamat' => 'Jl. Sudirman No. 2, Boyolali',
            'status' => 'aktif',
            'pengguna_id' => $budiUser->id
        ]);

        // 4. Create Super Admin
        echo "👤 Creating super admin...\n";
        User::updateOrCreate(['email' => 'admin@admin.smansago.com'], [
            'nama' => 'Super Admin',
            'password' => Hash::make('smansago'),
            'role' => 'admin',
        ]);

        // 5. Create Assignments (Tugas)
        echo "📝 Creating assignments...\n";
        
        Tugas::updateOrCreate([
            'judul' => 'Tugas Matematika Logika',
            'mata_pelajaran_id' => $matematika->id
        ], [
            'deskripsi' => 'Kerjakan latihan soal bab 1 nomor 1-10.',
            'deadline' => Carbon::now()->addDays(5),
            'guru_id' => $pakBudi->id,
            'status' => 'aktif'
        ]);

        Tugas::updateOrCreate([
            'judul' => 'Tugas Fisika Kinematika',
            'mata_pelajaran_id' => $fisika->id
        ], [
            'deskripsi' => 'Kerjakan laporan praktikum Gerak Lurus Beraturan.',
            'deadline' => Carbon::now()->addDays(3),
            'guru_id' => $ibuSiti->id,
            'status' => 'aktif'
        ]);

        echo "\n✅ Seeding finished successfully!\n";
    }
}
