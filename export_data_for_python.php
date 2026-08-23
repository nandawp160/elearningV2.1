<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\GuruKelas;

$classes = Kelas::withoutGlobalScopes()->where('academic_year', '2026/2027')->get()->keyBy('name');
$plottings = GuruKelas::whereIn('kelas_id', $classes->pluck('id'))->with(['guru', 'subject'])->get();
$gurus = Guru::orderBy('nama')->get();

$waliKelas = [
    'X 1' => 'Susilawati, Dra',
    'X 2' => 'Ratna Suryani, S.Pd',
    'X 3' => 'Agung Srihartono, S.Pd',
    'X 4' => 'Murtini Ningsih, S.Si',
    'X 5' => 'Eri Kriswanti, S.Pd',
    'X 6' => 'Khoirul Umam, S.Pd',
    'X 7' => 'Tiyastuti Nur Cahyani, S.Pd',
    'XI F 1' => 'Widodo, S.Pd',
    'XI F 2.1' => 'Endah Wahyuningsih, S.Pd',
    'XI F 2.2' => 'Heru Rismawan, S.Pd',
    'XI F 3.1' => 'Heni Setyarini, S.Pd',
    'XI F 3.2' => 'Puput Rika Harjani, S.Pd',
    'XI F 4.1' => 'Abdul Rouf, S.Pd',
    'XI F 4.2' => 'Sri Widyastuti, S.Pd.I',
    'XII F 1' => 'Umi Farichah, S.Pd, M.Pd',
    'XII F 2.1' => 'Is Imanah, S.Pd, M.Pd',
    'XII F 2.2' => 'Ardjanto, S.Pd',
    'XII F 3.1' => 'Ervhiendri Ali Akhmad, S.Pd',
    'XII F 3.2' => 'Endang Widayanti, S.Sos',
    'XII F 4.1' => 'Sri Kundarti, S.Pd',
    'XII F 4.2' => 'Djoko Heriyanto, S.Pd, M.Pd',
];

$ruanganKelas = [
    'X 1' => 'Ruang Kelas X.1',
    'X 2' => 'Ruang Kelas X.2',
    'X 3' => 'Ruang Kelas X.3',
    'X 4' => 'Ruang Kelas X.4',
    'X 5' => 'Ruang Kelas X.5',
    'X 6' => 'Ruang Kelas X.6',
    'X 7' => 'Ruang Kelas X.7',
    'XI F 1' => 'Ruang Kelas XI F 1',
    'XI F 2.1' => 'Ruang Kelas XI F 2.1',
    'XI F 2.2' => 'Ruang Kelas XI F 2.2',
    'XI F 3.1' => 'Ruang Kelas XI F 3.1',
    'XI F 3.2' => 'Ruang Kelas XI F 3.2',
    'XI F 4.1' => 'Ruang Kelas XI F 4.1',
    'XI F 4.2' => 'Ruang Kelas XI F 4.2',
    'XII F 1' => 'Ruang Kelas XII F 1',
    'XII F 2.1' => 'Ruang Kelas XII F 2.1',
    'XII F 2.2' => 'Ruang Kelas XII F 2.2',
    'XII F 3.1' => 'Ruang Kelas XII F 3.1',
    'XII F 3.2' => 'Ruang Kelas XII F 3.2',
    'XII F 4.1' => 'Ruang Kelas XII F 4.1',
    'XII F 4.2' => 'Ruang Kelas XII F 4.2',
];

$data = [
    'classes' => [],
    'gurus' => [],
    'plottings' => [],
];

foreach ($classes as $cName => $cls) {
    $data['classes'][] = [
        'id' => $cls->id,
        'name' => $cls->name,
        'grade_level' => $cls->grade_level,
        'rumpun' => $cls->rumpun,
        'wali_kelas' => $waliKelas[$cName] ?? '-',
        'ruangan' => $ruanganKelas[$cName] ?? '-',
    ];
}

foreach ($gurus as $g) {
    $data['gurus'][] = [
        'id' => $g->id,
        'nama' => $g->nama,
        'spesialisasi' => $g->spesialisasi,
    ];
}

foreach ($plottings as $p) {
    $data['plottings'][] = [
        'kelas_id' => $p->kelas_id,
        'mata_pelajaran_id' => $p->mata_pelajaran_id,
        'mapel_nama' => $p->subject->nama ?? 'Mapel',
        'beban_jp' => $p->subject->beban_jp ?? 2,
        'guru_id' => $p->guru_id,
        'guru_nama' => $p->guru->nama ?? 'Guru',
    ];
}

file_put_contents(__DIR__ . '/data_jadwal_export.json', json_encode($data, JSON_PRETTY_PRINT));
echo "Successfully exported data_jadwal_export.json with " . count($data['classes']) . " classes and " . count($data['plottings']) . " plottings.\n";
