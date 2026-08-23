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

$kelasXNames = ['X 1', 'X 2', 'X 3', 'X 4', 'X 5', 'X 6', 'X 7'];
$kelasMipaXI  = ['XI F 1', 'XI F 2.1', 'XI F 2.2', 'XI F 4.1'];
$kelasMipaXII = ['XII F 1', 'XII F 2.1', 'XII F 2.2', 'XII F 4.1'];
$kelasMipaNames = array_merge($kelasMipaXI, $kelasMipaXII);

$kelasIpsXI  = ['XI F 3.1', 'XI F 3.2', 'XI F 4.2'];
$kelasIpsXII = ['XII F 3.1', 'XII F 3.2', 'XII F 4.2'];
$kelasIpsNames  = array_merge($kelasIpsXI, $kelasIpsXII);
$kelasFaseFNames = array_merge($kelasMipaNames, $kelasIpsNames);

$plottings = [];

// 1. KELAS X (FASE E - 7 KELAS)
$plottings[] = ['mapel_id' => 14, 'guru_id' => 25, 'classes' => ['X 1', 'X 3', 'X 5', 'X 7']]; // Sri Widyastuti (4)
$plottings[] = ['mapel_id' => 14, 'guru_id' => 16, 'classes' => ['X 2', 'X 4', 'X 6']];        // Khoirul Umam (3)
$plottings[] = ['mapel_id' => 6,  'guru_id' => 8,  'classes' => ['X 1', 'X 2', 'X 3', 'X 4']];  // Endang (4)
$plottings[] = ['mapel_id' => 6,  'guru_id' => 7,  'classes' => ['X 5', 'X 6', 'X 7']];        // Endah (3)
$plottings[] = ['mapel_id' => 9,  'guru_id' => 11, 'classes' => ['X 1', 'X 4', 'X 7']];        // Heni Setyarini (3)
$plottings[] = ['mapel_id' => 9,  'guru_id' => 27, 'classes' => ['X 2', 'X 5']];               // Susilawati (2)
$plottings[] = ['mapel_id' => 9,  'guru_id' => 29, 'classes' => ['X 3', 'X 6']];               // Teguh (2)
$plottings[] = ['mapel_id' => 21, 'guru_id' => 26, 'classes' => ['X 1', 'X 4', 'X 7']];        // Sunarno (3)
$plottings[] = ['mapel_id' => 21, 'guru_id' => 19, 'classes' => ['X 2', 'X 5']];               // Murtini Ningsih (2)
$plottings[] = ['mapel_id' => 21, 'guru_id' => 12, 'classes' => ['X 3', 'X 6']];               // Heru Rismawan (2)
$plottings[] = ['mapel_id' => 3,  'guru_id' => 3,  'classes' => ['X 1', 'X 3', 'X 5', 'X 7']]; // Ardjanto (4)
$plottings[] = ['mapel_id' => 3,  'guru_id' => 17, 'classes' => ['X 2', 'X 4', 'X 6']];        // Lanjar Setyowati (3)
$plottings[] = ['mapel_id' => 5,  'guru_id' => 10, 'classes' => ['X 1', 'X 4', 'X 7']];        // Ervhiendri (3)
$plottings[] = ['mapel_id' => 5,  'guru_id' => 15, 'classes' => ['X 2', 'X 5']];               // Joko Widodo (2)
$plottings[] = ['mapel_id' => 5,  'guru_id' => 6,  'classes' => ['X 3', 'X 6']];               // Djoko Heriyanto (2)
$plottings[] = ['mapel_id' => 16, 'guru_id' => 13, 'classes' => $kelasXNames];                  // Iis Lestari (7)
$plottings[] = ['mapel_id' => 31, 'guru_id' => 21, 'classes' => $kelasXNames];                  // Puput Rika (7)

// 2. KELAS XI & XII (FASE F - 14 KELAS)
$plottings[] = ['mapel_id' => 14, 'guru_id' => 25, 'classes' => ['XI F 1', 'XI F 2.2', 'XI F 3.2', 'XI F 4.2', 'XII F 2.1', 'XII F 3.1', 'XII F 4.1']]; // Sri Widyastuti (7)
$plottings[] = ['mapel_id' => 14, 'guru_id' => 16, 'classes' => ['XI F 2.1', 'XI F 3.1', 'XI F 4.1', 'XII F 1', 'XII F 2.2', 'XII F 3.2', 'XII F 4.2']]; // Khoirul Umam (7)
$plottings[] = ['mapel_id' => 6,  'guru_id' => 7,  'classes' => $kelasFaseFNames];              // Endah (14)
$plottings[] = ['mapel_id' => 9,  'guru_id' => 11, 'classes' => ['XI F 1', 'XI F 2.2', 'XI F 4.1', 'XII F 2.1', 'XII F 3.2']];         // Heni Setyarini (5)
$plottings[] = ['mapel_id' => 9,  'guru_id' => 27, 'classes' => ['XI F 2.1', 'XI F 3.1', 'XI F 4.2', 'XII F 2.2', 'XII F 4.1']];        // Susilawati (5)
$plottings[] = ['mapel_id' => 9,  'guru_id' => 29, 'classes' => ['XI F 3.2', 'XII F 1', 'XII F 3.1', 'XII F 4.2']];                    // Teguh (4)
$plottings[] = ['mapel_id' => 21, 'guru_id' => 30, 'classes' => ['XI F 1', 'XI F 2.2', 'XI F 4.1', 'XII F 2.1', 'XII F 3.2']];         // Tiyastuti (5)
$plottings[] = ['mapel_id' => 21, 'guru_id' => 15, 'classes' => ['XI F 2.1', 'XI F 3.1', 'XI F 4.2', 'XII F 2.2', 'XII F 4.1']];        // Joko Widodo (5)
$plottings[] = ['mapel_id' => 21, 'guru_id' => 33, 'classes' => ['XI F 3.2', 'XII F 1', 'XII F 3.1', 'XII F 4.2']];                    // Widodo (4)
$plottings[] = ['mapel_id' => 3,  'guru_id' => 4,  'classes' => ['XI F 1', 'XI F 2.2', 'XI F 3.2', 'XI F 4.2', 'XII F 2.1', 'XII F 3.1', 'XII F 4.1']]; // ARIEF DARMAYANTI (7)
$plottings[] = ['mapel_id' => 3,  'guru_id' => 21, 'classes' => ['XI F 2.1', 'XI F 3.1', 'XI F 4.1', 'XII F 1', 'XII F 2.2', 'XII F 3.2', 'XII F 4.2']]; // Puput Rika (7)
$plottings[] = ['mapel_id' => 5,  'guru_id' => 10, 'classes' => ['XI F 1', 'XI F 2.2', 'XI F 4.1', 'XII F 2.1', 'XII F 3.2']];         // Ervhiendri (5)
$plottings[] = ['mapel_id' => 5,  'guru_id' => 15, 'classes' => ['XI F 2.1', 'XI F 3.1', 'XI F 4.2', 'XII F 2.2', 'XII F 4.1']];        // Joko Widodo (5)
$plottings[] = ['mapel_id' => 5,  'guru_id' => 6,  'classes' => ['XI F 3.2', 'XII F 1', 'XII F 3.1', 'XII F 4.2']];                    // Djoko Heriyanto (4)
$plottings[] = ['mapel_id' => 19, 'guru_id' => 22, 'classes' => $kelasMipaNames];               // Ratna (8 MIPA)
$plottings[] = ['mapel_id' => 19, 'guru_id' => 2,  'classes' => $kelasIpsNames];                // Agung Srihartono (6 IPS)
$plottings[] = ['mapel_id' => 16, 'guru_id' => 18, 'classes' => $kelasFaseFNames];              // Murdananto (14)

// 3. MAPEL PEMINATAN MIPA
$plottings[] = ['mapel_id' => 8,  'guru_id' => 9,  'classes' => $kelasMipaXI];                  // Eri Kriswanti (4 classes x 2 blocks = 8 blocks)
$plottings[] = ['mapel_id' => 8,  'guru_id' => 20, 'classes' => $kelasMipaXII];                 // Oryza Hesak (4 classes x 2 blocks = 8 blocks)
$plottings[] = ['mapel_id' => 26, 'guru_id' => 14, 'classes' => $kelasMipaXI];                  // Is Imanah (4 classes x 2 blocks = 8 blocks)
$plottings[] = ['mapel_id' => 26, 'guru_id' => 32, 'classes' => $kelasMipaXII];                 // Umi Farichah (4 classes x 2 blocks = 8 blocks)
$plottings[] = ['mapel_id' => 23, 'guru_id' => 31, 'classes' => $kelasMipaXI];                  // Tutik Mahendra (4 classes x 2 blocks = 8 blocks)
$plottings[] = ['mapel_id' => 23, 'guru_id' => 28, 'classes' => $kelasMipaXII];                 // Syamsudin (4 classes x 2 blocks = 8 blocks)
$plottings[] = ['mapel_id' => 27, 'guru_id' => 33, 'classes' => $kelasMipaXI];                  // Widodo (4 classes x 2 blocks = 8 blocks)
$plottings[] = ['mapel_id' => 27, 'guru_id' => 12, 'classes' => $kelasMipaXII];                 // Heru Rismawan (4 classes x 2 blocks = 8 blocks)

// 4. MAPEL PEMINATAN IPS
$plottings[] = ['mapel_id' => 1,  'guru_id' => 24, 'classes' => $kelasIpsXI];                   // Sri Kundarti (3 classes x 2 blocks = 6 blocks)
$plottings[] = ['mapel_id' => 1,  'guru_id' => 1,  'classes' => $kelasIpsXII];                  // Abdul Rouf (3 classes x 2 blocks = 6 blocks)
$plottings[] = ['mapel_id' => 4,  'guru_id' => 30, 'classes' => $kelasIpsXI];                   // Tiyastuti (3 classes x 2 blocks = 6 blocks)
$plottings[] = ['mapel_id' => 4,  'guru_id' => 5,  'classes' => $kelasIpsXII];                  // Arik Andriyani (3 classes x 2 blocks = 6 blocks)
$plottings[] = ['mapel_id' => 7,  'guru_id' => 8,  'classes' => $kelasIpsNames];                 // Endang Widayanti (6 classes x 2 blocks = 12 blocks)

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

$flatPlottings = [];
foreach ($plottings as $p) {
    $m = MataPelajaran::find($p['mapel_id']);
    $g = Guru::find($p['guru_id']);
    foreach ($p['classes'] as $cName) {
        $cObj = $classes[$cName];
        $flatPlottings[] = [
            'kelas_id' => $cObj->id,
            'kelas_name' => $cName,
            'mata_pelajaran_id' => $m->id,
            'mapel_nama' => $m->nama,
            'beban_jp' => $m->beban_jp ?? 2,
            'guru_id' => $g->id,
            'guru_nama' => $g->nama,
        ];
    }
}

$exportData = [
    'classes' => [],
    'gurus' => [],
    'plottings' => $flatPlottings,
];

foreach ($classes as $cName => $cls) {
    $exportData['classes'][] = [
        'id' => $cls->id,
        'name' => $cls->name,
        'grade_level' => $cls->grade_level,
        'rumpun' => $cls->rumpun,
        'wali_kelas' => $waliKelas[$cName] ?? '-',
        'ruangan' => $ruanganKelas[$cName] ?? '-',
    ];
}

foreach (Guru::orderBy('nama')->get() as $g) {
    $exportData['gurus'][] = [
        'id' => $g->id,
        'nama' => $g->nama,
        'spesialisasi' => $g->spesialisasi,
    ];
}

file_put_contents(__DIR__ . '/data_jadwal_export.json', json_encode($exportData, JSON_PRETTY_PRINT));
echo "Successfully updated data_jadwal_export.json with " . count($flatPlottings) . " plottings.\n";
