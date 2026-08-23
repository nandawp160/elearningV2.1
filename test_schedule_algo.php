<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;

$days = [
    'Senin'  => ['slots' => 8, 'times' => ['07.45 - 08.30', '08.30 - 09.15', '09.15 - 10.00', '10.20 - 11.05', '11.05 - 11.50', '12.30 - 13.15', '13.15 - 14.00', '14.00 - 14.45']],
    'Selasa' => ['slots' => 8, 'times' => ['07.15 - 08.00', '08.00 - 08.45', '08.45 - 09.30', '09.50 - 10.35', '10.35 - 11.20', '11.20 - 12.05', '12.45 - 13.30', '13.30 - 14.15']],
    'Rabu'   => ['slots' => 8, 'times' => ['07.15 - 08.00', '08.00 - 08.45', '08.45 - 09.30', '09.50 - 10.35', '10.35 - 11.20', '11.20 - 12.05', '12.45 - 13.30', '13.30 - 14.15']],
    'Kamis'  => ['slots' => 8, 'times' => ['07.15 - 08.00', '08.00 - 08.45', '08.45 - 09.30', '09.50 - 10.35', '10.35 - 11.20', '11.20 - 12.05', '12.45 - 13.30', '13.30 - 14.15']],
    'Jumat'  => ['slots' => 5, 'times' => ['07.45 - 08.25', '08.25 - 09.05', '09.25 - 10.05', '10.05 - 10.45', '10.45 - 11.25']],
];

$allSlots = [];
$slotIdx = 0;
foreach ($days as $dayName => $dInfo) {
    for ($s = 1; $s <= $dInfo['slots']; $s++) {
        $allSlots[] = [
            'index' => $slotIdx++,
            'day' => $dayName,
            'period' => $s,
            'time' => $dInfo['times'][$s - 1],
        ];
    }
}
$totalWeeklySlots = count($allSlots);

$classes = Kelas::withoutGlobalScopes()->where('academic_year', '2026/2027')->get()->keyBy('name');

$kelasXNames = ['X 1', 'X 2', 'X 3', 'X 4', 'X 5', 'X 6', 'X 7'];
$kelasMipaXI  = ['XI F 1', 'XI F 2.1', 'XI F 2.2', 'XI F 4.1'];
$kelasMipaXII = ['XII F 1', 'XII F 2.1', 'XII F 2.2', 'XII F 4.1'];
$kelasMipaNames = array_merge($kelasMipaXI, $kelasMipaXII);

$kelasIpsXI  = ['XI F 3.1', 'XI F 3.2', 'XI F 4.2'];
$kelasIpsXII = ['XII F 3.1', 'XII F 3.2', 'XII F 4.2'];
$kelasIpsNames  = array_merge($kelasIpsXI, $kelasIpsXII);

$kelasFaseFNames = array_merge($kelasMipaNames, $kelasIpsNames);

// Build Plottings
$plottings = [];
// 1. KELAS X (FASE E - 7 KELAS)
$plottings[] = ['mapel_id' => 14, 'guru_id' => 25, 'classes' => ['X 1', 'X 3', 'X 5', 'X 7']]; // Sri Widyastuti (4)
$plottings[] = ['mapel_id' => 14, 'guru_id' => 16, 'classes' => ['X 2', 'X 4', 'X 6']];        // Khoirul Umam (3)
$plottings[] = ['mapel_id' => 6,  'guru_id' => 8,  'classes' => $kelasXNames];                  // Endang Widayanti (7)
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
$plottings[] = ['mapel_id' => 6,  'guru_id' => 7,  'classes' => ['XI F 1', 'XI F 2.1', 'XI F 2.2', 'XI F 4.1', 'XII F 1', 'XII F 2.1', 'XII F 2.2', 'XII F 4.1']]; // Endah (8 MIPA = 16 JP)
$plottings[] = ['mapel_id' => 6,  'guru_id' => 8,  'classes' => ['XI F 3.1', 'XI F 3.2', 'XI F 4.2', 'XII F 3.1', 'XII F 3.2', 'XII F 4.2']]; // Endang (6 IPS = 12 JP)
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
$plottings[] = ['mapel_id' => 19, 'guru_id' => 22, 'classes' => ['XI F 1', 'XI F 2.1', 'XI F 2.2', 'XI F 4.1', 'XII F 1', 'XII F 2.1', 'XII F 2.2', 'XII F 4.1']]; // Ratna (8 MIPA = 16 JP)
$plottings[] = ['mapel_id' => 19, 'guru_id' => 2,  'classes' => ['XI F 3.1', 'XI F 3.2', 'XI F 4.2', 'XII F 3.1', 'XII F 3.2', 'XII F 4.2']]; // Agung Srihartono (6 IPS = 12 JP)
$plottings[] = ['mapel_id' => 16, 'guru_id' => 18, 'classes' => $kelasFaseFNames];              // Murdananto (14)

// 3. MAPEL PEMINATAN MIPA
$plottings[] = ['mapel_id' => 8,  'guru_id' => 9,  'classes' => $kelasMipaXI];                  // Eri Kriswanti (4)
$plottings[] = ['mapel_id' => 8,  'guru_id' => 20, 'classes' => $kelasMipaXII];                 // Oryza Hesak (4)
$plottings[] = ['mapel_id' => 26, 'guru_id' => 14, 'classes' => $kelasMipaXI];                  // Is Imanah (4)
$plottings[] = ['mapel_id' => 26, 'guru_id' => 32, 'classes' => $kelasMipaXII];                 // Umi Farichah (4)
$plottings[] = ['mapel_id' => 23, 'guru_id' => 31, 'classes' => $kelasMipaXI];                  // Tutik Mahendra (4)
$plottings[] = ['mapel_id' => 23, 'guru_id' => 28, 'classes' => $kelasMipaXII];                 // Syamsudin (4)
$plottings[] = ['mapel_id' => 27, 'guru_id' => 33, 'classes' => $kelasMipaXI];                  // Widodo (4)
$plottings[] = ['mapel_id' => 27, 'guru_id' => 12, 'classes' => $kelasMipaXII];                 // Heru Rismawan (4)

// 4. MAPEL PEMINATAN IPS
$plottings[] = ['mapel_id' => 1,  'guru_id' => 24, 'classes' => $kelasIpsXI];                   // Sri Kundarti (3)
$plottings[] = ['mapel_id' => 1,  'guru_id' => 1,  'classes' => $kelasIpsXII];                  // Abdul Rouf (3)
$plottings[] = ['mapel_id' => 4,  'guru_id' => 30, 'classes' => $kelasIpsXI];                   // Tiyastuti (3)
$plottings[] = ['mapel_id' => 4,  'guru_id' => 5,  'classes' => $kelasIpsXII];                  // Arik Andriyani (3)
$plottings[] = ['mapel_id' => 7,  'guru_id' => 8,  'classes' => $kelasIpsNames];                 // Endang Widayanti (6)

// Build 1-JP units for exact simulated annealing scheduler
$classUnits = [];
foreach ($classes as $cName => $cls) {
    $units = [];
    foreach ($plottings as $p) {
        if (in_array($cName, $p['classes'])) {
            $m = MataPelajaran::find($p['mapel_id']);
            $g = Guru::find($p['guru_id']);
            $jp = $m->beban_jp ?? 2;
            for ($k = 0; $k < $jp; $k++) {
                $units[] = [
                    'class_id' => $cls->id,
                    'class_name' => $cName,
                    'mapel_id' => $m->id,
                    'mapel_nama' => $m->nama,
                    'guru_id' => $g->id,
                    'guru_nama' => $g->nama,
                ];
            }
        }
    }
    $classUnits[$cls->id] = $units;
}

echo "Generating Timetable with Simulated Annealing...\n";

// Initialize random schedule per class
$schedule = []; // $schedule[class_id][slot_idx] = unit or null
foreach ($classes as $cls) {
    $units = $classUnits[$cls->id];
    shuffle($units);
    $arr = array_fill(0, $totalWeeklySlots, null);
    for ($i = 0; $i < count($units); $i++) {
        $arr[$i] = $units[$i];
    }
    shuffle($arr);
    $schedule[$cls->id] = $arr;
}

// Compute Conflicts
function countTeacherConflicts($schedule, $totalWeeklySlots) {
    $conflicts = 0;
    for ($slot = 0; $slot < $totalWeeklySlots; $slot++) {
        $teachersInSlot = [];
        foreach ($schedule as $classId => $slots) {
            $unit = $slots[$slot];
            if ($unit !== null) {
                $gId = $unit['guru_id'];
                if (isset($teachersInSlot[$gId])) {
                    $conflicts++;
                } else {
                    $teachersInSlot[$gId] = true;
                }
            }
        }
    }
    return $conflicts;
}

$currentConflicts = countTeacherConflicts($schedule, $totalWeeklySlots);
echo "Initial Conflicts: {$currentConflicts}\n";

$temp = 100.0;
$coolingRate = 0.99995;
$iter = 0;

$classIds = $classes->pluck('id')->toArray();

while ($currentConflicts > 0 && $iter < 300000) {
    $iter++;
    $cId = $classIds[array_rand($classIds)];
    $slotA = rand(0, $totalWeeklySlots - 1);
    $slotB = rand(0, $totalWeeklySlots - 1);
    if ($slotA === $slotB) continue;

    // Swap slots in class
    $tempUnit = $schedule[$cId][$slotA];
    $schedule[$cId][$slotA] = $schedule[$cId][$slotB];
    $schedule[$cId][$slotB] = $tempUnit;

    $newConflicts = countTeacherConflicts($schedule, $totalWeeklySlots);

    $delta = $newConflicts - $currentConflicts;
    if ($delta < 0 || ($temp > 0.001 && exp(-$delta / $temp) > (mt_rand() / mt_getrandmax()))) {
        $currentConflicts = $newConflicts;
    } else {
        // Revert swap
        $tempUnit = $schedule[$cId][$slotA];
        $schedule[$cId][$slotA] = $schedule[$cId][$slotB];
        $schedule[$cId][$slotB] = $tempUnit;
    }

    $temp *= $coolingRate;

    if ($iter % 25000 === 0) {
        echo "Iter {$iter} | Conflicts: {$currentConflicts} | Temp: " . round($temp, 4) . "\n";
    }
}

echo "\nFinal Conflicts after {$iter} iterations: {$currentConflicts}\n";
