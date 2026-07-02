<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Pengumpulan;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class PengumpulanController extends Controller
{
    public function store(Request $request, Tugas $assignment)
    {
        if (\App\Models\Pengaturan::getValue('storage_frozen', '0') === '1') {
            return redirect()->back()->with('error', 'Sistem terkunci (Read-Only). Anda tidak dapat mengirim atau mengubah tugas saat ini.');
        }

        Gate::authorize('view_tugas');

        $user = auth()->user();
        
        if (!$user->isStudent()) {
            abort(403, 'Only students can submit assignments.');
        }

        // Validate Native File Upload
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,zip|max:10240',
            'content' => 'nullable|string',
        ]);

        // Check for existing submission to prevent multiple submissions
        $existingSubmission = Pengumpulan::where('tugas_id', $assignment->id)
            ->where('siswa_id', $user->student_id)
            ->first();

        if ($existingSubmission) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah mengumpulkan tugas ini.'
                ], 422);
            }
            return redirect()->back()->with('error', 'Anda sudah mengumpulkan tugas ini.');
        }

        // Handle File Upload
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $mimeType = $file->getClientMimeType();
        $fileSize = $file->getSize();
        
        // Structure: submissions/{assignment_id}/{student_id}/filename
        $folderPath = "submissions/{$assignment->id}/{$user->student_id}";
        $filePath = $file->store($folderPath);

        // Create new submission
        $submission = Pengumpulan::create([
            'tugas_id' => $assignment->id,
            'siswa_id' => $user->student_id,
            'tanggal_pengumpulan' => Carbon::now(),
            'file_tugas' => $filePath,
            'status' => $assignment->deadline->isPast() ? 'late' : 'submitted',
            'original_name' => $originalName,
            'file_path' => $filePath,
            'file_size' => $fileSize,
            'mime_type' => $mimeType,
        ]);

        // Handle Progressive Sequential Recovery Progression
        $this->handleRecoveryProgression($user->student_id, $assignment);

        \App\Models\ActivityLog::log('ASSIGNMENT', 'Mengumpulkan tugas: ' . $assignment->title);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tugas berhasil dikumpulkan.',
                'submission' => $submission
            ]);
        }

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan.');
    }

    /**
     * Handles the progression of recovery mode by unlocking the next overdue assignment
     * or completing the recovery session if all tasks are finished.
     */
    private function handleRecoveryProgression($studentId, $assignment)
    {
        $recovery = \App\Models\PemulihanPengumpulan::where('siswa_id', $studentId)
            ->where('mata_pelajaran_id', $assignment->subject_id)
            ->where('status_pemulihan', 'aktif')
            ->first();

        if (!$recovery || $recovery->tugas_id != $assignment->id) {
            return;
        }

        // Find next oldest overdue assignment in this subject
        $nextOverdue = \App\Models\Tugas::tugas()
            ->where('mata_pelajaran_id', $assignment->subject_id)
            ->where('status', 'aktif')
            ->where('deadline', '<', Carbon::now())
            ->whereDoesntHave('submissions', function ($q) use ($studentId) {
                $q->where('siswa_id', $studentId);
            })
            ->orderBy('deadline', 'asc')
            ->first();

        if ($nextOverdue) {
            // Update to next task and reset timer using stored duration
            $recovery->update([
                'tugas_id' => $nextOverdue->id,
                'batas_pemulihan' => Carbon::now()->addHours($recovery->durasi_jam),
            ]);
        } else {
            // No more overdue tasks in this subject
            $recovery->update([
                'status_pemulihan' => 'selesai',
                'selesai_pemulihan' => Carbon::now(),
            ]);
        }
    }

    public function show(Pengumpulan $submission)
    {
        Gate::authorize('grade_tugas');

        $user = auth()->user();
        $assignment = $submission->assignment;
        $isOwner = $user->isSuperAdmin() || ($user->isTeacher() && $assignment->guru_id == $user->teacher_id);

        if (!$isOwner) {
            abort(403, 'Unauthorized action.');
        }

        $submission->load(['student', 'assignment.subject']);
        return view('pengumpulan.show', compact('submission'));
    }

    public function grade(Request $request, Pengumpulan $submission)
    {
        Gate::authorize('grade_tugas');

        $user = auth()->user();
        $assignment = $submission->assignment;
        $isOwner = $user->isSuperAdmin() || ($user->isTeacher() && $assignment->guru_id == $user->teacher_id);

        if (!$isOwner) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'score' => 'required|numeric|min:0|max:' . $assignment->max_score,
            'feedback' => 'nullable|string',
        ]);

        Nilai::updateOrCreate(
            ['submission_id' => $submission->id],
            [
                'subject_id' => $assignment->subject_id,
                'student_id' => $submission->student_id,
                'type' => 'assignment',
                'score' => $request->score,
                'max_score' => $assignment->max_score,
                'feedback' => $request->feedback,
                'graded_by' => $user->isTeacher() ? $user->teacher_id : $assignment->created_by,
                'graded_at' => Carbon::now(),
            ]
        );

        $submission->update(['status' => 'graded']);

        \App\Models\ActivityLog::log('ASSIGNMENT', 'Menilai tugas ' . $submission->assignment->title . ' untuk siswa ' . $submission->student->nama . ' dengan skor ' . $request->score);

        return redirect()->route('assignments.show', $assignment)->with('success', 'Nilai berhasil disimpan.');
    }

    public function toggleKoreksi(Request $request, Pengumpulan $submission)
    {
        Gate::authorize('grade_tugas');

        $user = auth()->user();
        $assignment = $submission->assignment;
        $isOwner = $user->isSuperAdmin() || ($user->isTeacher() && $assignment->guru_id == $user->teacher_id);

        if (!$isOwner) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
            }
            abort(403, 'Unauthorized action.');
        }

        if ($submission->grade) {
            $submission->grade()->delete();
            $isGraded = false;
            $statusLabel = 'Perlu Koreksi';
            $statusClass = 'badge-perlu-koreksi';
            $statusType = 'perlu_koreksi';
            
            // Check if late
            $telat = $submission->tanggal_pengumpulan->gt($assignment->deadline);
            if ($telat) {
                $statusLabel = 'Terlambat';
                $statusClass = 'badge-terlambat';
                $statusType = 'terlambat';
            }
            
            $message = 'Koreksi dibatalkan.';
        } else {
            $request->validate([
                'nilai' => 'required|numeric|min:0|max:' . $assignment->max_score,
                'catatan' => 'nullable|string'
            ]);

            $feedback = $request->input('catatan') ?: 'Selesai dikoreksi.';
            $score = $request->input('nilai');
            
            $gradeRecord = Nilai::updateOrCreate(
                ['submission_id' => $submission->id],
                [
                    'subject_id' => $assignment->subject_id,
                    'student_id' => $submission->student_id,
                    'type' => 'assignment',
                    'score' => $score,
                    'max_score' => $assignment->max_score,
                    'feedback' => $feedback,
                    'graded_by' => $user->isTeacher() ? $user->teacher_id : $assignment->created_by,
                    'graded_at' => Carbon::now(),
                ]
            );
            $isGraded = true;
            $statusLabel = 'Sudah Dikoreksi';
            $statusClass = 'badge-dikoreksi';
            $statusType = 'sudah_dikoreksi';
            $message = 'Tugas berhasil dinilai.';
        }

        \App\Models\ActivityLog::log('ASSIGNMENT', 'Mengubah status koreksi tugas ' . $submission->assignment->title . ' untuk siswa ' . $submission->student->nama);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'is_graded' => $isGraded,
                'status_label' => $statusLabel,
                'status_class' => $statusClass,
                'status_type' => $statusType,
                'score' => isset($gradeRecord) ? $gradeRecord->score : null,
                'feedback' => isset($gradeRecord) ? $gradeRecord->feedback : null,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    private function autoGrade(Pengumpulan $submission, Tugas $assignment, array $studentAnswers)
    {
        // Parse answer key (comma separated: A,B,C,...)
        $key = array_map('trim', explode(',', $assignment->answer_key));
        $totalQuestions = count($key);
        $correctCount = 0;

        foreach ($key as $index => $correctAnswer) {
            $studentAnswer = $studentAnswers[$index + 1] ?? null; // Answers are 1-indexed from form
            if (strtoupper($studentAnswer) === strtoupper($correctAnswer)) {
                $correctCount++;
            }
        }

        $score = ($totalQuestions > 0) ? ($correctCount / $totalQuestions) * $assignment->max_score : 0;

        Nilai::updateOrCreate(
            [
                'submission_id' => $submission->id,
            ],
            [
                'subject_id' => $assignment->subject_id,
                'student_id' => $submission->student_id,
                'type' => 'assignment',
                'score' => $score,
                'max_score' => $assignment->max_score,
                'feedback' => "Auto-graded: $correctCount / $totalQuestions correct.",
                'graded_by' => $assignment->created_by, // Assigned to the teacher who created the assignment
                'graded_at' => Carbon::now(),
            ]
        );

        $submission->update(['status' => 'graded']);
    }
}
