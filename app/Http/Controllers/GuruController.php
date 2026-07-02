<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GuruController extends Controller
{
    public function index()
    {
        Gate::authorize('view_guru');

        $teachers = Guru::with(['mataPelajaran', 'kelasDiampu', 'teachingAssignments.kelas', 'teachingAssignments.subject'])->get();
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
            'email' => 'required|email|unique:guru,email',
            'phone' => 'required|string|max:20',
            'specialization_id' => 'nullable|exists:mata_pelajaran,id',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'tugas_tambahan_jtm' => 'nullable|integer|min:0',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'allowed_grades' => 'nullable|array',
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
            Guru::create([
                'nip' => $request->nip,
                'nama' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->phone,
                'specialization_id' => $request->specialization_id,
                'alamat' => $request->address,
                'status' => $request->status === 'active' ? 'aktif' : 'nonaktif',
                'pengguna_id' => $user->id,
                'tugas_tambahan_jtm' => $request->tugas_tambahan_jtm ?? 0,
                'allowed_grades' => $request->allowed_grades ?? [],
            ]);

            \App\Models\ActivityLog::log('TEACHER', 'Menambahkan data guru baru: ' . $request->name . ' (NIP: ' . $request->nip . ')');

            DB::commit();

            return redirect()->route('teachers.index')
                ->with('success', 'Data guru dan akun berhasil ditambahkan! Password default: password');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan guru: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Guru $teacher)
    {
        Gate::authorize('view_guru');

        $classrooms = \App\Models\Kelas::orderBy('name')->get();
        return view('guru.show', compact('teacher', 'classrooms'));
    }

    public function edit(Guru $teacher)
    {
        Gate::authorize('edit_guru');

        $courses = \App\Models\MataPelajaran::where('status', 'aktif')->orderBy('nama')->get();
        $classrooms = \App\Models\Kelas::orderBy('name')->get();
        return view('guru.edit', compact('teacher', 'courses', 'classrooms'));
    }

    public function update(Request $request, Guru $teacher)
    {
        Gate::authorize('edit_guru');

        $request->validate([
            'nip' => 'required|unique:guru,nip,' . $teacher->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email,' . $teacher->id,
            'phone' => 'required|string|max:20',
            'specialization_id' => 'nullable|exists:mata_pelajaran,id',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'tugas_tambahan_jtm' => 'nullable|integer|min:0',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'allowed_grades' => 'nullable|array',
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
                'specialization_id' => $request->specialization_id,
                'alamat' => $request->address,
                'status' => $request->status, // Model handles active/inactive mapping
                'tugas_tambahan_jtm' => $request->tugas_tambahan_jtm ?? 0,
                'allowed_grades' => $request->allowed_grades ?? [],
            ]);

            \App\Models\ActivityLog::log('TEACHER', 'Memperbarui data guru: ' . $teacher->nama . ' (NIP: ' . $teacher->nip . ')');

            DB::commit();

            return redirect()->route('teachers.index')
                ->with('success', 'Data guru berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data guru: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Guru $teacher)
    {
        Gate::authorize('delete_guru');

        try {
            DB::beginTransaction();

            if ($teacher->pengguna_id) {
                $user = User::find($teacher->pengguna_id);
                if ($user) {
                    $user->delete();
                }
            }

            \App\Models\ActivityLog::log('DELETION', 'Menghapus data guru: ' . $teacher->nama . ' (NIP: ' . $teacher->nip . ')');

            $teacher->delete();

            DB::commit();
            return redirect()->route('teachers.index')
                ->with('success', 'Data guru berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data guru: ' . $e->getMessage());
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

        try {
            DB::beginTransaction();

            // 1. Clear existing mappings for classes in target academic year
            DB::table('guru_kelas')
                ->whereIn('kelas_id', function ($query) use ($tahunAjaran) {
                    $query->select('id')
                        ->from('kelas')
                        ->where('academic_year', $tahunAjaran);
                })
                ->delete();

            // 2. Fetch all active teachers that have a specialization_id
            $teachers = Guru::active()
                ->whereNotNull('specialization_id')
                ->with('mataPelajaran')
                ->get();

            // Normalisasi Base Subject Name dan kumpulkan ke dalam pool
            $groupedTeachers = [];
            foreach ($teachers as $t) {
                if (!$t->mataPelajaran) continue;
                $mapelName = $t->mataPelajaran->nama;
                
                // Normalisasi nama dasar: Hilangkan X, XI, XII dan (Wajib)/(Peminatan)
                $base = preg_replace('/\s*\b(X|XI|XII)\b\s*/i', '', $mapelName);
                $base = preg_replace('/\s*\b(Kelas)\b\s*/i', ' ', $base);
                $base = preg_replace('/\s*\((Wajib|Peminatan)\)\s*/i', ' ', $base);
                $base = str_ireplace(' dan ', ' ', $base);
                $base = trim($base);
                
                // Penyesuaian khusus untuk Matematika agar Peminatan dan Wajib terpisah jika eksplisit
                if (stripos($base, 'Matematika') !== false) {
                    if (stripos($mapelName, 'Peminatan') !== false) {
                        $base = 'Matematika Peminatan';
                    } else {
                        $base = 'Matematika';
                    }
                }
                
                $groupedTeachers[$base][] = $t;
            }

            $totalAssignments = 0;
            $unassignedClasses = [];

            // 3. Ambil semua kelas di tahun ajaran target (Prioritaskan kelas XII, XI, X)
            $allClassrooms = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                ->where('academic_year', $tahunAjaran)
                ->orderByRaw("FIELD(grade_level, 'XII', 'XI', 'X')") 
                ->orderBy('name')
                ->get();

            // 4. Ambil semua mata pelajaran yang ada (sebagai kebutuhan kelas)
            $allSubjects = \App\Models\MataPelajaran::where('status', 'aktif')->get();

            // Iterasi per Mata Pelajaran Kebutuhan
            foreach ($allSubjects as $subject) {
                $subjectName = strtolower($subject->nama);
                $grade = $subject->tingkat; // 'X', 'XI', 'XII'
                $bebanJp = $subject->beban_jp ?? 4;
                
                // Dapatkan Base Subject dari Mata Pelajaran ini
                $reqBase = preg_replace('/\s*\b(X|XI|XII)\b\s*/i', '', $subject->nama);
                $reqBase = preg_replace('/\s*\b(Kelas)\b\s*/i', ' ', $reqBase);
                $reqBase = preg_replace('/\s*\((Wajib|Peminatan)\)\s*/i', ' ', $reqBase);
                $reqBase = str_ireplace(' dan ', ' ', $reqBase);
                $reqBase = trim($reqBase);
                if (stripos($reqBase, 'Matematika') !== false) {
                    if (stripos($subject->nama, 'Peminatan') !== false) $reqBase = 'Matematika Peminatan';
                    else $reqBase = 'Matematika';
                }

                // Cek apakah ada pool guru untuk Base Subject ini
                if (!isset($groupedTeachers[$reqBase])) continue;
                $teachersList = $groupedTeachers[$reqBase];

                // Di Kurikulum Merdeka, penjurusan IPA/IPS sudah dihapuskan.
                // Mata pelajaran pilihan (Fisika, Sosiologi, dll) dapat diajarkan di kelas Fase F mana saja
                // sehingga pembatasan majorConstraint dihilangkan.

                // Cari kelas-kelas yang membutuhkan mata pelajaran ini (berdasarkan tingkat kelas saja)
                $targetClasses = $allClassrooms->filter(function($c) use ($grade) {
                    if ($c->grade_level !== $grade) return false;
                    return true;
                });

                if ($targetClasses->isEmpty()) continue;

                // Hitung beban JTM berjalan (inisialisasi dari database / existing load)
                $teacherLoad = [];
                foreach ($teachersList as $t) {
                    $awalJtm = ($t->tugas_tambahan_jtm ?? 0) + ($t->kelasPerwalian()->where('academic_year', $tahunAjaran)->count() > 0 ? 2 : 0);
                    // Tambahkan beban dari plot yang sudah ada di tabel untuk guru ini di tahun ajaran tsb
                    // (Karena kita memproses secara bertahap, kita hitung akumulasinya)
                    $existingPlotJtm = DB::table('guru_kelas')
                        ->join('kelas', 'guru_kelas.kelas_id', '=', 'kelas.id')
                        ->where('guru_kelas.guru_id', $t->id)
                        ->where('kelas.academic_year', $tahunAjaran)
                        ->count() * 4; // Asumsi beban default 4 JTM per rombel
                        
                    $teacherLoad[$t->id] = $awalJtm + $existingPlotJtm;
                }

                foreach ($targetClasses as $c) {
                    $selectedTeacherId = null;
                    
                    // Filter guru yang diizinkan mengajar di tingkat kelas ini ($grade)
                    $eligibleTeachers = collect($teachersList)->filter(function($t) use ($grade) {
                        if (is_array($t->allowed_grades) && count($t->allowed_grades) > 0) {
                            return in_array($grade, $t->allowed_grades);
                        }
                        return true; // Jika allowed_grades kosong, asumsikan bisa mengajar semua tingkat
                    });
                    
                    // Filter candidate berdasarkan Load (<= 24 JTM atau <= 40 JTM)
                    $candidateIds = $eligibleTeachers->pluck('id')->toArray();
                    $filteredLoad = collect($teacherLoad)->filter(function($jtm, $id) use ($candidateIds) {
                        return in_array($id, $candidateIds);
                    });

                    // Phase 1: <= 24 JTM
                    $candidate1 = $filteredLoad->filter(fn($jtm) => ($jtm + $bebanJp) <= 24)->sort()->keys()->first();
                    if ($candidate1) {
                        $selectedTeacherId = $candidate1;
                    } else {
                        // Phase 2: <= 40 JTM
                        $candidate2 = $filteredLoad->filter(fn($jtm) => ($jtm + $bebanJp) <= 40)->sort()->keys()->first();
                        if ($candidate2) {
                            $selectedTeacherId = $candidate2;
                        }
                    }

                    if ($selectedTeacherId) {
                        DB::table('guru_kelas')->insert([
                            'guru_id' => $selectedTeacherId,
                            'kelas_id' => $c->id,
                            'mata_pelajaran_id' => $subject->id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        $teacherLoad[$selectedTeacherId] += $bebanJp;
                        $totalAssignments++;
                    } else {
                        $unassignedClasses[] = "Kelas {$c->name} ({$subject->nama}) - Load Guru Penuh/Tidak Ada Tagging";
                    }
                }
            }

            \App\Models\ActivityLog::log('TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran ' . $tahunAjaran . '. Terplot: ' . $totalAssignments . ' pemetaan mengajar');

            DB::commit();

            if (count($unassignedClasses) > 0) {
                return redirect()->route('teachers.index')
                    ->with('success', "Plotting sebagian selesai! {$totalAssignments} pemetaan berhasil.")
                    ->with('unassigned', $unassignedClasses);
            }

            return redirect()->route('teachers.index')->with('success', "Plotting guru otomatis selesai! Berhasil memetakan {$totalAssignments} kelas mengajar tanpa ada yang kosong.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal melakukan plotting mengajar otomatis: ' . $e->getMessage());
        }
    }
}
