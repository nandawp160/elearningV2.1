<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use PhpOffice\PhpSpreadsheet\IOFactory;
$file = base_path('md/data_rill/DAFTAR PESERTA DIDIK.xls');
$spreadsheet = IOFactory::load($file);
$sheet = $spreadsheet->getActiveSheet();
$rows = $sheet->toArray();
$classes = [];
foreach($rows as $index => $row) {
    if ($index === 0) continue;
    $kelas = trim($row[4] ?? '');
    if(!empty($kelas) && strtolower($kelas) !== 'rombel saat ini') {
        $classes[] = $kelas;
    }
}
$classes = array_values(array_unique($classes));
sort($classes);

// Print the classes to check
print_r($classes);

// Check current Kelas master data
use App\Models\Kelas;
$currentKelas = Kelas::pluck('nama_kelas')->toArray();
echo "Current Master Data:\n";
print_r($currentKelas);
