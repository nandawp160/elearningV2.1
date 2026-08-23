<?php

namespace App\Services;

use App\DTO\AdaptiveAccessResult;
use App\DTO\SubmissionDecision;
use App\DTOs\SslThresholdResolution;
use App\Enums\AdaptiveAccessStatus;
use App\Models\Banding;
use App\Models\GuruKelas;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\PelacakanMateri;
use App\Models\PemulihanPengumpulan;
use App\Models\Pengaturan;
use App\Models\Pengumpulan;
use App\Models\Siswa;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AdaptiveAccessService
{
    /**
     * Centralized threshold resolution hierarchy:
     * 1. TEACHER_OVERRIDE (guru_kelas.ssl_threshold)
     * 2. SCHOOL_DEFAULT (Pengaturan::getValue('ssl_threshold'))
     * 3. SYSTEM_FALLBACK (config('ssl.system_default', 3))
     */
    public function resolveThreshold(Siswa $student, int $subjectId): SslThresholdResolution
    {
        $minAllowed = (int) config('ssl.teacher_min', 1);
        $maxAllowed = (int) (Pengaturan::getValue('ssl_teacher_threshold_max') ?? config('ssl.teacher_max', 10));
        if ($maxAllowed < $minAllowed) {
            $maxAllowed = (int) config('ssl.teacher_max', 10);
        }

        $studentKelas = $student->kelas ?? $student->resolved_kelas;
        $kelasObj = $studentKelas ? Kelas::where('name', $studentKelas)->first() : null;
        $kelasId = $kelasObj?->id;

        $guruKelas = null;
        if ($kelasId) {
            $guruKelas = GuruKelas::where('kelas_id', $kelasId)
                ->where('mata_pelajaran_id', $subjectId)
                ->first();
        }

        $teacherOverride = null;
        if ($guruKelas && $guruKelas->ssl_threshold !== null) {
            $val = (int) $guruKelas->ssl_threshold;
            if ($val >= $minAllowed && $val <= $maxAllowed) {
                $teacherOverride = $val;
            }
        }

        $schoolDefaultRaw = Pengaturan::getValue('ssl_threshold')
            ?? DB::table('settings')->where('key', 'ssl_threshold')->value('value');
        $schoolDefault = ($schoolDefaultRaw !== null && is_numeric($schoolDefaultRaw)) ? (int) $schoolDefaultRaw : null;

        $systemFallback = (int) config('ssl.system_default', 3);

        if ($teacherOverride !== null) {
            $effective = $teacherOverride;
            $source = 'TEACHER_OVERRIDE';
        } elseif ($schoolDefault !== null && $schoolDefault > 0) {
            $effective = $schoolDefault;
            $source = 'SCHOOL_DEFAULT';
        } else {
            $effective = $systemFallback;
            $source = 'SYSTEM_FALLBACK';
        }

        return new SslThresholdResolution(
            effectiveThreshold: $effective,
            source: $source,
            teacherOverride: $teacherOverride,
            schoolDefault: $schoolDefault,
            minimumAllowed: $minAllowed,
            maximumAllowed: $maxAllowed,
            guruKelasId: $guruKelas?->id
        );
    }

    /**
     * Unified central query for overdue assignments of a student in a specific subject.
     * Applies all 6 mandatory filters:
     * 1. Student not yet submitted
     * 2. Specific subject ID
     * 3. Student's active class & assigned teachers for global tasks
     * 4. Assignment status is active
     * 5. Deadline has passed
     * 6. Accurate subject isolation
     */
    public function getOverdueTasksQuery(Siswa $student, int $subjectId): Builder
    {
        $studentKelas = $student->kelas ?? $student->resolved_kelas;
        $kelasObj = $studentKelas ? Kelas::where('name', $studentKelas)->first() : null;
        $kelasId = $kelasObj?->id;

        // Get assigned teacher IDs for this student's class and subject
        $assignedTeacherIds = $kelasId
            ? GuruKelas::where('kelas_id', $kelasId)->where('mata_pelajaran_id', $subjectId)->pluck('guru_id')->toArray()
            : [];

        return Tugas::tugas()
            ->where('mata_pelajaran_id', $subjectId)
            ->where('status', 'aktif')
            ->whereNotNull('deadline')
            ->where('deadline', '<', Carbon::now())
            ->where(function ($q) use ($kelasId, $assignedTeacherIds) {
                if ($kelasId) {
                    $q->where('kelas_id', $kelasId)
                      ->orWhere(function ($subQ) use ($assignedTeacherIds) {
                          $subQ->whereNull('kelas_id');
                          if (!empty($assignedTeacherIds)) {
                              $subQ->whereIn('guru_id', $assignedTeacherIds);
                          }
                      });
                } else {
                    $q->whereNull('kelas_id');
                }
            })
            ->whereDoesntHave('submissions', function ($q) use ($student) {
                $q->where('siswa_id', $student->id)
                  ->where(function ($subQ) {
                      $subQ->whereIn('status', ['submitted', 'terkumpul', 'graded'])
                           ->orWhereHas('grade');
                  })
                  ->whereNotIn('status', ['needs_revision', 'revisi']);
            });
    }

    /**
     * Evaluates the student's adaptive access status for a given subject.
     */
    public function evaluateSubjectAccess(Siswa $student, JadwalPelajaran $subject): AdaptiveAccessResult
    {
        // 1. Check Active Recovery Session
        $recovery = PemulihanPengumpulan::where('siswa_id', $student->id)
            ->where('mata_pelajaran_id', $subject->id)
            ->where('status_pemulihan', 'aktif')
            ->first();

        if ($recovery && $recovery->batas_pemulihan && $recovery->batas_pemulihan->isPast()) {
            $recovery->update(['status_pemulihan' => 'expired']);
            $recovery = null;
        }

        // 2. Check Pending Appeals
        $pendingAppeal = Banding::where('siswa_id', $student->id)
            ->where('mata_pelajaran_id', $subject->id)
            ->whereIn('status', ['pending', 'ditinjau'])
            ->first();

        $appealStatus = $pendingAppeal ? 'PENDING' : null;

        // 3. Count Overdue Tasks using the unified query
        $overdueCount = $this->getOverdueTasksQuery($student, $subject->id)->count();

        // 4. Resolve Dynamic Threshold
        $resolution = $this->resolveThreshold($student, $subject->id);
        $threshold = $resolution->effectiveThreshold;

        // 5. Determine 4-State Status
        if ($recovery) {
            return new AdaptiveAccessResult(
                status: AdaptiveAccessStatus::RECOVERY,
                jumlahTunggakan: $overdueCount,
                threshold: $threshold,
                targetTugasId: $recovery->tugas_id,
                recoveryExpiresAt: $recovery->batas_pemulihan,
                appealStatus: $appealStatus,
                reasonCode: 'RECOVERY_ACTIVE',
                nextAction: 'Selesaikan tugas target yang sedang dibuka pada masa pemulihan.',
                canAppeal: false,
                thresholdSource: $resolution->source,
                teacherThreshold: $resolution->teacherOverride
            );
        }

        if ($overdueCount >= $threshold) {
            return new AdaptiveAccessResult(
                status: AdaptiveAccessStatus::LOCKED,
                jumlahTunggakan: $overdueCount,
                threshold: $threshold,
                targetTugasId: null,
                recoveryExpiresAt: null,
                appealStatus: $appealStatus,
                reasonCode: 'THRESHOLD_REACHED',
                nextAction: $appealStatus === 'PENDING' ? 'Menunggu tanggapan permohonan banding' : 'Ajukan banding untuk membuka pemulihan akses tugas',
                canAppeal: ($appealStatus === null),
                thresholdSource: $resolution->source,
                teacherThreshold: $resolution->teacherOverride
            );
        }

        if ($overdueCount > 0) {
            return new AdaptiveAccessResult(
                status: AdaptiveAccessStatus::WARNING,
                jumlahTunggakan: $overdueCount,
                threshold: $threshold,
                targetTugasId: null,
                recoveryExpiresAt: null,
                appealStatus: $appealStatus,
                reasonCode: 'OVERDUE_BELOW_THRESHOLD',
                nextAction: 'Selesaikan tugas tertunggak sebelum mencapai batas penguncian.',
                canAppeal: false,
                thresholdSource: $resolution->source,
                teacherThreshold: $resolution->teacherOverride
            );
        }

        return new AdaptiveAccessResult(
            status: AdaptiveAccessStatus::NORMAL,
            jumlahTunggakan: 0,
            threshold: $threshold,
            targetTugasId: null,
            recoveryExpiresAt: null,
            appealStatus: $appealStatus,
            reasonCode: 'NO_OVERDUE',
            nextAction: 'Semua tugas pada mata pelajaran ini telah dikumpulkan tepat waktu.',
            canAppeal: false,
            thresholdSource: $resolution->source,
            teacherThreshold: $resolution->teacherOverride
        );
    }

    /**
     * Evaluates whether a student is allowed to submit a specific task.
     */
    public function evaluateTaskSubmission(Siswa $student, Tugas $task): SubmissionDecision
    {
        $subject = $task->subject;
        $subjectId = $subject?->id ?? $task->mata_pelajaran_id;

        // 1. Separate Prerequisite Check
        if ($task->prasyarat_materi_id) {
            $hasCompletedPrereq = PelacakanMateri::where('siswa_id', $student->id)
                ->where('materi_id', $task->prasyarat_materi_id)
                ->exists();

            if (!$hasCompletedPrereq) {
                $prereq = Materi::find($task->prasyarat_materi_id);
                $prereqTitle = $prereq ? $prereq->title : 'Materi Prasyarat';
                return new SubmissionDecision(
                    allowed: false,
                    sslStatus: AdaptiveAccessStatus::NORMAL,
                    prerequisiteMet: false,
                    reasonCode: 'PREREQUISITE_INCOMPLETE',
                    message: "Akses pengumpulan tugas dikunci. Anda harus menyelesaikan materi prasyarat terlebih dahulu: {$prereqTitle}",
                    targetTugasId: null,
                    prerequisiteMaterialId: $task->prasyarat_materi_id,
                    prerequisiteTitle: $prereqTitle,
                    canAppeal: false,
                    subjectId: $subjectId,
                    tunggakanCount: 0
                );
            }
        }

        if (!$subject) {
            return new SubmissionDecision(
                allowed: true,
                sslStatus: AdaptiveAccessStatus::NORMAL,
                prerequisiteMet: true,
                reasonCode: 'NO_SUBJECT',
                message: 'Mata pelajaran tidak ditemukan, pengumpulan diizinkan.',
                subjectId: $subjectId
            );
        }

        // 2. Evaluate Adaptive Status on Subject Level
        $subjectResult = $this->evaluateSubjectAccess($student, $subject);

        // 3. Check if student has a submission on this task that needs revision
        $existingSub = Pengumpulan::where('tugas_id', $task->id)
            ->where('siswa_id', $student->id)
            ->first();

        if ($existingSub && $existingSub->is_needs_revision) {
            if ($subjectResult->isRecovery() && $task->id != $subjectResult->targetTugasId) {
                return new SubmissionDecision(
                    allowed: false,
                    sslStatus: AdaptiveAccessStatus::RECOVERY,
                    prerequisiteMet: true,
                    reasonCode: 'RECOVERY_WRONG_TASK',
                    message: 'Anda dalam Mode Pemulihan. Selesaikan tugas target yang diminta terlebih dahulu.',
                    targetTugasId: $subjectResult->targetTugasId,
                    canAppeal: false,
                    subjectId: $subjectId,
                    tunggakanCount: $subjectResult->jumlahTunggakan
                );
            }

            return new SubmissionDecision(
                allowed: true,
                sslStatus: $subjectResult->status,
                prerequisiteMet: true,
                reasonCode: 'REVISION_ALLOWED',
                message: 'Tugas ini dikembalikan oleh guru untuk direvisi. Silakan unggah perbaikan jawaban.',
                targetTugasId: $subjectResult->targetTugasId,
                canAppeal: false,
                subjectId: $subjectId,
                tunggakanCount: $subjectResult->jumlahTunggakan
            );
        }

        // 4. Make Specific Task Decision
        if ($subjectResult->isRecovery()) {
            if ($task->id == $subjectResult->targetTugasId) {
                return new SubmissionDecision(
                    allowed: true,
                    sslStatus: AdaptiveAccessStatus::RECOVERY,
                    prerequisiteMet: true,
                    reasonCode: 'RECOVERY_TARGET_ALLOWED',
                    message: 'Pengumpulan diizinkan untuk tugas target pemulihan.',
                    targetTugasId: $subjectResult->targetTugasId,
                    canAppeal: false,
                    subjectId: $subjectId,
                    tunggakanCount: $subjectResult->jumlahTunggakan
                );
            }

            return new SubmissionDecision(
                allowed: false,
                sslStatus: AdaptiveAccessStatus::RECOVERY,
                prerequisiteMet: true,
                reasonCode: 'RECOVERY_WRONG_TASK',
                message: 'Anda dalam Mode Pemulihan. Selesaikan tugas target yang diminta terlebih dahulu.',
                targetTugasId: $subjectResult->targetTugasId,
                canAppeal: false,
                subjectId: $subjectId,
                tunggakanCount: $subjectResult->jumlahTunggakan
            );
        }

        if ($subjectResult->isLocked()) {
            $returnedCount = Tugas::where('mata_pelajaran_id', $subjectId)
                ->whereHas('submissions', function ($q) use ($student) {
                    $q->where('siswa_id', $student->id)
                      ->whereIn('status', ['needs_revision', 'revisi']);
                })
                ->count();

            $reasonCode = $returnedCount > 0 ? 'LOCKED_BY_RETURNED_TASKS' : 'LOCKED_BY_SSL';
            $message = $returnedCount > 0
                ? "Akses tugas baru dikunci karena Anda memiliki {$returnedCount} tugas yang di-return oleh guru dan belum diperbaiki (total tunggakan: {$subjectResult->jumlahTunggakan}, batas toleransi: {$subjectResult->threshold})."
                : "Akses pengumpulan tugas dikunci karena Anda memiliki {$subjectResult->jumlahTunggakan} tunggakan tugas pada mata pelajaran ini (batas maksimal {$subjectResult->threshold} tunggakan).";

            return new SubmissionDecision(
                allowed: false,
                sslStatus: AdaptiveAccessStatus::LOCKED,
                prerequisiteMet: true,
                reasonCode: $reasonCode,
                message: $message,
                targetTugasId: null,
                canAppeal: $subjectResult->canAppeal,
                subjectId: $subjectId,
                tunggakanCount: $subjectResult->jumlahTunggakan,
                returnedCount: $returnedCount
            );
        }

        if ($subjectResult->isWarning()) {
            return new SubmissionDecision(
                allowed: true,
                sslStatus: AdaptiveAccessStatus::WARNING,
                prerequisiteMet: true,
                reasonCode: 'ALLOWED_WARNING',
                message: "Peringatan: Anda memiliki {$subjectResult->jumlahTunggakan} tunggakan tugas pada mata pelajaran ini.",
                targetTugasId: null,
                canAppeal: false,
                subjectId: $subjectId,
                tunggakanCount: $subjectResult->jumlahTunggakan
            );
        }

        return new SubmissionDecision(
            allowed: true,
            sslStatus: AdaptiveAccessStatus::NORMAL,
            prerequisiteMet: true,
            reasonCode: 'ALLOWED',
            message: 'Pengumpulan tugas diizinkan.',
            targetTugasId: null,
            canAppeal: false,
            subjectId: $subjectId,
            tunggakanCount: 0
        );
    }

    /**
     * Advances the recovery session sequentially to the next overdue task upon successful submission.
     * Executes within the same session window without resetting the duration timer.
     */
    public function advanceRecoveryAfterSubmission(Siswa $student, Tugas $submittedTask): void
    {
        $recovery = PemulihanPengumpulan::where('siswa_id', $student->id)
            ->where('mata_pelajaran_id', $submittedTask->mata_pelajaran_id)
            ->where('status_pemulihan', 'aktif')
            ->first();

        if (!$recovery || $recovery->tugas_id != $submittedTask->id) {
            return;
        }

        // Find next oldest overdue task in this subject that still needs recovery submission
        $nextOverdue = Tugas::tugas()
            ->where('mata_pelajaran_id', $submittedTask->mata_pelajaran_id)
            ->where('status', 'aktif')
            ->whereNotNull('deadline')
            ->where('deadline', '<', Carbon::now())
            ->whereDoesntHave('submissions', function ($q) use ($student) {
                $q->where('siswa_id', $student->id)
                  ->whereNotIn('status', ['needs_revision', 'revisi']);
            })
            ->orderBy('deadline', 'asc')
            ->first();

        if ($nextOverdue) {
            // Update to next overdue task within the same session window
            $recovery->update([
                'tugas_id' => $nextOverdue->id,
            ]);
        } else {
            // All overdue tasks completed!
            $recovery->update([
                'status_pemulihan' => 'selesai',
                'selesai_pemulihan' => Carbon::now(),
            ]);
        }
    }
}
