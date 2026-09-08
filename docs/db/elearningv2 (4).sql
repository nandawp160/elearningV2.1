-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 08, 2026 at 01:47 AM
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
(19, 1, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2025/2026. Terplot: 258 pemetaan.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 02:09:29', '2026-07-22 02:09:29'),
(20, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 02:19:50', '2026-07-22 02:19:50'),
(21, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2025/2026. Terplot: 272 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:27:53', '2026-07-22 02:27:53'),
(22, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2025/2026. Terplot: 291 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:29:58', '2026-07-22 02:29:58'),
(23, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2025/2026. Terplot: 291 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:48:13', '2026-07-22 02:48:13'),
(24, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2025/2026. Terplot: 324 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:48:30', '2026-07-22 02:48:30'),
(25, 1, 'DELETION', 'Menghapus data kelas: XII F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 02:53:35', '2026-07-22 02:53:35'),
(26, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2025/2026. Terplot: 315 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:55:21', '2026-07-22 02:55:21'),
(27, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke 20 kelas (Kurikulum Merdeka) untuk Tahun Ajaran 2025/2026. Terplot: 328 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 02:55:52', '2026-07-22 02:55:52'),
(28, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke 20 kelas dengan pengikatan Rumpun (Kurikulum Merdeka) untuk Tahun Ajaran 2025/2026. Terplot: 266 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:29:42', '2026-07-22 03:29:42'),
(29, NULL, 'TEACHER', 'Melakukan plotting guru otomatis ke 20 kelas dengan pengikatan Rumpun Kurikulum Merdeka persis untuk Tahun Ajaran 2025/2026. Terplot: 263 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:39:42', '2026-07-22 03:39:42'),
(30, NULL, 'TEACHER', 'Melakukan plotting guru otomatis 100% Sempurna ke 20 kelas untuk Tahun Ajaran 2025/2026. Terplot: 265 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:47:50', '2026-07-22 03:47:50'),
(31, NULL, 'TEACHER', 'Melakukan plotting guru otomatis 100% Sempurna ke 20 kelas untuk Tahun Ajaran 2025/2026. Terplot: 265 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:51:59', '2026-07-22 03:51:59'),
(32, NULL, 'TEACHER', 'Melakukan plotting guru otomatis 100% Sempurna ke 20 kelas untuk Tahun Ajaran 2025/2026. Terplot: 265 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:57:25', '2026-07-22 03:57:25'),
(33, NULL, 'TEACHER', 'Melakukan plotting guru otomatis 100% Sempurna ke 20 kelas untuk Tahun Ajaran 2025/2026. Terplot: 265 pemetaan.', '127.0.0.1', 'Symfony', '2026-07-22 03:59:58', '2026-07-22 03:59:58'),
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
(74, 1, 'CLASS', 'Me-generate 22 rombel dari Master Kelas untuk Tahun Ajaran 2025/2026', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-15 11:52:56', '2026-08-15 11:52:56'),
(75, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 32 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-15 12:47:35', '2026-08-15 12:47:35'),
(76, NULL, 'STUDENT', 'Mengembalikan kelas 32 siswa ke X 1 (pembatalan test penjurusan).', '127.0.0.1', 'Symfony', '2026-08-15 12:49:26', '2026-08-15 12:49:26'),
(77, NULL, 'SETTINGS', 'Menghapus data Tahun Ajaran 2025/2026 untuk persiapan simulasi demo mandiri', '127.0.0.1', 'Symfony', '2026-08-16 11:26:52', '2026-08-16 11:26:52'),
(78, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 11:48:25', '2026-08-16 11:48:25'),
(79, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 12:25:26', '2026-08-16 12:25:26'),
(80, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 13:04:43', '2026-08-16 13:04:43'),
(81, 1, 'CLASS', 'Me-generate 22 rombel (Basis: T.A. 2025/2026) untuk Tahun Ajaran 2025/2026', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 13:16:04', '2026-08-16 13:16:04'),
(82, 1, 'STUDENT', 'Melakukan kenaikan kelas massal untuk 248 siswa. Detail: XI F 1 -> XII F 1 (36 siswa), XI F 2.1 -> XII F 2.1 (36 siswa), XI F 2.2 -> XII F 2.2 (35 siswa), XI F 3.1 -> XII F 3.1 (36 siswa), XI F 3.2 -> XII F 3.2 (33 siswa), XI F 4.1 -> XII F 4.1 (36 siswa), XI F 4.2 -> XII F 4.2 (36 siswa)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(83, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 14:32:27', '2026-08-16 14:32:27'),
(84, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 14:39:29', '2026-08-16 14:39:29'),
(85, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 14:40:12', '2026-08-16 14:40:12'),
(86, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 1 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 14:43:25', '2026-08-16 14:43:25'),
(87, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 14:48:54', '2026-08-16 14:48:54'),
(88, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(89, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(90, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(91, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(92, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(93, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(94, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(95, NULL, 'STUDENT', 'Membuat 288 data siswa baru Kelas X (X 1 s/d X 8) untuk Tahun Ajaran 2025/2026.', '127.0.0.1', 'Symfony', '2026-08-16 15:32:13', '2026-08-16 15:32:13'),
(96, NULL, 'STUDENT', 'Menetapkan nomor induk siswa (NIS) standar untuk seluruh 788 siswa Kelas X, XI, dan XII.', '127.0.0.1', 'Symfony', '2026-08-16 15:34:59', '2026-08-16 15:34:59'),
(97, 1, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran 2025/2026. Terplot: 220 pemetaan.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-16 15:43:59', '2026-08-16 15:43:59'),
(98, 1, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran 2025/2026. Terplot: 80 pemetaan.', '127.0.0.1', 'Symfony', '2026-08-16 15:48:34', '2026-08-16 15:48:34'),
(99, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:31:13', '2026-08-17 04:31:13'),
(100, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas XI F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:54:19', '2026-08-17 04:54:19'),
(101, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas XI F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:54:19', '2026-08-17 04:54:19'),
(102, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas XI F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:54:19', '2026-08-17 04:54:19'),
(103, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas XI F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:54:19', '2026-08-17 04:54:19'),
(104, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas XI F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:54:19', '2026-08-17 04:54:19'),
(105, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas XI F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:54:19', '2026-08-17 04:54:19'),
(106, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas XI F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:54:19', '2026-08-17 04:54:19'),
(107, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas X 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:55:30', '2026-08-17 04:55:30'),
(108, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas X 2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:55:30', '2026-08-17 04:55:30'),
(109, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas X 3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:55:30', '2026-08-17 04:55:30'),
(110, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas X 4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:55:30', '2026-08-17 04:55:30'),
(111, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas X 5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:55:30', '2026-08-17 04:55:30'),
(112, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas X 6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:55:30', '2026-08-17 04:55:30'),
(113, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas X 7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:55:30', '2026-08-17 04:55:30'),
(114, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Agung Srihartono, S.Pd mengajar Seni dan Budaya di kelas X 8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:55:30', '2026-08-17 04:55:30'),
(115, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:57:05', '2026-08-17 04:57:05'),
(116, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:57:05', '2026-08-17 04:57:05'),
(117, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:57:05', '2026-08-17 04:57:05'),
(118, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia di kelas XII F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:57:05', '2026-08-17 04:57:05'),
(119, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia di kelas XII F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:57:05', '2026-08-17 04:57:05'),
(120, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia di kelas XII F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:57:05', '2026-08-17 04:57:05'),
(121, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia di kelas XII F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 04:57:05', '2026-08-17 04:57:05'),
(122, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:11:20', '2026-08-17 05:11:20'),
(123, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:11:20', '2026-08-17 05:11:20'),
(124, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:11:20', '2026-08-17 05:11:20'),
(125, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XII F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:11:20', '2026-08-17 05:11:20'),
(126, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XII F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:11:20', '2026-08-17 05:11:20'),
(127, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XII F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:11:20', '2026-08-17 05:11:20'),
(128, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XII F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:11:20', '2026-08-17 05:11:20'),
(129, 1, 'PLOTTING', 'Menghapus seluruh plotting (7 kelas) untuk Guru Lanjar Setyowati, S.Pd pada mapel Bahasa Indonesia', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:16:58', '2026-08-17 05:16:58'),
(130, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:17:35', '2026-08-17 05:17:35'),
(131, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:17:35', '2026-08-17 05:17:35'),
(132, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:17:35', '2026-08-17 05:17:35'),
(133, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:17:35', '2026-08-17 05:17:35'),
(134, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:17:35', '2026-08-17 05:17:35'),
(135, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:17:35', '2026-08-17 05:17:35'),
(136, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:17:35', '2026-08-17 05:17:35'),
(137, 1, 'PLOTTING', 'Menghapus seluruh plotting (8 kelas) untuk Guru Lanjar Setyowati, S.Pd pada mapel Bahasa Inggris', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:17:55', '2026-08-17 05:17:55'),
(138, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XI F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:34:46', '2026-08-17 05:34:46'),
(139, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XI F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:34:46', '2026-08-17 05:34:46'),
(140, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XI F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:34:46', '2026-08-17 05:34:46'),
(141, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XI F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:34:46', '2026-08-17 05:34:46'),
(142, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XI F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:34:46', '2026-08-17 05:34:46'),
(143, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XI F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:34:46', '2026-08-17 05:34:46'),
(144, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XI F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:34:46', '2026-08-17 05:34:46'),
(145, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:37:37', '2026-08-17 05:37:37'),
(146, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:37:37', '2026-08-17 05:37:37'),
(147, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:37:37', '2026-08-17 05:37:37'),
(148, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XII F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:37:37', '2026-08-17 05:37:37'),
(149, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XII F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:37:37', '2026-08-17 05:37:37'),
(150, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XII F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:37:37', '2026-08-17 05:37:37'),
(151, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Septa Falintina, S.Pd, M.T mengajar Informatika di kelas XII F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:37:37', '2026-08-17 05:37:37'),
(152, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Iis Lestari, S.Kom mengajar Informatika di kelas XI F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:02', '2026-08-17 05:38:02'),
(153, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Iis Lestari, S.Kom mengajar Informatika di kelas XI F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:02', '2026-08-17 05:38:02'),
(154, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Iis Lestari, S.Kom mengajar Informatika di kelas XI F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:02', '2026-08-17 05:38:02'),
(155, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Iis Lestari, S.Kom mengajar Informatika di kelas X 2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:02', '2026-08-17 05:38:02'),
(156, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Iis Lestari, S.Kom mengajar Informatika di kelas X 4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:02', '2026-08-17 05:38:02'),
(157, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Iis Lestari, S.Kom mengajar Informatika di kelas X 6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:02', '2026-08-17 05:38:02'),
(158, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Iis Lestari, S.Kom mengajar Informatika di kelas X 8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:02', '2026-08-17 05:38:02'),
(159, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heru Rismawan, S.Pd mengajar Matematika (Umum) di kelas XI F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:56', '2026-08-17 05:38:56'),
(160, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heru Rismawan, S.Pd mengajar Matematika (Umum) di kelas XI F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:56', '2026-08-17 05:38:56'),
(161, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heru Rismawan, S.Pd mengajar Matematika (Umum) di kelas XI F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:38:56', '2026-08-17 05:38:56'),
(162, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Murtini Ningsih, S.Si mengajar Matematika (Umum) di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:39:19', '2026-08-17 05:39:19'),
(163, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Murtini Ningsih, S.Si mengajar Matematika (Umum) di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:39:19', '2026-08-17 05:39:19'),
(164, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Murtini Ningsih, S.Si mengajar Matematika (Umum) di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:39:19', '2026-08-17 05:39:19'),
(165, 1, 'PLOTTING', 'Menghapus seluruh plotting (4 kelas) untuk Guru Murtini Ningsih, S.Si pada mapel Matematika (Umum)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:39:53', '2026-08-17 05:39:53'),
(166, 1, 'PLOTTING', 'Menghapus seluruh plotting (5 kelas) untuk Guru Heru Rismawan, S.Pd pada mapel Matematika (Umum)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:39:58', '2026-08-17 05:39:58'),
(167, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heru Rismawan, S.Pd mengajar Matematika Tingkat Lanjut di kelas XI F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:42:47', '2026-08-17 05:42:47'),
(168, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heru Rismawan, S.Pd mengajar Matematika Tingkat Lanjut di kelas XI F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:42:47', '2026-08-17 05:42:47'),
(169, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heru Rismawan, S.Pd mengajar Matematika Tingkat Lanjut di kelas XI F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:42:47', '2026-08-17 05:42:47'),
(170, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Murtini Ningsih, S.Si mengajar Matematika Tingkat Lanjut di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:43:39', '2026-08-17 05:43:39'),
(171, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Murtini Ningsih, S.Si mengajar Matematika Tingkat Lanjut di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:43:39', '2026-08-17 05:43:39'),
(172, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Murtini Ningsih, S.Si mengajar Matematika Tingkat Lanjut di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:43:39', '2026-08-17 05:43:39'),
(173, 1, 'PLOTTING', 'Menghapus seluruh plotting (7 kelas) untuk Guru Lanjar Setyowati, S.Pd pada mapel Bahasa Indonesia Tingkat Lanjut', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:51:33', '2026-08-17 05:51:33'),
(174, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heni Setyarini, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:51:55', '2026-08-17 05:51:55'),
(175, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heni Setyarini, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:51:55', '2026-08-17 05:51:55'),
(176, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heni Setyarini, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:51:55', '2026-08-17 05:51:55'),
(177, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heni Setyarini, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:51:55', '2026-08-17 05:51:55'),
(178, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heni Setyarini, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:51:55', '2026-08-17 05:51:55'),
(179, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heni Setyarini, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:51:55', '2026-08-17 05:51:55'),
(180, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Heni Setyarini, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XII F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 05:51:55', '2026-08-17 05:51:55'),
(181, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Sunarno, S.Pd mengajar Matematika (Umum) di kelas X 3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:02:13', '2026-08-17 06:02:13'),
(182, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Sunarno, S.Pd mengajar Matematika (Umum) di kelas X 6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:02:28', '2026-08-17 06:02:28');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(183, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Ardjanto, S.Pd mengajar Bahasa Inggris di kelas X 5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:02:43', '2026-08-17 06:02:43'),
(184, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Ardjanto, S.Pd mengajar Bahasa Inggris di kelas X 6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:03:27', '2026-08-17 06:03:27'),
(185, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Ardjanto, S.Pd mengajar Bahasa Inggris di kelas X 5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:07:15', '2026-08-17 06:07:15'),
(186, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Sunarno, S.Pd mengajar Matematika (Umum) di kelas X 4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:07:37', '2026-08-17 06:07:37'),
(187, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Sunarno, S.Pd mengajar Matematika (Umum) di kelas X 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:07:47', '2026-08-17 06:07:47'),
(188, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Sunarno, S.Pd mengajar Matematika (Umum) di kelas X 3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:08:57', '2026-08-17 06:08:57'),
(189, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Ardjanto, S.Pd mengajar Bahasa Inggris di kelas X 3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:09:16', '2026-08-17 06:09:16'),
(190, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Ardjanto, S.Pd mengajar Bahasa Inggris di kelas X 2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:09:29', '2026-08-17 06:09:29'),
(191, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Is Imanah, S.Pd, M.Pd mengajar Prakarya dan Kewirausahaan di kelas XII F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:09:44', '2026-08-17 06:09:44'),
(192, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Is Imanah, S.Pd, M.Pd mengajar Prakarya dan Kewirausahaan di kelas XII F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:09:59', '2026-08-17 06:09:59'),
(193, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Syamsudin, S.Pd mengajar Biologi di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:11:35', '2026-08-17 06:11:35'),
(194, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Syamsudin, S.Pd mengajar Biologi di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:11:35', '2026-08-17 06:11:35'),
(195, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Syamsudin, S.Pd mengajar Biologi di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:11:35', '2026-08-17 06:11:35'),
(196, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Syamsudin, S.Pd mengajar Biologi di kelas XI F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:11:35', '2026-08-17 06:11:35'),
(197, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Syamsudin, S.Pd mengajar Biologi di kelas XI F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:11:35', '2026-08-17 06:11:35'),
(198, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Syamsudin, S.Pd mengajar Biologi di kelas XI F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:11:35', '2026-08-17 06:11:35'),
(199, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Arik Andriyani, S.S. mengajar Geografi di kelas XII F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:12:36', '2026-08-17 06:12:36'),
(200, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Arik Andriyani, S.S. mengajar Geografi di kelas XII F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:12:36', '2026-08-17 06:12:36'),
(201, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Arik Andriyani, S.S. mengajar Geografi di kelas XI F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:12:36', '2026-08-17 06:12:36'),
(202, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Arik Andriyani, S.S. mengajar Geografi di kelas XI F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:12:36', '2026-08-17 06:12:36'),
(203, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Oryza Hesak Karismaningtyas, S.Pd mengajar Fisika di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:13:19', '2026-08-17 06:13:19'),
(204, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Oryza Hesak Karismaningtyas, S.Pd mengajar Fisika di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:13:19', '2026-08-17 06:13:19'),
(205, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Oryza Hesak Karismaningtyas, S.Pd mengajar Fisika di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:13:19', '2026-08-17 06:13:19'),
(206, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Oryza Hesak Karismaningtyas, S.Pd mengajar Fisika di kelas XI F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:13:19', '2026-08-17 06:13:19'),
(207, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Oryza Hesak Karismaningtyas, S.Pd mengajar Fisika di kelas XI F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:13:19', '2026-08-17 06:13:19'),
(208, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Oryza Hesak Karismaningtyas, S.Pd mengajar Fisika di kelas XI F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:13:19', '2026-08-17 06:13:19'),
(209, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Umi Farichah, S.Pd, M.Pd mengajar Kimia di kelas XII F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:20:07', '2026-08-17 06:20:07'),
(210, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Umi Farichah, S.Pd, M.Pd mengajar Kimia di kelas XII F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:20:07', '2026-08-17 06:20:07'),
(211, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Umi Farichah, S.Pd, M.Pd mengajar Kimia di kelas XII F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:20:07', '2026-08-17 06:20:07'),
(212, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Umi Farichah, S.Pd, M.Pd mengajar Kimia di kelas XI F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:20:07', '2026-08-17 06:20:07'),
(213, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Umi Farichah, S.Pd, M.Pd mengajar Kimia di kelas XI F 2.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:20:07', '2026-08-17 06:20:07'),
(214, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Umi Farichah, S.Pd, M.Pd mengajar Kimia di kelas XI F 2.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:20:07', '2026-08-17 06:20:07'),
(215, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Teguh, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XI F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:21:00', '2026-08-17 06:21:00'),
(216, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Teguh, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XI F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:21:00', '2026-08-17 06:21:00'),
(217, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Endang Widayanti, S.Sos mengajar Sosiologi di kelas XII F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:21:26', '2026-08-17 06:21:26'),
(218, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Endang Widayanti, S.Sos mengajar Sosiologi di kelas XII F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:21:26', '2026-08-17 06:21:26'),
(219, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Endang Widayanti, S.Sos mengajar Sosiologi di kelas XI F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:21:26', '2026-08-17 06:21:26'),
(220, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Endang Widayanti, S.Sos mengajar Sosiologi di kelas XI F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:21:26', '2026-08-17 06:21:26'),
(221, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XI F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:22:10', '2026-08-17 06:22:10'),
(222, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XI F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:22:10', '2026-08-17 06:22:10'),
(223, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Is Imanah, S.Pd, M.Pd mengajar Prakarya dan Kewirausahaan di kelas XI F 4.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:22:29', '2026-08-17 06:22:29'),
(224, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Is Imanah, S.Pd, M.Pd mengajar Prakarya dan Kewirausahaan di kelas XI F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:22:29', '2026-08-17 06:22:29'),
(225, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Abdul Rouf, S.Pd mengajar Ekonomi di kelas XII F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:22:47', '2026-08-17 06:22:47'),
(226, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Abdul Rouf, S.Pd mengajar Ekonomi di kelas XII F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:22:47', '2026-08-17 06:22:47'),
(227, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Abdul Rouf, S.Pd mengajar Ekonomi di kelas XI F 3.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:22:47', '2026-08-17 06:22:47'),
(228, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Abdul Rouf, S.Pd mengajar Ekonomi di kelas XI F 3.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 06:22:47', '2026-08-17 06:22:47'),
(229, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 08:19:08', '2026-08-17 08:19:08'),
(230, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 08:31:02', '2026-08-17 08:31:02'),
(231, 1, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran 2025/2026. Terplot: 126 pemetaan.', '127.0.0.1', 'Symfony', '2026-08-17 09:08:29', '2026-08-17 09:08:29'),
(232, 4, 'AUTH', 'Guru \"Agung Srihartono, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 09:32:37', '2026-08-17 09:32:37'),
(233, 4, 'AUTH', 'Pengguna \"Agung Srihartono, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 10:06:06', '2026-08-17 10:06:06'),
(234, 13, 'AUTH', 'Guru \"Heni Setyarini, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 10:06:14', '2026-08-17 10:06:14'),
(235, 13, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 2: Analisis Kaidah Kebahasaan Teks Laporan Hasil Observasi (LHO)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 10:14:05', '2026-08-17 10:14:05'),
(236, 13, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 1: Analisis Struktur Teks LHO Lingkungan Sekolah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 10:15:07', '2026-08-17 10:15:07'),
(239, 13, 'ASSIGNMENT', 'Mengubah status koreksi tugas Tugas 2: Analisis Kaidah Kebahasaan Teks Laporan Hasil Observasi (LHO) untuk siswa HARIS RAMADHAN', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 10:38:12', '2026-08-17 10:38:12'),
(240, 13, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 3: Menyusun Kerangka dan Menulis Teks Laporan Hasil Observasi (LHO)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 11:11:51', '2026-08-17 11:11:51'),
(241, 13, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 1: Analisis Struktur Teks LHO Lingkungan Sekolah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 11:12:24', '2026-08-17 11:12:24'),
(242, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 11:43:08', '2026-08-17 11:43:08'),
(243, 13, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 3: Menyusun Kerangka dan Menulis Teks Laporan Hasil Observasi (LHO)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 11:57:09', '2026-08-17 11:57:09'),
(244, 13, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 2: Analisis Kaidah Kebahasaan Teks Laporan Hasil Observasi (LHO)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 11:57:20', '2026-08-17 11:57:20'),
(245, 13, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 1: Analisis Struktur Teks LHO Lingkungan Sekolah', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 11:57:31', '2026-08-17 11:57:31'),
(247, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 11:58:27', '2026-08-17 11:58:27'),
(250, 13, 'AUTH', 'Guru \"Heni Setyarini, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 12:16:31', '2026-08-17 12:16:31'),
(251, 13, 'APPEAL', 'Menyetujui banding dispensasi untuk siswa ID 1129 pada mata pelajaran ID 9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 12:30:39', '2026-08-17 12:30:39'),
(252, 1, 'SETTINGS', 'Mengubah status Proteksi Kunci Deadline SSL: dinonaktifkan (Fleksibel Edit)', '127.0.0.1', 'Symfony', '2026-08-17 12:46:51', '2026-08-17 12:46:51'),
(253, 1, 'SETTINGS', 'Mengubah status Proteksi Kunci Deadline SSL: diaktifkan (Terkunci Ketat)', '127.0.0.1', 'Symfony', '2026-08-17 12:46:51', '2026-08-17 12:46:51'),
(254, 1, 'SETTINGS', 'Mengubah status Proteksi Kunci Deadline SSL: dinonaktifkan (Fleksibel Edit)', '127.0.0.1', 'Symfony', '2026-08-17 12:47:31', '2026-08-17 12:47:31'),
(255, 1, 'SETTINGS', 'Mengubah status Proteksi Kunci Deadline SSL: diaktifkan (Terkunci Ketat)', '127.0.0.1', 'Symfony', '2026-08-17 12:47:31', '2026-08-17 12:47:31'),
(256, 1, 'SETTINGS', 'Mengubah status Proteksi Kunci Deadline SSL: dinonaktifkan (Fleksibel Edit)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 12:52:04', '2026-08-17 12:52:04'),
(257, 1, 'SETTINGS', 'Mengubah status Proteksi Kunci Deadline SSL: diaktifkan (Terkunci Ketat)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 12:52:20', '2026-08-17 12:52:20'),
(258, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 13:23:09', '2026-08-17 13:23:09'),
(259, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-17 23:14:58', '2026-08-17 23:14:58'),
(260, 13, 'AUTH', 'Guru \"Heni Setyarini, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 23:15:18', '2026-08-17 23:15:18'),
(261, 13, 'AUTH', 'Pengguna \"Heni Setyarini, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 23:19:08', '2026-08-17 23:19:08'),
(266, 13, 'AUTH', 'Guru \"Heni Setyarini, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 23:41:08', '2026-08-17 23:41:08'),
(267, 13, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 4 LHO', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 23:42:07', '2026-08-17 23:42:07'),
(268, 13, 'AUTH', 'Pengguna \"Heni Setyarini, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-17 23:42:15', '2026-08-17 23:42:15'),
(275, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 00:22:08', '2026-08-18 00:22:08'),
(276, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 00:33:55', '2026-08-18 00:33:55'),
(279, 29, 'AUTH', 'Guru \"Susilawati\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 00:41:13', '2026-08-18 00:41:13'),
(280, 1, 'CLASS', 'Memperbarui plotting wali kelas secara massal', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 00:41:28', '2026-08-18 00:41:28'),
(281, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 01:15:08', '2026-08-18 01:15:08'),
(282, 29, 'AUTH', 'Pengguna \"Susilawati\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 02:39:55', '2026-08-18 02:39:55'),
(283, 5, 'AUTH', 'Guru \"Ardjanto, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 02:40:10', '2026-08-18 02:40:10'),
(284, 5, 'ASSIGNMENT', 'Membuat tugas baru: Tugas Pertemuan 1: Self-Introduction (Memperkenalkan Diri)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 02:42:27', '2026-08-18 02:42:27'),
(285, 5, 'AUTH', 'Pengguna \"Ardjanto, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 02:42:41', '2026-08-18 02:42:41'),
(286, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 02:43:08', '2026-08-18 02:43:08'),
(287, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 02:43:43', '2026-08-18 02:43:43'),
(290, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 02:53:16', '2026-08-18 02:53:16'),
(291, 1, 'CLASS', 'Me-generate 21 rombel (Basis: T.A. 2025/2026) untuk Tahun Ajaran 2025/2026', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:08:02', '2026-08-18 03:08:02'),
(292, 1, 'STUDENT', 'Melakukan kelulusan massal untuk 248 siswa dari kelas: XII F 1, XII F 2.1, XII F 2.2, XII F 3.1, XII F 3.2, XII F 4.1, XII F 4.2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:08:17', '2026-08-18 03:08:17'),
(293, 1, 'STUDENT', 'Melakukan kenaikan kelas massal untuk 252 siswa. Detail: XI F 1 -> XII F 1 (36 siswa), XI F 2.1 -> XII F 2.1 (36 siswa), XI F 2.2 -> XII F 2.2 (36 siswa), XI F 3.1 -> XII F 3.1 (36 siswa), XI F 3.2 -> XII F 3.2 (36 siswa), XI F 4.1 -> XII F 4.1 (36 siswa), XI F 4.2 -> XII F 4.2 (36 siswa)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:09:25', '2026-08-18 03:09:25'),
(294, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:10:00', '2026-08-18 03:10:00'),
(295, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:13:32', '2026-08-18 03:13:32'),
(296, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:13:49', '2026-08-18 03:13:49'),
(297, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:14:01', '2026-08-18 03:14:01'),
(298, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:14:12', '2026-08-18 03:14:12'),
(299, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:14:23', '2026-08-18 03:14:23'),
(300, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 36 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:14:35', '2026-08-18 03:14:35'),
(301, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:31:37', '2026-08-18 03:31:37'),
(302, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:31:46', '2026-08-18 03:31:46'),
(303, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:31:55', '2026-08-18 03:31:55'),
(304, 1, 'STUDENT', 'Melakukan penjurusan/kenaikan kelas X ke XI untuk 1 siswa.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:32:40', '2026-08-18 03:32:40'),
(305, 1, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran 2026/2027. Terplot: 126 pemetaan.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:38:15', '2026-08-18 03:38:15'),
(306, 1, 'STUDENT', 'Men-generate 252 akun login siswa secara otomatis', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:50:14', '2026-08-18 03:50:14'),
(307, 1, 'STUDENT', 'Men-generate 252 akun login siswa secara otomatis', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 03:55:25', '2026-08-18 03:55:25'),
(308, 1, 'STUDENT', 'Men-generate 252 akun login siswa secara otomatis', '127.0.0.1', 'Symfony', '2026-08-18 04:04:15', '2026-08-18 04:04:15'),
(309, 1, 'STUDENT', 'Men-generate 0 akun login siswa secara otomatis', '127.0.0.1', 'Symfony', '2026-08-18 04:04:50', '2026-08-18 04:04:50'),
(310, 1, 'STUDENT', 'Men-generate 252 akun login siswa secara otomatis', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 04:06:26', '2026-08-18 04:06:26'),
(312, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Lanjar Setyowati, S.Pd mengajar Bahasa Indonesia Tingkat Lanjut di kelas XI F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 04:17:03', '2026-08-18 04:17:03'),
(313, 1, 'PLOTTING', 'Menambahkan plotting manual: Guru Puput Rika Harjani, S.Pd mengajar Bahasa Inggris Tingkat Lanjut di kelas XI F 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 04:17:29', '2026-08-18 04:17:29'),
(315, 23, 'AUTH', 'Guru \"Puput Rika Harjani, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 04:19:06', '2026-08-18 04:19:06'),
(317, 23, 'ASSIGNMENT', 'Membuat tugas baru: Pertemuan 1: Introduction to Legend (Narrative Text)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 04:24:20', '2026-08-18 04:24:20'),
(318, 23, 'ASSIGNMENT', 'Membuat tugas baru: Pertemuan 2: Sharing Opinions - Social Media Impact', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 04:24:58', '2026-08-18 04:24:58'),
(319, 23, 'ASSIGNMENT', 'Membuat tugas baru: Pertemuan 3: Listening & Video Reflection', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 04:27:01', '2026-08-18 04:27:01'),
(320, 1, 'SETTINGS', 'Mengubah status Proteksi Kunci Deadline SSL: dinonaktifkan (Fleksibel Edit)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 04:43:34', '2026-08-18 04:43:34'),
(321, 23, 'ASSIGNMENT', 'Memperbarui tugas: Pertemuan 3: Listening & Video Reflection', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 04:44:00', '2026-08-18 04:44:00'),
(324, 23, 'ASSIGNMENT', 'Memperbarui tugas: Pertemuan 3: Listening & Video Reflection', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 04:45:57', '2026-08-18 04:45:57'),
(325, 1, 'SETTINGS', 'Mengubah status Proteksi Kunci Deadline SSL: diaktifkan (Terkunci Ketat)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 04:46:24', '2026-08-18 04:46:24'),
(327, 23, 'ASSIGNMENT', 'Memperbarui tugas: Pertemuan 3: Listening & Video Reflection', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 05:20:29', '2026-08-18 05:20:29'),
(329, 23, 'AUTH', 'Pengguna \"Puput Rika Harjani, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 05:23:08', '2026-08-18 05:23:08'),
(330, 23, 'AUTH', 'Guru \"Puput Rika Harjani, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 05:23:40', '2026-08-18 05:23:40'),
(331, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 07:23:37', '2026-08-18 07:23:37'),
(332, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 07:27:20', '2026-08-18 07:27:20'),
(333, 19, 'AUTH', 'Pengguna \"Lanjar Setyowati, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 07:29:44', '2026-08-18 07:29:44'),
(334, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 07:40:14', '2026-08-18 07:40:14'),
(335, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-18 07:41:03', '2026-08-18 07:41:03'),
(337, 23, 'AUTH', 'Guru \"Puput Rika Harjani, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 07:43:55', '2026-08-18 07:43:55'),
(339, 23, 'ASSIGNMENT', 'Memperbarui tugas: Pertemuan 3: Listening & Video Reflection', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 07:47:19', '2026-08-18 07:47:19'),
(340, 23, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 07:48:42', '2026-08-18 07:48:42'),
(341, 23, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 07:49:41', '2026-08-18 07:49:41'),
(344, 23, 'ASSIGNMENT', 'Membuat tugas baru: tugas 6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 07:50:42', '2026-08-18 07:50:42'),
(345, 23, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 07:50:56', '2026-08-18 07:50:56'),
(346, 23, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 07:51:12', '2026-08-18 07:51:12'),
(347, 23, 'AUTH', 'Pengguna \"Puput Rika Harjani, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 08:03:58', '2026-08-18 08:03:58'),
(348, 28, 'AUTH', 'Guru \"Sunarno, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 08:04:09', '2026-08-18 08:04:09'),
(349, 28, 'AUTH', 'Pengguna \"Sunarno, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 08:05:47', '2026-08-18 08:05:47'),
(350, 29, 'AUTH', 'Guru \"Susilawati\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-18 08:05:58', '2026-08-18 08:05:58'),
(351, 29, 'AUTH', 'Guru \"Susilawati\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 14:24:01', '2026-08-21 14:24:01'),
(352, 29, 'AUTH', 'Pengguna \"Susilawati\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 14:28:14', '2026-08-21 14:28:14'),
(353, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 14:49:51', '2026-08-21 14:49:51'),
(354, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-21 14:52:24', '2026-08-21 14:52:24'),
(355, 19, 'AUTH', 'Pengguna \"Lanjar Setyowati, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-21 15:23:28', '2026-08-21 15:23:28'),
(356, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-21 15:52:00', '2026-08-21 15:52:00'),
(357, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 15:52:08', '2026-08-21 15:52:08'),
(358, 19, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 1 Analisis Teks / Analytical Exposition (Menulis Esai)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-21 15:54:51', '2026-08-21 15:54:51'),
(359, 19, 'AUTH', 'Pengguna \"Lanjar Setyowati, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-21 16:29:28', '2026-08-21 16:29:28'),
(360, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-21 16:55:38', '2026-08-21 16:55:38'),
(361, 19, 'ASSIGNMENT', 'Mengembalikan tugas \"Tugas 1 Analisis Teks / Analytical Exposition (Menulis Esai)\" milik siswa ALMIRA IKSANIA PUTRI untuk direvisi: Jawaban tidak sesuai dengan instruksi / topik tugas yang diberikan.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-21 17:43:41', '2026-08-21 17:43:41'),
(362, 218, 'AUTH', 'Siswa \"ALMIRA IKSANIA PUTRI\" (NIS: 25109) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 17:46:06', '2026-08-21 17:46:06'),
(363, 218, 'ASSIGNMENT', 'Mengunggah perbaikan/revisi tugas: Tugas 1 Analisis Teks / Analytical Exposition (Menulis Esai)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 18:05:29', '2026-08-21 18:05:29'),
(364, 218, 'AUTH', 'Pengguna \"ALMIRA IKSANIA PUTRI\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-21 18:54:56', '2026-08-21 18:54:56'),
(365, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 05:36:06', '2026-08-22 05:36:06'),
(366, 19, 'AUTH', 'Pengguna \"Lanjar Setyowati, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 06:09:27', '2026-08-22 06:09:27'),
(367, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 06:32:01', '2026-08-22 06:32:01'),
(368, 19, 'ASSIGNMENT', 'Membuat tugas baru: Video Presentasi Bahasa Inggris', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 06:36:07', '2026-08-22 06:36:07'),
(369, 218, 'AUTH', 'Siswa \"ALMIRA IKSANIA PUTRI\" (NIS: 25109) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-22 06:37:22', '2026-08-22 06:37:22'),
(370, 218, 'ASSIGNMENT', 'Mengumpulkan tugas: Video Presentasi Bahasa Inggris', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-22 06:41:24', '2026-08-22 06:41:24'),
(371, 19, 'ASSIGNMENT', 'Membuat tugas baru: English Campaign Poster: Speak with Confidence', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 07:05:36', '2026-08-22 07:05:36'),
(372, 218, 'ASSIGNMENT', 'Mengumpulkan tugas: English Campaign Poster: Speak with Confidence', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-22 07:23:16', '2026-08-22 07:23:16'),
(373, 19, 'ASSIGNMENT', 'Mengembalikan tugas \"English Campaign Poster: Speak with Confidence\" milik siswa ALMIRA IKSANIA PUTRI untuk direvisi: Berkas rusak / corrupt / tidak dapat dibuka atau dibaca.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 07:23:51', '2026-08-22 07:23:51'),
(374, 218, 'ASSIGNMENT', 'Mengunggah perbaikan/revisi tugas: English Campaign Poster: Speak with Confidence', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-22 07:24:22', '2026-08-22 07:24:22'),
(375, 19, 'ASSIGNMENT', 'Mengembalikan tugas \"English Campaign Poster: Speak with Confidence\" milik siswa ALMIRA IKSANIA PUTRI untuk direvisi: Berkas rusak / corrupt / tidak dapat dibuka atau dibaca.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 07:24:52', '2026-08-22 07:24:52'),
(376, 218, 'ASSIGNMENT', 'Mengunggah perbaikan/revisi tugas: English Campaign Poster: Speak with Confidence', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-22 07:25:23', '2026-08-22 07:25:23'),
(377, 19, 'ASSIGNMENT', 'Mengembalikan tugas \"English Campaign Poster: Speak with Confidence\" milik siswa ALMIRA IKSANIA PUTRI untuk direvisi: Berkas rusak / corrupt / tidak dapat dibuka atau dibaca.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 07:34:48', '2026-08-22 07:34:48'),
(378, 218, 'ASSIGNMENT', 'Mengunggah perbaikan/revisi tugas: English Campaign Poster: Speak with Confidence', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-22 07:35:11', '2026-08-22 07:35:11'),
(379, 218, 'AUTH', 'Pengguna \"ALMIRA IKSANIA PUTRI\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-22 08:08:53', '2026-08-22 08:08:53'),
(380, 19, 'AUTH', 'Pengguna \"Lanjar Setyowati, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 08:43:27', '2026-08-22 08:43:27'),
(381, 218, 'AUTH', 'Siswa \"ALMIRA IKSANIA PUTRI\" (NIS: 25109) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-22 09:00:26', '2026-08-22 09:00:26'),
(382, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 09:01:33', '2026-08-22 09:01:33'),
(383, 19, 'AUTH', 'Pengguna \"Lanjar Setyowati, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 09:32:26', '2026-08-22 09:32:26'),
(384, 218, 'AUTH', 'Pengguna \"ALMIRA IKSANIA PUTRI\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-22 10:40:26', '2026-08-22 10:40:26'),
(385, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 12:17:07', '2026-08-22 12:17:07'),
(386, 19, 'AUTH', 'Pengguna \"Lanjar Setyowati, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 12:53:27', '2026-08-22 12:53:27'),
(387, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 13:11:12', '2026-08-22 13:11:12'),
(388, 19, 'AUTH', 'Pengguna \"Lanjar Setyowati, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 14:01:27', '2026-08-22 14:01:27'),
(389, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-22 15:24:58', '2026-08-22 15:24:58'),
(390, 19, 'SSL_THRESHOLD_UPDATED', 'Pengaturan ambang batas SSL diperbarui untuk Mapel Bahasa Inggris Tingkat Lanjut (Kelas XII F 3.1): Scope=CURRENT_CLASS, Mode=custom, Nilai=1', NULL, NULL, '2026-08-22 15:36:31', '2026-08-22 15:36:31'),
(391, 19, 'SSL_THRESHOLD_UPDATED', 'Pengaturan ambang batas SSL diperbarui untuk Mapel Bahasa Inggris Tingkat Lanjut (Kelas XII F 3.1): Scope=CURRENT_CLASS, Mode=custom, Nilai=1', NULL, NULL, '2026-08-22 15:36:46', '2026-08-22 15:36:46'),
(392, 19, 'SSL_THRESHOLD_UPDATED', 'Pengaturan ambang batas SSL diperbarui untuk Mapel Bahasa Inggris Tingkat Lanjut (Kelas XII F 3.1): Scope=CURRENT_CLASS, Mode=custom, Nilai=3', NULL, NULL, '2026-08-22 15:40:49', '2026-08-22 15:40:49'),
(393, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:07:29', '2026-08-23 04:07:29');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(394, 19, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 1 cek ssl', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:39:23', '2026-08-23 04:39:23'),
(395, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-23 04:40:09', '2026-08-23 04:40:09'),
(396, NULL, 'STUDENT', 'Membuat akun login mandiri untuk siswa AHMAD ROSYADI ANGGRAINI (ahmad.27090@siswa.smansago.com)', '127.0.0.1', 'Symfony', '2026-08-23 04:41:08', '2026-08-23 04:41:08'),
(397, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-23 04:42:07', '2026-08-23 04:42:07'),
(400, 19, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 2 cek ssl', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:43:50', '2026-08-23 04:43:50'),
(401, 19, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 2 cek ssl', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:43:50', '2026-08-23 04:43:50'),
(402, 19, 'DELETION', 'Menghapus tugas: Tugas 2 cek ssl', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:43:59', '2026-08-23 04:43:59'),
(404, 19, 'ASSIGNMENT', 'Membuat tugas baru: Tugas 3 cek ssl', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:44:40', '2026-08-23 04:44:40'),
(406, 19, 'ASSIGNMENT', 'Membuat tugas baru: waktunya tes ssl', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:45:26', '2026-08-23 04:45:26'),
(407, 19, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 3 cek ssl', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:50:55', '2026-08-23 04:50:55'),
(408, 19, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 1 cek ssl', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:51:10', '2026-08-23 04:51:10'),
(409, 19, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 2 cek ssl', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 04:51:21', '2026-08-23 04:51:21'),
(410, 19, 'ASSIGNMENT', 'Mengembalikan tugas \"Tugas 3 cek ssl\" milik siswa AHMAD ROSYADI ANGGRAINI untuk direvisi: lembar jawaban mapel lain tidak sesuai dengan intruksi', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 05:13:05', '2026-08-23 05:13:05'),
(411, 19, 'ASSIGNMENT', 'Mengembalikan tugas \"Tugas 2 cek ssl\" milik siswa AHMAD ROSYADI ANGGRAINI untuk direvisi: lembar jawaban mapel lain tidak sesuai dengan intruksi', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 05:13:30', '2026-08-23 05:13:30'),
(412, 19, 'ASSIGNMENT', 'Mengembalikan tugas \"Tugas 1 cek ssl\" milik siswa AHMAD ROSYADI ANGGRAINI untuk direvisi: lembar jawaban mapel lain tidak sesuai dengan intruksi', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 05:13:48', '2026-08-23 05:13:48'),
(421, 218, 'AUTH', 'Siswa \"ALMIRA IKSANIA PUTRI\" (NIS: 25109) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 17:36:19', '2026-08-23 17:36:19'),
(422, 218, 'AUTH', 'Pengguna \"ALMIRA IKSANIA PUTRI\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 18:07:46', '2026-08-23 18:07:46'),
(423, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 18:07:58', '2026-08-23 18:07:58'),
(424, 19, 'AUTH', 'Pengguna \"Lanjar Setyowati, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 18:26:33', '2026-08-23 18:26:33'),
(425, 218, 'AUTH', 'Siswa \"ALMIRA IKSANIA PUTRI\" (NIS: 25109) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 18:28:32', '2026-08-23 18:28:32'),
(426, 19, 'AUTH', 'Guru \"Lanjar Setyowati, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 23:18:16', '2026-08-23 23:18:16'),
(427, 19, 'ASSIGNMENT', 'Memperbarui tugas: Video Presentasi Bahasa Inggris', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 23:23:30', '2026-08-23 23:23:30'),
(428, 19, 'ASSIGNMENT', 'Memperbarui tugas: Tugas 1 Analisis Teks / Analytical Exposition (Menulis Esai)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 23:24:00', '2026-08-23 23:24:00'),
(429, 19, 'ASSIGNMENT', 'Memperbarui tugas: Advanced English External Project (Canva/Figma)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-23 23:31:32', '2026-08-23 23:31:32'),
(430, 39, 'AUTH', 'Siswa \"AULIA AZZAHRA\" (NIS: 25112) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-24 10:17:24', '2026-08-24 10:17:24'),
(431, 39, 'AUTH', 'Pengguna \"AULIA AZZAHRA\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '2026-08-24 10:20:48', '2026-08-24 10:20:48'),
(432, 39, 'AUTH', 'Siswa \"AULIA AZZAHRA\" (NIS: 25112) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', '2026-08-24 10:21:21', '2026-08-24 10:21:21'),
(433, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-02 09:33:23', '2026-09-02 09:33:23'),
(434, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-03 13:16:34', '2026-09-03 13:16:34'),
(435, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-03 14:17:12', '2026-09-03 14:17:12'),
(436, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-03 14:28:46', '2026-09-03 14:28:46'),
(437, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-03 15:03:16', '2026-09-03 15:03:16'),
(438, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-03 15:31:57', '2026-09-03 15:31:57'),
(439, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-04 03:03:50', '2026-09-04 03:03:50'),
(440, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 04:02:55', '2026-09-07 04:02:55'),
(441, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 04:42:26', '2026-09-07 04:42:26'),
(442, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 06:02:07', '2026-09-07 06:02:07'),
(443, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 07:30:26', '2026-09-07 07:30:26'),
(444, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 07:42:03', '2026-09-07 07:42:03'),
(445, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 08:12:27', '2026-09-07 08:12:27'),
(446, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 08:31:59', '2026-09-07 08:31:59'),
(447, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 11:16:26', '2026-09-07 11:16:26'),
(448, 1, 'AUTH', 'Admin \"Super Admin\" berhasil masuk ke sistem melalui portal admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 11:21:05', '2026-09-07 11:21:05'),
(449, 1, 'SETTINGS', 'Memperbarui profil informasi sekolah dan pengaturan sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 11:35:36', '2026-09-07 11:35:36'),
(450, 1, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 12:06:28', '2026-09-07 12:06:28'),
(451, 23, 'AUTH', 'Guru \"Puput Rika Harjani, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 12:39:42', '2026-09-07 12:39:42'),
(452, 23, 'AUTH', 'Pengguna \"Puput Rika Harjani, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 12:39:48', '2026-09-07 12:39:48'),
(453, 23, 'AUTH', 'Guru \"Puput Rika Harjani, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 12:42:30', '2026-09-07 12:42:30'),
(454, 23, 'AUTH', 'Pengguna \"Puput Rika Harjani, S.Pd\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 14:15:15', '2026-09-07 14:15:15'),
(455, 36, 'AUTH', 'Siswa \"AKRIMA NAYLA AMIRA AGHNI\" (NIS: -) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 14:21:04', '2026-09-07 14:21:04'),
(456, 36, 'APPEAL', 'Mengajukan banding dispensasi untuk mata pelajaran ID 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 15:09:30', '2026-09-07 15:09:30'),
(457, 36, 'AUTH', 'Pengguna \"AKRIMA NAYLA AMIRA AGHNI\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 15:21:33', '2026-09-07 15:21:33'),
(458, 29, 'AUTH', 'Guru \"Susilawati\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 15:24:21', '2026-09-07 15:24:21'),
(459, 29, 'AUTH', 'Pengguna \"Susilawati\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 16:11:20', '2026-09-07 16:11:20'),
(460, 23, 'AUTH', 'Guru \"Puput Rika Harjani, S.Pd\" berhasil masuk ke sistem melalui portal guru', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', '2026-09-07 16:12:14', '2026-09-07 16:12:14');

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
  `mata_pelajaran_id` bigint UNSIGNED DEFAULT NULL,
  `ssl_threshold` tinyint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru_kelas`
--

INSERT INTO `guru_kelas` (`id`, `guru_id`, `kelas_id`, `created_at`, `updated_at`, `mata_pelajaran_id`, `ssl_threshold`) VALUES
(7502, 26, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7503, 26, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7504, 26, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7505, 26, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7506, 19, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7507, 19, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7508, 19, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7509, 19, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7510, 19, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7511, 33, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7512, 33, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7513, 33, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7514, 33, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7515, 33, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 21, NULL),
(7516, 25, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7517, 25, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7518, 25, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7519, 25, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7520, 25, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7521, 25, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7522, 25, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7523, 16, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7524, 16, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7525, 16, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7526, 16, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7527, 16, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7528, 16, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7529, 16, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 14, NULL),
(7530, 11, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7531, 11, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7532, 11, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7533, 11, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7534, 11, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7535, 27, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7536, 27, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7537, 27, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7538, 27, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7539, 27, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7540, 29, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7541, 29, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7542, 29, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7543, 29, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 9, NULL),
(7544, 4, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7545, 4, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7546, 4, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7547, 4, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7548, 4, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7549, 4, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7550, 4, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7551, 21, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7552, 21, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7553, 21, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7554, 21, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7555, 21, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7556, 21, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7557, 21, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 3, NULL),
(7558, 10, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7559, 10, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7560, 10, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7561, 10, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7562, 10, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7563, 15, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7564, 15, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7565, 15, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7566, 15, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7567, 15, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7568, 6, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7569, 6, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7570, 6, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7571, 6, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 5, NULL),
(7572, 7, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7573, 7, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7574, 7, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7575, 7, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7576, 7, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7577, 7, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7578, 7, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7579, 7, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7580, 23, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7581, 23, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7582, 23, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7583, 23, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7584, 23, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7585, 23, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 6, NULL),
(7586, 22, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7587, 22, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7588, 22, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7589, 22, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7590, 22, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7591, 22, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7592, 22, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7593, 22, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7594, 2, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7595, 2, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7596, 2, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7597, 2, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7598, 2, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7599, 2, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 19, NULL),
(7600, 18, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7601, 18, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7602, 18, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7603, 18, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7604, 18, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7605, 18, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7606, 18, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7607, 18, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7608, 18, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7609, 18, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7610, 18, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7611, 18, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7612, 18, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7613, 18, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 16, NULL),
(7614, 4, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7615, 4, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7616, 4, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7617, 4, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7618, 4, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7619, 4, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7620, 4, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7621, 27, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7622, 27, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7623, 27, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7624, 27, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7625, 27, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7626, 27, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7627, 27, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 31, NULL),
(7628, 33, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7629, 7, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7630, 12, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7631, 1, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7632, 32, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7633, 14, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7634, 3, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7635, 24, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7636, 11, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7637, 21, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7638, 25, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7639, 10, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7640, 8, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7641, 6, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 32, NULL),
(7642, 9, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 8, NULL),
(7643, 9, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 8, NULL),
(7644, 9, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 8, NULL),
(7645, 9, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 8, NULL),
(7646, 20, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 8, NULL),
(7647, 20, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 8, NULL),
(7648, 20, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 8, NULL),
(7649, 20, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 8, NULL),
(7650, 14, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 26, NULL),
(7651, 14, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 26, NULL),
(7652, 14, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 26, NULL),
(7653, 14, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 26, NULL),
(7654, 32, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 26, NULL),
(7655, 32, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 26, NULL),
(7656, 32, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 26, NULL),
(7657, 32, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 26, NULL),
(7658, 31, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 23, NULL),
(7659, 31, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 23, NULL),
(7660, 31, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 23, NULL),
(7661, 31, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 23, NULL),
(7662, 28, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 23, NULL),
(7663, 28, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 23, NULL),
(7664, 28, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 23, NULL),
(7665, 28, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 23, NULL),
(7666, 33, 97, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 27, NULL),
(7667, 33, 98, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 27, NULL),
(7668, 33, 99, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 27, NULL),
(7669, 33, 102, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 27, NULL),
(7670, 12, 104, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 27, NULL),
(7671, 12, 105, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 27, NULL),
(7672, 12, 106, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 27, NULL),
(7673, 12, 109, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 27, NULL),
(7674, 24, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 1, NULL),
(7675, 24, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 1, NULL),
(7676, 24, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 1, NULL),
(7677, 1, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 1, NULL),
(7678, 1, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 1, NULL),
(7679, 1, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 1, NULL),
(7680, 30, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 4, NULL),
(7681, 30, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 4, NULL),
(7682, 30, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 4, NULL),
(7683, 5, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 4, NULL),
(7684, 5, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 4, NULL),
(7685, 5, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 4, NULL),
(7686, 8, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 7, NULL),
(7687, 8, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 7, NULL),
(7688, 8, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 7, NULL),
(7689, 8, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 7, NULL),
(7690, 8, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 7, NULL),
(7691, 8, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 7, NULL),
(7692, 29, 100, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 29, NULL),
(7693, 29, 101, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 29, NULL),
(7694, 29, 103, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 29, NULL),
(7695, 17, 107, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 30, NULL),
(7696, 17, 108, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 30, NULL),
(7697, 17, 110, '2026-08-17 09:00:09', '2026-08-17 09:00:09', 30, NULL),
(7701, 2, 89, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 2, NULL),
(7702, 2, 90, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 2, NULL),
(7703, 2, 91, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 2, NULL),
(7704, 2, 92, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 2, NULL),
(7705, 2, 93, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 2, NULL),
(7706, 2, 94, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 2, NULL),
(7707, 2, 95, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 2, NULL),
(7708, 7, 89, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 6, NULL),
(7709, 7, 90, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 6, NULL),
(7710, 7, 91, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 6, NULL),
(7711, 7, 92, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 6, NULL),
(7712, 7, 93, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 6, NULL),
(7713, 7, 94, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 6, NULL),
(7714, 7, 95, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 6, NULL),
(7715, 8, 89, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 7, NULL),
(7716, 8, 90, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 7, NULL),
(7717, 8, 91, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 7, NULL),
(7718, 8, 92, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 7, NULL),
(7719, 8, 93, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 7, NULL),
(7720, 8, 94, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 7, NULL),
(7721, 8, 95, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 7, NULL),
(7722, 18, 89, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 16, NULL),
(7723, 18, 90, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 16, NULL),
(7724, 18, 91, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 16, NULL),
(7725, 18, 92, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 16, NULL),
(7726, 18, 93, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 16, NULL),
(7727, 18, 94, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 16, NULL),
(7728, 18, 95, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 16, NULL),
(7729, 22, 89, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 19, NULL),
(7730, 22, 90, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 19, NULL),
(7731, 22, 91, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 19, NULL),
(7732, 22, 92, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 19, NULL),
(7733, 22, 93, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 19, NULL),
(7734, 22, 94, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 19, NULL),
(7735, 22, 95, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 19, NULL),
(7736, 21, 89, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 31, NULL),
(7737, 21, 90, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 31, NULL),
(7738, 21, 91, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 31, NULL),
(7739, 21, 92, '2026-08-17 09:08:28', '2026-08-17 09:08:28', 31, NULL),
(7740, 21, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 31, NULL),
(7741, 21, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 31, NULL),
(7742, 21, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 31, NULL),
(7743, 1, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 1, NULL),
(7744, 24, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 1, NULL),
(7745, 1, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 1, NULL),
(7746, 24, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 1, NULL),
(7747, 1, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 1, NULL),
(7748, 24, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 1, NULL),
(7749, 1, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 1, NULL),
(7750, 5, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 4, NULL),
(7751, 5, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 4, NULL),
(7752, 30, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 4, NULL),
(7753, 5, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 4, NULL),
(7754, 30, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 4, NULL),
(7755, 5, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 4, NULL),
(7756, 30, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 4, NULL),
(7757, 20, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 8, NULL),
(7758, 9, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 8, NULL),
(7759, 20, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 8, NULL),
(7760, 9, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 8, NULL),
(7761, 20, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 8, NULL),
(7762, 9, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 8, NULL),
(7763, 20, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 8, NULL),
(7764, 13, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 11, NULL),
(7765, 13, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 11, NULL),
(7766, 13, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 11, NULL),
(7767, 13, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 11, NULL),
(7768, 13, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 11, NULL),
(7769, 23, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 11, NULL),
(7770, 13, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 11, NULL),
(7771, 16, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 14, NULL),
(7772, 25, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 14, NULL),
(7773, 16, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 14, NULL),
(7774, 25, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 14, NULL),
(7775, 16, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 14, NULL),
(7776, 25, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 14, NULL),
(7777, 16, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 14, NULL),
(7778, 28, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 23, NULL),
(7779, 31, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 23, NULL),
(7780, 28, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 23, NULL),
(7781, 31, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 23, NULL),
(7782, 28, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 23, NULL),
(7783, 31, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 23, NULL),
(7784, 28, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 23, NULL),
(7785, 6, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 5, NULL),
(7786, 6, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 5, NULL),
(7787, 15, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 5, NULL),
(7788, 10, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 5, NULL),
(7789, 6, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 5, NULL),
(7790, 15, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 5, NULL),
(7791, 10, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 5, NULL),
(7792, 23, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 26, NULL),
(7793, 23, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 26, NULL),
(7794, 23, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 26, NULL),
(7795, 14, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 26, NULL),
(7796, 23, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 26, NULL),
(7797, 32, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 26, NULL),
(7798, 14, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 26, NULL),
(7799, 3, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 3, NULL),
(7800, 3, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 3, NULL),
(7801, 3, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 3, NULL),
(7802, 3, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 3, NULL),
(7803, 17, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 3, NULL),
(7804, 3, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 3, NULL),
(7805, 17, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 3, NULL),
(7806, 11, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 9, NULL),
(7807, 17, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 9, NULL),
(7808, 11, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 9, NULL),
(7809, 17, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 9, NULL),
(7810, 11, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 9, NULL),
(7811, 17, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 9, NULL),
(7812, 29, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 9, NULL),
(7813, 26, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 21, NULL),
(7814, 26, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 21, NULL),
(7815, 19, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 21, NULL),
(7816, 26, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 21, NULL),
(7817, 19, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 21, NULL),
(7818, 26, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 21, NULL),
(7819, 15, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 21, NULL),
(7820, 13, 89, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 32, NULL),
(7821, 3, 90, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 32, NULL),
(7822, 13, 91, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 32, NULL),
(7823, 3, 92, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 32, NULL),
(7824, 13, 93, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 32, NULL),
(7825, 3, 94, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 32, NULL),
(7826, 5, 95, '2026-08-17 09:08:29', '2026-08-17 09:08:29', 32, NULL),
(7827, 2, 111, '2026-08-18 03:38:12', '2026-08-18 03:38:12', 2, NULL),
(7828, 2, 112, '2026-08-18 03:38:12', '2026-08-18 03:38:12', 2, NULL),
(7829, 2, 113, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 2, NULL),
(7830, 2, 114, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 2, NULL),
(7831, 2, 115, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 2, NULL),
(7832, 2, 116, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 2, NULL),
(7833, 2, 117, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 2, NULL),
(7834, 7, 111, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 6, NULL),
(7835, 7, 112, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 6, NULL),
(7836, 7, 113, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 6, NULL),
(7837, 7, 114, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 6, NULL),
(7838, 7, 115, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 6, NULL),
(7839, 7, 116, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 6, NULL),
(7840, 7, 117, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 6, NULL),
(7841, 8, 111, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 7, NULL),
(7842, 8, 112, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 7, NULL),
(7843, 8, 113, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 7, NULL),
(7844, 8, 114, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 7, NULL),
(7845, 8, 115, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 7, NULL),
(7846, 8, 116, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 7, NULL),
(7847, 8, 117, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 7, NULL),
(7848, 18, 111, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 16, NULL),
(7849, 18, 112, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 16, NULL),
(7850, 18, 113, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 16, NULL),
(7851, 18, 114, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 16, NULL),
(7852, 18, 115, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 16, NULL),
(7853, 18, 116, '2026-08-18 03:38:13', '2026-08-18 03:38:13', 16, NULL),
(7854, 18, 117, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 16, NULL),
(7855, 22, 111, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 19, NULL),
(7856, 22, 112, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 19, NULL),
(7857, 22, 113, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 19, NULL),
(7858, 22, 114, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 19, NULL),
(7859, 22, 115, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 19, NULL),
(7860, 22, 116, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 19, NULL),
(7861, 22, 117, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 19, NULL),
(7862, 21, 111, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 31, NULL),
(7863, 21, 112, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 31, NULL),
(7864, 21, 113, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 31, NULL),
(7865, 21, 114, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 31, NULL),
(7866, 21, 115, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 31, NULL),
(7867, 21, 116, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 31, NULL),
(7868, 21, 117, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 31, NULL),
(7869, 1, 111, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 1, NULL),
(7870, 24, 112, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 1, NULL),
(7871, 1, 113, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 1, NULL),
(7872, 24, 114, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 1, NULL),
(7873, 1, 115, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 1, NULL),
(7874, 24, 116, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 1, NULL),
(7875, 1, 117, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 1, NULL),
(7876, 5, 111, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 4, NULL),
(7877, 5, 112, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 4, NULL),
(7878, 30, 113, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 4, NULL),
(7879, 5, 114, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 4, NULL),
(7880, 30, 115, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 4, NULL),
(7881, 5, 116, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 4, NULL),
(7882, 30, 117, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 4, NULL),
(7883, 9, 111, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 8, NULL),
(7884, 20, 112, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 8, NULL),
(7885, 9, 113, '2026-08-18 03:38:14', '2026-08-18 03:38:14', 8, NULL),
(7886, 20, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 8, NULL),
(7887, 9, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 8, NULL),
(7888, 20, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 8, NULL),
(7889, 9, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 8, NULL),
(7890, 13, 111, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 11, NULL),
(7891, 23, 112, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 11, NULL),
(7892, 13, 113, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 11, NULL),
(7893, 23, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 11, NULL),
(7894, 13, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 11, NULL),
(7895, 23, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 11, NULL),
(7896, 13, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 11, NULL),
(7897, 16, 111, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 14, NULL),
(7898, 25, 112, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 14, NULL),
(7899, 16, 113, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 14, NULL),
(7900, 25, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 14, NULL),
(7901, 16, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 14, NULL),
(7902, 25, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 14, NULL),
(7903, 16, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 14, NULL),
(7904, 28, 111, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 23, NULL),
(7905, 31, 112, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 23, NULL),
(7906, 28, 113, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 23, NULL),
(7907, 31, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 23, NULL),
(7908, 28, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 23, NULL),
(7909, 31, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 23, NULL),
(7910, 28, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 23, NULL),
(7911, 6, 111, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 5, NULL),
(7912, 15, 112, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 5, NULL),
(7913, 10, 113, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 5, NULL),
(7914, 6, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 5, NULL),
(7915, 15, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 5, NULL),
(7916, 10, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 5, NULL),
(7917, 6, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 5, NULL),
(7918, 14, 111, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 26, NULL),
(7919, 32, 112, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 26, NULL),
(7920, 14, 113, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 26, NULL),
(7921, 32, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 26, NULL),
(7922, 23, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 26, NULL),
(7923, 14, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 26, NULL),
(7924, 32, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 26, NULL),
(7925, 4, 111, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 3, NULL),
(7926, 3, 112, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 3, NULL),
(7927, 17, 113, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 3, NULL),
(7928, 4, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 3, NULL),
(7929, 3, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 3, NULL),
(7930, 17, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 3, NULL),
(7931, 4, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 3, NULL),
(7932, 11, 111, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 9, NULL),
(7933, 29, 112, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 9, NULL),
(7934, 27, 113, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 9, NULL),
(7935, 11, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 9, NULL),
(7936, 29, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 9, NULL),
(7937, 27, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 9, NULL),
(7938, 11, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 9, NULL),
(7939, 12, 111, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 21, NULL),
(7940, 26, 112, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 21, NULL),
(7941, 33, 113, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 21, NULL),
(7942, 19, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 21, NULL),
(7943, 12, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 21, NULL),
(7944, 26, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 21, NULL),
(7945, 33, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 21, NULL),
(7946, 27, 111, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 32, NULL),
(7947, 2, 112, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 32, NULL),
(7948, 29, 113, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 32, NULL),
(7949, 5, 114, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 32, NULL),
(7950, 30, 115, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 32, NULL),
(7951, 22, 116, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 32, NULL),
(7952, 19, 117, '2026-08-18 03:38:15', '2026-08-18 03:38:15', 32, NULL),
(7954, 21, 118, '2026-08-18 04:17:29', '2026-08-18 04:17:29', 30, NULL),
(7955, 26, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(7956, 25, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(7957, 11, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(7959, 10, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(7960, 7, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(7961, 22, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(7962, 18, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(7963, 4, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(7964, 33, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(7965, 9, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 8, NULL),
(7966, 14, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 26, NULL),
(7967, 31, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 23, NULL),
(7968, 33, 118, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 27, NULL),
(7969, 26, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(7970, 25, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(7971, 27, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(7972, 21, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(7973, 15, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(7974, 7, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(7975, 22, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(7976, 18, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(7977, 3, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(7978, 7, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(7979, 20, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 8, NULL),
(7980, 32, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 26, NULL),
(7981, 28, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 23, NULL),
(7982, 12, 119, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 27, NULL),
(7983, 19, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(7984, 16, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(7985, 29, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(7986, 3, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(7987, 6, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(7988, 7, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(7989, 22, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(7990, 18, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(7991, 3, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(7992, 33, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(7993, 20, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 8, NULL),
(7994, 32, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 26, NULL),
(7995, 28, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 23, NULL),
(7996, 12, 120, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 27, NULL),
(7997, 19, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(7998, 16, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(7999, 27, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8000, 21, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8001, 15, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8002, 23, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8003, 2, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8004, 18, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8005, 4, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8006, 11, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8007, 24, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 1, NULL),
(8008, 30, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 4, NULL),
(8009, 8, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 7, NULL),
(8010, 29, 121, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 29, NULL),
(8011, 12, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8012, 16, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8013, 11, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8014, 3, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8015, 10, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8016, 23, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8017, 2, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8018, 18, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8019, 3, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8020, 21, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8021, 1, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 1, NULL),
(8022, 5, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 4, NULL),
(8023, 8, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 7, NULL),
(8024, 11, 122, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 29, NULL),
(8025, 26, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8026, 25, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8027, 29, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8028, 21, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8029, 6, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8030, 7, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8031, 22, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8032, 18, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8033, 3, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8034, 24, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8035, 20, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 8, NULL),
(8036, 32, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 26, NULL),
(8037, 28, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 23, NULL),
(8038, 12, 123, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 27, NULL),
(8039, 12, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8040, 16, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8041, 27, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8042, 3, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8043, 15, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8044, 23, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8045, 2, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8046, 18, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8047, 3, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8048, 16, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8049, 1, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 1, NULL),
(8050, 5, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 4, NULL),
(8051, 8, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 7, NULL),
(8052, 11, 124, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 29, NULL),
(8053, 33, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8054, 16, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8055, 29, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8056, 21, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8057, 6, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8058, 7, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8059, 22, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8060, 18, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8061, 27, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8062, 32, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8063, 20, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 8, NULL),
(8064, 32, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 26, NULL),
(8065, 28, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 23, NULL),
(8066, 12, 125, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 27, NULL),
(8067, 19, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8068, 16, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8069, 29, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8070, 3, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8071, 6, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8072, 7, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8073, 22, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8074, 18, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8075, 27, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8076, 32, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8077, 9, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 8, NULL),
(8078, 14, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 26, NULL),
(8079, 31, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 23, NULL),
(8080, 33, 126, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 27, NULL),
(8081, 26, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8082, 25, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8083, 27, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8084, 21, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8085, 15, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8086, 7, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8087, 22, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8088, 18, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8089, 27, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8090, 4, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8091, 9, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 8, NULL),
(8092, 14, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 26, NULL),
(8093, 31, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 23, NULL),
(8094, 33, 127, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 27, NULL),
(8095, 33, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8096, 25, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8097, 29, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8098, 4, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8099, 6, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8100, 23, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8101, 2, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8102, 18, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8103, 27, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8104, 10, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8105, 1, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 1, NULL),
(8106, 5, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 4, NULL),
(8107, 8, 128, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 7, NULL),
(8108, 17, 128, '2026-08-18 04:48:42', '2026-08-22 15:40:49', 30, 3),
(8109, 26, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8110, 25, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8111, 29, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8112, 21, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8113, 6, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8114, 23, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8115, 2, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8116, 18, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8117, 27, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8118, 8, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8119, 24, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 1, NULL),
(8120, 30, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 4, NULL),
(8121, 8, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 7, NULL),
(8122, 17, 129, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 30, NULL),
(8123, 19, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8124, 16, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8125, 27, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8126, 3, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8127, 15, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8128, 7, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8129, 22, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8130, 18, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8131, 27, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8132, 1, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8133, 9, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 8, NULL),
(8134, 14, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 26, NULL),
(8135, 31, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 23, NULL),
(8136, 33, 130, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 27, NULL),
(8137, 12, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 21, NULL),
(8138, 25, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 14, NULL),
(8139, 11, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 9, NULL),
(8140, 21, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 3, NULL),
(8141, 10, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 5, NULL),
(8142, 23, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 6, NULL),
(8143, 2, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 19, NULL),
(8144, 18, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 16, NULL),
(8145, 27, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 31, NULL),
(8146, 10, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 32, NULL),
(8147, 24, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 1, NULL),
(8148, 30, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 4, NULL),
(8149, 8, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 7, NULL),
(8150, 17, 131, '2026-08-18 04:48:42', '2026-08-18 04:48:42', 30, NULL);

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
  `is_plotting_verified` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `name`, `grade_level`, `major`, `homeroom_teacher_id`, `academic_year`, `max_students`, `is_plotting_verified`, `created_at`, `updated_at`) VALUES
(89, 'X 1', 'X', 'Umum', 27, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(90, 'X 2', 'X', 'Umum', 2, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(91, 'X 3', 'X', 'Umum', 29, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(92, 'X 4', 'X', 'Umum', 5, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(93, 'X 5', 'X', 'Umum', 30, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(94, 'X 6', 'X', 'Umum', 22, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(95, 'X 7', 'X', 'Umum', 19, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(97, 'XI F 1', 'XI', 'Fase F', 17, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(98, 'XI F 2.1', 'XI', 'Fase F', 26, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(99, 'XI F 2.2', 'XI', 'Fase F', 6, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(100, 'XI F 3.1', 'XI', 'Fase F', 32, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(101, 'XI F 3.2', 'XI', 'Fase F', 25, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(102, 'XI F 4.1', 'XI', 'Fase F', 20, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(103, 'XI F 4.2', 'XI', 'Fase F', 16, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(104, 'XII F 1', 'XII', 'Fase F', 33, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(105, 'XII F 2.1', 'XII', 'Fase F', 28, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(106, 'XII F 2.2', 'XII', 'Fase F', 31, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(107, 'XII F 3.1', 'XII', 'Fase F', 14, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(108, 'XII F 3.2', 'XII', 'Fase F', 10, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(109, 'XII F 4.1', 'XII', 'Fase F', 1, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(110, 'XII F 4.2', 'XII', 'Fase F', 24, '2025/2026', 36, 1, '2026-08-16 13:16:04', '2026-08-18 00:41:28'),
(111, 'X 1', 'X', 'Fase E', 27, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(112, 'X 2', 'X', 'Fase E', 2, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(113, 'X 3', 'X', 'Fase E', 29, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(114, 'X 4', 'X', 'Fase E', 5, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(115, 'X 5', 'X', 'Fase E', 30, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(116, 'X 6', 'X', 'Fase E', 22, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(117, 'X 7', 'X', 'Fase E', 19, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(118, 'XI F 1', 'XI', 'Fase F', 27, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(119, 'XI F 2.1', 'XI', 'Fase F', 26, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(120, 'XI F 2.2', 'XI', 'Fase F', 6, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(121, 'XI F 3.1', 'XI', 'Fase F', 32, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(122, 'XI F 3.2', 'XI', 'Fase F', 25, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(123, 'XI F 4.1', 'XI', 'Fase F', 20, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(124, 'XI F 4.2', 'XI', 'Fase F', 16, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(125, 'XII F 1', 'XII', 'Fase F', 33, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(126, 'XII F 2.1', 'XII', 'Fase F', 28, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(127, 'XII F 2.2', 'XII', 'Fase F', 31, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:16:06'),
(128, 'XII F 3.1', 'XII', 'Fase F', 14, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(129, 'XII F 3.2', 'XII', 'Fase F', 10, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(130, 'XII F 4.1', 'XII', 'Fase F', 1, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55'),
(131, 'XII F 4.2', 'XII', 'Fase F', 24, '2026/2027', 36, 1, '2026-08-18 03:08:02', '2026-08-18 05:15:55');

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
(24, 'X 1', 'X', 'Fase E', '2026-08-15 11:37:38', '2026-08-17 05:57:57', '2025/2026'),
(25, 'X 2', 'X', 'Fase E', '2026-08-15 11:37:38', '2026-08-17 05:58:05', '2025/2026'),
(26, 'X 3', 'X', 'Fase E', '2026-08-15 11:37:38', '2026-08-17 05:58:10', '2025/2026'),
(27, 'X 4', 'X', 'Fase E', '2026-08-15 11:37:38', '2026-08-17 05:58:16', '2025/2026'),
(28, 'X 5', 'X', 'Fase E', '2026-08-15 11:37:38', '2026-08-17 05:58:37', '2025/2026'),
(29, 'X 6', 'X', 'Fase E', '2026-08-15 11:37:38', '2026-08-17 05:58:22', '2025/2026'),
(30, 'X 7', 'X', 'Fase E', '2026-08-15 11:37:38', '2026-08-17 05:58:28', '2025/2026'),
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
(45, 'XII F 4.2', 'XII', 'Fase F', '2026-08-15 11:37:38', '2026-08-15 11:37:38', '2025/2026'),
(46, 'X 8', 'X', 'Fase E', '2026-09-07 09:53:35', '2026-09-07 09:53:35', '2026/2027');

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
(1, 'EKO-EZU', 'Ekonomi', 'Mata Pelajaran Ekonomi', NULL, 'aktif', 5, '2026-07-06 06:23:44', '2026-08-17 08:39:34', '2025/2026'),
(2, 'SEN-CIf', 'Seni dan Budaya', 'Mata Pelajaran Seni dan Budaya', NULL, 'aktif', 5, '2026-07-06 06:23:44', '2026-08-17 08:39:34', '2025/2026'),
(3, 'BAH-SY0', 'Bahasa Inggris', 'Mata Pelajaran Bahasa Inggris', NULL, 'aktif', 3, '2026-07-06 06:23:44', '2026-08-17 08:39:34', '2025/2026'),
(4, 'GEO-VNP', 'Geografi', 'Mata Pelajaran Geografi', NULL, 'aktif', 5, '2026-07-06 06:23:45', '2026-08-17 08:39:34', '2025/2026'),
(5, 'PEN-snV', 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'Mata Pelajaran Pendidikan Jasmani, Olahraga, dan Kesehatan', NULL, 'aktif', 3, '2026-07-06 06:23:45', '2026-08-17 08:39:34', '2025/2026'),
(6, 'PEN-3or', 'Pendidikan Pancasila', 'Mata Pelajaran Pendidikan Pancasila', NULL, 'aktif', 2, '2026-07-06 06:23:45', '2026-07-22 03:59:52', '2025/2026'),
(7, 'SOS-nbT', 'Sosiologi', 'Mata Pelajaran Sosiologi', NULL, 'aktif', 5, '2026-07-06 06:23:46', '2026-08-17 08:39:34', '2025/2026'),
(8, 'FIS-2MZ', 'Fisika', 'Mata Pelajaran Fisika', NULL, 'aktif', 5, '2026-07-06 06:23:46', '2026-08-17 08:39:34', '2025/2026'),
(9, 'BAH-G47', 'Bahasa Indonesia', 'Mata Pelajaran Bahasa Indonesia', NULL, 'aktif', 3, '2026-07-06 06:23:46', '2026-08-17 08:39:34', '2025/2026'),
(11, 'INF-T6P', 'Informatika', 'Mata Pelajaran Informatika', NULL, 'aktif', 3, '2026-07-06 06:23:47', '2026-08-17 08:39:34', '2025/2026'),
(14, 'PEN-bCv', 'Pendidikan Agama Islam dan Budi Pekerti', 'Mata Pelajaran Pendidikan Agama Islam dan Budi Pekerti', NULL, 'aktif', 3, '2026-07-06 06:23:48', '2026-08-17 08:39:34', '2025/2026'),
(16, 'BIM-q63', 'Bimbingan dan Konseling/Konselor (BP/BK)', 'Mata Pelajaran Bimbingan dan Konseling/Konselor (BP/BK)', NULL, 'aktif', 2, '2026-07-06 06:23:48', '2026-07-22 03:59:52', '2025/2026'),
(19, 'SEJ-qta', 'Sejarah', 'Mata Pelajaran Sejarah', NULL, 'aktif', 2, '2026-07-06 06:23:49', '2026-07-22 03:59:52', '2025/2026'),
(21, 'MAT-LVh', 'Matematika (Umum)', 'Mata Pelajaran Matematika (Umum)', NULL, 'aktif', 3, '2026-07-06 06:23:50', '2026-08-17 08:39:34', '2025/2026'),
(23, 'BIO-UKC', 'Biologi', 'Mata Pelajaran Biologi', NULL, 'aktif', 5, '2026-07-06 06:23:51', '2026-08-17 08:39:34', '2025/2026'),
(26, 'KIM-Ksw', 'Kimia', 'Mata Pelajaran Kimia', NULL, 'aktif', 5, '2026-07-06 06:23:52', '2026-08-17 08:39:34', '2025/2026'),
(27, 'MPL-EA3FC', 'Matematika Tingkat Lanjut', NULL, NULL, 'aktif', 5, '2026-07-09 21:09:08', '2026-08-17 08:39:34', '2025/2026'),
(28, 'MPL-94DF7', 'Prakarya dan Kewirausahaan', NULL, NULL, 'aktif', 4, '2026-07-09 21:09:08', '2026-07-09 21:09:08', '2025/2026'),
(29, 'MPL-70697', 'Bahasa Indonesia Tingkat Lanjut', NULL, NULL, 'aktif', 4, '2026-07-09 21:09:08', '2026-07-09 21:09:08', '2025/2026'),
(30, 'MPL-4F2F3', 'Bahasa Inggris Tingkat Lanjut', NULL, NULL, 'aktif', 4, '2026-07-09 21:09:08', '2026-07-09 21:09:08', '2025/2026'),
(31, 'MPL-265B6', 'Muatan Lokal Bahasa Daerah', NULL, NULL, 'aktif', 2, '2026-07-09 21:09:08', '2026-07-22 03:59:52', '2025/2026'),
(32, 'P5-PANCASILA', 'Projek Penguatan Profil Pelajar Pancasila (P5)', NULL, NULL, 'aktif', 2, '2026-08-17 08:14:42', '2026-08-17 08:39:34', NULL);

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
(4, 9, 89, 'Bab 1: Menulis Teks Laporan Hasil Observasi (LHO)', 'Materi pengantar struktur teks LHO: Pernyataan umum, deskripsi bagian, dan manfaat.', 'document', 'materials/demo_teks_lho_kelas_x.pdf', NULL, 11, '2026-08-17 10:03:32', '2026-08-17 10:03:32'),
(5, 1, 111, 'Bab 1: Konsep Dasar Ilmu Ekonomi dan Kelangkaan', 'Materi pembelajaran mengenai konsep dasar ilmu ekonomi, prinsip ekonomi, motif ekonomi, dan pemenuhan kebutuhan di era digital.', 'pdf', 'materi/sample_konsep_dasar_ekonomi.pdf', NULL, 1, '2026-09-07 14:36:21', '2026-09-07 14:36:21');

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
(60, '2026_07_12_235308_create_password_change_histories_table', 9),
(61, '2026_08_21_190000_add_escalation_and_emergency_fields_to_appeals_and_recoveries', 10),
(62, '2026_08_21_210000_add_unique_index_to_pemulihan_akses_table', 10),
(63, '2026_08_22_000500_add_revision_and_validation_fields_to_pengumpulan_tugas_table', 11),
(64, '2026_08_22_130000_add_submission_types_and_url_fields', 12),
(65, '2026_08_22_150000_add_catatan_to_pengumpulan_tugas_table', 13),
(66, '2026_08_22_210000_add_ssl_threshold_to_guru_kelas_table', 14);

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
  `tipe_pemulihan` enum('normal','provisional','emergency_override') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `dibuka_oleh` bigint UNSIGNED DEFAULT NULL,
  `alasan_darurat` text COLLATE utf8mb4_unicode_ci,
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

INSERT INTO `pemulihan_akses` (`id`, `siswa_id`, `mata_pelajaran_id`, `status_pemulihan`, `tipe_pemulihan`, `dibuka_oleh`, `alasan_darurat`, `durasi_jam`, `tugas_id`, `mulai_pemulihan`, `batas_pemulihan`, `selesai_pemulihan`, `created_at`, `updated_at`) VALUES
(2, 500, 11, 'aktif', 'normal', NULL, NULL, 48, NULL, '2026-07-28 04:38:51', '2026-07-30 04:38:51', NULL, '2026-07-28 04:38:51', '2026-07-28 04:38:51'),
(4, 183, 6, 'aktif', 'normal', NULL, NULL, 48, 35, '2026-08-23 18:03:55', '2026-08-25 18:02:25', NULL, '2026-08-23 18:03:55', '2026-08-23 18:03:55');

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
  `tingkat_eskalasi` enum('guru','wali_kelas','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guru',
  `waktu_eskalasi` timestamp NULL DEFAULT NULL,
  `is_provisional_unlocked` tinyint(1) NOT NULL DEFAULT '0',
  `provisional_unlocked_at` timestamp NULL DEFAULT NULL,
  `provisional_expires_at` timestamp NULL DEFAULT NULL,
  `disetujui_oleh` bigint UNSIGNED DEFAULT NULL,
  `tanggal_persetujuan` timestamp NULL DEFAULT NULL,
  `tugas_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_banding`
--

INSERT INTO `pengajuan_banding` (`id`, `siswa_id`, `mata_pelajaran_id`, `alasan`, `kategori_alasan`, `bukti_pendukung`, `tanggapan_guru`, `status`, `tingkat_eskalasi`, `waktu_eskalasi`, `is_provisional_unlocked`, `provisional_unlocked_at`, `provisional_expires_at`, `disetujui_oleh`, `tanggal_persetujuan`, `tugas_id`, `created_at`, `updated_at`) VALUES
(1, 500, 11, 'tes', 'Lainnya', 'banding_bukti/lRoW4Cyc1D0ULctT6IwjgDcG8DUerGjuuEwY7xxT.pdf', NULL, 'diterima', 'guru', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2026-07-28 04:11:16', '2026-07-28 04:38:51'),
(4, 2, 31, 'Mohon izin Bu Guru, saya sempat sakit demam berdarah dan harus istirahat total selama 3 hari sehingga terlambat mengumpulkan tugas analisis tembang macapat. Surat keterangan dokter telah saya lampirkan.', 'Sakit', NULL, NULL, 'ditinjau', 'guru', NULL, 0, NULL, NULL, NULL, NULL, 44, '2026-09-07 13:53:28', '2026-09-07 13:53:28'),
(5, 3, 31, 'Mohon maaf Bu, laptop saya mengalami kerusakan layar mati dan koneksi internet di desa sedang putus saat deadline tugas kemarin. Mohon diberikan dispensasi waktu pengumpulan.', 'Kendala Teknis', NULL, NULL, 'ditinjau', 'guru', NULL, 0, NULL, NULL, NULL, NULL, 44, '2026-09-07 13:53:28', '2026-09-07 13:53:28'),
(6, 4, 31, 'Izin Bu Guru, kemarin saya harus mendampingi orang tua ke luar kota karena ada keperluan keluarga yang sangat mendesak sehingga belum sempat menyelesaikan tugas. Mohon perpanjangan waktu pemulihan akses tugas.', 'Keluarga', NULL, NULL, 'ditinjau', 'guru', NULL, 0, NULL, NULL, NULL, NULL, 44, '2026-09-07 13:53:28', '2026-09-07 13:53:28'),
(7, 1, 1, 'tes banding', 'Lainnya', 'banding_bukti/VcuYJMpfwoUSOMbALC0RugrfiyddtmTcWPA7p1bP.pdf', NULL, 'ditinjau', 'wali_kelas', '2026-09-07 13:54:07', 0, NULL, NULL, NULL, NULL, NULL, '2026-09-06 13:54:07', '2026-09-06 13:54:07');

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
(1, 'Super Admin', 'admin@admin.smansago.com', NULL, '$2y$12$9P6u9BsdnLbgsD9eoYgZf.E7j.FJGBBMPU8gKD.mYwj/gnVYzABrq', 'admin', NULL, '2026-07-06 06:23:43', '2026-09-07 11:21:05'),
(3, 'Abdul Rouf, S.Pd', 'abdul.rouf@guru.smansago.com', NULL, '$2y$12$1fYvRUPXmJb5cvjGygtqie9fxmOuaqFhzv.NvaxvtzkYwVgQNQHX6', 'guru', NULL, '2026-07-06 06:23:44', '2026-07-09 07:33:11'),
(4, 'Agung Srihartono, S.Pd', 'agung.srihartono@guru.smansago.com', NULL, '$2y$12$BuBwAAUNIV7nVCdEKJdOSeRWvJFgbXw8ux3h8lowrWqwjgia0BH/S', 'guru', NULL, '2026-07-06 06:23:44', '2026-08-17 09:32:37'),
(5, 'Ardjanto, S.Pd', 'ardjanto@guru.smansago.com', NULL, '$2y$12$cbGImS6S81jK4p1P0RDpku0LOGgdGNAi8ckwVN7gj24F68OBaIXm6', 'guru', NULL, '2026-07-06 06:23:45', '2026-08-18 02:40:10'),
(6, 'ARIEF DARMAYANTI, S.Pd', 'arief.darmayanti@guru.smansago.com', NULL, '$2y$12$.YFqDNwEE6NvmR3zC1bpzeh/fn.Q9wTntzz183NpW/mDzUAKbJ2d2', 'guru', NULL, '2026-07-06 06:23:45', '2026-07-06 06:23:45'),
(7, 'Arik Andriyani, S.S.', 'arik.andriyani@guru.smansago.com', NULL, '$2y$12$abJbHmB1q2nDgVT1wlP.Me/sEg0mpoZ/mp3/R1Y7K1Jch.5RIEYU.', 'guru', NULL, '2026-07-06 06:23:45', '2026-07-06 06:23:45'),
(8, 'Djoko Heriyanto, S.Pd, M.Pd', 'djoko.heriyanto@guru.smansago.com', NULL, '$2y$12$al1y72ZSZeED2TdioQQyHeW/sRDu5ah6xzO8B/L6df6XpMtMv/Xje', 'guru', NULL, '2026-07-06 06:23:45', '2026-07-06 06:23:45'),
(9, 'Endah Wahyuningsih, S.Pd', 'endah.wahyuningsih@guru.smansago.com', NULL, '$2y$12$xyNoVqEHQ0F3BQBKWLj9DuaJabNSjZSK/XWYHyFFOaqw3jKb39fTi', 'guru', NULL, '2026-07-06 06:23:46', '2026-07-06 06:23:46'),
(10, 'Endang Widayanti, S.Sos', 'endang.widayanti@guru.smansago.com', NULL, '$2y$12$CYThYhyDv6Y0BzthK8NbI.QNDMcPNy9CJxXLazKCQlNXTn4jsOloq', 'guru', NULL, '2026-07-06 06:23:46', '2026-07-06 06:23:46'),
(11, 'Eri Kriswanti, S.Pd', 'eri.kriswanti@guru.smansago.com', NULL, '$2y$12$jNBoKLTFFG3WU.y4JmJGweVin90z3RmpwEQgRSuJ.EqwYC38CvQDS', 'guru', NULL, '2026-07-06 06:23:46', '2026-07-06 06:23:46'),
(12, 'Ervhiendri Ali Akhmad, S.Pd', 'ervhiendri.akhmad@guru.smansago.com', NULL, '$2y$12$5khZ255fwX0QbpfgbLgw1OUxJJI8Afn92sfKwmOenjPgwctdsIhIK', 'guru', NULL, '2026-07-06 06:23:46', '2026-07-06 06:23:46'),
(13, 'Heni Setyarini, S.Pd', 'heni.setyarini@guru.smansago.com', NULL, '$2y$12$Ph0PJUPn96RJsYNSzapCjuyPQ2PoOQO0InH2TQJVwuCdsNNHUuT6.', 'guru', NULL, '2026-07-06 06:23:47', '2026-08-17 23:41:08'),
(14, 'Heru Rismawan, S.Pd', 'heru.rismawan@guru.smansago.com', NULL, '$2y$12$ph7.uJutwlqvXM.G40l.1..ramWPpo3VErI/X3KnK8rk31YrDd7hW', 'guru', NULL, '2026-07-06 06:23:47', '2026-07-06 06:23:47'),
(15, 'Iis Lestari, S.Kom', 'iis.lestari@guru.smansago.com', NULL, '$2y$12$X1r8WITnbH8v4bJjY4pV5.OhsK2S1PeImS0YOob2OQ.z.TcCWe/Ni', 'guru', NULL, '2026-07-06 06:23:47', '2026-07-28 04:14:18'),
(16, 'Is Imanah, S.Pd, M.Pd', 'is.imanah@guru.smansago.com', NULL, '$2y$12$RJhQT88Jleupy2pDSDY8.eYQ4xFCph1Q9hgSUqINb.DL4Oxx3d3jW', 'guru', NULL, '2026-07-06 06:23:47', '2026-07-06 06:23:47'),
(17, 'Joko Widodo, S.Pd', 'joko.widodo@guru.smansago.com', NULL, '$2y$12$FR.7Eyv4vuJ58cPmy1dag.sgcy4GhtppTV6c5E7/WHdPr0DfqX2EG', 'guru', NULL, '2026-07-06 06:23:48', '2026-07-12 17:42:59'),
(18, 'Khoirul Umam, S.Pd', 'khoirul.umam@guru.smansago.com', NULL, '$2y$12$RlzEuiQoBl7tsi.Nctb4WO/Yp0DhMSfjSvzu0TaTLM.DpN5dNnMg2', 'guru', NULL, '2026-07-06 06:23:48', '2026-07-06 06:23:48'),
(19, 'Lanjar Setyowati, S.Pd', 'lanjar.setyowati@guru.smansago.com', NULL, '$2y$12$JauQC6KyxzcmYOgs3vF4C.PwDzcs3v8mJJoI.cA.b42nqM8DQIRs6', 'guru', NULL, '2026-07-06 06:23:48', '2026-08-23 23:18:16'),
(20, 'Murdananto', 'murdananto@guru.smansago.com', NULL, '$2y$12$R8oN5CTAL2IaQhkRMvWRq.AZgmqS2szxU9PJRYJpVorDMd16NgOBm', 'guru', NULL, '2026-07-06 06:23:48', '2026-07-06 06:23:48'),
(21, 'Murtini Ningsih, S.Si', 'murtini.ningsih@guru.smansago.com', NULL, '$2y$12$5HE80tmS55VBjgZTDRnZku8vsfMP/ab/407VltZDPpHhElOD5nEQC', 'guru', NULL, '2026-07-06 06:23:49', '2026-07-06 06:23:49'),
(22, 'Oryza Hesak Karismaningtyas, S.Pd', 'oryza.karismaningtyas@guru.smansago.com', NULL, '$2y$12$iR0vaISSoMev.GB.JGqvyeBgLOa4judtJn9LBeKtRKWKuR6DV2pLm', 'guru', NULL, '2026-07-06 06:23:49', '2026-07-06 06:23:49'),
(23, 'Puput Rika Harjani, S.Pd', 'puput.harjani@guru.smansago.com', NULL, '$2y$12$2jD2TYdm242qQh/yS.nK.ePsWtJH39x3FB0dmrvGYqV8WWYAh.DsG', 'guru', NULL, '2026-07-06 06:23:49', '2026-09-07 16:12:14'),
(24, 'Ratna Suryani, S.Pd', 'ratna.suryani@guru.smansago.com', NULL, '$2y$12$16JdxGo5UjTkr.RRwVA7IOq8UMwzpjYLiBgFiduorJo0a4rlI5gyO', 'guru', NULL, '2026-07-06 06:23:49', '2026-07-06 06:23:49'),
(25, 'Septa Falintina, S.Pd, M.T', 'septa.falintina@guru.smansago.com', NULL, '$2y$12$ofZw0xwuO9sq8DKXYwpLP.5nZKNCS6KXjCUOlwZPLf/9f/eUkWz3u', 'guru', NULL, '2026-07-06 06:23:50', '2026-07-06 06:23:50'),
(26, 'Sri Kundarti, S.Pd', 'sri.kundarti@guru.smansago.com', NULL, '$2y$12$EZhpqYyHU7vW6e4LrYWiXe9GYoKpYY22PVJOTsX4ZmIUApL/ObHFG', 'guru', NULL, '2026-07-06 06:23:50', '2026-07-06 06:23:50'),
(27, 'Sri Widyastuti, S.Pd.I', 'sri.widyastuti@guru.smansago.com', NULL, '$2y$12$ufTXyswjCYEmDFcQM6oh9.qAxCUS/AphEvg9zOGvr61HpQ5OTDOHm', 'guru', NULL, '2026-07-06 06:23:50', '2026-07-06 06:23:50'),
(28, 'Sunarno, S.Pd', 'sunarno@guru.smansago.com', NULL, '$2y$12$ltF5gXDSoFSgaGi4qa7UmOUUg.b3APssanJPNuVznc8TVScEhpxmu', 'guru', NULL, '2026-07-06 06:23:51', '2026-08-18 08:04:09'),
(29, 'Susilawati', 'susilawati@guru.smansago.com', NULL, '$2y$12$4Yya7L5l0ArkvMhELW7UJ.dTLQ.L/P4Eo9YtCe.lvmBH7p64nbefi', 'guru', NULL, '2026-07-06 06:23:51', '2026-09-07 15:24:21'),
(30, 'Syamsudin, S.Pd', 'syamsudin@guru.smansago.com', NULL, '$2y$12$jkS8T8WSK6OEq.rKWyJvJeIywnZcFYICHYeYLYQX655s/gSLxs4XK', 'guru', NULL, '2026-07-06 06:23:51', '2026-07-06 06:23:51'),
(31, 'Teguh, S.Pd', 'teguh@guru.smansago.com', NULL, '$2y$12$s2oBe6PIhiQOeVW1ip4fC.H88ZoKpTcdh5.6.XN.j67pDd454JJh6', 'guru', NULL, '2026-07-06 06:23:51', '2026-07-06 06:23:51'),
(32, 'Tiyastuti Nur Cahyani, S.Pd', 'tiyastuti.cahyani@guru.smansago.com', NULL, '$2y$12$.0./IzqJttyXJ5q/iV9sAuE2yorsRbksPNeQNdAQwe1rlAY79SaZ2', 'guru', NULL, '2026-07-06 06:23:52', '2026-07-06 06:23:52'),
(33, 'Tutik Mahendra Dewi, S.Pd', 'tutik.dewi@guru.smansago.com', NULL, '$2y$12$j8c6i6iGgY8D8Z7VSOJEFekPBn./C.miDBvvJkRYANkM1Jya.H9uK', 'guru', NULL, '2026-07-06 06:23:52', '2026-07-06 06:23:52'),
(34, 'Umi Farichah, S.Pd, M.Pd', 'umi.farichah@guru.smansago.com', NULL, '$2y$12$8ymAafTlxW9A84vA9tptYu/c35HGV9hS8wXflVyN4ZbwwY801/5h2', 'guru', NULL, '2026-07-06 06:23:52', '2026-07-06 06:23:52'),
(35, 'Widodo, S.Pd', 'widodo@guru.smansago.com', NULL, '$2y$12$gw1KVOJx1ntCLBeFc8QQDe56WlLcdx68WWhmW9w/V6X8M66Np3e2q', 'guru', NULL, '2026-07-06 06:23:52', '2026-07-06 06:23:52'),
(36, 'AKRIMA NAYLA AMIRA AGHNI', 'akrima.aghni@siswa.smansago.com', NULL, '$2y$12$eI8xehIvMh3p8OlLTZNVrONzcn5s0M4/Af32FE0gBm6ozDusd4RAq', 'siswa', NULL, '2026-07-06 06:23:53', '2026-09-07 14:21:04'),
(37, 'ANIS PUTRI RAHMADANI', 'anis.rahmadani@siswa.smansago.com', NULL, '$2y$12$bNLWCgLD32W/pli9R5W84ez8Qb1yYJ00YetI8jRNKRHx8xaFjcM9i', 'siswa', NULL, '2026-07-06 06:23:53', '2026-09-07 14:14:01'),
(38, 'ARIF EVAN NUR ROHMAT', 'arif.rohmat@siswa.smansago.com', NULL, '$2y$12$QPq5NcxMxAz1h2RG9Pv21OvZL8m.gozjazMAnG8zZYVJiIZwKtvhS', 'siswa', NULL, '2026-07-06 06:23:53', '2026-09-03 13:43:30'),
(39, 'AULIA AZZAHRA', 'aulia.azzahra@siswa.smansago.com', NULL, '$2y$12$abBTeeU1shldT6cDbkkeuuarwIZsWXNwN8h5XLjGfc0ZXiiYkWbEC', 'siswa', NULL, '2026-07-06 06:23:53', '2026-09-03 13:43:30'),
(40, 'BRILLIANT ATAINA ZULHIJA', 'brilliant.zulhija@siswa.smansago.com', NULL, '$2y$12$LIYedzKkrDquBdCeXQTdjudwAnWppbe.K9yTACqb6ksbaft2.crU.', 'siswa', NULL, '2026-07-06 06:23:54', '2026-09-03 13:43:30'),
(41, 'DEFAN DRIAN RIFAL KANDELA', 'defan.kandela@siswa.smansago.com', NULL, '$2y$12$GiYrOI1M.4iSs2.GAU975OxRXJu/OZfFWG.bQGOXUcCQnjpQiMDvy', 'siswa', NULL, '2026-07-06 06:23:54', '2026-09-03 13:43:30'),
(42, 'DIAN AYUK SETIANINGSIH', 'dian.setianingsih@siswa.smansago.com', NULL, '$2y$12$JBUIOhAKv.YN7TvME4UnGe4XmES1qRO/B2T63OxAwZYSgmXxeHNmq', 'siswa', NULL, '2026-07-06 06:23:54', '2026-09-03 13:43:30'),
(43, 'EKA SELVIANA', 'eka.selviana@siswa.smansago.com', NULL, '$2y$12$0WOHXfoJpBYUZla9xIvrb.R7UjgZnxUp6kAC/fXUNcnvm0uwnHc4m', 'siswa', NULL, '2026-07-06 06:23:54', '2026-09-03 13:43:30'),
(44, 'FADILA ALTHEA UFAIRA PUTRI', 'fadila.putri@siswa.smansago.com', NULL, '$2y$12$ObG7j/Qso3QHn.Q1/bOogOgInBlCn2xo.WOf29YUs7pwJSPpN8x6C', 'siswa', NULL, '2026-07-06 06:23:55', '2026-09-03 13:43:30'),
(45, 'FAREL WAHYU WIBOWO', 'farel.wibowo@siswa.smansago.com', NULL, '$2y$12$S5zic09xoLpzF8VAvo4NsOulo73NndsOI77yQ2a.dLZG7pcE1RXUO', 'siswa', NULL, '2026-07-06 06:23:55', '2026-09-03 13:43:30'),
(46, 'GALANG ADITYA NUGROHO', 'galang.nugroho@siswa.smansago.com', NULL, '$2y$12$V69Ly6SkKVmcyP0ylRVZVOqUgErDLZVJGZGBGFxvI7jVoyf/drkLK', 'siswa', NULL, '2026-07-06 06:23:55', '2026-09-03 13:43:30'),
(47, 'GRACIA MAYLLANE PUTRI LEDO', 'gracia.ledo@siswa.smansago.com', NULL, '$2y$12$3I01MA2wF1FlqjL72tnfkeqEjR8I2nu8WQqYM0a.Q3xLMYtWAIGfi', 'siswa', NULL, '2026-07-06 06:23:55', '2026-09-03 13:43:30'),
(48, 'INDRIYANI WIDIASTUTI', 'indriyani.widiastuti@siswa.smansago.com', NULL, '$2y$12$bsgXNfMupE.ujcKDR/vtcuAfjrSSNsGky2ITy1UOGN3QWTEEb.1ey', 'siswa', NULL, '2026-07-06 06:23:56', '2026-09-03 13:43:30'),
(49, 'IRSYAD ADI RINAWAN', 'irsyad.rinawan@siswa.smansago.com', NULL, '$2y$12$4DN39KlPWksvLURqg3/BR.AK3Vzh4lMVNrmlXYj7/DPwhGbiMAngS', 'siswa', NULL, '2026-07-06 06:23:56', '2026-09-03 13:43:30'),
(50, 'KHANZA LATIFAH', 'khanza.latifah@siswa.smansago.com', NULL, '$2y$12$c211WbLGSOZbuEbksUbBwuNBVf9999s/ZPbqP./q7UShZLUvGI27i', 'siswa', NULL, '2026-07-06 06:23:56', '2026-09-03 13:43:30'),
(51, 'LILYANA MELINDA ELMER', 'lilyana.elmer@siswa.smansago.com', NULL, '$2y$12$DKsq4mdTh4wCLtAnL0Aja.qOuOLj8xsShQiNVTlIGE0TBPA8L.cSi', 'siswa', NULL, '2026-07-06 06:23:56', '2026-09-03 13:43:30'),
(52, 'LUTHFI KAMIL JIBRAN', 'luthfi.jibran@siswa.smansago.com', NULL, '$2y$12$fkQSub4LcJ1slNYdLlOsXOOeAwUrJC4oBnVBOyBvfCAiXgxpTfL1u', 'siswa', NULL, '2026-07-06 06:23:56', '2026-09-03 13:43:30'),
(53, 'MUHAMMAD BURHANUDIN HIBATULLOH', 'muhammad.hibatulloh@siswa.smansago.com', NULL, '$2y$12$weGFkwkQKla3HUbTGSBV.eWnOiLOh7z4DIMojJdFwlh.lma2vF9ZW', 'siswa', NULL, '2026-07-06 06:23:57', '2026-09-03 13:43:30'),
(54, 'Nanda Yusuf Prakoso', 'nanda.prakoso@siswa.smansago.com', NULL, '$2y$12$vyowIgwV.pZ.sqg8hCni4e66kyBH9H4ytE6NtIDw8JMNkM2hdbvwa', 'siswa', NULL, '2026-07-06 06:23:57', '2026-09-03 13:43:30'),
(55, 'NATHAN YOGA PRATAMA', 'nathan.pratama@siswa.smansago.com', NULL, '$2y$12$I/gP99IOPdqyCJ2lolP8z.wQw19PkNPtGDQGFNvvuSQmjQGBih09q', 'siswa', NULL, '2026-07-06 06:23:57', '2026-09-03 13:43:30'),
(56, 'NAURA SYAFA', 'naura.syafa@siswa.smansago.com', NULL, '$2y$12$ivAG.JCGAKPtOm9hmLHC/efmXJLXdIBo/VZjUTwSpkfzhxyfYQj56', 'siswa', NULL, '2026-07-06 06:23:57', '2026-09-03 13:43:30'),
(57, 'Novita Rokhim Mawati', 'novita.mawati@siswa.smansago.com', NULL, '$2y$12$.0l2UtnMWR8GN0.tuM2NcO78RqHU5etvrAUA3G0pzIjBSDmK5Vrte', 'siswa', NULL, '2026-07-06 06:23:58', '2026-09-03 13:43:30'),
(58, 'PURWANINGSIH', 'purwaningsih@siswa.smansago.com', NULL, '$2y$12$iRkSDhhSNwYKMRnwc6Uwnu2fRcetYIpQX1JBqzCs8kPM6W6SjFkj6', 'siswa', NULL, '2026-07-06 06:23:58', '2026-09-03 13:43:30'),
(59, 'RAIF BANU FAIRUZ', 'raif.fairuz@siswa.smansago.com', NULL, '$2y$12$0MTVANWmcz59aVHkZOhvPuhNpAjnjHzKPDNMDrX8A7tvC1dIrhOSq', 'siswa', NULL, '2026-07-06 06:23:58', '2026-09-03 13:43:30'),
(60, 'RENI OKTAVIA SARI', 'reni.sari@siswa.smansago.com', NULL, '$2y$12$/7MDpn2zYdrCW6QpYLdfOOSID1FIoCHu51ARbqh26NbDLoemMkVFu', 'siswa', NULL, '2026-07-06 06:23:58', '2026-09-03 13:43:30'),
(61, 'RISMA NUR KHASANAH', 'risma.khasanah@siswa.smansago.com', NULL, '$2y$12$5Ur9g4w5b8513JmZ7Ge7b.LISl3.89uxyU5o.n7DPciAH2jncnJOe', 'siswa', NULL, '2026-07-06 06:23:58', '2026-09-03 13:43:30'),
(62, 'ROKHIM MAHESTI', 'rokhim.mahesti@siswa.smansago.com', NULL, '$2y$12$NRyAqCY8smwWEVcxQGcPlOFtAWWb0OECwxULG8ak/BafucuIpYlpG', 'siswa', NULL, '2026-07-06 06:23:59', '2026-09-03 13:43:30'),
(63, 'SEAN CAROLINE VALENTINE BAETRICE', 'sean.baetrice@siswa.smansago.com', NULL, '$2y$12$l/GXXjKjjZG8E0juvl8mt.pj4/x2FkPGbRdQXkJlZQGbkHfhFUGVm', 'siswa', NULL, '2026-07-06 06:23:59', '2026-09-03 13:43:30'),
(64, 'SEVI LEVIAN GRAFISI', 'sevi.grafisi@siswa.smansago.com', NULL, '$2y$12$H9vB/eqUMwlyYj.YiSag4Oh9cz4Cqdelu4KBpfcWCgo7HPS4pP/3i', 'siswa', NULL, '2026-07-06 06:23:59', '2026-09-03 13:43:30'),
(65, 'SULISTYANI MASRUROH', 'sulistyani.masruroh@siswa.smansago.com', NULL, '$2y$12$41.cZtEORNQ11Tckx.3VxeBRSYSRRmYnKcZXotBgIF4xJWyugkzVS', 'siswa', NULL, '2026-07-06 06:23:59', '2026-09-03 13:43:30'),
(66, 'SYARIF HIDAYATULLOH', 'syarif.hidayatulloh@siswa.smansago.com', NULL, '$2y$12$EmO8e903.mxcNrB5UDdSHO6snMg4OfdR1RZ4IeFzxHehctPa/TcW.', 'siswa', NULL, '2026-07-06 06:24:00', '2026-09-03 13:43:30'),
(67, 'TRI NOFIYANTI', 'tri.nofiyanti@siswa.smansago.com', NULL, '$2y$12$X4gaGX1aG7LzZgXjLv57Z.TWG70qY8tpPVj4evYy6vICt0dTcX.Ie', 'siswa', NULL, '2026-07-06 06:24:00', '2026-09-03 13:43:30'),
(68, 'WAHYU OKTAVIA LESTARI', 'wahyu.lestari@siswa.smansago.com', NULL, '$2y$12$FbBS66EcuCpnMVvOtDhx5uCAfYJJdaHZ5di4nPTE33UDNTapdFn6q', 'siswa', NULL, '2026-07-06 06:24:00', '2026-09-03 13:43:30'),
(69, 'WIDIYANTO', 'widiyanto@siswa.smansago.com', NULL, '$2y$12$V1/.ykTLQA1W7AXtCeuStOuLBpAs.LLjPyhsjI6cDg1kwoHn8H1X.', 'siswa', NULL, '2026-07-06 06:24:00', '2026-09-03 13:43:30'),
(70, 'Yoris Arya Rahmadan', 'yoris.rahmadan@siswa.smansago.com', NULL, '$2y$12$JkHEN6GdpYkVz6YxR/sGiOuAVo7Pp7JLzgSYUSlnLV2fFr7b.ruHW', 'siswa', NULL, '2026-07-06 06:24:01', '2026-09-03 13:43:30'),
(71, 'YUNI RAHMAWATI', 'yuni.rahmawati@siswa.smansago.com', NULL, '$2y$12$OzSsbfarQLT1yeqYhGqA.uJN/PRULK7HqYUN6/bHlDFNRbGhJHfLS', 'siswa', NULL, '2026-07-06 06:24:01', '2026-09-03 13:43:30'),
(72, 'ADITYA DWI PUTRA', 'aditya.putra@siswa.smansago.com', NULL, '$2y$12$xZftQeo8YAwnRF93zYYNpuha0F7LYu6Q4G6DbXR4pjN9gbgF3ydmG', 'siswa', NULL, '2026-07-06 06:24:01', '2026-09-03 13:43:30'),
(73, 'Afiqah Ocktavi Wahyunia', 'afiqah.wahyunia@siswa.smansago.com', NULL, '$2y$12$IXcbVPgUASMt2S.MwHM5L..4tJyRoZGeNnpt0Qt2Flf9PTz89gYLa', 'siswa', NULL, '2026-07-06 06:24:01', '2026-09-03 13:43:30'),
(74, 'ALFIFAH ADYSTIA NURNANINGSIH', 'alfifah.nurnaningsih@siswa.smansago.com', NULL, '$2y$12$MSMAI9DCLiE4H3sRjC9ztumPKd/BiJxb7yeKnoS8U6KlC9gapYqzq', 'siswa', NULL, '2026-07-06 06:24:02', '2026-09-03 13:43:30'),
(75, 'ALVI AINURROZIQIN', 'alvi.ainurroziqin@siswa.smansago.com', NULL, '$2y$12$2nyAO2tsh7P/Bi5.elTg3OBMNzf..xM4fIw30pFVZonLmcKVvoBf.', 'siswa', NULL, '2026-07-06 06:24:02', '2026-09-03 13:43:30'),
(76, 'ANISA AUFA ABIBATUL AZIZAH', 'anisa.azizah@siswa.smansago.com', NULL, '$2y$12$bX4kHeIlaX5pbhXvrcdCqOvcyZG/nDaN5qVUvJ3cD1edoFlWhDTRq', 'siswa', NULL, '2026-07-06 06:24:02', '2026-09-03 13:43:30'),
(77, 'AULIA ISTIQOMAH', 'aulia.istiqomah@siswa.smansago.com', NULL, '$2y$12$gHanuDWp7xKlbQu.W7KToeMXnTqLr7kcFPGodYJuTtdTi7GlOYx7m', 'siswa', NULL, '2026-07-06 06:24:02', '2026-09-03 13:43:30'),
(78, 'BAGUS RIVAI', 'bagus.rivai@siswa.smansago.com', NULL, '$2y$12$3KalMJtUcL31gCFY.Oot3.72BoNBb4JLgzGSAxnhSyh/nLnkhcUIW', 'siswa', NULL, '2026-07-06 06:24:03', '2026-09-03 13:43:30'),
(79, 'CALISTA SALMA MAHESWARI', 'calista.maheswari@siswa.smansago.com', NULL, '$2y$12$Rl1x05JXCahkrhMYQPHL4uHW.FO.Fs0sHMukDnjnkJYcl/q3/xKL2', 'siswa', NULL, '2026-07-06 06:24:03', '2026-09-03 13:43:30'),
(80, 'DENIS ABI SETIAWAN', 'denis.setiawan@siswa.smansago.com', NULL, '$2y$12$U3190nKAzALkeckxdbRkmeGs1TFhTc3UoMlI.gGnAVJPhBtchyvXq', 'siswa', NULL, '2026-07-06 06:24:03', '2026-09-03 13:43:30'),
(81, 'DIAN FATMAH AINU ROHMAH', 'dian.rohmah@siswa.smansago.com', NULL, '$2y$12$NU5BrdRl1Hs.83TdIZCF9uSOQEHn9bA96dsJ3PoIsvvTr5IsTOS3C', 'siswa', NULL, '2026-07-06 06:24:03', '2026-09-03 13:43:30'),
(82, 'EKA WULAN RAMADHANI', 'eka.ramadhani@siswa.smansago.com', NULL, '$2y$12$qgJiY9nPxElEncfVaDznie2eniVs4a8ZtBA9V4YVrJFJ5TA/j.h7y', 'siswa', NULL, '2026-07-06 06:24:04', '2026-09-03 13:43:30'),
(83, 'Faisya Ramadani', 'faisya.ramadani@siswa.smansago.com', NULL, '$2y$12$nhjQ1qzFTP8hlrsa5PjDPu5BYUOH3wjvY5vfwFMztu0c/rqifRVse', 'siswa', NULL, '2026-07-06 06:24:04', '2026-09-03 13:43:30'),
(84, 'Farhan Zaki Fahrezy', 'farhan.fahrezy@siswa.smansago.com', NULL, '$2y$12$qvi0DJE6i1CGk/k9A20CeeA5NLKTBIc/xg/.tyJwxH/RPMOrBl5gy', 'siswa', NULL, '2026-07-06 06:24:04', '2026-09-03 13:43:30'),
(85, 'GALIH PRATITIS WULANDRI UTOMO', 'galih.utomo@siswa.smansago.com', NULL, '$2y$12$lZ8uamy6LCQpUN/GWYahlOzo/GbSBIznYZRZzDXol2TVZUx4gkBmq', 'siswa', NULL, '2026-07-06 06:24:04', '2026-09-03 13:43:30'),
(86, 'GILDA CELLYN MAGDALENA', 'gilda.magdalena@siswa.smansago.com', NULL, '$2y$12$mmRK3JVUpvJmADCIS2Ut4u94ChAI1barOJhpoGBOQNqPy5MijwPze', 'siswa', NULL, '2026-07-06 06:24:05', '2026-09-03 13:43:30'),
(87, 'ISNAN NUR ARIFIN', 'isnan.arifin@siswa.smansago.com', NULL, '$2y$12$vDHNwDwFQ7WNPXyQDqMhiu6FXFGqfPtzqwWCP3wk1vZ8P0uanlZyq', 'siswa', NULL, '2026-07-06 06:24:05', '2026-09-03 13:43:30'),
(88, 'JHUHRIA FEBRIANA', 'jhuhria.febriana@siswa.smansago.com', NULL, '$2y$12$48sIL9NP9BWw9eqGsdnws.Tek/eATu.pmy7rhYRqJr036CFSBvYVS', 'siswa', NULL, '2026-07-06 06:24:05', '2026-09-03 13:43:30'),
(89, 'KIRANA NOVITASARI', 'kirana.novitasari@siswa.smansago.com', NULL, '$2y$12$l40ym1p9aeWQjoD2ZM6FieKxRaugKOvwdEIKuDaafPTBnJPYnjXOK', 'siswa', NULL, '2026-07-06 06:24:05', '2026-09-03 13:43:30'),
(90, 'LINTANG FAJAR WATI', 'lintang.wati@siswa.smansago.com', NULL, '$2y$12$DhsQa0xr7P0jmfLC9uiesOqVkMAij4PxyCZiUC1dduPwB9LmhQcCK', 'siswa', NULL, '2026-07-06 06:24:06', '2026-09-03 13:43:30'),
(91, 'MASSYAHRIL ARBA MAULANA', 'massyahril.maulana@siswa.smansago.com', NULL, '$2y$12$ez97s1AFPsWKg1JTT36/geSy4XWE7oa4tGPh29tRUnKnr5.sEn34C', 'siswa', NULL, '2026-07-06 06:24:06', '2026-09-03 13:43:30'),
(92, 'MUHAMMAD DIMAS AGUNG NUGROHO', 'muhammad.nugroho@siswa.smansago.com', NULL, '$2y$12$uU1XSgyWav.fjuuHDKBgT.pys5WpyAgWXoBIy.ErTsjDwCsbmvnn6', 'siswa', NULL, '2026-07-06 06:24:06', '2026-09-03 13:43:30'),
(93, 'NAYLA AZ ZAHRA', 'nayla.zahra@siswa.smansago.com', NULL, '$2y$12$v9wSA68xQ9P6eMDX9iVsG.CROM1.sFMKziezRZhDYyHDh5wuUTYjK', 'siswa', NULL, '2026-07-06 06:24:06', '2026-09-03 13:43:30'),
(94, 'NAZA AKMAL FAIRIZUAN', 'naza.fairizuan@siswa.smansago.com', NULL, '$2y$12$mOmF.QkFtJpmLbHq8Na/MOm4Jq4tGYIc3qLya.0pj2enrZCsvvvvO', 'siswa', NULL, '2026-07-06 06:24:07', '2026-09-03 13:43:30'),
(95, 'NUR AINA SANIYAH QOLBI', 'nur.qolbi@siswa.smansago.com', NULL, '$2y$12$Bl6ZNWSfGgmaX7YRKGz6w.iMsPLsaKTOWeXT/lFhmpM1Uzs8nyRKu', 'siswa', NULL, '2026-07-06 06:24:07', '2026-09-03 13:43:30'),
(96, 'PUTRI MAULIDA', 'putri.maulida@siswa.smansago.com', NULL, '$2y$12$/gszuzPoZAldnE0/aT.40.1uTQfMaaW3V020NPOVZt9TwM//HDxCO', 'siswa', NULL, '2026-07-06 06:24:07', '2026-09-03 13:43:30'),
(97, 'RAKA RISANNJANA', 'raka.risannjana@siswa.smansago.com', NULL, '$2y$12$.0M4nlFB6RoINtdVOon/.Otzs5PtbJCMWhVbFJAay3C.ifc/uQV5C', 'siswa', NULL, '2026-07-06 06:24:08', '2026-09-03 13:43:30'),
(98, 'RINA HANDAYANI', 'rina.handayani@siswa.smansago.com', NULL, '$2y$12$/wFaCz.rFqTiiFhxtWyE7u3w7C6U1NMcE//kgptM1Gsdx/wpCUR8K', 'siswa', NULL, '2026-07-06 06:24:08', '2026-09-03 13:43:30'),
(99, 'RONI OKTAVIAN', 'roni.oktavian@siswa.smansago.com', NULL, '$2y$12$1oc9tJScwQ1ehvRkgMooPegASpVQu4rImGDREWTGtxbh4HixzT1Qe', 'siswa', NULL, '2026-07-06 06:24:08', '2026-09-03 13:43:30'),
(100, 'Salsa Nabila Dwi Aryanti', 'salsa.aryanti@siswa.smansago.com', NULL, '$2y$12$Q23PpFXUR/qi3HNVdpTGFeglTfFMUcQEXq0yaMh9IPiC75aeyiLfG', 'siswa', NULL, '2026-07-06 06:24:08', '2026-09-03 13:43:30'),
(101, 'Septiyana Ramadani', 'septiyana.ramadani@siswa.smansago.com', NULL, '$2y$12$/aazY7P7BejhlxHhw03aq.fBQEWzclset1aWbc95T4Ylx7o4dJvo6', 'siswa', NULL, '2026-07-06 06:24:09', '2026-09-03 13:43:30'),
(102, 'SITI ROHANI', 'siti.rohani@siswa.smansago.com', NULL, '$2y$12$JxkGvJ/io4ldtGgDydf1Z.I/7dg33EQKf1Pxt.SZtDIYwsEYHDNri', 'siswa', NULL, '2026-07-06 06:24:09', '2026-09-03 13:43:30'),
(103, 'SYAFA MUFIDA AZ-ZAHRA', 'syafa.azzahra@siswa.smansago.com', NULL, '$2y$12$.QcjUGdlK1lEhYbqRir.versQAEQOuLd62wQ12.VbDwk5jOdel5qW', 'siswa', NULL, '2026-07-06 06:24:09', '2026-09-03 13:43:30'),
(104, 'TRI WAHYU NOVIANA', 'tri.noviana@siswa.smansago.com', NULL, '$2y$12$0q90VH7TNCcj0UW9ngiuFuPH6uEdUqPAHf39EoFxZPTCAkDKKbvvG', 'siswa', NULL, '2026-07-06 06:24:09', '2026-09-03 13:43:30'),
(105, 'TRI WAHYU NOVIANI', 'tri.noviani@siswa.smansago.com', NULL, '$2y$12$zYra7yb9bwWIv8gCLdY.bugKRFw08EzopM2BN6ItoG1Gw9elc0jma', 'siswa', NULL, '2026-07-06 06:24:10', '2026-09-03 13:43:30'),
(106, 'WAHYU WALIMATUL KHOLIFAH', 'wahyu.kholifah@siswa.smansago.com', NULL, '$2y$12$OsCmeryEwAv67AwU8tOyC.A386rwkQaLqSQMpEdDIR3kWsHL/4w6q', 'siswa', NULL, '2026-07-06 06:24:10', '2026-09-03 13:43:30'),
(107, 'YUNIA RIZKI ANISA', 'yunia.anisa@siswa.smansago.com', NULL, '$2y$12$MpmsyzI52GRd.87cetbVkes1JqNXlb/OQUBrONK9yjMKmC0wEqiSe', 'siswa', NULL, '2026-07-06 06:24:10', '2026-09-03 13:43:30'),
(108, 'ABIZAH DEVANA HAFSARI', 'abizah.hafsari@siswa.smansago.com', NULL, '$2y$12$LPAndo0hrzZg0CxE5jongOsPOCnYMIAih7P35yEo.zkSOaDfYpSDq', 'siswa', NULL, '2026-07-06 06:24:10', '2026-09-03 13:43:30'),
(109, 'ALANA JUAN REVANO', 'alana.revano@siswa.smansago.com', NULL, '$2y$12$iWFr3QscEHBGX4dt2MuSsOZvEv6mmBDhjH8mozNiKh4tW5fIQhFJS', 'siswa', NULL, '2026-07-06 06:24:11', '2026-09-03 13:43:30'),
(110, 'ALIF CAHYA SETYANI', 'alif.setyani@siswa.smansago.com', NULL, '$2y$12$aV0xHvmT4pF7VJHa6GAVFOfwnq3wI3oJeQyjYW8Yk35GlKiIapvyK', 'siswa', NULL, '2026-07-06 06:24:11', '2026-09-03 13:43:30'),
(111, 'ALVIN FEBRIYANSAH', 'alvin.febriyansah@siswa.smansago.com', NULL, '$2y$12$MH0.Nw/lRadsrQVNEknTV.FSeqSOWqc3m4dxDCAoTGYymR.MTnTMy', 'siswa', NULL, '2026-07-06 06:24:11', '2026-09-03 13:43:30'),
(112, 'ANISA FEBRIYANA', 'anisa.febriyana@siswa.smansago.com', NULL, '$2y$12$DCVz.mlyM3DTPRSl6Np8SuJ2b2AKV.8RD7rUzi76vNfZ8vevCgkBK', 'siswa', NULL, '2026-07-06 06:24:11', '2026-09-03 13:43:30'),
(113, 'AULIA NUR RISKI', 'aulia.riski@siswa.smansago.com', NULL, '$2y$12$yhD9OtNEcc4qmW6ASlbHdesUZbZmxaQVkq9t8fSB7K5P8KBMTLvAe', 'siswa', NULL, '2026-07-06 06:24:11', '2026-09-03 13:43:30'),
(114, 'BAYU BAGUS LASTYADI', 'bayu.lastyadi@siswa.smansago.com', NULL, '$2y$12$cUeyLPoX2zaVEVDrkdvnw.oxE887WJ9YRiZWu50mFdwR9oPKlouyO', 'siswa', NULL, '2026-07-06 06:24:12', '2026-09-03 13:43:30'),
(115, 'CHALILA NISRIN DEWANTI', 'chalila.dewanti@siswa.smansago.com', NULL, '$2y$12$7OpScd.c/jKdZWeiNCh0HupAwMP5TntTwMFDh4.sPh6JpdvEZFbCe', 'siswa', NULL, '2026-07-06 06:24:12', '2026-09-03 13:43:30'),
(116, 'DIKI PRAMANA', 'diki.pramana@siswa.smansago.com', NULL, '$2y$12$ftWr/cP2WOHQU5UGjhbaPOuWlHAL6z5HGFiHugDZShmqzNDbWaL3i', 'siswa', NULL, '2026-07-06 06:24:12', '2026-09-03 13:43:30'),
(117, 'DINI INDAH AULIA', 'dini.aulia@siswa.smansago.com', NULL, '$2y$12$OmQ9IlLAarSs8RgIIB94B.U1IaH4Tmte9yYmh4sbWOxvmd/OYEiTO', 'siswa', NULL, '2026-07-06 06:24:12', '2026-09-03 13:43:30'),
(118, 'ELSA DEMAWATI', 'elsa.demawati@siswa.smansago.com', NULL, '$2y$12$1TfyxXq62189NOmIzMOz6.9.frNxAqNlOgKuvG/5EVTJPMuU/zGru', 'siswa', NULL, '2026-07-06 06:24:13', '2026-09-03 13:43:30'),
(119, 'FARA AYU DITA', 'fara.dita@siswa.smansago.com', NULL, '$2y$12$G/BtTCe7Xyex3iLydAg9Xu0PoYtOXwJqBVgvggxatfBq3Qj/0tXDm', 'siswa', NULL, '2026-07-06 06:24:13', '2026-09-03 13:43:30'),
(120, 'FARIS NAZHRIL ILHAM PRATAMA', 'faris.pratama@siswa.smansago.com', NULL, '$2y$12$iiDc0cRijnXlfloaPZTsxObdRvcfUVsaqIWGncekt96zusFAlSSBK', 'siswa', NULL, '2026-07-06 06:24:13', '2026-09-03 13:43:30'),
(121, 'HABIBAH SYAFA FAUZIAH', 'habibah.fauziah@siswa.smansago.com', NULL, '$2y$12$/AIv6tsw/OQqXKOZ81ahqeXiuSCD3iFL49L4/a29NUI5s62bz4gDK', 'siswa', NULL, '2026-07-06 06:24:13', '2026-09-03 13:43:30'),
(122, 'HAFIDZ MUHAMMAD IRFAN', 'hafidz.irfan@siswa.smansago.com', NULL, '$2y$12$Wt4yNiNh0ZHHNtpH7GZF1uuzj1LXyh/d.iB.7DPTcB61LCaj657bC', 'siswa', NULL, '2026-07-06 06:24:13', '2026-09-03 13:43:30'),
(123, 'INTAN NUR AISYAH', 'intan.aisyah@siswa.smansago.com', NULL, '$2y$12$6ASC9FOEBMwtrPrXPi6pRe8NRckLDgrqo47qeSOtImkWhpVF7uKBa', 'siswa', NULL, '2026-07-06 06:24:14', '2026-09-03 13:43:30'),
(124, 'JAVERA RASHIF TRISTANDIKA', 'javera.tristandika@siswa.smansago.com', NULL, '$2y$12$6irLjcJvVTUPYHqybZOH2.kUE5ND2H.MLYK9Nc1eDCQqntO75Hug6', 'siswa', NULL, '2026-07-06 06:24:14', '2026-09-03 13:43:30'),
(125, 'KALISA REGINA PUTRI', 'kalisa.putri@siswa.smansago.com', NULL, '$2y$12$0lMLQhsYFA/vzdr7EZG0WOAuoJoGYlnNw8BEksZy.eBIAPqugQFs6', 'siswa', NULL, '2026-07-06 06:24:14', '2026-09-03 13:43:30'),
(126, 'LUTFI AULIA RAMADHANI', 'lutfi.ramadhani@siswa.smansago.com', NULL, '$2y$12$jo98/sfwFrxNcF0UraL1EuYRCB3gl6qEiF2cTFYtLVLIMAANxrZEe', 'siswa', NULL, '2026-07-06 06:24:14', '2026-09-03 13:43:30'),
(127, 'MAULANA SATRIA SAPUTRA', 'maulana.saputra@siswa.smansago.com', NULL, '$2y$12$pN71W0xfam8E19siS/5OfO9GQT.sAAIr210XM35iE8c5DroNUt9iO', 'siswa', NULL, '2026-07-06 06:24:15', '2026-09-03 13:43:30'),
(128, 'MUHAMMAD FAISAL ABIDIN', 'muhammad.abidin@siswa.smansago.com', NULL, '$2y$12$4TrifDVXq/iqk5/O8GmeWeOyjl8QhMU.ZzVNSAfDg.7eXjwyUOY0q', 'siswa', NULL, '2026-07-06 06:24:15', '2026-09-03 13:43:30'),
(129, 'NAYLA WAHYU LESTARI', 'nayla.lestari@siswa.smansago.com', NULL, '$2y$12$0YBVHOTrzj4ZUhFZPmrJJeY6Izg2n2xU88SJ6SOE5tvXYcg8PWv/6', 'siswa', NULL, '2026-07-06 06:24:15', '2026-09-03 13:43:30'),
(130, 'NICO FANDEZTA PRATAMA', 'nico.pratama@siswa.smansago.com', NULL, '$2y$12$BBSfj4geYIbqeI6zbCgPV.OkH3EAsD71GwI7lBmesoa/4YWo2K1v6', 'siswa', NULL, '2026-07-06 06:24:15', '2026-09-03 13:43:30'),
(131, 'NUR SHOLIKAH', 'nur.sholikah@siswa.smansago.com', NULL, '$2y$12$hy0RZvHXzVjKL4WBMfVGreKSsoiA6DHfZyLldOH8KvZsg7z5GXaNq', 'siswa', NULL, '2026-07-06 06:24:16', '2026-09-03 13:43:30'),
(132, 'Putri Nur Sholekha', 'putri.sholekha@siswa.smansago.com', NULL, '$2y$12$uJn6hT5cssDUQhK.55VgXuwyF2otmZtbqE.w3k8Vv8Xk18j6mYQLC', 'siswa', NULL, '2026-07-06 06:24:16', '2026-09-03 13:43:30'),
(133, 'RAVI ALFATAH', 'ravi.alfatah@siswa.smansago.com', NULL, '$2y$12$QRQ1FILhtE793eWj4Kvnz.H/5gpnYtbkKeW6q5U2IKXt6GYnhpWYi', 'siswa', NULL, '2026-07-06 06:24:16', '2026-09-03 13:43:30'),
(134, 'RINDU MUGI LESTARI', 'rindu.lestari@siswa.smansago.com', NULL, '$2y$12$4JofnsA5kJirOTtCuPT4SOWGzld5wjGiIeKkEWkl1rAU89QNQTlbK', 'siswa', NULL, '2026-07-06 06:24:16', '2026-09-03 13:43:30'),
(135, 'SAIFUL BAHRI', 'saiful.bahri@siswa.smansago.com', NULL, '$2y$12$r2SC7Wrf9sjoODjDjZAMX.vWzAoQG1I12KH.VjrfXuvGhP7Gnrt7i', 'siswa', NULL, '2026-07-06 06:24:17', '2026-09-03 13:43:30'),
(136, 'SALWA AURA SAFITRI', 'salwa.safitri@siswa.smansago.com', NULL, '$2y$12$TN7gOmOnbiW19POWp9BnFOG3eInVRnIBphSNnHomW91iL9q9Y1MN6', 'siswa', NULL, '2026-07-06 06:24:17', '2026-09-03 13:43:30'),
(137, 'SHELA ARINI FAUZIYAH', 'shela.fauziyah@siswa.smansago.com', NULL, '$2y$12$LaO96xns.hVsirELC/e4a.vpcCgQn.dygMrnJ30p1fT709dWGZY2i', 'siswa', NULL, '2026-07-06 06:24:17', '2026-09-03 13:43:30'),
(138, 'SOFIANA NOVITA SARI', 'sofiana.sari@siswa.smansago.com', NULL, '$2y$12$HdlT8KJyqpK6HbkCeRqM9ev4k2fXlrxLgYKCS5MBaX.cx5p7MVu26', 'siswa', NULL, '2026-07-06 06:24:17', '2026-09-03 13:43:30'),
(139, 'SYAFINA FEBRIASTUTI', 'syafina.febriastuti@siswa.smansago.com', NULL, '$2y$12$EWIdqGRHfkD9ql0huUx/Q.hYWxIyPc7B/vlEBia.9DVkrRF6Z9mXe', 'siswa', NULL, '2026-07-06 06:24:17', '2026-09-03 13:43:30'),
(140, 'TAHTA ANDHIKA SETYAWAN', 'tahta.setyawan@siswa.smansago.com', NULL, '$2y$12$2UQLEeKD7mW9KFD8eCiJpuTx9jFDvod90Fgk.qZ0TJQcV3ZMJws86', 'siswa', NULL, '2026-07-06 06:24:18', '2026-09-03 13:43:30'),
(141, 'TOMY KURNIAWAN', 'tomy.kurniawan@siswa.smansago.com', NULL, '$2y$12$pJ0XIku7B8EYDoD2smqEH.3cLKXtrT9jCFF/d89GWoBrwE6nZVS4i', 'siswa', NULL, '2026-07-06 06:24:18', '2026-09-03 13:43:30'),
(142, 'WINDI FATIKA KHASANAH', 'windi.khasanah@siswa.smansago.com', NULL, '$2y$12$mzDmifnhAYICCOqrW1LW7estQRfsgahlHjwVag5vB6qEmCWxYW2dG', 'siswa', NULL, '2026-07-06 06:24:18', '2026-09-03 13:43:30'),
(143, 'ZAHRA FAJRINA', 'zahra.fajrina@siswa.smansago.com', NULL, '$2y$12$hypvLDmrEQD.TPMES3C13ufgI3g2QtauQUnowycJVroAYcmGviwyu', 'siswa', NULL, '2026-07-06 06:24:18', '2026-09-03 13:43:30'),
(144, 'AFISAH MAHARANI', 'afisah.maharani@siswa.smansago.com', NULL, '$2y$12$XoSd1f/BOmTeKaIYNO/3P.GL7BdDa/qaxIue4PR9ImdFquOvzNNLi', 'siswa', NULL, '2026-07-06 06:24:19', '2026-09-03 13:43:30'),
(145, 'ALFANO DWI HANDIKA', 'alfano.handika@siswa.smansago.com', NULL, '$2y$12$FajFLW9szGg/hNcmab0RgOrpdw/DyAj98dhTt4hnMCRyrCn0LHFJu', 'siswa', NULL, '2026-07-06 06:24:19', '2026-09-03 13:43:30'),
(146, 'ALINDA BRILIAN TIKA DEWI', 'alinda.dewi@siswa.smansago.com', NULL, '$2y$12$EhwFgpUXl5ikBnuzUvFOg.BpZbNBg/wbrWWR7cFAYuz8/KUfeXTga', 'siswa', NULL, '2026-07-06 06:24:19', '2026-09-03 13:43:30'),
(147, 'Andante Arga Yudhistira Prabowo', 'andante.prabowo@siswa.smansago.com', NULL, '$2y$12$JKUZZCW1J2g8hbctrALzueRpSWuw2Kyb2sFk34nDJs8ziQsOHvXpy', 'siswa', NULL, '2026-07-06 06:24:19', '2026-09-03 13:43:30'),
(148, 'ANNIS EKA ARIYANI', 'annis.ariyani@siswa.smansago.com', NULL, '$2y$12$GuHfMWpXBeygEHIFh.7C0.I/Vhrk6EjXQzzkn7j3a4dTNgNrPET2u', 'siswa', NULL, '2026-07-06 06:24:20', '2026-09-03 13:43:30'),
(149, 'AULIA RAFI QURROHMAN', 'aulia.qurrohman@siswa.smansago.com', NULL, '$2y$12$joVZ5obUJaFlClMYW75dJu7ZMlilvG8SsHNgpqSnP53xBOWDQ2moG', 'siswa', NULL, '2026-07-06 06:24:20', '2026-09-03 13:43:30'),
(150, 'BAYU JATI ANGKOSO', 'bayu.angkoso@siswa.smansago.com', NULL, '$2y$12$tz1VxutEQSnQjjR.UX4ByOA67s4rkM3yIoeiuehiV5BkSDpeCCqgi', 'siswa', NULL, '2026-07-06 06:24:20', '2026-09-03 13:43:30'),
(151, 'Daimatul Karimah', 'daimatul.karimah@siswa.smansago.com', NULL, '$2y$12$gogTNVdTHZY8v176oN9uKeyUjJy.Kh7SnH0iB94A3ZhmTykv.2Upm', 'siswa', NULL, '2026-07-06 06:24:20', '2026-09-03 13:43:30'),
(152, 'DWI DONI PRABOWO', 'dwi.prabowo@siswa.smansago.com', NULL, '$2y$12$n23Mfc/O.M55KbCbG.nXMumIF7WDtutSKRerStFtYVBM1Vs1A/AaW', 'siswa', NULL, '2026-07-06 06:24:21', '2026-09-03 13:43:30'),
(153, 'DWI KURNIAWAN', 'dwi.kurniawan@siswa.smansago.com', NULL, '$2y$12$WJ6wKY5h4VVal3vpU0ssJ.O7Wo1QAJ0wjubWe2.b/lgLUg8p2rTzS', 'siswa', NULL, '2026-07-06 06:24:21', '2026-09-03 13:43:30'),
(154, 'ENGGAR WAHYUNI', 'enggar.wahyuni@siswa.smansago.com', NULL, '$2y$12$OUGuN3eF..JW0BdNcSBA2uCKzk5znZH4BYWvquvDft39SRToiUS.y', 'siswa', NULL, '2026-07-06 06:24:21', '2026-09-03 13:43:30'),
(155, 'FATAH RAMADHAN AJI SAPUTRA', 'fatah.saputra@siswa.smansago.com', NULL, '$2y$12$iQ5uSRuVqU3CmNgEOrPlS.5VAZ2Ui9D/d3uOq8Q/XFTzhDicfIKA2', 'siswa', NULL, '2026-07-06 06:24:21', '2026-09-03 13:43:30'),
(156, 'FEBRYANA ANGREINY PRANATA', 'febryana.pranata@siswa.smansago.com', NULL, '$2y$12$HfKaAt3mjAOKp3ebR53jwOHW4AXcHlHp1JE/vYUzQ0xfEa3PbmDA.', 'siswa', NULL, '2026-07-06 06:24:22', '2026-09-03 13:43:30'),
(157, 'HANIFAH PUTRI MEILANI', 'hanifah.meilani@siswa.smansago.com', NULL, '$2y$12$XrDs0WPSNjttMSV.dU6ZfuHz4vRg0JrLSJnkHhqyKTuqvnywk63SG', 'siswa', NULL, '2026-07-06 06:24:22', '2026-09-03 13:43:30'),
(158, 'IQBAAL LUQMAN SAPUTRA', 'iqbaal.saputra@siswa.smansago.com', NULL, '$2y$12$lOxtIkBZLgEw3dCFPBJXPuL0GHsN6UsMYlvnHTHf4fmQrrRmBLG2y', 'siswa', NULL, '2026-07-06 06:24:22', '2026-09-03 13:43:30'),
(159, 'JAYANUDIN PURNA MURTI', 'jayanudin.murti@siswa.smansago.com', NULL, '$2y$12$lMWEHtB6auLkvtEGdY5J/eQJVEtqH1mqs1p7MQkzfQJwdmuIqOngu', 'siswa', NULL, '2026-07-06 06:24:22', '2026-09-03 13:43:30'),
(160, 'KAYLA NUR ADILLA', 'kayla.adilla@siswa.smansago.com', NULL, '$2y$12$dICaTCR4jGJa15DOkzqIY.xbyFXhKviQdMkcwpiqaLE3zr5bKdheu', 'siswa', NULL, '2026-07-06 06:24:22', '2026-09-03 13:43:30'),
(161, 'KRISTIANA KURNIAWATI', 'kristiana.kurniawati@siswa.smansago.com', NULL, '$2y$12$pPnpjkmdNj.tJz3N5ameJ.ec.LnPdDDrbMspB5SaziQSXCOA5iEeO', 'siswa', NULL, '2026-07-06 06:24:23', '2026-09-03 13:43:30'),
(162, 'MAYLA NURUL AFIFAH', 'mayla.afifah@siswa.smansago.com', NULL, '$2y$12$VJq2F0f25N7PPeZhxY4EX.SfJODyi6zcfdybU0i63JE7hQfKH7DFy', 'siswa', NULL, '2026-07-06 06:24:23', '2026-09-03 13:43:30'),
(163, 'MUHAMAD AKBAR SALIM', 'muhamad.salim@siswa.smansago.com', NULL, '$2y$12$sfu0lZSs/M.o8xFy54zUSeS2RITN95UBku04Ulk38NIqNO19fiJ0K', 'siswa', NULL, '2026-07-06 06:24:23', '2026-09-03 13:43:30'),
(164, 'MUHAMMAD HABIB LUTHFI', 'muhammad.luthfi@siswa.smansago.com', NULL, '$2y$12$m3x4ockzNje9uAqHzOvCJebGYP2qR32nCzhKgEE/Bz.HLIftQ6yMC', 'siswa', NULL, '2026-07-06 06:24:23', '2026-09-03 13:43:30'),
(165, 'NINA VANIA ZERLINA', 'nina.zerlina@siswa.smansago.com', NULL, '$2y$12$P1tUUaoMRD/i3Y6l/yyeqOLILYjhmrUjzvXh/T6SEdN6qrDQYrdNa', 'siswa', NULL, '2026-07-06 06:24:24', '2026-09-03 13:43:30'),
(166, 'NOVAL RIFKY AFRIANTO', 'noval.afrianto@siswa.smansago.com', NULL, '$2y$12$SsmHdHNdIhtl.igSxQubcOVLXfJ1alHyl...ofAXNBSdKH.KH3RY.', 'siswa', NULL, '2026-07-06 06:24:24', '2026-09-03 13:43:30'),
(167, 'NUR UTAMI', 'nur.utami@siswa.smansago.com', NULL, '$2y$12$cPOe9il5e81LkzWdnhJINOgmn28bGMIM2HEKW5LKKm853Mbs66Dcq', 'siswa', NULL, '2026-07-06 06:24:24', '2026-09-03 13:43:30'),
(168, 'RAIHANNISA PUTRI FITRIANA', 'raihannisa.fitriana@siswa.smansago.com', NULL, '$2y$12$/7N4q.qnvd4GdjNtTCUwNeG3v7vynGr.Bhb9AgVl7U0qIxZVdVhZu', 'siswa', NULL, '2026-07-06 06:24:24', '2026-09-03 13:43:30'),
(169, 'REZA ZAPUTRA', 'reza.zaputra@siswa.smansago.com', NULL, '$2y$12$c0nG7bgcsebs7wggce4d0uFF2HbzwlN2ze0oefc9qpSc/i5.vpIk2', 'siswa', NULL, '2026-07-06 06:24:25', '2026-09-03 13:43:30'),
(170, 'RIRIN DWI PRASETYANI', 'ririn.prasetyani@siswa.smansago.com', NULL, '$2y$12$SQfoqEUad3D90ltDJ2fwxu7zoHJvgzPFOcOHJl//qtraPpuImWR56', 'siswa', NULL, '2026-07-06 06:24:25', '2026-09-03 13:43:30'),
(171, 'SANTI OLIVIA NINGSIH', 'santi.ningsih@siswa.smansago.com', NULL, '$2y$12$LGiBa.ObXJ68/9Ovn/DKjuzi0V09vT5DIU0XNHPbE4uXBEK/8h9G2', 'siswa', NULL, '2026-07-06 06:24:25', '2026-09-03 13:43:30'),
(172, 'SATRIA OCTA CAHYO PUTRO', 'satria.putro@siswa.smansago.com', NULL, '$2y$12$7SijARp/jX.pnRJrQLVgG.AGNWULK1DimYJDvPkCz4Iswsvdo/to6', 'siswa', NULL, '2026-07-06 06:24:25', '2026-09-03 13:43:30'),
(173, 'SHELLYKHA DHANYATULL RIZMA', 'shellykha.rizma@siswa.smansago.com', NULL, '$2y$12$nEp0DTJdrlbVy.1fIp1TJuEvArsLavpHzA18VUXLRN5oR4ep4uSem', 'siswa', NULL, '2026-07-06 06:24:26', '2026-09-03 13:43:30'),
(174, 'SRI MULYANI', 'sri.mulyani@siswa.smansago.com', NULL, '$2y$12$pCh9A6AQyDx88Uf.F.0itemYGVj4DG6gYFBcUcoyvwTiBeLc1/5w6', 'siswa', NULL, '2026-07-06 06:24:26', '2026-09-03 13:43:30'),
(175, 'TALITHA LUTHFI', 'talitha.luthfi@siswa.smansago.com', NULL, '$2y$12$KWOuV.v2Hw6EjupXY0I0NO89OEAqUa0JKbqlic71n8vexGyB6g8Di', 'siswa', NULL, '2026-07-06 06:24:26', '2026-09-03 13:43:30'),
(176, 'TRI NURROHMAN', 'tri.nurrohman@siswa.smansago.com', NULL, '$2y$12$Rz3xbRJxBU5XUYp.cQtRaeUl22bQGkr7aGTguJLdbLl4cv6b1c27S', 'siswa', NULL, '2026-07-06 06:24:26', '2026-09-03 13:43:30'),
(177, 'ULFA LUTFIANA', 'ulfa.lutfiana@siswa.smansago.com', NULL, '$2y$12$qacfhQAw.aTEwgTAQjSpP.aM.fh3oBpCJhacHyNcGgptEWF7DWI2y', 'siswa', NULL, '2026-07-06 06:24:27', '2026-09-03 13:43:30'),
(178, 'WIWIK LIS RAHAYU', 'wiwik.rahayu@siswa.smansago.com', NULL, '$2y$12$i/OIB2trDS8yIngdwlk5P.vDtlGYtSNyb7MkQ39IFUeZ7s6/jG1Ue', 'siswa', NULL, '2026-07-06 06:24:27', '2026-09-03 13:43:30'),
(179, 'ZAHWA PUTRI CAHYA RIANTI', 'zahwa.rianti@siswa.smansago.com', NULL, '$2y$12$9W.QmNZhgjraZS28Vq7CEOsBpOi835tB8AAU7KNptKYMZdDJBHIZK', 'siswa', NULL, '2026-07-06 06:24:27', '2026-09-03 13:43:30'),
(180, 'Agnia Chindy Feyrus Chalisa', 'agnia.chalisa@siswa.smansago.com', NULL, '$2y$12$B6Tu0JVFyUV9VSe.SPrFJ.lOyFr/5HSP9d8Eh8nwKiWOhpT4QaGsC', 'siswa', NULL, '2026-07-06 06:24:27', '2026-09-03 13:43:30'),
(181, 'ALFIANO DHIKA PRATAMA', 'alfiano.pratama@siswa.smansago.com', NULL, '$2y$12$jLIWWXq5QRWwc9Mi1v8fjuGnzbD7MlDmjkvD2veV.3u2CAnENsCIa', 'siswa', NULL, '2026-07-06 06:24:28', '2026-09-03 13:43:30'),
(182, 'ALISA NAMIRA IMANI', 'alisa.imani@siswa.smansago.com', NULL, '$2y$12$2wOPYS3.AgPHq.rXQGcF3eaW28j/3LBMKpwdLYrSKs38VOZiI7U.G', 'siswa', NULL, '2026-07-06 06:24:28', '2026-09-03 13:43:30'),
(183, 'ANDI YONO', 'andi.yono@siswa.smansago.com', NULL, '$2y$12$8R2E1qkYZ8kEw9HlATxjduTmR3JJiuDeRrjzsUM.eNaWyxkHcGaoO', 'siswa', NULL, '2026-07-06 06:24:28', '2026-09-03 13:43:30'),
(184, 'Ariqa Sally Aswangga', 'ariqa.aswangga@siswa.smansago.com', NULL, '$2y$12$vyZf1tA3fKT.yQkMzXcoa.O24gYUAcNY.we5xmCM3NyftuzZayaiW', 'siswa', NULL, '2026-07-06 06:24:28', '2026-09-03 13:43:30'),
(185, 'AULIYA ZAHRATUL SIVA', 'auliya.siva@siswa.smansago.com', NULL, '$2y$12$E9KkNM0lEqbgj6yGwcqQxOjjFlE.yUnt/MbuDleeQeJNRv.PZST8.', 'siswa', NULL, '2026-07-06 06:24:29', '2026-09-03 13:43:30'),
(186, 'CHOIRUL ADNAN', 'choirul.adnan@siswa.smansago.com', NULL, '$2y$12$ILxibSFa2BFjgEt8WjAv.OjWDeyXDm.xJD89H913csigFUfgwbQjq', 'siswa', NULL, '2026-07-06 06:24:29', '2026-09-03 13:43:30'),
(187, 'DANIS NURIL FAHMA', 'danis.fahma@siswa.smansago.com', NULL, '$2y$12$nGdhvoip6rcz.03YAGArDeTsxMW9/3/IJtdgWR1XHMOC9ED2HlSOC', 'siswa', NULL, '2026-07-06 06:24:29', '2026-09-03 13:43:30'),
(188, 'DWI EVA ARIYANI', 'dwi.ariyani@siswa.smansago.com', NULL, '$2y$12$ChOfH7ulQzcZCAWTv89BFexdo9MuigveMrpzn7MbtOH/ys.IW.cD6', 'siswa', NULL, '2026-07-06 06:24:29', '2026-09-03 13:43:30'),
(189, 'DWI INDRIANA', 'dwi.indriana@siswa.smansago.com', NULL, '$2y$12$o9PiVLewCAOiBJ7WfWCsKOi9EpCpwIAx47NNTkH59jlSawL/avIwO', 'siswa', NULL, '2026-07-06 06:24:29', '2026-09-03 13:43:30'),
(190, 'ERDITA WAHYU FEBRIYANTI', 'erdita.febriyanti@siswa.smansago.com', NULL, '$2y$12$Efyz.k8mteERqX8.KZr/CeA2A0vYLXPyBvyDbUTf57qZoJEO7qKsi', 'siswa', NULL, '2026-07-06 06:24:30', '2026-09-03 13:43:30'),
(191, 'FERA YUNIARTI', 'fera.yuniarti@siswa.smansago.com', NULL, '$2y$12$A7NTDh/uO7lYwDtjcnIcMuOx9/gx7CH3aCrWyIxLlNVh/KPV94jjK', 'siswa', NULL, '2026-07-06 06:24:30', '2026-09-03 13:43:30'),
(192, 'FERI ARDIYANTO', 'feri.ardiyanto@siswa.smansago.com', NULL, '$2y$12$ePdIkANXIAPdgtqD38NBTeAnpQgOHaQuoepRbSdV8ISitWer7SSVe', 'siswa', NULL, '2026-07-06 06:24:30', '2026-09-03 13:43:30'),
(193, 'HANIK IKA MUSLIKHAH', 'hanik.muslikhah@siswa.smansago.com', NULL, '$2y$12$pCi1o.i2u7.XA958O1q2GueGxb/.pylPQ7skq8LRhQmMZ8FkAw76q', 'siswa', NULL, '2026-07-06 06:24:30', '2026-09-03 13:43:30'),
(194, 'IQBAL AL GHIFFAARI', 'iqbal.ghiffaari@siswa.smansago.com', NULL, '$2y$12$T1SV7IJQRoByh3dSwau51.ZBJt4Ump0QIajDvy9sfQF4Ktty1ZOjG', 'siswa', NULL, '2026-07-06 06:24:31', '2026-09-03 13:43:30'),
(195, 'Joko Prasetiyo', 'joko.prasetiyo@siswa.smansago.com', NULL, '$2y$12$6hXqyBvemjyoy0j.huja6e.ZmbkaZkwMylCuBsNLEOJVIuxeOpLIq', 'siswa', NULL, '2026-07-06 06:24:31', '2026-09-03 13:43:30'),
(196, 'KEYZA JAZTYIN AYU DIA PRATIWI', 'keyza.pratiwi@siswa.smansago.com', NULL, '$2y$12$jOyqq2U3AK9zHddxsllb3.a4ucqhSCkyncpb8pJRJ7yzB8ZGxSsOG', 'siswa', NULL, '2026-07-06 06:24:31', '2026-09-03 13:43:30'),
(197, 'KUNTI DWI YULIANTI', 'kunti.yulianti@siswa.smansago.com', NULL, '$2y$12$VbvBareGX9p3LznJ3sYF4Oa1ka2wECyoyaKrc3iFKMBkjSkC5XdPW', 'siswa', NULL, '2026-07-06 06:24:32', '2026-09-03 13:43:30'),
(198, 'MUHAMAD AKHYAR AFRILIAN', 'muhamad.afrilian@siswa.smansago.com', NULL, '$2y$12$.ulIpfFJ8cMJCBIPCII8e.Ibke195kpZ7frtO6yQsjWQ7ealGQfO2', 'siswa', NULL, '2026-07-06 06:24:32', '2026-09-03 13:43:30'),
(199, 'MUHAMMAD IRGI FAHREZI', 'muhammad.fahrezi@siswa.smansago.com', NULL, '$2y$12$BZ4HSJt9/Dd565bUjxFkC.hm8h3YUg1ZCMesaoDbHA69ax9nqAT0.', 'siswa', NULL, '2026-07-06 06:24:32', '2026-09-03 13:43:30'),
(200, 'NASRIFA YUMNA HAQILA', 'nasrifa.haqila@siswa.smansago.com', NULL, '$2y$12$jO5UUv.i5F5h/3P8OCecwuwcntUACGo2S2JVtSAecxnljTY3uZa9O', 'siswa', NULL, '2026-07-06 06:24:32', '2026-09-03 13:43:30'),
(201, 'NISAUL AULIA', 'nisaul.aulia@siswa.smansago.com', NULL, '$2y$12$J5mnqoQJDSTBJCj7hvBXm.pMSZMhMUjdhn61O7ogZOaqlzU4Xs8Nu', 'siswa', NULL, '2026-07-06 06:24:32', '2026-09-03 13:43:30'),
(202, 'NOVAN DWI ANDIKA', 'novan.andika@siswa.smansago.com', NULL, '$2y$12$hT8hUA1W2qmVhsNTgVP1TOtzFlS6WgUbGIYfGAffqHU/OlqSI8rgq', 'siswa', NULL, '2026-07-06 06:24:33', '2026-09-03 13:43:30'),
(203, 'OLIFFIA YULIANA', 'oliffia.yuliana@siswa.smansago.com', NULL, '$2y$12$OPhhQFOw3RXWTYktMRCrSO109XsAjAMNuZ86VlOgB55b/5wvxDgqu', 'siswa', NULL, '2026-07-06 06:24:33', '2026-09-03 13:43:30'),
(204, 'RATNA KEISHA SALSABILA', 'ratna.salsabila@siswa.smansago.com', NULL, '$2y$12$YnBuxqL9fBjBE3TavVWiPO5Inq90SB4iF9RwagaAuwVj82Xj/tjhO', 'siswa', NULL, '2026-07-06 06:24:33', '2026-09-03 13:43:30'),
(205, 'RIDHO LEONEL ADITYA', 'ridho.aditya@siswa.smansago.com', NULL, '$2y$12$eaxM4AWcTEzcpgkmcr/OXeJNs5yb9M6Wn8.FouHqUmtK2F1njKwIe', 'siswa', NULL, '2026-07-06 06:24:33', '2026-09-03 13:43:30'),
(206, 'RIRIT BHARATA NINGTYAS', 'ririt.ningtyas@siswa.smansago.com', NULL, '$2y$12$bg3CcuQ0HocYrL3fRUXV4uX5WwbzCSGMtSTkPV4YlRAkPOxGMgfrK', 'siswa', NULL, '2026-07-06 06:24:34', '2026-09-03 13:43:30'),
(207, 'SASKIA ZAHRA AMANDA', 'saskia.amanda@siswa.smansago.com', NULL, '$2y$12$Wd1ipsQvA8UTdhOBcfhZoeQCVO/A8QcMWh74EIJFPAdRmTv3/SGK2', 'siswa', NULL, '2026-07-06 06:24:34', '2026-09-03 13:43:30'),
(208, 'SITI OKTAVIANI', 'siti.oktaviani@siswa.smansago.com', NULL, '$2y$12$iZQ3BojvuDJl/Wvp3xHDpeMdeEleD/F7dxWd.LHZiJsdTYDw2XaMm', 'siswa', NULL, '2026-07-06 06:24:34', '2026-09-03 13:43:30'),
(209, 'SLAMET TRIYANTO', 'slamet.triyanto@siswa.smansago.com', NULL, '$2y$12$VA2AuJyuSqaIAIxKUo1nBOilTH6YX4NpxASiXd0dOPrOubdjD7Bvu', 'siswa', NULL, '2026-07-06 06:24:34', '2026-09-03 13:43:30'),
(210, 'SRI MURNI', 'sri.murni@siswa.smansago.com', NULL, '$2y$12$boEWqDmU5pX3XDUsqHYtgeI.9g0DIYyGQ0IEJUUeNSrfM7s3Wue5K', 'siswa', NULL, '2026-07-06 06:24:35', '2026-09-03 13:43:30'),
(211, 'TIKA AULIA', 'tika.aulia@siswa.smansago.com', NULL, '$2y$12$rbBgi/2Z8vsu5vFToJKZc.erDERaOv58juygaBo9v5yqYqQiMzZUq', 'siswa', NULL, '2026-07-06 06:24:35', '2026-09-03 13:43:30'),
(212, 'USWATUN KHASANAH', 'uswatun.khasanah@siswa.smansago.com', NULL, '$2y$12$yRdQNhHkWX50m4mfeLvs2ue/u25nwZzYeKPYV9RMd7P7.60Nqp/Ji', 'siswa', NULL, '2026-07-06 06:24:35', '2026-09-03 13:43:30'),
(213, 'Wahyu Tri Mulyanto', 'wahyu.mulyanto@siswa.smansago.com', NULL, '$2y$12$zpfd52qoFrRfI0z2nv755Ot/3MRxzCJ0.pEfZU56EJrDIbGQnWccO', 'siswa', NULL, '2026-07-06 06:24:35', '2026-09-03 13:43:30'),
(214, 'WULAN AGUSTIN', 'wulan.agustin@siswa.smansago.com', NULL, '$2y$12$DmDI4vI20w3H6DMjcVmk4.fAAet.jLfswe2VjYHtf9VZVpKGTdXG6', 'siswa', NULL, '2026-07-06 06:24:36', '2026-09-03 13:43:30'),
(215, 'ZULFA ISNAINISA', 'zulfa.isnainisa@siswa.smansago.com', NULL, '$2y$12$SvG2/l.fwjCfGLq.a2oPLeOScJf8ouWqQ5H47BCWVACV6YiQ0wByS', 'siswa', NULL, '2026-07-06 06:24:36', '2026-09-03 13:43:30'),
(216, 'AIDA SYAHIRA', 'aida.syahira@siswa.smansago.com', NULL, '$2y$12$XuxOvShEokBDnkuKaZZSCeFuEJQIMrGe669d9UkEyIIkhIsgcHuG2', 'siswa', NULL, '2026-07-06 06:24:36', '2026-09-03 13:43:30'),
(217, 'ALFIN IRGIYANSAH', 'alfin.irgiyansah@siswa.smansago.com', NULL, '$2y$12$GXu7FyMzZnXT8ZZ8d9yLWOpPS05ffyP44jmX.DN8W8DhquA764/fW', 'siswa', NULL, '2026-07-06 06:24:36', '2026-09-03 13:43:30'),
(218, 'ALMIRA IKSANIA PUTRI', 'almira.putri@siswa.smansago.com', NULL, '$2y$12$lNIHOqnSX.ubZdrOovW.EeaRaooPnn5zPE1HuhvvNZAgfTHWEQJS2', 'siswa', NULL, '2026-07-06 06:24:37', '2026-09-03 13:43:30'),
(219, 'ANDIKA PRATAMA', 'andika.pratama@siswa.smansago.com', NULL, '$2y$12$OmixSnp46bA7W0QNP.Xfd.efsfWI9d5K8YoxoFbhaeVUaQc88EhMG', 'siswa', NULL, '2026-07-06 06:24:37', '2026-09-03 13:43:30'),
(220, 'ARLINA TARA MAHENDRA', 'arlina.mahendra@siswa.smansago.com', NULL, '$2y$12$Y21l6Sfx4SiXpNf46W6qLekPn9qFeNTRRhbvAMuPVWq0ETYmDU9Ma', 'siswa', NULL, '2026-07-06 06:24:37', '2026-09-03 13:43:30'),
(221, 'AURA PUTRI KUSTIA WAL SOLEKHAH', 'aura.solekhah@siswa.smansago.com', NULL, '$2y$12$9l3XkYZ1lz1Aean9P88uXOV2bhSDhA7UCYBRnhqb0JLKuIlWcnkSa', 'siswa', NULL, '2026-07-06 06:24:38', '2026-09-03 13:43:30'),
(222, 'CHOIRUL UMAM', 'choirul.umam@siswa.smansago.com', NULL, '$2y$12$0yHK/8Yi1udIBjGy0Y0GE.egwBOMHssw2LnO4S//RgucIAe.hSNMu', 'siswa', NULL, '2026-07-06 06:24:38', '2026-09-03 13:43:30'),
(223, 'DESWITA DWI MAY RANI', 'deswita.rani@siswa.smansago.com', NULL, '$2y$12$5i/MCR83kwGiwT4NAsGPZus3uql/.8m38ET1G9nPxySQL89nC2C/K', 'siswa', NULL, '2026-07-06 06:24:38', '2026-09-03 13:43:30'),
(224, 'Dwi Indriyani', 'dwi.indriyani@siswa.smansago.com', NULL, '$2y$12$8XpB5WafGq8pijnXFXmYdugbC4/8yjX/YXC49.SPMbZifk/af544S', 'siswa', NULL, '2026-07-06 06:24:38', '2026-09-03 13:43:30'),
(225, 'Dwi Wicaksono', 'dwi.wicaksono@siswa.smansago.com', NULL, '$2y$12$tXJIuytQtRNXGhaACONXWemDUVhSJKPFHtFxvq69h6Pir2bhOLnnO', 'siswa', NULL, '2026-07-06 06:24:39', '2026-09-03 13:43:30'),
(226, 'ESHA SULISTIYANI', 'esha.sulistiyani@siswa.smansago.com', NULL, '$2y$12$8QT1zC.A1hucdkZJPPSSPeAgwWb4ZfCBlEMeYfaBPrMPBDkcggXY2', 'siswa', NULL, '2026-07-06 06:24:39', '2026-09-03 13:43:30'),
(227, 'FILIO KENZIE HAFEEZY', 'filio.hafeezy@siswa.smansago.com', NULL, '$2y$12$GWh2NHNd0EdyiPtiX/iClOun3cLPAoiAobWzBHZkjYVdLkyxF7bTq', 'siswa', NULL, '2026-07-06 06:24:39', '2026-09-03 13:43:30'),
(228, 'FITRI SHOLIKHAH', 'fitri.sholikhah@siswa.smansago.com', NULL, '$2y$12$Om6xBVUFT7oRMVuWqhDd4eugqq/4cjTfyNevKqHZOMUB8QnCCIrOO', 'siswa', NULL, '2026-07-06 06:24:39', '2026-09-03 13:43:30'),
(229, 'Ika Wahyuningsih', 'ika.wahyuningsih@siswa.smansago.com', NULL, '$2y$12$cy0xLEzSpNret5DgZv2NGuZT6vJNCNOoMhFt19Wz12LcCAGA3tWgu', 'siswa', NULL, '2026-07-06 06:24:39', '2026-09-03 13:43:30'),
(230, 'IRFAN AHMAD', 'irfan.ahmad@siswa.smansago.com', NULL, '$2y$12$7Ue7ERt7F8Wk.fgeWtlBy.T0krBNoJZy3fFoy8yNtkRdq.wD9q/dO', 'siswa', NULL, '2026-07-06 06:24:40', '2026-09-03 13:43:30'),
(231, 'Khailla Adelia Marsya', 'khailla.marsya@siswa.smansago.com', NULL, '$2y$12$fAlXNC6AV1hpSTMTZnQS1eVZqy5TpqHv52IXMvLY/j4sXP6TPLgIi', 'siswa', NULL, '2026-07-06 06:24:40', '2026-09-03 13:43:30'),
(232, 'KHARIZ IRFAN HAKIM', 'khariz.hakim@siswa.smansago.com', NULL, '$2y$12$oldaabt9vebeb3FIY6lh8On.2IVVOp2zM7Y4DyfKB3ugBJQuoi3WG', 'siswa', NULL, '2026-07-06 06:24:40', '2026-09-03 13:43:30'),
(233, 'LAUDYA DEVINA ANASTASYA', 'laudya.anastasya@siswa.smansago.com', NULL, '$2y$12$k5Ks.zIBzhBO/lA5PD9HD.hJMGmmXeQtM.HYLYwybxOsMAgj5OWtW', 'siswa', NULL, '2026-07-06 06:24:40', '2026-09-03 13:43:30'),
(234, 'MUHAMAD DINO WARDANA', 'muhamad.wardana@siswa.smansago.com', NULL, '$2y$12$8o.7EEP0way7VtiLb9RrdO5LjuTr5kSiw6QCALGL7pskINZUGrYHm', 'siswa', NULL, '2026-07-06 06:24:41', '2026-09-03 13:43:30'),
(235, 'MUHAMMAD RAFFA AL FADHIL', 'muhammad.fadhil@siswa.smansago.com', NULL, '$2y$12$OEbj92/jOG.QRCgIS76eT.1k./jmIfC46EP6wO9lGC.6q8ljuXKj2', 'siswa', NULL, '2026-07-06 06:24:41', '2026-09-03 13:43:30'),
(236, 'NATASYA NOVITA PUTRI', 'natasya.putri@siswa.smansago.com', NULL, '$2y$12$TJe0Q052ICICqiiTew3sn.FPOlvPI8wQLmpfU1fN.S7J/0aa8ADiS', 'siswa', NULL, '2026-07-06 06:24:41', '2026-09-03 13:43:30'),
(237, 'NIYA SELA PASHA ARDHILA', 'niya.ardhila@siswa.smansago.com', NULL, '$2y$12$/.LgWCtdeP0XDk88T.FL0ee.pXalJ5lGrcuOxU/IQwSOXZTNG4J66', 'siswa', NULL, '2026-07-06 06:24:42', '2026-09-03 13:43:30'),
(238, 'NOVIYANTO FARLY IRAWAN', 'noviyanto.irawan@siswa.smansago.com', NULL, '$2y$12$hKKCQPD3YddfJc2Aj3wXYOvMPL40AVnA.uMoxAn4GMm69htxC619u', 'siswa', NULL, '2026-07-06 06:24:42', '2026-09-03 13:43:30'),
(239, 'Olivia Ayyatul Khusna', 'olivia.khusna@siswa.smansago.com', NULL, '$2y$12$gr.SUs/zqkpocCZLY7JcpOjM6ow.86Maz0XVtYFsWWb9sAQjXZ7Sa', 'siswa', NULL, '2026-07-06 06:24:42', '2026-09-03 13:43:30'),
(240, 'RAUDHYA ZAHRA RASYIDAH', 'raudhya.rasyidah@siswa.smansago.com', NULL, '$2y$12$420Q7O20iHRbtG.8CliuGOs3QGeoHR8zXV8iMmqnXdIZ1uWTrb2rK', 'siswa', NULL, '2026-07-06 06:24:42', '2026-09-03 13:43:30'),
(241, 'RIO IRAWAN', 'rio.irawan@siswa.smansago.com', NULL, '$2y$12$OYqb1oQI/TM1Tr/TJyZUGOTg7P33w46Qks13btOUcIsqsWG0npAoG', 'siswa', NULL, '2026-07-06 06:24:43', '2026-09-03 13:43:30'),
(242, 'RISKA WAHYU SEPTIYANI', 'riska.septiyani@siswa.smansago.com', NULL, '$2y$12$IGAokL8.4ayBSiPpj7Do.Ohvia87ofDd/JwmJzw2U4AVfhEHY33Ty', 'siswa', NULL, '2026-07-06 06:24:43', '2026-09-03 13:43:30'),
(243, 'Sasya Eka Septiyasa', 'sasya.septiyasa@siswa.smansago.com', NULL, '$2y$12$gQ69cx4XgLnfqm8nxX3hUeAb7F/XFZAe2/IBZMJqnEVluW0Sp5zhW', 'siswa', NULL, '2026-07-06 06:24:43', '2026-09-03 13:43:30'),
(244, 'SITI PRIHATIN', 'siti.prihatin@siswa.smansago.com', NULL, '$2y$12$EfqcTjHQaVu7RBD4mo7/QeuC0v7arti6VtP79uuA4S8pft9opryj2', 'siswa', NULL, '2026-07-06 06:24:43', '2026-09-03 13:43:30'),
(245, 'SRI RAHAYU', 'sri.rahayu@siswa.smansago.com', NULL, '$2y$12$HZIPQPIEsL0ffOfbXTDiH.CLVs6lj2N3yv.vM6JvSKSFxlIAXMBEy', 'siswa', NULL, '2026-07-06 06:24:44', '2026-09-03 13:43:30'),
(246, 'SURYA ADISTI PUTRA', 'surya.putra@siswa.smansago.com', NULL, '$2y$12$w4hZZTwceIdKADF7W9uZnelvP5t2ewEF1sVW6lLWlOm9Y26o67T/q', 'siswa', NULL, '2026-07-06 06:24:44', '2026-09-03 13:43:30'),
(247, 'TRI HARTANTI', 'tri.hartanti@siswa.smansago.com', NULL, '$2y$12$vlxL9yGWHmU.xO.2nebqJeEAX1od4BQi1tKbxErRljakB2Fato0V2', 'siswa', NULL, '2026-07-06 06:24:44', '2026-09-03 13:43:30'),
(248, 'WAHYU FARAH AULIA', 'wahyu.aulia@siswa.smansago.com', NULL, '$2y$12$ldAsBDz55bfDcfP9FTvPdeE47J61aLb9YOP4Tvo8B4uH9cgier/Nu', 'siswa', NULL, '2026-07-06 06:24:44', '2026-09-03 13:43:30'),
(249, 'YAKA HUTAMA', 'yaka.hutama@siswa.smansago.com', NULL, '$2y$12$drza0mx/4QbWFsJ38WTg3uZWoSfilIEkkZwVoA/fZsHivcFxgkS0O', 'siswa', NULL, '2026-07-06 06:24:45', '2026-09-03 13:43:31'),
(250, 'YAMANDA TIYASTUTI', 'yamanda.tiyastuti@siswa.smansago.com', NULL, '$2y$12$N1pHoMGiHfD2xJpJgqcBYu99Zk/Fh.6rUwUJhSJN099vnQb8LKoL.', 'siswa', NULL, '2026-07-06 06:24:45', '2026-09-03 13:43:31'),
(251, 'ZULFA NUR AZIZAH', 'zulfa.azizah@siswa.smansago.com', NULL, '$2y$12$t3LvkxDOakriTv2tx8Tu1eti1D8vGjywoMkeP4PK/GW.Ms1l59vPS', 'siswa', NULL, '2026-07-06 06:24:45', '2026-09-03 13:43:31'),
(252, 'ADITIA SAPUTRA', 'aditia.saputra@siswa.smansago.com', NULL, '$2y$12$nYS92K9lWVNLJ6pQyZh63uUvwDGgMWzpCB59Ma6rQQJ.lwaZEvOqu', 'siswa', NULL, '2026-07-06 06:24:45', '2026-09-03 13:43:31'),
(253, 'AISYAH PUTRI AZZAHRA', 'aisyah.azzahra@siswa.smansago.com', NULL, '$2y$12$fwcm4BuV9HgT5Eat0WTAFO8v38AdlLw4lk8xZU6NXDDjzjyKBPLWW', 'siswa', NULL, '2026-07-06 06:24:46', '2026-09-03 13:43:31'),
(254, 'ALI ZAINAL ABIDIN', 'ali.abidin@siswa.smansago.com', NULL, '$2y$12$xq.QOwpzHTnIqfhItwp/XuvN4fh3j1DNejgrU5KbhgNtyOlYeu.jC', 'siswa', NULL, '2026-07-06 06:24:46', '2026-09-03 13:43:31'),
(255, 'ALYARISMA DEVINA ANGGRAENI', 'alyarisma.anggraeni@siswa.smansago.com', NULL, '$2y$12$jCcr/BiLOzFaIYkh00XbaO16OWigG.6G1gQnCfPlIZvoES5tMRaAO', 'siswa', NULL, '2026-07-06 06:24:46', '2026-09-03 13:43:31'),
(256, 'ARDIAN BINTANG PRAMUDITA', 'ardian.pramudita@siswa.smansago.com', NULL, '$2y$12$dOGUEX3vAIC0EC5ulQNrwOAZLN62DhCGP.iV1CxtTfceeeZkl4KDC', 'siswa', NULL, '2026-07-06 06:24:47', '2026-09-03 13:43:31'),
(257, 'ARYA SAFITRI', 'arya.safitri@siswa.smansago.com', NULL, '$2y$12$B6bNvR1x5MGqgLSEjuU/Eua6SvOny/hN./40T4HYajmXajaP0kr4S', 'siswa', NULL, '2026-07-06 06:24:47', '2026-09-03 13:43:31');
INSERT INTO `pengguna` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(258, 'BERLINA PURNAMA NUGRAHANI', 'berlina.nugrahani@siswa.smansago.com', NULL, '$2y$12$kv3E99bgjjcVyiosRFHU2.Ol60GYhmrb.KcBui1LPIIcuwxMofrn6', 'siswa', NULL, '2026-07-06 06:24:47', '2026-09-03 13:43:31'),
(259, 'DEDY NOVANDI', 'dedy.novandi@siswa.smansago.com', NULL, '$2y$12$sDHBhS7ER5PBhd7LqHNZT.pb1ycTdnolF2BspHccJ9uS2nbr9cBgq', 'siswa', NULL, '2026-07-06 06:24:47', '2026-09-03 13:43:31'),
(260, 'DEVIANA BELLA SASKIA', 'deviana.saskia@siswa.smansago.com', NULL, '$2y$12$YU4NIzLye2OJ8eMCcw4/..1GgdXBeLSfMgem2DoUp.43YMbo.uTW.', 'siswa', NULL, '2026-07-06 06:24:48', '2026-09-03 13:43:31'),
(261, 'ECKA RIDO SETYONO', 'ecka.setyono@siswa.smansago.com', NULL, '$2y$12$cepWF4NXR6AYSwKG3cI5i.cPrDcqWhOU8ugToaUFPZdCi2SVd0zDy', 'siswa', NULL, '2026-07-06 06:24:48', '2026-09-03 13:43:31'),
(262, 'EDRIA THEDA MUFARIHAH', 'edria.mufarihah@siswa.smansago.com', NULL, '$2y$12$TOqSeZE3nV4podQEDtStbOTVnrffKZAnr8fUcpqs3nPFi69ml6COu', 'siswa', NULL, '2026-07-06 06:24:48', '2026-09-03 13:43:31'),
(263, 'EVA APRILIA SAFITRI', 'eva.safitri@siswa.smansago.com', NULL, '$2y$12$DzhK8Ks9pvtW3akAO8fmeutWR8gXaY.Y.HCnBg.HzmFCRZr.aRywe', 'siswa', NULL, '2026-07-06 06:24:48', '2026-09-03 13:43:31'),
(264, 'FRISKA YOGI WAHYUNINGTYAS', 'friska.wahyuningtyas@siswa.smansago.com', NULL, '$2y$12$udWFIR0vXoQKxqZMiT836uyymQIKgEaIznbm1cgl45kDNnsg0jK3O', 'siswa', NULL, '2026-07-06 06:24:49', '2026-09-03 13:43:31'),
(265, 'GABRILIA MUTIARA SARI', 'gabrilia.sari@siswa.smansago.com', NULL, '$2y$12$hcQHZLJOZWea9Hfto7HYS.qbMEqrohyelC3X2E8GxltIlIEPzVyeO', 'siswa', NULL, '2026-07-06 06:24:49', '2026-09-03 13:43:31'),
(266, 'IKHDA ANNISA RAHMAH', 'ikhda.rahmah@siswa.smansago.com', NULL, '$2y$12$cs6dJ0Z9ML6rcRlnSkpHaeMvGVXOe.g3MhUilGETXBH.fZ.24Uar.', 'siswa', NULL, '2026-07-06 06:24:49', '2026-09-03 13:43:31'),
(267, 'IRFAN DWI SETIAWAN', 'irfan.setiawan@siswa.smansago.com', NULL, '$2y$12$9bdAxziALbYloyjNqWR3sOQfct5hJ4gsP0W8up9z7OwOU/qG8T5rK', 'siswa', NULL, '2026-07-06 06:24:49', '2026-09-03 13:43:31'),
(268, 'KHAIRUNISA AZAHRA RAMADANI', 'khairunisa.ramadani@siswa.smansago.com', NULL, '$2y$12$.AnlTctwFM6.ldcQnZcpgeJcDV5M0gi4/0gZxKnEuiIK9pxl4IIgO', 'siswa', NULL, '2026-07-06 06:24:50', '2026-09-03 13:43:31'),
(269, 'KURNIAWAN SIDIK BAYU PRAKOSO', 'kurniawan.prakoso@siswa.smansago.com', NULL, '$2y$12$Y/pYk3MCKKQUldTbuAStje47eJ7yNWo2txukda4jjvc7hH41KFG6G', 'siswa', NULL, '2026-07-06 06:24:50', '2026-09-03 13:43:31'),
(270, 'LILIK SRI LESTARI', 'lilik.lestari@siswa.smansago.com', NULL, '$2y$12$6SkHW.aaUyc/XnbShAQs7.VVjRfJwwML2Ty50USZ.vDt9iH/1FyiC', 'siswa', NULL, '2026-07-06 06:24:50', '2026-09-03 13:43:31'),
(271, 'Muhammad Affandi Arsyad Yuono Putra', 'muhammad.putra@siswa.smansago.com', NULL, '$2y$12$I9ISrRKcxP/new0/nq50GOwUnGXNjBO9qXckI1AI.eSQlFMcC/NR.', 'siswa', NULL, '2026-07-06 06:24:50', '2026-09-03 13:43:31'),
(272, 'MUHAMMAD RIZAL ALYAZID', 'muhammad.alyazid@siswa.smansago.com', NULL, '$2y$12$Pi7iDRUCDNHsr2emLl9Y6enoBdnDAS0udIAqlIrOdlt3kBIBmHnAS', 'siswa', NULL, '2026-07-06 06:24:51', '2026-09-03 13:43:31'),
(273, 'Natasya Yunika Putri', 'natasya.putri1@siswa.smansago.com', NULL, '$2y$12$aCD6CdOmNZdd71ZKSKVZf.ZBpeW6vPrUpyWcjbjficQA4xB3qhZXO', 'siswa', NULL, '2026-07-06 06:24:51', '2026-09-03 13:43:31'),
(274, 'NOVI KURNIASARI', 'novi.kurniasari@siswa.smansago.com', NULL, '$2y$12$YvwJ5WzCcyBdbee7GrOmG.c871PlwhWOwXPgK20r2yBfvG47NGJgq', 'siswa', NULL, '2026-07-06 06:24:51', '2026-09-03 13:43:31'),
(275, 'NUR FAISAL', 'nur.faisal@siswa.smansago.com', NULL, '$2y$12$Xs70jmf76Yt/byc2k/nV9emR8QiTnOjO/ajhzK/7kgXKkU0OrIyTy', 'siswa', NULL, '2026-07-06 06:24:51', '2026-09-03 13:43:31'),
(276, 'PIPIT SRI HANDAYANI', 'pipit.handayani@siswa.smansago.com', NULL, '$2y$12$92M//eN.adLtz9QmmM5iU.HvHG9/voEdOU/P3aDVB8lBFSR9IHt.m', 'siswa', NULL, '2026-07-06 06:24:52', '2026-09-03 13:43:31'),
(277, 'RAYKHANUN NOVA REZQIANI', 'raykhanun.rezqiani@siswa.smansago.com', NULL, '$2y$12$1XG573pw.TGFa5FsCLmHme01Dx2wvdU8bSzA1MtnP03B7gVzSAXQy', 'siswa', NULL, '2026-07-06 06:24:52', '2026-09-03 13:43:31'),
(278, 'RISKY FADILAH', 'risky.fadilah@siswa.smansago.com', NULL, '$2y$12$NjPUrjAxDyHt6k3zj.1XTOoUIM9Yy7lhEhJtpKjrVmBiUcOw9p3u2', 'siswa', NULL, '2026-07-06 06:24:52', '2026-09-03 13:43:31'),
(279, 'ROICHAN AHMAD ARROYANI', 'roichan.arroyani@siswa.smansago.com', NULL, '$2y$12$jrRlLP1q6u4kgpxj.3A0Q.DHO6Zl0rnbcetLoWr.SEUBvfq/H/7Zm', 'siswa', NULL, '2026-07-06 06:24:52', '2026-09-03 13:43:31'),
(280, 'SAVA LESTARI', 'sava.lestari@siswa.smansago.com', NULL, '$2y$12$r0rVa4dHOZ/.1Z2Za79SpuzXoXQpjafi0Jh7S1PWLwSn3i5Mi/P6q', 'siswa', NULL, '2026-07-06 06:24:53', '2026-09-03 13:43:31'),
(281, 'SITI ROHANA', 'siti.rohana@siswa.smansago.com', NULL, '$2y$12$weY0wWxUK9GEjw2TQu4Cj.AHl84F7qjlohHCddKHRCVlFJ4cpoDVa', 'siswa', NULL, '2026-07-06 06:24:53', '2026-09-03 13:43:31'),
(282, 'STIYA WATIK', 'stiya.watik@siswa.smansago.com', NULL, '$2y$12$QfJmHIfjzqx9t9ZIYfnGwuQjhNLTqKFe2u/utS5OsTOXFHUbssClG', 'siswa', NULL, '2026-07-06 06:24:53', '2026-09-03 13:43:31'),
(283, 'SYARIF HIDAYATULLAH', 'syarif.hidayatullah@siswa.smansago.com', NULL, '$2y$12$oTeHXiH7foEswXDGZmAgCeCJ4lso.81YX7KoWHWYCtFmajo0xNL/q', 'siswa', NULL, '2026-07-06 06:24:53', '2026-09-03 13:43:31'),
(284, 'TRI LISTIYANINGSIH', 'tri.listiyaningsih@siswa.smansago.com', NULL, '$2y$12$RFftNGStzpFpXS8ZKYPqreCEwJocq0yS5dMcbBwLhJ8.MK9S2qpA.', 'siswa', NULL, '2026-07-06 06:24:54', '2026-09-03 13:43:31'),
(285, 'WAHYU KHAMIDHATU ZUHRIYA', 'wahyu.zuhriya@siswa.smansago.com', NULL, '$2y$12$BN8./XZBf1ZBIMpFfBQA1.waExctKnZaa5gTNovQ4.FAZ2/en0.b6', 'siswa', NULL, '2026-07-06 06:24:54', '2026-09-03 13:43:31'),
(286, 'YOGA KURNIYAWAN', 'yoga.kurniyawan@siswa.smansago.com', NULL, '$2y$12$1Gwz3UyqDlSdGwJgekj3duGYL0QxAQMRFp/StPz/xmiZsS3mDnx/6', 'siswa', NULL, '2026-07-06 06:24:54', '2026-09-03 13:43:31'),
(287, 'YULMIA KIRANI AZIZAH', 'yulmia.azizah@siswa.smansago.com', NULL, '$2y$12$Y0JSHtSrcQEN7o2ZLUG6I.R2R7t4P14QpOQU51b7VBQmFLQ4RSQPK', 'siswa', NULL, '2026-07-06 06:24:54', '2026-09-03 13:43:31'),
(288, 'Abdul Hafizh Mardiyanto', 'abdul.mardiyanto@siswa.smansago.com', NULL, '$2y$12$xofZqWx7wck6oZEcAmCN2O.jXPDedFsbTCJyKtTPJJh1LFBGlmWui', 'siswa', NULL, '2026-07-06 06:24:55', '2026-09-03 13:43:31'),
(289, 'ADITYA PRADANA FIKI ARDIANSYAH', 'aditya.ardiansyah@siswa.smansago.com', NULL, '$2y$12$1fYvRUPXmJb5cvjGygtqie9fxmOuaqFhzv.NvaxvtzkYwVgQNQHX6', 'siswa', NULL, '2026-07-06 06:24:55', '2026-09-03 13:43:31'),
(290, 'AGENG BUDI HARJO', 'ageng.harjo@siswa.smansago.com', NULL, '$2y$12$.0wqp2I4aEU3dq1LgmhD8.TwgiMe.0rSHaALfGenFDz7v0U/WWXwq', 'siswa', NULL, '2026-07-06 06:24:55', '2026-09-03 13:43:31'),
(291, 'AHMAD ZAENURI', 'ahmad.zaenuri@siswa.smansago.com', NULL, '$2y$12$EV3NYV.4TtXRtKSDnOUAxuOE4NB92gS4oPJs2USH4E.2RgMIA/h5q', 'siswa', NULL, '2026-07-06 06:24:55', '2026-09-03 13:43:31'),
(292, 'ALLEA SASTRA ALMA FAISHA', 'allea.faisha@siswa.smansago.com', NULL, '$2y$12$gxjerm6o86rH/P5qdcr.Ce82/T722ponFWrPpD3AQnCZiuOw1MatW', 'siswa', NULL, '2026-07-06 06:24:56', '2026-09-03 13:43:31'),
(293, 'Angga Setiawan', 'angga.setiawan@siswa.smansago.com', NULL, '$2y$12$V2JEZGblCaPM5.wgR/9HT.2bvXA.TcLUsMVANEbtDsivbyf/6a3J.', 'siswa', NULL, '2026-07-06 06:24:56', '2026-09-03 13:43:31'),
(294, 'ARES WIDODO', 'ares.widodo@siswa.smansago.com', NULL, '$2y$12$wnnWTKXVH/Ln9WerVdBG3eZX7WFjZMPux5im1bMYOjyVYkwY8LS3a', 'siswa', NULL, '2026-07-06 06:24:56', '2026-09-03 13:43:31'),
(295, 'DANANG SULISTYO', 'danang.sulistyo@siswa.smansago.com', NULL, '$2y$12$6A9LEgrr5fd5LDHEWvLqZuXzEqFkgC4ORakE9PvKe92ZYm/zbLt5O', 'siswa', NULL, '2026-07-06 06:24:56', '2026-09-03 13:43:31'),
(296, 'DIMAS RAIKHAN DEWANTORO', 'dimas.dewantoro@siswa.smansago.com', NULL, '$2y$12$4aHBVF7rj9Jj3jmf0M/jgeU21Lpp3Bz5HwlvZ/mo4j3h56sWuPIa2', 'siswa', NULL, '2026-07-06 06:24:57', '2026-09-03 13:43:31'),
(297, 'DZAKY RAIHAN PUTRA PRATHAMA', 'dzaky.prathama@siswa.smansago.com', NULL, '$2y$12$18yyEbisxKVYH/OeOFOSG.NyUk7POWljVUBSz87md/sBeWg13kkqS', 'siswa', NULL, '2026-07-06 06:24:57', '2026-09-03 13:43:31'),
(298, 'FARHAN WIRA ARDIAN MAULANA', 'farhan.maulana@siswa.smansago.com', NULL, '$2y$12$UxmA4poqa3Ztm.Uri4M4S.FSthVCxGMPFlV7YVXw.VYnFMw35noKa', 'siswa', NULL, '2026-07-06 06:24:57', '2026-09-03 13:43:31'),
(299, 'GALIH REHANANTO', 'galih.rehananto@siswa.smansago.com', NULL, '$2y$12$N1ANOKz2H3EtzvvM3W67g.recaTSl6NTLiSqLzFsaMyt.sePKXFPS', 'siswa', NULL, '2026-07-06 06:24:57', '2026-09-03 13:43:31'),
(300, 'HABIBUR RAHMAN', 'habibur.rahman@siswa.smansago.com', NULL, '$2y$12$MkTNulDBSDARr8DkgqXMjOiQYEJNyFAjROnhyW9Q4BhCJeUBN5wa6', 'siswa', NULL, '2026-07-06 06:24:58', '2026-09-03 13:43:31'),
(301, 'Ilham Taukhid Mustakim', 'ilham.mustakim@siswa.smansago.com', NULL, '$2y$12$IzKAs95w2y54.7Z9ebYXPu6rxqzuyCTkVzYUO8hV1iu8r6VZR8xi6', 'siswa', NULL, '2026-07-06 06:24:58', '2026-09-03 13:43:31'),
(302, 'Ivan Galih Maulana', 'ivan.maulana@siswa.smansago.com', NULL, '$2y$12$G5kiW2EjVhvfz5P9Z9T.G.Ok245X8oaNNHYyetQlNJCxglMnNPgne', 'siswa', NULL, '2026-07-06 06:24:58', '2026-09-03 13:43:31'),
(303, 'Jesika Rahma Maulana', 'jesika.maulana@siswa.smansago.com', NULL, '$2y$12$gG.aq4S4AAige4lg0FhHJ.1tx7HvtouAE7xcg5bmjViJNQaLcs13a', 'siswa', NULL, '2026-07-06 06:24:58', '2026-09-03 13:43:31'),
(304, 'JOICE IVANIA', 'joice.ivania@siswa.smansago.com', NULL, '$2y$12$3cZrryGmqhBVgurFrHxtre8UDZQ4yRF2Uj08L1O59.ZLWtLpO8n2y', 'siswa', NULL, '2026-07-06 06:24:59', '2026-09-03 13:43:31'),
(305, 'KHALILA ESTA PUTRI', 'khalila.putri@siswa.smansago.com', NULL, '$2y$12$m5fyVi14IbcNyeJBjyoBFugVgTImwBhKZ8gsNAA.ZqblxqWqsKNPW', 'siswa', NULL, '2026-07-06 06:24:59', '2026-09-03 13:43:31'),
(306, 'LATIFA AZZARA', 'latifa.azzara@siswa.smansago.com', NULL, '$2y$12$eLnbODp3LBA3knnGaP/OqOKaMy7.TrqZCyEwj01.9eDWQ1RtO4zh2', 'siswa', NULL, '2026-07-06 06:24:59', '2026-09-03 13:43:31'),
(307, 'Listianingsih', 'listianingsih@siswa.smansago.com', NULL, '$2y$12$Lc2eIaqs.n0N8hbqGWBcmufUKfjx9yFdUqRcYUVE6flQT0yqnUoty', 'siswa', NULL, '2026-07-06 06:24:59', '2026-09-03 13:43:31'),
(308, 'MOHAMAD YOGA PRATAMA', 'mohamad.pratama@siswa.smansago.com', NULL, '$2y$12$texgaJpD1t8qgPwc2cdKc.tMn29EAHCZz4ShAFOVU3VvUiH1dF9.G', 'siswa', NULL, '2026-07-06 06:24:59', '2026-09-03 13:43:31'),
(309, 'MUGHNI LAFIF AL LATIEF', 'mughni.latief@siswa.smansago.com', NULL, '$2y$12$lF3b7856mc/2.Y62vN6U5.OLjLMYOa/hNZLvb7Pc6fSZ5uHfdkt1q', 'siswa', NULL, '2026-07-06 06:25:00', '2026-09-03 13:43:31'),
(310, 'MUHYI ASRORI FUADY', 'muhyi.fuady@siswa.smansago.com', NULL, '$2y$12$P3awlRX6Pyspc.7ixQ4n8OxgRIVmabrICOFGdrfrceyOrNFYEj2QW', 'siswa', NULL, '2026-07-06 06:25:00', '2026-09-03 13:43:31'),
(311, 'NASYWA NATHANIA JASMINE', 'nasywa.jasmine@siswa.smansago.com', NULL, '$2y$12$YJXKVzrcYF6LQLgUSgd5yuJsgZ.NTFox2fB6JxLnMv2exGLtLhaHe', 'siswa', NULL, '2026-07-06 06:25:00', '2026-09-03 13:43:31'),
(312, 'NAZARI ADI LESMANA', 'nazari.lesmana@siswa.smansago.com', NULL, '$2y$12$0SWZvCiyFcrfDoBixPWZVOM.0TkFqZcnlUQwqFUQDpZOsxbptdJMO', 'siswa', NULL, '2026-07-06 06:25:01', '2026-09-03 13:43:31'),
(313, 'Nofa Setiadi', 'nofa.setiadi@siswa.smansago.com', NULL, '$2y$12$MH9uB7yd07AbnLo1ynbcwece7jLB7CfzOu8gDgNcboiwkS3VXW.Fu', 'siswa', NULL, '2026-07-06 06:25:01', '2026-09-03 13:43:31'),
(314, 'Novita Anisa Putri', 'novita.putri@siswa.smansago.com', NULL, '$2y$12$LNZFG4grs1iiDkygu6P33elOuaO0dhPxUQTTOz9n9kgHH1NWVXQLu', 'siswa', NULL, '2026-07-06 06:25:01', '2026-09-03 13:43:31'),
(315, 'Pipiet Nastiti Wulan', 'pipiet.wulan@siswa.smansago.com', NULL, '$2y$12$nL.lO24KWcvL8yOwNkKdmuY5mIq./lOqY8FMf/309VZ8d/aUWCD2i', 'siswa', NULL, '2026-07-06 06:25:01', '2026-09-03 13:43:31'),
(316, 'RAFA PUTRA PURWANA', 'rafa.purwana@siswa.smansago.com', NULL, '$2y$12$5yeuXzib7TX2ixM9MMD9Muk4oBzWZWVOHnrXiGWfqcQywxGuxbEK.', 'siswa', NULL, '2026-07-06 06:25:02', '2026-09-03 13:43:31'),
(317, 'RAFID AFFANDI', 'rafid.affandi@siswa.smansago.com', NULL, '$2y$12$M2W3/U69uMkSdhEUs7naCe8bAONba6tQfdl4yJP.H9zgHhrgUMuXW', 'siswa', NULL, '2026-07-06 06:25:02', '2026-09-03 13:43:31'),
(318, 'RAHARJA GALIH CANDRANANTA', 'raharja.candrananta@siswa.smansago.com', NULL, '$2y$12$RTglw5/d4skUZawwWh22dOB2ZEeNP2PL.V3nxDzar.Hx.WvMn8Kr.', 'siswa', NULL, '2026-07-06 06:25:02', '2026-09-03 13:43:31'),
(319, 'RIBANG RAIF RABANI', 'ribang.rabani@siswa.smansago.com', NULL, '$2y$12$U0pwUfXh4u6AwDoNCd/YsusBHNmTcED2gZKh0hgmMcssa9OstU5Gq', 'siswa', NULL, '2026-07-06 06:25:03', '2026-09-03 13:43:31'),
(320, 'SATYA NUGROHO', 'satya.nugroho@siswa.smansago.com', NULL, '$2y$12$HUlKq3zoFGzQOXDXdlUciuuK8AGeonfaKnANZhZjoT0Ju/LlroxAK', 'siswa', NULL, '2026-07-06 06:25:03', '2026-09-03 13:43:31'),
(321, 'SRI WAHYU RAHMADANI', 'sri.rahmadani@siswa.smansago.com', NULL, '$2y$12$kMVs.fH8tEsK2fKhvOwKoOYZgmbDGS5unjEhqgjLc2AuQTalz2.a6', 'siswa', NULL, '2026-07-06 06:25:03', '2026-09-03 13:43:31'),
(322, 'SUCI MAHARDIKA', 'suci.mahardika@siswa.smansago.com', NULL, '$2y$12$u2e7mEdHGHcKVfs816JvNulemxIFodxVrrFHnP5mc5z08l7gfbYjy', 'siswa', NULL, '2026-07-06 06:25:03', '2026-09-03 13:43:31'),
(323, 'YANTI IDA LESTARI', 'yanti.lestari@siswa.smansago.com', NULL, '$2y$12$N2Yks0dF.hfdfv6MyooLa.nXJey.s.X8bo4BATCbamNYkDzM87yN6', 'siswa', NULL, '2026-07-06 06:25:04', '2026-09-03 13:43:31'),
(324, 'Ambar Dwi Andhini', 'ambar.andhini@siswa.smansago.com', NULL, '$2y$12$1eZpjuFg5NPeBNlocxvScOPY0fwFcrBwFTcbSbvQvPv5YZwvIJ9XC', 'siswa', NULL, '2026-07-06 06:25:04', '2026-09-03 13:43:31'),
(325, 'AMELIA PUSPITA SARI', 'amelia.sari@siswa.smansago.com', NULL, '$2y$12$PvYo.Bwq26J1du3Y2yJdiemmsVcyK3W7NSvAGMUmqmdwMkzlkDNXa', 'siswa', NULL, '2026-07-06 06:25:04', '2026-09-03 13:43:31'),
(326, 'ANIS CAHYATI', 'anis.cahyati@siswa.smansago.com', NULL, '$2y$12$BQG9TaojdOAYwfUyAktAieK/zkYsf.QTbyuvwtOyqMO./yz6rRxMy', 'siswa', NULL, '2026-07-06 06:25:04', '2026-09-03 13:43:31'),
(327, 'Aqilla Khairunnisa', 'aqilla.khairunnisa@siswa.smansago.com', NULL, '$2y$12$OroWOolfgNL9kU0FxXlDgOoQE/cv06VrX3Dz.wCkApZWFyz9OExTW', 'siswa', NULL, '2026-07-06 06:25:05', '2026-09-03 13:43:31'),
(328, 'ARYA BIMA SAPUTRA', 'arya.saputra@siswa.smansago.com', NULL, '$2y$12$LZ7sXrTAHiReiDsDqRkdzOZur7LYxKenqzNbqSqD0rXhIF5.UQshC', 'siswa', NULL, '2026-07-06 06:25:05', '2026-09-03 13:43:31'),
(329, 'Azahra Azizatul Febriyana', 'azahra.febriyana@siswa.smansago.com', NULL, '$2y$12$4BuHprcTEH6Pwm8dAqhoyeS90cNP3NhpzAbV.3.DYnn7dYpclx/1y', 'siswa', NULL, '2026-07-06 06:25:05', '2026-09-03 13:43:31'),
(330, 'Denil Nur Faizin', 'denil.faizin@siswa.smansago.com', NULL, '$2y$12$sbvRayfQTFuRZjxHmBWGW.F7vPQYbzl9PEh9zguU7dNYuIX8DHVBi', 'siswa', NULL, '2026-07-06 06:25:05', '2026-09-03 13:43:31'),
(331, 'DESTA AYU ARISTA', 'desta.arista@siswa.smansago.com', NULL, '$2y$12$uQciqMnKeIrIzMw.fP.wx.pbsj0knFpddP6Yd0i7oxL/.AO4I2PMC', 'siswa', NULL, '2026-07-06 06:25:06', '2026-09-03 13:43:31'),
(332, 'DIAH AYU SILVIANA', 'diah.silviana@siswa.smansago.com', NULL, '$2y$12$wWMhiSV9QVO7bi32Z74jWeZpCWlr.XeCCXRdXMSMQdUwNjWzBGPw2', 'siswa', NULL, '2026-07-06 06:25:06', '2026-09-03 13:43:31'),
(333, 'DINDA DARA KUSUMA', 'dinda.kusuma@siswa.smansago.com', NULL, '$2y$12$v/5Hky/5VVj94rspSG7T1OBZUkQ2ElHavoWw4kvDmsaAyrJCHm74e', 'siswa', NULL, '2026-07-06 06:25:06', '2026-09-03 13:43:31'),
(334, 'DINI ASTUTI', 'dini.astuti@siswa.smansago.com', NULL, '$2y$12$NoznjKfLnOlbhCd5VrGO0OOH9ZR6q3evw55YV2KwIaTGlYrlbQhGe', 'siswa', NULL, '2026-07-06 06:25:06', '2026-09-03 13:43:31'),
(335, 'EKA AYU LESTARI', 'eka.lestari@siswa.smansago.com', NULL, '$2y$12$ZAmQA3JTT46RTkRUwRmpU.3hMRzyntdbzr3z2GDBHO08HjOTDYYA6', 'siswa', NULL, '2026-07-06 06:25:07', '2026-09-03 13:43:31'),
(336, 'EKA SEPTIANINGSIH', 'eka.septianingsih@siswa.smansago.com', NULL, '$2y$12$6ysAriQlZLo30guz6Auj6OrxbCAoE3ENolsq/IH5l7kIbCGfkqhxa', 'siswa', NULL, '2026-07-06 06:25:07', '2026-09-03 13:43:31'),
(337, 'ERISDA ANUNG WIDAYANI', 'erisda.widayani@siswa.smansago.com', NULL, '$2y$12$jn4iFAo1Vp6krzRmBUF9L.21S9TEwTK7Vk2jN138aWWUc0FelVSaW', 'siswa', NULL, '2026-07-06 06:25:07', '2026-09-03 13:43:31'),
(338, 'IKA WULANDARI', 'ika.wulandari@siswa.smansago.com', NULL, '$2y$12$x3ceeQS5xW3bg3Ph7wF5/emRpyINBDDmUoFr0OZjP4IEjWiWdTru6', 'siswa', NULL, '2026-07-06 06:25:07', '2026-09-03 13:43:31'),
(339, 'ILI YINNA SUFI AL-HAQ', 'ili.alhaq@siswa.smansago.com', NULL, '$2y$12$rHVkbeXx1B67M7DBp2VZbeI2qwy98teKp3xzrb16f94BxIuhCpvZy', 'siswa', NULL, '2026-07-06 06:25:07', '2026-09-03 13:43:31'),
(340, 'IMAM ABDUL AZIS', 'imam.azis@siswa.smansago.com', NULL, '$2y$12$Vl6wQ04ybfegGAStPSABHez.CzTObFntMXRWZ/bahzQPGMtnNCGk2', 'siswa', NULL, '2026-07-06 06:25:08', '2026-09-03 13:43:31'),
(341, 'JESIKA NOVITA RAHMAWATI', 'jesika.rahmawati@siswa.smansago.com', NULL, '$2y$12$7oC2OKc4dLDhprQBrxs9bu2II3NlRFdWFFA/5nFpSRY1JAYYht42m', 'siswa', NULL, '2026-07-06 06:25:08', '2026-09-03 13:43:31'),
(342, 'KAILA YULI YATI', 'kaila.yati@siswa.smansago.com', NULL, '$2y$12$Qx/.cPhsRRz9v/2xLcyURO1szKr7JQsJMGxOr1jEqUxHSvOLoqa4K', 'siswa', NULL, '2026-07-06 06:25:08', '2026-09-03 13:43:31'),
(343, 'KHARISA SUCI LESTARI', 'kharisa.lestari@siswa.smansago.com', NULL, '$2y$12$DghOsuCBR9pvVQesBjy2P.BmsgXE.S/MdF.AOsby1b1Wwq3YibL8.', 'siswa', NULL, '2026-07-06 06:25:08', '2026-09-03 13:43:31'),
(344, 'LUXVI ISTIANA ANNISA', 'luxvi.annisa@siswa.smansago.com', NULL, '$2y$12$Uraa5fWpXnFuCbaZ8S0Oqe9E529Tuv.zN9T8P9aWKEX5pIAZnrWRK', 'siswa', NULL, '2026-07-06 06:25:09', '2026-09-03 13:43:31'),
(345, 'META UTAMI', 'meta.utami@siswa.smansago.com', NULL, '$2y$12$0K3fL4wd8sB38cAm8QNKg.Ry8t5mszqKJxZmY8BX5m.NdAhsL4nAO', 'siswa', NULL, '2026-07-06 06:25:09', '2026-09-03 13:43:31'),
(346, 'MUTIA FIRDASARI', 'mutia.firdasari@siswa.smansago.com', NULL, '$2y$12$LOjUJpkl29D.BJmNMi371ONsxN7b4I6v00kDos1OxDpfAONNYS3Fu', 'siswa', NULL, '2026-07-06 06:25:09', '2026-09-03 13:43:31'),
(347, 'NITA FITRIYANI', 'nita.fitriyani@siswa.smansago.com', NULL, '$2y$12$vDGKdy9dQCoWFTNO1gibBOOX7MuIwgMUaDBLpMrUzsgUpXir1llae', 'siswa', NULL, '2026-07-06 06:25:09', '2026-09-03 13:43:31'),
(348, 'NOVALIA SAFITRI', 'novalia.safitri@siswa.smansago.com', NULL, '$2y$12$p9c7qLVpl47Lw6b1zjm.4.fCHXiefwi7sV7XhaZzWxPaByrYkw8Cu', 'siswa', NULL, '2026-07-06 06:25:10', '2026-09-03 13:43:31'),
(349, 'NOVITA ARUM SARI', 'novita.sari@siswa.smansago.com', NULL, '$2y$12$9.bDW/tfp6uL5o.yMf1sguBkZz4nXzBsxtwL/whuJpDsTaf/q2IBC', 'siswa', NULL, '2026-07-06 06:25:10', '2026-09-03 13:43:31'),
(350, 'Rezky Heru Nitha', 'rezky.nitha@siswa.smansago.com', NULL, '$2y$12$1nP8Qsfubhjm4La96JkrOOBLGTXfkb5fXgmYand2AnAqSrfQEyWRq', 'siswa', NULL, '2026-07-06 06:25:10', '2026-09-03 13:43:31'),
(351, 'RIZKY AMELIYA', 'rizky.ameliya@siswa.smansago.com', NULL, '$2y$12$JSNG7skBnLvqHGUfdnRmm.eEdyNDin1y4KgsUfABI.mwdEpniVWFy', 'siswa', NULL, '2026-07-06 06:25:10', '2026-09-03 13:43:31'),
(352, 'SALSABILAH AGUSTINA', 'salsabilah.agustina@siswa.smansago.com', NULL, '$2y$12$O8NuqtlIORuicl0rvL7P1.sDt/oHDO.BdFFG4ROWunNZUZ9i4Sbpa', 'siswa', NULL, '2026-07-06 06:25:11', '2026-09-03 13:43:31'),
(353, 'SRI BELA NOFITA', 'sri.nofita@siswa.smansago.com', NULL, '$2y$12$tT1.LgnW5GJrBgDoAi03GuBuPYJkoOmyz8Mjwnvu5jyea.NMAE9vu', 'siswa', NULL, '2026-07-06 06:25:11', '2026-09-03 13:43:31'),
(354, 'SYARIFA QUMAIRAH RAMADHANI', 'syarifa.ramadhani@siswa.smansago.com', NULL, '$2y$12$1DyeQuUftGHHkxfT.fM47OexAZUTy5pYUKxXsD6Z8bHk123Ia3qre', 'siswa', NULL, '2026-07-06 06:25:11', '2026-09-03 13:43:31'),
(355, 'TESALONIKA SHARON', 'tesalonika.sharon@siswa.smansago.com', NULL, '$2y$12$MESd8tuG/R.4u8ygwKvP5.POc59DDMUCbN8BRvKaHdcis6vtICGSW', 'siswa', NULL, '2026-07-06 06:25:11', '2026-09-03 13:43:31'),
(356, 'TRI APRILLIA MARDANI', 'tri.mardani@siswa.smansago.com', NULL, '$2y$12$v4KdDy1zyr2pM7zEWr0BGuf75Ngcy/ztRCd0w3p5O4dyqGLz4mDZa', 'siswa', NULL, '2026-07-06 06:25:12', '2026-09-03 13:43:31'),
(357, 'VITA RISTIANTI', 'vita.ristianti@siswa.smansago.com', NULL, '$2y$12$JVje/HkwpJTtoh15FXEyV.JfWgFVLLEfllBLyCqJNyPt1dAsn2xQS', 'siswa', NULL, '2026-07-06 06:25:12', '2026-09-03 13:43:31'),
(358, 'YULIANA WARISMA', 'yuliana.warisma@siswa.smansago.com', NULL, '$2y$12$4KRXRpYB7ZHwwWtwkcOLz.7yVjLJjqRcDZUZjZil5.SyulFbilrrW', 'siswa', NULL, '2026-07-06 06:25:12', '2026-09-03 13:43:31'),
(359, 'ZALFA\' AULIA NAJAH', 'zalfa.najah@siswa.smansago.com', NULL, '$2y$12$beJMoyCwhHVOLbTSHc1AJ.3P59KjUgg9P4bkRSXEHuyPIfLpeSVb.', 'siswa', NULL, '2026-07-06 06:25:12', '2026-09-03 13:43:31'),
(360, 'AIDINA FITRANI WULANDARI', 'aidina.wulandari@siswa.smansago.com', NULL, '$2y$12$2phL0rgGu/A0wfJNYFOvauNm6T0/qfGwUD5KBb/FkBXJNry9DFQdC', 'siswa', NULL, '2026-07-06 06:25:13', '2026-09-03 13:43:31'),
(361, 'AKHDAN GANTARI ATMAJA', 'akhdan.atmaja@siswa.smansago.com', NULL, '$2y$12$CzV/0RMFN.YR9JiyZSkEDeKjPWU0ngOMfpVasSVq0/FPt5eBmwD2m', 'siswa', NULL, '2026-07-06 06:25:13', '2026-09-03 13:43:31'),
(362, 'ALINEA TITIAN', 'alinea.titian@siswa.smansago.com', NULL, '$2y$12$FO2dFVnDSUuSv/fVuwLAy.7Cj53zJYyRrgxnUKJOA98QEZnv/ZO.2', 'siswa', NULL, '2026-07-06 06:25:13', '2026-09-03 13:43:31'),
(363, 'AMIRA ZAHWA AZIZAH', 'amira.azizah@siswa.smansago.com', NULL, '$2y$12$7e1YxQoy.EsIgw2Pz5mlFud7yStngb2T4zn63EK5bz7ucF0UydIrK', 'siswa', NULL, '2026-07-06 06:25:13', '2026-09-03 13:43:31'),
(364, 'ANANDA PUTRI', 'ananda.putri@siswa.smansago.com', NULL, '$2y$12$t3DH/WBq0HeU6qhrbGa1y.Qsen.S9Uc7d8hi.Qfg9kQz74BnupfKO', 'siswa', NULL, '2026-07-06 06:25:14', '2026-09-03 13:43:31'),
(365, 'ARUM FEBRIANTI', 'arum.febrianti@siswa.smansago.com', NULL, '$2y$12$K/mtfaAiFxJUz27cQtmBL.gtLeozQ/Fjwi3QQ/EerZI9gKf2i.I26', 'siswa', NULL, '2026-07-06 06:25:14', '2026-09-03 13:43:31'),
(366, 'AYU MALINA FEBRIYA', 'ayu.febriya@siswa.smansago.com', NULL, '$2y$12$NE4ClJ3GtB6lbaF/ToK4vuuBOL9rlAjpyAdnpyZoW1xll7.E.W8Uu', 'siswa', NULL, '2026-07-06 06:25:14', '2026-09-03 13:43:31'),
(367, 'BAMBANG PRI HARTANTO', 'bambang.hartanto@siswa.smansago.com', NULL, '$2y$12$ZY/ZG/efreQ71EPkiOZtHOK.ABeBOk3kPJHVTY4aG2vTxG4y5B9Jm', 'siswa', NULL, '2026-07-06 06:25:14', '2026-09-03 13:43:31'),
(368, 'EKA SITI AMINATUN', 'eka.aminatun@siswa.smansago.com', NULL, '$2y$12$qCrkHL5Ig6sOV2oBBGing.LtFUlkluMeiJHpjsNKl.1msGcZgZOXS', 'siswa', NULL, '2026-07-06 06:25:15', '2026-09-03 13:43:31'),
(369, 'ERIKA AULIA AMBARWATI', 'erika.ambarwati@siswa.smansago.com', NULL, '$2y$12$mygvDDtuxRucl6uaGOmmhu1Wbub0nVuCUKz0VwD3Cv9JxhUACau9i', 'siswa', NULL, '2026-07-06 06:25:15', '2026-09-03 13:43:31'),
(370, 'Fajar Puryanti', 'fajar.puryanti@siswa.smansago.com', NULL, '$2y$12$5kriRMooLfir7Dqwk4JJ8.PZP3lRF64TgnVgJ2O4wyoO1mC7zUyBy', 'siswa', NULL, '2026-07-06 06:25:15', '2026-09-03 13:43:31'),
(371, 'GIGIH BUDIYARTO', 'gigih.budiyarto@siswa.smansago.com', NULL, '$2y$12$gvxzYy9ciJendmZtQioO2.dor1kXHVz6meIGhonlUZ/Zn1ea/sU0C', 'siswa', NULL, '2026-07-06 06:25:15', '2026-09-03 13:43:31'),
(372, 'HABIBAH ELFARIZQI', 'habibah.elfarizqi@siswa.smansago.com', NULL, '$2y$12$hrqygPqv4OKjt9J50stUxe9pxbEuDSBG/mVldb5J.Thszk/972W9q', 'siswa', NULL, '2026-07-06 06:25:16', '2026-09-03 13:43:31'),
(373, 'HELNIDA RANNY TAKHEL', 'helnida.takhel@siswa.smansago.com', NULL, '$2y$12$zMLXmqDZeM03MwysaW3wqOWLUR46LizAexSfdrF.hxkpAsNBjXov6', 'siswa', NULL, '2026-07-06 06:25:16', '2026-09-03 13:43:31'),
(374, 'IKA NOVIANI', 'ika.noviani@siswa.smansago.com', NULL, '$2y$12$AOPKd/eg75D4LjPJ888i8O76t4JTU4SfvuGAKuP5Zbb3NyT1vESdy', 'siswa', NULL, '2026-07-06 06:25:16', '2026-09-03 13:43:31'),
(375, 'INTAN NURAINI', 'intan.nuraini@siswa.smansago.com', NULL, '$2y$12$Jjfo0F1SBP6SMU7k7caJbO6O6UV649MVueRi/eENFoVUZWGHde8cq', 'siswa', NULL, '2026-07-06 06:25:16', '2026-09-03 13:43:31'),
(376, 'Kholifah Alya Mufidah', 'kholifah.mufidah@siswa.smansago.com', NULL, '$2y$12$Cqguzh6zhqzv1AihftBAzurII5DCydCzTu9rj8BI8JtJ294l.HoYa', 'siswa', NULL, '2026-07-06 06:25:17', '2026-09-03 13:43:31'),
(377, 'LINDA SURYANI', 'linda.suryani@siswa.smansago.com', NULL, '$2y$12$fjzfL4GO51RCfxU3uhoEPeMnHSv8hxJi.IlLcpy58b8/U3lu2EpnC', 'siswa', NULL, '2026-07-06 06:25:17', '2026-09-03 13:43:31'),
(378, 'MASAYU DIVA KHARISMA', 'masayu.kharisma@siswa.smansago.com', NULL, '$2y$12$NXySE16aAL/COKma2Ltqx.B8SyYQ.NOCifCWhEggWN/wVacirOxyK', 'siswa', NULL, '2026-07-06 06:25:17', '2026-09-03 13:43:31'),
(379, 'MAULIANA RAHMANING TYAS', 'mauliana.tyas@siswa.smansago.com', NULL, '$2y$12$pJgBJH92.SbafK2Y5zgi1OMHtNNRrCnWyGkwCny0RRvvoQgQJEgHa', 'siswa', NULL, '2026-07-06 06:25:17', '2026-09-03 13:43:31'),
(380, 'Melinda Nadine Saputri', 'melinda.saputri@siswa.smansago.com', NULL, '$2y$12$RmRDc2u4ncQpeBNje2Mwf.SnwgxWSXYhMFRSY4FhNvAZD2j9ydSk.', 'siswa', NULL, '2026-07-06 06:25:18', '2026-09-03 13:43:31'),
(381, 'Menik Sugiyarti', 'menik.sugiyarti@siswa.smansago.com', NULL, '$2y$12$o1o2NGyZKKon6pSv/e.HR.DCd/vurcequVsYiKVRfLkJyWOpmB5zW', 'siswa', NULL, '2026-07-06 06:25:18', '2026-09-03 13:43:31'),
(382, 'NADILA SYIFAURROHMAH', 'nadila.syifaurrohmah@siswa.smansago.com', NULL, '$2y$12$VrnDRoXWvNyHDhiHFIIqQOMjvDyNCCk5tHBF6AOJu7wqhcNnFjo8K', 'siswa', NULL, '2026-07-06 06:25:18', '2026-09-03 13:43:31'),
(383, 'NAURA YASMIN ZAAFARANI', 'naura.zaafarani@siswa.smansago.com', NULL, '$2y$12$EfC4j8G8zFq480qifJhYweHsMSCoHR1e2biopisskCYtRdnCnIig.', 'siswa', NULL, '2026-07-06 06:25:18', '2026-09-03 13:43:31'),
(384, 'NUR ANGGA PRATAMA', 'nur.pratama@siswa.smansago.com', NULL, '$2y$12$UiMmTBM6ehDVKY4cPfizB.wDlD6X1.P6bLEXlSFCBt.MuBvf3ae2.', 'siswa', NULL, '2026-07-06 06:25:19', '2026-09-03 13:43:31'),
(385, 'NUR RAMADHANA NABABAN', 'nur.nababan@siswa.smansago.com', NULL, '$2y$12$t/Dmw5T.RmkBAyL/fix48.Ekz.B1q077zJgKzvSEeC8JjJDDxH4Uu', 'siswa', NULL, '2026-07-06 06:25:19', '2026-09-03 13:43:31'),
(386, 'NURUL EKA YULIANTI', 'nurul.yulianti@siswa.smansago.com', NULL, '$2y$12$AHS21eS2mNGAMKIz.cH.7.rB2rd2W3VdLaSxFjoxJPQsavxw9jyoa', 'siswa', NULL, '2026-07-06 06:25:19', '2026-09-03 13:43:31'),
(387, 'RAYA FITRIA OKTAFIANI', 'raya.oktafiani@siswa.smansago.com', NULL, '$2y$12$HxqHCsIur0o1kq1RyL2BBu.fJvYggD3Du9yKqyyUDNBZGDz6Hq.Zm', 'siswa', NULL, '2026-07-06 06:25:19', '2026-09-03 13:43:31'),
(388, 'REIVA STECY EKA LAURA', 'reiva.laura@siswa.smansago.com', NULL, '$2y$12$6Y2cjAnF4PKGJ5Ds.w6dpuA2vP1cBEvtfp7/lm3pCPBkTeXmdUok6', 'siswa', NULL, '2026-07-06 06:25:20', '2026-09-03 13:43:31'),
(389, 'SALSA AULIA PUTRI', 'salsa.putri@siswa.smansago.com', NULL, '$2y$12$7h/2ugll8eWluThKCYVpPOUQT21atoPr0gOB2Dd9eZVqM5YJNnYuW', 'siswa', NULL, '2026-07-06 06:25:20', '2026-09-03 13:43:31'),
(390, 'SRI WAHYU RAHMASARI', 'sri.rahmasari@siswa.smansago.com', NULL, '$2y$12$XNyEyPbzVPCcImbpTBdBt.bBFhjTlD/TN4481lbh9LvrEtzp3kFZS', 'siswa', NULL, '2026-07-06 06:25:20', '2026-09-03 13:43:31'),
(391, 'SYAFALINA ANISA FEBRIYANTI', 'syafalina.febriyanti@siswa.smansago.com', NULL, '$2y$12$7XjzmNaRgTjDn.adSAGK8uCTogz2lO59N.iCYVjpIjoSHdK4ioRsG', 'siswa', NULL, '2026-07-06 06:25:20', '2026-09-03 13:43:31'),
(392, 'VEGA UBIYANA', 'vega.ubiyana@siswa.smansago.com', NULL, '$2y$12$RswVBw4XTp4KLe/iPvedZOgfjdBhs9WdufaFNszSvgqpLL8/vDR4e', 'siswa', NULL, '2026-07-06 06:25:20', '2026-09-03 13:43:31'),
(393, 'YIN YANG KESHILA CHEUNG', 'yin.cheung@siswa.smansago.com', NULL, '$2y$12$xLeXDPZ8Lqjr/aBz.BjvEet3YzdNlb0yZQa7RT3rOTggoExntlP5G', 'siswa', NULL, '2026-07-06 06:25:21', '2026-09-03 13:43:31'),
(394, 'Zahra Fitri Septiana', 'zahra.septiana@siswa.smansago.com', NULL, '$2y$12$XaF4reZ63ri1d2LEhO1JrOzskVZO0oUYZez0mFMTJ7lyr8QdO9s/q', 'siswa', NULL, '2026-07-06 06:25:21', '2026-09-03 13:43:31'),
(395, 'Adi Heri Pramono', 'adi.pramono@siswa.smansago.com', NULL, '$2y$12$mO9Cbecvf9aaDJXg2n0ARuyMmBDLvShIuRDI5wxPZVdG3ZTF8QekO', 'siswa', NULL, '2026-07-06 06:25:21', '2026-09-03 13:43:31'),
(396, 'Akna Mumtaz Ilmi', 'akna.ilmi@siswa.smansago.com', NULL, '$2y$12$trC6L9ewh6d5Dl.FGLWwH.zFyxfnZHprl/Cvoa1Ofkw7Pkj3dXdie', 'siswa', NULL, '2026-07-06 06:25:22', '2026-09-03 13:43:31'),
(397, 'ANGGUN SAL SABILA', 'anggun.sabila@siswa.smansago.com', NULL, '$2y$12$tAcwZvDCybEtXKsITgZ6beytqzrRgDyXVcTIL5a1cXVAQkyEfME5m', 'siswa', NULL, '2026-07-06 06:25:22', '2026-09-03 13:43:31'),
(398, 'ANUGRAH MAULINA RAHMAWATI', 'anugrah.rahmawati@siswa.smansago.com', NULL, '$2y$12$SLW1PEIJWua2h6eiC.w0BO96UqBu8m7H2XttpSXWMEnNGxMsBzFT6', 'siswa', NULL, '2026-07-06 06:25:22', '2026-09-03 13:43:31'),
(399, 'Asri Arum Ningtyas', 'asri.ningtyas@siswa.smansago.com', NULL, '$2y$12$n/bdLgA8PAFVh42zdKDGherygW/Y6R0GrBT2djrOfBi9o0KQAFdme', 'siswa', NULL, '2026-07-06 06:25:22', '2026-09-03 13:43:31'),
(400, 'AULIA DINDA PRAMASTYA', 'aulia.pramastya@siswa.smansago.com', NULL, '$2y$12$uwNFFhhH5bBZaoeypXaN/ueQeahFDOFXKMj4fqoBzJtBBogWkSajm', 'siswa', NULL, '2026-07-06 06:25:22', '2026-09-03 13:43:31'),
(401, 'AULITA TRI KUMANDA YAFI', 'aulita.yafi@siswa.smansago.com', NULL, '$2y$12$Us6yuJbSFperrvUVyFOpbuSqByFYTN.DOxYHjJTHcGsZ.k9oQsuxC', 'siswa', NULL, '2026-07-06 06:25:23', '2026-09-03 13:43:31'),
(402, 'AYUDYA PRATIWI', 'ayudya.pratiwi@siswa.smansago.com', NULL, '$2y$12$AynZW6UBYK2YRCiQ3b06Fen1ulSnzjRHkK8o4wCwDoFqu0g0si5X.', 'siswa', NULL, '2026-07-06 06:25:23', '2026-09-03 13:43:31'),
(403, 'BAYU AJI PURNOMO', 'bayu.purnomo@siswa.smansago.com', NULL, '$2y$12$Bbi.p4/Wp8RhWGx4LfmrUuAUFER4he4amiEDhebLD.IcTAUt8HjUe', 'siswa', NULL, '2026-07-06 06:25:23', '2026-09-03 13:43:31'),
(404, 'DEA FATMAWATI', 'dea.fatmawati@siswa.smansago.com', NULL, '$2y$12$JdiHo4SS3hHbio86Nn2amOeUQzKuuZeHl7.iaS/RzGAWlEO22va5S', 'siswa', NULL, '2026-07-06 06:25:23', '2026-09-03 13:43:31'),
(405, 'DESI LUSIANA PURNAMASARI', 'desi.purnamasari@siswa.smansago.com', NULL, '$2y$12$vx8/Ed0h3kkkkXO5RSj18ObK/QkAjBznWHtI7ejEpgBa54q1.XruK', 'siswa', NULL, '2026-07-06 06:25:24', '2026-09-03 13:43:31'),
(406, 'DHEA SAFIRA', 'dhea.safira@siswa.smansago.com', NULL, '$2y$12$hjmLicdYMbFpOqMBQ1XeH.6jtq/WwWy4hFbAdyrUXBTyEUN/ABQI6', 'siswa', NULL, '2026-07-06 06:25:24', '2026-09-03 13:43:31'),
(407, 'DIVA TRI ANDRIANI', 'diva.andriani@siswa.smansago.com', NULL, '$2y$12$6dYTJlls47A1veeVErySYuM0EUM73AWQ.j2snfysMpMP9Iam2Clqm', 'siswa', NULL, '2026-07-06 06:25:24', '2026-09-03 13:43:31'),
(408, 'Eko Priyanto', 'eko.priyanto@siswa.smansago.com', NULL, '$2y$12$wCTQJPlnb8/AjdLFCzgmq.76rXCE2m1G3fjXpZtrdS8qDAasmwJZe', 'siswa', NULL, '2026-07-06 06:25:24', '2026-09-03 13:43:31'),
(409, 'EVALDO FIAN AFRIZA', 'evaldo.afriza@siswa.smansago.com', NULL, '$2y$12$k1jqr2IrXudWqgy2Sb1Hou9P386Mz.4jBlGo9jEnG/D.EZVBygeRO', 'siswa', NULL, '2026-07-06 06:25:25', '2026-09-03 13:43:31'),
(410, 'FATIMAH NUR YULIANI', 'fatimah.yuliani@siswa.smansago.com', NULL, '$2y$12$uzrIM.aCBUwLoBxyLzy.ju8y/Nb5CQxB80QnXgS.ZTJvNTTLr0INC', 'siswa', NULL, '2026-07-06 06:25:25', '2026-09-03 13:43:31'),
(411, 'HAFIDH ALBAR', 'hafidh.albar@siswa.smansago.com', NULL, '$2y$12$8vziMQYK6VCl95SGJi8o2.8rxNP6ErXzirYAvHSLctXj4ZhWtYFGC', 'siswa', NULL, '2026-07-06 06:25:25', '2026-09-03 13:43:31'),
(412, 'HANNA SALSABILA', 'hanna.salsabila@siswa.smansago.com', NULL, '$2y$12$x6n93USZLVKazxB3vQndCex6KXjM41SZp..AiIONS8QblxO7ziC1a', 'siswa', NULL, '2026-07-06 06:25:25', '2026-09-03 13:43:31'),
(413, 'Intan Putri Utami', 'intan.utami@siswa.smansago.com', NULL, '$2y$12$mRJLxcjm1yqYt4uUUDzxoep5id53DE/ZqA59RYTkcznQeiWv3udQG', 'siswa', NULL, '2026-07-06 06:25:26', '2026-09-03 13:43:31'),
(414, 'LISTA SRI WAHYU LESTARI', 'lista.lestari@siswa.smansago.com', NULL, '$2y$12$ILEsvpWVE2RRX/TUbzO8K.OCT8un9z7a/dYGIPtBufCLip//D49d2', 'siswa', NULL, '2026-07-06 06:25:26', '2026-09-03 13:43:31'),
(415, 'MEISA NURAINI', 'meisa.nuraini@siswa.smansago.com', NULL, '$2y$12$ja3S6uxtyu7C/E4xA/zXTONF7d09F1RdHSkWn18TbLehUvnQuWQnu', 'siswa', NULL, '2026-07-06 06:25:26', '2026-09-03 13:43:31'),
(416, 'MUHAMAD AGUNG PRATAMA', 'muhamad.pratama@siswa.smansago.com', NULL, '$2y$12$HmCn.GyI8WQvjTIipx6gXu1WKid3V5oZiqWu6YxY/f6O85vIT.im.', 'siswa', NULL, '2026-07-06 06:25:26', '2026-09-03 13:43:31'),
(417, 'Muhamad Arifin', 'muhamad.arifin@siswa.smansago.com', NULL, '$2y$12$4buSCko0T6yAf5t2P41BiOg1RwBTWL0tVUKLaujPVJE6foX2G2s46', 'siswa', NULL, '2026-07-06 06:25:27', '2026-09-03 13:43:31'),
(418, 'MUHAMAD DWI ARDIYANTO', 'muhamad.ardiyanto@siswa.smansago.com', NULL, '$2y$12$5dxdLy3Wk6f0mgQznyUvMu5LywqwSLyt6EhXq8CtwQaYz.zaqavCS', 'siswa', NULL, '2026-07-06 06:25:27', '2026-09-03 13:43:31'),
(419, 'MUHAMMAD RIZKI ADITIYA', 'muhammad.aditiya@siswa.smansago.com', NULL, '$2y$12$kiROyFv3lt3zO13u8HHTUuSOdvjxKCq1aEq.fKZ4HWPR8m29UyIIa', 'siswa', NULL, '2026-07-06 06:25:27', '2026-09-03 13:43:31'),
(420, 'MUHAMMAD TYO ARDIANSYAH', 'muhammad.ardiansyah@siswa.smansago.com', NULL, '$2y$12$GluE07KVeC89YQzRjiLJ6er0ygXutXiffZ5K69FvuOKU2TFV/7vY2', 'siswa', NULL, '2026-07-06 06:25:27', '2026-09-03 13:43:31'),
(421, 'NADYA KHOIRUN NISWAN', 'nadya.niswan@siswa.smansago.com', NULL, '$2y$12$XX41J93rXhdkGbtJgcTKgu1T8TPEvn17ChWiGtF/vvz9aYfBqsDpK', 'siswa', NULL, '2026-07-06 06:25:28', '2026-09-03 13:43:31'),
(422, 'NASWA AULIA PREHANTY', 'naswa.prehanty@siswa.smansago.com', NULL, '$2y$12$xer6aUcOOBwwcnG2EOZ45.qdYrYqq7XUEeFgBwEYid3Ei9UgIdRy2', 'siswa', NULL, '2026-07-06 06:25:28', '2026-09-03 13:43:31'),
(423, 'Natali Kris Diovani', 'natali.diovani@siswa.smansago.com', NULL, '$2y$12$RiiJkwNLraZ8j6pAiXlRcu5BT8gx3fWvwrG8tkL9wmJF05TFV00uu', 'siswa', NULL, '2026-07-06 06:25:28', '2026-09-03 13:43:31'),
(424, 'Novia Maulinda', 'novia.maulinda@siswa.smansago.com', NULL, '$2y$12$J0I1EdP925KjhUcv6IWUWOVyJHR.axKTQRg3CsXKzo8/0tApPfzBi', 'siswa', NULL, '2026-07-06 06:25:28', '2026-09-03 13:43:31'),
(425, 'NOVIANA ROKHALI', 'noviana.rokhali@siswa.smansago.com', NULL, '$2y$12$ie99DO8/uTHVqPD42vEv/.5s0umsuLAYB44vLpFRG3Osthmvilsg.', 'siswa', NULL, '2026-07-06 06:25:29', '2026-09-03 13:43:31'),
(426, 'Ridho Deni Kiswanto', 'ridho.kiswanto@siswa.smansago.com', NULL, '$2y$12$ErrAL67ahqQtBW5NzT..Y.rc51DIfZHOehmLGIiWPCZXU8S6Q7NjS', 'siswa', NULL, '2026-07-06 06:25:29', '2026-09-03 13:43:31'),
(427, 'RIZKY SETIADI', 'rizky.setiadi@siswa.smansago.com', NULL, '$2y$12$87rTl2DeWeFE/7RxIk.Rfu3yAEkw5ROc53b971L6evhwlvDXcfYlu', 'siswa', NULL, '2026-07-06 06:25:29', '2026-09-03 13:43:31'),
(428, 'Salman Bajradaram', 'salman.bajradaram@siswa.smansago.com', NULL, '$2y$12$7vpOUmuJ/dXaw30byWv1wemhwrMciFUusxNggNA7dkNCK5vkUrFQ6', 'siswa', NULL, '2026-07-06 06:25:29', '2026-09-03 13:43:31'),
(429, 'TRIYONO', 'triyono@siswa.smansago.com', NULL, '$2y$12$P22uhR9uxM7wozzk2WkhHuvxVE1nSTZQLxbvVqnQcXAsjdlYNUdzG', 'siswa', NULL, '2026-07-06 06:25:30', '2026-09-03 13:43:31'),
(430, 'Wongayu Jenar Mahesa', 'wongayu.mahesa@siswa.smansago.com', NULL, '$2y$12$ElPaFIusaKKGd09CqIT5qemVjLwKp0Py/PyfkZtUZHhylN.nUjj4O', 'siswa', NULL, '2026-07-06 06:25:30', '2026-09-03 13:43:31'),
(431, 'AGIP WIJANARKO', 'agip.wijanarko@siswa.smansago.com', NULL, '$2y$12$0MUdayXq.X8asKS8SvS4p.bwrS/P4OGBD4MOxgzTl0HkF/LbHmk06', 'siswa', NULL, '2026-07-06 06:25:30', '2026-09-03 13:43:31'),
(432, 'AGUS SRIYONO', 'agus.sriyono@siswa.smansago.com', NULL, '$2y$12$/S92QNbMzVRmbjmshlruFeHXJfuENdinjBuNOdmFgSiVpzRHBeL3m', 'siswa', NULL, '2026-07-06 06:25:30', '2026-09-03 13:43:31'),
(433, 'Ahmad fauzan fathurroziq', 'ahmad.fathurroziq@siswa.smansago.com', NULL, '$2y$12$iiIlGcX3VaWCEpY3Uzwm7OZgKl6gp9cxTtEuOkjPJ9ore4knQ1h12', 'siswa', NULL, '2026-07-06 06:25:31', '2026-09-03 13:43:31'),
(434, 'ALI MUSTOFA', 'ali.mustofa@siswa.smansago.com', NULL, '$2y$12$0AHrruvQcHBkHr6UYUGaJe8qRpY8ewfe98QdI1MF/r0kESmP7x29W', 'siswa', NULL, '2026-07-06 06:25:31', '2026-09-03 13:43:31'),
(435, 'ALIEFAH ADJENG ARYA NINGSIH', 'aliefah.ningsih@siswa.smansago.com', NULL, '$2y$12$U.SoCTl9FtR8cpZOqrKOoeMg9.gquDR.S7X8Yvc1d1cEhX57KYObe', 'siswa', NULL, '2026-07-06 06:25:31', '2026-09-03 13:43:31'),
(436, 'ANIS PUJI LESTARI', 'anis.lestari@siswa.smansago.com', NULL, '$2y$12$gxqRjMSOPoM6fs1zvB1S9OwET6/ipRkF.p3WvH9xWsGTtyvQ8bESa', 'siswa', NULL, '2026-07-06 06:25:32', '2026-09-03 13:43:31'),
(437, 'ANITA NOVIYANTI', 'anita.noviyanti@siswa.smansago.com', NULL, '$2y$12$vjp/Hyc4LsB/ngBPC72hBumgBnfciE9MHceYNSOmO3ZL5yzQnIMBm', 'siswa', NULL, '2026-07-06 06:25:32', '2026-09-03 13:43:31'),
(438, 'ARMADITA PRIHATINI', 'armadita.prihatini@siswa.smansago.com', NULL, '$2y$12$qY.mEJMZggJcW9ewUj9Tb.VPEwipKHaWcz9l2IQsWxs8xHIUfx29C', 'siswa', NULL, '2026-07-06 06:25:32', '2026-09-03 13:43:31'),
(439, 'CALLISTA GISELA GITAFREYA', 'callista.gitafreya@siswa.smansago.com', NULL, '$2y$12$pemMwZmw7nAu9iztP0mFZ.VfjtiNe0x.Yo3EGMjHw3yoIjEuKjY4O', 'siswa', NULL, '2026-07-06 06:25:32', '2026-09-03 13:43:31'),
(440, 'Dwi Lestari', 'dwi.lestari@siswa.smansago.com', NULL, '$2y$12$rzGrCFpA41VK9iGZPOZAh.By9jqE9PCpzSZhM2SZMVi4e3ZVWSXXu', 'siswa', NULL, '2026-07-06 06:25:33', '2026-09-03 13:43:31'),
(441, 'FEBRIAN WAHYU PRATAMA', 'febrian.pratama@siswa.smansago.com', NULL, '$2y$12$PLLp5eimK6cZSnXV32MzXusQyJx.kuAy3z1tCVZM/ZiU6d2q8SGCO', 'siswa', NULL, '2026-07-06 06:25:33', '2026-09-03 13:43:31'),
(442, 'FELYSA EKA HIDAYANTI', 'felysa.hidayanti@siswa.smansago.com', NULL, '$2y$12$0lxdKN7palxA2CpHHiiJG.AnJx8OBAtMT.1u/D5C8coM67gRwpP46', 'siswa', NULL, '2026-07-06 06:25:33', '2026-09-03 13:43:31'),
(443, 'HAFID RIZAL DANENDRA', 'hafid.danendra@siswa.smansago.com', NULL, '$2y$12$XipZQfj8azwUz9fPBmqyhO5dEFED6j24/9xTPjwAPrKZpWyBKhqoS', 'siswa', NULL, '2026-07-06 06:25:33', '2026-09-03 13:43:31'),
(444, 'HANUNG DEWI NOVIANI', 'hanung.noviani@siswa.smansago.com', NULL, '$2y$12$YoqI9RVMF5Ljq47a4rIyBOxO8R7z0r4A47rR6TimoRvRpMRmqD90m', 'siswa', NULL, '2026-07-06 06:25:34', '2026-09-03 13:43:31'),
(445, 'Khanza Dwi Khoirun Nisa', 'khanza.nisa@siswa.smansago.com', NULL, '$2y$12$GVfev5HOyX4hkvcpl6apquRH.dCaZ57tkd7UvMliwoTp5GNN69Lbu', 'siswa', NULL, '2026-07-06 06:25:34', '2026-09-03 13:43:31'),
(446, 'KRISBIYANTO', 'krisbiyanto@siswa.smansago.com', NULL, '$2y$12$.7BbtYWedq1TVjPeTX5/Lu8au2BcpQO0QBHpxbws/hTSYZM5v2bGC', 'siswa', NULL, '2026-07-06 06:25:34', '2026-09-03 13:43:31'),
(447, 'KURNIAWAN DEWA PAMBUDI', 'kurniawan.pambudi@siswa.smansago.com', NULL, '$2y$12$Hf6eE2l3JIA3tC3.J2pedecEKwyiJDTtE5oujYo0Pymo3Ex/TqCBS', 'siswa', NULL, '2026-07-06 06:25:34', '2026-09-03 13:43:31'),
(448, 'MUHAMMAD ANWAR', 'muhammad.anwar@siswa.smansago.com', NULL, '$2y$12$UvK.aaCC4nbJhXPYbX6x3eBP07lIcfacV87owR9cAXINbxKNj.bXy', 'siswa', NULL, '2026-07-06 06:25:35', '2026-09-03 13:43:31'),
(449, 'MUTIARA', 'mutiara@siswa.smansago.com', NULL, '$2y$12$wRmQLC9G5ECIbgj3lSsj2OJwpMZXniCXBUucWJ8.eZI1WwPw.fPZS', 'siswa', NULL, '2026-07-06 06:25:35', '2026-09-03 13:43:31'),
(450, 'NAYLA ADIAS PRATIWI', 'nayla.pratiwi@siswa.smansago.com', NULL, '$2y$12$e5sFH49B/iQ3Z8pGI6KlEuupfVk6GKZ/NmWMfjROCEF.Uu97QItKy', 'siswa', NULL, '2026-07-06 06:25:35', '2026-09-03 13:43:31'),
(451, 'Ni Wayan Febriyan', 'ni.febriyan@siswa.smansago.com', NULL, '$2y$12$TYq7beZAP/tsEuF4LVemXu7lgh/NPbPad0nBX4AG3B3CzDWyfQvbe', 'siswa', NULL, '2026-07-06 06:25:35', '2026-09-03 13:43:31'),
(452, 'PUJI RAHAYU', 'puji.rahayu@siswa.smansago.com', NULL, '$2y$12$Pi9axhGBNUaMKde.B0OTY.EKyczf4W8pFWYgFVZc4SZYIKh.aS1va', 'siswa', NULL, '2026-07-06 06:25:36', '2026-09-03 13:43:31'),
(453, 'RAIHAN DAMAR PANULUH', 'raihan.panuluh@siswa.smansago.com', NULL, '$2y$12$PdI9YMpExM2kchdl.skM5e5gYsdBXZ28l/fDUC4ltqGbIekDkRU7m', 'siswa', NULL, '2026-07-06 06:25:36', '2026-09-03 13:43:31'),
(454, 'RIFKY DWI HANDIKA', 'rifky.handika@siswa.smansago.com', NULL, '$2y$12$qHlIxvXqGRo/ZUGh36.YYOJJHuW0lF1BE71lYWIEel/TeELme/2GK', 'siswa', NULL, '2026-07-06 06:25:36', '2026-09-03 13:43:31'),
(455, 'RIFQI AKBAR PRADITA', 'rifqi.pradita@siswa.smansago.com', NULL, '$2y$12$gbPCx2gYw9k/WA49X8H07..Q1MG50FhZGHXbImzTm8nw0V2mYVGPy', 'siswa', NULL, '2026-07-06 06:25:36', '2026-09-03 13:43:31'),
(456, 'SAHDA ARISTA ROFILAH', 'sahda.rofilah@siswa.smansago.com', NULL, '$2y$12$elKuEEwIA5FWcsKD2EsTMuPGN0OYlfSpPEOYas7Yhz4KwRptnjk6e', 'siswa', NULL, '2026-07-06 06:25:37', '2026-09-03 13:43:31'),
(457, 'Septya Ramadhani', 'septya.ramadhani@siswa.smansago.com', NULL, '$2y$12$q0JNEETMKO9MGkNxcAZ3YOjc/sqtbVtVf75CJJfsKQsqWTV78O5O.', 'siswa', NULL, '2026-07-06 06:25:37', '2026-09-03 13:43:31'),
(458, 'SITI NUR WASI\'ATUL BADRIAH', 'siti.badriah@siswa.smansago.com', NULL, '$2y$12$OqNVy7g.9ozSGNiIQUlKRuiUXiIGJBK8cEgeyGXNGMskPUrdguVsK', 'siswa', NULL, '2026-07-06 06:25:37', '2026-09-03 13:43:31'),
(459, 'TAUFIK HIDAYAT', 'taufik.hidayat@siswa.smansago.com', NULL, '$2y$12$V60lw1iZb4owGX./7oZ4Peyv1Re4YH8F6kGfTAf29kkjwjkv/QWUm', 'siswa', NULL, '2026-07-06 06:25:37', '2026-09-03 13:43:31'),
(460, 'Vicky Putra Ramadan', 'vicky.ramadan@siswa.smansago.com', NULL, '$2y$12$XJYhc3Z2yx8AYMiCkVUS1u58i2NdvLDhSgAGVFrzHjn8Op6HE3z5W', 'siswa', NULL, '2026-07-06 06:25:38', '2026-09-03 13:43:31'),
(461, 'VIKY FAHRURODIN OKTARA', 'viky.oktara@siswa.smansago.com', NULL, '$2y$12$yoUx9E6Yw9FpGVQA1QrCQeHs.iXsXCvwzEv6hYygjAgf0wDliwTNG', 'siswa', NULL, '2026-07-06 06:25:38', '2026-09-03 13:43:31'),
(462, 'WAHYU BAYUTRI SETIANA', 'wahyu.setiana@siswa.smansago.com', NULL, '$2y$12$AEtYnfAEOuQl7cAQ684/qurnCkAmTanIgvpBvT5TtbGEckj4SynDW', 'siswa', NULL, '2026-07-06 06:25:38', '2026-09-03 13:43:31'),
(463, 'YULIANA PUTRI LISTIYONO', 'yuliana.listiyono@siswa.smansago.com', NULL, '$2y$12$TcgI4J1wXkNrxkuatjLib.aCSbXgSwKFzcGoC6WMK6Znmoew3m8Ui', 'siswa', NULL, '2026-07-06 06:25:38', '2026-09-03 13:43:31'),
(464, 'AAN KURNIAWAN', 'aan.kurniawan@siswa.smansago.com', NULL, '$2y$12$flwFlF4UJI62HFQ1CDxleeG5ZobKkU42zj0dKQ6DpAGkqMg.oumvS', 'siswa', NULL, '2026-07-06 06:25:39', '2026-09-03 13:43:31'),
(465, 'AFIFA MERLIN PRAMESTI AYU ASTUTI', 'afifa.astuti@siswa.smansago.com', NULL, '$2y$12$CHmuXpCVH2qmllqFYeBGl.uR8eEELB8DXHZ3YnatLypL.jLFXl1Oa', 'siswa', NULL, '2026-07-06 06:25:39', '2026-09-03 13:43:31'),
(466, 'Alenta Rahmawati', 'alenta.rahmawati@siswa.smansago.com', NULL, '$2y$12$ys.E8Xj9zV8d4Qvf1JKuIuSwhq70iVMM/8mMkMIMZjEzV6DkhFMsG', 'siswa', NULL, '2026-07-06 06:25:39', '2026-09-03 13:43:31'),
(467, 'ALIF SAPUTRA', 'alif.saputra@siswa.smansago.com', NULL, '$2y$12$w45NmZyeWyl8p7w6nsd2JeTU4Bmu1TPq6j8.VBtfCAsRIsBQHGtg.', 'siswa', NULL, '2026-07-06 06:25:39', '2026-09-03 13:43:31'),
(468, 'APRILIA UMAEROH', 'aprilia.umaeroh@siswa.smansago.com', NULL, '$2y$12$xfoWyKycUj4VvYyNOV.3FuBWYlHrA8erNlzM57chgdTlUhsQ40OoW', 'siswa', NULL, '2026-07-06 06:25:40', '2026-09-03 13:43:31'),
(469, 'APRILIA WULANDARI', 'aprilia.wulandari@siswa.smansago.com', NULL, '$2y$12$.TWF/62u5zh4gGD4ewa0zOMY9OyQgBeQVEZLFuCF6UfNIFL4MBNAe', 'siswa', NULL, '2026-07-06 06:25:40', '2026-09-03 13:43:31'),
(470, 'ARDAN RAFIANTO', 'ardan.rafianto@siswa.smansago.com', NULL, '$2y$12$KCNUlBRB3R6hTd8aQxiQAu49UWYFKt6isF2Lds/Wmolx16XoVSgnS', 'siswa', NULL, '2026-07-06 06:25:40', '2026-09-03 13:43:31'),
(471, 'ARVIN RAHMADDANI', 'arvin.rahmaddani@siswa.smansago.com', NULL, '$2y$12$YK7Z9VqF4/BrmIInLVtKDO5g4NPCHw1wiwtUMATtEp6HfFE.dBYze', 'siswa', NULL, '2026-07-06 06:25:40', '2026-09-03 13:43:31'),
(472, 'BELLA AYU WULANDARI', 'bella.wulandari@siswa.smansago.com', NULL, '$2y$12$XbMeXl1RRoc2OAytxviQROPCrvSIdzI9Bl.XrUY6qYensLnk.BXq6', 'siswa', NULL, '2026-07-06 06:25:41', '2026-09-03 13:43:31'),
(473, 'CARISSA PUTRI', 'carissa.putri@siswa.smansago.com', NULL, '$2y$12$izXNqQrFTo5teaVXLrfQpOqQ.DoZirV9sxBTv8odI1gSGjf2nE1M.', 'siswa', NULL, '2026-07-06 06:25:41', '2026-09-03 13:43:31'),
(474, 'DIMAS SETIAWAN', 'dimas.setiawan@siswa.smansago.com', NULL, '$2y$12$s2sHwoFKHdX1E/f4kM4kw.mgqhLiKRwU1Ng1Z0Lt8JiG/x4n14lq2', 'siswa', NULL, '2026-07-06 06:25:41', '2026-09-03 13:43:31'),
(475, 'ENY WAHYUNINGSIH', 'eny.wahyuningsih@siswa.smansago.com', NULL, '$2y$12$DfuSumxDCleI6lO6KAUSWO66YD22YU1btM6BskQUsftChNTyZP9qW', 'siswa', NULL, '2026-07-06 06:25:41', '2026-09-03 13:43:31'),
(476, 'ERIXDA AGUNG KUNCORO', 'erixda.kuncoro@siswa.smansago.com', NULL, '$2y$12$pWOlMtWddIOlbNB7Rao.KOOCU3I0budCywVPEZV2FMjENoRjdUgge', 'siswa', NULL, '2026-07-06 06:25:42', '2026-09-03 13:43:31'),
(477, 'ERVANDY ALIF FEBRIAN', 'ervandy.febrian@siswa.smansago.com', NULL, '$2y$12$xeXj65nV6zc55V9hcY9y7.KfQ/BjH075VYV9/WCx3Lo.cfNBNzfte', 'siswa', NULL, '2026-07-06 06:25:42', '2026-09-03 13:43:31'),
(478, 'EVA YULIANTY', 'eva.yulianty@siswa.smansago.com', NULL, '$2y$12$uXwgzPdhzEQoJ4VZ//FAf.68V3snhAyiky0IP0qXw9DmV0lO5IHCe', 'siswa', NULL, '2026-07-06 06:25:42', '2026-09-03 13:43:31'),
(479, 'FAJAR NUR HIDAYAT', 'fajar.hidayat@siswa.smansago.com', NULL, '$2y$12$baK8hTuqoTXKDAK4S0bmGesXH06ylNzXr4p1o7p7QH1XaiklIKHrG', 'siswa', NULL, '2026-07-06 06:25:42', '2026-09-03 13:43:31'),
(480, 'FATIMAH AZZAHRA', 'fatimah.azzahra@siswa.smansago.com', NULL, '$2y$12$gY5lM9gcvoYjN1QnWjY1ZOlPFUxxh7aF9uTAJ0G3p0g4LEKl0xJfu', 'siswa', NULL, '2026-07-06 06:25:43', '2026-09-03 13:43:31'),
(481, 'Intan Damayanti', 'intan.damayanti@siswa.smansago.com', NULL, '$2y$12$X4dCvz37KmNld3prvYOhg.HN5neKPaG7v.ekzMoAiDfs2X/NCA3EC', 'siswa', NULL, '2026-07-06 06:25:43', '2026-09-03 13:43:31'),
(482, 'LAILI MAFTUKHAH', 'laili.maftukhah@siswa.smansago.com', NULL, '$2y$12$McbsjQtUVT5b9b6OgJepP.qhH6WPvuBN0DcNd94yqyOP1/esNVFwW', 'siswa', NULL, '2026-07-06 06:25:43', '2026-09-03 13:43:31'),
(483, 'MA\'RIFATU SYIFA KAMIL FARHANI', 'marifatu.farhani@siswa.smansago.com', NULL, '$2y$12$OzwtC5NB4DMxYmMRabzg2.BkuDsV59FcbZol83gN8tV2lgn2AhMEO', 'siswa', NULL, '2026-07-06 06:25:43', '2026-09-03 13:43:31'),
(484, 'MUHAMAD FEBRY VALIANSAH', 'muhamad.valiansah@siswa.smansago.com', NULL, '$2y$12$0l0ieF1l/m8vgrblHRHH2.E6bY7C3r03QoFE8TJdQWVrx4T.psb6a', 'siswa', NULL, '2026-07-06 06:25:44', '2026-09-03 13:43:31'),
(485, 'MUHAMAD TAUFIK KURNIAWAN', 'muhamad.kurniawan@siswa.smansago.com', NULL, '$2y$12$iXjAkLICFCKodmmobOUUF.YHBM4meop5vK7s7njKNDDNmdRaikJ6q', 'siswa', NULL, '2026-07-06 06:25:44', '2026-09-03 13:43:31'),
(486, 'MUHAMMAD FAHRI AFIANTO', 'muhammad.afianto@siswa.smansago.com', NULL, '$2y$12$rq4Wy7v249h6mvvQ7CewKed.lGwK3zwxD0s.J4Pc2/vtHnpuju7D.', 'siswa', NULL, '2026-07-06 06:25:44', '2026-09-03 13:43:31'),
(487, 'MUHAMMAD RIZQI KAKA PRADANA', 'muhammad.pradana@siswa.smansago.com', NULL, '$2y$12$eK.uzjuG8/BFfPwW69prDOl566UVqeAimv.2dgoiaEQisNBd6etIG', 'siswa', NULL, '2026-07-06 06:25:44', '2026-09-03 13:43:31'),
(488, 'Naysila Annisa Zaskia', 'naysila.zaskia@siswa.smansago.com', NULL, '$2y$12$e8Qyw9i65G0o7vhBJ.d0nOFkjFIsdQC94N/D6aQEw1H7fRlliVgUy', 'siswa', NULL, '2026-07-06 06:25:44', '2026-09-03 13:43:31'),
(489, 'NURUDIN RIZKI SAPUTRO', 'nurudin.saputro@siswa.smansago.com', NULL, '$2y$12$LMqXCjVTOHsBx3qv6cOHOeHwUD1qgerd2H/P.JzZXEtLI8TTKCM4C', 'siswa', NULL, '2026-07-06 06:25:45', '2026-09-03 13:43:31'),
(490, 'RAIHAN SUSILO BUDIANTO', 'raihan.budianto@siswa.smansago.com', NULL, '$2y$12$AvuYgi2aXqBVsyuMRkaJ0uQFMCwC5C.uZXqxV36Jzt2X1kGxjy41m', 'siswa', NULL, '2026-07-06 06:25:45', '2026-09-03 13:43:31'),
(491, 'RASYA NUR HIDAYAT', 'rasya.hidayat@siswa.smansago.com', NULL, '$2y$12$5LBCwQP2ObYM1s2QaBQrguuCj7joEyeNdxVW6vtb9wekZcw4TeeXO', 'siswa', NULL, '2026-07-06 06:25:45', '2026-09-03 13:43:31'),
(492, 'RENDI SETIAWAN', 'rendi.setiawan@siswa.smansago.com', NULL, '$2y$12$WL6ebXOFeQHRxiOwg3gl5OIhqtQzUQMTRdG3sD7QWdt70Mdq8MA.C', 'siswa', NULL, '2026-07-06 06:25:45', '2026-09-03 13:43:31'),
(493, 'SATRIA BAYU AJI', 'satria.aji@siswa.smansago.com', NULL, '$2y$12$whwC8c5AHr5XQqllPW1/AeyXhfEbCTozmzYJKypIPfQDxEM7hGZeu', 'siswa', NULL, '2026-07-06 06:25:46', '2026-09-03 13:43:31'),
(494, 'SRI WAHYU RAHMAYANI', 'sri.rahmayani@siswa.smansago.com', NULL, '$2y$12$Pd9qkRgCGuQ3UPnj3WJyWet.yE2QoeNUkwC/7T3CXm1X.lPzGdq42', 'siswa', NULL, '2026-07-06 06:25:46', '2026-09-03 13:43:31'),
(495, 'TRI HARTANTO', 'tri.hartanto@siswa.smansago.com', NULL, '$2y$12$ghOOw5zyaugZlauwR8c7befgmzOaLrf.2E4z/Ri9NEPNPMDqRr1d2', 'siswa', NULL, '2026-07-06 06:25:46', '2026-09-03 13:43:31'),
(496, 'WAHYU NUGROHO', 'wahyu.nugroho@siswa.smansago.com', NULL, '$2y$12$Ve4GPFinWPMjp84xMiqwP.U6Iz094zL0FfX03938JaaME5C/mlcQy', 'siswa', NULL, '2026-07-06 06:25:46', '2026-09-03 13:43:31'),
(497, 'WIDYA FELISIANO PUTRI', 'widya.putri@siswa.smansago.com', NULL, '$2y$12$0PhpulfAJN1zFMGNUyxtA.eV0TG0sHz.SJlE4sX1WsfK8aNYdWr46', 'siswa', NULL, '2026-07-06 06:25:47', '2026-09-03 13:43:31'),
(498, 'WIWID SARENAWATI', 'wiwid.sarenawati@siswa.smansago.com', NULL, '$2y$12$hzsCU7989AknOwgrC1Hm2uKC71ZWbxmkJf3R2.bsV3ofsoZ1oUnxu', 'siswa', NULL, '2026-07-06 06:25:47', '2026-09-03 13:43:31'),
(499, 'YOGO SAPUTRA', 'yogo.saputra@siswa.smansago.com', NULL, '$2y$12$w0AK1WgpCDz7mP9yzZrWfeAEcjWq7ttxKzcw5mhy7xDZDR4fQVBP6', 'siswa', NULL, '2026-07-06 06:25:47', '2026-09-03 13:43:31'),
(500, 'ALPIANA RAHMAWATI', 'alpiana.rahmawati@siswa.smansago.com', NULL, '$2y$12$MgvrHoiBjAKYVtCSzWu7HOuDUp2KXXtfSwPQnMhnZxn2UKpzVJyhi', 'siswa', NULL, '2026-07-06 06:25:47', '2026-09-03 13:43:31'),
(501, 'ALWIS ALQURNIAWAN', 'alwis.alqurniawan@siswa.smansago.com', NULL, '$2y$12$JQbZ9Fz7U7DdFEqkfHYu7eirguHt.FdGf1w8xbxk9hZheqBIf.tm.', 'siswa', NULL, '2026-07-06 06:25:48', '2026-09-03 13:43:31'),
(502, 'Arief Nur Haryanto', 'arief.haryanto@siswa.smansago.com', NULL, '$2y$12$B6SOYxNxVWuPe4h64F9s7OG1hK1IoU0tFURsRJgOGG9GqKBajPIiO', 'siswa', NULL, '2026-07-06 06:25:48', '2026-09-03 13:43:31'),
(503, 'AYU ANDINI', 'ayu.andini@siswa.smansago.com', NULL, '$2y$12$SSlfgzSjkxI0Hgb9RWZPwupxv3Xf9LMpX6GMKYjfZYr62zvCjm9pi', 'siswa', NULL, '2026-07-06 06:25:48', '2026-09-03 13:43:31'),
(504, 'BAGUS PRABOWO', 'bagus.prabowo@siswa.smansago.com', NULL, '$2y$12$3.x7V9MXnW96kzAJhq8opubXGN5WPAh7e0uhA9YS1jEz3KhSvBzjG', 'siswa', NULL, '2026-07-06 06:25:49', '2026-09-03 13:43:31'),
(505, 'BIMA BASTIAN MULYA', 'bima.mulya@siswa.smansago.com', NULL, '$2y$12$BlhXvHDGpyl/S1JIfKd1/.hEBECNyyNx/rRH7OfcwnxCcccQrQ98G', 'siswa', NULL, '2026-07-06 06:25:49', '2026-09-03 13:43:31'),
(506, 'DEVIANA ANDRIYANTI', 'deviana.andriyanti@siswa.smansago.com', NULL, '$2y$12$0OusKEjebc9pJA5IxvmPz.WS2FWxSCEeiRpQg9y5QH6T3vY7h4rGu', 'siswa', NULL, '2026-07-06 06:25:49', '2026-09-03 13:43:31'),
(507, 'ELXA WAHYU YULIANTO', 'elxa.yulianto@siswa.smansago.com', NULL, '$2y$12$B3yoX.DWXdJubXgDx.lB7er/fJP8RpFnpk4tOabh46G37nyf6xo2S', 'siswa', NULL, '2026-07-06 06:25:49', '2026-09-03 13:43:31'),
(508, 'FAIZ SARIFUDIN', 'faiz.sarifudin@siswa.smansago.com', NULL, '$2y$12$zfHCkN25pvMdcpWgXWDnT.1IePocj/xzf0Rb9xR27aSDVYSQY55sy', 'siswa', NULL, '2026-07-06 06:25:50', '2026-09-03 13:43:31'),
(509, 'FALIHA ALBIT', 'faliha.albit@siswa.smansago.com', NULL, '$2y$12$xpz/K.DazQCqZig6/2JYqeSX8Dj7ZSxXfoO83Tg2rfiJdm4INzC/W', 'siswa', NULL, '2026-07-06 06:25:50', '2026-09-03 13:43:31'),
(510, 'FARA DECHA ABABILQIS', 'fara.ababilqis@siswa.smansago.com', NULL, '$2y$12$giur0FdnNL4ZW7dC86hB3eLliW0Dfia.fn3aXZQ9cYJ5GBc15x.aS', 'siswa', NULL, '2026-07-06 06:25:50', '2026-09-03 13:43:31'),
(511, 'HANUNG GIBRAN ALANSAH', 'hanung.alansah@siswa.smansago.com', NULL, '$2y$12$ZttOtBmyqATcmZ5jXtSW9.cZTquZHmK3QCFCeXmpWFYzoyRPN5mx2', 'siswa', NULL, '2026-07-06 06:25:50', '2026-09-03 13:43:31'),
(512, 'KAILA NURUL AISHA', 'kaila.aisha@siswa.smansago.com', NULL, '$2y$12$qX4ZIE8GaRGmn3JC16Tkou7HrMckWUlEzoOG59Kc5dpeJIunCvYwy', 'siswa', NULL, '2026-07-06 06:25:51', '2026-09-03 13:43:31'),
(513, 'MUHAMAD RIZAL PURNAMA PUTRA', 'muhamad.putra@siswa.smansago.com', NULL, '$2y$12$J3.EwbuMjlkmndAr1XLGR.wnUKDo36kAjib7YJOAIqbBahm5BqaTi', 'siswa', NULL, '2026-07-06 06:25:51', '2026-09-03 13:43:31');
INSERT INTO `pengguna` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(514, 'MUHAMMAD RIZKI FAUZI', 'muhammad.fauzi@siswa.smansago.com', NULL, '$2y$12$AV0KOxN7I1NqwjX5FKs0POE4t51Jj8PjV2539Z10GNvG/qGCBa8Wu', 'siswa', NULL, '2026-07-06 06:25:51', '2026-09-03 13:43:31'),
(515, 'Muhammat Ibnu Tamar Ibrahim', 'muhammat.ibrahim@siswa.smansago.com', NULL, '$2y$12$eAJc5Uy9SOkHpOn3RHH/JuqAy5B0a5IunLdmSiJ7FtUfGUb5MK6OC', 'siswa', NULL, '2026-07-06 06:25:51', '2026-09-03 13:43:31'),
(516, 'Nadin Aprilia Putri', 'nadin.putri@siswa.smansago.com', NULL, '$2y$12$QwN6xWSzIN9zX4mrWpqO..2i/1tMV.CA4gy714Kho7cHSGDSGjWDe', 'siswa', NULL, '2026-07-06 06:25:52', '2026-09-03 13:43:31'),
(517, 'NINDA ALTHAFUNNISA', 'ninda.althafunnisa@siswa.smansago.com', NULL, '$2y$12$hRjIz2WVmh.LFbZ.Ye0J4ei1mXDc/K4JpE02MlTzSHJ4HEMDhv1Te', 'siswa', NULL, '2026-07-06 06:25:52', '2026-09-03 13:43:31'),
(518, 'NOVA WIYANTO', 'nova.wiyanto@siswa.smansago.com', NULL, '$2y$12$mLeysKBvBOVVWyYl2zSVcuETQuXGj3SHZ84Maj0BxhqxC7Jz.0QsK', 'siswa', NULL, '2026-07-06 06:25:52', '2026-09-03 13:43:31'),
(519, 'NOVI MAULANI ADITYA', 'novi.aditya@siswa.smansago.com', NULL, '$2y$12$ajh42gmbQBj1ayIkWp1BeOpmzkLLbOVhn0l/7pDl/RhEvaR/psXLG', 'siswa', NULL, '2026-07-06 06:25:52', '2026-09-03 13:43:31'),
(520, 'NUR ANISA', 'nur.anisa@siswa.smansago.com', NULL, '$2y$12$4XnnSNh.U0jgCYUvLEFgh./bg3eu5jsd6moN01p5mA.atLqqnr8/6', 'siswa', NULL, '2026-07-06 06:25:53', '2026-09-03 13:43:31'),
(521, 'NUR ROHIMAH', 'nur.rohimah@siswa.smansago.com', NULL, '$2y$12$SHgf3ag.8V98VuOZOKdpMeP1C3pwNLqL0zc/xXVxoJ8FZl.ZLgngC', 'siswa', NULL, '2026-07-06 06:25:53', '2026-09-03 13:43:31'),
(522, 'PRASETYO DWI SAPUTRO', 'prasetyo.saputro@siswa.smansago.com', NULL, '$2y$12$UoFZxp4VelkOWunGop/w6O5gX/y8eVYMWBMAhKZnWIAcCOhO5Z.Jq', 'siswa', NULL, '2026-07-06 06:25:53', '2026-09-03 13:43:31'),
(523, 'RAISA ISNAN SAPUTRA', 'raisa.saputra@siswa.smansago.com', NULL, '$2y$12$zTFOecsHY8Hl1RmALTA6AOog9C84mzrmXBK1EdLdYFQC59ba9N95K', 'siswa', NULL, '2026-07-06 06:25:53', '2026-09-03 13:43:31'),
(524, 'Rasyid Amir Zaki', 'rasyid.zaki@siswa.smansago.com', NULL, '$2y$12$PrgsfRKRFGdIeS1BPOYUV.PoPmw0HAooPCKfb6WCB0deKE2rluKa2', 'siswa', NULL, '2026-07-06 06:25:54', '2026-09-03 13:43:31'),
(525, 'RESTU PURBANINGRAT', 'restu.purbaningrat@siswa.smansago.com', NULL, '$2y$12$CsDFGsGMISo9LyK3t6v4P.NWQKUhV2X6ZX6Gani1MsjzzAPQOHmbm', 'siswa', NULL, '2026-07-06 06:25:54', '2026-09-03 13:43:31'),
(526, 'RIZAL MATHOFANI ADI NUGRAHA', 'rizal.nugraha@siswa.smansago.com', NULL, '$2y$12$0CeAe5x6qFl2J6N/nIXY5ufoqQqsA8588zvObqyasC3OBz5CxXW5.', 'siswa', NULL, '2026-07-06 06:25:54', '2026-09-03 13:43:31'),
(527, 'SAIFUL UDIN', 'saiful.udin@siswa.smansago.com', NULL, '$2y$12$sj616VjOpL5JHVlxUkbeteN6JJffgaRPR4pMt5Ov6DbcEVCQ96lgu', 'siswa', NULL, '2026-07-06 06:25:54', '2026-09-03 13:43:31'),
(528, 'Septia Ramadhani', 'septia.ramadhani@siswa.smansago.com', NULL, '$2y$12$BRDfY5tgWY7gm8RIoLWtQuOIuxGIgqXZI2A6azAjm8M1u6zLSZZJu', 'siswa', NULL, '2026-07-06 06:25:55', '2026-09-03 13:43:31'),
(529, 'SHOLEH SETYAWAN', 'sholeh.setyawan@siswa.smansago.com', NULL, '$2y$12$ltPFxiqfCe.GPpMTWxRwDOp4GPioX9ho8FPdcUIrLsFtAM2SaZcQa', 'siswa', NULL, '2026-07-06 06:25:55', '2026-09-03 13:43:31'),
(530, 'SOWAN APRILIA', 'sowan.aprilia@siswa.smansago.com', NULL, '$2y$12$rORc25YQFESZMVQvcr70eOeEpMgtjGEgBZN2EIcO6AsSht.RKObg6', 'siswa', NULL, '2026-07-06 06:25:55', '2026-09-03 13:43:31'),
(531, 'THORIQ LUTFI ZAILANI', 'thoriq.zailani@siswa.smansago.com', NULL, '$2y$12$8w1vgT0vIfCjZ0.gJ25FzOHFSzBIR90CY4W5HOF8YH5R0bb/Ia.XS', 'siswa', NULL, '2026-07-06 06:25:55', '2026-09-03 13:43:31'),
(532, 'Vika Damayanti', 'vika.damayanti@siswa.smansago.com', NULL, '$2y$12$iAh3.B1sKUFeACk6X0ohJOrQyPKsJy9U95Y4M/HNzwLRtb0TtCb5W', 'siswa', NULL, '2026-07-06 06:25:56', '2026-09-03 13:43:31'),
(533, 'WAHYU PURWANTO', 'wahyu.purwanto@siswa.smansago.com', NULL, '$2y$12$6dTCfwIgHh80Wn6VcA24g..ES4/oKEIzXNg3TaLaOD5QaMhwHgHRO', 'siswa', NULL, '2026-07-06 06:25:56', '2026-09-03 13:43:31'),
(534, 'YOGI MUHAMAD FAIZAL', 'yogi.faizal@siswa.smansago.com', NULL, '$2y$12$6FIC8FSPt.ndStciV3FlTeHht8pSgmCtCdc507PzzGQJPhLElXYJO', 'siswa', NULL, '2026-07-06 06:25:56', '2026-09-03 13:43:31'),
(535, 'ZAFRAN AL FARIZI', 'zafran.farizi@siswa.smansago.com', NULL, '$2y$12$wrGKGmE7eXMuf/R43BfNiughG6pWAC4GBEY/0rp5V99t.AunFNSOe', 'siswa', NULL, '2026-07-06 06:25:56', '2026-09-03 13:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `tugas_id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `tanggal_pengumpulan` datetime DEFAULT NULL,
  `file_tugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submission_url` text COLLATE utf8mb4_unicode_ci,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint UNSIGNED DEFAULT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `drive_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `alasan_pengembalian` text COLLATE utf8mb4_unicode_ci,
  `dikembalikan_pada` timestamp NULL DEFAULT NULL,
  `dikembalikan_oleh` bigint UNSIGNED DEFAULT NULL,
  `revisi_ke` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumpulan_tugas`
--

INSERT INTO `pengumpulan_tugas` (`id`, `tugas_id`, `siswa_id`, `tanggal_pengumpulan`, `file_tugas`, `submission_url`, `original_name`, `file_path`, `file_size`, `mime_type`, `catatan`, `drive_link`, `file_name`, `file_icon`, `status`, `alasan_pengembalian`, `dikembalikan_pada`, `dikembalikan_oleh`, `revisi_ke`, `created_at`, `updated_at`, `deleted_at`) VALUES
(359, 21, 183, '2026-08-22 01:05:29', 'submissions/21/183/mPKSKT83F7IvnwTvZgXGHqXfFwaYx5W4FXhy6UKk.docx', NULL, 'JAWABAN_TUGAS_2_B_INDO_HARIS RAMADHAN.docx', 'submissions/21/183/mPKSKT83F7IvnwTvZgXGHqXfFwaYx5W4FXhy6UKk.docx', 27663, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 1, '2026-08-21 15:58:14', '2026-08-21 18:05:29', NULL),
(360, 21, 77, '2026-08-21 14:30:00', 'submissions/tugas_1_analytical_exposition_anisa_febriyana.pdf', NULL, 'tugas_1_analytical_exposition_anisa_febriyana.pdf', 'submissions/tugas_1_analytical_exposition_anisa_febriyana.pdf', 2787, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(361, 21, 185, '2026-08-21 14:45:00', 'submissions/tugas_1_analytical_exposition_arlina_tara_mahendra.pdf', NULL, 'tugas_1_analytical_exposition_arlina_tara_mahendra.pdf', 'submissions/tugas_1_analytical_exposition_arlina_tara_mahendra.pdf', 2756, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(362, 21, 4, '2026-08-21 15:00:00', 'submissions/tugas_1_analytical_exposition_aulia_azzahra.pdf', NULL, 'tugas_1_analytical_exposition_aulia_azzahra.pdf', 'submissions/tugas_1_analytical_exposition_aulia_azzahra.pdf', 2752, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(363, 21, 114, '2026-08-21 15:15:00', 'submissions/tugas_1_analytical_exposition_aulia_rafi_qurrohman.pdf', NULL, 'tugas_1_analytical_exposition_aulia_rafi_qurrohman.pdf', 'submissions/tugas_1_analytical_exposition_aulia_rafi_qurrohman.pdf', 2726, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(364, 21, 43, '2026-08-21 15:15:00', 'submissions/tugas_1_analytical_exposition_bagus_rivai.pdf', NULL, 'tugas_1_analytical_exposition_bagus_rivai.pdf', 'submissions/tugas_1_analytical_exposition_bagus_rivai.pdf', 2856, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(365, 21, 115, '2026-08-21 15:30:00', 'submissions/tugas_1_analytical_exposition_bayu_jati_angkoso.pdf', NULL, 'tugas_1_analytical_exposition_bayu_jati_angkoso.pdf', 'submissions/tugas_1_analytical_exposition_bayu_jati_angkoso.pdf', 2789, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(366, 21, 80, '2026-08-21 15:45:00', 'submissions/tugas_1_analytical_exposition_chalila_nisrin_dewanti.pdf', NULL, 'tugas_1_analytical_exposition_chalila_nisrin_dewanti.pdf', 'submissions/tugas_1_analytical_exposition_chalila_nisrin_dewanti.pdf', 2758, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(367, 21, 116, '2026-08-21 16:00:00', 'submissions/tugas_1_analytical_exposition_daimatul_karimah.pdf', NULL, 'tugas_1_analytical_exposition_daimatul_karimah.pdf', 'submissions/tugas_1_analytical_exposition_daimatul_karimah.pdf', 2755, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(368, 21, 152, '2026-08-21 16:15:00', 'submissions/tugas_1_analytical_exposition_danis_nuril_fahma.pdf', NULL, 'tugas_1_analytical_exposition_danis_nuril_fahma.pdf', 'submissions/tugas_1_analytical_exposition_danis_nuril_fahma.pdf', 2723, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(369, 21, 117, '2026-08-21 16:15:00', 'submissions/tugas_1_analytical_exposition_dwi_doni_prabowo.pdf', NULL, 'tugas_1_analytical_exposition_dwi_doni_prabowo.pdf', 'submissions/tugas_1_analytical_exposition_dwi_doni_prabowo.pdf', 2861, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(370, 21, 153, '2026-08-21 16:30:00', 'submissions/tugas_1_analytical_exposition_dwi_eva_ariyani.pdf', NULL, 'tugas_1_analytical_exposition_dwi_eva_ariyani.pdf', 'submissions/tugas_1_analytical_exposition_dwi_eva_ariyani.pdf', 2787, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(371, 21, 190, '2026-08-21 16:45:00', 'submissions/tugas_1_analytical_exposition_dwi_wicaksono.pdf', NULL, 'tugas_1_analytical_exposition_dwi_wicaksono.pdf', 'submissions/tugas_1_analytical_exposition_dwi_wicaksono.pdf', 2749, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(372, 21, 84, '2026-08-21 17:00:00', 'submissions/tugas_1_analytical_exposition_fara_ayu_dita.pdf', NULL, 'tugas_1_analytical_exposition_fara_ayu_dita.pdf', 'submissions/tugas_1_analytical_exposition_fara_ayu_dita.pdf', 2752, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(373, 21, 49, '2026-08-21 17:15:00', 'submissions/tugas_1_analytical_exposition_farhan_zaki_fahrezy.pdf', NULL, 'tugas_1_analytical_exposition_farhan_zaki_fahrezy.pdf', 'submissions/tugas_1_analytical_exposition_farhan_zaki_fahrezy.pdf', 2725, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(374, 21, 193, '2026-08-21 17:15:00', 'submissions/tugas_1_analytical_exposition_fitri_sholikhah.pdf', NULL, 'tugas_1_analytical_exposition_fitri_sholikhah.pdf', 'submissions/tugas_1_analytical_exposition_fitri_sholikhah.pdf', 2860, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(375, 21, 11, '2026-08-21 17:30:00', 'submissions/tugas_1_analytical_exposition_galang_aditya_nugroho.pdf', NULL, 'tugas_1_analytical_exposition_galang_aditya_nugroho.pdf', 'submissions/tugas_1_analytical_exposition_galang_aditya_nugroho.pdf', 2793, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(376, 21, 50, '2026-08-21 17:45:00', 'submissions/tugas_1_analytical_exposition_galih_pratitis_wulandri_utomo.pdf', NULL, 'tugas_1_analytical_exposition_galih_pratitis_wulandri_utomo.pdf', 'submissions/tugas_1_analytical_exposition_galih_pratitis_wulandri_utomo.pdf', 2765, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(377, 21, 194, '2026-08-21 18:00:00', 'submissions/tugas_1_analytical_exposition_ika_wahyuningsih.pdf', NULL, 'tugas_1_analytical_exposition_ika_wahyuningsih.pdf', 'submissions/tugas_1_analytical_exposition_ika_wahyuningsih.pdf', 2755, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(378, 21, 88, '2026-08-21 18:15:00', 'submissions/tugas_1_analytical_exposition_intan_nur_aisyah.pdf', NULL, 'tugas_1_analytical_exposition_intan_nur_aisyah.pdf', 'submissions/tugas_1_analytical_exposition_intan_nur_aisyah.pdf', 2722, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(379, 21, 160, '2026-08-21 18:15:00', 'submissions/tugas_1_analytical_exposition_joko_prasetiyo.pdf', NULL, 'tugas_1_analytical_exposition_joko_prasetiyo.pdf', 'submissions/tugas_1_analytical_exposition_joko_prasetiyo.pdf', 2859, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(380, 21, 161, '2026-08-21 18:30:00', 'submissions/tugas_1_analytical_exposition_keyza_jaztyin_ayu_dia_pratiwi.pdf', NULL, 'tugas_1_analytical_exposition_keyza_jaztyin_ayu_dia_pratiwi.pdf', 'submissions/tugas_1_analytical_exposition_keyza_jaztyin_ayu_dia_pratiwi.pdf', 2801, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(381, 21, 92, '2026-08-21 18:45:00', 'submissions/tugas_1_analytical_exposition_maulana_satria_saputra.pdf', NULL, 'tugas_1_analytical_exposition_maulana_satria_saputra.pdf', 'submissions/tugas_1_analytical_exposition_maulana_satria_saputra.pdf', 2758, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(382, 21, 127, '2026-08-21 19:00:00', 'submissions/tugas_1_analytical_exposition_mayla_nurul_afifah.pdf', NULL, 'tugas_1_analytical_exposition_mayla_nurul_afifah.pdf', 'submissions/tugas_1_analytical_exposition_mayla_nurul_afifah.pdf', 2757, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:14', '2026-08-21 15:58:14', NULL),
(383, 21, 18, '2026-08-21 19:15:00', 'submissions/tugas_1_analytical_exposition_muhammad_burhanudin_hibatulloh.pdf', NULL, 'tugas_1_analytical_exposition_muhammad_burhanudin_hibatulloh.pdf', 'submissions/tugas_1_analytical_exposition_muhammad_burhanudin_hibatulloh.pdf', 2736, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(384, 21, 130, '2026-08-21 19:15:00', 'submissions/tugas_1_analytical_exposition_nina_vania_zerlina.pdf', NULL, 'tugas_1_analytical_exposition_nina_vania_zerlina.pdf', 'submissions/tugas_1_analytical_exposition_nina_vania_zerlina.pdf', 2863, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(385, 21, 131, '2026-08-21 19:30:00', 'submissions/tugas_1_analytical_exposition_noval_rifky_afrianto.pdf', NULL, 'tugas_1_analytical_exposition_noval_rifky_afrianto.pdf', 'submissions/tugas_1_analytical_exposition_noval_rifky_afrianto.pdf', 2792, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(386, 21, 132, '2026-08-21 19:45:00', 'submissions/tugas_1_analytical_exposition_nur_utami.pdf', NULL, 'tugas_1_analytical_exposition_nur_utami.pdf', 'submissions/tugas_1_analytical_exposition_nur_utami.pdf', 2745, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(387, 21, 97, '2026-08-21 20:00:00', 'submissions/tugas_1_analytical_exposition_putri_nur_sholekha.pdf', NULL, 'tugas_1_analytical_exposition_putri_nur_sholekha.pdf', 'submissions/tugas_1_analytical_exposition_putri_nur_sholekha.pdf', 2757, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(388, 21, 133, '2026-08-21 20:15:00', 'submissions/tugas_1_analytical_exposition_raihannisa_putri_fitriana.pdf', NULL, 'tugas_1_analytical_exposition_raihannisa_putri_fitriana.pdf', 'submissions/tugas_1_analytical_exposition_raihannisa_putri_fitriana.pdf', 2731, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(389, 21, 25, '2026-08-21 20:15:00', 'submissions/tugas_1_analytical_exposition_reni_oktavia_sari.pdf', NULL, 'tugas_1_analytical_exposition_reni_oktavia_sari.pdf', 'submissions/tugas_1_analytical_exposition_reni_oktavia_sari.pdf', 2862, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(390, 21, 171, '2026-08-21 20:30:00', 'submissions/tugas_1_analytical_exposition_ririt_bharata_ningtyas.pdf', NULL, 'tugas_1_analytical_exposition_ririt_bharata_ningtyas.pdf', 'submissions/tugas_1_analytical_exposition_ririt_bharata_ningtyas.pdf', 2794, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(391, 21, 173, '2026-08-21 20:45:00', 'submissions/tugas_1_analytical_exposition_siti_oktaviani.pdf', NULL, 'tugas_1_analytical_exposition_siti_oktaviani.pdf', 'submissions/tugas_1_analytical_exposition_siti_oktaviani.pdf', 2750, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(392, 21, 174, '2026-08-21 21:00:00', 'submissions/tugas_1_analytical_exposition_slamet_triyanto.pdf', NULL, 'tugas_1_analytical_exposition_slamet_triyanto.pdf', 'submissions/tugas_1_analytical_exposition_slamet_triyanto.pdf', 2754, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(393, 21, 103, '2026-08-21 21:15:00', 'submissions/tugas_1_analytical_exposition_sofiana_novita_sari.pdf', NULL, 'tugas_1_analytical_exposition_sofiana_novita_sari.pdf', 'submissions/tugas_1_analytical_exposition_sofiana_novita_sari.pdf', 2725, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(394, 21, 32, '2026-08-21 21:15:00', 'submissions/tugas_1_analytical_exposition_tri_nofiyanti.pdf', NULL, 'tugas_1_analytical_exposition_tri_nofiyanti.pdf', 'submissions/tugas_1_analytical_exposition_tri_nofiyanti.pdf', 2858, 'application/pdf', NULL, NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-21 15:58:15', '2026-08-21 15:58:15', NULL),
(395, 22, 183, '2026-08-22 13:41:24', NULL, 'https://youtu.be/3ex-bH2aBq0', NULL, NULL, NULL, NULL, NULL, 'https://youtu.be/3ex-bH2aBq0', NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-08-22 06:41:24', '2026-08-22 06:41:24', NULL),
(396, 23, 183, '2026-08-22 14:35:11', 'submissions/23/183/mmD2vXY6tOyTVFEzloAkAy4EFRvAI0QzMc1kKkrd.png', NULL, 'ChatGPT Image Aug 22, 2026, 01_46_16 PM.png', 'submissions/23/183/mmD2vXY6tOyTVFEzloAkAy4EFRvAI0QzMc1kKkrd.png', 1887482, 'image/png', 'catatan dari siswa apakah sudah muncul?', NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 3, '2026-08-22 07:23:16', '2026-08-22 07:35:11', NULL),
(400, 44, 1, '2026-09-07 18:18:03', 'tugas/sample_jawaban_pocung.pdf', NULL, 'Tugas1_Macapat_Pocung_Akrima.pdf', 'tugas/sample_jawaban_pocung.pdf', 2406, 'application/pdf', 'Berikut adalah tugas analisis Tembang Macapat Pocung yang telah saya kerjakan, Bu Guru. Mohon koreksinya.', NULL, NULL, NULL, 'terkumpul', NULL, NULL, NULL, 0, '2026-09-07 13:18:03', '2026-09-07 13:26:16', NULL);

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
(1535, 253, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1536, 254, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1537, 255, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1538, 256, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1539, 257, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1540, 258, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1541, 259, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1542, 260, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1543, 261, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1544, 262, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1545, 263, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1546, 264, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1547, 265, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1548, 266, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1549, 267, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1550, 268, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1551, 269, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1552, 270, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1553, 271, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1554, 272, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1555, 273, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1556, 274, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1557, 275, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1558, 276, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1559, 277, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1560, 278, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1561, 279, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1562, 280, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1563, 281, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1564, 282, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1565, 283, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1566, 284, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1567, 285, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1568, 286, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1569, 287, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1570, 288, 'XII F 1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1571, 289, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1572, 290, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1573, 291, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1574, 292, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1575, 293, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1576, 294, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1577, 295, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1578, 296, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1579, 297, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1580, 298, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1581, 299, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1582, 300, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1583, 301, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1584, 302, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1585, 303, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1586, 304, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1587, 305, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1588, 306, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1589, 307, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1590, 308, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1591, 309, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1592, 310, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1593, 311, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1594, 312, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1595, 313, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1596, 314, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1597, 315, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1598, 316, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1599, 317, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1600, 318, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1601, 319, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:26', '2026-08-16 13:52:26'),
(1602, 320, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1603, 321, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1604, 322, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1605, 323, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1606, 324, 'XII F 2.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1607, 325, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1608, 326, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1609, 327, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1610, 328, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1611, 329, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1612, 330, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1613, 331, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1614, 332, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1615, 333, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1616, 334, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1617, 335, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1618, 336, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1619, 337, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1620, 338, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1621, 339, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1622, 340, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1623, 341, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1624, 342, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1625, 343, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1626, 344, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1627, 345, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1628, 346, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1629, 347, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1630, 348, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1631, 349, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1632, 350, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1633, 351, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1634, 352, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1635, 353, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1636, 354, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1637, 355, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1638, 356, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1639, 357, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1640, 358, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1641, 359, 'XII F 2.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1642, 360, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1643, 361, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1644, 362, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1645, 363, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1646, 364, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1647, 365, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1648, 366, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1649, 367, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1650, 368, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1651, 369, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1652, 370, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1653, 371, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1654, 372, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1655, 373, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1656, 374, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1657, 375, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1658, 376, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1659, 377, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1660, 378, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1661, 379, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1662, 380, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1663, 381, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1664, 382, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1665, 383, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1666, 384, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1667, 385, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1668, 386, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1669, 387, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1670, 388, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1671, 389, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1672, 390, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1673, 391, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1674, 392, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1675, 393, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1676, 394, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1677, 395, 'XII F 3.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1678, 396, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1679, 397, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1680, 398, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1681, 399, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1682, 400, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1683, 401, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1684, 402, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1685, 403, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1686, 404, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1687, 405, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1688, 406, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1689, 407, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1690, 408, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1691, 409, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1692, 410, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1693, 411, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1694, 412, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1695, 413, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1696, 414, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1697, 415, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1698, 416, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1699, 417, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1700, 418, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1701, 419, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1702, 420, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1703, 421, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1704, 422, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1705, 423, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1706, 424, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1707, 425, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1708, 426, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1709, 427, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1710, 428, 'XII F 3.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1711, 429, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1712, 430, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1713, 431, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1714, 432, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1715, 433, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1716, 434, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1717, 435, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1718, 436, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1719, 437, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1720, 438, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1721, 439, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1722, 440, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1723, 441, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1724, 442, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1725, 443, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1726, 444, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1727, 445, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1728, 446, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1729, 447, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1730, 448, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1731, 449, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1732, 450, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1733, 451, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1734, 452, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1735, 453, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1736, 454, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1737, 455, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1738, 456, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1739, 457, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1740, 458, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1741, 459, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1742, 460, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1743, 461, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1744, 462, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1745, 463, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1746, 464, 'XII F 4.1', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1747, 465, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1748, 466, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1749, 467, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1750, 468, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1751, 469, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1752, 470, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1753, 471, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1754, 472, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1755, 473, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1756, 474, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1757, 475, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1758, 476, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1759, 477, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1760, 478, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1761, 479, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1762, 480, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1763, 481, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1764, 482, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1765, 483, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1766, 484, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1767, 485, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1768, 486, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1769, 487, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1770, 488, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1771, 489, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1772, 490, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1773, 491, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1774, 492, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1775, 493, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1776, 494, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1777, 495, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1778, 496, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1779, 497, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1780, 498, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1781, 499, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1782, 500, 'XII F 4.2', '2025/2026', '2026-08-16 13:52:27', '2026-08-16 13:52:27'),
(1856, 1, 'XI F 1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1857, 2, 'XI F 2.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1858, 3, 'XI F 2.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1859, 4, 'XI F 3.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1860, 5, 'XI F 3.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1861, 6, 'XI F 4.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1862, 7, 'XI F 4.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1863, 8, 'XI F 1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1864, 9, 'XI F 2.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1865, 10, 'XI F 2.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1866, 11, 'XI F 3.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1867, 12, 'XI F 3.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1868, 13, 'XI F 4.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1869, 14, 'XI F 4.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1870, 15, 'XI F 1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1871, 16, 'XI F 2.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1872, 17, 'XI F 2.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1873, 18, 'XI F 3.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1874, 19, 'XI F 3.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1875, 20, 'XI F 4.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1876, 21, 'XI F 4.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1877, 22, 'XI F 1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1878, 23, 'XI F 2.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1879, 24, 'XI F 2.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1880, 25, 'XI F 3.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1881, 26, 'XI F 3.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1882, 27, 'XI F 4.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1883, 28, 'XI F 4.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1884, 29, 'XI F 1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1885, 30, 'XI F 2.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1886, 31, 'XI F 2.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1887, 32, 'XI F 3.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1888, 33, 'XI F 3.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1889, 34, 'XI F 4.1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1890, 35, 'XI F 4.2', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1891, 36, 'XI F 1', '2025/2026', '2026-08-16 15:19:03', '2026-08-16 15:19:03'),
(1892, 37, 'XI F 1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1893, 38, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1894, 39, 'XI F 1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1895, 40, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1896, 41, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1897, 42, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1898, 43, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1899, 44, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1900, 45, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1901, 46, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1902, 47, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1903, 48, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1904, 49, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1905, 50, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1906, 51, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1907, 52, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1908, 53, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1909, 54, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1910, 55, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1911, 56, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1912, 57, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1913, 58, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1914, 59, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1915, 60, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1916, 61, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1917, 62, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1918, 63, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1919, 64, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1920, 65, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1921, 66, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1922, 67, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1923, 68, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1924, 69, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1925, 70, 'XI F 4.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1926, 71, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1927, 72, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:05', '2026-08-16 15:20:05'),
(1928, 73, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1929, 74, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1930, 75, 'XI F 1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1931, 76, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1932, 77, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1933, 78, 'XI F 1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1934, 79, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1935, 80, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1936, 81, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1937, 82, 'XI F 1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1938, 83, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1939, 84, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1940, 85, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1941, 86, 'XI F 1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1942, 87, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1943, 88, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1944, 89, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1945, 90, 'XI F 1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1946, 91, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1947, 92, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1948, 93, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1949, 94, 'XI F 1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1950, 95, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1951, 96, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1952, 97, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1953, 98, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1954, 99, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1955, 100, 'XI F 1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1956, 101, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1957, 102, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1958, 103, 'XI F 3.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1959, 104, 'XI F 3.2', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1960, 105, 'XI F 4.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1961, 106, 'XI F 1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1962, 107, 'XI F 2.1', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1963, 108, 'XI F 2.2', '2025/2026', '2026-08-16 15:20:32', '2026-08-16 15:20:32'),
(1964, 109, 'XI F 1', '2025/2026', '2026-08-16 15:21:34', '2026-08-16 15:21:34'),
(1965, 110, 'XI F 1', '2025/2026', '2026-08-16 15:21:34', '2026-08-16 15:21:34'),
(1966, 111, 'XI F 1', '2025/2026', '2026-08-16 15:21:34', '2026-08-16 15:21:34'),
(1967, 112, 'XI F 2.1', '2025/2026', '2026-08-16 15:21:34', '2026-08-16 15:21:34'),
(1968, 113, 'XI F 2.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1969, 114, 'XI F 3.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1970, 115, 'XI F 3.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1971, 116, 'XI F 3.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1972, 117, 'XI F 3.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1973, 118, 'XI F 3.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1974, 119, 'XI F 3.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1975, 120, 'XI F 4.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1976, 121, 'XI F 4.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1977, 122, 'XI F 4.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1978, 123, 'XI F 4.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1979, 124, 'XI F 3.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1980, 125, 'XI F 3.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1981, 126, 'XI F 4.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1982, 127, 'XI F 3.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1983, 128, 'XI F 2.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1984, 129, 'XI F 2.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1985, 130, 'XI F 3.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1986, 131, 'XI F 3.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1987, 132, 'XI F 3.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1988, 133, 'XI F 3.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1989, 134, 'XI F 2.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1990, 135, 'XI F 2.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1991, 136, 'XI F 2.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1992, 137, 'XI F 2.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1993, 138, 'XI F 1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1994, 139, 'XI F 3.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1995, 140, 'XI F 3.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1996, 141, 'XI F 3.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1997, 142, 'XI F 4.1', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1998, 143, 'XI F 4.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(1999, 144, 'XI F 4.2', '2025/2026', '2026-08-16 15:21:35', '2026-08-16 15:21:35'),
(2000, 145, 'XI F 1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2001, 146, 'XI F 1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2002, 147, 'XI F 1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2003, 148, 'XI F 2.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2004, 149, 'XI F 2.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2005, 150, 'XI F 2.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2006, 151, 'XI F 2.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2007, 152, 'XI F 3.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2008, 153, 'XI F 3.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2009, 154, 'XI F 3.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2010, 155, 'XI F 3.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2011, 156, 'XI F 4.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2012, 157, 'XI F 4.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2013, 158, 'XI F 3.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2014, 159, 'XI F 3.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2015, 160, 'XI F 3.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2016, 161, 'XI F 3.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2017, 162, 'XI F 2.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2018, 163, 'XI F 2.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2019, 164, 'XI F 2.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2020, 165, 'XI F 1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2021, 166, 'XI F 2.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2022, 167, 'XI F 1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2023, 168, 'XI F 2.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2024, 169, 'XI F 2.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2025, 170, 'XI F 2.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2026, 171, 'XI F 3.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2027, 172, 'XI F 3.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2028, 173, 'XI F 3.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2029, 174, 'XI F 3.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2030, 175, 'XI F 2.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2031, 176, 'XI F 2.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2032, 177, 'XI F 2.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2033, 178, 'XI F 2.1', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2034, 179, 'XI F 3.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2035, 180, 'XI F 3.2', '2025/2026', '2026-08-16 15:22:30', '2026-08-16 15:22:30'),
(2036, 181, 'XI F 2.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2037, 182, 'XI F 2.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2038, 183, 'XI F 3.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2039, 184, 'XI F 2.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2040, 185, 'XI F 3.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2041, 186, 'XI F 2.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2042, 187, 'XI F 1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2043, 188, 'XI F 3.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2044, 189, 'XI F 3.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2045, 190, 'XI F 3.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2046, 191, 'XI F 4.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2047, 192, 'XI F 4.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2048, 193, 'XI F 3.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2049, 194, 'XI F 3.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2050, 195, 'XI F 3.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2051, 196, 'XI F 1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2052, 197, 'XI F 1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2053, 198, 'XI F 1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2054, 199, 'XI F 4.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2055, 200, 'XI F 3.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2056, 201, 'XI F 2.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2057, 202, 'XI F 2.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2058, 203, 'XI F 2.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2059, 204, 'XI F 2.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2060, 205, 'XI F 1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2061, 206, 'XI F 4.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2062, 207, 'XI F 4.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2063, 208, 'XI F 3.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2064, 209, 'XI F 4.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2065, 210, 'XI F 4.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2066, 211, 'XI F 2.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2067, 212, 'XI F 2.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2068, 213, 'XI F 1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2069, 214, 'XI F 2.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2070, 215, 'XI F 2.2', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2071, 216, 'XI F 2.1', '2025/2026', '2026-08-16 15:23:50', '2026-08-16 15:23:50'),
(2072, 217, 'XI F 2.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2073, 218, 'XI F 2.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2074, 219, 'XI F 1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2075, 220, 'XI F 1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2076, 221, 'XI F 1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2077, 222, 'XI F 1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2078, 223, 'XI F 1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2079, 224, 'XI F 2.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2080, 225, 'XI F 2.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2081, 226, 'XI F 3.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2082, 227, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2083, 228, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2084, 229, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2085, 230, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2086, 231, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2087, 232, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2088, 233, 'XI F 3.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2089, 234, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2090, 235, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2091, 236, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2092, 237, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2093, 238, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2094, 239, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2095, 240, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2096, 241, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2097, 242, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2098, 243, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2099, 244, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2100, 245, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2101, 246, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2102, 247, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2103, 248, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2104, 249, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2105, 250, 'XI F 4.2', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2106, 251, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2107, 252, 'XI F 4.1', '2025/2026', '2026-08-16 15:27:07', '2026-08-16 15:27:07'),
(2396, 1, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2397, 8, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2398, 15, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2399, 22, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2400, 29, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2401, 36, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2402, 37, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2403, 39, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2404, 75, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2405, 78, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2406, 82, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2407, 86, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2408, 90, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2409, 94, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2410, 100, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2411, 106, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2412, 109, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2413, 110, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2414, 111, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2415, 138, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2416, 145, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2417, 146, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2418, 147, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2419, 165, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2420, 167, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2421, 187, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2422, 196, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2423, 197, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2424, 198, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2425, 205, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2426, 213, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2427, 219, 'X 7', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2428, 220, 'X 7', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2429, 221, 'X 7', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2430, 222, 'X 7', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2431, 223, 'X 7', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2432, 2, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2433, 9, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2434, 16, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2435, 23, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2436, 30, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2437, 38, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2438, 73, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2439, 74, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2440, 76, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2441, 79, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2442, 83, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2443, 87, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2444, 91, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2445, 95, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2446, 101, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2447, 107, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2448, 112, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2449, 136, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2450, 137, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2451, 148, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2452, 149, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2453, 162, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2454, 163, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2455, 168, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2456, 169, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2457, 177, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2458, 178, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2459, 186, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2460, 202, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2461, 203, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2462, 211, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2463, 214, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2464, 216, 'X 6', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2465, 218, 'X 7', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2466, 224, 'X 7', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2467, 225, 'X 7', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:48'),
(2468, 3, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2469, 10, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2470, 17, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2471, 24, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2472, 31, 'X 1', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2473, 40, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2474, 41, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2475, 42, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2476, 44, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2477, 45, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2478, 46, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2479, 47, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2480, 48, 'X 2', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2481, 96, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2482, 102, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2483, 108, 'X 3', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2484, 113, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2485, 128, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2486, 129, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2487, 134, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2488, 135, 'X 4', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2489, 150, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2490, 151, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2491, 164, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2492, 166, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2493, 170, 'X 5', '2026/2027', '2026-08-18 03:09:24', '2026-09-03 13:42:47'),
(2494, 175, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2495, 176, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2496, 181, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2497, 182, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2498, 184, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2499, 201, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2500, 204, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2501, 212, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2502, 215, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2503, 217, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2504, 4, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2505, 11, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2506, 18, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2507, 25, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2508, 32, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2509, 43, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2510, 49, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2511, 50, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47');
INSERT INTO `riwayat_kelas_siswa` (`id`, `siswa_id`, `kelas_name`, `academic_year`, `created_at`, `updated_at`) VALUES
(2512, 77, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2513, 80, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2514, 84, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2515, 88, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2516, 92, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2517, 97, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2518, 103, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2519, 114, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2520, 115, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2521, 116, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2522, 117, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2523, 127, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2524, 130, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2525, 131, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2526, 132, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2527, 133, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2528, 152, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2529, 153, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2530, 160, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2531, 161, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2532, 171, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2533, 173, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2534, 174, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2535, 183, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2536, 185, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2537, 190, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2538, 193, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2539, 194, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2540, 5, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2541, 12, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2542, 19, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2543, 26, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2544, 33, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2545, 51, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2546, 52, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2547, 71, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2548, 72, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2549, 81, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2550, 85, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2551, 89, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2552, 93, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2553, 98, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2554, 104, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2555, 118, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2556, 119, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2557, 124, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2558, 125, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2559, 139, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2560, 140, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2561, 141, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2562, 154, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2563, 155, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2564, 158, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2565, 159, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2566, 172, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2567, 179, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2568, 180, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2569, 188, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2570, 189, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2571, 195, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2572, 200, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2573, 208, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2574, 226, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2575, 233, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2576, 6, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2577, 13, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2578, 20, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2579, 27, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2580, 34, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2581, 53, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2582, 54, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2583, 58, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2584, 62, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2585, 63, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2586, 64, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2587, 65, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2588, 66, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2589, 99, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2590, 105, 'X 3', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2591, 120, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2592, 122, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2593, 126, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2594, 142, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2595, 191, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2596, 199, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2597, 227, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2598, 231, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2599, 232, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2600, 234, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2601, 235, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2602, 236, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2603, 241, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2604, 242, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2605, 243, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2606, 245, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2607, 247, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2608, 248, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2609, 249, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2610, 251, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2611, 252, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2612, 7, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2613, 14, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2614, 21, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2615, 28, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2616, 35, 'X 1', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2617, 55, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2618, 56, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2619, 57, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2620, 59, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2621, 60, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2622, 61, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2623, 67, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2624, 68, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2625, 69, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2626, 70, 'X 2', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2627, 121, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2628, 123, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2629, 143, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2630, 144, 'X 4', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2631, 156, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2632, 157, 'X 5', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:47'),
(2633, 192, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2634, 206, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2635, 207, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2636, 209, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2637, 210, 'X 6', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2638, 228, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2639, 229, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2640, 230, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2641, 237, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2642, 238, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2643, 239, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2644, 240, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2645, 244, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2646, 246, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(2647, 250, 'X 7', '2026/2027', '2026-08-18 03:09:25', '2026-09-03 13:42:48'),
(3152, 253, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3153, 254, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3154, 255, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3155, 256, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3156, 257, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3157, 258, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3158, 259, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3159, 260, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3160, 261, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3161, 262, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3162, 263, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3163, 264, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3164, 265, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3165, 266, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3166, 267, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3167, 268, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3168, 269, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3169, 270, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3170, 271, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3171, 272, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3172, 273, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3173, 274, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3174, 275, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3175, 276, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3176, 277, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3177, 278, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3178, 279, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3179, 280, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3180, 281, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3181, 282, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3182, 283, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3183, 284, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3184, 285, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3185, 286, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3186, 287, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3187, 288, 'XI F 1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3188, 289, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3189, 290, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3190, 291, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3191, 292, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3192, 293, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3193, 294, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3194, 295, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3195, 296, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3196, 297, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3197, 298, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3198, 299, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3199, 300, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3200, 301, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3201, 302, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3202, 303, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3203, 304, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3204, 305, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3205, 306, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3206, 307, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3207, 308, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3208, 309, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3209, 310, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3210, 311, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3211, 312, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3212, 313, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3213, 314, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3214, 315, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3215, 316, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3216, 317, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3217, 318, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3218, 319, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3219, 320, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3220, 321, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3221, 322, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3222, 323, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3223, 324, 'XI F 2.1', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3224, 325, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3225, 326, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3226, 327, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3227, 328, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3228, 329, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3229, 330, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3230, 331, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3231, 332, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3232, 333, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3233, 334, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3234, 335, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3235, 336, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3236, 337, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3237, 338, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3238, 339, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3239, 340, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3240, 341, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3241, 342, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3242, 343, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3243, 344, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3244, 345, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3245, 346, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3246, 347, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3247, 348, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3248, 349, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3249, 350, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3250, 351, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3251, 352, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3252, 353, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3253, 354, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3254, 355, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3255, 356, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3256, 357, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3257, 358, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3258, 359, 'XI F 2.2', '2026/2027', '2026-09-03 13:42:48', '2026-09-03 13:42:48'),
(3259, 360, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3260, 361, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3261, 362, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3262, 363, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3263, 364, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3264, 365, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3265, 366, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3266, 367, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3267, 368, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3268, 369, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3269, 370, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3270, 371, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3271, 372, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3272, 373, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3273, 374, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3274, 375, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3275, 376, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3276, 377, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3277, 378, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3278, 379, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3279, 380, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3280, 381, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3281, 382, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3282, 383, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3283, 384, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3284, 385, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3285, 386, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3286, 387, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3287, 388, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3288, 389, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3289, 390, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3290, 391, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3291, 392, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3292, 393, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3293, 394, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3294, 395, 'XI F 3.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3295, 396, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3296, 397, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3297, 398, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3298, 399, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3299, 400, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3300, 401, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3301, 402, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3302, 403, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3303, 404, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3304, 405, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3305, 406, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3306, 407, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3307, 408, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3308, 409, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3309, 410, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3310, 411, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3311, 412, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3312, 413, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3313, 414, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3314, 415, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3315, 416, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3316, 417, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3317, 418, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3318, 419, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3319, 420, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3320, 421, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3321, 422, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3322, 423, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3323, 424, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3324, 425, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3325, 426, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3326, 427, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3327, 428, 'XI F 3.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3328, 429, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3329, 430, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3330, 431, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3331, 432, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3332, 433, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3333, 434, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3334, 435, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3335, 436, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3336, 437, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3337, 438, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3338, 439, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3339, 440, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3340, 441, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3341, 442, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3342, 443, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3343, 444, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3344, 445, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3345, 446, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3346, 447, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3347, 448, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3348, 449, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3349, 450, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3350, 451, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3351, 452, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3352, 453, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3353, 454, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3354, 455, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3355, 456, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3356, 457, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3357, 458, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3358, 459, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3359, 460, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3360, 461, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3361, 462, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3362, 463, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3363, 464, 'XI F 4.1', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3364, 465, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3365, 466, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3366, 467, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3367, 468, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3368, 469, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3369, 470, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3370, 471, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3371, 472, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3372, 473, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3373, 474, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3374, 475, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3375, 476, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3376, 477, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3377, 478, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3378, 479, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3379, 480, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3380, 481, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3381, 482, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3382, 483, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3383, 484, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3384, 485, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3385, 486, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3386, 487, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3387, 488, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3388, 489, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3389, 490, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3390, 491, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3391, 492, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3392, 493, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3393, 494, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3394, 495, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3395, 496, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3396, 497, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3397, 498, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3398, 499, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49'),
(3399, 500, 'XI F 4.2', '2026/2027', '2026-09-03 13:42:49', '2026-09-03 13:42:49');

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
('xuGDWveWAypUnA99niNi09sAW4HZxNDMrnrfE8C2', 23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoicmhTak1JNmRmaks2ckk3T1VmOUQzMTdKSXUzd0xEVnBYUmNZeXh4biI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2hvbWVyb29tL2xlZ2VyLW5pbGFpIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjM7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6ImIzMzEzNDFmNDVlYjdmMzJjMDIwZjZiZjY4ZWMwYmY4MTMyNDRlMDA2YjM0M2Y0OGY2NzRjZjY0YjI4NDcyNTAiO30=', 1788798442);

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
(1, 'tahun_ajaran_aktif', '2026/2027', '2026-07-06 06:36:50', '2026-08-18 05:02:20'),
(2, 'daftar_tahun_ajaran_custom', '[\"2025\\/2026\",\"2026\\/2027\"]', '2026-07-07 18:17:57', '2026-08-18 03:07:12'),
(3, 'system_roles', '{\"admin\":\"Administrator\",\"guru\":\"Guru Pengajar\",\"wali_kelas\":\"Wali Kelas\",\"siswa\":\"Siswa\"}', '2026-07-11 02:19:18', '2026-07-11 02:19:18'),
(4, 'system_modules', '{\"Data Sekolah (Siswa, Kelas)\":{\"view\":{\"key\":\"view_siswa\",\"label\":\"Melihat Siswa & Kelas\"},\"create\":{\"key\":\"create_siswa\",\"label\":\"Tambah Siswa & Kelas\"},\"edit\":{\"key\":\"edit_siswa\",\"label\":\"Edit Siswa & Kelas\"},\"delete\":{\"key\":\"delete_siswa\",\"label\":\"Hapus Siswa & Kelas\"}},\"Data Guru\":{\"view\":{\"key\":\"view_guru\",\"label\":\"Melihat Guru\"},\"create\":{\"key\":\"create_guru\",\"label\":\"Tambah Guru\"},\"edit\":{\"key\":\"edit_guru\",\"label\":\"Edit Guru\"},\"delete\":{\"key\":\"delete_guru\",\"label\":\"Hapus Guru\"}},\"Tugas & Pembelajaran\":{\"view\":{\"key\":\"view_tugas\",\"label\":\"Melihat Tugas\"},\"create\":{\"key\":\"create_tugas\",\"label\":\"Tambah Tugas\"},\"edit\":{\"key\":\"edit_tugas\",\"label\":\"Edit Tugas & Nilai\"},\"delete\":{\"key\":\"delete_tugas\",\"label\":\"Hapus Tugas\"}},\"Verifikasi Banding (SSL)\":{\"view\":{\"key\":\"view_dispensasi\",\"label\":\"Melihat Dispensasi\"},\"create\":null,\"edit\":{\"key\":\"approve_dispensasi\",\"label\":\"Setujui Dispensasi\"},\"delete\":null},\"Cetak Laporan\":{\"view\":{\"key\":\"view_laporan\",\"label\":\"Lihat Laporan\"},\"create\":null,\"edit\":null,\"delete\":null},\"Pengaturan Sistem\":{\"view\":null,\"create\":null,\"edit\":{\"key\":\"manage_settings\",\"label\":\"Pengaturan Sistem\"},\"delete\":null}}', '2026-07-11 02:19:18', '2026-07-11 02:19:18'),
(5, 'ssl_lock_expired_deadline', '1', '2026-08-17 12:46:51', '2026-08-18 04:46:23'),
(6, 'ssl_threshold', '3', '2026-08-18 04:39:43', '2026-08-18 04:42:31'),
(7, 'school_name', 'SMA Negeri 1 Cepogo', '2026-09-07 11:35:35', '2026-09-07 11:35:35'),
(8, 'school_npsn', '', '2026-09-07 11:35:35', '2026-09-07 11:35:35'),
(9, 'school_email', 'info@smansago.sch.id', '2026-09-07 11:35:36', '2026-09-07 11:35:36'),
(10, 'school_phone', '(0276)', '2026-09-07 11:35:36', '2026-09-07 11:35:36'),
(11, 'school_website', 'https://sman1cepogo.sch.id', '2026-09-07 11:35:36', '2026-09-07 11:35:36'),
(12, 'headmaster_name', '', '2026-09-07 11:35:36', '2026-09-07 11:35:36'),
(13, 'headmaster_nip', '', '2026-09-07 11:35:36', '2026-09-07 11:35:36'),
(14, 'school_address', 'Jl. Cepogo KM. 13, Boyolali, Jawa Tengah', '2026-09-07 11:35:36', '2026-09-07 11:35:36'),
(15, 'lock_duration_hours', '24', '2026-09-07 11:35:36', '2026-09-07 11:35:36'),
(16, 'allow_dispensations', '1', '2026-09-07 11:35:36', '2026-09-07 11:35:36'),
(17, 'permissions_page_password', 'admin123', '2026-09-07 11:35:36', '2026-09-07 11:35:36');

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
(1, NULL, 'AKRIMA NAYLA AMIRA AGHNI', 'BOYOLALI', 'Laki-laki', '2009-12-28', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 36, '2026-07-06 06:23:53', '2026-09-03 13:42:47', NULL),
(2, NULL, 'ANIS PUTRI RAHMADANI', 'Boyolali', 'Laki-laki', '2009-09-05', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 37, '2026-07-06 06:23:53', '2026-09-03 13:42:47', NULL),
(3, NULL, 'ARIF EVAN NUR ROHMAT', 'BOYOLALI', 'Laki-laki', '2010-06-23', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 38, '2026-07-06 06:23:53', '2026-09-03 13:42:47', NULL),
(4, NULL, 'AULIA AZZAHRA', 'BOYOLALI', 'Laki-laki', '2009-07-27', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 39, '2026-07-06 06:23:53', '2026-09-03 13:42:47', NULL),
(5, NULL, 'BRILLIANT ATAINA ZULHIJA', 'PANGKALAN BUN', 'Laki-laki', '2009-11-22', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 40, '2026-07-06 06:23:54', '2026-09-03 13:42:47', NULL),
(6, NULL, 'DEFAN DRIAN RIFAL KANDELA', 'BOYOLALI', 'Laki-laki', '2010-06-11', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 41, '2026-07-06 06:23:54', '2026-09-03 13:42:47', NULL),
(7, NULL, 'DIAN AYUK SETIANINGSIH', 'BOYOLALI', 'Laki-laki', '2009-07-19', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 42, '2026-07-06 06:23:54', '2026-09-03 13:42:47', NULL),
(8, NULL, 'EKA SELVIANA', 'BOYOLALI', 'Laki-laki', '2009-09-14', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 43, '2026-07-06 06:23:54', '2026-09-03 13:42:47', NULL),
(9, NULL, 'FADILA ALTHEA UFAIRA PUTRI', 'Boyolali', 'Laki-laki', '2009-07-03', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 44, '2026-07-06 06:23:55', '2026-09-03 13:42:47', NULL),
(10, NULL, 'FAREL WAHYU WIBOWO', 'Boyolali', 'Laki-laki', '2010-04-10', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 45, '2026-07-06 06:23:55', '2026-09-03 13:42:47', NULL),
(11, NULL, 'GALANG ADITYA NUGROHO', 'Boyolali', 'Laki-laki', '2010-02-03', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 46, '2026-07-06 06:23:55', '2026-09-03 13:42:47', NULL),
(12, NULL, 'GRACIA MAYLLANE PUTRI LEDO', 'SUKOHARJO', 'Laki-laki', '2009-05-03', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 47, '2026-07-06 06:23:55', '2026-09-03 13:42:47', NULL),
(13, NULL, 'INDRIYANI WIDIASTUTI', 'BOYOLALI', 'Laki-laki', '2010-04-12', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 48, '2026-07-06 06:23:56', '2026-09-03 13:42:47', NULL),
(14, NULL, 'IRSYAD ADI RINAWAN', 'Boyolali', 'Laki-laki', '2010-02-17', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 49, '2026-07-06 06:23:56', '2026-09-03 13:42:47', NULL),
(15, NULL, 'KHANZA LATIFAH', 'BOYOLALI', 'Laki-laki', '2010-01-04', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 50, '2026-07-06 06:23:56', '2026-09-03 13:42:47', NULL),
(16, NULL, 'LILYANA MELINDA ELMER', 'BOYOLALI', 'Laki-laki', '2009-10-30', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 51, '2026-07-06 06:23:56', '2026-09-03 13:42:47', NULL),
(17, NULL, 'LUTHFI KAMIL JIBRAN', 'BOYOLALI', 'Laki-laki', '2010-07-14', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 52, '2026-07-06 06:23:56', '2026-09-03 13:42:47', NULL),
(18, NULL, 'MUHAMMAD BURHANUDIN HIBATULLOH', 'BOYOLALI', 'Laki-laki', '2010-04-16', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 53, '2026-07-06 06:23:57', '2026-09-03 13:42:47', NULL),
(19, NULL, 'Nanda Yusuf Prakoso', 'Boyolali', 'Laki-laki', '2010-08-28', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 54, '2026-07-06 06:23:57', '2026-09-03 13:42:47', NULL),
(20, NULL, 'NATHAN YOGA PRATAMA', 'Boyolali', 'Laki-laki', '2009-08-21', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 55, '2026-07-06 06:23:57', '2026-09-03 13:42:47', NULL),
(21, NULL, 'NAURA SYAFA', 'BOYOLALI', 'Laki-laki', '2009-05-16', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 56, '2026-07-06 06:23:57', '2026-09-03 13:42:47', NULL),
(22, NULL, 'Novita Rokhim Mawati', 'Boyolali', 'Laki-laki', '2009-10-30', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 57, '2026-07-06 06:23:58', '2026-09-03 13:42:47', NULL),
(23, NULL, 'PURWANINGSIH', 'BOYOLALI', 'Laki-laki', '2009-12-21', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 58, '2026-07-06 06:23:58', '2026-09-03 13:42:47', NULL),
(24, NULL, 'RAIF BANU FAIRUZ', 'JAKARTA', 'Laki-laki', '2009-05-14', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 59, '2026-07-06 06:23:58', '2026-09-03 13:42:47', NULL),
(25, NULL, 'RENI OKTAVIA SARI', 'Boyolali', 'Laki-laki', '2009-10-24', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 60, '2026-07-06 06:23:58', '2026-09-03 13:42:47', NULL),
(26, NULL, 'RISMA NUR KHASANAH', 'BOYOLALI', 'Perempuan', '2009-09-10', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 61, '2026-07-06 06:23:58', '2026-09-03 13:42:47', NULL),
(27, NULL, 'ROKHIM MAHESTI', 'BOYOLALI', 'Perempuan', '2010-12-29', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 62, '2026-07-06 06:23:59', '2026-09-03 13:42:47', NULL),
(28, NULL, 'SEAN CAROLINE VALENTINE BAETRICE', 'SALATIGA', 'Perempuan', '2010-02-13', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 63, '2026-07-06 06:23:59', '2026-09-03 13:42:47', NULL),
(29, NULL, 'SEVI LEVIAN GRAFISI', 'SERUI', 'Perempuan', '2009-12-02', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 64, '2026-07-06 06:23:59', '2026-09-03 13:42:47', NULL),
(30, NULL, 'SULISTYANI MASRUROH', 'BOYOLALI', 'Perempuan', '2010-10-11', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 65, '2026-07-06 06:23:59', '2026-09-03 13:42:47', NULL),
(31, NULL, 'SYARIF HIDAYATULLOH', 'BOYOLALI', 'Perempuan', '2009-09-19', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 66, '2026-07-06 06:24:00', '2026-09-03 13:42:47', NULL),
(32, NULL, 'TRI NOFIYANTI', 'Boyolali', 'Perempuan', '2009-10-29', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 67, '2026-07-06 06:24:00', '2026-09-03 13:42:47', NULL),
(33, NULL, 'WAHYU OKTAVIA LESTARI', 'Boyolali', 'Perempuan', '2009-10-27', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 68, '2026-07-06 06:24:00', '2026-09-03 13:42:47', NULL),
(34, NULL, 'WIDIYANTO', 'Boyolali', 'Perempuan', '2009-08-22', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 69, '2026-07-06 06:24:00', '2026-09-03 13:42:47', NULL),
(35, NULL, 'Yoris Arya Rahmadan', 'Boyolali', 'Perempuan', '2009-09-02', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 70, '2026-07-06 06:24:01', '2026-09-03 13:42:47', NULL),
(36, NULL, 'YUNI RAHMAWATI', 'BOYOLALI', 'Perempuan', '2009-06-03', NULL, 'X 1', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 71, '2026-07-06 06:24:01', '2026-09-03 13:42:47', NULL),
(37, NULL, 'ADITYA DWI PUTRA', 'BOYOLALI', 'Laki-laki', '2010-01-23', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 72, '2026-07-06 06:24:01', '2026-09-03 13:42:47', NULL),
(38, NULL, 'Afiqah Ocktavi Wahyunia', 'BOYOLALI', 'Laki-laki', '2009-10-06', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 73, '2026-07-06 06:24:01', '2026-09-03 13:42:47', NULL),
(39, NULL, 'ALFIFAH ADYSTIA NURNANINGSIH', 'Wonogiri', 'Laki-laki', '2010-05-23', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 74, '2026-07-06 06:24:02', '2026-09-03 13:42:47', NULL),
(40, NULL, 'ALVI AINURROZIQIN', 'Boyolali', 'Perempuan', '2010-03-16', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 75, '2026-07-06 06:24:02', '2026-09-03 13:42:47', NULL),
(41, NULL, 'ANISA AUFA ABIBATUL AZIZAH', 'BOYOLALI', 'Perempuan', '2009-11-26', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 76, '2026-07-06 06:24:02', '2026-09-03 13:42:47', NULL),
(42, NULL, 'AULIA ISTIQOMAH', 'BOYOLALI', 'Perempuan', '2010-07-11', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 77, '2026-07-06 06:24:02', '2026-09-03 13:42:47', NULL),
(43, NULL, 'BAGUS RIVAI', 'BOYOLALI', 'Perempuan', '2010-03-27', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 78, '2026-07-06 06:24:03', '2026-09-03 13:42:47', NULL),
(44, NULL, 'CALISTA SALMA MAHESWARI', 'Boyolali', 'Perempuan', '2009-02-27', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 79, '2026-07-06 06:24:03', '2026-09-03 13:42:47', NULL),
(45, NULL, 'DENIS ABI SETIAWAN', 'Boyolali', 'Perempuan', '2010-08-02', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 80, '2026-07-06 06:24:03', '2026-09-03 13:42:47', NULL),
(46, NULL, 'DIAN FATMAH AINU ROHMAH', 'Boyolali', 'Perempuan', '2009-08-21', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 81, '2026-07-06 06:24:03', '2026-09-03 13:42:47', NULL),
(47, NULL, 'EKA WULAN RAMADHANI', 'BOYOLALI', 'Perempuan', '2010-08-24', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 82, '2026-07-06 06:24:04', '2026-09-03 13:42:47', NULL),
(48, NULL, 'Faisya Ramadani', 'Boyolali', 'Perempuan', '2010-08-11', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 83, '2026-07-06 06:24:04', '2026-09-03 13:42:47', NULL),
(49, NULL, 'Farhan Zaki Fahrezy', 'Boyolali', 'Perempuan', '2009-11-30', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 84, '2026-07-06 06:24:04', '2026-09-03 13:42:47', NULL),
(50, NULL, 'GALIH PRATITIS WULANDRI UTOMO', 'BOYOLALI', 'Perempuan', '2010-06-09', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 85, '2026-07-06 06:24:04', '2026-09-03 13:42:47', NULL),
(51, NULL, 'GILDA CELLYN MAGDALENA', 'BOYOLALI', 'Perempuan', '2011-02-03', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 86, '2026-07-06 06:24:05', '2026-09-03 13:42:47', NULL),
(52, NULL, 'ISNAN NUR ARIFIN', 'BOYOLALI', 'Perempuan', '2009-12-31', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 87, '2026-07-06 06:24:05', '2026-09-03 13:42:47', NULL),
(53, NULL, 'JHUHRIA FEBRIANA', 'Boyolali', 'Perempuan', '2010-02-08', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 88, '2026-07-06 06:24:05', '2026-09-03 13:42:47', NULL),
(54, NULL, 'KIRANA NOVITASARI', 'BOYOLALI', 'Perempuan', '2009-11-01', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 89, '2026-07-06 06:24:05', '2026-09-03 13:42:47', NULL),
(55, NULL, 'LINTANG FAJAR WATI', 'BOYOLALI', 'Perempuan', '2009-11-22', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 90, '2026-07-06 06:24:06', '2026-09-03 13:42:47', NULL),
(56, NULL, 'MASSYAHRIL ARBA MAULANA', 'BOYOLALI', 'Perempuan', '2009-12-20', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 91, '2026-07-06 06:24:06', '2026-09-03 13:42:47', NULL),
(57, NULL, 'MUHAMMAD DIMAS AGUNG NUGROHO', 'BOYOLALI', 'Perempuan', '2009-10-22', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 92, '2026-07-06 06:24:06', '2026-09-03 13:42:47', NULL),
(58, NULL, 'NAYLA AZ ZAHRA', 'BOYOLALI', 'Perempuan', '2010-02-15', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 93, '2026-07-06 06:24:06', '2026-09-03 13:42:47', NULL),
(59, NULL, 'NAZA AKMAL FAIRIZUAN', 'BOYOLALI', 'Perempuan', '2009-10-21', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 94, '2026-07-06 06:24:07', '2026-09-03 13:42:47', NULL),
(60, NULL, 'NUR AINA SANIYAH QOLBI', 'BOYOLALI', 'Perempuan', '2010-07-07', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 95, '2026-07-06 06:24:07', '2026-09-03 13:42:47', NULL),
(61, NULL, 'PUTRI MAULIDA', 'BOYOLALI', 'Perempuan', '2010-02-26', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 96, '2026-07-06 06:24:07', '2026-09-03 13:42:47', NULL),
(62, NULL, 'RAKA RISANNJANA', 'BOYOLALI', 'Perempuan', '2010-08-10', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 97, '2026-07-06 06:24:08', '2026-09-03 13:42:47', NULL),
(63, NULL, 'RINA HANDAYANI', 'BOYOLALI', 'Perempuan', '2009-06-30', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 98, '2026-07-06 06:24:08', '2026-09-03 13:42:47', NULL),
(64, NULL, 'RONI OKTAVIAN', 'BOYOLALI', 'Perempuan', '2009-10-05', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 99, '2026-07-06 06:24:08', '2026-09-03 13:42:47', NULL),
(65, NULL, 'Salsa Nabila Dwi Aryanti', 'Boyolali', 'Perempuan', '2009-08-04', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 100, '2026-07-06 06:24:08', '2026-09-03 13:42:47', NULL),
(66, NULL, 'Septiyana Ramadani', 'Boyolali', 'Perempuan', '2009-09-02', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 101, '2026-07-06 06:24:09', '2026-09-03 13:42:47', NULL),
(67, NULL, 'SITI ROHANI', 'BOYOLALI', 'Perempuan', '2010-02-22', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 102, '2026-07-06 06:24:09', '2026-09-03 13:42:47', NULL),
(68, NULL, 'SYAFA MUFIDA AZ-ZAHRA', 'BOYOLALI', 'Perempuan', '2010-03-11', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 103, '2026-07-06 06:24:09', '2026-09-03 13:42:47', NULL),
(69, NULL, 'TRI WAHYU NOVIANA', 'BOYOLALI', 'Perempuan', '2009-11-14', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 104, '2026-07-06 06:24:09', '2026-09-03 13:42:47', NULL),
(70, NULL, 'TRI WAHYU NOVIANI', 'BOYOLALI', 'Perempuan', '2009-11-14', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 105, '2026-07-06 06:24:10', '2026-09-03 13:42:47', NULL),
(71, NULL, 'WAHYU WALIMATUL KHOLIFAH', 'BOYOLALI', 'Perempuan', '2010-01-31', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 106, '2026-07-06 06:24:10', '2026-09-03 13:42:47', NULL),
(72, NULL, 'YUNIA RIZKI ANISA', 'WONOSOBO', 'Perempuan', '2009-06-19', NULL, 'X 2', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 107, '2026-07-06 06:24:10', '2026-09-03 13:42:47', NULL),
(73, NULL, 'ABIZAH DEVANA HAFSARI', 'Boyolali', 'Laki-laki', '2009-10-13', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 108, '2026-07-06 06:24:10', '2026-09-03 13:42:47', NULL),
(74, NULL, 'ALANA JUAN REVANO', 'BOYOLALI', 'Laki-laki', '2009-07-10', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 109, '2026-07-06 06:24:11', '2026-09-03 13:42:47', NULL),
(75, NULL, 'ALIF CAHYA SETYANI', 'BOYOLALI', 'Laki-laki', '2010-01-18', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 110, '2026-07-06 06:24:11', '2026-09-03 13:42:47', NULL),
(76, NULL, 'ALVIN FEBRIYANSAH', 'BOYOLALI', 'Laki-laki', '2010-02-12', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 111, '2026-07-06 06:24:11', '2026-09-03 13:42:47', NULL),
(77, NULL, 'ANISA FEBRIYANA', 'BOYOLALI', 'Laki-laki', '2010-02-24', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 112, '2026-07-06 06:24:11', '2026-09-03 13:42:47', NULL),
(78, NULL, 'AULIA NUR RISKI', 'BANDUNG', 'Perempuan', '2009-08-16', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 113, '2026-07-06 06:24:11', '2026-09-03 13:42:47', NULL),
(79, NULL, 'BAYU BAGUS LASTYADI', 'Boyolali', 'Perempuan', '2009-08-14', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 114, '2026-07-06 06:24:12', '2026-09-03 13:42:47', NULL),
(80, NULL, 'CHALILA NISRIN DEWANTI', 'Boyolali', 'Perempuan', '2010-01-04', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 115, '2026-07-06 06:24:12', '2026-09-03 13:42:47', NULL),
(81, NULL, 'DIKI PRAMANA', 'BOYOLALI', 'Perempuan', '2010-05-13', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 116, '2026-07-06 06:24:12', '2026-09-03 13:42:47', NULL),
(82, NULL, 'DINI INDAH AULIA', 'BOYOLALI', 'Perempuan', '2010-04-08', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 117, '2026-07-06 06:24:12', '2026-09-03 13:42:47', NULL),
(83, NULL, 'ELSA DEMAWATI', 'BOYOLALI', 'Perempuan', '2009-12-03', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 118, '2026-07-06 06:24:13', '2026-09-03 13:42:47', NULL),
(84, NULL, 'FARA AYU DITA', 'BOYOLALI', 'Perempuan', '2010-03-04', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 119, '2026-07-06 06:24:13', '2026-09-03 13:42:47', NULL),
(85, NULL, 'FARIS NAZHRIL ILHAM PRATAMA', 'SUKOHARJO', 'Perempuan', '2010-03-07', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 120, '2026-07-06 06:24:13', '2026-09-03 13:42:47', NULL),
(86, NULL, 'HABIBAH SYAFA FAUZIAH', 'BOYOLALI', 'Perempuan', '2010-02-18', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 121, '2026-07-06 06:24:13', '2026-09-03 13:42:47', NULL),
(87, NULL, 'HAFIDZ MUHAMMAD IRFAN', 'BOYOLALI', 'Perempuan', '2009-09-30', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 122, '2026-07-06 06:24:13', '2026-09-03 13:42:47', NULL),
(88, NULL, 'INTAN NUR AISYAH', 'Boyolali', 'Perempuan', '2010-01-19', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 123, '2026-07-06 06:24:14', '2026-09-03 13:42:47', NULL),
(89, NULL, 'JAVERA RASHIF TRISTANDIKA', 'BOYOLALI', 'Perempuan', '2010-07-13', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 124, '2026-07-06 06:24:14', '2026-09-03 13:42:47', NULL),
(90, NULL, 'KALISA REGINA PUTRI', 'BOYOLALI', 'Perempuan', '2010-09-17', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 125, '2026-07-06 06:24:14', '2026-09-03 13:42:47', NULL),
(91, NULL, 'LUTFI AULIA RAMADHANI', 'BOYOLALI', 'Perempuan', '2010-08-11', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 126, '2026-07-06 06:24:14', '2026-09-03 13:42:47', NULL),
(92, NULL, 'MAULANA SATRIA SAPUTRA', 'Boyolali', 'Perempuan', '2010-01-12', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 127, '2026-07-06 06:24:15', '2026-09-03 13:42:47', NULL),
(93, NULL, 'MUHAMMAD FAISAL ABIDIN', 'BOYOLALI', 'Perempuan', '2009-05-20', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 128, '2026-07-06 06:24:15', '2026-09-03 13:42:47', NULL),
(94, NULL, 'NAYLA WAHYU LESTARI', 'BOYOLALI', 'Perempuan', '2010-01-29', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 129, '2026-07-06 06:24:15', '2026-09-03 13:42:47', NULL),
(95, NULL, 'NICO FANDEZTA PRATAMA', 'Boyolali', 'Perempuan', '2009-10-24', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 130, '2026-07-06 06:24:15', '2026-09-03 13:42:47', NULL),
(96, NULL, 'NUR SHOLIKAH', 'BOYOLALI', 'Perempuan', '2010-06-30', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 131, '2026-07-06 06:24:16', '2026-09-03 13:42:47', NULL),
(97, NULL, 'Putri Nur Sholekha', 'Boyolali', 'Perempuan', '2010-03-15', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 132, '2026-07-06 06:24:16', '2026-09-03 13:42:47', NULL),
(98, NULL, 'RAVI ALFATAH', 'BOYOLALI', 'Perempuan', '2009-04-20', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 133, '2026-07-06 06:24:16', '2026-09-03 13:42:47', NULL),
(99, NULL, 'RINDU MUGI LESTARI', 'BOYOLALI', 'Perempuan', '2009-08-27', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 134, '2026-07-06 06:24:16', '2026-09-03 13:42:47', NULL),
(100, NULL, 'SAIFUL BAHRI', 'BOYOLALI', 'Perempuan', '2009-03-26', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 135, '2026-07-06 06:24:17', '2026-09-03 13:42:47', NULL),
(101, NULL, 'SALWA AURA SAFITRI', 'BOYOLALI', 'Perempuan', '2009-09-24', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 136, '2026-07-06 06:24:17', '2026-09-03 13:42:47', NULL),
(102, NULL, 'SHELA ARINI FAUZIYAH', 'BOYOLALI', 'Perempuan', '2010-02-11', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 137, '2026-07-06 06:24:17', '2026-09-03 13:42:47', NULL),
(103, NULL, 'SOFIANA NOVITA SARI', 'Grobogan', 'Perempuan', '2010-06-22', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 138, '2026-07-06 06:24:17', '2026-09-03 13:42:47', NULL),
(104, NULL, 'SYAFINA FEBRIASTUTI', 'BOYOLALI', 'Perempuan', '2010-02-16', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 139, '2026-07-06 06:24:17', '2026-09-03 13:42:47', NULL),
(105, NULL, 'TAHTA ANDHIKA SETYAWAN', 'Boyolali', 'Perempuan', '2009-06-07', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 140, '2026-07-06 06:24:18', '2026-09-03 13:42:47', NULL),
(106, NULL, 'TOMY KURNIAWAN', 'BOYOLALI', 'Perempuan', '2009-10-28', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 141, '2026-07-06 06:24:18', '2026-09-03 13:42:47', NULL),
(107, NULL, 'WINDI FATIKA KHASANAH', 'B OYOLALI', 'Perempuan', '2009-11-05', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 142, '2026-07-06 06:24:18', '2026-09-03 13:42:47', NULL),
(108, NULL, 'ZAHRA FAJRINA', 'BOYOLALI', 'Perempuan', '2010-07-27', NULL, 'X 3', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 143, '2026-07-06 06:24:18', '2026-09-03 13:42:47', NULL),
(109, NULL, 'AFISAH MAHARANI', 'BOYOLALI', 'Laki-laki', '2010-05-20', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 144, '2026-07-06 06:24:19', '2026-09-03 13:42:47', NULL),
(110, NULL, 'ALFANO DWI HANDIKA', 'BOYOLALI', 'Laki-laki', '2009-04-03', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 145, '2026-07-06 06:24:19', '2026-09-03 13:42:47', NULL),
(111, NULL, 'ALINDA BRILIAN TIKA DEWI', 'BOYOLALI', 'Laki-laki', '2010-07-12', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 146, '2026-07-06 06:24:19', '2026-09-03 13:42:47', NULL),
(112, NULL, 'Andante Arga Yudhistira Prabowo', 'Boyolali', 'Laki-laki', '2010-06-11', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 147, '2026-07-06 06:24:19', '2026-09-03 13:42:47', NULL),
(113, NULL, 'ANNIS EKA ARIYANI', 'Boyolali', 'Laki-laki', '2009-05-16', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 148, '2026-07-06 06:24:20', '2026-09-03 13:42:47', NULL),
(114, NULL, 'AULIA RAFI QURROHMAN', 'BOYOLALI', 'Laki-laki', '2008-12-04', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 149, '2026-07-06 06:24:20', '2026-09-03 13:42:47', NULL),
(115, NULL, 'BAYU JATI ANGKOSO', 'BOYOLALI', 'Laki-laki', '2009-09-26', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 150, '2026-07-06 06:24:20', '2026-09-03 13:42:47', NULL),
(116, NULL, 'Daimatul Karimah', 'Boyolali', 'Laki-laki', '2010-04-14', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 151, '2026-07-06 06:24:20', '2026-09-03 13:42:47', NULL),
(117, NULL, 'DWI DONI PRABOWO', 'BOYOLALI', 'Laki-laki', '2009-11-28', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 152, '2026-07-06 06:24:21', '2026-09-03 13:42:47', NULL),
(118, NULL, 'DWI KURNIAWAN', 'BOYOLALI', 'Laki-laki', '2009-11-22', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 153, '2026-07-06 06:24:21', '2026-09-03 13:42:47', NULL),
(119, NULL, 'ENGGAR WAHYUNI', 'Boyolali', 'Laki-laki', '2010-06-15', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 154, '2026-07-06 06:24:21', '2026-09-03 13:42:47', NULL),
(120, NULL, 'FATAH RAMADHAN AJI SAPUTRA', 'BOYOLALI', 'Laki-laki', '2010-08-25', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 155, '2026-07-06 06:24:21', '2026-09-03 13:42:47', NULL),
(121, NULL, 'FEBRYANA ANGREINY PRANATA', 'Boyolali', 'Laki-laki', '2010-02-05', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 156, '2026-07-06 06:24:22', '2026-09-03 13:42:47', NULL),
(122, NULL, 'HANIFAH PUTRI MEILANI', 'Boyolali', 'Laki-laki', '2010-05-20', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 157, '2026-07-06 06:24:22', '2026-09-03 13:42:47', NULL),
(123, NULL, 'IQBAAL LUQMAN SAPUTRA', 'BOYOLALI', 'Perempuan', '2009-09-19', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 158, '2026-07-06 06:24:22', '2026-09-03 13:42:47', NULL),
(124, NULL, 'JAYANUDIN PURNA MURTI', 'BOYOLALI', 'Perempuan', '2010-04-27', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 159, '2026-07-06 06:24:22', '2026-09-03 13:42:47', NULL),
(125, NULL, 'KAYLA NUR ADILLA', 'TANGERANG', 'Perempuan', '2010-10-24', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 160, '2026-07-06 06:24:22', '2026-09-03 13:42:47', NULL),
(126, NULL, 'KRISTIANA KURNIAWATI', 'BOYOLALI', 'Perempuan', '2010-02-22', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 161, '2026-07-06 06:24:23', '2026-09-03 13:42:47', NULL),
(127, NULL, 'MAYLA NURUL AFIFAH', 'BOYOLALI', 'Perempuan', '2010-05-05', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 162, '2026-07-06 06:24:23', '2026-09-03 13:42:47', NULL),
(128, NULL, 'MUHAMAD AKBAR SALIM', 'BOYOLALI', 'Perempuan', '2009-10-08', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 163, '2026-07-06 06:24:23', '2026-09-03 13:42:47', NULL),
(129, NULL, 'MUHAMMAD HABIB LUTHFI', 'BOYOLALI', 'Perempuan', '2010-04-25', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 164, '2026-07-06 06:24:23', '2026-09-03 13:42:47', NULL),
(130, NULL, 'NINA VANIA ZERLINA', 'BOYOLALI', 'Perempuan', '2009-11-19', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 165, '2026-07-06 06:24:24', '2026-09-03 13:42:47', NULL),
(131, NULL, 'NOVAL RIFKY AFRIANTO', 'BOYOLALI', 'Perempuan', '2009-11-08', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 166, '2026-07-06 06:24:24', '2026-09-03 13:42:47', NULL),
(132, NULL, 'NUR UTAMI', 'BOYOLALI', 'Perempuan', '2009-11-08', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 167, '2026-07-06 06:24:24', '2026-09-03 13:42:47', NULL),
(133, NULL, 'RAIHANNISA PUTRI FITRIANA', 'BOYOLALI', 'Perempuan', '2009-09-25', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 168, '2026-07-06 06:24:24', '2026-09-03 13:42:47', NULL),
(134, NULL, 'REZA ZAPUTRA', 'BOYOLALI', 'Perempuan', '2009-06-16', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 169, '2026-07-06 06:24:25', '2026-09-03 13:42:47', NULL),
(135, NULL, 'RIRIN DWI PRASETYANI', 'BOYOLALI', 'Perempuan', '2009-08-17', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 170, '2026-07-06 06:24:25', '2026-09-03 13:42:47', NULL),
(136, NULL, 'SANTI OLIVIA NINGSIH', 'BOYOLALI', 'Perempuan', '2009-04-30', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 171, '2026-07-06 06:24:25', '2026-09-03 13:42:47', NULL),
(137, NULL, 'SATRIA OCTA CAHYO PUTRO', 'Boyolali', 'Perempuan', '2009-10-22', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 172, '2026-07-06 06:24:25', '2026-09-03 13:42:47', NULL),
(138, NULL, 'SHELLYKHA DHANYATULL RIZMA', 'BOYOLALI', 'Perempuan', '2009-10-13', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 173, '2026-07-06 06:24:26', '2026-09-03 13:42:47', NULL),
(139, NULL, 'SRI MULYANI', 'BOYOLALI', 'Perempuan', '2010-02-18', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 174, '2026-07-06 06:24:26', '2026-09-03 13:42:47', NULL),
(140, NULL, 'TALITHA LUTHFI', 'Boyolali', 'Perempuan', '2009-09-08', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 175, '2026-07-06 06:24:26', '2026-09-03 13:42:47', NULL),
(141, NULL, 'TRI NURROHMAN', 'Boyolali', 'Perempuan', '2010-03-12', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 176, '2026-07-06 06:24:26', '2026-09-03 13:42:47', NULL),
(142, NULL, 'ULFA LUTFIANA', 'BOYOLALI', 'Perempuan', '2009-05-14', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 177, '2026-07-06 06:24:27', '2026-09-03 13:42:47', NULL),
(143, NULL, 'WIWIK LIS RAHAYU', 'BOYOLALI', 'Perempuan', '2009-12-20', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 178, '2026-07-06 06:24:27', '2026-09-03 13:42:47', NULL),
(144, NULL, 'ZAHWA PUTRI CAHYA RIANTI', 'Boyolali', 'Perempuan', '2010-03-18', NULL, 'X 4', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 179, '2026-07-06 06:24:27', '2026-09-03 13:42:47', NULL),
(145, NULL, 'Agnia Chindy Feyrus Chalisa', 'Boyolali', 'Laki-laki', '2010-06-06', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 180, '2026-07-06 06:24:27', '2026-09-03 13:42:47', NULL),
(146, NULL, 'ALFIANO DHIKA PRATAMA', 'BOYOLALI', 'Laki-laki', '2010-01-04', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 181, '2026-07-06 06:24:28', '2026-09-03 13:42:47', NULL),
(147, NULL, 'ALISA NAMIRA IMANI', 'BOYOLALI', 'Laki-laki', '2010-02-18', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 182, '2026-07-06 06:24:28', '2026-09-03 13:42:47', NULL),
(148, NULL, 'ANDI YONO', 'BOYOLALI', 'Laki-laki', '2009-10-27', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 183, '2026-07-06 06:24:28', '2026-09-03 13:42:47', NULL),
(149, NULL, 'Ariqa Sally Aswangga', 'Boyolali', 'Laki-laki', '2010-03-25', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 184, '2026-07-06 06:24:28', '2026-09-03 13:42:47', NULL),
(150, NULL, 'AULIYA ZAHRATUL SIVA', 'BOYOLALI', 'Laki-laki', '2009-06-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 185, '2026-07-06 06:24:29', '2026-09-03 13:42:47', NULL),
(151, NULL, 'CHOIRUL ADNAN', 'BOYOLALI', 'Laki-laki', '2009-08-03', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 186, '2026-07-06 06:24:29', '2026-09-03 13:42:47', NULL),
(152, NULL, 'DANIS NURIL FAHMA', 'Boyolali', 'Laki-laki', '2009-08-15', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 187, '2026-07-06 06:24:29', '2026-09-03 13:42:47', NULL),
(153, NULL, 'DWI EVA ARIYANI', 'BOYOLALI', 'Laki-laki', '2010-03-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 188, '2026-07-06 06:24:29', '2026-09-03 13:42:47', NULL),
(154, NULL, 'DWI INDRIANA', 'BOYOLALI', 'Laki-laki', '2010-02-01', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 189, '2026-07-06 06:24:29', '2026-09-03 13:42:47', NULL),
(155, NULL, 'ERDITA WAHYU FEBRIYANTI', 'BOYOLALI', 'Laki-laki', '2010-02-24', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 190, '2026-07-06 06:24:30', '2026-09-03 13:42:47', NULL),
(156, NULL, 'FERA YUNIARTI', 'BOYOLALI', 'Laki-laki', '2010-06-30', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 191, '2026-07-06 06:24:30', '2026-09-03 13:42:47', NULL),
(157, NULL, 'FERI ARDIYANTO', 'BOYOLALI', 'Laki-laki', '2009-08-05', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 192, '2026-07-06 06:24:30', '2026-09-03 13:42:47', NULL),
(158, NULL, 'HANIK IKA MUSLIKHAH', 'BOYOLALI', 'Laki-laki', '2010-03-17', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 193, '2026-07-06 06:24:30', '2026-09-03 13:42:47', NULL),
(159, NULL, 'IQBAL AL GHIFFAARI', 'Jakarta', 'Laki-laki', '2009-07-21', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 194, '2026-07-06 06:24:31', '2026-09-03 13:42:47', NULL),
(160, NULL, 'Joko Prasetiyo', 'Boyolali', 'Laki-laki', '2010-03-19', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 195, '2026-07-06 06:24:31', '2026-09-03 13:42:47', NULL),
(161, NULL, 'KEYZA JAZTYIN AYU DIA PRATIWI', 'PONOROGO', 'Laki-laki', '2009-06-09', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 196, '2026-07-06 06:24:31', '2026-09-03 13:42:47', NULL),
(162, NULL, 'KUNTI DWI YULIANTI', 'Boyolali', 'Perempuan', '2009-06-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 197, '2026-07-06 06:24:32', '2026-09-03 13:42:47', NULL),
(163, NULL, 'MUHAMAD AKHYAR AFRILIAN', 'JAKARTA', 'Perempuan', '2010-04-04', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 198, '2026-07-06 06:24:32', '2026-09-03 13:42:47', NULL),
(164, NULL, 'MUHAMMAD IRGI FAHREZI', 'BOYOLALI', 'Perempuan', '2010-03-25', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 199, '2026-07-06 06:24:32', '2026-09-03 13:42:47', NULL),
(165, NULL, 'NASRIFA YUMNA HAQILA', 'Boyolali', 'Perempuan', '2009-08-24', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 200, '2026-07-06 06:24:32', '2026-09-03 13:42:47', NULL),
(166, NULL, 'NISAUL AULIA', 'BOYOLALI', 'Perempuan', '2009-05-21', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 201, '2026-07-06 06:24:32', '2026-09-03 13:42:47', NULL),
(167, NULL, 'NOVAN DWI ANDIKA', 'BOYOLALI', 'Perempuan', '2008-11-12', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 202, '2026-07-06 06:24:33', '2026-09-03 13:42:47', NULL),
(168, NULL, 'OLIFFIA YULIANA', 'Boyolali', 'Perempuan', '2010-07-15', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 203, '2026-07-06 06:24:33', '2026-09-03 13:42:47', NULL),
(169, NULL, 'RATNA KEISHA SALSABILA', 'BOYOLALI', 'Perempuan', '2010-06-13', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 204, '2026-07-06 06:24:33', '2026-09-03 13:42:47', NULL),
(170, NULL, 'RIDHO LEONEL ADITYA', 'BOYOLALI', 'Perempuan', '2009-05-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 205, '2026-07-06 06:24:33', '2026-09-03 13:42:47', NULL),
(171, NULL, 'RIRIT BHARATA NINGTYAS', 'Boyolali', 'Perempuan', '2009-11-01', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 206, '2026-07-06 06:24:34', '2026-09-03 13:42:47', NULL),
(172, NULL, 'SASKIA ZAHRA AMANDA', 'BOYOLALI', 'Perempuan', '2009-03-27', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 207, '2026-07-06 06:24:34', '2026-09-03 13:42:47', NULL),
(173, NULL, 'SITI OKTAVIANI', 'BOYOLALI', 'Perempuan', '2009-10-29', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 208, '2026-07-06 06:24:34', '2026-09-03 13:42:47', NULL),
(174, NULL, 'SLAMET TRIYANTO', 'BOYOLALI', 'Perempuan', '2009-06-28', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 209, '2026-07-06 06:24:35', '2026-09-03 13:42:47', NULL),
(175, NULL, 'SRI MURNI', 'BOYOLALI', 'Perempuan', '2009-08-11', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 210, '2026-07-06 06:24:35', '2026-09-03 13:42:47', NULL),
(176, NULL, 'TIKA AULIA', 'Boyolali', 'Perempuan', '2009-06-25', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 211, '2026-07-06 06:24:35', '2026-09-03 13:42:47', NULL),
(177, NULL, 'USWATUN KHASANAH', 'Boyolali', 'Perempuan', '2009-12-03', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 212, '2026-07-06 06:24:35', '2026-09-03 13:42:47', NULL),
(178, NULL, 'Wahyu Tri Mulyanto', 'Boyolali', 'Perempuan', '2009-09-05', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 213, '2026-07-06 06:24:35', '2026-09-03 13:42:47', NULL),
(179, NULL, 'WULAN AGUSTIN', 'BOYOLALI', 'Perempuan', '2009-08-08', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 214, '2026-07-06 06:24:36', '2026-09-03 13:42:47', NULL),
(180, NULL, 'ZULFA ISNAINISA', 'BOYOLALI', 'Perempuan', '2010-05-21', NULL, 'X 5', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 215, '2026-07-06 06:24:36', '2026-09-03 13:42:47', NULL),
(181, NULL, 'AIDA SYAHIRA', 'Boyolali', 'Laki-laki', '2010-12-23', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 216, '2026-07-06 06:24:36', '2026-09-03 13:42:48', NULL),
(182, NULL, 'ALFIN IRGIYANSAH', 'BOYOLALI', 'Laki-laki', '2009-07-19', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 217, '2026-07-06 06:24:36', '2026-09-03 13:42:48', NULL),
(183, NULL, 'ALMIRA IKSANIA PUTRI', 'SURAKARTA', 'Laki-laki', '2009-11-16', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 218, '2026-07-06 06:24:37', '2026-09-03 13:42:48', NULL),
(184, NULL, 'ANDIKA PRATAMA', 'Boyolali', 'Laki-laki', '2010-04-17', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 219, '2026-07-06 06:24:37', '2026-09-03 13:42:48', NULL),
(185, NULL, 'ARLINA TARA MAHENDRA', 'BOYOLALI', 'Laki-laki', '2010-03-21', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 220, '2026-07-06 06:24:37', '2026-09-03 13:42:48', NULL),
(186, NULL, 'AURA PUTRI KUSTIA WAL SOLEKHAH', 'BOYOLALI', 'Laki-laki', '2009-01-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 221, '2026-07-06 06:24:38', '2026-09-03 13:42:48', NULL),
(187, NULL, 'CHOIRUL UMAM', 'Boyolali', 'Laki-laki', '2010-06-03', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 222, '2026-07-06 06:24:38', '2026-09-03 13:42:48', NULL),
(188, NULL, 'DESWITA DWI MAY RANI', 'BOYOLALI', 'Laki-laki', '2009-12-20', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 223, '2026-07-06 06:24:38', '2026-09-03 13:42:48', NULL),
(189, NULL, 'Dwi Indriyani', 'Boyolali', 'Laki-laki', '2009-06-15', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 224, '2026-07-06 06:24:38', '2026-09-03 13:42:48', NULL),
(190, NULL, 'Dwi Wicaksono', 'Boyolali', 'Laki-laki', '2009-03-16', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 225, '2026-07-06 06:24:39', '2026-09-03 13:42:48', NULL),
(191, NULL, 'ESHA SULISTIYANI', 'BOYOLALI', 'Laki-laki', '2009-11-25', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 226, '2026-07-06 06:24:39', '2026-09-03 13:42:48', NULL),
(192, NULL, 'FILIO KENZIE HAFEEZY', 'BOYOLALI', 'Laki-laki', '2009-09-24', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 227, '2026-07-06 06:24:39', '2026-09-03 13:42:48', NULL),
(193, NULL, 'FITRI SHOLIKHAH', 'BOYOLALI', 'Laki-laki', '2009-11-27', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 228, '2026-07-06 06:24:39', '2026-09-03 13:42:48', NULL),
(194, NULL, 'Ika Wahyuningsih', 'Boyolali', 'Laki-laki', '2010-02-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 229, '2026-07-06 06:24:39', '2026-09-03 13:42:48', NULL),
(195, NULL, 'IRFAN AHMAD', 'Boyolali', 'Laki-laki', '2009-12-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 230, '2026-07-06 06:24:40', '2026-09-03 13:42:48', NULL),
(196, NULL, 'Khailla Adelia Marsya', 'Boyolali', 'Laki-laki', '2009-05-30', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 231, '2026-07-06 06:24:40', '2026-09-03 13:42:48', NULL),
(197, NULL, 'KHARIZ IRFAN HAKIM', 'Boyolali', 'Laki-laki', '2010-07-23', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 232, '2026-07-06 06:24:40', '2026-09-03 13:42:48', NULL),
(198, NULL, 'LAUDYA DEVINA ANASTASYA', 'BOYOLALI', 'Laki-laki', '2010-05-21', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 233, '2026-07-06 06:24:40', '2026-09-03 13:42:48', NULL),
(199, NULL, 'MUHAMAD DINO WARDANA', 'BOYOLALI', 'Laki-laki', '2010-05-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 234, '2026-07-06 06:24:41', '2026-09-03 13:42:48', NULL),
(200, NULL, 'MUHAMMAD RAFFA AL FADHIL', 'BOYOLALI', 'Laki-laki', '2009-01-18', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 235, '2026-07-06 06:24:41', '2026-09-03 13:42:48', NULL),
(201, NULL, 'NATASYA NOVITA PUTRI', 'Boyolali', 'Perempuan', '2010-05-13', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 236, '2026-07-06 06:24:41', '2026-09-03 13:42:48', NULL),
(202, NULL, 'NIYA SELA PASHA ARDHILA', 'KARANGANYAR', 'Perempuan', '2009-11-19', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 237, '2026-07-06 06:24:42', '2026-09-03 13:42:48', NULL),
(203, NULL, 'NOVIYANTO FARLY IRAWAN', 'JAKARTA', 'Perempuan', '2009-11-23', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 238, '2026-07-06 06:24:42', '2026-09-03 13:42:48', NULL),
(204, NULL, 'Olivia Ayyatul Khusna', 'Boyolali', 'Perempuan', '2010-08-15', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 239, '2026-07-06 06:24:42', '2026-09-03 13:42:48', NULL),
(205, NULL, 'RAUDHYA ZAHRA RASYIDAH', 'BOYOLALI', 'Perempuan', '2009-11-21', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 240, '2026-07-06 06:24:42', '2026-09-03 13:42:48', NULL),
(206, NULL, 'RIO IRAWAN', 'BOYOLALI', 'Perempuan', '2010-08-12', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 241, '2026-07-06 06:24:43', '2026-09-03 13:42:48', NULL),
(207, NULL, 'RISKA WAHYU SEPTIYANI', 'BOYOLALI', 'Perempuan', '2010-09-24', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 242, '2026-07-06 06:24:43', '2026-09-03 13:42:48', NULL),
(208, NULL, 'Sasya Eka Septiyasa', 'Klaten', 'Perempuan', '2010-09-27', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 243, '2026-07-06 06:24:43', '2026-09-03 13:42:48', NULL),
(209, NULL, 'SITI PRIHATIN', 'Boyolali', 'Perempuan', '2010-07-17', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 244, '2026-07-06 06:24:43', '2026-09-03 13:42:48', NULL),
(210, NULL, 'SRI RAHAYU', 'Boyolali', 'Perempuan', '2009-09-27', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 245, '2026-07-06 06:24:44', '2026-09-03 13:42:48', NULL),
(211, NULL, 'SURYA ADISTI PUTRA', 'Boyolali', 'Perempuan', '2009-10-20', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 246, '2026-07-06 06:24:44', '2026-09-03 13:42:48', NULL),
(212, NULL, 'TRI HARTANTI', 'Boyolali', 'Perempuan', '2010-05-13', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 247, '2026-07-06 06:24:44', '2026-09-03 13:42:48', NULL),
(213, NULL, 'WAHYU FARAH AULIA', 'Boyolali', 'Perempuan', '2010-07-13', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 248, '2026-07-06 06:24:44', '2026-09-03 13:42:48', NULL),
(214, NULL, 'YAKA HUTAMA', 'Boyolali', 'Perempuan', '2009-11-14', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 249, '2026-07-06 06:24:45', '2026-09-03 13:42:48', NULL),
(215, NULL, 'YAMANDA TIYASTUTI', 'BOYOLALI', 'Perempuan', '2009-08-10', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 250, '2026-07-06 06:24:45', '2026-09-03 13:42:48', NULL),
(216, NULL, 'ZULFA NUR AZIZAH', 'BOYOLALI', 'Perempuan', '2010-01-09', NULL, 'X 6', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 251, '2026-07-06 06:24:45', '2026-09-03 13:42:48', NULL),
(217, NULL, 'ADITIA SAPUTRA', 'BOYOLALI', 'Laki-laki', '2009-07-18', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 252, '2026-07-06 06:24:45', '2026-09-03 13:42:48', NULL),
(218, NULL, 'AISYAH PUTRI AZZAHRA', 'BOYOLALI', 'Laki-laki', '2010-12-12', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 253, '2026-07-06 06:24:46', '2026-09-03 13:42:48', NULL),
(219, NULL, 'ALI ZAINAL ABIDIN', 'BOYOLALI', 'Laki-laki', '2009-12-14', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 254, '2026-07-06 06:24:46', '2026-09-03 13:42:48', NULL),
(220, NULL, 'ALYARISMA DEVINA ANGGRAENI', 'BOYOLALI', 'Laki-laki', '2009-12-04', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 255, '2026-07-06 06:24:46', '2026-09-03 13:42:48', NULL),
(221, NULL, 'ARDIAN BINTANG PRAMUDITA', 'BOYOLALI', 'Laki-laki', '2009-10-19', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 256, '2026-07-06 06:24:47', '2026-09-03 13:42:48', NULL),
(222, NULL, 'ARYA SAFITRI', 'BOYOLALI', 'Laki-laki', '2009-01-17', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 257, '2026-07-06 06:24:47', '2026-09-03 13:42:48', NULL),
(223, NULL, 'BERLINA PURNAMA NUGRAHANI', 'BOYOLALI', 'Laki-laki', '2010-06-03', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 258, '2026-07-06 06:24:47', '2026-09-03 13:42:48', NULL),
(224, NULL, 'DEDY NOVANDI', 'BOYOLALI', 'Laki-laki', '2009-11-06', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 259, '2026-07-06 06:24:47', '2026-09-03 13:42:48', NULL),
(225, NULL, 'DEVIANA BELLA SASKIA', 'BOYOLALI', 'Laki-laki', '2010-05-05', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 260, '2026-07-06 06:24:48', '2026-09-03 13:42:48', NULL),
(226, NULL, 'ECKA RIDO SETYONO', 'BOYOLALI', 'Laki-laki', '2010-04-24', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 261, '2026-07-06 06:24:48', '2026-09-03 13:42:48', NULL),
(227, NULL, 'EDRIA THEDA MUFARIHAH', 'Boyolali', 'Laki-laki', '2010-01-25', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 262, '2026-07-06 06:24:48', '2026-09-03 13:42:48', NULL),
(228, NULL, 'EVA APRILIA SAFITRI', 'BOYOLALI', 'Laki-laki', '2010-04-01', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 263, '2026-07-06 06:24:48', '2026-09-03 13:42:48', NULL),
(229, NULL, 'FRISKA YOGI WAHYUNINGTYAS', 'BOYOLALI', 'Laki-laki', '2008-08-19', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 264, '2026-07-06 06:24:49', '2026-09-03 13:42:48', NULL),
(230, NULL, 'GABRILIA MUTIARA SARI', 'Boyolali', 'Laki-laki', '2008-04-28', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 265, '2026-07-06 06:24:49', '2026-09-03 13:42:48', NULL),
(231, NULL, 'IKHDA ANNISA RAHMAH', 'BOYOLALI', 'Laki-laki', '2010-10-09', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 266, '2026-07-06 06:24:49', '2026-09-03 13:42:48', NULL),
(232, NULL, 'IRFAN DWI SETIAWAN', 'BOYOLALI', 'Laki-laki', '2010-08-26', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 267, '2026-07-06 06:24:49', '2026-09-03 13:42:48', NULL),
(233, NULL, 'KHAIRUNISA AZAHRA RAMADANI', 'BEKASI', 'Laki-laki', '2010-08-21', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 268, '2026-07-06 06:24:50', '2026-09-03 13:42:48', NULL),
(234, NULL, 'KURNIAWAN SIDIK BAYU PRAKOSO', 'JAKARTA', 'Laki-laki', '2010-03-11', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 269, '2026-07-06 06:24:50', '2026-09-03 13:42:48', NULL),
(235, NULL, 'LILIK SRI LESTARI', 'BOYOLALI', 'Laki-laki', '2009-07-02', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 270, '2026-07-06 06:24:50', '2026-09-03 13:42:48', NULL),
(236, NULL, 'Muhammad Affandi Arsyad Yuono Putra', 'Boyolali', 'Laki-laki', '2010-04-10', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 271, '2026-07-06 06:24:50', '2026-09-03 13:42:48', NULL),
(237, NULL, 'MUHAMMAD RIZAL ALYAZID', 'BOYOLALI', 'Laki-laki', '2010-01-06', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 272, '2026-07-06 06:24:51', '2026-09-03 13:42:48', NULL),
(238, NULL, 'Natasya Yunika Putri', 'B OYOLALI', 'Perempuan', '2010-06-15', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 273, '2026-07-06 06:24:51', '2026-09-03 13:42:48', NULL),
(239, NULL, 'NOVI KURNIASARI', 'Boyolali', 'Perempuan', '2009-10-30', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 274, '2026-07-06 06:24:51', '2026-09-03 13:42:48', NULL),
(240, NULL, 'NUR FAISAL', 'BOYOLALI', 'Perempuan', '2009-10-03', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 275, '2026-07-06 06:24:51', '2026-09-03 13:42:48', NULL),
(241, NULL, 'PIPIT SRI HANDAYANI', 'BOYOLALI', 'Perempuan', '2010-03-23', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 276, '2026-07-06 06:24:52', '2026-09-03 13:42:48', NULL),
(242, NULL, 'RAYKHANUN NOVA REZQIANI', 'BOYOLALI', 'Perempuan', '2009-11-30', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 277, '2026-07-06 06:24:52', '2026-09-03 13:42:48', NULL),
(243, NULL, 'RISKY FADILAH', 'BOYOLALI', 'Perempuan', '2010-01-15', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 278, '2026-07-06 06:24:52', '2026-09-03 13:42:48', NULL),
(244, NULL, 'ROICHAN AHMAD ARROYANI', 'Boyolali', 'Perempuan', '2010-02-18', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 279, '2026-07-06 06:24:52', '2026-09-03 13:42:48', NULL),
(245, NULL, 'SAVA LESTARI', 'BOYOLALI', 'Perempuan', '2010-01-20', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 280, '2026-07-06 06:24:53', '2026-09-03 13:42:48', NULL),
(246, NULL, 'SITI ROHANA', 'BOYOLALI', 'Perempuan', '2010-02-22', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 281, '2026-07-06 06:24:53', '2026-09-03 13:42:48', NULL),
(247, NULL, 'STIYA WATIK', 'BOYOLALI', 'Perempuan', '2009-07-23', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 282, '2026-07-06 06:24:53', '2026-09-03 13:42:48', NULL),
(248, NULL, 'SYARIF HIDAYATULLAH', 'BOYOLALI', 'Perempuan', '2010-01-23', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 283, '2026-07-06 06:24:53', '2026-09-03 13:42:48', NULL),
(249, NULL, 'TRI LISTIYANINGSIH', 'BOYOLALI', 'Perempuan', '2010-03-11', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 284, '2026-07-06 06:24:54', '2026-09-03 13:42:48', NULL),
(250, NULL, 'WAHYU KHAMIDHATU ZUHRIYA', 'BOYOLALI', 'Perempuan', '2010-07-17', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 285, '2026-07-06 06:24:54', '2026-09-03 13:42:48', NULL),
(251, NULL, 'YOGA KURNIYAWAN', 'BOYOLALI', 'Perempuan', '2009-09-10', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 286, '2026-07-06 06:24:54', '2026-09-03 13:42:48', NULL),
(252, NULL, 'YULMIA KIRANI AZIZAH', 'BOYOLALI', 'Perempuan', '2009-08-21', NULL, 'X 7', NULL, NULL, NULL, NULL, 'aktif', NULL, NULL, 287, '2026-07-06 06:24:54', '2026-09-03 13:42:48', NULL),
(253, NULL, 'Abdul Hafizh Mardiyanto', 'Boyolali', 'Laki-laki', '2009-05-17', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 288, '2026-07-06 06:24:55', '2026-09-03 13:42:48', NULL),
(254, NULL, 'ADITYA PRADANA FIKI ARDIANSYAH', 'Boyolali', 'Laki-laki', '2009-08-25', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 289, '2026-07-06 06:24:55', '2026-09-03 13:42:48', NULL),
(255, NULL, 'AGENG BUDI HARJO', 'BOYOLALI', 'Laki-laki', '2008-11-08', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 290, '2026-07-06 06:24:55', '2026-09-03 13:42:48', NULL),
(256, NULL, 'AHMAD ZAENURI', 'Boyolali', 'Laki-laki', '2008-12-01', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 291, '2026-07-06 06:24:55', '2026-09-03 13:42:48', NULL),
(257, NULL, 'ALLEA SASTRA ALMA FAISHA', 'Boyolali', 'Laki-laki', '2009-02-01', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 292, '2026-07-06 06:24:56', '2026-09-03 13:42:48', NULL),
(258, NULL, 'Angga Setiawan', 'Boyolali', 'Laki-laki', '2009-05-25', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 293, '2026-07-06 06:24:56', '2026-09-03 13:42:48', NULL),
(259, NULL, 'ARES WIDODO', 'Boyolali', 'Laki-laki', '2009-09-04', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 294, '2026-07-06 06:24:56', '2026-09-03 13:42:48', NULL),
(260, NULL, 'DANANG SULISTYO', 'BOYOLALI', 'Laki-laki', '2008-11-01', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 295, '2026-07-06 06:24:56', '2026-09-03 13:42:48', NULL),
(261, NULL, 'DIMAS RAIKHAN DEWANTORO', 'BOYOLALI', 'Laki-laki', '2008-05-02', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 296, '2026-07-06 06:24:57', '2026-09-03 13:42:48', NULL),
(262, NULL, 'DZAKY RAIHAN PUTRA PRATHAMA', 'BOYOLALI', 'Laki-laki', '2009-03-05', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 297, '2026-07-06 06:24:57', '2026-09-03 13:42:48', NULL),
(263, NULL, 'FARHAN WIRA ARDIAN MAULANA', 'BOYOLALI', 'Laki-laki', '2009-03-12', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 298, '2026-07-06 06:24:57', '2026-09-03 13:42:48', NULL),
(264, NULL, 'GALIH REHANANTO', 'Boyolali', 'Laki-laki', '2008-12-18', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 299, '2026-07-06 06:24:57', '2026-09-03 13:42:48', NULL),
(265, NULL, 'HABIBUR RAHMAN', 'BOYOLALI', 'Laki-laki', '2008-06-26', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 300, '2026-07-06 06:24:58', '2026-09-03 13:42:48', NULL);
INSERT INTO `siswa` (`id`, `nis`, `nama`, `tempat_lahir`, `jenis_kelamin`, `tanggal_lahir`, `entry_year`, `kelas`, `nama_ortu`, `no_hp_ortu`, `alamat`, `photo`, `status`, `tahun_lulus`, `acc_batch_id`, `pengguna_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(266, NULL, 'Ilham Taukhid Mustakim', 'Boyolali', 'Laki-laki', '2009-05-02', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 301, '2026-07-06 06:24:58', '2026-09-03 13:42:48', NULL),
(267, NULL, 'Ivan Galih Maulana', 'Boyolali', 'Laki-laki', '2009-03-25', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 302, '2026-07-06 06:24:58', '2026-09-03 13:42:48', NULL),
(268, NULL, 'Jesika Rahma Maulana', 'Boyolali', 'Laki-laki', '2009-08-24', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 303, '2026-07-06 06:24:58', '2026-09-03 13:42:48', NULL),
(269, NULL, 'JOICE IVANIA', 'BOYOLALI', 'Laki-laki', '2008-07-22', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 304, '2026-07-06 06:24:59', '2026-09-03 13:42:48', NULL),
(270, NULL, 'KHALILA ESTA PUTRI', 'BOYOLALI', 'Laki-laki', '2009-08-06', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 305, '2026-07-06 06:24:59', '2026-09-03 13:42:48', NULL),
(271, NULL, 'LATIFA AZZARA', 'BOYOLALI', 'Laki-laki', '2008-08-21', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 306, '2026-07-06 06:24:59', '2026-09-03 13:42:48', NULL),
(272, NULL, 'Listianingsih', 'Boyolali', 'Laki-laki', '2008-12-05', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 307, '2026-07-06 06:24:59', '2026-09-03 13:42:48', NULL),
(273, NULL, 'MOHAMAD YOGA PRATAMA', 'BOYOLALI', 'Laki-laki', '2009-06-29', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 308, '2026-07-06 06:24:59', '2026-09-03 13:42:48', NULL),
(274, NULL, 'MUGHNI LAFIF AL LATIEF', 'BOYOLALI', 'Laki-laki', '2008-12-20', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 309, '2026-07-06 06:25:00', '2026-09-03 13:42:48', NULL),
(275, NULL, 'MUHYI ASRORI FUADY', 'Boyolali', 'Laki-laki', '2009-01-28', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 310, '2026-07-06 06:25:00', '2026-09-03 13:42:48', NULL),
(276, NULL, 'NASYWA NATHANIA JASMINE', 'BOYOLALI', 'Laki-laki', '2009-05-03', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 311, '2026-07-06 06:25:00', '2026-09-03 13:42:48', NULL),
(277, NULL, 'NAZARI ADI LESMANA', 'BOYOLALI', 'Laki-laki', '2008-08-16', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 312, '2026-07-06 06:25:01', '2026-09-03 13:42:48', NULL),
(278, NULL, 'Nofa Setiadi', 'Madiun', 'Laki-laki', '2008-11-24', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 313, '2026-07-06 06:25:01', '2026-09-03 13:42:48', NULL),
(279, NULL, 'Novita Anisa Putri', 'Boyolali', 'Laki-laki', '2008-11-22', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 314, '2026-07-06 06:25:01', '2026-09-03 13:42:48', NULL),
(280, NULL, 'Pipiet Nastiti Wulan', 'Klaten', 'Laki-laki', '2009-03-10', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 315, '2026-07-06 06:25:01', '2026-09-03 13:42:48', NULL),
(281, NULL, 'RAFA PUTRA PURWANA', 'Boyolali', 'Laki-laki', '2008-11-28', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 316, '2026-07-06 06:25:02', '2026-09-03 13:42:48', NULL),
(282, NULL, 'RAFID AFFANDI', 'BOYOLALI', 'Laki-laki', '2008-10-14', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 317, '2026-07-06 06:25:02', '2026-09-03 13:42:48', NULL),
(283, NULL, 'RAHARJA GALIH CANDRANANTA', 'BOYOLALI', 'Laki-laki', '2008-11-26', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 318, '2026-07-06 06:25:02', '2026-09-03 13:42:48', NULL),
(284, NULL, 'RIBANG RAIF RABANI', 'BOYOLALI', 'Laki-laki', '2009-07-27', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 319, '2026-07-06 06:25:03', '2026-09-03 13:42:48', NULL),
(285, NULL, 'SATYA NUGROHO', 'BOGOR', 'Laki-laki', '2009-02-16', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 320, '2026-07-06 06:25:03', '2026-09-03 13:42:48', NULL),
(286, NULL, 'SRI WAHYU RAHMADANI', 'BOYOLALI', 'Laki-laki', '2008-09-06', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 321, '2026-07-06 06:25:03', '2026-09-03 13:42:48', NULL),
(287, NULL, 'SUCI MAHARDIKA', 'BOYOLALI', 'Laki-laki', '2008-08-17', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 322, '2026-07-06 06:25:03', '2026-09-03 13:42:48', NULL),
(288, NULL, 'YANTI IDA LESTARI', 'BOYOLALI', 'Laki-laki', '2008-07-09', NULL, 'XI F 1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 323, '2026-07-06 06:25:04', '2026-09-03 13:42:48', NULL),
(289, NULL, 'Ambar Dwi Andhini', 'Cilacap', 'Laki-laki', '2009-01-14', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 324, '2026-07-06 06:25:04', '2026-09-03 13:42:48', NULL),
(290, NULL, 'AMELIA PUSPITA SARI', 'Air Naningan', 'Laki-laki', '2008-12-26', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 325, '2026-07-06 06:25:04', '2026-09-03 13:42:48', NULL),
(291, NULL, 'ANIS CAHYATI', 'Boyolali', 'Laki-laki', '2009-04-12', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 326, '2026-07-06 06:25:04', '2026-09-03 13:42:48', NULL),
(292, NULL, 'Aqilla Khairunnisa', 'Boyolali', 'Laki-laki', '2008-11-08', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 327, '2026-07-06 06:25:05', '2026-09-03 13:42:48', NULL),
(293, NULL, 'ARYA BIMA SAPUTRA', 'BOYOLALI', 'Laki-laki', '2008-10-28', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 328, '2026-07-06 06:25:05', '2026-09-03 13:42:48', NULL),
(294, NULL, 'Azahra Azizatul Febriyana', 'Bekasi', 'Laki-laki', '2009-02-20', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 329, '2026-07-06 06:25:05', '2026-09-03 13:42:48', NULL),
(295, NULL, 'Denil Nur Faizin', 'Boyolali', 'Laki-laki', '2009-02-21', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 330, '2026-07-06 06:25:05', '2026-09-03 13:42:48', NULL),
(296, NULL, 'DESTA AYU ARISTA', 'BOYOLALI', 'Laki-laki', '2007-09-30', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 331, '2026-07-06 06:25:06', '2026-09-03 13:42:48', NULL),
(297, NULL, 'DIAH AYU SILVIANA', 'BOYOLALI', 'Laki-laki', '2009-01-02', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 332, '2026-07-06 06:25:06', '2026-09-03 13:42:48', NULL),
(298, NULL, 'DINDA DARA KUSUMA', 'Boyolali', 'Laki-laki', '2009-07-25', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 333, '2026-07-06 06:25:06', '2026-09-03 13:42:48', NULL),
(299, NULL, 'DINI ASTUTI', 'BOYOLALI', 'Laki-laki', '2008-08-28', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 334, '2026-07-06 06:25:06', '2026-09-03 13:42:48', NULL),
(300, NULL, 'EKA AYU LESTARI', 'BOYOLALI', 'Laki-laki', '2009-03-18', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 335, '2026-07-06 06:25:07', '2026-09-03 13:42:48', NULL),
(301, NULL, 'EKA SEPTIANINGSIH', 'BOYOLALI', 'Laki-laki', '2008-09-05', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 336, '2026-07-06 06:25:07', '2026-09-03 13:42:48', NULL),
(302, NULL, 'ERISDA ANUNG WIDAYANI', 'BOYOLALI', 'Laki-laki', '2008-10-30', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 337, '2026-07-06 06:25:07', '2026-09-03 13:42:48', NULL),
(303, NULL, 'IKA WULANDARI', 'Boyolali', 'Laki-laki', '2009-03-18', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 338, '2026-07-06 06:25:07', '2026-09-03 13:42:48', NULL),
(304, NULL, 'ILI YINNA SUFI AL-HAQ', 'JAKARTA', 'Laki-laki', '2009-10-01', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 339, '2026-07-06 06:25:07', '2026-09-03 13:42:48', NULL),
(305, NULL, 'IMAM ABDUL AZIS', 'BOYOLALI', 'Laki-laki', '2009-04-10', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 340, '2026-07-06 06:25:08', '2026-09-03 13:42:48', NULL),
(306, NULL, 'JESIKA NOVITA RAHMAWATI', 'BOYOLALI', 'Laki-laki', '2008-11-20', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 341, '2026-07-06 06:25:08', '2026-09-03 13:42:48', NULL),
(307, NULL, 'KAILA YULI YATI', 'BOYOLALI', 'Laki-laki', '2009-07-05', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 342, '2026-07-06 06:25:08', '2026-09-03 13:42:48', NULL),
(308, NULL, 'KHARISA SUCI LESTARI', 'Boyolali', 'Laki-laki', '2009-03-14', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 343, '2026-07-06 06:25:08', '2026-09-03 13:42:48', NULL),
(309, NULL, 'LUXVI ISTIANA ANNISA', 'BOYOLALI', 'Laki-laki', '2009-06-07', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 344, '2026-07-06 06:25:09', '2026-09-03 13:42:48', NULL),
(310, NULL, 'META UTAMI', 'Boyolali', 'Laki-laki', '2009-06-17', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 345, '2026-07-06 06:25:09', '2026-09-03 13:42:48', NULL),
(311, NULL, 'MUTIA FIRDASARI', 'BOYOLALI', 'Laki-laki', '2008-12-29', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 346, '2026-07-06 06:25:09', '2026-09-03 13:42:48', NULL),
(312, NULL, 'NITA FITRIYANI', 'BOYOLALI', 'Laki-laki', '2009-10-01', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 347, '2026-07-06 06:25:09', '2026-09-03 13:42:48', NULL),
(313, NULL, 'NOVALIA SAFITRI', 'BOYOLALI', 'Laki-laki', '2009-11-28', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 348, '2026-07-06 06:25:10', '2026-09-03 13:42:48', NULL),
(314, NULL, 'NOVITA ARUM SARI', 'BOYOLALI', 'Laki-laki', '2008-11-04', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 349, '2026-07-06 06:25:10', '2026-09-03 13:42:48', NULL),
(315, NULL, 'Rezky Heru Nitha', 'AMBON', 'Laki-laki', '2009-10-03', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 350, '2026-07-06 06:25:10', '2026-09-03 13:42:48', NULL),
(316, NULL, 'RIZKY AMELIYA', 'BOYOLALI', 'Laki-laki', '2008-10-21', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 351, '2026-07-06 06:25:10', '2026-09-03 13:42:48', NULL),
(317, NULL, 'SALSABILAH AGUSTINA', 'KAB. SEMARANG', 'Laki-laki', '2008-08-17', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 352, '2026-07-06 06:25:11', '2026-09-03 13:42:48', NULL),
(318, NULL, 'SRI BELA NOFITA', 'Boyolali', 'Laki-laki', '2008-11-29', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 353, '2026-07-06 06:25:11', '2026-09-03 13:42:48', NULL),
(319, NULL, 'SYARIFA QUMAIRAH RAMADHANI', 'BOYOLALI', 'Laki-laki', '2008-09-18', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 354, '2026-07-06 06:25:11', '2026-09-03 13:42:48', NULL),
(320, NULL, 'TESALONIKA SHARON', 'BOYOLALI', 'Laki-laki', '2008-05-05', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 355, '2026-07-06 06:25:11', '2026-09-03 13:42:48', NULL),
(321, NULL, 'TRI APRILLIA MARDANI', 'BOYOLALI', 'Laki-laki', '2009-04-15', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 356, '2026-07-06 06:25:12', '2026-09-03 13:42:48', NULL),
(322, NULL, 'VITA RISTIANTI', 'BOYOLALI', 'Laki-laki', '2008-12-26', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 357, '2026-07-06 06:25:12', '2026-09-03 13:42:48', NULL),
(323, NULL, 'YULIANA WARISMA', 'BOYOLALI', 'Laki-laki', '2009-11-04', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 358, '2026-07-06 06:25:12', '2026-09-03 13:42:48', NULL),
(324, NULL, 'ZALFA\' AULIA NAJAH', 'BOYOLALI', 'Laki-laki', '2008-06-18', NULL, 'XI F 2.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 359, '2026-07-06 06:25:12', '2026-09-03 13:42:48', NULL),
(325, NULL, 'AIDINA FITRANI WULANDARI', 'BOYOLALI', 'Laki-laki', '2008-10-27', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 360, '2026-07-06 06:25:13', '2026-09-03 13:42:48', NULL),
(326, NULL, 'AKHDAN GANTARI ATMAJA', 'BOYOLALI', 'Laki-laki', '2009-03-13', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 361, '2026-07-06 06:25:13', '2026-09-03 13:42:48', NULL),
(327, NULL, 'ALINEA TITIAN', 'Boyolali', 'Laki-laki', '2008-12-05', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 362, '2026-07-06 06:25:13', '2026-09-03 13:42:48', NULL),
(328, NULL, 'AMIRA ZAHWA AZIZAH', 'Bogor', 'Laki-laki', '2009-07-06', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 363, '2026-07-06 06:25:13', '2026-09-03 13:42:48', NULL),
(329, NULL, 'ANANDA PUTRI', 'Boyolali', 'Laki-laki', '2009-03-15', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 364, '2026-07-06 06:25:14', '2026-09-03 13:42:48', NULL),
(330, NULL, 'ARUM FEBRIANTI', 'Boyolali', 'Laki-laki', '2009-02-14', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 365, '2026-07-06 06:25:14', '2026-09-03 13:42:48', NULL),
(331, NULL, 'AYU MALINA FEBRIYA', 'Boyolali', 'Laki-laki', '2009-02-13', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 366, '2026-07-06 06:25:14', '2026-09-03 13:42:48', NULL),
(332, NULL, 'BAMBANG PRI HARTANTO', 'BOYOLALI', 'Laki-laki', '2008-05-20', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 367, '2026-07-06 06:25:14', '2026-09-03 13:42:48', NULL),
(333, NULL, 'EKA SITI AMINATUN', 'Boyolali', 'Laki-laki', '2009-03-25', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 368, '2026-07-06 06:25:15', '2026-09-03 13:42:48', NULL),
(334, NULL, 'ERIKA AULIA AMBARWATI', 'BOYOLALI', 'Laki-laki', '2009-01-28', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 369, '2026-07-06 06:25:15', '2026-09-03 13:42:48', NULL),
(335, NULL, 'Fajar Puryanti', 'Boyolali', 'Laki-laki', '2008-09-12', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 370, '2026-07-06 06:25:15', '2026-09-03 13:42:48', NULL),
(336, NULL, 'GIGIH BUDIYARTO', 'Boyolali', 'Laki-laki', '2008-07-18', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 371, '2026-07-06 06:25:15', '2026-09-03 13:42:48', NULL),
(337, NULL, 'HABIBAH ELFARIZQI', 'BOYOLALI', 'Laki-laki', '2008-12-16', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 372, '2026-07-06 06:25:16', '2026-09-03 13:42:48', NULL),
(338, NULL, 'HELNIDA RANNY TAKHEL', 'Boyolali', 'Laki-laki', '2008-08-28', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 373, '2026-07-06 06:25:16', '2026-09-03 13:42:48', NULL),
(339, NULL, 'IKA NOVIANI', 'Boyolali', 'Laki-laki', '2008-11-07', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 374, '2026-07-06 06:25:16', '2026-09-03 13:42:48', NULL),
(340, NULL, 'INTAN NURAINI', 'BOYOLALI', 'Laki-laki', '2009-04-14', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 375, '2026-07-06 06:25:16', '2026-09-03 13:42:48', NULL),
(341, NULL, 'Kholifah Alya Mufidah', 'Boyolali', 'Laki-laki', '2008-12-18', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 376, '2026-07-06 06:25:17', '2026-09-03 13:42:48', NULL),
(342, NULL, 'LINDA SURYANI', 'BOYOLALI', 'Laki-laki', '2009-01-06', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 377, '2026-07-06 06:25:17', '2026-09-03 13:42:48', NULL),
(343, NULL, 'MASAYU DIVA KHARISMA', 'BOYOLALI', 'Laki-laki', '2009-01-11', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 378, '2026-07-06 06:25:17', '2026-09-03 13:42:48', NULL),
(344, NULL, 'MAULIANA RAHMANING TYAS', 'Boyolali', 'Laki-laki', '2008-03-13', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 379, '2026-07-06 06:25:17', '2026-09-03 13:42:48', NULL),
(345, NULL, 'Melinda Nadine Saputri', 'Boyolali', 'Laki-laki', '2008-05-02', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 380, '2026-07-06 06:25:18', '2026-09-03 13:42:48', NULL),
(346, NULL, 'Menik Sugiyarti', 'Boyolali', 'Laki-laki', '2008-11-29', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 381, '2026-07-06 06:25:18', '2026-09-03 13:42:48', NULL),
(347, NULL, 'NADILA SYIFAURROHMAH', 'BOYOLALI', 'Laki-laki', '2008-06-20', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 382, '2026-07-06 06:25:18', '2026-09-03 13:42:48', NULL),
(348, NULL, 'NAURA YASMIN ZAAFARANI', 'Boyolali', 'Laki-laki', '2009-07-29', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 383, '2026-07-06 06:25:18', '2026-09-03 13:42:48', NULL),
(349, NULL, 'NUR ANGGA PRATAMA', 'BOYOLALI', 'Laki-laki', '2008-06-02', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 384, '2026-07-06 06:25:19', '2026-09-03 13:42:48', NULL),
(350, NULL, 'NUR RAMADHANA NABABAN', 'KLATEN', 'Laki-laki', '2008-09-24', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 385, '2026-07-06 06:25:19', '2026-09-03 13:42:48', NULL),
(351, NULL, 'NURUL EKA YULIANTI', 'BOYOLALI', 'Laki-laki', '2008-07-02', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 386, '2026-07-06 06:25:19', '2026-09-03 13:42:48', NULL),
(352, NULL, 'RAYA FITRIA OKTAFIANI', 'Boyolali', 'Laki-laki', '2009-10-03', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 387, '2026-07-06 06:25:19', '2026-09-03 13:42:48', NULL),
(353, NULL, 'REIVA STECY EKA LAURA', 'BOYOLALI', 'Laki-laki', '2008-08-14', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 388, '2026-07-06 06:25:20', '2026-09-03 13:42:48', NULL),
(354, NULL, 'SALSA AULIA PUTRI', 'BOYOLALI', 'Laki-laki', '2008-11-09', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 389, '2026-07-06 06:25:20', '2026-09-03 13:42:48', NULL),
(355, NULL, 'SRI WAHYU RAHMASARI', 'BOYOLALI', 'Laki-laki', '2008-09-06', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 390, '2026-07-06 06:25:20', '2026-09-03 13:42:48', NULL),
(356, NULL, 'SYAFALINA ANISA FEBRIYANTI', 'BOYOLALI', 'Laki-laki', '2009-02-25', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 391, '2026-07-06 06:25:20', '2026-09-03 13:42:48', NULL),
(357, NULL, 'VEGA UBIYANA', 'BOYOLALI', 'Laki-laki', '2008-11-03', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 392, '2026-07-06 06:25:20', '2026-09-03 13:42:48', NULL),
(358, NULL, 'YIN YANG KESHILA CHEUNG', 'BOYOLALI', 'Laki-laki', '2009-08-14', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 393, '2026-07-06 06:25:21', '2026-09-03 13:42:48', NULL),
(359, NULL, 'Zahra Fitri Septiana', 'Boyolali', 'Laki-laki', '2009-09-20', NULL, 'XI F 2.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 394, '2026-07-06 06:25:21', '2026-09-03 13:42:48', NULL),
(360, NULL, 'Adi Heri Pramono', 'Boyolali', 'Laki-laki', '2008-01-17', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 395, '2026-07-06 06:25:21', '2026-09-03 13:42:49', NULL),
(361, NULL, 'Akna Mumtaz Ilmi', 'Semarang', 'Laki-laki', '2008-09-09', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 396, '2026-07-06 06:25:22', '2026-09-03 13:42:49', NULL),
(362, NULL, 'ANGGUN SAL SABILA', 'BOYOLALI', 'Laki-laki', '2009-03-20', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 397, '2026-07-06 06:25:22', '2026-09-03 13:42:49', NULL),
(363, NULL, 'ANUGRAH MAULINA RAHMAWATI', 'BOYOLALI', 'Laki-laki', '2009-02-03', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 398, '2026-07-06 06:25:22', '2026-09-03 13:42:49', NULL),
(364, NULL, 'Asri Arum Ningtyas', 'Boyolali', 'Laki-laki', '2009-07-31', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 399, '2026-07-06 06:25:22', '2026-09-03 13:42:49', NULL),
(365, NULL, 'AULIA DINDA PRAMASTYA', 'BOYOLALI', 'Laki-laki', '2008-06-15', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 400, '2026-07-06 06:25:22', '2026-09-03 13:42:49', NULL),
(366, NULL, 'AULITA TRI KUMANDA YAFI', 'BOYOLALI', 'Laki-laki', '2009-10-30', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 401, '2026-07-06 06:25:23', '2026-09-03 13:42:49', NULL),
(367, NULL, 'AYUDYA PRATIWI', 'BOYOLALI', 'Laki-laki', '2009-08-21', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 402, '2026-07-06 06:25:23', '2026-09-03 13:42:49', NULL),
(368, NULL, 'BAYU AJI PURNOMO', 'BOYOLALI', 'Laki-laki', '2008-05-30', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 403, '2026-07-06 06:25:23', '2026-09-03 13:42:49', NULL),
(369, NULL, 'DEA FATMAWATI', 'Boyolali', 'Laki-laki', '2008-11-22', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 404, '2026-07-06 06:25:23', '2026-09-03 13:42:49', NULL),
(370, NULL, 'DESI LUSIANA PURNAMASARI', 'BOYOLALI', 'Laki-laki', '2009-07-05', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 405, '2026-07-06 06:25:24', '2026-09-03 13:42:49', NULL),
(371, NULL, 'DHEA SAFIRA', 'BOYOLALI', 'Laki-laki', '2009-03-12', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 406, '2026-07-06 06:25:24', '2026-09-03 13:42:49', NULL),
(372, NULL, 'DIVA TRI ANDRIANI', 'BOYOLALI', 'Laki-laki', '2009-02-15', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 407, '2026-07-06 06:25:24', '2026-09-03 13:42:49', NULL),
(373, NULL, 'Eko Priyanto', 'Boyolali', 'Laki-laki', '2008-07-06', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 408, '2026-07-06 06:25:24', '2026-09-03 13:42:49', NULL),
(374, NULL, 'EVALDO FIAN AFRIZA', 'Boyolali', 'Laki-laki', '2009-04-01', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 409, '2026-07-06 06:25:25', '2026-09-03 13:42:49', NULL),
(375, NULL, 'FATIMAH NUR YULIANI', 'BOYOLALI', 'Laki-laki', '2008-07-06', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 410, '2026-07-06 06:25:25', '2026-09-03 13:42:49', NULL),
(376, NULL, 'HAFIDH ALBAR', 'BOYOLALI', 'Laki-laki', '2008-05-11', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 411, '2026-07-06 06:25:25', '2026-09-03 13:42:49', NULL),
(377, NULL, 'HANNA SALSABILA', 'BOYOLALI', 'Perempuan', '2009-06-21', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 412, '2026-07-06 06:25:25', '2026-09-03 13:42:49', NULL),
(378, NULL, 'Intan Putri Utami', 'Boyolali', 'Perempuan', '2009-04-26', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 413, '2026-07-06 06:25:26', '2026-09-03 13:42:49', NULL),
(379, NULL, 'LISTA SRI WAHYU LESTARI', 'BOYOLALI', 'Perempuan', '2008-12-31', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 414, '2026-07-06 06:25:26', '2026-09-03 13:42:49', NULL),
(380, NULL, 'MEISA NURAINI', 'Klaten', 'Perempuan', '2008-05-01', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 415, '2026-07-06 06:25:26', '2026-09-03 13:42:49', NULL),
(381, NULL, 'MUHAMAD AGUNG PRATAMA', 'BOYOLALI', 'Perempuan', '2009-03-11', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 416, '2026-07-06 06:25:26', '2026-09-03 13:42:49', NULL),
(382, NULL, 'Muhamad Arifin', 'Boyolali', 'Perempuan', '2009-01-19', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 417, '2026-07-06 06:25:27', '2026-09-03 13:42:49', NULL),
(383, NULL, 'MUHAMAD DWI ARDIYANTO', 'Boyolali', 'Perempuan', '2008-07-16', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 418, '2026-07-06 06:25:27', '2026-09-03 13:42:49', NULL),
(384, NULL, 'MUHAMMAD RIZKI ADITIYA', 'BOYOLALI', 'Perempuan', '2009-11-03', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 419, '2026-07-06 06:25:27', '2026-09-03 13:42:49', NULL),
(385, NULL, 'MUHAMMAD TYO ARDIANSYAH', 'BOYOLALI', 'Perempuan', '2008-11-26', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 420, '2026-07-06 06:25:27', '2026-09-03 13:42:49', NULL),
(386, NULL, 'NADYA KHOIRUN NISWAN', 'BOYOLALI', 'Perempuan', '2009-03-13', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 421, '2026-07-06 06:25:28', '2026-09-03 13:42:49', NULL),
(387, NULL, 'NASWA AULIA PREHANTY', 'BOYOLALI', 'Perempuan', '2008-03-01', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 422, '2026-07-06 06:25:28', '2026-09-03 13:42:49', NULL),
(388, NULL, 'Natali Kris Diovani', 'Surakarta', 'Perempuan', '2009-12-20', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 423, '2026-07-06 06:25:28', '2026-09-03 13:42:49', NULL),
(389, NULL, 'Novia Maulinda', 'Boyolali', 'Perempuan', '2008-11-18', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 424, '2026-07-06 06:25:28', '2026-09-03 13:42:49', NULL),
(390, NULL, 'NOVIANA ROKHALI', 'BOYOLALI', 'Perempuan', '2008-11-28', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 425, '2026-07-06 06:25:29', '2026-09-03 13:42:49', NULL),
(391, NULL, 'Ridho Deni Kiswanto', 'Boyolali', 'Perempuan', '2007-07-14', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 426, '2026-07-06 06:25:29', '2026-09-03 13:42:49', NULL),
(392, NULL, 'RIZKY SETIADI', 'BOYOLALI', 'Perempuan', '2009-05-25', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 427, '2026-07-06 06:25:29', '2026-09-03 13:42:49', NULL),
(393, NULL, 'Salman Bajradaram', 'Cilacap', 'Perempuan', '2009-06-22', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 428, '2026-07-06 06:25:29', '2026-09-03 13:42:49', NULL),
(394, NULL, 'TRIYONO', 'BOYOLALI', 'Perempuan', '2008-07-07', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 429, '2026-07-06 06:25:30', '2026-09-03 13:42:49', NULL),
(395, NULL, 'Wongayu Jenar Mahesa', 'Boyolali', 'Perempuan', '2008-10-06', NULL, 'XI F 3.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 430, '2026-07-06 06:25:30', '2026-09-03 13:42:49', NULL),
(396, NULL, 'AGIP WIJANARKO', 'Boyolali', 'Perempuan', '2008-08-13', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 431, '2026-07-06 06:25:30', '2026-09-03 13:42:49', NULL),
(397, NULL, 'AGUS SRIYONO', 'BOYOLALI', 'Perempuan', '2007-06-25', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 432, '2026-07-06 06:25:30', '2026-09-03 13:42:49', NULL),
(398, NULL, 'Ahmad fauzan fathurroziq', 'Boyolali', 'Perempuan', '2008-03-16', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 433, '2026-07-06 06:25:31', '2026-09-03 13:42:49', NULL),
(399, NULL, 'ALI MUSTOFA', 'BOYOLALI', 'Perempuan', '2009-01-27', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 434, '2026-07-06 06:25:31', '2026-09-03 13:42:49', NULL),
(400, NULL, 'ALIEFAH ADJENG ARYA NINGSIH', 'WONOGIRI', 'Perempuan', '2009-01-12', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 435, '2026-07-06 06:25:31', '2026-09-03 13:42:49', NULL),
(401, NULL, 'ANIS PUJI LESTARI', 'Boyolali', 'Perempuan', '2008-02-23', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 436, '2026-07-06 06:25:32', '2026-09-03 13:42:49', NULL),
(402, NULL, 'ANITA NOVIYANTI', 'BOYOLALI', 'Perempuan', '2008-10-22', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 437, '2026-07-06 06:25:32', '2026-09-03 13:42:49', NULL),
(403, NULL, 'ARMADITA PRIHATINI', 'WONOSOBO', 'Perempuan', '2009-01-29', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 438, '2026-07-06 06:25:32', '2026-09-03 13:42:49', NULL),
(404, NULL, 'CALLISTA GISELA GITAFREYA', 'Boyolali', 'Perempuan', '2008-11-04', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 439, '2026-07-06 06:25:32', '2026-09-03 13:42:49', NULL),
(405, NULL, 'Dwi Lestari', 'Boyolali', 'Perempuan', '2009-04-02', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 440, '2026-07-06 06:25:33', '2026-09-03 13:42:49', NULL),
(406, NULL, 'FEBRIAN WAHYU PRATAMA', 'BOYOLALI', 'Perempuan', '2009-02-19', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 441, '2026-07-06 06:25:33', '2026-09-03 13:42:49', NULL),
(407, NULL, 'FELYSA EKA HIDAYANTI', 'Jepara', 'Perempuan', '2008-08-31', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 442, '2026-07-06 06:25:33', '2026-09-03 13:42:49', NULL),
(408, NULL, 'HAFID RIZAL DANENDRA', 'BOYOLALI', 'Perempuan', '2009-03-19', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 443, '2026-07-06 06:25:33', '2026-09-03 13:42:49', NULL),
(409, NULL, 'HANUNG DEWI NOVIANI', 'BOYOLALI', 'Perempuan', '2009-11-10', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 444, '2026-07-06 06:25:34', '2026-09-03 13:42:49', NULL),
(410, NULL, 'Khanza Dwi Khoirun Nisa', 'Boyolali', 'Perempuan', '2009-05-05', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 445, '2026-07-06 06:25:34', '2026-09-03 13:42:49', NULL),
(411, NULL, 'KRISBIYANTO', 'Boyolali', 'Perempuan', '2007-04-18', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 446, '2026-07-06 06:25:34', '2026-09-03 13:42:49', NULL),
(412, NULL, 'KURNIAWAN DEWA PAMBUDI', 'Boyolali', 'Perempuan', '2008-07-20', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 447, '2026-07-06 06:25:34', '2026-09-03 13:42:49', NULL),
(413, NULL, 'MUHAMMAD ANWAR', 'BOYOLALI', 'Perempuan', '2009-02-21', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 448, '2026-07-06 06:25:35', '2026-09-03 13:42:49', NULL),
(414, NULL, 'MUTIARA', 'Boyolali', 'Perempuan', '2008-08-08', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 449, '2026-07-06 06:25:35', '2026-09-03 13:42:49', NULL),
(415, NULL, 'NAYLA ADIAS PRATIWI', 'BOYOLALI', 'Perempuan', '2008-03-08', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 450, '2026-07-06 06:25:35', '2026-09-03 13:42:49', NULL),
(416, NULL, 'Ni Wayan Febriyan', 'Boyolali', 'Perempuan', '2009-01-31', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 451, '2026-07-06 06:25:35', '2026-09-03 13:42:49', NULL),
(417, NULL, 'PUJI RAHAYU', 'Lampung Barat', 'Perempuan', '2008-10-17', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 452, '2026-07-06 06:25:36', '2026-09-03 13:42:49', NULL),
(418, NULL, 'RAIHAN DAMAR PANULUH', 'BOYOLALI', 'Perempuan', '2009-02-09', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 453, '2026-07-06 06:25:36', '2026-09-03 13:42:49', NULL),
(419, NULL, 'RIFKY DWI HANDIKA', 'BOYOLALI', 'Perempuan', '2008-08-25', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 454, '2026-07-06 06:25:36', '2026-09-03 13:42:49', NULL),
(420, NULL, 'RIFQI AKBAR PRADITA', 'Boyolali', 'Perempuan', '2009-04-27', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 455, '2026-07-06 06:25:36', '2026-09-03 13:42:49', NULL),
(421, NULL, 'SAHDA ARISTA ROFILAH', 'Boyolali', 'Perempuan', '2009-04-20', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 456, '2026-07-06 06:25:37', '2026-09-03 13:42:49', NULL),
(422, NULL, 'Septya Ramadhani', 'Boyolali', 'Perempuan', '2009-09-25', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 457, '2026-07-06 06:25:37', '2026-09-03 13:42:49', NULL),
(423, NULL, 'SITI NUR WASI\'ATUL BADRIAH', 'BOYOLALI', 'Perempuan', '2008-12-10', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 458, '2026-07-06 06:25:37', '2026-09-03 13:42:49', NULL),
(424, NULL, 'TAUFIK HIDAYAT', 'BOYOLALI', 'Perempuan', '2009-05-10', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 459, '2026-07-06 06:25:37', '2026-09-03 13:42:49', NULL),
(425, NULL, 'Vicky Putra Ramadan', 'Boyolali', 'Perempuan', '2008-09-12', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 460, '2026-07-06 06:25:38', '2026-09-03 13:42:49', NULL),
(426, NULL, 'VIKY FAHRURODIN OKTARA', 'Boyolali', 'Perempuan', '2009-10-16', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 461, '2026-07-06 06:25:38', '2026-09-03 13:42:49', NULL),
(427, NULL, 'WAHYU BAYUTRI SETIANA', 'Boyolali', 'Perempuan', '2006-12-03', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 462, '2026-07-06 06:25:38', '2026-09-03 13:42:49', NULL),
(428, NULL, 'YULIANA PUTRI LISTIYONO', 'Boyolali', 'Perempuan', '2007-06-07', NULL, 'XI F 3.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 463, '2026-07-06 06:25:38', '2026-09-03 13:42:49', NULL),
(429, NULL, 'AAN KURNIAWAN', 'BOYOLALI', 'Perempuan', '2008-08-07', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 464, '2026-07-06 06:25:39', '2026-09-03 13:42:49', NULL),
(430, NULL, 'AFIFA MERLIN PRAMESTI AYU ASTUTI', 'Boyolali', 'Perempuan', '2009-03-10', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 465, '2026-07-06 06:25:39', '2026-09-03 13:42:49', NULL),
(431, NULL, 'Alenta Rahmawati', 'Boyolali', 'Perempuan', '2009-01-16', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 466, '2026-07-06 06:25:39', '2026-09-03 13:42:49', NULL),
(432, NULL, 'ALIF SAPUTRA', 'BOYOLALI', 'Perempuan', '2009-01-18', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 467, '2026-07-06 06:25:39', '2026-09-03 13:42:49', NULL),
(433, NULL, 'APRILIA UMAEROH', 'BOYOLALI', 'Perempuan', '2009-04-18', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 468, '2026-07-06 06:25:40', '2026-09-03 13:42:49', NULL),
(434, NULL, 'APRILIA WULANDARI', 'BOYOLALI', 'Perempuan', '2008-04-16', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 469, '2026-07-06 06:25:40', '2026-09-03 13:42:49', NULL),
(435, NULL, 'ARDAN RAFIANTO', 'BOYOLALI', 'Perempuan', '2009-02-26', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 470, '2026-07-06 06:25:40', '2026-09-03 13:42:49', NULL),
(436, NULL, 'ARVIN RAHMADDANI', 'BOYOLALI', 'Perempuan', '2008-10-02', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 471, '2026-07-06 06:25:40', '2026-09-03 13:42:49', NULL),
(437, NULL, 'BELLA AYU WULANDARI', 'BOYOLALI', 'Perempuan', '2009-08-12', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 472, '2026-07-06 06:25:41', '2026-09-03 13:42:49', NULL),
(438, NULL, 'CARISSA PUTRI', 'Boyolali', 'Perempuan', '2008-06-12', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 473, '2026-07-06 06:25:41', '2026-09-03 13:42:49', NULL),
(439, NULL, 'DIMAS SETIAWAN', 'Boyolali', 'Perempuan', '2008-12-10', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 474, '2026-07-06 06:25:41', '2026-09-03 13:42:49', NULL),
(440, NULL, 'ENY WAHYUNINGSIH', 'BOYOLALI', 'Perempuan', '2009-01-19', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 475, '2026-07-06 06:25:41', '2026-09-03 13:42:49', NULL),
(441, NULL, 'ERIXDA AGUNG KUNCORO', 'Boyolali', 'Perempuan', '2009-06-06', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 476, '2026-07-06 06:25:42', '2026-09-03 13:42:49', NULL),
(442, NULL, 'ERVANDY ALIF FEBRIAN', 'Boyolali', 'Perempuan', '2008-02-25', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 477, '2026-07-06 06:25:42', '2026-09-03 13:42:49', NULL),
(443, NULL, 'EVA YULIANTY', 'Boyolali', 'Perempuan', '2008-12-11', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 478, '2026-07-06 06:25:42', '2026-09-03 13:42:49', NULL),
(444, NULL, 'FAJAR NUR HIDAYAT', 'BOYOLALI', 'Perempuan', '2008-11-18', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 479, '2026-07-06 06:25:42', '2026-09-03 13:42:49', NULL),
(445, NULL, 'FATIMAH AZZAHRA', 'KLATEN', 'Perempuan', '2009-12-03', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 480, '2026-07-06 06:25:43', '2026-09-03 13:42:49', NULL),
(446, NULL, 'Intan Damayanti', 'Boyolali', 'Perempuan', '2008-12-28', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 481, '2026-07-06 06:25:43', '2026-09-03 13:42:49', NULL),
(447, NULL, 'LAILI MAFTUKHAH', 'BOYOLALI', 'Perempuan', '2009-03-04', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 482, '2026-07-06 06:25:43', '2026-09-03 13:42:49', NULL),
(448, NULL, 'MA\'RIFATU SYIFA KAMIL FARHANI', 'Boyolali', 'Perempuan', '2009-02-08', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 483, '2026-07-06 06:25:43', '2026-09-03 13:42:49', NULL),
(449, NULL, 'MUHAMAD FEBRY VALIANSAH', 'Boyolali', 'Perempuan', '2009-02-02', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 484, '2026-07-06 06:25:44', '2026-09-03 13:42:49', NULL),
(450, NULL, 'MUHAMAD TAUFIK KURNIAWAN', 'BOYOLALI', 'Perempuan', '2009-06-14', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 485, '2026-07-06 06:25:44', '2026-09-03 13:42:49', NULL),
(451, NULL, 'MUHAMMAD FAHRI AFIANTO', 'Boyolali', 'Perempuan', '2009-07-03', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 486, '2026-07-06 06:25:44', '2026-09-03 13:42:49', NULL),
(452, NULL, 'MUHAMMAD RIZQI KAKA PRADANA', 'BOYOLALI', 'Perempuan', '2009-06-07', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 487, '2026-07-06 06:25:44', '2026-09-03 13:42:49', NULL),
(453, NULL, 'Naysila Annisa Zaskia', 'Tulungagung', 'Perempuan', '2009-04-30', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 488, '2026-07-06 06:25:44', '2026-09-03 13:42:49', NULL),
(454, NULL, 'NURUDIN RIZKI SAPUTRO', 'Boyolali', 'Perempuan', '2008-10-26', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 489, '2026-07-06 06:25:45', '2026-09-03 13:42:49', NULL),
(455, NULL, 'RAIHAN SUSILO BUDIANTO', 'BOYOLALI', 'Perempuan', '2009-07-08', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 490, '2026-07-06 06:25:45', '2026-09-03 13:42:49', NULL),
(456, NULL, 'RASYA NUR HIDAYAT', 'Boyolali', 'Perempuan', '2008-03-21', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 491, '2026-07-06 06:25:45', '2026-09-03 13:42:49', NULL),
(457, NULL, 'RENDI SETIAWAN', 'Boyolali', 'Perempuan', '2007-11-27', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 492, '2026-07-06 06:25:45', '2026-09-03 13:42:49', NULL),
(458, NULL, 'SATRIA BAYU AJI', 'BOYOLALI', 'Perempuan', '2009-07-27', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 493, '2026-07-06 06:25:46', '2026-09-03 13:42:49', NULL),
(459, NULL, 'SRI WAHYU RAHMAYANI', 'BOYOLALI', 'Perempuan', '2008-09-06', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 494, '2026-07-06 06:25:46', '2026-09-03 13:42:49', NULL),
(460, NULL, 'TRI HARTANTO', 'Boyolali', 'Perempuan', '2008-10-17', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 495, '2026-07-06 06:25:46', '2026-09-03 13:42:49', NULL),
(461, NULL, 'WAHYU NUGROHO', 'Boyolali', 'Perempuan', '2009-03-29', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 496, '2026-07-06 06:25:46', '2026-09-03 13:42:49', NULL),
(462, NULL, 'WIDYA FELISIANO PUTRI', 'Boyolali', 'Perempuan', '2009-08-27', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 497, '2026-07-06 06:25:47', '2026-09-03 13:42:49', NULL),
(463, NULL, 'WIWID SARENAWATI', 'Boyolali', 'Perempuan', '2008-12-29', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 498, '2026-07-06 06:25:47', '2026-09-03 13:42:49', NULL),
(464, NULL, 'YOGO SAPUTRA', 'Boyolali', 'Perempuan', '2007-08-09', NULL, 'XI F 4.1', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 499, '2026-07-06 06:25:47', '2026-09-03 13:42:49', NULL),
(465, NULL, 'ALPIANA RAHMAWATI', 'Boyolali', 'Perempuan', '2009-02-13', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 500, '2026-07-06 06:25:47', '2026-09-03 13:42:49', NULL),
(466, NULL, 'ALWIS ALQURNIAWAN', 'BOYOLALI', 'Perempuan', '2008-05-16', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 501, '2026-07-06 06:25:48', '2026-09-03 13:42:49', NULL),
(467, NULL, 'Arief Nur Haryanto', 'Boyolali', 'Perempuan', '2008-03-21', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 502, '2026-07-06 06:25:48', '2026-09-03 13:42:49', NULL),
(468, NULL, 'AYU ANDINI', 'BOYOLALI', 'Perempuan', '2008-05-31', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 503, '2026-07-06 06:25:48', '2026-09-03 13:42:49', NULL),
(469, NULL, 'BAGUS PRABOWO', 'BOYOLALI', 'Perempuan', '2009-05-04', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 504, '2026-07-06 06:25:49', '2026-09-03 13:42:49', NULL),
(470, NULL, 'BIMA BASTIAN MULYA', 'BOYOLALI', 'Perempuan', '2008-10-22', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 505, '2026-07-06 06:25:49', '2026-09-03 13:42:49', NULL),
(471, NULL, 'DEVIANA ANDRIYANTI', 'Boyolali', 'Perempuan', '2009-12-20', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 506, '2026-07-06 06:25:49', '2026-09-03 13:42:49', NULL),
(472, NULL, 'ELXA WAHYU YULIANTO', 'Boyolali', 'Perempuan', '2007-07-23', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 507, '2026-07-06 06:25:49', '2026-09-03 13:42:49', NULL),
(473, NULL, 'FAIZ SARIFUDIN', 'BOYOLALI', 'Perempuan', '2009-01-13', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 508, '2026-07-06 06:25:50', '2026-09-03 13:42:49', NULL),
(474, NULL, 'FALIHA ALBIT', 'BOYOLALI', 'Perempuan', '2009-07-10', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 509, '2026-07-06 06:25:50', '2026-09-03 13:42:49', NULL),
(475, NULL, 'FARA DECHA ABABILQIS', 'BOYOLALI', 'Perempuan', '2009-08-16', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 510, '2026-07-06 06:25:50', '2026-09-03 13:42:49', NULL),
(476, NULL, 'HANUNG GIBRAN ALANSAH', 'BOYOLALI', 'Perempuan', '2009-03-30', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 511, '2026-07-06 06:25:50', '2026-09-03 13:42:49', NULL),
(477, NULL, 'KAILA NURUL AISHA', 'Boyolali', 'Perempuan', '2008-06-25', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 512, '2026-07-06 06:25:51', '2026-09-03 13:42:49', NULL),
(478, NULL, 'MUHAMAD RIZAL PURNAMA PUTRA', 'BOYOLALI', 'Perempuan', '2009-05-02', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 513, '2026-07-06 06:25:51', '2026-09-03 13:42:49', NULL),
(479, NULL, 'MUHAMMAD RIZKI FAUZI', 'BOYOLALI', 'Perempuan', '2009-01-28', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 514, '2026-07-06 06:25:51', '2026-09-03 13:42:49', NULL),
(480, NULL, 'Muhammat Ibnu Tamar Ibrahim', 'Boyolali', 'Perempuan', '2008-07-18', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 515, '2026-07-06 06:25:51', '2026-09-03 13:42:49', NULL),
(481, NULL, 'Nadin Aprilia Putri', 'Boyolali', 'Perempuan', '2008-04-01', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 516, '2026-07-06 06:25:52', '2026-09-03 13:42:49', NULL),
(482, NULL, 'NINDA ALTHAFUNNISA', 'KAB. SEMARANG', 'Perempuan', '2009-06-01', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 517, '2026-07-06 06:25:52', '2026-09-03 13:42:49', NULL),
(483, NULL, 'NOVA WIYANTO', 'Boyolali', 'Perempuan', '2008-09-21', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 518, '2026-07-06 06:25:52', '2026-09-03 13:42:49', NULL),
(484, NULL, 'NOVI MAULANI ADITYA', 'Boyolali', 'Perempuan', '2009-03-10', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 519, '2026-07-06 06:25:52', '2026-09-03 13:42:49', NULL),
(485, NULL, 'NUR ANISA', 'BOYOLALI', 'Perempuan', '2009-04-24', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 520, '2026-07-06 06:25:53', '2026-09-03 13:42:49', NULL),
(486, NULL, 'NUR ROHIMAH', 'BOYOLALI', 'Perempuan', '2008-11-29', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 521, '2026-07-06 06:25:53', '2026-09-03 13:42:49', NULL),
(487, NULL, 'PRASETYO DWI SAPUTRO', 'BOYOLALI', 'Perempuan', '2008-06-12', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 522, '2026-07-06 06:25:53', '2026-09-03 13:42:49', NULL),
(488, NULL, 'RAISA ISNAN SAPUTRA', 'Boyolali', 'Perempuan', '2009-04-20', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 523, '2026-07-06 06:25:53', '2026-09-03 13:42:49', NULL),
(489, NULL, 'Rasyid Amir Zaki', 'Bekasi', 'Perempuan', '2009-05-18', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 524, '2026-07-06 06:25:54', '2026-09-03 13:42:49', NULL),
(490, NULL, 'RESTU PURBANINGRAT', 'Boyolali', 'Perempuan', '2008-06-05', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 525, '2026-07-06 06:25:54', '2026-09-03 13:42:49', NULL),
(491, NULL, 'RIZAL MATHOFANI ADI NUGRAHA', 'BOYOLALI', 'Perempuan', '2008-02-29', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 526, '2026-07-06 06:25:54', '2026-09-03 13:42:49', NULL),
(492, NULL, 'SAIFUL UDIN', 'BOYOLALI', 'Perempuan', '2009-04-13', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 527, '2026-07-06 06:25:54', '2026-09-03 13:42:49', NULL),
(493, NULL, 'Septia Ramadhani', 'Boyolali', 'Perempuan', '2008-09-19', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 528, '2026-07-06 06:25:55', '2026-09-03 13:42:49', NULL),
(494, NULL, 'SHOLEH SETYAWAN', 'BOYOLALI', 'Perempuan', '2009-05-01', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 529, '2026-07-06 06:25:55', '2026-09-03 13:42:49', NULL),
(495, NULL, 'SOWAN APRILIA', 'Boyolali', 'Perempuan', '2009-04-28', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 530, '2026-07-06 06:25:55', '2026-09-03 13:42:49', NULL),
(496, NULL, 'THORIQ LUTFI ZAILANI', 'Boyolali', 'Perempuan', '2009-07-15', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 531, '2026-07-06 06:25:55', '2026-09-03 13:42:49', NULL),
(497, NULL, 'Vika Damayanti', 'Boyolali', 'Perempuan', '2008-06-05', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 532, '2026-07-06 06:25:56', '2026-09-03 13:42:49', NULL),
(498, NULL, 'WAHYU PURWANTO', 'SUKOHARJO', 'Perempuan', '2009-02-02', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 533, '2026-07-06 06:25:56', '2026-09-03 13:42:49', NULL),
(499, NULL, 'YOGI MUHAMAD FAIZAL', 'BOYOLALI', 'Perempuan', '2008-08-11', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 534, '2026-07-06 06:25:56', '2026-09-03 13:42:49', NULL),
(500, NULL, 'ZAFRAN AL FARIZI', 'BOYOLALI', 'Perempuan', '2009-05-10', NULL, 'XI F 4.2', NULL, NULL, NULL, NULL, 'aktif', '2026/2027', NULL, 535, '2026-07-06 06:25:56', '2026-09-03 13:42:49', NULL);

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
  `tipe_pengumpulan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dokumen',
  `mode_audiovisual` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `tugas` (`id`, `mata_pelajaran_id`, `kelas_id`, `judul`, `deskripsi`, `tipe_pengumpulan`, `mode_audiovisual`, `type`, `deadline`, `lampiran`, `answer_key`, `guru_id`, `prasyarat_materi_id`, `status`, `max_score`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 30, 118, 'Pertemuan 1: Introduction to Legend (Narrative Text)', 'Welcome to Advanced English Class, XI F 1! 🌟\r\n\r\nPada pertemuan pertama ini, kita akan mulai mengeksplorasi teks naratif (Narrative Text), khususnya cerita legenda (Legend). Silakan kerjakan instruksi berikut:\r\n1.Carilah satu cerita legenda dari Indonesia yang paling kalian sukai dalam Bahasa Inggris (contoh: Malin Kundang, Prambanan Temple, dll).\r\n2. Tuliskan ringkasan cerita (Summary) dalam 1-2 paragraf menggunakan kalimat kalian sendiri.\r\n3. Tuliskan pesan moral (Moral Value) yang bisa dipetik dari cerita tersebut.\r\nSilakan ketik langsung jawaban kalian atau kumpulkan dalam bentuk PDF/Word. Be creative and do your best!', 'dokumen', NULL, 'essay', '2026-08-17 15:00:00', NULL, NULL, 21, NULL, 'aktif', 100, '2026-08-18 04:24:20', '2026-08-18 04:24:20', NULL),
(12, 30, 118, 'Pertemuan 2: Sharing Opinions - Social Media Impact', 'Hello everyone, welcome to the Advanced English Class!\r\n\r\nSebelum kita masuk ke materi inti, saya ingin mengetahui sejauh mana kemampuan kalian dalam menyampaikan pendapat (Expressing Opinion).\r\n\r\nSilakan jawab pertanyaan berikut dalam 2-3 paragraf berbahasa Inggris:\r\n\"Do you think social media has a positive or negative impact on teenagers\' mental health? Give your reasons and examples.\" (Menurutmu, apakah media sosial berdampak positif atau negatif pada kesehatan mental remaja? Berikan alasan dan contohnya.)\r\n\r\nTidak ada jawaban benar atau salah, kemukakan opini kalian sebebas mungkin dengan tata bahasa terbaik yang kalian bisa. Boleh diketik langsung atau diunggah dalam format PDF. Good luck!', 'dokumen', NULL, 'essay', '2026-08-18 09:30:00', NULL, NULL, 21, NULL, 'aktif', 100, '2026-08-18 04:24:58', '2026-08-18 04:24:58', NULL),
(13, 30, 118, 'Pertemuan 3: Listening & Video Reflection', 'Hello class, welcome to Advanced English! 🚀\r\n\r\nUntuk tugas pertama ini, mari kita lakukan pemanasan dengan mengasah kemampuan Listening dan Critical Thinking kalian.\r\n1. Silakan tonton video pendek pada link berikut ini: [LINK VIDEO]\r\n2. Setelah menonton dengan saksama, jawablah pertanyaan berikut dalam Bahasa Inggris:\r\nA. What is the main idea of the video? (Apa ide pokok dari cerita/penjelasan di video tersebut?)\r\nB. Write down 5 new vocabulary words you found in the video and their meanings! (Tuliskan minimal 5 kosakata baru yang kalian temukan beserta artinya!)\r\nC. What is your personal opinion or takeaway from the video? (Apa pendapat pribadi atau pelajaran yang bisa kalian ambil dari video tersebut?)\r\nSilakan ketik langsung jawaban kalian di kolom pengumpulan tugas atau unggah dalam bentuk file (Word/PDF). Happy watching and learning!', 'dokumen', NULL, 'essay', '2026-08-17 15:45:00', NULL, NULL, 21, NULL, 'aktif', 100, '2026-08-18 04:27:01', '2026-08-18 07:47:19', NULL),
(14, 9, 89, 'Tugas 1: Analisis Struktur Teks LHO Lingkungan Sekolah', 'Bacalah teks LHO tentang Lingkungan Sekolah SMAN 1 Cepogo, kemudian analisislah struktur teks (Pernyataan Umum, Deskripsi Bagian, Deskripsi Manfaat).', 'dokumen', NULL, 'essay', '2025-08-25 16:00:00', NULL, NULL, 11, NULL, 'aktif', 100, '2025-08-18 01:00:00', '2025-08-18 01:00:00', NULL),
(15, 9, 89, 'Tugas 2: Analisis Kaidah Kebahasaan Teks Laporan Hasil Observasi (LHO)', 'Identifikasi penggunaan kata benda, kata kerja material, kalimat definisi, dan kalimat deskripsi pada teks laporan hasil observasi yang telah dibaca.', 'dokumen', NULL, 'essay', '2025-09-08 16:00:00', NULL, NULL, 11, NULL, 'aktif', 100, '2025-09-01 01:00:00', '2025-09-01 01:00:00', NULL),
(16, 9, 89, 'Tugas 3: Menyusun Kerangka dan Menulis Teks Laporan Hasil Observasi (LHO)', 'Lakukan observasi mandiri di lingkungan sekitar, susun kerangka laporan observasi, dan kembangkan menjadi teks LHO utuh minimal 4 paragraf.', 'dokumen', NULL, 'essay', '2025-09-22 16:00:00', NULL, NULL, 11, NULL, 'aktif', 100, '2025-09-15 01:00:00', '2025-09-15 01:00:00', NULL),
(17, 9, 89, 'Tugas 4: Publikasi dan Evaluasi Laporan Observasi Terpadu', 'Koreksi akhir teks LHO berdasarkan rubrik penilaian dan unggah naskah laporan observasi terpadu dalam format PDF.', 'dokumen', NULL, 'essay', '2025-10-06 16:00:00', NULL, NULL, 11, NULL, 'aktif', 100, '2025-09-29 01:00:00', '2025-09-29 01:00:00', NULL),
(18, 30, 118, 'Tugas 4', 'tes', 'dokumen', NULL, 'essay', '2026-08-17 15:31:00', NULL, NULL, 21, NULL, 'aktif', 100, '2026-08-18 07:48:42', '2026-08-18 07:50:56', NULL),
(19, 30, 118, 'Tugas 5', 'tes', 'dokumen', NULL, 'essay', '2026-08-17 15:49:00', NULL, NULL, 21, NULL, 'aktif', 100, '2026-08-18 07:49:41', '2026-08-18 07:51:12', NULL),
(20, 30, 118, 'tugas 6', 'tes andika', 'dokumen', NULL, 'essay', '2026-08-18 16:50:00', NULL, NULL, 21, NULL, 'aktif', 100, '2026-08-18 07:50:42', '2026-08-18 07:50:42', NULL),
(21, 30, 128, 'Tugas 1 Analisis Teks / Analytical Exposition (Menulis Esai)', '1. Read the provided article/topic regarding current global issues (e.g., Digital Literacy, Climate Change, or Artificial Intelligence).\r\n2. Write an Analytical Exposition Text consisting of 250–350 words with the following structure:\r\n-Thesis: State your stance clearly.\r\n-Arguments: Provide at least 2 strong arguments supported by facts/evidence.\r\n-Reiteration: Restate your point of view.\r\n3. Format: Font Times New Roman 12, 1.5 spacing, saved in PDF or DOCX format.\r\n4. Submit before the deadline.', 'dokumen', NULL, 'essay', '2026-08-22 22:54:00', 'tugas/WIPRfH7TWcWlWP9DV5ORqWHVaRkkyABVkgQthJA3.docx', NULL, 17, NULL, 'aktif', 100, '2026-08-21 15:54:51', '2026-08-23 23:24:00', NULL),
(22, 30, 128, 'Video Presentasi Bahasa Inggris', 'Buat video presentasi berdurasi 3–5 menit, unggah ke YouTube sebagai Tidak Tercantum (Unlisted), kemudian kumpulkan tautannya.', 'audiovisual', 'video_url', 'essay', '2026-08-23 13:35:00', 'https://youtu.be/0GzepVdF8TY?si=TrkVKkub1LfhyA6g', NULL, 17, NULL, 'aktif', 100, '2026-08-22 06:36:07', '2026-08-23 23:23:30', NULL),
(23, 30, 128, 'English Campaign Poster: Speak with Confidence', 'Create an original English poster with the theme “Speak English with Confidence.” Your poster must contain a clear title, a short motivational slogan, and at least three practical tips for improving English skills. Use the attached poster only as a reference and do not copy it exactly. Submit your work in JPG, JPEG, PNG, or PDF format with a maximum size of 20 MB.', 'visual', NULL, 'essay', '2026-08-22 17:02:00', 'tugas/eKRy2EG0FEs2pmPEtk04rvBYCfSjT7P3uM1Skk4O.png', NULL, 17, NULL, 'aktif', 100, '2026-08-22 07:05:36', '2026-08-22 07:05:36', NULL),
(24, 3, 113, 'Tugas 1 cek ssl', 'apakah berhasil revisinya', 'dokumen', NULL, 'essay', '2026-08-22 12:39:00', NULL, NULL, 17, NULL, 'aktif', 100, '2026-08-23 04:39:23', '2026-08-23 04:51:10', NULL),
(25, 3, 113, 'Tugas 2 cek ssl', 'maksimal 3 berarti tugas ke 4 jika guru belum melakukan validasi apa yang akan terjadi di sisi siswa', 'dokumen', NULL, 'essay', '2026-08-24 11:43:00', NULL, NULL, 17, NULL, 'aktif', 100, '2026-08-23 04:43:50', '2026-08-23 04:43:59', '2026-08-23 04:43:59'),
(26, 3, 113, 'Tugas 2 cek ssl', 'maksimal 3 berarti tugas ke 4 jika guru belum melakukan validasi apa yang akan terjadi di sisi siswa', 'dokumen', NULL, 'essay', '2026-08-21 11:43:00', NULL, NULL, 17, NULL, 'aktif', 100, '2026-08-23 04:43:50', '2026-08-23 04:51:21', NULL),
(27, 3, 113, 'Tugas 3 cek ssl', 'momen krusial', 'dokumen', NULL, 'essay', '2026-08-23 11:44:00', NULL, NULL, 17, NULL, 'aktif', 100, '2026-08-23 04:44:40', '2026-08-23 04:50:55', NULL),
(28, 3, 113, 'waktunya tes ssl', 'tes ssl', 'dokumen', NULL, 'essay', '2026-08-24 13:45:00', NULL, NULL, 17, NULL, 'aktif', 100, '2026-08-23 04:45:26', '2026-08-23 04:45:26', NULL),
(32, 9, 128, 'Tugas 1 Analisis Struktur & Ciri Kebahasaan Teks Editorial', 'Bacalah teks editorial terlampir lalu tentukan tesis, argumentasi pendukung, dan rekomendasi.', 'dokumen', NULL, 'essay', '2026-08-21 13:30:00', NULL, NULL, 29, NULL, 'aktif', 100, '2026-08-23 17:54:19', '2026-08-23 17:54:19', NULL),
(33, 9, 128, 'Tugas 2 Menyusun Opini dan Fakta Isu Pendidikan Aktual', 'Susun tabel perbandingan kalimat fakta dan kalimat opini berdasarkan artikel berita terkini.', 'dokumen', NULL, 'essay', '2026-08-23 23:59:00', NULL, NULL, 29, NULL, 'aktif', 100, '2026-08-23 17:54:19', '2026-08-23 17:54:19', NULL),
(34, 9, 128, 'Tugas 3 Praktik Menulis Teks Editorial Orisinal', 'Tulis sebuah teks editorial orisinal minimal 300 kata bertema peran AI dalam pembelajaran modern.', 'dokumen', NULL, 'essay', '2026-08-27 17:00:00', NULL, NULL, 29, NULL, 'aktif', 100, '2026-08-23 17:54:19', '2026-08-23 17:54:19', NULL),
(35, 6, 128, 'Tugas 1: Analisis Kasus Pelanggaran Hak dan Pengingkaran Kewajiban', 'Bacalah studi kasus terlampir mengenai penegakan hak asasi manusia, kemudian buatlah analisis kritis sesuai UUD 1945.', 'dokumen', NULL, 'essay', '2026-08-18 13:30:00', NULL, NULL, 23, NULL, 'aktif', 100, '2026-08-23 18:00:00', '2026-08-23 18:00:00', NULL),
(36, 6, 128, 'Tugas 2: Evaluasi Dinamika Praktik Demokrasi Pancasila', 'Buat infografis atau ringkasan esai mengenai periodisasi demokrasi di Indonesia sejak tahun 1945 hingga era reformasi.', 'dokumen', NULL, 'essay', '2026-08-20 23:59:00', NULL, NULL, 23, NULL, 'aktif', 100, '2026-08-23 18:00:00', '2026-08-23 18:00:00', NULL),
(37, 6, 128, 'Tugas 3: Analisis Peran Lembaga Penegak Hukum di Indonesia', 'Identifikasi wewenang Kepolisian, Kejaksaan, KPK, dan Kehakiman dalam menjamin keadilan hukum masyarakat.', 'dokumen', NULL, 'essay', '2026-08-22 17:00:00', NULL, NULL, 23, NULL, 'aktif', 100, '2026-08-23 18:00:00', '2026-08-23 18:00:00', NULL),
(38, 6, 128, 'Tugas 4: Rancangan Aksi Nyata Nilai Praksis Sila-Sila Pancasila', 'Susunlah proposal mini program bakti sosial / toleransi di lingkungan sekolah.', 'dokumen', NULL, 'essay', '2026-08-28 23:59:00', NULL, NULL, 23, NULL, 'aktif', 100, '2026-08-23 18:00:00', '2026-08-23 18:00:00', NULL),
(39, 7, 128, 'Tugas 1: Analisis Gejala Sosial di Lingkungan Sekitar', 'Amati gejala sosial di lingkungan Anda dan tulis laporannya (min. 2 halaman).', 'dokumen', NULL, 'essay', '2026-08-17 13:30:00', NULL, NULL, 8, NULL, 'aktif', 100, '2026-08-23 18:29:11', '2026-08-23 18:29:11', NULL),
(40, 7, 128, 'Tugas 2: Evaluasi Faktor-faktor Perubahan Sosial', 'Identifikasi faktor pendorong dan penghambat perubahan sosial dalam era digital.', 'dokumen', NULL, 'essay', '2026-08-19 23:59:00', NULL, NULL, 8, NULL, 'aktif', 100, '2026-08-23 18:29:11', '2026-08-23 18:29:11', NULL),
(41, 7, 128, 'Tugas 3: Studi Kasus Ketimpangan Sosial', 'Buat esai analisis mengenai ketimpangan sosial di bidang pendidikan atau kesehatan.', 'dokumen', NULL, 'essay', '2026-08-22 17:00:00', NULL, NULL, 8, NULL, 'aktif', 100, '2026-08-23 18:29:11', '2026-08-23 18:29:11', NULL),
(42, 7, 128, 'Tugas 4: Peran Kearifan Lokal dalam Masyarakat', 'Jelaskan peran kearifan lokal dalam mengatasi dampak negatif globalisasi.', 'dokumen', NULL, 'essay', '2026-08-29 23:59:00', NULL, NULL, 8, NULL, 'aktif', 100, '2026-08-23 18:29:11', '2026-08-23 18:29:11', NULL),
(43, 30, 128, 'Advanced English External Project (Canva/Figma)', 'Please submit the public URL to your Canva presentation or Figma design for the Advanced English speaking project.', 'tautan', NULL, 'essay', '2026-08-27 23:59:00', 'https://www.canva.com/templates/EAGDd5gpDNI-project-retro-presentation/', NULL, 17, NULL, 'aktif', 100, '2026-08-23 23:21:48', '2026-08-23 23:31:32', NULL),
(44, 31, 111, 'Tugas 1: Analisis Tembang Macapat Pocung', 'Silakan baca teks tembang Macapat Pocung pada lampiran modul. Kemudian buatlah analisis mengenai guru gatra, guru wilangan, guru lagu, serta pesan moral/amanat yang terkandung di dalamnya.\n\nFormat Pengumpulan: Dokumen PDF/Word.', 'dokumen', NULL, 'essay', '2026-09-12 23:59:00', NULL, NULL, 21, NULL, 'aktif', 100, '2026-09-07 13:13:09', '2026-09-07 13:13:09', NULL),
(45, 31, 111, 'Tugas 2: Penulisan Aksara Jawa & Pasangan', 'Tulislah 5 kalimat beraksara Jawa lengkap dengan sandhangan swara dan pasangan pada lembar tugas Anda. Silakan unggah foto/dokumen jawaban di sini.', 'dokumen', NULL, 'essay', '2026-09-14 23:59:00', NULL, NULL, 21, NULL, 'aktif', 100, '2026-09-07 14:42:55', '2026-09-07 14:42:55', NULL),
(46, 1, 111, 'Tugas 1: Analisis Kebutuhan Manusia dan Kelangkaan', 'Lakukan identifikasi faktor-faktor yang menyebabkan kelangkaan sumber daya ekonomi di lingkungan sekitar Anda dan buat tabel skala prioritas kebutuhan.', 'dokumen', NULL, 'essay', '2026-08-24 23:59:00', NULL, NULL, 1, NULL, 'aktif', 100, '2026-08-18 14:50:25', '2026-08-18 14:50:25', NULL),
(47, 1, 111, 'Tugas 2: Masalah Pokok Ekonomi Modern (What, How, For Whom)', 'Analisis penerapan masalah pokok ekonomi modern pada studi kasus UMKM lokal dan jelaskan solusi sistem ekonomi yang diterapkan.', 'dokumen', NULL, 'essay', '2026-08-31 23:59:00', NULL, NULL, 1, NULL, 'aktif', 100, '2026-08-23 14:50:25', '2026-08-23 14:50:25', NULL),
(48, 1, 111, 'Tugas 3: Pelaku Ekonomi dan Diagram Circular Flow', 'Gambarkan bagan interaksi antarpelaku kegiatan ekonomi (Circular Flow Diagram 4 Sektor) dan jelaskan peranan rumah tangga pemerintah.', 'dokumen', NULL, 'essay', '2026-09-05 23:59:00', NULL, NULL, 1, NULL, 'aktif', 100, '2026-08-28 14:50:25', '2026-08-28 14:50:25', NULL);

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
  ADD UNIQUE KEY `unique_siswa_subject_recovery` (`siswa_id`,`mata_pelajaran_id`),
  ADD KEY `pemulihan_akses_siswa_id_foreign` (`siswa_id`),
  ADD KEY `pemulihan_akses_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `pemulihan_akses_tugas_id_foreign` (`tugas_id`),
  ADD KEY `pemulihan_akses_dibuka_oleh_foreign` (`dibuka_oleh`);

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
  ADD KEY `pengumpulan_tugas_siswa_id_foreign` (`siswa_id`),
  ADD KEY `pengumpulan_tugas_dikembalikan_oleh_foreign` (`dikembalikan_oleh`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8151;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `master_kelas`
--
ALTER TABLE `master_kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pemulihan_akses`
--
ALTER TABLE `pemulihan_akses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengajuan_banding`
--
ALTER TABLE `pengajuan_banding`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2948;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_kelas_siswa`
--
ALTER TABLE `riwayat_kelas_siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3400;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1643;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
  ADD CONSTRAINT `pemulihan_akses_dibuka_oleh_foreign` FOREIGN KEY (`dibuka_oleh`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL,
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
  ADD CONSTRAINT `pengumpulan_tugas_dikembalikan_oleh_foreign` FOREIGN KEY (`dikembalikan_oleh`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL,
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
