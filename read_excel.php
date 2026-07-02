<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('md/data_rill/DAFTAR GURU MAPEL.xlsx');
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();

$subjects = [];
foreach ($rows as $index => $row) {
    if ($index < 6) continue; // Skip headers (they are at row 4 and 5)
    if (!empty($row[5])) {
        $subjects[] = trim($row[5]);
    }
}

$unique_subjects = array_unique($subjects);
sort($unique_subjects);
echo "Subjects in Excel:\n";
print_r($unique_subjects);

$db_subjects = \App\Models\MataPelajaran::select('nama')->distinct()->pluck('nama')->toArray();
// Wait, database subjects have " Kelas X" appended. So we strip that out.
$db_base_subjects = [];
foreach ($db_subjects as $db_sub) {
    $base = preg_replace('/ Kelas (X|XI|XII)$/', '', $db_sub);
    $db_base_subjects[] = $base;
}
$db_base_subjects = array_unique($db_base_subjects);
sort($db_base_subjects);
echo "\nBase Subjects in DB:\n";
print_r($db_base_subjects);
