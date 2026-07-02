# Setup Database Lengkap - Sistem E-Learning

## Step 1: Buat Database di phpMyAdmin

1. Buka **phpMyAdmin** (dari Laragon atau `localhost/phpmyadmin`)
2. Klik tab **"Databases"** atau **"Basis Data"**
3. Di kolom **"Create database"**, ketik: `sistem_e_learning`
4. Pilih **Collation**: `utf8mb4_unicode_ci` (recommended)
5. Klik **"Create"** / **"Buat"**

✅ Database `sistem_e_learning` sudah dibuat!

---

## Step 2: Run Migrations (Buat Semua Tables)

Buka **Terminal** di VSCode atau PowerShell, lalu jalankan:

```bash
cd c:\laragon\www\sistem-e_learning
php artisan migrate
```

Ini akan membuat semua table:
- ✅ users (untuk login - super admin, guru, siswa)
- ✅ teachers (data guru)
- ✅ students (data siswa)
- ✅ courses (mata pelajaran)
- ✅ class_rooms (kelas)
- ✅ subjects (jadwal mengajar - mapping guru ke kelas)
- ✅ enrollments (siswa masuk kelas mana)
- ✅ assignments (tugas)
- ✅ materials (materi)
- ✅ submissions (pengumpulan tugas)
- ✅ grades (nilai)
- ✅ attendances (absensi)

---

## Step 3: Insert Data Dummy

### A. Insert Super Admin User (Manual via SQL)

Di phpMyAdmin, pilih database `sistem_e_learning`, klik tab **SQL**, paste:

```sql
INSERT INTO `users` (`name`, `email`, `password`, `role`, `email_verified_at`, `created_at`, `updated_at`) 
VALUES ('Super Admin', 'admin@edulearn.com', '$2y$12$qwertyuiopasdfghjklzxc', 'super_admin', NOW(), NOW(), NOW());
```

**Note:** Password hash adalah untuk "password" (tapi nanti set ulang via reset password atau tinker)

### B. Insert 40 Siswa Dummy

Copy semua isi file **`insert_students_phpmyadmin.sql`** (sudah dibuat), paste ke SQL tab phpMyAdmin.

---

## Step 4: Set Admin Password yang Benar

Via terminal, jalankan:

```bash
php artisan tinker --execute="DB::table('users')->where('email', 'admin@edulearn.com')->update(['password' => Hash::make('password')]);"
```

Atau via phpMyAdmin SQL:

```sql
UPDATE users SET password = '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE email = 'admin@edulearn.com';
```

---

## Step 5: Test Login!

1. Buka browser: `http://127.0.0.1:8001/login`
2. Login dengan:
   - Email: `admin@edulearn.com`
   - Password: `password`

---

## Troubleshooting

**Error "Database not found":**
- Check `.env` file, pastikan `DB_DATABASE=sistem_e_learning`
- Restart server: `php artisan serve`

**Migration error:**
- Drop database dan buat ulang
- Atau: `php artisan migrate:fresh` (WARNING: hapus semua data!)

**Login error:**
- Clear cache: `php artisan cache:clear`
- Clear config: `php artisan config:clear`
