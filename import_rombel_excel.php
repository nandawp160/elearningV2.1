<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

echo "Memulai import plotting Wali Kelas dari Excel...\n";

try {
    $spreadsheet = IOFactory::load('md/data_rill/ROMBEL.xlsx');
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();
} catch (\Exception $e) {
    die("Gagal membaca file excel: " . $e->getMessage() . "\n");
}

$updatedCount = 0;
$notFoundGuru = 0;
$notFoundKelas = 0;

DB::beginTransaction();
try {
    foreach ($rows as $index => $row) {
        if ($index < 7) continue; 
        
        if (empty(trim($row[1] ?? ''))) continue;

        $namaRombelRaw = trim($row[1]); 
        $namaWaliKelas = trim($row[6] ?? '');

        $namaRombelVariations = [
            $namaRombelRaw,
            str_replace(' ', '.', $namaRombelRaw), 
            str_replace('.', ' ', $namaRombelRaw),
            str_replace(' ', '', $namaRombelRaw)
        ];

        $kelas = \Illuminate\Support\Facades\DB::table('kelas')->whereIn('name', $namaRombelVariations)->first();
        
        if (!$kelas) {
            echo "Kelas tidak ditemukan di DB: $namaRombelRaw\n";
            $notFoundKelas++;
            continue;
        }

        $guru = Guru::where('nama', 'LIKE', '%' . $namaWaliKelas . '%')->first();

        if ($guru) {
            \Illuminate\Support\Facades\DB::table('kelas')->where('id', $kelas->id)->update([
                'homeroom_teacher_id' => $guru->id
            ]);
            $updatedCount++;
            echo "Plotting: Kelas {$kelas->name} -> Wali Kelas: {$guru->nama}\n";
        } else {
            echo "Guru (Wali Kelas) tidak ditemukan: $namaWaliKelas\n";
            $notFoundGuru++;
        }
    }
    DB::commit();
    echo "\nSelesai! $updatedCount kelas berhasil di-plot dengan Wali Kelas.\n";
    echo "Kelas tidak ditemukan: $notFoundKelas\n";
    echo "Guru tidak ditemukan: $notFoundGuru\n";
} catch (\Exception $e) {
    DB::rollBack();
    echo "Terjadi kesalahan saat update database: " . $e->getMessage() . "\n";
}
