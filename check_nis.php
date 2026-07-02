<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$students = \App\Models\Siswa::take(5)->get();
foreach($students as $s) {
    echo $s->nama . ' | NIS: ' . ($s->nis ?: 'NULL') . PHP_EOL;
}
