-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2026 at 11:16 AM
-- Server version: 8.4.3
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearningv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 22:28:13', '2026-07-14 22:28:13'),
(2, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 22:28:21', '2026-07-14 22:28:21'),
(3, 13, 'AUTH', 'Guru \"Heni Setyarini, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 22:28:34', '2026-07-14 22:28:34'),
(4, 13, 'AUTH', 'Pengguna \"Heni Setyarini, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 22:28:50', '2026-07-14 22:28:50'),
(5, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 22:29:04', '2026-07-14 22:29:04'),
(6, 1, 'STUDENT', 'Menambahkan data siswa baru: tes dum (NIS: 12345679)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 22:49:37', '2026-07-14 22:49:37'),
(7, 1, 'DELETION', 'Menghapus data siswa: tes dum (NIS: 12345679)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 22:56:00', '2026-07-14 22:56:00'),
(8, 1, 'TEACHER', 'Menambahkan data guru baru: tess guru (NIP: 201928739848392)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 22:57:02', '2026-07-14 22:57:02'),
(9, 1, 'DELETION', 'Menghapus data guru: tess guru (NIP: 201928739848392)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 23:05:49', '2026-07-14 23:05:49'),
(10, 1, 'TEACHER', 'Menambahkan data guru baru: wahyu (NIP: 123456789)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 23:13:24', '2026-07-14 23:13:24'),
(11, 1, 'DELETION', 'Menghapus data guru: wahyu (NIP: 123456789)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 23:14:15', '2026-07-14 23:14:15'),
(12, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 00:08:42', '2026-07-22 00:08:42'),
(13, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 00:54:40', '2026-07-22 00:54:40'),
(14, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 01:22:54', '2026-07-22 01:22:54'),
(15, 1, 'TEACHER', 'Menambahkan data guru baru: nama  pengujian,S.Kom (NIP: 2003081620260102)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 01:25:21', '2026-07-22 01:25:21'),
(16, 1, 'DELETION', 'Menghapus data guru: nama  pengujian,S.Kom (NIP: 2003081620260102)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 01:26:08', '2026-07-22 01:26:08'),
(17, 1, 'TEACHER', 'Menambahkan data guru baru: nama  pengujian,S.Kom (NIP: 200308232020109848)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 01:54:09', '2026-07-22 01:54:09'),
(18, 1, 'DELETION', 'Menghapus data guru: nama  pengujian,S.Kom (NIP: 200308232020109848)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 01:54:22', '2026-07-22 01:54:22'),
(19, 1, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2027/2028. Terplot: 258 pemetaan.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 02:09:29', '2026-07-22 02:09:29'),
(20, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 02:19:50', '2026-07-22 02:19:50'),
(21, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2027/2028. Terplot: 272 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:27:53', '2026-07-22 02:27:53'),
(22, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2027/2028. Terplot: 291 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:29:58', '2026-07-22 02:29:58'),
(23, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2027/2028. Terplot: 291 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:48:13', '2026-07-22 02:48:13'),
(24, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2027/2028. Terplot: 324 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:48:30', '2026-07-22 02:48:30'),
(25, 1, 'DELETION', 'Menghapus data kelas: XII F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 02:53:35', '2026-07-22 02:53:35'),
(26, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2027/2028. Terplot: 315 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:55:21', '2026-07-22 02:55:21'),
(27, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke 20 kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2027/2028. Terplot: 328 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:55:52', '2026-07-22 02:55:52'),
(28, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke 20 kelas dengan pengikatan Rumpun (Kurikulum Merdeka) untuk Tahun Ajaran 2027/2028. Terplot: 266 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:29:42', '2026-07-22 03:29:42'),
(29, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke 20 kelas dengan pengikatan Rumpun Kurikulum Merdeka persis untuk Tahun Ajaran 2027/2028. Terplot: 263 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:39:42', '2026-07-22 03:39:42'),
(30, NULL, 'TEACHER', 'Melakukan plotting guru otomatis 100% Sempurna ke 20 kelas untuk Tahun Ajaran 2027/2028. Terplot: 265 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:47:50', '2026-07-22 03:47:50'),
(31, NULL, 'TEACHER', 'Melakukan plotting guru otomatis 100% Sempurna ke 20 kelas untuk Tahun Ajaran 2027/2028. Terplot: 265 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:51:59', '2026-07-22 03:51:59'),
(32, NULL, 'TEACHER', 'Melakukan plotting guru otomatis 100% Sempurna ke 20 kelas untuk Tahun Ajaran 2027/2028. Terplot: 265 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:57:25', '2026-07-22 03:57:25'),
(33, NULL, 'TEACHER', 'Melakukan plotting guru otomatis 100% Sempurna ke 20 kelas untuk Tahun Ajaran 2027/2028. Terplot: 265 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:59:58', '2026-07-22 03:59:58'),
(34, NULL, 'CLEARED_CACHE', 'Membersihkan cache sistem (cache, config, view, route)', NULL, NULL, '2026-07-22 04:23:42', '2026-07-22 04:23:42'),
(35, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 10:43:42', '2026-07-22 10:43:42'),
(36, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 11:17:30', '2026-07-22 11:17:30'),
(37, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 00:30:46', '2026-07-28 00:30:46'),
(38, 1, 'SETTINGS', 'Mengekspor data distribusi akun pengguna ke Excel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 00:33:56', '2026-07-28 00:33:56'),
(39, 1, 'SETTINGS', 'Mengekspor data distribusi akun pengguna ke Excel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 00:34:23', '2026-07-28 00:34:23'),
(40, 1, 'SETTINGS', 'Mengekspor data distribusi akun pengguna ke Excel', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 00:37:40', '2026-07-28 00:37:40'),
(41, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:31:24', '2026-07-28 03:31:24'),
(42, 15, 'AUTH', 'Guru \"Iis Lestari, S.Kom\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:36:53', '2026-07-28 03:36:53'),
(43, 500, 'AUTH', 'Siswa \"ALPIANA RAHMAWATI\" (NIS: -) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:37:08', '2026-07-28 03:37:08'),
(44, 15, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 2: Berpikir Komputasional - Logika Sistem Perpustakaan Digital', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:43:49', '2026-07-28 03:43:49'),
(45, 15, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 2: Berpikir Komputasional - Logika Sistem Perpustakaan Digital', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:45:00', '2026-07-28 03:45:00'),
(46, 15, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 2: Berpikir Komputasional - Logika Sistem Perpustakaan Digital', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:45:32', '2026-07-28 03:45:32'),
(47, 15, 'ASSIGNMENT', 'Membuat materi baru: tes upload materi', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:50:11', '2026-07-28 03:50:11'),
(48, 15, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 1: Berpikir Komputasional - Logika Sistem Perpustakaan Digital', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:56:29', '2026-07-28 03:56:29'),
(49, 15, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 2: Berpikir Komputasional - Logika Sistem Kehadiran Karyawan', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:58:10', '2026-07-28 03:58:10'),
(50, 15, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 1: Berpikir Komputasional - Logika Sistem Perpustakaan Digital', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 03:59:11', '2026-07-28 03:59:11'),
(51, 500, 'ASSIGNMENT', 'Mengumpulkan tugas: Tugas 1: Berpikir Komputasional - Logika Sistem Perpustakaan Digital', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:03:19', '2026-07-28 04:03:19'),
(52, 15, 'ASSIGNMENT', 'Mengubah status koreksi tugas Tugas 1: Berpikir Komputasional - Logika Sistem Perpustakaan Digital untuk siswa ALPIANA RAHMAWATI', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:03:50', '2026-07-28 04:03:50'),
(53, 15, 'ASSIGNMENT', 'Membuat tugas baru: TES', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:06:52', '2026-07-28 04:06:52'),
(54, 15, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 2: Berpikir Komputasional - Logika Sistem Kehadiran Karyawan', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:07:19', '2026-07-28 04:07:19'),
(55, 15, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 1: Berpikir Komputasional - Logika Sistem Perpustakaan Digital', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:07:36', '2026-07-28 04:07:36'),
(56, 15, 'ASSIGNMENT', 'Memperbarui tugas: TES', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:07:49', '2026-07-28 04:07:49'),
(57, 500, 'AUTH', 'Pengguna \"ALPIANA RAHMAWATI\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:09:55', '2026-07-28 04:09:55'),
(58, 535, 'AUTH', 'Siswa \"ZAFRAN AL FARIZI\" (NIS: -) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:10:32', '2026-07-28 04:10:32'),
(59, 535, 'APPEAL', 'Mengajukan banding dispensasi untuk mata pelajaran ID 11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:11:16', '2026-07-28 04:11:16'),
(60, 15, 'AUTH', 'Pengguna \"Iis Lestari, S.Kom\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:12:13', '2026-07-28 04:12:13'),
(61, 15, 'AUTH', 'Guru \"Iis Lestari, S.Kom\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:12:22', '2026-07-28 04:12:22'),
(62, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:13:40', '2026-07-28 04:13:40'),
(63, 15, 'AUTH', 'Guru \"Iis Lestari, S.Kom\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:14:18', '2026-07-28 04:14:18'),
(64, 535, 'AUTH', 'Siswa \"ZAFRAN AL FARIZI\" (NIS: -) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:14:59', '2026-07-28 04:14:59'),
(65, 15, 'APPEAL', 'Menyetujui banding dispensasi untuk siswa ID 500 pada mata pelajaran ID 11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:21:40', '2026-07-28 04:21:40'),
(66, 15, 'APPEAL', 'Menyetujui banding dispensasi untuk siswa ID 500 pada mata pelajaran ID 11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-28 04:38:51', '2026-07-28 04:38:51'),
(67, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-10 09:55:22', '2026-08-10 09:55:22'),
(68, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-10 10:28:46', '2026-08-10 10:28:46'),
(69, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-11 11:27:20', '2026-08-11 11:27:20'),
(70, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-11 12:03:43', '2026-08-11 12:03:43'),
(71, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-11 12:14:41', '2026-08-11 12:14:41'),
(72, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-15 11:23:58', '2026-08-15 11:23:58'),
(73, 1, 'CLASS', 'Me-generate 1 rombel dari Master Kelas untuk Tahun Ajaran 2025/2026', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-15 11:40:29', '2026-08-15 11:40:29'),
(74, 1, 'CLASS', 'Me-generate 22 rombel dari Master Kelas untuk Tahun Ajaran 2026/2027', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(75, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 32 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-15 12:47:35', '2026-08-15 12:47:35'),
(76, NULL, 'STUDENT', 'Mengembalikan kelas 32 siswa ke X 1 (pembatalan test penjurusan).', '127.0.0.1', 'Symfony', '2026-08-15 12:49:26', '2026-08-15 12:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hadir',
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `marked_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sessions`
--

CREATE TABLE `attendance_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `qr_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('sma-n-1-cepogo-cache-f83a383c0fa81f295d057f8f5ed0ba4610947817', 'i:1;', 1785211459),
('sma-n-1-cepogo-cache-f83a383c0fa81f295d057f8f5ed0ba4610947817:timer', 'i:1785211459;', 1785211459),
('sma-n-1-cepogo-cache-total_students', 'i:500;', 1786793098),
('sma-n-1-cepogo-cache-total_teachers', 'i:33;', 1786793098);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint UNSIGNED NOT NULL,
  `submission_id` bigint UNSIGNED DEFAULT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `type` enum('assignment','quiz','midterm','final') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'assignment',
  `score` decimal(5,2) NOT NULL,
  `max_score` int NOT NULL DEFAULT '100',
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `graded_by` bigint UNSIGNED NOT NULL,
  `graded_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `submission_id`, `subject_id`, `student_id`, `type`, `score`, `max_score`, `feedback`, `graded_by`, `graded_at`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 465, 'assignment', 100.00, 100, 'Selesai dikoreksi.', 13, '2026-07-28 11:03:50', '2026-07-28 04:03:50', '2026-07-28 04:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization_id` bigint UNSIGNED DEFAULT NULL,
  `allowed_grades` json DEFAULT NULL COMMENT '["X", "XI", "XII"]',
  `spesialisasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('aktif','nonaktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `tugas_tambahan_jtm` int NOT NULL DEFAULT '0',
  `pengguna_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `entry_academic_year` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama`, `email`, `no_hp`, `specialization_id`, `allowed_grades`, `spesialisasi`, `alamat`, `status`, `tugas_tambahan_jtm`, `pengguna_id`, `created_at`, `updated_at`, `deleted_at`, `entry_academic_year`) VALUES
(1, NULL, 'Abdul Rouf, S.Pd', 'abdul.rouf@guru.smansago.com', NULL, 1, NULL, 'Ekonomi', NULL, 'aktif', 2, 3, '2026-07-06 06:23:44', '2026-07-06 06:53:52', NULL, '2025/2026'),
(2, NULL, 'Agung Srihartono, S.Pd', 'agung.srihartono@guru.smansago.com', NULL, 2, NULL, 'Seni dan Budaya', NULL, 'aktif', 2, 4, '2026-07-06 06:23:44', '2026-07-06 06:53:52', NULL, '2025/2026'),
(3, NULL, 'Ardjanto, S.Pd', 'ardjanto@guru.smansago.com', NULL, 3, NULL, 'Bahasa Inggris', NULL, 'aktif', 2, 5, '2026-07-06 06:23:45', '2026-07-06 06:53:52', NULL, '2025/2026'),
(4, NULL, 'ARIEF DARMAYANTI, S.Pd', 'arief.darmayanti@guru.smansago.com', NULL, 3, NULL, 'Bahasa Inggris', NULL, 'aktif', 0, 6, '2026-07-06 06:23:45', '2026-07-06 06:53:52', NULL, '2025/2026'),
(5, NULL, 'Arik Andriyani, S.S.', 'arik.andriyani@guru.smansago.com', NULL, 4, NULL, 'Geografi', NULL, 'aktif', 0, 7, '2026-07-06 06:23:45', '2026-07-06 06:53:52', NULL, '2025/2026'),
(6, NULL, 'Djoko Heriyanto, S.Pd, M.Pd', 'djoko.heriyanto@guru.smansago.com', NULL, 5, NULL, 'Pendidikan Jasmani, Olahraga, dan Kesehatan', NULL, 'aktif', 0, 8, '2026-07-06 06:23:45', '2026-07-06 06:53:52', NULL, '2025/2026'),
(7, NULL, 'Endah Wahyuningsih, S.Pd', 'endah.wahyuningsih@guru.smansago.com', NULL, 6, NULL, 'Pendidikan Pancasila', NULL, 'aktif', 2, 9, '2026-07-06 06:23:46', '2026-07-06 06:53:52', NULL, '2025/2026'),
(8, NULL, 'Endang Widayanti, S.Sos', 'endang.widayanti@guru.smansago.com', NULL, 7, NULL, 'Sosiologi', NULL, 'aktif', 2, 10, '2026-07-06 06:23:46', '2026-07-06 06:53:52', NULL, '2025/2026'),
(9, NULL, 'Eri Kriswanti, S.Pd', 'eri.kriswanti@guru.smansago.com', NULL, 8, NULL, 'Fisika', NULL, 'aktif', 2, 11, '2026-07-06 06:23:46', '2026-07-06 06:53:52', NULL, '2025/2026'),
(10, NULL, 'Ervhiendri Ali Akhmad, S.Pd', 'ervhiendri.akhmad@guru.smansago.com', NULL, 5, NULL, 'Pendidikan Jasmani, Olahraga, dan Kesehatan', NULL, 'aktif', 2, 12, '2026-07-06 06:23:46', '2026-07-06 06:53:52', NULL, '2025/2026'),
(11, NULL, 'Heni Setyarini, S.Pd', 'heni.setyarini@guru.smansago.com', NULL, 9, NULL, 'Bahasa Indonesia', NULL, 'aktif', 2, 13, '2026-07-06 06:23:47', '2026-07-06 06:53:52', NULL, '2025/2026'),
(12, NULL, 'Heru Rismawan, S.Pd', 'heru.rismawan@guru.smansago.com', NULL, NULL, NULL, 'Matematika Tingkat Lanjut, Matematika (Umum)', NULL, 'aktif', 2, 14, '2026-07-06 06:23:47', '2026-07-06 06:53:52', NULL, '2025/2026'),
(13, NULL, 'Iis Lestari, S.Kom', 'iis.lestari@guru.smansago.com', NULL, 11, NULL, 'Informatika', NULL, 'aktif', 0, 15, '2026-07-06 06:23:47', '2026-07-06 06:53:52', NULL, '2025/2026'),
(14, NULL, 'Is Imanah, S.Pd, M.Pd', 'is.imanah@guru.smansago.com', NULL, NULL, NULL, 'Kimia, Prakarya dan Kewirausahaan', NULL, 'aktif', 2, 16, '2026-07-06 06:23:47', '2026-07-06 06:53:52', NULL, '2025/2026'),
(15, NULL, 'Joko Widodo, S.Pd', 'joko.widodo@guru.smansago.com', NULL, NULL, NULL, 'Pendidikan Jasmani, Olahraga, dan Kesehatan, Matematika (Umum)', NULL, 'aktif', 2, 17, '2026-07-06 06:23:48', '2026-07-06 06:53:52', NULL, '2025/2026'),
(16, NULL, 'Khoirul Umam, S.Pd', 'khoirul.umam@guru.smansago.com', NULL, 14, NULL, 'Pendidikan Agama Islam dan Budi Pekerti', NULL, 'aktif', 2, 18, '2026-07-06 06:23:48', '2026-07-06 06:53:52', NULL, '2025/2026'),
(17, NULL, 'Lanjar Setyowati, S.Pd', 'lanjar.setyowati@guru.smansago.com', NULL, NULL, NULL, 'Bahasa Indonesia Tingkat Lanjut, Bahasa Inggris Tingkat Lanjut, Bahasa Inggris', NULL, 'aktif', 0, 19, '2026-07-06 06:23:48', '2026-07-06 06:53:52', NULL, '2025/2026'),
(18, NULL, 'Murdananto', 'murdananto@guru.smansago.com', NULL, 16, NULL, 'Bimbingan dan Konseling/Konselor (BP/BK)', NULL, 'aktif', 0, 20, '2026-07-06 06:23:48', '2026-07-06 06:53:52', NULL, '2025/2026'),
(19, NULL, 'Murtini Ningsih, S.Si', 'murtini.ningsih@guru.smansago.com', NULL, NULL, NULL, 'Matematika Tingkat Lanjut, Matematika (Umum)', NULL, 'aktif', 2, 21, '2026-07-06 06:23:49', '2026-07-06 06:53:52', NULL, '2025/2026'),
(20, NULL, 'Oryza Hesak Karismaningtyas, S.Pd', 'oryza.karismaningtyas@guru.smansago.com', NULL, NULL, NULL, 'Prakarya dan Kewirausahaan, Fisika', NULL, 'aktif', 0, 22, '2026-07-06 06:23:49', '2026-07-06 06:53:52', NULL, '2025/2026'),
(21, NULL, 'Puput Rika Harjani, S.Pd', 'puput.harjani@guru.smansago.com', NULL, NULL, NULL, 'Muatan Lokal Bahasa Daerah, Bahasa Inggris', NULL, 'aktif', 2, 23, '2026-07-06 06:23:49', '2026-07-06 06:53:52', NULL, '2025/2026'),
(22, NULL, 'Ratna Suryani, S.Pd', 'ratna.suryani@guru.smansago.com', NULL, 19, NULL, 'Sejarah', NULL, 'aktif', 2, 24, '2026-07-06 06:23:49', '2026-07-06 06:53:52', NULL, '2025/2026'),
(23, NULL, 'Septa Falintina, S.Pd, M.T', 'septa.falintina@guru.smansago.com', NULL, NULL, NULL, 'Kimia, Informatika', NULL, 'aktif', 0, 25, '2026-07-06 06:23:50', '2026-07-06 06:53:52', NULL, '2025/2026'),
(24, NULL, 'Sri Kundarti, S.Pd', 'sri.kundarti@guru.smansago.com', NULL, 1, NULL, 'Ekonomi', NULL, 'aktif', 2, 26, '2026-07-06 06:23:50', '2026-07-06 06:53:52', NULL, '2025/2026'),
(25, NULL, 'Sri Widyastuti, S.Pd.I', 'sri.widyastuti@guru.smansago.com', NULL, 14, NULL, 'Pendidikan Agama Islam dan Budi Pekerti', NULL, 'aktif', 2, 27, '2026-07-06 06:23:50', '2026-07-06 06:53:52', NULL, '2025/2026'),
(26, NULL, 'Sunarno, S.Pd', 'sunarno@guru.smansago.com', NULL, 21, NULL, 'Matematika (Umum)', NULL, 'aktif', 0, 28, '2026-07-06 06:23:51', '2026-07-06 06:53:52', NULL, '2025/2026'),
(27, NULL, 'Susilawati', 'susilawati@guru.smansago.com', NULL, NULL, NULL, 'Bahasa Indonesia, Matematika (Umum)', NULL, 'aktif', 2, 29, '2026-07-06 06:23:51', '2026-07-06 06:53:52', NULL, '2025/2026'),
(28, NULL, 'Syamsudin, S.Pd', 'syamsudin@guru.smansago.com', NULL, 23, NULL, 'Biologi', NULL, 'aktif', 0, 30, '2026-07-06 06:23:51', '2026-07-06 06:53:52', NULL, '2025/2026'),
(29, NULL, 'Teguh, S.Pd', 'teguh@guru.smansago.com', NULL, NULL, NULL, 'Bahasa Indonesia Tingkat Lanjut, Bahasa Indonesia', NULL, 'aktif', 0, 31, '2026-07-06 06:23:51', '2026-07-06 06:53:52', NULL, '2025/2026'),
(30, NULL, 'Tiyastuti Nur Cahyani, S.Pd', 'tiyastuti.cahyani@guru.smansago.com', NULL, NULL, NULL, 'Geografi, Matematika (Umum)', NULL, 'aktif', 2, 32, '2026-07-06 06:23:52', '2026-07-06 06:53:52', NULL, '2025/2026'),
(31, NULL, 'Tutik Mahendra Dewi, S.Pd', 'tutik.dewi@guru.smansago.com', NULL, 23, NULL, 'Biologi', NULL, 'aktif', 0, 33, '2026-07-06 06:23:52', '2026-07-06 06:53:52', NULL, '2025/2026'),
(32, NULL, 'Umi Farichah, S.Pd, M.Pd', 'umi.farichah@guru.smansago.com', NULL, 26, NULL, 'Kimia', NULL, 'aktif', 2, 34, '2026-07-06 06:23:52', '2026-07-06 06:53:52', NULL, '2025/2026'),
(33, NULL, 'Widodo, S.Pd', 'widodo@guru.smansago.com', NULL, NULL, NULL, 'Matematika Tingkat Lanjut, Matematika (Umum)', NULL, 'aktif', 0, 35, '2026-07-06 06:23:52', '2026-07-06 06:53:52', NULL, '2025/2026'),
(36, '123456789', 'wahyu', 'wahyu@guru.smansago.com', '08764756231', 23, '[]', NULL, NULL, 'aktif', 0, NULL, '2026-07-14 23:13:24', '2026-07-14 23:14:15', '2026-07-14 23:14:15', '2025/2026'),
(37, '2003081620260102', 'nama  pengujian,S.Kom', 'nama@guru.smansago.com', '08767846372', NULL, '[]', NULL, 'boyolali', 'aktif', 0, NULL, '2026-07-22 01:25:21', '2026-07-22 01:26:08', '2026-07-22 01:26:08', '2025/2026'),
(38, '200308232020109848', 'nama  pengujian,S.Kom', 'namatestes@guru.smansago.com', '08767846372', NULL, '[]', NULL, NULL, 'aktif', 0, NULL, '2026-07-22 01:54:09', '2026-07-22 01:54:22', '2026-07-22 01:54:22', '2025/2026');

-- --------------------------------------------------------

--
-- Table structure for table `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mata_pelajaran_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru_kelas`
--

INSERT INTO `guru_kelas` (`id`, `guru_id`, `kelas_id`, `created_at`, `updated_at`, `mata_pelajaran_id`) VALUES
(1856, 16, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1857, 25, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1858, 16, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1859, 25, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1860, 16, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1861, 25, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1862, 16, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1863, 25, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1864, 16, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1865, 25, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1866, 16, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1867, 25, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1868, 16, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1869, 25, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1870, 16, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1871, 25, 39, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1872, 16, 40, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1873, 25, 41, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1874, 16, 42, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1875, 25, 43, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1876, 16, 44, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 14),
(1877, 7, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1878, 7, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1879, 7, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1880, 7, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1881, 7, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1882, 7, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1883, 7, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1884, 7, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1885, 7, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1886, 7, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1887, 7, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1888, 7, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 6),
(1889, 29, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1890, 11, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1891, 27, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1892, 29, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1893, 11, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1894, 27, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1895, 29, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1896, 11, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1897, 27, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1898, 29, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1899, 11, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1900, 27, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1901, 29, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1902, 11, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1903, 27, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1904, 29, 39, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1905, 11, 40, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1906, 27, 41, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1907, 29, 42, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1908, 11, 43, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1909, 27, 44, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 9),
(1910, 33, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1911, 26, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1912, 30, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1913, 12, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1914, 15, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1915, 19, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1916, 33, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1917, 26, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1918, 30, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1919, 12, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1920, 15, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1921, 19, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1922, 33, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1923, 26, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1924, 30, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1925, 12, 39, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1926, 15, 40, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1927, 19, 41, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1928, 33, 42, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1929, 26, 43, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1930, 30, 44, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 21),
(1931, 3, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1932, 4, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1933, 17, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1934, 21, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1935, 3, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1936, 4, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1937, 17, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1938, 21, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1939, 3, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1940, 4, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1941, 17, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1942, 21, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1943, 3, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1944, 4, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1945, 17, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1946, 21, 39, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1947, 3, 40, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1948, 4, 41, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1949, 17, 42, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1950, 21, 43, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1951, 3, 44, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 3),
(1952, 6, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1953, 10, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1954, 6, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1955, 10, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1956, 6, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1957, 10, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1958, 6, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1959, 10, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1960, 6, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1961, 10, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1962, 6, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1963, 15, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1964, 10, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1965, 6, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1966, 15, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1967, 10, 39, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1968, 6, 40, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1969, 15, 41, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1970, 10, 42, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1971, 6, 43, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1972, 15, 44, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 5),
(1973, 2, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 2),
(1974, 2, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 2),
(1975, 2, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 2),
(1976, 2, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 2),
(1977, 2, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 2),
(1978, 2, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 2),
(1979, 2, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 2),
(1980, 2, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 2),
(1981, 2, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 2),
(1982, 23, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1983, 13, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1984, 23, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1985, 13, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1986, 23, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1987, 13, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1988, 23, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1989, 13, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1990, 23, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1991, 13, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1992, 23, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1993, 13, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1994, 23, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1995, 13, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1996, 23, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 11),
(1997, 18, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(1998, 18, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(1999, 18, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2000, 18, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2001, 18, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2002, 18, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2003, 18, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2004, 18, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2005, 18, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2006, 18, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2007, 18, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2008, 18, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 16),
(2009, 21, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 31),
(2010, 21, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 31),
(2011, 21, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 31),
(2012, 21, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 31),
(2013, 22, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2014, 22, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2015, 22, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2016, 22, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2017, 22, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2018, 22, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2019, 22, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2020, 22, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2021, 22, 39, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2022, 22, 40, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2023, 22, 41, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2024, 22, 42, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 19),
(2025, 28, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2026, 31, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2027, 20, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2028, 32, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2029, 9, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2030, 14, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2031, 28, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2032, 5, 24, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 4),
(2033, 1, 25, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2034, 24, 26, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2035, 8, 27, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 7),
(2036, 5, 28, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 4),
(2037, 1, 29, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2038, 24, 30, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2039, 20, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2040, 9, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2041, 20, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2042, 9, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2043, 20, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2044, 9, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2045, 20, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2046, 9, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2047, 20, 39, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2048, 9, 40, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2049, 20, 41, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2050, 9, 42, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 8),
(2051, 32, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2052, 14, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2053, 32, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2054, 14, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2055, 32, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2056, 14, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2057, 32, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2058, 14, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2059, 32, 39, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2060, 14, 40, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2061, 32, 41, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2062, 14, 42, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 26),
(2063, 31, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2064, 28, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2065, 31, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2066, 28, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2067, 31, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2068, 28, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2069, 31, 37, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2070, 28, 38, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2071, 31, 39, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2072, 28, 40, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2073, 31, 41, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2074, 28, 42, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2075, 31, 43, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 23),
(2076, 1, 31, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2077, 24, 32, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2078, 1, 33, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2079, 24, 34, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2080, 1, 35, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2081, 24, 36, '2026-07-09 21:14:48', '2026-07-09 21:14:48', 1),
(2082, 1, 37, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 1),
(2083, 24, 38, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 1),
(2084, 1, 39, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 1),
(2085, 24, 40, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 1),
(2086, 8, 31, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 7),
(2087, 8, 32, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 7),
(2088, 8, 33, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 7),
(2089, 8, 34, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 7),
(2090, 8, 35, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 7),
(2091, 8, 36, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 7),
(2092, 5, 31, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2093, 5, 32, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2094, 30, 33, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2095, 5, 34, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2096, 30, 35, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2097, 5, 36, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2098, 30, 37, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2099, 5, 38, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2100, 30, 39, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2101, 5, 40, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 4),
(2102, 12, 31, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2103, 19, 32, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2104, 33, 33, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2105, 12, 34, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2106, 19, 35, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2107, 33, 36, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2108, 12, 37, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2109, 19, 38, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2110, 33, 39, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2111, 12, 40, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2112, 19, 41, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2113, 33, 42, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2114, 12, 43, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2115, 19, 44, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 27),
(2116, 17, 31, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 29),
(2117, 17, 32, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 29),
(2118, 17, 33, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 29),
(2119, 29, 34, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 29),
(2120, 17, 35, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 29),
(2121, 29, 36, '2026-07-09 21:14:49', '2026-07-09 21:14:49', 29);

-- --------------------------------------------------------

--
-- Table structure for table `guru_mata_pelajaran`
--

CREATE TABLE `guru_mata_pelajaran` (
  `id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru_mata_pelajaran`
--

INSERT INTO `guru_mata_pelajaran` (`id`, `guru_id`, `mata_pelajaran_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(2, 2, 2, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(3, 3, 3, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(4, 4, 3, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(5, 5, 4, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(6, 6, 5, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(7, 7, 6, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(8, 8, 7, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(9, 9, 8, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(10, 10, 5, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(11, 11, 9, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(12, 12, 27, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(13, 12, 21, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(14, 13, 11, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(15, 14, 26, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(16, 14, 28, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(17, 15, 5, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(18, 15, 21, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(19, 16, 14, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(20, 17, 29, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(21, 17, 30, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(22, 17, 3, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(23, 18, 16, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(24, 19, 27, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(25, 19, 21, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(26, 20, 28, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(27, 20, 8, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(28, 21, 31, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(29, 21, 3, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(30, 22, 19, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(31, 23, 26, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(32, 23, 11, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(33, 24, 1, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(34, 25, 14, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(35, 26, 21, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(36, 27, 9, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(37, 27, 21, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(38, 28, 23, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(39, 29, 29, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(40, 29, 9, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(41, 30, 4, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(42, 30, 21, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(43, 31, 23, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(44, 32, 26, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(45, 33, 27, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(46, 33, 21, '2026-07-09 21:09:08', '2026-07-09 21:09:08'),
(47, 38, 9, '2026-07-22 01:54:09', '2026-07-22 01:54:09'),
(48, 38, 29, '2026-07-22 01:54:09', '2026-07-22 01:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `invoice_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `xendit_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` decimal(15,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('unpaid','partial','paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_level` enum('X','XI','XII') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `major` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homeroom_teacher_id` bigint UNSIGNED DEFAULT NULL,
  `academic_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_students` int NOT NULL DEFAULT '40',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `name`, `grade_level`, `major`, `homeroom_teacher_id`, `academic_year`, `max_students`, `created_at`, `updated_at`) VALUES
(24, 'X 1', 'X', 'Umum', 27, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(25, 'X 2', 'X', 'Umum', 22, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(26, 'X 3', 'X', 'Umum', 2, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(27, 'X 4', 'X', 'Umum', 19, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(28, 'X 5', 'X', 'Umum', 9, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(29, 'X 6', 'X', 'Umum', 16, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(30, 'X 7', 'X', 'Umum', 30, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(31, 'XI F 1', 'XI', 'Fase F', 15, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(32, 'XI F 2.1', 'XI', 'Fase F', 7, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(33, 'XI F 2.2', 'XI', 'Fase F', 12, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(34, 'XI F 3.1', 'XI', 'Fase F', 11, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(35, 'XI F 3.2', 'XI', 'Fase F', 21, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(36, 'XI F 4.1', 'XI', 'Fase F', 1, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(37, 'XI F 4.2', 'XI', 'Fase F', 25, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(38, 'XII F 1', 'XII', 'Fase F', 32, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(39, 'XII F 2.1', 'XII', 'Fase F', 14, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(40, 'XII F 2.2', 'XII', 'Fase F', 3, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(41, 'XII F 3.1', 'XII', 'Fase F', 10, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(42, 'XII F 3.2', 'XII', 'Fase F', 8, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(43, 'XII F 4.1', 'XII', 'Fase F', 24, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-28 00:54:03'),
(44, 'XII F 4.2', 'XII', 'Fase F', 21, '2025/2026', 36, '2026-07-07 18:58:39', '2026-07-09 05:34:52'),
(66, 'X 8', 'X', 'Fase E', NULL, '2025/2026', 36, '2026-08-15 11:40:29', '2026-08-15 11:40:29'),
(67, 'X 1', 'X', 'Umum', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(68, 'X 2', 'X', 'Umum', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(69, 'X 3', 'X', 'Umum', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(70, 'X 4', 'X', 'Umum', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(71, 'X 5', 'X', 'Umum', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(72, 'X 6', 'X', 'Umum', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(73, 'X 7', 'X', 'Umum', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(74, 'X 8', 'X', 'Fase E', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(75, 'XI F 1', 'XI', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(76, 'XI F 2.1', 'XI', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(77, 'XI F 2.2', 'XI', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(78, 'XI F 3.1', 'XI', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(79, 'XI F 3.2', 'XI', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(80, 'XI F 4.1', 'XI', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(81, 'XI F 4.2', 'XI', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(82, 'XII F 1', 'XII', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(83, 'XII F 2.1', 'XII', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(84, 'XII F 2.2', 'XII', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(85, 'XII F 3.1', 'XII', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(86, 'XII F 3.2', 'XII', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(87, 'XII F 4.1', 'XII', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(88, 'XII F 4.2', 'XII', 'Fase F', NULL, '2026/2027', 36, '2026-08-15 11:52:56', '2026-08-15 11:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `master_kelas`
--

CREATE TABLE `master_kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entry_academic_year` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_kelas`
--

INSERT INTO `master_kelas` (`id`, `name`, `grade_level`, `major`, `created_at`, `updated_at`, `entry_academic_year`) VALUES
(24, 'X 1', 'X', 'Umum', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(25, 'X 2', 'X', 'Umum', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(26, 'X 3', 'X', 'Umum', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(27, 'X 4', 'X', 'Umum', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(28, 'X 5', 'X', 'Umum', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(29, 'X 6', 'X', 'Umum', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(30, 'X 7', 'X', 'Umum', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(31, 'X 8', 'X', 'Fase E', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(32, 'XI F 1', 'XI', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(33, 'XI F 2.1', 'XI', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(34, 'XI F 2.2', 'XI', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(35, 'XI F 3.1', 'XI', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(36, 'XI F 3.2', 'XI', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(37, 'XI F 4.1', 'XI', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(38, 'XI F 4.2', 'XI', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(39, 'XII F 1', 'XII', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(40, 'XII F 2.1', 'XII', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(41, 'XII F 2.2', 'XII', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(42, 'XII F 3.1', 'XII', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(43, 'XII F 3.2', 'XII', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(44, 'XII F 4.1', 'XII', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(45, 'XII F 4.2', 'XII', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tingkat` enum('X','XI','XII') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `beban_jp` int NOT NULL DEFAULT '4',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entry_academic_year` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `kode`, `nama`, `deskripsi`, `tingkat`, `status`, `beban_jp`, `created_at`, `updated_at`, `entry_academic_year`) VALUES
(1, 'EKO-EZU', 'Ekonomi', 'Mata Pelajaran Ekonomi', NULL, 'aktif', 5, '2026-07-06 06:23:44', '2026-07-06 06:53:52', '2025/2026'),
(2, 'SEN-CIf', 'Seni dan Budaya', 'Mata Pelajaran Seni dan Budaya', NULL, 'aktif', 2, '2026-07-06 06:23:44', '2026-07-22 03:59:52', '2025/2026'),
(3, 'BAH-SY0', 'Bahasa Inggris', 'Mata Pelajaran Bahasa Inggris', NULL, 'aktif', 2, '2026-07-06 06:23:44', '2026-07-22 03:59:52', '2025/2026'),
(4, 'GEO-VNP', 'Geografi', 'Mata Pelajaran Geografi', NULL, 'aktif', 5, '2026-07-06 06:23:45', '2026-07-06 06:53:52', '2025/2026'),
(5, 'PEN-snV', 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'Mata Pelajaran Pendidikan Jasmani, Olahraga, dan Kesehatan', NULL, 'aktif', 2, '2026-07-06 06:23:45', '2026-07-22 03:59:52', '2025/2026'),
(6, 'PEN-3or', 'Pendidikan Pancasila', 'Mata Pelajaran Pendidikan Pancasila', NULL, 'aktif', 2, '2026-07-06 06:23:45', '2026-07-22 03:59:52', '2025/2026'),
(7, 'SOS-nbT', 'Sosiologi', 'Mata Pelajaran Sosiologi', NULL, 'aktif', 5, '2026-07-06 06:23:46', '2026-07-06 06:53:52', '2025/2026'),
(8, 'FIS-2MZ', 'Fisika', 'Mata Pelajaran Fisika', NULL, 'aktif', 5, '2026-07-06 06:23:46', '2026-07-06 06:53:52', '2025/2026'),
(9, 'BAH-G47', 'Bahasa Indonesia', 'Mata Pelajaran Bahasa Indonesia', NULL, 'aktif', 3, '2026-07-06 06:23:46', '2026-07-22 03:59:52', '2025/2026'),
(11, 'INF-T6P', 'Informatika', 'Mata Pelajaran Informatika', NULL, 'aktif', 2, '2026-07-06 06:23:47', '2026-07-22 03:59:52', '2025/2026'),
(14, 'PEN-bCv', 'Pendidikan Agama Islam dan Budi Pekerti', 'Mata Pelajaran Pendidikan Agama Islam dan Budi Pekerti', NULL, 'aktif', 2, '2026-07-06 06:23:48', '2026-07-22 03:59:52', '2025/2026'),
(16, 'BIM-q63', 'Bimbingan dan Konseling/Konselor (BP/BK)', 'Mata Pelajaran Bimbingan dan Konseling/Konselor (BP/BK)', NULL, 'aktif', 2, '2026-07-06 06:23:48', '2026-07-22 03:59:52', '2025/2026'),
(19, 'SEJ-qta', 'Sejarah', 'Mata Pelajaran Sejarah', NULL, 'aktif', 2, '2026-07-06 06:23:49', '2026-07-22 03:59:52', '2025/2026'),
(21, 'MAT-LVh', 'Matematika (Umum)', 'Mata Pelajaran Matematika (Umum)', NULL, 'aktif', 3, '2026-07-06 06:23:50', '2026-07-22 03:59:52', '2025/2026'),
(23, 'BIO-UKC', 'Biologi', 'Mata Pelajaran Biologi', NULL, 'aktif', 5, '2026-07-06 06:23:51', '2026-07-06 06:53:52', '2025/2026'),
(26, 'KIM-Ksw', 'Kimia', 'Mata Pelajaran Kimia', NULL, 'aktif', 5, '2026-07-06 06:23:52', '2026-07-06 06:53:52', '2025/2026'),
(27, 'MPL-EA3FC', 'Matematika Tingkat Lanjut', NULL, NULL, 'aktif', 4, '2026-07-09 21:09:08', '2026-07-09 21:09:08', '2025/2026'),
(28, 'MPL-94DF7', 'Prakarya dan Kewirausahaan', NULL, NULL, 'aktif', 4, '2026-07-09 21:09:08', '2026-07-09 21:09:08', '2025/2026'),
(29, 'MPL-70697', 'Bahasa Indonesia Tingkat Lanjut', NULL, NULL, 'aktif', 4, '2026-07-09 21:09:08', '2026-07-09 21:09:08', '2025/2026'),
(30, 'MPL-4F2F3', 'Bahasa Inggris Tingkat Lanjut', NULL, NULL, 'aktif', 4, '2026-07-09 21:09:08', '2026-07-09 21:09:08', '2025/2026'),
(31, 'MPL-265B6', 'Muatan Lokal Bahasa Daerah', NULL, NULL, 'aktif', 2, '2026-07-09 21:09:08', '2026-07-22 03:59:52', '2025/2026');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` enum('pdf','video','link','document','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'document',
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `subject_id`, `kelas_id`, `title`, `description`, `type`, `file_path`, `url`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(1, 11, 37, 'tes upload materi', 'tes upload', 'pdf', 'materi/QSZm7QCojJ1VHNh6wzFcSDMsZcv2aQO2xn4oH9ij.pdf', NULL, 13, '2026-07-28 03:50:11', '2026-07-28 03:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_12_092142_create_students_table', 1),
(5, '2026_01_12_092759_create_invoices_table', 1),
(6, '2026_01_12_102013_create_payments_table', 1),
(7, '2026_01_12_121925_create_settings_table', 1),
(8, '2026_01_12_144528_add_batch_id_to_invoices_table', 1),
(9, '2026_01_12_155334_add_xendit_fields_to_invoices_table', 1),
(10, '2026_01_13_030201_create_courses_table', 1),
(11, '2026_01_13_033132_create_teachers_table', 1),
(12, '2026_01_13_033139_create_class_rooms_table', 1),
(13, '2026_01_13_033143_create_subjects_table', 1),
(14, '2026_01_13_033151_create_enrollments_table', 1),
(15, '2026_01_13_033159_create_assignments_table', 1),
(16, '2026_01_13_033203_create_submissions_table', 1),
(17, '2026_01_13_033207_create_grades_table', 1),
(18, '2026_01_13_033211_create_materials_table', 1),
(19, '2026_01_13_033214_create_attendances_table', 1),
(20, '2026_01_13_033217_add_elearning_fields_to_students_table', 1),
(21, '2026_01_13_064808_remove_status_from_class_rooms_table', 1),
(22, '2026_01_13_105327_create_attendance_sessions_table', 1),
(23, '2026_01_13_110105_create_personal_access_tokens_table', 1),
(24, '2026_01_13_161500_add_type_and_answer_key_to_assignments_table', 1),
(25, '2026_01_27_215817_add_acc_batch_id_to_students_and_enrollments', 1),
(26, '2026_01_27_220648_add_drive_link_to_submissions_table', 1),
(27, '2026_01_28_050640_add_file_details_to_submissions_table', 1),
(28, '2026_05_10_140314_create_submission_appeals_table', 1),
(29, '2026_05_10_140314_create_submission_recoveries_table', 1),
(30, '2026_05_10_144516_add_duration_hours_to_submission_recoveries_table', 1),
(31, '2026_05_10_160301_add_native_upload_fields_to_submissions_table', 1),
(32, '2026_06_07_125438_create_kelas_table', 1),
(33, '2026_06_20_210430_add_specialization_id_to_guru_table', 1),
(34, '2026_06_21_084243_create_guru_kelas_table', 1),
(35, '2026_06_21_135225_add_max_score_to_tugas_table', 1),
(36, '2026_06_23_160000_add_kategori_alasan_and_bukti_pendukung_to_pengajuan_banding_table', 1),
(37, '2026_06_23_165923_add_tanggapan_guru_to_pengajuan_banding_table', 1),
(38, '2026_06_24_070718_add_mata_pelajaran_id_to_guru_kelas_table', 1),
(39, '2026_06_25_190000_modify_siswa_status_column', 1),
(40, '2026_06_26_053013_create_activity_logs_table', 1),
(41, '2026_06_26_163615_add_prasyarat_materi_id_to_tugas_table', 1),
(42, '2026_06_26_163617_create_pelacakan_materi_table', 1),
(43, '2026_06_27_082207_add_plotting_fields_to_guru_and_mapel', 1),
(44, '2026_06_27_091000_create_mutasi_siswa_table', 1),
(45, '2026_06_27_094402_alter_status_enum_on_siswa_table', 1),
(46, '2026_06_27_170549_migrate_materi_data_and_update_pelacakan', 1),
(47, '2026_06_27_174857_add_allowed_grades_to_guru_table', 1),
(48, '2026_06_27_204149_add_tahun_lulus_to_siswa_table', 1),
(49, '2026_06_28_000943_add_kelas_id_to_tugas_table', 1),
(50, '2026_07_01_135352_modify_siswa_and_guru_fields_for_real_data', 1),
(51, '2026_07_02_140558_add_beban_jp_to_mata_pelajaran_table', 1),
(52, '2026_07_06_150249_modify_major_column_in_kelas_table', 2),
(53, '2026_07_06_165827_add_kelas_id_to_materials_table', 3),
(54, '2026_07_08_013445_create_master_kelas_table', 4),
(55, '2026_07_08_215129_add_soft_deletes_to_critical_tables', 5),
(56, '2026_07_09_085445_create_riwayat_kelas_siswa_table', 6),
(57, '2026_07_09_120031_add_surat_mutasi_to_mutasi_siswa_table', 7),
(58, '2026_07_10_040820_create_guru_mata_pelajaran_table', 8),
(59, '2026_07_10_040839_seed_atomic_subjects_and_mapping', 8),
(60, '2026_07_12_235308_create_password_change_histories_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_siswa`
--

CREATE TABLE `mutasi_siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `jenis_mutasi` enum('masuk','keluar','dikeluarkan','mengundurkan diri') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'keluar',
  `tanggal_mutasi` date NOT NULL,
  `keterangan_sekolah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Asal sekolah jika masuk, tujuan jika keluar',
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `surat_mutasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_change_histories`
--

CREATE TABLE `password_change_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `pengguna_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `payment_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` enum('cash','transfer','qris') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelacakan_materi`
--

CREATE TABLE `pelacakan_materi` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `materi_id` bigint UNSIGNED NOT NULL,
  `tanggal_selesai` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemulihan_akses`
--

CREATE TABLE `pemulihan_akses` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `status_pemulihan` enum('aktif','selesai','expired') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `durasi_jam` int NOT NULL DEFAULT '48',
  `tugas_id` bigint UNSIGNED DEFAULT NULL,
  `mulai_pemulihan` timestamp NULL DEFAULT NULL,
  `batas_pemulihan` timestamp NULL DEFAULT NULL,
  `selesai_pemulihan` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemulihan_akses`
--

INSERT INTO `pemulihan_akses` (`id`, `siswa_id`, `mata_pelajaran_id`, `status_pemulihan`, `durasi_jam`, `tugas_id`, `mulai_pemulihan`, `batas_pemulihan`, `selesai_pemulihan`, `created_at`, `updated_at`) VALUES
(2, 500, 11, 'aktif', 48, 1, '2026-07-28 04:38:51', '2026-07-30 04:38:51', NULL, '2026-07-28 04:38:51', '2026-07-28 04:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_banding`
--

CREATE TABLE `pengajuan_banding` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_alasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_pendukung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggapan_guru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('ditinjau','diterima','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ditinjau',
  `disetujui_oleh` bigint UNSIGNED DEFAULT NULL,
  `tanggal_persetujuan` timestamp NULL DEFAULT NULL,
  `tugas_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_banding`
--

INSERT INTO `pengajuan_banding` (`id`, `siswa_id`, `mata_pelajaran_id`, `alasan`, `kategori_alasan`, `bukti_pendukung`, `tanggapan_guru`, `status`, `disetujui_oleh`, `tanggal_persetujuan`, `tugas_id`, `created_at`, `updated_at`) VALUES
(1, 500, 11, 'tes', 'Lainnya', 'banding_bukti/lRoW4Cyc1D0ULctT6IwjgDcG8DUerGjuuEwY7xxT.pdf', NULL, 'diterima', NULL, NULL, NULL, '2026-07-28 04:11:16', '2026-07-28 04:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guru','siswa') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@admin.smansago.com', NULL, '$2y$12$FSbmUq/YmGyG1t3XhdvREutNAbKkpBy4UMwuG.jVX7oUaJFPzB9X2', 'admin', NULL, '2026-07-06 06:23:43', '2026-08-15 11:23:58'),
(3, 'Abdul Rouf, S.Pd', 'abdul.rouf@guru.smansago.com', NULL, '$2y$12$1fYvRUPXmJb5cvjGygtqie9fxmOuaqFhzv.NvaxvtzkYwVgQNQHX6', 'guru', NULL, '2026-07-06 06:23:44', '2026-07-09 07:33:11'),
(4, 'Agung Srihartono, S.Pd', 'agung.srihartono@guru.smansago.com', NULL, '$2y$12$VdUst89FrwYnxODaOTyzjemwHsHmJqqodQw8Nd2.IsGt0HtVc0fkW', 'guru', NULL, '2026-07-06 06:23:44', '2026-07-09 07:41:51'),
(5, 'Ardjanto, S.Pd', 'ardjanto@guru.smansago.com', NULL, '$2y$12$Yj0s7jNzSUco9nEyzZD1f.JYHHIhgD9iSPbggJhdbti4m8Y1HEtDa', 'guru', NULL, '2026-07-06 06:23:45', '2026-07-06 06:23:45'),
(6, 'ARIEF DARMAYANTI, S.Pd', 'arief.darmayanti@guru.smansago.com', NULL, '$2y$12$.YFqDNwEE6NvmR3zC1bpzeh/fn.Q9wTntzz183NpW/mDzUAKbJ2d2', 'guru', NULL, '2026-07-06 06:23:45', '2026-07-06 06:23:45'),
(7, 'Arik Andriyani, S.S.', 'arik.andriyani@guru.smansago.com', NULL, '$2y$12$abJbHmB1q2nDgVT1wlP.Me/sEg0mpoZ/mp3/R1Y7K1Jch.5RIEYU.', 'guru', NULL, '2026-07-06 06:23:45', '2026-07-06 06:23:45'),
(8, 'Djoko Heriyanto, S.Pd, M.Pd', 'djoko.heriyanto@guru.smansago.com', NULL, '$2y$12$al1y72ZSZeED2TdioQQyHeW/sRDu5ah6xzO8B/L6df6XpMtMv/Xje', 'guru', NULL, '2026-07-06 06:23:45', '2026-07-06 06:23:45'),
(9, 'Endah Wahyuningsih, S.Pd', 'endah.wahyuningsih@guru.smansago.com', NULL, '$2y$12$xyNoVqEHQ0F3BQBKWLj9DuaJabNSjZSK/XWYHyFFOaqw3jKb39fTi', 'guru', NULL, '2026-07-06 06:23:46', '2026-07-06 06:23:46'),
(10, 'Endang Widayanti, S.Sos', 'endang.widayanti@guru.smansago.com', NULL, '$2y$12$CYThYhyDv6Y0BzthK8NbI.QNDMcPNy9CJxXLazKCQlNXTn4jsOloq', 'guru', NULL, '2026-07-06 06:23:46', '2026-07-06 06:23:46'),
(11, 'Eri Kriswanti, S.Pd', 'eri.kriswanti@guru.smansago.com', NULL, '$2y$12$jNBoKLTFFG3WU.y4JmJGweVin90z3RmpwEQgRSuJ.EqwYC38CvQDS', 'guru', NULL, '2026-07-06 06:23:46', '2026-07-06 06:23:46'),
(12, 'Ervhiendri Ali Akhmad, S.Pd', 'ervhiendri.akhmad@guru.smansago.com', NULL, '$2y$12$5khZ255fwX0QbpfgbLgw1OUxJJI8Afn92sfKwmOenjPgwctdsIhIK', 'guru', NULL, '2026-07-06 06:23:46', '2026-07-06 06:23:46'),
(13, 'Heni Setyarini, S.Pd', 'heni.setyarini@guru.smansago.com', NULL, '$2y$12$0JpnjztmwbgMEcy52N9KJueOfFqhEXm6XQ/I8hMLFe/gTibDiXsoC', 'guru', NULL, '2026-07-06 06:23:47', '2026-07-14 22:28:34'),
(14, 'Heru Rismawan, S.Pd', 'heru.rismawan@guru.smansago.com', NULL, '$2y$12$ph7.uJutwlqvXM.G40l.1..ramWPpo3VErI/X3KnK8rk31YrDd7hW', 'guru', NULL, '2026-07-06 06:23:47', '2026-07-06 06:23:47'),
(15, 'Iis Lestari, S.Kom', 'iis.lestari@guru.smansago.com', NULL, '$2y$12$X1r8WITnbH8v4bJjY4pV5.OhsK2S1PeImS0YOob2OQ.z.TcCWe/Ni', 'guru', NULL, '2026-07-06 06:23:47', '2026-07-28 04:14:18'),
(16, 'Is Imanah, S.Pd, M.Pd', 'is.imanah@guru.smansago.com', NULL, '$2y$12$RJhQT88Jleupy2pDSDY8.eYQ4xFCph1Q9hgSUqINb.DL4Oxx3d3jW', 'guru', NULL, '2026-07-06 06:23:47', '2026-07-06 06:23:47'),
(17, 'Joko Widodo, S.Pd', 'joko.widodo@guru.smansago.com', NULL, '$2y$12$FR.7Eyv4vuJ58cPmy1dag.sgcy4GhtppTV6c5E7/WHdPr0DfqX2EG', 'guru', NULL, '2026-07-06 06:23:48', '2026-07-12 17:42:59'),
(18, 'Khoirul Umam, S.Pd', 'khoirul.umam@guru.smansago.com', NULL, '$2y$12$RlzEuiQoBl7tsi.Nctb4WO/Yp0DhMSfjSvzu0TaTLM.DpN5dNnMg2', 'guru', NULL, '2026-07-06 06:23:48', '2026-07-06 06:23:48'),
(19, 'Lanjar Setyowati, S.Pd', 'lanjar.setyowati@guru.smansago.com', NULL, '$2y$12$Vw72OhEsI8CBsRxaMI0Ade2sd4.ZyZdBt7EaA6S.6.Wfafr1/RaHy', 'guru', NULL, '2026-07-06 06:23:48', '2026-07-06 06:23:48'),
(20, 'Murdananto', 'murdananto@guru.smansago.com', NULL, '$2y$12$R8oN5CTAL2IaQhkRMvWRq.AZgmqS2szxU9PJRYJpVorDMd16NgOBm', 'guru', NULL, '2026-07-06 06:23:48', '2026-07-06 06:23:48'),
(21, 'Murtini Ningsih, S.Si', 'murtini.ningsih@guru.smansago.com', NULL, '$2y$12$5HE80tmS55VBjgZTDRnZku8vsfMP/ab/407VltZDPpHhElOD5nEQC', 'guru', NULL, '2026-07-06 06:23:49', '2026-07-06 06:23:49'),
(22, 'Oryza Hesak Karismaningtyas, S.Pd', 'oryza.karismaningtyas@guru.smansago.com', NULL, '$2y$12$iR0vaISSoMev.GB.JGqvyeBgLOa4judtJn9LBeKtRKWKuR6DV2pLm', 'guru', NULL, '2026-07-06 06:23:49', '2026-07-06 06:23:49'),
(23, 'Puput Rika Harjani, S.Pd', 'puput.harjani@guru.smansago.com', NULL, '$2y$12$453Qb1ipKQK8s8XLXk0LbeIBS3arlomZxhi5w45G9NYc.iV8FuPoe', 'guru', NULL, '2026-07-06 06:23:49', '2026-07-06 06:23:49'),
(24, 'Ratna Suryani, S.Pd', 'ratna.suryani@guru.smansago.com', NULL, '$2y$12$16JdxGo5UjTkr.RRwVA7IOq8UMwzpjYLiBgFiduorJo0a4rlI5gyO', 'guru', NULL, '2026-07-06 06:23:49', '2026-07-06 06:23:49'),
(25, 'Septa Falintina, S.Pd, M.T', 'septa.falintina@guru.smansago.com', NULL, '$2y$12$ofZw0xwuO9sq8DKXYwpLP.5nZKNCS6KXjCUOlwZPLf/9f/eUkWz3u', 'guru', NULL, '2026-07-06 06:23:50', '2026-07-06 06:23:50'),
(26, 'Sri Kundarti, S.Pd', 'sri.kundarti@guru.smansago.com', NULL, '$2y$12$EZhpqYyHU7vW6e4LrYWiXe9GYoKpYY22PVJOTsX4ZmIUApL/ObHFG', 'guru', NULL, '2026-07-06 06:23:50', '2026-07-06 06:23:50'),
(27, 'Sri Widyastuti, S.Pd.I', 'sri.widyastuti@guru.smansago.com', NULL, '$2y$12$ufTXyswjCYEmDFcQM6oh9.qAxCUS/AphEvg9zOGvr61HpQ5OTDOHm', 'guru', NULL, '2026-07-06 06:23:50', '2026-07-06 06:23:50'),
(28, 'Sunarno, S.Pd', 'sunarno@guru.smansago.com', NULL, '$2y$12$9Pe5FnCOfq3slK8.Rlvt6uj1OyUH0doM0.V2W9Hw.1t12.MymUO2G', 'guru', NULL, '2026-07-06 06:23:51', '2026-07-06 06:23:51'),
(29, 'Susilawati', 'susilawati@guru.smansago.com', NULL, '$2y$12$q63UF0gMXBeoIuLpb/hRCOVDEFIyfs8qnpI/Fmnbua2MVbK71HX1i', 'guru', NULL, '2026-07-06 06:23:51', '2026-07-06 06:23:51'),
(30, 'Syamsudin, S.Pd', 'syamsudin@guru.smansago.com', NULL, '$2y$12$jkS8T8WSK6OEq.rKWyJvJeIywnZcFYICHYeYLYQX655s/gSLxs4XK', 'guru', NULL, '2026-07-06 06:23:51', '2026-07-06 06:23:51'),
(31, 'Teguh, S.Pd', 'teguh@guru.smansago.com', NULL, '$2y$12$s2oBe6PIhiQOeVW1ip4fC.H88ZoKpTcdh5.6.XN.j67pDd454JJh6', 'guru', NULL, '2026-07-06 06:23:51', '2026-07-06 06:23:51'),
(32, 'Tiyastuti Nur Cahyani, S.Pd', 'tiyastuti.cahyani@guru.smansago.com', NULL, '$2y$12$.0./IzqJttyXJ5q/iV9sAuE2yorsRbksPNeQNdAQwe1rlAY79SaZ2', 'guru', NULL, '2026-07-06 06:23:52', '2026-07-06 06:23:52'),
(33, 'Tutik Mahendra Dewi, S.Pd', 'tutik.dewi@guru.smansago.com', NULL, '$2y$12$j8c6i6iGgY8D8Z7VSOJEFekPBn./C.miDBvvJkRYANkM1Jya.H9uK', 'guru', NULL, '2026-07-06 06:23:52', '2026-07-06 06:23:52'),
(34, 'Umi Farichah, S.Pd, M.Pd', 'umi.farichah@guru.smansago.com', NULL, '$2y$12$8ymAafTlxW9A84vA9tptYu/c35HGV9hS8wXflVyN4ZbwwY801/5h2', 'guru', NULL, '2026-07-06 06:23:52', '2026-07-06 06:23:52'),
(35, 'Widodo, S.Pd', 'widodo@guru.smansago.com', NULL, '$2y$12$gw1KVOJx1ntCLBeFc8QQDe56WlLcdx68WWhmW9w/V6X8M66Np3e2q', 'guru', NULL, '2026-07-06 06:23:52', '2026-07-06 06:23:52'),
(36, 'AKRIMA NAYLA AMIRA AGHNI', 'akrima.aghni@siswa.smansago.com', NULL, '$2y$12$8OCieJz/cL4TSf7KKFRxSOdo0S81ek8WSt2pbA5GIEW59iqkjwWsK', 'siswa', NULL, '2026-07-06 06:23:53', '2026-07-12 09:33:28'),
(37, 'ANIS PUTRI RAHMADANI', 'anis.rahmadani@siswa.smansago.com', NULL, '$2y$12$NplWHvkDBDloWtl/cUE1eOUyoRkGVjWo2KUuYik25l3hMfZJ0lEFG', 'siswa', NULL, '2026-07-06 06:23:53', '2026-07-12 13:21:29'),
(38, 'ARIF EVAN NUR ROHMAT', 'arif.rohmat@siswa.smansago.com', NULL, '$2y$12$QPq5NcxMxAz1h2RG9Pv21OvZL8m.gozjazMAnG8zZYVJiIZwKtvhS', 'siswa', NULL, '2026-07-06 06:23:53', '2026-07-06 06:23:53'),
(39, 'AULIA AZZAHRA', 'aulia.azzahra@siswa.smansago.com', NULL, '$2y$12$Tf4vM8Z4SO67jny5LFWKlONgyGbAKsNnW9rJvJwKTGTMV6fDWq.7G', 'siswa', NULL, '2026-07-06 06:23:53', '2026-07-12 16:21:17'),
(40, 'BRILLIANT ATAINA ZULHIJA', 'brilliant.zulhija@siswa.smansago.com', NULL, '$2y$12$LIYedzKkrDquBdCeXQTdjudwAnWppbe.K9yTACqb6ksbaft2.crU.', 'siswa', NULL, '2026-07-06 06:23:54', '2026-07-06 06:23:54'),
(41, 'DEFAN DRIAN RIFAL KANDELA', 'defan.kandela@siswa.smansago.com', NULL, '$2y$12$GiYrOI1M.4iSs2.GAU975OxRXJu/OZfFWG.bQGOXUcCQnjpQiMDvy', 'siswa', NULL, '2026-07-06 06:23:54', '2026-07-06 06:23:54'),
(42, 'DIAN AYUK SETIANINGSIH', 'dian.setianingsih@siswa.smansago.com', NULL, '$2y$12$JBUIOhAKv.YN7TvME4UnGe4XmES1qRO/B2T63OxAwZYSgmXxeHNmq', 'siswa', NULL, '2026-07-06 06:23:54', '2026-07-06 06:23:54'),
(43, 'EKA SELVIANA', 'eka.selviana@siswa.smansago.com', NULL, '$2y$12$0WOHXfoJpBYUZla9xIvrb.R7UjgZnxUp6kAC/fXUNcnvm0uwnHc4m', 'siswa', NULL, '2026-07-06 06:23:54', '2026-07-06 06:23:54'),
(44, 'FADILA ALTHEA UFAIRA PUTRI', 'fadila.putri@siswa.smansago.com', NULL, '$2y$12$ObG7j/Qso3QHn.Q1/bOogOgInBlCn2xo.WOf29YUs7pwJSPpN8x6C', 'siswa', NULL, '2026-07-06 06:23:55', '2026-07-06 06:23:55'),
(45, 'FAREL WAHYU WIBOWO', 'farel.wibowo@siswa.smansago.com', NULL, '$2y$12$S5zic09xoLpzF8VAvo4NsOulo73NndsOI77yQ2a.dLZG7pcE1RXUO', 'siswa', NULL, '2026-07-06 06:23:55', '2026-07-06 06:23:55'),
(46, 'GALANG ADITYA NUGROHO', 'galang.nugroho@siswa.smansago.com', NULL, '$2y$12$V69Ly6SkKVmcyP0ylRVZVOqUgErDLZVJGZGBGFxvI7jVoyf/drkLK', 'siswa', NULL, '2026-07-06 06:23:55', '2026-07-06 06:23:55'),
(47, 'GRACIA MAYLLANE PUTRI LEDO', 'gracia.ledo@siswa.smansago.com', NULL, '$2y$12$3I01MA2wF1FlqjL72tnfkeqEjR8I2nu8WQqYM0a.Q3xLMYtWAIGfi', 'siswa', NULL, '2026-07-06 06:23:55', '2026-07-06 06:23:55'),
(48, 'INDRIYANI WIDIASTUTI', 'indriyani.widiastuti@siswa.smansago.com', NULL, '$2y$12$bsgXNfMupE.ujcKDR/vtcuAfjrSSNsGky2ITy1UOGN3QWTEEb.1ey', 'siswa', NULL, '2026-07-06 06:23:56', '2026-07-06 06:23:56'),
(49, 'IRSYAD ADI RINAWAN', 'irsyad.rinawan@siswa.smansago.com', NULL, '$2y$12$4DN39KlPWksvLURqg3/BR.AK3Vzh4lMVNrmlXYj7/DPwhGbiMAngS', 'siswa', NULL, '2026-07-06 06:23:56', '2026-07-06 06:23:56'),
(50, 'KHANZA LATIFAH', 'khanza.latifah@siswa.smansago.com', NULL, '$2y$12$c211WbLGSOZbuEbksUbBwuNBVf9999s/ZPbqP./q7UShZLUvGI27i', 'siswa', NULL, '2026-07-06 06:23:56', '2026-07-06 06:23:56'),
(51, 'LILYANA MELINDA ELMER', 'lilyana.elmer@siswa.smansago.com', NULL, '$2y$12$DKsq4mdTh4wCLtAnL0Aja.qOuOLj8xsShQiNVTlIGE0TBPA8L.cSi', 'siswa', NULL, '2026-07-06 06:23:56', '2026-07-06 06:23:56'),
(52, 'LUTHFI KAMIL JIBRAN', 'luthfi.jibran@siswa.smansago.com', NULL, '$2y$12$fkQSub4LcJ1slNYdLlOsXOOeAwUrJC4oBnVBOyBvfCAiXgxpTfL1u', 'siswa', NULL, '2026-07-06 06:23:56', '2026-07-06 06:23:56'),
(53, 'MUHAMMAD BURHANUDIN HIBATULLOH', 'muhammad.hibatulloh@siswa.smansago.com', NULL, '$2y$12$weGFkwkQKla3HUbTGSBV.eWnOiLOh7z4DIMojJdFwlh.lma2vF9ZW', 'siswa', NULL, '2026-07-06 06:23:57', '2026-07-06 06:23:57'),
(54, 'Nanda Yusuf Prakoso', 'nanda.prakoso@siswa.smansago.com', NULL, '$2y$12$vyowIgwV.pZ.sqg8hCni4e66kyBH9H4ytE6NtIDw8JMNkM2hdbvwa', 'siswa', NULL, '2026-07-06 06:23:57', '2026-07-06 06:23:57'),
(55, 'NATHAN YOGA PRATAMA', 'nathan.pratama@siswa.smansago.com', NULL, '$2y$12$I/gP99IOPdqyCJ2lolP8z.wQw19PkNPtGDQGFNvvuSQmjQGBih09q', 'siswa', NULL, '2026-07-06 06:23:57', '2026-07-06 06:23:57'),
(56, 'NAURA SYAFA', 'naura.syafa@siswa.smansago.com', NULL, '$2y$12$ivAG.JCGAKPtOm9hmLHC/efmXJLXdIBo/VZjUTwSpkfzhxyfYQj56', 'siswa', NULL, '2026-07-06 06:23:57', '2026-07-06 06:23:57'),
(57, 'Novita Rokhim Mawati', 'novita.mawati@siswa.smansago.com', NULL, '$2y$12$.0l2UtnMWR8GN0.tuM2NcO78RqHU5etvrAUA3G0pzIjBSDmK5Vrte', 'siswa', NULL, '2026-07-06 06:23:58', '2026-07-06 06:23:58'),
(58, 'PURWANINGSIH', 'purwaningsih@siswa.smansago.com', NULL, '$2y$12$iRkSDhhSNwYKMRnwc6Uwnu2fRcetYIpQX1JBqzCs8kPM6W6SjFkj6', 'siswa', NULL, '2026-07-06 06:23:58', '2026-07-06 06:23:58'),
(59, 'RAIF BANU FAIRUZ', 'raif.fairuz@siswa.smansago.com', NULL, '$2y$12$0MTVANWmcz59aVHkZOhvPuhNpAjnjHzKPDNMDrX8A7tvC1dIrhOSq', 'siswa', NULL, '2026-07-06 06:23:58', '2026-07-06 06:23:58'),
(60, 'RENI OKTAVIA SARI', 'reni.sari@siswa.smansago.com', NULL, '$2y$12$/7MDpn2zYdrCW6QpYLdfOOSID1FIoCHu51ARbqh26NbDLoemMkVFu', 'siswa', NULL, '2026-07-06 06:23:58', '2026-07-06 06:23:58'),
(61, 'RISMA NUR KHASANAH', 'risma.khasanah@siswa.smansago.com', NULL, '$2y$12$5Ur9g4w5b8513JmZ7Ge7b.LISl3.89uxyU5o.n7DPciAH2jncnJOe', 'siswa', NULL, '2026-07-06 06:23:58', '2026-07-06 06:23:58'),
(62, 'ROKHIM MAHESTI', 'rokhim.mahesti@siswa.smansago.com', NULL, '$2y$12$NRyAqCY8smwWEVcxQGcPlOFtAWWb0OECwxULG8ak/BafucuIpYlpG', 'siswa', NULL, '2026-07-06 06:23:59', '2026-07-06 06:23:59'),
(63, 'SEAN CAROLINE VALENTINE BAETRICE', 'sean.baetrice@siswa.smansago.com', NULL, '$2y$12$l/GXXjKjjZG8E0juvl8mt.pj4/x2FkPGbRdQXkJlZQGbkHfhFUGVm', 'siswa', NULL, '2026-07-06 06:23:59', '2026-07-06 06:23:59'),
(64, 'SEVI LEVIAN GRAFISI', 'sevi.grafisi@siswa.smansago.com', NULL, '$2y$12$H9vB/eqUMwlyYj.YiSag4Oh9cz4Cqdelu4KBpfcWCgo7HPS4pP/3i', 'siswa', NULL, '2026-07-06 06:23:59', '2026-07-06 06:23:59'),
(65, 'SULISTYANI MASRUROH', 'sulistyani.masruroh@siswa.smansago.com', NULL, '$2y$12$41.cZtEORNQ11Tckx.3VxeBRSYSRRmYnKcZXotBgIF4xJWyugkzVS', 'siswa', NULL, '2026-07-06 06:23:59', '2026-07-06 06:23:59'),
(66, 'SYARIF HIDAYATULLOH', 'syarif.hidayatulloh@siswa.smansago.com', NULL, '$2y$12$EmO8e903.mxcNrB5UDdSHO6snMg4OfdR1RZ4IeFzxHehctPa/TcW.', 'siswa', NULL, '2026-07-06 06:24:00', '2026-07-06 06:24:00'),
(67, 'TRI NOFIYANTI', 'tri.nofiyanti@siswa.smansago.com', NULL, '$2y$12$X4gaGX1aG7LzZgXjLv57Z.TWG70qY8tpPVj4evYy6vICt0dTcX.Ie', 'siswa', NULL, '2026-07-06 06:24:00', '2026-07-06 06:24:00'),
(68, 'WAHYU OKTAVIA LESTARI', 'wahyu.lestari@siswa.smansago.com', NULL, '$2y$12$FbBS66EcuCpnMVvOtDhx5uCAfYJJdaHZ5di4nPTE33UDNTapdFn6q', 'siswa', NULL, '2026-07-06 06:24:00', '2026-07-06 06:24:00'),
(69, 'WIDIYANTO', 'widiyanto@siswa.smansago.com', NULL, '$2y$12$V1/.ykTLQA1W7AXtCeuStOuLBpAs.LLjPyhsjI6cDg1kwoHn8H1X.', 'siswa', NULL, '2026-07-06 06:24:00', '2026-07-06 06:24:00'),
(70, 'Yoris Arya Rahmadan', 'yoris.rahmadan@siswa.smansago.com', NULL, '$2y$12$JkHEN6GdpYkVz6YxR/sGiOuAVo7Pp7JLzgSYUSlnLV2fFr7b.ruHW', 'siswa', NULL, '2026-07-06 06:24:01', '2026-07-06 06:24:01'),
(71, 'YUNI RAHMAWATI', 'yuni.rahmawati@siswa.smansago.com', NULL, '$2y$12$OzSsbfarQLT1yeqYhGqA.uJN/PRULK7HqYUN6/bHlDFNRbGhJHfLS', 'siswa', NULL, '2026-07-06 06:24:01', '2026-07-06 06:24:01'),
(72, 'ADITYA DWI PUTRA', 'aditya.putra@siswa.smansago.com', NULL, '$2y$12$xZftQeo8YAwnRF93zYYNpuha0F7LYu6Q4G6DbXR4pjN9gbgF3ydmG', 'siswa', NULL, '2026-07-06 06:24:01', '2026-07-06 06:24:01'),
(73, 'Afiqah Ocktavi Wahyunia', 'afiqah.wahyunia@siswa.smansago.com', NULL, '$2y$12$IXcbVPgUASMt2S.MwHM5L..4tJyRoZGeNnpt0Qt2Flf9PTz89gYLa', 'siswa', NULL, '2026-07-06 06:24:01', '2026-07-06 06:24:01'),
(74, 'ALFIFAH ADYSTIA NURNANINGSIH', 'alfifah.nurnaningsih@siswa.smansago.com', NULL, '$2y$12$MSMAI9DCLiE4H3sRjC9ztumPKd/BiJxb7yeKnoS8U6KlC9gapYqzq', 'siswa', NULL, '2026-07-06 06:24:02', '2026-07-06 06:24:02'),
(75, 'ALVI AINURROZIQIN', 'alvi.ainurroziqin@siswa.smansago.com', NULL, '$2y$12$2nyAO2tsh7P/Bi5.elTg3OBMNzf..xM4fIw30pFVZonLmcKVvoBf.', 'siswa', NULL, '2026-07-06 06:24:02', '2026-07-06 06:24:02'),
(76, 'ANISA AUFA ABIBATUL AZIZAH', 'anisa.azizah@siswa.smansago.com', NULL, '$2y$12$bX4kHeIlaX5pbhXvrcdCqOvcyZG/nDaN5qVUvJ3cD1edoFlWhDTRq', 'siswa', NULL, '2026-07-06 06:24:02', '2026-07-06 06:24:02'),
(77, 'AULIA ISTIQOMAH', 'aulia.istiqomah@siswa.smansago.com', NULL, '$2y$12$gHanuDWp7xKlbQu.W7KToeMXnTqLr7kcFPGodYJuTtdTi7GlOYx7m', 'siswa', NULL, '2026-07-06 06:24:02', '2026-07-06 06:24:02'),
(78, 'BAGUS RIVAI', 'bagus.rivai@siswa.smansago.com', NULL, '$2y$12$3KalMJtUcL31gCFY.Oot3.72BoNBb4JLgzGSAxnhSyh/nLnkhcUIW', 'siswa', NULL, '2026-07-06 06:24:03', '2026-07-06 06:24:03'),
(79, 'CALISTA SALMA MAHESWARI', 'calista.maheswari@siswa.smansago.com', NULL, '$2y$12$Rl1x05JXCahkrhMYQPHL4uHW.FO.Fs0sHMukDnjnkJYcl/q3/xKL2', 'siswa', NULL, '2026-07-06 06:24:03', '2026-07-06 06:24:03'),
(80, 'DENIS ABI SETIAWAN', 'denis.setiawan@siswa.smansago.com', NULL, '$2y$12$U3190nKAzALkeckxdbRkmeGs1TFhTc3UoMlI.gGnAVJPhBtchyvXq', 'siswa', NULL, '2026-07-06 06:24:03', '2026-07-06 06:24:03'),
(81, 'DIAN FATMAH AINU ROHMAH', 'dian.rohmah@siswa.smansago.com', NULL, '$2y$12$NU5BrdRl1Hs.83TdIZCF9uSOQEHn9bA96dsJ3PoIsvvTr5IsTOS3C', 'siswa', NULL, '2026-07-06 06:24:03', '2026-07-06 06:24:03'),
(82, 'EKA WULAN RAMADHANI', 'eka.ramadhani@siswa.smansago.com', NULL, '$2y$12$qgJiY9nPxElEncfVaDznie2eniVs4a8ZtBA9V4YVrJFJ5TA/j.h7y', 'siswa', NULL, '2026-07-06 06:24:04', '2026-07-06 06:24:04'),
(83, 'Faisya Ramadani', 'faisya.ramadani@siswa.smansago.com', NULL, '$2y$12$nhjQ1qzFTP8hlrsa5PjDPu5BYUOH3wjvY5vfwFMztu0c/rqifRVse', 'siswa', NULL, '2026-07-06 06:24:04', '2026-07-06 06:24:04'),
(84, 'Farhan Zaki Fahrezy', 'farhan.fahrezy@siswa.smansago.com', NULL, '$2y$12$qvi0DJE6i1CGk/k9A20CeeA5NLKTBIc/xg/.tyJwxH/RPMOrBl5gy', 'siswa', NULL, '2026-07-06 06:24:04', '2026-07-06 06:24:04'),
(85, 'GALIH PRATITIS WULANDRI UTOMO', 'galih.utomo@siswa.smansago.com', NULL, '$2y$12$lZ8uamy6LCQpUN/GWYahlOzo/GbSBIznYZRZzDXol2TVZUx4gkBmq', 'siswa', NULL, '2026-07-06 06:24:04', '2026-07-06 06:24:04'),
(86, 'GILDA CELLYN MAGDALENA', 'gilda.magdalena@siswa.smansago.com', NULL, '$2y$12$mmRK3JVUpvJmADCIS2Ut4u94ChAI1barOJhpoGBOQNqPy5MijwPze', 'siswa', NULL, '2026-07-06 06:24:05', '2026-07-06 06:24:05'),
(87, 'ISNAN NUR ARIFIN', 'isnan.arifin@siswa.smansago.com', NULL, '$2y$12$vDHNwDwFQ7WNPXyQDqMhiu6FXFGqfPtzqwWCP3wk1vZ8P0uanlZyq', 'siswa', NULL, '2026-07-06 06:24:05', '2026-07-06 06:24:05'),
(88, 'JHUHRIA FEBRIANA', 'jhuhria.febriana@siswa.smansago.com', NULL, '$2y$12$48sIL9NP9BWw9eqGsdnws.Tek/eATu.pmy7rhYRqJr036CFSBvYVS', 'siswa', NULL, '2026-07-06 06:24:05', '2026-07-06 06:24:05'),
(89, 'KIRANA NOVITASARI', 'kirana.novitasari@siswa.smansago.com', NULL, '$2y$12$l40ym1p9aeWQjoD2ZM6FieKxRaugKOvwdEIKuDaafPTBnJPYnjXOK', 'siswa', NULL, '2026-07-06 06:24:05', '2026-07-06 06:24:05'),
(90, 'LINTANG FAJAR WATI', 'lintang.wati@siswa.smansago.com', NULL, '$2y$12$DhsQa0xr7P0jmfLC9uiesOqVkMAij4PxyCZiUC1dduPwB9LmhQcCK', 'siswa', NULL, '2026-07-06 06:24:06', '2026-07-06 06:24:06'),
(91, 'MASSYAHRIL ARBA MAULANA', 'massyahril.maulana@siswa.smansago.com', NULL, '$2y$12$ez97s1AFPsWKg1JTT36/geSy4XWE7oa4tGPh29tRUnKnr5.sEn34C', 'siswa', NULL, '2026-07-06 06:24:06', '2026-07-06 06:24:06'),
(92, 'MUHAMMAD DIMAS AGUNG NUGROHO', 'muhammad.nugroho@siswa.smansago.com', NULL, '$2y$12$uU1XSgyWav.fjuuHDKBgT.pys5WpyAgWXoBIy.ErTsjDwCsbmvnn6', 'siswa', NULL, '2026-07-06 06:24:06', '2026-07-06 06:24:06'),
(93, 'NAYLA AZ ZAHRA', 'nayla.zahra@siswa.smansago.com', NULL, '$2y$12$v9wSA68xQ9P6eMDX9iVsG.CROM1.sFMKziezRZhDYyHDh5wuUTYjK', 'siswa', NULL, '2026-07-06 06:24:06', '2026-07-06 06:24:06'),
(94, 'NAZA AKMAL FAIRIZUAN', 'naza.fairizuan@siswa.smansago.com', NULL, '$2y$12$mOmF.QkFtJpmLbHq8Na/MOm4Jq4tGYIc3qLya.0pj2enrZCsvvvvO', 'siswa', NULL, '2026-07-06 06:24:07', '2026-07-06 06:24:07'),
(95, 'NUR AINA SANIYAH QOLBI', 'nur.qolbi@siswa.smansago.com', NULL, '$2y$12$Bl6ZNWSfGgmaX7YRKGz6w.iMsPLsaKTOWeXT/lFhmpM1Uzs8nyRKu', 'siswa', NULL, '2026-07-06 06:24:07', '2026-07-06 06:24:07'),
(96, 'PUTRI MAULIDA', 'putri.maulida@siswa.smansago.com', NULL, '$2y$12$/gszuzPoZAldnE0/aT.40.1uTQfMaaW3V020NPOVZt9TwM//HDxCO', 'siswa', NULL, '2026-07-06 06:24:07', '2026-07-06 06:24:07'),
(97, 'RAKA RISANNJANA', 'raka.risannjana@siswa.smansago.com', NULL, '$2y$12$.0M4nlFB6RoINtdVOon/.Otzs5PtbJCMWhVbFJAay3C.ifc/uQV5C', 'siswa', NULL, '2026-07-06 06:24:08', '2026-07-06 06:24:08'),
(98, 'RINA HANDAYANI', 'rina.handayani@siswa.smansago.com', NULL, '$2y$12$/wFaCz.rFqTiiFhxtWyE7u3w7C6U1NMcE//kgptM1Gsdx/wpCUR8K', 'siswa', NULL, '2026-07-06 06:24:08', '2026-07-06 06:24:08'),
(99, 'RONI OKTAVIAN', 'roni.oktavian@siswa.smansago.com', NULL, '$2y$12$1oc9tJScwQ1ehvRkgMooPegASpVQu4rImGDREWTGtxbh4HixzT1Qe', 'siswa', NULL, '2026-07-06 06:24:08', '2026-07-06 06:24:08'),
(100, 'Salsa Nabila Dwi Aryanti', 'salsa.aryanti@siswa.smansago.com', NULL, '$2y$12$Q23PpFXUR/qi3HNVdpTGFeglTfFMUcQEXq0yaMh9IPiC75aeyiLfG', 'siswa', NULL, '2026-07-06 06:24:08', '2026-07-06 06:24:08'),
(101, 'Septiyana Ramadani', 'septiyana.ramadani@siswa.smansago.com', NULL, '$2y$12$/aazY7P7BejhlxHhw03aq.fBQEWzclset1aWbc95T4Ylx7o4dJvo6', 'siswa', NULL, '2026-07-06 06:24:09', '2026-07-06 06:24:09'),
(102, 'SITI ROHANI', 'siti.rohani@siswa.smansago.com', NULL, '$2y$12$JxkGvJ/io4ldtGgDydf1Z.I/7dg33EQKf1Pxt.SZtDIYwsEYHDNri', 'siswa', NULL, '2026-07-06 06:24:09', '2026-07-06 06:24:09'),
(103, 'SYAFA MUFIDA AZ-ZAHRA', 'syafa.azzahra@siswa.smansago.com', NULL, '$2y$12$.QcjUGdlK1lEhYbqRir.versQAEQOuLd62wQ12.VbDwk5jOdel5qW', 'siswa', NULL, '2026-07-06 06:24:09', '2026-07-06 06:24:09'),
(104, 'TRI WAHYU NOVIANA', 'tri.noviana@siswa.smansago.com', NULL, '$2y$12$0q90VH7TNCcj0UW9ngiuFuPH6uEdUqPAHf39EoFxZPTCAkDKKbvvG', 'siswa', NULL, '2026-07-06 06:24:09', '2026-07-06 06:24:09'),
(105, 'TRI WAHYU NOVIANI', 'tri.noviani@siswa.smansago.com', NULL, '$2y$12$zYra7yb9bwWIv8gCLdY.bugKRFw08EzopM2BN6ItoG1Gw9elc0jma', 'siswa', NULL, '2026-07-06 06:24:10', '2026-07-06 06:24:10'),
(106, 'WAHYU WALIMATUL KHOLIFAH', 'wahyu.kholifah@siswa.smansago.com', NULL, '$2y$12$OsCmeryEwAv67AwU8tOyC.A386rwkQaLqSQMpEdDIR3kWsHL/4w6q', 'siswa', NULL, '2026-07-06 06:24:10', '2026-07-06 06:24:10'),
(107, 'YUNIA RIZKI ANISA', 'yunia.anisa@siswa.smansago.com', NULL, '$2y$12$MpmsyzI52GRd.87cetbVkes1JqNXlb/OQUBrONK9yjMKmC0wEqiSe', 'siswa', NULL, '2026-07-06 06:24:10', '2026-07-06 06:24:10'),
(108, 'ABIZAH DEVANA HAFSARI', 'abizah.hafsari@siswa.smansago.com', NULL, '$2y$12$LPAndo0hrzZg0CxE5jongOsPOCnYMIAih7P35yEo.zkSOaDfYpSDq', 'siswa', NULL, '2026-07-06 06:24:10', '2026-07-06 06:24:10'),
(109, 'ALANA JUAN REVANO', 'alana.revano@siswa.smansago.com', NULL, '$2y$12$iWFr3QscEHBGX4dt2MuSsOZvEv6mmBDhjH8mozNiKh4tW5fIQhFJS', 'siswa', NULL, '2026-07-06 06:24:11', '2026-07-06 06:24:11'),
(110, 'ALIF CAHYA SETYANI', 'alif.setyani@siswa.smansago.com', NULL, '$2y$12$aV0xHvmT4pF7VJHa6GAVFOfwnq3wI3oJeQyjYW8Yk35GlKiIapvyK', 'siswa', NULL, '2026-07-06 06:24:11', '2026-07-06 06:24:11'),
(111, 'ALVIN FEBRIYANSAH', 'alvin.febriyansah@siswa.smansago.com', NULL, '$2y$12$MH0.Nw/lRadsrQVNEknTV.FSeqSOWqc3m4dxDCAoTGYymR.MTnTMy', 'siswa', NULL, '2026-07-06 06:24:11', '2026-07-06 06:24:11'),
(112, 'ANISA FEBRIYANA', 'anisa.febriyana@siswa.smansago.com', NULL, '$2y$12$DCVz.mlyM3DTPRSl6Np8SuJ2b2AKV.8RD7rUzi76vNfZ8vevCgkBK', 'siswa', NULL, '2026-07-06 06:24:11', '2026-07-06 06:24:11'),
(113, 'AULIA NUR RISKI', 'aulia.riski@siswa.smansago.com', NULL, '$2y$12$yhD9OtNEcc4qmW6ASlbHdesUZbZmxaQVkq9t8fSB7K5P8KBMTLvAe', 'siswa', NULL, '2026-07-06 06:24:11', '2026-07-06 06:24:11'),
(114, 'BAYU BAGUS LASTYADI', 'bayu.lastyadi@siswa.smansago.com', NULL, '$2y$12$cUeyLPoX2zaVEVDrkdvnw.oxE887WJ9YRiZWu50mFdwR9oPKlouyO', 'siswa', NULL, '2026-07-06 06:24:12', '2026-07-06 06:24:12'),
(115, 'CHALILA NISRIN DEWANTI', 'chalila.dewanti@siswa.smansago.com', NULL, '$2y$12$7OpScd.c/jKdZWeiNCh0HupAwMP5TntTwMFDh4.sPh6JpdvEZFbCe', 'siswa', NULL, '2026-07-06 06:24:12', '2026-07-06 06:24:12'),
(116, 'DIKI PRAMANA', 'diki.pramana@siswa.smansago.com', NULL, '$2y$12$ftWr/cP2WOHQU5UGjhbaPOuWlHAL6z5HGFiHugDZShmqzNDbWaL3i', 'siswa', NULL, '2026-07-06 06:24:12', '2026-07-06 06:24:12'),
(117, 'DINI INDAH AULIA', 'dini.aulia@siswa.smansago.com', NULL, '$2y$12$OmQ9IlLAarSs8RgIIB94B.U1IaH4Tmte9yYmh4sbWOxvmd/OYEiTO', 'siswa', NULL, '2026-07-06 06:24:12', '2026-07-06 06:24:12'),
(118, 'ELSA DEMAWATI', 'elsa.demawati@siswa.smansago.com', NULL, '$2y$12$1TfyxXq62189NOmIzMOz6.9.frNxAqNlOgKuvG/5EVTJPMuU/zGru', 'siswa', NULL, '2026-07-06 06:24:13', '2026-07-06 06:24:13'),
(119, 'FARA AYU DITA', 'fara.dita@siswa.smansago.com', NULL, '$2y$12$G/BtTCe7Xyex3iLydAg9Xu0PoYtOXwJqBVgvggxatfBq3Qj/0tXDm', 'siswa', NULL, '2026-07-06 06:24:13', '2026-07-06 06:24:13'),
(120, 'FARIS NAZHRIL ILHAM PRATAMA', 'faris.pratama@siswa.smansago.com', NULL, '$2y$12$iiDc0cRijnXlfloaPZTsxObdRvcfUVsaqIWGncekt96zusFAlSSBK', 'siswa', NULL, '2026-07-06 06:24:13', '2026-07-06 06:24:13'),
(121, 'HABIBAH SYAFA FAUZIAH', 'habibah.fauziah@siswa.smansago.com', NULL, '$2y$12$/AIv6tsw/OQqXKOZ81ahqeXiuSCD3iFL49L4/a29NUI5s62bz4gDK', 'siswa', NULL, '2026-07-06 06:24:13', '2026-07-06 06:24:13'),
(122, 'HAFIDZ MUHAMMAD IRFAN', 'hafidz.irfan@siswa.smansago.com', NULL, '$2y$12$Wt4yNiNh0ZHHNtpH7GZF1uuzj1LXyh/d.iB.7DPTcB61LCaj657bC', 'siswa', NULL, '2026-07-06 06:24:13', '2026-07-06 06:24:13'),
(123, 'INTAN NUR AISYAH', 'intan.aisyah@siswa.smansago.com', NULL, '$2y$12$6ASC9FOEBMwtrPrXPi6pRe8NRckLDgrqo47qeSOtImkWhpVF7uKBa', 'siswa', NULL, '2026-07-06 06:24:14', '2026-07-06 06:24:14'),
(124, 'JAVERA RASHIF TRISTANDIKA', 'javera.tristandika@siswa.smansago.com', NULL, '$2y$12$6irLjcJvVTUPYHqybZOH2.kUE5ND2H.MLYK9Nc1eDCQqntO75Hug6', 'siswa', NULL, '2026-07-06 06:24:14', '2026-07-06 06:24:14'),
(125, 'KALISA REGINA PUTRI', 'kalisa.putri@siswa.smansago.com', NULL, '$2y$12$0lMLQhsYFA/vzdr7EZG0WOAuoJoGYlnNw8BEksZy.eBIAPqugQFs6', 'siswa', NULL, '2026-07-06 06:24:14', '2026-07-06 06:24:14'),
(126, 'LUTFI AULIA RAMADHANI', 'lutfi.ramadhani@siswa.smansago.com', NULL, '$2y$12$jo98/sfwFrxNcF0UraL1EuYRCB3gl6qEiF2cTFYtLVLIMAANxrZEe', 'siswa', NULL, '2026-07-06 06:24:14', '2026-07-06 06:24:14'),
(127, 'MAULANA SATRIA SAPUTRA', 'maulana.saputra@siswa.smansago.com', NULL, '$2y$12$pN71W0xfam8E19siS/5OfO9GQT.sAAIr210XM35iE8c5DroNUt9iO', 'siswa', NULL, '2026-07-06 06:24:15', '2026-07-06 06:24:15'),
(128, 'MUHAMMAD FAISAL ABIDIN', 'muhammad.abidin@siswa.smansago.com', NULL, '$2y$12$4TrifDVXq/iqk5/O8GmeWeOyjl8QhMU.ZzVNSAfDg.7eXjwyUOY0q', 'siswa', NULL, '2026-07-06 06:24:15', '2026-07-06 06:24:15'),
(129, 'NAYLA WAHYU LESTARI', 'nayla.lestari@siswa.smansago.com', NULL, '$2y$12$0YBVHOTrzj4ZUhFZPmrJJeY6Izg2n2xU88SJ6SOE5tvXYcg8PWv/6', 'siswa', NULL, '2026-07-06 06:24:15', '2026-07-06 06:24:15'),
(130, 'NICO FANDEZTA PRATAMA', 'nico.pratama@siswa.smansago.com', NULL, '$2y$12$BBSfj4geYIbqeI6zbCgPV.OkH3EAsD71GwI7lBmesoa/4YWo2K1v6', 'siswa', NULL, '2026-07-06 06:24:15', '2026-07-06 06:24:15'),
(131, 'NUR SHOLIKAH', 'nur.sholikah@siswa.smansago.com', NULL, '$2y$12$hy0RZvHXzVjKL4WBMfVGreKSsoiA6DHfZyLldOH8KvZsg7z5GXaNq', 'siswa', NULL, '2026-07-06 06:24:16', '2026-07-06 06:24:16'),
(132, 'Putri Nur Sholekha', 'putri.sholekha@siswa.smansago.com', NULL, '$2y$12$uJn6hT5cssDUQhK.55VgXuwyF2otmZtbqE.w3k8Vv8Xk18j6mYQLC', 'siswa', NULL, '2026-07-06 06:24:16', '2026-07-06 06:24:16'),
(133, 'RAVI ALFATAH', 'ravi.alfatah@siswa.smansago.com', NULL, '$2y$12$QRQ1FILhtE793eWj4Kvnz.H/5gpnYtbkKeW6q5U2IKXt6GYnhpWYi', 'siswa', NULL, '2026-07-06 06:24:16', '2026-07-06 06:24:16'),
(134, 'RINDU MUGI LESTARI', 'rindu.lestari@siswa.smansago.com', NULL, '$2y$12$4JofnsA5kJirOTtCuPT4SOWGzld5wjGiIeKkEWkl1rAU89QNQTlbK', 'siswa', NULL, '2026-07-06 06:24:16', '2026-07-06 06:24:16'),
(135, 'SAIFUL BAHRI', 'saiful.bahri@siswa.smansago.com', NULL, '$2y$12$r2SC7Wrf9sjoODjDjZAMX.vWzAoQG1I12KH.VjrfXuvGhP7Gnrt7i', 'siswa', NULL, '2026-07-06 06:24:17', '2026-07-06 06:24:17'),
(136, 'SALWA AURA SAFITRI', 'salwa.safitri@siswa.smansago.com', NULL, '$2y$12$TN7gOmOnbiW19POWp9BnFOG3eInVRnIBphSNnHomW91iL9q9Y1MN6', 'siswa', NULL, '2026-07-06 06:24:17', '2026-07-06 06:24:17'),
(137, 'SHELA ARINI FAUZIYAH', 'shela.fauziyah@siswa.smansago.com', NULL, '$2y$12$LaO96xns.hVsirELC/e4a.vpcCgQn.dygMrnJ30p1fT709dWGZY2i', 'siswa', NULL, '2026-07-06 06:24:17', '2026-07-06 06:24:17'),
(138, 'SOFIANA NOVITA SARI', 'sofiana.sari@siswa.smansago.com', NULL, '$2y$12$HdlT8KJyqpK6HbkCeRqM9ev4k2fXlrxLgYKCS5MBaX.cx5p7MVu26', 'siswa', NULL, '2026-07-06 06:24:17', '2026-07-06 06:24:17'),
(139, 'SYAFINA FEBRIASTUTI', 'syafina.febriastuti@siswa.smansago.com', NULL, '$2y$12$EWIdqGRHfkD9ql0huUx/Q.hYWxIyPc7B/vlEBia.9DVkrRF6Z9mXe', 'siswa', NULL, '2026-07-06 06:24:17', '2026-07-06 06:24:17'),
(140, 'TAHTA ANDHIKA SETYAWAN', 'tahta.setyawan@siswa.smansago.com', NULL, '$2y$12$2UQLEeKD7mW9KFD8eCiJpuTx9jFDvod90Fgk.qZ0TJQcV3ZMJws86', 'siswa', NULL, '2026-07-06 06:24:18', '2026-07-06 06:24:18'),
(141, 'TOMY KURNIAWAN', 'tomy.kurniawan@siswa.smansago.com', NULL, '$2y$12$pJ0XIku7B8EYDoD2smqEH.3cLKXtrT9jCFF/d89GWoBrwE6nZVS4i', 'siswa', NULL, '2026-07-06 06:24:18', '2026-07-06 06:24:18'),
(142, 'WINDI FATIKA KHASANAH', 'windi.khasanah@siswa.smansago.com', NULL, '$2y$12$mzDmifnhAYICCOqrW1LW7estQRfsgahlHjwVag5vB6qEmCWxYW2dG', 'siswa', NULL, '2026-07-06 06:24:18', '2026-07-06 06:24:18'),
(143, 'ZAHRA FAJRINA', 'zahra.fajrina@siswa.smansago.com', NULL, '$2y$12$hypvLDmrEQD.TPMES3C13ufgI3g2QtauQUnowycJVroAYcmGviwyu', 'siswa', NULL, '2026-07-06 06:24:18', '2026-07-06 06:24:18'),
(144, 'AFISAH MAHARANI', 'afisah.maharani@siswa.smansago.com', NULL, '$2y$12$XoSd1f/BOmTeKaIYNO/3P.GL7BdDa/qaxIue4PR9ImdFquOvzNNLi', 'siswa', NULL, '2026-07-06 06:24:19', '2026-07-06 06:24:19'),
(145, 'ALFANO DWI HANDIKA', 'alfano.handika@siswa.smansago.com', NULL, '$2y$12$FajFLW9szGg/hNcmab0RgOrpdw/DyAj98dhTt4hnMCRyrCn0LHFJu', 'siswa', NULL, '2026-07-06 06:24:19', '2026-07-06 06:24:19'),
(146, 'ALINDA BRILIAN TIKA DEWI', 'alinda.dewi@siswa.smansago.com', NULL, '$2y$12$EhwFgpUXl5ikBnuzUvFOg.BpZbNBg/wbrWWR7cFAYuz8/KUfeXTga', 'siswa', NULL, '2026-07-06 06:24:19', '2026-07-06 06:24:19'),
(147, 'Andante Arga Yudhistira Prabowo', 'andante.prabowo@siswa.smansago.com', NULL, '$2y$12$JKUZZCW1J2g8hbctrALzueRpSWuw2Kyb2sFk34nDJs8ziQsOHvXpy', 'siswa', NULL, '2026-07-06 06:24:19', '2026-07-06 06:24:19'),
(148, 'ANNIS EKA ARIYANI', 'annis.ariyani@siswa.smansago.com', NULL, '$2y$12$GuHfMWpXBeygEHIFh.7C0.I/Vhrk6EjXQzzkn7j3a4dTNgNrPET2u', 'siswa', NULL, '2026-07-06 06:24:20', '2026-07-06 06:24:20'),
(149, 'AULIA RAFI QURROHMAN', 'aulia.qurrohman@siswa.smansago.com', NULL, '$2y$12$joVZ5obUJaFlClMYW75dJu7ZMlilvG8SsHNgpqSnP53xBOWDQ2moG', 'siswa', NULL, '2026-07-06 06:24:20', '2026-07-06 06:24:20'),
(150, 'BAYU JATI ANGKOSO', 'bayu.angkoso@siswa.smansago.com', NULL, '$2y$12$tz1VxutEQSnQjjR.UX4ByOA67s4rkM3yIoeiuehiV5BkSDpeCCqgi', 'siswa', NULL, '2026-07-06 06:24:20', '2026-07-06 06:24:20'),
(151, 'Daimatul Karimah', 'daimatul.karimah@siswa.smansago.com', NULL, '$2y$12$gogTNVdTHZY8v176oN9uKeyUjJy.Kh7SnH0iB94A3ZhmTykv.2Upm', 'siswa', NULL, '2026-07-06 06:24:20', '2026-07-06 06:24:20'),
(152, 'DWI DONI PRABOWO', 'dwi.prabowo@siswa.smansago.com', NULL, '$2y$12$n23Mfc/O.M55KbCbG.nXMumIF7WDtutSKRerStFtYVBM1Vs1A/AaW', 'siswa', NULL, '2026-07-06 06:24:21', '2026-07-06 06:24:21'),
(153, 'DWI KURNIAWAN', 'dwi.kurniawan@siswa.smansago.com', NULL, '$2y$12$WJ6wKY5h4VVal3vpU0ssJ.O7Wo1QAJ0wjubWe2.b/lgLUg8p2rTzS', 'siswa', NULL, '2026-07-06 06:24:21', '2026-07-06 06:24:21'),
(154, 'ENGGAR WAHYUNI', 'enggar.wahyuni@siswa.smansago.com', NULL, '$2y$12$OUGuN3eF..JW0BdNcSBA2uCKzk5znZH4BYWvquvDft39SRToiUS.y', 'siswa', NULL, '2026-07-06 06:24:21', '2026-07-06 06:24:21'),
(155, 'FATAH RAMADHAN AJI SAPUTRA', 'fatah.saputra@siswa.smansago.com', NULL, '$2y$12$iQ5uSRuVqU3CmNgEOrPlS.5VAZ2Ui9D/d3uOq8Q/XFTzhDicfIKA2', 'siswa', NULL, '2026-07-06 06:24:21', '2026-07-06 06:24:21'),
(156, 'FEBRYANA ANGREINY PRANATA', 'febryana.pranata@siswa.smansago.com', NULL, '$2y$12$HfKaAt3mjAOKp3ebR53jwOHW4AXcHlHp1JE/vYUzQ0xfEa3PbmDA.', 'siswa', NULL, '2026-07-06 06:24:22', '2026-07-06 06:24:22'),
(157, 'HANIFAH PUTRI MEILANI', 'hanifah.meilani@siswa.smansago.com', NULL, '$2y$12$XrDs0WPSNjttMSV.dU6ZfuHz4vRg0JrLSJnkHhqyKTuqvnywk63SG', 'siswa', NULL, '2026-07-06 06:24:22', '2026-07-06 06:24:22'),
(158, 'IQBAAL LUQMAN SAPUTRA', 'iqbaal.saputra@siswa.smansago.com', NULL, '$2y$12$lOxtIkBZLgEw3dCFPBJXPuL0GHsN6UsMYlvnHTHf4fmQrrRmBLG2y', 'siswa', NULL, '2026-07-06 06:24:22', '2026-07-06 06:24:22'),
(159, 'JAYANUDIN PURNA MURTI', 'jayanudin.murti@siswa.smansago.com', NULL, '$2y$12$lMWEHtB6auLkvtEGdY5J/eQJVEtqH1mqs1p7MQkzfQJwdmuIqOngu', 'siswa', NULL, '2026-07-06 06:24:22', '2026-07-06 06:24:22'),
(160, 'KAYLA NUR ADILLA', 'kayla.adilla@siswa.smansago.com', NULL, '$2y$12$dICaTCR4jGJa15DOkzqIY.xbyFXhKviQdMkcwpiqaLE3zr5bKdheu', 'siswa', NULL, '2026-07-06 06:24:22', '2026-07-06 06:24:22'),
(161, 'KRISTIANA KURNIAWATI', 'kristiana.kurniawati@siswa.smansago.com', NULL, '$2y$12$pPnpjkmdNj.tJz3N5ameJ.ec.LnPdDDrbMspB5SaziQSXCOA5iEeO', 'siswa', NULL, '2026-07-06 06:24:23', '2026-07-06 06:24:23'),
(162, 'MAYLA NURUL AFIFAH', 'mayla.afifah@siswa.smansago.com', NULL, '$2y$12$VJq2F0f25N7PPeZhxY4EX.SfJODyi6zcfdybU0i63JE7hQfKH7DFy', 'siswa', NULL, '2026-07-06 06:24:23', '2026-07-06 06:24:23'),
(163, 'MUHAMAD AKBAR SALIM', 'muhamad.salim@siswa.smansago.com', NULL, '$2y$12$sfu0lZSs/M.o8xFy54zUSeS2RITN95UBku04Ulk38NIqNO19fiJ0K', 'siswa', NULL, '2026-07-06 06:24:23', '2026-07-06 06:24:23'),
(164, 'MUHAMMAD HABIB LUTHFI', 'muhammad.luthfi@siswa.smansago.com', NULL, '$2y$12$m3x4ockzNje9uAqHzOvCJebGYP2qR32nCzhKgEE/Bz.HLIftQ6yMC', 'siswa', NULL, '2026-07-06 06:24:23', '2026-07-06 06:24:23'),
(165, 'NINA VANIA ZERLINA', 'nina.zerlina@siswa.smansago.com', NULL, '$2y$12$P1tUUaoMRD/i3Y6l/yyeqOLILYjhmrUjzvXh/T6SEdN6qrDQYrdNa', 'siswa', NULL, '2026-07-06 06:24:24', '2026-07-06 06:24:24'),
(166, 'NOVAL RIFKY AFRIANTO', 'noval.afrianto@siswa.smansago.com', NULL, '$2y$12$SsmHdHNdIhtl.igSxQubcOVLXfJ1alHyl...ofAXNBSdKH.KH3RY.', 'siswa', NULL, '2026-07-06 06:24:24', '2026-07-06 06:24:24'),
(167, 'NUR UTAMI', 'nur.utami@siswa.smansago.com', NULL, '$2y$12$cPOe9il5e81LkzWdnhJINOgmn28bGMIM2HEKW5LKKm853Mbs66Dcq', 'siswa', NULL, '2026-07-06 06:24:24', '2026-07-06 06:24:24'),
(168, 'RAIHANNISA PUTRI FITRIANA', 'raihannisa.fitriana@siswa.smansago.com', NULL, '$2y$12$/7N4q.qnvd4GdjNtTCUwNeG3v7vynGr.Bhb9AgVl7U0qIxZVdVhZu', 'siswa', NULL, '2026-07-06 06:24:24', '2026-07-06 06:24:24'),
(169, 'REZA ZAPUTRA', 'reza.zaputra@siswa.smansago.com', NULL, '$2y$12$c0nG7bgcsebs7wggce4d0uFF2HbzwlN2ze0oefc9qpSc/i5.vpIk2', 'siswa', NULL, '2026-07-06 06:24:25', '2026-07-06 06:24:25'),
(170, 'RIRIN DWI PRASETYANI', 'ririn.prasetyani@siswa.smansago.com', NULL, '$2y$12$SQfoqEUad3D90ltDJ2fwxu7zoHJvgzPFOcOHJl//qtraPpuImWR56', 'siswa', NULL, '2026-07-06 06:24:25', '2026-07-06 06:24:25'),
(171, 'SANTI OLIVIA NINGSIH', 'santi.ningsih@siswa.smansago.com', NULL, '$2y$12$LGiBa.ObXJ68/9Ovn/DKjuzi0V09vT5DIU0XNHPbE4uXBEK/8h9G2', 'siswa', NULL, '2026-07-06 06:24:25', '2026-07-06 06:24:25'),
(172, 'SATRIA OCTA CAHYO PUTRO', 'satria.putro@siswa.smansago.com', NULL, '$2y$12$7SijARp/jX.pnRJrQLVgG.AGNWULK1DimYJDvPkCz4Iswsvdo/to6', 'siswa', NULL, '2026-07-06 06:24:25', '2026-07-06 06:24:25'),
(173, 'SHELLYKHA DHANYATULL RIZMA', 'shellykha.rizma@siswa.smansago.com', NULL, '$2y$12$nEp0DTJdrlbVy.1fIp1TJuEvArsLavpHzA18VUXLRN5oR4ep4uSem', 'siswa', NULL, '2026-07-06 06:24:26', '2026-07-06 06:24:26'),
(174, 'SRI MULYANI', 'sri.mulyani@siswa.smansago.com', NULL, '$2y$12$pCh9A6AQyDx88Uf.F.0itemYGVj4DG6gYFBcUcoyvwTiBeLc1/5w6', 'siswa', NULL, '2026-07-06 06:24:26', '2026-07-06 06:24:26'),
(175, 'TALITHA LUTHFI', 'talitha.luthfi@siswa.smansago.com', NULL, '$2y$12$KWOuV.v2Hw6EjupXY0I0NO89OEAqUa0JKbqlic71n8vexGyB6g8Di', 'siswa', NULL, '2026-07-06 06:24:26', '2026-07-06 06:24:26'),
(176, 'TRI NURROHMAN', 'tri.nurrohman@siswa.smansago.com', NULL, '$2y$12$Rz3xbRJxBU5XUYp.cQtRaeUl22bQGkr7aGTguJLdbLl4cv6b1c27S', 'siswa', NULL, '2026-07-06 06:24:26', '2026-07-06 06:24:26'),
(177, 'ULFA LUTFIANA', 'ulfa.lutfiana@siswa.smansago.com', NULL, '$2y$12$qacfhQAw.aTEwgTAQjSpP.aM.fh3oBpCJhacHyNcGgptEWF7DWI2y', 'siswa', NULL, '2026-07-06 06:24:27', '2026-07-06 06:24:27'),
(178, 'WIWIK LIS RAHAYU', 'wiwik.rahayu@siswa.smansago.com', NULL, '$2y$12$i/OIB2trDS8yIngdwlk5P.vDtlGYtSNyb7MkQ39IFUeZ7s6/jG1Ue', 'siswa', NULL, '2026-07-06 06:24:27', '2026-07-06 06:24:27'),
(179, 'ZAHWA PUTRI CAHYA RIANTI', 'zahwa.rianti@siswa.smansago.com', NULL, '$2y$12$9W.QmNZhgjraZS28Vq7CEOsBpOi835tB8AAU7KNptKYMZdDJBHIZK', 'siswa', NULL, '2026-07-06 06:24:27', '2026-07-06 06:24:27'),
(180, 'Agnia Chindy Feyrus Chalisa', 'agnia.chalisa@siswa.smansago.com', NULL, '$2y$12$B6Tu0JVFyUV9VSe.SPrFJ.lOyFr/5HSP9d8Eh8nwKiWOhpT4QaGsC', 'siswa', NULL, '2026-07-06 06:24:27', '2026-07-06 06:24:27'),
(181, 'ALFIANO DHIKA PRATAMA', 'alfiano.pratama@siswa.smansago.com', NULL, '$2y$12$jLIWWXq5QRWwc9Mi1v8fjuGnzbD7MlDmjkvD2veV.3u2CAnENsCIa', 'siswa', NULL, '2026-07-06 06:24:28', '2026-07-06 06:24:28'),
(182, 'ALISA NAMIRA IMANI', 'alisa.imani@siswa.smansago.com', NULL, '$2y$12$2wOPYS3.AgPHq.rXQGcF3eaW28j/3LBMKpwdLYrSKs38VOZiI7U.G', 'siswa', NULL, '2026-07-06 06:24:28', '2026-07-06 06:24:28'),
(183, 'ANDI YONO', 'andi.yono@siswa.smansago.com', NULL, '$2y$12$8R2E1qkYZ8kEw9HlATxjduTmR3JJiuDeRrjzsUM.eNaWyxkHcGaoO', 'siswa', NULL, '2026-07-06 06:24:28', '2026-07-06 06:24:28'),
(184, 'Ariqa Sally Aswangga', 'ariqa.aswangga@siswa.smansago.com', NULL, '$2y$12$vyZf1tA3fKT.yQkMzXcoa.O24gYUAcNY.we5xmCM3NyftuzZayaiW', 'siswa', NULL, '2026-07-06 06:24:28', '2026-07-06 06:24:28'),
(185, 'AULIYA ZAHRATUL SIVA', 'auliya.siva@siswa.smansago.com', NULL, '$2y$12$E9KkNM0lEqbgj6yGwcqQxOjjFlE.yUnt/MbuDleeQeJNRv.PZST8.', 'siswa', NULL, '2026-07-06 06:24:29', '2026-07-06 06:24:29'),
(186, 'CHOIRUL ADNAN', 'choirul.adnan@siswa.smansago.com', NULL, '$2y$12$ILxibSFa2BFjgEt8WjAv.OjWDeyXDm.xJD89H913csigFUfgwbQjq', 'siswa', NULL, '2026-07-06 06:24:29', '2026-07-06 06:24:29'),
(187, 'DANIS NURIL FAHMA', 'danis.fahma@siswa.smansago.com', NULL, '$2y$12$nGdhvoip6rcz.03YAGArDeTsxMW9/3/IJtdgWR1XHMOC9ED2HlSOC', 'siswa', NULL, '2026-07-06 06:24:29', '2026-07-06 06:24:29'),
(188, 'DWI EVA ARIYANI', 'dwi.ariyani@siswa.smansago.com', NULL, '$2y$12$ChOfH7ulQzcZCAWTv89BFexdo9MuigveMrpzn7MbtOH/ys.IW.cD6', 'siswa', NULL, '2026-07-06 06:24:29', '2026-07-06 06:24:29'),
(189, 'DWI INDRIANA', 'dwi.indriana@siswa.smansago.com', NULL, '$2y$12$o9PiVLewCAOiBJ7WfWCsKOi9EpCpwIAx47NNTkH59jlSawL/avIwO', 'siswa', NULL, '2026-07-06 06:24:29', '2026-07-06 06:24:29'),
(190, 'ERDITA WAHYU FEBRIYANTI', 'erdita.febriyanti@siswa.smansago.com', NULL, '$2y$12$Efyz.k8mteERqX8.KZr/CeA2A0vYLXPyBvyDbUTf57qZoJEO7qKsi', 'siswa', NULL, '2026-07-06 06:24:30', '2026-07-06 06:24:30'),
(191, 'FERA YUNIARTI', 'fera.yuniarti@siswa.smansago.com', NULL, '$2y$12$A7NTDh/uO7lYwDtjcnIcMuOx9/gx7CH3aCrWyIxLlNVh/KPV94jjK', 'siswa', NULL, '2026-07-06 06:24:30', '2026-07-06 06:24:30'),
(192, 'FERI ARDIYANTO', 'feri.ardiyanto@siswa.smansago.com', NULL, '$2y$12$ePdIkANXIAPdgtqD38NBTeAnpQgOHaQuoepRbSdV8ISitWer7SSVe', 'siswa', NULL, '2026-07-06 06:24:30', '2026-07-06 06:24:30'),
(193, 'HANIK IKA MUSLIKHAH', 'hanik.muslikhah@siswa.smansago.com', NULL, '$2y$12$pCi1o.i2u7.XA958O1q2GueGxb/.pylPQ7skq8LRhQmMZ8FkAw76q', 'siswa', NULL, '2026-07-06 06:24:30', '2026-07-06 06:24:30'),
(194, 'IQBAL AL GHIFFAARI', 'iqbal.ghiffaari@siswa.smansago.com', NULL, '$2y$12$T1SV7IJQRoByh3dSwau51.ZBJt4Ump0QIajDvy9sfQF4Ktty1ZOjG', 'siswa', NULL, '2026-07-06 06:24:31', '2026-07-06 06:24:31'),
(195, 'Joko Prasetiyo', 'joko.prasetiyo@siswa.smansago.com', NULL, '$2y$12$6hXqyBvemjyoy0j.huja6e.ZmbkaZkwMylCuBsNLEOJVIuxeOpLIq', 'siswa', NULL, '2026-07-06 06:24:31', '2026-07-06 06:24:31'),
(196, 'KEYZA JAZTYIN AYU DIA PRATIWI', 'keyza.pratiwi@siswa.smansago.com', NULL, '$2y$12$jOyqq2U3AK9zHddxsllb3.a4ucqhSCkyncpb8pJRJ7yzB8ZGxSsOG', 'siswa', NULL, '2026-07-06 06:24:31', '2026-07-06 06:24:31'),
(197, 'KUNTI DWI YULIANTI', 'kunti.yulianti@siswa.smansago.com', NULL, '$2y$12$VbvBareGX9p3LznJ3sYF4Oa1ka2wECyoyaKrc3iFKMBkjSkC5XdPW', 'siswa', NULL, '2026-07-06 06:24:32', '2026-07-06 06:24:32'),
(198, 'MUHAMAD AKHYAR AFRILIAN', 'muhamad.afrilian@siswa.smansago.com', NULL, '$2y$12$.ulIpfFJ8cMJCBIPCII8e.Ibke195kpZ7frtO6yQsjWQ7ealGQfO2', 'siswa', NULL, '2026-07-06 06:24:32', '2026-07-06 06:24:32'),
(199, 'MUHAMMAD IRGI FAHREZI', 'muhammad.fahrezi@siswa.smansago.com', NULL, '$2y$12$BZ4HSJt9/Dd565bUjxFkC.hm8h3YUg1ZCMesaoDbHA69ax9nqAT0.', 'siswa', NULL, '2026-07-06 06:24:32', '2026-07-06 06:24:32'),
(200, 'NASRIFA YUMNA HAQILA', 'nasrifa.haqila@siswa.smansago.com', NULL, '$2y$12$jO5UUv.i5F5h/3P8OCecwuwcntUACGo2S2JVtSAecxnljTY3uZa9O', 'siswa', NULL, '2026-07-06 06:24:32', '2026-07-06 06:24:32'),
(201, 'NISAUL AULIA', 'nisaul.aulia@siswa.smansago.com', NULL, '$2y$12$J5mnqoQJDSTBJCj7hvBXm.pMSZMhMUjdhn61O7ogZOaqlzU4Xs8Nu', 'siswa', NULL, '2026-07-06 06:24:32', '2026-07-06 06:24:32'),
(202, 'NOVAN DWI ANDIKA', 'novan.andika@siswa.smansago.com', NULL, '$2y$12$hT8hUA1W2qmVhsNTgVP1TOtzFlS6WgUbGIYfGAffqHU/OlqSI8rgq', 'siswa', NULL, '2026-07-06 06:24:33', '2026-07-06 06:24:33'),
(203, 'OLIFFIA YULIANA', 'oliffia.yuliana@siswa.smansago.com', NULL, '$2y$12$OPhhQFOw3RXWTYktMRCrSO109XsAjAMNuZ86VlOgB55b/5wvxDgqu', 'siswa', NULL, '2026-07-06 06:24:33', '2026-07-06 06:24:33'),
(204, 'RATNA KEISHA SALSABILA', 'ratna.salsabila@siswa.smansago.com', NULL, '$2y$12$YnBuxqL9fBjBE3TavVWiPO5Inq90SB4iF9RwagaAuwVj82Xj/tjhO', 'siswa', NULL, '2026-07-06 06:24:33', '2026-07-06 06:24:33'),
(205, 'RIDHO LEONEL ADITYA', 'ridho.aditya@siswa.smansago.com', NULL, '$2y$12$eaxM4AWcTEzcpgkmcr/OXeJNs5yb9M6Wn8.FouHqUmtK2F1njKwIe', 'siswa', NULL, '2026-07-06 06:24:33', '2026-07-06 06:24:33'),
(206, 'RIRIT BHARATA NINGTYAS', 'ririt.ningtyas@siswa.smansago.com', NULL, '$2y$12$bg3CcuQ0HocYrL3fRUXV4uX5WwbzCSGMtSTkPV4YlRAkPOxGMgfrK', 'siswa', NULL, '2026-07-06 06:24:34', '2026-07-06 06:24:34'),
(207, 'SASKIA ZAHRA AMANDA', 'saskia.amanda@siswa.smansago.com', NULL, '$2y$12$Wd1ipsQvA8UTdhOBcfhZoeQCVO/A8QcMWh74EIJFPAdRmTv3/SGK2', 'siswa', NULL, '2026-07-06 06:24:34', '2026-07-06 06:24:34'),
(208, 'SITI OKTAVIANI', 'siti.oktaviani@siswa.smansago.com', NULL, '$2y$12$iZQ3BojvuDJl/Wvp3xHDpeMdeEleD/F7dxWd.LHZiJsdTYDw2XaMm', 'siswa', NULL, '2026-07-06 06:24:34', '2026-07-06 06:24:34'),
(209, 'SLAMET TRIYANTO', 'slamet.triyanto@siswa.smansago.com', NULL, '$2y$12$VA2AuJyuSqaIAIxKUo1nBOilTH6YX4NpxASiXd0dOPrOubdjD7Bvu', 'siswa', NULL, '2026-07-06 06:24:34', '2026-07-06 06:24:34'),
(210, 'SRI MURNI', 'sri.murni@siswa.smansago.com', NULL, '$2y$12$boEWqDmU5pX3XDUsqHYtgeI.9g0DIYyGQ0IEJUUeNSrfM7s3Wue5K', 'siswa', NULL, '2026-07-06 06:24:35', '2026-07-06 06:24:35'),
(211, 'TIKA AULIA', 'tika.aulia@siswa.smansago.com', NULL, '$2y$12$rbBgi/2Z8vsu5vFToJKZc.erDERaOv58juygaBo9v5yqYqQiMzZUq', 'siswa', NULL, '2026-07-06 06:24:35', '2026-07-06 06:24:35'),
(212, 'USWATUN KHASANAH', 'uswatun.khasanah@siswa.smansago.com', NULL, '$2y$12$yRdQNhHkWX50m4mfeLvs2ue/u25nwZzYeKPYV9RMd7P7.60Nqp/Ji', 'siswa', NULL, '2026-07-06 06:24:35', '2026-07-06 06:24:35'),
(213, 'Wahyu Tri Mulyanto', 'wahyu.mulyanto@siswa.smansago.com', NULL, '$2y$12$zpfd52qoFrRfI0z2nv755Ot/3MRxzCJ0.pEfZU56EJrDIbGQnWccO', 'siswa', NULL, '2026-07-06 06:24:35', '2026-07-06 06:24:35'),
(214, 'WULAN AGUSTIN', 'wulan.agustin@siswa.smansago.com', NULL, '$2y$12$DmDI4vI20w3H6DMjcVmk4.fAAet.jLfswe2VjYHtf9VZVpKGTdXG6', 'siswa', NULL, '2026-07-06 06:24:36', '2026-07-06 06:24:36'),
(215, 'ZULFA ISNAINISA', 'zulfa.isnainisa@siswa.smansago.com', NULL, '$2y$12$SvG2/l.fwjCfGLq.a2oPLeOScJf8ouWqQ5H47BCWVACV6YiQ0wByS', 'siswa', NULL, '2026-07-06 06:24:36', '2026-07-06 06:24:36'),
(216, 'AIDA SYAHIRA', 'aida.syahira@siswa.smansago.com', NULL, '$2y$12$XuxOvShEokBDnkuKaZZSCeFuEJQIMrGe669d9UkEyIIkhIsgcHuG2', 'siswa', NULL, '2026-07-06 06:24:36', '2026-07-06 06:24:36'),
(217, 'ALFIN IRGIYANSAH', 'alfin.irgiyansah@siswa.smansago.com', NULL, '$2y$12$GXu7FyMzZnXT8ZZ8d9yLWOpPS05ffyP44jmX.DN8W8DhquA764/fW', 'siswa', NULL, '2026-07-06 06:24:36', '2026-07-06 06:24:36'),
(218, 'ALMIRA IKSANIA PUTRI', 'almira.putri@siswa.smansago.com', NULL, '$2y$12$lhddUKaJ6MgPUlFWUaEhOuDEnHRXN/GgpIZCA6wcC0VBXP24cq5OC', 'siswa', NULL, '2026-07-06 06:24:37', '2026-07-06 06:24:37'),
(219, 'ANDIKA PRATAMA', 'andika.pratama@siswa.smansago.com', NULL, '$2y$12$OmixSnp46bA7W0QNP.Xfd.efsfWI9d5K8YoxoFbhaeVUaQc88EhMG', 'siswa', NULL, '2026-07-06 06:24:37', '2026-07-06 06:24:37'),
(220, 'ARLINA TARA MAHENDRA', 'arlina.mahendra@siswa.smansago.com', NULL, '$2y$12$Y21l6Sfx4SiXpNf46W6qLekPn9qFeNTRRhbvAMuPVWq0ETYmDU9Ma', 'siswa', NULL, '2026-07-06 06:24:37', '2026-07-06 06:24:37'),
(221, 'AURA PUTRI KUSTIA WAL SOLEKHAH', 'aura.solekhah@siswa.smansago.com', NULL, '$2y$12$9l3XkYZ1lz1Aean9P88uXOV2bhSDhA7UCYBRnhqb0JLKuIlWcnkSa', 'siswa', NULL, '2026-07-06 06:24:38', '2026-07-06 06:24:38'),
(222, 'CHOIRUL UMAM', 'choirul.umam@siswa.smansago.com', NULL, '$2y$12$0yHK/8Yi1udIBjGy0Y0GE.egwBOMHssw2LnO4S//RgucIAe.hSNMu', 'siswa', NULL, '2026-07-06 06:24:38', '2026-07-06 06:24:38'),
(223, 'DESWITA DWI MAY RANI', 'deswita.rani@siswa.smansago.com', NULL, '$2y$12$5i/MCR83kwGiwT4NAsGPZus3uql/.8m38ET1G9nPxySQL89nC2C/K', 'siswa', NULL, '2026-07-06 06:24:38', '2026-07-06 06:24:38'),
(224, 'Dwi Indriyani', 'dwi.indriyani@siswa.smansago.com', NULL, '$2y$12$8XpB5WafGq8pijnXFXmYdugbC4/8yjX/YXC49.SPMbZifk/af544S', 'siswa', NULL, '2026-07-06 06:24:38', '2026-07-06 06:24:38'),
(225, 'Dwi Wicaksono', 'dwi.wicaksono@siswa.smansago.com', NULL, '$2y$12$tXJIuytQtRNXGhaACONXWemDUVhSJKPFHtFxvq69h6Pir2bhOLnnO', 'siswa', NULL, '2026-07-06 06:24:39', '2026-07-06 06:24:39'),
(226, 'ESHA SULISTIYANI', 'esha.sulistiyani@siswa.smansago.com', NULL, '$2y$12$8QT1zC.A1hucdkZJPPSSPeAgwWb4ZfCBlEMeYfaBPrMPBDkcggXY2', 'siswa', NULL, '2026-07-06 06:24:39', '2026-07-06 06:24:39'),
(227, 'FILIO KENZIE HAFEEZY', 'filio.hafeezy@siswa.smansago.com', NULL, '$2y$12$GWh2NHNd0EdyiPtiX/iClOun3cLPAoiAobWzBHZkjYVdLkyxF7bTq', 'siswa', NULL, '2026-07-06 06:24:39', '2026-07-06 06:24:39'),
(228, 'FITRI SHOLIKHAH', 'fitri.sholikhah@siswa.smansago.com', NULL, '$2y$12$Om6xBVUFT7oRMVuWqhDd4eugqq/4cjTfyNevKqHZOMUB8QnCCIrOO', 'siswa', NULL, '2026-07-06 06:24:39', '2026-07-06 06:24:39'),
(229, 'Ika Wahyuningsih', 'ika.wahyuningsih@siswa.smansago.com', NULL, '$2y$12$cy0xLEzSpNret5DgZv2NGuZT6vJNCNOoMhFt19Wz12LcCAGA3tWgu', 'siswa', NULL, '2026-07-06 06:24:39', '2026-07-06 06:24:39'),
(230, 'IRFAN AHMAD', 'irfan.ahmad@siswa.smansago.com', NULL, '$2y$12$7Ue7ERt7F8Wk.fgeWtlBy.T0krBNoJZy3fFoy8yNtkRdq.wD9q/dO', 'siswa', NULL, '2026-07-06 06:24:40', '2026-07-06 06:24:40'),
(231, 'Khailla Adelia Marsya', 'khailla.marsya@siswa.smansago.com', NULL, '$2y$12$fAlXNC6AV1hpSTMTZnQS1eVZqy5TpqHv52IXMvLY/j4sXP6TPLgIi', 'siswa', NULL, '2026-07-06 06:24:40', '2026-07-06 06:24:40'),
(232, 'KHARIZ IRFAN HAKIM', 'khariz.hakim@siswa.smansago.com', NULL, '$2y$12$oldaabt9vebeb3FIY6lh8On.2IVVOp2zM7Y4DyfKB3ugBJQuoi3WG', 'siswa', NULL, '2026-07-06 06:24:40', '2026-07-06 06:24:40'),
(233, 'LAUDYA DEVINA ANASTASYA', 'laudya.anastasya@siswa.smansago.com', NULL, '$2y$12$k5Ks.zIBzhBO/lA5PD9HD.hJMGmmXeQtM.HYLYwybxOsMAgj5OWtW', 'siswa', NULL, '2026-07-06 06:24:40', '2026-07-06 06:24:40'),
(234, 'MUHAMAD DINO WARDANA', 'muhamad.wardana@siswa.smansago.com', NULL, '$2y$12$8o.7EEP0way7VtiLb9RrdO5LjuTr5kSiw6QCALGL7pskINZUGrYHm', 'siswa', NULL, '2026-07-06 06:24:41', '2026-07-06 06:24:41'),
(235, 'MUHAMMAD RAFFA AL FADHIL', 'muhammad.fadhil@siswa.smansago.com', NULL, '$2y$12$OEbj92/jOG.QRCgIS76eT.1k./jmIfC46EP6wO9lGC.6q8ljuXKj2', 'siswa', NULL, '2026-07-06 06:24:41', '2026-07-06 06:24:41'),
(236, 'NATASYA NOVITA PUTRI', 'natasya.putri@siswa.smansago.com', NULL, '$2y$12$TJe0Q052ICICqiiTew3sn.FPOlvPI8wQLmpfU1fN.S7J/0aa8ADiS', 'siswa', NULL, '2026-07-06 06:24:41', '2026-07-06 06:24:41'),
(237, 'NIYA SELA PASHA ARDHILA', 'niya.ardhila@siswa.smansago.com', NULL, '$2y$12$/.LgWCtdeP0XDk88T.FL0ee.pXalJ5lGrcuOxU/IQwSOXZTNG4J66', 'siswa', NULL, '2026-07-06 06:24:42', '2026-07-06 06:24:42'),
(238, 'NOVIYANTO FARLY IRAWAN', 'noviyanto.irawan@siswa.smansago.com', NULL, '$2y$12$hKKCQPD3YddfJc2Aj3wXYOvMPL40AVnA.uMoxAn4GMm69htxC619u', 'siswa', NULL, '2026-07-06 06:24:42', '2026-07-06 06:24:42'),
(239, 'Olivia Ayyatul Khusna', 'olivia.khusna@siswa.smansago.com', NULL, '$2y$12$gr.SUs/zqkpocCZLY7JcpOjM6ow.86Maz0XVtYFsWWb9sAQjXZ7Sa', 'siswa', NULL, '2026-07-06 06:24:42', '2026-07-06 06:24:42'),
(240, 'RAUDHYA ZAHRA RASYIDAH', 'raudhya.rasyidah@siswa.smansago.com', NULL, '$2y$12$420Q7O20iHRbtG.8CliuGOs3QGeoHR8zXV8iMmqnXdIZ1uWTrb2rK', 'siswa', NULL, '2026-07-06 06:24:42', '2026-07-06 06:24:42'),
(241, 'RIO IRAWAN', 'rio.irawan@siswa.smansago.com', NULL, '$2y$12$OYqb1oQI/TM1Tr/TJyZUGOTg7P33w46Qks13btOUcIsqsWG0npAoG', 'siswa', NULL, '2026-07-06 06:24:43', '2026-07-06 06:24:43'),
(242, 'RISKA WAHYU SEPTIYANI', 'riska.septiyani@siswa.smansago.com', NULL, '$2y$12$IGAokL8.4ayBSiPpj7Do.Ohvia87ofDd/JwmJzw2U4AVfhEHY33Ty', 'siswa', NULL, '2026-07-06 06:24:43', '2026-07-06 06:24:43'),
(243, 'Sasya Eka Septiyasa', 'sasya.septiyasa@siswa.smansago.com', NULL, '$2y$12$gQ69cx4XgLnfqm8nxX3hUeAb7F/XFZAe2/IBZMJqnEVluW0Sp5zhW', 'siswa', NULL, '2026-07-06 06:24:43', '2026-07-06 06:24:43'),
(244, 'SITI PRIHATIN', 'siti.prihatin@siswa.smansago.com', NULL, '$2y$12$EfqcTjHQaVu7RBD4mo7/QeuC0v7arti6VtP79uuA4S8pft9opryj2', 'siswa', NULL, '2026-07-06 06:24:43', '2026-07-06 06:24:43'),
(245, 'SRI RAHAYU', 'sri.rahayu@siswa.smansago.com', NULL, '$2y$12$HZIPQPIEsL0ffOfbXTDiH.CLVs6lj2N3yv.vM6JvSKSFxlIAXMBEy', 'siswa', NULL, '2026-07-06 06:24:44', '2026-07-06 06:24:44'),
(246, 'SURYA ADISTI PUTRA', 'surya.putra@siswa.smansago.com', NULL, '$2y$12$w4hZZTwceIdKADF7W9uZnelvP5t2ewEF1sVW6lLWlOm9Y26o67T/q', 'siswa', NULL, '2026-07-06 06:24:44', '2026-07-06 06:24:44'),
(247, 'TRI HARTANTI', 'tri.hartanti@siswa.smansago.com', NULL, '$2y$12$vlxL9yGWHmU.xO.2nebqJeEAX1od4BQi1tKbxErRljakB2Fato0V2', 'siswa', NULL, '2026-07-06 06:24:44', '2026-07-06 06:24:44'),
(248, 'WAHYU FARAH AULIA', 'wahyu.aulia@siswa.smansago.com', NULL, '$2y$12$ldAsBDz55bfDcfP9FTvPdeE47J61aLb9YOP4Tvo8B4uH9cgier/Nu', 'siswa', NULL, '2026-07-06 06:24:44', '2026-07-06 06:24:44'),
(249, 'YAKA HUTAMA', 'yaka.hutama@siswa.smansago.com', NULL, '$2y$12$drza0mx/4QbWFsJ38WTg3uZWoSfilIEkkZwVoA/fZsHivcFxgkS0O', 'siswa', NULL, '2026-07-06 06:24:45', '2026-07-06 06:24:45'),
(250, 'YAMANDA TIYASTUTI', 'yamanda.tiyastuti@siswa.smansago.com', NULL, '$2y$12$N1pHoMGiHfD2xJpJgqcBYu99Zk/Fh.6rUwUJhSJN099vnQb8LKoL.', 'siswa', NULL, '2026-07-06 06:24:45', '2026-07-06 06:24:45'),
(251, 'ZULFA NUR AZIZAH', 'zulfa.azizah@siswa.smansago.com', NULL, '$2y$12$t3LvkxDOakriTv2tx8Tu1eti1D8vGjywoMkeP4PK/GW.Ms1l59vPS', 'siswa', NULL, '2026-07-06 06:24:45', '2026-07-06 06:24:45'),
(252, 'ADITIA SAPUTRA', 'aditia.saputra@siswa.smansago.com', NULL, '$2y$12$nYS92K9lWVNLJ6pQyZh63uUvwDGgMWzpCB59Ma6rQQJ.lwaZEvOqu', 'siswa', NULL, '2026-07-06 06:24:45', '2026-07-06 06:24:45'),
(253, 'AISYAH PUTRI AZZAHRA', 'aisyah.azzahra@siswa.smansago.com', NULL, '$2y$12$fwcm4BuV9HgT5Eat0WTAFO8v38AdlLw4lk8xZU6NXDDjzjyKBPLWW', 'siswa', NULL, '2026-07-06 06:24:46', '2026-07-06 06:24:46'),
(254, 'ALI ZAINAL ABIDIN', 'ali.abidin@siswa.smansago.com', NULL, '$2y$12$xq.QOwpzHTnIqfhItwp/XuvN4fh3j1DNejgrU5KbhgNtyOlYeu.jC', 'siswa', NULL, '2026-07-06 06:24:46', '2026-07-06 06:24:46'),
(255, 'ALYARISMA DEVINA ANGGRAENI', 'alyarisma.anggraeni@siswa.smansago.com', NULL, '$2y$12$jCcr/BiLOzFaIYkh00XbaO16OWigG.6G1gQnCfPlIZvoES5tMRaAO', 'siswa', NULL, '2026-07-06 06:24:46', '2026-07-06 06:24:46'),
(256, 'ARDIAN BINTANG PRAMUDITA', 'ardian.pramudita@siswa.smansago.com', NULL, '$2y$12$dOGUEX3vAIC0EC5ulQNrwOAZLN62DhCGP.iV1CxtTfceeeZkl4KDC', 'siswa', NULL, '2026-07-06 06:24:47', '2026-07-06 06:24:47'),
(257, 'ARYA SAFITRI', 'arya.safitri@siswa.smansago.com', NULL, '$2y$12$B6bNvR1x5MGqgLSEjuU/Eua6SvOny/hN./40T4HYajmXajaP0kr4S', 'siswa', NULL, '2026-07-06 06:24:47', '2026-07-06 06:24:47');
INSERT INTO `pengguna` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(258, 'BERLINA PURNAMA NUGRAHANI', 'berlina.nugrahani@siswa.smansago.com', NULL, '$2y$12$kv3E99bgjjcVyiosRFHU2.Ol60GYhmrb.KcBui1LPIIcuwxMofrn6', 'siswa', NULL, '2026-07-06 06:24:47', '2026-07-06 06:24:47'),
(259, 'DEDY NOVANDI', 'dedy.novandi@siswa.smansago.com', NULL, '$2y$12$sDHBhS7ER5PBhd7LqHNZT.pb1ycTdnolF2BspHccJ9uS2nbr9cBgq', 'siswa', NULL, '2026-07-06 06:24:47', '2026-07-06 06:24:47'),
(260, 'DEVIANA BELLA SASKIA', 'deviana.saskia@siswa.smansago.com', NULL, '$2y$12$YU4NIzLye2OJ8eMCcw4/..1GgdXBeLSfMgem2DoUp.43YMbo.uTW.', 'siswa', NULL, '2026-07-06 06:24:48', '2026-07-06 06:24:48'),
(261, 'ECKA RIDO SETYONO', 'ecka.setyono@siswa.smansago.com', NULL, '$2y$12$cepWF4NXR6AYSwKG3cI5i.cPrDcqWhOU8ugToaUFPZdCi2SVd0zDy', 'siswa', NULL, '2026-07-06 06:24:48', '2026-07-06 06:24:48'),
(262, 'EDRIA THEDA MUFARIHAH', 'edria.mufarihah@siswa.smansago.com', NULL, '$2y$12$TOqSeZE3nV4podQEDtStbOTVnrffKZAnr8fUcpqs3nPFi69ml6COu', 'siswa', NULL, '2026-07-06 06:24:48', '2026-07-06 06:24:48'),
(263, 'EVA APRILIA SAFITRI', 'eva.safitri@siswa.smansago.com', NULL, '$2y$12$DzhK8Ks9pvtW3akAO8fmeutWR8gXaY.Y.HCnBg.HzmFCRZr.aRywe', 'siswa', NULL, '2026-07-06 06:24:48', '2026-07-06 06:24:48'),
(264, 'FRISKA YOGI WAHYUNINGTYAS', 'friska.wahyuningtyas@siswa.smansago.com', NULL, '$2y$12$udWFIR0vXoQKxqZMiT836uyymQIKgEaIznbm1cgl45kDNnsg0jK3O', 'siswa', NULL, '2026-07-06 06:24:49', '2026-07-06 06:24:49'),
(265, 'GABRILIA MUTIARA SARI', 'gabrilia.sari@siswa.smansago.com', NULL, '$2y$12$hcQHZLJOZWea9Hfto7HYS.qbMEqrohyelC3X2E8GxltIlIEPzVyeO', 'siswa', NULL, '2026-07-06 06:24:49', '2026-07-06 06:24:49'),
(266, 'IKHDA ANNISA RAHMAH', 'ikhda.rahmah@siswa.smansago.com', NULL, '$2y$12$cs6dJ0Z9ML6rcRlnSkpHaeMvGVXOe.g3MhUilGETXBH.fZ.24Uar.', 'siswa', NULL, '2026-07-06 06:24:49', '2026-07-06 06:24:49'),
(267, 'IRFAN DWI SETIAWAN', 'irfan.setiawan@siswa.smansago.com', NULL, '$2y$12$9bdAxziALbYloyjNqWR3sOQfct5hJ4gsP0W8up9z7OwOU/qG8T5rK', 'siswa', NULL, '2026-07-06 06:24:49', '2026-07-06 06:24:49'),
(268, 'KHAIRUNISA AZAHRA RAMADANI', 'khairunisa.ramadani@siswa.smansago.com', NULL, '$2y$12$.AnlTctwFM6.ldcQnZcpgeJcDV5M0gi4/0gZxKnEuiIK9pxl4IIgO', 'siswa', NULL, '2026-07-06 06:24:50', '2026-07-06 06:24:50'),
(269, 'KURNIAWAN SIDIK BAYU PRAKOSO', 'kurniawan.prakoso@siswa.smansago.com', NULL, '$2y$12$Y/pYk3MCKKQUldTbuAStje47eJ7yNWo2txukda4jjvc7hH41KFG6G', 'siswa', NULL, '2026-07-06 06:24:50', '2026-07-06 06:24:50'),
(270, 'LILIK SRI LESTARI', 'lilik.lestari@siswa.smansago.com', NULL, '$2y$12$6SkHW.aaUyc/XnbShAQs7.VVjRfJwwML2Ty50USZ.vDt9iH/1FyiC', 'siswa', NULL, '2026-07-06 06:24:50', '2026-07-06 06:24:50'),
(271, 'Muhammad Affandi Arsyad Yuono Putra', 'muhammad.putra@siswa.smansago.com', NULL, '$2y$12$I9ISrRKcxP/new0/nq50GOwUnGXNjBO9qXckI1AI.eSQlFMcC/NR.', 'siswa', NULL, '2026-07-06 06:24:50', '2026-07-06 06:24:50'),
(272, 'MUHAMMAD RIZAL ALYAZID', 'muhammad.alyazid@siswa.smansago.com', NULL, '$2y$12$Pi7iDRUCDNHsr2emLl9Y6enoBdnDAS0udIAqlIrOdlt3kBIBmHnAS', 'siswa', NULL, '2026-07-06 06:24:51', '2026-07-06 06:24:51'),
(273, 'Natasya Yunika Putri', 'natasya.putri1@siswa.smansago.com', NULL, '$2y$12$aCD6CdOmNZdd71ZKSKVZf.ZBpeW6vPrUpyWcjbjficQA4xB3qhZXO', 'siswa', NULL, '2026-07-06 06:24:51', '2026-07-06 06:24:51'),
(274, 'NOVI KURNIASARI', 'novi.kurniasari@siswa.smansago.com', NULL, '$2y$12$YvwJ5WzCcyBdbee7GrOmG.c871PlwhWOwXPgK20r2yBfvG47NGJgq', 'siswa', NULL, '2026-07-06 06:24:51', '2026-07-06 06:24:51'),
(275, 'NUR FAISAL', 'nur.faisal@siswa.smansago.com', NULL, '$2y$12$Xs70jmf76Yt/byc2k/nV9emR8QiTnOjO/ajhzK/7kgXKkU0OrIyTy', 'siswa', NULL, '2026-07-06 06:24:51', '2026-07-06 06:24:51'),
(276, 'PIPIT SRI HANDAYANI', 'pipit.handayani@siswa.smansago.com', NULL, '$2y$12$92M//eN.adLtz9QmmM5iU.HvHG9/voEdOU/P3aDVB8lBFSR9IHt.m', 'siswa', NULL, '2026-07-06 06:24:52', '2026-07-06 06:24:52'),
(277, 'RAYKHANUN NOVA REZQIANI', 'raykhanun.rezqiani@siswa.smansago.com', NULL, '$2y$12$1XG573pw.TGFa5FsCLmHme01Dx2wvdU8bSzA1MtnP03B7gVzSAXQy', 'siswa', NULL, '2026-07-06 06:24:52', '2026-07-06 06:24:52'),
(278, 'RISKY FADILAH', 'risky.fadilah@siswa.smansago.com', NULL, '$2y$12$NjPUrjAxDyHt6k3zj.1XTOoUIM9Yy7lhEhJtpKjrVmBiUcOw9p3u2', 'siswa', NULL, '2026-07-06 06:24:52', '2026-07-06 06:24:52'),
(279, 'ROICHAN AHMAD ARROYANI', 'roichan.arroyani@siswa.smansago.com', NULL, '$2y$12$jrRlLP1q6u4kgpxj.3A0Q.DHO6Zl0rnbcetLoWr.SEUBvfq/H/7Zm', 'siswa', NULL, '2026-07-06 06:24:52', '2026-07-06 06:24:52'),
(280, 'SAVA LESTARI', 'sava.lestari@siswa.smansago.com', NULL, '$2y$12$r0rVa4dHOZ/.1Z2Za79SpuzXoXQpjafi0Jh7S1PWLwSn3i5Mi/P6q', 'siswa', NULL, '2026-07-06 06:24:53', '2026-07-06 06:24:53'),
(281, 'SITI ROHANA', 'siti.rohana@siswa.smansago.com', NULL, '$2y$12$weY0wWxUK9GEjw2TQu4Cj.AHl84F7qjlohHCddKHRCVlFJ4cpoDVa', 'siswa', NULL, '2026-07-06 06:24:53', '2026-07-06 06:24:53'),
(282, 'STIYA WATIK', 'stiya.watik@siswa.smansago.com', NULL, '$2y$12$QfJmHIfjzqx9t9ZIYfnGwuQjhNLTqKFe2u/utS5OsTOXFHUbssClG', 'siswa', NULL, '2026-07-06 06:24:53', '2026-07-06 06:24:53'),
(283, 'SYARIF HIDAYATULLAH', 'syarif.hidayatullah@siswa.smansago.com', NULL, '$2y$12$oTeHXiH7foEswXDGZmAgCeCJ4lso.81YX7KoWHWYCtFmajo0xNL/q', 'siswa', NULL, '2026-07-06 06:24:53', '2026-07-06 06:24:53'),
(284, 'TRI LISTIYANINGSIH', 'tri.listiyaningsih@siswa.smansago.com', NULL, '$2y$12$RFftNGStzpFpXS8ZKYPqreCEwJocq0yS5dMcbBwLhJ8.MK9S2qpA.', 'siswa', NULL, '2026-07-06 06:24:54', '2026-07-06 06:24:54'),
(285, 'WAHYU KHAMIDHATU ZUHRIYA', 'wahyu.zuhriya@siswa.smansago.com', NULL, '$2y$12$BN8./XZBf1ZBIMpFfBQA1.waExctKnZaa5gTNovQ4.FAZ2/en0.b6', 'siswa', NULL, '2026-07-06 06:24:54', '2026-07-06 06:24:54'),
(286, 'YOGA KURNIYAWAN', 'yoga.kurniyawan@siswa.smansago.com', NULL, '$2y$12$1Gwz3UyqDlSdGwJgekj3duGYL0QxAQMRFp/StPz/xmiZsS3mDnx/6', 'siswa', NULL, '2026-07-06 06:24:54', '2026-07-06 06:24:54'),
(287, 'YULMIA KIRANI AZIZAH', 'yulmia.azizah@siswa.smansago.com', NULL, '$2y$12$Y0JSHtSrcQEN7o2ZLUG6I.R2R7t4P14QpOQU51b7VBQmFLQ4RSQPK', 'siswa', NULL, '2026-07-06 06:24:54', '2026-07-06 06:24:54'),
(288, 'Abdul Hafizh Mardiyanto', 'abdul.mardiyanto@siswa.smansago.com', NULL, '$2y$12$xofZqWx7wck6oZEcAmCN2O.jXPDedFsbTCJyKtTPJJh1LFBGlmWui', 'siswa', NULL, '2026-07-06 06:24:55', '2026-07-09 07:36:50'),
(289, 'ADITYA PRADANA FIKI ARDIANSYAH', 'aditya.ardiansyah@siswa.smansago.com', NULL, '$2y$12$1fYvRUPXmJb5cvjGygtqie9fxmOuaqFhzv.NvaxvtzkYwVgQNQHX6', 'siswa', NULL, '2026-07-06 06:24:55', '2026-07-09 07:33:11'),
(290, 'AGENG BUDI HARJO', 'ageng.harjo@siswa.smansago.com', NULL, '$2y$12$.0wqp2I4aEU3dq1LgmhD8.TwgiMe.0rSHaALfGenFDz7v0U/WWXwq', 'siswa', NULL, '2026-07-06 06:24:55', '2026-07-06 06:24:55'),
(291, 'AHMAD ZAENURI', 'ahmad.zaenuri@siswa.smansago.com', NULL, '$2y$12$EV3NYV.4TtXRtKSDnOUAxuOE4NB92gS4oPJs2USH4E.2RgMIA/h5q', 'siswa', NULL, '2026-07-06 06:24:55', '2026-07-06 06:24:55'),
(292, 'ALLEA SASTRA ALMA FAISHA', 'allea.faisha@siswa.smansago.com', NULL, '$2y$12$gxjerm6o86rH/P5qdcr.Ce82/T722ponFWrPpD3AQnCZiuOw1MatW', 'siswa', NULL, '2026-07-06 06:24:56', '2026-07-06 06:24:56'),
(293, 'Angga Setiawan', 'angga.setiawan@siswa.smansago.com', NULL, '$2y$12$V2JEZGblCaPM5.wgR/9HT.2bvXA.TcLUsMVANEbtDsivbyf/6a3J.', 'siswa', NULL, '2026-07-06 06:24:56', '2026-07-06 06:24:56'),
(294, 'ARES WIDODO', 'ares.widodo@siswa.smansago.com', NULL, '$2y$12$wnnWTKXVH/Ln9WerVdBG3eZX7WFjZMPux5im1bMYOjyVYkwY8LS3a', 'siswa', NULL, '2026-07-06 06:24:56', '2026-07-06 06:24:56'),
(295, 'DANANG SULISTYO', 'danang.sulistyo@siswa.smansago.com', NULL, '$2y$12$6A9LEgrr5fd5LDHEWvLqZuXzEqFkgC4ORakE9PvKe92ZYm/zbLt5O', 'siswa', NULL, '2026-07-06 06:24:56', '2026-07-06 06:24:56'),
(296, 'DIMAS RAIKHAN DEWANTORO', 'dimas.dewantoro@siswa.smansago.com', NULL, '$2y$12$4aHBVF7rj9Jj3jmf0M/jgeU21Lpp3Bz5HwlvZ/mo4j3h56sWuPIa2', 'siswa', NULL, '2026-07-06 06:24:57', '2026-07-06 06:24:57'),
(297, 'DZAKY RAIHAN PUTRA PRATHAMA', 'dzaky.prathama@siswa.smansago.com', NULL, '$2y$12$18yyEbisxKVYH/OeOFOSG.NyUk7POWljVUBSz87md/sBeWg13kkqS', 'siswa', NULL, '2026-07-06 06:24:57', '2026-07-06 06:24:57'),
(298, 'FARHAN WIRA ARDIAN MAULANA', 'farhan.maulana@siswa.smansago.com', NULL, '$2y$12$UxmA4poqa3Ztm.Uri4M4S.FSthVCxGMPFlV7YVXw.VYnFMw35noKa', 'siswa', NULL, '2026-07-06 06:24:57', '2026-07-06 06:24:57'),
(299, 'GALIH REHANANTO', 'galih.rehananto@siswa.smansago.com', NULL, '$2y$12$N1ANOKz2H3EtzvvM3W67g.recaTSl6NTLiSqLzFsaMyt.sePKXFPS', 'siswa', NULL, '2026-07-06 06:24:57', '2026-07-06 06:24:57'),
(300, 'HABIBUR RAHMAN', 'habibur.rahman@siswa.smansago.com', NULL, '$2y$12$MkTNulDBSDARr8DkgqXMjOiQYEJNyFAjROnhyW9Q4BhCJeUBN5wa6', 'siswa', NULL, '2026-07-06 06:24:58', '2026-07-06 06:24:58'),
(301, 'Ilham Taukhid Mustakim', 'ilham.mustakim@siswa.smansago.com', NULL, '$2y$12$IzKAs95w2y54.7Z9ebYXPu6rxqzuyCTkVzYUO8hV1iu8r6VZR8xi6', 'siswa', NULL, '2026-07-06 06:24:58', '2026-07-06 06:24:58'),
(302, 'Ivan Galih Maulana', 'ivan.maulana@siswa.smansago.com', NULL, '$2y$12$G5kiW2EjVhvfz5P9Z9T.G.Ok245X8oaNNHYyetQlNJCxglMnNPgne', 'siswa', NULL, '2026-07-06 06:24:58', '2026-07-06 06:24:58'),
(303, 'Jesika Rahma Maulana', 'jesika.maulana@siswa.smansago.com', NULL, '$2y$12$gG.aq4S4AAige4lg0FhHJ.1tx7HvtouAE7xcg5bmjViJNQaLcs13a', 'siswa', NULL, '2026-07-06 06:24:58', '2026-07-06 06:24:58'),
(304, 'JOICE IVANIA', 'joice.ivania@siswa.smansago.com', NULL, '$2y$12$3cZrryGmqhBVgurFrHxtre8UDZQ4yRF2Uj08L1O59.ZLWtLpO8n2y', 'siswa', NULL, '2026-07-06 06:24:59', '2026-07-06 06:24:59'),
(305, 'KHALILA ESTA PUTRI', 'khalila.putri@siswa.smansago.com', NULL, '$2y$12$m5fyVi14IbcNyeJBjyoBFugVgTImwBhKZ8gsNAA.ZqblxqWqsKNPW', 'siswa', NULL, '2026-07-06 06:24:59', '2026-07-06 06:24:59'),
(306, 'LATIFA AZZARA', 'latifa.azzara@siswa.smansago.com', NULL, '$2y$12$eLnbODp3LBA3knnGaP/OqOKaMy7.TrqZCyEwj01.9eDWQ1RtO4zh2', 'siswa', NULL, '2026-07-06 06:24:59', '2026-07-06 06:24:59'),
(307, 'Listianingsih', 'listianingsih@siswa.smansago.com', NULL, '$2y$12$Lc2eIaqs.n0N8hbqGWBcmufUKfjx9yFdUqRcYUVE6flQT0yqnUoty', 'siswa', NULL, '2026-07-06 06:24:59', '2026-07-06 06:24:59'),
(308, 'MOHAMAD YOGA PRATAMA', 'mohamad.pratama@siswa.smansago.com', NULL, '$2y$12$texgaJpD1t8qgPwc2cdKc.tMn29EAHCZz4ShAFOVU3VvUiH1dF9.G', 'siswa', NULL, '2026-07-06 06:24:59', '2026-07-06 06:24:59'),
(309, 'MUGHNI LAFIF AL LATIEF', 'mughni.latief@siswa.smansago.com', NULL, '$2y$12$lF3b7856mc/2.Y62vN6U5.OLjLMYOa/hNZLvb7Pc6fSZ5uHfdkt1q', 'siswa', NULL, '2026-07-06 06:25:00', '2026-07-06 06:25:00'),
(310, 'MUHYI ASRORI FUADY', 'muhyi.fuady@siswa.smansago.com', NULL, '$2y$12$P3awlRX6Pyspc.7ixQ4n8OxgRIVmabrICOFGdrfrceyOrNFYEj2QW', 'siswa', NULL, '2026-07-06 06:25:00', '2026-07-06 06:25:00'),
(311, 'NASYWA NATHANIA JASMINE', 'nasywa.jasmine@siswa.smansago.com', NULL, '$2y$12$YJXKVzrcYF6LQLgUSgd5yuJsgZ.NTFox2fB6JxLnMv2exGLtLhaHe', 'siswa', NULL, '2026-07-06 06:25:00', '2026-07-06 06:25:00'),
(312, 'NAZARI ADI LESMANA', 'nazari.lesmana@siswa.smansago.com', NULL, '$2y$12$0SWZvCiyFcrfDoBixPWZVOM.0TkFqZcnlUQwqFUQDpZOsxbptdJMO', 'siswa', NULL, '2026-07-06 06:25:01', '2026-07-06 06:25:01'),
(313, 'Nofa Setiadi', 'nofa.setiadi@siswa.smansago.com', NULL, '$2y$12$MH9uB7yd07AbnLo1ynbcwece7jLB7CfzOu8gDgNcboiwkS3VXW.Fu', 'siswa', NULL, '2026-07-06 06:25:01', '2026-07-06 06:25:01'),
(314, 'Novita Anisa Putri', 'novita.putri@siswa.smansago.com', NULL, '$2y$12$LNZFG4grs1iiDkygu6P33elOuaO0dhPxUQTTOz9n9kgHH1NWVXQLu', 'siswa', NULL, '2026-07-06 06:25:01', '2026-07-06 06:25:01'),
(315, 'Pipiet Nastiti Wulan', 'pipiet.wulan@siswa.smansago.com', NULL, '$2y$12$nL.lO24KWcvL8yOwNkKdmuY5mIq./lOqY8FMf/309VZ8d/aUWCD2i', 'siswa', NULL, '2026-07-06 06:25:01', '2026-07-06 06:25:01'),
(316, 'RAFA PUTRA PURWANA', 'rafa.purwana@siswa.smansago.com', NULL, '$2y$12$5yeuXzib7TX2ixM9MMD9Muk4oBzWZWVOHnrXiGWfqcQywxGuxbEK.', 'siswa', NULL, '2026-07-06 06:25:02', '2026-07-06 06:25:02'),
(317, 'RAFID AFFANDI', 'rafid.affandi@siswa.smansago.com', NULL, '$2y$12$M2W3/U69uMkSdhEUs7naCe8bAONba6tQfdl4yJP.H9zgHhrgUMuXW', 'siswa', NULL, '2026-07-06 06:25:02', '2026-07-06 06:25:02'),
(318, 'RAHARJA GALIH CANDRANANTA', 'raharja.candrananta@siswa.smansago.com', NULL, '$2y$12$RTglw5/d4skUZawwWh22dOB2ZEeNP2PL.V3nxDzar.Hx.WvMn8Kr.', 'siswa', NULL, '2026-07-06 06:25:02', '2026-07-06 06:25:02'),
(319, 'RIBANG RAIF RABANI', 'ribang.rabani@siswa.smansago.com', NULL, '$2y$12$U0pwUfXh4u6AwDoNCd/YsusBHNmTcED2gZKh0hgmMcssa9OstU5Gq', 'siswa', NULL, '2026-07-06 06:25:03', '2026-07-06 06:25:03'),
(320, 'SATYA NUGROHO', 'satya.nugroho@siswa.smansago.com', NULL, '$2y$12$HUlKq3zoFGzQOXDXdlUciuuK8AGeonfaKnANZhZjoT0Ju/LlroxAK', 'siswa', NULL, '2026-07-06 06:25:03', '2026-07-06 06:25:03'),
(321, 'SRI WAHYU RAHMADANI', 'sri.rahmadani@siswa.smansago.com', NULL, '$2y$12$kMVs.fH8tEsK2fKhvOwKoOYZgmbDGS5unjEhqgjLc2AuQTalz2.a6', 'siswa', NULL, '2026-07-06 06:25:03', '2026-07-06 06:25:03'),
(322, 'SUCI MAHARDIKA', 'suci.mahardika@siswa.smansago.com', NULL, '$2y$12$u2e7mEdHGHcKVfs816JvNulemxIFodxVrrFHnP5mc5z08l7gfbYjy', 'siswa', NULL, '2026-07-06 06:25:03', '2026-07-06 06:25:03'),
(323, 'YANTI IDA LESTARI', 'yanti.lestari@siswa.smansago.com', NULL, '$2y$12$N2Yks0dF.hfdfv6MyooLa.nXJey.s.X8bo4BATCbamNYkDzM87yN6', 'siswa', NULL, '2026-07-06 06:25:04', '2026-07-06 06:25:04'),
(324, 'Ambar Dwi Andhini', 'ambar.andhini@siswa.smansago.com', NULL, '$2y$12$1eZpjuFg5NPeBNlocxvScOPY0fwFcrBwFTcbSbvQvPv5YZwvIJ9XC', 'siswa', NULL, '2026-07-06 06:25:04', '2026-07-06 06:25:04'),
(325, 'AMELIA PUSPITA SARI', 'amelia.sari@siswa.smansago.com', NULL, '$2y$12$PvYo.Bwq26J1du3Y2yJdiemmsVcyK3W7NSvAGMUmqmdwMkzlkDNXa', 'siswa', NULL, '2026-07-06 06:25:04', '2026-07-06 06:25:04'),
(326, 'ANIS CAHYATI', 'anis.cahyati@siswa.smansago.com', NULL, '$2y$12$BQG9TaojdOAYwfUyAktAieK/zkYsf.QTbyuvwtOyqMO./yz6rRxMy', 'siswa', NULL, '2026-07-06 06:25:04', '2026-07-06 06:25:04'),
(327, 'Aqilla Khairunnisa', 'aqilla.khairunnisa@siswa.smansago.com', NULL, '$2y$12$OroWOolfgNL9kU0FxXlDgOoQE/cv06VrX3Dz.wCkApZWFyz9OExTW', 'siswa', NULL, '2026-07-06 06:25:05', '2026-07-06 06:25:05'),
(328, 'ARYA BIMA SAPUTRA', 'arya.saputra@siswa.smansago.com', NULL, '$2y$12$LZ7sXrTAHiReiDsDqRkdzOZur7LYxKenqzNbqSqD0rXhIF5.UQshC', 'siswa', NULL, '2026-07-06 06:25:05', '2026-07-06 06:25:05'),
(329, 'Azahra Azizatul Febriyana', 'azahra.febriyana@siswa.smansago.com', NULL, '$2y$12$4BuHprcTEH6Pwm8dAqhoyeS90cNP3NhpzAbV.3.DYnn7dYpclx/1y', 'siswa', NULL, '2026-07-06 06:25:05', '2026-07-06 06:25:05'),
(330, 'Denil Nur Faizin', 'denil.faizin@siswa.smansago.com', NULL, '$2y$12$sbvRayfQTFuRZjxHmBWGW.F7vPQYbzl9PEh9zguU7dNYuIX8DHVBi', 'siswa', NULL, '2026-07-06 06:25:05', '2026-07-06 06:25:05'),
(331, 'DESTA AYU ARISTA', 'desta.arista@siswa.smansago.com', NULL, '$2y$12$uQciqMnKeIrIzMw.fP.wx.pbsj0knFpddP6Yd0i7oxL/.AO4I2PMC', 'siswa', NULL, '2026-07-06 06:25:06', '2026-07-06 06:25:06'),
(332, 'DIAH AYU SILVIANA', 'diah.silviana@siswa.smansago.com', NULL, '$2y$12$wWMhiSV9QVO7bi32Z74jWeZpCWlr.XeCCXRdXMSMQdUwNjWzBGPw2', 'siswa', NULL, '2026-07-06 06:25:06', '2026-07-06 06:25:06'),
(333, 'DINDA DARA KUSUMA', 'dinda.kusuma@siswa.smansago.com', NULL, '$2y$12$v/5Hky/5VVj94rspSG7T1OBZUkQ2ElHavoWw4kvDmsaAyrJCHm74e', 'siswa', NULL, '2026-07-06 06:25:06', '2026-07-06 06:25:06'),
(334, 'DINI ASTUTI', 'dini.astuti@siswa.smansago.com', NULL, '$2y$12$NoznjKfLnOlbhCd5VrGO0OOH9ZR6q3evw55YV2KwIaTGlYrlbQhGe', 'siswa', NULL, '2026-07-06 06:25:06', '2026-07-06 06:25:06'),
(335, 'EKA AYU LESTARI', 'eka.lestari@siswa.smansago.com', NULL, '$2y$12$ZAmQA3JTT46RTkRUwRmpU.3hMRzyntdbzr3z2GDBHO08HjOTDYYA6', 'siswa', NULL, '2026-07-06 06:25:07', '2026-07-06 06:25:07'),
(336, 'EKA SEPTIANINGSIH', 'eka.septianingsih@siswa.smansago.com', NULL, '$2y$12$6ysAriQlZLo30guz6Auj6OrxbCAoE3ENolsq/IH5l7kIbCGfkqhxa', 'siswa', NULL, '2026-07-06 06:25:07', '2026-07-06 06:25:07'),
(337, 'ERISDA ANUNG WIDAYANI', 'erisda.widayani@siswa.smansago.com', NULL, '$2y$12$jn4iFAo1Vp6krzRmBUF9L.21S9TEwTK7Vk2jN138aWWUc0FelVSaW', 'siswa', NULL, '2026-07-06 06:25:07', '2026-07-06 06:25:07'),
(338, 'IKA WULANDARI', 'ika.wulandari@siswa.smansago.com', NULL, '$2y$12$x3ceeQS5xW3bg3Ph7wF5/emRpyINBDDmUoFr0OZjP4IEjWiWdTru6', 'siswa', NULL, '2026-07-06 06:25:07', '2026-07-06 06:25:07'),
(339, 'ILI YINNA SUFI AL-HAQ', 'ili.alhaq@siswa.smansago.com', NULL, '$2y$12$rHVkbeXx1B67M7DBp2VZbeI2qwy98teKp3xzrb16f94BxIuhCpvZy', 'siswa', NULL, '2026-07-06 06:25:07', '2026-07-06 06:25:07'),
(340, 'IMAM ABDUL AZIS', 'imam.azis@siswa.smansago.com', NULL, '$2y$12$Vl6wQ04ybfegGAStPSABHez.CzTObFntMXRWZ/bahzQPGMtnNCGk2', 'siswa', NULL, '2026-07-06 06:25:08', '2026-07-06 06:25:08'),
(341, 'JESIKA NOVITA RAHMAWATI', 'jesika.rahmawati@siswa.smansago.com', NULL, '$2y$12$7oC2OKc4dLDhprQBrxs9bu2II3NlRFdWFFA/5nFpSRY1JAYYht42m', 'siswa', NULL, '2026-07-06 06:25:08', '2026-07-06 06:25:08'),
(342, 'KAILA YULI YATI', 'kaila.yati@siswa.smansago.com', NULL, '$2y$12$Qx/.cPhsRRz9v/2xLcyURO1szKr7JQsJMGxOr1jEqUxHSvOLoqa4K', 'siswa', NULL, '2026-07-06 06:25:08', '2026-07-06 06:25:08'),
(343, 'KHARISA SUCI LESTARI', 'kharisa.lestari@siswa.smansago.com', NULL, '$2y$12$DghOsuCBR9pvVQesBjy2P.BmsgXE.S/MdF.AOsby1b1Wwq3YibL8.', 'siswa', NULL, '2026-07-06 06:25:08', '2026-07-06 06:25:08'),
(344, 'LUXVI ISTIANA ANNISA', 'luxvi.annisa@siswa.smansago.com', NULL, '$2y$12$Uraa5fWpXnFuCbaZ8S0Oqe9E529Tuv.zN9T8P9aWKEX5pIAZnrWRK', 'siswa', NULL, '2026-07-06 06:25:09', '2026-07-06 06:25:09'),
(345, 'META UTAMI', 'meta.utami@siswa.smansago.com', NULL, '$2y$12$0K3fL4wd8sB38cAm8QNKg.Ry8t5mszqKJxZmY8BX5m.NdAhsL4nAO', 'siswa', NULL, '2026-07-06 06:25:09', '2026-07-06 06:25:09'),
(346, 'MUTIA FIRDASARI', 'mutia.firdasari@siswa.smansago.com', NULL, '$2y$12$LOjUJpkl29D.BJmNMi371ONsxN7b4I6v00kDos1OxDpfAONNYS3Fu', 'siswa', NULL, '2026-07-06 06:25:09', '2026-07-06 06:25:09'),
(347, 'NITA FITRIYANI', 'nita.fitriyani@siswa.smansago.com', NULL, '$2y$12$vDGKdy9dQCoWFTNO1gibBOOX7MuIwgMUaDBLpMrUzsgUpXir1llae', 'siswa', NULL, '2026-07-06 06:25:09', '2026-07-06 06:25:09'),
(348, 'NOVALIA SAFITRI', 'novalia.safitri@siswa.smansago.com', NULL, '$2y$12$p9c7qLVpl47Lw6b1zjm.4.fCHXiefwi7sV7XhaZzWxPaByrYkw8Cu', 'siswa', NULL, '2026-07-06 06:25:10', '2026-07-06 06:25:10'),
(349, 'NOVITA ARUM SARI', 'novita.sari@siswa.smansago.com', NULL, '$2y$12$9.bDW/tfp6uL5o.yMf1sguBkZz4nXzBsxtwL/whuJpDsTaf/q2IBC', 'siswa', NULL, '2026-07-06 06:25:10', '2026-07-06 06:25:10'),
(350, 'Rezky Heru Nitha', 'rezky.nitha@siswa.smansago.com', NULL, '$2y$12$1nP8Qsfubhjm4La96JkrOOBLGTXfkb5fXgmYand2AnAqSrfQEyWRq', 'siswa', NULL, '2026-07-06 06:25:10', '2026-07-06 06:25:10'),
(351, 'RIZKY AMELIYA', 'rizky.ameliya@siswa.smansago.com', NULL, '$2y$12$JSNG7skBnLvqHGUfdnRmm.eEdyNDin1y4KgsUfABI.mwdEpniVWFy', 'siswa', NULL, '2026-07-06 06:25:10', '2026-07-06 06:25:10'),
(352, 'SALSABILAH AGUSTINA', 'salsabilah.agustina@siswa.smansago.com', NULL, '$2y$12$O8NuqtlIORuicl0rvL7P1.sDt/oHDO.BdFFG4ROWunNZUZ9i4Sbpa', 'siswa', NULL, '2026-07-06 06:25:11', '2026-07-06 06:25:11'),
(353, 'SRI BELA NOFITA', 'sri.nofita@siswa.smansago.com', NULL, '$2y$12$tT1.LgnW5GJrBgDoAi03GuBuPYJkoOmyz8Mjwnvu5jyea.NMAE9vu', 'siswa', NULL, '2026-07-06 06:25:11', '2026-07-06 06:25:11'),
(354, 'SYARIFA QUMAIRAH RAMADHANI', 'syarifa.ramadhani@siswa.smansago.com', NULL, '$2y$12$1DyeQuUftGHHkxfT.fM47OexAZUTy5pYUKxXsD6Z8bHk123Ia3qre', 'siswa', NULL, '2026-07-06 06:25:11', '2026-07-06 06:25:11'),
(355, 'TESALONIKA SHARON', 'tesalonika.sharon@siswa.smansago.com', NULL, '$2y$12$MESd8tuG/R.4u8ygwKvP5.POc59DDMUCbN8BRvKaHdcis6vtICGSW', 'siswa', NULL, '2026-07-06 06:25:11', '2026-07-06 06:25:11'),
(356, 'TRI APRILLIA MARDANI', 'tri.mardani@siswa.smansago.com', NULL, '$2y$12$v4KdDy1zyr2pM7zEWr0BGuf75Ngcy/ztRCd0w3p5O4dyqGLz4mDZa', 'siswa', NULL, '2026-07-06 06:25:12', '2026-07-06 06:25:12'),
(357, 'VITA RISTIANTI', 'vita.ristianti@siswa.smansago.com', NULL, '$2y$12$JVje/HkwpJTtoh15FXEyV.JfWgFVLLEfllBLyCqJNyPt1dAsn2xQS', 'siswa', NULL, '2026-07-06 06:25:12', '2026-07-06 06:25:12'),
(358, 'YULIANA WARISMA', 'yuliana.warisma@siswa.smansago.com', NULL, '$2y$12$4KRXRpYB7ZHwwWtwkcOLz.7yVjLJjqRcDZUZjZil5.SyulFbilrrW', 'siswa', NULL, '2026-07-06 06:25:12', '2026-07-06 06:25:12'),
(359, 'ZALFA\' AULIA NAJAH', 'zalfa.najah@siswa.smansago.com', NULL, '$2y$12$beJMoyCwhHVOLbTSHc1AJ.3P59KjUgg9P4bkRSXEHuyPIfLpeSVb.', 'siswa', NULL, '2026-07-06 06:25:12', '2026-07-06 06:25:12'),
(360, 'AIDINA FITRANI WULANDARI', 'aidina.wulandari@siswa.smansago.com', NULL, '$2y$12$2phL0rgGu/A0wfJNYFOvauNm6T0/qfGwUD5KBb/FkBXJNry9DFQdC', 'siswa', NULL, '2026-07-06 06:25:13', '2026-07-06 06:25:13'),
(361, 'AKHDAN GANTARI ATMAJA', 'akhdan.atmaja@siswa.smansago.com', NULL, '$2y$12$CzV/0RMFN.YR9JiyZSkEDeKjPWU0ngOMfpVasSVq0/FPt5eBmwD2m', 'siswa', NULL, '2026-07-06 06:25:13', '2026-07-06 06:25:13'),
(362, 'ALINEA TITIAN', 'alinea.titian@siswa.smansago.com', NULL, '$2y$12$FO2dFVnDSUuSv/fVuwLAy.7Cj53zJYyRrgxnUKJOA98QEZnv/ZO.2', 'siswa', NULL, '2026-07-06 06:25:13', '2026-07-06 06:25:13'),
(363, 'AMIRA ZAHWA AZIZAH', 'amira.azizah@siswa.smansago.com', NULL, '$2y$12$7e1YxQoy.EsIgw2Pz5mlFud7yStngb2T4zn63EK5bz7ucF0UydIrK', 'siswa', NULL, '2026-07-06 06:25:13', '2026-07-06 06:25:13'),
(364, 'ANANDA PUTRI', 'ananda.putri@siswa.smansago.com', NULL, '$2y$12$t3DH/WBq0HeU6qhrbGa1y.Qsen.S9Uc7d8hi.Qfg9kQz74BnupfKO', 'siswa', NULL, '2026-07-06 06:25:14', '2026-07-06 06:25:14'),
(365, 'ARUM FEBRIANTI', 'arum.febrianti@siswa.smansago.com', NULL, '$2y$12$K/mtfaAiFxJUz27cQtmBL.gtLeozQ/Fjwi3QQ/EerZI9gKf2i.I26', 'siswa', NULL, '2026-07-06 06:25:14', '2026-07-06 06:25:14'),
(366, 'AYU MALINA FEBRIYA', 'ayu.febriya@siswa.smansago.com', NULL, '$2y$12$NE4ClJ3GtB6lbaF/ToK4vuuBOL9rlAjpyAdnpyZoW1xll7.E.W8Uu', 'siswa', NULL, '2026-07-06 06:25:14', '2026-07-06 06:25:14'),
(367, 'BAMBANG PRI HARTANTO', 'bambang.hartanto@siswa.smansago.com', NULL, '$2y$12$ZY/ZG/efreQ71EPkiOZtHOK.ABeBOk3kPJHVTY4aG2vTxG4y5B9Jm', 'siswa', NULL, '2026-07-06 06:25:14', '2026-07-06 06:25:14'),
(368, 'EKA SITI AMINATUN', 'eka.aminatun@siswa.smansago.com', NULL, '$2y$12$qCrkHL5Ig6sOV2oBBGing.LtFUlkluMeiJHpjsNKl.1msGcZgZOXS', 'siswa', NULL, '2026-07-06 06:25:15', '2026-07-06 06:25:15'),
(369, 'ERIKA AULIA AMBARWATI', 'erika.ambarwati@siswa.smansago.com', NULL, '$2y$12$mygvDDtuxRucl6uaGOmmhu1Wbub0nVuCUKz0VwD3Cv9JxhUACau9i', 'siswa', NULL, '2026-07-06 06:25:15', '2026-07-06 06:25:15'),
(370, 'Fajar Puryanti', 'fajar.puryanti@siswa.smansago.com', NULL, '$2y$12$5kriRMooLfir7Dqwk4JJ8.PZP3lRF64TgnVgJ2O4wyoO1mC7zUyBy', 'siswa', NULL, '2026-07-06 06:25:15', '2026-07-06 06:25:15'),
(371, 'GIGIH BUDIYARTO', 'gigih.budiyarto@siswa.smansago.com', NULL, '$2y$12$gvxzYy9ciJendmZtQioO2.dor1kXHVz6meIGhonlUZ/Zn1ea/sU0C', 'siswa', NULL, '2026-07-06 06:25:15', '2026-07-06 06:25:15'),
(372, 'HABIBAH ELFARIZQI', 'habibah.elfarizqi@siswa.smansago.com', NULL, '$2y$12$hrqygPqv4OKjt9J50stUxe9pxbEuDSBG/mVldb5J.Thszk/972W9q', 'siswa', NULL, '2026-07-06 06:25:16', '2026-07-06 06:25:16'),
(373, 'HELNIDA RANNY TAKHEL', 'helnida.takhel@siswa.smansago.com', NULL, '$2y$12$zMLXmqDZeM03MwysaW3wqOWLUR46LizAexSfdrF.hxkpAsNBjXov6', 'siswa', NULL, '2026-07-06 06:25:16', '2026-07-06 06:25:16'),
(374, 'IKA NOVIANI', 'ika.noviani@siswa.smansago.com', NULL, '$2y$12$AOPKd/eg75D4LjPJ888i8O76t4JTU4SfvuGAKuP5Zbb3NyT1vESdy', 'siswa', NULL, '2026-07-06 06:25:16', '2026-07-06 06:25:16'),
(375, 'INTAN NURAINI', 'intan.nuraini@siswa.smansago.com', NULL, '$2y$12$Jjfo0F1SBP6SMU7k7caJbO6O6UV649MVueRi/eENFoVUZWGHde8cq', 'siswa', NULL, '2026-07-06 06:25:16', '2026-07-06 06:25:16'),
(376, 'Kholifah Alya Mufidah', 'kholifah.mufidah@siswa.smansago.com', NULL, '$2y$12$Cqguzh6zhqzv1AihftBAzurII5DCydCzTu9rj8BI8JtJ294l.HoYa', 'siswa', NULL, '2026-07-06 06:25:17', '2026-07-06 06:25:17'),
(377, 'LINDA SURYANI', 'linda.suryani@siswa.smansago.com', NULL, '$2y$12$fjzfL4GO51RCfxU3uhoEPeMnHSv8hxJi.IlLcpy58b8/U3lu2EpnC', 'siswa', NULL, '2026-07-06 06:25:17', '2026-07-06 06:25:17'),
(378, 'MASAYU DIVA KHARISMA', 'masayu.kharisma@siswa.smansago.com', NULL, '$2y$12$NXySE16aAL/COKma2Ltqx.B8SyYQ.NOCifCWhEggWN/wVacirOxyK', 'siswa', NULL, '2026-07-06 06:25:17', '2026-07-06 06:25:17'),
(379, 'MAULIANA RAHMANING TYAS', 'mauliana.tyas@siswa.smansago.com', NULL, '$2y$12$pJgBJH92.SbafK2Y5zgi1OMHtNNRrCnWyGkwCny0RRvvoQgQJEgHa', 'siswa', NULL, '2026-07-06 06:25:17', '2026-07-06 06:25:17'),
(380, 'Melinda Nadine Saputri', 'melinda.saputri@siswa.smansago.com', NULL, '$2y$12$RmRDc2u4ncQpeBNje2Mwf.SnwgxWSXYhMFRSY4FhNvAZD2j9ydSk.', 'siswa', NULL, '2026-07-06 06:25:18', '2026-07-06 06:25:18'),
(381, 'Menik Sugiyarti', 'menik.sugiyarti@siswa.smansago.com', NULL, '$2y$12$o1o2NGyZKKon6pSv/e.HR.DCd/vurcequVsYiKVRfLkJyWOpmB5zW', 'siswa', NULL, '2026-07-06 06:25:18', '2026-07-06 06:25:18'),
(382, 'NADILA SYIFAURROHMAH', 'nadila.syifaurrohmah@siswa.smansago.com', NULL, '$2y$12$VrnDRoXWvNyHDhiHFIIqQOMjvDyNCCk5tHBF6AOJu7wqhcNnFjo8K', 'siswa', NULL, '2026-07-06 06:25:18', '2026-07-06 06:25:18'),
(383, 'NAURA YASMIN ZAAFARANI', 'naura.zaafarani@siswa.smansago.com', NULL, '$2y$12$EfC4j8G8zFq480qifJhYweHsMSCoHR1e2biopisskCYtRdnCnIig.', 'siswa', NULL, '2026-07-06 06:25:18', '2026-07-06 06:25:18'),
(384, 'NUR ANGGA PRATAMA', 'nur.pratama@siswa.smansago.com', NULL, '$2y$12$UiMmTBM6ehDVKY4cPfizB.wDlD6X1.P6bLEXlSFCBt.MuBvf3ae2.', 'siswa', NULL, '2026-07-06 06:25:19', '2026-07-06 06:25:19'),
(385, 'NUR RAMADHANA NABABAN', 'nur.nababan@siswa.smansago.com', NULL, '$2y$12$t/Dmw5T.RmkBAyL/fix48.Ekz.B1q077zJgKzvSEeC8JjJDDxH4Uu', 'siswa', NULL, '2026-07-06 06:25:19', '2026-07-06 06:25:19'),
(386, 'NURUL EKA YULIANTI', 'nurul.yulianti@siswa.smansago.com', NULL, '$2y$12$AHS21eS2mNGAMKIz.cH.7.rB2rd2W3VdLaSxFjoxJPQsavxw9jyoa', 'siswa', NULL, '2026-07-06 06:25:19', '2026-07-06 06:25:19'),
(387, 'RAYA FITRIA OKTAFIANI', 'raya.oktafiani@siswa.smansago.com', NULL, '$2y$12$HxqHCsIur0o1kq1RyL2BBu.fJvYggD3Du9yKqyyUDNBZGDz6Hq.Zm', 'siswa', NULL, '2026-07-06 06:25:19', '2026-07-06 06:25:19'),
(388, 'REIVA STECY EKA LAURA', 'reiva.laura@siswa.smansago.com', NULL, '$2y$12$6Y2cjAnF4PKGJ5Ds.w6dpuA2vP1cBEvtfp7/lm3pCPBkTeXmdUok6', 'siswa', NULL, '2026-07-06 06:25:20', '2026-07-06 06:25:20'),
(389, 'SALSA AULIA PUTRI', 'salsa.putri@siswa.smansago.com', NULL, '$2y$12$7h/2ugll8eWluThKCYVpPOUQT21atoPr0gOB2Dd9eZVqM5YJNnYuW', 'siswa', NULL, '2026-07-06 06:25:20', '2026-07-06 06:25:20'),
(390, 'SRI WAHYU RAHMASARI', 'sri.rahmasari@siswa.smansago.com', NULL, '$2y$12$XNyEyPbzVPCcImbpTBdBt.bBFhjTlD/TN4481lbh9LvrEtzp3kFZS', 'siswa', NULL, '2026-07-06 06:25:20', '2026-07-06 06:25:20'),
(391, 'SYAFALINA ANISA FEBRIYANTI', 'syafalina.febriyanti@siswa.smansago.com', NULL, '$2y$12$7XjzmNaRgTjDn.adSAGK8uCTogz2lO59N.iCYVjpIjoSHdK4ioRsG', 'siswa', NULL, '2026-07-06 06:25:20', '2026-07-06 06:25:20'),
(392, 'VEGA UBIYANA', 'vega.ubiyana@siswa.smansago.com', NULL, '$2y$12$RswVBw4XTp4KLe/iPvedZOgfjdBhs9WdufaFNszSvgqpLL8/vDR4e', 'siswa', NULL, '2026-07-06 06:25:20', '2026-07-06 06:25:20'),
(393, 'YIN YANG KESHILA CHEUNG', 'yin.cheung@siswa.smansago.com', NULL, '$2y$12$xLeXDPZ8Lqjr/aBz.BjvEet3YzdNlb0yZQa7RT3rOTggoExntlP5G', 'siswa', NULL, '2026-07-06 06:25:21', '2026-07-06 06:25:21'),
(394, 'Zahra Fitri Septiana', 'zahra.septiana@siswa.smansago.com', NULL, '$2y$12$XaF4reZ63ri1d2LEhO1JrOzskVZO0oUYZez0mFMTJ7lyr8QdO9s/q', 'siswa', NULL, '2026-07-06 06:25:21', '2026-07-06 06:25:21'),
(395, 'Adi Heri Pramono', 'adi.pramono@siswa.smansago.com', NULL, '$2y$12$mO9Cbecvf9aaDJXg2n0ARuyMmBDLvShIuRDI5wxPZVdG3ZTF8QekO', 'siswa', NULL, '2026-07-06 06:25:21', '2026-07-06 06:25:21'),
(396, 'Akna Mumtaz Ilmi', 'akna.ilmi@siswa.smansago.com', NULL, '$2y$12$trC6L9ewh6d5Dl.FGLWwH.zFyxfnZHprl/Cvoa1Ofkw7Pkj3dXdie', 'siswa', NULL, '2026-07-06 06:25:22', '2026-07-06 06:25:22'),
(397, 'ANGGUN SAL SABILA', 'anggun.sabila@siswa.smansago.com', NULL, '$2y$12$tAcwZvDCybEtXKsITgZ6beytqzrRgDyXVcTIL5a1cXVAQkyEfME5m', 'siswa', NULL, '2026-07-06 06:25:22', '2026-07-06 06:25:22'),
(398, 'ANUGRAH MAULINA RAHMAWATI', 'anugrah.rahmawati@siswa.smansago.com', NULL, '$2y$12$SLW1PEIJWua2h6eiC.w0BO96UqBu8m7H2XttpSXWMEnNGxMsBzFT6', 'siswa', NULL, '2026-07-06 06:25:22', '2026-07-06 06:25:22'),
(399, 'Asri Arum Ningtyas', 'asri.ningtyas@siswa.smansago.com', NULL, '$2y$12$n/bdLgA8PAFVh42zdKDGherygW/Y6R0GrBT2djrOfBi9o0KQAFdme', 'siswa', NULL, '2026-07-06 06:25:22', '2026-07-06 06:25:22'),
(400, 'AULIA DINDA PRAMASTYA', 'aulia.pramastya@siswa.smansago.com', NULL, '$2y$12$uwNFFhhH5bBZaoeypXaN/ueQeahFDOFXKMj4fqoBzJtBBogWkSajm', 'siswa', NULL, '2026-07-06 06:25:22', '2026-07-06 06:25:22'),
(401, 'AULITA TRI KUMANDA YAFI', 'aulita.yafi@siswa.smansago.com', NULL, '$2y$12$Us6yuJbSFperrvUVyFOpbuSqByFYTN.DOxYHjJTHcGsZ.k9oQsuxC', 'siswa', NULL, '2026-07-06 06:25:23', '2026-07-06 06:25:23'),
(402, 'AYUDYA PRATIWI', 'ayudya.pratiwi@siswa.smansago.com', NULL, '$2y$12$AynZW6UBYK2YRCiQ3b06Fen1ulSnzjRHkK8o4wCwDoFqu0g0si5X.', 'siswa', NULL, '2026-07-06 06:25:23', '2026-07-06 06:25:23'),
(403, 'BAYU AJI PURNOMO', 'bayu.purnomo@siswa.smansago.com', NULL, '$2y$12$Bbi.p4/Wp8RhWGx4LfmrUuAUFER4he4amiEDhebLD.IcTAUt8HjUe', 'siswa', NULL, '2026-07-06 06:25:23', '2026-07-06 06:25:23'),
(404, 'DEA FATMAWATI', 'dea.fatmawati@siswa.smansago.com', NULL, '$2y$12$JdiHo4SS3hHbio86Nn2amOeUQzKuuZeHl7.iaS/RzGAWlEO22va5S', 'siswa', NULL, '2026-07-06 06:25:23', '2026-07-06 06:25:23'),
(405, 'DESI LUSIANA PURNAMASARI', 'desi.purnamasari@siswa.smansago.com', NULL, '$2y$12$vx8/Ed0h3kkkkXO5RSj18ObK/QkAjBznWHtI7ejEpgBa54q1.XruK', 'siswa', NULL, '2026-07-06 06:25:24', '2026-07-06 06:25:24'),
(406, 'DHEA SAFIRA', 'dhea.safira@siswa.smansago.com', NULL, '$2y$12$hjmLicdYMbFpOqMBQ1XeH.6jtq/WwWy4hFbAdyrUXBTyEUN/ABQI6', 'siswa', NULL, '2026-07-06 06:25:24', '2026-07-06 06:25:24'),
(407, 'DIVA TRI ANDRIANI', 'diva.andriani@siswa.smansago.com', NULL, '$2y$12$6dYTJlls47A1veeVErySYuM0EUM73AWQ.j2snfysMpMP9Iam2Clqm', 'siswa', NULL, '2026-07-06 06:25:24', '2026-07-06 06:25:24'),
(408, 'Eko Priyanto', 'eko.priyanto@siswa.smansago.com', NULL, '$2y$12$wCTQJPlnb8/AjdLFCzgmq.76rXCE2m1G3fjXpZtrdS8qDAasmwJZe', 'siswa', NULL, '2026-07-06 06:25:24', '2026-07-06 06:25:24'),
(409, 'EVALDO FIAN AFRIZA', 'evaldo.afriza@siswa.smansago.com', NULL, '$2y$12$k1jqr2IrXudWqgy2Sb1Hou9P386Mz.4jBlGo9jEnG/D.EZVBygeRO', 'siswa', NULL, '2026-07-06 06:25:25', '2026-07-06 06:25:25'),
(410, 'FATIMAH NUR YULIANI', 'fatimah.yuliani@siswa.smansago.com', NULL, '$2y$12$uzrIM.aCBUwLoBxyLzy.ju8y/Nb5CQxB80QnXgS.ZTJvNTTLr0INC', 'siswa', NULL, '2026-07-06 06:25:25', '2026-07-06 06:25:25'),
(411, 'HAFIDH ALBAR', 'hafidh.albar@siswa.smansago.com', NULL, '$2y$12$8vziMQYK6VCl95SGJi8o2.8rxNP6ErXzirYAvHSLctXj4ZhWtYFGC', 'siswa', NULL, '2026-07-06 06:25:25', '2026-07-06 06:25:25'),
(412, 'HANNA SALSABILA', 'hanna.salsabila@siswa.smansago.com', NULL, '$2y$12$x6n93USZLVKazxB3vQndCex6KXjM41SZp..AiIONS8QblxO7ziC1a', 'siswa', NULL, '2026-07-06 06:25:25', '2026-07-06 06:25:25'),
(413, 'Intan Putri Utami', 'intan.utami@siswa.smansago.com', NULL, '$2y$12$mRJLxcjm1yqYt4uUUDzxoep5id53DE/ZqA59RYTkcznQeiWv3udQG', 'siswa', NULL, '2026-07-06 06:25:26', '2026-07-06 06:25:26'),
(414, 'LISTA SRI WAHYU LESTARI', 'lista.lestari@siswa.smansago.com', NULL, '$2y$12$ILEsvpWVE2RRX/TUbzO8K.OCT8un9z7a/dYGIPtBufCLip//D49d2', 'siswa', NULL, '2026-07-06 06:25:26', '2026-07-06 06:25:26'),
(415, 'MEISA NURAINI', 'meisa.nuraini@siswa.smansago.com', NULL, '$2y$12$ja3S6uxtyu7C/E4xA/zXTONF7d09F1RdHSkWn18TbLehUvnQuWQnu', 'siswa', NULL, '2026-07-06 06:25:26', '2026-07-06 06:25:26'),
(416, 'MUHAMAD AGUNG PRATAMA', 'muhamad.pratama@siswa.smansago.com', NULL, '$2y$12$HmCn.GyI8WQvjTIipx6gXu1WKid3V5oZiqWu6YxY/f6O85vIT.im.', 'siswa', NULL, '2026-07-06 06:25:26', '2026-07-06 06:25:26'),
(417, 'Muhamad Arifin', 'muhamad.arifin@siswa.smansago.com', NULL, '$2y$12$4buSCko0T6yAf5t2P41BiOg1RwBTWL0tVUKLaujPVJE6foX2G2s46', 'siswa', NULL, '2026-07-06 06:25:27', '2026-07-06 06:25:27'),
(418, 'MUHAMAD DWI ARDIYANTO', 'muhamad.ardiyanto@siswa.smansago.com', NULL, '$2y$12$5dxdLy3Wk6f0mgQznyUvMu5LywqwSLyt6EhXq8CtwQaYz.zaqavCS', 'siswa', NULL, '2026-07-06 06:25:27', '2026-07-06 06:25:27'),
(419, 'MUHAMMAD RIZKI ADITIYA', 'muhammad.aditiya@siswa.smansago.com', NULL, '$2y$12$kiROyFv3lt3zO13u8HHTUuSOdvjxKCq1aEq.fKZ4HWPR8m29UyIIa', 'siswa', NULL, '2026-07-06 06:25:27', '2026-07-06 06:25:27'),
(420, 'MUHAMMAD TYO ARDIANSYAH', 'muhammad.ardiansyah@siswa.smansago.com', NULL, '$2y$12$GluE07KVeC89YQzRjiLJ6er0ygXutXiffZ5K69FvuOKU2TFV/7vY2', 'siswa', NULL, '2026-07-06 06:25:27', '2026-07-06 06:25:27'),
(421, 'NADYA KHOIRUN NISWAN', 'nadya.niswan@siswa.smansago.com', NULL, '$2y$12$XX41J93rXhdkGbtJgcTKgu1T8TPEvn17ChWiGtF/vvz9aYfBqsDpK', 'siswa', NULL, '2026-07-06 06:25:28', '2026-07-06 06:25:28'),
(422, 'NASWA AULIA PREHANTY', 'naswa.prehanty@siswa.smansago.com', NULL, '$2y$12$xer6aUcOOBwwcnG2EOZ45.qdYrYqq7XUEeFgBwEYid3Ei9UgIdRy2', 'siswa', NULL, '2026-07-06 06:25:28', '2026-07-06 06:25:28'),
(423, 'Natali Kris Diovani', 'natali.diovani@siswa.smansago.com', NULL, '$2y$12$RiiJkwNLraZ8j6pAiXlRcu5BT8gx3fWvwrG8tkL9wmJF05TFV00uu', 'siswa', NULL, '2026-07-06 06:25:28', '2026-07-06 06:25:28'),
(424, 'Novia Maulinda', 'novia.maulinda@siswa.smansago.com', NULL, '$2y$12$J0I1EdP925KjhUcv6IWUWOVyJHR.axKTQRg3CsXKzo8/0tApPfzBi', 'siswa', NULL, '2026-07-06 06:25:28', '2026-07-06 06:25:28'),
(425, 'NOVIANA ROKHALI', 'noviana.rokhali@siswa.smansago.com', NULL, '$2y$12$ie99DO8/uTHVqPD42vEv/.5s0umsuLAYB44vLpFRG3Osthmvilsg.', 'siswa', NULL, '2026-07-06 06:25:29', '2026-07-06 06:25:29'),
(426, 'Ridho Deni Kiswanto', 'ridho.kiswanto@siswa.smansago.com', NULL, '$2y$12$ErrAL67ahqQtBW5NzT..Y.rc51DIfZHOehmLGIiWPCZXU8S6Q7NjS', 'siswa', NULL, '2026-07-06 06:25:29', '2026-07-06 06:25:29'),
(427, 'RIZKY SETIADI', 'rizky.setiadi@siswa.smansago.com', NULL, '$2y$12$87rTl2DeWeFE/7RxIk.Rfu3yAEkw5ROc53b971L6evhwlvDXcfYlu', 'siswa', NULL, '2026-07-06 06:25:29', '2026-07-06 06:25:29'),
(428, 'Salman Bajradaram', 'salman.bajradaram@siswa.smansago.com', NULL, '$2y$12$7vpOUmuJ/dXaw30byWv1wemhwrMciFUusxNggNA7dkNCK5vkUrFQ6', 'siswa', NULL, '2026-07-06 06:25:29', '2026-07-06 06:25:29'),
(429, 'TRIYONO', 'triyono@siswa.smansago.com', NULL, '$2y$12$P22uhR9uxM7wozzk2WkhHuvxVE1nSTZQLxbvVqnQcXAsjdlYNUdzG', 'siswa', NULL, '2026-07-06 06:25:30', '2026-07-06 06:25:30'),
(430, 'Wongayu Jenar Mahesa', 'wongayu.mahesa@siswa.smansago.com', NULL, '$2y$12$ElPaFIusaKKGd09CqIT5qemVjLwKp0Py/PyfkZtUZHhylN.nUjj4O', 'siswa', NULL, '2026-07-06 06:25:30', '2026-07-06 06:25:30'),
(431, 'AGIP WIJANARKO', 'agip.wijanarko@siswa.smansago.com', NULL, '$2y$12$0MUdayXq.X8asKS8SvS4p.bwrS/P4OGBD4MOxgzTl0HkF/LbHmk06', 'siswa', NULL, '2026-07-06 06:25:30', '2026-07-06 06:25:30'),
(432, 'AGUS SRIYONO', 'agus.sriyono@siswa.smansago.com', NULL, '$2y$12$/S92QNbMzVRmbjmshlruFeHXJfuENdinjBuNOdmFgSiVpzRHBeL3m', 'siswa', NULL, '2026-07-06 06:25:30', '2026-07-06 06:25:30'),
(433, 'Ahmad fauzan fathurroziq', 'ahmad.fathurroziq@siswa.smansago.com', NULL, '$2y$12$iiIlGcX3VaWCEpY3Uzwm7OZgKl6gp9cxTtEuOkjPJ9ore4knQ1h12', 'siswa', NULL, '2026-07-06 06:25:31', '2026-07-06 06:25:31'),
(434, 'ALI MUSTOFA', 'ali.mustofa@siswa.smansago.com', NULL, '$2y$12$0AHrruvQcHBkHr6UYUGaJe8qRpY8ewfe98QdI1MF/r0kESmP7x29W', 'siswa', NULL, '2026-07-06 06:25:31', '2026-07-06 06:25:31'),
(435, 'ALIEFAH ADJENG ARYA NINGSIH', 'aliefah.ningsih@siswa.smansago.com', NULL, '$2y$12$U.SoCTl9FtR8cpZOqrKOoeMg9.gquDR.S7X8Yvc1d1cEhX57KYObe', 'siswa', NULL, '2026-07-06 06:25:31', '2026-07-06 06:25:31'),
(436, 'ANIS PUJI LESTARI', 'anis.lestari@siswa.smansago.com', NULL, '$2y$12$gxqRjMSOPoM6fs1zvB1S9OwET6/ipRkF.p3WvH9xWsGTtyvQ8bESa', 'siswa', NULL, '2026-07-06 06:25:32', '2026-07-06 06:25:32'),
(437, 'ANITA NOVIYANTI', 'anita.noviyanti@siswa.smansago.com', NULL, '$2y$12$vjp/Hyc4LsB/ngBPC72hBumgBnfciE9MHceYNSOmO3ZL5yzQnIMBm', 'siswa', NULL, '2026-07-06 06:25:32', '2026-07-06 06:25:32'),
(438, 'ARMADITA PRIHATINI', 'armadita.prihatini@siswa.smansago.com', NULL, '$2y$12$qY.mEJMZggJcW9ewUj9Tb.VPEwipKHaWcz9l2IQsWxs8xHIUfx29C', 'siswa', NULL, '2026-07-06 06:25:32', '2026-07-06 06:25:32'),
(439, 'CALLISTA GISELA GITAFREYA', 'callista.gitafreya@siswa.smansago.com', NULL, '$2y$12$pemMwZmw7nAu9iztP0mFZ.VfjtiNe0x.Yo3EGMjHw3yoIjEuKjY4O', 'siswa', NULL, '2026-07-06 06:25:32', '2026-07-06 06:25:32'),
(440, 'Dwi Lestari', 'dwi.lestari@siswa.smansago.com', NULL, '$2y$12$rzGrCFpA41VK9iGZPOZAh.By9jqE9PCpzSZhM2SZMVi4e3ZVWSXXu', 'siswa', NULL, '2026-07-06 06:25:33', '2026-07-06 06:25:33'),
(441, 'FEBRIAN WAHYU PRATAMA', 'febrian.pratama@siswa.smansago.com', NULL, '$2y$12$PLLp5eimK6cZSnXV32MzXusQyJx.kuAy3z1tCVZM/ZiU6d2q8SGCO', 'siswa', NULL, '2026-07-06 06:25:33', '2026-07-06 06:25:33'),
(442, 'FELYSA EKA HIDAYANTI', 'felysa.hidayanti@siswa.smansago.com', NULL, '$2y$12$0lxdKN7palxA2CpHHiiJG.AnJx8OBAtMT.1u/D5C8coM67gRwpP46', 'siswa', NULL, '2026-07-06 06:25:33', '2026-07-06 06:25:33'),
(443, 'HAFID RIZAL DANENDRA', 'hafid.danendra@siswa.smansago.com', NULL, '$2y$12$XipZQfj8azwUz9fPBmqyhO5dEFED6j24/9xTPjwAPrKZpWyBKhqoS', 'siswa', NULL, '2026-07-06 06:25:33', '2026-07-06 06:25:33'),
(444, 'HANUNG DEWI NOVIANI', 'hanung.noviani@siswa.smansago.com', NULL, '$2y$12$YoqI9RVMF5Ljq47a4rIyBOxO8R7z0r4A47rR6TimoRvRpMRmqD90m', 'siswa', NULL, '2026-07-06 06:25:34', '2026-07-06 06:25:34'),
(445, 'Khanza Dwi Khoirun Nisa', 'khanza.nisa@siswa.smansago.com', NULL, '$2y$12$GVfev5HOyX4hkvcpl6apquRH.dCaZ57tkd7UvMliwoTp5GNN69Lbu', 'siswa', NULL, '2026-07-06 06:25:34', '2026-07-06 06:25:34'),
(446, 'KRISBIYANTO', 'krisbiyanto@siswa.smansago.com', NULL, '$2y$12$.7BbtYWedq1TVjPeTX5/Lu8au2BcpQO0QBHpxbws/hTSYZM5v2bGC', 'siswa', NULL, '2026-07-06 06:25:34', '2026-07-06 06:25:34'),
(447, 'KURNIAWAN DEWA PAMBUDI', 'kurniawan.pambudi@siswa.smansago.com', NULL, '$2y$12$Hf6eE2l3JIA3tC3.J2pedecEKwyiJDTtE5oujYo0Pymo3Ex/TqCBS', 'siswa', NULL, '2026-07-06 06:25:34', '2026-07-06 06:25:34'),
(448, 'MUHAMMAD ANWAR', 'muhammad.anwar@siswa.smansago.com', NULL, '$2y$12$UvK.aaCC4nbJhXPYbX6x3eBP07lIcfacV87owR9cAXINbxKNj.bXy', 'siswa', NULL, '2026-07-06 06:25:35', '2026-07-06 06:25:35'),
(449, 'MUTIARA', 'mutiara@siswa.smansago.com', NULL, '$2y$12$wRmQLC9G5ECIbgj3lSsj2OJwpMZXniCXBUucWJ8.eZI1WwPw.fPZS', 'siswa', NULL, '2026-07-06 06:25:35', '2026-07-06 06:25:35'),
(450, 'NAYLA ADIAS PRATIWI', 'nayla.pratiwi@siswa.smansago.com', NULL, '$2y$12$e5sFH49B/iQ3Z8pGI6KlEuupfVk6GKZ/NmWMfjROCEF.Uu97QItKy', 'siswa', NULL, '2026-07-06 06:25:35', '2026-07-06 06:25:35'),
(451, 'Ni Wayan Febriyan', 'ni.febriyan@siswa.smansago.com', NULL, '$2y$12$TYq7beZAP/tsEuF4LVemXu7lgh/NPbPad0nBX4AG3B3CzDWyfQvbe', 'siswa', NULL, '2026-07-06 06:25:35', '2026-07-06 06:25:35'),
(452, 'PUJI RAHAYU', 'puji.rahayu@siswa.smansago.com', NULL, '$2y$12$Pi9axhGBNUaMKde.B0OTY.EKyczf4W8pFWYgFVZc4SZYIKh.aS1va', 'siswa', NULL, '2026-07-06 06:25:36', '2026-07-06 06:25:36'),
(453, 'RAIHAN DAMAR PANULUH', 'raihan.panuluh@siswa.smansago.com', NULL, '$2y$12$PdI9YMpExM2kchdl.skM5e5gYsdBXZ28l/fDUC4ltqGbIekDkRU7m', 'siswa', NULL, '2026-07-06 06:25:36', '2026-07-06 06:25:36'),
(454, 'RIFKY DWI HANDIKA', 'rifky.handika@siswa.smansago.com', NULL, '$2y$12$qHlIxvXqGRo/ZUGh36.YYOJJHuW0lF1BE71lYWIEel/TeELme/2GK', 'siswa', NULL, '2026-07-06 06:25:36', '2026-07-06 06:25:36'),
(455, 'RIFQI AKBAR PRADITA', 'rifqi.pradita@siswa.smansago.com', NULL, '$2y$12$gbPCx2gYw9k/WA49X8H07..Q1MG50FhZGHXbImzTm8nw0V2mYVGPy', 'siswa', NULL, '2026-07-06 06:25:36', '2026-07-06 06:25:36'),
(456, 'SAHDA ARISTA ROFILAH', 'sahda.rofilah@siswa.smansago.com', NULL, '$2y$12$elKuEEwIA5FWcsKD2EsTMuPGN0OYlfSpPEOYas7Yhz4KwRptnjk6e', 'siswa', NULL, '2026-07-06 06:25:37', '2026-07-06 06:25:37'),
(457, 'Septya Ramadhani', 'septya.ramadhani@siswa.smansago.com', NULL, '$2y$12$q0JNEETMKO9MGkNxcAZ3YOjc/sqtbVtVf75CJJfsKQsqWTV78O5O.', 'siswa', NULL, '2026-07-06 06:25:37', '2026-07-06 06:25:37'),
(458, 'SITI NUR WASI\'ATUL BADRIAH', 'siti.badriah@siswa.smansago.com', NULL, '$2y$12$OqNVy7g.9ozSGNiIQUlKRuiUXiIGJBK8cEgeyGXNGMskPUrdguVsK', 'siswa', NULL, '2026-07-06 06:25:37', '2026-07-06 06:25:37'),
(459, 'TAUFIK HIDAYAT', 'taufik.hidayat@siswa.smansago.com', NULL, '$2y$12$V60lw1iZb4owGX./7oZ4Peyv1Re4YH8F6kGfTAf29kkjwjkv/QWUm', 'siswa', NULL, '2026-07-06 06:25:37', '2026-07-06 06:25:37'),
(460, 'Vicky Putra Ramadan', 'vicky.ramadan@siswa.smansago.com', NULL, '$2y$12$XJYhc3Z2yx8AYMiCkVUS1u58i2NdvLDhSgAGVFrzHjn8Op6HE3z5W', 'siswa', NULL, '2026-07-06 06:25:38', '2026-07-06 06:25:38'),
(461, 'VIKY FAHRURODIN OKTARA', 'viky.oktara@siswa.smansago.com', NULL, '$2y$12$yoUx9E6Yw9FpGVQA1QrCQeHs.iXsXCvwzEv6hYygjAgf0wDliwTNG', 'siswa', NULL, '2026-07-06 06:25:38', '2026-07-06 06:25:38'),
(462, 'WAHYU BAYUTRI SETIANA', 'wahyu.setiana@siswa.smansago.com', NULL, '$2y$12$AEtYnfAEOuQl7cAQ684/qurnCkAmTanIgvpBvT5TtbGEckj4SynDW', 'siswa', NULL, '2026-07-06 06:25:38', '2026-07-06 06:25:38'),
(463, 'YULIANA PUTRI LISTIYONO', 'yuliana.listiyono@siswa.smansago.com', NULL, '$2y$12$TcgI4J1wXkNrxkuatjLib.aCSbXgSwKFzcGoC6WMK6Znmoew3m8Ui', 'siswa', NULL, '2026-07-06 06:25:38', '2026-07-06 06:25:38'),
(464, 'AAN KURNIAWAN', 'aan.kurniawan@siswa.smansago.com', NULL, '$2y$12$flwFlF4UJI62HFQ1CDxleeG5ZobKkU42zj0dKQ6DpAGkqMg.oumvS', 'siswa', NULL, '2026-07-06 06:25:39', '2026-07-06 06:25:39'),
(465, 'AFIFA MERLIN PRAMESTI AYU ASTUTI', 'afifa.astuti@siswa.smansago.com', NULL, '$2y$12$CHmuXpCVH2qmllqFYeBGl.uR8eEELB8DXHZ3YnatLypL.jLFXl1Oa', 'siswa', NULL, '2026-07-06 06:25:39', '2026-07-06 06:25:39'),
(466, 'Alenta Rahmawati', 'alenta.rahmawati@siswa.smansago.com', NULL, '$2y$12$ys.E8Xj9zV8d4Qvf1JKuIuSwhq70iVMM/8mMkMIMZjEzV6DkhFMsG', 'siswa', NULL, '2026-07-06 06:25:39', '2026-07-06 06:25:39'),
(467, 'ALIF SAPUTRA', 'alif.saputra@siswa.smansago.com', NULL, '$2y$12$w45NmZyeWyl8p7w6nsd2JeTU4Bmu1TPq6j8.VBtfCAsRIsBQHGtg.', 'siswa', NULL, '2026-07-06 06:25:39', '2026-07-06 06:25:39'),
(468, 'APRILIA UMAEROH', 'aprilia.umaeroh@siswa.smansago.com', NULL, '$2y$12$xfoWyKycUj4VvYyNOV.3FuBWYlHrA8erNlzM57chgdTlUhsQ40OoW', 'siswa', NULL, '2026-07-06 06:25:40', '2026-07-06 06:25:40'),
(469, 'APRILIA WULANDARI', 'aprilia.wulandari@siswa.smansago.com', NULL, '$2y$12$.TWF/62u5zh4gGD4ewa0zOMY9OyQgBeQVEZLFuCF6UfNIFL4MBNAe', 'siswa', NULL, '2026-07-06 06:25:40', '2026-07-06 06:25:40'),
(470, 'ARDAN RAFIANTO', 'ardan.rafianto@siswa.smansago.com', NULL, '$2y$12$KCNUlBRB3R6hTd8aQxiQAu49UWYFKt6isF2Lds/Wmolx16XoVSgnS', 'siswa', NULL, '2026-07-06 06:25:40', '2026-07-06 06:25:40'),
(471, 'ARVIN RAHMADDANI', 'arvin.rahmaddani@siswa.smansago.com', NULL, '$2y$12$YK7Z9VqF4/BrmIInLVtKDO5g4NPCHw1wiwtUMATtEp6HfFE.dBYze', 'siswa', NULL, '2026-07-06 06:25:40', '2026-07-06 06:25:40'),
(472, 'BELLA AYU WULANDARI', 'bella.wulandari@siswa.smansago.com', NULL, '$2y$12$XbMeXl1RRoc2OAytxviQROPCrvSIdzI9Bl.XrUY6qYensLnk.BXq6', 'siswa', NULL, '2026-07-06 06:25:41', '2026-07-06 06:25:41'),
(473, 'CARISSA PUTRI', 'carissa.putri@siswa.smansago.com', NULL, '$2y$12$izXNqQrFTo5teaVXLrfQpOqQ.DoZirV9sxBTv8odI1gSGjf2nE1M.', 'siswa', NULL, '2026-07-06 06:25:41', '2026-07-06 06:25:41'),
(474, 'DIMAS SETIAWAN', 'dimas.setiawan@siswa.smansago.com', NULL, '$2y$12$s2sHwoFKHdX1E/f4kM4kw.mgqhLiKRwU1Ng1Z0Lt8JiG/x4n14lq2', 'siswa', NULL, '2026-07-06 06:25:41', '2026-07-06 06:25:41'),
(475, 'ENY WAHYUNINGSIH', 'eny.wahyuningsih@siswa.smansago.com', NULL, '$2y$12$DfuSumxDCleI6lO6KAUSWO66YD22YU1btM6BskQUsftChNTyZP9qW', 'siswa', NULL, '2026-07-06 06:25:41', '2026-07-06 06:25:41'),
(476, 'ERIXDA AGUNG KUNCORO', 'erixda.kuncoro@siswa.smansago.com', NULL, '$2y$12$pWOlMtWddIOlbNB7Rao.KOOCU3I0budCywVPEZV2FMjENoRjdUgge', 'siswa', NULL, '2026-07-06 06:25:42', '2026-07-06 06:25:42'),
(477, 'ERVANDY ALIF FEBRIAN', 'ervandy.febrian@siswa.smansago.com', NULL, '$2y$12$xeXj65nV6zc55V9hcY9y7.KfQ/BjH075VYV9/WCx3Lo.cfNBNzfte', 'siswa', NULL, '2026-07-06 06:25:42', '2026-07-06 06:25:42'),
(478, 'EVA YULIANTY', 'eva.yulianty@siswa.smansago.com', NULL, '$2y$12$uXwgzPdhzEQoJ4VZ//FAf.68V3snhAyiky0IP0qXw9DmV0lO5IHCe', 'siswa', NULL, '2026-07-06 06:25:42', '2026-07-06 06:25:42'),
(479, 'FAJAR NUR HIDAYAT', 'fajar.hidayat@siswa.smansago.com', NULL, '$2y$12$baK8hTuqoTXKDAK4S0bmGesXH06ylNzXr4p1o7p7QH1XaiklIKHrG', 'siswa', NULL, '2026-07-06 06:25:42', '2026-07-06 06:25:42'),
(480, 'FATIMAH AZZAHRA', 'fatimah.azzahra@siswa.smansago.com', NULL, '$2y$12$gY5lM9gcvoYjN1QnWjY1ZOlPFUxxh7aF9uTAJ0G3p0g4LEKl0xJfu', 'siswa', NULL, '2026-07-06 06:25:43', '2026-07-06 06:25:43'),
(481, 'Intan Damayanti', 'intan.damayanti@siswa.smansago.com', NULL, '$2y$12$X4dCvz37KmNld3prvYOhg.HN5neKPaG7v.ekzMoAiDfs2X/NCA3EC', 'siswa', NULL, '2026-07-06 06:25:43', '2026-07-06 06:25:43'),
(482, 'LAILI MAFTUKHAH', 'laili.maftukhah@siswa.smansago.com', NULL, '$2y$12$McbsjQtUVT5b9b6OgJepP.qhH6WPvuBN0DcNd94yqyOP1/esNVFwW', 'siswa', NULL, '2026-07-06 06:25:43', '2026-07-06 06:25:43'),
(483, 'MA\'RIFATU SYIFA KAMIL FARHANI', 'marifatu.farhani@siswa.smansago.com', NULL, '$2y$12$OzwtC5NB4DMxYmMRabzg2.BkuDsV59FcbZol83gN8tV2lgn2AhMEO', 'siswa', NULL, '2026-07-06 06:25:43', '2026-07-06 06:25:43'),
(484, 'MUHAMAD FEBRY VALIANSAH', 'muhamad.valiansah@siswa.smansago.com', NULL, '$2y$12$0l0ieF1l/m8vgrblHRHH2.E6bY7C3r03QoFE8TJdQWVrx4T.psb6a', 'siswa', NULL, '2026-07-06 06:25:44', '2026-07-06 06:25:44'),
(485, 'MUHAMAD TAUFIK KURNIAWAN', 'muhamad.kurniawan@siswa.smansago.com', NULL, '$2y$12$iXjAkLICFCKodmmobOUUF.YHBM4meop5vK7s7njKNDDNmdRaikJ6q', 'siswa', NULL, '2026-07-06 06:25:44', '2026-07-06 06:25:44'),
(486, 'MUHAMMAD FAHRI AFIANTO', 'muhammad.afianto@siswa.smansago.com', NULL, '$2y$12$rq4Wy7v249h6mvvQ7CewKed.lGwK3zwxD0s.J4Pc2/vtHnpuju7D.', 'siswa', NULL, '2026-07-06 06:25:44', '2026-07-06 06:25:44'),
(487, 'MUHAMMAD RIZQI KAKA PRADANA', 'muhammad.pradana@siswa.smansago.com', NULL, '$2y$12$eK.uzjuG8/BFfPwW69prDOl566UVqeAimv.2dgoiaEQisNBd6etIG', 'siswa', NULL, '2026-07-06 06:25:44', '2026-07-06 06:25:44'),
(488, 'Naysila Annisa Zaskia', 'naysila.zaskia@siswa.smansago.com', NULL, '$2y$12$e8Qyw9i65G0o7vhBJ.d0nOFkjFIsdQC94N/D6aQEw1H7fRlliVgUy', 'siswa', NULL, '2026-07-06 06:25:44', '2026-07-06 06:25:44'),
(489, 'NURUDIN RIZKI SAPUTRO', 'nurudin.saputro@siswa.smansago.com', NULL, '$2y$12$LMqXCjVTOHsBx3qv6cOHOeHwUD1qgerd2H/P.JzZXEtLI8TTKCM4C', 'siswa', NULL, '2026-07-06 06:25:45', '2026-07-06 06:25:45'),
(490, 'RAIHAN SUSILO BUDIANTO', 'raihan.budianto@siswa.smansago.com', NULL, '$2y$12$AvuYgi2aXqBVsyuMRkaJ0uQFMCwC5C.uZXqxV36Jzt2X1kGxjy41m', 'siswa', NULL, '2026-07-06 06:25:45', '2026-07-06 06:25:45'),
(491, 'RASYA NUR HIDAYAT', 'rasya.hidayat@siswa.smansago.com', NULL, '$2y$12$5LBCwQP2ObYM1s2QaBQrguuCj7joEyeNdxVW6vtb9wekZcw4TeeXO', 'siswa', NULL, '2026-07-06 06:25:45', '2026-07-06 06:25:45'),
(492, 'RENDI SETIAWAN', 'rendi.setiawan@siswa.smansago.com', NULL, '$2y$12$WL6ebXOFeQHRxiOwg3gl5OIhqtQzUQMTRdG3sD7QWdt70Mdq8MA.C', 'siswa', NULL, '2026-07-06 06:25:45', '2026-07-06 06:25:45'),
(493, 'SATRIA BAYU AJI', 'satria.aji@siswa.smansago.com', NULL, '$2y$12$whwC8c5AHr5XQqllPW1/AeyXhfEbCTozmzYJKypIPfQDxEM7hGZeu', 'siswa', NULL, '2026-07-06 06:25:46', '2026-07-06 06:25:46'),
(494, 'SRI WAHYU RAHMAYANI', 'sri.rahmayani@siswa.smansago.com', NULL, '$2y$12$Pd9qkRgCGuQ3UPnj3WJyWet.yE2QoeNUkwC/7T3CXm1X.lPzGdq42', 'siswa', NULL, '2026-07-06 06:25:46', '2026-07-06 06:25:46'),
(495, 'TRI HARTANTO', 'tri.hartanto@siswa.smansago.com', NULL, '$2y$12$ghOOw5zyaugZlauwR8c7befgmzOaLrf.2E4z/Ri9NEPNPMDqRr1d2', 'siswa', NULL, '2026-07-06 06:25:46', '2026-07-06 06:25:46'),
(496, 'WAHYU NUGROHO', 'wahyu.nugroho@siswa.smansago.com', NULL, '$2y$12$Ve4GPFinWPMjp84xMiqwP.U6Iz094zL0FfX03938JaaME5C/mlcQy', 'siswa', NULL, '2026-07-06 06:25:46', '2026-07-06 06:25:46'),
(497, 'WIDYA FELISIANO PUTRI', 'widya.putri@siswa.smansago.com', NULL, '$2y$12$0PhpulfAJN1zFMGNUyxtA.eV0TG0sHz.SJlE4sX1WsfK8aNYdWr46', 'siswa', NULL, '2026-07-06 06:25:47', '2026-07-06 06:25:47'),
(498, 'WIWID SARENAWATI', 'wiwid.sarenawati@siswa.smansago.com', NULL, '$2y$12$hzsCU7989AknOwgrC1Hm2uKC71ZWbxmkJf3R2.bsV3ofsoZ1oUnxu', 'siswa', NULL, '2026-07-06 06:25:47', '2026-07-06 06:25:47'),
(499, 'YOGO SAPUTRA', 'yogo.saputra@siswa.smansago.com', NULL, '$2y$12$w0AK1WgpCDz7mP9yzZrWfeAEcjWq7ttxKzcw5mhy7xDZDR4fQVBP6', 'siswa', NULL, '2026-07-06 06:25:47', '2026-07-06 06:25:47'),
(500, 'ALPIANA RAHMAWATI', 'alpiana.rahmawati@siswa.smansago.com', NULL, '$2y$12$MgvrHoiBjAKYVtCSzWu7HOuDUp2KXXtfSwPQnMhnZxn2UKpzVJyhi', 'siswa', NULL, '2026-07-06 06:25:47', '2026-07-28 03:37:08'),
(501, 'ALWIS ALQURNIAWAN', 'alwis.alqurniawan@siswa.smansago.com', NULL, '$2y$12$JQbZ9Fz7U7DdFEqkfHYu7eirguHt.FdGf1w8xbxk9hZheqBIf.tm.', 'siswa', NULL, '2026-07-06 06:25:48', '2026-07-06 06:25:48'),
(502, 'Arief Nur Haryanto', 'arief.haryanto@siswa.smansago.com', NULL, '$2y$12$B6SOYxNxVWuPe4h64F9s7OG1hK1IoU0tFURsRJgOGG9GqKBajPIiO', 'siswa', NULL, '2026-07-06 06:25:48', '2026-07-06 06:25:48'),
(503, 'AYU ANDINI', 'ayu.andini@siswa.smansago.com', NULL, '$2y$12$SSlfgzSjkxI0Hgb9RWZPwupxv3Xf9LMpX6GMKYjfZYr62zvCjm9pi', 'siswa', NULL, '2026-07-06 06:25:48', '2026-07-06 06:25:48'),
(504, 'BAGUS PRABOWO', 'bagus.prabowo@siswa.smansago.com', NULL, '$2y$12$3.x7V9MXnW96kzAJhq8opubXGN5WPAh7e0uhA9YS1jEz3KhSvBzjG', 'siswa', NULL, '2026-07-06 06:25:49', '2026-07-06 06:25:49'),
(505, 'BIMA BASTIAN MULYA', 'bima.mulya@siswa.smansago.com', NULL, '$2y$12$BlhXvHDGpyl/S1JIfKd1/.hEBECNyyNx/rRH7OfcwnxCcccQrQ98G', 'siswa', NULL, '2026-07-06 06:25:49', '2026-07-06 06:25:49'),
(506, 'DEVIANA ANDRIYANTI', 'deviana.andriyanti@siswa.smansago.com', NULL, '$2y$12$0OusKEjebc9pJA5IxvmPz.WS2FWxSCEeiRpQg9y5QH6T3vY7h4rGu', 'siswa', NULL, '2026-07-06 06:25:49', '2026-07-06 06:25:49'),
(507, 'ELXA WAHYU YULIANTO', 'elxa.yulianto@siswa.smansago.com', NULL, '$2y$12$B3yoX.DWXdJubXgDx.lB7er/fJP8RpFnpk4tOabh46G37nyf6xo2S', 'siswa', NULL, '2026-07-06 06:25:49', '2026-07-06 06:25:49'),
(508, 'FAIZ SARIFUDIN', 'faiz.sarifudin@siswa.smansago.com', NULL, '$2y$12$zfHCkN25pvMdcpWgXWDnT.1IePocj/xzf0Rb9xR27aSDVYSQY55sy', 'siswa', NULL, '2026-07-06 06:25:50', '2026-07-06 06:25:50'),
(509, 'FALIHA ALBIT', 'faliha.albit@siswa.smansago.com', NULL, '$2y$12$xpz/K.DazQCqZig6/2JYqeSX8Dj7ZSxXfoO83Tg2rfiJdm4INzC/W', 'siswa', NULL, '2026-07-06 06:25:50', '2026-07-06 06:25:50'),
(510, 'FARA DECHA ABABILQIS', 'fara.ababilqis@siswa.smansago.com', NULL, '$2y$12$giur0FdnNL4ZW7dC86hB3eLliW0Dfia.fn3aXZQ9cYJ5GBc15x.aS', 'siswa', NULL, '2026-07-06 06:25:50', '2026-07-06 06:25:50'),
(511, 'HANUNG GIBRAN ALANSAH', 'hanung.alansah@siswa.smansago.com', NULL, '$2y$12$ZttOtBmyqATcmZ5jXtSW9.cZTquZHmK3QCFCeXmpWFYzoyRPN5mx2', 'siswa', NULL, '2026-07-06 06:25:50', '2026-07-06 06:25:50'),
(512, 'KAILA NURUL AISHA', 'kaila.aisha@siswa.smansago.com', NULL, '$2y$12$qX4ZIE8GaRGmn3JC16Tkou7HrMckWUlEzoOG59Kc5dpeJIunCvYwy', 'siswa', NULL, '2026-07-06 06:25:51', '2026-07-06 06:25:51'),
(513, 'MUHAMAD RIZAL PURNAMA PUTRA', 'muhamad.putra@siswa.smansago.com', NULL, '$2y$12$J3.EwbuMjlkmndAr1XLGR.wnUKDo36kAjib7YJOAIqbBahm5BqaTi', 'siswa', NULL, '2026-07-06 06:25:51', '2026-07-06 06:25:51');
INSERT INTO `pengguna` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(514, 'MUHAMMAD RIZKI FAUZI', 'muhammad.fauzi@siswa.smansago.com', NULL, '$2y$12$AV0KOxN7I1NqwjX5FKs0POE4t51Jj8PjV2539Z10GNvG/qGCBa8Wu', 'siswa', NULL, '2026-07-06 06:25:51', '2026-07-06 06:25:51'),
(515, 'Muhammat Ibnu Tamar Ibrahim', 'muhammat.ibrahim@siswa.smansago.com', NULL, '$2y$12$eAJc5Uy9SOkHpOn3RHH/JuqAy5B0a5IunLdmSiJ7FtUfGUb5MK6OC', 'siswa', NULL, '2026-07-06 06:25:51', '2026-07-06 06:25:51'),
(516, 'Nadin Aprilia Putri', 'nadin.putri@siswa.smansago.com', NULL, '$2y$12$QwN6xWSzIN9zX4mrWpqO..2i/1tMV.CA4gy714Kho7cHSGDSGjWDe', 'siswa', NULL, '2026-07-06 06:25:52', '2026-07-06 06:25:52'),
(517, 'NINDA ALTHAFUNNISA', 'ninda.althafunnisa@siswa.smansago.com', NULL, '$2y$12$hRjIz2WVmh.LFbZ.Ye0J4ei1mXDc/K4JpE02MlTzSHJ4HEMDhv1Te', 'siswa', NULL, '2026-07-06 06:25:52', '2026-07-06 06:25:52'),
(518, 'NOVA WIYANTO', 'nova.wiyanto@siswa.smansago.com', NULL, '$2y$12$mLeysKBvBOVVWyYl2zSVcuETQuXGj3SHZ84Maj0BxhqxC7Jz.0QsK', 'siswa', NULL, '2026-07-06 06:25:52', '2026-07-06 06:25:52'),
(519, 'NOVI MAULANI ADITYA', 'novi.aditya@siswa.smansago.com', NULL, '$2y$12$ajh42gmbQBj1ayIkWp1BeOpmzkLLbOVhn0l/7pDl/RhEvaR/psXLG', 'siswa', NULL, '2026-07-06 06:25:52', '2026-07-06 06:25:52'),
(520, 'NUR ANISA', 'nur.anisa@siswa.smansago.com', NULL, '$2y$12$4XnnSNh.U0jgCYUvLEFgh./bg3eu5jsd6moN01p5mA.atLqqnr8/6', 'siswa', NULL, '2026-07-06 06:25:53', '2026-07-06 06:25:53'),
(521, 'NUR ROHIMAH', 'nur.rohimah@siswa.smansago.com', NULL, '$2y$12$SHgf3ag.8V98VuOZOKdpMeP1C3pwNLqL0zc/xXVxoJ8FZl.ZLgngC', 'siswa', NULL, '2026-07-06 06:25:53', '2026-07-06 06:25:53'),
(522, 'PRASETYO DWI SAPUTRO', 'prasetyo.saputro@siswa.smansago.com', NULL, '$2y$12$UoFZxp4VelkOWunGop/w6O5gX/y8eVYMWBMAhKZnWIAcCOhO5Z.Jq', 'siswa', NULL, '2026-07-06 06:25:53', '2026-07-06 06:25:53'),
(523, 'RAISA ISNAN SAPUTRA', 'raisa.saputra@siswa.smansago.com', NULL, '$2y$12$zTFOecsHY8Hl1RmALTA6AOog9C84mzrmXBK1EdLdYFQC59ba9N95K', 'siswa', NULL, '2026-07-06 06:25:53', '2026-07-06 06:25:53'),
(524, 'Rasyid Amir Zaki', 'rasyid.zaki@siswa.smansago.com', NULL, '$2y$12$PrgsfRKRFGdIeS1BPOYUV.PoPmw0HAooPCKfb6WCB0deKE2rluKa2', 'siswa', NULL, '2026-07-06 06:25:54', '2026-07-06 06:25:54'),
(525, 'RESTU PURBANINGRAT', 'restu.purbaningrat@siswa.smansago.com', NULL, '$2y$12$CsDFGsGMISo9LyK3t6v4P.NWQKUhV2X6ZX6Gani1MsjzzAPQOHmbm', 'siswa', NULL, '2026-07-06 06:25:54', '2026-07-06 06:25:54'),
(526, 'RIZAL MATHOFANI ADI NUGRAHA', 'rizal.nugraha@siswa.smansago.com', NULL, '$2y$12$0CeAe5x6qFl2J6N/nIXY5ufoqQqsA8588zvObqyasC3OBz5CxXW5.', 'siswa', NULL, '2026-07-06 06:25:54', '2026-07-06 06:25:54'),
(527, 'SAIFUL UDIN', 'saiful.udin@siswa.smansago.com', NULL, '$2y$12$sj616VjOpL5JHVlxUkbeteN6JJffgaRPR4pMt5Ov6DbcEVCQ96lgu', 'siswa', NULL, '2026-07-06 06:25:54', '2026-07-06 06:25:54'),
(528, 'Septia Ramadhani', 'septia.ramadhani@siswa.smansago.com', NULL, '$2y$12$BRDfY5tgWY7gm8RIoLWtQuOIuxGIgqXZI2A6azAjm8M1u6zLSZZJu', 'siswa', NULL, '2026-07-06 06:25:55', '2026-07-06 06:25:55'),
(529, 'SHOLEH SETYAWAN', 'sholeh.setyawan@siswa.smansago.com', NULL, '$2y$12$ltPFxiqfCe.GPpMTWxRwDOp4GPioX9ho8FPdcUIrLsFtAM2SaZcQa', 'siswa', NULL, '2026-07-06 06:25:55', '2026-07-06 06:25:55'),
(530, 'SOWAN APRILIA', 'sowan.aprilia@siswa.smansago.com', NULL, '$2y$12$rORc25YQFESZMVQvcr70eOeEpMgtjGEgBZN2EIcO6AsSht.RKObg6', 'siswa', NULL, '2026-07-06 06:25:55', '2026-07-06 06:25:55'),
(531, 'THORIQ LUTFI ZAILANI', 'thoriq.zailani@siswa.smansago.com', NULL, '$2y$12$8w1vgT0vIfCjZ0.gJ25FzOHFSzBIR90CY4W5HOF8YH5R0bb/Ia.XS', 'siswa', NULL, '2026-07-06 06:25:55', '2026-07-06 06:25:55'),
(532, 'Vika Damayanti', 'vika.damayanti@siswa.smansago.com', NULL, '$2y$12$iAh3.B1sKUFeACk6X0ohJOrQyPKsJy9U95Y4M/HNzwLRtb0TtCb5W', 'siswa', NULL, '2026-07-06 06:25:56', '2026-07-06 06:25:56'),
(533, 'WAHYU PURWANTO', 'wahyu.purwanto@siswa.smansago.com', NULL, '$2y$12$6dTCfwIgHh80Wn6VcA24g..ES4/oKEIzXNg3TaLaOD5QaMhwHgHRO', 'siswa', NULL, '2026-07-06 06:25:56', '2026-07-06 06:25:56'),
(534, 'YOGI MUHAMAD FAIZAL', 'yogi.faizal@siswa.smansago.com', NULL, '$2y$12$6FIC8FSPt.ndStciV3FlTeHht8pSgmCtCdc507PzzGQJPhLElXYJO', 'siswa', NULL, '2026-07-06 06:25:56', '2026-07-06 06:25:56'),
(535, 'ZAFRAN AL FARIZI', 'zafran.farizi@siswa.smansago.com', NULL, '$2y$12$wrGKGmE7eXMuf/R43BfNiughG6pWAC4GBEY/0rp5V99t.AunFNSOe', 'siswa', NULL, '2026-07-06 06:25:56', '2026-07-28 04:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `tugas_id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `tanggal_pengumpulan` datetime DEFAULT NULL,
  `file_tugas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint UNSIGNED DEFAULT NULL,
  `mime_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drive_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('terkumpul','terlambat','belum','graded') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumpulan_tugas`
--

INSERT INTO `pengumpulan_tugas` (`id`, `tugas_id`, `siswa_id`, `tanggal_pengumpulan`, `file_tugas`, `original_name`, `file_path`, `file_size`, `mime_type`, `drive_link`, `file_name`, `file_icon`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 465, '2026-07-28 11:03:19', 'submissions/1/465/m7CKxNW8kUrDOfF7p9UEpby0CErAFGvgj37UKSNi.pdf', 'BERITA ACARA SERAH TERIMA PRODUK SKRIPSI.pdf', 'submissions/1/465/m7CKxNW8kUrDOfF7p9UEpby0CErAFGvgj37UKSNi.pdf', 85537, 'application/pdf', NULL, NULL, NULL, 'graded', '2026-07-28 04:03:19', '2026-07-28 04:03:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kelas_siswa`
--

CREATE TABLE `riwayat_kelas_siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `kelas_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_kelas_siswa`
--

INSERT INTO `riwayat_kelas_siswa` (`id`, `siswa_id`, `kelas_name`, `academic_year`, `created_at`, `updated_at`) VALUES
(749, 2, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(750, 3, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(751, 4, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(752, 5, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(753, 6, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(754, 7, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(755, 8, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(756, 9, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(757, 10, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(758, 11, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(759, 12, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(760, 13, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(761, 14, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(762, 15, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(763, 16, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(764, 17, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(765, 18, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(766, 19, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(767, 20, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(768, 21, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(769, 22, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(770, 23, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(771, 24, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(772, 25, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(773, 26, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(774, 27, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(775, 28, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(776, 29, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(777, 30, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(778, 31, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(779, 32, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(780, 33, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(781, 34, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(782, 35, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(783, 36, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(784, 37, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(785, 38, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(786, 39, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(787, 40, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(788, 41, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(789, 42, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(790, 43, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(791, 44, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(792, 45, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(793, 46, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(794, 47, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(795, 48, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(796, 49, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(797, 50, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(798, 51, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(799, 52, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(800, 53, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(801, 54, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(802, 55, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(803, 56, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(804, 57, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(805, 58, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(806, 59, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(807, 60, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(808, 61, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(809, 62, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(810, 63, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(811, 64, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(812, 65, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(813, 66, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(814, 67, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(815, 68, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(816, 69, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(817, 70, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(818, 71, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(819, 72, 'X 2', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(820, 73, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(821, 74, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(822, 75, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(823, 76, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(824, 77, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(825, 78, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(826, 79, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(827, 80, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(828, 81, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(829, 82, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(830, 83, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(831, 84, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(832, 85, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(833, 86, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(834, 87, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(835, 88, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(836, 89, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(837, 90, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(838, 91, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(839, 92, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(840, 93, 'X 3', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(841, 94, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(842, 95, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(843, 96, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(844, 97, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(845, 98, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(846, 99, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(847, 100, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(848, 101, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(849, 102, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(850, 103, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(851, 104, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(852, 105, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(853, 106, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(854, 107, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(855, 108, 'X 3', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(856, 109, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(857, 110, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(858, 111, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(859, 112, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(860, 113, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(861, 114, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(862, 115, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(863, 116, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(864, 117, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(865, 118, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(866, 119, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(867, 120, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(868, 121, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(869, 122, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(870, 123, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(871, 124, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(872, 125, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(873, 126, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(874, 127, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(875, 128, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(876, 129, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(877, 130, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(878, 131, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(879, 132, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(880, 133, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(881, 134, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(882, 135, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(883, 136, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(884, 137, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(885, 138, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(886, 139, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(887, 140, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(888, 141, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(889, 142, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(890, 143, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(891, 144, 'X 4', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(892, 145, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(893, 146, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(894, 147, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(895, 148, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(896, 149, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(897, 150, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(898, 151, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(899, 152, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(900, 153, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(901, 154, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(902, 155, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(903, 156, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(904, 157, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(905, 158, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(906, 159, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(907, 160, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(908, 161, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(909, 162, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(910, 163, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(911, 164, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(912, 165, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(913, 166, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(914, 167, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(915, 168, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(916, 169, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(917, 170, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(918, 171, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(919, 172, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(920, 173, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(921, 174, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(922, 175, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(923, 176, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(924, 177, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(925, 178, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(926, 179, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(927, 180, 'X 5', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(928, 181, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(929, 182, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(930, 183, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(931, 184, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(932, 185, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(933, 186, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(934, 187, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(935, 188, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(936, 189, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(937, 190, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(938, 191, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(939, 192, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(940, 193, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(941, 194, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(942, 195, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(943, 196, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(944, 197, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(945, 198, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(946, 199, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(947, 200, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(948, 201, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(949, 202, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(950, 203, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(951, 204, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(952, 205, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(953, 206, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(954, 207, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(955, 208, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(956, 209, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(957, 210, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(958, 211, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(959, 212, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(960, 213, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(961, 214, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(962, 215, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(963, 216, 'X 6', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(964, 217, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(965, 218, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(966, 219, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(967, 220, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(968, 221, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(969, 222, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(970, 223, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(971, 224, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(972, 225, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(973, 226, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(974, 227, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(975, 228, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(976, 229, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(977, 230, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(978, 231, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(979, 232, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(980, 233, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(981, 234, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(982, 235, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(983, 236, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(984, 237, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(985, 238, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(986, 239, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(987, 240, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(988, 241, 'X 7', '2025/2026', '2026-07-14 23:19:01', '2026-07-14 23:19:01'),
(989, 242, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(990, 243, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(991, 244, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(992, 245, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(993, 246, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(994, 247, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(995, 248, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(996, 249, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(997, 250, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(998, 251, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(999, 252, 'X 7', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1254, 1, 'X 1', '2025/2026', '2026-07-14 23:19:00', '2026-07-14 23:19:00'),
(1255, 253, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1256, 254, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1257, 255, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1258, 256, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1259, 257, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1260, 258, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1261, 259, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1262, 260, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1263, 261, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1264, 262, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1265, 263, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1266, 264, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1267, 265, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1268, 266, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1269, 267, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1270, 268, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1271, 269, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1272, 270, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1273, 271, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1274, 272, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1275, 273, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1276, 274, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1277, 275, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1278, 276, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1279, 277, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1280, 278, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1281, 279, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1282, 280, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1283, 281, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1284, 282, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1285, 283, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1286, 284, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1287, 285, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1288, 286, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1289, 287, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1290, 288, 'XI F 1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1291, 289, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1292, 290, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1293, 291, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1294, 292, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1295, 293, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1296, 294, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1297, 295, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1298, 296, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1299, 297, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1300, 298, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1301, 299, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1302, 300, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1303, 301, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1304, 302, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1305, 303, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1306, 304, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1307, 305, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1308, 306, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1309, 307, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1310, 308, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1311, 309, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1312, 310, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1313, 311, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1314, 312, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1315, 313, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1316, 314, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1317, 315, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1318, 316, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1319, 317, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1320, 318, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1321, 319, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1322, 320, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1323, 321, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1324, 322, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1325, 323, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1326, 324, 'XI F 2.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1327, 325, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1328, 326, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1329, 327, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1330, 328, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1331, 329, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1332, 330, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1333, 331, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1334, 332, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1335, 333, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1336, 334, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1337, 335, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1338, 336, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1339, 337, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1340, 338, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1341, 339, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1342, 340, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1343, 341, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1344, 342, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1345, 343, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1346, 344, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1347, 345, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1348, 346, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1349, 347, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1350, 348, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1351, 349, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1352, 350, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1353, 351, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1354, 352, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1355, 353, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1356, 354, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1357, 355, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1358, 356, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1359, 357, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1360, 358, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1361, 359, 'XI F 2.2', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1362, 360, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1363, 361, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1364, 362, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1365, 363, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1366, 364, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1367, 365, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1368, 366, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1369, 367, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1370, 368, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1371, 369, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1372, 370, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1373, 371, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1374, 372, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1375, 373, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1376, 374, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1377, 375, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1378, 376, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1379, 377, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1380, 378, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1381, 379, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1382, 380, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1383, 381, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1384, 382, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1385, 383, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:02', '2026-07-14 23:19:02'),
(1386, 384, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1387, 385, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1388, 386, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1389, 387, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1390, 388, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1391, 389, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1392, 390, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1393, 391, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1394, 392, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1395, 393, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1396, 394, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1397, 395, 'XI F 3.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1398, 396, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1399, 397, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1400, 398, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1401, 399, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1402, 400, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1403, 401, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1404, 402, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1405, 403, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1406, 404, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1407, 405, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1408, 406, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1409, 407, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1410, 408, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1411, 409, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1412, 410, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1413, 411, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1414, 412, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1415, 413, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1416, 414, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1417, 415, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1418, 416, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1419, 417, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1420, 418, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1421, 419, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1422, 420, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1423, 421, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1424, 422, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1425, 423, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1426, 424, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1427, 425, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1428, 426, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1429, 427, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1430, 428, 'XI F 3.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1431, 429, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1432, 430, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1433, 431, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1434, 432, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1435, 433, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1436, 434, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1437, 435, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1438, 436, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1439, 437, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1440, 438, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1441, 439, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1442, 440, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1443, 441, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1444, 442, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1445, 443, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1446, 444, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1447, 445, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1448, 446, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1449, 447, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1450, 448, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1451, 449, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1452, 450, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1453, 451, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1454, 452, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1455, 453, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1456, 454, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1457, 455, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1458, 456, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1459, 457, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1460, 458, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1461, 459, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1462, 460, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1463, 461, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1464, 462, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1465, 463, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1466, 464, 'XI F 4.1', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1467, 465, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1468, 466, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1469, 467, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1470, 468, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1471, 469, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1472, 470, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1473, 471, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1474, 472, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1475, 473, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1476, 474, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1477, 475, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1478, 476, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1479, 477, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1480, 478, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1481, 479, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1482, 480, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1483, 481, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1484, 482, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1485, 483, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1486, 484, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1487, 485, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1488, 486, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1489, 487, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1490, 488, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1491, 489, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1492, 490, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1493, 491, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1494, 492, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1495, 493, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1496, 494, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1497, 495, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1498, 496, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1499, 497, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1500, 498, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1501, 499, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03'),
(1502, 500, 'XI F 4.2', '2025/2026', '2026-07-14 23:19:03', '2026-07-14 23:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3QuBZlqSdCC3YZz3EsqI87xYMU9YMlLgE3trpZV8', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiV3hSYmZVYkVNUmF0Q2Vob2tqNFdER0dRVGtZeHU3WXRUNFcwbXBzdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50cy9ieS1jbGFzc2VzP2tlbGFzPVglMjAxIjtzOjU6InJvdXRlIjtzOjE5OiJzdHVkZW50cy5ieS1jbGFzc2VzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiYTk2ZTc5YmRmYzVjZWQzNDBlMDc1Y2U5OWVjMzM1ZmQxZTg4ZDFjMWI1YTU1MjM4ZjIyZGJlZjljYWFjNTIxNyI7czoyMDoibWFpbnRlbmFuY2VfdW5sb2NrZWQiO2I6MTtzOjE4OiJhZG1pbl90YWh1bl9hamFyYW4iO3M6OToiMjAyNi8yMDI3Ijt9', 1786798383);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'tahun_ajaran_aktif', '2026/2027', '2026-07-06 06:36:50', '2026-08-15 11:29:01'),
(2, 'daftar_tahun_ajaran_custom', '[\"2025\\/2026\",\"2026\\/2027\"]', '2026-07-07 18:17:57', '2026-08-15 11:28:34'),
(3, 'system_roles', '{\"admin\":\"Administrator\",\"guru\":\"Guru Pengajar\",\"wali_kelas\":\"Wali Kelas\",\"siswa\":\"Siswa\"}', '2026-07-11 02:19:18', '2026-07-11 02:19:18'),
(4, 'system_modules', '{\"Data Sekolah (Siswa, Kelas)\":{\"view\":{\"key\":\"view_siswa\",\"label\":\"Melihat Siswa & Kelas\"},\"create\":{\"key\":\"create_siswa\",\"label\":\"Tambah Siswa & Kelas\"},\"edit\":{\"key\":\"edit_siswa\",\"label\":\"Edit Siswa & Kelas\"},\"delete\":{\"key\":\"delete_siswa\",\"label\":\"Hapus Siswa & Kelas\"}},\"Data Guru\":{\"view\":{\"key\":\"view_guru\",\"label\":\"Melihat Guru\"},\"create\":{\"key\":\"create_guru\",\"label\":\"Tambah Guru\"},\"edit\":{\"key\":\"edit_guru\",\"label\":\"Edit Guru\"},\"delete\":{\"key\":\"delete_guru\",\"label\":\"Hapus Guru\"}},\"Tugas & Pembelajaran\":{\"view\":{\"key\":\"view_tugas\",\"label\":\"Melihat Tugas\"},\"create\":{\"key\":\"create_tugas\",\"label\":\"Tambah Tugas\"},\"edit\":{\"key\":\"edit_tugas\",\"label\":\"Edit Tugas & Nilai\"},\"delete\":{\"key\":\"delete_tugas\",\"label\":\"Hapus Tugas\"}},\"Verifikasi Banding (SSL)\":{\"view\":{\"key\":\"view_dispensasi\",\"label\":\"Melihat Dispensasi\"},\"create\":null,\"edit\":{\"key\":\"approve_dispensasi\",\"label\":\"Setujui Dispensasi\"},\"delete\":null},\"Cetak Laporan\":{\"view\":{\"key\":\"view_laporan\",\"label\":\"Lihat Laporan\"},\"create\":null,\"edit\":null,\"delete\":null},\"Pengaturan Sistem\":{\"view\":null,\"create\":null,\"edit\":{\"key\":\"manage_settings\",\"label\":\"Pengaturan Sistem\"},\"delete\":null}}', '2026-07-11 02:19:18', '2026-07-11 02:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `entry_year` year DEFAULT NULL,
  `kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ortu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_ortu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif','lulus','mutasi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'aktif',
  `tahun_lulus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_batch_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengguna_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `tempat_lahir`, `jenis_kelamin`, `tanggal_lahir`, `entry_year`, `kelas`, `nama_ortu`, `no_hp_ortu`, `alamat`, `photo`, `status`, `tahun_lulus`, `acc_batch_id`, `pengguna_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'AKRIMA NAYLA AMIRA AGHNI', '2009-12-28', 'Laki-laki', '2009-12-28', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 36, '2026-07-06 06:23:53', '2026-08-15 12:49:26', NULL),
(2, NULL, 'ANIS PUTRI RAHMADANI', '2009-09-05', 'Laki-laki', '2009-09-05', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 37, '2026-07-06 06:23:53', '2026-08-15 12:49:26', NULL),
(3, NULL, 'ARIF EVAN NUR ROHMAT', '2010-06-23', 'Laki-laki', '2010-06-23', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 38, '2026-07-06 06:23:53', '2026-08-15 12:49:26', NULL),
(4, NULL, 'AULIA AZZAHRA', '2009-07-27', 'Laki-laki', '2009-07-27', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 39, '2026-07-06 06:23:53', '2026-08-15 12:49:26', NULL),
(5, NULL, 'BRILLIANT ATAINA ZULHIJA', '2009-11-22', 'Laki-laki', '2009-11-22', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 40, '2026-07-06 06:23:54', '2026-08-15 12:49:26', NULL),
(6, NULL, 'DEFAN DRIAN RIFAL KANDELA', '2010-06-11', 'Laki-laki', '2010-06-11', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 41, '2026-07-06 06:23:54', '2026-08-15 12:49:26', NULL),
(7, NULL, 'DIAN AYUK SETIANINGSIH', '2009-07-19', 'Laki-laki', '2009-07-19', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 42, '2026-07-06 06:23:54', '2026-08-15 12:49:26', NULL),
(8, NULL, 'EKA SELVIANA', '2009-09-14', 'Laki-laki', '2009-09-14', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 43, '2026-07-06 06:23:54', '2026-08-15 12:49:26', NULL),
(9, NULL, 'FADILA ALTHEA UFAIRA PUTRI', '2009-07-03', 'Laki-laki', '2009-07-03', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 44, '2026-07-06 06:23:55', '2026-08-15 12:49:26', NULL),
(10, NULL, 'FAREL WAHYU WIBOWO', '2010-04-10', 'Laki-laki', '2010-04-10', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 45, '2026-07-06 06:23:55', '2026-08-15 12:49:26', NULL),
(11, NULL, 'GALANG ADITYA NUGROHO', '2010-02-03', 'Laki-laki', '2010-02-03', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 46, '2026-07-06 06:23:55', '2026-08-15 12:49:26', NULL),
(12, NULL, 'GRACIA MAYLLANE PUTRI LEDO', '2009-05-03', 'Laki-laki', '2009-05-03', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 47, '2026-07-06 06:23:55', '2026-08-15 12:49:26', NULL),
(13, NULL, 'INDRIYANI WIDIASTUTI', '2010-04-12', 'Laki-laki', '2010-04-12', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 48, '2026-07-06 06:23:56', '2026-08-15 12:49:26', NULL),
(14, NULL, 'IRSYAD ADI RINAWAN', '2010-02-17', 'Laki-laki', '2010-02-17', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 49, '2026-07-06 06:23:56', '2026-08-15 12:49:26', NULL),
(15, NULL, 'KHANZA LATIFAH', '2010-01-04', 'Laki-laki', '2010-01-04', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 50, '2026-07-06 06:23:56', '2026-08-15 12:49:26', NULL),
(16, NULL, 'LILYANA MELINDA ELMER', '2009-10-30', 'Laki-laki', '2009-10-30', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 51, '2026-07-06 06:23:56', '2026-08-15 12:49:26', NULL),
(17, NULL, 'LUTHFI KAMIL JIBRAN', '2010-07-14', 'Laki-laki', '2010-07-14', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 52, '2026-07-06 06:23:56', '2026-08-15 12:49:26', NULL),
(18, NULL, 'MUHAMMAD BURHANUDIN HIBATULLOH', '2010-04-16', 'Laki-laki', '2010-04-16', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 53, '2026-07-06 06:23:57', '2026-08-15 12:49:26', NULL),
(19, NULL, 'Nanda Yusuf Prakoso', '2010-08-28', 'Laki-laki', '2010-08-28', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 54, '2026-07-06 06:23:57', '2026-08-15 12:49:26', NULL),
(20, NULL, 'NATHAN YOGA PRATAMA', '2009-08-21', 'Laki-laki', '2009-08-21', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 55, '2026-07-06 06:23:57', '2026-08-15 12:49:26', NULL),
(21, NULL, 'NAURA SYAFA', '2009-05-16', 'Laki-laki', '2009-05-16', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 56, '2026-07-06 06:23:57', '2026-08-15 12:49:26', NULL),
(22, NULL, 'Novita Rokhim Mawati', '2009-10-30', 'Laki-laki', '2009-10-30', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 57, '2026-07-06 06:23:58', '2026-08-15 12:49:26', NULL),
(23, NULL, 'PURWANINGSIH', '2009-12-21', 'Laki-laki', '2009-12-21', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 58, '2026-07-06 06:23:58', '2026-08-15 12:49:26', NULL),
(24, NULL, 'RAIF BANU FAIRUZ', '2009-05-14', 'Laki-laki', '2009-05-14', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 59, '2026-07-06 06:23:58', '2026-08-15 12:49:26', NULL),
(25, NULL, 'RENI OKTAVIA SARI', '2009-10-24', 'Laki-laki', '2009-10-24', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 60, '2026-07-06 06:23:58', '2026-08-15 12:49:26', NULL),
(26, NULL, 'RISMA NUR KHASANAH', '2009-09-10', 'Perempuan', '2009-09-10', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 61, '2026-07-06 06:23:58', '2026-08-15 12:49:26', NULL),
(27, NULL, 'ROKHIM MAHESTI', '2010-12-29', 'Perempuan', '2010-12-29', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 62, '2026-07-06 06:23:59', '2026-08-15 12:49:26', NULL),
(28, NULL, 'SEAN CAROLINE VALENTINE BAETRICE', '2010-02-13', 'Perempuan', '2010-02-13', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 63, '2026-07-06 06:23:59', '2026-08-15 12:49:26', NULL),
(29, NULL, 'SEVI LEVIAN GRAFISI', '2009-12-02', 'Perempuan', '2009-12-02', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 64, '2026-07-06 06:23:59', '2026-08-15 12:49:26', NULL),
(30, NULL, 'SULISTYANI MASRUROH', '2010-10-11', 'Perempuan', '2010-10-11', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 65, '2026-07-06 06:23:59', '2026-08-15 12:49:26', NULL),
(31, NULL, 'SYARIF HIDAYATULLOH', '2009-09-19', 'Perempuan', '2009-09-19', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 66, '2026-07-06 06:24:00', '2026-08-15 12:49:26', NULL),
(32, NULL, 'TRI NOFIYANTI', '2009-10-29', 'Perempuan', '2009-10-29', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 67, '2026-07-06 06:24:00', '2026-08-15 12:49:26', NULL),
(33, NULL, 'WAHYU OKTAVIA LESTARI', '2009-10-27', 'Perempuan', '2009-10-27', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 68, '2026-07-06 06:24:00', '2026-07-12 17:08:17', NULL),
(34, NULL, 'WIDIYANTO', '2009-08-22', 'Perempuan', '2009-08-22', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 69, '2026-07-06 06:24:00', '2026-07-12 17:08:17', NULL),
(35, NULL, 'Yoris Arya Rahmadan', '2009-09-02', 'Perempuan', '2009-09-02', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 70, '2026-07-06 06:24:01', '2026-07-12 17:08:17', NULL),
(36, NULL, 'YUNI RAHMAWATI', '2009-06-03', 'Perempuan', '2009-06-03', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 71, '2026-07-06 06:24:01', '2026-07-12 17:08:17', NULL),
(37, NULL, 'ADITYA DWI PUTRA', '2010-01-23', 'Laki-laki', '2010-01-23', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 72, '2026-07-06 06:24:01', '2026-07-12 17:08:17', NULL),
(38, NULL, 'Afiqah Ocktavi Wahyunia', '2009-10-06', 'Laki-laki', '2009-10-06', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 73, '2026-07-06 06:24:01', '2026-07-12 17:08:17', NULL),
(39, NULL, 'ALFIFAH ADYSTIA NURNANINGSIH', '2010-05-23', 'Laki-laki', '2010-05-23', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 74, '2026-07-06 06:24:02', '2026-07-12 17:08:17', NULL),
(40, NULL, 'ALVI AINURROZIQIN', '2010-03-16', 'Perempuan', '2010-03-16', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 75, '2026-07-06 06:24:02', '2026-07-12 17:08:17', NULL),
(41, NULL, 'ANISA AUFA ABIBATUL AZIZAH', '2009-11-26', 'Perempuan', '2009-11-26', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 76, '2026-07-06 06:24:02', '2026-07-12 17:08:17', NULL),
(42, NULL, 'AULIA ISTIQOMAH', '2010-07-11', 'Perempuan', '2010-07-11', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 77, '2026-07-06 06:24:02', '2026-07-12 17:08:17', NULL),
(43, NULL, 'BAGUS RIVAI', '2010-03-27', 'Perempuan', '2010-03-27', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 78, '2026-07-06 06:24:03', '2026-07-12 17:08:17', NULL),
(44, NULL, 'CALISTA SALMA MAHESWARI', '2009-02-27', 'Perempuan', '2009-02-27', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 79, '2026-07-06 06:24:03', '2026-07-12 17:08:17', NULL),
(45, NULL, 'DENIS ABI SETIAWAN', '2010-08-02', 'Perempuan', '2010-08-02', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 80, '2026-07-06 06:24:03', '2026-07-12 17:08:17', NULL),
(46, NULL, 'DIAN FATMAH AINU ROHMAH', '2009-08-21', 'Perempuan', '2009-08-21', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 81, '2026-07-06 06:24:03', '2026-07-12 17:08:17', NULL),
(47, NULL, 'EKA WULAN RAMADHANI', '2010-08-24', 'Perempuan', '2010-08-24', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 82, '2026-07-06 06:24:04', '2026-07-12 17:08:17', NULL),
(48, NULL, 'Faisya Ramadani', '2010-08-11', 'Perempuan', '2010-08-11', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 83, '2026-07-06 06:24:04', '2026-07-12 17:08:17', NULL),
(49, NULL, 'Farhan Zaki Fahrezy', '2009-11-30', 'Perempuan', '2009-11-30', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 84, '2026-07-06 06:24:04', '2026-07-12 17:08:17', NULL),
(50, NULL, 'GALIH PRATITIS WULANDRI UTOMO', '2010-06-09', 'Perempuan', '2010-06-09', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 85, '2026-07-06 06:24:04', '2026-07-12 17:08:17', NULL),
(51, NULL, 'GILDA CELLYN MAGDALENA', '2011-02-03', 'Perempuan', '2011-02-03', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 86, '2026-07-06 06:24:05', '2026-07-12 17:08:17', NULL),
(52, NULL, 'ISNAN NUR ARIFIN', '2009-12-31', 'Perempuan', '2009-12-31', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 87, '2026-07-06 06:24:05', '2026-07-12 17:08:17', NULL),
(53, NULL, 'JHUHRIA FEBRIANA', '2010-02-08', 'Perempuan', '2010-02-08', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 88, '2026-07-06 06:24:05', '2026-07-12 17:08:17', NULL),
(54, NULL, 'KIRANA NOVITASARI', '2009-11-01', 'Perempuan', '2009-11-01', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 89, '2026-07-06 06:24:05', '2026-07-12 17:08:17', NULL),
(55, NULL, 'LINTANG FAJAR WATI', '2009-11-22', 'Perempuan', '2009-11-22', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 90, '2026-07-06 06:24:06', '2026-07-12 17:08:17', NULL),
(56, NULL, 'MASSYAHRIL ARBA MAULANA', '2009-12-20', 'Perempuan', '2009-12-20', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 91, '2026-07-06 06:24:06', '2026-07-12 17:08:18', NULL),
(57, NULL, 'MUHAMMAD DIMAS AGUNG NUGROHO', '2009-10-22', 'Perempuan', '2009-10-22', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 92, '2026-07-06 06:24:06', '2026-07-12 17:08:18', NULL),
(58, NULL, 'NAYLA AZ ZAHRA', '2010-02-15', 'Perempuan', '2010-02-15', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 93, '2026-07-06 06:24:06', '2026-07-12 17:08:18', NULL),
(59, NULL, 'NAZA AKMAL FAIRIZUAN', '2009-10-21', 'Perempuan', '2009-10-21', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 94, '2026-07-06 06:24:07', '2026-07-12 17:08:18', NULL),
(60, NULL, 'NUR AINA SANIYAH QOLBI', '2010-07-07', 'Perempuan', '2010-07-07', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 95, '2026-07-06 06:24:07', '2026-07-12 17:08:18', NULL),
(61, NULL, 'PUTRI MAULIDA', '2010-02-26', 'Perempuan', '2010-02-26', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 96, '2026-07-06 06:24:07', '2026-07-12 17:08:18', NULL),
(62, NULL, 'RAKA RISANNJANA', '2010-08-10', 'Perempuan', '2010-08-10', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 97, '2026-07-06 06:24:08', '2026-07-12 17:08:18', NULL),
(63, NULL, 'RINA HANDAYANI', '2009-06-30', 'Perempuan', '2009-06-30', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 98, '2026-07-06 06:24:08', '2026-07-12 17:08:18', NULL),
(64, NULL, 'RONI OKTAVIAN', '2009-10-05', 'Perempuan', '2009-10-05', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 99, '2026-07-06 06:24:08', '2026-07-12 17:08:18', NULL),
(65, NULL, 'Salsa Nabila Dwi Aryanti', '2009-08-04', 'Perempuan', '2009-08-04', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 100, '2026-07-06 06:24:08', '2026-07-12 17:08:18', NULL),
(66, NULL, 'Septiyana Ramadani', '2009-09-02', 'Perempuan', '2009-09-02', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 101, '2026-07-06 06:24:09', '2026-07-12 17:08:18', NULL),
(67, NULL, 'SITI ROHANI', '2010-02-22', 'Perempuan', '2010-02-22', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 102, '2026-07-06 06:24:09', '2026-07-12 17:08:18', NULL),
(68, NULL, 'SYAFA MUFIDA AZ-ZAHRA', '2010-03-11', 'Perempuan', '2010-03-11', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 103, '2026-07-06 06:24:09', '2026-07-12 17:08:18', NULL),
(69, NULL, 'TRI WAHYU NOVIANA', '2009-11-14', 'Perempuan', '2009-11-14', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 104, '2026-07-06 06:24:09', '2026-07-12 17:08:18', NULL),
(70, NULL, 'TRI WAHYU NOVIANI', '2009-11-14', 'Perempuan', '2009-11-14', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 105, '2026-07-06 06:24:10', '2026-07-12 17:08:18', NULL),
(71, NULL, 'WAHYU WALIMATUL KHOLIFAH', '2010-01-31', 'Perempuan', '2010-01-31', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 106, '2026-07-06 06:24:10', '2026-07-12 17:08:18', NULL),
(72, NULL, 'YUNIA RIZKI ANISA', '2009-06-19', 'Perempuan', '2009-06-19', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 107, '2026-07-06 06:24:10', '2026-07-12 17:08:18', NULL),
(73, NULL, 'ABIZAH DEVANA HAFSARI', '2009-10-13', 'Laki-laki', '2009-10-13', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 108, '2026-07-06 06:24:10', '2026-07-12 17:08:18', NULL),
(74, NULL, 'ALANA JUAN REVANO', '2009-07-10', 'Laki-laki', '2009-07-10', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 109, '2026-07-06 06:24:11', '2026-07-12 17:08:18', NULL),
(75, NULL, 'ALIF CAHYA SETYANI', '2010-01-18', 'Laki-laki', '2010-01-18', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 110, '2026-07-06 06:24:11', '2026-07-12 17:08:18', NULL),
(76, NULL, 'ALVIN FEBRIYANSAH', '2010-02-12', 'Laki-laki', '2010-02-12', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 111, '2026-07-06 06:24:11', '2026-07-12 17:08:18', NULL),
(77, NULL, 'ANISA FEBRIYANA', '2010-02-24', 'Laki-laki', '2010-02-24', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 112, '2026-07-06 06:24:11', '2026-07-12 17:08:18', NULL),
(78, NULL, 'AULIA NUR RISKI', '2009-08-16', 'Perempuan', '2009-08-16', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 113, '2026-07-06 06:24:11', '2026-07-12 17:08:18', NULL),
(79, NULL, 'BAYU BAGUS LASTYADI', '2009-08-14', 'Perempuan', '2009-08-14', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 114, '2026-07-06 06:24:12', '2026-07-12 17:08:18', NULL),
(80, NULL, 'CHALILA NISRIN DEWANTI', '2010-01-04', 'Perempuan', '2010-01-04', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 115, '2026-07-06 06:24:12', '2026-07-12 17:08:18', NULL),
(81, NULL, 'DIKI PRAMANA', '2010-05-13', 'Perempuan', '2010-05-13', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 116, '2026-07-06 06:24:12', '2026-07-12 17:08:18', NULL),
(82, NULL, 'DINI INDAH AULIA', '2010-04-08', 'Perempuan', '2010-04-08', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 117, '2026-07-06 06:24:12', '2026-07-12 17:08:18', NULL),
(83, NULL, 'ELSA DEMAWATI', '2009-12-03', 'Perempuan', '2009-12-03', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 118, '2026-07-06 06:24:13', '2026-07-12 17:08:18', NULL),
(84, NULL, 'FARA AYU DITA', '2010-03-04', 'Perempuan', '2010-03-04', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 119, '2026-07-06 06:24:13', '2026-07-12 17:08:18', NULL),
(85, NULL, 'FARIS NAZHRIL ILHAM PRATAMA', '2010-03-07', 'Perempuan', '2010-03-07', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 120, '2026-07-06 06:24:13', '2026-07-12 17:08:18', NULL),
(86, NULL, 'HABIBAH SYAFA FAUZIAH', '2010-02-18', 'Perempuan', '2010-02-18', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 121, '2026-07-06 06:24:13', '2026-07-12 17:08:18', NULL),
(87, NULL, 'HAFIDZ MUHAMMAD IRFAN', '2009-09-30', 'Perempuan', '2009-09-30', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 122, '2026-07-06 06:24:13', '2026-07-12 17:08:18', NULL),
(88, NULL, 'INTAN NUR AISYAH', '2010-01-19', 'Perempuan', '2010-01-19', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 123, '2026-07-06 06:24:14', '2026-07-12 17:08:18', NULL),
(89, NULL, 'JAVERA RASHIF TRISTANDIKA', '2010-07-13', 'Perempuan', '2010-07-13', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 124, '2026-07-06 06:24:14', '2026-07-12 17:08:18', NULL),
(90, NULL, 'KALISA REGINA PUTRI', '2010-09-17', 'Perempuan', '2010-09-17', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 125, '2026-07-06 06:24:14', '2026-07-12 17:08:18', NULL),
(91, NULL, 'LUTFI AULIA RAMADHANI', '2010-08-11', 'Perempuan', '2010-08-11', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 126, '2026-07-06 06:24:14', '2026-07-12 17:08:18', NULL),
(92, NULL, 'MAULANA SATRIA SAPUTRA', '2010-01-12', 'Perempuan', '2010-01-12', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 127, '2026-07-06 06:24:15', '2026-07-12 17:08:18', NULL),
(93, NULL, 'MUHAMMAD FAISAL ABIDIN', '2009-05-20', 'Perempuan', '2009-05-20', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 128, '2026-07-06 06:24:15', '2026-07-12 17:08:18', NULL),
(94, NULL, 'NAYLA WAHYU LESTARI', '2010-01-29', 'Perempuan', '2010-01-29', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 129, '2026-07-06 06:24:15', '2026-07-12 17:08:18', NULL),
(95, NULL, 'NICO FANDEZTA PRATAMA', '2009-10-24', 'Perempuan', '2009-10-24', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 130, '2026-07-06 06:24:15', '2026-07-12 17:08:18', NULL),
(96, NULL, 'NUR SHOLIKAH', '2010-06-30', 'Perempuan', '2010-06-30', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 131, '2026-07-06 06:24:16', '2026-07-12 17:08:18', NULL),
(97, NULL, 'Putri Nur Sholekha', '2010-03-15', 'Perempuan', '2010-03-15', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 132, '2026-07-06 06:24:16', '2026-07-12 17:08:18', NULL),
(98, NULL, 'RAVI ALFATAH', '2009-04-20', 'Perempuan', '2009-04-20', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 133, '2026-07-06 06:24:16', '2026-07-12 17:08:18', NULL),
(99, NULL, 'RINDU MUGI LESTARI', '2009-08-27', 'Perempuan', '2009-08-27', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 134, '2026-07-06 06:24:16', '2026-07-12 17:08:18', NULL),
(100, NULL, 'SAIFUL BAHRI', '2009-03-26', 'Perempuan', '2009-03-26', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 135, '2026-07-06 06:24:17', '2026-07-12 17:08:18', NULL),
(101, NULL, 'SALWA AURA SAFITRI', '2009-09-24', 'Perempuan', '2009-09-24', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 136, '2026-07-06 06:24:17', '2026-07-12 17:08:18', NULL),
(102, NULL, 'SHELA ARINI FAUZIYAH', '2010-02-11', 'Perempuan', '2010-02-11', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 137, '2026-07-06 06:24:17', '2026-07-12 17:08:18', NULL),
(103, NULL, 'SOFIANA NOVITA SARI', '2010-06-22', 'Perempuan', '2010-06-22', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 138, '2026-07-06 06:24:17', '2026-07-12 17:08:18', NULL),
(104, NULL, 'SYAFINA FEBRIASTUTI', '2010-02-16', 'Perempuan', '2010-02-16', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 139, '2026-07-06 06:24:17', '2026-07-12 17:08:18', NULL),
(105, NULL, 'TAHTA ANDHIKA SETYAWAN', '2009-06-07', 'Perempuan', '2009-06-07', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 140, '2026-07-06 06:24:18', '2026-07-12 17:08:18', NULL),
(106, NULL, 'TOMY KURNIAWAN', '2009-10-28', 'Perempuan', '2009-10-28', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 141, '2026-07-06 06:24:18', '2026-07-12 17:08:18', NULL),
(107, NULL, 'WINDI FATIKA KHASANAH', '2009-11-05', 'Perempuan', '2009-11-05', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 142, '2026-07-06 06:24:18', '2026-07-12 17:08:18', NULL),
(108, NULL, 'ZAHRA FAJRINA', '2010-07-27', 'Perempuan', '2010-07-27', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 143, '2026-07-06 06:24:18', '2026-07-12 17:08:18', NULL),
(109, NULL, 'AFISAH MAHARANI', '2010-05-20', 'Laki-laki', '2010-05-20', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 144, '2026-07-06 06:24:19', '2026-07-12 17:08:18', NULL),
(110, NULL, 'ALFANO DWI HANDIKA', '2009-04-03', 'Laki-laki', '2009-04-03', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 145, '2026-07-06 06:24:19', '2026-07-12 17:08:18', NULL),
(111, NULL, 'ALINDA BRILIAN TIKA DEWI', '2010-07-12', 'Laki-laki', '2010-07-12', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 146, '2026-07-06 06:24:19', '2026-07-12 17:08:18', NULL),
(112, NULL, 'Andante Arga Yudhistira Prabowo', '2010-06-11', 'Laki-laki', '2010-06-11', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 147, '2026-07-06 06:24:19', '2026-07-12 17:08:18', NULL),
(113, NULL, 'ANNIS EKA ARIYANI', '2009-05-16', 'Laki-laki', '2009-05-16', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 148, '2026-07-06 06:24:20', '2026-07-12 17:08:18', NULL),
(114, NULL, 'AULIA RAFI QURROHMAN', '2008-12-04', 'Laki-laki', '2008-12-04', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 149, '2026-07-06 06:24:20', '2026-07-12 17:08:18', NULL),
(115, NULL, 'BAYU JATI ANGKOSO', '2009-09-26', 'Laki-laki', '2009-09-26', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 150, '2026-07-06 06:24:20', '2026-07-12 17:08:18', NULL),
(116, NULL, 'Daimatul Karimah', '2010-04-14', 'Laki-laki', '2010-04-14', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 151, '2026-07-06 06:24:20', '2026-07-12 17:08:18', NULL),
(117, NULL, 'DWI DONI PRABOWO', '2009-11-28', 'Laki-laki', '2009-11-28', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 152, '2026-07-06 06:24:21', '2026-07-12 17:08:18', NULL),
(118, NULL, 'DWI KURNIAWAN', '2009-11-22', 'Laki-laki', '2009-11-22', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 153, '2026-07-06 06:24:21', '2026-07-12 17:08:18', NULL),
(119, NULL, 'ENGGAR WAHYUNI', '2010-06-15', 'Laki-laki', '2010-06-15', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 154, '2026-07-06 06:24:21', '2026-07-12 17:08:18', NULL),
(120, NULL, 'FATAH RAMADHAN AJI SAPUTRA', '2010-08-25', 'Laki-laki', '2010-08-25', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 155, '2026-07-06 06:24:21', '2026-07-12 17:08:18', NULL),
(121, NULL, 'FEBRYANA ANGREINY PRANATA', '2010-02-05', 'Laki-laki', '2010-02-05', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 156, '2026-07-06 06:24:22', '2026-07-12 17:08:18', NULL),
(122, NULL, 'HANIFAH PUTRI MEILANI', '2010-05-20', 'Laki-laki', '2010-05-20', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 157, '2026-07-06 06:24:22', '2026-07-12 17:08:18', NULL),
(123, NULL, 'IQBAAL LUQMAN SAPUTRA', '2009-09-19', 'Perempuan', '2009-09-19', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 158, '2026-07-06 06:24:22', '2026-07-12 17:08:18', NULL),
(124, NULL, 'JAYANUDIN PURNA MURTI', '2010-04-27', 'Perempuan', '2010-04-27', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 159, '2026-07-06 06:24:22', '2026-07-12 17:08:18', NULL),
(125, NULL, 'KAYLA NUR ADILLA', '2010-10-24', 'Perempuan', '2010-10-24', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 160, '2026-07-06 06:24:22', '2026-07-12 17:08:18', NULL),
(126, NULL, 'KRISTIANA KURNIAWATI', '2010-02-22', 'Perempuan', '2010-02-22', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 161, '2026-07-06 06:24:23', '2026-07-12 17:08:18', NULL),
(127, NULL, 'MAYLA NURUL AFIFAH', '2010-05-05', 'Perempuan', '2010-05-05', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 162, '2026-07-06 06:24:23', '2026-07-12 17:08:18', NULL),
(128, NULL, 'MUHAMAD AKBAR SALIM', '2009-10-08', 'Perempuan', '2009-10-08', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 163, '2026-07-06 06:24:23', '2026-07-12 17:08:18', NULL),
(129, NULL, 'MUHAMMAD HABIB LUTHFI', '2010-04-25', 'Perempuan', '2010-04-25', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 164, '2026-07-06 06:24:23', '2026-07-12 17:08:18', NULL),
(130, NULL, 'NINA VANIA ZERLINA', '2009-11-19', 'Perempuan', '2009-11-19', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 165, '2026-07-06 06:24:24', '2026-07-12 17:08:18', NULL),
(131, NULL, 'NOVAL RIFKY AFRIANTO', '2009-11-08', 'Perempuan', '2009-11-08', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 166, '2026-07-06 06:24:24', '2026-07-12 17:08:18', NULL),
(132, NULL, 'NUR UTAMI', '2009-11-08', 'Perempuan', '2009-11-08', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 167, '2026-07-06 06:24:24', '2026-07-12 17:08:18', NULL),
(133, NULL, 'RAIHANNISA PUTRI FITRIANA', '2009-09-25', 'Perempuan', '2009-09-25', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 168, '2026-07-06 06:24:24', '2026-07-12 17:08:18', NULL),
(134, NULL, 'REZA ZAPUTRA', '2009-06-16', 'Perempuan', '2009-06-16', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 169, '2026-07-06 06:24:25', '2026-07-12 17:08:18', NULL),
(135, NULL, 'RIRIN DWI PRASETYANI', '2009-08-17', 'Perempuan', '2009-08-17', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 170, '2026-07-06 06:24:25', '2026-07-12 17:08:18', NULL),
(136, NULL, 'SANTI OLIVIA NINGSIH', '2009-04-30', 'Perempuan', '2009-04-30', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 171, '2026-07-06 06:24:25', '2026-07-12 17:08:18', NULL),
(137, NULL, 'SATRIA OCTA CAHYO PUTRO', '2009-10-22', 'Perempuan', '2009-10-22', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 172, '2026-07-06 06:24:25', '2026-07-12 17:08:18', NULL),
(138, NULL, 'SHELLYKHA DHANYATULL RIZMA', '2009-10-13', 'Perempuan', '2009-10-13', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 173, '2026-07-06 06:24:26', '2026-07-12 17:08:18', NULL),
(139, NULL, 'SRI MULYANI', '2010-02-18', 'Perempuan', '2010-02-18', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 174, '2026-07-06 06:24:26', '2026-07-12 17:08:18', NULL),
(140, NULL, 'TALITHA LUTHFI', '2009-09-08', 'Perempuan', '2009-09-08', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 175, '2026-07-06 06:24:26', '2026-07-12 17:08:18', NULL),
(141, NULL, 'TRI NURROHMAN', '2010-03-12', 'Perempuan', '2010-03-12', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 176, '2026-07-06 06:24:26', '2026-07-12 17:08:18', NULL),
(142, NULL, 'ULFA LUTFIANA', '2009-05-14', 'Perempuan', '2009-05-14', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 177, '2026-07-06 06:24:27', '2026-07-12 17:08:18', NULL),
(143, NULL, 'WIWIK LIS RAHAYU', '2009-12-20', 'Perempuan', '2009-12-20', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 178, '2026-07-06 06:24:27', '2026-07-12 17:08:18', NULL),
(144, NULL, 'ZAHWA PUTRI CAHYA RIANTI', '2010-03-18', 'Perempuan', '2010-03-18', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 179, '2026-07-06 06:24:27', '2026-07-12 17:08:18', NULL),
(145, NULL, 'Agnia Chindy Feyrus Chalisa', '2010-06-06', 'Laki-laki', '2010-06-06', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 180, '2026-07-06 06:24:27', '2026-07-12 17:08:18', NULL),
(146, NULL, 'ALFIANO DHIKA PRATAMA', '2010-01-04', 'Laki-laki', '2010-01-04', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 181, '2026-07-06 06:24:28', '2026-07-12 17:08:18', NULL),
(147, NULL, 'ALISA NAMIRA IMANI', '2010-02-18', 'Laki-laki', '2010-02-18', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 182, '2026-07-06 06:24:28', '2026-07-12 17:08:18', NULL),
(148, NULL, 'ANDI YONO', '2009-10-27', 'Laki-laki', '2009-10-27', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 183, '2026-07-06 06:24:28', '2026-07-12 17:08:18', NULL),
(149, NULL, 'Ariqa Sally Aswangga', '2010-03-25', 'Laki-laki', '2010-03-25', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 184, '2026-07-06 06:24:28', '2026-07-12 17:08:18', NULL),
(150, NULL, 'AULIYA ZAHRATUL SIVA', '2009-06-28', 'Laki-laki', '2009-06-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 185, '2026-07-06 06:24:29', '2026-07-12 17:08:18', NULL),
(151, NULL, 'CHOIRUL ADNAN', '2009-08-03', 'Laki-laki', '2009-08-03', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 186, '2026-07-06 06:24:29', '2026-07-12 17:08:18', NULL),
(152, NULL, 'DANIS NURIL FAHMA', '2009-08-15', 'Laki-laki', '2009-08-15', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 187, '2026-07-06 06:24:29', '2026-07-12 17:08:18', NULL),
(153, NULL, 'DWI EVA ARIYANI', '2010-03-28', 'Laki-laki', '2010-03-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 188, '2026-07-06 06:24:29', '2026-07-12 17:08:18', NULL),
(154, NULL, 'DWI INDRIANA', '2010-02-01', 'Laki-laki', '2010-02-01', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 189, '2026-07-06 06:24:29', '2026-07-12 17:08:18', NULL),
(155, NULL, 'ERDITA WAHYU FEBRIYANTI', '2010-02-24', 'Laki-laki', '2010-02-24', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 190, '2026-07-06 06:24:30', '2026-07-12 17:08:18', NULL),
(156, NULL, 'FERA YUNIARTI', '2010-06-30', 'Laki-laki', '2010-06-30', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 191, '2026-07-06 06:24:30', '2026-07-12 17:08:18', NULL),
(157, NULL, 'FERI ARDIYANTO', '2009-08-05', 'Laki-laki', '2009-08-05', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 192, '2026-07-06 06:24:30', '2026-07-12 17:08:18', NULL),
(158, NULL, 'HANIK IKA MUSLIKHAH', '2010-03-17', 'Laki-laki', '2010-03-17', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 193, '2026-07-06 06:24:30', '2026-07-12 17:08:18', NULL),
(159, NULL, 'IQBAL AL GHIFFAARI', '2009-07-21', 'Laki-laki', '2009-07-21', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 194, '2026-07-06 06:24:31', '2026-07-12 17:08:18', NULL),
(160, NULL, 'Joko Prasetiyo', '2010-03-19', 'Laki-laki', '2010-03-19', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 195, '2026-07-06 06:24:31', '2026-07-12 17:08:18', NULL),
(161, NULL, 'KEYZA JAZTYIN AYU DIA PRATIWI', '2009-06-09', 'Laki-laki', '2009-06-09', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 196, '2026-07-06 06:24:31', '2026-07-12 17:08:18', NULL),
(162, NULL, 'KUNTI DWI YULIANTI', '2009-06-28', 'Perempuan', '2009-06-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 197, '2026-07-06 06:24:32', '2026-07-12 17:08:18', NULL),
(163, NULL, 'MUHAMAD AKHYAR AFRILIAN', '2010-04-04', 'Perempuan', '2010-04-04', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 198, '2026-07-06 06:24:32', '2026-07-12 17:08:18', NULL),
(164, NULL, 'MUHAMMAD IRGI FAHREZI', '2010-03-25', 'Perempuan', '2010-03-25', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 199, '2026-07-06 06:24:32', '2026-07-12 17:08:18', NULL),
(165, NULL, 'NASRIFA YUMNA HAQILA', '2009-08-24', 'Perempuan', '2009-08-24', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 200, '2026-07-06 06:24:32', '2026-07-12 17:08:18', NULL),
(166, NULL, 'NISAUL AULIA', '2009-05-21', 'Perempuan', '2009-05-21', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 201, '2026-07-06 06:24:32', '2026-07-12 17:08:18', NULL),
(167, NULL, 'NOVAN DWI ANDIKA', '2008-11-12', 'Perempuan', '2008-11-12', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 202, '2026-07-06 06:24:33', '2026-07-12 17:08:18', NULL),
(168, NULL, 'OLIFFIA YULIANA', '2010-07-15', 'Perempuan', '2010-07-15', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 203, '2026-07-06 06:24:33', '2026-07-12 17:08:18', NULL),
(169, NULL, 'RATNA KEISHA SALSABILA', '2010-06-13', 'Perempuan', '2010-06-13', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 204, '2026-07-06 06:24:33', '2026-07-12 17:08:18', NULL),
(170, NULL, 'RIDHO LEONEL ADITYA', '2009-05-28', 'Perempuan', '2009-05-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 205, '2026-07-06 06:24:33', '2026-07-12 17:08:18', NULL),
(171, NULL, 'RIRIT BHARATA NINGTYAS', '2009-11-01', 'Perempuan', '2009-11-01', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 206, '2026-07-06 06:24:34', '2026-07-12 17:08:18', NULL),
(172, NULL, 'SASKIA ZAHRA AMANDA', '2009-03-27', 'Perempuan', '2009-03-27', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 207, '2026-07-06 06:24:34', '2026-07-12 17:08:18', NULL),
(173, NULL, 'SITI OKTAVIANI', '2009-10-29', 'Perempuan', '2009-10-29', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 208, '2026-07-06 06:24:34', '2026-07-12 17:08:18', NULL),
(174, NULL, 'SLAMET TRIYANTO', '2009-06-28', 'Perempuan', '2009-06-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 209, '2026-07-06 06:24:35', '2026-07-12 17:08:18', NULL),
(175, NULL, 'SRI MURNI', '2009-08-11', 'Perempuan', '2009-08-11', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 210, '2026-07-06 06:24:35', '2026-07-12 17:08:18', NULL),
(176, NULL, 'TIKA AULIA', '2009-06-25', 'Perempuan', '2009-06-25', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 211, '2026-07-06 06:24:35', '2026-07-12 17:08:18', NULL),
(177, NULL, 'USWATUN KHASANAH', '2009-12-03', 'Perempuan', '2009-12-03', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 212, '2026-07-06 06:24:35', '2026-07-12 17:08:18', NULL),
(178, NULL, 'Wahyu Tri Mulyanto', '2009-09-05', 'Perempuan', '2009-09-05', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 213, '2026-07-06 06:24:35', '2026-07-12 17:08:18', NULL),
(179, NULL, 'WULAN AGUSTIN', '2009-08-08', 'Perempuan', '2009-08-08', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 214, '2026-07-06 06:24:36', '2026-07-12 17:08:18', NULL),
(180, NULL, 'ZULFA ISNAINISA', '2010-05-21', 'Perempuan', '2010-05-21', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 215, '2026-07-06 06:24:36', '2026-07-12 17:08:18', NULL),
(181, NULL, 'AIDA SYAHIRA', '2010-12-23', 'Laki-laki', '2010-12-23', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 216, '2026-07-06 06:24:36', '2026-07-12 17:08:18', NULL),
(182, NULL, 'ALFIN IRGIYANSAH', '2009-07-19', 'Laki-laki', '2009-07-19', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 217, '2026-07-06 06:24:36', '2026-07-12 17:08:18', NULL),
(183, NULL, 'ALMIRA IKSANIA PUTRI', '2009-11-16', 'Laki-laki', '2009-11-16', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 218, '2026-07-06 06:24:37', '2026-07-12 17:08:18', NULL),
(184, NULL, 'ANDIKA PRATAMA', '2010-04-17', 'Laki-laki', '2010-04-17', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 219, '2026-07-06 06:24:37', '2026-07-12 17:08:18', NULL),
(185, NULL, 'ARLINA TARA MAHENDRA', '2010-03-21', 'Laki-laki', '2010-03-21', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 220, '2026-07-06 06:24:37', '2026-07-12 17:08:18', NULL),
(186, NULL, 'AURA PUTRI KUSTIA WAL SOLEKHAH', '2009-01-12', 'Laki-laki', '2009-01-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 221, '2026-07-06 06:24:38', '2026-07-12 17:08:18', NULL),
(187, NULL, 'CHOIRUL UMAM', '2010-06-03', 'Laki-laki', '2010-06-03', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 222, '2026-07-06 06:24:38', '2026-07-12 17:08:18', NULL),
(188, NULL, 'DESWITA DWI MAY RANI', '2009-12-20', 'Laki-laki', '2009-12-20', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 223, '2026-07-06 06:24:38', '2026-07-12 17:08:18', NULL),
(189, NULL, 'Dwi Indriyani', '2009-06-15', 'Laki-laki', '2009-06-15', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 224, '2026-07-06 06:24:38', '2026-07-12 17:08:18', NULL),
(190, NULL, 'Dwi Wicaksono', '2009-03-16', 'Laki-laki', '2009-03-16', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 225, '2026-07-06 06:24:39', '2026-07-12 17:08:18', NULL),
(191, NULL, 'ESHA SULISTIYANI', '2009-11-25', 'Laki-laki', '2009-11-25', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 226, '2026-07-06 06:24:39', '2026-07-12 17:08:18', NULL),
(192, NULL, 'FILIO KENZIE HAFEEZY', '2009-09-24', 'Laki-laki', '2009-09-24', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 227, '2026-07-06 06:24:39', '2026-07-12 17:08:18', NULL),
(193, NULL, 'FITRI SHOLIKHAH', '2009-11-27', 'Laki-laki', '2009-11-27', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 228, '2026-07-06 06:24:39', '2026-07-12 17:08:18', NULL),
(194, NULL, 'Ika Wahyuningsih', '2010-02-12', 'Laki-laki', '2010-02-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 229, '2026-07-06 06:24:39', '2026-07-12 17:08:18', NULL),
(195, NULL, 'IRFAN AHMAD', '2009-12-12', 'Laki-laki', '2009-12-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 230, '2026-07-06 06:24:40', '2026-07-12 17:08:18', NULL),
(196, NULL, 'Khailla Adelia Marsya', '2009-05-30', 'Laki-laki', '2009-05-30', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 231, '2026-07-06 06:24:40', '2026-07-12 17:08:18', NULL),
(197, NULL, 'KHARIZ IRFAN HAKIM', '2010-07-23', 'Laki-laki', '2010-07-23', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 232, '2026-07-06 06:24:40', '2026-07-12 17:08:18', NULL),
(198, NULL, 'LAUDYA DEVINA ANASTASYA', '2010-05-21', 'Laki-laki', '2010-05-21', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 233, '2026-07-06 06:24:40', '2026-07-12 17:08:18', NULL),
(199, NULL, 'MUHAMAD DINO WARDANA', '2010-05-12', 'Laki-laki', '2010-05-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 234, '2026-07-06 06:24:41', '2026-07-12 17:08:18', NULL),
(200, NULL, 'MUHAMMAD RAFFA AL FADHIL', '2009-01-18', 'Laki-laki', '2009-01-18', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 235, '2026-07-06 06:24:41', '2026-07-12 17:08:18', NULL),
(201, NULL, 'NATASYA NOVITA PUTRI', '2010-05-13', 'Perempuan', '2010-05-13', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 236, '2026-07-06 06:24:41', '2026-07-12 17:08:18', NULL),
(202, NULL, 'NIYA SELA PASHA ARDHILA', '2009-11-19', 'Perempuan', '2009-11-19', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 237, '2026-07-06 06:24:42', '2026-07-12 17:08:18', NULL),
(203, NULL, 'NOVIYANTO FARLY IRAWAN', '2009-11-23', 'Perempuan', '2009-11-23', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 238, '2026-07-06 06:24:42', '2026-07-12 17:08:18', NULL),
(204, NULL, 'Olivia Ayyatul Khusna', '2010-08-15', 'Perempuan', '2010-08-15', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 239, '2026-07-06 06:24:42', '2026-07-12 17:08:18', NULL),
(205, NULL, 'RAUDHYA ZAHRA RASYIDAH', '2009-11-21', 'Perempuan', '2009-11-21', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 240, '2026-07-06 06:24:42', '2026-07-12 17:08:18', NULL),
(206, NULL, 'RIO IRAWAN', '2010-08-12', 'Perempuan', '2010-08-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 241, '2026-07-06 06:24:43', '2026-07-12 17:08:18', NULL),
(207, NULL, 'RISKA WAHYU SEPTIYANI', '2010-09-24', 'Perempuan', '2010-09-24', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 242, '2026-07-06 06:24:43', '2026-07-12 17:08:18', NULL),
(208, NULL, 'Sasya Eka Septiyasa', '2010-09-27', 'Perempuan', '2010-09-27', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 243, '2026-07-06 06:24:43', '2026-07-12 17:08:18', NULL),
(209, NULL, 'SITI PRIHATIN', '2010-07-17', 'Perempuan', '2010-07-17', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 244, '2026-07-06 06:24:43', '2026-07-12 17:08:18', NULL),
(210, NULL, 'SRI RAHAYU', '2009-09-27', 'Perempuan', '2009-09-27', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 245, '2026-07-06 06:24:44', '2026-07-12 17:08:18', NULL),
(211, NULL, 'SURYA ADISTI PUTRA', '2009-10-20', 'Perempuan', '2009-10-20', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 246, '2026-07-06 06:24:44', '2026-07-12 17:08:18', NULL),
(212, NULL, 'TRI HARTANTI', '2010-05-13', 'Perempuan', '2010-05-13', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 247, '2026-07-06 06:24:44', '2026-07-12 17:08:18', NULL),
(213, NULL, 'WAHYU FARAH AULIA', '2010-07-13', 'Perempuan', '2010-07-13', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 248, '2026-07-06 06:24:44', '2026-07-12 17:08:18', NULL),
(214, NULL, 'YAKA HUTAMA', '2009-11-14', 'Perempuan', '2009-11-14', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 249, '2026-07-06 06:24:45', '2026-07-12 17:08:18', NULL),
(215, NULL, 'YAMANDA TIYASTUTI', '2009-08-10', 'Perempuan', '2009-08-10', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 250, '2026-07-06 06:24:45', '2026-07-12 17:08:18', NULL),
(216, NULL, 'ZULFA NUR AZIZAH', '2010-01-09', 'Perempuan', '2010-01-09', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 251, '2026-07-06 06:24:45', '2026-07-12 17:08:18', NULL),
(217, NULL, 'ADITIA SAPUTRA', '2009-07-18', 'Laki-laki', '2009-07-18', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 252, '2026-07-06 06:24:45', '2026-07-12 17:08:18', NULL),
(218, NULL, 'AISYAH PUTRI AZZAHRA', '2010-12-12', 'Laki-laki', '2010-12-12', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 253, '2026-07-06 06:24:46', '2026-07-12 17:08:18', NULL),
(219, NULL, 'ALI ZAINAL ABIDIN', '2009-12-14', 'Laki-laki', '2009-12-14', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 254, '2026-07-06 06:24:46', '2026-07-12 17:08:18', NULL),
(220, NULL, 'ALYARISMA DEVINA ANGGRAENI', '2009-12-04', 'Laki-laki', '2009-12-04', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 255, '2026-07-06 06:24:46', '2026-07-12 17:08:18', NULL),
(221, NULL, 'ARDIAN BINTANG PRAMUDITA', '2009-10-19', 'Laki-laki', '2009-10-19', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 256, '2026-07-06 06:24:47', '2026-07-12 17:08:18', NULL),
(222, NULL, 'ARYA SAFITRI', '2009-01-17', 'Laki-laki', '2009-01-17', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 257, '2026-07-06 06:24:47', '2026-07-12 17:08:18', NULL),
(223, NULL, 'BERLINA PURNAMA NUGRAHANI', '2010-06-03', 'Laki-laki', '2010-06-03', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 258, '2026-07-06 06:24:47', '2026-07-12 17:08:18', NULL),
(224, NULL, 'DEDY NOVANDI', '2009-11-06', 'Laki-laki', '2009-11-06', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 259, '2026-07-06 06:24:47', '2026-07-12 17:08:18', NULL),
(225, NULL, 'DEVIANA BELLA SASKIA', '2010-05-05', 'Laki-laki', '2010-05-05', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 260, '2026-07-06 06:24:48', '2026-07-12 17:08:18', NULL),
(226, NULL, 'ECKA RIDO SETYONO', '2010-04-24', 'Laki-laki', '2010-04-24', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 261, '2026-07-06 06:24:48', '2026-07-12 17:08:18', NULL),
(227, NULL, 'EDRIA THEDA MUFARIHAH', '2010-01-25', 'Laki-laki', '2010-01-25', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 262, '2026-07-06 06:24:48', '2026-07-12 17:08:18', NULL),
(228, NULL, 'EVA APRILIA SAFITRI', '2010-04-01', 'Laki-laki', '2010-04-01', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 263, '2026-07-06 06:24:48', '2026-07-12 17:08:18', NULL),
(229, NULL, 'FRISKA YOGI WAHYUNINGTYAS', '2008-08-19', 'Laki-laki', '2008-08-19', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 264, '2026-07-06 06:24:49', '2026-07-12 17:08:18', NULL),
(230, NULL, 'GABRILIA MUTIARA SARI', '2008-04-28', 'Laki-laki', '2008-04-28', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 265, '2026-07-06 06:24:49', '2026-07-12 17:08:18', NULL),
(231, NULL, 'IKHDA ANNISA RAHMAH', '2010-10-09', 'Laki-laki', '2010-10-09', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 266, '2026-07-06 06:24:49', '2026-07-12 17:08:18', NULL),
(232, NULL, 'IRFAN DWI SETIAWAN', '2010-08-26', 'Laki-laki', '2010-08-26', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 267, '2026-07-06 06:24:49', '2026-07-12 17:08:18', NULL),
(233, NULL, 'KHAIRUNISA AZAHRA RAMADANI', '2010-08-21', 'Laki-laki', '2010-08-21', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 268, '2026-07-06 06:24:50', '2026-07-12 17:08:18', NULL),
(234, NULL, 'KURNIAWAN SIDIK BAYU PRAKOSO', '2010-03-11', 'Laki-laki', '2010-03-11', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 269, '2026-07-06 06:24:50', '2026-07-12 17:08:18', NULL),
(235, NULL, 'LILIK SRI LESTARI', '2009-07-02', 'Laki-laki', '2009-07-02', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 270, '2026-07-06 06:24:50', '2026-07-12 17:08:18', NULL),
(236, NULL, 'Muhammad Affandi Arsyad Yuono Putra', '2010-04-10', 'Laki-laki', '2010-04-10', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 271, '2026-07-06 06:24:50', '2026-07-12 17:08:18', NULL),
(237, NULL, 'MUHAMMAD RIZAL ALYAZID', '2010-01-06', 'Laki-laki', '2010-01-06', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 272, '2026-07-06 06:24:51', '2026-07-12 17:08:18', NULL),
(238, NULL, 'Natasya Yunika Putri', '2010-06-15', 'Perempuan', '2010-06-15', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 273, '2026-07-06 06:24:51', '2026-07-12 17:08:18', NULL),
(239, NULL, 'NOVI KURNIASARI', '2009-10-30', 'Perempuan', '2009-10-30', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 274, '2026-07-06 06:24:51', '2026-07-12 17:08:18', NULL),
(240, NULL, 'NUR FAISAL', '2009-10-03', 'Perempuan', '2009-10-03', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 275, '2026-07-06 06:24:51', '2026-07-12 17:08:18', NULL),
(241, NULL, 'PIPIT SRI HANDAYANI', '2010-03-23', 'Perempuan', '2010-03-23', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 276, '2026-07-06 06:24:52', '2026-07-12 17:08:18', NULL),
(242, NULL, 'RAYKHANUN NOVA REZQIANI', '2009-11-30', 'Perempuan', '2009-11-30', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 277, '2026-07-06 06:24:52', '2026-07-12 17:08:18', NULL),
(243, NULL, 'RISKY FADILAH', '2010-01-15', 'Perempuan', '2010-01-15', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 278, '2026-07-06 06:24:52', '2026-07-12 17:08:18', NULL),
(244, NULL, 'ROICHAN AHMAD ARROYANI', '2010-02-18', 'Perempuan', '2010-02-18', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 279, '2026-07-06 06:24:52', '2026-07-12 17:08:18', NULL),
(245, NULL, 'SAVA LESTARI', '2010-01-20', 'Perempuan', '2010-01-20', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 280, '2026-07-06 06:24:53', '2026-07-12 17:08:18', NULL),
(246, NULL, 'SITI ROHANA', '2010-02-22', 'Perempuan', '2010-02-22', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 281, '2026-07-06 06:24:53', '2026-07-12 17:08:18', NULL),
(247, NULL, 'STIYA WATIK', '2009-07-23', 'Perempuan', '2009-07-23', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 282, '2026-07-06 06:24:53', '2026-07-12 17:08:18', NULL),
(248, NULL, 'SYARIF HIDAYATULLAH', '2010-01-23', 'Perempuan', '2010-01-23', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 283, '2026-07-06 06:24:53', '2026-07-12 17:08:18', NULL),
(249, NULL, 'TRI LISTIYANINGSIH', '2010-03-11', 'Perempuan', '2010-03-11', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 284, '2026-07-06 06:24:54', '2026-07-12 17:08:18', NULL),
(250, NULL, 'WAHYU KHAMIDHATU ZUHRIYA', '2010-07-17', 'Perempuan', '2010-07-17', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 285, '2026-07-06 06:24:54', '2026-07-12 17:08:18', NULL),
(251, NULL, 'YOGA KURNIYAWAN', '2009-09-10', 'Perempuan', '2009-09-10', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 286, '2026-07-06 06:24:54', '2026-07-12 17:08:18', NULL),
(252, NULL, 'YULMIA KIRANI AZIZAH', '2009-08-21', 'Perempuan', '2009-08-21', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 287, '2026-07-06 06:24:54', '2026-07-12 17:08:18', NULL),
(253, NULL, 'Abdul Hafizh Mardiyanto', '2009-05-17', 'Laki-laki', '2009-05-17', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 288, '2026-07-06 06:24:55', '2026-07-12 13:37:21', NULL),
(254, NULL, 'ADITYA PRADANA FIKI ARDIANSYAH', '2009-08-25', 'Laki-laki', '2009-08-25', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 289, '2026-07-06 06:24:55', '2026-07-12 13:37:21', NULL),
(255, NULL, 'AGENG BUDI HARJO', '2008-11-08', 'Laki-laki', '2008-11-08', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 290, '2026-07-06 06:24:55', '2026-07-12 13:37:21', NULL),
(256, NULL, 'AHMAD ZAENURI', '2008-12-01', 'Laki-laki', '2008-12-01', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 291, '2026-07-06 06:24:55', '2026-07-12 13:37:21', NULL),
(257, NULL, 'ALLEA SASTRA ALMA FAISHA', '2009-02-01', 'Laki-laki', '2009-02-01', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 292, '2026-07-06 06:24:56', '2026-07-12 13:37:21', NULL),
(258, NULL, 'Angga Setiawan', '2009-05-25', 'Laki-laki', '2009-05-25', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 293, '2026-07-06 06:24:56', '2026-07-12 13:37:21', NULL),
(259, NULL, 'ARES WIDODO', '2009-09-04', 'Laki-laki', '2009-09-04', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 294, '2026-07-06 06:24:56', '2026-07-12 13:37:21', NULL),
(260, NULL, 'DANANG SULISTYO', '2008-11-01', 'Laki-laki', '2008-11-01', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 295, '2026-07-06 06:24:56', '2026-07-12 13:37:21', NULL),
(261, NULL, 'DIMAS RAIKHAN DEWANTORO', '2008-05-02', 'Laki-laki', '2008-05-02', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 296, '2026-07-06 06:24:57', '2026-07-12 13:37:21', NULL),
(262, NULL, 'DZAKY RAIHAN PUTRA PRATHAMA', '2009-03-05', 'Laki-laki', '2009-03-05', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 297, '2026-07-06 06:24:57', '2026-07-12 13:37:21', NULL),
(263, NULL, 'FARHAN WIRA ARDIAN MAULANA', '2009-03-12', 'Laki-laki', '2009-03-12', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 298, '2026-07-06 06:24:57', '2026-07-12 13:37:21', NULL);
INSERT INTO `siswa` (`id`, `nis`, `nama`, `tempat_lahir`, `jenis_kelamin`, `tanggal_lahir`, `entry_year`, `kelas`, `nama_ortu`, `no_hp_ortu`, `alamat`, `photo`, `status`, `tahun_lulus`, `acc_batch_id`, `pengguna_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(264, NULL, 'GALIH REHANANTO', '2008-12-18', 'Laki-laki', '2008-12-18', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 299, '2026-07-06 06:24:57', '2026-07-12 13:37:21', NULL),
(265, NULL, 'HABIBUR RAHMAN', '2008-06-26', 'Laki-laki', '2008-06-26', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 300, '2026-07-06 06:24:58', '2026-07-12 13:37:21', NULL),
(266, NULL, 'Ilham Taukhid Mustakim', '2009-05-02', 'Laki-laki', '2009-05-02', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 301, '2026-07-06 06:24:58', '2026-07-12 13:37:21', NULL),
(267, NULL, 'Ivan Galih Maulana', '2009-03-25', 'Laki-laki', '2009-03-25', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 302, '2026-07-06 06:24:58', '2026-07-12 13:37:21', NULL),
(268, NULL, 'Jesika Rahma Maulana', '2009-08-24', 'Laki-laki', '2009-08-24', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 303, '2026-07-06 06:24:58', '2026-07-12 13:37:21', NULL),
(269, NULL, 'JOICE IVANIA', '2008-07-22', 'Laki-laki', '2008-07-22', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 304, '2026-07-06 06:24:59', '2026-07-12 13:37:21', NULL),
(270, NULL, 'KHALILA ESTA PUTRI', '2009-08-06', 'Laki-laki', '2009-08-06', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 305, '2026-07-06 06:24:59', '2026-07-12 13:37:21', NULL),
(271, NULL, 'LATIFA AZZARA', '2008-08-21', 'Laki-laki', '2008-08-21', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 306, '2026-07-06 06:24:59', '2026-07-12 13:37:21', NULL),
(272, NULL, 'Listianingsih', '2008-12-05', 'Laki-laki', '2008-12-05', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 307, '2026-07-06 06:24:59', '2026-07-12 13:37:21', NULL),
(273, NULL, 'MOHAMAD YOGA PRATAMA', '2009-06-29', 'Laki-laki', '2009-06-29', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 308, '2026-07-06 06:24:59', '2026-07-12 13:37:21', NULL),
(274, NULL, 'MUGHNI LAFIF AL LATIEF', '2008-12-20', 'Laki-laki', '2008-12-20', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 309, '2026-07-06 06:25:00', '2026-07-12 13:37:21', NULL),
(275, NULL, 'MUHYI ASRORI FUADY', '2009-01-28', 'Laki-laki', '2009-01-28', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 310, '2026-07-06 06:25:00', '2026-07-12 13:37:21', NULL),
(276, NULL, 'NASYWA NATHANIA JASMINE', '2009-05-03', 'Laki-laki', '2009-05-03', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 311, '2026-07-06 06:25:00', '2026-07-12 13:37:21', NULL),
(277, NULL, 'NAZARI ADI LESMANA', '2008-08-16', 'Laki-laki', '2008-08-16', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 312, '2026-07-06 06:25:01', '2026-07-12 13:37:21', NULL),
(278, NULL, 'Nofa Setiadi', '2008-11-24', 'Laki-laki', '2008-11-24', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 313, '2026-07-06 06:25:01', '2026-07-12 13:37:21', NULL),
(279, NULL, 'Novita Anisa Putri', '2008-11-22', 'Laki-laki', '2008-11-22', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 314, '2026-07-06 06:25:01', '2026-07-12 13:37:21', NULL),
(280, NULL, 'Pipiet Nastiti Wulan', '2009-03-10', 'Laki-laki', '2009-03-10', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 315, '2026-07-06 06:25:01', '2026-07-12 13:37:21', NULL),
(281, NULL, 'RAFA PUTRA PURWANA', '2008-11-28', 'Laki-laki', '2008-11-28', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 316, '2026-07-06 06:25:02', '2026-07-12 13:37:21', NULL),
(282, NULL, 'RAFID AFFANDI', '2008-10-14', 'Laki-laki', '2008-10-14', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 317, '2026-07-06 06:25:02', '2026-07-12 13:37:21', NULL),
(283, NULL, 'RAHARJA GALIH CANDRANANTA', '2008-11-26', 'Laki-laki', '2008-11-26', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 318, '2026-07-06 06:25:02', '2026-07-12 13:37:21', NULL),
(284, NULL, 'RIBANG RAIF RABANI', '2009-07-27', 'Laki-laki', '2009-07-27', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 319, '2026-07-06 06:25:03', '2026-07-12 13:37:21', NULL),
(285, NULL, 'SATYA NUGROHO', '2009-02-16', 'Laki-laki', '2009-02-16', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 320, '2026-07-06 06:25:03', '2026-07-12 13:37:21', NULL),
(286, NULL, 'SRI WAHYU RAHMADANI', '2008-09-06', 'Laki-laki', '2008-09-06', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 321, '2026-07-06 06:25:03', '2026-07-12 13:37:21', NULL),
(287, NULL, 'SUCI MAHARDIKA', '2008-08-17', 'Laki-laki', '2008-08-17', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 322, '2026-07-06 06:25:03', '2026-07-12 13:37:21', NULL),
(288, NULL, 'YANTI IDA LESTARI', '2008-07-09', 'Laki-laki', '2008-07-09', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 323, '2026-07-06 06:25:04', '2026-07-12 13:37:21', NULL),
(289, NULL, 'Ambar Dwi Andhini', '2009-01-14', 'Laki-laki', '2009-01-14', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 324, '2026-07-06 06:25:04', '2026-07-12 13:37:21', NULL),
(290, NULL, 'AMELIA PUSPITA SARI', '2008-12-26', 'Laki-laki', '2008-12-26', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 325, '2026-07-06 06:25:04', '2026-07-12 13:37:21', NULL),
(291, NULL, 'ANIS CAHYATI', '2009-04-12', 'Laki-laki', '2009-04-12', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 326, '2026-07-06 06:25:04', '2026-07-12 13:37:21', NULL),
(292, NULL, 'Aqilla Khairunnisa', '2008-11-08', 'Laki-laki', '2008-11-08', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 327, '2026-07-06 06:25:05', '2026-07-12 13:37:21', NULL),
(293, NULL, 'ARYA BIMA SAPUTRA', '2008-10-28', 'Laki-laki', '2008-10-28', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 328, '2026-07-06 06:25:05', '2026-07-12 13:37:21', NULL),
(294, NULL, 'Azahra Azizatul Febriyana', '2009-02-20', 'Laki-laki', '2009-02-20', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 329, '2026-07-06 06:25:05', '2026-07-12 13:37:21', NULL),
(295, NULL, 'Denil Nur Faizin', '2009-02-21', 'Laki-laki', '2009-02-21', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 330, '2026-07-06 06:25:05', '2026-07-12 13:37:21', NULL),
(296, NULL, 'DESTA AYU ARISTA', '2007-09-30', 'Laki-laki', '2007-09-30', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 331, '2026-07-06 06:25:06', '2026-07-12 13:37:21', NULL),
(297, NULL, 'DIAH AYU SILVIANA', '2009-01-02', 'Laki-laki', '2009-01-02', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 332, '2026-07-06 06:25:06', '2026-07-12 13:37:21', NULL),
(298, NULL, 'DINDA DARA KUSUMA', '2009-07-25', 'Laki-laki', '2009-07-25', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 333, '2026-07-06 06:25:06', '2026-07-12 13:37:21', NULL),
(299, NULL, 'DINI ASTUTI', '2008-08-28', 'Laki-laki', '2008-08-28', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 334, '2026-07-06 06:25:06', '2026-07-12 13:37:21', NULL),
(300, NULL, 'EKA AYU LESTARI', '2009-03-18', 'Laki-laki', '2009-03-18', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 335, '2026-07-06 06:25:07', '2026-07-12 13:37:21', NULL),
(301, NULL, 'EKA SEPTIANINGSIH', '2008-09-05', 'Laki-laki', '2008-09-05', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 336, '2026-07-06 06:25:07', '2026-07-12 13:37:21', NULL),
(302, NULL, 'ERISDA ANUNG WIDAYANI', '2008-10-30', 'Laki-laki', '2008-10-30', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 337, '2026-07-06 06:25:07', '2026-07-12 13:37:21', NULL),
(303, NULL, 'IKA WULANDARI', '2009-03-18', 'Laki-laki', '2009-03-18', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 338, '2026-07-06 06:25:07', '2026-07-12 13:37:21', NULL),
(304, NULL, 'ILI YINNA SUFI AL-HAQ', '2009-10-01', 'Laki-laki', '2009-10-01', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 339, '2026-07-06 06:25:07', '2026-07-12 13:37:21', NULL),
(305, NULL, 'IMAM ABDUL AZIS', '2009-04-10', 'Laki-laki', '2009-04-10', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 340, '2026-07-06 06:25:08', '2026-07-12 13:37:21', NULL),
(306, NULL, 'JESIKA NOVITA RAHMAWATI', '2008-11-20', 'Laki-laki', '2008-11-20', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 341, '2026-07-06 06:25:08', '2026-07-12 13:37:21', NULL),
(307, NULL, 'KAILA YULI YATI', '2009-07-05', 'Laki-laki', '2009-07-05', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 342, '2026-07-06 06:25:08', '2026-07-12 13:37:21', NULL),
(308, NULL, 'KHARISA SUCI LESTARI', '2009-03-14', 'Laki-laki', '2009-03-14', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 343, '2026-07-06 06:25:08', '2026-07-12 13:37:21', NULL),
(309, NULL, 'LUXVI ISTIANA ANNISA', '2009-06-07', 'Laki-laki', '2009-06-07', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 344, '2026-07-06 06:25:09', '2026-07-12 13:37:21', NULL),
(310, NULL, 'META UTAMI', '2009-06-17', 'Laki-laki', '2009-06-17', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 345, '2026-07-06 06:25:09', '2026-07-12 13:37:21', NULL),
(311, NULL, 'MUTIA FIRDASARI', '2008-12-29', 'Laki-laki', '2008-12-29', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 346, '2026-07-06 06:25:09', '2026-07-12 13:37:21', NULL),
(312, NULL, 'NITA FITRIYANI', '2009-10-01', 'Laki-laki', '2009-10-01', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 347, '2026-07-06 06:25:09', '2026-07-12 13:37:21', NULL),
(313, NULL, 'NOVALIA SAFITRI', '2009-11-28', 'Laki-laki', '2009-11-28', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 348, '2026-07-06 06:25:10', '2026-07-12 13:37:21', NULL),
(314, NULL, 'NOVITA ARUM SARI', '2008-11-04', 'Laki-laki', '2008-11-04', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 349, '2026-07-06 06:25:10', '2026-07-12 13:37:21', NULL),
(315, NULL, 'Rezky Heru Nitha', '2009-10-03', 'Laki-laki', '2009-10-03', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 350, '2026-07-06 06:25:10', '2026-07-12 13:37:21', NULL),
(316, NULL, 'RIZKY AMELIYA', '2008-10-21', 'Laki-laki', '2008-10-21', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 351, '2026-07-06 06:25:10', '2026-07-12 13:37:21', NULL),
(317, NULL, 'SALSABILAH AGUSTINA', '2008-08-17', 'Laki-laki', '2008-08-17', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 352, '2026-07-06 06:25:11', '2026-07-12 13:37:21', NULL),
(318, NULL, 'SRI BELA NOFITA', '2008-11-29', 'Laki-laki', '2008-11-29', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 353, '2026-07-06 06:25:11', '2026-07-12 13:37:21', NULL),
(319, NULL, 'SYARIFA QUMAIRAH RAMADHANI', '2008-09-18', 'Laki-laki', '2008-09-18', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 354, '2026-07-06 06:25:11', '2026-07-12 13:37:21', NULL),
(320, NULL, 'TESALONIKA SHARON', '2008-05-05', 'Laki-laki', '2008-05-05', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 355, '2026-07-06 06:25:11', '2026-07-12 13:37:21', NULL),
(321, NULL, 'TRI APRILLIA MARDANI', '2009-04-15', 'Laki-laki', '2009-04-15', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 356, '2026-07-06 06:25:12', '2026-07-12 13:37:21', NULL),
(322, NULL, 'VITA RISTIANTI', '2008-12-26', 'Laki-laki', '2008-12-26', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 357, '2026-07-06 06:25:12', '2026-07-12 13:37:21', NULL),
(323, NULL, 'YULIANA WARISMA', '2009-11-04', 'Laki-laki', '2009-11-04', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 358, '2026-07-06 06:25:12', '2026-07-12 13:37:21', NULL),
(324, NULL, 'ZALFA\' AULIA NAJAH', '2008-06-18', 'Laki-laki', '2008-06-18', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 359, '2026-07-06 06:25:12', '2026-07-12 13:37:21', NULL),
(325, NULL, 'AIDINA FITRANI WULANDARI', '2008-10-27', 'Laki-laki', '2008-10-27', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 360, '2026-07-06 06:25:13', '2026-07-12 13:37:21', NULL),
(326, NULL, 'AKHDAN GANTARI ATMAJA', '2009-03-13', 'Laki-laki', '2009-03-13', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 361, '2026-07-06 06:25:13', '2026-07-12 13:37:21', NULL),
(327, NULL, 'ALINEA TITIAN', '2008-12-05', 'Laki-laki', '2008-12-05', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 362, '2026-07-06 06:25:13', '2026-07-12 13:37:21', NULL),
(328, NULL, 'AMIRA ZAHWA AZIZAH', '2009-07-06', 'Laki-laki', '2009-07-06', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 363, '2026-07-06 06:25:13', '2026-07-12 13:37:21', NULL),
(329, NULL, 'ANANDA PUTRI', '2009-03-15', 'Laki-laki', '2009-03-15', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 364, '2026-07-06 06:25:14', '2026-07-12 13:37:21', NULL),
(330, NULL, 'ARUM FEBRIANTI', '2009-02-14', 'Laki-laki', '2009-02-14', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 365, '2026-07-06 06:25:14', '2026-07-12 13:37:21', NULL),
(331, NULL, 'AYU MALINA FEBRIYA', '2009-02-13', 'Laki-laki', '2009-02-13', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 366, '2026-07-06 06:25:14', '2026-07-12 13:37:21', NULL),
(332, NULL, 'BAMBANG PRI HARTANTO', '2008-05-20', 'Laki-laki', '2008-05-20', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 367, '2026-07-06 06:25:14', '2026-07-12 13:37:21', NULL),
(333, NULL, 'EKA SITI AMINATUN', '2009-03-25', 'Laki-laki', '2009-03-25', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 368, '2026-07-06 06:25:15', '2026-07-12 13:37:21', NULL),
(334, NULL, 'ERIKA AULIA AMBARWATI', '2009-01-28', 'Laki-laki', '2009-01-28', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 369, '2026-07-06 06:25:15', '2026-07-12 13:37:21', NULL),
(335, NULL, 'Fajar Puryanti', '2008-09-12', 'Laki-laki', '2008-09-12', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 370, '2026-07-06 06:25:15', '2026-07-12 13:37:21', NULL),
(336, NULL, 'GIGIH BUDIYARTO', '2008-07-18', 'Laki-laki', '2008-07-18', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 371, '2026-07-06 06:25:15', '2026-07-12 13:37:21', NULL),
(337, NULL, 'HABIBAH ELFARIZQI', '2008-12-16', 'Laki-laki', '2008-12-16', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 372, '2026-07-06 06:25:16', '2026-07-12 13:37:21', NULL),
(338, NULL, 'HELNIDA RANNY TAKHEL', '2008-08-28', 'Laki-laki', '2008-08-28', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 373, '2026-07-06 06:25:16', '2026-07-12 13:37:21', NULL),
(339, NULL, 'IKA NOVIANI', '2008-11-07', 'Laki-laki', '2008-11-07', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 374, '2026-07-06 06:25:16', '2026-07-12 13:37:21', NULL),
(340, NULL, 'INTAN NURAINI', '2009-04-14', 'Laki-laki', '2009-04-14', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 375, '2026-07-06 06:25:16', '2026-07-12 13:37:21', NULL),
(341, NULL, 'Kholifah Alya Mufidah', '2008-12-18', 'Laki-laki', '2008-12-18', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 376, '2026-07-06 06:25:17', '2026-07-12 13:37:21', NULL),
(342, NULL, 'LINDA SURYANI', '2009-01-06', 'Laki-laki', '2009-01-06', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 377, '2026-07-06 06:25:17', '2026-07-12 13:37:21', NULL),
(343, NULL, 'MASAYU DIVA KHARISMA', '2009-01-11', 'Laki-laki', '2009-01-11', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 378, '2026-07-06 06:25:17', '2026-07-12 13:37:21', NULL),
(344, NULL, 'MAULIANA RAHMANING TYAS', '2008-03-13', 'Laki-laki', '2008-03-13', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 379, '2026-07-06 06:25:17', '2026-07-12 13:37:21', NULL),
(345, NULL, 'Melinda Nadine Saputri', '2008-05-02', 'Laki-laki', '2008-05-02', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 380, '2026-07-06 06:25:18', '2026-07-12 13:37:21', NULL),
(346, NULL, 'Menik Sugiyarti', '2008-11-29', 'Laki-laki', '2008-11-29', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 381, '2026-07-06 06:25:18', '2026-07-12 13:37:21', NULL),
(347, NULL, 'NADILA SYIFAURROHMAH', '2008-06-20', 'Laki-laki', '2008-06-20', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 382, '2026-07-06 06:25:18', '2026-07-12 13:37:21', NULL),
(348, NULL, 'NAURA YASMIN ZAAFARANI', '2009-07-29', 'Laki-laki', '2009-07-29', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 383, '2026-07-06 06:25:18', '2026-07-12 13:37:22', NULL),
(349, NULL, 'NUR ANGGA PRATAMA', '2008-06-02', 'Laki-laki', '2008-06-02', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 384, '2026-07-06 06:25:19', '2026-07-12 13:37:22', NULL),
(350, NULL, 'NUR RAMADHANA NABABAN', '2008-09-24', 'Laki-laki', '2008-09-24', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 385, '2026-07-06 06:25:19', '2026-07-12 13:37:22', NULL),
(351, NULL, 'NURUL EKA YULIANTI', '2008-07-02', 'Laki-laki', '2008-07-02', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 386, '2026-07-06 06:25:19', '2026-07-12 13:37:22', NULL),
(352, NULL, 'RAYA FITRIA OKTAFIANI', '2009-10-03', 'Laki-laki', '2009-10-03', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 387, '2026-07-06 06:25:19', '2026-07-12 13:37:22', NULL),
(353, NULL, 'REIVA STECY EKA LAURA', '2008-08-14', 'Laki-laki', '2008-08-14', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 388, '2026-07-06 06:25:20', '2026-07-12 13:37:22', NULL),
(354, NULL, 'SALSA AULIA PUTRI', '2008-11-09', 'Laki-laki', '2008-11-09', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 389, '2026-07-06 06:25:20', '2026-07-12 13:37:22', NULL),
(355, NULL, 'SRI WAHYU RAHMASARI', '2008-09-06', 'Laki-laki', '2008-09-06', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 390, '2026-07-06 06:25:20', '2026-07-12 13:37:22', NULL),
(356, NULL, 'SYAFALINA ANISA FEBRIYANTI', '2009-02-25', 'Laki-laki', '2009-02-25', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 391, '2026-07-06 06:25:20', '2026-07-12 13:37:22', NULL),
(357, NULL, 'VEGA UBIYANA', '2008-11-03', 'Laki-laki', '2008-11-03', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 392, '2026-07-06 06:25:20', '2026-07-12 13:37:22', NULL),
(358, NULL, 'YIN YANG KESHILA CHEUNG', '2009-08-14', 'Laki-laki', '2009-08-14', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 393, '2026-07-06 06:25:21', '2026-07-12 13:37:22', NULL),
(359, NULL, 'Zahra Fitri Septiana', '2009-09-20', 'Laki-laki', '2009-09-20', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 394, '2026-07-06 06:25:21', '2026-07-12 13:37:22', NULL),
(360, NULL, 'Adi Heri Pramono', '2008-01-17', 'Laki-laki', '2008-01-17', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 395, '2026-07-06 06:25:21', '2026-07-12 13:37:22', NULL),
(361, NULL, 'Akna Mumtaz Ilmi', '2008-09-09', 'Laki-laki', '2008-09-09', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 396, '2026-07-06 06:25:22', '2026-07-12 13:37:22', NULL),
(362, NULL, 'ANGGUN SAL SABILA', '2009-03-20', 'Laki-laki', '2009-03-20', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 397, '2026-07-06 06:25:22', '2026-07-12 13:37:22', NULL),
(363, NULL, 'ANUGRAH MAULINA RAHMAWATI', '2009-02-03', 'Laki-laki', '2009-02-03', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 398, '2026-07-06 06:25:22', '2026-07-12 13:37:22', NULL),
(364, NULL, 'Asri Arum Ningtyas', '2009-07-31', 'Laki-laki', '2009-07-31', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 399, '2026-07-06 06:25:22', '2026-07-12 13:37:22', NULL),
(365, NULL, 'AULIA DINDA PRAMASTYA', '2008-06-15', 'Laki-laki', '2008-06-15', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 400, '2026-07-06 06:25:22', '2026-07-12 13:37:22', NULL),
(366, NULL, 'AULITA TRI KUMANDA YAFI', '2009-10-30', 'Laki-laki', '2009-10-30', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 401, '2026-07-06 06:25:23', '2026-07-12 13:37:22', NULL),
(367, NULL, 'AYUDYA PRATIWI', '2009-08-21', 'Laki-laki', '2009-08-21', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 402, '2026-07-06 06:25:23', '2026-07-12 13:37:22', NULL),
(368, NULL, 'BAYU AJI PURNOMO', '2008-05-30', 'Laki-laki', '2008-05-30', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 403, '2026-07-06 06:25:23', '2026-07-12 13:37:22', NULL),
(369, NULL, 'DEA FATMAWATI', '2008-11-22', 'Laki-laki', '2008-11-22', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 404, '2026-07-06 06:25:23', '2026-07-12 13:37:22', NULL),
(370, NULL, 'DESI LUSIANA PURNAMASARI', '2009-07-05', 'Laki-laki', '2009-07-05', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 405, '2026-07-06 06:25:24', '2026-07-12 13:37:22', NULL),
(371, NULL, 'DHEA SAFIRA', '2009-03-12', 'Laki-laki', '2009-03-12', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 406, '2026-07-06 06:25:24', '2026-07-12 13:37:22', NULL),
(372, NULL, 'DIVA TRI ANDRIANI', '2009-02-15', 'Laki-laki', '2009-02-15', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 407, '2026-07-06 06:25:24', '2026-07-12 13:37:22', NULL),
(373, NULL, 'Eko Priyanto', '2008-07-06', 'Laki-laki', '2008-07-06', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 408, '2026-07-06 06:25:24', '2026-07-12 13:37:22', NULL),
(374, NULL, 'EVALDO FIAN AFRIZA', '2009-04-01', 'Laki-laki', '2009-04-01', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 409, '2026-07-06 06:25:25', '2026-07-12 13:37:22', NULL),
(375, NULL, 'FATIMAH NUR YULIANI', '2008-07-06', 'Laki-laki', '2008-07-06', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 410, '2026-07-06 06:25:25', '2026-07-12 13:37:22', NULL),
(376, NULL, 'HAFIDH ALBAR', '2008-05-11', 'Laki-laki', '2008-05-11', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 411, '2026-07-06 06:25:25', '2026-07-12 13:37:22', NULL),
(377, NULL, 'HANNA SALSABILA', '2009-06-21', 'Perempuan', '2009-06-21', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 412, '2026-07-06 06:25:25', '2026-07-12 13:37:22', NULL),
(378, NULL, 'Intan Putri Utami', '2009-04-26', 'Perempuan', '2009-04-26', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 413, '2026-07-06 06:25:26', '2026-07-12 13:37:22', NULL),
(379, NULL, 'LISTA SRI WAHYU LESTARI', '2008-12-31', 'Perempuan', '2008-12-31', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 414, '2026-07-06 06:25:26', '2026-07-12 13:37:22', NULL),
(380, NULL, 'MEISA NURAINI', '2008-05-01', 'Perempuan', '2008-05-01', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 415, '2026-07-06 06:25:26', '2026-07-12 13:37:22', NULL),
(381, NULL, 'MUHAMAD AGUNG PRATAMA', '2009-03-11', 'Perempuan', '2009-03-11', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 416, '2026-07-06 06:25:26', '2026-07-12 13:37:22', NULL),
(382, NULL, 'Muhamad Arifin', '2009-01-19', 'Perempuan', '2009-01-19', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 417, '2026-07-06 06:25:27', '2026-07-12 13:37:22', NULL),
(383, NULL, 'MUHAMAD DWI ARDIYANTO', '2008-07-16', 'Perempuan', '2008-07-16', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 418, '2026-07-06 06:25:27', '2026-07-12 13:37:22', NULL),
(384, NULL, 'MUHAMMAD RIZKI ADITIYA', '2009-11-03', 'Perempuan', '2009-11-03', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 419, '2026-07-06 06:25:27', '2026-07-12 13:37:22', NULL),
(385, NULL, 'MUHAMMAD TYO ARDIANSYAH', '2008-11-26', 'Perempuan', '2008-11-26', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 420, '2026-07-06 06:25:27', '2026-07-12 13:37:22', NULL),
(386, NULL, 'NADYA KHOIRUN NISWAN', '2009-03-13', 'Perempuan', '2009-03-13', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 421, '2026-07-06 06:25:28', '2026-07-12 13:37:22', NULL),
(387, NULL, 'NASWA AULIA PREHANTY', '2008-03-01', 'Perempuan', '2008-03-01', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 422, '2026-07-06 06:25:28', '2026-07-12 13:37:22', NULL),
(388, NULL, 'Natali Kris Diovani', '2009-12-20', 'Perempuan', '2009-12-20', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 423, '2026-07-06 06:25:28', '2026-07-12 13:37:22', NULL),
(389, NULL, 'Novia Maulinda', '2008-11-18', 'Perempuan', '2008-11-18', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 424, '2026-07-06 06:25:28', '2026-07-12 13:37:22', NULL),
(390, NULL, 'NOVIANA ROKHALI', '2008-11-28', 'Perempuan', '2008-11-28', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 425, '2026-07-06 06:25:29', '2026-07-12 13:37:22', NULL),
(391, NULL, 'Ridho Deni Kiswanto', '2007-07-14', 'Perempuan', '2007-07-14', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 426, '2026-07-06 06:25:29', '2026-07-12 13:37:22', NULL),
(392, NULL, 'RIZKY SETIADI', '2009-05-25', 'Perempuan', '2009-05-25', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 427, '2026-07-06 06:25:29', '2026-07-12 13:37:22', NULL),
(393, NULL, 'Salman Bajradaram', '2009-06-22', 'Perempuan', '2009-06-22', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 428, '2026-07-06 06:25:29', '2026-07-12 13:37:22', NULL),
(394, NULL, 'TRIYONO', '2008-07-07', 'Perempuan', '2008-07-07', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 429, '2026-07-06 06:25:30', '2026-07-12 13:37:22', NULL),
(395, NULL, 'Wongayu Jenar Mahesa', '2008-10-06', 'Perempuan', '2008-10-06', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 430, '2026-07-06 06:25:30', '2026-07-12 13:37:22', NULL),
(396, NULL, 'AGIP WIJANARKO', '2008-08-13', 'Perempuan', '2008-08-13', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 431, '2026-07-06 06:25:30', '2026-07-12 13:37:22', NULL),
(397, NULL, 'AGUS SRIYONO', '2007-06-25', 'Perempuan', '2007-06-25', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 432, '2026-07-06 06:25:30', '2026-07-12 13:37:22', NULL),
(398, NULL, 'Ahmad fauzan fathurroziq', '2008-03-16', 'Perempuan', '2008-03-16', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 433, '2026-07-06 06:25:31', '2026-07-12 13:37:22', NULL),
(399, NULL, 'ALI MUSTOFA', '2009-01-27', 'Perempuan', '2009-01-27', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 434, '2026-07-06 06:25:31', '2026-07-12 13:37:22', NULL),
(400, NULL, 'ALIEFAH ADJENG ARYA NINGSIH', '2009-01-12', 'Perempuan', '2009-01-12', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 435, '2026-07-06 06:25:31', '2026-07-12 13:37:22', NULL),
(401, NULL, 'ANIS PUJI LESTARI', '2008-02-23', 'Perempuan', '2008-02-23', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 436, '2026-07-06 06:25:32', '2026-07-12 13:37:22', NULL),
(402, NULL, 'ANITA NOVIYANTI', '2008-10-22', 'Perempuan', '2008-10-22', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 437, '2026-07-06 06:25:32', '2026-07-12 13:37:22', NULL),
(403, NULL, 'ARMADITA PRIHATINI', '2009-01-29', 'Perempuan', '2009-01-29', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 438, '2026-07-06 06:25:32', '2026-07-12 13:37:22', NULL),
(404, NULL, 'CALLISTA GISELA GITAFREYA', '2008-11-04', 'Perempuan', '2008-11-04', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 439, '2026-07-06 06:25:32', '2026-07-12 13:37:22', NULL),
(405, NULL, 'Dwi Lestari', '2009-04-02', 'Perempuan', '2009-04-02', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 440, '2026-07-06 06:25:33', '2026-07-12 13:37:22', NULL),
(406, NULL, 'FEBRIAN WAHYU PRATAMA', '2009-02-19', 'Perempuan', '2009-02-19', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 441, '2026-07-06 06:25:33', '2026-07-12 13:37:22', NULL),
(407, NULL, 'FELYSA EKA HIDAYANTI', '2008-08-31', 'Perempuan', '2008-08-31', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 442, '2026-07-06 06:25:33', '2026-07-12 13:37:22', NULL),
(408, NULL, 'HAFID RIZAL DANENDRA', '2009-03-19', 'Perempuan', '2009-03-19', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 443, '2026-07-06 06:25:33', '2026-07-12 13:37:22', NULL),
(409, NULL, 'HANUNG DEWI NOVIANI', '2009-11-10', 'Perempuan', '2009-11-10', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 444, '2026-07-06 06:25:34', '2026-07-12 13:37:22', NULL),
(410, NULL, 'Khanza Dwi Khoirun Nisa', '2009-05-05', 'Perempuan', '2009-05-05', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 445, '2026-07-06 06:25:34', '2026-07-12 13:37:22', NULL),
(411, NULL, 'KRISBIYANTO', '2007-04-18', 'Perempuan', '2007-04-18', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 446, '2026-07-06 06:25:34', '2026-07-12 13:37:22', NULL),
(412, NULL, 'KURNIAWAN DEWA PAMBUDI', '2008-07-20', 'Perempuan', '2008-07-20', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 447, '2026-07-06 06:25:34', '2026-07-12 13:37:22', NULL),
(413, NULL, 'MUHAMMAD ANWAR', '2009-02-21', 'Perempuan', '2009-02-21', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 448, '2026-07-06 06:25:35', '2026-07-12 13:37:22', NULL),
(414, NULL, 'MUTIARA', '2008-08-08', 'Perempuan', '2008-08-08', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 449, '2026-07-06 06:25:35', '2026-07-12 13:37:22', NULL),
(415, NULL, 'NAYLA ADIAS PRATIWI', '2008-03-08', 'Perempuan', '2008-03-08', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 450, '2026-07-06 06:25:35', '2026-07-12 13:37:22', NULL),
(416, NULL, 'Ni Wayan Febriyan', '2009-01-31', 'Perempuan', '2009-01-31', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 451, '2026-07-06 06:25:35', '2026-07-12 13:37:22', NULL),
(417, NULL, 'PUJI RAHAYU', '2008-10-17', 'Perempuan', '2008-10-17', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 452, '2026-07-06 06:25:36', '2026-07-12 13:37:22', NULL),
(418, NULL, 'RAIHAN DAMAR PANULUH', '2009-02-09', 'Perempuan', '2009-02-09', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 453, '2026-07-06 06:25:36', '2026-07-12 13:37:22', NULL),
(419, NULL, 'RIFKY DWI HANDIKA', '2008-08-25', 'Perempuan', '2008-08-25', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 454, '2026-07-06 06:25:36', '2026-07-12 13:37:22', NULL),
(420, NULL, 'RIFQI AKBAR PRADITA', '2009-04-27', 'Perempuan', '2009-04-27', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 455, '2026-07-06 06:25:36', '2026-07-12 13:37:22', NULL),
(421, NULL, 'SAHDA ARISTA ROFILAH', '2009-04-20', 'Perempuan', '2009-04-20', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 456, '2026-07-06 06:25:37', '2026-07-12 13:37:22', NULL),
(422, NULL, 'Septya Ramadhani', '2009-09-25', 'Perempuan', '2009-09-25', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 457, '2026-07-06 06:25:37', '2026-07-12 13:37:22', NULL),
(423, NULL, 'SITI NUR WASI\'ATUL BADRIAH', '2008-12-10', 'Perempuan', '2008-12-10', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 458, '2026-07-06 06:25:37', '2026-07-12 13:37:22', NULL),
(424, NULL, 'TAUFIK HIDAYAT', '2009-05-10', 'Perempuan', '2009-05-10', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 459, '2026-07-06 06:25:37', '2026-07-12 13:37:22', NULL),
(425, NULL, 'Vicky Putra Ramadan', '2008-09-12', 'Perempuan', '2008-09-12', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 460, '2026-07-06 06:25:38', '2026-07-12 13:37:22', NULL),
(426, NULL, 'VIKY FAHRURODIN OKTARA', '2009-10-16', 'Perempuan', '2009-10-16', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 461, '2026-07-06 06:25:38', '2026-07-12 13:37:22', NULL),
(427, NULL, 'WAHYU BAYUTRI SETIANA', '2006-12-03', 'Perempuan', '2006-12-03', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 462, '2026-07-06 06:25:38', '2026-07-12 13:37:22', NULL),
(428, NULL, 'YULIANA PUTRI LISTIYONO', '2007-06-07', 'Perempuan', '2007-06-07', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 463, '2026-07-06 06:25:38', '2026-07-12 13:37:22', NULL),
(429, NULL, 'AAN KURNIAWAN', '2008-08-07', 'Perempuan', '2008-08-07', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 464, '2026-07-06 06:25:39', '2026-07-12 13:37:22', NULL),
(430, NULL, 'AFIFA MERLIN PRAMESTI AYU ASTUTI', '2009-03-10', 'Perempuan', '2009-03-10', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 465, '2026-07-06 06:25:39', '2026-07-12 13:37:22', NULL),
(431, NULL, 'Alenta Rahmawati', '2009-01-16', 'Perempuan', '2009-01-16', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 466, '2026-07-06 06:25:39', '2026-07-12 13:37:22', NULL),
(432, NULL, 'ALIF SAPUTRA', '2009-01-18', 'Perempuan', '2009-01-18', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 467, '2026-07-06 06:25:39', '2026-07-12 13:37:22', NULL),
(433, NULL, 'APRILIA UMAEROH', '2009-04-18', 'Perempuan', '2009-04-18', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 468, '2026-07-06 06:25:40', '2026-07-12 13:37:22', NULL),
(434, NULL, 'APRILIA WULANDARI', '2008-04-16', 'Perempuan', '2008-04-16', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 469, '2026-07-06 06:25:40', '2026-07-12 13:37:22', NULL),
(435, NULL, 'ARDAN RAFIANTO', '2009-02-26', 'Perempuan', '2009-02-26', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 470, '2026-07-06 06:25:40', '2026-07-12 13:37:22', NULL),
(436, NULL, 'ARVIN RAHMADDANI', '2008-10-02', 'Perempuan', '2008-10-02', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 471, '2026-07-06 06:25:40', '2026-07-12 13:37:22', NULL),
(437, NULL, 'BELLA AYU WULANDARI', '2009-08-12', 'Perempuan', '2009-08-12', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 472, '2026-07-06 06:25:41', '2026-07-12 13:37:22', NULL),
(438, NULL, 'CARISSA PUTRI', '2008-06-12', 'Perempuan', '2008-06-12', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 473, '2026-07-06 06:25:41', '2026-07-12 13:37:22', NULL),
(439, NULL, 'DIMAS SETIAWAN', '2008-12-10', 'Perempuan', '2008-12-10', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 474, '2026-07-06 06:25:41', '2026-07-12 13:37:22', NULL),
(440, NULL, 'ENY WAHYUNINGSIH', '2009-01-19', 'Perempuan', '2009-01-19', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 475, '2026-07-06 06:25:41', '2026-07-12 13:37:22', NULL),
(441, NULL, 'ERIXDA AGUNG KUNCORO', '2009-06-06', 'Perempuan', '2009-06-06', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 476, '2026-07-06 06:25:42', '2026-07-12 13:37:22', NULL),
(442, NULL, 'ERVANDY ALIF FEBRIAN', '2008-02-25', 'Perempuan', '2008-02-25', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 477, '2026-07-06 06:25:42', '2026-07-12 13:37:22', NULL),
(443, NULL, 'EVA YULIANTY', '2008-12-11', 'Perempuan', '2008-12-11', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 478, '2026-07-06 06:25:42', '2026-07-12 13:37:22', NULL),
(444, NULL, 'FAJAR NUR HIDAYAT', '2008-11-18', 'Perempuan', '2008-11-18', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 479, '2026-07-06 06:25:42', '2026-07-12 13:37:22', NULL),
(445, NULL, 'FATIMAH AZZAHRA', '2009-12-03', 'Perempuan', '2009-12-03', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 480, '2026-07-06 06:25:43', '2026-07-12 13:37:22', NULL),
(446, NULL, 'Intan Damayanti', '2008-12-28', 'Perempuan', '2008-12-28', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 481, '2026-07-06 06:25:43', '2026-07-12 13:37:22', NULL),
(447, NULL, 'LAILI MAFTUKHAH', '2009-03-04', 'Perempuan', '2009-03-04', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 482, '2026-07-06 06:25:43', '2026-07-12 13:37:22', NULL),
(448, NULL, 'MA\'RIFATU SYIFA KAMIL FARHANI', '2009-02-08', 'Perempuan', '2009-02-08', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 483, '2026-07-06 06:25:43', '2026-07-12 13:37:22', NULL),
(449, NULL, 'MUHAMAD FEBRY VALIANSAH', '2009-02-02', 'Perempuan', '2009-02-02', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 484, '2026-07-06 06:25:44', '2026-07-12 13:37:22', NULL),
(450, NULL, 'MUHAMAD TAUFIK KURNIAWAN', '2009-06-14', 'Perempuan', '2009-06-14', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 485, '2026-07-06 06:25:44', '2026-07-12 13:37:22', NULL),
(451, NULL, 'MUHAMMAD FAHRI AFIANTO', '2009-07-03', 'Perempuan', '2009-07-03', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 486, '2026-07-06 06:25:44', '2026-07-12 13:37:22', NULL),
(452, NULL, 'MUHAMMAD RIZQI KAKA PRADANA', '2009-06-07', 'Perempuan', '2009-06-07', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 487, '2026-07-06 06:25:44', '2026-07-12 13:37:23', NULL),
(453, NULL, 'Naysila Annisa Zaskia', '2009-04-30', 'Perempuan', '2009-04-30', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 488, '2026-07-06 06:25:44', '2026-07-12 13:37:23', NULL),
(454, NULL, 'NURUDIN RIZKI SAPUTRO', '2008-10-26', 'Perempuan', '2008-10-26', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 489, '2026-07-06 06:25:45', '2026-07-12 13:37:23', NULL),
(455, NULL, 'RAIHAN SUSILO BUDIANTO', '2009-07-08', 'Perempuan', '2009-07-08', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 490, '2026-07-06 06:25:45', '2026-07-12 13:37:23', NULL),
(456, NULL, 'RASYA NUR HIDAYAT', '2008-03-21', 'Perempuan', '2008-03-21', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 491, '2026-07-06 06:25:45', '2026-07-12 13:37:23', NULL),
(457, NULL, 'RENDI SETIAWAN', '2007-11-27', 'Perempuan', '2007-11-27', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 492, '2026-07-06 06:25:45', '2026-07-12 13:37:23', NULL),
(458, NULL, 'SATRIA BAYU AJI', '2009-07-27', 'Perempuan', '2009-07-27', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 493, '2026-07-06 06:25:46', '2026-07-12 13:37:23', NULL),
(459, NULL, 'SRI WAHYU RAHMAYANI', '2008-09-06', 'Perempuan', '2008-09-06', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 494, '2026-07-06 06:25:46', '2026-07-12 13:37:23', NULL),
(460, NULL, 'TRI HARTANTO', '2008-10-17', 'Perempuan', '2008-10-17', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 495, '2026-07-06 06:25:46', '2026-07-12 13:37:23', NULL),
(461, NULL, 'WAHYU NUGROHO', '2009-03-29', 'Perempuan', '2009-03-29', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 496, '2026-07-06 06:25:46', '2026-07-12 13:37:23', NULL),
(462, NULL, 'WIDYA FELISIANO PUTRI', '2009-08-27', 'Perempuan', '2009-08-27', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 497, '2026-07-06 06:25:47', '2026-07-12 13:37:23', NULL),
(463, NULL, 'WIWID SARENAWATI', '2008-12-29', 'Perempuan', '2008-12-29', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 498, '2026-07-06 06:25:47', '2026-07-12 13:37:23', NULL),
(464, NULL, 'YOGO SAPUTRA', '2007-08-09', 'Perempuan', '2007-08-09', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 499, '2026-07-06 06:25:47', '2026-07-12 13:37:23', NULL),
(465, NULL, 'ALPIANA RAHMAWATI', '2009-02-13', 'Perempuan', '2009-02-13', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 500, '2026-07-06 06:25:47', '2026-07-12 13:37:23', NULL),
(466, NULL, 'ALWIS ALQURNIAWAN', '2008-05-16', 'Perempuan', '2008-05-16', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 501, '2026-07-06 06:25:48', '2026-07-12 13:37:23', NULL),
(467, NULL, 'Arief Nur Haryanto', '2008-03-21', 'Perempuan', '2008-03-21', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 502, '2026-07-06 06:25:48', '2026-07-12 13:37:23', NULL),
(468, NULL, 'AYU ANDINI', '2008-05-31', 'Perempuan', '2008-05-31', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 503, '2026-07-06 06:25:48', '2026-07-12 13:37:23', NULL),
(469, NULL, 'BAGUS PRABOWO', '2009-05-04', 'Perempuan', '2009-05-04', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 504, '2026-07-06 06:25:49', '2026-07-12 13:37:23', NULL),
(470, NULL, 'BIMA BASTIAN MULYA', '2008-10-22', 'Perempuan', '2008-10-22', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 505, '2026-07-06 06:25:49', '2026-07-12 13:37:23', NULL),
(471, NULL, 'DEVIANA ANDRIYANTI', '2009-12-20', 'Perempuan', '2009-12-20', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 506, '2026-07-06 06:25:49', '2026-07-12 13:37:23', NULL),
(472, NULL, 'ELXA WAHYU YULIANTO', '2007-07-23', 'Perempuan', '2007-07-23', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 507, '2026-07-06 06:25:49', '2026-07-12 13:37:23', NULL),
(473, NULL, 'FAIZ SARIFUDIN', '2009-01-13', 'Perempuan', '2009-01-13', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 508, '2026-07-06 06:25:50', '2026-07-12 13:37:23', NULL),
(474, NULL, 'FALIHA ALBIT', '2009-07-10', 'Perempuan', '2009-07-10', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 509, '2026-07-06 06:25:50', '2026-07-12 13:37:23', NULL),
(475, NULL, 'FARA DECHA ABABILQIS', '2009-08-16', 'Perempuan', '2009-08-16', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 510, '2026-07-06 06:25:50', '2026-07-12 13:37:23', NULL),
(476, NULL, 'HANUNG GIBRAN ALANSAH', '2009-03-30', 'Perempuan', '2009-03-30', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 511, '2026-07-06 06:25:50', '2026-07-12 13:37:23', NULL),
(477, NULL, 'KAILA NURUL AISHA', '2008-06-25', 'Perempuan', '2008-06-25', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 512, '2026-07-06 06:25:51', '2026-07-12 13:37:23', NULL),
(478, NULL, 'MUHAMAD RIZAL PURNAMA PUTRA', '2009-05-02', 'Perempuan', '2009-05-02', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 513, '2026-07-06 06:25:51', '2026-07-12 13:37:23', NULL),
(479, NULL, 'MUHAMMAD RIZKI FAUZI', '2009-01-28', 'Perempuan', '2009-01-28', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 514, '2026-07-06 06:25:51', '2026-07-12 13:37:23', NULL),
(480, NULL, 'Muhammat Ibnu Tamar Ibrahim', '2008-07-18', 'Perempuan', '2008-07-18', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 515, '2026-07-06 06:25:51', '2026-07-12 13:37:23', NULL),
(481, NULL, 'Nadin Aprilia Putri', '2008-04-01', 'Perempuan', '2008-04-01', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 516, '2026-07-06 06:25:52', '2026-07-12 13:37:23', NULL),
(482, NULL, 'NINDA ALTHAFUNNISA', '2009-06-01', 'Perempuan', '2009-06-01', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 517, '2026-07-06 06:25:52', '2026-07-12 13:37:23', NULL),
(483, NULL, 'NOVA WIYANTO', '2008-09-21', 'Perempuan', '2008-09-21', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 518, '2026-07-06 06:25:52', '2026-07-12 13:37:23', NULL),
(484, NULL, 'NOVI MAULANI ADITYA', '2009-03-10', 'Perempuan', '2009-03-10', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 519, '2026-07-06 06:25:52', '2026-07-12 13:37:23', NULL),
(485, NULL, 'NUR ANISA', '2009-04-24', 'Perempuan', '2009-04-24', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 520, '2026-07-06 06:25:53', '2026-07-12 13:37:23', NULL),
(486, NULL, 'NUR ROHIMAH', '2008-11-29', 'Perempuan', '2008-11-29', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 521, '2026-07-06 06:25:53', '2026-07-12 13:37:23', NULL),
(487, NULL, 'PRASETYO DWI SAPUTRO', '2008-06-12', 'Perempuan', '2008-06-12', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 522, '2026-07-06 06:25:53', '2026-07-12 13:37:23', NULL),
(488, NULL, 'RAISA ISNAN SAPUTRA', '2009-04-20', 'Perempuan', '2009-04-20', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 523, '2026-07-06 06:25:53', '2026-07-12 13:37:23', NULL),
(489, NULL, 'Rasyid Amir Zaki', '2009-05-18', 'Perempuan', '2009-05-18', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 524, '2026-07-06 06:25:54', '2026-07-12 13:37:23', NULL),
(490, NULL, 'RESTU PURBANINGRAT', '2008-06-05', 'Perempuan', '2008-06-05', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 525, '2026-07-06 06:25:54', '2026-07-12 13:37:23', NULL),
(491, NULL, 'RIZAL MATHOFANI ADI NUGRAHA', '2008-02-29', 'Perempuan', '2008-02-29', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 526, '2026-07-06 06:25:54', '2026-07-12 13:37:23', NULL),
(492, NULL, 'SAIFUL UDIN', '2009-04-13', 'Perempuan', '2009-04-13', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 527, '2026-07-06 06:25:54', '2026-07-12 13:37:23', NULL),
(493, NULL, 'Septia Ramadhani', '2008-09-19', 'Perempuan', '2008-09-19', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 528, '2026-07-06 06:25:55', '2026-07-12 13:37:23', NULL),
(494, NULL, 'SHOLEH SETYAWAN', '2009-05-01', 'Perempuan', '2009-05-01', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 529, '2026-07-06 06:25:55', '2026-07-12 13:37:23', NULL),
(495, NULL, 'SOWAN APRILIA', '2009-04-28', 'Perempuan', '2009-04-28', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 530, '2026-07-06 06:25:55', '2026-07-12 13:37:23', NULL),
(496, NULL, 'THORIQ LUTFI ZAILANI', '2009-07-15', 'Perempuan', '2009-07-15', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 531, '2026-07-06 06:25:55', '2026-07-12 13:37:23', NULL),
(497, NULL, 'Vika Damayanti', '2008-06-05', 'Perempuan', '2008-06-05', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 532, '2026-07-06 06:25:56', '2026-07-12 13:37:23', NULL),
(498, NULL, 'WAHYU PURWANTO', '2009-02-02', 'Perempuan', '2009-02-02', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 533, '2026-07-06 06:25:56', '2026-07-12 13:37:23', NULL),
(499, NULL, 'YOGI MUHAMAD FAIZAL', '2008-08-11', 'Perempuan', '2008-08-11', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 534, '2026-07-06 06:25:56', '2026-07-12 13:37:23', NULL),
(500, NULL, 'ZAFRAN AL FARIZI', '2009-05-10', 'Perempuan', '2009-05-10', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 535, '2026-07-06 06:25:56', '2026-07-12 13:37:23', NULL),
(1102, '12345679', 'tes dum', NULL, 'Laki-laki', '2011-05-03', NULL, 'X', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, NULL, '2026-07-14 22:49:37', '2026-07-14 22:56:00', '2026-07-14 22:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` enum('essay','multiple_choice') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'essay',
  `deadline` datetime NOT NULL,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `guru_id` bigint UNSIGNED DEFAULT NULL,
  `prasyarat_materi_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('aktif','nonaktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `max_score` int NOT NULL DEFAULT '100',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `mata_pelajaran_id`, `kelas_id`, `judul`, `deskripsi`, `type`, `deadline`, `lampiran`, `answer_key`, `guru_id`, `prasyarat_materi_id`, `status`, `max_score`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 11, 37, 'Tugas 1: Berpikir Komputasional - Logika Sistem Perpustakaan Digital', 'Kalian diminta merancang logika dasar Sistem Peminjaman Buku Perpustakaan Digital sebelum masuk ke tahap pemrograman. Terapkan 4 pilar berpikir komputasional dalam laporan kalian:\r\n\r\n1. Dekomposisi: Uraikan sistem menjadi minimal 3 modul/fitur utama dan jelaskan fungsinya.\r\n2. Pengenalan Pola: Identifikasi minimal 2 pola data atau proses yang akan berulang dalam sistem (misal: pengurangan stok saat dipinjam).\r\n3. Abstraksi: Tentukan data esensial yang harus disimpan dalam database untuk fitur peminjaman, dan data yang tidak perlu.\r\n4. Berpikir Algoritme: Buat satu buah Flowchart atau Pseudocode yang menggambarkan langkah-langkah dari saat siswa login hingga berhasil meminjam buku (harus memuat percabangan kondisi ketersediaan buku).\r\n\r\nKetentuan:\r\n- Dikerjakan secara individu/kelompok (maksimal 3 orang).\r\n- Kumpulkan dalam format PDF.', 'essay', '2026-07-28 10:42:00', 'tugas/fSroFy3Ws82lS8LmYEVg8UtgR5i3Xrqyre7FawP4.docx', NULL, 13, NULL, 'aktif', 100, '2026-07-28 03:43:49', '2026-07-28 04:07:36', NULL),
(2, 11, 37, 'Tugas 2: Berpikir Komputasional - Logika Sistem Kehadiran Karyawan', 'Kalian diminta merancang logika dasar Sistem Kehadiran dan Penghitungan Lembur Karyawan. Terapkan 4 pilar berpikir komputasional dalam laporan rancangan kalian:\r\n\r\n1. Dekomposisi: Uraikan sistem kehadiran ini menjadi minimal 3 fitur utama (misalnya: Pencatatan Kehadiran, Pengajuan Cuti, Penghitungan Lembur) dan jelaskan fungsinya secara ringkas.\r\n2. Pengenalan Pola: Identifikasi minimal 2 pola aturan yang berulang (misalnya: setiap kelebihan jam kerja harian di atas 8 jam akan otomatis dihitung sebagai waktu lembur).\r\n3. Abstraksi: Tentukan data inti yang wajib disimpan dalam basis data untuk fitur pencatatan kehadiran, dan data pendukung yang tidak relevan.\r\n4. Berpikir Algoritme: Buat satu buah bagan alir (diagram alir) atau sandi semu yang menggambarkan langkah-langkah dari saat karyawan memindai kartu identitas hingga sistem mencatat status kehadiran (tepat waktu atau terlambat).\r\n\r\nKetentuan:\r\n- Dikerjakan secara individu atau kelompok (maksimal 3 orang).\r\n- Kumpulkan dalam format dokumen elektronik (PDF).', 'essay', '2026-07-28 10:57:00', 'tugas/3csOSjdI7bexnLoPbeppYodmdxCa9bvhfmBtwRnV.docx', NULL, 13, NULL, 'aktif', 100, '2026-07-28 03:58:10', '2026-07-28 04:07:19', NULL),
(3, 11, 37, 'TES', 'TES', 'essay', '2026-07-28 11:06:00', NULL, NULL, 13, NULL, 'aktif', 100, '2026-07-28 04:06:52', '2026-07-28 04:07:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_subject_id_student_id_date_unique` (`subject_id`,`student_id`,`date`),
  ADD KEY `attendances_student_id_foreign` (`student_id`),
  ADD KEY `attendances_marked_by_foreign` (`marked_by`);

--
-- Indexes for table `attendance_sessions`
--
ALTER TABLE `attendance_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendance_sessions_qr_token_unique` (`qr_token`),
  ADD KEY `attendance_sessions_subject_id_foreign` (`subject_id`),
  ADD KEY `attendance_sessions_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grades_submission_id_foreign` (`submission_id`),
  ADD KEY `grades_subject_id_foreign` (`subject_id`),
  ADD KEY `grades_student_id_foreign` (`student_id`),
  ADD KEY `grades_graded_by_foreign` (`graded_by`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_email_unique` (`email`),
  ADD UNIQUE KEY `guru_nip_unique` (`nip`),
  ADD KEY `guru_pengguna_id_foreign` (`pengguna_id`),
  ADD KEY `guru_specialization_id_foreign` (`specialization_id`);

--
-- Indexes for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_kelas_guru_id_foreign` (`guru_id`),
  ADD KEY `guru_kelas_kelas_id_foreign` (`kelas_id`),
  ADD KEY `guru_kelas_mata_pelajaran_id_foreign` (`mata_pelajaran_id`);

--
-- Indexes for table `guru_mata_pelajaran`
--
ALTER TABLE `guru_mata_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_mata_pelajaran_guru_id_mata_pelajaran_id_unique` (`guru_id`,`mata_pelajaran_id`),
  ADD KEY `guru_mata_pelajaran_mata_pelajaran_id_foreign` (`mata_pelajaran_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_student_id_foreign` (`student_id`),
  ADD KEY `invoices_batch_id_index` (`batch_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_homeroom_teacher_id_foreign` (`homeroom_teacher_id`);

--
-- Indexes for table `master_kelas`
--
ALTER TABLE `master_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mata_pelajaran_kode_unique` (`kode`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materials_subject_id_foreign` (`subject_id`),
  ADD KEY `materials_uploaded_by_foreign` (`uploaded_by`),
  ADD KEY `materials_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi_siswa`
--
ALTER TABLE `mutasi_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mutasi_siswa_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `password_change_histories`
--
ALTER TABLE `password_change_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_change_histories_pengguna_id_foreign` (`pengguna_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_payment_number_unique` (`payment_number`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `pelacakan_materi`
--
ALTER TABLE `pelacakan_materi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelacakan_materi_siswa_id_materi_id_unique` (`siswa_id`,`materi_id`),
  ADD KEY `pelacakan_materi_materi_id_foreign` (`materi_id`);

--
-- Indexes for table `pemulihan_akses`
--
ALTER TABLE `pemulihan_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemulihan_akses_siswa_id_foreign` (`siswa_id`),
  ADD KEY `pemulihan_akses_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `pemulihan_akses_tugas_id_foreign` (`tugas_id`);

--
-- Indexes for table `pengajuan_banding`
--
ALTER TABLE `pengajuan_banding`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_banding_siswa_id_foreign` (`siswa_id`),
  ADD KEY `pengajuan_banding_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `pengajuan_banding_disetujui_oleh_foreign` (`disetujui_oleh`),
  ADD KEY `pengajuan_banding_tugas_id_foreign` (`tugas_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengguna_email_unique` (`email`);

--
-- Indexes for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengumpulan_tugas_tugas_id_siswa_id_unique` (`tugas_id`,`siswa_id`),
  ADD KEY `pengumpulan_tugas_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `riwayat_kelas_siswa`
--
ALTER TABLE `riwayat_kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_kelas_siswa_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nis_unique` (`nis`),
  ADD KEY `siswa_pengguna_id_foreign` (`pengguna_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `tugas_guru_id_foreign` (`guru_id`),
  ADD KEY `tugas_prasyarat_materi_id_foreign` (`prasyarat_materi_id`),
  ADD KEY `tugas_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_sessions`
--
ALTER TABLE `attendance_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5791;

--
-- AUTO_INCREMENT for table `guru_mata_pelajaran`
--
ALTER TABLE `guru_mata_pelajaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `master_kelas`
--
ALTER TABLE `master_kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `mutasi_siswa`
--
ALTER TABLE `mutasi_siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_change_histories`
--
ALTER TABLE `password_change_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelacakan_materi`
--
ALTER TABLE `pelacakan_materi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemulihan_akses`
--
ALTER TABLE `pemulihan_akses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajuan_banding`
--
ALTER TABLE `pengajuan_banding`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1147;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_kelas_siswa`
--
ALTER TABLE `riwayat_kelas_siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1535;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1103;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_marked_by_foreign` FOREIGN KEY (`marked_by`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_sessions`
--
ALTER TABLE `attendance_sessions`
  ADD CONSTRAINT `attendance_sessions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_sessions_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_graded_by_foreign` FOREIGN KEY (`graded_by`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `pengumpulan_tugas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `guru_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD CONSTRAINT `guru_kelas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_kelas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_kelas_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guru_mata_pelajaran`
--
ALTER TABLE `guru_mata_pelajaran`
  ADD CONSTRAINT `guru_mata_pelajaran_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_mata_pelajaran_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_homeroom_teacher_id_foreign` FOREIGN KEY (`homeroom_teacher_id`) REFERENCES `guru` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materials_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materials_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `guru` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mutasi_siswa`
--
ALTER TABLE `mutasi_siswa`
  ADD CONSTRAINT `mutasi_siswa_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `password_change_histories`
--
ALTER TABLE `password_change_histories`
  ADD CONSTRAINT `password_change_histories_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pelacakan_materi`
--
ALTER TABLE `pelacakan_materi`
  ADD CONSTRAINT `pelacakan_materi_materi_id_foreign` FOREIGN KEY (`materi_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pelacakan_materi_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemulihan_akses`
--
ALTER TABLE `pemulihan_akses`
  ADD CONSTRAINT `pemulihan_akses_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemulihan_akses_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemulihan_akses_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pengajuan_banding`
--
ALTER TABLE `pengajuan_banding`
  ADD CONSTRAINT `pengajuan_banding_disetujui_oleh_foreign` FOREIGN KEY (`disetujui_oleh`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengajuan_banding_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuan_banding_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuan_banding_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD CONSTRAINT `pengumpulan_tugas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengumpulan_tugas_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat_kelas_siswa`
--
ALTER TABLE `riwayat_kelas_siswa`
  ADD CONSTRAINT `riwayat_kelas_siswa_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tugas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tugas_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tugas_prasyarat_materi_id_foreign` FOREIGN KEY (`prasyarat_materi_id`) REFERENCES `materials` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
