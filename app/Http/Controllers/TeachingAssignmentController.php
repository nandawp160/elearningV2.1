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

        return view('pengaturan.teaching_assignments', compact('teachers', 'classes', 'subjects', 'plottings', 'activeYear', 'availableYears'));
    }

    /**
     * Store a newly created teaching assignment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
        ]);

        // Cek apakah plotting sudah ada untuk menghindari duplikat
        $exists = GuruKelas::where('guru_id', $request->guru_id)
            ->where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Plotting mengajar tersebut sudah ada di sistem.');
        }

        try {
            DB::beginTransaction();

            $plot = GuruKelas::create([
                'guru_id' => $request->guru_id,
                'kelas_id' => $request->kelas_id,
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
            ]);

            $guru = Guru::find($request->guru_id);
            $kelas = Kelas::find($request->kelas_id);
            $mapel = MataPelajaran::find($request->mata_pelajaran_id);

            ActivityLog::log('PLOTTING', "Menambahkan plotting manual: Guru {$guru->nama} mengajar {$mapel->nama} di kelas {$kelas->name}");

            DB::commit();
            return back()->with('success', 'Plotting guru berhasil ditambahkan.');
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
