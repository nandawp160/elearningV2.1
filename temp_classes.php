<?php
$data = App\Models\Guru::with(['user', 'kelasDiampu'])
    ->whereHas('user', function($q) {
        $q->whereIn('email', ['agung.srihartono@smansago.com', 'endah.wahyuningsih@smansago.com']);
    })
    ->get()
    ->map(function($g) {
        return [
            'nama' => $g->nama,
            'kelas' => $g->kelasDiampu->pluck('nama_kelas')->toArray()
        ];
    })
    ->toArray();

echo json_encode($data);
exit;
