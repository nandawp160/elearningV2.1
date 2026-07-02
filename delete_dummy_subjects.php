<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$deleted = \App\Models\MataPelajaran::where('kode', 'like', 'B-ASING-%')
    ->orWhere('kode', 'like', 'SAS-ING-%')
    ->delete();
    
echo "Deleted {$deleted} dummy subjects." . PHP_EOL;
