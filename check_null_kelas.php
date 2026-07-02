<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$plottings = \App\Models\GuruKelas::with('kelas')->latest('id')->get(); 
$nullKelas = $plottings->filter(fn($p) => is_null($p->kelas)); 
foreach($nullKelas->take(5) as $p) { 
    echo 'Plot ID: ' . $p->id . ', Kelas ID: ' . $p->kelas_id . ', TA: ' . (\Illuminate\Support\Facades\DB::table('kelas')->where('id', $p->kelas_id)->value('academic_year')) . "\n"; 
}
