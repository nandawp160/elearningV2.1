<?php
$activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');

$teacherJp = DB::table('guru_kelas')
    ->join('kelas', 'guru_kelas.kelas_id', '=', 'kelas.id')
    ->join('mata_pelajaran', 'guru_kelas.mata_pelajaran_id', '=', 'mata_pelajaran.id')
    ->where('kelas.academic_year', $activeYear)
    ->select('guru_kelas.guru_id')
    ->selectRaw('SUM(mata_pelajaran.beban_jp) as total_jp')
    ->groupBy('guru_kelas.guru_id')
    ->pluck('total_jp', 'guru_id')
    ->toArray();

$teachers = App\Models\Guru::active()->get();
$lessThanAverage = [];
$zeroJp = [];
$moreThanAverage = [];

foreach ($teachers as $t) {
    $jp = (int) ($teacherJp[$t->id] ?? 0);
    
    if ($jp == 0) {
        $zeroJp[] = ['nama' => $t->nama, 'mapel' => $t->spesialisasi];
    } elseif ($jp < 24) {
        $lessThanAverage[] = ['nama' => $t->nama, 'jp' => $jp, 'mapel' => $t->spesialisasi];
    } else {
        $moreThanAverage[] = ['nama' => $t->nama, 'jp' => $jp, 'mapel' => $t->spesialisasi];
    }
}

echo json_encode([
    'active_year' => $activeYear,
    'zero' => $zeroJp,
    'kurang_dari_24' => $lessThanAverage,
    'total_zero' => count($zeroJp),
    'total_kurang' => count($lessThanAverage),
    'total_lebih_atau_pas' => count($moreThanAverage)
]);
exit;
