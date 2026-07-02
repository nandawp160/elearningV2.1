# PRODUCT REQUIREMENTS DOCUMENT (PRD) & SYSTEM ARCHITECTURE
**Project Name:** E-Learning Assignment Control System (Fokus Modul: Dispensasi Keterlambatan)
**Project State:** CUSTOMIZATION / BROWNFIELD PROJECT (Sistem Induk Sudah Ada)
**Tech Stack:** Laravel 11+, PHP 8.2+, MySQL, Tailwind/Bootstrap, Maatwebsite/Laravel-Excel, DomPDF.
**Brand Identity:** Warna Utama Oranye (`#D65A20`), Layouting Desktop Centered.

---

## 🛑 STRICT DIRECTIVES FOR AI AGENT
Peringatan untuk AI Code Assistant: Ini BUKAN proyek dari nol (Greenfield). Anda beroperasi di atas sistem *legacy* eksisting.
1. **DO NOT OVERWRITE CORE FILES:** Jangan pernah menimpa/menghapus `users` migration, model, atau core controller yang sudah ada tanpa izin tertulis.
2. **USE MIGRATION ALTERS:** Jika butuh kolom baru di tabel yang sudah umum ada (seperti `users`, `kelas`, `mapel`), wajib gunakan perintah `make:migration add_column_to_table_name` (Schema::table), BUKAN Schema::create.
3. **COMPONENT-BASED UI:** Ekstrak elemen visual berulang (seperti *Master Sidebar* Administrator dan *Modal Pop-up Overlay* gelap) ke dalam komponen Blade (`resources/views/components/`).
4. **NON-DESTRUCTIVE INJECTION:** Saat menambahkan logika "Lock/Terkunci" pada fitur Tugas, injeksikan logika tersebut ke dalam alur *Controller* eksisting secara *non-destructive* (misalnya menggunakan *Middleware* atau tambahan *Service Class*).

---

## 1. DESKRIPSI SISTEM (OBJEKTIF R&D)
Sistem E-Learning eksisting ini akan dikustomisasi untuk memiliki fokus unik pada **Manajemen Kedisiplinan Pengumpulan Tugas**. 
Jika siswa melewati tenggat waktu (deadline), sistem secara otomatis mengunci akses pengumpulan (Status: Terkunci/Lock). Untuk membuka kunci, siswa harus mengajukan **Banding/Dispensasi** (dengan alasan & bukti dokumen) yang akan divalidasi oleh Guru Mata Pelajaran. Wali Kelas bertindak sebagai pengamat (*Monitoring*) melalui laporan analitik.

---

## 2. HAK AKSES & PERAN (RBAC TARGET)
Sistem memiliki 4 entitas aktor utama (pastikan tabel `users` memiliki kolom `role` untuk membedakan ini):

1. **Administrator:**
   - Mengelola Data Induk via UI yang telah distandarisasi (Sidebar Oranye).
   - Mengelola Data Siswa, Data Guru, Kelas, dan Rolling Kelas.
   - Fitur Wajib di setiap halaman Data: Search Bar, Filter Select, Export Excel, Import Excel, dan Tambah Manual via *Pop-up Modal* (dengan overlay gelap 60%).
2. **Guru Mata Pelajaran:**
   - Membuat penugasan eksisting.
   - **[FITUR BARU]** Memiliki modul *Inbox* **Validasi Dispensasi** (Menerima/Menolak alasan keterlambatan siswa).
3. **Wali Kelas (Read-Only Observer):**
   - **[FITUR BARU]** Mengakses Dashboard Grafik Akademik (Visualisasi Chart.js untuk zona kedisiplinan).
   - **[FITUR BARU]** Mencetak Leger Tugas Harian (Crosstab/Pivot) & Akumulasi Frekuensi Pelanggaran per siswa.
4. **Siswa:**
   - Mengerjakan tugas eksisting.
   - **[FITUR BARU]** Jika deadline lewat, tombol *Upload* berubah menjadi form *Ajukan Banding Dispensasi*.

---

## 3. DELTA DATABASE (TARGET STRUKTUR)
*Agent: Cek database lokal eksisting. Jika tabel 1-3 sudah ada, lakukan ALTER TABLE. Tabel 4-5 biasanya adalah tabel baru.*

**1. Tabel `users` (ALTER jika perlu)**
- Pastikan ada kolom/relasi untuk: `role` (admin, guru, walikelas, siswa), `is_active`.

**2. Tabel Induk Akademik (`kelas`, `mata_pelajaran`, `siswa`, `guru`) (ALTER jika perlu)**
- Pastikan relasi FK antar entitas valid (Contoh: `kelas` memiliki `wali_kelas_id` yang merujuk ke tabel users dengan role walikelas).

**3. Tabel `pengumpulan_tugas` / Assignment Submission (ALTER WAJIB)**
- Tambahkan kolom: `status_pengumpulan` (enum: 'belum_kumpul', 'tepat_waktu', 'terkunci', 'menunggu_validasi', 'dispensasi_aktif', 'ditolak').

**4. Tabel `banding_dispensasi` (CREATE NEW TABLE)**
- `id`, `pengumpulan_tugas_id` (FK), `kategori_alasan` (string), `deskripsi_alasan` (text), `file_bukti` (string/path), `status` (enum: pending, approved, rejected), `waktu_pengajuan` (timestamp).

**5. Tabel `log_pelanggaran_akademik` (CREATE NEW TABLE - Opsional/Saran)**
- Untuk mempermudah query Wali Kelas saat menarik Leger Tunggakan.

---

## 4. UI/UX & ROUTING MAP (BERDASARKAN DESAIN FIGMA TERBARU)

**A. Autentikasi & Layout Utama**
- `login` -> Layout Desktop Centered yang modern dan minimalis. Terdapat aksen garis atas oranye (`#D65A20`), form input NIS/Sandi, dan tombol solid oranye.
- `layouts.app` -> Gunakan Master Sidebar Component (logo E_LEARNING oranye, background putih, active state light-orange).

**B. Administrator Routes (Prefix: `/admin`)**
- `admin.siswa.index` -> Tabel Data Siswa. Wajib ada fitur Pop-up form tambah data dengan overlay background `#111827` opacity 60%.
- `admin.guru.index` -> Tabel Data Guru (NIP, Nama Lengkap & Gelar, Mata Pelajaran, Status).
- `admin.kelas.index` -> Tabel Data Kelas (menampilkan relasi Wali Kelas dan Aggregate Total Siswa).

**C. Wali Kelas Routes (Prefix: `/walikelas`)**
- `walikelas.laporan.grafik` -> Analitik Kedisiplinan (Doughnut Chart & Bar chart korelasi nilai vs kasus).
- `walikelas.laporan.leger` -> Tabel Dinamis (Crosstab). Menampilkan nilai per mapel dan kotak penanda merah untuk akumulasi tunggakan.

**D. Alur Logika "Lock" (Controller Target: `SiswaTaskController`)**
1. Saat Load Detail Tugas: `if(now() > $task->deadline && $submission->status != 'dispensasi_aktif') { render view Locked; }`
2. Proses Banding: Upload alasan -> Ubah status jadi `menunggu_validasi`.
3. Guru Validasi: Jika di-Approve -> Status berubah `dispensasi_aktif` -> Buka kunci form upload file tugas utama.