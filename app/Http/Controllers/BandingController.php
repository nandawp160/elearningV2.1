<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BandingController extends Controller
{
    /**
     * Store a new appeal from a student.
     */
    public function store(Request $request)
    {
        Gate::authorize('view_tugas');

        $user = auth()->user();
        if (!$user->isStudent()) abort(403);

        $request->validate([
            'subject_id' => 'required|exists:mata_pelajaran,id',
            'reason' => 'required|string|max:1000',
            'bukti_pendukung' => 'required|file|mimes:pdf,jpg,png|max:5120',
        ], [
            'reason.required' => 'Alasan keterlambatan wajib diisi.',
            'bukti_pendukung.required' => 'Berkas bukti pendukung (surat sakit/dokumen relevan) wajib diunggah.',
            'bukti_pendukung.max' => 'Ukuran berkas bukti pendukung maksimal 5MB.',
            'bukti_pendukung.mimes' => 'Format berkas bukti pendukung harus berupa PDF, JPG, atau PNG.',
        ]);

        $student = $user->student;
        if (!$student || !$student->resolved_kelas) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar di kelas manapun.');
        }

        $subject = \App\Models\JadwalPelajaran::find($request->subject_id);
        $studentClass = \App\Models\Kelas::where('name', $student->resolved_kelas)->first();
        if ($subject) {
            if ($studentClass && $subject->tingkat && $studentClass->grade_level && $subject->tingkat !== $studentClass->grade_level) {
                abort(403, 'Mata pelajaran ini tidak sesuai dengan tingkat kelas Anda.');
            }
        }

        // Student eligibility check: Subject overdue count must reach threshold to be SSL locked
        $adaptiveService = app(\App\Services\AdaptiveAccessService::class);
        $student = $user->student;
        if (!$student) {
            abort(403, 'Data siswa tidak ditemukan.');
        }

        $accessResult = $adaptiveService->evaluateSubjectAccess($student, $subject);

        if (!$accessResult->isLocked()) {
            abort(403, 'Permohonan banding hanya dapat diajukan jika akses pengumpulan mata pelajaran ini sedang terkunci oleh sistem.');
        }

        if (!$accessResult->canAppeal) {
            return redirect()->back()->with('error', 'Banding untuk mata pelajaran ini sedang diproses.');
        }

        $filePath = null;
        if ($request->hasFile('bukti_pendukung')) {
            $filePath = $request->file('bukti_pendukung')->store('banding_bukti');
        }

        \App\Models\Banding::create([
            'siswa_id' => $user->student_id,
            'mata_pelajaran_id' => $request->subject_id,
            'alasan' => $request->reason,
            'bukti_pendukung' => $filePath,
            'kategori_alasan' => 'Lainnya',
            'status' => 'pending',
        ]);

        \App\Models\ActivityLog::log('APPEAL', 'Mengajukan banding dispensasi untuk mata pelajaran ID ' . $request->subject_id);

        return redirect()->back()->with('success', 'Permohonan banding berhasil dikirim. Mohon tunggu persetujuan guru.');
    }

    /**
     * List appeals for teachers/admins.
     */
    public function index(Request $request)
    {
        Gate::authorize('view_dispensasi');

        $user = auth()->user();

        if (!$user->isTeacher() && !$user->isSuperAdmin()) {
            abort(403);
        }

        // Jika class_id tidak ada, tampilkan halaman Daftar Kelas (Mockup 1)
        if (!$request->has('class_id') || empty($request->class_id)) {
            $classData = collect();

            if ($user->isTeacher() && !$user->isSuperAdmin()) {
                $guru = $user->guru;
                if ($guru) {
                    $processedClassIds = [];

                    // 1. Kelas yang diampu oleh Guru (Taught Classes)
                    foreach ($guru->kelasDiampu as $kelas) {
                        $processedClassIds[] = $kelas->id;
                        $resolvedSubject = $guru->getSubjectForClass($kelas);
                        $subjectId = $resolvedSubject ? $resolvedSubject->id : $guru->specialization_id;
                        $subjectName = $resolvedSubject ? $resolvedSubject->nama : ($guru->mataPelajaran->nama ?? 'Tidak Ada Spesialisasi');

                        // Hitung jumlah siswa aktif di kelas ini
                        $studentCount = \App\Models\Siswa::where('kelas', $kelas->name)->where('status', 'aktif')->count();
                        
                        // Hitung antrean permohonan baru (status = 'ditinjau' / pending)
                        $pendingCount = \App\Models\Banding::whereIn('status', ['ditinjau', 'pending'])
                            ->where('mata_pelajaran_id', $subjectId)
                            ->whereHas('student', function($q) use ($kelas) {
                                $q->where('kelas', $kelas->name);
                            })->count();

                        $classData->push((object)[
                            'id' => $kelas->id,
                            'name' => $kelas->name,
                            'grade_level' => $kelas->grade_level ?? $this->extractGradeLevel($kelas->name),
                            'student_count' => $studentCount,
                            'subject_id' => $subjectId,
                            'subject_name' => $subjectName,
                            'pending_count' => $pendingCount,
                            'is_homeroom' => false,
                        ]);
                    }

                    // 2. Kelas Perwalian (Homeroom Classes for Wali Kelas)
                    if ($user->isHomeroomTeacher()) {
                        $homeroomClasses = \App\Models\Kelas::where('homeroom_teacher_id', $user->teacher_id)->get();
                        foreach ($homeroomClasses as $hKelas) {
                            $studentCount = \App\Models\Siswa::where('kelas', $hKelas->name)->where('status', 'aktif')->count();

                            // Wali Kelas melihat permohonan pending yang dieskalasi (tingkat_eskalasi != 'guru' atau created_at > 24 jam lalu)
                            $pendingCount = \App\Models\Banding::whereIn('status', ['ditinjau', 'pending'])
                                ->whereHas('student', function($q) use ($hKelas) {
                                    $q->where('kelas', $hKelas->name);
                                })
                                ->where(function($q) {
                                    $q->whereIn('tingkat_eskalasi', ['wali_kelas', 'admin'])
                                      ->orWhere('created_at', '<=', now()->subHours(24));
                                })->count();

                            $classData->push((object)[
                                'id' => $hKelas->id,
                                'name' => $hKelas->name,
                                'grade_level' => $hKelas->grade_level ?? $this->extractGradeLevel($hKelas->name),
                                'student_count' => $studentCount,
                                'subject_id' => null,
                                'subject_name' => 'Semua Pelajaran (Kelas Perwalian)',
                                'pending_count' => $pendingCount,
                                'is_homeroom' => true,
                            ]);
                        }
                    }
                }
            } else {
                // Admin/Super Admin: Tampilkan semua kelas
                $classrooms = \App\Models\Kelas::all();
                foreach ($classrooms as $kelas) {
                    $studentCount = \App\Models\Siswa::where('kelas', $kelas->name)->where('status', 'aktif')->count();
                    $pendingCount = \App\Models\Banding::whereIn('status', ['ditinjau', 'pending'])
                        ->whereHas('student', function($q) use ($kelas) {
                            $q->where('kelas', $kelas->name);
                        })->count();

                    $classData->push((object)[
                        'id' => $kelas->id,
                        'name' => $kelas->name,
                        'grade_level' => $kelas->grade_level ?? $this->extractGradeLevel($kelas->name),
                        'student_count' => $studentCount,
                        'subject_id' => null,
                        'subject_name' => 'Semua Pelajaran',
                        'pending_count' => $pendingCount,
                        'is_homeroom' => false,
                    ]);
                }
            }

            return view('banding.index', compact('classData'));
        }

        // JIKA ADA class_id, tampilkan detail banding per kelas (Mockup 2)
        $classId = $request->class_id;
        $classroom = \App\Models\Kelas::where('name', $classId)->first();
        if (!$classroom) {
            $classroom = \App\Models\Kelas::find($classId);
            if ($classroom) {
                $classId = $classroom->name;
            } else {
                abort(404, 'Kelas tidak ditemukan.');
            }
        }

        $isHomeroomForClass = false;
        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $guru = $user->guru;
            if (!$guru) abort(403);
            $isAssignedClass = \App\Models\GuruKelas::where('guru_id', $guru->id)
                ->where('kelas_id', $classroom->id)
                ->exists();
            $isHomeroomForClass = ($classroom->homeroom_teacher_id == $user->teacher_id);

            if (!$isAssignedClass && !$isHomeroomForClass) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan atau perwalian pada kelas ini.');
            }
        }

        $query = \App\Models\Banding::with(['student', 'subject', 'assignment'])
            ->whereHas('student', function($q) use ($classId) {
                $q->where('kelas', $classId);
            });

        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            if (!$isHomeroomForClass) {
                $resolvedSubject = $user->guru->getSubjectForClass($classroom);
                if ($resolvedSubject) {
                    $query->where('mata_pelajaran_id', $resolvedSubject->id);
                } else {
                    $query->whereIn('mata_pelajaran_id', $user->guru->getSubjectIdsTaught());
                }
            }
        }

        // Apply filters
        if ($request->status) {
            $statusMap = [
                'pending' => 'ditinjau',
                'approved' => 'diterima',
                'rejected' => 'ditolak'
            ];
            $dbStatus = $statusMap[$request->status] ?? $request->status;
            $query->where('status', $dbStatus);
        }

        if ($request->search) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // Get all appeals for stats calculation before pagination
        $allClassAppeals = $query->get();
        $pendingCount = $allClassAppeals->whereIn('status', ['pending', 'ditinjau'])->count();
        $approvedCount = $allClassAppeals->whereIn('status', ['approved', 'diterima'])->count();
        $rejectedCount = $allClassAppeals->whereIn('status', ['rejected', 'ditolak'])->count();

        $appeals = $query->latest()->paginate(15);

        // Subject name for header
        $subjectName = 'Semua Pelajaran';
        if ($user->isTeacher() && $user->guru && !$isHomeroomForClass) {
            $resolvedSubject = $user->guru->getSubjectForClass($classroom);
            $subjectName = $resolvedSubject ? $resolvedSubject->nama : ($user->guru->mataPelajaran->nama ?? '-');
        } elseif ($isHomeroomForClass) {
            $subjectName = 'Kelas Perwalian (Semua Pelajaran)';
        }

        return view('banding.classroom_appeals', compact(
            'appeals', 'classroom', 'classId', 'pendingCount', 'approvedCount', 'rejectedCount', 'subjectName', 'isHomeroomForClass'
        ));
    }

    private function extractGradeLevel($className)
    {
        if (str_contains($className, 'XII')) return 'XII';
        if (str_contains($className, 'XI')) return 'XI';
        if (str_contains($className, 'X')) return 'X';
        return 'X';
    }

    /**
     * Show recovery history/monitoring.
     */
    public function history(Request $request)
    {
        Gate::authorize('view_dispensasi');

        $user = auth()->user();
        $query = \App\Models\PemulihanPengumpulan::with(['student', 'subject']);

        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $guru = $user->guru;
            $homeroomClass = \App\Models\Kelas::where('homeroom_teacher_id', $user->teacher_id)->first();

            if ($user->isHomeroomTeacher() && $homeroomClass) {
                // Wali Kelas can view recovery history for students in homeroom class across all subjects
                $query->whereHas('student', function($q) use ($homeroomClass) {
                    $q->where('kelas', $homeroomClass->name);
                });
            } else {
                // Regular teacher is restricted to their taught classes
                $kelasDiampuNames = $guru ? $guru->kelasDiampu()->pluck('kelas.name')->toArray() : [];
                $query->whereHas('student', function($q) use ($kelasDiampuNames) {
                    $q->whereIn('kelas', $kelasDiampuNames);
                });
            }
        } elseif (!$user->isSuperAdmin()) {
            abort(403);
        }

        // Filters
        if ($request->subject_id) $query->where('mata_pelajaran_id', $request->subject_id);
        if ($request->class_id) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('kelas', $request->class_id);
            });
        }
        if ($request->status) $query->where('status_pemulihan', $request->status);
        if ($request->search) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $recoveries = $query->latest()->paginate(15);
        
        // For Filter Dropdowns
        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $guru = $user->guru;
            $subjects = collect();
            if ($guru) {
                foreach ($guru->kelasDiampu as $kelas) {
                    $resolvedSubject = $guru->getSubjectForClass($kelas);
                    if ($resolvedSubject) {
                        $cloned = clone $resolvedSubject;
                        $cloned->setRelation('classRoom', $kelas);
                        $subjects->push($cloned);
                    }
                }
            }
        } else {
            $subjects = \App\Models\JadwalPelajaran::with(['classRoom'])->get();
        }
        $classrooms = \App\Models\Siswa::distinct()->pluck('kelas')->filter();

        return view('banding.history', compact('recoveries', 'subjects', 'classrooms'));
    }

    /**
     * Get overdue assignments for a specific appeal (API for Modal).
     */
    public function getOverdueData(\App\Models\Banding $appeal)
    {
        Gate::authorize('view_dispensasi');

        $user = auth()->user();
        if (!$user->isTeacher() && !$user->isSuperAdmin()) {
            abort(403);
        }
        $overdue = \App\Models\Tugas::tugas()
            ->where('mata_pelajaran_id', $appeal->subject_id)
            ->where('deadline', '<', now())
            ->whereDoesntHave('submissions', function ($q) use ($appeal) {
                $q->where('siswa_id', $appeal->student_id);
            })
            ->orderBy('deadline', 'asc')
            ->get();

        return response()->json([
            'appeal' => $appeal->load(['student', 'subject']),
            'overdue' => $overdue
        ]);
    }

    /**
     * Determine if a user can process (approve/reject) an appeal.
     */
    private function evaluateAppealAuthority($user, \App\Models\Banding $appeal): array
    {
        if ($user->isSuperAdmin()) {
            return ['can_process' => true, 'role_type' => 'superadmin', 'reason' => null];
        }

        if (!$user->isTeacher()) {
            return ['can_process' => false, 'role_type' => 'unauthorized', 'reason' => 'Bukan guru atau admin.'];
        }

        $studentKelas = $appeal->student?->kelas ?? $appeal->student?->resolved_kelas;
        $kelas = $studentKelas ? \App\Models\Kelas::where('name', $studentKelas)->first() : null;

        // 1. Check if user is the assigned Subject Teacher for this class & subject
        $isSubjectTeacher = \App\Models\GuruKelas::where('guru_id', $user->teacher_id)
            ->where('mata_pelajaran_id', $appeal->mata_pelajaran_id)
            ->when($kelas, fn($q) => $q->where('kelas_id', $kelas->id))
            ->exists();

        if ($isSubjectTeacher) {
            return ['can_process' => true, 'role_type' => 'guru_mapel', 'reason' => null];
        }

        // 2. Check if user is the Homeroom Teacher (Wali Kelas) for this student's class
        $isHomeroomTeacher = ($kelas && $kelas->homeroom_teacher_id == $user->teacher_id);
        if ($isHomeroomTeacher) {
            // Check if appeal has been escalated to Wali Kelas (or Admin) OR is > 24 hours old OR teacher is inactive
            $isEscalated = $appeal->isEscalatedToWaliKelas();
            $isOldEnough = ($appeal->created_at && $appeal->created_at->diffInHours(now()) >= 24);
            
            // Check if assigned subject teacher is inactive
            $assignedTeacher = \App\Models\GuruKelas::where('mata_pelajaran_id', $appeal->mata_pelajaran_id)
                ->when($kelas, fn($q) => $q->where('kelas_id', $kelas->id))
                ->with('guru')
                ->first()?->guru;
            if (!$assignedTeacher) {
                $assignedTeacher = \App\Models\Guru::where('specialization_id', $appeal->mata_pelajaran_id)->first();
            }
            $isTeacherAbsent = ($assignedTeacher && $assignedTeacher->status !== 'active');

            if ($isEscalated || $isOldEnough || $isTeacherAbsent) {
                return ['can_process' => true, 'role_type' => 'wali_kelas', 'reason' => null];
            } else {
                return [
                    'can_process' => false,
                    'role_type' => 'wali_kelas_early',
                    'reason' => 'Permohonan banding ini masih dalam periode penanganan guru mata pelajaran (0-24 jam). Wali Kelas dapat memproses setelah eskalasi (24 jam) atau jika guru berhalangan.'
                ];
            }
        }

        return ['can_process' => false, 'role_type' => 'unauthorized', 'reason' => 'Anda tidak memiliki hak akses untuk memproses permohonan banding pada kelas/mata pelajaran ini.'];
    }

    /**
     * Approve an appeal and start recovery mode.
     */
    public function approve(Request $request, \App\Models\Banding $appeal)
    {
        Gate::authorize('approve_dispensasi');

        $user = auth()->user();
        $authResult = $this->evaluateAppealAuthority($user, $appeal);
        if (!$authResult['can_process']) {
            abort(403, $authResult['reason']);
        }

        $request->validate([
            'duration' => 'nullable|integer|min:1|max:720',
            'tanggapan_guru' => 'nullable|string|max:1000'
        ]);

        $duration = (int) $request->input('duration', 48);

        // Find the oldest overdue assignment
        $oldestOverdue = \App\Models\Tugas::tugas()
            ->where('mata_pelajaran_id', $appeal->subject_id)
            ->where('status', 'aktif')
            ->where('deadline', '<', now())
            ->whereDoesntHave('submissions', function ($q) use ($appeal) {
                $q->where('siswa_id', $appeal->student_id);
            })
            ->orderBy('deadline', 'asc')
            ->first();

        if (!$oldestOverdue) {
            return redirect()->back()->with('error', 'Siswa tidak memiliki tunggakan tugas.');
        }

        $recoveryType = 'normal';
        $reasonNote = null;
        if ($authResult['role_type'] === 'wali_kelas') {
            $recoveryType = 'emergency_override';
            $reasonNote = 'Disetujui oleh Wali Kelas (Eskalasi Darurat)';
        } elseif ($authResult['role_type'] === 'superadmin') {
            $recoveryType = 'emergency_override';
            $reasonNote = 'Disetujui oleh Super Admin (Master Override)';
        }

        // Start / Update Recovery Session
        \App\Models\PemulihanPengumpulan::updateOrCreate(
            [
                'siswa_id' => $appeal->student_id,
                'mata_pelajaran_id' => $appeal->subject_id,
            ],
            [
                'status_pemulihan' => 'aktif',
                'tipe_pemulihan' => $recoveryType,
                'durasi_jam' => (int)$duration,
                'tugas_id' => $oldestOverdue->id,
                'mulai_pemulihan' => now(),
                'batas_pemulihan' => now()->addHours((int)$duration),
                'selesai_pemulihan' => null,
                'dibuka_oleh' => $user->id,
                'alasan_darurat' => $reasonNote,
            ]
        );

        $appeal->update([
            'status' => 'approved',
            'approved_by' => $user->id,
            'approved_at' => now(),
            'tanggapan_guru' => $request->tanggapan_guru,
        ]);

        if ($authResult['role_type'] === 'wali_kelas' || $authResult['role_type'] === 'superadmin') {
            \App\Models\ActivityLog::logEmergency(
                'EMERGENCY_OVERRIDE',
                "Menyetujui banding dispensasi sebagai {$authResult['role_type']} untuk siswa ID {$appeal->student_id} pada mata pelajaran ID {$appeal->mata_pelajaran_id}",
                [
                    'aktor' => $user->nama ?? $user->name,
                    'role' => $authResult['role_type'],
                    'siswa_id' => $appeal->student_id,
                    'mata_pelajaran_id' => $appeal->mata_pelajaran_id,
                    'durasi_jam' => $duration,
                    'catatan' => $reasonNote,
                ]
            );
        } else {
            \App\Models\ActivityLog::log('APPEAL', 'Menyetujui banding dispensasi untuk siswa ID ' . $appeal->student_id . ' pada mata pelajaran ID ' . $appeal->mata_pelajaran_id);
        }

        return redirect()->back()->with('success', 'Banding disetujui dan Mode Pemulihan diaktifkan.');
    }

    /**
     * Show locking history / Audit.
     */
    public function lockingHistory(Request $request)
    {
        Gate::authorize('view_dispensasi');

        $user = auth()->user();
        
        // Find students who currently have overdue assignments (locked)
        $query = \App\Models\Tugas::tugas()
            ->where('deadline', '<', now())
            ->where('status', 'aktif')
            ->whereDoesntHave('submissions');

        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $guru = $user->guru;
            $homeroomClass = \App\Models\Kelas::where('homeroom_teacher_id', $user->teacher_id)->first();

            if ($user->isHomeroomTeacher() && $homeroomClass) {
                // Homeroom teacher can view locking history for homeroom students across subjects
                $query->where(function($q) use ($guru, $homeroomClass) {
                    $q->whereIn('mata_pelajaran_id', $guru->getSubjectIdsTaught())
                      ->orWhere('kelas_id', $homeroomClass->id);
                });
            } else {
                // Regular teacher is restricted to their taught subjects/classes
                $query->whereIn('mata_pelajaran_id', $guru->getSubjectIdsTaught());
            }
        }

        $lockedAssignments = $query->with(['subject'])
            ->latest('deadline')
            ->paginate(15);

        return view('banding.locking_history', compact('lockedAssignments'));
    }

    public function reject(Request $request, \App\Models\Banding $appeal)
    {
        Gate::authorize('approve_dispensasi');

        $user = auth()->user();
        $authResult = $this->evaluateAppealAuthority($user, $appeal);
        if (!$authResult['can_process']) {
            abort(403, $authResult['reason']);
        }

        $request->validate([
            'tanggapan_guru' => 'nullable|string|max:1000'
        ]);

        $appeal->update([
            'status' => 'rejected',
            'approved_by' => $user->id,
            'approved_at' => now(),
            'tanggapan_guru' => $request->tanggapan_guru,
        ]);

        // Terminate any active provisional recovery session for this subject
        \App\Models\PemulihanPengumpulan::where('siswa_id', $appeal->siswa_id)
            ->where('mata_pelajaran_id', $appeal->mata_pelajaran_id)
            ->where('status_pemulihan', 'aktif')
            ->where('tipe_pemulihan', 'provisional')
            ->update(['status_pemulihan' => 'expired']);

        if ($authResult['role_type'] === 'wali_kelas' || $authResult['role_type'] === 'superadmin') {
            \App\Models\ActivityLog::logEmergency(
                'EMERGENCY_OVERRIDE',
                "Menolak banding dispensasi sebagai {$authResult['role_type']} untuk siswa ID {$appeal->student_id} pada mata pelajaran ID {$appeal->mata_pelajaran_id}",
                [
                    'aktor' => $user->nama ?? $user->name,
                    'role' => $authResult['role_type'],
                    'siswa_id' => $appeal->student_id,
                    'mata_pelajaran_id' => $appeal->mata_pelajaran_id,
                    'tanggapan' => $request->tanggapan_guru,
                ]
            );
        } else {
            \App\Models\ActivityLog::log('APPEAL', 'Menolak banding dispensasi untuk siswa ID ' . $appeal->student_id . ' pada mata pelajaran ID ' . $appeal->mata_pelajaran_id);
        }

        return redirect()->back()->with('success', 'Permohonan banding ditolak.');
    }

    /**
     * Mass Emergency Release by Super Admin.
     */
    public function massEmergencyRelease(Request $request)
    {
        Gate::authorize('manage_settings');

        $user = auth()->user();
        if (!$user->isSuperAdmin()) {
            abort(403, 'Hanya Super Admin yang dapat melakukan Pelepasan Darurat Massal.');
        }

        $request->validate([
            'target_type' => 'required|in:all,kelas,tingkat,subject',
            'target_id' => 'nullable|string',
            'duration' => 'required|integer|min:1|max:168',
            'alasan_darurat' => 'required|string|min:5|max:1000',
        ]);

        $duration = (int) $request->duration;
        $reason = $request->alasan_darurat;

        // Query students based on target filter
        $studentsQuery = \App\Models\Siswa::where('status', 'aktif');

        if ($request->target_type === 'kelas' && !empty($request->target_id)) {
            $studentsQuery->where('kelas', $request->target_id);
        } elseif ($request->target_type === 'tingkat' && !empty($request->target_id)) {
            $tingkat = $request->target_id;
            $studentsQuery->where('kelas', 'like', $tingkat . ' %');
        }

        $students = $studentsQuery->get();
        $releasedCount = 0;
        $adaptiveService = app(\App\Services\AdaptiveAccessService::class);

        foreach ($students as $student) {
            // Find all subjects for evaluation
            $subjectsQuery = \App\Models\JadwalPelajaran::query();
            if ($request->target_type === 'subject' && !empty($request->target_id)) {
                $subjectsQuery->where('id', $request->target_id);
            }

            $subjects = $subjectsQuery->get();

            foreach ($subjects as $sub) {
                $accessResult = $adaptiveService->evaluateSubjectAccess($student, $sub);
                if ($accessResult->isLocked()) {
                    $oldestOverdue = $adaptiveService->getOverdueTasksQuery($student, $sub->id)
                        ->orderBy('deadline', 'asc')
                        ->first();

                    if ($oldestOverdue) {
                        \App\Models\PemulihanPengumpulan::updateOrCreate(
                            [
                                'siswa_id' => $student->id,
                                'mata_pelajaran_id' => $sub->id,
                            ],
                            [
                                'status_pemulihan' => 'aktif',
                                'tipe_pemulihan' => 'emergency_override',
                                'durasi_jam' => $duration,
                                'tugas_id' => $oldestOverdue->id,
                                'mulai_pemulihan' => now(),
                                'batas_pemulihan' => now()->addHours($duration),
                                'selesai_pemulihan' => null,
                                'dibuka_oleh' => $user->id,
                                'alasan_darurat' => $reason,
                            ]
                        );
                        $releasedCount++;
                    }
                }
            }
        }

        \App\Models\ActivityLog::logEmergency(
            'MASS_EMERGENCY_RELEASE',
            "Super Admin merilis kunci pengumpulan darurat massal untuk {$releasedCount} sesi siswa.",
            [
                'target_type' => $request->target_type,
                'target_id' => $request->target_id,
                'durasi_jam' => $duration,
                'alasan' => $reason,
                'user_id' => $user->id,
            ]
        );

        return redirect()->back()->with('success', "Pelepasan darurat massal berhasil diterapkan pada {$releasedCount} sesi pemulihan siswa.");
    }

    /**
     * Display the student appeals tracking page.
     */
    public function studentAppeals(Request $request)
    {
        $user = auth()->user();
        if (!$user->isStudent()) {
            abort(403, 'Akses khusus untuk siswa.');
        }

        $student = $user->student;
        if (!$student) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $appeals = \App\Models\Banding::with(['subject', 'assignment'])
            ->where('siswa_id', $student->id)
            ->latest()
            ->get();

        // Calculate counts
        $pendingCount = $appeals->whereIn('status', ['pending', 'ditinjau'])->count();
        $approvedCount = $appeals->whereIn('status', ['approved', 'diterima'])->count();
        $rejectedCount = $appeals->whereIn('status', ['rejected', 'ditolak'])->count();

        // Map teacher names to appeals
        foreach ($appeals as $appeal) {
            $teacherName = 'Guru Mata Pelajaran';
            if ($appeal->disetujui_oleh) {
                $approver = \App\Models\User::find($appeal->disetujui_oleh);
                if ($approver && $approver->isTeacher() && $approver->guru) {
                    $teacherName = $approver->guru->nama;
                }
            } else {
                $teacher = null;
                $activeTeachers = \App\Models\Guru::active()->get();
                foreach ($activeTeachers as $t) {
                    if (in_array($appeal->mata_pelajaran_id, $t->getSubjectIdsTaught())) {
                        $teacher = $t;
                        break;
                    }
                }
                if ($teacher) {
                    $teacherName = $teacher->nama;
                }
            }
            $appeal->teacher_name = $teacherName;
        }

        return view('banding.student_index', compact('appeals', 'pendingCount', 'approvedCount', 'rejectedCount', 'student'));
    }

    /**
     * Cancel/delete a pending appeal.
     */
    public function cancelAppeal(\App\Models\Banding $appeal)
    {
        $user = auth()->user();
        if (!$user->isStudent()) abort(403);

        $student = $user->student;
        if (!$student || $appeal->siswa_id !== $student->id) {
            abort(403, 'Anda tidak berwenang membatalkan pengajuan ini.');
        }

        // Only pending appeals can be cancelled
        if (!in_array($appeal->status, ['pending', 'ditinjau'])) {
            return redirect()->back()->with('error', 'Hanya pengajuan yang sedang ditinjau yang dapat dibatalkan.');
        }

        $mapelId = $appeal->mata_pelajaran_id;

        $appeal->delete();

        \App\Models\ActivityLog::log('APPEAL', 'Membatalkan pengajuan banding dispensasi untuk mata pelajaran ID ' . $mapelId);

        return redirect()->back()->with('success', 'Permohonan banding berhasil dibatalkan.');
    }
}
