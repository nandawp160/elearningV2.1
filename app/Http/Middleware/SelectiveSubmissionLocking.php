<?php

namespace App\Http\Middleware;

use App\Services\AdaptiveAccessService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SelectiveSubmissionLocking
{
    public function __construct(
        protected AdaptiveAccessService $adaptiveAccessService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Hanya berlaku untuk siswa
        if (!$user || !$user->isStudent()) {
            return $next($request);
        }

        try {
            $student = $user->student;
            if (!$student) {
                return $next($request);
            }

            // Ambil assignment dari route model binding
            $assignment = $request->route('assignment');
            if (!$assignment) {
                return $next($request);
            }

            $decision = $this->adaptiveAccessService->evaluateTaskSubmission($student, $assignment);

            if (!$decision->allowed) {
                $isJson = $request->expectsJson() || $request->ajax();

                if ($decision->reasonCode === 'PREREQUISITE_INCOMPLETE') {
                    if ($isJson) {
                        return response()->json([
                            'success' => false,
                            'locked' => true,
                            'type' => 'prereq_locked',
                            'message' => $decision->message,
                            'prereq_title' => $decision->prerequisiteTitle,
                            'prereq_material_id' => $decision->prerequisiteMaterialId,
                            'can_appeal' => false
                        ], 403);
                    }

                    return redirect()->back()
                        ->with('submission_locked', $decision->message)
                        ->with('prereq_not_completed', true)
                        ->with('prereq_material_id', $decision->prerequisiteMaterialId);
                }

                if ($decision->reasonCode === 'RECOVERY_WRONG_TASK') {
                    if ($isJson) {
                        return response()->json([
                            'success' => false,
                            'locked' => true,
                            'type' => 'recovery_locked',
                            'message' => $decision->message,
                            'current_recovery_assignment_id' => $decision->targetTugasId,
                            'can_appeal' => false
                        ], 403);
                    }

                    return redirect()->back()
                        ->with('submission_locked', $decision->message)
                        ->with('recovery_active', true)
                        ->with('current_recovery_assignment_id', $decision->targetTugasId);
                }

                if ($decision->reasonCode === 'LOCKED_BY_RETURNED_TASKS') {
                    $returnedTasks = \App\Models\Tugas::where('mata_pelajaran_id', $assignment->mata_pelajaran_id)
                        ->whereHas('submissions', function ($q) use ($student) {
                            $q->where('siswa_id', $student->id)
                              ->whereIn('status', ['needs_revision', 'revisi']);
                        })
                        ->with(['submissions' => function ($q) use ($student) {
                            $q->where('siswa_id', $student->id);
                        }])
                        ->get()
                        ->map(function ($t) {
                            $sub = $t->submissions->first();
                            return [
                                'id' => $t->id,
                                'title' => $t->judul,
                                'deskripsi' => $t->deskripsi,
                                'tipe_pengumpulan' => $t->tipe_pengumpulan ?? 'dokumen',
                                'mode_audiovisual' => $t->mode_audiovisual ?? 'either',
                                'deadline' => $t->deadline ? $t->deadline->format('d M Y, H:i') : '-',
                                'alasan' => $sub?->alasan_pengembalian ?? 'Silakan periksa instruksi perbaikan dari guru.',
                            ];
                        })
                        ->toArray();

                    if ($isJson) {
                        return response()->json([
                            'success' => false,
                            'locked' => true,
                            'type' => 'locked_by_returned',
                            'reason_code' => 'LOCKED_BY_RETURNED_TASKS',
                            'message' => $decision->message,
                            'tunggakan_count' => $decision->tunggakanCount,
                            'returned_count' => $decision->returnedCount,
                            'returned_tasks' => $returnedTasks,
                            'can_appeal' => false,
                            'subject_id' => $decision->subjectId
                        ], 403);
                    }

                    return redirect()->back()
                        ->with('submission_locked', $decision->message)
                        ->with('returned_count', $decision->returnedCount)
                        ->with('tunggakan_count', $decision->tunggakanCount)
                        ->with('can_appeal', false)
                        ->with('subject_id', $decision->subjectId);
                }

                if ($decision->reasonCode === 'LOCKED_BY_SSL') {
                    if ($isJson) {
                        return response()->json([
                            'success' => false,
                            'locked' => true,
                            'type' => 'overdue_locked',
                            'reason_code' => 'LOCKED_BY_SSL',
                            'message' => $decision->message,
                            'tunggakan_count' => $decision->tunggakanCount,
                            'can_appeal' => $decision->canAppeal,
                            'subject_id' => $decision->subjectId
                        ], 403);
                    }

                    return redirect()->back()
                        ->with('submission_locked', $decision->message)
                        ->with('tunggakan_count', $decision->tunggakanCount)
                        ->with('can_appeal', $decision->canAppeal)
                        ->with('subject_id', $decision->subjectId);
                }

                // Default blocked fallback
                if ($isJson) {
                    return response()->json([
                        'success' => false,
                        'locked' => true,
                        'message' => $decision->message,
                    ], 403);
                }

                return redirect()->back()->with('submission_locked', $decision->message);
            }

            return $next($request);

        } catch (\Throwable $e) {
            Log::error('Adaptive access evaluation failed', [
                'exception' => $e,
                'student_id' => auth()->user()?->student_id,
                'task_id' => $request->route('assignment')?->id,
            ]);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Evaluasi akses sementara tidak tersedia. Silakan mencoba kembali.',
                ], 503);
            }

            return redirect()->back()->with(
                'error',
                'Evaluasi akses sementara tidak tersedia. Silakan mencoba kembali.'
            );
        }
    }
}
