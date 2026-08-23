<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Guru;

$gurus = Guru::all();
echo "Total Gurus: " . $gurus->count() . "\n";
foreach ($gurus as $g) {
    echo "ID: {$g->id} | {$g->nama} | Spec: {$g->spesialisasi}\n";
}
