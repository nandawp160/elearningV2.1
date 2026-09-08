<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Gate;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view_kelas');

        $selectedYear = $request->get('tahun_ajaran');
        $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
        
        if (!$selectedYear) {
            $selectedYear = $activeYear;
        }

        $query = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                      ->with('waliKelas')
                      ->withCount('siswa')
                      ->orderBy('grade_level')
                      ->orderBy('name');

        if ($selectedYear && $selectedYear !== 'all') {
            $query->where('academic_year', $selectedYear);
        }

        $classrooms = $query->get();

        $realCurrentYear = Kelas::withoutGlobalScopes()->max('academic_year');

        // Inject riwayat_kelas_siswa counts for historical years to prevent 0 counts falling back to physical counts
        foreach ($classrooms as $kelas) {
            if ($kelas->academic_year !== $realCurrentYear) {
                $historyCount = \App\Models\RiwayatKelasSiswa::where('kelas_name', $kelas->name)
                                        ->where('academic_year', $kelas->academic_year)
                                        ->count();
                $kelas->siswa_count = $historyCount;
            }
        }

        $academicYears = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                                  ->select('academic_year')
                                  ->distinct()
                                  ->pluck('academic_year')
                                  ->push($activeYear);

        $customYears = json_decode(\App\Models\Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
        if (is_array($customYears)) {
            foreach ($customYears as $cy) {
                $academicYears->push($cy);
            }
        }

        $academicYears = $academicYears->filter(fn($val) => $val !== 'all' && !empty($val))
                                  ->unique()
                                  ->sortDesc()
                                  ->values();

        $totalMasterClasses = \App\Models\MasterKelas::count();

        // Hitung kelas kosong dan guru yang tersedia secara dinamis berdasarkan tahun ajaran terpilih
        $emptyClasses = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                             ->whereNull('homeroom_teacher_id')
                             ->when($selectedYear !== 'all', function($q) use ($selectedYear) {
                                 $q->where('academic_year', $selectedYear);
                             })
                             ->get(['id', 'name']);

        $kelasWithHomeroomQuery = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                                      ->whereNotNull('homeroom_teacher_id');
        if ($selectedYear !== 'all') {
            $kelasWithHomeroomQuery->where('academic_year', $selectedYear);
        }
        $homeroomTeacherIds = $kelasWithHomeroomQuery->pluck('homeroom_teacher_id')->toArray();

        $availableTeachers = \App\Models\Guru::whereNotIn('id', $homeroomTeacherIds)
                                             ->active()
                                             ->get(['id', 'nama']);

        $kelasSorter = function($a, $b) {
            $map = ['X' => 10, 'XI' => 11, 'XII' => 12];
            $tA = $map[strtoupper(explode(' ', trim($a))[0] ?? '')] ?? 99;
            $tB = $map[strtoupper(explode(' ', trim($b))[0] ?? '')] ?? 99;
            if ($tA === $tB) return strnatcmp($a, $b);
            return $tA <=> $tB;
        };
        
        $daftarKelasAsal = \App\Models\Siswa::active()->pluck('kelas')->filter()->unique()->sort($kelasSorter)->values();

        $teachers = \App\Models\Guru::active()->orderBy('nama', 'asc')->get();
        $masterClasses = \App\Models\MasterKelas::orderBy('grade_level', 'asc')->orderBy('name', 'asc')->get();

        return view('kelas.index', compact(
            'classrooms',
            'academicYears',
            'selectedYear',
            'activeYear',
            'emptyClasses',
            'availableTeachers',
            'teachers',
            'masterClasses',
            'daftarKelasAsal',
            'totalMasterClasses'
        ));
    }

    public function generateFromMaster(Request $request)
    {
        Gate::authorize('create_kelas');
        
        $request->validate([
            'source_master_year' => ['nullable', 'string'],
            'target_year' => ['required', 'string']
        ], [
            'target_year.required' => 'Tahun Ajaran tujuan wajib dipilih.'
        ]);
        
        $targetYear = $request->input('target_year');
        $sourceMasterYear = $request->input('source_master_year', 'all');
        
        // Auto-seed if MasterKelas is empty
        if (\App\Models\MasterKelas::count() === 0) {
            $seeder = new \Database\Seeders\MasterKelasSeeder();
            $seeder->run();
        }

        $query = \App\Models\MasterKelas::orderBy('grade_level', 'asc')->orderBy('name', 'asc');
        
        if (!empty($sourceMasterYear) && $sourceMasterYear !== 'all') {
            $hasSpecific = \App\Models\MasterKelas::where('entry_academic_year', $sourceMasterYear)->exists();
            if ($hasSpecific) {
                $query->where('entry_academic_year', $sourceMasterYear);
            }
        }

        $masterClasses = $query->get();
        
        // Fallback: If filtered master classes is empty, take all available master classes
        if ($masterClasses->isEmpty()) {
            $masterClasses = \App\Models\MasterKelas::orderBy('grade_level', 'asc')->orderBy('name', 'asc')->get();
        }
        
        if ($masterClasses->isEmpty()) {
            return redirect()->route('classrooms.index', ['tahun_ajaran' => $targetYear])
                             ->with('error', 'Tidak ada data Master Kelas yang tersedia. Silakan tambahkan data di menu Master Kelas terlebih dahulu.');
        }

        $createdCount = 0;
        $alreadyExistedCount = 0;
        
        foreach ($masterClasses as $master) {
            $exists = Kelas::withoutGlobalScopes()
                           ->where('academic_year', $targetYear)
                           ->where('name', $master->name)
                           ->exists();
                           
            if (!$exists) {
                Kelas::create([
                    'name' => $master->name,
                    'grade_level' => $master->grade_level,
                    'major' => $master->major,
                    'academic_year' => $targetYear,
                    'max_students' => 36,
                    'homeroom_teacher_id' => null, // Wali kelas selalu dikosongkan (null) agar di-plotting ulang di tahun baru
                ]);
                $createdCount++;
            } else {
                $alreadyExistedCount++;
            }
        }
        
        $sourceDesc = ($sourceMasterYear && $sourceMasterYear !== 'all') ? "T.A. $sourceMasterYear" : "Master Utama";
        \App\Models\ActivityLog::log('CLASS', "Me-generate $createdCount rombel (Basis: $sourceDesc) untuk Tahun Ajaran $targetYear");

        if ($createdCount > 0) {
            $msg = "Berhasil me-generate $createdCount rombel baru untuk Tahun Ajaran $targetYear (Basis: $sourceDesc).";
            if ($alreadyExistedCount > 0) {
                $msg .= " ($alreadyExistedCount rombel sudah ada sebelumnya).";
            }
            return redirect()->route('classrooms.index', ['tahun_ajaran' => $targetYear])->with('success', $msg);
        } else {
            return redirect()->route('classrooms.index', ['tahun_ajaran' => $targetYear])->with('info', "Semua ($alreadyExistedCount) rombel dari Master Kelas sudah ada pada Tahun Ajaran $targetYear.");
        }
    }

    public function create()
    {
        Gate::authorize('create_kelas');

        $teachers = Guru::active()->orderBy('nama')->get();
        return view('kelas.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create_kelas');

        // Normalisasi nama field input
        $request->merge([
            'name' => $request->input('name') ?? $request->input('namaKelas'),
            'tingkat' => $request->input('tingkat') ?? $request->input('grade_level'),
            'jurusan' => $request->input('jurusan') ?? $request->input('major'),
            'homeroom_teacher_id' => $request->input('homeroom_teacher_id') ?? $request->input('waliKelas'),
            'tahunAjaran' => $request->input('tahunAjaran') ?? $request->input('academic_year'),
            'kapasitasMaksimal' => $request->input('kapasitasMaksimal') ?? $request->input('max_students') ?? 36,
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:kelas,name',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:Fase E,Fase F,IPA,IPS,Bahasa',
            'homeroom_teacher_id' => 'nullable|exists:guru,id',
            'tahunAjaran' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
            'kapasitasMaksimal' => 'required|integer|min:1|max:50',
        ], [
            'name.required' => 'Nama kelas harus diisi',
            'name.unique' => 'Nama kelas sudah terdaftar',
            'tingkat.required' => 'Tingkat kelas harus dipilih',
            'jurusan.required' => 'Fase Kurikulum harus dipilih',
            'homeroom_teacher_id.exists' => 'Guru yang dipilih tidak valid',
            'tahunAjaran.required' => 'Tahun ajaran harus diisi',
            'tahunAjaran.regex' => 'Format tahun ajaran harus YYYY/YYYY (contoh: 2024/2025)',
            'kapasitasMaksimal.required' => 'Kapasitas maksimal harus diisi',
            'kapasitasMaksimal.min' => 'Kapasitas minimal adalah 1 siswa',
            'kapasitasMaksimal.max' => 'Kapasitas maksimal adalah 50 siswa',
        ]);

        Kelas::create([
            'name' => $validated['name'],
            'grade_level' => $validated['tingkat'],
            'major' => $validated['jurusan'],
            'homeroom_teacher_id' => $validated['homeroom_teacher_id'] ?? null,
            'academic_year' => $validated['tahunAjaran'],
            'max_students' => $validated['kapasitasMaksimal'],
        ]);

        \App\Models\ActivityLog::log('CLASS', 'Membuat kelas baru: ' . $validated['name'] . ' (T.A. ' . $validated['tahunAjaran'] . ')');

        return redirect()->route('classrooms.index')
                        ->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function show(Kelas $classroom)
    {
        Gate::authorize('view_kelas');

        $classroom->load(['waliKelas']);
        
        $realCurrentYear = \App\Models\Kelas::withoutGlobalScopes()->max('academic_year');
        
        // Inject historical students strictly for past academic years
        if ($classroom->academic_year !== $realCurrentYear) {
            $studentIds = \App\Models\RiwayatKelasSiswa::where('kelas_name', $classroom->name)
                                ->where('academic_year', $classroom->academic_year)
                                ->pluck('siswa_id');
            $classroom->setRelation('daftarSiswa', Siswa::whereIn('id', $studentIds)->get());
            $classroom->siswa_count = $studentIds->count();
        } else {
            $classroom->load(['daftarSiswa'])->loadCount('siswa');
        }
        // Get students who are NOT currently in this class
        $availableStudents = Siswa::where('status', 'aktif')
                                    ->where(function($q) {
                                        $q->whereNull('kelas')
                                          ->orWhereIn('kelas', ['', 'X', 'XI', 'XII']);
                                    })
                                    ->orderBy('nama')
                                    ->get();

        // Get courses and teachers for scheduling/management if needed
        $courses = \App\Models\MataPelajaran::where('status', 'aktif')->orderBy('nama')->get();
        $teachers = Guru::active()->orderBy('nama')->get();

        // Get daftar pengajar (plottings)
        $pengajar = \App\Models\GuruKelas::with(['guru', 'subject'])
                        ->where('kelas_id', $classroom->id)
                        ->get();

        return view('kelas.show', compact('classroom', 'availableStudents', 'courses', 'teachers', 'pengajar'));
    }

    public function enroll(Request $request, Kelas $classroom)
    {
        Gate::authorize('edit_kelas');

        $request->validate([
            'student_id' => 'required|exists:siswa,id',
        ], [
            'student_id.required' => 'Siswa wajib dipilih',
            'student_id.exists' => 'Siswa tidak valid',
        ]);

        $student = Siswa::find($request->student_id);

        if ($student->kelas === $classroom->name) {
            return back()->with('error', 'Siswa sudah terdaftar di kelas ini.');
        }

        // Check capacity
        $classroom->loadCount('siswa');
        if ($classroom->siswa_count >= $classroom->kapasitasMaksimal) {
            return back()->with('error', 'Kapasitas kelas sudah penuh.');
        }

        $student->update(['kelas' => $classroom->name]);

        \App\Models\ActivityLog::log('CLASS', 'Memasukkan siswa ' . $student->nama . ' ke kelas ' . $classroom->name);

        return back()->with('success', 'Siswa berhasil dimasukkan ke kelas.');
    }

    public function unenroll(Kelas $classroom, Siswa $student)
    {
        Gate::authorize('edit_kelas');

        if ($student->kelas === $classroom->name) {
            $student->update(['kelas' => null]);
            \App\Models\ActivityLog::log('CLASS', 'Mengeluarkan siswa ' . $student->nama . ' dari kelas ' . $classroom->name);
        }

        return back()->with('success', 'Siswa berhasil dikeluarkan dari kelas.');
    }

    public function edit(Kelas $classroom)
    {
        Gate::authorize('edit_kelas');

        $teachers = Guru::active()->orderBy('nama')->get();
        return view('kelas.edit', compact('classroom', 'teachers'));
    }

    public function update(Request $request, Kelas $classroom)
    {
        Gate::authorize('edit_kelas');

        $validated = $request->validate([
            'homeroom_teacher_id' => 'nullable|exists:guru,id',
            'kapasitasMaksimal' => 'required|integer|min:1|max:50',
        ], [
            'homeroom_teacher_id.exists' => 'Guru yang dipilih tidak valid',
            'kapasitasMaksimal.required' => 'Kapasitas maksimal harus diisi',
            'kapasitasMaksimal.min' => 'Kapasitas minimal adalah 1 siswa',
            'kapasitasMaksimal.max' => 'Kapasitas maksimal adalah 50 siswa',
        ]);

        $classroom->update([
            'homeroom_teacher_id' => $validated['homeroom_teacher_id'] ?? null,
            'max_students' => $validated['kapasitasMaksimal'],
        ]);

        \App\Models\ActivityLog::log('CLASS', 'Memperbarui informasi kelas: ' . $classroom->name);

        return redirect()->route('classrooms.index')
                        ->with('success', 'Data kelas berhasil diperbarui!');
    }

    public function destroy(Kelas $classroom)
    {
        Gate::authorize('delete_kelas');

        // Check if classroom has active students
        $activeStudents = $classroom->daftarSiswa()->count();
        
        if ($activeStudents > 0) {
            return redirect()->route('classrooms.index')
                           ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki ' . $activeStudents . ' siswa aktif!');
        }

        \App\Models\ActivityLog::log('DELETION', 'Menghapus data kelas: ' . $classroom->name);

        $classroom->delete();

        return redirect()->route('classrooms.index')
                        ->with('success', 'Kelas berhasil dihapus!');
    }

    public function homeroomSetup()
    {
        Gate::authorize('plot_wali');

        $classrooms = Kelas::with('waliKelas')->withCount('siswa')->orderBy('name')->get();
        $teachers = Guru::active()->orderBy('nama')->get();
        return view('kelas.homeroom_setup', compact('classrooms', 'teachers'));
    }

    public function saveHomeroomSetup(Request $request)
    {
        Gate::authorize('plot_wali');

        $request->validate([
            'assignments' => 'required|array',
            'assignments.*.classroom_id' => 'required|exists:kelas,id',
            'assignments.*.teacher_id' => 'nullable|exists:guru,id',
        ]);

        foreach ($request->assignments as $assignment) {
            $classroom = Kelas::find($assignment['classroom_id']);
            if ($classroom) {
                $classroom->update(['homeroom_teacher_id' => $assignment['teacher_id'] ?: null]);
            }
        }

        \App\Models\ActivityLog::log('CLASS', 'Memperbarui plotting wali kelas secara massal');

        return redirect()->route('classrooms.index')
                         ->with('success', 'Plotting Wali Kelas berhasil diperbarui!');
    }

    public function rollingIndex(Request $request)
    {
        Gate::authorize('edit_kelas');

        $classrooms = Kelas::withCount('siswa')->orderBy('name')->get();
        
        $sourceClassname = $request->input('source_class');
        $students = collect();
        if ($sourceClassname) {
            $students = Siswa::where('kelas', $sourceClassname)
                               ->where('status', 'aktif')
                               ->orderBy('nama')
                               ->get();
        }

        return view('kelas.rolling', compact('classrooms', 'students', 'sourceClassname'));
    }

    public function rollingStore(Request $request)
    {
        Gate::authorize('edit_kelas');

        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:siswa,id',
            'target_class' => 'required|string',
        ], [
            'student_ids.required' => 'Wajib memilih minimal satu siswa untuk di-rolling',
            'target_class.required' => 'Wajib memilih kelas tujuan',
        ]);

        $targetClassname = $request->input('target_class');
        $studentIds = $request->input('student_ids');

        // Verify target class exists
        $targetClassExists = Kelas::where('name', $targetClassname)->exists();
        if (!$targetClassExists) {
            return back()->with('error', 'Kelas tujuan tidak ditemukan.');
        }

        // Update all selected students
        Siswa::whereIn('id', $studentIds)->update(['kelas' => $targetClassname]);

        \App\Models\ActivityLog::log('CLASS', 'Melakukan rolling kelas untuk ' . count($studentIds) . ' siswa ke kelas ' . $targetClassname);

        return redirect()->route('classrooms.index')
                         ->with('success', 'Rolling Kelas berhasil! Sebanyak ' . count($studentIds) . ' siswa telah dipindahkan ke kelas ' . $targetClassname . '.');
    }

    public function import(Request $request)
    {
        Gate::authorize('create_kelas');

        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv'
        ], [
            'excel_file.required' => 'Berkas Excel wajib diunggah.',
            'excel_file.file' => 'Berkas yang diunggah harus berupa file.',
            'excel_file.mimes' => 'Format berkas harus berupa .xlsx, .xls, atau .csv.'
        ]);

        try {
            $file = $request->file('excel_file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            // 1. Detect if it's the DataTables export format or Template format
            $isDataTableExport = false;
            $headerRowIndex = 0;

            foreach ($rows as $index => $row) {
                $rowStr = implode(' ', array_filter($row));
                if (stripos($rowStr, 'Tingkat / Jurusan') !== false || stripos($rowStr, 'Wali Kelas') !== false) {
                    $isDataTableExport = true;
                    $headerRowIndex = $index;
                    break;
                } elseif (stripos($rowStr, 'TINGKAT') !== false && stripos($rowStr, 'JURUSAN') !== false) {
                    $headerRowIndex = $index;
                    break;
                }
            }

            if ($headerRowIndex === 0) {
                $headerRowIndex = 0;
            }

            $importedCount = 0;
            $teachers = Guru::active()->get();

            foreach ($rows as $index => $row) {
                if ($index <= $headerRowIndex) {
                    continue; // Skip headers
                }

                // If row is entirely empty, skip
                if (empty(array_filter($row))) {
                    continue;
                }

                if ($isDataTableExport) {
                    // DataTables export columns mapping:
                    // B: Kelas (e.g. "X IPA 1T.A. 2025/2026")
                    // C: Tingkat / Jurusan (e.g. "Kelas XIPA")
                    // D: Wali Kelas (e.g. "Pak Budi Santoso")
                    // F: Kapasitas (e.g. "50")

                    $rawKelas = isset($row['B']) ? trim($row['B']) : '';
                    $rawWaliKelas = isset($row['D']) ? trim($row['D']) : '';
                    $rawKapasitas = isset($row['F']) ? trim($row['F']) : '';

                    // Clean rawKelas (remove whitespace, linebreaks)
                    $rawKelas = str_replace(["\r", "\n"], ' ', $rawKelas);
                    $rawKelas = preg_replace('/\s+/', ' ', $rawKelas);

                    // Extract Name and Academic Year
                    $name = $rawKelas;
                    $academicYear = '2025/2026'; // default fallback
                    if (preg_match('/^(.*?)\s*T\.A\.\s*(\d{4}\/\d{4})$/i', $rawKelas, $matches)) {
                        $name = trim($matches[1]);
                        $academicYear = trim($matches[2]);
                    }

                    // Extract Tingkat and Jurusan directly from class name (e.g., "X IPA 1" -> "X", "IPA")
                    $parts = explode(' ', $name);
                    $tingkat = isset($parts[0]) ? strtoupper(trim($parts[0])) : 'X';
                    $jurusan = isset($parts[1]) ? strtoupper(trim($parts[1])) : 'IPA';

                    if (!in_array($tingkat, ['X', 'XI', 'XII'])) {
                        $tingkat = 'X';
                    }
                    if (!in_array($jurusan, ['IPA', 'IPS', 'Bahasa'])) {
                        $jurusan = 'IPA';
                    }

                    $maxStudents = (int)$rawKapasitas;
                    if ($maxStudents <= 0) {
                        $maxStudents = 36;
                    }

                    // SMART TEACHER LOOKUP
                    $teacherId = null;
                    $rawWaliKelas = trim($rawWaliKelas);
                    if (!empty($rawWaliKelas)) {
                        $cleanTeacherName = preg_replace('/\s+/', ' ', $rawWaliKelas);
                        
                        $matchedTeacher = $teachers->first(function($t) use ($cleanTeacherName) {
                            $dbName = strtolower(trim($t->nama));
                            $searchName = strtolower(trim($cleanTeacherName));
                            
                            $dbNameClean = trim(preg_replace('/\b(pak|bu|ibu|bpk|bapak)\b/i', '', $dbName));
                            $searchNameClean = trim(preg_replace('/\b(pak|bu|ibu|bpk|bapak)\b/i', '', $searchName));
                            
                            if (empty($dbNameClean) || empty($searchNameClean)) return false;
                            
                            return (stripos($searchNameClean, $dbNameClean) !== false) 
                                || (stripos($dbNameClean, $searchNameClean) !== false);
                        });
                        
                        if ($matchedTeacher) {
                            $teacherId = $matchedTeacher->id;
                        }
                    }
                } else {
                    // Template format columns mapping:
                    // A: NAMA
                    // B: TINGKAT
                    // C: JURUSAN
                    // D: TAHUN_AJARAN
                    // E: KAPASITAS
                    $name = isset($row['A']) ? trim($row['A']) : '';
                    $tingkat = isset($row['B']) ? strtoupper(trim($row['B'])) : 'X';
                    $jurusan = isset($row['C']) ? trim($row['C']) : 'IPA';
                    $academicYear = isset($row['D']) ? trim($row['D']) : '2025/2026';
                    $rawKapasitas = isset($row['E']) ? trim($row['E']) : '';

                    if (!in_array($tingkat, ['X', 'XI', 'XII'])) {
                        $tingkat = 'X';
                    }
                    if (strcasecmp($jurusan, 'ipa') === 0) {
                        $jurusan = 'IPA';
                    } elseif (strcasecmp($jurusan, 'ips') === 0) {
                        $jurusan = 'IPS';
                    } elseif (strcasecmp($jurusan, 'bahasa') === 0) {
                        $jurusan = 'Bahasa';
                    }

                    if (!in_array($jurusan, ['IPA', 'IPS', 'Bahasa'])) {
                        $jurusan = 'IPA';
                    }

                    $maxStudents = (int)$rawKapasitas;
                    if ($maxStudents <= 0) {
                        $maxStudents = 36;
                    }
                    $teacherId = null;
                }

                if (empty($name)) {
                    continue;
                }

                $updateData = [
                    'grade_level' => $tingkat,
                    'major' => $jurusan,
                    'academic_year' => $academicYear,
                    'max_students' => $maxStudents,
                ];

                if ($teacherId !== null) {
                    $updateData['homeroom_teacher_id'] = $teacherId;
                }

                Kelas::updateOrCreate(
                    ['name' => $name],
                    $updateData
                );

                $importedCount++;
            }

            \App\Models\ActivityLog::log('CLASS', 'Mengimpor ' . $importedCount . ' data kelas dari file Excel');

            return redirect()->route('classrooms.index')
                             ->with('success', 'Berhasil mengimpor ' . $importedCount . ' data kelas!');

        } catch (\Exception $e) {
            return redirect()->route('classrooms.index')
                             ->with('error', 'Gagal mengimpor kelas: ' . $e->getMessage());
        }
    }

    public function clone(Request $request)
    {
        Gate::authorize('create_kelas');
        
        $request->validate([
            'tahun_ajaran_sumber' => 'required|string',
            'tahun_ajaran_tujuan' => 'required|string'
        ]);
        
        if ($request->tahun_ajaran_sumber === $request->tahun_ajaran_tujuan) {
            return back()->with('error', 'Tahun ajaran sumber dan tujuan tidak boleh sama.');
        }

        $sourceClasses = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('academic_year', $request->tahun_ajaran_sumber)
            ->get();

        if ($sourceClasses->isEmpty()) {
            return back()->with('error', 'Tidak ada data kelas di tahun ajaran ' . $request->tahun_ajaran_sumber);
        }

        $count = 0;
        foreach ($sourceClasses as $class) {
            // Cek apakah kelas dengan nama yang sama sudah ada di tahun target
            $exists = Kelas::withoutGlobalScope('tahun_ajaran_aktif')
                ->where('academic_year', $request->tahun_ajaran_tujuan)
                ->where('name', $class->name)
                ->exists();

            if (!$exists) {
                Kelas::create([
                    'name' => $class->name,
                    'grade_level' => $class->grade_level,
                    'major' => $class->major,
                    'academic_year' => $request->tahun_ajaran_tujuan,
                    'max_students' => $class->max_students,
                    'homeroom_teacher_id' => null // Wali kelas dikosongkan secara default
                ]);
                $count++;
            }
        }

        \App\Models\ActivityLog::log('CLASS', 'Menyalin ' . $count . ' kelas dari T.A ' . $request->tahun_ajaran_sumber . ' ke ' . $request->tahun_ajaran_tujuan);

        return back()->with('success', "$count ruang kelas berhasil disalin dari {$request->tahun_ajaran_sumber} ke {$request->tahun_ajaran_tujuan}.");
    }
}
