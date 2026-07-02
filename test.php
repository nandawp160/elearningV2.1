<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

foreach (\App\Models\Guru::get() as $g) {
    echo $g->nama . ' : ' . $g->total_jtm . PHP_EOL;
}
