<?php
$gurus = App\Models\Guru::with(['user', 'kelasDiampu'])->whereIn('id', [229, 245])->get()->map(function($g) {
    return [
        'nama' => $g->nama,
        'email' => $g->user->email ?? '',
        'kelas' => $g->kelasDiampu->pluck('nama_kelas')->toArray()
    ];
})->toArray();
echo json_encode($gurus);
exit;
