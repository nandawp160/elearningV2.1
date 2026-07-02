-- =========================================================================
-- SQL Pemindahan Data (Migration Data) Ke Database Baru (db_elearning)
-- HANYA memasukkan data 'pengguna' dan 'mata_pelajaran' saja.
-- =========================================================================

-- 1. Mengisi data ke tabel 'pengguna'
INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Pak Budi Santoso', 'budi@guru.smansago.com', '$2y$12$BiP3occJOx.R01Zp820weuBe/nVwhPub0lwU56cVfqWbPHD6Y9F.a', 'guru', '2026-06-07 05:14:27', '2026-06-07 05:14:27'),
(2, 'Ibu Siti Aminah Test', 'siti@guru.smansago.com.test', '$2y$12$FnSw8JLMpDmRvgQ/CHpLy.WX/3JNCGjJMW8Le4PYQOe7ENA7wWra6', 'guru', '2026-06-07 05:14:27', '2026-06-19 09:09:20'),
(3, 'Pak Ahmad Yani', 'ahmad@guru.smansago.com', '$2y$12$hVyaZPRnphAY3W.98.XkseGgDtBVz8h8QOsr4Payw266WZoGyL5xW', 'guru', '2026-06-07 05:14:27', '2026-06-07 05:14:27'),
(4, 'Andi Pratama', 'andi@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-07 05:14:27', '2026-06-07 05:14:27'),
(5, 'Budi Santoso', 'budi@siswa.smansago.com', '$2y$12$FxPPrkCzBn9oC6Qp6mSFqO7ktTDJ9dwjvlh15sGtBaOc/9XhOuVq2', 'siswa', '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(6, 'Super Admin', 'admin@admin.smansago.com', '$2y$12$LwN6FHA5reNjKdsWLEZpNe2LwgY.szZC7hzuhzWC8OFPfkvfFfWLe', 'admin', '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(8, 'Staf Tata Usaha', 'tu@admin.smansago.com', '$2y$12$EZhO2283GKr8/9aMMTlUZ.cLdt6TixxI6wkiUTOKX2kiSkvflwOD.', 'admin', '2026-06-19 09:00:19', '2026-06-19 09:00:19'),
(10, 'Wahyu', '2025003@siswa.smansago.com', '$2y$12$9qxXyLvalxdmtpVSmRn8KOsHsOVSftqjVBeVP6cb2ewEyYqMFsGN.', 'siswa', '2026-06-19 17:40:45', '2026-06-19 17:40:45'),
(11, 'homsi', '2025004@siswa.smansago.com', '$2y$12$9DxAspfFXEM6aBTHHZMLaOqfXEncxByJYRKwh4E.2jpwlIMd93p0.', 'siswa', '2026-06-19 17:42:47', '2026-06-19 17:42:47'),
(13, 'Wahyu test dropdown', '2025005@siswa.smansago.com', '$2y$12$pPkpHLDGo80PH/bFSIeFy.Qcd2hh3bBEnJIEACMZxoP0bsbDOnBzi', 'siswa', '2026-06-19 17:59:45', '2026-06-19 17:59:45'),
(14, 'Ilham, S.M', 'ilham@guru.smansago.com', '$2y$12$6WVlOtLDX2/xJwR7GYSfAOYKAwqs2O2Ch/brMRbkbSkuN6.vXcXtG', 'guru', '2026-06-19 18:16:33', '2026-06-19 18:16:33');

-- 2. Mengisi data ke tabel 'mata_pelajaran'
INSERT INTO `mata_pelajaran` (`id`, `kode`, `nama`, `deskripsi`, `tingkat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MTK-X', 'Matematika X', 'Matematika Wajib Kelas X', 'X', 'aktif', '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(2, 'FIS-X', 'Fisika X', 'Fisika Kelas X', 'X', 'aktif', '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(3, 'KIM-X', 'Kimia X', 'Kimia Kelas X', 'X', 'aktif', '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(4, 'TIK-X', 'TIK 1', 'Teknologi Informasi dan Komunikasi 1', 'X', 'aktif', '2026-06-19 18:16:33', '2026-06-19 18:16:33'),
(5, 'BINDX', 'Bahasa Indonesia X', 'Bahasa Indonesia Kelas X', 'X', 'aktif', '2026-06-19 18:16:33', '2026-06-19 18:16:33'),
(6, 'TIK-XI', 'TIK LANJUTAN', 'TIK Lanjutan Kelas XI', 'XI', 'aktif', '2026-06-19 18:16:33', '2026-06-19 18:16:33');
