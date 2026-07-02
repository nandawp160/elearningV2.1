<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\JadwalPelajaran;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use App\Models\Banding;
use App\Models\PemulihanPengumpulan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

try {
    echo "🧹 Truncating tables...\n";
    // Disable foreign key checks to truncate cleanly
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    User::truncate();
    Guru::truncate();
    Siswa::truncate();
    JadwalPelajaran::truncate();
    Tugas::truncate();
    Pengumpulan::truncate();
    Banding::truncate();
    PemulihanPengumpulan::truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    echo "✅ Tables truncated successfully.\n\n";

    echo "👥 Creating Users & Profil...\n";
    
    // 1. Admin
    $adminUser = User::create([
        'nama' => 'Administrator E-Learning',
        'email' => 'admin@sekolah.sch.id',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]);
    echo "🔹 Admin User created.\n";

    // 2. Guru 1 (Mulyadi - Wali Kelas / Guru Bahasa Indonesia)
    $mulyadiUser = User::create([
        'nama' => 'Drs. H. Mulyadi, M.Pd.',
        'email' => 'mulyadi@sekolah.sch.id',
        'password' => Hash::make('password'),
        'role' => 'guru'
    ]);
    $mulyadiGuru = Guru::create([
        'nip' => '198801012015011001',
        'nama' => 'Drs. H. Mulyadi, M.Pd.',
        'email' => 'mulyadi@sekolah.sch.id',
        'no_hp' => '081299887766',
        'spesialisasi' => 'Bahasa Indonesia',
        'alamat' => 'Jl. Pendidikan No. 12, Boyolali',
        'status' => 'aktif',
        'pengguna_id' => $mulyadiUser->id
    ]);
    echo "🔹 Guru Drs. H. Mulyadi created.\n";

    // 3. Guru 2 (Sari Wahyuni - Guru Bahasa Inggris)
    $sariUser = User::create([
        'nama' => 'Sari Wahyuni, S.Pd.',
        'email' => 'sari.wahyuni@sekolah.sch.id',
        'password' => Hash::make('password'),
        'role' => 'guru'
    ]);
    $sariGuru = Guru::create([
        'nip' => '199012122018032005',
        'nama' => 'Sari Wahyuni, S.Pd.',
        'email' => 'sari.wahyuni@sekolah.sch.id',
        'no_hp' => '085711223344',
        'spesialisasi' => 'Bahasa Inggris',
        'alamat' => 'Perum Griya Indah Blok C/15, Boyolali',
        'status' => 'aktif',
        'pengguna_id' => $sariUser->id
    ]);
    echo "🔹 Guru Sari Wahyuni created.\n";

    // 4. Siswa 1 (Andi - Kelas X IPA 1)
    $andiUser = User::create([
        'nama' => 'Andi Pratama',
        'email' => 'andi@sekolah.sch.id',
        'password' => Hash::make('password'),
        'role' => 'siswa'
    ]);
    $andiSiswa = Siswa::create([
        'nis' => '2025001',
        'nama' => 'Andi Pratama',
        'jenis_kelamin' => 'Laki-laki',
        'tanggal_lahir' => '2009-05-15',
        'kelas' => 'X IPA 1',
        'nama_ortu' => 'Ortu Andi',
        'no_hp_ortu' => '08123456789',
        'alamat' => 'Jl. Merdeka No. 1, Cepogo',
        'status' => 'aktif',
        'pengguna_id' => $andiUser->id
    ]);
    echo "🔹 Siswa Andi Pratama created.\n";

    // 5. Siswa 2 (Budi - Kelas X IPA 1)
    $budiUser = User::create([
        'nama' => 'Budi Santoso',
        'email' => 'budi@sekolah.sch.id',
        'password' => Hash::make('password'),
        'role' => 'siswa'
    ]);
    $budiSiswa = Siswa::create([
        'nis' => '2025002',
        'nama' => 'Budi Santoso',
        'jenis_kelamin' => 'Laki-laki',
        'tanggal_lahir' => '2009-03-20',
        'kelas' => 'X IPA 1',
        'nama_ortu' => 'Ortu Budi',
        'no_hp_ortu' => '08123456780',
        'alamat' => 'Jl. Sudirman No. 2, Cepogo',
        'status' => 'aktif',
        'pengguna_id' => $budiUser->id
    ]);
    echo "🔹 Siswa Budi Santoso created.\n";

    echo "\n📚 Creating Subjects (Mata Pelajaran)...\n";
    
    // Mapel 1: Bahasa Indonesia (Tingkat X)
    $mapelIndo = JadwalPelajaran::create([
        'kode' => 'BIN-X',
        'nama' => 'Bahasa Indonesia X',
        'deskripsi' => 'Mata pelajaran Bahasa Indonesia untuk kelas X',
        'tingkat' => 'X',
        'status' => 'aktif'
    ]);
    
    // Mapel 2: Bahasa Inggris (Tingkat X)
    $mapelInggris = JadwalPelajaran::create([
        'kode' => 'BIG-X',
        'nama' => 'Bahasa Inggris X',
        'deskripsi' => 'Mata pelajaran Bahasa Inggris untuk kelas X',
        'tingkat' => 'X',
        'status' => 'aktif'
    ]);

    // Mapel 3: Matematika (Tingkat XI)
    $mapelMtk = JadwalPelajaran::create([
        'kode' => 'MTK-XI',
        'nama' => 'Matematika XI',
        'deskripsi' => 'Mata pelajaran Matematika untuk kelas XI',
        'tingkat' => 'XI',
        'status' => 'aktif'
    ]);
    echo "✅ 3 Mata Pelajaran created.\n\n";

    echo "📝 Creating Assignments (Tugas)...\n";
    
    // Tugas 1: Overdue Assignment for Bahasa Indonesia (Deadline 3 days ago)
    $tugasOverdue = Tugas::create([
        'mata_pelajaran_id' => $mapelIndo->id,
        'judul' => 'Tugas Laporan Hasil Observasi (LHO)',
        'deskripsi' => 'Kumpulkan laporan hasil observasi lingkungan sekitar Anda dalam format PDF.',
        'deadline' => Carbon::now()->subDays(3),
        'lampiran' => null,
        'status' => 'aktif',
        'guru_id' => $mulyadiGuru->id
    ]);
    echo "🔹 Tugas Overdue created (Deadline: 3 days ago).\n";

    // Tugas 2: Active Assignment for Bahasa Indonesia (Deadline 5 days from now)
    $tugasActiveIndo = Tugas::create([
        'mata_pelajaran_id' => $mapelIndo->id,
        'judul' => 'Membaca Cerita Rakyat Nusantara',
        'deskripsi' => 'Buatlah ringkasan nilai-nilai kehidupan yang terkandung dalam cerita rakyat tersebut.',
        'deadline' => Carbon::now()->addDays(5),
        'lampiran' => null,
        'status' => 'aktif',
        'guru_id' => $mulyadiGuru->id
    ]);
    echo "🔹 Tugas Aktif Indo created (Deadline: 5 days from now).\n";

    // Tugas 3: Active Assignment for Bahasa Inggris (Deadline 2 days from now)
    $tugasActiveInggris = Tugas::create([
        'mata_pelajaran_id' => $mapelInggris->id,
        'judul' => 'Descriptive Text Assignment',
        'deskripsi' => 'Write a descriptive text about your favorite tourism place.',
        'deadline' => Carbon::now()->addDays(2),
        'lampiran' => null,
        'status' => 'aktif',
        'guru_id' => $sariGuru->id
    ]);
    echo "🔹 Tugas Aktif Inggris created (Deadline: 2 days from now).\n";

    echo "\n🎉 Database seeding finished successfully!\n";
    echo "Login Credentials:\n";
    echo "🔑 Admin:\n";
    echo "   Email: admin@sekolah.sch.id\n";
    echo "   Password: password\n";
    echo "🔑 Guru (Mulyadi):\n";
    echo "   Email: mulyadi@sekolah.sch.id\n";
    echo "   Password: password\n";
    echo "🔑 Siswa (Andi):\n";
    echo "   Email: andi@sekolah.sch.id\n";
    echo "   Password: password\n";
    
} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
