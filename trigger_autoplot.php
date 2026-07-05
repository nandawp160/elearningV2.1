<?php
$request = new \Illuminate\Http\Request();
$request->merge(['tahun_ajaran' => '2026/2027']); // Assuming 2026/2027 is the active academic year

$controller = new \App\Http\Controllers\GuruController();

// Bypass Gate authorization by using actingAs with Super Admin
$superAdmin = \App\Models\User::where('role', 'super_admin')->first();
if ($superAdmin) {
    auth()->login($superAdmin);
}

$response = $controller->autoPlot($request);

echo "AutoPlot response status: " . $response->getStatusCode() . "\n";
$session = session()->all();
if (isset($session['success'])) {
    echo "Success: " . $session['success'] . "\n";
}
if (isset($session['unassigned'])) {
    echo "Unassigned: " . print_r($session['unassigned'], true) . "\n";
}
if (isset($session['error'])) {
    echo "Error: " . $session['error'] . "\n";
}
exit;
