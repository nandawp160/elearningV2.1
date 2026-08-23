<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define dynamic gates based on DB settings
        $permissionKeys = [
            'view_siswa', 'create_siswa', 'edit_siswa', 'delete_siswa',
            'view_guru', 'create_guru', 'edit_guru', 'delete_guru',
            'view_kelas', 'create_kelas', 'edit_kelas', 'delete_kelas', 'plot_wali',
            'view_tugas', 'create_tugas', 'edit_tugas', 'delete_tugas', 'grade_tugas',
            'view_dispensasi', 'approve_dispensasi',
            'view_laporan', 'manage_settings'
        ];

        foreach ($permissionKeys as $key) {
            \Illuminate\Support\Facades\Gate::define($key, function ($user) use ($key) {
                // Super-Admin Bypass
                if ($user->role === 'admin' || $user->role === 'super_admin') {
                    return true;
                }

                // Identify user role
                $role = $user->role;
                if ($role === 'student') $role = 'siswa';
                if ($role === 'teacher') $role = 'guru';

                // Check if they are a homeroom teacher (wali_kelas)
                if ($role === 'guru' && $user->isWaliKelas()) {
                    $role = 'wali_kelas';
                }

                // Fetch allowed permissions from database settings table
                $rawPerms = \App\Models\Pengaturan::getValue("permissions_{$role}");
                if ($rawPerms !== null) {
                    $permsArray = json_decode($rawPerms, true);
                    if (is_array($permsArray)) {
                        return in_array($key, $permsArray);
                    }
                } else {
                    // Default fallback permissions if database settings are not initialized yet
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
                    return in_array($key, $defaultPermissions[$role] ?? []);
                }

                return false;
            });
        }
    }
}
