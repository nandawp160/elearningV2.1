# BUKU PANDUAN PENGGUNAAN SISTEM E-LEARNING V2.1
## SMA NEGERI 1 CEPOGO (SMANSAGO)
*Tahun Ajaran Aktif Terpadu & Kurikulum Merdeka*

---

## DAFTAR ISI

1. [PENDAHULUAN & GAMBARAN UMUM](#1-pendahuluan--gambaran-umum)
   - [1.1 Mengenal E-Learning V2.1 SMANSAGO](#11-mengenal-e-learning-v21-smansago)
   - [1.2 Fitur Unggulan Sistem](#12-fitur-unggulan-sistem)
   - [1.3 Hak Akses & Pembagian Peran](#13-hak-akses--pembagian-peran)
2. [AKSES & AUTENTIKASI SISTEM](#2-akses--autentikasi-sistem)
   - [2.1 Alamat Pintu Masuk (URL Login)](#21-alamat-pintu-masuk-url-login)
   - [2.2 Prosedur Keamanan & Ganti Sandi](#22-prosedur-keamanan--ganti-sandi)
3. [PANDUAN OPERASIONAL: SUPER ADMIN](#3-panduan-operasional-super-admin)
   - [3.1 Manajemen Master Data & Kurikulum](#31-manajemen-master-data--kurikulum)
   - [3.2 Plotting Pengampuan Guru (Teaching Assignment)](#32-plotting-pengampuan-guru-teaching-assignment)
   - [3.3 Manajemen Rombel & Rolling Kelas](#33-manajemen-rombel--rolling-kelas)
   - [3.4 Manajemen Siswa, Kenaikan Kelas & Alumni](#34-manajemen-siswa-kenaikan-kelas--alumni)
   - [3.5 Pengaturan Tahun Ajaran & Arsip Akademik](#35-pengaturan-tahun-ajaran--arsip-akademik)
   - [3.6 Matriks Hak Akses (Permissions Matrix)](#36-matriks-hak-akses-permissions-matrix)
   - [3.7 Pemeliharaan Sistem (Backup, Restore, Storage & Cache)](#37-pemeliharaan-sistem-backup-restore-storage--cache)
   - [3.8 Pelepasan Darurat Massal (Mass Emergency Release)](#38-pelepasan-darurat-massal-mass-emergency-release)
4. [PANDUAN OPERASIONAL: GURU MATA PELAJARAN](#4-panduan-operasional-guru-mata-pelajaran)
   - [4.1 Dashboard Pengampuan & Status Pembelajaran](#41-dashboard-pengampuan--status-pembelajaran)
   - [4.2 Manajemen & Publikasi Materi Belajar](#42-manajemen--publikasi-materi-belajar)
   - [4.3 Pembuatan & Pengelolaan Tugas Multi-Modalitas](#43-pembuatan--pengelolaan-tugas-multi-modalitas)
   - [4.4 Penilaian, Koreksi & Alur Pengembalian Revisi](#44-penilaian-koreksi--alur-pengembalian-revisi)
   - [4.5 Manajemen Banding / Dispensasi Siswa & Mode Pemulihan](#45-manajemen-banding--dispensasi-siswa--mode-pemulihan)
   - [4.6 Rekap Nilai & Ekspor Excel](#46-rekap-nilai--ekspor-excel)
5. [PANDUAN OPERASIONAL: WALI KELAS](#5-panduan-operasional-wali-kelas)
   - [5.1 Dashboard Perwalian & Early Warning System (EWS)](#51-dashboard-perwalian--early-warning-system-ews)
   - [5.2 Pemantauan Daftar Siswa & Kedisiplinan Tugas](#52-pemantauan-daftar-siswa--kedisiplinan-tugas)
   - [5.3 Rekap Nilai & Leger Nilai Terpadu](#53-rekap-nilai--leger-nilai-terpadu)
   - [5.4 Ekspor Leger Nilai ke Excel](#54-ekspor-leger-nilai-ke-excel)
   - [5.5 Penanganan Eskalasi Banding Darurat](#55-penanganan-eskalasi-banding-darurat)
   - [5.6 Grafik Analitik Akademik Rombel](#56-grafik-analitik-akademik-rombel)
6. [PANDUAN OPERASIONAL: SISWA](#6-panduan-operasional-siswa)
   - [6.1 Login Perdana, Biodata & Pembaruan Sandi](#61-login-perdana-biodata--pembaruan-sandi)
   - [6.2 Dashboard Siswa & Jadwal Pembelajaran](#62-dashboard-siswa--jadwal-pembelajaran)
   - [6.3 Mengakses & Mempelajari Materi](#63-mengakses--mempelajari-materi)
   - [6.4 Mengerjakan & Mengirim Tugas (File, Audio, URL/Video)](#64-mengerjakan--mengirim-tugas-file-audio-urlvideo)
   - [6.5 Memahami Mekanisme Kunci Tugas (SSL)](#65-memahami-mekanisme-kunci-tugas-ssl)
   - [6.6 Mengajukan Banding Dispensasi & Menjalankan Recovery](#66-mengajukan-banding-dispensasi--menjalankan-recovery)
7. [TROUBLESHOOTING & PERTANYAAN UMUM (FAQ)](#7-troubleshooting--pertanyaan-umum-faq)

---

# 1. PENDAHULUAN & GAMBARAN UMUM

### 1.1 Mengenal E-Learning V2.1 SMANSAGO
Sistem E-Learning Versi 2.1 SMA Negeri 1 Cepogo dirancang khusus untuk memfasilitasi kegiatan belajar mengajar berbasis digital yang adaptif, terstruktur, dan selaras dengan implementasi **Kurikulum Merdeka**. Sistem ini menghubungkan seluruh civitas akademika—mulai dari Super Administrator, Guru Mata Pelajaran, Wali Kelas, hingga Siswa—dalam satu ekosistem terpadu.

### 1.2 Fitur Unggulan Sistem
1. **Adaptive Selective Submission Locking (SSL):** Mekanisme cerdas untuk menjaga kedisiplinan belajar. Jika siswa memiliki tunggakan tugas yang melebihi batas toleransi (*threshold*), akses pengumpulan tugas baru akan terkunci otomatis sampai tunggakan tugas lama diselesaikan melalui alur banding resmi.
2. **Multi-Modalitas Pengumpulan Tugas:** Mendukung berbagai bentuk portofolio siswa:
   - **Dokumen Berkas:** PDF, Word, Excel, Gambar, dll.
   - **Rekaman Audio Asli:** MP3 / M4A (misal untuk tugas menyanyi, pidato bahasa daerah, atau listening).
   - **Tautan Proyek Daring / Video:** YouTube, Google Drive, Canva, Figma, Loom, dll.
3. **Early Warning System (EWS) Wali Kelas:** Panel deteksi dini untuk memantau siswa yang mengalami kendala belajar atau akumulasi tugas menunggak lintas mata pelajaran.
4. **Leger Nilai Terpadu & Ekspor Excel:** Pembuatan rekap nilai mentah dan nilai akhir siap cetak untuk pengisian rapor kurikulum merdeka.
5. **Multi-Tahun Ajaran & Pengarsipan Otomatis:** Pemisahan data aktif dengan arsip akademik, data alumni lulus, dan mutasi keluar tanpa risiko kehilangan histori data nilai.
6. **Keamanan Berkas Privat (Private File Serving):** Seluruh materi dan tugas tersimpan di penyimpanan terlindungi yang hanya dapat diunduh oleh pihak berwenang melalui sistem enkripsi rute unduh.

### 1.3 Hak Akses & Pembagian Peran

| Peran (Role) | Rute Utama | Tanggung Jawab Utama |
| :--- | :--- | :--- |
| **Super Admin** | `/admin/*` | Pengelolaan data induk, plotting guru, konfigurasi sistem, arsip, & pemeliharaan database. |
| **Guru Mapel** | `/teacher/*` | Pembuatan materi, penerbitan tugas, penilaian, feedback koreksi, & evaluasi banding. |
| **Wali Kelas** | `/homeroom/*` | Monitoring kelas perwalian, evaluasi EWS, verifikasi leger nilai, & eskalasi dispensasi. |
| **Siswa** | `/student/*` & `/dashboard` | Mempelajari materi, pengumpulan tugas multi-modal, & pengajuan dispensasi/banding. |

---

# 2. AKSES & AUTENTIKASI SISTEM

### 2.1 Alamat Pintu Masuk (URL Login)
Untuk menjamin keamanan dan segregasi pengguna, sistem menyediakan 3 pintu login terpisah:

```
┌────────────────────────────────────────────────────────────────────────┐
│                   PORTAL LOGIN E-LEARNING SMANSAGO                     │
├───────────────────────┬────────────────────────────────────────────────┤
│ 1. Portal Siswa       │ http://[domain-sekolah]/siswa/login            │
│ 2. Portal Guru / Wali │ http://[domain-sekolah]/guru/login             │
│ 3. Portal Super Admin │ http://[domain-sekolah]/admin/login            │
└───────────────────────┴────────────────────────────────────────────────┘
```

> **Catatan:** Halaman utama `http://[domain-sekolah]/` secara otomatis akan mengarahkan pengguna ke halaman login siswa sebagai portal publik default.

### 2.2 Prosedur Keamanan & Ganti Sandi
1. Setiap akun wajib memiliki kata sandi yang kuat (kombinasi huruf dan angka).
2. Siswa yang pertama kali dibuatkan akun oleh admin akan diarahkan mengisi biodata dan wajib mengganti kata sandi awal saat login perdana.
3. Seluruh riwayat pergantian kata sandi dicatat dalam tabel audit `PasswordChangeHistory` demi keamanan.

---

# 3. PANDUAN OPERASIONAL: SUPER ADMIN

Super Admin memiliki kendali penuh terhadap konfigurasi aplikasi, master data akademik, hingga backup data.

```
                  ┌─────────────────────────────────┐
                  │      DASHBOARD SUPER ADMIN      │
                  └────────────────┬────────────────┘
         ┌─────────────────────────┼─────────────────────────┐
         ▼                         ▼                         ▼
┌───────────────────┐    ┌───────────────────┐    ┌───────────────────┐
│   Master Data &   │    │  Pengaturan Multi │    │    Pemeliharaan   │
│     Kurikulum     │    │   Tahun Ajaran    │    │      Sistem       │
├───────────────────┤    ├───────────────────┤    ├───────────────────┤
│• Master Kelas     │    │• Set Tahun Aktif  │    │• Backup/Restore DB│
│• Rombel & Rolling │    │• Arsip Siswa      │    │• Bersihkan Cache  │
│• Mata Pelajaran   │    │• Arsip Alumni     │    │• Freeze Storage   │
│• Plotting Guru    │    │• Mutasi Siswa     │    │• Emergency Release│
└───────────────────┘    └───────────────────┘    └───────────────────┘
```

### 3.1 Manajemen Master Data & Kurikulum
1. **Master Kelas (`/master-classes`):**
   - Berfungsi mendefinisikan template kelas (misal: *X-A, X-B, XI-IPA-1, XII-IPS-2*).
   - Dilengkapi fitur **Ekspor Excel Template** untuk pencatatan struktur rombel.
2. **Mata Pelajaran (`/courses`):**
   - Menambahkan mata pelajaran sesuai struktur Kurikulum Merdeka (Fase E untuk Kelas X, Fase F untuk Kelas XI & XII).
   - Menentukan status keaktifan mata pelajaran.

### 3.2 Plotting Pengampuan Guru (Teaching Assignment)
Menu: **Pengaturan > Plotting Guru** (`/teaching-assignments`)
- **Tujuan:** Menghubungkan Guru, Mata Pelajaran, dan Rombongan Belajar pada tahun ajaran aktif.
- **Langkah Kerja:**
  1. Pilih **Nama Guru**, **Mata Pelajaran**, dan centang **Daftar Kelas** yang diajar.
  2. Sistem secara otomatis menghitung beban Jam Tatap Muka (JTM/JP riil) guru berdasarkan alokasi kurikulum standar (termasuk penambahan +2 JP otomatis jika guru menjabat sebagai Wali Kelas).
  3. Gunakan tombol **Toggle Verified** untuk mengunci plotting setelah divalidasi oleh Waka Kurikulum.

### 3.3 Manajemen Rombel & Rolling Kelas
Menu: **Kelas (`/classrooms`) & Rolling Kelas (`/rolling-kelas`)**
- **Generate Kelas:** Membuat rombel aktif otomatis dari data Master Kelas untuk tahun ajaran baru.
- **Rolling Kelas:** Memindahkan rombongan siswa secara masal dari tingkat sebelumnya (misal dari Kelas X-1 ke XI-MIPA-1) tanpa merusak nilai riwayat kelas sebelumnya.
- **Kloning Kelas:** Menduplikasi struktur kelas jika terdapat rombel paralel baru.

### 3.4 Manajemen Siswa, Kenaikan Kelas & Alumni
Menu: **Siswa (`/students`)**
- **Tambah / Impor Siswa:** Mendaftarkan siswa baru beserta NIS, NISN, dan rombel penempatan.
- **Generate Akun Masal:** Menghasilkan akun login dan email resmi sekolah secara otomatis (`@siswa.smansago.com`).
- **Persetujuan Siswa Baru (`Approve All`):** Mengaktifkan akun siswa yang mendaftar mandiri.
- **Kenaikan Kelas Masal (`Bulk Promote`):** Menaikkan siswa ke tingkat berikutnya.
- **Kelulusan Masal (`Bulk Graduate`):** Mengubah status siswa kelas XII menjadi **Alumni** (akses e-learning dinonaktifkan dan berkas diarahkan ke arsip).
- **Mutasi Keluar:** Mencatat riwayat kepindahan siswa ke sekolah lain.

### 3.5 Pengaturan Tahun Ajaran & Arsip Akademik
Menu: **Pengaturan > Tahun Ajaran (`/settings`)**
- **Set Tahun Ajaran Aktif:** Menentukan tahun ajaran operasional sekolah (misal: `2025/2026`).
- **Admin View Switcher:** Admin dapat melihat data tahun ajaran sebelumnya tanpa mengubah tahun aktif bagi guru dan siswa.
- **Detail Arsip per Tahun:**
  - Unduh rekap arsip siswa per tahun dalam format Excel.
  - Unduh data alumni per tahun kelulusan.
  - Unduh data mutasi siswa.

### 3.6 Matriks Hak Akses (Permissions Matrix)
Menu: **Pengaturan > Hak Akses (`/permissions`)**
- Dilengkapi fitur **Security Lock PIN/Password** untuk mencegah perubahan wewenang tanpa izin.
- Mengatur izin detail (create, view, edit, delete, approve) untuk peran: *Super Admin, Guru, Wali Kelas, Siswa*.

### 3.7 Pemeliharaan Sistem (Backup, Restore, Storage & Cache)
Menu: **Pengaturan > Tab Pemeliharaan**
- **Cadangkan Database (Backup DB):** Menghasilkan file dump `.sql` utuh yang langsung terunduh secara aman.
- **Pulihkan Database (Restore DB):** Mengunggah file `.sql` cadangan untuk memulihkan sistem jika terjadi insiden.
- **Bersihkan Cache:** Menghapus cache route, view, dan konfigurasi Laravel dengan sekali klik.
- **Bekukan Penyimpanan (Storage Freeze):** Mengubah sistem menjadi mode *Read-Only* (berguna saat masa penilaian akhir semester atau maintenance agar tidak ada siswa/guru yang mengubah tugas).
- **Arsipkan Submission Alumni:** Mengompres tugas-tugas alumni ke dalam file ZIP arsip dan mengosongkan ruang disk server.

### 3.8 Pelepasan Darurat Massal (Mass Emergency Release)
Menu: **Teacher Portal > Permohonan Banding > Mass Emergency Release**
- Digunakan saat terjadi kondisi luar biasa (misal: bencana alam, gangguan jaringan internet sekolah berkepanjangan).
- Super Admin dapat membuka seluruh kunci tugas (SSL) untuk satu tingkat, satu kelas, atau seluruh sekolah secara serentak dengan menetapkan durasi dispensasi darurat (misal: 48 jam).

---

# 4. PANDUAN OPERASIONAL: GURU MATA PELAJARAN

```
                   ┌───────────────────────────────┐
                   │     PORTAL GURU / TEACHER     │
                   └───────────────┬───────────────┘
         ┌─────────────────────────┼─────────────────────────┐
         ▼                         ▼                         ▼
┌─────────────────┐       ┌─────────────────┐       ┌─────────────────┐
│     MATERI      │       │      TUGAS      │       │     BANDING     │
├─────────────────┤       ├─────────────────┤       ├─────────────────┤
│• Upload Dokumen │       │• Dokumen File   │       │• Review Bukti   │
│• Tautan Daring  │       │• Rekaman Audio  │       │• Set Durasi Jam │
│• Tracking Baca  │       │• Video / URL    │       │• Mode Pemulihan │
│• Preview Privat │       │• Set SSL Limit  │       │• Buka Tunggakan │
└─────────────────┘       └─────────────────┘       └─────────────────┘
```

### 4.1 Dashboard Pengampuan & Status Pembelajaran
Saat login di `/guru/login`, Guru disambut dengan ringkasan:
- Jumlah rombel yang diampu.
- Tugas yang sedang aktif berjalan & tenggat waktunya (*deadline*).
- Jumlah pengumpulan baru yang belum diperiksa.
- Antrean pengajuan banding/dispensasi siswa.

### 4.2 Manajemen & Publikasi Materi Belajar
Menu: **Materi (`/materials`)**
1. **Membuat Materi Baru:**
   - Klik **Tambah Materi**.
   - Masukkan Judul Materi, Deskripsi, dan pilih Kelas Sasaran.
   - Pilih jenis konten: **Unggah Berkas (PDF/PPT/DOC)** atau **Tautan Eksternal (Website/YouTube)**.
2. **Monitoring Pemahaman Siswa:**
   - Guru dapat melihat daftar siswa yang telah mengonfirmasi selesai mempelajari materi melalui indikator *Completion Tracker*.

### 4.3 Pembuatan & Pengelolaan Tugas Multi-Modalitas
Menu: **Pengampuan Saya > Tugas (`/assignments`)**
1. **Membuat Tugas Baru:**
   - Tentukan Judul, Petunjuk Pengerjaan, Mata Pelajaran, dan Kelas.
   - Tentukan **Batas Waktu (Deadline)** secara presisi.
2. **Memilih Tipe Pengumpulan (Modalitas):**
   - **Tipe Dokumen:** Siswa mengunggah dokumen PDF/Office/Gambar (maksimal 10 MB).
   - **Tipe Tautan (Project URL):** Siswa mengumpulkan link Canva, Google Docs, atau repositori proyek.
   - **Tipe Audiovisual:**
     - *Audio File Only:* Khusus rekaman suara format `.mp3` atau `.m4a` (misal ujian lisan/bahasa).
     - *Video URL Only:* Siswa mengumpulkan tautan video Google Drive, YouTube, atau Loom.
3. **Pengaturan Khusus SSL Threshold:**
   - Guru dapat menyesuaikan ambang batas toleransi tunggakan khusus untuk rombel tertentu melalui menu pengaturan threshold guru.

### 4.4 Penilaian, Koreksi & Alur Pengembalian Revisi
Menu: **Pengampuan Saya > Pilih Tugas > Pengumpulan Siswa (`/submissions/{id}`)**
1. **Memeriksa Tugas:**
   - Gunakan fitur **Preview Berkas Privat** untuk membaca dokumen atau memutar audio siswa langsung di peramban tanpa perlu mengunduh manual ke laptop.
2. **Memberikan Nilai & Umpan Balik:**
   - Masukkan skor nilai angka (0 - 100).
   - Tuliskan catatan evaluasi konstruktif pada kolom *Feedback*.
3. **Fitur Pengembalian untuk Revisi (Return for Revision):**
   - Jika tugas siswa belum memenuhi kriteria atau salah format, klik tombol **Kembalikan untuk Revisi**.
   - Status tugas di sisi siswa akan berubah menjadi *Perlu Revisi* sehingga siswa dapat mengunggah perbaikan sebelum batas akhir.

### 4.5 Manajemen Banding / Dispensasi Siswa & Mode Pemulihan
Menu: **Teacher Portal > Banding Submission (`/teacher/submission-appeals`)**
- Jika siswa terkunci oleh sistem SSL, siswa akan mengajukan permohonan banding disertai surat izin/sakit/kendala.
- **Prosedur Guru:**
  1. Buka antrean banding pada kelas terkait.
  2. Periksa alasan dan klik **Lihat Bukti Pendukung** (surat keterangan dokter/orang tua).
  3. **Jika Diterima:**
     - Pilih **Durasi Waktu Pemulihan** (misal: 24 jam, 48 jam, atau 72 jam).
     - Masukkan catatan tanggapan guru.
     - Klik **Setujui Banding**.
     - *Efek:* Sistem otomatis mengaktifkan **Mode Pemulihan (Recovery Mode)**. Akses tugas tertua yang menunggak akan terbuka bagi siswa tersebut hingga batas waktu berakhir.
  4. **Jika Ditolak:**
     - Masukkan alasan penolakan dan klik **Tolak Banding**.

### 4.6 Rekap Nilai & Ekspor Excel
Menu: **Pengampuan Saya > Rekap Nilai (`/assignments/teacher/rekap/{subject}`)**
- Guru dapat melihat matriks nilai seluruh siswa per tugas dalam satu mata pelajaran.
- Klik tombol **Ekspor Excel** untuk mengunduh format lembar nilai `.xlsx` yang siap disetorkan ke Waka Kurikulum.

---

# 5. PANDUAN OPERASIONAL: WALI KELAS

Wali Kelas memiliki wewenang komprehensif untuk mengawasi perkembangan akademik seluruh siswa di rombongan perwaliannya lintas semua mata pelajaran.

```
                  ┌─────────────────────────────────┐
                  │      DASHBOARD WALI KELAS       │
                  └────────────────┬────────────────┘
         ┌─────────────────────────┼─────────────────────────┐
         ▼                         ▼                         ▼
┌───────────────────┐    ┌───────────────────┐    ┌───────────────────┐
│Early Warning (EWS)│    │   Leger & Rekap   │    │ Eskalasi Banding  │
├───────────────────┤    ├───────────────────┤    ├───────────────────┤
│• Siswa Kritis     │    │• Leger Nilai Rombel│   │• Override > 24 Jam│
│• Akumulasi Lock   │    │• Nilai Mentah     │    │• Guru Berhalangan │
│• Rasio Disiplin   │    │• Ekspor Excel Rapi│    │• Audit Pemulihan  │
└───────────────────┘    └───────────────────┘    └───────────────────┘
```

### 5.1 Dashboard Perwalian & Early Warning System (EWS)
Menu: **Wali Kelas > Dashboard (`/homeroom/dashboard`)**
- **Kartu Statistik Rombel:** Jumlah siswa aktif, rasio gender, rata-rata nilai kelas.
- **Grafik Tren Kedisiplinan:** Persentase pengumpulan tepat waktu (*On-Time*), melalui pemulihan (*SSL Recovery*), dan tugas terblokir (*Blocked*).
- **Panel Early Warning System (EWS):**
  - Menampilkan daftar siswa yang berada dalam zona merah/kritis (memiliki tunggakan tugas $\ge$ ambang batas di berbagai mapel).
  - Memudahkan Wali Kelas untuk segera melakukan konseling atau memanggil orang tua siswa yang bersangkutan.

### 5.2 Pemantauan Daftar Siswa & Kedisiplinan Tugas
Menu: **Wali Kelas > Siswa Kelas (`/homeroom/students`)**
- Menampilkan profil lengkap siswa perwalian, NISN, kontak, dan riwayat status keaktifan.

### 5.3 Rekap Nilai & Leger Nilai Terpadu
Menu: **Wali Kelas > Rekap Nilai & Leger Nilai (`/homeroom/rekap-nilai` & `/homeroom/leger-nilai`)**
- **Rekap Nilai:** Menampilkan matriks status pengumpulan dan tunggakan siswa di setiap mata pelajaran.
- **Leger Nilai:** Menggabungkan seluruh nilai tugas dari seluruh guru pengampu menjadi satu tabel terpadu lengkap dengan rata-rata nilai per anak dan rata-rata kelas.

### 5.4 Ekspor Leger Nilai ke Excel
- Tombol **Ekspor Leger Nilai (Excel):** Menghasilkan lembar kerja `.xlsx` terformat rapi dengan kop sekolah resmi, daftar nilai seluruh mata pelajaran, dan kolom tanda tangan Wali Kelas.

### 5.5 Penanganan Eskalasi Banding Darurat
Menu: **Wali Kelas > Banding Siswa (`/homeroom/appeals`)**
- **Prinsip Eskalasi:** Guru Mata Pelajaran memiliki waktu 24 jam pertama untuk memproses banding siswa.
- **Wewenang Wali Kelas:**
  - Jika guru mapel belum memproses permohonan dalam waktu $> 24\text{ jam}$, atau guru mapel sedang berhalangan hadir/nonaktif, hak persetujuan akan **dieskalasi otomatis** ke Wali Kelas.
  - Wali Kelas dapat menyetujui dispensasi darurat agar siswa tidak tertinggal materi pembelajaran.

### 5.6 Grafik Analitik Akademik Rombel
Menu: **Wali Kelas > Grafik Akademik (`/homeroom/academic-chart`)**
- Visualisasi performa akademik kelas, perbandingan capaian antar mata pelajaran, dan analisis distribusi nilai siswa.

---

# 6. PANDUAN OPERASIONAL: SISWA

```
                  ┌─────────────────────────────────┐
                  │          PORTAL SISWA           │
                  └────────────────┬────────────────┘
         ┌─────────────────────────┼─────────────────────────┐
         ▼                         ▼                         ▼
┌───────────────────┐    ┌───────────────────┐    ┌───────────────────┐
│  Materi & Jadwal  │    │ Pengumpulan Tugas │    │ Alur Banding SSL  │
├───────────────────┤    ├───────────────────┤    ├───────────────────┤
│• Unduh Dokumen    │    │• Upload File      │    │• Notifikasi Kunci │
│• Tandai Selesai   │    │• Audio MP3/M4A    │    │• Upload Bukti Izin│
│• Cek Deadline     │    │• URL Video/Proyek │    │• Countdown Timer  │
└───────────────────┘    └───────────────────┘    └───────────────────┘
```

### 6.1 Login Perdana, Biodata & Pembaruan Sandi
1. Akses halaman: `http://[domain-sekolah]/siswa/login`
2. Masukkan email resmi yang diberikan sekolah dan kata sandi default.
3. **Pada Login Perdana:**
   - Sistem akan menampilkan formulir **Lengkapi Biodata**.
   - Isi NISN, Nomor WhatsApp aktif, Nama Orang Tua/Wali, dan Alamat.
   - Masukkan kata sandi baru yang aman dan mudah diingat.
   - Klik **Simpan & Masuk ke Dashboard**.

### 6.2 Dashboard Siswa & Jadwal Pembelajaran
- **Pengumuman & Notifikasi:** Informasi penting dari sekolah dan guru.
- **Tugas Mendatang:** Daftar tugas aktif yang diurutkan berdasarkan batas waktu terdekat.
- **Jadwal Pelajaran:** Rincian mata pelajaran aktif sesuai tingkat rombel siswa.

### 6.3 Mengakses & Mempelajari Materi
1. Buka menu **Mata Pelajaran** atau **Materi**.
2. Pilih materi yang ingin dipelajari.
3. Unduh berkas materi atau klik tautan video penjelasan dari guru.
4. Setelah selesai mempelajari, klik tombol **Tandai Selesai** agar tercatat pada progres belajar guru.

### 6.4 Mengerjakan & Mengirim Tugas (File, Audio, URL/Video)
1. Buka menu **Tugas**, pilih tugas yang berstatus *Aktif*.
2. Perhatikan instruksi guru dan jenis pengumpulan yang diminta:
   - **Jika Tipe File Dokumen:** Klik *Pilih Berkas* (PDF/Word/JPG), lalu klik **Kirim Tugas**.
   - **Jika Tipe Audio:** Rekam suara Anda (misal via Voice Recorder HP), pastikan format `.mp3` atau `.m4a`, unggah berkas, lalu klik **Kirim Tugas**.
   - **Jika Tipe Tautan Proyek / Video:** Buka Google Drive / YouTube / Canva Anda, pastikan hak akses link diatur ke *"Siapa saja yang memiliki tautan dapat melihat (Viewer)"*, salin link, tempelkan ke kolom URL di e-learning, lalu klik **Kirim Tugas**.
3. **Status Pengumpulan:**
   - **Tepat Waktu (On Time):** Dikirim sebelum batas waktu.
   - **Terlambat (Late):** Dikirim melewati batas waktu toleransi.
   - **Perlu Revisi:** Tugas dikembalikan oleh guru untuk diperbaiki.
   - **Selesai / Dinilai:** Guru telah memberikan nilai angka dan ulasan evaluasi.

### 6.5 Memahami Mekanisme Kunci Tugas (SSL)
- Sistem e-learning menerapkan aturan kedisiplinan **Selective Submission Locking (SSL)**.
- Jika Anda memiliki tugas yang melewati deadline tanpa dikumpulkan hingga mencapai batas toleransi (misal 3 tugas menunggak), maka:
  > ⚠️ **AKSES PENGUMPULAN TERKUNCI:** Anda tidak dapat mengumpulkan tugas baru pada mata pelajaran tersebut sebelum menyelesaikan tugas yang menunggak!

### 6.6 Mengajukan Banding Dispensasi & Menjalankan Recovery
Jika akun Anda mengalami penguncian SSL karena alasan yang sah (sakit, kendala teknis, musibah, atau dispensasi kegiatan lomba):
1. **Mengajukan Banding:**
   - Klik tombol **Ajukan Banding Dispensasi** pada halaman tugas yang terkunci.
   - Tuliskan alasan kendala secara jujur dan detail.
   - Unggah foto **Bukti Pendukung** (Surat Izin Dokter, Surat Tugas Sekolah, atau Surat Orang Tua format PDF/JPG).
   - Klik **Kirim Permohonan Banding**.
2. **Memantau Status Permohonan (`/student/appeals`):**
   - Siswa dapat melihat status: *Menunggu Guru*, *Disetujui*, atau *Ditolak*.
3. **Menjalankan Mode Pemulihan (Recovery Mode):**
   - Setelah disetujui Guru / Wali Kelas, akun akan memasuki **Mode Pemulihan**.
   - Sistem membuka tugas tertua yang menunggak dan menampilkan **Countdown Timer** (misal 48 jam).
   - Segera kumpulkan tugas tunggakan tersebut sebelum waktu timer habis agar akses tugas Anda kembali normal sepenuhnya.

---

# 7. TROUBLESHOOTING & PERTANYAAN UMUM (FAQ)

### Q1: Mengapa muncul pesan "Sistem Terkunci (Read-Only) / Storage Frozen"?
> **Penjelasan:** Super Admin sedang mengaktifkan fitur *Storage Freeze* untuk keperluan rekapitulasi nilai akhir semester atau pemeliharaan server. Selama masa ini, pengguna hanya dapat membaca materi dan tidak dapat mengunggah file baru sampai admin mencairkan (*unfreeze*) sistem.

### Q2: Siswa tidak bisa mengunggah tugas karena format ditolak?
> **Solusi:** Periksa modalitas yang ditetapkan guru:
> - Jika tugas mewajibkan audio, pastikan format file adalah `.mp3` atau `.m4a` dengan ukuran di bawah 10 MB.
> - Jika tugas mewajibkan URL/Tautan, pastikan link diawali dengan `http://` atau `https://` yang valid (bukan teks biasa).

### Q3: Bagaimana jika Guru berhalangan hadir dan tidak sempat menyetujui banding siswa?
> **Solusi:** Sistem memiliki mekanisme eskalasi otomatis. Setelah 24 jam permohonan dibuat, wewenang persetujuan banding akan otomatis terbuka pada dashboard Wali Kelas dari rombel siswa tersebut.

### Q4: Muncul pesan error "No application encryption key has been specified"?
> **Solusi Teknis:** Buka terminal di server utama dan jalankan perintah:
> ```bash
> php artisan key:generate
> ```

### Q5: Tampilan halaman terlihat berantakan atau perubahan data tidak muncul?
> **Solusi Teknis:** Bersihkan cache aplikasi melalui portal Admin pada menu **Pemeliharaan > Bersihkan Cache**, atau jalankan perintah:
> ```bash
> php artisan optimize:clear
> ```

---
*Dokumen ini disusun sebagai panduan operasional resmi Sistem E-Learning V2.1 SMA Negeri 1 Cepogo.*
*Pembaruan Terakhir: Tahun Ajaran 2025/2026 - Versi Rilis 2.1.0*
