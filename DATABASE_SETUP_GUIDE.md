# Panduan Instalasi dan Setup Database - SMA N 1 Cepogo

Dokumen ini berisi panduan langkah demi langkah untuk melakukan instalasi dan setup database aplikasi E-Learning SMA N 1 Cepogo pada server produksi.

## Persyaratan Sistem
Sebelum memulai, pastikan server Anda telah memenuhi prasyarat berikut:
- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Web Server (Apache/Nginx)

---

## Langkah 1: Konfigurasi Environment (`.env`)

1. Buka folder utama aplikasi.
2. Salin file `.env.example` dan ubah namanya menjadi `.env`.
3. Buka file `.env` dan pastikan konfigurasi database sudah sesuai dengan server Anda:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_elearning
DB_USERNAME=root
DB_PASSWORD=
```
*(Sesuaikan password dengan kredensial MySQL di server Anda).*

---

## Langkah 2: Buat Database di MySQL

1. Buka aplikasi manajemen database (phpMyAdmin, atau MySQL CLI).
2. Buat database baru dengan nama: **`db_elearning`**
3. Gunakan *collation* `utf8mb4_unicode_ci`.

---

## Langkah 3: Eksekusi Migrasi 

Buka aplikasi **Terminal** (atau PowerShell), arahkan direktori aktif ke folder utama aplikasi, lalu jalankan perintah berikut untuk membangun struktur tabel yang bersih:

```bash
php artisan migrate
```

---

## Langkah 4: Impor Data Awal (Master Data)

Silakan impor file *SQL Dump* yang disertakan dalam paket aplikasi (berisi data riil guru, jadwal, dan siswa) langsung melalui menu **Import** di phpMyAdmin ke dalam database `db_elearning`.

---

## Langkah 5: Kredensial & Rute Akses Pengguna

Setelah database berhasil diimpor, sistem sudah siap digunakan. Sistem ini telah membagi *routing* dan *dashboard* menjadi 3 hak akses utama (Admin, Guru, dan Siswa).

Sistem ini menggunakan halaman login yang terpisah untuk masing-masing hak akses. Silakan akses URL berikut sesuai dengan peran Anda (sesuaikan `domain-sekolah.com` dengan domain asli sekolah):

**1. Akses Super Admin**
- **URL Login:** `http://domain-sekolah.com/admin/login`
- Menggunakan kredensial utama Admin (diserahkan terpisah).
- Akses penuh ke pengaturan sistem, pemeliharaan, dan manajemen *user*.

**2. Akses Guru / Wali Kelas**
- **URL Login:** `http://domain-sekolah.com/guru/login`
- Menggunakan email resmi guru (misal: `@guru.smansago.com`) atau via integrasi *Google Sign-In*.
- Untuk manajemen tugas, nilai, dan rekap wali kelas.

**3. Akses Siswa**
- **URL Login:** `http://domain-sekolah.com/siswa/login`
- Menggunakan email resmi siswa (misal: `@siswa.smansago.com`) atau via integrasi *Google Sign-In*.
- Untuk pengumpulan tugas dan pengajuan banding.

---

## Troubleshooting Umum

- **Error 500 / Connection Refused:** Pastikan kredensial database di `.env` sudah benar dan layanan MySQL sedang berjalan.
- **Error "No application encryption key has been specified":** Jalankan perintah `php artisan key:generate` pada terminal.
- **Halaman Blank atau Error Cache:** Jalankan perintah `php artisan optimize:clear` untuk membersihkan cache konfigurasi lama.
