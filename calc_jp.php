<?php
$totalTeachers = App\Models\Guru::count();
$classes = App\Models\Kelas::all();
$totalJpNeeded = 0;

// Let's see how subjects are assigned to classes.
// Usually, a subject has a 'tingkat' (X, XI, XII).
// If a subject belongs to 'X', then all 'X' classes must take it.
$subjects = App\Models\MataPelajaran::all();

foreach ($classes as $kelas) {
    // For each class, find the subjects that belong to its grade_level
    $kelasSubjects = $subjects->where('tingkat', $kelas->grade_level);
    
    // Sum the beban_jp for these subjects
    $kelasJp = $kelasSubjects->sum('beban_jp');
    
    // Add to total
    $totalJpNeeded += $kelasJp;
}

// If tingkat is null for all, maybe they are shared?
// Let's check how many subjects have tingkat set.
$subjectsWithTingkat = $subjects->whereNotNull('tingkat')->count();
$totalBebanSemuaMapel = $subjects->sum('beban_jp');

echo json_encode([
    'total_guru' => $totalTeachers,
    'total_kelas' => $classes->count(),
    'mapel_dengan_tingkat' => $subjectsWithTingkat,
    'total_beban_semua_mapel_sekali_jalan' => $totalBebanSemuaMapel,
    'total_jp_dihitung_berdasar_kelas' => $totalJpNeeded,
    'rata_rata_jp_per_guru' => $totalJpNeeded > 0 ? round($totalJpNeeded / $totalTeachers, 2) : round(($totalBebanSemuaMapel * $classes->count()) / $totalTeachers, 2)
]);
exit;
