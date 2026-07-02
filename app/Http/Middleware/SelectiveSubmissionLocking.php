<?php

namespace App\Http\Middleware;

use App\Models\Tugas;
use App\Models\Materi;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SelectiveSubmissionLocking
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Hanya berlaku untuk siswa
        if (!$user || !$user->isStudent()) {
            return $next($request);
        }

        try {
            $studentId  = $user->student_id;

            // Edge case: student_id null
            if (!$studentId) {
                return $next($request);
            }

            // Ambil assignment dari route model binding
            $assignment = $request->route('assignment');

            // Edge case: subject atau tingkat tidak ditemukan
            if (!$assignment || !$assignment->subject || !$assignment->subject->tingkat) {
                return $next($request);
            }

            $tingkat   = $assignment->subject->tingkat;
            $subjectId = $assignment->subject->id;

            // 0. Cek apakah ada materi prasyarat yang belum diselesaikan
            if ($assignment->prasyarat_materi_id) {
                $hasCompleted = \App\Models\PelacakanMateri::where('siswa_id', $studentId)
                    ->where('materi_id', $assignment->prasyarat_materi_id)
                    ->exists();

                if (!$hasCompleted) {
                    $prereq = Materi::find($assignment->prasyarat_materi_id);
                    $prereqTitle = $prereq ? $prereq->title : 'Materi Prasyarat';
                    return redirect()->back()
                        ->with('submission_locked', "Akses pengumpulan tugas dikunci. Anda harus menyelesaikan materi prasyarat terlebih dahulu: {$prereqTitle}")
                        ->with('prereq_not_completed', true)
                        ->with('prereq_material_id', $assignment->prasyarat_materi_id);
                }
            }

            // 1. Cari sesi pemulihan aktif untuk siswa dan mapel ini
            $recovery = \App\Models\PemulihanPengumpulan::where('siswa_id', $studentId)
                ->where('mata_pelajaran_id', $subjectId)
                ->where('status_pemulihan', 'aktif')
                ->first();

            if ($recovery) {
                // Periksa apakah sesi pemulihan sudah kadaluarsa
                if ($recovery->batas_pemulihan && $recovery->batas_pemulihan->isPast()) {
                    $recovery->update(['status_pemulihan' => 'expired']);
                    // Lanjut ke pengecekan locking normal di bawah
                } else {
                    // Jika aktif dan belum kadaluarsa:
                    // Siswa HANYA boleh submit tugas_id yang ditentukan di recovery
                    if ($assignment->id == $recovery->tugas_id) {
                        return $next($request);
                    } else {
                        return redirect()->back()
                            ->with('submission_locked', "Anda dalam Mode Pemulihan. Selesaikan tugas yang diminta terlebih dahulu.")
                            ->with('recovery_active', true)
                            ->with('current_recovery_assignment_id', $recovery->tugas_id);
                    }
                }
            }

            // 2. Hitung tunggakan (Logic Normal / Tanpa Recovery Aktif)
            // Hitung semua tunggakan untuk siswa di tingkat ini (termasuk tugas saat ini jika sudah lewat deadline)
            $totalTunggakan = Tugas::tugas()
                ->where('status', 'aktif')
                ->where('deadline', '<', Carbon::now())
                ->whereHas('subject', function ($q) use ($tingkat) {
                    $q->where('tingkat', $tingkat);
                })
                ->whereDoesntHave('submissions', function ($q) use ($studentId) {
                    $q->where('siswa_id', $studentId);
                })
                ->count();

            // 1. Jika tugas yang diakses sendiri sudah lewat deadline, kunci aksesnya (harus melalui recovery)
            if ($assignment->deadline < Carbon::now()) {
                return redirect()->back()
                    ->with('submission_locked', "Batas waktu pengumpulan tugas ini telah habis.")
                    ->with('tunggakan_count', $totalTunggakan)
                    ->with('can_appeal', true)
                    ->with('subject_id', $subjectId);
            }

            // 2. Jika total tunggakan >= 3, kunci semua tugas (termasuk tugas aktif/baru)
            if ($totalTunggakan >= 3) {
                return redirect()->back()
                    ->with('submission_locked', 
                        "Akses pengumpulan tugas dikunci karena Anda memiliki {$totalTunggakan} tunggakan tugas (batas maksimal 3)."
                    )
                    ->with('tunggakan_count', $totalTunggakan)
                    ->with('can_appeal', true)
                    ->with('subject_id', $subjectId);
            }

        } catch (\Exception $e) {
            \Log::error('SelectiveSubmissionLocking error: ' . $e->getMessage());
            return $next($request);
        }

        return $next($request);
    }
}
