<?php
$data = App\Models\Guru::with(['user', 'kelasDiampu' => function($q) {
    $q->withoutGlobalScopes();
}])
    ->whereHas('user', function($q) {
        $q->whereIn('email', ['agung.srihartono@smansago.com', 'endah.wahyuningsih@smansago.com']);
    })
    ->get()
    ->map(function($g) {
        return [
            'nama' => $g->nama,
            'kelas' => $g->kelasDiampu->pluck('name')->toArray()
        ];
    })
    ->toArray();

echo json_encode($data);
exit;
