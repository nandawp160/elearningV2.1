<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTeacherSslThresholdRequest;
use App\Models\ActivityLog;
use App\Models\GuruKelas;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherSslSettingsController extends Controller
{
    public function update(
        UpdateTeacherSslThresholdRequest $request,
        JadwalPelajaran $subject,
        Kelas $kelas
    ) {
        $user = auth()->user();
        if (!$user || (!$user->isTeacher() && !$user->isSuperAdmin())) {
            abort(403, 'Akses hanya untuk guru pengampu.');
        }

        $guru = $user->guru;
        if (!$guru && !$user->isSuperAdmin()) {
            abort(403, 'Data profil guru tidak ditemukan.');
        }

        $guruId = $guru ? $guru->id : null;

        return DB::transaction(function () use ($request, $subject, $kelas, $user, $guruId) {
            // Find current guru_kelas record
            $currentQuery = GuruKelas::where('kelas_id', $kelas->id)
                ->where('mata_pelajaran_id', $subject->id);

            if ($guruId) {
                $currentQuery->where('guru_id', $guruId);
            }

            $currentGuruKelas = $currentQuery->lockForUpdate()->first();

            if (!$currentGuruKelas) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan pada mata pelajaran dan kelas ini.');
            }

            $mode = $request->input('mode');
            $applyAll = filter_var($request->input('apply_all_classes'), FILTER_VALIDATE_BOOLEAN);

            // Normalize value: if mode is default, threshold is NULL
            $newThreshold = ($mode === 'custom') ? (int) $request->input('ssl_threshold') : null;

            if ($applyAll) {
                // Update all active classes currently taught by this teacher for this subject
                $allQuery = GuruKelas::where('mata_pelajaran_id', $subject->id)->whereHas('kelas');
                if ($guruId) {
                    $allQuery->where('guru_id', $guruId);
                }
                $targetRecords = $allQuery->lockForUpdate()->get();
            } else {
                $targetRecords = collect([$currentGuruKelas]);
            }

            $affectedClassIds = [];
            $oldValues = [];

            foreach ($targetRecords as $rec) {
                $affectedClassIds[] = $rec->kelas_id;
                $oldValues[$rec->kelas_id] = $rec->ssl_threshold;
                $rec->ssl_threshold = $newThreshold;
                $rec->save();
            }

            // Resolve effective threshold for response
            $schoolDefaultRaw = Pengaturan::getValue('ssl_threshold')
                ?? DB::table('settings')->where('key', 'ssl_threshold')->value('value');
            $hasSchoolDefault = ($schoolDefaultRaw !== null && is_numeric($schoolDefaultRaw) && (int)$schoolDefaultRaw > 0);
            $schoolDefault = $hasSchoolDefault
                ? (int) $schoolDefaultRaw
                : (int) config('ssl.system_default', 3);

            $effectiveThreshold = ($newThreshold !== null) ? $newThreshold : $schoolDefault;
            $source = ($newThreshold !== null) 
                ? 'TEACHER_OVERRIDE' 
                : ($hasSchoolDefault ? 'SCHOOL_DEFAULT' : 'SYSTEM_FALLBACK');

            // Record audit log
            $subjectName = $subject->course->name ?? $subject->nama ?? 'Mata Pelajaran';
            $scopeDesc = $applyAll ? 'ALL_CURRENT_CLASSES' : 'CURRENT_CLASS';
            
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'SSL_THRESHOLD_UPDATED',
                'description' => "Pengaturan ambang batas SSL diperbarui untuk Mapel {$subjectName} (" .
                    ($applyAll ? count($affectedClassIds) . " Kelas" : "Kelas {$kelas->name}") .
                    "): Scope={$scopeDesc}, Mode={$mode}, Nilai=" . ($newThreshold ?? 'Default (' . $schoolDefault . ')'),
            ]);

            $message = $applyAll
                ? "Batas tunggakan SSL berhasil diperbarui untuk seluruh " . count($affectedClassIds) . " kelas yang diampu pada mata pelajaran ini."
                : "Batas tunggakan SSL berhasil diperbarui untuk kelas {$kelas->name}.";

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'mode' => $mode,
                    'effective_threshold' => $effectiveThreshold,
                    'source' => $source,
                    'affected_class_ids' => $affectedClassIds,
                ]);
            }

            return redirect()->back()->with('success', $message);
        });
    }
}
