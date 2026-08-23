<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\GuruKelas;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;

class TeachingAssignmentController extends Controller
{
    /**
     * Display a listing of the teaching assignments (plotting guru).
     */
    public function index()
    {
        $teachers = Guru::active()->orderBy('nama')->get();
        if (DB::connection()->getDriverName() === 'sqlite') {
            $classes = Kelas::orderByRaw("CASE grade_level WHEN 'XII' THEN 1 WHEN 'XI' THEN 2 WHEN 'X' THEN 3 ELSE 4 END")->orderBy('name')->get();
        } else {
            $classes = Kelas::orderByRaw("FIELD(grade_level, 'XII', 'XI', 'X')")->orderBy('name')->get();
        }
        $subjects = MataPelajaran::where('status', 'aktif')->orderBy('nama')->get();

        $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
        $availableYears = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->distinct()
            ->orderBy('academic_year', 'desc')
            ->pluck('academic_year')
            ->toArray();

        // Jika activeYear tidak ada di daftar, tambahkan
        if (!in_array($activeYear, $availableYears)) {
            $availableYears[] = $activeYear;
            rsort($availableYears);
        }

        // Get all plotting data (Filtered by Active Year to avoid confusion)
        $plottings = GuruKelas::with(['guru', 'kelas' => function($query) {
                $query->withoutGlobalScope('tahun_ajaran_aktif');
            }, 'subject'])
            ->whereHas('kelas', function($query) use ($activeYear) {
                $query->withoutGlobalScope('tahun_ajaran_aktif')
                      ->where('academic_year', $activeYear);
            })
            ->orderByDesc('id')
            ->get();

        // Hitung total JP riil per Guru berdasarkan jam per tingkat kelas
        $teacherJp = [];
        foreach ($plottings as $p) {
            $p->calculated_jp = self::getMapelJp($p->mata_pelajaran_id, $p->kelas->grade_level ?? 'X');
            $teacherJp[$p->guru_id] = ($teacherJp[$p->guru_id] ?? 0) + $p->calculated_jp;
        }

        // Hitung walikelas untuk tahun ajaran aktif
        $walikelasCounts = Kelas::where('academic_year', $activeYear)
            ->whereNotNull('homeroom_teacher_id')
            ->selectRaw('homeroom_teacher_id as guru_id, count(*) as count')
            ->groupBy('homeroom_teacher_id')
            ->pluck('count', 'guru_id')
            ->toArray();

        foreach ($teachers as $t) {
            $baseJp = $teacherJp[$t->id] ?? 0;
            $tugasTambahan = $t->tugas_tambahan_jtm ?? 0;
            $walikelasJp = ($walikelasCounts[$t->id] ?? 0) > 0 ? 2 : 0; // Tambahan 2 JP jika wali kelas

            $total = $baseJp + $tugasTambahan + $walikelasJp;
            $teacherJp[$t->id] = $total;
            $t->calculated_jp = $total;
        }

        $existingAssignmentsMap = [];
        foreach ($plottings as $p) {
            $key = $p->guru_id . '_' . $p->mata_pelajaran_id;
            if (!isset($existingAssignmentsMap[$key])) {
                $existingAssignmentsMap[$key] = [];
            }
            $existingAssignmentsMap[$key][] = (int) $p->kelas_id;
        }

        // Smart Kurikulum Merdeka Coverage (Menghitung Kelas Lengkap & Belum Lengkap untuk 3 Kartu Metrik Laporan)
        $mapelKelasXNames = [
            'Pendidikan Agama Islam dan Budi Pekerti',
            'Pendidikan Pancasila',
            'Bahasa Indonesia',
            'Matematika (Umum)',
            'Bahasa Inggris',
            'Pendidikan Jasmani, Olahraga, dan Kesehatan',
            'Bimbingan dan Konseling/Konselor (BP/BK)',
            'Muatan Lokal Bahasa Daerah',
            'Informatika',
            'Seni dan Budaya',
            'Sejarah',
            'Fisika',
            'Kimia',
            'Biologi',
            'Ekonomi',
            'Sosiologi',
            'Geografi',
            'Projek Penguatan Profil Pelajar Pancasila (P5)',
        ];

        $completeClassesCount = 0;
        $incompleteClassesCount = 0;
        $kelasMonitoring = [];

        foreach ($classes as $cls) {
            $clsPlots = $plottings->where('kelas_id', $cls->id);
            $assignedSubjectNames = $clsPlots->map(fn($p) => $p->subject->nama ?? '')->filter()->values()->toArray();

            $kelasXJpMap = [
                'Pendidikan Agama Islam dan Budi Pekerti' => 3,
                'Bahasa Indonesia' => 3,
                'Matematika (Umum)' => 3,
                'Bahasa Inggris' => 3,
                'Pendidikan Jasmani, Olahraga, dan Kesehatan' => 3,
                'Informatika' => 3,
                'Fisika' => 3,
                'Kimia' => 3,
                'Biologi' => 3,
                'Pendidikan Pancasila' => 2,
                'Sejarah' => 2,
                'Seni dan Budaya' => 2,
                'Ekonomi' => 2,
                'Sosiologi' => 2,
                'Geografi' => 2,
                'Bimbingan dan Konseling/Konselor (BP/BK)' => 2,
                'Muatan Lokal Bahasa Daerah' => 2,
                'Projek Penguatan Profil Pelajar Pancasila (P5)' => 2,
            ];

            if ($cls->grade_level === 'X') {
                $totalJp = $clsPlots->sum(fn($p) => $kelasXJpMap[$p->subject->nama ?? ''] ?? ($p->subject->beban_jp ?? 2));
            } else {
                $totalJp = $clsPlots->sum(fn($p) => $p->subject->beban_jp ?? 0);
            }

            if ($cls->grade_level === 'X') {
                $targetMapelNames = $mapelKelasXNames;
            } elseif ($cls->rumpun === 'MIPA') {
                $targetMapelNames = [
                    'Pendidikan Agama Islam dan Budi Pekerti', 'Pendidikan Pancasila', 'Bahasa Indonesia',
                    'Matematika (Umum)', 'Bahasa Inggris', 'Pendidikan Jasmani, Olahraga, dan Kesehatan',
                    'Sejarah', 'Bimbingan dan Konseling/Konselor (BP/BK)', 'Muatan Lokal Bahasa Daerah',
                    'Fisika', 'Kimia', 'Biologi', 'Matematika Tingkat Lanjut', 'Projek Penguatan Profil Pelajar Pancasila (P5)'
                ];
            } else { // IPS
                $targetMapelNames = [
                    'Pendidikan Agama Islam dan Budi Pekerti', 'Pendidikan Pancasila', 'Bahasa Indonesia',
                    'Matematika (Umum)', 'Bahasa Inggris', 'Pendidikan Jasmani, Olahraga, dan Kesehatan',
                    'Sejarah', 'Bimbingan dan Konseling/Konselor (BP/BK)', 'Muatan Lokal Bahasa Daerah',
                    'Ekonomi', 'Geografi', 'Sosiologi', 'Projek Penguatan Profil Pelajar Pancasila (P5)'
                ];
            }

            $missingMapels = [];
            foreach ($targetMapelNames as $reqName) {
                if (!in_array($reqName, $assignedSubjectNames)) {
                    $missingMapels[] = $reqName;
                }
            }

            $isClassComplete = !is_null($cls->is_plotting_verified) 
                ? (bool) $cls->is_plotting_verified 
                : (count($targetMapelNames) > 0 ? (count($missingMapels) === 0) : ($clsPlots->count() > 0));

            if ($isClassComplete) {
                $completeClassesCount++;
            } else {
                $incompleteClassesCount++;
            }

            $kelasMonitoring[] = [
                'kelas_id' => $cls->id,
                'kelas_name' => $cls->name,
                'grade_level' => $cls->grade_level,
                'major' => $cls->major,
                'total_mapel' => $clsPlots->count(),
                'total_jp' => $totalJp,
                'is_complete' => $isClassComplete,
                'plottings' => $clsPlots->map(fn($p) => [
                    'id' => $p->id,
                    'mapel_id' => $p->mata_pelajaran_id,
                    'mapel_nama' => $p->subject->nama ?? 'Mapel',
                    'guru_id' => $p->guru_id,
                    'guru_nama' => $p->guru->nama ?? 'Guru',
                    'beban_jp' => $p->subject->beban_jp ?? 0,
                ])->values(),
            ];
        }

        return view('pengaturan.teaching_assignments', compact('teachers', 'classes', 'subjects', 'plottings', 'activeYear', 'availableYears', 'teacherJp', 'kelasMonitoring', 'completeClassesCount', 'incompleteClassesCount', 'existingAssignmentsMap'));
    }

    /**
     * Toggle checklist status kelas lengkap mapel secara instan (AJAX)
     */
    public function toggleClassVerified(Request $request, $id)
    {
        $kelas = Kelas::withoutGlobalScope('tahun_ajaran_aktif')->findOrFail($id);
        $kelas->is_plotting_verified = !$kelas->is_plotting_verified;
        $kelas->save();

        $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
        $totalClasses = Kelas::where('academic_year', $activeYear)->count();
        $completeCount = Kelas::where('academic_year', $activeYear)->where('is_plotting_verified', 1)->count();
        $incompleteCount = max(0, $totalClasses - $completeCount);

        return response()->json([
            'success' => true,
            'is_verified' => (bool) $kelas->is_plotting_verified,
            'complete_count' => $completeCount,
            'incomplete_count' => $incompleteCount,
            'total_count' => $totalClasses,
            'message' => $kelas->is_plotting_verified 
                ? "Status kelas {$kelas->name} berhasil ditandai LENGKAP." 
                : "Status kelas {$kelas->name} ditandai BELUM LENGKAP."
        ]);
    }

    /**
     * Batch toggle checklist status seluruh kelas (Checklist All / Uncheck All)
     */
    public function toggleAllVerified(Request $request)
    {
        $status = $request->boolean('status', true);
        $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');

        Kelas::where('academic_year', $activeYear)->update([
            'is_plotting_verified' => $status ? 1 : 0
        ]);

        $totalClasses = Kelas::where('academic_year', $activeYear)->count();
        $completeCount = $status ? $totalClasses : 0;
        $incompleteCount = $status ? 0 : $totalClasses;

        return response()->json([
            'success' => true,
            'is_verified' => $status,
            'complete_count' => $completeCount,
            'incomplete_count' => $incompleteCount,
            'total_count' => $totalClasses,
            'message' => $status 
                ? "Seluruh {$totalClasses} rombel kelas berhasil ditandai LENGKAP." 
                : "Seluruh rombel kelas berhasil di-reset menjadi BELUM LENGKAP."
        ]);
    }

    /**
     * Store a newly created teaching assignment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'kelas_id' => 'required|array|min:1',
            'kelas_id.*' => 'exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
        ]);

        $guru = Guru::find($request->guru_id);
        $mapel = MataPelajaran::find($request->mata_pelajaran_id);
        $submittedClassIds = array_map('intval', $request->kelas_id);
        $isQuickAssign = $request->boolean('is_quick_assign');

        try {
            DB::beginTransaction();

            // Hapus pengampuan guru ini untuk mapel ini yang tidak ada dalam daftar yang dicentang (hanya jika dari form manual lengkap, bukan quick assign)
            if (!$isQuickAssign) {
                GuruKelas::where('guru_id', $request->guru_id)
                    ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
                    ->whereNotIn('kelas_id', $submittedClassIds)
                    ->delete();
            }

            $successCount = 0;
            $errors = [];

            foreach ($submittedClassIds as $kelasId) {
                $kelas = Kelas::withoutGlobalScope('tahun_ajaran_aktif')->find($kelasId);
                
                // Cek apakah mata pelajaran di kelas ini sudah diampu oleh guru lain (1 Mapel + 1 Kelas = 1 Guru)
                $conflict = GuruKelas::where('kelas_id', $kelasId)
                    ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
                    ->first();

                if ($conflict) {
                    if ($conflict->guru_id == $request->guru_id) {
                        // Jika sudah ada tapi guru yang sama, skip saja
                        $successCount++;
                        continue;
                    } else {
                        $guruLain = $conflict->guru->nama ?? 'Guru Lain';
                        $errors[] = "Kelas {$kelas->name}: sudah diampu oleh {$guruLain}.";
                        continue;
                    }
                }

                GuruKelas::create([
                    'guru_id' => $request->guru_id,
                    'kelas_id' => $kelasId,
                    'mata_pelajaran_id' => $request->mata_pelajaran_id,
                ]);

                ActivityLog::log('PLOTTING', "Menambahkan plotting manual: Guru {$guru->nama} mengajar {$mapel->nama} di kelas {$kelas->name}");
                $successCount++;
            }

            DB::commit();

            if (count($errors) > 0) {
                $errorMsg = 'Berhasil memperbarui pengampuan. Catatan: ' . implode(' ', $errors);
                return back()->with('error', $errorMsg);
            }

            return back()->with('success', "Berhasil memperbarui pengampuan untuk Guru {$guru->nama} pada Mata Pelajaran {$mapel->nama}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan plotting: ' . $e->getMessage());
        }
    }

    /**
     * Remove all teaching assignments for a specific teacher and subject.
     */
    public function destroyGroup($guruId, $mapelId)
    {
        try {
            DB::beginTransaction();
            $guru = Guru::findOrFail($guruId);
            $mapel = MataPelajaran::findOrFail($mapelId);

            $count = GuruKelas::where('guru_id', $guruId)
                ->where('mata_pelajaran_id', $mapelId)
                ->delete();

            ActivityLog::log('PLOTTING', "Menghapus seluruh plotting ({$count} kelas) untuk Guru {$guru->nama} pada mapel {$mapel->nama}");

            DB::commit();
            return back()->with('success', "Berhasil menghapus seluruh pengampuan ({$count} kelas) mapel {$mapel->nama} untuk Guru {$guru->nama}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus plotting mapel: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified teaching assignment from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $plot = GuruKelas::findOrFail($id);
            $guruNama = $plot->guru->nama ?? 'Unknown';
            $kelasNama = $plot->kelas->name ?? 'Unknown';
            
            $plot->delete();

            ActivityLog::log('PLOTTING', "Menghapus plotting mengajar untuk Guru {$guruNama} di kelas {$kelasNama}");

            DB::commit();
            return back()->with('success', 'Plotting mengajar berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus plotting: ' . $e->getMessage());
        }
    }

    /**
     * Hitung alokasi JP per mapel dan per jenjang kelas secara akurat (Kurikulum Merdeka).
     */
    public static function getMapelJp($mapelId, $gradeLevel)
    {
        if ($gradeLevel === 'X') {
            // Kelas X (Fase E):
            // 9 Mapel @ 3 JP: PAI (14), B. Indo (9), MTK (21), B. Ing (3), PJOK (5), Informatika (11), Fisika (8), Kimia (26), Biologi (23)
            if (in_array((int)$mapelId, [14, 9, 21, 3, 5, 11, 8, 26, 23])) {
                return 3;
            }
            // 9 Mapel @ 2 JP: Pancasila (6), Sejarah (19), Seni (2), Ekonomi (1), Sosiologi (7), Geografi (4), BK (16), Mulok (31), P5 (32)
            return 2;
        } else {
            // Fase F (Kelas XI & XII):
            // Peminatan @ 5 JP: Fisika (8), Kimia (26), Biologi (23), MTK Lanjut (27), Ekonomi (1), Geografi (4), Sosiologi (7), B. Indo Lanjut (29), B. Ing Lanjut (30)
            if (in_array((int)$mapelId, [8, 26, 23, 27, 1, 4, 7, 29, 30])) {
                return 5;
            }
            // Mapel Umum @ 3 JP: PAI (14), B. Indo (9), MTK Umum (21), B. Ing (3), PJOK (5)
            if (in_array((int)$mapelId, [14, 9, 21, 3, 5])) {
                return 3;
            }
            // Mapel Umum @ 2 JP: Pancasila (6), Sejarah (19), BK (16), Mulok (31), P5 (32)
            return 2;
        }
    }
}
