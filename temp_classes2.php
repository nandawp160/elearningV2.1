<?php
$data = App\Models\Guru::with(['user', 'subjects', 'kelasPerwalian'])
    ->whereHas('user', function($q) {
        $q->whereIn('email', ['agung.srihartono@smansago.com', 'endah.wahyuningsih@smansago.com']);
    })
    ->get()
    ->map(function($g) {
        return [
            'nama' => $g->nama,
            'subjects' => $g->subjects->pluck('id')->toArray(), // Or check what's inside
            'perwalian' => $g->kelasPerwalian->pluck('nama_kelas')->toArray(),
        ];
    })
    ->toArray();

echo json_encode($data);
exit;
