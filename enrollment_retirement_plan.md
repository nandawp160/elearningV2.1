# Audit Pensiun Model: Enrollment.php

Berdasarkan investigasi read-only terhadap struktur database dan kode program, berikut adalah hasil analisis kelayakan model `Enrollment`.

---

## 1. Verifikasi Query & Kecocokan Kolom Fisik (Tabel `siswa`)

Berikut adalah hasil verifikasi pencocokan kolom untuk setiap query yang melibatkan model `Enrollment` atau relasi `enrollments` terhadap kolom fisik pada tabel `siswa`:

### Query 1: Pembuatan/Pembaruan Biodata Siswa
* **FILE**: [SiswaBiodataController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/SiswaBiodataController.php)
* **BARIS**: 82-92
* **QUERY**:
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
* **HASIL**: **INVALID (Banyak Kolom Tidak Ada)**
  * `student_id` $\rightarrow$ **INVALID** (tidak ada di tabel `siswa`)
  * `academic_year` $\rightarrow$ **INVALID** (tidak ada di tabel `siswa`)
  * `class_room_id` $\rightarrow$ **INVALID** (tidak ada di tabel `siswa`)
  * `enrollment_date` $\rightarrow$ **INVALID** (tidak ada di tabel `siswa`)
  * `status` $\rightarrow$ **VALID** (ada di tabel `siswa`)

---

### Query 2: Inisialisasi Seeder Siswa Andi
* **FILE**: [StudentLoginSeeder.php](file:///c:/laragon/www/sistem-e_learningV1/database/seeders/StudentLoginSeeder.php)
* **BARIS**: 36-44
* **QUERY**:
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
* **HASIL**: **INVALID (Banyak Kolom Tidak Ada)**
  * `student_id` $\rightarrow$ **INVALID** (tidak ada di tabel `siswa`)
  * `class_room_id` $\rightarrow$ **INVALID** (tidak ada di tabel `siswa`)
  * `enrollment_date` $\rightarrow$ **INVALID** (tidak ada di tabel `siswa`)
  * `academic_year` $\rightarrow$ **INVALID** (tidak ada di tabel `siswa`)
  * `status` $\rightarrow$ **VALID** (ada di tabel `siswa`)

---

### Query 3: Persetujuan Massal Siswa Baru (ACC Batch)
* **FILE**: [SiswaController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/SiswaController.php)
* **BARIS**: 190-193
* **QUERY**:
  ```php
  $student->enrollments()->where('status', 'inactive')->update([
      'status' => 'active',
      'acc_batch_id' => $batchId
  ]);
  ```
* **HASIL**: **VALID**
  * `status` $\rightarrow$ **VALID** (ada di tabel `siswa`)
  * `acc_batch_id` $\rightarrow$ **VALID** (ada di tabel `siswa`)

---

### Query 4: Persetujuan Manual Siswa Baru (ACC Single)
* **FILE**: [SiswaController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/SiswaController.php)
* **BARIS**: 220-223
* **QUERY**:
  ```php
  $student->enrollments()->where('status', 'inactive')->update([
      'status' => 'active',
      'acc_batch_id' => $manualId
  ]);
  ```
* **HASIL**: **VALID**
  * `status` $\rightarrow$ **VALID** (ada di tabel `siswa`)
  * `acc_batch_id` $\rightarrow$ **VALID** (ada di tabel `siswa`)

---

### Query 5: Filter Siswa untuk Monitoring Tugas
* **FILE**: [TugasController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/TugasController.php)
* **BARIS**: 312-315
* **QUERY**:
  ```php
  Siswa::withoutGlobalScope('teacher_access')
      ->whereHas('enrollments', function ($q) use ($classRoomId) {
          $q->where('class_room_id', $classRoomId)
            ->where('status', 'active');
      })
  ```
* **HASIL**: **INVALID (Kolom Tidak Ada)**
  * `class_room_id` $\rightarrow$ **INVALID** (tidak ada di tabel `siswa`)
  * `status` $\rightarrow$ **VALID** (ada di tabel `siswa`)

---

### Relasi 1: `enrollments()` pada model `Siswa`
* **FILE**: [Siswa.php](file:///c:/laragon/www/sistem-e_learningV1/app/Models/Siswa.php)
* **BARIS**: 110-113
* **QUERY / DEFINISI**:
  ```php
  public function enrollments()
  {
      return $this->hasMany(Enrollment::class, 'id', 'id');
  }
  ```
* **HASIL**: **VALID** (Kunci relasi `id` ke `id` ada di tabel `siswa`, tetapi relasi ini secara konseptual aneh karena memetakan model `Siswa` ke barisnya sendiri di bawah model `Enrollment`).

---

## 2. Identifikasi Kolom Fiktif

Atribut pendaftaran berikut **tidak memiliki representasi kolom fisik** pada tabel `siswa` (hanya disimulasikan menggunakan accessors/getters di model `Enrollment`):
1. **`student_id`** (fiktif, mengembalikan properti `$this->id`)
2. **`class_room_id`** (fiktif, mengembalikan nilai konstan `1`)
3. **`academic_year`** (fiktif, mengembalikan nilai konstan `"2025/2026"`)
4. **`enrollment_date`** (fiktif, mengembalikan properti `$this->created_at`)

---

## 3. Status Evaluasi Model `Enrollment`

Berdasarkan temuan di atas, model `Enrollment` diklasifikasikan ke dalam:
* **B. Enrollment hanya compatibility layer** (mensimulasikan kolom lama dengan getters statis).
* **C. Enrollment mengandung bug runtime laten** (seluruh query pencarian `where` atau `updateOrCreate` yang memuat kolom fiktif akan crash secara runtime dengan pesan error *SQL Column Not Found*).
* **D. Enrollment dapat dipensiunkan** (tabel fisik `enrollments` sudah tidak ada, dan penempatan kelas riil sudah disimpan langsung pada kolom `kelas` di tabel `siswa`).

---

## 4. Rencana Migrasi (Migration Plan) Pensiun Model

Berikut adalah langkah-langkah refaktorisasi aman untuk menghapus model `Enrollment` dan memperbarui semua referensi agar menunjuk langsung ke model `Siswa` dan `Kelas`:

### Langkah 1: Hapus Relasi di Model `Siswa`
Hapus relasi `enrollments()` pada file [Siswa.php](file:///c:/laragon/www/sistem-e_learningV1/app/Models/Siswa.php) (Baris 110-113).

### Langkah 2: Bersihkan Redundansi di `SiswaController.php`
Di dalam [SiswaController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/SiswaController.php):
* **ACC Batch (Baris 189-194)**: Hapus perulangan foreach yang memperbarui status lewat `enrollments()`. Pembaruan massal sudah ditangani dengan benar pada baris 183-186 langsung menggunakan model `Siswa`:
  ```php
  Siswa::where('status', 'inactive')->update([
      'status' => 'active',
      'acc_batch_id' => $batchId
  ]);
  ```
* **ACC Single (Baris 220-223)**: Hapus pemanggilan `$student->enrollments()->...->update(...)`. Pembaruan data siswa tunggal sudah dilakukan langsung di baris 214-217 menggunakan `$student->update(...)`.

### Langkah 3: Bersihkan Pendaftaran Fiktif di `SiswaBiodataController.php`
Di dalam [SiswaBiodataController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/SiswaBiodataController.php):
* Hapus import `use App\Models\Enrollment;` di baris 7.
* Hapus blok eksekusi `Enrollment::updateOrCreate(...)` di baris 82-92. Penempatan kelas siswa baru sudah dicatat langsung di baris 64-79 pada pemanggilan `Siswa::updateOrCreate(...)` melalui kolom `kelas` (`'kelas' => $classroom->name`).

### Langkah 4: Perbaiki Filter Kelas di `TugasController.php`
Di dalam [TugasController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/TugasController.php):
* Hapus import `use App\Models\Enrollment;` di baris 8.
* Ubah query filter siswa kelas di baris 312-315 dari menggunakan relasi `enrollments` menjadi relasi kelas langsung:
  ```php
  // Ganti:
  $students = Siswa::withoutGlobalScope('teacher_access')
      ->whereHas('enrollments', function ($q) use ($classRoomId) {
          $q->where('class_room_id', $classRoomId)
            ->where('status', 'active');
      })
      ->orderBy('name')
      ->get();

  // Menjadi:
  $classroom = Kelas::find($classRoomId);
  $students = $classroom 
      ? $classroom->students()->where('status', 'aktif')->orderBy('nama')->get()
      : collect();
  ```

### Langkah 5: Sesuaikan Seeder `StudentLoginSeeder.php`
Di dalam [StudentLoginSeeder.php](file:///c:/laragon/www/sistem-e_learningV1/database/seeders/StudentLoginSeeder.php):
* Hapus import `use App\Models\Enrollment;` di baris 8.
* Hapus pemanggilan `Enrollment::firstOrCreate(...)` di baris 36-44.
* Pastikan siswa ditugaskan ke kelas secara langsung dengan menambahkan pembaruan kolom `kelas` pada model `Siswa`:
  ```php
  if ($class) {
      $student->update(['kelas' => $class->name]);
  }
  ```

### Langkah 6: Perbaiki View `resources/views/kelas/show.blade.php`
Di dalam file `resources/views/kelas/show.blade.php`:
* Ganti pemanggilan properti yang salah pada perulangan `@forelse($classroom->enrollments as $enrollment)` (karena `$enrollment` sekarang mengembalikan instance `Siswa`):
  * Ganti `$enrollment->student->name` menjadi `$enrollment->nama` (atau `$enrollment->name`).
  * Ganti `$enrollment->student->nis` menjadi `$enrollment->nis`.
  * Ganti `$enrollment->enrollment_date` menjadi `$enrollment->created_at`.
  * Ganti `$enrollment->student_id` menjadi `$enrollment->id`.
  * Baris 119:
    `route('classrooms.unenroll', [$classroom, $enrollment->id])`

### Langkah 7: Hapus File Model `Enrollment.php`
Hapus file [Enrollment.php](file:///c:/laragon/www/sistem-e_learningV1/app/Models/Enrollment.php) dari direktori `app/Models/`.

---

## Status Akhir

**PENSIUNKAN**
