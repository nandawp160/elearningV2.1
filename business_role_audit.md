# Business Role Audit: Enrollment.php

Fokus audit tertuju pada model [Enrollment.php](file:///c:/laragon/www/sistem-e_learningV1/app/Models/Enrollment.php).

---

## 1. Isi `$fillable`
Di dalam model [Enrollment.php](file:///c:/laragon/www/sistem-e_learningV1/app/Models/Enrollment.php), atribut yang diizinkan untuk mass-assignment (`$fillable`) adalah:
```php
protected $fillable = [
    'student_id',
    'class_room_id',
    'enrollment_date',
    'academic_year',
    'status'
];
```

---

## 2. Isi Relasi
Model `Enrollment` memiliki dua relasi Eloquent:
1. **`student()`** (Belongs To)
   ```php
   public function student()
   {
       return $this->belongsTo(Siswa::class, 'id', 'id');
   }
   ```
   *Penjelasan:* Menghubungkan model `Enrollment` ke model `Siswa` dengan memetakan `id` (dari tabel `siswa`) ke `id` (pada tabel `siswa`). Ini merupakan relasi satu-ke-satu ke baris dirinya sendiri karena kedua model merujuk ke tabel yang sama.

2. **`classRoom()`** (Belongs To)
   ```php
   public function classRoom()
   {
       return $this->belongsTo(Kelas::class, 'id', 'id');
   }
   ```
   *Penjelasan:* Menghubungkan model `Enrollment` ke model `Kelas` (sebelumnya `ClassRoom`) dengan memetakan `id` (dari tabel `siswa`) ke `id` (tabel `kelas`). *Secara bisnis, relasi ini tidak akurat karena memetakan ID unik siswa secara langsung ke ID kelas.*

---

## 3. Tabel yang Digunakan
Model `Enrollment` menggunakan tabel fisik:
* **`siswa`** (didefinisikan melalui `protected $table = 'siswa';`)

> [!NOTE]
> Database migrasi `database/migrations/2026_01_13_033151_create_enrollments_table.php` dibiarkan kosong dengan keterangan *"Table enrollments is omitted in Indonesian schema (fallback maps to siswa)"*. Tidak ada tabel fisik bernama `enrollments` di database aktif saat ini.

---

## 4. Controller yang Menggunakan Model Ini
Model `Enrollment` secara eksplisit dan implisit dirujuk oleh beberapa controller berikut:
1. **[SiswaBiodataController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/SiswaBiodataController.php)**
   *Mengimpor `App\Models\Enrollment` secara langsung dan memanggil `Enrollment::updateOrCreate()` saat menyimpan data biodata siswa baru.*
2. **[SiswaController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/SiswaController.php)**
   *Memanggil relasi `$student->enrollments()` secara berantai untuk melakukan update status siswa saat disetujui (proses ACC).*
3. **[TugasController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/TugasController.php)**
   *Mengimpor `App\Models\Enrollment` dan secara implisit menggunakan query `Siswa::whereHas('enrollments', ...)` untuk melakukan filter siswa aktif di dalam kelas.*

---

## 5. Query Utama Terhadap Model Ini
Berikut adalah query utama yang dilakukan di dalam kode program:

1. **Pendaftaran Biodata (`SiswaBiodataController.php` L82-92)**:
   ```php
   Enrollment::updateOrCreate(
       [
           'student_id' => $student->id,
           'academic_year' => $classroom->academic_year,
       ],
       [
           'class_room_id' => $classroom->id,
           'enrollment_date' => now(),
           'status' => $status,
       ]
   );
   ```
   *Catatan Kritis:* Karena kolom-kolom pencarian (`student_id` & `academic_year`) tidak ada secara fisik di tabel `siswa`, query ini berpotensi memicu runtime crash jika dieksekusi tanpa penanganan khusus.

2. **Proses Persetujuan/ACC Siswa (`SiswaController.php` L190 & L220)**:
   ```php
   $student->enrollments()->where('status', 'inactive')->update([
       'status' => 'active',
       'acc_batch_id' => $manualId
   ]);
   ```
   *Query SQL Riil:* `UPDATE siswa SET status = 'active', acc_batch_id = ? WHERE siswa.id = ? AND status = 'inactive'` (Query ini berhasil dieksekusi karena kolom `status` dan `acc_batch_id` ada di tabel `siswa`).

3. **Penyaringan Tugas Kelas (`TugasController.php` L312)**:
   ```php
   Siswa::whereHas('enrollments', function ($q) use ($classRoomId) {
       $q->where('class_room_id', $classRoomId)
         ->where('status', 'active');
   })
   ```
   *Catatan Kritis:* Query pencarian ini mencoba memfilter kolom `class_room_id` yang tidak ada di tabel `siswa`.

4. **Pendaftaran Seeder (`StudentLoginSeeder.php` L36-44)**:
   ```php
   Enrollment::firstOrCreate(
       ['student_id' => $student->id],
       [
           'class_room_id' => $class->id,
           'enrollment_date' => now(),
           'academic_year' => '2025/2026',
           'status' => 'active'
       ]
   );
   ```

---

## 6. Contoh Data Terpan pada Tabel Terkait (`siswa`)
Tabel `siswa` menyimpan entitas siswa secara riil. Berikut adalah representasi baris datanya:
* `id`: `1`
* `nis`: `"2025001"`
* `nama`: `"Andi Pratama"` (Model Siswa memetakan `nama` <-> `name`)
* `jenis_kelamin`: `"Laki-laki"` (Model Siswa memetakan `jenis_kelamin` <-> `gender`)
* `tanggal_lahir`: `"2009-05-15"` (Model Siswa memetakan `tanggal_lahir` <-> `date_of_birth`)
* `entry_year`: `2025`
* `kelas`: `"X IPA 1"` (Data penempatan kelas disimpan di sini)
* `nama_ortu`: `"Bapak Pratama"`
* `no_hp_ortu`: `"081234567801"`
* `alamat`: `"Jl. Merdeka No. 1, Jakarta"`
* `status`: `"aktif"` (Di-cast ke `'active'` atau `'inactive'`)
* `pengguna_id`: `2`
* `acc_batch_id`: `"ACC-BATCH-20260609..."`

---

## 7. Fungsi Bisnis Sebenarnya
Meskipun model ini dinamakan `Enrollment`, secara fisik **model ini merujuk langsung ke entitas Siswa (`siswa`)**. 

Model ini berfungsi sebagai **Compatibility Wrapper (Lapisan Kompatibilitas Mundur)** untuk mengakomodasi struktur kode legacy yang mengharapkan adanya tabel pivot `enrollments` terpisah. Model ini memalsukan (mock) beberapa properti pendaftaran dengan menggunakan getters (Accessors):
* `$enrollment->student_id` $\rightarrow$ mengembalikan `$this->id` (ID Siswa).
* `$enrollment->class_room_id` $\rightarrow$ mengembalikan nilai konstan `1`.
* `$enrollment->academic_year` $\rightarrow$ mengembalikan nilai konstan `"2025/2026"`.
* `$enrollment->enrollment_date` $\rightarrow$ mengembalikan `$this->created_at`.
* `$enrollment->status` $\rightarrow$ memetakan status `aktif` $\rightarrow$ `'active'` / `nonaktif` $\rightarrow$ `'inactive'`.

Adapun penempatan kelas yang sesungguhnya di dalam aplikasi dilakukan secara langsung dan ter-denormalisasi menggunakan kolom `kelas` berupa string langsung pada tabel `siswa` (misal `"X IPA 1"`), bukan melalui record relasi many-to-many atau model `Enrollment` ini.

---

## Kesimpulan Kategori Representasi

Model `Enrollment` sebenarnya merepresentasikan:

### **F. Fungsi Lain (Jelaskan)**

**Penjelasan:**
Model `Enrollment` secara fisik merepresentasikan **A. Pendaftaran Siswa** (karena memetakan langsung 1-to-1 ke tabel `siswa`). 

Namun, secara fungsi antarmuka kode (API/Interface), model ini merepresentasikan **B. Penempatan Kelas (Class Placement) Tiruan/Mock** untuk mempertahankan kecocokan kode lama (backward compatibility) setelah tabel fisik `enrollments` ditiadakan dari sistem dan diintegrasikan langsung ke dalam tabel `siswa`.
