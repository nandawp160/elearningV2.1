# Implementation Plan: Fix Temuan Audit Backend

> [!IMPORTANT]
> Plan ini mencakup perbaikan untuk **8 temuan** dari laporan audit. Dibagi menjadi **4 fase** berdasarkan prioritas. Semua perubahan hanya di level Controller & Route — **tidak mengubah database atau frontend**.

---

## Fase 1 — Kritis (3 Temuan)

### Temuan #1: Mass Assignment `$request->all()` di TugasController

**Masalah:**
- `store()` baris 481: `$data = $request->all()` → lalu `Tugas::create($data)`
- `update()` baris 771: `$data = $request->all()` → lalu `$assignment->update($data)`
- Model `Tugas` punya `fillable` yang sangat luas termasuk `created_by`, `uploaded_by`, `guru_id`
- Guru bisa menyisipkan field `created_by: 99` di request body → tugas "dimiliki" guru lain

**Apa yang berubah:**

#### [MODIFY] [TugasController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/TugasController.php)

**`store()` (baris ~481):**
```diff
- $data = $request->all();
+ $data = $request->only([
+     'subject_id', 'title', 'description', 'due_date',
+     'max_score', 'status', 'type', 'class_name',
+     'prasyarat_materi_id'
+ ]);
```
Field `created_by` tetap di-set secara eksplisit dari `auth()->user()->teacher->id` di baris 484-486 (sudah ada, tidak berubah).

**`update()` (baris ~771):**
```diff
- $data = $request->all();
+ $data = $request->only([
+     'subject_id', 'title', 'description', 'due_date',
+     'max_score', 'status', 'prasyarat_materi_id'
+ ]);
```
Field `guru_id`/`created_by` **tidak boleh** bisa diubah saat update.

---

### Temuan #2: Materi IDOR — Guru Bisa Edit/Hapus Materi Guru Lain

**Masalah:**
- `edit()` baris 204: hanya cek `isStudent()` + Gate `edit_tugas`, **tidak cek** `uploaded_by`
- `update()` baris 235: sama
- `destroy()` baris 335: sama
- Bandingkan dengan TugasController yang **sudah punya** ownership check ✅

**Apa yang berubah:**

#### [MODIFY] [MateriController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/MateriController.php)

Tambahkan ownership check di 3 method. Contoh pattern yang sama dengan TugasController:

**`edit()` — setelah baris 213 (`$material = Materi::findOrFail($id)`):**
```diff
  $material = Materi::findOrFail($id);
+ if ($user->isTeacher() && $material->uploaded_by !== $user->teacher_id) {
+     abort(403, 'Anda tidak memiliki akses untuk mengedit materi ini.');
+ }
```

**`update()` — setelah baris 244 (`$material = Materi::findOrFail($id)`):**
```diff
  $material = Materi::findOrFail($id);
+ if ($user->isTeacher() && $material->uploaded_by !== $user->teacher_id) {
+     abort(403, 'Anda tidak memiliki akses untuk mengedit materi ini.');
+ }
```

**`destroy()` — setelah baris 344 (`$material = Materi::findOrFail($id)`):**
```diff
  $material = Materi::findOrFail($id);
+ if ($user->isTeacher() && $material->uploaded_by !== $user->teacher_id) {
+     abort(403, 'Anda tidak memiliki akses untuk menghapus materi ini.');
+ }
```

---

### Temuan #3: Materi `show()` — Siswa Bisa Akses Materi Kelas Lain via ID

**Masalah:**
- `show()` baris 187: hanya `Gate::authorize('view_tugas')` + `findOrFail($id)`
- Di `index()`, materi sudah difilter per kelas/guru pengampu → tetapi di `show()` filter ini **tidak ada**
- Siswa kelas X bisa akses `GET /materials/42` yang berisi materi kelas XII

**Apa yang berubah:**

#### [MODIFY] [MateriController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/MateriController.php)

**`show()` — setelah baris 191 (`$material = ...findOrFail`):**
```diff
  $material = Materi::with(['subject', 'uploader'])->findOrFail($id);
  $user = auth()->user();
+
+ // Validasi: Siswa hanya boleh akses materi dari guru pengampu kelasnya
+ if ($user->isStudent()) {
+     $student = $user->student;
+     $kelasName = $student?->kelas;
+     $allowed = false;
+     if ($kelasName) {
+         $kelas = \App\Models\Kelas::where('name', $kelasName)->first();
+         if ($kelas) {
+             $teacherIds = $kelas->guruPengampu()->pluck('guru.id')->toArray();
+             $allowed = in_array($material->uploaded_by, $teacherIds);
+         }
+     }
+     if (!$allowed) {
+         abort(403, 'Anda tidak memiliki akses ke materi ini.');
+     }
+ }
```

---

## Fase 2 — Tinggi (3 Temuan)

### Temuan #4: API `getOverdueData()` Tanpa Otorisasi

**Masalah:**
- `getOverdueData()` baris 264: **tidak ada** `Gate::authorize()` atau cek role
- Route: `GET /teacher/submission-appeals/{appeal}/overdue`
- Siswa yang login bisa panggil endpoint ini → lihat data tunggakan siswa lain

**Apa yang berubah:**

#### [MODIFY] [BandingController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/BandingController.php)

**`getOverdueData()` — tambahkan di awal method:**
```diff
  public function getOverdueData(\App\Models\Banding $appeal)
  {
+     Gate::authorize('view_dispensasi');
+
+     $user = auth()->user();
+     if (!$user->isTeacher() && !$user->isSuperAdmin() && !$user->isAdmin()) {
+         abort(403);
+     }
+
      $overdue = \App\Models\Tugas::tugas()
```

---

### Temuan #5: Nilai `show()` — Guru Bisa Lihat Nilai Seluruh Mapel

**Masalah:**
- `show()` baris 28: hanya cek siswa, **tidak cek guru**
- Guru Matematika bisa lihat detail nilai siswa pada Bahasa Indonesia
- Bandingkan dengan PengumpulanController yang **sudah punya** ownership check ✅

**Apa yang berubah:**

#### [MODIFY] [NilaiController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/NilaiController.php)

**`show()` — setelah pengecekan siswa (baris ~33):**
```diff
  if ($user->isStudent() && $grade->student_id !== $user->student_id) {
      abort(403, 'Unauthorized action.');
  }
+
+ // Guru hanya boleh lihat nilai dari tugas yang dia buat
+ if ($user->isTeacher()) {
+     $assignment = $grade->submission?->assignment;
+     if ($assignment && $assignment->guru_id !== $user->teacher_id) {
+         abort(403, 'Anda tidak memiliki akses ke nilai ini.');
+     }
+ }
```

---

### Temuan #6: File Disimpan di Disk Publik

**Masalah:**
- Semua file disimpan dengan `->store('folder', 'public')`
- File bisa diakses langsung via URL tanpa login: `https://domain.com/storage/submissions/1/2/file.pdf`
- Berlaku untuk: submissions, materi, tugas (attachment), bukti banding

**Dampak Faktual:**
- Ini adalah masalah **desain arsitektur**, bukan bug logika
- Fix-nya membutuhkan perubahan di **banyak tempat** (controller, view, model accessor)
- Perlu membuat route download controller baru

> [!WARNING]
> Fix ini lebih kompleks karena semua view yang menampilkan link file (blade templates) perlu diubah dari `asset('storage/...')` ke route download baru. **Direkomendasikan untuk ditangani setelah Fase 1 & 2 selesai**, atau setelah sidang jika waktu terbatas.

**Langkah high-level jika ingin diimplementasikan:**
1. Buat `DownloadController` baru dengan method per resource
2. Ubah `->store('folder', 'public')` menjadi `->store('folder')` (disk default = private)
3. Buat route baru: `GET /download/submission/{submission}`, `GET /download/material/{material}`, dll
4. Update semua view yang menggunakan `asset('storage/...')` ke route download baru

---

## Fase 3 — Sedang (2 Temuan)

### Temuan #7: N+1 Query pada `User::getStudentIdAttribute()`

**Masalah:**
- Setiap akses `$user->student_id` menjalankan raw DB query baru
- Dalam satu request, bisa dipanggil belasan kali (controller, middleware, view)
- Padahal sudah ada relasi `$user->student` yang bisa di-cache oleh Eloquent

**Apa yang berubah:**

#### [MODIFY] [User.php](file:///c:/laragon/www/sistem-e_learningV1/app/Models/User.php)

```diff
  public function getStudentIdAttribute()
  {
-     return \DB::table('siswa')->where('pengguna_id', $this->id)->value('id');
+     return $this->student?->id;
  }

  public function getTeacherIdAttribute()
  {
-     return \DB::table('guru')->where('pengguna_id', $this->id)->value('id');
+     return $this->teacher?->id;
  }
```

> [!NOTE]
> Ini memanfaatkan Eloquent relationship caching. Setelah `$user->student` dipanggil pertama kali, Eloquent menyimpan hasilnya di memori dan tidak menjalankan query ulang dalam request yang sama.

---

### Temuan #8: Duplikat Route `assignments.submit`

**Masalah:**
- Route didefinisikan di **dua tempat** di `web.php`:
  - Baris 81-83 (dalam group `auth` + `verified`)
  - Baris 195-197 (dalam group `auth` saja, **tanpa `verified`**)
- Route terakhir yang menang → siswa tanpa verifikasi email bisa submit tugas

**Apa yang berubah:**

#### [MODIFY] [web.php](file:///c:/laragon/www/sistem-e_learningV1/routes/web.php)

Hapus definisi route yang duplikat. Pertahankan yang di baris 195-197 (karena sudah berada di group yang tepat bersama route student lainnya), dan hapus yang di baris 81-83:

```diff
- Route::post('assignments/{assignment}/submit', [\App\Http\Controllers\PengumpulanController::class, 'store'])
-     ->middleware('submission.lock')
-     ->name('assignments.submit');
```

---

## Verification Plan

### Automated Tests
Setelah implementasi, jalankan test suite yang ada:
```bash
php artisan test --filter=TugasController
php artisan test --filter=MateriController
```

### Manual Verification
Untuk setiap temuan, verifikasi dengan skenario berikut:

| # | Skenario Test | Expected Result |
|---|---|---|
| 1 | Guru A buat tugas dengan field `created_by: [ID guru B]` di request body | Field `guru_id` tetap terisi ID Guru A |
| 2 | Guru A akses `GET /materials/{id milik Guru B}/edit` | Response 403 Forbidden |
| 3 | Siswa kelas X akses `GET /materials/{id materi kelas XII}` | Response 403 Forbidden |
| 4 | Siswa akses `GET /teacher/submission-appeals/{id}/overdue` | Response 403 Forbidden |
| 5 | Guru Matematika akses `GET /grades/{id nilai Bahasa Indonesia}` | Response 403 Forbidden |
| 7 | Load halaman dashboard siswa, cek query count di Debugbar | Query `student_id` tidak duplikat |
| 8 | Pastikan hanya ada 1 route `assignments.submit` di `php artisan route:list` | Tidak ada duplikat |
