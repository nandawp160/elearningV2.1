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
            'bukti_pendukung' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
        ]);

        $student = $user->student;
        if (!$student || !$student->kelas) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar di kelas manapun.');
        }

        // Check for existing pending appeal for this subject
        $exists = \App\Models\Banding::where('siswa_id', $user->student_id)
            ->where('mata_pelajaran_id', $request->subject_id)
            ->where('status', 'pending')
            ->exists();

        if ($exists) {
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

        if (!$user->isTeacher() && !$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403);
        }

        // Jika class_id tidak ada, tampilkan halaman Daftar Kelas (Mockup 1)
        if (!$request->has('class_id') || empty($request->class_id)) {
            $classData = collect();

            if ($user->isTeacher()) {
                $guru = $user->guru;
                if ($guru) {
                    foreach ($guru->kelasDiampu as $kelas) {
                        $resolvedSubject = $guru->getSubjectForClass($kelas);
                        $subjectId = $resolvedSubject ? $resolvedSubject->id : $guru->specialization_id;
                        $subjectName = $resolvedSubject ? $resolvedSubject->nama : ($guru->mataPelajaran->nama ?? 'Tidak Ada Spesialisasi');

                        // Hitung jumlah siswa aktif di kelas ini
                        $studentCount = \App\Models\Siswa::where('kelas', $kelas->name)->where('status', 'aktif')->count();
                        
                        // Hitung antrean permohonan baru (status = 'ditinjau' / pending)
                        $pendingCount = \App\Models\Banding::where('status', 'ditinjau')
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
                        ]);
                    }
                }
            } else {
                // Admin/Super Admin: Tampilkan semua kelas
                $classrooms = \App\Models\Kelas::all();
                foreach ($classrooms as $kelas) {
                    $studentCount = \App\Models\Siswa::where('kelas', $kelas->name)->where('status', 'aktif')->count();
                    $pendingCount = \App\Models\Banding::where('status', 'ditinjau')
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

        $query = \App\Models\Banding::with(['student', 'subject'])
            ->whereHas('student', function($q) use ($classId) {
                $q->where('kelas', $classId);
            });

        if ($user->isTeacher()) {
            // Filter by the resolved subject ID for this classroom
            $resolvedSubject = $user->guru->getSubjectForClass($classroom);
            if ($resolvedSubject) {
                $query->where('mata_pelajaran_id', $resolvedSubject->id);
            } else {
                $query->where('mata_pelajaran_id', $user->guru->specialization_id);
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
        $pendingCount = $allClassAppeals->where('status', 'pending')->count(); 
        $approvedCount = $allClassAppeals->where('status', 'approved')->count(); 
        $rejectedCount = $allClassAppeals->where('status', 'rejected')->count(); 

        $appeals = $query->latest()->paginate(15);

        // Subject name for header
        $subjectName = 'Semua Pelajaran';
        if ($user->isTeacher() && $user->guru) {
            $resolvedSubject = $user->guru->getSubjectForClass($classroom);
            $subjectName = $resolvedSubject ? $resolvedSubject->nama : ($user->guru->mataPelajaran->nama ?? '-');
        }

        return view('banding.classroom_appeals', compact(
            'appeals', 'classroom', 'classId', 'pendingCount', 'approvedCount', 'rejectedCount', 'subjectName'
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

        if ($user->isTeacher()) {
            $kelasDiampuNames = $user->guru ? $user->guru->kelasDiampu()->pluck('kelas.name')->toArray() : [];
            // TODO: Pada refactor versi berikutnya, kolom siswa.kelas sebaiknya diganti menjadi foreign key kelas_id.
            $query->whereHas('student', function($q) use ($kelasDiampuNames) {
                $q->whereIn('kelas', $kelasDiampuNames);
            });
        } elseif (!$user->isSuperAdmin() && !$user->isAdmin()) {
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
        if ($user->isTeacher()) {
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
     * Approve an appeal and start recovery mode.
     */
    public function approve(Request $request, \App\Models\Banding $appeal)
    {
        Gate::authorize('approve_dispensasi');

        $user = auth()->user();
        if (!$user->isTeacher() && !$user->isSuperAdmin() && !$user->isAdmin()) abort(403);

        $request->validate([
            'duration' => 'nullable|in:24,48,72',
            'tanggapan_guru' => 'nullable|string|max:1000'
        ]);

        $duration = $request->input('duration', 48);

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

        // Start Recovery Session
        \App\Models\PemulihanPengumpulan::updateOrCreate(
            [
                'siswa_id' => $appeal->student_id,
                'mata_pelajaran_id' => $appeal->subject_id,
            ],
            [
                'status_pemulihan' => 'aktif',
                'durasi_jam' => (int)$duration,
                'tugas_id' => $oldestOverdue->id,
                'mulai_pemulihan' => now(),
                'batas_pemulihan' => now()->addHours((int)$duration),
                'selesai_pemulihan' => null,
            ]
        );

        $appeal->update([
            'status' => 'approved',
            'approved_by' => $user->id,
            'approved_at' => now(),
            'tanggapan_guru' => $request->tanggapan_guru,
        ]);

        \App\Models\ActivityLog::log('APPEAL', 'Menyetujui banding dispensasi untuk siswa ID ' . $appeal->student_id . ' pada mata pelajaran ID ' . $appeal->mata_pelajaran_id);

        return redirect()->back()->with('success', 'Banding disetujui dan Recovery Mode diaktifkan.');
    }

    /**
     * Reject an appeal.
     */
    /**
     * Show locking history / Audit.
     */
    public function lockingHistory(Request $request)
    {
        Gate::authorize('view_dispensasi');

        $user = auth()->user();
        
        // Find students who currently have overdue assignments (locked)
        // This is an audit view.
        $query = \App\Models\Tugas::tugas()
            ->where('deadline', '<', now())
            ->where('status', 'aktif')
            ->whereDoesntHave('submissions');

        if ($user->isTeacher() && $user->guru) {
            $query->whereIn('mata_pelajaran_id', $user->guru->getSubjectIdsTaught());
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
        if (!$user->isTeacher() && !$user->isSuperAdmin() && !$user->isAdmin()) abort(403);

        $request->validate([
            'tanggapan_guru' => 'nullable|string|max:1000'
        ]);

        $appeal->update([
            'status' => 'rejected',
            'approved_by' => $user->id,
            'approved_at' => now(),
            'tanggapan_guru' => $request->tanggapan_guru,
        ]);

        \App\Models\ActivityLog::log('APPEAL', 'Menolak banding dispensasi untuk siswa ID ' . $appeal->student_id . ' pada mata pelajaran ID ' . $appeal->mata_pelajaran_id);

        return redirect()->back()->with('success', 'Permohonan banding ditolak.');
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
