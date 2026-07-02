<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$mapels = \App\Models\MataPelajaran::pluck('nama'); 
$bases = []; 
foreach($mapels as $m) { 
    $base = trim(str_replace([' X',' XI',' XII','(Wajib)','(Peminatan)'], '', $m)); 
    $bases[] = $base; 
} 
echo json_encode(array_values(array_unique($bases)), JSON_PRETTY_PRINT);
