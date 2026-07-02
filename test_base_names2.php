<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$mapels = \App\Models\MataPelajaran::pluck('nama'); 
$bases = []; 
foreach($mapels as $m) { 
    // Remove X, XI, XII at the end of the string, and any (Wajib)/(Peminatan)
    $base = preg_replace('/\s*\b(X|XI|XII)\b\s*/i', '', $m);
    $base = preg_replace('/\s*\((Wajib|Peminatan)\)\s*/i', ' ', $base);
    $base = trim($base);
    
    // Grouping adjustments
    if (stripos($base, 'Matematika') !== false) {
        if (stripos($m, 'Peminatan') !== false) $base = 'Matematika Peminatan';
        else $base = 'Matematika';
    }
    
    $bases[$m] = $base; 
} 
echo json_encode($bases, JSON_PRETTY_PRINT);
