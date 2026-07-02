<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

foreach (\App\Models\MataPelajaran::get() as $m) {
    echo $m->nama . ' | Tingkat: ' . ($m->tingkat ?: 'NULL') . ' | JP: ' . $m->beban_jp . PHP_EOL;
}
