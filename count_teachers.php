<?php
$all = App\Models\Guru::with('user')->get();
$dummy = 0;
$real = 0;

foreach ($all as $guru) {
    $email = $guru->user->email ?? '';
    // Dummy indicators
    if (str_contains($email, 'test') || 
        str_contains($email, 'budi@') || 
        str_contains($email, 'siti@') || 
        str_contains($email, 'ahmad@') || 
        str_contains($email, 'guru.smansago.com') ||
        str_contains($email, 'pak.santoso')
    ) {
        $dummy++;
    } else {
        $real++;
    }
}

echo json_encode(['total' => $all->count(), 'real' => $real, 'dummy' => $dummy]);
exit;
