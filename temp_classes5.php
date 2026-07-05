<?php
$gurus = App\Models\Guru::whereHas('user', function($q) {
    $q->whereIn('email', ['agung.srihartono@smansago.com', 'endah.wahyuningsih@smansago.com']);
})->get(['id', 'nama']);

$ids = $gurus->pluck('id')->toArray();

$gk = DB::table('guru_kelas')->whereIn('guru_id', $ids)->get();

$data = [
    'gurus' => $gurus,
    'guru_kelas' => $gk
];

echo json_encode($data);
exit;
