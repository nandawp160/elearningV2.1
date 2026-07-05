<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

echo "Memulai import data siswa dari Excel...\n";

try {
    $spreadsheet = IOFactory::load('md/data_rill/DAFTAR PESERTA DIDIK.xls');
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();
} catch (\Exception $e) {
    die("Gagal membaca file excel: " . $e->getMessage() . "\n");
}

$importedCount = 0;
$skippedCount = 0;

DB::beginTransaction();
try {
    foreach ($rows as $index => $row) {
        // Baris data sebenarnya dimulai sekitar index 8
        if ($index < 8) continue; 
        
        $nama = trim($row[1] ?? '');
        if (empty($nama)) continue;

        $nis_or_no = trim($row[0] ?? '');
        $tempatLahir = trim($row[2] ?? '');
        $tanggalLahir = trim($row[3] ?? '');
        $kelas = trim($row[4] ?? '');
        
        // Buat format email unik (hilangkan karakter aneh)
        $baseEmail = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nama));
        $email = $baseEmail . rand(100, 999) . '@siswa.com';
        
        // Cek jika siswa sudah ada berdasarkan nama
        $existingSiswa = Siswa::where('nama', $nama)->first();
        if ($existingSiswa) {
            // Update kelas siswa untuk plotting
            $existingSiswa->update(['kelas' => $kelas]);
            $skippedCount++; // count as updated
            continue;
        }

        // Bikin akun User
        $user = User::create([
            'name' => $nama,
            'email' => $email,
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        // Simpan data ke tabel siswa
        Siswa::create([
            'pengguna_id' => $user->id,
            'nis' => $nis_or_no ?: str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'nama' => $nama,
            'tempat_lahir' => $tempatLahir,
            'tanggal_lahir' => $tanggalLahir ?: null,
            'kelas' => $kelas,
            'jenis_kelamin' => 'Laki-Laki', // Default
            'status' => 'aktif'
        ]);

        $importedCount++;
        if ($importedCount % 50 == 0) {
            echo "Memproses $importedCount data...\n";
        }
    }
    DB::commit();
    echo "\nSelesai! $importedCount siswa berhasil diimport dan di-plot ke kelas.\n";
    echo "Dilewati (sudah ada sebelumnya): $skippedCount siswa.\n";
} catch (\Exception $e) {
    DB::rollBack();
    echo "Terjadi kesalahan saat import ke database: " . $e->getMessage() . "\n";
}
