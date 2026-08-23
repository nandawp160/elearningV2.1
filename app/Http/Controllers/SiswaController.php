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

        $selectedYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');

        $hasYearHistory = \App\Models\RiwayatKelasSiswa::where('academic_year', $selectedYear)
            ->whereHas('siswa', function($q) {
                $q->where('status', '!=', 'Lulus');
            })->exists();

        $studentsQuery = Siswa::with(['user', 'relasiKelas.waliKelas'])
                           ->where('status', '!=', 'Lulus');

        if ($hasYearHistory) {
            $studentsQuery->whereHas('riwayatKelas', function($q) use ($selectedYear) {
                $q->where('academic_year', $selectedYear);
            });
        }

        $students = $studentsQuery->orderBy('kelas', 'asc')
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

            // Record Class History
            $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', date('Y') . '/' . (date('Y') + 1));
            \App\Models\RiwayatKelasSiswa::create([
                'siswa_id' => $siswa->id,
                'kelas_name' => $request->kelas,
                'academic_year' => $activeYear,
            ]);

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

            // Record or Update Class History for current active year
            $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', date('Y') . '/' . (date('Y') + 1));
            \App\Models\RiwayatKelasSiswa::updateOrCreate(
                [
                    'siswa_id' => $student->id,
                    'academic_year' => $activeYear,
                ],
                [
                    'kelas_name' => $request->kelas,
                ]
            );

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

        // Get all inactive students
        $inactiveStudents = Siswa::where('status', 'inactive')->get();
        $count = $inactiveStudents->count();

        if ($count === 0) {
            return redirect()->route('students.index')->with('info', 'Tidak ada siswa yang perlu disetujui.');
        }

        try {
            DB::beginTransaction();

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
            $defaultPasswordHash = \Illuminate\Support\Facades\Hash::make('password');
            $now = now();
            
            foreach ($studentsWithoutAccounts as $student) {
                // Generate uniform email: nama_depan.nis@siswa.smansago.com
                $words = preg_split('/\s+/', trim($student->nama));
                $words = array_values(array_filter($words, fn($w) => !empty($w)));
                
                $cleanFirst = !empty($words[0]) ? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $words[0])) : 'siswa';
                $email = "{$cleanFirst}.{$student->nis}@siswa.smansago.com";
                
                // Clean up orphaned user if exists
                $existingUser = DB::table('pengguna')->where('email', $email)->first();
                if ($existingUser) {
                    $hasStudent = DB::table('siswa')->where('pengguna_id', $existingUser->id)->exists();
                    if (!$hasStudent) {
                        DB::table('pengguna')->where('id', $existingUser->id)->delete();
                    }
                }
                
                // Direct DB insert with pre-computed hash for maximum speed
                $userId = DB::table('pengguna')->insertGetId([
                    'nama' => $student->nama,
                    'email' => $email,
                    'password' => $defaultPasswordHash,
                    'role' => 'siswa',
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
                
                DB::table('siswa')->where('id', $student->id)->update(['pengguna_id' => $userId]);
                $count++;
            }
            
            \App\Models\ActivityLog::log('STUDENT', 'Men-generate ' . $count . ' akun login siswa secara otomatis');

            DB::commit();
            return redirect()->route('admin.accounts')->with('success', "Berhasil men-generate $count akun siswa otomatis! Password default: password");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.accounts')->with('error', 'Gagal generate akun otomatis: ' . $e->getMessage());
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

        // Sesuai permintaan, fitur ini HANYA untuk siswa baru (kelas X atau 10 tanpa akhiran)
        $students = Siswa::where('status', 'aktif')
            ->where(function($query) {
                $query->where('kelas', 'X')
                      ->orWhere('kelas', 'x')
                      ->orWhere('kelas', '10');
            })->get();

        $plottedCount = 0;
        $skippedCount = 0;

        // Cari semua kelas tingkat X di tahun ajaran target
        $classrooms = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('grade_level', 'X')
            ->where('academic_year', $tahunAjaran)
            ->get();

        if ($classrooms->isEmpty()) {
            return redirect()->route('students.index')->with('error', "Gagal: Tidak ada Rombel tingkat X yang aktif di Tahun Ajaran $tahunAjaran. Silakan buat kelas X terlebih dahulu.");
        }

        try {
            DB::beginTransaction();

            foreach ($students as $student) {
                // Kalkulasi ulang jumlah siswa setiap iterasi agar seimbang
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

                $assigned = false;
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

                if (!$assigned) {
                    $skippedCount++; // Semua kelas penuh
                }
            }

            \App\Models\ActivityLog::log('STUDENT', 'Melakukan plotting otomatis siswa kelas X ke rombel tingkat X Tahun Ajaran ' . $tahunAjaran . '. Terplot: ' . $plottedCount . ' siswa');

            DB::commit();

            $msg = "Plotting siswa selesai! Berhasil menempatkan {$plottedCount} siswa ke rombel X.";
            if ($skippedCount > 0) {
                $msg .= " Sebanyak {$skippedCount} siswa dilewati karena semua rombel X penuh.";
            }

            return back()->with('success', $msg);
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
            return redirect()->back()->with('error', 'Tidak ada siswa yang dipilih untuk kelulusan.');
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
            return redirect()->back()->with('success', "$count siswa berhasil diluluskan.");
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
            return redirect()->back()->with('error', 'Tidak ada mapping kelas tujuan yang dipilih untuk kenaikan kelas.');
        }

        // Verifikasi apakah kelas tujuan sudah dibuat untuk Tahun Ajaran Aktif
        $targetClasses = $mappings->pluck('tujuan')->unique()->toArray();
        $existingClasses = \App\Models\Kelas::whereIn('name', $targetClasses)->pluck('name')->toArray();
        $missingClasses = array_diff($targetClasses, $existingClasses);

        if (!empty($missingClasses)) {
            return redirect()->back()->with('error', 'Kelas tujuan berikut belum dibuat di master Kelas: ' . implode(', ', $missingClasses));
        }

        try {
            DB::beginTransaction();

            $totalPromoted = 0;
            $logDetails = [];

            // Pre-calculate how many students are moving OUT of each class in this batch
            $movingOutCounts = [];
            foreach ($mappings as $map) {
                $asal = $map['asal'];
                $movingOutCounts[$asal] = Siswa::where('kelas', $asal)->active()->count();
            }

            // Group mappings by target class to calculate projected capacity
            $targetCounts = [];
            foreach ($mappings as $map) {
                $asal = $map['asal'];
                $tujuan = $map['tujuan'];
                
                $studentsToMove = $movingOutCounts[$asal];
                if (!isset($targetCounts[$tujuan])) {
                    // Current in DB MINUS students moving out in this same batch
                    $currentInDb = Siswa::where('kelas', $tujuan)->active()->count();
                    $movingOut = isset($movingOutCounts[$tujuan]) ? $movingOutCounts[$tujuan] : 0;
                    $targetCounts[$tujuan] = max(0, $currentInDb - $movingOut);
                }
                
                // Kapasitas default adalah 36
                $kapasitas = 36;
                $kelasObj = \App\Models\Kelas::where('name', $tujuan)->first();
                if ($kelasObj && $kelasObj->max_students) {
                    $kapasitas = $kelasObj->max_students;
                }

                if (($targetCounts[$tujuan] + $studentsToMove) > $kapasitas) {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Gagal: Kapasitas kelas $tujuan tidak mencukupi untuk menampung tambahan $studentsToMove siswa dari $asal. (Maksimal: $kapasitas)");
                }
                
                // Update tracker
                $targetCounts[$tujuan] += $studentsToMove;

                $updated = Siswa::where('kelas', $asal)->active()->update([
                    'kelas' => $tujuan
                ]);

                if ($updated > 0) {
                    $totalPromoted += $updated;
                    $logDetails[] = "$asal -> $tujuan ($updated siswa)";

                    // Record new class history for all promoted students in this batch
                    $promotedStudents = Siswa::where('kelas', $tujuan)->active()->get();
                    $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', date('Y') . '/' . (date('Y') + 1));
                    foreach ($promotedStudents as $ps) {
                        \App\Models\RiwayatKelasSiswa::updateOrCreate(
                            [
                                'siswa_id' => $ps->id,
                                'academic_year' => $activeYear,
                            ],
                            [
                                'kelas_name' => $tujuan,
                            ]
                        );
                    }
                }
            }

            if ($totalPromoted > 0) {
                \App\Models\ActivityLog::log('STUDENT', 'Melakukan kenaikan kelas massal untuk ' . $totalPromoted . ' siswa. Detail: ' . implode(', ', $logDetails));
            }

            DB::commit();
            return redirect()->back()->with('success', "$totalPromoted siswa berhasil dinaikkan kelasnya secara massal.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menaikkan kelas siswa: ' . $e->getMessage());
        }
    }

    public function promoteStudents(Request $request)
    {
        Gate::authorize('edit_siswa');

        $request->validate([
            'id_siswa' => 'required|array',
            'id_siswa.*' => 'exists:siswa,id',
            'tujuan' => 'required|array',
            'tujuan.*' => 'nullable|string',
        ]);

        $promotedCount = 0;
        
        try {
            DB::beginTransaction();

            $idSiswas = $request->input('id_siswa');
            $tujuans = $request->input('tujuan');
            $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', date('Y') . '/' . (date('Y') + 1));
            $classCounts = [];

            foreach ($idSiswas as $id) {
                if (!empty($tujuans[$id])) {
                    $student = Siswa::find($id);
                    if ($student && $student->status === 'active') {
                        $kelasBaru = $tujuans[$id];
                        
                        if (!isset($classCounts[$kelasBaru])) {
                            $classModel = \App\Models\Kelas::withoutGlobalScopes()->where('name', $kelasBaru)->where('academic_year', $activeYear)->first();
                            $classMax = $classModel ? ($classModel->max_students ?? 36) : 36;
                            $currentInDb = Siswa::where('kelas', $kelasBaru)->where('status', 'active')->count();
                            $classCounts[$kelasBaru] = [
                                'current' => $currentInDb,
                                'max' => $classMax
                            ];
                        }
                        
                        // Proteksi kapasitas: jangan lewati kuota maksimal kelas
                        if ($classCounts[$kelasBaru]['current'] >= $classCounts[$kelasBaru]['max']) {
                            continue;
                        }
                        
                        $classCounts[$kelasBaru]['current']++;
                        
                        $student->update([
                            'kelas' => $kelasBaru
                        ]);
                        $promotedCount++;

                        \App\Models\RiwayatKelasSiswa::updateOrCreate(
                            [
                                'siswa_id' => $student->id,
                                'academic_year' => $activeYear,
                            ],
                            [
                                'kelas_name' => $kelasBaru,
                            ]
                        );
                    }
                }
            }

            if ($promotedCount === 0) {
                DB::rollBack();
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Tidak ada siswa yang dipilih kelas tujuannya. Silakan tentukan kelas tujuan siswa terlebih dahulu.'], 422);
                }
                return redirect()->back()->with('error', 'Tidak ada siswa yang dipilih kelas tujuannya. Silakan tentukan kelas tujuan siswa terlebih dahulu.');
            }

            \App\Models\ActivityLog::log('STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk ' . $promotedCount . ' siswa.');

            DB::commit();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "$promotedCount siswa berhasil dipetakan ke kelas barunya.",
                    'promoted_count' => $promotedCount
                ]);
            }
            return redirect()->back()->with('success', "$promotedCount siswa berhasil dipetakan ke kelas barunya.");
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal memproses penjurusan siswa: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Gagal memproses penjurusan siswa: ' . $e->getMessage());
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
            'surat_mutasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $suratPath = null;
            if ($request->hasFile('surat_mutasi')) {
                $folderMap = [
                    'keluar' => 'mutasi/pindah-sekolah',
                    'dikeluarkan' => 'mutasi/dikeluarkan',
                    'mengundurkan diri' => 'mutasi/mengundurkan-diri',
                ];
                $folder = $folderMap[$request->jenis_mutasi] ?? 'mutasi/lainnya';
                $suratPath = $request->file('surat_mutasi')->store($folder, 'public');
            }

            // Insert into MutasiSiswa
            \App\Models\MutasiSiswa::create([
                'siswa_id' => $student->id,
                'jenis_mutasi' => $request->jenis_mutasi,
                'tanggal_mutasi' => $request->tanggal_mutasi,
                'keterangan_sekolah' => $request->keterangan_sekolah,
                'alasan' => $request->alasan,
                'surat_mutasi' => $suratPath,
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

