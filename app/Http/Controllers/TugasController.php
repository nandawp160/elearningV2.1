<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Materi;
use App\Models\JadwalPelajaran;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class TugasController extends Controller
{
    public function index()
    {
        Gate::authorize('view_tugas');

        $user = auth()->user();

        // ── STUDENT: Redirect to grouped subject listing ──
        if ($user->isStudent()) {
            return $this->studentIndex();
        }

        // ── TEACHER: Redirect to teacher subject listing ──
        if ($user->isTeacher()) {
            return $this->teacherIndex();
        }

        // 🚨 SUPER ADMIN: Original flat list 🚨
        $query = Tugas::tugas()->with(['subject.course', 'subject.classRoom', 'creator', 'submissions'])
            ->where(function($q) {
                $q->whereHas('kelas')->orWhereNull('kelas_id');
            });
        $assignments = $query->latest()->get();
        $tunggakanList = collect();
        $subjects = JadwalPelajaran::with(['course', 'classRoom'])->get();

        return view('tugas.index', compact('assignments', 'subjects', 'tunggakanList'));
    }

    /**
     * Teacher Index — Halaman 1: Daftar Pengampuan
     */
    private function teacherIndex()
    {
        $user   = auth()->user();
        $teacher = $user->teacher;

        $guru = $user->guru;
        $subjectData = collect();

        if ($guru) {
            $now = Carbon::now();
            $kelasDiampu = $guru->kelasDiampu()->with('homeroomTeacher')->get();
            $kelasNames = $kelasDiampu->pluck('name')->filter()->unique()->toArray();
            $kelasIds = $kelasDiampu->pluck('id')->filter()->unique()->toArray();

            // 1. Batch fetch student counts (1 query)
            $studentCounts = \App\Models\Siswa::whereIn('kelas', $kelasNames)
                ->where('status', 'aktif')
                ->selectRaw('kelas, count(*) as total')
                ->groupBy('kelas')
                ->pluck('total', 'kelas')
                ->toArray();

            // 2. Batch fetch assignments for this teacher's classes (1 query)
            $allAssignments = Tugas::tugas()
                ->where(function($q) use ($kelasIds) {
                    $q->whereIn('kelas_id', $kelasIds)->orWhereNull('kelas_id');
                })
                ->where('guru_id', $guru->id)
                ->get(['id', 'mata_pelajaran_id', 'kelas_id', 'status', 'deadline']);

            $assignmentIds = $allAssignments->pluck('id')->toArray();

            // 3. Batch fetch submission counts (1 query)
            $submissionCounts = \App\Models\Pengumpulan::whereIn('tugas_id', $assignmentIds)
                ->selectRaw('tugas_id, count(*) as total')
                ->groupBy('tugas_id')
                ->pluck('total', 'tugas_id')
                ->toArray();

            foreach ($kelasDiampu as $kelas) {
                $resolvedSubject = $guru->getSubjectForClass($kelas);
                if (!$resolvedSubject) {
                    continue;
                }

                $cloned = clone $resolvedSubject;
                $cloned->setRelation('classRoom', $kelas);

                $assignments = $allAssignments->filter(function($a) use ($kelas, $cloned) {
                    return ($a->kelas_id == $kelas->id || is_null($a->kelas_id)) && $a->mata_pelajaran_id == $cloned->id;
                });

                $totalAssignments = $assignments->count();
                $activeCount = $assignments->where('status', 'active')
                                            ->filter(fn($a) => !Carbon::parse($a->deadline)->isPast())
                                            ->count();
                $overdueCount = $assignments->where('status', 'active')
                                            ->filter(fn($a) => Carbon::parse($a->deadline)->isPast())
                                            ->count();
                $studentCount = $studentCounts[$kelas->name] ?? 0;
                $totalSlots = $totalAssignments * $studentCount;

                $submittedCount = $assignments->sum(function($a) use ($submissionCounts) {
                    return $submissionCounts[$a->id] ?? 0;
                });

                $subjectData->push([
                    'subject_id'        => $cloned->id,
                    'course_name'       => $cloned->nama,
                    'class_name'        => $kelas->name,
                    'teacher_name'      => $teacher->name ?? $guru->nama,
                    'academic_year'     => $kelas->academic_year ?? '-',
                    'total_assignments' => $totalAssignments,
                    'active_count'      => $activeCount,
                    'overdue_count'     => $overdueCount,
                    'submitted_count'   => $submittedCount,
                    'total_slots'       => $totalSlots,
                    'student_count'     => $studentCount,
                ]);
            }
            $subjectData = $subjectData->sortBy(function($s) {
                $name = $s['class_name'] ?? '';
                $name = preg_replace('/\bXII\b/', '12', $name);
                $name = preg_replace('/\bXI\b/', '11', $name);
                $name = preg_replace('/\bX\b/', '10', $name);
                $name = preg_replace('/\bIX\b/', '09', $name);
                $name = preg_replace('/\bVIII\b/', '08', $name);
                $name = preg_replace('/\bVII\b/', '07', $name);
                return $name;
            }, SORT_NATURAL)->values();
        }

        // Unique lists for filter dropdowns
        $courseNames = $subjectData->pluck('course_name')->unique()->sort()->values();
        $classNames  = $subjectData->pluck('class_name')->unique()->sort()->values();

        return view('tugas.teacher_index', compact('subjectData', 'courseNames', 'classNames', 'teacher'));
    }

    /**
     * Teacher Detail — Halaman 2: Daftar Tugas per Pengampuan
     */
    public function teacherDetail(JadwalPelajaran $subject)
    {
        Gate::authorize('view_tugas');

        $user = auth()->user();

        if (!$user->isTeacher() && !$user->isSuperAdmin()) {
            abort(403);
        }

        $className = request('class_name');
        if (!$className && $user->isTeacher() && $user->guru) {
            $firstKelas = $user->guru->kelasDiampu()->first();
            if ($firstKelas) {
                $className = $firstKelas->name;
            }
        }

        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $guru = $user->guru;
            if (!$guru) abort(403);
            $kelasTarget = $className ? Kelas::where('name', $className)->first() : null;
            $isAssigned = \App\Models\GuruKelas::where('guru_id', $guru->id)
                ->where('mata_pelajaran_id', $subject->id)
                ->when($kelasTarget, fn($q) => $q->where('kelas_id', $kelasTarget->id))
                ->exists();
            if (!$isAssigned) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan pada kelas/mata pelajaran ini.');
            }
        }

        $targetClass = null;
        if ($className) {
            $targetClass = Kelas::where('name', $className)->first();
            if ($targetClass) {
                $subject = clone $subject;
                $subject->setRelation('classRoom', $targetClass);
            }
        } else {
            $targetClass = $subject->classRoom;
        }

        $subject->load(['course']);

        $query = Tugas::tugas()->with(['submissions'])
            ->where('mata_pelajaran_id', $subject->id);
            
        if ($targetClass) {
            $query->where(function($q) use ($targetClass) {
                $q->where('kelas_id', $targetClass->id)->orWhereNull('kelas_id');
            });
        }
            
        $assignments = $query->orderBy('deadline', 'desc')->get();

        $studentCount = $targetClass ? \App\Models\Siswa::where('kelas', $targetClass->name)->where('status', 'aktif')->count() : 0;
        $now          = Carbon::now();

        // Build subjects list for the create modal
        if ($user->isTeacher()) {
            $guru = $user->guru;
            $subjects = collect();
            if ($guru) {
                foreach ($guru->kelasDiampu as $kItem) {
                    $resolvedSubject = $guru->getSubjectForClass($kItem);
                    if ($resolvedSubject) {
                        $cloned = clone $resolvedSubject;
                        $cloned->setRelation('classRoom', $kItem);
                        $subjects->push($cloned);
                    }
                }
            }
        } else {
            $subjects = JadwalPelajaran::with(['course', 'classRoom'])->get();
        }

        // Calculate Workspace Metrics
        $totalTugas = $assignments->count();
        $totalSlots = $totalTugas * $studentCount;
        $totalSubmissions = 0;
        $perluDinilai = 0;

        foreach ($assignments as $a) {
            foreach ($a->submissions as $sub) {
                // Pastikan yang dihitung adalah yang sudah dikumpulkan (bukan status 'pending' / 'belum')
                if (in_array($sub->status, ['submitted', 'late', 'terkumpul', 'terlambat', 'graded'])) {
                    $totalSubmissions++;
                    if (!$sub->is_graded) {
                        $perluDinilai++;
                    }
                }
            }
        }

        // SSL Threshold Resolution for Current Class & Teacher
        $currentGuruKelas = null;
        $allTaughtClasses = collect();
        if ($user->isTeacher() && $user->guru) {
            $currentGuruKelas = \App\Models\GuruKelas::where('guru_id', $user->guru->id)
                ->where('mata_pelajaran_id', $subject->id)
                ->when($targetClass, fn($q) => $q->where('kelas_id', $targetClass->id))
                ->first();

            $allTaughtClasses = \App\Models\GuruKelas::with('kelas')
                ->where('guru_id', $user->guru->id)
                ->where('mata_pelajaran_id', $subject->id)
                ->whereHas('kelas')
                ->get()
                ->unique('kelas_id')
                ->values();
        }

        $schoolDefaultRaw = \App\Models\Pengaturan::getValue('ssl_threshold')
            ?? \Illuminate\Support\Facades\DB::table('settings')->where('key', 'ssl_threshold')->value('value');
        $schoolDefaultSsl = ($schoolDefaultRaw !== null && is_numeric($schoolDefaultRaw))
            ? (int) $schoolDefaultRaw
            : (int) config('ssl.system_default', 3);

        $teacherOverrideSsl = $currentGuruKelas?->ssl_threshold;
        $effectiveSslThreshold = ($teacherOverrideSsl !== null) ? (int) $teacherOverrideSsl : $schoolDefaultSsl;
        $sslThresholdSource = ($teacherOverrideSsl !== null) ? 'TEACHER_OVERRIDE' : 'SCHOOL_DEFAULT';

        return view('tugas.teacher_detail', compact(
            'subject', 'assignments', 'studentCount', 'now', 'subjects',
            'totalTugas', 'totalSlots', 'totalSubmissions', 'perluDinilai',
            'currentGuruKelas', 'allTaughtClasses', 'schoolDefaultSsl',
            'effectiveSslThreshold', 'sslThresholdSource', 'teacherOverrideSsl'
        ));
    }

    /**
     * Teacher Recap — Halaman Rekap Nilai Kelas (Buku Nilai)
     */
    public function rekapNilai(JadwalPelajaran $subject)
    {
        Gate::authorize('view_tugas');

        $user = auth()->user();

        if (!$user->isTeacher() && !$user->isSuperAdmin()) {
            abort(403);
        }

        $className = request('class_name');
        if (!$className && $user->isTeacher() && $user->guru) {
            $firstKelas = $user->guru->kelasDiampu()->first();
            if ($firstKelas) {
                $className = $firstKelas->name;
            }
        }

        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $guru = $user->guru;
            if (!$guru) abort(403);
            $kelasTarget = $className ? Kelas::where('name', $className)->first() : null;
            $isAssigned = \App\Models\GuruKelas::where('guru_id', $guru->id)
                ->where('mata_pelajaran_id', $subject->id)
                ->when($kelasTarget, fn($q) => $q->where('kelas_id', $kelasTarget->id))
                ->exists();
            if (!$isAssigned) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan pada kelas/mata pelajaran ini.');
            }
        }

        if ($className) {
            $kelas = \App\Models\Kelas::where('name', $className)->first();
            if ($kelas) {
                $subject = clone $subject;
                $subject->setRelation('classRoom', $kelas);
            }
        }

        $subject->load(['course']);

        if (!$subject->classRoom) {
            abort(404, 'Kelas tidak ditemukan.');
        }

        // Get all active assignments for this subject
        $query = Tugas::tugas()
            ->where('mata_pelajaran_id', $subject->id);
            
        if (isset($kelas) && $kelas) {
            $query->where(function($q) use ($kelas) {
                $q->where('kelas_id', $kelas->id)->orWhereNull('kelas_id');
            });
        }
            
        $assignments = $query->orderBy('created_at', 'asc')->get();

        // Get all active students in this class
        $students = \App\Models\Siswa::withoutGlobalScope('teacher_access')
            ->where('kelas', $subject->classRoom->name)
            ->where('status', 'aktif')
            ->orderBy('nama', 'asc')
            ->get();

        // Load grades for these students and assignments
        $assignmentIds = $assignments->pluck('id');
        $studentIds = $students->pluck('id');
        
        // Assuming Nilai table is used for grades as implemented earlier
        // Wait, Nilai has submission_id, not assignment_id directly, but it has subject_id, student_id, type.
        // It's better to fetch submissions with grades.
        $submissions = \App\Models\Pengumpulan::with('grade')
            ->whereIn('tugas_id', $assignmentIds)
            ->whereIn('siswa_id', $studentIds)
            ->get()
            ->groupBy('siswa_id');

        // Build the matrix
        $rekap = collect();
        foreach ($students as $student) {
            $studentSubmissions = $submissions->get($student->id, collect())->keyBy('tugas_id');
            $grades = [];
            $totalScore = 0;
            $gradedCount = 0;

            foreach ($assignments as $assignment) {
                $submission = $studentSubmissions->get($assignment->id);
                $score = null;
                if ($submission && $submission->grade) {
                    $score = (float) $submission->grade->score;
                    $totalScore += $score;
                    $gradedCount++;
                }
                $grades[$assignment->id] = $score;
            }

            $average = $gradedCount > 0 ? round($totalScore / $gradedCount, 2) : null;

            $rekap->push([
                'student' => $student,
                'grades' => $grades,
                'average' => $average
            ]);
        }

        return view('tugas.rekap_nilai', compact('subject', 'assignments', 'rekap'));
    }

    /**
     * Export Rekap Nilai ke Excel
     */
    public function exportRekapNilai(JadwalPelajaran $subject)
    {
        Gate::authorize('view_tugas');

        $user = auth()->user();

        if (!$user->isTeacher() && !$user->isSuperAdmin()) {
            abort(403);
        }

        $className = request('class_name');
        if (!$className && $user->isTeacher() && $user->guru) {
            $firstKelas = $user->guru->kelasDiampu()->first();
            if ($firstKelas) {
                $className = $firstKelas->name;
            }
        }

        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $guru = $user->guru;
            if (!$guru) abort(403);
            $kelasTarget = $className ? Kelas::where('name', $className)->first() : null;
            $isAssigned = \App\Models\GuruKelas::where('guru_id', $guru->id)
                ->where('mata_pelajaran_id', $subject->id)
                ->when($kelasTarget, fn($q) => $q->where('kelas_id', $kelasTarget->id))
                ->exists();
            if (!$isAssigned) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan pada kelas/mata pelajaran ini.');
            }
        }

        if ($className) {
            $kelas = \App\Models\Kelas::where('name', $className)->first();
            if ($kelas) {
                $subject = clone $subject;
                $subject->setRelation('classRoom', $kelas);
            }
        }

        $subject->load(['course']);

        if (!$subject->classRoom) {
            abort(404, 'Kelas tidak ditemukan.');
        }

        // Get all active assignments for this subject
        $query = Tugas::tugas()
            ->where('mata_pelajaran_id', $subject->id);
            
        if (isset($kelas) && $kelas) {
            $query->where(function($q) use ($kelas) {
                $q->where('kelas_id', $kelas->id)->orWhereNull('kelas_id');
            });
        }
            
        $assignments = $query->orderBy('created_at', 'asc')->get();

        // Get all active students in this class
        $students = \App\Models\Siswa::withoutGlobalScope('teacher_access')
            ->where('kelas', $subject->classRoom->name)
            ->where('status', 'aktif')
            ->orderBy('nama', 'asc')
            ->get();

        $assignmentIds = $assignments->pluck('id');
        $studentIds = $students->pluck('id');
        
        $submissions = \App\Models\Pengumpulan::with('grade')
            ->whereIn('tugas_id', $assignmentIds)
            ->whereIn('siswa_id', $studentIds)
            ->get()
            ->groupBy('siswa_id');

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header Tabel
        $headers = ["NO", "NIS", "NAMA SISWA"];
        foreach ($assignments as $assignment) {
            $headers[] = strtoupper($assignment->judul);
        }
        $headers[] = "RATA-RATA";

        // Judul Laporan & Metadata (Kop Surat Resmi)
        $highestColumnLetter = chr(65 + count($headers) - 1);
        
        $sheet->setCellValue('A1', 'PEMERINTAH PROVINSI JAWA TENGAH');
        $sheet->mergeCells("A1:{$highestColumnLetter}1");
        $sheet->getStyle('A1')->getFont()->setName('Arial')->setSize(11)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $sheet->setCellValue('A2', 'DINAS PENDIDIKAN DAN KEBUDAYAAN');
        $sheet->mergeCells("A2:{$highestColumnLetter}2");
        $sheet->getStyle('A2')->getFont()->setName('Arial')->setSize(11)->setBold(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'SMA NEGERI 1 CEPOGO');
        $sheet->mergeCells("A3:{$highestColumnLetter}3");
        $sheet->getStyle('A3')->getFont()->setName('Arial')->setSize(14)->setBold(true);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A4', 'Kecamatan Kec. Cepogo, Kabupaten Kab. Boyolali, Provinsi Prov. Jawa Tengah');
        $sheet->mergeCells("A4:{$highestColumnLetter}4");
        $sheet->getStyle('A4')->getFont()->setName('Arial')->setSize(9)->setItalic(true);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Double line border under Kop
        $sheet->getStyle("A4:{$highestColumnLetter}4")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE);

        // Title Laporan
        $sheet->setCellValue('A6', 'LAPORAN REKAPITULASI NILAI TUGAS');
        $sheet->mergeCells("A6:{$highestColumnLetter}6");
        $sheet->getStyle('A6')->getFont()->setName('Arial')->setSize(12)->setBold(true);
        $sheet->getStyle('A6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Metadata
        $teacherName = $subject->teacher->nama ?? $subject->teacher->name ?? '-';
        $metaText = 'Mata Pelajaran: ' . $subject->course->nama . ' | Kelas: ' . $subject->classRoom->name . ' | Guru: ' . $teacherName . ' | TA: ' . ($subject->academic_year ?? '2026/2027');
        $sheet->setCellValue('A7', $metaText);
        $sheet->mergeCells("A7:{$highestColumnLetter}7");
        $sheet->getStyle('A7')->getFont()->setName('Arial')->setSize(10)->setItalic(true);
        $sheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Header Tabel di Baris 9
        $sheet->fromArray($headers, null, 'A9');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'name' => 'Arial', 'size' => 10],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D65A20']],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => 'B54A18']]]
        ];
        $sheet->getStyle("A9:{$highestColumnLetter}9")->applyFromArray($headerStyle);
        $sheet->getRowDimension(9)->setRowHeight(25);

        // Isi Data di Baris 10
        $row = 10;
        $idx = 1;
        foreach ($students as $student) {
            $studentSubmissions = $submissions->get($student->id, collect())->keyBy('tugas_id');
            $rowData = [$idx++, $student->nis, $student->nama];
            
            $totalScore = 0;
            $gradedCount = 0;

            foreach ($assignments as $assignment) {
                $submission = $studentSubmissions->get($assignment->id);
                $score = null;
                if ($submission && $submission->grade) {
                    $score = (float) $submission->grade->score;
                    $totalScore += $score;
                    $gradedCount++;
                }
                $rowData[] = $score !== null ? $score : '-';
            }

            $average = $gradedCount > 0 ? round($totalScore / $gradedCount, 2) : 0;
            $rowData[] = $average;

            $sheet->fromArray($rowData, null, "A{$row}");

            $rowStyle = [
                'font' => ['name' => 'Arial', 'size' => 10],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => 'E2E8F0']]],
                'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
            ];
            $sheet->getStyle("A{$row}:{$highestColumnLetter}{$row}")->applyFromArray($rowStyle);

            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            // Format numbers to center
            for ($i = 3; $i < count($headers); $i++) {
                $colLetter = chr(65 + $i);
                $sheet->getStyle("{$colLetter}{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }

            if ($row % 2 !== 0) {
                $sheet->getStyle("A{$row}:{$highestColumnLetter}{$row}")->getFill()->applyFromArray([
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8FAFC']
                ]);
            }
            $row++;
        }

        // Auto-fit columns
        for ($i = 0; $i < count($headers); $i++) {
            $colLetter = chr(65 + $i);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        $filename = "rekap_nilai_" . strtolower(str_replace(' ', '_', $subject->course->nama)) . "_" . strtolower(str_replace(' ', '_', $subject->classRoom->name)) . "_" . date('Ymd_His') . ".xlsx";

        $headersResponse = [
            "Content-Type"        => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        if (ob_get_length()) {
            ob_end_clean();
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $callback = function() use ($writer) {
            $writer->save('php://output');
        };

        return response()->stream($callback, 200, $headersResponse);
    }

    /**
     * Student Index — Halaman 1: Daftar Mata Pelajaran
     */
    private function studentIndex()
    {
        $user = auth()->user();
        $student = $user->student;
        $kelas = $student->resolved_kelas; // e.g. "X 1" or "XI F 1"
        
        // Determine tingkat
        $tingkat = 'X';
        if (strpos($kelas, 'XII') !== false) {
            $tingkat = 'XII';
        } elseif (strpos($kelas, 'XI') !== false) {
            $tingkat = 'XI';
        } elseif (strpos($kelas, 'X') !== false) {
            $tingkat = 'X';
        }

        // Get subjects for this student's class
        $kelasModel = \App\Models\Kelas::where('name', $kelas)->first();
        $subjectIds = [];
        if ($kelasModel) {
            $subjectIds = \App\Models\GuruKelas::where('kelas_id', $kelasModel->id)
                ->pluck('mata_pelajaran_id')
                ->filter()
                ->unique()
                ->toArray();
        }

        if (!empty($subjectIds)) {
            $subjects = JadwalPelajaran::whereIn('id', $subjectIds)->where('status', 'aktif')->get();
        } else {
            // Fallback to tingkat
            $subjects = JadwalPelajaran::where('tingkat', $tingkat)->where('status', 'aktif')->get();
        }

        // Preload Guru Pengampu for student's classroom
        $guruKelasMap = [];
        if ($kelasModel) {
            $guruKelasMap = \App\Models\GuruKelas::where('kelas_id', $kelasModel->id)
                ->with('guru.user')
                ->get()
                ->keyBy('mata_pelajaran_id');
        }

        $iconSets = [
            ['icon' => 'fas fa-book', 'bg' => '#eff6ff', 'text' => '#2563eb'],
            ['icon' => 'fas fa-calculator', 'bg' => '#f0fdf4', 'text' => '#16a34a'],
            ['icon' => 'fas fa-atom', 'bg' => '#faf5ff', 'text' => '#9333ea'],
            ['icon' => 'fas fa-flask', 'bg' => '#fff1f2', 'text' => '#e11d48'],
            ['icon' => 'fas fa-globe', 'bg' => '#f0fdfa', 'text' => '#0d9488'],
            ['icon' => 'fas fa-palette', 'bg' => '#fffbeb', 'text' => '#d97706'],
            ['icon' => 'fas fa-dna', 'bg' => '#fdf2f8', 'text' => '#db2777'],
            ['icon' => 'fas fa-laptop-code', 'bg' => '#ecfeff', 'text' => '#0891b2'],
        ];

        $adaptiveService = app(\App\Services\AdaptiveAccessService::class);

        $subjectData = $subjects->map(function ($subject, $index) use ($student, $iconSets, $kelas, $kelasModel, $guruKelasMap, $adaptiveService) {
            $iconSet = $iconSets[$index % count($iconSets)];

            $query = $subject->assignments()->tugas()->where('status', 'aktif');
            if ($kelasModel) {
                $query->where(function($q) use ($kelasModel) {
                    $q->where('kelas_id', $kelasModel->id)->orWhereNull('kelas_id');
                });
            }
            $totalAssignments = $query->count();
            $submittedCount = (clone $query)
                ->whereHas('submissions', function ($q) use ($student) {
                    $q->where('siswa_id', $student->id);
                })->count();

            // Teacher name resolution
            $teacherName = '-';
            if (isset($guruKelasMap[$subject->id]) && $guruKelasMap[$subject->id]->guru) {
                $teacherName = $guruKelasMap[$subject->id]->guru->nama;
            }

            // Adaptive Access Evaluation
            $accessResult = $adaptiveService->evaluateSubjectAccess($student, $subject);

            return [
                'subject_id'          => $subject->id,
                'course_name'         => $subject->nama,
                'teacher_name'        => $teacherName,
                'class_name'          => $kelas,
                'total_assignments'   => $totalAssignments,
                'submitted_count'     => $submittedCount,
                'overdue_count'       => $accessResult->jumlahTunggakan,
                'threshold'           => $accessResult->threshold,
                'is_locked'           => $accessResult->isLocked(),
                'is_warning'          => $accessResult->isWarning(),
                'is_recovery'         => $accessResult->isRecovery(),
                'is_normal'           => $accessResult->isNormal(),
                'has_pending_appeal'  => $accessResult->appealStatus === 'PENDING',
                'has_active_recovery' => $accessResult->isRecovery(),
                'adaptive_status'     => $accessResult->status->value,
                'reason_code'         => $accessResult->reasonCode,
                'next_action'         => $accessResult->nextAction,
                'can_appeal'          => $accessResult->canAppeal,
                'appeal_status'       => $accessResult->appealStatus,
                'icon'                => $iconSet['icon'],
                'color_bg'            => $iconSet['bg'],
                'color_text'          => $iconSet['text'],
            ];
        });

        return view('tugas.student_index', compact('subjectData'));
    }

    /**
     * Student Detail — Halaman 2: Daftar Tugas per Mata Pelajaran
     */
    public function studentDetail(JadwalPelajaran $subject)
    {
        Gate::authorize('view_tugas');

        $user = auth()->user();

        if (!$user->isStudent()) {
            abort(403);
        }

        $student = $user->student;
        $kelasName = $student?->resolved_kelas;
        if ($kelasName) {
            $kelas = Kelas::where('name', $kelasName)->first();
            if ($kelas) {
                $subject = clone $subject;
                $subject->setRelation('classRoom', $kelas);
            }
        }

        if (!$subject->course) {
            $subject->setRelation('course', $subject);
        }

        $studentId = $student->id;

        // Get teachers of student's classroom to isolate tasks
        $teacherIds = [];
        if ($kelasName) {
            $kelas = Kelas::where('name', $kelasName)->first();
            if ($kelas) {
                $teacherIds = $kelas->guruPengampu()->pluck('guru.id')->toArray();
            }
        }

        $query = Tugas::tugas()->with(['submissions' => function ($q) use ($studentId) {
                $q->where('siswa_id', $studentId);
            }])
            ->where('mata_pelajaran_id', $subject->id)
            ->where('status', 'aktif');
            
        if (isset($kelas) && $kelas) {
            $query->where(function($q) use ($kelas) {
                $q->where('kelas_id', $kelas->id)->orWhereNull('kelas_id');
            });
        }

        if (!empty($teacherIds)) {
            $query->whereIn('guru_id', $teacherIds);
        }

        $assignments = $query->orderBy('deadline', 'desc')->get();

        $adaptiveService = app(\App\Services\AdaptiveAccessService::class);
        $accessResult = $adaptiveService->evaluateSubjectAccess($student, $subject);
        $tunggakanIds = $adaptiveService->getOverdueTasksQuery($student, $subject->id)->pluck('id');
        $completedMaterialIds = \App\Models\PelacakanMateri::where('siswa_id', $studentId)->pluck('materi_id')->toArray();

        $recovery = \App\Models\PemulihanPengumpulan::where('siswa_id', $studentId)
            ->where('mata_pelajaran_id', $subject->id)
            ->where('status_pemulihan', 'aktif')
            ->first();

        $pendingAppeal = \App\Models\Banding::where('siswa_id', $studentId)
            ->where('mata_pelajaran_id', $subject->id)
            ->whereIn('status', ['pending', 'ditinjau'])
            ->first();

        return view('tugas.student_detail', compact('subject', 'assignments', 'tunggakanIds', 'recovery', 'pendingAppeal', 'completedMaterialIds', 'accessResult'));
    }

    public function create()
    {
        Gate::authorize('create_tugas');

        $user = auth()->user();
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
            $subjects = JadwalPelajaran::with(['course', 'classRoom'])->get();
        }
        $allMaterials = Materi::get(['id', 'title', 'subject_id']);
        return view('tugas.create', compact('subjects', 'allMaterials'));
    }

    public function store(Request $request)
    {
        if (\App\Models\Pengaturan::getValue('storage_frozen', '0') === '1') {
            return redirect()->back()->with('error', 'Sistem terkunci (Read-Only). Anda tidak dapat menambah tugas baru saat ini.');
        }

        Gate::authorize('create_tugas');

        $request->validate([
            'subject_id' => 'required|exists:mata_pelajaran,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:now',
            'max_score' => 'required|integer|min:0',
            'status' => 'nullable|in:active,inactive',
            'type' => 'nullable|in:essay,online,offline',
            'tipe_pengumpulan' => 'nullable|string|in:visual,dokumen,audiovisual,tautan',
            'mode_audiovisual' => 'required_if:tipe_pengumpulan,audiovisual|nullable|string|in:audio_file,video_url,either',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip,rar,jpg,png,jpeg,pptx,mp3,m4a,mp4,m4v,mov|max:51200', // Maks 50MB
            'attachment_link' => 'nullable|string|max:2048',
            'prasyarat_materi_id' => 'nullable|exists:tugas,id',
        ]);

        $data = $request->only([
            'subject_id', 'title', 'description', 'due_date',
            'max_score', 'status', 'type', 'class_name',
            'prasyarat_materi_id'
        ]);

        $tipePengumpulan = $request->input('tipe_pengumpulan', 'dokumen');
        $modeAudiovisual = $tipePengumpulan === 'audiovisual' ? $request->input('mode_audiovisual', 'either') : null;
        $data['tipe_pengumpulan'] = $tipePengumpulan;
        $data['mode_audiovisual'] = $modeAudiovisual;
        $user = auth()->user();
        
        if ($user->isTeacher()) {
            $data['created_by'] = $user->teacher->id;
        }
        
        if (!empty($data['class_name'])) {
            $kelas = \App\Models\Kelas::where('name', $data['class_name'])->first();
            if ($kelas) {
                $data['kelas_id'] = $kelas->id;
            }
        }

        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $guru = $user->guru;
            if (!$guru) abort(403);
            $kelasTarget = isset($data['kelas_id']) ? \App\Models\Kelas::find($data['kelas_id']) : null;
            $isAssigned = \App\Models\GuruKelas::where('guru_id', $guru->id)
                ->where('mata_pelajaran_id', $data['subject_id'])
                ->when($kelasTarget, fn($q) => $q->where('kelas_id', $kelasTarget->id))
                ->exists();
            if (!$isAssigned) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan untuk membuat tugas pada kelas/mata pelajaran ini.');
            }
        }

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('tugas');
        } elseif ($request->filled('attachment_link')) {
            $link = trim($request->input('attachment_link'));
            if (filter_var($link, FILTER_VALIDATE_URL) || str_starts_with($link, 'http://') || str_starts_with($link, 'https://')) {
                $data['attachment'] = $link;
            }
        }

        $data['status'] = $request->input('status', 'active');
        $data['type'] = $request->input('type', 'essay');

        Tugas::create($data);

        \App\Models\ActivityLog::log('ASSIGNMENT', 'Membuat tugas baru: ' . $request->title);

        // Redirect back to the specific subject detail page for better UX
        return redirect()->route('assignments.teacher.detail', [
            'subject' => $data['subject_id'],
            'class_name' => $data['class_name'] ?? null
        ])->with('success', 'Tugas berhasil dibuat.');
    }

    public function show(Tugas $assignment)
    {
        Gate::authorize('view_tugas');

        $user = auth()->user();

        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $isAssigned = ($assignment->guru_id == $user->teacher_id) || \App\Models\GuruKelas::where('guru_id', $user->teacher_id)
                ->where('mata_pelajaran_id', $assignment->mata_pelajaran_id)
                ->when($assignment->kelas_id, fn($q) => $q->where('kelas_id', $assignment->kelas_id))
                ->exists();
            if (!$isAssigned) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan pada tugas ini.');
            }
        }

        if ($user->isStudent()) {
            $student = $user->student;
            $studentKelas = $student?->resolved_kelas;
            if ($assignment->kelas_id) {
                $kelasAssignment = \App\Models\Kelas::find($assignment->kelas_id);
                if ($kelasAssignment && $kelasAssignment->name !== $studentKelas) {
                    abort(403, 'Tugas ini diperuntukkan bagi rombongan belajar lain.');
                }
            }
        }

        $isOwner = $user->isSuperAdmin() || ($user->isTeacher() && $assignment->guru_id == $user->teacher_id);
        
        $relations = ['subject.course', 'subject.classRoom', 'creator'];
        
        if ($isOwner) {
            $relations[] = 'submissions.student';
            $relations[] = 'submissions.grade';
        } else {
            // For students, only load their own submission
            $relations['submissions'] = function($query) use ($user) {
                $query->where('siswa_id', $user->student_id);
            };
        }

        $assignment->load($relations);

        // Bind course fallback if null
        if ($assignment->subject && !$assignment->subject->course) {
            $assignment->subject->setRelation('course', $assignment->subject);
        }

        // Bind classRoom fallback
        if ($assignment->subject && !$assignment->subject->classRoom) {
            if ($user->isStudent() && $user->student) {
                $kelasName = $user->student->kelas;
                $kelas = Kelas::where('name', $kelasName)->first();
                if ($kelas) {
                    $assignment->subject->setRelation('classRoom', $kelas);
                }
            } elseif ($user->isTeacher() && $user->guru) {
                $className = request('class_name');
                if ($className) {
                    $kelas = Kelas::where('name', $className)->first();
                } else {
                    $kelas = $user->guru->kelasDiampu()->first();
                }
                
                if ($kelas) {
                    $assignment->subject->setRelation('classRoom', $kelas);
                }
            }
        }

        // ============================================================
        // [DITAMBAHKAN] Monitoring Pengumpulan Tugas untuk Guru/Admin
        // Mengambil semua siswa di kelas terkait assignment, lalu
        // menggabungkan dengan data submission untuk menentukan status.
        // Logic status ini dirancang agar bisa digunakan kembali untuk
        // fitur "Selective Submission Locking" di masa depan.
        // ============================================================
        $studentMonitoring = collect();

        if ($isOwner) {
            $classroom = $assignment->subject ? $assignment->subject->classRoom : null;
            $students = $classroom 
                ? $classroom->students()
                            ->withoutGlobalScope('teacher_access')
                            ->where('status', 'aktif')
                            ->orderBy('nama')
                            ->get()
                : collect();

            // Index submissions berdasarkan student_id agar lookup O(1)
            $submissionsByStudent = $assignment->submissions->keyBy('student_id');

            $now = Carbon::now();
            $deadline = $assignment->deadline;

            // [DITAMBAHKAN] Mapping status per siswa
            $studentMonitoring = $students->map(function ($student) use ($submissionsByStudent, $now, $deadline) {
                $submission = $submissionsByStudent->get($student->id);

                // Logic status yang bisa digunakan kembali (reusable)
                if ($submission) {
                    $status = 'sudah_submit';
                    $statusLabel = 'Sudah Submit';
                    $statusColor = 'success'; // hijau
                } elseif ($now->greaterThan($deadline)) {
                    $status = 'terlambat';
                    $statusLabel = 'Terlambat';
                    $statusColor = 'danger'; // merah
                } else {
                    $status = 'belum_submit';
                    $statusLabel = 'Belum Submit';
                    $statusColor = 'warning'; // kuning
                }

                return (object) [
                    'student'        => $student,
                    'submission'     => $submission,
                    'status'         => $status,        // untuk logic di masa depan
                    'status_label'   => $statusLabel,   // untuk tampilan
                    'status_color'   => $statusColor,   // untuk badge
                    'submitted_at'   => $submission?->submission_date,
                ];
            });
        }

        // ============================================================
        // [DITAMBAHKAN] Selective Submission Locking — untuk Siswa
        // Cek apakah siswa punya tunggakan tugas lain yang sudah lewat
        // deadline namun belum dikumpulkan.
        //
        // Logic LOCKED jika:
        //   1. Ada assignment LAIN (bukan yang sedang dibuka)
        //   2. Deadline assignment tersebut sudah lewat
        //   3. Siswa belum punya submission untuk assignment itu
        //
        // Menggunakan whereDoesntHave untuk efisiensi — 1 query, tanpa N+1
        // ============================================================
        $isLocked       = false;
        $tunggakanCount = 0;
        $tunggakanList  = collect();
        $pendingAppeal  = null;
        $recovery       = null;

        if ($user->isStudent() && $user->student_id) {
            $studentId  = $user->student_id;
            $student = $user->student;
            $kelasName = $student?->resolved_kelas;
            $teacherIds = [];
            if ($kelasName) {
                $kelas = Kelas::where('name', $kelasName)->first();
                if ($kelas) {
                    $teacherIds = $kelas->guruPengampu()->pluck('guru.id')->toArray();
                }
            }

            // 1. Check Active Recovery Mode
            $recovery = \App\Models\PemulihanPengumpulan::where('siswa_id', $studentId)
                ->where('mata_pelajaran_id', $assignment->mata_pelajaran_id)
                ->where('status_pemulihan', 'aktif')
                ->first();
                
            if ($recovery && $recovery->batas_pemulihan && $recovery->batas_pemulihan->isPast()) {
                $recovery->update(['status_pemulihan' => 'expired']);
                $recovery = null;
            }

            // 2. Fetch overdue tasks in this class/subject (Selective Submission Locking)
            $kelasId = $kelas ? $kelas->id : null;
            $tunggakanQuery = Tugas::tugas()->with(['subject.course'])
                ->where('id', '!=', $assignment->id)           // bukan assignment yg sedang dibuka
                ->where('mata_pelajaran_id', $assignment->mata_pelajaran_id) // Khusus mata pelajaran ini
                ->where('status', 'aktif')                     // hanya yang aktif
                ->whereNotNull('deadline')
                ->where('deadline', '<', Carbon::now())        // deadline sudah lewat
                ->where(function ($q) use ($kelasId) {
                    if ($kelasId) {
                        $q->where('kelas_id', $kelasId);
                    } else {
                        $q->whereNull('kelas_id');
                    }
                })
                ->whereDoesntHave('submissions', function ($q) use ($studentId) {
                    $q->where('siswa_id', $studentId);
                });

            $tunggakanList = $tunggakanQuery->orderBy('deadline')
                ->get(['id', 'judul', 'deadline', 'mata_pelajaran_id']);

            $tunggakanCount = $tunggakanList->count();
            
            // Check if student has submission for this assignment
            $mySub = $assignment->submissions->first();

            if ($mySub) {
                $isLocked = false;
            } else {
                if ($recovery && $recovery->tugas_id == $assignment->id) {
                    $isLocked = false;
                } else {
                    // Lock if total overdue assignments is >= 3 OR if this assignment itself is overdue
                    $isLocked = ($tunggakanCount >= 3) || $assignment->is_overdue;
                }
            }

            // 3. Check Pending Appeal
            $pendingAppeal = \App\Models\Banding::where('siswa_id', $studentId)
                ->whereIn('status', ['pending', 'ditinjau'])
                ->where(function($q) use ($assignment) {
                    $q->where('tugas_id', $assignment->id)
                      ->orWhere('mata_pelajaran_id', $assignment->mata_pelajaran_id);
                })
                ->first();
        }

        $completedMaterialIds = [];
        if ($user->isStudent()) {
            $completedMaterialIds = \App\Models\PelacakanMateri::where('siswa_id', $user->student_id)->pluck('materi_id')->toArray();
        }

        return view('tugas.show', compact(
            'assignment',
            'studentMonitoring',
            'isLocked',        // [BARU] status kunci untuk UI kondisi
            'tunggakanCount',  // [BARU] jumlah tunggakan
            'tunggakanList',   // [BARU] daftar tugas tunggakan
            'pendingAppeal',   // [BARU] banding pending
            'recovery',         // [BARU] pemulihan aktif
            'completedMaterialIds' // [BARU] materi yang diselesaikan
        ));
    }

    /**
     * Export Rekapitulasi Pengumpulan & Nilai untuk Satu Tugas Spesifik ke Excel (.xlsx)
     */
    public function exportSingleAssignmentRekap(Request $request, Tugas $assignment)
    {
        Gate::authorize('view_tugas');

        $user = auth()->user();

        if (!$user->isTeacher() && !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengunduh rekap ini.');
        }

        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            $isAssigned = ($assignment->guru_id == $user->teacher_id) || \App\Models\GuruKelas::where('guru_id', $user->teacher_id)
                ->where('mata_pelajaran_id', $assignment->mata_pelajaran_id)
                ->when($assignment->kelas_id, fn($q) => $q->where('kelas_id', $assignment->kelas_id))
                ->exists();
            if (!$isAssigned) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan pada tugas ini.');
            }
        }

        // Tentukan kelas yang relevan
        $className = $request->query('class_name');
        if ($className) {
            $kelas = Kelas::where('name', $className)->first();
        } else {
            $kelas = $assignment->subject ? $assignment->subject->classRoom : null;
            if (!$kelas && $assignment->kelas_id) {
                $kelas = Kelas::find($assignment->kelas_id);
            }
        }

        $assignment->load(['subject.course', 'subject.classRoom', 'submissions.student', 'submissions.grade']);

        // Mengambil seluruh siswa aktif di kelas
        $students = collect();
        if ($kelas) {
            $students = \App\Models\Siswa::withoutGlobalScope('teacher_access')
                ->where('kelas', $kelas->name)
                ->where('status', 'aktif')
                ->orderBy('nama', 'asc')
                ->get();
        } else {
            $students = \App\Models\Siswa::withoutGlobalScope('teacher_access')
                ->whereIn('id', $assignment->submissions->pluck('siswa_id'))
                ->orderBy('nama', 'asc')
                ->get();
        }

        $submissionsByStudent = $assignment->submissions->keyBy('siswa_id');

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Rekap Tugas');

        $highestColumnLetter = 'G'; // Kolom A s.d. G

        // Kop Surat Resmi
        $sheet->setCellValue('A1', 'PEMERINTAH PROVINSI JAWA TENGAH');
        $sheet->mergeCells("A1:{$highestColumnLetter}1");
        $sheet->getStyle('A1')->getFont()->setName('Arial')->setSize(11)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'DINAS PENDIDIKAN DAN KEBUDAYAAN');
        $sheet->mergeCells("A2:{$highestColumnLetter}2");
        $sheet->getStyle('A2')->getFont()->setName('Arial')->setSize(11)->setBold(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'SMA NEGERI 1 CEPOGO');
        $sheet->mergeCells("A3:{$highestColumnLetter}3");
        $sheet->getStyle('A3')->getFont()->setName('Arial')->setSize(14)->setBold(true);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A4', 'Kecamatan Kec. Cepogo, Kabupaten Kab. Boyolali, Provinsi Prov. Jawa Tengah');
        $sheet->mergeCells("A4:{$highestColumnLetter}4");
        $sheet->getStyle('A4')->getFont()->setName('Arial')->setSize(9)->setItalic(true);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("A4:{$highestColumnLetter}4")->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE);

        // Judul Laporan
        $sheet->setCellValue('A6', 'REKAPITULASI PENGUMPULAN & NILAI TUGAS');
        $sheet->mergeCells("A6:{$highestColumnLetter}6");
        $sheet->getStyle('A6')->getFont()->setName('Arial')->setSize(12)->setBold(true);
        $sheet->getStyle('A6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Metadata
        $courseName = $assignment->subject->course->nama ?? $assignment->subject->nama ?? '-';
        $kelasNameStr = $kelas->name ?? '-';
        $deadlineStr = $assignment->deadline ? Carbon::parse($assignment->deadline)->locale('id')->isoFormat('D MMMM Y, HH:mm') . ' WIB' : '-';

        $sheet->setCellValue('A7', "Tugas: {$assignment->title} | Mapel: {$courseName} | Kelas: {$kelasNameStr} | Batas Waktu: {$deadlineStr}");
        $sheet->mergeCells("A7:{$highestColumnLetter}7");
        $sheet->getStyle('A7')->getFont()->setName('Arial')->setSize(10)->setItalic(true);
        $sheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Header Tabel (Baris 9)
        $headers = ["NO", "NIS", "NAMA SISWA", "WAKTU KUMPUL", "STATUS PEMERIKSAAN", "NILAI", "CATATAN GURU"];
        $sheet->fromArray($headers, null, 'A9');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'name' => 'Arial', 'size' => 10],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D65A20']],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => 'B54A18']]]
        ];
        $sheet->getStyle("A9:{$highestColumnLetter}9")->applyFromArray($headerStyle);
        $sheet->getRowDimension(9)->setRowHeight(25);

        // Baris Data (Baris 10+)
        $row = 10;
        $no = 1;
        $deadline = $assignment->deadline ? Carbon::parse($assignment->deadline) : null;

        foreach ($students as $student) {
            $submission = $submissionsByStudent->get($student->id);

            $waktuKumpul = 'Belum ada file';
            $statusPemeriksaan = 'Belum Kumpul';
            $nilai = '-';
            $catatan = '-';

            if ($submission) {
                $tglKumpul = $submission->tanggal_pengumpulan ?? $submission->created_at;
                $isTelat = $deadline && $tglKumpul && Carbon::parse($tglKumpul)->gt($deadline);

                if ($tglKumpul) {
                    $waktuKumpul = Carbon::parse($tglKumpul)->locale('id')->isoFormat('D MMMM Y, HH:mm') . ' WIB';
                    if ($isTelat) {
                        $waktuKumpul .= ' (Telat)';
                    }
                }

                if ($submission->grade) {
                    $statusPemeriksaan = 'Sudah Dikoreksi';
                    $nilai = (float) $submission->grade->score;
                    $catatan = $submission->grade->feedback ?? '-';
                } else {
                    if ($isTelat) {
                        $statusPemeriksaan = 'Terlambat';
                    } else {
                        $statusPemeriksaan = 'Perlu Koreksi';
                    }
                }
            }

            $rowData = [
                $no++,
                $student->nis ?? '-',
                $student->nama,
                $waktuKumpul,
                $statusPemeriksaan,
                $nilai,
                $catatan
            ];

            $sheet->fromArray($rowData, null, "A{$row}");

            $rowStyle = [
                'font' => ['name' => 'Arial', 'size' => 10],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => 'E2E8F0']]],
                'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER]
            ];
            $sheet->getStyle("A{$row}:G{$row}")->applyFromArray($rowStyle);

            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("D{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("E{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("F{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            if ($row % 2 !== 0) {
                $sheet->getStyle("A{$row}:G{$row}")->getFill()->applyFromArray([
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F8FAFC']
                ]);
            }
            $row++;
        }

        foreach (range('A', 'G') as $colLetter) {
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        $cleanJudul = \Illuminate\Support\Str::slug($assignment->title, '_');
        $cleanKelas = \Illuminate\Support\Str::slug($kelasNameStr, '_');
        $filename = "rekap_tugas_{$cleanJudul}_{$cleanKelas}_" . date('Ymd_His') . ".xlsx";

        $headersResponse = [
            "Content-Type"        => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        if (ob_get_length()) {
            ob_end_clean();
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $callback = function() use ($writer) {
            $writer->save('php://output');
        };

        return response()->stream($callback, 200, $headersResponse);
    }

    public function edit(Tugas $assignment)

    {
        Gate::authorize('edit_tugas');

        $user = auth()->user();
        
        // Authorization check
        if ($user->isTeacher() && $assignment->guru_id !== $user->teacher->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->isTeacher()) {
            $guru = $user->guru;
            $subjects = collect();
            if ($guru && $guru->specialization_id) {
                $specializedSubject = JadwalPelajaran::find($guru->specialization_id);
                if ($specializedSubject) {
                    foreach ($guru->kelasDiampu as $kelas) {
                        $cloned = clone $specializedSubject;
                        $cloned->setRelation('classRoom', $kelas);
                        $subjects->push($cloned);
                    }
                }
            }
        } else {
            $subjects = JadwalPelajaran::with(['course', 'classRoom'])->get();
        }

        $allMaterials = Materi::get(['id', 'title', 'subject_id']);
        return view('tugas.edit', compact('assignment', 'subjects', 'allMaterials'));
    }

    public function update(Request $request, Tugas $assignment)
    {
        if (\App\Models\Pengaturan::getValue('storage_frozen', '0') === '1') {
            return redirect()->back()->with('error', 'Sistem terkunci (Read-Only). Anda tidak dapat mengubah tugas saat ini.');
        }

        Gate::authorize('edit_tugas');

        $user = auth()->user();
        
        // Authorization check
        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            if ($assignment->guru_id != $user->teacher->id) {
                abort(403, 'Unauthorized action.');
            }
            $targetSubjectId = $request->input('subject_id', $assignment->mata_pelajaran_id);
            $assignmentKelasId = $assignment->kelas_id;

            if (!$assignmentKelasId) {
                abort(403, 'Tugas tidak memiliki data kelas yang valid.');
            }

            $isAssigned = \App\Models\GuruKelas::where('guru_id', $user->teacher->id)
                ->where('kelas_id', $assignmentKelasId)
                ->where('mata_pelajaran_id', $targetSubjectId)
                ->exists();

            if (!$isAssigned) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan untuk mata pelajaran target pada kelas ini.');
            }
        }

        $isSslLockEnabled = \App\Models\Pengaturan::getValue('ssl_lock_expired_deadline', '1') === '1';
        $isDeadlinePassed = $isSslLockEnabled && $assignment->deadline && Carbon::parse($assignment->deadline)->isPast();

        $request->validate([
            'subject_id' => 'required|exists:mata_pelajaran,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => $isDeadlinePassed ? 'nullable|date' : 'required|date',
            'max_score' => 'required|integer|min:0',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip,rar,jpg,png,jpeg,pptx,mp3,m4a,mp4,m4v,mov|max:51200',
            'attachment_link' => 'nullable|string|max:2048',
            'status' => 'required|in:active,inactive',
            'tipe_pengumpulan' => 'nullable|string|in:visual,dokumen,audiovisual,tautan',
            'mode_audiovisual' => 'required_if:tipe_pengumpulan,audiovisual|nullable|string|in:audio_file,video_url,either',
            'prasyarat_materi_id' => 'nullable|exists:tugas,id',
        ]);

        $hasSubmissions = $assignment->hasSubmissions();

        if ($hasSubmissions) {
            if ($request->has('tipe_pengumpulan') && $request->input('tipe_pengumpulan') !== $assignment->tipe_pengumpulan) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'tipe_pengumpulan' => 'Tipe pengumpulan tidak dapat diubah karena tugas sudah memiliki pengumpulan dari siswa.'
                ]);
            }
            if ($request->has('mode_audiovisual') && $request->input('mode_audiovisual') !== $assignment->mode_audiovisual) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'mode_audiovisual' => 'Mode audiovisual tidak dapat diubah karena tugas sudah memiliki pengumpulan dari siswa.'
                ]);
            }
        }

        $data = $request->only([
            'subject_id', 'title', 'description',
            'max_score', 'status', 'prasyarat_materi_id'
        ]);

        if (!$hasSubmissions) {
            $tipePengumpulan = $request->input('tipe_pengumpulan', $assignment->tipe_pengumpulan ?? 'dokumen');
            $modeAudiovisual = $tipePengumpulan === 'audiovisual' ? $request->input('mode_audiovisual', 'either') : null;
            $data['tipe_pengumpulan'] = $tipePengumpulan;
            $data['mode_audiovisual'] = $modeAudiovisual;
        }

        // Proteksi Integritas: Kunci deadline jika tugas sudah melewati batas waktu (SSL Policy)
        if ($isDeadlinePassed) {
            $data['due_date'] = $assignment->deadline;
        } else {
            $data['due_date'] = $request->input('due_date');
        }

        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists and it is a stored local file
            if ($assignment->attachment && !\Illuminate\Support\Str::startsWith($assignment->attachment, ['http://', 'https://'])) {
                \Storage::delete($assignment->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('tugas');
        } elseif ($request->filled('attachment_link')) {
            $link = trim($request->input('attachment_link'));
            if (filter_var($link, FILTER_VALIDATE_URL) || str_starts_with($link, 'http://') || str_starts_with($link, 'https://')) {
                if ($assignment->attachment && !\Illuminate\Support\Str::startsWith($assignment->attachment, ['http://', 'https://'])) {
                    \Storage::delete($assignment->attachment);
                }
                $data['attachment'] = $link;
            }
        } elseif ($request->boolean('remove_attachment')) {
            if ($assignment->attachment && !\Illuminate\Support\Str::startsWith($assignment->attachment, ['http://', 'https://'])) {
                \Storage::delete($assignment->attachment);
            }
            $data['attachment'] = null;
        }

        $assignment->update($data);

        \App\Models\ActivityLog::log('ASSIGNMENT', 'Memperbarui tugas: ' . $assignment->title);

        if ($user->isTeacher() || $user->isSuperAdmin()) {
            return redirect()->route('assignments.teacher.detail', [
                'subject' => $assignment->mata_pelajaran_id ?: $request->input('subject_id'),
                'class_name' => $request->query('class_name') ?: $request->input('class_name')
            ])->with('success', 'Tugas berhasil diperbarui.');
        }

        return redirect()->route('assignments.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $assignment)
    {
        Gate::authorize('delete_tugas');

        $user = auth()->user();
        
        // Authorization check
        if ($user->isTeacher() && !$user->isSuperAdmin()) {
            if ($assignment->guru_id != $user->teacher->id) {
                abort(403, 'Unauthorized action.');
            }
            if (!$assignment->kelas_id) {
                abort(403, 'Tugas tidak memiliki data kelas yang valid.');
            }
            $isAssigned = \App\Models\GuruKelas::where('guru_id', $user->teacher->id)
                ->where('kelas_id', $assignment->kelas_id)
                ->where('mata_pelajaran_id', $assignment->mata_pelajaran_id)
                ->exists();

            if (!$isAssigned) {
                abort(403, 'Anda tidak memiliki hak akses pengampuan pada tugas ini.');
            }
        }

        if ($assignment->attachment) {
            \Storage::disk('public')->delete($assignment->attachment);
        }

        $subjectId = $assignment->mata_pelajaran_id;
        $assignmentTitle = $assignment->title;

        $assignment->delete();

        \App\Models\ActivityLog::log('DELETION', 'Menghapus tugas: ' . $assignmentTitle);

        $previousUrl = url()->previous();
        // Jika penghapusan dipicu dari halaman detail mata pelajaran, halaman edit, atau detail tugas itu sendiri,
        // alihkan kembali ke halaman daftar tugas mata pelajaran tersebut.
        if (
            strpos($previousUrl, 'teacher/subject/') !== false ||
            strpos($previousUrl, '/edit') !== false ||
            strpos($previousUrl, '/assignments/' . $assignment->id) !== false
        ) {
            if ($subjectId) {
                return redirect()->route('assignments.teacher.detail', [
                    'subject' => $subjectId,
                    'class_name' => request('class_name')
                ])->with('success', 'Tugas berhasil dihapus.');
            }
            return redirect()->route('assignments.index')
                ->with('success', 'Tugas berhasil dihapus.');
        }

        return redirect()->back()
            ->with('success', 'Tugas berhasil dihapus.');
    }

    /**
     * Submit an appeal for a locked assignment.
     */
    public function submitBanding(Request $request, $id)
    {
        $user = auth()->user();
        if (!$user->isStudent()) {
            abort(403, 'Hanya siswa yang dapat mengajukan banding.');
        }

        $request->validate([
            'kategori_alasan' => 'required|string|in:Sakit,Kendala Teknis/Jaringan,Izin Resmi,Lainnya',
            'penjelasan' => 'required|string|min:50',
            'bukti_pendukung' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ], [
            'penjelasan.required' => 'Penjelasan detail wajib diisi.',
            'penjelasan.min' => 'Penjelasan detail harus minimal 50 karakter.',
            'bukti_pendukung.max' => 'Ukuran bukti pendukung maksimal 2MB.',
            'bukti_pendukung.mimes' => 'Format bukti pendukung harus PDF, JPG, atau PNG.',
        ]);

        $assignment = Tugas::findOrFail($id);
        $student = $user->student;
        $studentId = $user->student_id;

        if (!$student || !$student->resolved_kelas) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar di kelas manapun.');
        }

        if ($assignment->kelas_id) {
            $kelasAssignment = \App\Models\Kelas::find($assignment->kelas_id);
            if ($kelasAssignment && $kelasAssignment->name !== $student->resolved_kelas) {
                abort(403, 'Tugas ini diperuntukkan bagi rombongan belajar lain.');
            }
        }

        // Student eligibility check: subject overdue count must reach threshold >= 3 to be SSL locked
        $alreadySubmitted = \App\Models\Pengumpulan::where('siswa_id', $student->id)->where('tugas_id', $assignment->id)->exists();
        $studentClass = \App\Models\Kelas::where('name', $student->resolved_kelas)->first();
        $tingkat = $assignment->subject?->tingkat;
        $kelasId = $studentClass?->id;
        $overdueCount = Tugas::countOverdueForStudentAndSubject($studentId, $assignment->mata_pelajaran_id, $tingkat, $kelasId);

        if ($alreadySubmitted || $overdueCount < 3) {
            abort(403, 'Permohonan banding hanya dapat diajukan jika tugas dalam kondisi terkunci oleh sistem.');
        }

        $filePath = null;
        if ($request->hasFile('bukti_pendukung')) {
            $filePath = $request->file('bukti_pendukung')->store('banding_bukti');
        }

        // Check for existing pending appeal for this assignment
        $exists = \App\Models\Banding::where('siswa_id', $studentId)
            ->where('tugas_id', $assignment->id)
            ->whereIn('status', ['pending', 'ditinjau'])
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Banding untuk tugas ini sedang ditinjau.');
        }

        \App\Models\Banding::create([
            'siswa_id' => $studentId,
            'mata_pelajaran_id' => $assignment->mata_pelajaran_id,
            'tugas_id' => $assignment->id,
            'alasan' => $request->penjelasan,
            'kategori_alasan' => $request->kategori_alasan,
            'bukti_pendukung' => $filePath,
            'status' => 'pending', // Will be mapped to 'ditinjau' by setter in model
        ]);

        return redirect()->route('assignments.show', $assignment->id)
            ->with('success', 'Pengajuan banding berhasil dikirim, silakan tunggu evaluasi dari guru');
    }

    /**
     * Verify student submission access through Selective Submission Locking (SSL)
     */
    public function verifyAccess(Request $request, Tugas $assignment)
    {
        $user = auth()->user();
        if (!$user || !$user->isStudent()) {
            return response()->json(['success' => false, 'message' => 'Hanya siswa yang dapat melakukan verifikasi.'], 403);
        }

        $student = $user->student;
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Data siswa tidak ditemukan.'], 404);
        }

        $mySub = $assignment->submissions()->where('siswa_id', $student->id)->first();
        if ($mySub && !$mySub->is_needs_revision) {
            return response()->json([
                'success' => true,
                'allowed' => false,
                'is_submitted' => true,
                'submission' => $mySub,
                'message' => 'Tugas sudah pernah dikumpulkan.'
            ]);
        }

        $adaptiveService = app(\App\Services\AdaptiveAccessService::class);
        $decision = $adaptiveService->evaluateTaskSubmission($student, $assignment);

        if (!$decision->allowed) {
            $type = match ($decision->reasonCode) {
                'PREREQUISITE_NOT_MET' => 'prereq_locked',
                'RECOVERY_WRONG_TASK' => 'recovery_locked',
                'LOCKED_BY_RETURNED_TASKS' => 'locked_by_returned',
                'LOCKED_BY_SSL' => 'overdue_locked',
                'PAST_DEADLINE' => 'deadline_passed',
                default => 'overdue_locked',
            };

            $returnedTasks = [];
            if ($decision->reasonCode === 'LOCKED_BY_RETURNED_TASKS') {
                $returnedTasks = Tugas::where('mata_pelajaran_id', $assignment->mata_pelajaran_id)
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
            }

            return response()->json([
                'success' => false,
                'allowed' => false,
                'locked' => true,
                'type' => $type,
                'ssl_status' => $decision->sslStatus->value,
                'reason_code' => $decision->reasonCode,
                'message' => $decision->message,
                'tunggakan_count' => $decision->tunggakanCount,
                'returned_count' => $decision->returnedCount,
                'returned_tasks' => $returnedTasks,
                'can_appeal' => $decision->canAppeal,
                'target_tugas_id' => $decision->targetTugasId,
                'prerequisite_material_id' => $decision->prerequisiteMaterialId,
                'prerequisite_title' => $decision->prerequisiteTitle,
                'subject_id' => $decision->subjectId
            ], 403);
        }

        return response()->json([
            'success' => true,
            'allowed' => true,
            'is_submitted' => false,
            'ssl_status' => $decision->sslStatus->value,
            'reason_code' => $decision->reasonCode,
            'message' => $decision->message
        ]);
    }
}
