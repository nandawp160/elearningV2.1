<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\GuruKelas;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GuruController extends Controller
{
    public function index()
    {
        Gate::authorize('view_guru');

        $selectedYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
        $selectedStartYear = (int) explode('/', $selectedYear)[0];

        $teachers = Guru::with(['mataPelajaran', 'kelasDiampu', 'teachingAssignments.kelas', 'teachingAssignments.subject'])
            ->get()
            ->filter(function($teacher) use ($selectedStartYear) {
                if (!$teacher->entry_academic_year) return true;
                $teacherStartYear = (int) explode('/', $teacher->entry_academic_year)[0];
                return $teacherStartYear <= $selectedStartYear;
            });
        $courses = \App\Models\MataPelajaran::where('status', 'aktif')->orderBy('nama')->get();
        $classrooms = \App\Models\Kelas::orderBy('name')->get();
        return view('guru.index', compact('teachers', 'courses', 'classrooms'));
    }

    public function create()
    {
        Gate::authorize('create_guru');

        $courses = \App\Models\MataPelajaran::where('status', 'aktif')->orderBy('nama')->get();
        return view('guru.create', compact('courses'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create_guru');

        $request->validate([
            'nip' => 'required|unique:guru,nip',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email|unique:pengguna,email',
            'phone' => 'required|string|max:20',
            'specialization_id' => 'nullable|exists:mata_pelajaran,id',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'tugas_tambahan_jtm' => 'nullable|integer|min:0',
            'mata_pelajaran_diajarkan' => 'nullable|array',
            'mata_pelajaran_diajarkan.*' => 'exists:mata_pelajaran,id',
            'allowed_grades' => 'nullable|array',
            'allowed_grades.*' => 'in:X,XI,XII',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        try {
            DB::beginTransaction();

            // Create login user account
            $user = User::create([
                'nama' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'guru',
            ]);

            // Create Teacher profile
            $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
            $guru = Guru::create([
                'nip' => $request->nip,
                'nama' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->phone,
                'specialization_id' => $request->specialization_id, // Backward compatibility
                'alamat' => $request->address,
                'status' => $request->status === 'active' ? 'aktif' : 'nonaktif',
                'pengguna_id' => $user->id,
                'tugas_tambahan_jtm' => $request->tugas_tambahan_jtm ?? 0,
                'allowed_grades' => $request->allowed_grades ?? [],
                'entry_academic_year' => $activeYear
            ]);

            if ($request->has('mata_pelajaran_diajarkan')) {
                $guru->mataPelajaranDiajarkan()->sync($request->mata_pelajaran_diajarkan);
            }

            \App\Models\ActivityLog::log('TEACHER', 'Menambahkan guru baru: ' . $guru->nama . ' (NIP: ' . $guru->nip . ')');

            DB::commit();

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        Gate::authorize('view_guru');
        $teacher = Guru::with(['userAccount', 'specialization', 'classes.subject', 'mataPelajaranDiajarkan'])->findOrFail($id);
        return view('guru.show', compact('teacher'));
    }

    public function edit($id)
    {
        Gate::authorize('edit_guru');
        $teacher = Guru::with(['mataPelajaranDiajarkan'])->findOrFail($id);
        $subjects = MataPelajaran::active()->orderBy('nama')->get();
        return view('guru.edit', compact('teacher', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('edit_guru');

        $teacher = Guru::findOrFail($id);

        $request->validate([
            'nip' => 'required|unique:guru,nip,' . $teacher->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email,' . $teacher->id,
            'phone' => 'required|string|max:20',
            'specialization_id' => 'nullable|exists:mata_pelajaran,id',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'tugas_tambahan_jtm' => 'nullable|integer|min:0',
            'mata_pelajaran_diajarkan' => 'nullable|array',
            'mata_pelajaran_diajarkan.*' => 'exists:mata_pelajaran,id',
            'allowed_grades' => 'nullable|array',
            'allowed_grades.*' => 'in:X,XI,XII',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        try {
            DB::beginTransaction();

            // Update associated User account if exists
            if ($teacher->pengguna_id) {
                $user = User::find($teacher->pengguna_id);
                if ($user) {
                    $user->update([
                        'nama' => $request->name,
                        'email' => $request->email,
                    ]);
                }
            } else {
                // Create associated User account if somehow missing
                if (!User::where('email', $request->email)->exists()) {
                    $user = User::create([
                        'nama' => $request->name,
                        'email' => $request->email,
                        'password' => \Illuminate\Support\Facades\Hash::make('password'),
                        'role' => 'guru',
                    ]);
                    $teacher->pengguna_id = $user->id;
                }
            }

            // Update teacher profile
            $teacher->update([
                'nip' => $request->nip,
                'nama' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->phone,
                'specialization_id' => $request->specialization_id, // Backward compatibility
                'alamat' => $request->address,
                'status' => $request->status, // Model handles active/inactive mapping
                'tugas_tambahan_jtm' => $request->tugas_tambahan_jtm ?? 0,
                'allowed_grades' => $request->allowed_grades ?? [],
            ]);

            if ($request->has('mata_pelajaran_diajarkan')) {
                $teacher->mataPelajaranDiajarkan()->sync($request->mata_pelajaran_diajarkan);
            } else {
                $teacher->mataPelajaranDiajarkan()->sync([]);
            }

            \App\Models\ActivityLog::log('TEACHER', 'Memperbarui data guru: ' . $teacher->nama . ' (NIP: ' . $teacher->nip . ')');

            DB::commit();

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Gate::authorize('delete_guru');

        try {
            DB::beginTransaction();

            $teacher = Guru::findOrFail($id);
            $nama = $teacher->nama;

            // Soft-delete associated user account if exists
            if ($teacher->pengguna_id) {
                User::destroy($teacher->pengguna_id);
            }

            $teacher->delete();

            \App\Models\ActivityLog::log('TEACHER', 'Menghapus data guru: ' . $nama);

            DB::commit();

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menghapus guru: ' . $e->getMessage());
        }
    }
 
    public function createUser(Guru $teacher)
    {
        Gate::authorize('edit_guru');

        if ($teacher->pengguna_id && User::find($teacher->pengguna_id)) {
            return back()->with('error', 'Akun pengguna untuk guru ini sudah ada.');
        }

        if (User::where('email', $teacher->email)->exists()) {
             return back()->with('error', 'Email guru ini sudah digunakan oleh pengguna lain.');
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'nama' => $teacher->name,
                'email' => $teacher->email,
                'password' => \Illuminate\Support\Facades\Hash::make('password'), // Default password
                'role' => 'guru',
            ]);

            $teacher->update(['pengguna_id' => $user->id]);

            \App\Models\ActivityLog::log('TEACHER', 'Membuatkan akun login untuk guru: ' . $teacher->nama . ' (NIP: ' . $teacher->nip . ')');

            DB::commit();

            return back()->with('success', 'Akun pengguna berhasil dibuat! Password default: password');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat akun pengguna: ' . $e->getMessage());
        }
    }

    public function updateTeachingClasses(Request $request, Guru $teacher)
    {
        Gate::authorize('edit_guru');

        $request->validate([
            'kelas' => 'array',
            'kelas.*' => 'exists:kelas,id',
            'subject_ids' => 'array',
            'subject_ids.*' => 'nullable|exists:mata_pelajaran,id'
        ]);

        $syncData = [];
        foreach ($request->kelas ?? [] as $kelasId) {
            $subjectId = $request->input("subject_ids.{$kelasId}");
            $syncData[$kelasId] = [
                'mata_pelajaran_id' => $subjectId ?: null
            ];
        }

        $teacher->kelasDiampu()->sync($syncData);

        \App\Models\ActivityLog::log('TEACHER', 'Memperbarui pembagian kelas mengajar guru: ' . $teacher->nama);

        return back()->with('success', 'Pengaturan kelas diampu untuk ' . $teacher->nama . ' berhasil diperbarui.');
    }

    public function getResolvedSubjects(Guru $teacher)
    {
        $user = auth()->user();
        if ($user && $user->isTeacher() && $user->guru && $user->guru->id === $teacher->id) {
            // Authorized
        } else {
            Gate::authorize('view_guru');
        }

        $classrooms = \App\Models\Kelas::orderBy('name')->get();
        $data = [];
        foreach ($classrooms as $kelas) {
            $subject = $teacher->getSubjectForClass($kelas);
            $data[$kelas->id] = $subject ? [
                'id' => $subject->id,
                'nama' => $subject->nama
            ] : null;
        }
        return response()->json($data);
    }

    public function autoPlot(Request $request)
    {
        Gate::authorize('edit_guru');

        $request->validate([
            'tahun_ajaran' => ['required', 'string', 'regex:/^\d{4}\/\d{4}$/'],
        ], [
            'tahun_ajaran.required' => 'Tahun ajaran target harus diisi.',
            'tahun_ajaran.regex' => 'Format tahun ajaran tidak valid.',
        ]);

        $tahunAjaran = $request->input('tahun_ajaran');
        $targetStartYear = (int) explode('/', $tahunAjaran)[0];

        try {
            DB::beginTransaction();

            // 1. Clean existing Grade X assignments for target academic year only
            GuruKelas::whereIn('kelas_id', function ($query) use ($tahunAjaran) {
                    $query->select('id')
                        ->from('kelas')
                        ->where('academic_year', $tahunAjaran)
                        ->where('grade_level', 'X');
                })
                ->delete();

            // 2. Fetch active teachers (using Guru::active() scope)
            $teachers = Guru::active()
                ->with(['mataPelajaranDiajarkan', 'kelasPerwalian', 'mataPelajaran'])
                ->get();

            $TARGET_JTM = 30; // Soft target per guru
            $MAX_JTM = 44;    // Hard cap per guru (strictly enforced, no 120 JTM bypass)

            // 2. Pre-fetch Fase F plottings to calculate initial load
            $faseFPlots = GuruKelas::with(['kelas'])
                ->whereHas('kelas', function($q) use ($tahunAjaran) {
                    $q->withoutGlobalScope('tahun_ajaran_aktif')
                      ->where('academic_year', $tahunAjaran)
                      ->whereIn('grade_level', ['XI', 'XII']);
                })->get();

            $faseFLoadByGuru = [];
            foreach ($faseFPlots as $fp) {
                $jp = \App\Http\Controllers\TeachingAssignmentController::getMapelJp($fp->mata_pelajaran_id, $fp->kelas->grade_level ?? 'XI');
                $faseFLoadByGuru[$fp->guru_id] = ($faseFLoadByGuru[$fp->guru_id] ?? 0) + $jp;
            }

            // Pre-process teacher capability profiles in memory
            $teacherProfiles = [];
            $teacherLoad = [];
            foreach ($teachers as $t) {
                $isWalikelas = $t->kelasPerwalian->where('academic_year', $tahunAjaran)->count() > 0;
                $tLoad = ($t->tugas_tambahan_jtm ?? 0) + ($isWalikelas ? 2 : 0) + ($faseFLoadByGuru[$t->id] ?? 0);
                $teacherLoad[$t->id] = $tLoad;

                $subjectIds = $t->mataPelajaranDiajarkan->pluck('id')->toArray();
                if (empty($subjectIds) && $t->specialization_id) {
                    $subjectIds = [(int)$t->specialization_id];
                }

                $specs = array_filter(array_map('trim', explode(',', strtolower($t->spesialisasi ?? ''))));

                $teacherProfiles[$t->id] = [
                    'model' => $t,
                    'subject_ids' => $subjectIds,
                    'specs' => $specs,
                    'allowed_grades' => $t->allowed_grades ?? [],
                    'start_year' => $t->entry_academic_year ? (int)explode('/', $t->entry_academic_year)[0] : 0,
                ];
            }

            // 3. Exact 18 Kurikulum Merdeka subject contracts for Grade X (Fase E - Umum)
            $mapelKelasXNames = [
                'Pendidikan Agama Islam dan Budi Pekerti',
                'Pendidikan Pancasila',
                'Bahasa Indonesia',
                'Matematika (Umum)',
                'Bahasa Inggris',
                'Pendidikan Jasmani, Olahraga, dan Kesehatan',
                'Bimbingan dan Konseling/Konselor (BP/BK)',
                'Muatan Lokal Bahasa Daerah',
                'Informatika',
                'Seni dan Budaya',
                'Sejarah',
                'Fisika',
                'Kimia',
                'Biologi',
                'Ekonomi',
                'Sosiologi',
                'Geografi',
                'Projek Penguatan Profil Pelajar Pancasila (P5)',
            ];

            // 4. Fetch target classrooms (Kelas X only)
            $classrooms = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                ->where('academic_year', $tahunAjaran)
                ->where('grade_level', 'X')
                ->orderBy('id')
                ->get();

            // Build all pending demand slots for Grade X (18 mapel x jumlah rombel)
            $pendingSlots = [];
            foreach ($classrooms as $kelas) {
                $subjects = \App\Models\MataPelajaran::where('status', 'aktif')
                    ->whereIn('nama', $mapelKelasXNames)
                    ->get();

                foreach ($subjects as $subject) {
                    $bebanJp = \App\Http\Controllers\TeachingAssignmentController::getMapelJp($subject->id, 'X');
                    $pendingSlots[] = [
                        'kelas' => $kelas,
                        'subject' => $subject,
                        'beban_jp' => $bebanJp,
                    ];
                }
            }

            // Candidate feasibility filter closure (blazing fast in-memory)
            $getFeasibleTeachers = function ($kelas, $subject, $bebanJp) use ($teacherProfiles, $teacherLoad, $targetStartYear, $MAX_JTM) {
                $feasible = [];
                $isP5 = ($subject->id == 32 || stripos($subject->nama, 'P5') !== false || stripos($subject->nama, 'Projek') !== false);
                $subName = strtolower($subject->nama);

                foreach ($teacherProfiles as $gId => $prof) {
                    if ($prof['start_year'] > 0 && $prof['start_year'] > $targetStartYear) {
                        continue;
                    }

                    if (!empty($prof['allowed_grades']) && !in_array($kelas->grade_level, $prof['allowed_grades'])) {
                        continue;
                    }

                    if ($isP5) {
                        if (($teacherLoad[$gId] ?? 0) + $bebanJp <= $MAX_JTM) {
                            $feasible[] = $prof['model'];
                        }
                        continue;
                    }

                    $canTeach = in_array($subject->id, $prof['subject_ids']);
                    if (!$canTeach && !empty($prof['specs'])) {
                        foreach ($prof['specs'] as $sp) {
                            if ($sp && (str_contains($subName, $sp) || str_contains($sp, $subName))) {
                                $canTeach = true;
                                break;
                            }
                        }
                    }

                    if (!$canTeach) {
                        continue;
                    }

                    if (($teacherLoad[$gId] ?? 0) + $bebanJp > $MAX_JTM) {
                        continue;
                    }

                    $feasible[] = $prof['model'];
                }
                return $feasible;
            };

            $totalAssignments = 0;
            $unassignedClasses = [];

            // Dynamic Scarcity-First Allocation Loop
            while (!empty($pendingSlots)) {
                // Compute candidate count for each pending slot
                foreach ($pendingSlots as $key => $slot) {
                    $candidates = $getFeasibleTeachers($slot['kelas'], $slot['subject'], $slot['beban_jp']);
                    $pendingSlots[$key]['feasible_count'] = count($candidates);
                }

                // Sort pending slots: candidate_count ASC, subject.id ASC, kelas.id ASC
                usort($pendingSlots, function ($a, $b) {
                    if ($a['feasible_count'] !== $b['feasible_count']) {
                        return $a['feasible_count'] <=> $b['feasible_count'];
                    }
                    if ($a['subject']->id !== $b['subject']->id) {
                        return $a['subject']->id <=> $b['subject']->id;
                    }
                    return $a['kelas']->id <=> $b['kelas']->id;
                });

                // Pick slot with highest scarcity (fewest feasible candidates)
                $slot = array_shift($pendingSlots);
                $candidates = $getFeasibleTeachers($slot['kelas'], $slot['subject'], $slot['beban_jp']);

                if (count($candidates) === 0) {
                    $unassignedClasses[] = "Kelas {$slot['kelas']->name} - {$slot['subject']->nama}";
                    continue;
                }

                // Deterministic candidate scoring:
                // 1. Homeroom teacher priority for P5 slots
                // 2. Projected total <= 30 JTM preferred
                // 3. Current teacherLoad ASC
                // 4. guru.id ASC tie-break
                usort($candidates, function ($a, $b) use ($teacherLoad, $slot, $TARGET_JTM) {
                    $isP5 = ($slot['subject']->id == 32 || stripos($slot['subject']->nama, 'P5') !== false);
                    if ($isP5) {
                        $isAHome = ($slot['kelas']->homeroom_teacher_id == $a->id) ? 0 : 1;
                        $isBHome = ($slot['kelas']->homeroom_teacher_id == $b->id) ? 0 : 1;
                        if ($isAHome !== $isBHome) {
                            return $isAHome <=> $isBHome;
                        }
                    }

                    $aUnderTarget = (($teacherLoad[$a->id] ?? 0) + $slot['beban_jp'] <= $TARGET_JTM) ? 0 : 1;
                    $bUnderTarget = (($teacherLoad[$b->id] ?? 0) + $slot['beban_jp'] <= $TARGET_JTM) ? 0 : 1;
                    if ($aUnderTarget !== $bUnderTarget) {
                        return $aUnderTarget <=> $bUnderTarget;
                    }
                    $loadA = $teacherLoad[$a->id] ?? 0;
                    $loadB = $teacherLoad[$b->id] ?? 0;
                    if ($loadA !== $loadB) {
                        return $loadA <=> $loadB;
                    }
                    return $a->id <=> $b->id;
                });

                $selectedTeacher = $candidates[0];

                DB::table('guru_kelas')->insert([
                    'guru_id' => $selectedTeacher->id,
                    'kelas_id' => $slot['kelas']->id,
                    'mata_pelajaran_id' => $slot['subject']->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $teacherLoad[$selectedTeacher->id] += $slot['beban_jp'];
                $totalAssignments++;
            }

            \App\Models\ActivityLog::log('TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran ' . $tahunAjaran . '. Terplot: ' . $totalAssignments . ' pemetaan.');

            DB::commit();

            if (count($unassignedClasses) > 0) {
                return redirect()->back()
                    ->with('success', "Plotting selesai! {$totalAssignments} pemetaan berhasil.")
                    ->with('unassigned', $unassignedClasses);
            }

            return redirect()->back()
                ->with('success', "Plotting otomatis selesai! Semua {$totalAssignments} pemetaan kelas dan mata pelajaran berhasil dialokasikan secara optimal.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat melakukan Auto-Plot: ' . $e->getMessage());
        }
    }
}
