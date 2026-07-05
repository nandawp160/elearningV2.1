<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view_siswa');

        $query = Siswa::query();

        $students = Siswa::with(['user', 'relasiKelas.waliKelas'])
                           ->orderBy('kelas', 'asc')
                           ->orderBy('nama', 'asc')
                           ->get();
        $pendingCount = Siswa::where('status', 'inactive')->count();
        $classList = \App\Models\Kelas::orderBy('name', 'asc')->get();
        $tahunLulusList = Siswa::whereNotNull('tahun_lulus')->distinct()->pluck('tahun_lulus')->sort()->values();
        
        $kelasSorter = function($a, $b) {
            $map = ['X' => 10, 'XI' => 11, 'XII' => 12];
            $tA = $map[strtoupper(explode(' ', trim($a))[0] ?? '')] ?? 99;
            $tB = $map[strtoupper(explode(' ', trim($b))[0] ?? '')] ?? 99;
            if ($tA === $tB) return strnatcmp($a, $b);
            return $tA <=> $tB;
        };

        $daftarKelasAsal = Siswa::active()->pluck('kelas')->filter()->unique()->sort($kelasSorter)->values();

        return view('siswa.index', compact('students', 'pendingCount', 'classList', 'tahunLulusList', 'daftarKelasAsal'));
    }

    public function create()
    {
        Gate::authorize('create_siswa');

        $classList = \App\Models\Kelas::orderBy('name', 'asc')->get();
        return view('siswa.create', compact('classList'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create_siswa');

        $request->validate([
            'nis' => [
                'required',
                'string',
                'max:20',
                'unique:siswa,nis',
                function ($attribute, $value, $fail) {
                    $email = $value . '@siswa.smansago.com';
                    $user = User::where('email', $email)->first();
                    if ($user) {
                        if ($user->student) {
                            $fail('NIS ini sudah digunakan oleh siswa lain.');
                        } elseif ($user->role !== 'siswa') {
                            $fail('Email yang dihasilkan dari NIS ini sudah digunakan oleh akun non-siswa.');
                        }
                    }
                },
            ],
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'date_of_birth' => 'required|date',
            'kelas' => 'required|string|max:50',
            'parent_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive,lulus',
            
            // Mutasi Masuk Fields
            'is_pindahan' => 'nullable|boolean',
            'asal_sekolah' => 'nullable|required_if:is_pindahan,1|string|max:255',
            'tanggal_masuk' => 'nullable|required_if:is_pindahan,1|date',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'name.required' => 'Nama wajib diisi.',
            'gender.required' => 'Jenis Kelamin wajib dipilih.',
            'date_of_birth.required' => 'Tanggal Lahir wajib diisi.',
            'kelas.required' => 'Kelas wajib dipilih/diisi.',
            'asal_sekolah.required_if' => 'Asal sekolah wajib diisi jika siswa pindahan.',
            'tanggal_masuk.required_if' => 'Tanggal masuk wajib diisi jika siswa pindahan.',
        ]);

        try {
            DB::beginTransaction();

            // Create login user account
            $email = $request->nis . '@siswa.smansago.com';

            // Clean up orphaned user if exists
            $existingUser = User::where('email', $email)->first();
            if ($existingUser) {
                if (!$existingUser->student) {
                    $existingUser->delete();
                }
            }

            $user = User::create([
                'nama' => $request->name,
                'email' => $email,
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'siswa'
            ]);

            // Create Student Profile
            $siswa = Siswa::create([
                'nis' => $request->nis,
                'nama' => $request->name,
                'jenis_kelamin' => $request->gender,
                'tanggal_lahir' => $request->date_of_birth,
                'kelas' => $request->kelas,
                'nama_ortu' => $request->parent_name,
                'no_hp_ortu' => $request->phone,
                'alamat' => $request->address,
                'status' => $request->status === 'active' ? 'aktif' : 'nonaktif',
                'pengguna_id' => $user->id,
                'entry_year' => date('Y')
            ]);

            if ($request->has('is_pindahan') && $request->is_pindahan) {
                \App\Models\MutasiSiswa::create([
                    'siswa_id' => $siswa->id,
                    'jenis_mutasi' => 'masuk',
                    'tanggal_mutasi' => $request->tanggal_masuk,
                    'keterangan_sekolah' => $request->asal_sekolah,
                    'alasan' => 'Siswa pindahan',
                ]);
            }

            \App\Models\ActivityLog::log('STUDENT', 'Menambahkan data siswa baru: ' . $request->name . ' (NIS: ' . $request->nis . ')');

            DB::commit();

            return redirect()->route('students.index')->with('success', 'Data siswa dan akun berhasil ditambahkan! Password default: password');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan data siswa: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Siswa $student)
    {
        Gate::authorize('view_siswa');

        return view('siswa.show', compact('student'));
    }

    public function edit(Siswa $student)
    {
        Gate::authorize('edit_siswa');

        $classList = \App\Models\Kelas::orderBy('name', 'asc')->get();
        return view('siswa.edit', compact('student', 'classList'));
    }

    public function update(Request $request, Siswa $student)
    {
        Gate::authorize('edit_siswa');

        $request->validate([
            'nis' => [
                'required',
                'string',
                'max:20',
                'unique:siswa,nis,' . $student->id,
                function ($attribute, $value, $fail) use ($student) {
                    $email = $value . '@siswa.smansago.com';
                    $user = User::where('email', $email)->first();
                    if ($user && $user->id !== $student->pengguna_id) {
                        if ($user->student) {
                            $fail('NIS ini sudah digunakan oleh siswa lain.');
                        } elseif ($user->role !== 'siswa') {
                            $fail('Email yang dihasilkan dari NIS ini sudah digunakan oleh akun non-siswa.');
                        }
                    }
                },
            ],
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'date_of_birth' => 'required|date',
            'kelas' => 'required|string|max:50',
            'parent_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive,lulus,mutasi',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'name.required' => 'Nama wajib diisi.',
            'gender.required' => 'Jenis Kelamin wajib dipilih.',
            'date_of_birth.required' => 'Tanggal Lahir wajib diisi.',
            'kelas.required' => 'Kelas wajib dipilih/diisi.',
        ]);

        try {
            DB::beginTransaction();

            // Update associated User account if exists
            if ($student->pengguna_id) {
                $user = User::find($student->pengguna_id);
                if ($user) {
                    $newEmail = $request->nis . '@siswa.smansago.com';

                    // Clean up orphaned user if exists and is different from current student's user
                    $otherUser = User::where('email', $newEmail)->where('id', '!=', $user->id)->first();
                    if ($otherUser) {
                        if (!$otherUser->student) {
                            $otherUser->delete();
                        }
                    }

                    $user->update([
                        'nama' => $request->name,
                        'email' => $newEmail,
                    ]);
                }
            } else {
                // Create login user account if somehow missing
                $email = $request->nis . '@siswa.smansago.com';

                // Clean up orphaned user if exists
                $existingUser = User::where('email', $email)->first();
                if ($existingUser) {
                    if (!$existingUser->student) {
                        $existingUser->delete();
                    }
                }

                if (!User::where('email', $email)->exists()) {
                    $user = User::create([
                        'nama' => $request->name,
                        'email' => $email,
                        'password' => \Illuminate\Support\Facades\Hash::make('password'),
                        'role' => 'siswa'
                    ]);
                    $student->pengguna_id = $user->id;
                }
            }

            // Update student profile
            $student->update([
                'nis' => $request->nis,
                'nama' => $request->name,
                'jenis_kelamin' => $request->gender,
                'tanggal_lahir' => $request->date_of_birth,
                'kelas' => $request->kelas,
                'nama_ortu' => $request->parent_name,
                'no_hp_ortu' => $request->phone,
                'alamat' => $request->address,
                'status' => $request->status, // Model handles active/inactive mapping to aktif/nonaktif
            ]);

            \App\Models\ActivityLog::log('STUDENT', 'Memperbarui data siswa: ' . $student->nama . ' (NIS: ' . $student->nis . ')');

            DB::commit();

            return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data siswa: ' . $e->getMessage())->withInput();
        }
    }

    public function approveAll()
    {
        Gate::authorize('edit_siswa');

        try {
            DB::beginTransaction();

            // Get all inactive students
            $inactiveStudents = Siswa::where('status', 'inactive')->get();
            $count = $inactiveStudents->count();

            if ($count === 0) {
                return redirect()->route('students.index')->with('info', 'Tidak ada siswa yang perlu disetujui.');
            }

            // Generate unique batch ID
            $batchId = 'ACC-BATCH-' . date('YmdHis') . '-' . strtoupper(bin2hex(random_bytes(2)));

            // Update all inactive students status and batch
            Siswa::where('status', 'inactive')->update([
                'status' => 'active',
                'acc_batch_id' => $batchId
            ]);

            \App\Models\ActivityLog::log('STUDENT', 'Menyetujui secara massal ' . $count . ' pendaftaran akun siswa baru (Batch ID: ' . $batchId . ')');

            DB::commit();

            return redirect()->route('students.index', ['status' => 'inactive'])->with('success', "Berhasil menyetujui (ACC) {$count} siswa dengan Batch ID: {$batchId}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyetujui semua siswa: ' . $e->getMessage());
        }
    }

    public function approve(Siswa $student)
    {
        Gate::authorize('edit_siswa');

        try {
            DB::beginTransaction();

            // Generate unique manual ID
            $manualId = 'ACC-MANUAL-' . date('YmdHis') . '-' . strtoupper(bin2hex(random_bytes(2)));

            // Update student status and batch
            $student->update([
                'status' => 'active',
                'acc_batch_id' => $manualId
            ]);

            \App\Models\ActivityLog::log('STUDENT', 'Menyetujui pendaftaran akun siswa: ' . $student->nama . ' (NIS: ' . $student->nis . ')');

            DB::commit();

            return redirect()->route('students.index', ['status' => 'inactive'])->with('success', 'Siswa ' . $student->name . " berhasil disetujui (ACC)! ID: {$manualId}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyetujui siswa: ' . $e->getMessage());
        }
    }

    public function generateAccounts()
    {
        Gate::authorize('edit_siswa');

        try {
            DB::beginTransaction();
            $studentsWithoutAccounts = Siswa::whereNull('pengguna_id')->get();
            $count = 0;
            
            foreach ($studentsWithoutAccounts as $student) {
                $email = $student->nis . '@siswa.smansago.com';
                
                // Clean up orphaned user if exists
                $existingUser = User::where('email', $email)->first();
                if ($existingUser) {
                    if (!$existingUser->student) {
                        $existingUser->delete();
                    }
                }

                // Skip if email already exists
                if (User::where('email', $email)->exists()) {
                    continue;
                }
                
                $user = User::create([
                    'nama' => $student->nama,
                    'email' => $email,
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'role' => 'siswa'
                ]);
                
                $student->update(['pengguna_id' => $user->id]);
                $count++;
            }
            
            \App\Models\ActivityLog::log('STUDENT', 'Men-generate ' . $count . ' akun login siswa secara otomatis');

            DB::commit();
            return redirect()->route('students.index')->with('success', "Berhasil men-generate $count akun siswa otomatis! Password default: password");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal generate akun otomatis: ' . $e->getMessage());
        }
    }

    public function destroy(Siswa $student)
    {
        Gate::authorize('delete_siswa');

        try {
            DB::beginTransaction();

            if ($student->pengguna_id) {
                $user = User::find($student->pengguna_id);
                if ($user) {
                    $user->delete();
                }
            }

            \App\Models\ActivityLog::log('DELETION', 'Menghapus data siswa: ' . $student->nama . ' (NIS: ' . $student->nis . ')');

            $student->delete();

            DB::commit();
            return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data siswa: ' . $e->getMessage());
        }
    }

    public function autoPlot(Request $request)
    {
        Gate::authorize('edit_siswa');

        $request->validate([
            'tahun_ajaran' => ['required', 'string', 'regex:/^\d{4}\/\d{4}$/'],
        ], [
            'tahun_ajaran.required' => 'Tahun ajaran target harus diisi.',
            'tahun_ajaran.regex' => 'Format tahun ajaran tidak valid.',
        ]);

        $tahunAjaran = $request->input('tahun_ajaran');

        try {
            DB::beginTransaction();

            // Ambil semua siswa aktif
            $students = Siswa::where('status', 'aktif')->get();

            $plottedCount = 0;
            $createdClasses = [];
            $skippedCount = 0;

            foreach ($students as $student) {
                $rawKelas = trim($student->kelas);

                if (empty($rawKelas)) {
                    $skippedCount++;
                    continue;
                }

                // 1. Cek format kelas spesifik: e.g. "X IPA 1", "XI IPS 2", "XII Bahasa 1"
                if (preg_match('/^(X|XI|XII)\s+(IPA|IPS|Bahasa)\s+(\d+)$/i', $rawKelas, $matches)) {
                    $tingkat = strtoupper($matches[1]);
                    $jurusan = $matches[2];
                    $nomor = $matches[3];
                    $className = "{$tingkat} {$jurusan} {$nomor}";

                    // Cari atau buat kelas target untuk tahun ajaran terpilih
                    $classroom = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                        ->where('name', $className)
                        ->where('academic_year', $tahunAjaran)
                        ->first();

                    if (!$classroom) {
                        $classroom = Kelas::create([
                            'name' => $className,
                            'grade_level' => $tingkat,
                            'major' => $jurusan,
                            'academic_year' => $tahunAjaran,
                            'max_students' => 36, // kapasitas default
                        ]);
                        $createdClasses[] = $className;
                    }

                    // Assign siswa ke kelas tersebut
                    if ($student->kelas !== $classroom->name) {
                        $student->update(['kelas' => $classroom->name]);
                        $plottedCount++;
                    }
                    continue;
                }

                // 3. Cek format tingkat saja tanpa jurusan: e.g. "X", "XI", "XII"
                if (preg_match('/^(X|XI|XII)$/i', $rawKelas, $matches)) {
                    $tingkat = strtoupper($matches[1]);

                    // Cari semua kelas untuk tingkat tersebut di tahun ajaran target
                    $classrooms = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                        ->where('grade_level', $tingkat)
                        ->where('academic_year', $tahunAjaran)
                        ->get();

                    if ($classrooms->isNotEmpty()) {
                        // Urutkan kelas berdasarkan jumlah siswa terkecil agar pembagian merata
                        $classroomList = [];
                        foreach ($classrooms as $room) {
                            $studentCount = Siswa::where('kelas', $room->name)
                                ->where('status', 'aktif')
                                ->count();
                            $classroomList[] = [
                                'room' => $room,
                                'count' => $studentCount
                            ];
                        }
                        
                        // Urutkan menaik berdasarkan jumlah siswa
                        usort($classroomList, function($a, $b) {
                            return $a['count'] <=> $b['count'];
                        });

                        foreach ($classroomList as $item) {
                            $room = $item['room'];
                            $currentCount = $item['count'];

                            if ($currentCount < $room->max_students) {
                                $student->update(['kelas' => $room->name]);
                                $plottedCount++;
                                break;
                            }
                        }
                    }
                    continue;
                }

                // 2. Cek format kelas umum/kelompok: e.g. "X IPA", "XI IPS"
                if (preg_match('/^(X|XI|XII)\s+(IPA|IPS|Bahasa)$/i', $rawKelas, $matches)) {
                    $tingkat = strtoupper($matches[1]);
                    $jurusan = $matches[2];

                    // Cari kelas yang sudah ada untuk tingkat dan jurusan tersebut di tahun ajaran target
                    $classrooms = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                        ->where('grade_level', $tingkat)
                        ->where('major', $jurusan)
                        ->where('academic_year', $tahunAjaran)
                        ->get();

                    $assigned = false;

                    if ($classrooms->isNotEmpty()) {
                        // Urutkan kelas berdasarkan jumlah siswa terkecil agar pembagian merata
                        $classroomList = [];
                        foreach ($classrooms as $room) {
                            // Hanya hitung siswa yang statusnya aktif, jangan hitung alumni/lulus
                            $studentCount = Siswa::where('kelas', $room->name)
                                ->where('status', 'aktif')
                                ->count();
                            $classroomList[] = [
                                'room' => $room,
                                'count' => $studentCount
                            ];
                        }
                        
                        // Urutkan menaik berdasarkan jumlah siswa
                        usort($classroomList, function($a, $b) {
                            return $a['count'] <=> $b['count'];
                        });

                        foreach ($classroomList as $item) {
                            $room = $item['room'];
                            $currentCount = $item['count'];

                            if ($currentCount < $room->max_students) {
                                $student->update(['kelas' => $room->name]);
                                $plottedCount++;
                                $assigned = true;
                                break;
                            }
                        }
                    }

                    // Jika belum ada kelas sama sekali, atau semua kelas sudah penuh, buat kelas baru
                    if (!$assigned) {
                        // Cari nomor kelas berikutnya
                        $existingCount = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                            ->where('grade_level', $tingkat)
                            ->where('major', $jurusan)
                            ->where('academic_year', $tahunAjaran)
                            ->count();
                        
                        $nextNum = $existingCount + 1;
                        $className = "{$tingkat} {$jurusan} {$nextNum}";

                        $classroom = Kelas::create([
                            'name' => $className,
                            'grade_level' => $tingkat,
                            'major' => $jurusan,
                            'academic_year' => $tahunAjaran,
                            'max_students' => 36,
                        ]);
                        
                        $createdClasses[] = $className;
                        $student->update(['kelas' => $classroom->name]);
                        $plottedCount++;
                    }
                    continue;
                }

                // 3. Format tidak valid
                $skippedCount++;
            }

            \App\Models\ActivityLog::log('STUDENT', 'Melakukan plotting siswa otomatis ke kelas untuk Tahun Ajaran ' . $tahunAjaran . '. Terplot: ' . $plottedCount . ' siswa');

            DB::commit();

            $msg = "Plotting siswa selesai! Berhasil mem-plot {$plottedCount} siswa.";
            if ($skippedCount > 0) {
                $msg .= " Sebanyak {$skippedCount} siswa dilewati karena format kelas tidak valid/kosong.";
            }
            if (count($createdClasses) > 0) {
                $msg .= " Berhasil membuat kelas baru: " . implode(', ', array_unique($createdClasses));
            }

            return redirect()->route('students.index')->with('success', $msg);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal melakukan plotting otomatis: ' . $e->getMessage());
        }
    }

    public function getByClasses(Request $request)
    {
        Gate::authorize('view_siswa');

        $daftarKelas = $request->input('kelas', []);
        if (is_string($daftarKelas)) {
            $daftarKelas = array_filter(explode(',', $daftarKelas));
        }

        $students = Siswa::whereIn('kelas', $daftarKelas)
            ->active()
            ->get(['id', 'nis', 'nama', 'kelas'])
            ->sort(function ($a, $b) {
                $map = ['X' => 10, 'XI' => 11, 'XII' => 12];
                $tA = $map[strtoupper(explode(' ', trim($a->kelas))[0] ?? '')] ?? 99;
                $tB = $map[strtoupper(explode(' ', trim($b->kelas))[0] ?? '')] ?? 99;
                
                $classComparison = ($tA === $tB) ? strnatcmp($a->kelas, $b->kelas) : ($tA <=> $tB);
                
                if ($classComparison === 0) {
                    return strcasecmp($a->nama, $b->nama);
                }
                return $classComparison;
            })
            ->values();

        return response()->json($students);
    }

    public function bulkGraduate(Request $request)
    {
        Gate::authorize('edit_siswa');

        $request->validate([
            'kelas' => 'required|array',
            'id_siswa' => 'nullable|array',
        ]);

        $daftarKelas = $request->input('kelas');
        $idSiswaArray = $request->input('id_siswa', []);

        if (!$request->has('id_siswa') && empty($idSiswaArray)) {
            return redirect()->route('students.index')->with('error', 'Tidak ada siswa yang dipilih untuk kelulusan.');
        }

        try {
            DB::beginTransaction();

            $studentsToGraduate = Siswa::whereIn('kelas', $daftarKelas)
                ->whereIn('id', $idSiswaArray)
                ->active()
                ->get();

            $count = $studentsToGraduate->count();
            $tahunLulus = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', date('Y'));

            if ($count > 0) {
                foreach ($studentsToGraduate as $student) {
                    $student->update([
                        'status' => 'lulus',
                        'kelas' => null,
                        'tahun_lulus' => $tahunLulus
                    ]);
                }
            }

            \App\Models\ActivityLog::log('STUDENT', 'Melakukan kelulusan massal untuk ' . $count . ' siswa dari kelas: ' . implode(', ', $daftarKelas));

            DB::commit();
            return redirect()->route('students.index')->with('success', "$count siswa berhasil diluluskan.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal meluluskan siswa: ' . $e->getMessage());
        }
    }

    public function bulkPromote(Request $request)
    {
        Gate::authorize('edit_siswa');

        $request->validate([
            'mapping' => 'required|array',
            'mapping.*.asal' => 'required|string',
            'mapping.*.tujuan' => 'nullable|string',
        ]);

        $mappings = collect($request->input('mapping'))->filter(function ($map) {
            return !empty($map['tujuan']);
        })->sortByDesc(function ($map) {
            $mapGrade = ['X' => 10, 'XI' => 11, 'XII' => 12];
            $asalClass = trim($map['asal']);
            $firstWord = explode(' ', $asalClass)[0];
            $cleanGrade = preg_replace('/[^A-Z]/i', '', $firstWord);
            return $mapGrade[strtoupper($cleanGrade)] ?? 99;
        });

        if ($mappings->isEmpty()) {
            return redirect()->route('students.index')->with('error', 'Tidak ada mapping kelas tujuan yang dipilih untuk kenaikan kelas.');
        }

        // Verifikasi apakah kelas tujuan sudah dibuat untuk Tahun Ajaran Aktif
        $targetClasses = $mappings->pluck('tujuan')->unique()->toArray();
        $existingClasses = \App\Models\Kelas::whereIn('name', $targetClasses)->pluck('name')->toArray();
        $missingClasses = array_diff($targetClasses, $existingClasses);

        if (!empty($missingClasses)) {
            return redirect()->route('students.index')->with('error', 'Kelas tujuan berikut belum dibuat di master Kelas: ' . implode(', ', $missingClasses));
        }

        try {
            DB::beginTransaction();

            $totalPromoted = 0;
            $logDetails = [];

            foreach ($mappings as $map) {
                $asal = $map['asal'];
                $tujuan = $map['tujuan'];

                $updated = Siswa::where('kelas', $asal)->active()->update([
                    'kelas' => $tujuan
                ]);

                if ($updated > 0) {
                    $totalPromoted += $updated;
                    $logDetails[] = "$asal -> $tujuan ($updated siswa)";
                }
            }

            if ($totalPromoted > 0) {
                \App\Models\ActivityLog::log('STUDENT', 'Melakukan kenaikan kelas massal untuk ' . $totalPromoted . ' siswa. Detail: ' . implode(', ', $logDetails));
            }

            DB::commit();
            return redirect()->route('students.index')->with('success', "$totalPromoted siswa berhasil dinaikkan kelasnya secara massal.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menaikkan kelas siswa: ' . $e->getMessage());
        }
    }

    public function prosesMutasiKeluar(Request $request, Siswa $student)
    {
        Gate::authorize('edit_siswa');

        $request->validate([
            'jenis_mutasi' => 'required|in:keluar,dikeluarkan,mengundurkan diri',
            'tanggal_mutasi' => 'required|date',
            'keterangan_sekolah' => 'nullable|string|max:255',
            'alasan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Insert into MutasiSiswa
            \App\Models\MutasiSiswa::create([
                'siswa_id' => $student->id,
                'jenis_mutasi' => $request->jenis_mutasi,
                'tanggal_mutasi' => $request->tanggal_mutasi,
                'keterangan_sekolah' => $request->keterangan_sekolah,
                'alasan' => $request->alasan,
            ]);

            // Update Siswa
            $student->update([
                'status' => 'mutasi',
                'kelas' => null
            ]);

            // Nonaktifkan User account jika ada
            if ($student->user) {
                // Not actually deleting, maybe change status if User model has it. Or we just leave it, since it's checked via student->status.
                // However, standard practice might be to remove role or something. Let's just keep it as is.
            }

            \App\Models\ActivityLog::log('STUDENT', "Memproses mutasi keluar untuk {$student->nama} (NIS: {$student->nis})");

            DB::commit();

            return redirect()->route('students.index')->with('success', 'Berhasil memproses mutasi siswa.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses mutasi: ' . $e->getMessage());
        }
    }
}

