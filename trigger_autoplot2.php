<?php
use Illuminate\Support\Facades\DB;
use App\Models\Guru;

$tahunAjaran = '2026/2027';

try {
    DB::beginTransaction();

    DB::table('guru_kelas')
        ->whereIn('kelas_id', function ($query) use ($tahunAjaran) {
            $query->select('id')
                ->from('kelas')
                ->where('academic_year', $tahunAjaran);
        })
        ->delete();

    $teachers = Guru::active()
        ->whereNotNull('specialization_id')
        ->with('mataPelajaran')
        ->get();

    $groupedTeachers = [];
    foreach ($teachers as $t) {
        if (!$t->mataPelajaran) continue;
        $mapelName = $t->mataPelajaran->nama;
        
        $base = preg_replace('/\s*\b(X|XI|XII)\b\s*/i', '', $mapelName);
        $base = preg_replace('/\s*\b(Kelas)\b\s*/i', ' ', $base);
        $base = preg_replace('/\s*\((Wajib|Peminatan)\)\s*/i', ' ', $base);
        $base = str_ireplace(' dan ', ' ', $base);
        $base = trim($base);
        
        if (stripos($base, 'Matematika') !== false) {
            if (stripos($mapelName, 'Peminatan') !== false) {
                $base = 'Matematika Peminatan';
            } else {
                $base = 'Matematika';
            }
        }
        
        $groupedTeachers[$base][] = $t;
    }

    $totalAssignments = 0;
    $unassignedClasses = [];

    $allClassrooms = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
        ->where('academic_year', $tahunAjaran)
        ->orderByRaw("FIELD(grade_level, 'XII', 'XI', 'X')") 
        ->orderBy('name')
        ->get();

    $allSubjects = \App\Models\MataPelajaran::where('status', 'aktif')->get();

    foreach ($allSubjects as $subject) {
        $subjectName = strtolower($subject->nama);
        $grade = $subject->tingkat; 
        $bebanJp = $subject->beban_jp ?? 4;
        
        $reqBase = preg_replace('/\s*\b(X|XI|XII)\b\s*/i', '', $subject->nama);
        $reqBase = preg_replace('/\s*\b(Kelas)\b\s*/i', ' ', $reqBase);
        $reqBase = preg_replace('/\s*\((Wajib|Peminatan)\)\s*/i', ' ', $reqBase);
        $reqBase = str_ireplace(' dan ', ' ', $reqBase);
        $reqBase = trim($reqBase);
        if (stripos($reqBase, 'Matematika') !== false) {
            if (stripos($subject->nama, 'Peminatan') !== false) $reqBase = 'Matematika Peminatan';
            else $reqBase = 'Matematika';
        }

        if (!isset($groupedTeachers[$reqBase])) continue;
        $teachersList = $groupedTeachers[$reqBase];

        $targetClasses = $allClassrooms->filter(function($c) use ($grade) {
            if ($c->grade_level !== $grade) return false;
            return true;
        });

        if ($targetClasses->isEmpty()) continue;

        $teacherLoad = [];
        foreach ($teachersList as $t) {
            $awalJtm = ($t->tugas_tambahan_jtm ?? 0) + ($t->kelasPerwalian()->where('academic_year', $tahunAjaran)->count() > 0 ? 2 : 0);
            $existingPlotJtm = DB::table('guru_kelas')
                ->join('kelas', 'guru_kelas.kelas_id', '=', 'kelas.id')
                ->where('guru_kelas.guru_id', $t->id)
                ->where('kelas.academic_year', $tahunAjaran)
                ->count() * 4; 
                
            $teacherLoad[$t->id] = $awalJtm + $existingPlotJtm;
        }

        foreach ($targetClasses as $c) {
            $selectedTeacherId = null;
            
            $eligibleTeachers = collect($teachersList)->filter(function($t) use ($grade) {
                if (is_array($t->allowed_grades) && count($t->allowed_grades) > 0) {
                    return in_array($grade, $t->allowed_grades);
                }
                return true; 
            });
            
            $candidateIds = $eligibleTeachers->pluck('id')->toArray();
            $filteredLoad = collect($teacherLoad)->filter(function($jtm, $id) use ($candidateIds) {
                return in_array($id, $candidateIds);
            });

            $candidate1 = $filteredLoad->filter(fn($jtm) => ($jtm + $bebanJp) <= 24)->sort()->keys()->first();
            if ($candidate1) {
                $selectedTeacherId = $candidate1;
            } else {
                $candidate2 = $filteredLoad->filter(fn($jtm) => ($jtm + $bebanJp) <= 40)->sort()->keys()->first();
                if ($candidate2) {
                    $selectedTeacherId = $candidate2;
                }
            }

            if ($selectedTeacherId) {
                DB::table('guru_kelas')->insert([
                    'guru_id' => $selectedTeacherId,
                    'kelas_id' => $c->id,
                    'mata_pelajaran_id' => $subject->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $teacherLoad[$selectedTeacherId] += $bebanJp;
                $totalAssignments++;
            } else {
                $unassignedClasses[] = "Kelas {$c->name} ({$subject->nama})";
            }
        }
    }

    DB::commit();

    echo "AutoPlot Success: $totalAssignments assignments made.\n";
    if (count($unassignedClasses) > 0) {
        echo "Unassigned:\n";
        print_r($unassignedClasses);
    }
} catch (\Exception $e) {
    DB::rollBack();
    echo "Error: " . $e->getMessage() . "\n";
}
exit;
