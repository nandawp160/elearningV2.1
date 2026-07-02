<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$teacher = \App\Models\Guru::where('nama', 'Agung Srihartono')->first();
$assignments = $teacher->teachingAssignments()->with(['kelas', 'subject'])->get();
foreach ($assignments as $a) {
    echo "Kelas: " . ($a->kelas ? $a->kelas->name . ' (' . $a->kelas->academic_year . ')' : 'NULL') . 
         " | Mapel: " . ($a->subject ? $a->subject->nama : 'NULL') . PHP_EOL;
}
