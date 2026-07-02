# Rencana Implementasi: Penyempurnaan Pemetaan Mata Pelajaran Guru Lintas Jenjang

Rencana ini bertujuan untuk menyempurnakan fitur **Atur Kelas Diampu** pada Master Data Guru. Saat ini, sistem membatasi guru untuk hanya mengajar satu mata pelajaran yang didefinisikan secara statis oleh `specialization_id` (contoh: "TIK 1" tingkat X). Ketika guru tersebut diatur untuk mengajar di kelas tingkat lain (misalnya tingkat XI), sistem masih berasumsi mereka mengajar mata pelajaran tingkat X ("TIK 1"), sehingga siswa tingkat XI tidak dapat melihat materi/tugas yang relevan (seperti "TIK LANJUTAN").

Untuk menyelesaikannya tanpa mengubah skema basis data, kita akan menerapkan pencocokan otomatis (Dynamic Subject Resolver) berbasis kemiripan nama mata pelajaran pada model `Guru`.

---

## User Review Required

> [!IMPORTANT]
> **Metode Pencocokan Otomatis (Dynamic Subject Resolver)**:
> Sistem akan mencocokkan mata pelajaran spesialisasi guru dengan mata pelajaran yang ada di tingkat kelas target dengan cara menormalkan nama mata pelajaran:
> 1. Menghilangkan kata-kata tingkat/grade: `X`, `XI`, `XII`, `1`, `2`, `Lanjutan`, `Peminatan`, `Wajib` (case-insensitive).
> 2. Mencocokkan nama dasar yang tersisa (misal: "TIK 1" -> "tik", "TIK LANJUTAN" -> "tik", sehingga keduanya cocok).
> 3. Mencocokkan "Bahasa Indonesia X" dengan "Bahasa Indonesia XI" secara akurat tanpa tertukar dengan "Bahasa Inggris XI".
> 
> Mohon konfirmasi apakah skema penamaan mata pelajaran di sekolah Anda mengikuti format standar ini sehingga pencocokan berbasis teks ini bekerja dengan akurat.

---

## Proposed Changes

### 1. Model: [Guru.php](file:///c:/laragon/www/sistem-e_learningV1/app/Models/Guru.php)
* **Menambahkan Method `getSubjectForClass(Kelas $kelas)`**:
  * Mengambil mata pelajaran spesialisasi guru.
  * Jika tingkat kelas cocok dengan tingkat spesialisasi, langsung kembalikan mata pelajaran tersebut.
  * Jika berbeda tingkat (lintas jenjang), ambil semua mata pelajaran aktif pada tingkat kelas target tersebut.
  * Lakukan pencocokan berbasis normalisasi teks (menghilangkan suffix tingkat/angka/status wajib/lanjutan).
  * Kembalikan mata pelajaran tingkat target yang cocok.
* **Menambahkan Method `getSubjectIdsTaught()`**:
  * Mengembalikan array ID semua mata pelajaran yang diajarkan oleh guru berdasarkan daftar `kelasDiampu` yang dimilikinya.

---

### 2. Model: [JadwalPelajaran.php](file:///c:/laragon/www/sistem-e_learningV1/app/Models/JadwalPelajaran.php)
* **Memperbarui Accessor `getTeacherAttribute()`**:
  * Alih-alih mencocokkan secara kaku via `where('specialization_id', $this->id)`, kita akan mencari guru aktif yang memiliki ID mata pelajaran ini di dalam daftar mata pelajaran yang diajarkannya (`getSubjectIdsTaught()`).

---

### 3. Controller: [TugasController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/TugasController.php)
* **Method `teacherIndex()`**:
  * Panggil `$guru->getSubjectForClass($kelas)` untuk masing-masing kelas diampu guna mendapatkan mata pelajaran yang sesuai (contoh: "TIK LANJUTAN" untuk tingkat XI).
* **Method `create()`**:
  * Panggil `$guru->getSubjectForClass($kelas)` saat menyusun pilihan mata pelajaran untuk form pembuatan tugas.

---

### 4. Controller: [MateriController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/MateriController.php)
* **Method `index()`, `create()`, dan `edit()`**:
  * Perbarui logika penyusunan `$subjects` untuk guru agar memanggil `$guru->getSubjectForClass($kelas)` alih-alih mengkloning subjek spesialisasi secara statis.

---

### 5. Controller: [BandingController.php](file:///c:/laragon/www/sistem-e_learningV1/app/Http/Controllers/BandingController.php)
* **Method `index()`**:
  * Hitung statistik permohonan banding (`pendingCount`) menggunakan ID mata pelajaran hasil penyelarasan `getSubjectForClass($kelas)`.
  * Filter daftar detail banding per kelas menggunakan subjek yang diselaraskan untuk kelas tersebut.
* **Method `history()`**:
  * Perbarui daftar filter drop-down subjek agar menggunakan mata pelajaran hasil penyelarasan untuk kelas-kelas diampu.
* **Method `lockingHistory()`**:
  * Ubah filter kueri tugas terkunci agar memfilter dengan `whereIn('mata_pelajaran_id', $user->guru->getSubjectIdsTaught())`.
* **Method `studentAppeals()`**:
  * Perbarui pencarian guru (`$teacher`) agar mencocokkan guru pengampu kelas yang mengajarkan mata pelajaran terkait melalui `$guru->getSubjectIdsTaught()`.

---

## Verification Plan

### Manual Verification
1. Membuat/memastikan ada mata pelajaran **TIK 1** (Tingkat X) dan **TIK LANJUTAN** (Tingkat XI).
2. Mengatur guru TIK dengan spesialisasi **TIK 1** (Tingkat X).
3. Mengatur Kelas Diampu guru tersebut mencakup **X IPA 1** (Tingkat X) dan **XI IPA 1** (Tingkat XI).
4. Masuk sebagai Guru TIK, verifikasi halaman tugas & materi:
   - Pada baris kelas **X IPA 1**, mata pelajaran tertulis **TIK 1**.
   - Pada baris kelas **XI IPA 1**, mata pelajaran tertulis **TIK LANJUTAN**.
5. Guru membuat tugas/materi baru di kelas XI IPA 1 dan memastikan tugas tersimpan dengan `mata_pelajaran_id` dari **TIK LANJUTAN**.
6. Masuk sebagai siswa kelas **XI IPA 1**, pastikan tugas/materi **TIK LANJUTAN** yang dibuat guru tersebut tampil dengan benar.
