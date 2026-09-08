<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PengaturanController extends Controller
{
    public function index()
    {
        // Proteksi kunci password modul pemeliharaan dinonaktifkan
        session(['maintenance_unlocked' => true]);
        $maintenance_unlocked = true;

        $settings = [
            'school_name' => Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo'),
            'school_npsn' => Pengaturan::getValue('school_npsn', '20307718'),
            'school_email' => Pengaturan::getValue('school_email', 'info@smansago.sch.id'),
            'school_phone' => Pengaturan::getValue('school_phone', '(0276) 321xxx'),
            'school_website' => Pengaturan::getValue('school_website', 'https://sman1cepogo.sch.id'),
            'headmaster_name' => Pengaturan::getValue('headmaster_name', 'Drs. H. Sukardi, M.Pd.'),
            'headmaster_nip' => Pengaturan::getValue('headmaster_nip', '19680512 199412 1 002'),
            'school_address' => Pengaturan::getValue('school_address', 'Jl. Cepogo KM. 13, Boyolali, Jawa Tengah'),
            'fonnte_token' => Pengaturan::getValue('fonnte_token', config('services.fonnte.token')),
            'lock_duration_hours' => Pengaturan::getValue('lock_duration_hours', '24'),
            'allow_dispensations' => Pengaturan::getValue('allow_dispensations', '1'),
            'wa_notification_status' => Pengaturan::getValue('wa_notification_status', '1'),
            'tahun_ajaran_aktif' => Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026'),
            'permissions_page_password' => Pengaturan::getValue('permissions_page_password', 'admin123'),
            'ssl_lock_expired_deadline' => Pengaturan::getValue('ssl_lock_expired_deadline', '1'),
        ];

        $global_tahun_ajaran_aktif = Pengaturan::getGlobalValue('tahun_ajaran_aktif', '2025/2026');

        $daftar_tahun_ajaran = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->distinct()
            ->pluck('academic_year')
            ->toArray();

        $custom_years = json_decode(Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
        if (!is_array($custom_years)) {
            $custom_years = [];
        }

        $daftar_tahun_ajaran = array_unique(array_merge($daftar_tahun_ajaran, $custom_years));
        rsort($daftar_tahun_ajaran);

        if (empty($daftar_tahun_ajaran)) {
            $daftar_tahun_ajaran = ['2025/2026'];
        }

        if (!in_array($settings['tahun_ajaran_aktif'], $daftar_tahun_ajaran)) {
            $daftar_tahun_ajaran[] = $settings['tahun_ajaran_aktif'];
            rsort($daftar_tahun_ajaran);
        }

        $password = Pengaturan::getValue('permissions_page_password', 'admin123');
        
        $semua_kelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->orderBy('academic_year', 'desc')
            ->orderBy('name', 'asc')
            ->get();
            
        $semua_mapel = \App\Models\MataPelajaran::orderBy('nama', 'asc')->get();

        $arsip_siswa = \App\Models\RiwayatKelasSiswa::select('academic_year', \DB::raw('count(distinct siswa_id) as total'))
            ->groupBy('academic_year')
            ->orderBy('academic_year', 'desc')
            ->get();

        $arsip_alumni = \App\Models\Siswa::whereNotNull('tahun_lulus')
            ->select('tahun_lulus', \DB::raw('count(*) as total'))
            ->groupBy('tahun_lulus')
            ->orderBy('tahun_lulus', 'desc')
            ->get();

        $arsip_mutasi = \App\Models\MutasiSiswa::where('jenis_mutasi', 'keluar')
            ->selectRaw('YEAR(tanggal_mutasi) as tahun, count(*) as total')
            ->groupBy(\DB::raw('YEAR(tanggal_mutasi)'))
            ->orderBy('tahun', 'desc')
            ->get();

        $storage_frozen = Pengaturan::getValue('storage_frozen', '0') === '1';
        $active_page = request()->routeIs('academic-years.index') ? 'academic-year' : 'settings';
        $tahun_ajaran_updated_at = \App\Models\Pengaturan::where('key', 'tahun_ajaran_aktif')->value('updated_at');
        
        return view('pengaturan.index', compact('settings', 'daftar_tahun_ajaran', 'custom_years', 'maintenance_unlocked', 'password', 'semua_kelas', 'semua_mapel', 'arsip_siswa', 'arsip_alumni', 'arsip_mutasi', 'storage_frozen', 'active_page', 'tahun_ajaran_updated_at', 'global_tahun_ajaran_aktif'));
    }

    public function archiveDetail($year)
    {
        $yearDecoded = str_replace('-', '/', $year);
        
        // Cek apakah tahun yang diminta adalah tahun ajaran aktif
        $activeYear = Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
        $isActive = ($yearDecoded === $activeYear);

        // Pastikan tahun tersebut valid ada di database
        $kelasAda = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('academic_year', $yearDecoded)
            ->exists();
            
        if (!$kelasAda) {
            return redirect()->route('academic-years.index')->with('error', 'Data arsip tahun ajaran tidak ditemukan.');
        }

        // Dapatkan data tanggal dibuat/diperbarui dengan melihat kelas tertua dan terbaru
        $oldestKelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('academic_year', $yearDecoded)
            ->orderBy('created_at', 'asc')
            ->first();
            
        $newestKelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('academic_year', $yearDecoded)
            ->orderBy('updated_at', 'desc')
            ->first();
            
        $createdAt = $oldestKelas ? $oldestKelas->created_at : null;
        $updatedAt = $newestKelas ? $newestKelas->updated_at : null;

        // Hitung Ringkasan
        $jumlahKelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('academic_year', $yearDecoded)
            ->count();
            
        $jumlahWaliKelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('academic_year', $yearDecoded)
            ->whereNotNull('homeroom_teacher_id')
            ->distinct('homeroom_teacher_id')
            ->count('homeroom_teacher_id');
            
        // Menghitung Guru Pengampu menggunakan DB builder karena guru_kelas pivot
        $jumlahGuruPengampu = \Illuminate\Support\Facades\DB::table('guru_kelas')
            ->join('kelas', 'guru_kelas.kelas_id', '=', 'kelas.id')
            ->where('kelas.academic_year', $yearDecoded)
            ->distinct('guru_kelas.guru_id')
            ->count('guru_kelas.guru_id');

        // Mengambil daftar kelas dan wali kelas (Eager load wali_kelas jika ada relasinya)
        $daftarKelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->with('homeroomTeacher')
            ->where('academic_year', $yearDecoded)
            ->orderBy('name', 'asc')
            ->get();

        // Mengambil daftar pengampuan guru (menggunakan DB builder)
        $daftarPengampu = \Illuminate\Support\Facades\DB::table('guru_kelas')
            ->join('kelas', 'guru_kelas.kelas_id', '=', 'kelas.id')
            ->join('guru', 'guru_kelas.guru_id', '=', 'guru.id')
            ->leftJoin('mata_pelajaran', 'guru_kelas.mata_pelajaran_id', '=', 'mata_pelajaran.id')
            ->where('kelas.academic_year', $yearDecoded)
            ->select('guru.nama as guru_nama', 'kelas.name as kelas_nama', 'mata_pelajaran.nama as mapel_nama')
            ->orderBy('kelas_nama', 'asc')
            ->orderBy('guru_nama', 'asc')
            ->get();
            
        // Hitung Siswa Terdaftar dari Riwayat Kelas
        $jumlahSiswaAktif = \App\Models\RiwayatKelasSiswa::where('academic_year', $yearDecoded)
            ->distinct('siswa_id')
            ->count('siswa_id');
            
        $jumlahAlumni = \App\Models\Siswa::where('tahun_lulus', $yearDecoded)->count();
        
        // Fallback untuk arsip lama yang belum ada di riwayat kelas
        if ($jumlahSiswaAktif == 0 && $jumlahAlumni > 0) {
            $jumlahSiswaAktif = $jumlahAlumni;
        }

        return view('pengaturan.archive_detail', compact(
            'yearDecoded',
            'createdAt',
            'updatedAt',
            'jumlahKelas',
            'jumlahWaliKelas',
            'jumlahGuruPengampu',
            'jumlahSiswaAktif',
            'jumlahAlumni',
            'daftarKelas',
            'daftarPengampu',
            'isActive'
        ));
    }

    public function arsipSiswaDetail(\Illuminate\Http\Request $request, $year)
    {
        $yearDecoded = str_replace('-', '/', $year);
        $filterKelas = $request->get('kelas');
        
        $arsip_siswa = \App\Models\RiwayatKelasSiswa::with(['siswa' => function($q) {
            $q->withTrashed();
        }])
            ->where('academic_year', $yearDecoded)
            ->get()
            ->filter(function ($riwayat) {
                return $riwayat->siswa !== null;
            })
            ->map(function ($riwayat) {
                $riwayat->siswa->kelas_riwayat = $riwayat->kelas_name;
                return $riwayat->siswa;
            });

        // Fallback for old alumni data that doesn't have RiwayatKelasSiswa yet
        if ($arsip_siswa->isEmpty()) {
            $arsip_siswa = \App\Models\Siswa::where('tahun_lulus', $yearDecoded)
                ->orderBy('nama', 'asc')
                ->get();
            foreach ($arsip_siswa as $siswa) {
                $siswa->kelas_riwayat = $siswa->kelas ?? '-';
            }
        } else {
            $arsip_siswa = $arsip_siswa->sortBy('nama')->values();
        }

        // Get unique classes for dropdown
        $daftarKelas = $arsip_siswa->pluck('kelas_riwayat')->unique()->filter(function($k) { return $k != '-' && $k != null; })->sort()->values();

        // Apply filter if selected
        if ($filterKelas) {
            $arsip_siswa = $arsip_siswa->filter(function($siswa) use ($filterKelas) {
                return $siswa->kelas_riwayat === $filterKelas;
            })->values();
        }
            
        return view('pengaturan.arsip_siswa', compact('yearDecoded', 'arsip_siswa', 'daftarKelas', 'filterKelas'));
    }

    public function alumniDetail($year)
    {
        $yearDecoded = str_replace('-', '/', $year);
        
        $alumni = \App\Models\Siswa::where('tahun_lulus', $yearDecoded)
            ->orderBy('nama', 'asc')
            ->get();
            
        return view('pengaturan.alumni', compact('yearDecoded', 'alumni'));
    }

    public function mutasiDetail($year)
    {
        $mutasi = \App\Models\MutasiSiswa::with('siswa')
            ->where('jenis_mutasi', 'keluar')
            ->whereYear('tanggal_mutasi', $year)
            ->orderBy('tanggal_mutasi', 'desc')
            ->get();
            
        return view('pengaturan.mutasi', compact('year', 'mutasi'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'school_npsn' => 'nullable|string|max:50',
            'school_email' => 'required|email|max:255',
            'school_phone' => 'nullable|string|max:50',
            'school_website' => 'nullable|string|max:255',
            'headmaster_name' => 'nullable|string|max:255',
            'headmaster_nip' => 'nullable|string|max:50',
            'school_address' => 'nullable|string|max:500',
            'fonnte_token' => 'nullable|string|max:255',
            'lock_duration_hours' => 'nullable|integer|min:1|max:168',
            'allow_dispensations' => 'nullable|in:0,1',
            'wa_notification_status' => 'nullable|in:0,1',
            'tahun_ajaran_aktif' => 'nullable|string',
            'tahun_ajaran_baru' => ['nullable', 'string', 'regex:/^\d{4}\/\d{4}$/'],
            'permissions_page_password' => 'nullable|string|max:255',
            'ssl_lock_expired_deadline' => 'nullable|in:0,1',
        ], [
            'tahun_ajaran_baru.regex' => 'Format tahun ajaran baru harus YYYY/YYYY (contoh: 2026/2027)',
            'school_name.required' => 'Nama Sekolah wajib diisi.',
            'school_email.required' => 'Email Resmi Sekolah wajib diisi.',
            'school_email.email' => 'Format email resmi tidak valid.',
        ]);

        foreach ($validated as $key => $value) {
            if ($key !== 'tahun_ajaran_baru') {
                if ($key === 'permissions_page_password' && empty($value)) {
                    continue;
                }
                Pengaturan::setValue($key, $value ?? '');
            }
        }

        if (!empty($validated['tahun_ajaran_baru'])) {
            $newYear = $validated['tahun_ajaran_baru'];
            $custom_years = json_decode(Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
            if (!is_array($custom_years)) {
                $custom_years = [];
            }
            if (!in_array($newYear, $custom_years)) {
                $custom_years[] = $newYear;
                Pengaturan::setValue('daftar_tahun_ajaran_custom', json_encode($custom_years));
            }
            Pengaturan::setValue('tahun_ajaran_aktif', $newYear);
        }
        
        \App\Models\ActivityLog::log('SETTINGS', 'Memperbarui profil informasi sekolah dan pengaturan sistem');

        return redirect()->route('settings.index')->with('success', 'Informasi sekolah dan pengaturan sistem berhasil diperbarui!');
    }

    public function toggleSslDeadlineLock(Request $request)
    {
        $current = Pengaturan::getValue('ssl_lock_expired_deadline', '1');
        $newVal = ($current === '1') ? '0' : '1';
        Pengaturan::setValue('ssl_lock_expired_deadline', $newVal);

        $statusText = ($newVal === '1') ? 'diaktifkan (Terkunci Ketat)' : 'dinonaktifkan (Fleksibel Edit)';
        \App\Models\ActivityLog::log('SETTINGS', 'Mengubah status Proteksi Kunci Deadline SSL: ' . $statusText);

        return back()->with('success', 'Proteksi Kunci Deadline SSL berhasil ' . $statusText . '.');
    }

    public function changeAdminViewYear(Request $request)
    {
        $validated = $request->validate([
            'admin_tahun_ajaran' => ['required', 'string', 'regex:/^\d{4}\/\d{4}$/'],
        ]);

        session(['admin_tahun_ajaran' => $validated['admin_tahun_ajaran']]);
        return back()->with('success', 'Tampilan Tahun Ajaran berhasil diubah ke ' . $validated['admin_tahun_ajaran'] . '. Ini hanya mempengaruhi tampilan Anda.');
    }

    public function setGlobalActiveYear(Request $request)
    {
        $validated = $request->validate([
            'global_tahun_ajaran' => ['required', 'string', 'regex:/^\d{4}\/\d{4}$/'],
        ]);

        Pengaturan::setValue('tahun_ajaran_aktif', $validated['global_tahun_ajaran']);
        
        // Also update session so admin sees the new global
        session(['admin_tahun_ajaran' => $validated['global_tahun_ajaran']]);

        return back()->with('success', 'Tahun Ajaran Global berhasil diaktifkan ke ' . $validated['global_tahun_ajaran'] . '. Seluruh sistem sekarang menggunakan tahun ajaran ini.');
    }

    public function permissions()
    {
        $defaultRoles = [
            'admin' => 'Administrator',
            'guru' => 'Guru Pengajar',
            'wali_kelas' => 'Wali Kelas',
            'siswa' => 'Siswa'
        ];

        $defaultModules = [
            'Data Sekolah (Siswa, Kelas)' => [
                'view' => ['key' => 'view_siswa', 'label' => 'Melihat Siswa & Kelas'],
                'create' => ['key' => 'create_siswa', 'label' => 'Tambah Siswa & Kelas'],
                'edit' => ['key' => 'edit_siswa', 'label' => 'Edit Siswa & Kelas'],
                'delete' => ['key' => 'delete_siswa', 'label' => 'Hapus Siswa & Kelas'],
            ],
            'Data Guru' => [
                'view' => ['key' => 'view_guru', 'label' => 'Melihat Guru'],
                'create' => ['key' => 'create_guru', 'label' => 'Tambah Guru'],
                'edit' => ['key' => 'edit_guru', 'label' => 'Edit Guru'],
                'delete' => ['key' => 'delete_guru', 'label' => 'Hapus Guru'],
            ],
            'Tugas & Pembelajaran' => [
                'view' => ['key' => 'view_tugas', 'label' => 'Melihat Tugas'],
                'create' => ['key' => 'create_tugas', 'label' => 'Tambah Tugas'],
                'edit' => ['key' => 'edit_tugas', 'label' => 'Edit Tugas & Nilai'],
                'delete' => ['key' => 'delete_tugas', 'label' => 'Hapus Tugas'],
            ],
            'Verifikasi Banding (SSL)' => [
                'view' => ['key' => 'view_dispensasi', 'label' => 'Melihat Dispensasi'],
                'create' => null,
                'edit' => ['key' => 'approve_dispensasi', 'label' => 'Setujui Dispensasi'],
                'delete' => null,
            ],
            'Cetak Laporan' => [
                'view' => ['key' => 'view_laporan', 'label' => 'Lihat Laporan'],
                'create' => null,
                'edit' => null,
                'delete' => null,
            ],
            'Pengaturan Sistem' => [
                'view' => null,
                'create' => null,
                'edit' => ['key' => 'manage_settings', 'label' => 'Pengaturan Sistem'],
                'delete' => null,
            ],
        ];

        // Ambil dari DB atau gunakan default jika belum ada
        $rolesData = Pengaturan::getValue('system_roles');
        if (!$rolesData) {
            Pengaturan::setValue('system_roles', json_encode($defaultRoles));
            $roles = $defaultRoles;
        } else {
            $roles = json_decode($rolesData, true) ?: $defaultRoles;
        }

        $modulesData = Pengaturan::getValue('system_modules');
        if (!$modulesData) {
            Pengaturan::setValue('system_modules', json_encode($defaultModules));
            $modules = $defaultModules;
        } else {
            $modules = json_decode($modulesData, true) ?: $defaultModules;
        }

        // Load dynamic permissions from DB with default fallbacks
        $permissions = [];
        foreach ($roles as $roleKey => $roleName) {
            $rawPerms = Pengaturan::getValue("permissions_{$roleKey}");
            if ($rawPerms !== null) {
                $permissions[$roleKey] = json_decode($rawPerms, true) ?: [];
            } else {
                $defaultPermissions = [
                    'admin' => [
                        'view_siswa', 'create_siswa', 'edit_siswa', 'delete_siswa',
                        'view_guru', 'create_guru', 'edit_guru', 'delete_guru',
                        'view_kelas', 'create_kelas', 'edit_kelas', 'delete_kelas', 'plot_wali',
                        'view_tugas', 'create_tugas', 'edit_tugas', 'delete_tugas', 'grade_tugas',
                        'view_dispensasi', 'approve_dispensasi',
                        'view_laporan', 'manage_settings'
                    ],
                    'guru' => [
                        'view_siswa', 'view_kelas',
                        'view_tugas', 'create_tugas', 'edit_tugas', 'delete_tugas', 'grade_tugas',
                        'view_dispensasi', 'approve_dispensasi'
                    ],
                    'wali_kelas' => [
                        'view_siswa', 'view_kelas',
                        'view_tugas', 'create_tugas', 'edit_tugas', 'delete_tugas', 'grade_tugas',
                        'view_dispensasi', 'approve_dispensasi'
                    ],
                    'siswa' => [
                        'view_tugas'
                    ]
                ];
                $permissions[$roleKey] = $defaultPermissions[$roleKey] ?? [];
            }
        }

        return view('pengaturan.permissions', compact('roles', 'modules', 'permissions'));
    }

    public function savePermissions(Request $request)
    {
        $matrix = $request->input('matrix', []);
        
        // Ambil roles dinamis dari DB
        $rolesData = Pengaturan::getValue('system_roles');
        $roles = $rolesData ? (json_decode($rolesData, true) ?: []) : ['admin' => 'Administrator', 'guru' => 'Guru Pengajar', 'wali_kelas' => 'Wali Kelas', 'siswa' => 'Siswa'];
        
        foreach ($roles as $role => $roleName) {
            if ($role === 'admin') {
                // Kumpulkan semua keys dari semua module yang ada di DB
                $modulesData = Pengaturan::getValue('system_modules');
                $modules = $modulesData ? (json_decode($modulesData, true) ?: []) : [];
                $adminPerms = [];
                foreach ($modules as $moduleName => $actions) {
                    foreach (['view', 'create', 'edit', 'delete'] as $action) {
                        if (isset($actions[$action]) && isset($actions[$action]['key'])) {
                            $adminPerms[] = $actions[$action]['key'];
                        }
                    }
                }
                Pengaturan::setValue("permissions_{$role}", json_encode($adminPerms));
                continue;
            }
            
            $perms = $matrix[$role] ?? [];
            Pengaturan::setValue("permissions_{$role}", json_encode($perms));
        }

        \App\Models\ActivityLog::log('SETTINGS', 'Mengubah pengaturan matriks hak akses aplikasi');

        return redirect()->route('permissions.index')->with('success', 'Hak akses role berhasil diperbarui!');
    }

    public function addRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:100'
        ]);

        $rolesData = Pengaturan::getValue('system_roles');
        $roles = $rolesData ? (json_decode($rolesData, true) ?: []) : ['admin' => 'Administrator', 'guru' => 'Guru Pengajar', 'wali_kelas' => 'Wali Kelas', 'siswa' => 'Siswa'];

        $roleKey = \Illuminate\Support\Str::slug($request->role_name, '_');

        if (array_key_exists($roleKey, $roles)) {
            return back()->with('error', 'Peran dengan nama tersebut sudah ada.');
        }

        $roles[$roleKey] = $request->role_name;
        Pengaturan::setValue('system_roles', json_encode($roles));
        Pengaturan::setValue("permissions_{$roleKey}", json_encode([])); // Initialize empty permissions

        \App\Models\ActivityLog::log('SETTINGS', 'Menambahkan peran baru: ' . $request->role_name);

        return redirect()->route('permissions.index')->with('success', 'Peran baru berhasil ditambahkan!');
    }

    public function deleteRole(Request $request, $roleKey)
    {
        if (in_array($roleKey, ['admin', 'guru', 'wali_kelas', 'siswa'])) {
            return back()->with('error', 'Peran bawaan sistem tidak dapat dihapus.');
        }

        $rolesData = Pengaturan::getValue('system_roles');
        $roles = $rolesData ? (json_decode($rolesData, true) ?: []) : [];

        if (array_key_exists($roleKey, $roles)) {
            unset($roles[$roleKey]);
            Pengaturan::setValue('system_roles', json_encode($roles));
            
            // Hapus juga tabel permissions untuk role tersebut jika perlu
            // Karena tidak ada method delete, kita bisa kosongkan saja
            Pengaturan::setValue("permissions_{$roleKey}", json_encode([])); 

            \App\Models\ActivityLog::log('SETTINGS', 'Menghapus peran: ' . $roleKey);
            return redirect()->route('permissions.index')->with('success', 'Peran berhasil dihapus.');
        }

        return back()->with('error', 'Peran tidak ditemukan.');
    }

    public function unlockPermissions(Request $request)
    {
        $password = $request->input('password');
        $expected = Pengaturan::getValue('permissions_page_password', 'admin123');
        
        if ($password === $expected) {
            session(['permissions_unlocked' => true]);
            session(['permissions_last_activity' => time()]);
            return redirect()->route('permissions.index');
        }
        
        return back()->withErrors(['password' => 'Password yang Anda masukkan salah!']);
    }

    public function lockPermissions()
    {
        session()->forget('permissions_unlocked');
        session()->forget('permissions_last_activity');
        return redirect()->route('permissions.index');
    }

    public function userAccounts(Request $request)
    {
        $showAlumni = $request->get('show_alumni', false);

        $query = \App\Models\User::with(['teacher', 'student.riwayatKelas']);

        if (!$showAlumni) {
            $query->whereDoesntHave('student', function ($q) {
                $q->whereIn('status', ['lulus', 'mutasi']);
            });
        }

        $users = $query->get()->sort(function ($a, $b) {
            $roleOrder = ['super_admin' => 1, 'admin' => 1, 'guru' => 2, 'siswa' => 3];
            $roleA = $roleOrder[$a->role] ?? 4;
            $roleB = $roleOrder[$b->role] ?? 4;

            if ($roleA !== $roleB) {
                return $roleA <=> $roleB;
            }

            if ($a->role === 'siswa' && $b->role === 'siswa') {
                $kelasA = $a->student?->resolved_kelas ?? $a->student?->kelas ?? '';
                $kelasB = $b->student?->resolved_kelas ?? $b->student?->kelas ?? '';

                if ($kelasA !== $kelasB) {
                    return strnatcasecmp($kelasA, $kelasB);
                }
            }

            return strnatcasecmp($a->nama, $b->nama);
        })->values();

        return view('pengaturan.user_accounts', compact('users', 'showAlumni'));
    }

    public function exportUserAccounts(Request $request)
    {
        $showAlumni = $request->get('show_alumni', false);
        $roleFilter = $request->get('role', null);

        $query = \App\Models\User::with(['teacher', 'student.riwayatKelas']);

        if (!$showAlumni) {
            $query->whereDoesntHave('student', function ($q) {
                $q->whereIn('status', ['lulus', 'mutasi']);
            });
        }

        if ($roleFilter) {
            $roleLower = strtolower($roleFilter);
            if ($roleLower === 'super admin' || $roleLower === 'admin' || $roleLower === 'super_admin') {
                $query->whereIn('role', ['admin', 'super_admin']);
            } elseif ($roleLower === 'guru') {
                $query->where('role', 'guru');
            } elseif ($roleLower === 'siswa') {
                $query->where('role', 'siswa');
            }
        }

        $users = $query->get()->sort(function ($a, $b) {
            $roleOrder = ['super_admin' => 1, 'admin' => 1, 'guru' => 2, 'siswa' => 3];
            $roleA = $roleOrder[$a->role] ?? 4;
            $roleB = $roleOrder[$b->role] ?? 4;

            if ($roleA !== $roleB) {
                return $roleA <=> $roleB;
            }

            if ($a->role === 'siswa' && $b->role === 'siswa') {
                $kelasA = $a->student?->resolved_kelas ?? $a->student?->kelas ?? '';
                $kelasB = $b->student?->resolved_kelas ?? $b->student?->kelas ?? '';

                if ($kelasA !== $kelasB) {
                    return strnatcasecmp($kelasA, $kelasB);
                }
            }

            return strnatcasecmp($a->nama, $b->nama);
        })->values();
        $schoolName = Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Title Kop
        $sheet->setCellValue('A1', 'DATA DISTRIBUSI AKUN PENGGUNA E-LEARNING');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setName('Arial')->setSize(14)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', $schoolName);
        $sheet->mergeCells('A2:H2');
        $sheet->getStyle('A2')->getFont()->setName('Arial')->setSize(11)->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $filterText = $roleFilter ? ' (Filter: ' . $roleFilter . ')' : '';
        $sheet->setCellValue('A3', 'Diekspor oleh: ' . (auth()->user()?->nama ?? 'Admin') . ' pada ' . date('d/m/Y H:i') . ' WIB | Total: ' . count($users) . ' Akun' . $filterText);
        $sheet->mergeCells('A3:H3');
        $sheet->getStyle('A3')->getFont()->setName('Arial')->setSize(10);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header Table
        $headers = ['No', 'Nama Pengguna', 'Username / Email', 'Password Default', 'Peran (Role)', 'NIS / NIP', 'Kelas / Unit', 'Status Akun'];
        $sheet->fromArray($headers, null, 'A5');

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'name' => 'Arial',
                'size' => 10
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D65A20']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A5:H5')->applyFromArray($headerStyle);
        $sheet->getRowDimension(5)->setRowHeight(24);

        // Data Rows
        $data = [];
        $no = 1;
        foreach ($users as $user) {
            $roleLabel = 'Siswa';
            if ($user->role === 'admin' || $user->role === 'super_admin') {
                $roleLabel = 'Super Admin';
            } elseif ($user->role === 'guru') {
                $roleLabel = 'Guru';
            }

            $identityNo = '-';
            $kelasUnit = '-';
            $status = 'Aktif';

            if ($user->role === 'guru' && $user->teacher) {
                $identityNo = $user->teacher->nip ?? '-';
                $kelasUnit = 'Guru Pengajar';
                $status = ($user->teacher->status === 'aktif' || $user->teacher->status === 'active') ? 'Aktif' : 'Nonaktif';
            } elseif ($user->role === 'siswa' && $user->student) {
                $identityNo = $user->student->nis ?? '-';
                $kelasUnit = $user->student->resolved_kelas ?? $user->student->kelas ?? '-';
                $statusVal = $user->student->status;
                if ($statusVal === 'aktif' || $statusVal === 'active') {
                    $status = 'Aktif';
                } elseif ($statusVal === 'mutasi') {
                    $status = 'Mutasi';
                } elseif ($statusVal === 'lulus') {
                    $status = 'Lulus (Alumni)';
                } else {
                    $status = 'Nonaktif';
                }
            } elseif ($user->isSuperAdmin()) {
                $kelasUnit = 'Administrator';
            }

            $passwordNote = 'password';

            $data[] = [
                $no++,
                $user->nama,
                $user->email,
                $passwordNote,
                $roleLabel,
                $identityNo,
                $kelasUnit,
                $status
            ];
        }

        if (count($data) > 0) {
            $sheet->fromArray($data, null, 'A6');
            $lastRow = 5 + count($data);
            $dataRange = 'A6:H' . $lastRow;

            $dataStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'CBD5E1']
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]
            ];
            $sheet->getStyle($dataRange)->applyFromArray($dataStyle);
            $sheet->getStyle('A6:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D6:H' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Set Column Widths
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(28);
        $sheet->getColumnDimension('C')->setWidth(32);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(16);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(16);

        \App\Models\ActivityLog::log('SETTINGS', 'Mengekspor data distribusi akun pengguna ke Excel');

        $filename = 'Distribusi_Akun_Pengguna_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function resetPassword(\App\Models\User $user)
    {
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make('password')
        ]);

        return back()->with('success', 'Password pengguna "' . $user->nama . '" berhasil di-reset menjadi: password');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,super_admin'
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        \App\Models\User::create([
            'nama' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'Akun Administrator baru berhasil ditambahkan!');
    }

    public function updateUser(Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,' . $user->id,
            'role' => 'required|in:admin,super_admin,guru,siswa'
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'role.required' => 'Peran wajib diisi.',
        ]);

        $user->update([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ]);

        // Sync with Teacher/Student if they exist
        if ($user->role === 'guru' && $user->teacher) {
            $user->teacher->update([
                'nama' => $validated['name'],
                'email' => $validated['email']
            ]);
        } elseif ($user->role === 'siswa' && $user->student) {
            $user->student->update([
                'nama' => $validated['name'],
                'email' => $validated['email']
            ]);
        }

        return back()->with('success', 'Data akun pengguna berhasil diperbarui!');
    }

    public function toggleStatus(\App\Models\User $user)
    {
        $statusChanged = false;
        $newStatus = 'aktif';

        if ($user->role === 'guru' && $user->teacher) {
            $currentStatus = $user->teacher->status;
            $newStatus = ($currentStatus === 'aktif' || $currentStatus === 'active') ? 'nonaktif' : 'aktif';
            $user->teacher->update(['status' => $newStatus]);
            $statusChanged = true;
        } elseif ($user->role === 'siswa' && $user->student) {
            $currentStatus = $user->student->status;
            $newStatus = ($currentStatus === 'aktif' || $currentStatus === 'active') ? 'nonaktif' : 'aktif';
            $user->student->update(['status' => $newStatus]);
            $statusChanged = true;
        }

        if ($statusChanged) {
            $statusLabel = ($newStatus === 'aktif') ? 'diaktifkan' : 'dinonaktifkan';
            return back()->with('success', 'Status akun pengguna "' . $user->nama . '" berhasil ' . $statusLabel . '!');
        }

        return back()->with('error', 'Status akun administrator tidak dapat diubah.');
    }

    public function addAcademicYear(Request $request)
    {
        $validated = $request->validate([
            'tahun_ajaran' => ['required', 'string', 'regex:/^\d{4}\/\d{4}$/'],
        ]);

        $newYear = $validated['tahun_ajaran'];

        // Ambil list tahun ajaran custom saat ini
        $custom_years = json_decode(Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
        if (!is_array($custom_years)) {
            $custom_years = [];
        }

        if (!in_array($newYear, $custom_years)) {
            $custom_years[] = $newYear;
            Pengaturan::setValue('daftar_tahun_ajaran_custom', json_encode($custom_years));
        }

        return response()->json([
            'success' => true,
            'message' => 'Tahun ajaran ' . $newYear . ' berhasil ditambahkan ke daftar pilihan!',
            'tahun_ajaran' => $newYear,
        ]);
    }

    public function deleteAcademicYear(Request $request)
    {
        $validated = $request->validate([
            'tahun_ajaran' => ['required', 'string'],
        ]);

        $targetYear = $validated['tahun_ajaran'];

        // 1. Cek apakah ini tahun ajaran aktif
        $activeYear = Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
        if ($targetYear === $activeYear) {
            return response()->json([
                'success' => false,
                'message' => 'Tahun ajaran aktif tidak dapat dihapus. Silakan ganti tahun ajaran aktif terlebih dahulu.',
            ], 422);
        }

        // 2. Cek apakah tahun ajaran ini memiliki kelas di database
        $hasClass = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('academic_year', $targetYear)
            ->exists();

        if ($hasClass) {
            return response()->json([
                'success' => false,
                'message' => 'Tahun ajaran ini memiliki data kelas aktif di database dan tidak dapat dihapus.',
            ], 422);
        }

        // 3. Ambil custom years list
        $custom_years = json_decode(Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
        if (!is_array($custom_years)) {
            $custom_years = [];
        }

        if (($key = array_search($targetYear, $custom_years)) !== false) {
            unset($custom_years[$key]);
            $custom_years = array_values($custom_years); // reindex
            Pengaturan::setValue('daftar_tahun_ajaran_custom', json_encode($custom_years));

            return response()->json([
                'success' => true,
                'message' => 'Tahun ajaran ' . $targetYear . ' berhasil dihapus dari daftar pilihan!',
                'tahun_ajaran' => $targetYear,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tahun ajaran tidak ditemukan dalam daftar kustom.',
        ], 422);
    }

    public function editAcademicYear(Request $request)
    {
        $validated = $request->validate([
            'old_tahun_ajaran' => ['required', 'string'],
            'new_tahun_ajaran' => ['required', 'string', 'regex:/^\d{4}\/\d{4}$/'],
        ], [
            'new_tahun_ajaran.regex' => 'Format tahun ajaran baru harus YYYY/YYYY (contoh: 2026/2027)',
        ]);

        $oldYear = $validated['old_tahun_ajaran'];
        $newYear = $validated['new_tahun_ajaran'];

        // 1. Ambil list tahun ajaran kustom dan perbarui jika ada
        $custom_years = json_decode(Pengaturan::getValue('daftar_tahun_ajaran_custom', '[]'), true);
        if (!is_array($custom_years)) {
            $custom_years = [];
        }

        // Cek apakah tahun ajaran baru sudah terdaftar (dan bukan yang sedang diedit)
        if (in_array($newYear, $custom_years) && $newYear !== $oldYear) {
            return response()->json([
                'success' => false,
                'message' => 'Tahun ajaran ' . $newYear . ' sudah terdaftar.',
            ], 422);
        }

        $updatedCustom = false;
        if (($key = array_search($oldYear, $custom_years)) !== false) {
            $custom_years[$key] = $newYear;
            $custom_years = array_values(array_unique($custom_years));
            Pengaturan::setValue('daftar_tahun_ajaran_custom', json_encode($custom_years));
            $updatedCustom = true;
        }

        // 2. Jika tahun ajaran lama adalah tahun ajaran aktif, perbarui juga
        $activeYear = Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
        $isActive = ($oldYear === $activeYear);
        if ($isActive) {
            Pengaturan::setValue('tahun_ajaran_aktif', $newYear);
        }

        // 3. Perbarui data kelas di database yang menggunakan tahun ajaran ini
        $affectedClasses = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('academic_year', $oldYear)
            ->update(['academic_year' => $newYear]);

        // Cek apakah ada perubahan yang dilakukan (untuk mencegah input tidak valid/tidak ditemukan)
        if (!$updatedCustom && !$isActive && $affectedClasses === 0) {
            // Cek apakah tahun ajaran lama ada di database kelas (tanpa global scope) atau di dropdown
            // Jika tidak ada di keduanya, kembalikan error
            return response()->json([
                'success' => false,
                'message' => 'Tahun ajaran tidak ditemukan di sistem.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tahun ajaran berhasil diubah dari ' . $oldYear . ' menjadi ' . $newYear . '!',
            'old_tahun_ajaran' => $oldYear,
            'new_tahun_ajaran' => $newYear,
            'is_active' => $isActive,
        ]);
    }

    public function activityLogs(Request $request)
    {
        $query = \App\Models\ActivityLog::with('user');

        // Apply filters
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', '%' . $search . '%')
                  ->orWhere('action', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('nama', 'like', '%' . $search . '%')
                         ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($request->has('action_type') && !empty($request->input('action_type'))) {
            $query->where('action', $request->input('action_type'));
        }

        $logs = $query->latest()->paginate(25)->withQueryString();

        // Get unique action types for filter dropdown
        $actionTypes = \App\Models\ActivityLog::select('action')->distinct()->pluck('action')->toArray();

        return view('pengaturan.activity_logs', compact('logs', 'actionTypes'));
    }

    /**
     * Membuka kunci tab pemeliharaan data.
     */
    public function unlockMaintenance(Request $request)
    {
        $expected = Pengaturan::getValue('permissions_page_password', 'admin123');
        if ($request->input('password') === $expected) {
            session(['maintenance_unlocked' => true]);
            session(['maintenance_last_activity' => time()]);
            return redirect()->route('settings.index', ['tab' => 'pemeliharaan']);
        }
        return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
            ->withErrors(['maintenance_password' => 'Password administrator tidak valid.']);
    }

    /**
     * Mengunci kembali tab pemeliharaan data.
     */
    public function lockMaintenance()
    {
        session()->forget('maintenance_unlocked');
        session()->forget('maintenance_last_activity');
        return redirect()->route('settings.index', ['tab' => 'pemeliharaan']);
    }

    /**
     * Membersihkan cache aplikasi (config, view, route, cache data).
     * Diimplementasikan dalam Bahasa Indonesia untuk kemudahan pemeliharaan.
     */
    public function bersihkanCache(Request $request)
    {
        try {
            \Artisan::call('cache:clear');
            \Artisan::call('config:clear');
            \Artisan::call('view:clear');
            \Artisan::call('route:clear');

            // Catat log aktivitas
            \App\Models\ActivityLog::create([
                'pengguna_id' => auth()->id(),
                'action' => 'CLEARED_CACHE',
                'description' => 'Membersihkan cache sistem (cache, config, view, route)',
            ]);

            return redirect()->route('settings.index')
                ->with('success', 'Cache sistem berhasil dibersihkan!');
        } catch (\Exception $e) {
            return redirect()->route('settings.index')
                ->with('error', 'Gagal membersihkan cache: ' . $e->getMessage());
        }
    }

    /**
     * Mengunduh file backup database (.sql) secara native menggunakan PDO.
     */
    public function cadangkanDatabase()
    {
        try {
            $pdo = \DB::connection()->getPdo();
            $daftarTabel = [];
            $kueriTabel = $pdo->query("SHOW TABLES");
            while ($baris = $kueriTabel->fetch(\PDO::FETCH_NUM)) {
                $daftarTabel[] = $baris[0];
            }

            $kontenSql = "-- Backup Database E-Learning SMAN 1 Cepogo\n";
            $kontenSql .= "-- Dibuat pada: " . date('Y-m-d H:i:s') . "\n";
            $kontenSql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($daftarTabel as $tabel) {
                // Ambil perintah CREATE TABLE
                $skemaTabel = $pdo->query("SHOW CREATE TABLE `{$tabel}`")->fetch(\PDO::FETCH_ASSOC);
                $kontenSql .= "DROP TABLE IF EXISTS `{$tabel}`;\n";
                $kontenSql .= $skemaTabel['Create Table'] . ";\n\n";

                // Ambil data baris
                $kueriData = $pdo->query("SELECT * FROM `{$tabel}`");
                $dataBaris = $kueriData->fetchAll(\PDO::FETCH_ASSOC);
                
                if (count($dataBaris) > 0) {
                    $kontenSql .= "INSERT INTO `{$tabel}` VALUES \n";
                    $barisInsert = [];
                    foreach ($dataBaris as $baris) {
                        $nilaiKolom = [];
                        foreach ($baris as $nilai) {
                            if (is_null($nilai)) {
                                $nilaiKolom[] = "NULL";
                            } else {
                                $nilaiKolom[] = $pdo->quote($nilai);
                            }
                        }
                        $barisInsert[] = "(" . implode(", ", $nilaiKolom) . ")";
                    }
                    $kontenSql .= implode(",\n", $barisInsert) . ";\n\n";
                }
            }

            $kontenSql .= "SET FOREIGN_KEY_CHECKS=1;\n";

            // Catat log aktivitas
            \App\Models\ActivityLog::create([
                'pengguna_id' => auth()->id(),
                'action' => 'BACKUP_DB',
                'description' => 'Melakukan pencadangan database secara manual',
            ]);

            $namaBerkas = 'cadangan_database_' . date('Ymd_His') . '.sql';

            return response($kontenSql, 200, [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $namaBerkas . '"',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('settings.index')
                ->with('error', 'Gagal mencadangkan database: ' . $e->getMessage());
        }
    }

    /**
     * Memulihkan database dari file backup (.sql) yang diunggah.
     * Membutuhkan konfirmasi password administrator.
     */
    public function pulihkanDatabase(Request $request)
    {
        $request->validate([
            'berkas_sql' => 'required|file',
            'password' => 'required|string',
        ]);

        // Verifikasi password Super Admin saat ini
        if (!\Hash::check($request->password, auth()->user()->password)) {
            return redirect()->route('settings.index')
                ->with('error', 'Password administrator tidak valid. Pemulihan database dibatalkan.');
        }

        try {
            $berkas = $request->file('berkas_sql');
            $isiSql = file_get_contents($berkas->getRealPath());

            // Eksekusi pemulihan database
            \DB::unprepared("SET FOREIGN_KEY_CHECKS=0;");
            \DB::unprepared($isiSql);
            \DB::unprepared("SET FOREIGN_KEY_CHECKS=1;");

            // Catat log aktivitas
            \App\Models\ActivityLog::create([
                'pengguna_id' => auth()->id(),
                'action' => 'RESTORE_DB',
                'description' => 'Melakukan pemulihan database dari berkas: ' . $berkas->getClientOriginalName(),
            ]);

            return redirect()->route('settings.index')
                ->with('success', 'Database berhasil dipulihkan dari berkas ' . $berkas->getClientOriginalName());
        } catch (\Exception $e) {
            return redirect()->route('settings.index')
                ->with('error', 'Gagal memulihkan database: ' . $e->getMessage());
        }
    }

    /**
     * Melakukan reset data operasional secara selektif.
     * Membutuhkan konfirmasi password administrator.
     */
    public function resetData(Request $request)
    {
        $request->validate([
            'opsi' => 'required|array|min:1',
            'password' => 'required|string',
        ]);

        // Verifikasi password Super Admin saat ini
        if (!\Hash::check($request->password, auth()->user()->password)) {
            return redirect()->route('settings.index')
                ->with('error', 'Password administrator tidak valid. Reset data dibatalkan.');
        }

        try {
            $opsiDipilih = $request->input('opsi');
            $catatanPembersihan = [];

            // Matikan foreign key check selama pembersihan
            \DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // 1. Reset Tugas, Nilai, Pengumpulan, dan Banding
            if (in_array('tugas_nilai', $opsiDipilih)) {
                \DB::table('pengajuan_banding')->truncate();
                \DB::table('pemulihan_pengumpulan')->truncate();
                \DB::table('pengumpulan')->truncate();
                \DB::table('nilai')->truncate();
                \DB::table('tugas')->truncate();
                $catatanPembersihan[] = 'Data Tugas, Nilai, Pengumpulan, & Banding';
            }

            // 2. Reset Materi Pembelajaran
            if (in_array('materi', $opsiDipilih)) {
                \DB::table('materi')->truncate();
                $catatanPembersihan[] = 'Data Materi Pembelajaran';
            }

            // 3. Reset Plotting Kelas Siswa & Guru
            if (in_array('plot_kelas', $opsiDipilih)) {
                \DB::table('siswa')->update(['kelas' => null]);
                \DB::table('guru_kelas')->truncate();
                $catatanPembersihan[] = 'Plotting Kelas Siswa & Guru Pengampu';
            }

            // Aktifkan kembali foreign key check
            \DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // Catat log aktivitas
            \App\Models\ActivityLog::create([
                'pengguna_id' => auth()->id(),
                'action' => 'RESET_DATA',
                'description' => 'Melakukan pembersihan data: ' . implode(', ', $catatanPembersihan),
            ]);

            return redirect()->route('settings.index')
                ->with('success', 'Reset data berhasil: ' . implode(', ', $catatanPembersihan) . ' telah dibersihkan.');
        } catch (\Exception $e) {
            // Jamin foreign key checks tetap menyala jika ada error
            \DB::statement('SET FOREIGN_KEY_CHECKS=1');
            return redirect()->route('settings.index')
                ->with('error', 'Gagal mereset data: ' . $e->getMessage());
        }
    }

    /**
     * Mengekspor database SQL dan file media unggahan (materi/tugas) ke berkas ZIP.
     */
    public function eksporArsip()
    {
        // Deteksi apakah ekstensi PHP ZipArchive didukung di server ini
        if (!class_exists('\ZipArchive')) {
            return redirect()->route('settings.index')
                ->with('error', 'Fitur Ekspor Arsip ZIP gagal dijalankan karena ekstensi ZIP (ZipArchive) dinonaktifkan atau diblokir pada konfigurasi server PHP ini.');
        }

        try {
            $zip = new \ZipArchive();
            $namaZip = 'arsip_elearning_' . date('Ymd_His') . '.zip';
            $pathZip = storage_path('app/' . $namaZip);

            if ($zip->open($pathZip, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
                // 1. Cadangkan database ke berkas sql sementara
                $pdo = \DB::connection()->getPdo();
                $daftarTabel = [];
                $kueriTabel = $pdo->query("SHOW TABLES");
                while ($baris = $kueriTabel->fetch(\PDO::FETCH_NUM)) {
                    $daftarTabel[] = $baris[0];
                }

                $kontenSql = "-- Backup Database E-Learning SMAN 1 Cepogo (Arsip ZIP)\n";
                $kontenSql .= "-- Dibuat pada: " . date('Y-m-d H:i:s') . "\n";
                $kontenSql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

                foreach ($daftarTabel as $tabel) {
                    $skemaTabel = $pdo->query("SHOW CREATE TABLE `{$tabel}`")->fetch(\PDO::FETCH_ASSOC);
                    $kontenSql .= "DROP TABLE IF EXISTS `{$tabel}`;\n";
                    $kontenSql .= $skemaTabel['Create Table'] . ";\n\n";

                    $kueriData = $pdo->query("SELECT * FROM `{$tabel}`");
                    $dataBaris = $kueriData->fetchAll(\PDO::FETCH_ASSOC);
                    if (count($dataBaris) > 0) {
                        $kontenSql .= "INSERT INTO `{$tabel}` VALUES \n";
                        $barisInsert = [];
                        foreach ($dataBaris as $baris) {
                            $nilaiKolom = [];
                            foreach ($baris as $nilai) {
                                if (is_null($nilai)) {
                                    $nilaiKolom[] = "NULL";
                                } else {
                                    $nilaiKolom[] = $pdo->quote($nilai);
                                }
                            }
                            $barisInsert[] = "(" . implode(", ", $nilaiKolom) . ")";
                        }
                        $kontenSql .= implode(",\n", $barisInsert) . ";\n\n";
                    }
                }
                $kontenSql .= "SET FOREIGN_KEY_CHECKS=1;\n";
                
                $pathSqlSementara = storage_path('app/temp_db_backup.sql');
                file_put_contents($pathSqlSementara, $kontenSql);
                
                // Masukkan file sql ke zip
                $zip->addFile($pathSqlSementara, 'database_elearning.sql');

                // 2. Ekspor File Terstruktur berdasarkan Database Aktif (Materi, Tugas, Pengumpulan, Banding)
                $fileCount = 0;
                
                // --- A. Materi Pembelajaran ---
                $materis = \App\Models\Materi::with('subject.course')->get();
                foreach ($materis as $materi) {
                    if ($materi->file_path) {
                        $mapel = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $materi->subject->course->nama ?? 'Umum'));
                        $judul = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $materi->title));
                        
                        $filePath = storage_path('app/' . $materi->file_path);
                        if (!file_exists($filePath)) {
                            $filePath = storage_path('app/public/' . $materi->file_path);
                        }
                        
                        if (file_exists($filePath)) {
                            $ext = pathinfo($filePath, PATHINFO_EXTENSION);
                            $zip->addFile($filePath, "Materi/{$mapel}/{$judul}.{$ext}");
                            $fileCount++;
                        }
                    }
                }

                // --- B. Soal Tugas Guru ---
                $tugases = \App\Models\Tugas::with('subject.course')->get();
                foreach ($tugases as $tugas) {
                    if ($tugas->lampiran) {
                        $mapel = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $tugas->subject->course->nama ?? 'Umum'));
                        $judul = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $tugas->judul));
                        
                        $filePath = storage_path('app/' . $tugas->lampiran);
                        if (!file_exists($filePath)) {
                            $filePath = storage_path('app/public/' . $tugas->lampiran);
                        }
                        
                        if (file_exists($filePath)) {
                            $ext = pathinfo($filePath, PATHINFO_EXTENSION);
                            $zip->addFile($filePath, "Tugas/{$mapel}/{$judul}/[Soal_Guru]_{$judul}.{$ext}");
                            $fileCount++;
                        }
                    }
                }

                // --- C. Jawaban Pengumpulan Siswa ---
                $pengumpulans = \App\Models\Pengumpulan::with(['student', 'assignment.subject.course'])->get();
                foreach ($pengumpulans as $sub) {
                    if ($sub->file_tugas) {
                        $mapel = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $sub->assignment->subject->course->nama ?? 'Umum'));
                        $judul = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $sub->assignment->judul ?? 'Tanpa_Judul'));
                        $siswa = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $sub->student->nama ?? 'Anonim'));
                        
                        $filePath = storage_path('app/' . $sub->file_tugas);
                        if (!file_exists($filePath)) {
                            $filePath = storage_path('app/public/' . $sub->file_tugas);
                        }
                        
                        if (file_exists($filePath)) {
                            $ext = pathinfo($sub->original_name ?? $filePath, PATHINFO_EXTENSION);
                            $zip->addFile($filePath, "Tugas/{$mapel}/{$judul}/[Jawaban]_{$siswa}.{$ext}");
                            $fileCount++;
                        }
                    }
                }
                
                // --- D. Bukti Banding Nilai ---
                $bandings = \App\Models\Banding::with(['student', 'subject.course'])->get();
                foreach ($bandings as $banding) {
                    if ($banding->bukti_pendukung) {
                        $mapel = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $banding->subject->course->nama ?? 'Umum'));
                        $siswa = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $banding->student->nama ?? 'Anonim'));
                        
                        $filePath = storage_path('app/' . $banding->bukti_pendukung);
                        if (!file_exists($filePath)) {
                            $filePath = storage_path('app/public/' . $banding->bukti_pendukung);
                        }
                        
                        if (file_exists($filePath)) {
                            $ext = pathinfo($filePath, PATHINFO_EXTENSION);
                            $zip->addFile($filePath, "Banding_Nilai/{$mapel}/[Bukti]_{$siswa}_{$banding->id}.{$ext}");
                            $fileCount++;
                        }
                    }
                }

                $zip->close();
                
                // Hapus berkas sql sementara
                if (file_exists($pathSqlSementara)) {
                    unlink($pathSqlSementara);
                }

                // Catat log aktivitas
                \App\Models\ActivityLog::create([
                    'pengguna_id' => auth()->id(),
                    'action' => 'EXPORT_ARCHIVE',
                    'description' => 'Melakukan ekspor arsip sistem lengkap (database + unggahan file)',
                ]);

                return response()->download($pathZip)->deleteFileAfterSend(true);
            } else {
                throw new \Exception('Gagal membuat berkas ZIP.');
            }
        } catch (\Exception $e) {
            return redirect()->route('settings.index')
                ->with('error', 'Gagal mengekspor arsip data sekolah: ' . $e->getMessage());
        }
    }

    /**
     * Membekukan (Freeze) akses unggah ke folder storage/app/submissions dan storage/app/tugas
     */
    public function freezeStorage(Request $request)
    {
        try {
            Pengaturan::setValue('storage_frozen', '1');
            
            $submissionsPath = storage_path('app/submissions');
            $tugasPath = storage_path('app/tugas');
            
            if (file_exists($submissionsPath)) { @chmod($submissionsPath, 0555); }
            if (file_exists($tugasPath)) { @chmod($tugasPath, 0555); }

            \App\Models\ActivityLog::create([
                'pengguna_id' => auth()->id(),
                'action' => 'STORAGE_FREEZE',
                'description' => 'Membekukan direktori penyimpanan tugas (Read-Only)',
            ]);

            return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                ->with('success', 'Direktori penyimpanan berhasil dibekukan (Read-Only). Siswa maupun Guru tidak dapat lagi mengunggah tugas baru.');
        } catch (\Exception $e) {
            return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                ->with('error', 'Gagal membekukan direktori: ' . $e->getMessage());
        }
    }

    /**
     * Membuka kembali kunci (Unfreeze) folder storage
     */
    public function unfreezeStorage(Request $request)
    {
        try {
            Pengaturan::setValue('storage_frozen', '0');
            
            $submissionsPath = storage_path('app/submissions');
            $tugasPath = storage_path('app/tugas');
            
            if (file_exists($submissionsPath)) { @chmod($submissionsPath, 0755); }
            if (file_exists($tugasPath)) { @chmod($tugasPath, 0755); }

            \App\Models\ActivityLog::create([
                'pengguna_id' => auth()->id(),
                'action' => 'STORAGE_UNFREEZE',
                'description' => 'Membuka kunci direktori penyimpanan tugas (Writable)',
            ]);

            return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                ->with('success', 'Direktori penyimpanan berhasil dibuka kuncinya. Operasi unggah berkas kini diizinkan.');
        } catch (\Exception $e) {
            return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                ->with('error', 'Gagal membuka kunci direktori: ' . $e->getMessage());
        }
    }

    /**
     * Ekspor arsip spesifik berdasarkan Kelas dan Tahun Ajaran
     */
    public function eksporArsipKelas(Request $request)
    {
        if (!class_exists('\ZipArchive')) {
            return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                ->with('error', 'Fitur ini membutuhkan ekstensi ZipArchive PHP.');
        }

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'nullable|exists:mata_pelajaran,id'
        ]);

        try {
            // Kita bypass global scope tahun_ajaran agar admin bisa narik data tahun berapapun
            $kelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')->findOrFail($request->kelas_id);
            $tahunAjaran = str_replace('/', '-', $kelas->academic_year);
            $namaKelas = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $kelas->name));
            
            $mataPelajaranStr = $request->filled('mata_pelajaran_id') ? '_Mapel_' . $request->mata_pelajaran_id : '';
            $zip = new \ZipArchive();
            $namaZip = 'Arsip_Kelas_' . $namaKelas . '_TA_' . $tahunAjaran . $mataPelajaranStr . '.zip';
            $pathZip = storage_path('app/' . $namaZip);

            if ($zip->open($pathZip, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
                throw new \Exception('Gagal membuat berkas ZIP.');
            }

            $fileCount = 0;

            // 1. Ambil Materi untuk kelas ini
            $materiQuery = \App\Models\Materi::where('kelas_id', $kelas->id)->with('subject.course');
            if ($request->filled('mata_pelajaran_id')) {
                $materiQuery->where('subject_id', $request->mata_pelajaran_id);
            }
            $materis = $materiQuery->get();

            foreach ($materis as $materi) {
                if ($materi->file_path) {
                    $mapel = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $materi->subject->course->nama ?? 'Umum'));
                    $judul = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $materi->title));
                    
                    $filePath = storage_path('app/' . $materi->file_path);
                    if (!file_exists($filePath)) {
                        $filePath = storage_path('app/public/' . $materi->file_path);
                    }

                    if (file_exists($filePath)) {
                        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
                        $zipPath = $mapel . '/Materi/' . $judul . '.' . $ext;
                        $zip->addFile($filePath, $zipPath);
                        $fileCount++;
                    }
                }
            }

            // 2. Ambil Tugas untuk kelas ini
            $assignmentsQuery = \App\Models\Tugas::where('kelas_id', $kelas->id)->with('subject.course');
            if ($request->filled('mata_pelajaran_id')) {
                $assignmentsQuery->where('mata_pelajaran_id', $request->mata_pelajaran_id);
            }
            $assignments = $assignmentsQuery->get();
            $assignmentIds = $assignments->pluck('id');

            // 3. Masukkan file Soal (Tugas) Guru
            foreach ($assignments as $assignment) {
                if ($assignment->lampiran) {
                    $mataPelajaran = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $assignment->subject->course->nama ?? 'Umum'));
                    $namaTugas = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $assignment->judul));
                    
                    $filePath = storage_path('app/' . $assignment->lampiran);
                    if (!file_exists($filePath)) {
                        $filePath = storage_path('app/public/' . $assignment->lampiran);
                    }

                    if (file_exists($filePath)) {
                        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
                        $zipPath = $mataPelajaran . '/Tugas/' . $namaTugas . '/[Soal_Guru]_' . $namaTugas . '.' . $ext;
                        $zip->addFile($filePath, $zipPath);
                        $fileCount++;
                    }
                }
            }

            // 4. Masukkan file Pengumpulan Siswa
            $submissions = \App\Models\Pengumpulan::whereIn('tugas_id', $assignmentIds)
                ->with(['student', 'assignment.subject.course'])
                ->get();

            foreach ($submissions as $sub) {
                if ($sub->file_tugas) {
                    $mataPelajaran = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $sub->assignment->subject->course->nama ?? 'Umum'));
                    $namaTugas = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $sub->assignment->judul ?? 'Tanpa_Judul'));
                    $namaSiswa = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $sub->student->nama ?? 'Anonim'));
                    
                    $filePath = storage_path('app/' . $sub->file_tugas);
                    if (!file_exists($filePath)) {
                        $filePath = storage_path('app/public/' . $sub->file_tugas);
                    }

                    if (file_exists($filePath)) {
                        $ext = pathinfo($sub->original_name ?? $filePath, PATHINFO_EXTENSION);
                        $zipPath = $mataPelajaran . '/Tugas/' . $namaTugas . '/[Jawaban]_' . $namaSiswa . '.' . $ext;
                        $zip->addFile($filePath, $zipPath);
                        $fileCount++;
                    }
                }
            }

            if ($fileCount === 0) {
                $zip->close();
                if (file_exists($pathZip)) { unlink($pathZip); }
                return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                    ->with('error', 'Tidak ada data file tugas maupun pengumpulan siswa di kelas ini.');
            }

            $zip->close();

            \App\Models\ActivityLog::create([
                'pengguna_id' => auth()->id(),
                'action' => 'EXPORT_CLASS',
                'description' => 'Mengekspor arsip fisik kelas ' . $kelas->name . ' (TA ' . $kelas->academic_year . ')',
            ]);

            return response()->download($pathZip)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                ->with('error', 'Gagal mengekspor arsip kelas: ' . $e->getMessage());
        }
    }
    public function archiveAlumniSubmissions(Request $request)
    {
        try {
            // Dapatkan seluruh file pengumpulan tugas dari siswa yang statusnya 'lulus'
            $submissions = \App\Models\Pengumpulan::whereHas('student', function ($query) {
                $query->where('status', 'lulus');
            })->whereNotNull('file_tugas')->get();

            if ($submissions->isEmpty()) {
                return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                    ->with('error', 'Tidak ada file pengumpulan tugas dari siswa alumni yang dapat diarsipkan.');
            }

            // Siapkan ZipArchive
            $zip = new \ZipArchive();
            $filename = 'arsip_alumni_' . date('Ymd_His') . '.zip';
            $storagePath = storage_path('app/archives');
            
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0755, true);
            }
            
            $zipPath = $storagePath . '/' . $filename;

            if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                $fileCount = 0;
                
                // Tambahkan file ke ZIP
                foreach ($submissions as $submission) {
                    // Cek di disk 'local' (storage/app)
                    $filePath = storage_path('app/' . $submission->file_tugas);
                    
                    if (file_exists($filePath)) {
                        $zip->addFile($filePath, $submission->file_tugas);
                        $fileCount++;
                    }
                }
                
                $zip->close();

                if ($fileCount === 0) {
                    // Zip kosong, hapus zip dan kembali
                    unlink($zipPath);
                    return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                        ->with('error', 'Semua record ditemukan namun file fisik sudah tidak ada di server.');
                }

                // Hapus file aslinya dari server
                foreach ($submissions as $submission) {
                    if (\Illuminate\Support\Facades\Storage::exists($submission->file_tugas)) {
                        \Illuminate\Support\Facades\Storage::delete($submission->file_tugas);
                    }
                    // Biarkan histori angkanya tetap ada, kita tidak men-null-kan kolom file agar 
                    // ketika diakses nanti tahu bahwa ini nama file aslinya (meski sudah terhapus fisik).
                }

                \App\Models\ActivityLog::create([
                    'pengguna_id' => auth()->id(),
                    'action' => 'ARCHIVE_ALUMNI',
                    'description' => "Mengarsipkan $fileCount file tugas siswa alumni dan menghapusnya dari server",
                ]);

                // Simpan url download sementara di session untuk dirender oleh UI via SweetAlert/Flash
                return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                    ->with('success', "$fileCount file tugas alumni berhasil diarsipkan ke dalam ZIP dan dibersihkan dari server. Silakan klik tombol di bawah untuk mengunduh salinan aslinya.")
                    ->with('download_archive_url', route('settings.download-alumni-archive', ['filename' => $filename]));
            } else {
                throw new \Exception('Gagal membuat berkas ZIP.');
            }
        } catch (\Exception $e) {
            return redirect()->route('settings.index', ['tab' => 'pemeliharaan'])
                ->with('error', 'Gagal memproses arsip file alumni: ' . $e->getMessage());
        }
    }

    public function downloadAlumniArchive($filename)
    {
        $path = storage_path('app/archives/' . $filename);
        if (file_exists($path)) {
            return response()->download($path); // Tidak dihapus otomatis jika ingin disimpan di server sbg backup
        }
        
        return abort(404, 'File arsip tidak ditemukan.');
    }

    // --- Helper function for Excel Multi-Sheet with Kop Surat ---
    private function streamMultiSheetExcel($filename, $sheetsData)
    {
        $spreadsheet = new Spreadsheet();
        
        $schoolName = Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo');
        $schoolEmail = Pengaturan::getValue('school_email', 'info@smansago.sch.id');
        $downloader = auth()->user() ? auth()->user()->name : 'Administrator';
        $downloadTime = \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d M Y H:i:s');
        
        foreach ($sheetsData as $index => $sheetInfo) {
            if ($index === 0) {
                $sheet = $spreadsheet->getActiveSheet();
            } else {
                $sheet = $spreadsheet->createSheet();
            }
            $sheet->setTitle(substr($sheetInfo['sheet_name'], 0, 31));
            
            $headers = $sheetInfo['headers'];
            $data = $sheetInfo['data'];
            $documentTitle = $sheetInfo['title'];
            
            $colCount = count($headers);
            $lastCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colCount);
            
            // Batasi merge Kop Surat maksimal 12 kolom agar tidak terlalu ke kanan/hilang saat dibuka
            $kopColCount = min($colCount, 12);
            $kopLastCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($kopColCount);
            
            // Kop Surat
            $sheet->mergeCells("A1:{$kopLastCol}1");
            $sheet->setCellValue('A1', mb_strtoupper($schoolName));
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
            $sheet->mergeCells("A2:{$kopLastCol}2");
            $sheet->setCellValue('A2', $schoolEmail);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
            $sheet->mergeCells("A3:{$kopLastCol}3");
            $sheet->setCellValue('A3', mb_strtoupper($documentTitle));
            $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(12);
            $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
            $sheet->mergeCells("A4:{$kopLastCol}4");
            $sheet->setCellValue('A4', 'Diunduh pada: ' . $downloadTime . ' | Oleh: ' . $downloader);
            $sheet->getStyle('A4')->getFont()->setItalic(true)->setSize(10);
            $sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
            // Header Tabel
            $startRow = 6;
            for ($i = 0; $i < $colCount; $i++) {
                $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);
                $sheet->setCellValue($colLetter . $startRow, $headers[$i]);
                $sheet->getStyle($colLetter . $startRow)->getFont()->setBold(true);
                $sheet->getColumnDimension($colLetter)->setAutoSize(true);
            }
            
            // Data
            $row = $startRow + 1;
            foreach ($data as $item) {
                for ($i = 0; $i < $colCount; $i++) {
                    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);
                    $sheet->setCellValue($colLetter . $row, $item[$i] ?? '-');
                }
                $row++;
            }
        }
        
        $spreadsheet->setActiveSheetIndex(0);
        
        $writer = new Xlsx($spreadsheet);
        
        return new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '.xlsx"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }

    // --- Helper function for single sheet (backward compatibility) ---
    private function streamExcelWithKop($filename, $documentTitle, $headers, $data, $tahunAjaranStr)
    {
        return $this->streamMultiSheetExcel($filename, [
            [
                'sheet_name' => 'Data',
                'title' => $documentTitle,
                'headers' => $headers,
                'data' => $data
            ]
        ]);
    }

    // 1. Download Archive Detail
    public function downloadArchiveDetail($year)
    {
        $yearDecoded = str_replace('-', '/', $year);
        
        // --- Daftar Kelas & Wali Kelas ---
        $daftarKelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->with('homeroomTeacher')
            ->where('academic_year', $yearDecoded)
            ->orderBy('name', 'asc')
            ->get();
            
        $headersKelas = ['No', 'Nama Kelas', 'Wali Kelas', 'Tahun Ajaran'];
        $dataKelas = [];
        $no = 1;
        foreach ($daftarKelas as $kelas) {
            $dataKelas[] = [
                $no++,
                $kelas->name,
                $kelas->homeroomTeacher ? $kelas->homeroomTeacher->nama : 'Belum Ditentukan',
                $kelas->academic_year
            ];
        }
        
        // --- Daftar Pengampuan Guru (Matrix) ---
        $semuaKelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->where('academic_year', $yearDecoded)
            ->orderBy('name', 'asc')
            ->pluck('name')
            ->toArray();
            
        $daftarPengampu = \Illuminate\Support\Facades\DB::table('guru_kelas')
            ->join('kelas', 'guru_kelas.kelas_id', '=', 'kelas.id')
            ->join('guru', 'guru_kelas.guru_id', '=', 'guru.id')
            ->leftJoin('mata_pelajaran', 'guru_kelas.mata_pelajaran_id', '=', 'mata_pelajaran.id')
            ->where('kelas.academic_year', $yearDecoded)
            ->select('guru.nama as guru_nama', 'kelas.name as kelas_nama', 'mata_pelajaran.nama as mapel_nama')
            ->orderBy('guru_nama', 'asc')
            ->orderBy('kelas_nama', 'asc')
            ->get();
            
        $matrixData = [];
        foreach ($daftarPengampu as $pengampu) {
            $guru = $pengampu->guru_nama;
            $kelas = $pengampu->kelas_nama;
            $mapel = $pengampu->mapel_nama ?? 'Umum';
            
            if (!isset($matrixData[$guru])) {
                $matrixData[$guru] = [];
            }
            if (!isset($matrixData[$guru][$kelas])) {
                $matrixData[$guru][$kelas] = [];
            }
            $matrixData[$guru][$kelas][] = $mapel;
        }

        $headersPengampu = array_merge(['No', 'Nama Guru Pengampu'], $semuaKelas);
        $dataPengampu = [];
        $noPengampu = 1;
        
        foreach ($matrixData as $guru => $kelasMap) {
            $row = [
                $noPengampu++,
                $guru
            ];
            
            foreach ($semuaKelas as $kelasName) {
                if (isset($kelasMap[$kelasName])) {
                    $row[] = implode(', ', $kelasMap[$kelasName]);
                } else {
                    $row[] = '-';
                }
            }
            
            $dataPengampu[] = $row;
        }
        
        return $this->streamMultiSheetExcel("arsip_periode_akademik_{$year}", [
            [
                'sheet_name' => 'Wali Kelas',
                'title' => "ARSIP KELAS TAHUN AJARAN {$yearDecoded}",
                'headers' => $headersKelas,
                'data' => $dataKelas
            ],
            [
                'sheet_name' => 'Pengampuan Guru',
                'title' => "PLOTTING PENGAMPUAN GURU TAHUN {$yearDecoded}",
                'headers' => $headersPengampu,
                'data' => $dataPengampu
            ]
        ]);
    }

    // 2. Download Alumni
    public function downloadAlumni($year)
    {
        $yearDecoded = str_replace('-', '/', $year);
        $alumni = \App\Models\Siswa::where('tahun_lulus', $yearDecoded)
            ->orderBy('name', 'asc')
            ->get();
            
        $headers = ['No', 'NIS', 'Nama Lengkap', 'L/P', 'Email', 'Tahun Lulus'];
        $data = [];
        $no = 1;
        foreach ($alumni as $siswa) {
            $data[] = [
                $no++,
                $siswa->nis,
                $siswa->name,
                $siswa->gender === 'male' ? 'L' : 'P',
                $siswa->email,
                $siswa->tahun_lulus
            ];
        }
        
        return $this->streamExcelWithKop(
            "arsip_alumni_{$year}", 
            "DATA ALUMNI LULUSAN {$yearDecoded}", 
            $headers, 
            $data, 
            $yearDecoded
        );
    }

    // 3. Download Arsip Siswa (Riwayat Kelas)
    public function downloadArsipSiswa($year)
    {
        $yearDecoded = str_replace('-', '/', $year);
        $riwayat = \App\Models\RiwayatKelasSiswa::with(['siswa'])
            ->where('academic_year', $yearDecoded)
            ->get()
            ->sortBy(function($item) {
                return ($item->kelas_name ?? '') . ($item->siswa ? $item->siswa->name : '');
            });
            
        $headers = ['No', 'NIS', 'Nama Siswa', 'Kelas', 'Tahun Ajaran'];
        $data = [];
        $no = 1;
        foreach ($riwayat as $item) {
            if (!$item->siswa) continue;
            $data[] = [
                $no++,
                $item->siswa->nis,
                $item->siswa->name,
                $item->kelas_name ?? 'N/A',
                $item->academic_year
            ];
        }
        
        return $this->streamExcelWithKop(
            "riwayat_kelas_siswa_{$year}", 
            "RIWAYAT KELAS SISWA TAHUN AJARAN {$yearDecoded}", 
            $headers, 
            $data, 
            $yearDecoded
        );
    }

    // 4. Download Mutasi
    public function downloadMutasi($year)
    {
        $yearDecoded = str_replace('-', '/', $year);
        $mutasi = \App\Models\MutasiSiswa::with('siswa')
            ->where('jenis_mutasi', 'keluar')
            ->whereYear('tanggal_mutasi', $yearDecoded)
            ->orderBy('tanggal_mutasi', 'desc')
            ->get();
            
        $headers = ['No', 'NIS', 'Nama Siswa', 'Jenis', 'Tanggal Mutasi', 'Keterangan'];
        $data = [];
        $no = 1;
        $jenisMap = [
            'keluar' => 'Pindah Sekolah',
            'dikeluarkan' => 'Dikeluarkan',
            'mengundurkan diri' => 'Mengundurkan Diri'
        ];

        foreach ($mutasi as $item) {
            $jenis = $jenisMap[$item->jenis_mutasi] ?? strtoupper($item->jenis_mutasi);
            
            $ketParts = [];
            if (!empty($item->keterangan_sekolah)) {
                $ketParts[] = "Tujuan: " . $item->keterangan_sekolah;
            }
            if (!empty($item->alasan)) {
                $ketParts[] = "Alasan: " . $item->alasan;
            }
            $keterangan = !empty($ketParts) ? implode(" | ", $ketParts) : '-';

            $data[] = [
                $no++,
                $item->siswa ? $item->siswa->nis : 'Terhapus',
                $item->siswa ? $item->siswa->nama : 'Terhapus',
                $jenis,
                \Carbon\Carbon::parse($item->tanggal_mutasi)->format('d-m-Y'),
                $keterangan
            ];
        }
        
        return $this->streamExcelWithKop(
            "arsip_mutasi_{$year}", 
            "ARSIP MUTASI SISWA TAHUN {$yearDecoded}", 
            $headers, 
            $data, 
            $yearDecoded
        );
    }
}
