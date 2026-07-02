# Arsip Modul Absensi (Kehadiran)

Dokumen ini mencatat informasi pemindahan dan penonaktifan modul Absensi pada proyek Sistem E-Learning untuk kebutuhan sidang skripsi.

## Detail Arsip

* **Tanggal Pengarsipan**: 2026-06-08
* **Metode**: Konservatif & Aman (Sesuai Aturan Ketat: tidak merusak database, model, atau modul tidak terkait).
* **Direktori Arsip**: `dev_archive/attendance_module/`

---

## File yang Diarsipkan

Semua file visual (views) dipindahkan ke folder ini:

1. **Views**:
   * `dev_archive/attendance_module/Views/attendances/`
     * `create.blade.php`
     * `index.blade.php`
     * `index_student.blade.php`
   * `dev_archive/attendance_module/Views/attendance_sessions/`
     * `create.blade.php`
     * `index.blade.php`
     * `show.blade.php`

---

## File yang Dipertahankan (Tidak Dipindahkan)

Untuk menjaga stabilitas sistem dan relasi database serta mencegah error pada modul Wali Kelas, file berikut **dipertahankan pada lokasi asli**:
* `app/Http/Controllers/AttendanceController.php` (Controller Utama)
* `app/Http/Controllers/AttendanceSessionController.php` (Controller Sesi QR)
* `app/Models/Attendance.php` (Model Absensi)
* `app/Models/AttendanceSession.php` (Model Sesi Absensi)

---

## Rute yang Dinonaktifkan

Rute-rute berikut dinonaktifkan dengan cara dikomentari (comment-out) pada berkas rute:

### 1. `routes/web.php`
```php
// [NONAKTIF - ARSIP] Attendance Management (Dinonaktifkan untuk Sidang Skripsi)
// Route::delete('attendances/sessions/destroy', [AttendanceController::class, 'destroySession'])->name('attendances.destroy_session');
// Route::resource('attendances', AttendanceController::class)->except(['show', 'edit', 'update']);

// [NONAKTIF - ARSIP] QR Attendance Sessions (Dinonaktifkan untuk Sidang Skripsi)
// Route::get('attendance_sessions/{attendanceSession}/refresh', [AttendanceSessionController::class, 'refresh'])->name('attendance_sessions.refresh');
// Route::resource('attendance_sessions', AttendanceSessionController::class);
```

### 2. `routes/api.php`
```php
// [NONAKTIF - ARSIP] Route::post('/attendance/scan', [\App\Http\Controllers\AttendanceSessionController::class, 'scan']);
```

---

## Menu UI yang Disembunyikan

1. **Menu Cepat "Rekap Kehadiran"** pada Dashboard Wali Kelas (`resources/views/homeroom/dashboard.blade.php`) telah disembunyikan/dikomentari.
2. Tidak ada menu statis yang mengarah ke `attendances` atau `attendance_sessions` pada sidebar (`resources/views/components/sidebar.blade.php`) maupun navbar (`resources/views/components/navbar.blade.php`).

---

## Cara Pemulihan Modul (Restore)

Jika ingin mengaktifkan kembali modul ini setelah sidang skripsi:
1. Pindahkan kembali folder `dev_archive/attendance_module/Views/attendances` ke `resources/views/attendances`.
2. Pindahkan kembali folder `dev_archive/attendance_module/Views/attendance_sessions` ke `resources/views/attendance_sessions`.
3. Hapus simbol komentar (`//`) pada baris rute absensi di `routes/web.php` dan `routes/api.php`.
4. Hapus simbol komentar pada tombol "Rekap Kehadiran" di `resources/views/homeroom/dashboard.blade.php`.
5. Jalankan perintah `php artisan view:clear` untuk memperbarui cache view.
