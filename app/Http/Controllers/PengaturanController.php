<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        // Cek ketidakaktifan modul pemeliharaan selama 15 menit
        $lastActivity = session('maintenance_last_activity');
        if ($lastActivity && (time() - $lastActivity > 900)) {
            session()->forget('maintenance_unlocked');
            session()->forget('maintenance_last_activity');
        } elseif (session('maintenance_unlocked')) {
            session(['maintenance_last_activity' => time()]);
        }

        $settings = [
            'school_name' => Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo'),
            'school_email' => Pengaturan::getValue('school_email', 'info@smansago.sch.id'),
            'fonnte_token' => Pengaturan::getValue('fonnte_token', config('services.fonnte.token')),
            'lock_duration_hours' => Pengaturan::getValue('lock_duration_hours', '24'),
            'allow_dispensations' => Pengaturan::getValue('allow_dispensations', '1'),
            'wa_notification_status' => Pengaturan::getValue('wa_notification_status', '1'),
            'tahun_ajaran_aktif' => Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026'),
            'permissions_page_password' => Pengaturan::getValue('permissions_page_password', 'admin123'),
        ];

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
        
        $maintenance_unlocked = session('maintenance_unlocked', false);
        $password = Pengaturan::getValue('permissions_page_password', 'admin123');
        
        $semua_kelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')
            ->orderBy('academic_year', 'desc')
            ->orderBy('name', 'asc')
            ->get();
            
        $storage_frozen = Pengaturan::getValue('storage_frozen', '0') === '1';
        
        return view('pengaturan.index', compact('settings', 'daftar_tahun_ajaran', 'custom_years', 'maintenance_unlocked', 'password', 'semua_kelas', 'storage_frozen'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'school_email' => 'required|email|max:255',
            'fonnte_token' => 'nullable|string|max:255',
            'lock_duration_hours' => 'required|integer|min:1|max:168',
            'allow_dispensations' => 'required|in:0,1',
            'wa_notification_status' => 'required|in:0,1',
            'tahun_ajaran_aktif' => 'required|string',
            'tahun_ajaran_baru' => ['nullable', 'string', 'regex:/^\d{4}\/\d{4}$/'],
            'permissions_page_password' => 'nullable|string|max:255',
        ], [
            'tahun_ajaran_baru.regex' => 'Format tahun ajaran baru harus YYYY/YYYY (contoh: 2026/2027)',
        ]);

        foreach ($validated as $key => $value) {
            if ($key !== 'tahun_ajaran_baru') {
                if ($key === 'permissions_page_password' && empty($value)) {
                    continue;
                }
                Pengaturan::setValue($key, $value);
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
        
        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }

    public function permissions()
    {
        if (!session('permissions_unlocked')) {
            $password = Pengaturan::getValue('permissions_page_password', 'admin123');
            return view('pengaturan.permissions_lock', compact('password'));
        }

        // Check if 15 minutes (900 seconds) have passed since last activity on this page
        $lastActivity = session('permissions_last_activity');
        if ($lastActivity && (time() - $lastActivity > 900)) {
            session()->forget('permissions_unlocked');
            session()->forget('permissions_last_activity');
            
            $password = Pengaturan::getValue('permissions_page_password', 'admin123');
            return view('pengaturan.permissions_lock', compact('password'))->withErrors(['password' => 'Halaman terkunci otomatis karena tidak ada aktivitas selama 15 menit.']);
        }

        // Update last activity timestamp
        session(['permissions_last_activity' => time()]);

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
                        'view_dispensasi'
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
        $users = \App\Models\User::with(['teacher', 'student'])->orderBy('role')->orderBy('nama')->get();
        return view('pengaturan.user_accounts', compact('users'));
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

            // 3. Reset Absensi / Kehadiran
            if (in_array('kehadiran', $opsiDipilih)) {
                \DB::table('attendances')->truncate();
                \DB::table('attendance_sessions')->truncate();
                $catatanPembersihan[] = 'Data Presensi & Sesi Kehadiran';
            }

            // 4. Reset Plotting Kelas Siswa & Guru
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

                // 2. Masukkan berkas unggahan di storage public
                $pathPublic = storage_path('app/public');
                if (file_exists($pathPublic)) {
                    $berkasFolder = new \RecursiveIteratorIterator(
                        new \RecursiveDirectoryIterator($pathPublic),
                        \RecursiveIteratorIterator::LEAVES_ONLY
                    );

                    foreach ($berkasFolder as $nama => $file) {
                        if (!$file->isDir()) {
                            $pathBerkas = $file->getRealPath();
                            $pathRelatifInZip = 'unggahan/' . substr($pathBerkas, strlen($pathPublic) + 1);
                            $zip->addFile($pathBerkas, $pathRelatifInZip);
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
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        try {
            // Kita bypass global scope tahun_ajaran agar admin bisa narik data tahun berapapun
            $kelas = \App\Models\Kelas::withoutGlobalScope('tahun_ajaran_aktif')->findOrFail($request->kelas_id);
            $tahunAjaran = str_replace('/', '-', $kelas->academic_year);
            $namaKelas = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $kelas->name));
            
            $zip = new \ZipArchive();
            $namaZip = 'Arsip_Kelas_' . $namaKelas . '_TA_' . $tahunAjaran . '.zip';
            $pathZip = storage_path('app/' . $namaZip);

            if ($zip->open($pathZip, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
                throw new \Exception('Gagal membuat berkas ZIP.');
            }

            // Ambil semua tugas untuk kelas ini
            $assignments = \App\Models\Tugas::where('kelas_id', $kelas->id)->with('subject.course')->get();
            $assignmentIds = $assignments->pluck('id');

            // Ambil semua pengumpulan (submission) untuk tugas-tugas tersebut
            $submissions = \App\Models\Pengumpulan::whereIn('tugas_id', $assignmentIds)
                ->with(['student', 'tugas.subject.course'])
                ->get();

            $fileCount = 0;

            // 1. Masukkan file Soal (Tugas) Guru
            foreach ($assignments as $assignment) {
                if ($assignment->lampiran) {
                    $mataPelajaran = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $assignment->subject->course->nama));
                    $namaTugas = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $assignment->judul));
                    
                    // Path fisik di disk local/public
                    $filePath = storage_path('app/' . $assignment->lampiran);
                    if (!file_exists($filePath)) {
                        $filePath = storage_path('app/public/' . $assignment->lampiran);
                    }

                    if (file_exists($filePath)) {
                        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
                        // Folder ZIP Structure: Mata_Pelajaran / Tugas / [Soal_Guru]...
                        $zipPath = $mataPelajaran . '/' . $namaTugas . '/[Soal_Guru]_' . $namaTugas . '.' . $ext;
                        $zip->addFile($filePath, $zipPath);
                        $fileCount++;
                    }
                }
            }

            // 2. Masukkan file Pengumpulan Siswa
            foreach ($submissions as $sub) {
                if ($sub->file_tugas) {
                    $mataPelajaran = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $sub->tugas->subject->course->nama));
                    $namaTugas = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $sub->tugas->judul));
                    $namaSiswa = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9 ]/', '', $sub->student->nama));
                    
                    $filePath = storage_path('app/' . $sub->file_tugas);
                    if (!file_exists($filePath)) {
                        $filePath = storage_path('app/public/' . $sub->file_tugas);
                    }

                    if (file_exists($filePath)) {
                        $ext = pathinfo($sub->original_name ?? $filePath, PATHINFO_EXTENSION);
                        $zipPath = $mataPelajaran . '/' . $namaTugas . '/[Jawaban]_' . $namaSiswa . '.' . $ext;
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
}
