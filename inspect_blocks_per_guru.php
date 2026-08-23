<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;

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
$plottings[] = ['mapel_id' => 14, 'guru_id' => 25, 'classes' => ['X 1', 'X 3', 'X 5', 'X 7']]; // Sri Widyastuti (4 edges)
$plottings[] = ['mapel_id' => 14, 'guru_id' => 16, 'classes' => ['X 2', 'X 4', 'X 6']];        // Khoirul Umam (3 edges)
$plottings[] = ['mapel_id' => 6,  'guru_id' => 8,  'classes' => ['X 1', 'X 2', 'X 3', 'X 4']];  // Endang (4 edges)
$plottings[] = ['mapel_id' => 6,  'guru_id' => 7,  'classes' => ['X 5', 'X 6', 'X 7']];        // Endah (3 edges)
$plottings[] = ['mapel_id' => 9,  'guru_id' => 11, 'classes' => ['X 1', 'X 4', 'X 7']];        // Heni Setyarini (3 edges)
$plottings[] = ['mapel_id' => 9,  'guru_id' => 27, 'classes' => ['X 2', 'X 5']];               // Susilawati (2 edges)
$plottings[] = ['mapel_id' => 9,  'guru_id' => 29, 'classes' => ['X 3', 'X 6']];               // Teguh (2 edges)
$plottings[] = ['mapel_id' => 21, 'guru_id' => 26, 'classes' => ['X 1', 'X 4', 'X 7']];        // Sunarno (3 edges)
$plottings[] = ['mapel_id' => 21, 'guru_id' => 19, 'classes' => ['X 2', 'X 5']];               // Murtini Ningsih (2 edges)
$plottings[] = ['mapel_id' => 21, 'guru_id' => 12, 'classes' => ['X 3', 'X 6']];               // Heru Rismawan (2 edges)
$plottings[] = ['mapel_id' => 3,  'guru_id' => 3,  'classes' => ['X 1', 'X 3', 'X 5', 'X 7']]; // Ardjanto (4 edges)
$plottings[] = ['mapel_id' => 3,  'guru_id' => 17, 'classes' => ['X 2', 'X 4', 'X 6']];        // Lanjar Setyowati (3 edges)
$plottings[] = ['mapel_id' => 5,  'guru_id' => 10, 'classes' => ['X 1', 'X 4', 'X 7']];        // Ervhiendri (3 edges)
$plottings[] = ['mapel_id' => 5,  'guru_id' => 15, 'classes' => ['X 2', 'X 5']];               // Joko Widodo (2 edges)
$plottings[] = ['mapel_id' => 5,  'guru_id' => 6,  'classes' => ['X 3', 'X 6']];               // Djoko Heriyanto (2 edges)
$plottings[] = ['mapel_id' => 16, 'guru_id' => 13, 'classes' => $kelasXNames];                  // Iis Lestari (7 edges)
$plottings[] = ['mapel_id' => 31, 'guru_id' => 21, 'classes' => $kelasXNames];                  // Puput Rika (7 edges)

// 2. KELAS XI & XII (FASE F - 14 KELAS)
$plottings[] = ['mapel_id' => 14, 'guru_id' => 25, 'classes' => ['XI F 1', 'XI F 2.2', 'XI F 3.2', 'XI F 4.2', 'XII F 2.1', 'XII F 3.1', 'XII F 4.1']]; // Sri Widyastuti (7)
$plottings[] = ['mapel_id' => 14, 'guru_id' => 16, 'classes' => ['XI F 2.1', 'XI F 3.1', 'XI F 4.1', 'XII F 1', 'XII F 2.2', 'XII F 3.2', 'XII F 4.2']]; // Khoirul Umam (7)
$plottings[] = ['mapel_id' => 6,  'guru_id' => 7,  'classes' => $kelasFaseFNames];              // Endah (14 edges)
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

// Check total blocks per teacher
$teacherBlocks = [];
$classBlocks = [];
foreach ($plottings as $plotGroup) {
    $m = MataPelajaran::find($plotGroup['mapel_id']);
    $gId = $plotGroup['guru_id'];
    $jp = $m->beban_jp ?? 2;
    $numBlocks = ($jp >= 4 ? 2 : 1);
    foreach ($plotGroup['classes'] as $cName) {
        $cObj = $classes[$cName];
        $teacherBlocks[$gId] = ($teacherBlocks[$gId] ?? 0) + $numBlocks;
        $classBlocks[$cObj->id] = ($classBlocks[$cObj->id] ?? 0) + $numBlocks;
    }
}

echo "=== GURU TOTAL BLOCKS (MUST BE <= 18) ===\n";
foreach ($teacherBlocks as $gId => $blocks) {
    $g = Guru::find($gId);
    echo "- {$g->nama}: {$blocks} blocks\n";
}

echo "\nMax Teacher Blocks: " . max($teacherBlocks) . "\n";
echo "Max Class Blocks: " . max($classBlocks) . "\n";
