<?php
$data = App\Models\Guru::has('kelasDiampu')
    ->with(['user', 'kelasDiampu'])
    ->take(2)
    ->get()
    ->map(function($g) {
        return [
            'email' => $g->user->email ?? '',
            'nama' => $g->nama,
            'mapel' => $g->spesialisasi,
            'kelas' => $g->kelasDiampu->pluck('nama_kelas')->toArray()
        ];
    })
    ->toArray();

echo json_encode($data);
exit;
