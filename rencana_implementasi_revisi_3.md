# Rencana Implementasi — Sentralisasi Filter Materi dan Tugas Menggunakan Eloquent Scope (Revisi 3)

Rencana ini bertujuan untuk menyatukan aturan pemisah antara Materi dan Tugas secara terpusat pada model `Tugas` menggunakan Eloquent Scope. Berdasarkan masukan pengguna, Phase 3 dibagi menjadi dua sub-fase: Phase 3A — Audit (Read Only) dan Phase 3B — Refactor & Verifikasi.

---

## User Review Required

### IMPORTANT

#### 1. Aturan Batas Pembeda Materi dan Tugas
Pembeda utama pada tabel `tugas` yang sama adalah:
* **Materi**: `deadline` > `2030-01-01 00:00:00` (konstanta `Tugas::BATAS_MATERI`).
* **Tugas**: `deadline` <= `2030-01-01 00:00:00` (konstanta `Tugas::BATAS_MATERI`).

#### 2. Hasil Audit Phase 3A (Read Only)
Audit terhadap middleware dan controller terkait SSL telah selesai dilakukan (detail hasil audit tersedia di `audit_report_phase_3.md`). Kesimpulannya, kueri `Tugas::query()` di lokasi-lokasi tersebut berisiko mencampur materi dengan tugas (khususnya jika sistem dijalankan setelah tahun 2030 atau terjadi kesalahan input tenggat materi), sehingga tindakan refactoring ke `Tugas::tugas()` pada Phase 3B sangat direkomendasikan dan aman dilakukan.

---

## Proposed Changes

### Phase 1 — Core (Modifikasi Inti) [SELESAI]
* Penambahan konstanta, komentar TODO, dan scope `materi()` & `tugas()` di `Tugas.php`.
* Modifikasi query pengambilan di `MateriController.php` (scope `materi()`) dan `TugasController.php` (scope `tugas()`).

### Phase 2 — Statistik (Modifikasi Dashboard & Laporan) [SELESAI]
* Modifikasi query statistik di `DashboardController.php` (scope `tugas()`).
* Modifikasi query ringkasan laporan di `LaporanController.php` (scope `tugas()`).

### Phase 3A — Audit (Read Only) [SELESAI]
* Melakukan audit read-only pada `SelectiveSubmissionLocking.php`, `PengumpulanController.php`, dan `BandingController.php`.
* Laporan lengkap didokumentasikan di `audit_report_phase_3.md`.

### Phase 3B — Refactor & Verifikasi [BELUM SELESAI / TERHENTI PADA VERIFIKASI BROWSER]

Refactoring kode telah selesai diimplementasikan, dan verifikasi logika database via PHP script telah lulus (OK). Namun, **verifikasi manual langsung via UI browser terhenti/belum selesai** dikarenakan adanya kendala teknis (rate limit individual quota pada browser subagent).

#### 1. [MODIFY] `app/Http/Middleware/SelectiveSubmissionLocking.php`
Ubah query penghitungan tunggakan dari `Tugas::query()` menjadi `Tugas::tugas()`.
```diff
- $tunggakanCount = Tugas::query()
+ $tunggakanCount = Tugas::tugas()
```

#### 2. [MODIFY] `app/Http/Controllers/PengumpulanController.php`
Ubah query pencarian overdue berikutnya pada method `handleRecoveryProgression()` agar mengecualikan materi:
```diff
- $nextOverdue = \App\Models\Tugas::query()
+ $nextOverdue = \App\Models\Tugas::tugas()
```

#### 3. [MODIFY] `app/Http/Controllers/BandingController.php`
Ubah query pencarian overdue pada method `getOverdueData()`:
```diff
- $overdue = \App\Models\Tugas::query()
+ $overdue = \App\Models\Tugas::tugas()
```
Ubah query pencarian overdue tertua pada method `approve()`:
```diff
- $oldestOverdue = \App\Models\Tugas::query()
+ $oldestOverdue = \App\Models\Tugas::tugas()
```
Ubah query riwayat penguncian pada method `lockingHistory()`:
```diff
- $query = \App\Models\Tugas::query()
+ $query = \App\Models\Tugas::tugas()
```

---

## Verification Plan & Results (Phase 3B)

### Automated Tests
* Jalankan `php artisan test` untuk memastikan regression-free pada test suite yang ada.

### Manual Verification (5 Skenario Wajib) - *STATUS: TERHENTI PADA VERIFIKASI BROWSER*

* **Status Verifikasi Logika Query (PHP Script):** **LULUS** (Berhasil memverifikasi pemisahan data di level database menggunakan script `verify_phase3b.php`).
* **Status Verifikasi Visual UI (Browser):** **TERHENTI/BELUM DIJALANKAN** (Perlu dilakukan verifikasi manual di browser oleh pengguna/developer berikutnya).

Skenario pengujian yang disiapkan untuk verifikasi manual di browser:

#### 1. Verifikasi Selective Submission Locking (SSL)
* **Status**: *Belum Diverifikasi di Browser*
* **Tujuan**: Memastikan tugas kedua siswa terkunci dari pengumpulan apabila ada tunggakan, namun materi pembelajaran tetap bebas diakses tanpa hambatan.

#### 2. Verifikasi Alur Banding
* **Status**: *Belum Diverifikasi di Browser*
* **Tujuan**: Memastikan guru dapat menyetujui banding siswa dan mengaktifkan Mode Recovery hanya untuk tugas overdue tertua, serta memastikan materi di masa depan (> 2030) tidak ditargetkan sebagai tunggakan.

#### 3. Verifikasi Recovery Progression (Kelanjutan Pemulihan)
* **Status**: *Belum Diverifikasi di Browser*
* **Tujuan**: Memastikan sistem mendeteksi pengumpulan tugas overdue tertua, secara otomatis membuka tugas overdue berikutnya, dan membiarkan materi tetap bebas diakses.

#### 4. Verifikasi Locking History (Riwayat Penguncian)
* **Status**: *Belum Diverifikasi di Browser*
* **Tujuan**: Memastikan daftar riwayat penguncian di portal guru/admin hanya berisi data tugas yang terlambat, tanpa menampilkan materi pembelajaran.

#### 5. Verifikasi Skenario Tahun >2030 (Materi 2035 vs Tugas)
* **Status**: *Belum Diverifikasi di Browser*
* **Tujuan**: Menguji perilaku sistem dengan `Materi Uji Tahun 2035` (deadline: 2035-01-01) dan memastikan sistem tidak mendeteksinya sebagai tunggakan di SSL, alur banding, recovery, maupun locking history, tetapi tetap menampilkannya di portal materi siswa.

---

## Bugfix Tambahan yang Diterapkan Selama Verifikasi

1. **Fix Dropdown Kelas Guru Banding** (`banding/index.blade.php` & `banding/history.blade.php`)
   Memperbaiki bug looping `$classrooms` yang berisi array of string agar tidak mengakses `$c->id` / `$c->name`, melainkan langsung mencetak string `{{ $c }}`.
2. **Fix Accessor Biodata Siswa** (`Siswa.php`)
   Memperbaiki `getCurrentClassRoomAttribute()` agar mengembalikan objek model relasi asli `Kelas` dan bukan `stdClass` tanpa `id` guna menghindari error 500 di biodata siswa.
