<?php
$gk = DB::table('guru_kelas')->take(5)->get();
$tugas = DB::table('tugas')->take(5)->get();
$jadwal = Schema::hasTable('jadwal_pelajaran') ? DB::table('jadwal_pelajaran')->take(5)->get() : [];

echo json_encode([
    'guru_kelas' => $gk,
    'tugas' => $tugas,
    'jadwal' => $jadwal
]);
exit;
