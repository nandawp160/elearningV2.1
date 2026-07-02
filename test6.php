<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$allClassrooms = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
    ->where('academic_year', '2026/2027')
    ->get();

$subject = \App\Models\MataPelajaran::where('nama', 'Seni dan Budaya')->first();
$grade = $subject->tingkat;

$targetClasses = $allClassrooms->filter(function($c) use ($grade) {
    if ($c->grade_level !== $grade) return false;
    return true;
});

echo "Seni dan Budaya Tingkat: " . var_export($grade, true) . PHP_EOL;
echo "Target Classes Count: " . $targetClasses->count() . PHP_EOL;

// Why did Agung get 20 classes of Seni dan Budaya in GuruKelas?
$agungPlots = \App\Models\GuruKelas::where('guru_id', \App\Models\Guru::where('nama', 'Agung Srihartono')->first()->id)->get();
echo "Agung has " . $agungPlots->count() . " plots in DB." . PHP_EOL;
