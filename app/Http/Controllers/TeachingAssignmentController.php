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
        // Hanya ambil kelas yang belum lulus (biasanya berstatus aktif atau berdasar tahun ajaran terakhir)
        $classes = Kelas::orderByRaw("FIELD(grade_level, 'XII', 'XI', 'X')")->orderBy('name')->get();
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

        // Hitung total JP per Guru secara agregasi database untuk menghindari N+1 query
        $teacherJp = DB::table('guru_kelas')
            ->join('kelas', 'guru_kelas.kelas_id', '=', 'kelas.id')
            ->join('mata_pelajaran', 'guru_kelas.mata_pelajaran_id', '=', 'mata_pelajaran.id')
            ->where('kelas.academic_year', $activeYear)
            ->select('guru_kelas.guru_id')
            ->selectRaw('SUM(mata_pelajaran.beban_jp) as total_jp')
            ->groupBy('guru_kelas.guru_id')
            ->pluck('total_jp', 'guru_id')
            ->toArray();

        foreach ($teachers as $t) {
            $t->calculated_jp = $teacherJp[$t->id] ?? 0;
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

        return view('pengaturan.teaching_assignments', compact('teachers', 'classes', 'subjects', 'plottings', 'activeYear', 'availableYears', 'teacherJp'));
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
        $successCount = 0;
        $errors = [];

        try {
            DB::beginTransaction();

            foreach ($request->kelas_id as $kelasId) {
                $kelas = Kelas::find($kelasId);
                
                // Cek apakah mata pelajaran di kelas ini sudah diampu oleh guru lain (1 Mapel + 1 Kelas = 1 Guru)
                $conflict = GuruKelas::where('kelas_id', $kelasId)
                    ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
                    ->first();

                if ($conflict) {
                    if ($conflict->guru_id == $request->guru_id) {
                        // Jika sudah ada tapi guru yang sama, skip saja
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
                $errorMsg = 'Berhasil menambah ' . $successCount . ' pengampuan. Namun ada yang gagal: ' . implode(' ', $errors);
                return back()->with('error', $errorMsg);
            }

            return back()->with('success', "Berhasil menambahkan {$successCount} kelas untuk pengampuan guru.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan plotting: ' . $e->getMessage());
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
}
