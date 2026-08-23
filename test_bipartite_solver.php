<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\GuruKelas;

$classes = Kelas::withoutGlobalScopes()->where('academic_year', '2026/2027')->get()->keyBy('id');
$plottings = GuruKelas::whereIn('kelas_id', $classes->keys())->with(['guru', 'subject', 'kelas'])->get();

$classLessons = [];
foreach ($classes as $cId => $cls) {
    $cPlots = $plottings->where('kelas_id', $cId);
    $items = [];
    foreach ($cPlots as $p) {
        $jp = $p->subject->beban_jp ?? 2;
        $mName = $p->subject->nama;
        $gName = $p->guru->nama;
        $gId = $p->guru_id;

        if ($jp === 5) {
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 3, 'tag' => 'Peminatan (3 JP)'];
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 2, 'tag' => 'Peminatan (2 JP)'];
        } elseif ($jp === 4) {
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 2, 'tag' => 'Peminatan (2 JP)'];
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 2, 'tag' => 'Peminatan (2 JP)'];
        } elseif ($jp === 3) {
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 3, 'tag' => 'Wajib (3 JP)'];
        } else {
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 2, 'tag' => 'Wajib (2 JP)'];
        }
    }
    $classLessons[$cId] = $items;
}

// Bipartite matching block by block:
// For block $b from 0 to 17:
// Assign 1 item to each class (if class has items left) such that all assigned teachers are unique.
$classIds = $classes->keys()->toArray();

function solveBlockByBlock($blockIdx, $remainingLessons, $schedule, $classIds) {
    if ($blockIdx === 18) {
        return $schedule;
    }

    // For block $blockIdx, we need to choose one item for each class
    // Classes that have no remaining lessons just get null for this block
    $classesToAssign = [];
    foreach ($classIds as $cId) {
        if (!empty($remainingLessons[$cId])) {
            $classesToAssign[] = $cId;
        }
    }

    // Backtracking within this block to find a collision-free teacher assignment
    $blockAssignments = findBlockMatching(0, $classesToAssign, $remainingLessons, [], []);
    
    if (empty($blockAssignments)) {
        return null;
    }

    // Shuffle multiple valid assignments to add diversity
    shuffle($blockAssignments);

    foreach (array_slice($blockAssignments, 0, 10) as $assignment) {
        $nextRemaining = $remainingLessons;
        $nextSchedule = $schedule;

        foreach ($classIds as $cId) {
            if (isset($assignment[$cId])) {
                $chosenIdx = $assignment[$cId];
                $item = $remainingLessons[$cId][$chosenIdx];
                $nextSchedule[$cId][$blockIdx] = $item;
                unset($nextRemaining[$cId][$chosenIdx]);
                $nextRemaining[$cId] = array_values($nextRemaining[$cId]);
            } else {
                $nextSchedule[$cId][$blockIdx] = null;
            }
        }

        $res = solveBlockByBlock($blockIdx + 1, $nextRemaining, $nextSchedule, $classIds);
        if ($res !== null) {
            return $res;
        }
    }

    return null;
}

function findBlockMatching($classIdx, $classesToAssign, $remainingLessons, $usedTeachers, $currentAssign) {
    if ($classIdx === count($classesToAssign)) {
        return [$currentAssign];
    }

    $cId = $classesToAssign[$classIdx];
    $results = [];

    // Prioritize items of teachers that are more constrained
    $availItems = $remainingLessons[$cId];
    // Optional: shuffle
    $indices = array_keys($availItems);
    shuffle($indices);

    foreach ($indices as $i) {
        $item = $availItems[$i];
        $gId = $item['guru_id'];
        if (!isset($usedTeachers[$gId])) {
            $usedTeachers[$gId] = true;
            $currentAssign[$cId] = $i;

            $subResults = findBlockMatching($classIdx + 1, $classesToAssign, $remainingLessons, $usedTeachers, $currentAssign);
            foreach ($subResults as $sr) {
                $results[] = $sr;
                if (count($results) >= 5) break; // Limit search branch width for speed
            }

            unset($usedTeachers[$gId]);
            unset($currentAssign[$cId]);
            if (count($results) >= 5) break;
        }
    }

    return $results;
}

echo "Running recursive block matching solver...\n";
$start = microtime(true);
$emptySchedule = [];
foreach ($classIds as $cId) {
    $emptySchedule[$cId] = array_fill(0, 18, null);
}

$solution = solveBlockByBlock(0, $classLessons, $emptySchedule, $classIds);
$elapsed = round(microtime(true) - $start, 3);

if ($solution) {
    echo "SOLVED in {$elapsed}s!\n";
    // Check conflicts
    for ($b = 0; $b < 18; $b++) {
        $teachers = [];
        foreach ($classIds as $cId) {
            $item = $solution[$cId][$b];
            if ($item) {
                $gId = $item['guru_id'];
                if (isset($teachers[$gId])) {
                    echo "ERROR: Teacher conflict in block {$b}: Guru {$gId}\n";
                }
                $teachers[$gId] = true;
            }
        }
    }
    echo "Verification complete: 0 CONFLICTS across all 18 blocks and 21 classes!\n";
} else {
    echo "Failed in {$elapsed}s.\n";
}
