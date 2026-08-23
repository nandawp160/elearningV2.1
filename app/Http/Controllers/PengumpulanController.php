<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Pengumpulan;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

        $student = $user->student;
        if (!$student || !$student->resolved_kelas) {
            abort(403, 'Anda tidak terdaftar di kelas manapun.');
        }

        if ($assignment->kelas_id) {
            $kelasAssignment = \App\Models\Kelas::find($assignment->kelas_id);
            if ($kelasAssignment && $kelasAssignment->name !== $student->resolved_kelas) {
                abort(403, 'Tugas ini diperuntukkan bagi rombongan belajar lain.');
            }
        }

        // Determine assignment modality
        $tipePengumpulan = $assignment->tipe_pengumpulan ?? 'dokumen';
        $modeAudiovisual = $assignment->mode_audiovisual ?? 'either';
        $urlService = app(\App\Services\SubmissionUrlService::class);

        $isUrlSubmission = false;
        $submissionUrl = null;
        $file = null;

        // 1. Modality-Specific Validations
        if ($tipePengumpulan === 'tautan') {
            if ($request->hasFile('file')) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'file' => 'Tugas ini mewajibkan pengumpulan tautan proyek daring, bukan unggah berkas.'
                ]);
            }
            $urlValidation = $urlService->validateSubmissionUrl($request->input('submission_url'), 'tautan');
            if (!$urlValidation['valid']) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'submission_url' => $urlValidation['message']
                ]);
            }
            $isUrlSubmission = true;
            $submissionUrl = trim($request->input('submission_url'));
        } elseif ($tipePengumpulan === 'audiovisual') {
            if ($modeAudiovisual === 'audio_file') {
                if ($request->filled('submission_url')) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'submission_url' => 'Guru menetapkan pengumpulan tugas ini khusus berupa rekaman berkas audio (MP3/M4A).'
                    ]);
                }
                $request->validate([
                    'file' => [
                        'required',
                        'file',
                        'mimes:mp3,m4a',
                        'max:10240',
                        function ($attribute, $value, $fail) {
                            if ($value && $value->getSize() <= 0) {
                                $fail('Berkas rekaman audio kosong (0 Byte). Harap unggah berkas rekaman yang valid.');
                            }
                        },
                    ],
                ], [
                    'file.required' => 'Berkas rekaman audio wajib diunggah.',
                    'file.mimes' => 'Format audio harus berupa MP3 atau M4A.',
                    'file.max' => 'Ukuran berkas audio maksimal 10 MB.',
                ]);
                $file = $request->file('file');
            } elseif ($modeAudiovisual === 'video_url') {
                if ($request->hasFile('file')) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'file' => 'Guru menetapkan pengumpulan tugas ini khusus berupa tautan video daring (YouTube, Google Drive, atau Loom).'
                    ]);
                }
                $urlValidation = $urlService->validateSubmissionUrl($request->input('submission_url'), 'audiovisual');
                if (!$urlValidation['valid']) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'submission_url' => $urlValidation['message']
                    ]);
                }
                $isUrlSubmission = true;
                $submissionUrl = trim($request->input('submission_url'));
            } else { // mode either
                $hasFile = $request->hasFile('file');
                $hasUrl = $request->filled('submission_url');

                if ($hasFile && $hasUrl) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'submission_url' => 'Pilih salah satu metode: unggah berkas audio ATAU masukkan tautan video, tidak boleh keduanya.'
                    ]);
                }
                if (!$hasFile && !$hasUrl) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'submission_url' => 'Harap unggah berkas audio atau masukkan tautan video tugas Anda.'
                    ]);
                }

                if ($hasUrl) {
                    $urlValidation = $urlService->validateSubmissionUrl($request->input('submission_url'), 'audiovisual');
                    if (!$urlValidation['valid']) {
                        throw \Illuminate\Validation\ValidationException::withMessages([
                            'submission_url' => $urlValidation['message']
                        ]);
                    }
                    $isUrlSubmission = true;
                    $submissionUrl = trim($request->input('submission_url'));
                } else {
                    $request->validate([
                        'file' => [
                            'required',
                            'file',
                            'mimes:mp3,m4a',
                            'max:10240',
                            function ($attribute, $value, $fail) {
                                if ($value && $value->getSize() <= 0) {
                                    $fail('Berkas rekaman audio kosong (0 Byte). Harap unggah berkas rekaman yang valid.');
                                }
                            },
                        ],
                    ], [
                        'file.mimes' => 'Format audio harus berupa MP3 atau M4A.',
                        'file.max' => 'Ukuran berkas audio maksimal 10 MB.',
                    ]);
                    $file = $request->file('file');
                }
            }
        } elseif ($tipePengumpulan === 'visual') {
            if ($request->filled('submission_url')) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'submission_url' => 'Tugas ini mewajibkan pengunggahan berkas media visual (JPG/PNG/PDF), bukan tautan.'
                ]);
            }
            $request->validate([
                'file' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,png,pdf',
                    'max:20480',
                    function ($attribute, $value, $fail) {
                        if ($value && $value->getSize() <= 0) {
                            $fail('Berkas gambar/visual kosong (0 Byte). Harap unggah berkas yang valid.');
                        }
                    },
                ],
            ], [
                'file.required' => 'Berkas media visual wajib diunggah.',
                'file.mimes' => 'Format berkas harus berupa JPG, JPEG, PNG, atau PDF.',
                'file.max' => 'Ukuran berkas maksimal 20 MB.',
            ]);
            $file = $request->file('file');
        } elseif ($tipePengumpulan === 'tautan') {
            if ($request->hasFile('file')) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'submission_url' => 'Tugas ini mewajibkan pengumpulan berupa tautan proyek eksternal, bukan berkas unggahan.'
                ]);
            }
            if (!$request->filled('submission_url')) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'submission_url' => 'Tautan karya digital wajib diisi.'
                ]);
            }
            $urlValidation = $urlService->validateSubmissionUrl($request->input('submission_url'), 'tautan');
            if (!$urlValidation['valid']) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'submission_url' => $urlValidation['message']
                ]);
            }
            $isUrlSubmission = true;
            $submissionUrl = trim($request->input('submission_url'));
        } else { // dokumen (default)
            if ($request->filled('submission_url')) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'submission_url' => 'Tugas ini mewajibkan pengunggahan berkas dokumen (PDF/DOC/DOCX), bukan tautan.'
                ]);
            }
            $request->validate([
                'file' => [
                    'required',
                    'file',
                    'mimes:pdf,doc,docx',
                    'max:20480',
                    function ($attribute, $value, $fail) {
                        if ($value && $value->getSize() <= 0) {
                            $fail('Berkas dokumen kosong (0 Byte). Harap unggah dokumen yang valid.');
                        }
                    },
                ],
            ], [
                'file.required' => 'Berkas dokumen wajib diunggah.',
                'file.mimes' => 'Format berkas harus berupa PDF, DOC, atau DOCX.',
                'file.max' => 'Ukuran berkas maksimal 20 MB.',
            ]);
            $file = $request->file('file');
        }

        // Validate optional content/catatan notes
        $request->validate([
            'content' => 'nullable|string|max:2000',
            'catatan' => 'nullable|string|max:2000'
        ]);
        $catatan = $request->input('catatan') ?? $request->input('content');

        // Check for existing submission
        $existingSubmission = Pengumpulan::where('tugas_id', $assignment->id)
            ->where('siswa_id', $user->student_id)
            ->first();

        $isRevision = $existingSubmission && $existingSubmission->is_needs_revision;

        if ($existingSubmission && !$isRevision) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah mengumpulkan tugas ini.'
                ], 422);
            }
            return redirect()->back()->with('error', 'Anda sudah mengumpulkan tugas ini.');
        }

        // 2. Process File vs URL Separation
        $filePath = null;
        $originalName = null;
        $mimeType = null;
        $fileSize = null;
        $oldFilePath = $isRevision ? $existingSubmission->file_tugas : null;

        if (!$isUrlSubmission && $file) {
            // Extra Security Hard-Block: Mencegah eksekusi file berbahaya (meskipun spoofing mime type)
            $blockedExtensions = ['php', 'php3', 'php4', 'php5', 'phtml', 'exe', 'sh', 'bat', 'cmd', 'js', 'jar', 'vbs', 'scr', 'apk'];
            if (in_array(strtolower($file->getClientOriginalExtension()), $blockedExtensions)) {
                return redirect()->back()->with('error', 'SECURITY ALERT: File yang Anda unggah terdeteksi sebagai ekstensi berbahaya dan ditolak oleh sistem.');
            }

            $originalName = $file->getClientOriginalName();
            $mimeType = $file->getClientMimeType();
            $fileSize = $file->getSize();

            $folderPath = "submissions/{$assignment->id}/{$user->student_id}";
            $filePath = $file->store($folderPath, 'public');
        }

        $adaptiveService = app(\App\Services\AdaptiveAccessService::class);

        try {
            $submission = DB::transaction(function () use ($assignment, $user, $student, $filePath, $originalName, $fileSize, $mimeType, $submissionUrl, $catatan, $adaptiveService, $existingSubmission, $isRevision) {
                $status = $assignment->deadline && $assignment->deadline->isPast() ? 'late' : 'submitted';

                if ($isRevision) {
                    $existingSubmission->update([
                        'tanggal_pengumpulan' => Carbon::now(),
                        'file_tugas' => $filePath,
                        'submission_url' => $submissionUrl,
                        'drive_link' => $submissionUrl,
                        'original_name' => $originalName,
                        'file_path' => $filePath,
                        'file_size' => $fileSize,
                        'mime_type' => $mimeType,
                        'catatan' => $catatan,
                        'status' => $status,
                        'alasan_pengembalian' => null,
                        'dikembalikan_pada' => null,
                        'dikembalikan_oleh' => null,
                        'revisi_ke' => ($existingSubmission->revisi_ke ?? 0) + 1,
                    ]);
                    $sub = $existingSubmission;
                    \App\Models\ActivityLog::log('ASSIGNMENT', 'Mengunggah perbaikan/revisi tugas: ' . ($assignment->judul ?? $assignment->title));
                } else {
                    $sub = Pengumpulan::create([
                        'tugas_id' => $assignment->id,
                        'siswa_id' => $user->student_id,
                        'tanggal_pengumpulan' => Carbon::now(),
                        'file_tugas' => $filePath,
                        'submission_url' => $submissionUrl,
                        'drive_link' => $submissionUrl,
                        'status' => $status,
                        'original_name' => $originalName,
                        'file_path' => $filePath,
                        'file_size' => $fileSize,
                        'mime_type' => $mimeType,
                        'catatan' => $catatan,
                    ]);
                    \App\Models\ActivityLog::log('ASSIGNMENT', 'Mengumpulkan tugas: ' . ($assignment->judul ?? $assignment->title));

                    // Advance recovery ONLY on initial submission (not on revisions)
                    if ($student) {
                        $adaptiveService->advanceRecoveryAfterSubmission($student, $assignment);
                    }
                }

                return $sub;
            });

            // Delete old file after successful commit if replaced
            if ($oldFilePath && $oldFilePath !== $filePath && Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }
        } catch (\Throwable $e) {
            // Rollback newly uploaded physical file if transaction fails
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            throw $e;
        }

        $successMsg = $isRevision ? 'Perbaikan tugas berhasil dikirimkan.' : 'Tugas berhasil dikumpulkan.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
                'submission' => $submission
            ]);
        }

        return redirect()->back()->with('success', $successMsg);
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
            
            $submission->update(['status' => $telat ? 'late' : 'submitted']);
            
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
            
            $submission->update(['status' => 'graded']);
            
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

    /**
     * Return student submission for revision with teacher feedback / notes
     */
    public function returnForRevision(Request $request, Pengumpulan $submission)
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

        $request->validate([
            'alasan' => 'required|string|min:3|max:1000',
        ], [
            'alasan.required' => 'Catatan / alasan pengembalian tugas wajib diisi.'
        ]);

        $alasan = $request->input('alasan');

        \Illuminate\Support\Facades\DB::transaction(function () use ($submission, $user, $alasan) {
            // Delete grade record if exists
            if ($submission->grade) {
                $submission->grade()->delete();
            }

            $submission->update([
                'status' => 'needs_revision',
                'alasan_pengembalian' => $alasan,
                'dikembalikan_pada' => Carbon::now(),
                'dikembalikan_oleh' => $user->id,
            ]);

            \App\Models\ActivityLog::log(
                'ASSIGNMENT',
                'Mengembalikan tugas "' . ($submission->assignment->judul ?? $submission->assignment->title ?? 'Tugas') . '" milik siswa ' . ($submission->student->nama ?? $submission->student->name ?? '-') . ' untuk direvisi: ' . $alasan
            );
        });

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jawaban siswa berhasil di-return untuk perbaikan / upload ulang.',
                'status_label' => 'Return Jawaban',
                'status_class' => 'badge-needs-revision',
                'status_type' => 'needs_revision',
                'alasan_pengembalian' => $alasan,
                'submission' => $submission->fresh(['student', 'grade'])
            ]);
        }

        return redirect()->back()->with('success', 'Jawaban siswa berhasil di-return untuk perbaikan / upload ulang.');
    }
}
