<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Bypass Gate by acting as super admin
$admin = \App\Models\User::where('role', 'admin')->first();
\Illuminate\Support\Facades\Auth::login($admin);

$request = new \Illuminate\Http\Request(['tahun_ajaran' => '2026/2027']);
$controller = app()->make(\App\Http\Controllers\GuruController::class);
$response = $controller->autoPlot($request);

echo "Response status: " . $response->status() . PHP_EOL;

// Check JTM now
foreach (\App\Models\Guru::get() as $g) {
    if ($g->total_jtm > 0) {
        echo $g->nama . ' : ' . $g->total_jtm . PHP_EOL;
    }
}
