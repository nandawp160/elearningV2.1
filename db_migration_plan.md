# Rencana Migrasi & Pemangkasan Database (`sistem_e_learning.sql` -> `db_elearning.sql`)

Rencana ini bertujuan untuk memindahkan data penting dari database lama yang kompleks (`sistem_e_learning.sql`) ke database baru yang lebih ringkas (`db_elearning.sql`), serta memangkas tabel-tabel fitur yang tidak digunakan lagi untuk menghemat biaya operasional database.

---

## Daftar Tabel yang Dipertahankan (Fitur Utama)

Berdasarkan arsitektur inti e-learning yang aktif, berikut adalah tabel-tabel utama yang akan kita pertahankan dan pindahkan datanya:

1. **Autentikasi & Akun**: `pengguna` (users), `personal_access_tokens`, `sessions`
2. **Data Induk**: `guru`, `siswa`, `kelas`
3. **Akademik & E-learning**: `mata_pelajaran`, `guru_kelas` (pivot baru), `tugas`, `pengumpulan_tugas`, `grades` (nilai), `materials` (materi)
4. **Banding Nilai**: `pengajuan_banding`
5. **Absensi**: `attendances`, `attendance_sessions`
6. **Sistem**: `settings`, `migrations`

### Tabel yang Dipangkas (Dihapus dari dump baru):
- `invoices`, `payments` (Fitur Keuangan/Pembayaran SPP)
- `failed_jobs`, `jobs`, `job_batches`, `cache`, `cache_locks` (Tabel utilitas/antrean sementara yang bisa dibuat ulang otomatis)

---

## Rencana Langkah Eksekusi (Metode Laravel Script)

Kami menyarankan menggunakan script Laravel Command agar proses pemindahan data berjalan aman tanpa melanggar batasan relasi database (*Foreign Key Constraint Integrity*).

### Langkah 1: Konfigurasi Database Sementara
Di dalam file `.env` atau `config/database.php`, kita akan mendaftarkan koneksi database lama (MySQL Lama) dan database baru (MySQL Baru yang bersih).

### Langkah 2: Pembuatan Artisan Command Pemindah Data
Kita akan membuat command di Laravel:
```bash
php artisan make:command MigrateElearningData
```
Command ini akan melakukan proses kloning baris data dari database lama ke database baru secara bertahap berdasarkan urutan dependensi tabel (tabel utama didefinisikan terlebih dahulu untuk mencegah error foreign key):
1. `pengguna`
2. `settings`
3. `mata_pelajaran`
4. `guru`
5. `kelas`
6. `siswa`
7. `guru_kelas`
8. `tugas`
9. `pengumpulan_tugas`
10. `grades`
11. `materials`
12. `pengajuan_banding`
13. `attendances` & `attendance_sessions`

### Langkah 3: Ekspor Database Baru
Setelah data terpindahkan dengan aman ke database baru di local, kita akan melakukan ekspor (dump) database baru tersebut ke file `C:\laragon\www\sistem-e_learningV1\md\db\db_baru\db_elearning.sql`.

---

## Verifikasi Akhir
Setelah migrasi data selesai:
1. Jalankan aplikasi menggunakan database baru.
2. Login sebagai Admin, Guru, dan Siswa untuk memastikan riwayat nilai, tugas, materi, dan absensi tetap utuh.
