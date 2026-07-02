<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$mapels = \App\Models\MataPelajaran::all();
$valid_base_subjects = [
    'Bahasa Indonesia',
    'Bahasa Indonesia Tingkat Lanjut',
    'Bahasa Inggris',
    'Bahasa Inggris Tingkat Lanjut',
    'Bimbingan dan Konseling/Konselor (BP/BK)',
    'Biologi',
    'Ekonomi',
    'Fisika',
    'Geografi',
    'Informatika',
    'Kimia',
    'Matematika (Umum)',
    'Matematika Tingkat Lanjut',
    'Muatan Lokal Bahasa Daerah',
    'Pendidikan Agama Islam dan Budi Pekerti',
    'Pendidikan Jasmani, Olahraga, dan Kesehatan',
    'Pendidikan Pancasila',
    'Prakarya dan Kewirausahaan',
    'Sejarah',
    'Seni dan Budaya',
    'Sosiologi'
];

$to_delete = [];

foreach ($mapels as $mapel) {
    $base = preg_replace('/ Kelas (X|XI|XII)$/', '', $mapel->nama);
    if (!in_array($base, $valid_base_subjects)) {
        $to_delete[] = $mapel->id;
        echo "Will delete: {$mapel->nama} (Base: $base)\n";
    }
}

if (!empty($to_delete)) {
    \App\Models\MataPelajaran::whereIn('id', $to_delete)->delete();
    echo "Deleted " . count($to_delete) . " dummy/old subjects.\n";
} else {
    echo "No dummy subjects found.\n";
}
