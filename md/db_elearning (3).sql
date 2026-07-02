-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2026 at 12:19 PM
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
-- Database: `db_elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-26 09:13:49', '2026-06-26 09:13:49'),
(2, NULL, 'BACKUP_DB', 'Melakukan pencadangan database secara manual', NULL, NULL, '2026-06-26 09:15:48', '2026-06-26 09:15:48'),
(3, NULL, 'BACKUP_DB', 'Melakukan pencadangan database secara manual', NULL, NULL, '2026-06-26 09:16:05', '2026-06-26 09:16:05'),
(4, NULL, 'BACKUP_DB', 'Melakukan pencadangan database secara manual', NULL, NULL, '2026-06-26 09:17:23', '2026-06-26 09:17:23'),
(5, NULL, 'CLEARED_CACHE', 'Membersihkan cache sistem (cache, config, view, route)', NULL, NULL, '2026-06-26 09:17:27', '2026-06-26 09:17:27'),
(6, NULL, 'EXPORT_ARCHIVE', 'Melakukan ekspor arsip sistem lengkap (database + unggahan file)', NULL, NULL, '2026-06-26 09:28:14', '2026-06-26 09:28:14'),
(7, 752, 'AUTH', 'Pengguna \"Aditya Lestari\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-26 09:58:54', '2026-06-26 09:58:54'),
(8, 752, 'AUTH', 'Pengguna \"Aditya Lestari\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-26 10:01:46', '2026-06-26 10:01:46'),
(9, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-26 10:16:10', '2026-06-26 10:16:10'),
(10, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 02:16:57', '2026-06-27 02:16:57'),
(11, 6, 'STUDENT', 'Melakukan kelulusan massal untuk 100 siswa dari kelas: XII IPA 1, XII IPA 2, XII IPA 3, XII IPA 4, XII IPS 1, XII IPS 2, XII IPS 3, XII IPS 4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 02:46:17', '2026-06-27 02:46:17'),
(12, 6, 'STUDENT', 'Melakukan kenaikan kelas massal untuk 300 siswa. Detail: X IPA 1 -> XI IPA 1 (14 siswa), X IPA 2 -> XI IPA 2 (14 siswa), X IPA 3 -> XI IPA 3 (13 siswa), X IPA 4 -> XI IPA 4 (13 siswa), X IPS 1 -> XI IPS 1 (12 siswa), X IPS 2 -> XI IPS 2 (12 siswa), X IPS 3 -> XI IPS 3 (11 siswa), X IPS 4 -> XI IPS 4 (11 siswa), XI IPA 1 -> XII IPA 1 (26 siswa), XI IPA 2 -> XII IPA 2 (25 siswa), XI IPA 3 -> XII IPA 3 (24 siswa), XI IPA 4 -> XII IPA 4 (24 siswa), XI IPS 1 -> XII IPS 1 (26 siswa), XI IPS 2 -> XII IPS 2 (26 siswa), XI IPS 3 -> XII IPS 3 (25 siswa), XI IPS 4 -> XII IPS 4 (24 siswa)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 02:55:04', '2026-06-27 02:55:04'),
(13, 6, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:03:00', '2026-06-27 03:03:00'),
(14, 1305, 'AUTH', 'Pengguna \"Agus Nugroho, S.Pd.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:03:06', '2026-06-27 03:03:06'),
(15, 1305, 'AUTH', 'Pengguna \"Agus Nugroho, S.Pd.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:03:30', '2026-06-27 03:03:30'),
(16, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:03:34', '2026-06-27 03:03:34'),
(17, 6, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:04:00', '2026-06-27 03:04:00'),
(18, 1293, 'AUTH', 'Pengguna \"Nining Wibowo, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:04:04', '2026-06-27 03:04:04'),
(19, 1293, 'AUTH', 'Pengguna \"Nining Wibowo, S.Pd., M.Si.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:04:29', '2026-06-27 03:04:29'),
(20, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:04:35', '2026-06-27 03:04:35'),
(21, 6, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran 2025/2026. Terplot: 104 pemetaan mengajar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(22, 6, 'STUDENT', 'Melakukan plotting siswa otomatis ke kelas untuk Tahun Ajaran 2025/2026. Terplot: 0 siswa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:06:04', '2026-06-27 03:06:04'),
(23, 6, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:07:36', '2026-06-27 03:07:36'),
(24, 1297, 'AUTH', 'Pengguna \"Siti Subagyo, S.Pd., M.Pd.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:07:40', '2026-06-27 03:07:40'),
(25, 1297, 'AUTH', 'Pengguna \"Siti Subagyo, S.Pd., M.Pd.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:07:59', '2026-06-27 03:07:59'),
(26, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:10:04', '2026-06-27 03:10:04'),
(27, 6, 'STUDENT', 'Melakukan plotting siswa otomatis ke kelas untuk Tahun Ajaran 2025/2026. Terplot: 300 siswa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:14:31', '2026-06-27 03:14:31'),
(28, 6, 'STUDENT', 'Melakukan kelulusan massal untuk 100 siswa dari kelas: XII IPA 1, XII IPA 2, XII IPA 3, XII IPA 4, XII IPS 1, XII IPS 2, XII IPS 3, XII IPS 4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:17:03', '2026-06-27 03:17:03'),
(29, 6, 'STUDENT', 'Melakukan kenaikan kelas massal untuk 200 siswa. Detail: XI IPA 1 -> XII IPA 1 (12 siswa), XI IPA 2 -> XII IPA 2 (11 siswa), XI IPA 3 -> XII IPA 3 (11 siswa), XI IPA 4 -> XII IPA 4 (11 siswa), XI IPS 1 -> XII IPS 1 (14 siswa), XI IPS 2 -> XII IPS 2 (14 siswa), XI IPS 3 -> XII IPS 3 (14 siswa), XI IPS 4 -> XII IPS 4 (13 siswa), X IPA 1 -> XI IPA 1 (14 siswa), X IPA 2 -> XI IPA 2 (14 siswa), X IPA 3 -> XI IPA 3 (13 siswa), X IPA 4 -> XI IPA 4 (13 siswa), X IPS 1 -> XI IPS 1 (12 siswa), X IPS 2 -> XI IPS 2 (12 siswa), X IPS 3 -> XI IPS 3 (11 siswa), X IPS 4 -> XI IPS 4 (11 siswa)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:17:29', '2026-06-27 03:17:29'),
(30, 6, 'CLASS', 'Menyalin 24 kelas dari T.A 2025/2026 ke 2026/2027', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 03:33:20', '2026-06-27 03:33:20'),
(31, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 10:23:04', '2026-06-27 10:23:04'),
(32, 1305, 'AUTH', 'Pengguna \"Agus Nugroho, S.Pd.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 10:24:50', '2026-06-27 10:24:50'),
(33, 6, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran 2026/2027. Terplot: 104 pemetaan mengajar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 10:25:17', '2026-06-27 10:25:17'),
(34, 6, 'STUDENT', 'Melakukan plotting siswa otomatis ke kelas untuk Tahun Ajaran 2026/2027. Terplot: 0 siswa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 10:25:46', '2026-06-27 10:25:46'),
(35, 6, 'CLASS', 'Memperbarui plotting wali kelas secara massal', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 10:26:02', '2026-06-27 10:26:02'),
(36, 1305, 'AUTH', 'Pengguna \"Agus Nugroho, S.Pd.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 10:26:28', '2026-06-27 10:26:28'),
(37, 6, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran 2027/2028. Terplot: 0 pemetaan mengajar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 10:38:59', '2026-06-27 10:38:59'),
(38, 6, 'STUDENT', 'Melakukan plotting siswa otomatis ke kelas untuk Tahun Ajaran 2026/2027. Terplot: 100 siswa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 12:51:02', '2026-06-27 12:51:02'),
(39, 6, 'TEACHER', 'Melakukan plotting guru otomatis ke kelas-kelas untuk Tahun Ajaran 2026/2027. Terplot: 245 pemetaan mengajar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(40, 6, 'STUDENT', 'Menambahkan data siswa baru: Andika Pratama (NIS: 4101001101)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 13:15:02', '2026-06-27 13:15:02'),
(41, 6, 'CLASS', 'Memasukkan siswa Andika Pratama ke kelas X IPS 4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 13:23:32', '2026-06-27 13:23:32'),
(42, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 13:50:58', '2026-06-27 13:50:58'),
(43, 616, 'AUTH', 'Pengguna \"Budi Dewi\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 14:02:02', '2026-06-27 14:02:02'),
(44, 616, 'AUTH', 'Pengguna \"Budi Dewi\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 14:03:29', '2026-06-27 14:03:29'),
(45, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 14:03:47', '2026-06-27 14:03:47'),
(46, 6, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 14:31:49', '2026-06-27 14:31:49'),
(47, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 14:32:14', '2026-06-27 14:32:14'),
(48, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 15:03:33', '2026-06-27 15:03:33'),
(49, 1278, 'ASSIGNMENT', 'Membuat tugas baru: TUGAS PAI PERTEMUAN 1', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 15:04:48', '2026-06-27 15:04:48'),
(50, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 15:05:01', '2026-06-27 15:05:01'),
(51, 616, 'AUTH', 'Pengguna \"Budi Dewi\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 15:05:24', '2026-06-27 15:05:24'),
(52, 616, 'AUTH', 'Pengguna \"Budi Dewi\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 15:05:57', '2026-06-27 15:05:57'),
(53, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 15:06:12', '2026-06-27 15:06:12'),
(54, 1278, 'ASSIGNMENT', 'Membuat tugas baru: TUGAS PAI PERTEMUAN 1', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 15:07:12', '2026-06-27 15:07:12'),
(55, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 15:07:21', '2026-06-27 15:07:21'),
(56, 616, 'AUTH', 'Pengguna \"Budi Dewi\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.34 Mobile/15E148 Safari/604.1', '2026-06-27 15:07:49', '2026-06-27 15:07:49'),
(57, 1278, 'ASSIGNMENT', 'Membuat tugas baru: TUGAS PAI PERTEMUAN 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 15:12:45', '2026-06-27 15:12:45'),
(58, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 15:13:21', '2026-06-27 15:13:21'),
(59, 616, 'AUTH', 'Pengguna \"Budi Dewi\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 15:13:27', '2026-06-27 15:13:27'),
(60, 616, 'ASSIGNMENT', 'Mengumpulkan tugas: TUGAS PAI PERTEMUAN 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 15:16:01', '2026-06-27 15:16:01'),
(61, 616, 'AUTH', 'Pengguna \"Budi Dewi\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 15:19:01', '2026-06-27 15:19:01'),
(62, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 15:19:26', '2026-06-27 15:19:26'),
(63, 1278, 'ASSIGNMENT', 'Mengubah status koreksi tugas TUGAS PAI PERTEMUAN 1 untuk siswa Budi Dewi', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-27 16:01:03', '2026-06-27 16:01:03'),
(64, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 07:00:00', '2026-06-28 07:00:00'),
(65, 6, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:47:09', '2026-06-28 10:47:09'),
(66, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:47:28', '2026-06-28 10:47:28'),
(67, 1278, 'ASSIGNMENT', 'Membuat materi baru: Materi Pertemuan 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:49:46', '2026-06-28 10:49:46'),
(68, 1278, 'ASSIGNMENT', 'Memperbarui materi: Materi Pertemuan 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:50:53', '2026-06-28 10:50:53'),
(69, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:51:22', '2026-06-28 10:51:22'),
(70, 1279, 'AUTH', 'Pengguna \"Irwan Purnama, S.Pd., M.Pd.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:51:33', '2026-06-28 10:51:33'),
(71, 1279, 'AUTH', 'Pengguna \"Irwan Purnama, S.Pd., M.Pd.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:52:22', '2026-06-28 10:52:22'),
(72, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:53:10', '2026-06-28 10:53:10'),
(73, 1278, 'ASSIGNMENT', 'Membuat materi baru: Materi Pertemuan 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:55:46', '2026-06-28 10:55:46'),
(74, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:56:29', '2026-06-28 10:56:29'),
(75, 616, 'AUTH', 'Pengguna \"Budi Dewi\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:56:47', '2026-06-28 10:56:47'),
(76, 616, 'AUTH', 'Pengguna \"Budi Dewi\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:57:23', '2026-06-28 10:57:23'),
(77, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:57:30', '2026-06-28 10:57:30'),
(78, 6, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:58:03', '2026-06-28 10:58:03'),
(79, 2269, 'AUTH', 'Pengguna \"Fathonah Handayani\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:58:10', '2026-06-28 10:58:10'),
(80, 2269, 'AUTH', 'Pengguna \"Fathonah Handayani\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:58:17', '2026-06-28 10:58:17'),
(81, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:58:24', '2026-06-28 10:58:24'),
(82, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:58:52', '2026-06-28 10:58:52'),
(83, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:59:10', '2026-06-28 10:59:10'),
(84, 6, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:59:26', '2026-06-28 10:59:26'),
(85, 2341, 'AUTH', 'Pengguna \"Ade Hasanah\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 10:59:32', '2026-06-28 10:59:32'),
(86, 2341, 'AUTH', 'Pengguna \"Ade Hasanah\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:03:33', '2026-06-28 11:03:33'),
(87, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:03:40', '2026-06-28 11:03:40'),
(88, 1278, 'ASSIGNMENT', 'Membuat tugas baru: Tugas Pertemuan 2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:06:07', '2026-06-28 11:06:07'),
(89, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:06:34', '2026-06-28 11:06:34'),
(90, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:06:44', '2026-06-28 11:06:44'),
(91, 6, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:07:25', '2026-06-28 11:07:25'),
(92, 654, 'AUTH', 'Pengguna \"Budi Kusuma\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:07:36', '2026-06-28 11:07:36'),
(93, 654, 'AUTH', 'Pengguna \"Budi Kusuma\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:09:30', '2026-06-28 11:09:30'),
(94, 679, 'AUTH', 'Pengguna \"Chandra Rahmawati\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:09:41', '2026-06-28 11:09:41'),
(95, 679, 'AUTH', 'Pengguna \"Chandra Rahmawati\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:09:57', '2026-06-28 11:09:57'),
(96, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:10:04', '2026-06-28 11:10:04'),
(97, 6, 'AUTH', 'Pengguna \"Super Admin\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:10:19', '2026-06-28 11:10:19'),
(98, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:10:26', '2026-06-28 11:10:26'),
(99, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:12:53', '2026-06-28 11:12:53'),
(100, 654, 'AUTH', 'Pengguna \"Budi Kusuma\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:13:03', '2026-06-28 11:13:03'),
(101, 654, 'AUTH', 'Pengguna \"Budi Kusuma\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:13:30', '2026-06-28 11:13:30'),
(102, 679, 'AUTH', 'Pengguna \"Chandra Rahmawati\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:13:39', '2026-06-28 11:13:39'),
(103, 679, 'AUTH', 'Pengguna \"Chandra Rahmawati\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:16:30', '2026-06-28 11:16:30'),
(104, 1278, 'AUTH', 'Pengguna \"Diah Gunawan, S.Pd., M.Si.\" (Peran: guru) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:16:37', '2026-06-28 11:16:37'),
(105, 6, 'AUTH', 'Pengguna \"Super Admin\" (Peran: admin) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:17:48', '2026-06-28 11:17:48'),
(106, 661, 'AUTH', 'Pengguna \"Agus Dewi\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:19:10', '2026-06-28 11:19:10'),
(107, 661, 'ASSIGNMENT', 'Mengumpulkan tugas: Tugas Pertemuan 2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:21:56', '2026-06-28 11:21:56'),
(108, 661, 'AUTH', 'Pengguna \"Agus Dewi\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:22:34', '2026-06-28 11:22:34'),
(109, 653, 'AUTH', 'Pengguna \"Ahmad Siregar\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:22:47', '2026-06-28 11:22:47'),
(110, 653, 'AUTH', 'Pengguna \"Ahmad Siregar\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:24:41', '2026-06-28 11:24:41'),
(111, 661, 'AUTH', 'Pengguna \"Agus Dewi\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:24:53', '2026-06-28 11:24:53'),
(112, 661, 'AUTH', 'Pengguna \"Agus Dewi\" keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:28:05', '2026-06-28 11:28:05'),
(113, 653, 'AUTH', 'Pengguna \"Ahmad Siregar\" (Peran: siswa) berhasil masuk ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-28 11:28:30', '2026-06-28 11:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-gurubind@guru.smansago.com|127.0.0.1', 'i:1;', 1782469018),
('laravel-cache-gurubind@guru.smansago.com|127.0.0.1:timer', 'i:1782469018;', 1782469018),
('laravel-cache-total_students', 'i:401;', 1782645529),
('laravel-cache-total_teachers', 'i:30;', 1782645529);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint UNSIGNED NOT NULL,
  `submission_id` bigint UNSIGNED DEFAULT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `type` enum('assignment','quiz','midterm','final') NOT NULL DEFAULT 'assignment',
  `score` decimal(5,2) NOT NULL,
  `max_score` int NOT NULL DEFAULT '100',
  `feedback` text,
  `graded_by` bigint UNSIGNED NOT NULL,
  `graded_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `submission_id`, `subject_id`, `student_id`, `type`, `score`, `max_score`, `feedback`, `graded_by`, `graded_at`, `created_at`, `updated_at`) VALUES
(2, 1, 8, 1, 'assignment', 88.00, 100, 'Selesai dikoreksi.', 121, '2026-06-27 23:01:10', '2026-06-27 16:01:10', '2026-06-27 16:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `specialization_id` bigint UNSIGNED DEFAULT NULL,
  `allowed_grades` json DEFAULT NULL,
  `spesialisasi` varchar(255) DEFAULT NULL,
  `alamat` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pengguna_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama`, `email`, `no_hp`, `specialization_id`, `allowed_grades`, `spesialisasi`, `alamat`, `status`, `created_at`, `updated_at`, `pengguna_id`) VALUES
(121, '197610162010122798', 'Diah Gunawan, S.Pd., M.Si.', 'diah.2798@guru.smansago.com', NULL, 7, '[\"X\", \"XI\", \"XII\"]', 'Pendidikan Agama & Budi Pekerti', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1278),
(122, '199512192005111578', 'Irwan Purnama, S.Pd., M.Pd.', 'irwan.1578@guru.smansago.com', NULL, 10, '[\"X\", \"XI\", \"XII\"]', 'Pendidikan Pancasila & Kewarganegaraan (PPKn)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1279),
(123, '198512242014111187', 'Hendra Nugroho, S.Pd., M.Pd.', 'hendra.1187@guru.smansago.com', NULL, 5, '[\"X\", \"XI\", \"XII\"]', 'Bahasa Indonesia', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1280),
(124, '199111192007122764', 'Diah Gunawan, S.Pd., M.Si.', 'diah.2764@guru.smansago.com', NULL, 15, '[\"X\", \"XI\", \"XII\"]', 'Matematika (Wajib)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1281),
(125, '197611202007112199', 'Yuli Setiawan, S.Pd.', 'yuli.2199@guru.smansago.com', NULL, 17, '[\"X\", \"XI\", \"XII\"]', 'Sejarah Indonesia (Wajib)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1282),
(126, '198511182013101195', 'Anwar Gunawan, S.Pd., M.Pd.', 'anwar.1195@guru.smansago.com', NULL, 20, '[\"X\", \"XI\", \"XII\"]', 'Bahasa Inggris (Wajib)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1283),
(127, '198011162009112617', 'Nining Sudarsono, S.Pd., M.Si.', 'nining.2617@guru.smansago.com', NULL, 23, '[\"X\", \"XI\", \"XII\"]', 'Seni Budaya', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1284),
(128, '198710122009112420', 'Ani Purnama, S.Pd., M.Si.', 'ani.2420@guru.smansago.com', NULL, 26, '[\"X\", \"XI\", \"XII\"]', 'Pendidikan Jasmani, Olahraga & Kesehatan (PJOK)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1285),
(129, '198210252016111356', 'Taufik Prasetyo, S.Si.', 'taufik.1356@guru.smansago.com', NULL, 29, '[\"X\", \"XI\", \"XII\"]', 'Matematika Peminatan', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1286),
(130, '198010212006101991', 'Irwan Gunawan, S.Si., M.Pd.', 'irwan.1991@guru.smansago.com', NULL, 2, '[\"X\", \"XI\", \"XII\"]', 'Fisika', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1287),
(131, '198410112007112828', 'Eni Rahardjo, S.Pd., M.Pd.', 'eni.2828@guru.smansago.com', NULL, 3, '[\"X\", \"XI\", \"XII\"]', 'Kimia', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1288),
(132, '198812232017102388', 'Nining Kusumo, S.Pd., M.Pd.', 'nining.2388@guru.smansago.com', NULL, 36, '[\"X\", \"XI\", \"XII\"]', 'Biologi', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1289),
(133, '198012122005112656', 'Dewi Mulyadi, S.Pd., M.Si.', 'dewi.2656@guru.smansago.com', NULL, 39, '[\"X\", \"XI\", \"XII\"]', 'Ekonomi & Akuntansi', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1290),
(134, '198212222014111561', 'Irwan Subagyo, S.Si., M.Pd.', 'irwan.1561@guru.smansago.com', NULL, 42, '[\"X\", \"XI\", \"XII\"]', 'Sosiologi', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1291),
(135, '198012102017102592', 'Yuli Purnama, S.S.', 'yuli.2592@guru.smansago.com', NULL, 45, '[\"X\", \"XI\", \"XII\"]', 'Geografi', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1292),
(136, '199510142011112236', 'Nining Wibowo, S.Pd., M.Si.', 'nining.2236@guru.smansago.com', NULL, 48, '[\"X\", \"XI\", \"XII\"]', 'Sejarah Peminatan', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1293),
(137, '197210172005121817', 'Toto Susanto, S.Pd.', 'toto.1817@guru.smansago.com', NULL, 51, '[\"X\", \"XI\", \"XII\"]', 'Prakarya & Kewirausahaan (PKWU)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1294),
(138, '199511132010102244', 'Sri Sudarsono, S.S.', 'sri.2244@guru.smansago.com', NULL, 7, '[\"X\", \"XI\", \"XII\"]', 'Pendidikan Agama & Budi Pekerti', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1295),
(139, '198612192013121769', 'Rudi Purnama, S.Si., M.Pd.', 'rudi.1769@guru.smansago.com', NULL, 10, '[\"X\", \"XI\", \"XII\"]', 'Pendidikan Pancasila & Kewarganegaraan (PPKn)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1296),
(140, '198312142015102295', 'Siti Subagyo, S.Pd., M.Pd.', 'siti.2295@guru.smansago.com', NULL, 5, '[\"X\", \"XI\", \"XII\"]', 'Bahasa Indonesia', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1297),
(141, '198011172009101202', 'Agus Sudarsono, S.Si., M.Pd.', 'agus.1202@guru.smansago.com', NULL, 15, '[\"X\", \"XI\", \"XII\"]', 'Matematika (Wajib)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1298),
(142, '197811122011102485', 'Eni Subagyo, S.Pd., M.Si.', 'eni.2485@guru.smansago.com', NULL, 17, '[\"X\", \"XI\", \"XII\"]', 'Sejarah Indonesia (Wajib)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1299),
(143, '199210112010102936', 'Ika Rahardjo, S.Pd., M.Pd.', 'ika.2936@guru.smansago.com', NULL, 20, '[\"X\", \"XI\", \"XII\"]', 'Bahasa Inggris (Wajib)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1300),
(144, '197010182014111795', 'Irwan Hartono, S.Pd., M.Pd.', 'irwan.1795@guru.smansago.com', NULL, 23, '[\"X\", \"XI\", \"XII\"]', 'Seni Budaya', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1301),
(145, '197711252014101347', 'Yusuf Rahardjo, S.Si.', 'yusuf.1347@guru.smansago.com', NULL, 26, '[\"X\", \"XI\", \"XII\"]', 'Pendidikan Jasmani, Olahraga & Kesehatan (PJOK)', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1302),
(146, '197711172017112176', 'Yuli Gunawan, S.S.', 'yuli.2176@guru.smansago.com', NULL, 29, '[\"X\", \"XI\", \"XII\"]', 'Matematika Peminatan', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1303),
(147, '198111252018101134', 'Aris Hidayat, S.Si., M.Pd.', 'aris.1134@guru.smansago.com', NULL, 2, '[\"X\", \"XI\", \"XII\"]', 'Fisika', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1304),
(148, '199411272007121774', 'Agus Nugroho, S.Pd.', 'agus.1774@guru.smansago.com', NULL, 3, '[\"X\", \"XI\", \"XII\"]', 'Kimia', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1305),
(149, '198110132011122358', 'Wahyuni Setiawan, S.Pd., M.Si.', 'wahyuni.2358@guru.smansago.com', NULL, 36, '[\"X\", \"XI\", \"XII\"]', 'Biologi', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1306),
(150, '197910192009112725', 'Retno Mulyadi, S.Pd., M.Pd.', 'retno.2725@guru.smansago.com', NULL, 39, '[\"X\", \"XI\", \"XII\"]', 'Ekonomi & Akuntansi', NULL, 'aktif', '2026-06-25 16:41:14', '2026-06-27 10:54:30', 1307);

-- --------------------------------------------------------

--
-- Table structure for table `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru_kelas`
--

INSERT INTO `guru_kelas` (`id`, `guru_id`, `kelas_id`, `mata_pelajaran_id`, `created_at`, `updated_at`) VALUES
(729, 138, 1, 7, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(730, 121, 2, 7, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(731, 138, 3, 7, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(732, 121, 4, 7, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(733, 138, 5, 7, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(734, 121, 6, 7, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(735, 138, 7, 7, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(736, 121, 8, 7, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(737, 122, 1, 10, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(738, 139, 2, 10, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(739, 122, 3, 10, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(740, 139, 4, 10, '2026-06-27 03:04:55', '2026-06-27 03:04:55'),
(741, 122, 5, 10, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(742, 139, 6, 10, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(743, 122, 7, 10, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(744, 139, 8, 10, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(745, 123, 1, 5, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(746, 140, 2, 5, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(747, 123, 3, 5, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(748, 140, 4, 5, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(749, 123, 5, 5, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(750, 140, 6, 5, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(751, 123, 7, 5, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(752, 140, 8, 5, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(753, 124, 9, 15, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(754, 141, 10, 15, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(755, 124, 11, 15, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(756, 141, 12, 15, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(757, 124, 13, 15, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(758, 141, 14, 15, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(759, 124, 15, 15, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(760, 141, 16, 15, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(761, 142, 1, 17, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(762, 125, 2, 17, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(763, 142, 3, 17, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(764, 125, 4, 17, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(765, 142, 5, 17, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(766, 125, 6, 17, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(767, 142, 7, 17, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(768, 125, 8, 17, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(769, 126, 1, 20, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(770, 143, 2, 20, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(771, 126, 3, 20, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(772, 143, 4, 20, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(773, 126, 5, 20, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(774, 143, 6, 20, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(775, 126, 7, 20, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(776, 143, 8, 20, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(777, 127, 1, 23, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(778, 144, 2, 23, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(779, 127, 3, 23, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(780, 144, 4, 23, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(781, 127, 5, 23, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(782, 144, 6, 23, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(783, 127, 7, 23, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(784, 144, 8, 23, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(785, 145, 1, 26, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(786, 128, 2, 26, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(787, 145, 3, 26, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(788, 128, 4, 26, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(789, 145, 5, 26, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(790, 128, 6, 26, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(791, 145, 7, 26, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(792, 128, 8, 26, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(793, 129, 1, 29, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(794, 146, 2, 29, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(795, 129, 3, 29, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(796, 146, 4, 29, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(797, 147, 1, 2, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(798, 130, 2, 2, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(799, 147, 3, 2, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(800, 130, 4, 2, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(801, 131, 1, 3, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(802, 148, 2, 3, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(803, 131, 3, 3, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(804, 148, 4, 3, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(805, 132, 1, 36, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(806, 149, 2, 36, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(807, 132, 3, 36, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(808, 149, 4, 36, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(809, 133, 5, 39, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(810, 150, 6, 39, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(811, 133, 7, 39, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(812, 150, 8, 39, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(813, 134, 5, 42, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(814, 134, 6, 42, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(815, 134, 7, 42, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(816, 134, 8, 42, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(817, 135, 5, 45, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(818, 135, 6, 45, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(819, 135, 7, 45, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(820, 135, 8, 45, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(821, 136, 5, 48, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(822, 136, 6, 48, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(823, 136, 7, 48, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(824, 136, 8, 48, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(825, 137, 1, 51, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(826, 137, 2, 51, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(827, 137, 3, 51, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(828, 137, 4, 51, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(829, 137, 5, 51, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(830, 137, 6, 51, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(831, 137, 7, 51, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(832, 137, 8, 51, '2026-06-27 03:04:56', '2026-06-27 03:04:56'),
(937, 124, 49, 1, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(938, 141, 50, 1, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(939, 124, 51, 1, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(940, 141, 52, 1, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(941, 124, 53, 1, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(942, 141, 54, 1, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(943, 124, 55, 1, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(944, 141, 56, 1, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(945, 130, 49, 2, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(946, 147, 50, 2, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(947, 130, 51, 2, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(948, 147, 52, 2, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(949, 131, 49, 3, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(950, 148, 50, 3, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(951, 131, 51, 3, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(952, 148, 52, 3, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(953, 123, 49, 5, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(954, 140, 50, 5, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(955, 123, 51, 5, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(956, 140, 52, 5, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(957, 123, 53, 5, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(958, 140, 54, 5, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(959, 123, 55, 5, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(960, 140, 56, 5, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(961, 121, 49, 7, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(962, 138, 50, 7, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(963, 121, 51, 7, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(964, 138, 52, 7, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(965, 121, 53, 7, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(966, 138, 54, 7, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(967, 121, 55, 7, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(968, 138, 56, 7, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(969, 121, 57, 8, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(970, 138, 58, 8, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(971, 121, 59, 8, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(972, 138, 60, 8, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(973, 121, 61, 8, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(974, 138, 62, 8, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(975, 121, 63, 8, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(976, 138, 64, 8, '2026-06-27 12:54:48', '2026-06-27 12:54:48'),
(977, 121, 65, 9, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(978, 138, 66, 9, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(979, 139, 49, 10, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(980, 122, 50, 10, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(981, 139, 51, 10, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(982, 122, 52, 10, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(983, 139, 53, 10, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(984, 122, 54, 10, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(985, 139, 55, 10, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(986, 122, 56, 10, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(987, 139, 57, 11, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(988, 122, 58, 11, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(989, 139, 59, 11, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(990, 122, 60, 11, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(991, 139, 61, 11, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(992, 122, 62, 11, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(993, 139, 63, 11, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(994, 122, 64, 11, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(995, 139, 65, 12, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(996, 122, 66, 12, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(997, 139, 67, 12, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(998, 123, 57, 13, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(999, 140, 58, 13, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1000, 123, 59, 13, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1001, 140, 60, 13, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1002, 123, 61, 13, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1003, 140, 62, 13, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1004, 123, 63, 13, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1005, 140, 64, 13, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1006, 123, 65, 14, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1007, 140, 66, 14, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1008, 123, 67, 14, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1009, 124, 57, 15, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1010, 141, 58, 15, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1011, 124, 59, 15, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1012, 141, 60, 15, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1013, 124, 61, 15, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1014, 141, 62, 15, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1015, 124, 63, 15, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1016, 141, 64, 15, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1017, 124, 65, 16, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1018, 141, 66, 16, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1019, 125, 49, 17, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1020, 142, 50, 17, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1021, 125, 51, 17, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1022, 142, 52, 17, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1023, 125, 53, 17, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1024, 142, 54, 17, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1025, 125, 55, 17, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1026, 142, 56, 17, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1027, 125, 57, 18, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1028, 142, 58, 18, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1029, 125, 59, 18, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1030, 142, 60, 18, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1031, 125, 61, 18, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1032, 142, 62, 18, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1033, 125, 63, 18, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1034, 142, 64, 18, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1035, 125, 65, 19, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1036, 142, 66, 19, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1037, 126, 49, 20, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1038, 143, 50, 20, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1039, 126, 51, 20, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1040, 143, 52, 20, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1041, 126, 53, 20, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1042, 143, 54, 20, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1043, 126, 55, 20, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1044, 143, 56, 20, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1045, 126, 57, 21, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1046, 143, 58, 21, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1047, 126, 59, 21, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1048, 143, 60, 21, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1049, 126, 61, 21, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1050, 143, 62, 21, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1051, 126, 63, 21, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1052, 143, 64, 21, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1053, 126, 65, 22, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1054, 143, 66, 22, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1055, 126, 67, 22, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1056, 127, 49, 23, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1057, 144, 50, 23, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1058, 127, 51, 23, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1059, 144, 52, 23, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1060, 127, 53, 23, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1061, 144, 54, 23, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1062, 127, 55, 23, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1063, 144, 56, 23, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1064, 127, 57, 24, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1065, 144, 58, 24, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1066, 127, 59, 24, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1067, 144, 60, 24, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1068, 127, 61, 24, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1069, 144, 62, 24, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1070, 127, 63, 24, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1071, 144, 64, 24, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1072, 127, 65, 25, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1073, 144, 66, 25, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1074, 145, 49, 26, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1075, 128, 50, 26, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1076, 145, 51, 26, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1077, 128, 52, 26, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1078, 145, 53, 26, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1079, 128, 54, 26, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1080, 145, 55, 26, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1081, 128, 56, 26, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1082, 145, 57, 27, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1083, 128, 58, 27, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1084, 145, 59, 27, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1085, 128, 60, 27, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1086, 145, 61, 27, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1087, 128, 62, 27, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1088, 145, 63, 27, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1089, 128, 64, 27, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1090, 145, 65, 28, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1091, 128, 66, 28, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1092, 145, 67, 28, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1093, 129, 49, 29, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1094, 146, 50, 29, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1095, 129, 51, 29, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1096, 146, 52, 29, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1097, 129, 57, 30, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1098, 146, 58, 30, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1099, 129, 59, 30, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1100, 146, 60, 30, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1101, 129, 65, 31, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1102, 146, 66, 31, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1103, 129, 67, 31, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1104, 146, 68, 31, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1105, 130, 57, 32, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1106, 147, 58, 32, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1107, 130, 59, 32, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1108, 147, 60, 32, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1109, 130, 65, 33, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1110, 147, 66, 33, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1111, 130, 67, 33, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1112, 147, 68, 33, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1113, 131, 57, 34, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1114, 148, 58, 34, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1115, 131, 59, 34, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1116, 148, 60, 34, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1117, 131, 65, 35, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1118, 148, 66, 35, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1119, 131, 67, 35, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1120, 148, 68, 35, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1121, 132, 49, 36, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1122, 149, 50, 36, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1123, 132, 51, 36, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1124, 149, 52, 36, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1125, 132, 57, 37, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1126, 149, 58, 37, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1127, 132, 59, 37, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1128, 149, 60, 37, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1129, 132, 65, 38, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1130, 149, 66, 38, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1131, 132, 67, 38, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1132, 149, 68, 38, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1133, 133, 53, 39, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1134, 150, 54, 39, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1135, 133, 55, 39, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1136, 150, 56, 39, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1137, 133, 61, 40, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1138, 150, 62, 40, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1139, 133, 63, 40, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1140, 150, 64, 40, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1141, 133, 69, 41, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1142, 150, 70, 41, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1143, 133, 71, 41, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1144, 150, 72, 41, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1145, 134, 53, 42, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1146, 134, 54, 42, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1147, 134, 55, 42, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1148, 134, 56, 42, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1149, 134, 61, 43, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1150, 134, 62, 43, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1151, 134, 63, 43, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1152, 134, 64, 43, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1153, 134, 69, 44, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1154, 134, 70, 44, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1155, 135, 53, 45, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1156, 135, 54, 45, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1157, 135, 55, 45, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1158, 135, 56, 45, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1159, 135, 61, 46, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1160, 135, 62, 46, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1161, 135, 63, 46, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1162, 135, 64, 46, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1163, 135, 69, 47, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1164, 136, 53, 48, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1165, 136, 54, 48, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1166, 136, 55, 48, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1167, 136, 56, 48, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1168, 136, 61, 49, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1169, 136, 62, 49, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1170, 136, 63, 49, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1171, 136, 64, 49, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1172, 136, 69, 50, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1173, 137, 49, 51, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1174, 137, 50, 51, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1175, 137, 51, 51, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1176, 137, 52, 51, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1177, 137, 53, 51, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1178, 137, 54, 51, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1179, 137, 55, 51, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1180, 137, 56, 51, '2026-06-27 12:54:49', '2026-06-27 12:54:49'),
(1181, 137, 57, 52, '2026-06-27 12:54:49', '2026-06-27 12:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `grade_level` enum('X','XI','XII') NOT NULL,
  `major` enum('IPA','IPS') NOT NULL,
  `homeroom_teacher_id` bigint UNSIGNED DEFAULT NULL,
  `academic_year` varchar(255) NOT NULL,
  `max_students` int NOT NULL DEFAULT '40',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `name`, `grade_level`, `major`, `homeroom_teacher_id`, `academic_year`, `max_students`, `created_at`, `updated_at`) VALUES
(1, 'X IPA 1', 'X', 'IPA', 131, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(2, 'X IPA 2', 'X', 'IPA', 133, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(3, 'X IPA 3', 'X', 'IPA', 123, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(4, 'X IPA 4', 'X', 'IPA', 126, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(5, 'X IPS 1', 'X', 'IPS', 149, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(6, 'X IPS 2', 'X', 'IPS', 121, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(7, 'X IPS 3', 'X', 'IPS', 141, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(8, 'X IPS 4', 'X', 'IPS', 148, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(9, 'XI IPA 1', 'XI', 'IPA', 125, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(10, 'XI IPA 2', 'XI', 'IPA', 136, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(11, 'XI IPA 3', 'XI', 'IPA', 128, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(12, 'XI IPA 4', 'XI', 'IPA', 150, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(13, 'XI IPS 1', 'XI', 'IPS', 144, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(14, 'XI IPS 2', 'XI', 'IPS', 146, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(15, 'XI IPS 3', 'XI', 'IPS', 129, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(16, 'XI IPS 4', 'XI', 'IPS', 127, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(17, 'XII IPA 1', 'XII', 'IPA', 140, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(18, 'XII IPA 2', 'XII', 'IPA', 130, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(19, 'XII IPA 3', 'XII', 'IPA', 134, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(20, 'XII IPA 4', 'XII', 'IPA', 143, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(21, 'XII IPS 1', 'XII', 'IPS', 135, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(22, 'XII IPS 2', 'XII', 'IPS', 139, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(23, 'XII IPS 3', 'XII', 'IPS', 132, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(24, 'XII IPS 4', 'XII', 'IPS', 137, '2025/2026', 40, '2026-06-25 16:26:50', '2026-06-25 19:07:44'),
(49, 'X IPA 1', 'X', 'IPA', 144, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(50, 'X IPA 2', 'X', 'IPA', 148, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(51, 'X IPA 3', 'X', 'IPA', 124, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(52, 'X IPA 4', 'X', 'IPA', 147, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(53, 'X IPS 1', 'X', 'IPS', 131, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(54, 'X IPS 2', 'X', 'IPS', 140, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(55, 'X IPS 3', 'X', 'IPS', 136, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(56, 'X IPS 4', 'X', 'IPS', 129, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(57, 'XI IPA 1', 'XI', 'IPA', 133, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(58, 'XI IPA 2', 'XI', 'IPA', 121, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(59, 'XI IPA 3', 'XI', 'IPA', 128, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(60, 'XI IPA 4', 'XI', 'IPA', 146, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(61, 'XI IPS 1', 'XI', 'IPS', 135, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(62, 'XI IPS 2', 'XI', 'IPS', 137, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(63, 'XI IPS 3', 'XI', 'IPS', 141, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(64, 'XI IPS 4', 'XI', 'IPS', 138, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(65, 'XII IPA 1', 'XII', 'IPA', 150, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(66, 'XII IPA 2', 'XII', 'IPA', 125, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(67, 'XII IPA 3', 'XII', 'IPA', 122, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(68, 'XII IPA 4', 'XII', 'IPA', 142, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(69, 'XII IPS 1', 'XII', 'IPS', 143, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(70, 'XII IPS 2', 'XII', 'IPS', 149, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(71, 'XII IPS 3', 'XII', 'IPS', 127, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02'),
(72, 'XII IPS 4', 'XII', 'IPS', 132, '2026/2027', 40, '2026-06-27 03:33:20', '2026-06-27 10:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text,
  `tingkat` enum('X','XI','XII') DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `kode`, `nama`, `deskripsi`, `tingkat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MTK-X', 'Matematika X', 'Matematika Wajib Kelas X', 'X', 'aktif', '2026-06-06 22:14:28', '2026-06-06 22:14:28'),
(2, 'FIS-X', 'Fisika X', 'Fisika Kelas X', 'X', 'aktif', '2026-06-06 22:14:28', '2026-06-06 22:14:28'),
(3, 'KIM-X', 'Kimia X', 'Kimia Kelas X', 'X', 'aktif', '2026-06-06 22:14:28', '2026-06-06 22:14:28'),
(4, 'TIK-X', 'TIK 1', 'Teknologi Informasi dan Komunikasi 1', 'X', 'aktif', '2026-06-19 11:16:33', '2026-06-19 11:16:33'),
(5, 'BINDX', 'Bahasa Indonesia X', 'Bahasa Indonesia Kelas X', 'X', 'aktif', '2026-06-19 11:16:33', '2026-06-19 11:16:33'),
(6, 'TIK-XI', 'TIK LANJUTAN', 'TIK Lanjutan Kelas XI', 'XI', 'aktif', '2026-06-19 11:16:33', '2026-06-19 11:16:33'),
(7, 'AGM-X', 'Pendidikan Agama & Budi Pekerti X', 'Pendidikan keagamaan dan pembentukan karakter moral sesuai keyakinan masing-masing.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(8, 'AGM-XI', 'Pendidikan Agama & Budi Pekerti XI', 'Pendidikan keagamaan dan pembentukan karakter moral sesuai keyakinan masing-masing.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(9, 'AGM-XII', 'Pendidikan Agama & Budi Pekerti XII', 'Pendidikan keagamaan dan pembentukan karakter moral sesuai keyakinan masing-masing.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(10, 'PPKN-X', 'Pendidikan Pancasila & Kewarganegaraan (PPKn) X', 'Ideologi negara, konstitusi, hak & kewajiban warga negara, serta wawasan kebangsaan.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(11, 'PPKN-XI', 'Pendidikan Pancasila & Kewarganegaraan (PPKn) XI', 'Ideologi negara, konstitusi, hak & kewajiban warga negara, serta wawasan kebangsaan.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(12, 'PPKN-XII', 'Pendidikan Pancasila & Kewarganegaraan (PPKn) XII', 'Ideologi negara, konstitusi, hak & kewajiban warga negara, serta wawasan kebangsaan.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(13, 'BIND-XI', 'Bahasa Indonesia XI', 'Keterampilan berbahasa, apresiasi sastra, teks eksposisi, editorial, laporan, dan karya ilmiah.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(14, 'BIND-XII', 'Bahasa Indonesia XII', 'Keterampilan berbahasa, apresiasi sastra, teks eksposisi, editorial, laporan, dan karya ilmiah.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(15, 'MTK-XI', 'Matematika (Wajib) XI', 'Materi dasar: Aljabar, statistika dasar, peluang, fungsi, matriks, dan geometri dasar.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(16, 'MTK-XII', 'Matematika (Wajib) XII', 'Materi dasar: Aljabar, statistika dasar, peluang, fungsi, matriks, dan geometri dasar.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(17, 'SEJ-X', 'Sejarah Indonesia (Wajib) X', 'Perjalanan sejarah bangsa dari masa praaksara, kerajaan nusantara, kolonialisme, hingga reformasi.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(18, 'SEJ-XI', 'Sejarah Indonesia (Wajib) XI', 'Perjalanan sejarah bangsa dari masa praaksara, kerajaan nusantara, kolonialisme, hingga reformasi.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(19, 'SEJ-XII', 'Sejarah Indonesia (Wajib) XII', 'Perjalanan sejarah bangsa dari masa praaksara, kerajaan nusantara, kolonialisme, hingga reformasi.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(20, 'BIG-X', 'Bahasa Inggris (Wajib) X', 'Pemahaman teks fungsional, teks transaksional, tata bahasa inggris dasar-menengah, dan percakapan.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(21, 'BIG-XI', 'Bahasa Inggris (Wajib) XI', 'Pemahaman teks fungsional, teks transaksional, tata bahasa inggris dasar-menengah, dan percakapan.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(22, 'BIG-XII', 'Bahasa Inggris (Wajib) XII', 'Pemahaman teks fungsional, teks transaksional, tata bahasa inggris dasar-menengah, dan percakapan.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(23, 'SENI-X', 'Seni Budaya X', 'Apresiasi dan praktik seni (Pilihan sekolah: Seni Rupa, Seni Musik, Tari, atau Teater).', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(24, 'SENI-XI', 'Seni Budaya XI', 'Apresiasi dan praktik seni (Pilihan sekolah: Seni Rupa, Seni Musik, Tari, atau Teater).', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(25, 'SENI-XII', 'Seni Budaya XII', 'Apresiasi dan praktik seni (Pilihan sekolah: Seni Rupa, Seni Musik, Tari, atau Teater).', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(26, 'PJOK-X', 'Pendidikan Jasmani, Olahraga & Kesehatan (PJOK) X', 'Praktik olahraga, kebugaran jasmani, kesehatan reproduksi, dan pola hidup sehat.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(27, 'PJOK-XI', 'Pendidikan Jasmani, Olahraga & Kesehatan (PJOK) XI', 'Praktik olahraga, kebugaran jasmani, kesehatan reproduksi, dan pola hidup sehat.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(28, 'PJOK-XII', 'Pendidikan Jasmani, Olahraga & Kesehatan (PJOK) XII', 'Praktik olahraga, kebugaran jasmani, kesehatan reproduksi, dan pola hidup sehat.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(29, 'MTKP-X', 'Matematika Peminatan X', 'Materi tingkat lanjut: Trigonometri kompleks, vektor, polinomial, dan kalkulus (limit, turunan, integral).', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(30, 'MTKP-XI', 'Matematika Peminatan XI', 'Materi tingkat lanjut: Trigonometri kompleks, vektor, polinomial, dan kalkulus (limit, turunan, integral).', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(31, 'MTKP-XII', 'Matematika Peminatan XII', 'Materi tingkat lanjut: Trigonometri kompleks, vektor, polinomial, dan kalkulus (limit, turunan, integral).', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(32, 'FIS-XI', 'Fisika XI', 'Studi energi dan materi: Mekanika, termodinamika, gelombang, optik, listrik, magnet, dan fisika modern.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(33, 'FIS-XII', 'Fisika XII', 'Studi energi dan materi: Mekanika, termodinamika, gelombang, optik, listrik, magnet, dan fisika modern.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(34, 'KIM-XI', 'Kimia XI', 'Struktur materi, tabel periodik, stoikiometri (hitungan kimia), termokimia, asam-basa, dan kimia karbon.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(35, 'KIM-XII', 'Kimia XII', 'Struktur materi, tabel periodik, stoikiometri (hitungan kimia), termokimia, asam-basa, dan kimia karbon.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(36, 'BIO-X', 'Biologi X', 'Makhluk hidup & lingkungan: Tingkat sel, jaringan, anatomi manusia/hewan, genetika, ekosistem, dan evolusi.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(37, 'BIO-XI', 'Biologi XI', 'Makhluk hidup & lingkungan: Tingkat sel, jaringan, anatomi manusia/hewan, genetika, ekosistem, dan evolusi.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(38, 'BIO-XII', 'Biologi XII', 'Makhluk hidup & lingkungan: Tingkat sel, jaringan, anatomi manusia/hewan, genetika, ekosistem, dan evolusi.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(39, 'EKO-X', 'Ekonomi & Akuntansi X', 'Mekanisme pasar, manajemen, kebijakan moneter, perdagangan internasional, dan siklus akuntansi perusahaan.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(40, 'EKO-XI', 'Ekonomi & Akuntansi XI', 'Mekanisme pasar, manajemen, kebijakan moneter, perdagangan internasional, dan siklus akuntansi perusahaan.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(41, 'EKO-XII', 'Ekonomi & Akuntansi XII', 'Mekanisme pasar, manajemen, kebijakan moneter, perdagangan internasional, dan siklus akuntansi perusahaan.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(42, 'SOS-X', 'Sosiologi X', 'Struktur sosial, interaksi sosial, konflik masyarakat, perubahan sosial, dan pemberdayaan komunitas.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(43, 'SOS-XI', 'Sosiologi XI', 'Struktur sosial, interaksi sosial, konflik masyarakat, perubahan sosial, dan pemberdayaan komunitas.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(44, 'SOS-XII', 'Sosiologi XII', 'Struktur sosial, interaksi sosial, konflik masyarakat, perubahan sosial, dan pemberdayaan komunitas.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(45, 'GEO-X', 'Geografi X', 'Fenomena geosfer (iklim, litosfer, hidrosfer), pemetaan/SIG, kependudukan, dan ketahanan pangan nasional.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(46, 'GEO-XI', 'Geografi XI', 'Fenomena geosfer (iklim, litosfer, hidrosfer), pemetaan/SIG, kependudukan, dan ketahanan pangan nasional.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(47, 'GEO-XII', 'Geografi XII', 'Fenomena geosfer (iklim, litosfer, hidrosfer), pemetaan/SIG, kependudukan, dan ketahanan pangan nasional.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(48, 'SEJP-X', 'Sejarah Peminatan X', 'Kajian mendalam sejarah dunia: Peradaban kuno, Perang Dunia I & II, Perang Dingin, dan sejarah kontemporer.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(49, 'SEJP-XI', 'Sejarah Peminatan XI', 'Kajian mendalam sejarah dunia: Peradaban kuno, Perang Dunia I & II, Perang Dingin, dan sejarah kontemporer.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(50, 'SEJP-XII', 'Sejarah Peminatan XII', 'Kajian mendalam sejarah dunia: Peradaban kuno, Perang Dunia I & II, Perang Dingin, dan sejarah kontemporer.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(51, 'PRAK-X', 'Prakarya & Kewirausahaan (PKWU) X', 'Pengembangan kreativitas produk, pengolahan makanan daerah, budidaya, dan dasar-dasar bisnis/wirausaha.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(52, 'PRAK-XI', 'Prakarya & Kewirausahaan (PKWU) XI', 'Pengembangan kreativitas produk, pengolahan makanan daerah, budidaya, dan dasar-dasar bisnis/wirausaha.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(53, 'PRAK-XII', 'Prakarya & Kewirausahaan (PKWU) XII', 'Pengembangan kreativitas produk, pengolahan makanan daerah, budidaya, dan dasar-dasar bisnis/wirausaha.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(54, 'LML-X', 'Lintas Minat / Muatan Lokal X', 'Pendalaman materi lintas jurusan (misal anak IPA belajar Ekonomi) atau materi budaya khas daerah.', 'X', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(55, 'LML-XI', 'Lintas Minat / Muatan Lokal XI', 'Pendalaman materi lintas jurusan (misal anak IPA belajar Ekonomi) atau materi budaya khas daerah.', 'XI', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50'),
(56, 'LML-XII', 'Lintas Minat / Muatan Lokal XII', 'Pendalaman materi lintas jurusan (misal anak IPA belajar Ekonomi) atau materi budaya khas daerah.', 'XII', 'aktif', '2026-06-25 16:26:50', '2026-06-25 16:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('pdf','video','link','document','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'document',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `subject_id`, `title`, `description`, `type`, `file_path`, `url`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(1, 7, 'Materi Pertemuan 1', 'Deskripsi\r\nMateri ini membahas peran manusia sebagai hamba Allah dan khalifah di bumi menurut ajaran Islam. Peserta didik akan mempelajari tujuan penciptaan manusia, tanggung jawab sebagai seorang muslim, serta penerapan nilai-nilai tersebut dalam kehidupan sehari-hari melalui sikap yang berakhlak mulia, bertanggung jawab, dan peduli terhadap lingkungan.', 'pdf', 'materi/icEdMDrBxZ5A5mNXTqAC1YX9CY1uE01Nw99Hs5Cd.pdf', NULL, 121, '2026-06-28 10:49:46', '2026-06-28 10:50:53'),
(2, 9, 'Materi Pertemuan 1', 'Materi ini membahas pengertian qada dan qadar, hubungan antara ikhtiar, doa, dan tawakal, serta hikmah beriman kepada ketetapan Allah Swt. Setelah mempelajari materi ini, peserta didik diharapkan mampu menerapkan sikap optimis, sabar, dan bertanggung jawab dalam kehidupan sehari-hari sesuai dengan nilai-nilai ajaran Islam.', 'pdf', 'materi/zweijVr0c8v5z6VV9jKd9bYCkp9TB3ksH0NMjveH.pdf', NULL, 121, '2026-06-28 10:55:46', '2026-06-28 10:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_06_26_053013_create_activity_logs_table', 1),
(2, '2026_06_26_163615_add_prasyarat_materi_id_to_tugas_table', 2),
(3, '2026_06_26_163617_create_pelacakan_materi_table', 3),
(4, '2026_01_13_033211_create_materials_table', 4),
(5, '2026_06_27_170549_migrate_materi_data_and_update_pelacakan', 4),
(6, '2026_06_27_204149_add_tahun_lulus_to_siswa_table', 5),
(7, '2026_06_21_135225_add_max_score_to_tugas_table', 6),
(8, '2026_01_13_161500_add_type_and_answer_key_to_assignments_table', 7),
(9, '2026_01_27_220648_add_drive_link_to_submissions_table', 8),
(10, '2026_01_28_050640_add_file_details_to_submissions_table', 9),
(11, '2026_05_10_160301_add_native_upload_fields_to_submissions_table', 10);

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
  `status_pemulihan` enum('aktif','selesai','expired') DEFAULT 'aktif',
  `durasi_jam` int DEFAULT '48',
  `tugas_saat_ini` bigint UNSIGNED DEFAULT NULL,
  `mulai_pemulihan` timestamp NULL DEFAULT NULL,
  `batas_pemulihan` timestamp NULL DEFAULT NULL,
  `selesai_pemulihan` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tugas_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_banding`
--

CREATE TABLE `pengajuan_banding` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `alasan` text NOT NULL,
  `status` enum('ditinjau','diterima','ditolak') DEFAULT 'ditinjau',
  `disetujui_oleh` bigint UNSIGNED DEFAULT NULL,
  `tanggal_persetujuan` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tugas_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Pak Budi Santoso', 'budi@guru.smansago.com', '$2y$12$BiP3occJOx.R01Zp820weuBe/nVwhPub0lwU56cVfqWbPHD6Y9F.a', 'guru', '2026-06-06 22:14:27', '2026-06-06 22:14:27'),
(2, 'Ibu Siti Aminah Test', 'siti@guru.smansago.com.test', '$2y$12$FnSw8JLMpDmRvgQ/CHpLy.WX/3JNCGjJMW8Le4PYQOe7ENA7wWra6', 'guru', '2026-06-06 22:14:27', '2026-06-19 02:09:20'),
(3, 'Pak Ahmad Yani', 'ahmad@guru.smansago.com', '$2y$12$hVyaZPRnphAY3W.98.XkseGgDtBVz8h8QOsr4Payw266WZoGyL5xW', 'guru', '2026-06-06 22:14:27', '2026-06-06 22:14:27'),
(4, 'Andi Pratama', 'andi@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-06 22:14:27', '2026-06-06 22:14:27'),
(5, 'Budi Santoso', 'budi@siswa.smansago.com', '$2y$12$FxPPrkCzBn9oC6Qp6mSFqO7ktTDJ9dwjvlh15sGtBaOc/9XhOuVq2', 'siswa', '2026-06-06 22:14:28', '2026-06-06 22:14:28'),
(6, 'Super Admin', 'admin@admin.smansago.com', '$2y$12$LwN6FHA5reNjKdsWLEZpNe2LwgY.szZC7hzuhzWC8OFPfkvfFfWLe', 'admin', '2026-06-06 22:14:28', '2026-06-06 22:14:28'),
(8, 'Staf Tata Usaha', 'tu@admin.smansago.com', '$2y$12$EZhO2283GKr8/9aMMTlUZ.cLdt6TixxI6wkiUTOKX2kiSkvflwOD.', 'admin', '2026-06-19 02:00:19', '2026-06-19 02:00:19'),
(10, 'Wahyu', '2025003@siswa.smansago.com', '$2y$12$9qxXyLvalxdmtpVSmRn8KOsHsOVSftqjVBeVP6cb2ewEyYqMFsGN.', 'siswa', '2026-06-19 10:40:45', '2026-06-19 10:40:45'),
(11, 'homsi', '2025004@siswa.smansago.com', '$2y$12$9DxAspfFXEM6aBTHHZMLaOqfXEncxByJYRKwh4E.2jpwlIMd93p0.', 'siswa', '2026-06-19 10:42:47', '2026-06-19 10:42:47'),
(13, 'Wahyu test dropdown', '2025005@siswa.smansago.com', '$2y$12$pPkpHLDGo80PH/bFSIeFy.Qcd2hh3bBEnJIEACMZxoP0bsbDOnBzi', 'siswa', '2026-06-19 10:59:45', '2026-06-19 10:59:45'),
(14, 'Ilham, S.M', 'ilham@guru.smansago.com', '$2y$12$6WVlOtLDX2/xJwR7GYSfAOYKAwqs2O2Ch/brMRbkbSkuN6.vXcXtG', 'guru', '2026-06-19 11:16:33', '2026-06-19 11:16:33'),
(616, 'Budi Dewi', '3101001001@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(617, 'Lukman Hidayat', '3101001002@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(618, 'Anisa Saputra', '3101001003@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(619, 'Fahmi Setiawan', '3101001004@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(620, 'Chandra Putri', '3101001005@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(621, 'Kevin Purnomo', '3101001006@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(622, 'Muhammad Siregar', '3101001007@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(623, 'Aditya Wulandari', '3101001008@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(624, 'Lukman Budiman', '3101001009@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(625, 'Fahmi Gunawan', '3101001010@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(626, 'Kevin Kusuma', '3101001011@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(627, 'Dewi Wulandari', '3101001012@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(628, 'Fitri Budiman', '3101001013@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(629, 'Aditya Nasution', '3101001014@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(630, 'Hafiz Sari', '3101001015@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(631, 'Chandra Situmorang', '3101001016@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(632, 'Elena Hayati', '3101001017@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(633, 'Naufal Siregar', '3101001018@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(634, 'Satria Putri', '3101001019@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(635, 'Irfan Nugroho', '3101001020@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(636, 'Hendra Pratama', '3101001021@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(637, 'Gita Putri', '3101001022@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(638, 'Eka Nugroho', '3101001023@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(639, 'Dedi Sari', '3101001024@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(640, 'Agus Situmorang', '3101001025@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(641, 'Tania Wulandari', '3101001026@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(642, 'Citra Sari', '3101001027@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(643, 'Rina Budiman', '3101001028@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(644, 'Eka Pratiwi', '3101001029@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(645, 'Dedi Nasution', '3101001030@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(646, 'Rani Saputra', '3101001031@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(647, 'Dinda Wijaya', '3101001032@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(648, 'Lukman Nugroho', '3101001033@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(649, 'Joko Nugroho', '3101001034@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(650, 'Shinta Wulandari', '3101001035@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(651, 'Kevin Gunawan', '3101001036@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(652, 'Gita Ramadhan', '3101001037@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(653, 'Ahmad Siregar', '3101001038@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:40'),
(654, 'Budi Kusuma', '3101001039@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(655, 'Ahmad Utami', '3101001040@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(656, 'Eka Utomo', '3101001041@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(657, 'Fahmi Pratama', '3101001042@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(658, 'Naufal Nugroho', '3101001043@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(659, 'Rian Asturi', '3101001044@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(660, 'Pratiwi Wulandari', '3101001045@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(661, 'Agus Dewi', '3101001046@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(662, 'Rizky Setiawan', '3101001047@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(663, 'Rina Wibowo', '3101001048@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(664, 'Dhea Wulandari', '3101001049@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(665, 'Irfan Lestari', '3101001050@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(666, 'Eko Purnomo', '3101001051@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(667, 'Gita Wijaya', '3101001052@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(668, 'Fitri Pratiwi', '3101001053@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(669, 'Olivia Permata', '3101001054@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(670, 'Rizky Gunawan', '3101001055@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(671, 'Lukman Siregar', '3101001056@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(672, 'Andi Ramadhan', '3101001057@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(673, 'Hafiz Kusuma', '3101001058@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(674, 'Putri Utami', '3101001059@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(675, 'Bambang Asturi', '3101001060@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(676, 'Sari Asturi', '3101001061@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(677, 'Nadia Pratama', '3101001062@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(678, 'Laras Pratiwi', '3101001063@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(679, 'Chandra Rahmawati', '3101001064@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(680, 'Fahmi Setiawan', '3101001065@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(681, 'Gita Kusuma', '3101001066@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(682, 'Rina Budiman', '3101001067@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(683, 'Joko Fitriani', '3101001068@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(684, 'Hendra Hidayat', '3101001069@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(685, 'Ayu Rahmawati', '3101001070@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(686, 'Joko Sari', '3101001071@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(687, 'Gita Pratiwi', '3101001072@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(688, 'Elena Wibowo', '3101001073@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(689, 'Irfan Wibowo', '3101001074@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(690, 'Tania Saputra', '3101001075@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(691, 'Oki Nasution', '3101001076@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(692, 'Indah Wijaya', '3101001077@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(693, 'Sari Asturi', '3101001078@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(694, 'Citra Lestari', '3101001079@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(695, 'Satria Pratiwi', '3101001080@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(696, 'Rendra Purnomo', '3101001081@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(697, 'Dhea Asturi', '3101001082@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(698, 'Rina Amalia', '3101001083@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(699, 'Panji Nugroho', '3101001084@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(700, 'Ayu Fitriani', '3101001085@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(701, 'Budi Asturi', '3101001086@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(702, 'Farida Kusuma', '3101001087@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(703, 'Yanti Ramadhan', '3101001088@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(704, 'Rian Utami', '3101001089@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(705, 'Anisa Hidayat', '3101001090@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(706, 'Olivia Rahmawati', '3101001091@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(707, 'Gita Putri', '3101001092@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(708, 'Siti Ramadhan', '3101001093@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(709, 'Olivia Kusuma', '3101001094@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(710, 'Zahra Wulandari', '3101001095@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(711, 'Zahra Purnomo', '3101001096@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(712, 'Rizky Purnomo', '3101001097@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(713, 'Hafiz Putri', '3101001098@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(714, 'Ayu Setiawan', '3101001099@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(715, 'Pratiwi Budiman', '3101001100@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(716, 'Joko Kusuma', '3101001101@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(717, 'Oki Hayati', '3101001102@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(718, 'Naufal Setiawan', '3101001103@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(719, 'Dani Rahmawati', '3101001104@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(720, 'Olivia Utami', '3101001105@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(721, 'Rani Situmorang', '3101001106@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(722, 'Muhammad Purnomo', '3101001107@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(723, 'Fahmi Utomo', '3101001108@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(724, 'Indah Amalia', '3101001109@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(725, 'Wulan Fitriani', '3101001110@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(726, 'Gita Santoso', '3101001111@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(727, 'Fitri Hayati', '3101001112@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(728, 'Yanti Utomo', '3101001113@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(729, 'Dinda Wibowo', '3101001114@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(730, 'Dedi Utomo', '3101001115@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(731, 'Ahmad Purnomo', '3101001116@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(732, 'Anisa Setiawan', '3101001117@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(733, 'Panji Utami', '3101001118@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(734, 'Siti Nasution', '3101001119@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(735, 'Tania Dewi', '3101001120@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(736, 'Dinda Wibowo', '3101001121@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(737, 'Laras Asturi', '3101001122@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(738, 'Oki Budiman', '3101001123@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(739, 'Utami Putri', '3101001124@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(740, 'Indah Wulandari', '3101001125@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(741, 'Nadia Siregar', '3101001126@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(742, 'Citra Utami', '3101001127@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(743, 'Elena Kusuma', '3101001128@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(744, 'Dinda Sari', '3101001129@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(745, 'Fajar Setiawan', '3101001130@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(746, 'Dedi Nugroho', '3101001131@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(747, 'Amalia Wibowo', '3101001132@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(748, 'Muhammad Fitriani', '3101001133@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(749, 'Gilang Saputra', '3101001134@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(750, 'Amalia Setiawan', '3101001135@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(751, 'Kevin Hayati', '3101001136@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(752, 'Aditya Lestari', '3101001137@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(753, 'Eka Sari', '3101001138@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(754, 'Putri Purnomo', '3101001139@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(755, 'Bambang Santoso', '3101001140@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(756, 'Pratiwi Purnomo', '3101001141@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(757, 'Farida Utomo', '3101001142@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(758, 'Gita Budiman', '3101001143@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(759, 'Laras Saputra', '3101001144@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(760, 'Dani Setiawan', '3101001145@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(761, 'Fitri Utami', '3101001146@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(762, 'Eka Setiawan', '3101001147@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(763, 'Tania Hayati', '3101001148@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(764, 'Pratiwi Amalia', '3101001149@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(765, 'Agus Permata', '3101001150@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(766, 'Tania Ramadhan', '3101001151@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(767, 'Amalia Budiman', '3101001152@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(768, 'Rian Dewi', '3101001153@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(769, 'Rizky Setiawan', '3101001154@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(770, 'Putri Fitriani', '3101001155@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(771, 'Rina Gunawan', '3101001156@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(772, 'Anisa Wijaya', '3101001157@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(773, 'Putri Wulandari', '3101001158@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(774, 'Rani Budiman', '3101001159@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(775, 'Farida Nugroho', '3101001160@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(776, 'Rani Kusuma', '3101001161@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(777, 'Dedi Amalia', '3101001162@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(778, 'Fajar Hidayat', '3101001163@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(779, 'Muhammad Ramadhan', '3101001164@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(780, 'Farida Putri', '3101001165@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(781, 'Hafiz Dewi', '3101001166@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(782, 'Hendra Asturi', '3101001167@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(783, 'Fahmi Kusuma', '3101001168@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(784, 'Amalia Rahmawati', '3101001169@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(785, 'Dimas Permata', '3101001170@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(786, 'Joko Utomo', '3101001171@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(787, 'Putri Lestari', '3101001172@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(788, 'Elena Pratama', '3101001173@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(789, 'Wulan Dewi', '3101001174@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(790, 'Putri Budiman', '3101001175@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(791, 'Shinta Lestari', '3101001176@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:09', '2026-06-27 03:13:41'),
(792, 'Rendra Purnomo', '3101001177@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(793, 'Ahmad Utomo', '3101001178@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(794, 'Utami Wijaya', '3101001179@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(795, 'Shinta Sari', '3101001180@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(796, 'Gilang Purnomo', '3101001181@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(797, 'Dani Nasution', '3101001182@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(798, 'Panji Santoso', '3101001183@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(799, 'Zahra Situmorang', '3101001184@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(800, 'Dewi Siregar', '3101001185@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(801, 'Farida Ramadhan', '3101001186@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:41'),
(802, 'Olivia Wijaya', '3101001187@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(803, 'Yanti Budiman', '3101001188@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(804, 'Tania Pratama', '3101001189@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(805, 'Putri Saputra', '3101001190@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(806, 'Dimas Lestari', '3101001191@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(807, 'Fajar Fitriani', '3101001192@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(808, 'Irfan Fitriani', '3101001193@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(809, 'Olivia Fitriani', '3101001194@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(810, 'Chandra Lestari', '3101001195@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(811, 'Panji Kusuma', '3101001196@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(812, 'Hesti Amalia', '3101001197@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(813, 'Bella Gunawan', '3101001198@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(814, 'Chandra Lestari', '3101001199@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(815, 'Pratiwi Siregar', '3101001200@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(816, 'Dinda Wulandari', '3101001201@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(817, 'Bella Nugroho', '3101001202@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(818, 'Zahra Amalia', '3101001203@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(819, 'Anisa Pratama', '3101001204@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(820, 'Panji Wulandari', '3101001205@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(821, 'Lukman Pratama', '3101001206@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(822, 'Dani Amalia', '3101001207@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(823, 'Yanti Kusuma', '3101001208@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(824, 'Yanti Permata', '3101001209@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(825, 'Hafiz Kusuma', '3101001210@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(826, 'Lukman Kusuma', '3101001211@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(827, 'Chandra Santoso', '3101001212@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(828, 'Arif Amalia', '3101001213@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(829, 'Olivia Pratama', '3101001214@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(830, 'Eko Santoso', '3101001215@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(831, 'Dani Pratiwi', '3101001216@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(832, 'Yanti Wibowo', '3101001217@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(833, 'Gita Gunawan', '3101001218@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(834, 'Chandra Nasution', '3101001219@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(835, 'Amalia Wibowo', '3101001220@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(836, 'Agus Wulandari', '3101001221@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(837, 'Utami Nasution', '3101001222@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(838, 'Oki Asturi', '3101001223@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(839, 'Satria Rahmawati', '3101001224@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(840, 'Hafiz Amalia', '3101001225@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(841, 'Zahra Hayati', '3101001226@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(842, 'Rendra Sari', '3101001227@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(843, 'Anisa Putri', '3101001228@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(844, 'Satria Gunawan', '3101001229@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(845, 'Rizky Pratama', '3101001230@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(846, 'Elena Santoso', '3101001231@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(847, 'Bella Wulandari', '3101001232@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(848, 'Dewi Pratama', '3101001233@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(849, 'Farida Amalia', '3101001234@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(850, 'Siti Wibowo', '3101001235@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(851, 'Zahra Dewi', '3101001236@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(852, 'Putri Asturi', '3101001237@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(853, 'Hesti Rahmawati', '3101001238@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(854, 'Hesti Permata', '3101001239@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(855, 'Dedi Wijaya', '3101001240@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(856, 'Putri Hidayat', '3101001241@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(857, 'Pratiwi Nasution', '3101001242@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(858, 'Rendra Purnomo', '3101001243@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(859, 'Fitri Wijaya', '3101001244@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(860, 'Pratiwi Utomo', '3101001245@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(861, 'Tania Utami', '3101001246@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(862, 'Agus Wibowo', '3101001247@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(863, 'Dewi Asturi', '3101001248@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(864, 'Naufal Siregar', '3101001249@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(865, 'Ahmad Fitriani', '3101001250@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(866, 'Oki Wulandari', '3101001251@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(867, 'Hendra Wulandari', '3101001252@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(868, 'Dhea Santoso', '3101001253@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(869, 'Budi Nasution', '3101001254@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(870, 'Siti Santoso', '3101001255@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(871, 'Shinta Hidayat', '3101001256@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(872, 'Citra Nasution', '3101001257@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(873, 'Shinta Utomo', '3101001258@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(874, 'Pratiwi Sari', '3101001259@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(875, 'Farida Situmorang', '3101001260@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(876, 'Amalia Pratiwi', '3101001261@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(877, 'Wulan Pratama', '3101001262@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(878, 'Nadia Rahmawati', '3101001263@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(879, 'Putri Amalia', '3101001264@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(880, 'Pratiwi Utami', '3101001265@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(881, 'Nadia Purnomo', '3101001266@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(882, 'Laras Asturi', '3101001267@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(883, 'Dewi Kusuma', '3101001268@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(884, 'Putri Dewi', '3101001269@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(885, 'Gilang Lestari', '3101001270@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(886, 'Mega Wulandari', '3101001271@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(887, 'Dimas Rahmawati', '3101001272@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(888, 'Dedi Asturi', '3101001273@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(889, 'Farida Lestari', '3101001274@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(890, 'Naufal Purnomo', '3101001275@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(891, 'Siti Santoso', '3101001276@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42');
INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(892, 'Mega Saputra', '3101001277@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(893, 'Dewi Pratama', '3101001278@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(894, 'Lukman Ramadhan', '3101001279@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(895, 'Laras Santoso', '3101001280@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(896, 'Rendra Wijaya', '3101001281@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(897, 'Hendra Budiman', '3101001282@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(898, 'Olivia Wibowo', '3101001283@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(899, 'Olivia Hidayat', '3101001284@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(900, 'Anisa Utomo', '3101001285@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(901, 'Rizky Gunawan', '3101001286@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(902, 'Ayu Siregar', '3101001287@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(903, 'Rina Pratama', '3101001288@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(904, 'Dewi Situmorang', '3101001289@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(905, 'Siti Budiman', '3101001290@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(906, 'Utami Situmorang', '3101001291@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(907, 'Putri Situmorang', '3101001292@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(908, 'Naufal Rahmawati', '3101001293@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(909, 'Bambang Wulandari', '3101001294@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(910, 'Shinta Kusuma', '3101001295@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(911, 'Dinda Siregar', '3101001296@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(912, 'Eka Ramadhan', '3101001297@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(913, 'Bella Fitriani', '3101001298@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(914, 'Rian Pratama', '3101001299@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(915, 'Muhammad Hayati', '3101001300@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-25 16:34:10', '2026-06-27 03:13:42'),
(1278, 'Diah Gunawan, S.Pd., M.Si.', 'diah.2798@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1279, 'Irwan Purnama, S.Pd., M.Pd.', 'irwan.1578@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1280, 'Hendra Nugroho, S.Pd., M.Pd.', 'hendra.1187@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1281, 'Diah Gunawan, S.Pd., M.Si.', 'diah.2764@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1282, 'Yuli Setiawan, S.Pd.', 'yuli.2199@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1283, 'Anwar Gunawan, S.Pd., M.Pd.', 'anwar.1195@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1284, 'Nining Sudarsono, S.Pd., M.Si.', 'nining.2617@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1285, 'Ani Purnama, S.Pd., M.Si.', 'ani.2420@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1286, 'Taufik Prasetyo, S.Si.', 'taufik.1356@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1287, 'Irwan Gunawan, S.Si., M.Pd.', 'irwan.1991@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1288, 'Eni Rahardjo, S.Pd., M.Pd.', 'eni.2828@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1289, 'Nining Kusumo, S.Pd., M.Pd.', 'nining.2388@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1290, 'Dewi Mulyadi, S.Pd., M.Si.', 'dewi.2656@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1291, 'Irwan Subagyo, S.Si., M.Pd.', 'irwan.1561@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1292, 'Yuli Purnama, S.S.', 'yuli.2592@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1293, 'Nining Wibowo, S.Pd., M.Si.', 'nining.2236@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1294, 'Toto Susanto, S.Pd.', 'toto.1817@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1295, 'Sri Sudarsono, S.S.', 'sri.2244@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1296, 'Rudi Purnama, S.Si., M.Pd.', 'rudi.1769@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1297, 'Siti Subagyo, S.Pd., M.Pd.', 'siti.2295@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1298, 'Agus Sudarsono, S.Si., M.Pd.', 'agus.1202@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1299, 'Eni Subagyo, S.Pd., M.Si.', 'eni.2485@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1300, 'Ika Rahardjo, S.Pd., M.Pd.', 'ika.2936@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1301, 'Irwan Hartono, S.Pd., M.Pd.', 'irwan.1795@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1302, 'Yusuf Rahardjo, S.Si.', 'yusuf.1347@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1303, 'Yuli Gunawan, S.S.', 'yuli.2176@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1304, 'Aris Hidayat, S.Si., M.Pd.', 'aris.1134@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1305, 'Agus Nugroho, S.Pd.', 'agus.1774@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1306, 'Wahyuni Setiawan, S.Pd., M.Si.', 'wahyuni.2358@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(1307, 'Retno Mulyadi, S.Pd., M.Pd.', 'retno.2725@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', '2026-06-25 16:39:23', '2026-06-25 16:41:14'),
(2268, 'Ade Nuraini', '4101001001@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2269, 'Fathonah Handayani', '4101001002@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2270, 'Capa Novitasari', '4101001003@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2271, 'Mahfud Zulkarnain', '4101001004@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2272, 'Prakosa Mandasari', '4101001005@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2273, 'Laila Wulandari', '4101001006@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2274, 'Yusuf Mahendra', '4101001007@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2275, 'Rafi Yolanda', '4101001008@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2276, 'Jaka Sirait', '4101001009@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2277, 'Pia Nurdiyanti', '4101001010@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2278, 'Galur Mandasari', '4101001011@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2279, 'Darijan Kuswandari', '4101001012@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2280, 'Aurora Rahmawati', '4101001013@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2281, 'Bancar Oktaviani', '4101001014@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2282, 'Febi Yolanda', '4101001015@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2283, 'Olivia Nugroho', '4101001016@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2284, 'Hardana Uyainah', '4101001017@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2285, 'Siti Rahmawati', '4101001018@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2286, 'Ida Hariyah', '4101001019@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2287, 'Wulan Susanti', '4101001020@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2288, 'Kamaria Laksita', '4101001021@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2289, 'Yuni Mustofa', '4101001022@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2290, 'Qori Wulandari', '4101001023@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2291, 'Rachel Najmudin', '4101001024@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2292, 'Intan Simanjuntak', '4101001025@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2293, 'Kiandra Putra', '4101001026@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2294, 'Gamanto Yuliarti', '4101001027@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2295, 'Belinda Agustina', '4101001028@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2296, 'Shania Rajata', '4101001029@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2297, 'Betania Nuraini', '4101001030@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2298, 'Jindra Dabukke', '4101001031@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2299, 'Michelle Irawan', '4101001032@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2300, 'Padmi Prakasa', '4101001033@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2301, 'Tasdik Hassanah', '4101001034@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2302, 'Martaka Pertiwi', '4101001035@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2303, 'Ratna Adriansyah', '4101001036@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2304, 'Emin Anggraini', '4101001037@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2305, 'Ami Wahyuni', '4101001038@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2306, 'Narji Winarno', '4101001039@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2307, 'Rachel Prasasta', '4101001040@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2308, 'Ulva Puspasari', '4101001041@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2309, 'Hasan Halim', '4101001042@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2310, 'Rahayu Nugroho', '4101001043@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2311, 'Adhiarja Oktaviani', '4101001044@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2312, 'Qori Aryani', '4101001045@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2313, 'Hani Saragih', '4101001046@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2314, 'Diah Uwais', '4101001047@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2315, 'Genta Hidayanto', '4101001048@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2316, 'Ulya Tamba', '4101001049@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2317, 'Karimah Jailani', '4101001050@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2318, 'Lili Halimah', '4101001051@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2319, 'Gina Wasita', '4101001052@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2320, 'Mala Lailasari', '4101001053@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2321, 'Jati Sudiati', '4101001054@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2322, 'Kadir Pertiwi', '4101001055@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2323, 'Cemplunk Yuniar', '4101001056@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2324, 'Alambana Siregar', '4101001057@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2325, 'Dalimin Rajata', '4101001058@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2326, 'Wirda Wijaya', '4101001059@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2327, 'Ibun Gunawan', '4101001060@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2328, 'Jagapati Suartini', '4101001061@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2329, 'Tedi Dongoran', '4101001062@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2330, 'Jane Wibisono', '4101001063@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2331, 'Tari Laksita', '4101001064@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2332, 'Juli Wahyuni', '4101001065@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2333, 'Cahya Wasita', '4101001066@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2334, 'Yunita Narpati', '4101001067@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2335, 'Gamblang Rahimah', '4101001068@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2336, 'Asirwada Winarsih', '4101001069@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2337, 'Harsaya Kusmawati', '4101001070@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2338, 'Mutia Hutapea', '4101001071@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2339, 'Janet Gunawan', '4101001072@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2340, 'Jane Astuti', '4101001073@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2341, 'Ade Hasanah', '4101001074@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2342, 'Mursita Narpati', '4101001075@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2343, 'Puji Pratama', '4101001076@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2344, 'Wisnu Nuraini', '4101001077@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2345, 'Yulia Firgantoro', '4101001078@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2346, 'Lili Firmansyah', '4101001079@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2347, 'Artawan Pratiwi', '4101001080@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2348, 'Gamanto Mansur', '4101001081@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2349, 'Gantar Novitasari', '4101001082@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2350, 'Rika Hasanah', '4101001083@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2351, 'Karsana Wastuti', '4101001084@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2352, 'Dirja Iswahyudi', '4101001085@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2353, 'Diana Hutasoit', '4101001086@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2354, 'Zelda Mayasari', '4101001087@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2355, 'Dalima Samosir', '4101001088@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2356, 'Banara Wijaya', '4101001089@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2357, 'Cindy Simbolon', '4101001090@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2358, 'Nabila Novitasari', '4101001091@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2359, 'Gilda Prasetya', '4101001092@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2360, 'Irwan Dabukke', '4101001093@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2361, 'Cemplunk Mulyani', '4101001094@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2362, 'Ophelia Kusumo', '4101001095@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2363, 'Ozy Yulianti', '4101001096@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2364, 'Julia Mulyani', '4101001097@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2365, 'Lidya Wahyudin', '4101001098@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2366, 'Juli Pradipta', '4101001099@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2367, 'Jayeng Uwais', '4101001100@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', '2026-06-27 12:49:49', '2026-06-27 12:49:49'),
(2368, 'Andika Pratama', '4101001101@siswa.smansago.com', '$2y$12$CZFT3LM0iJZ8wtwKjPZby.p9ZTXLZNTcETw29TkOlqgW0DBE8MNO6', 'siswa', '2026-06-27 13:15:02', '2026-06-27 13:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `tugas_id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `file_tugas` varchar(255) DEFAULT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_size` bigint UNSIGNED DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `drive_link` text,
  `file_name` varchar(255) DEFAULT NULL,
  `file_icon` varchar(255) DEFAULT NULL,
  `tanggal_pengumpulan` datetime DEFAULT NULL,
  `status` enum('terkumpul','terlambat','belum') DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumpulan_tugas`
--

INSERT INTO `pengumpulan_tugas` (`id`, `tugas_id`, `siswa_id`, `file_tugas`, `original_name`, `file_path`, `file_size`, `mime_type`, `drive_link`, `file_name`, `file_icon`, `tanggal_pengumpulan`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'submissions/2/1/0zCRZzsl4VOVPXa78rAaLJmBbaXmO5H4R5OopQWp.pdf', 'Jawaban_Dummy_Uji_Upload_PAI_XI.pdf', 'submissions/2/1/0zCRZzsl4VOVPXa78rAaLJmBbaXmO5H4R5OopQWp.pdf', 44853, 'application/pdf', NULL, NULL, NULL, '2026-06-27 22:16:01', 'terkumpul', '2026-06-27 15:16:01', '2026-06-27 15:16:01'),
(2, 4, 46, 'submissions/4/46/smVhf0WJ3UFcS1rjnRTx9jmi0mtji3EYz1dGVIj6.pdf', 'Jawaban_Tugas_Pertemuan_2_PAI_Kelas_X_Agus_Dewi.pdf', 'submissions/4/46/smVhf0WJ3UFcS1rjnRTx9jmi0mtji3EYz1dGVIj6.pdf', 23753, 'application/pdf', NULL, NULL, NULL, '2026-06-28 18:21:56', 'terkumpul', '2026-06-28 11:21:56', '2026-06-28 11:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4gbRXc2Fmbf7dYIYsN4NuD2l1CPyz09cVIWULmV5', 653, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibkVkNUc4YjZVQ2lIOGQ5UEFqSXF5Q1RDSW05a01Eb1RGcE93Tk9lWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kb3dubG9hZC9zdWJtaXNzaW9uLzIiO3M6NToicm91dGUiO3M6MTk6ImRvd25sb2FkLnN1Ym1pc3Npb24iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2NTM7fQ==', 1782646238),
('x8zphFcSHXI5cvhErVYzpr4IPAx055CsiZXoTxG3', 1278, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWENTVDNLNlRqaUMyRWJMckFSWDVKS1ZMMVpydURmMXZxa3N0T3B5ViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3NpZ25tZW50cy80P2NsYXNzX25hbWU9WEklMjBJUEElMjAxIjtzOjU6InJvdXRlIjtzOjE2OiJhc3NpZ25tZW50cy5zaG93Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI3ODt9', 1782646364),
('YmpuyA7X0ul2qxxayRRT0gqFLU3A5MeeGUflu2vo', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicThheHhZcXJONFA1SzZuQkhXYTk3bDFKVVQ4SFhiQVBodmRuUHMxQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHVkZW50cyI7czo1OiJyb3V0ZSI7czoxNDoic3R1ZGVudHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1782646363);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'daftar_tahun_ajaran_custom', '[\"2026\\/2027\"]', '2026-06-27 03:18:28', '2026-06-27 03:18:28'),
(2, 'school_name', 'SMA Negeri 1 Cepogo', '2026-06-27 03:18:49', '2026-06-27 03:54:53'),
(3, 'school_email', 'info@smansago.sch.id', '2026-06-27 03:18:49', '2026-06-27 03:18:49'),
(4, 'fonnte_token', NULL, '2026-06-27 03:18:49', '2026-06-27 03:18:49'),
(5, 'lock_duration_hours', '24', '2026-06-27 03:18:49', '2026-06-27 03:18:49'),
(6, 'allow_dispensations', '1', '2026-06-27 03:18:49', '2026-06-27 03:18:49'),
(7, 'wa_notification_status', '1', '2026-06-27 03:18:49', '2026-06-27 03:18:49'),
(8, 'tahun_ajaran_aktif', '2026/2027', '2026-06-27 03:18:49', '2026-06-27 03:25:16'),
(9, 'permissions_page_password', 'admin123', '2026-06-27 03:18:49', '2026-06-27 03:18:49'),
(10, 'system_roles', '{\"admin\":\"Administrator\",\"guru\":\"Guru Pengajar\",\"wali_kelas\":\"Wali Kelas\",\"siswa\":\"Siswa\"}', '2026-06-27 04:01:02', '2026-06-27 04:01:02'),
(11, 'system_modules', '{\"Data Sekolah (Siswa, Kelas)\":{\"view\":{\"key\":\"view_siswa\",\"label\":\"Melihat Siswa & Kelas\"},\"create\":{\"key\":\"create_siswa\",\"label\":\"Tambah Siswa & Kelas\"},\"edit\":{\"key\":\"edit_siswa\",\"label\":\"Edit Siswa & Kelas\"},\"delete\":{\"key\":\"delete_siswa\",\"label\":\"Hapus Siswa & Kelas\"}},\"Data Guru\":{\"view\":{\"key\":\"view_guru\",\"label\":\"Melihat Guru\"},\"create\":{\"key\":\"create_guru\",\"label\":\"Tambah Guru\"},\"edit\":{\"key\":\"edit_guru\",\"label\":\"Edit Guru\"},\"delete\":{\"key\":\"delete_guru\",\"label\":\"Hapus Guru\"}},\"Tugas & Pembelajaran\":{\"view\":{\"key\":\"view_tugas\",\"label\":\"Melihat Tugas\"},\"create\":{\"key\":\"create_tugas\",\"label\":\"Tambah Tugas\"},\"edit\":{\"key\":\"edit_tugas\",\"label\":\"Edit Tugas & Nilai\"},\"delete\":{\"key\":\"delete_tugas\",\"label\":\"Hapus Tugas\"}},\"Verifikasi Banding (SSL)\":{\"view\":{\"key\":\"view_dispensasi\",\"label\":\"Melihat Dispensasi\"},\"create\":null,\"edit\":{\"key\":\"approve_dispensasi\",\"label\":\"Setujui Dispensasi\"},\"delete\":null},\"Cetak Laporan\":{\"view\":{\"key\":\"view_laporan\",\"label\":\"Lihat Laporan\"},\"create\":null,\"edit\":null,\"delete\":null},\"Pengaturan Sistem\":{\"view\":null,\"create\":null,\"edit\":{\"key\":\"manage_settings\",\"label\":\"Pengaturan Sistem\"},\"delete\":null}}', '2026-06-27 04:01:02', '2026-06-27 04:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kelas` varchar(100) DEFAULT NULL,
  `nama_ortu` varchar(255) DEFAULT NULL,
  `no_hp_ortu` varchar(20) DEFAULT NULL,
  `alamat` text,
  `status` enum('aktif','nonaktif','lulus','mutasi') DEFAULT 'aktif',
  `tahun_lulus` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pengguna_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `kelas`, `nama_ortu`, `no_hp_ortu`, `alamat`, `status`, `tahun_lulus`, `created_at`, `updated_at`, `pengguna_id`) VALUES
(1, '3101001001', 'Budi Dewi', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 616),
(2, '3101001002', 'Lukman Hidayat', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 617),
(3, '3101001003', 'Anisa Saputra', 'Perempuan', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 618),
(4, '3101001004', 'Fahmi Setiawan', 'Laki-laki', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 619),
(5, '3101001005', 'Chandra Putri', 'Laki-laki', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 620),
(6, '3101001006', 'Kevin Purnomo', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 621),
(7, '3101001007', 'Muhammad Siregar', 'Laki-laki', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 622),
(8, '3101001008', 'Aditya Wulandari', 'Laki-laki', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 623),
(9, '3101001009', 'Lukman Budiman', 'Laki-laki', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 624),
(10, '3101001010', 'Fahmi Gunawan', 'Laki-laki', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 625),
(11, '3101001011', 'Kevin Kusuma', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 626),
(12, '3101001012', 'Dewi Wulandari', 'Perempuan', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 627),
(13, '3101001013', 'Fitri Budiman', 'Perempuan', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 628),
(14, '3101001014', 'Aditya Nasution', 'Laki-laki', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 629),
(15, '3101001015', 'Hafiz Sari', 'Laki-laki', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 630),
(16, '3101001016', 'Chandra Situmorang', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 631),
(17, '3101001017', 'Elena Hayati', 'Perempuan', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 632),
(18, '3101001018', 'Naufal Siregar', 'Laki-laki', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 633),
(19, '3101001019', 'Satria Putri', 'Laki-laki', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 634),
(20, '3101001020', 'Irfan Nugroho', 'Laki-laki', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 635),
(21, '3101001021', 'Hendra Pratama', 'Laki-laki', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 636),
(22, '3101001022', 'Gita Putri', 'Perempuan', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 637),
(23, '3101001023', 'Eka Nugroho', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 638),
(24, '3101001024', 'Dedi Sari', 'Laki-laki', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 639),
(25, '3101001025', 'Agus Situmorang', 'Laki-laki', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 640),
(26, '3101001026', 'Tania Wulandari', 'Perempuan', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 641),
(27, '3101001027', 'Citra Sari', 'Perempuan', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 642),
(28, '3101001028', 'Rina Budiman', 'Perempuan', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 643),
(29, '3101001029', 'Eka Pratiwi', 'Laki-laki', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 644),
(30, '3101001030', 'Dedi Nasution', 'Laki-laki', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 645),
(31, '3101001031', 'Rani Saputra', 'Perempuan', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 646),
(32, '3101001032', 'Dinda Wijaya', 'Perempuan', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 647),
(33, '3101001033', 'Lukman Nugroho', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 648),
(34, '3101001034', 'Joko Nugroho', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 649),
(35, '3101001035', 'Shinta Wulandari', 'Perempuan', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 650),
(36, '3101001036', 'Kevin Gunawan', 'Laki-laki', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 651),
(37, '3101001037', 'Gita Ramadhan', 'Perempuan', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:40', '2026-06-27 03:17:29', 652),
(38, '3101001038', 'Ahmad Siregar', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 653),
(39, '3101001039', 'Budi Kusuma', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 654),
(40, '3101001040', 'Ahmad Utami', 'Laki-laki', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 655),
(41, '3101001041', 'Eka Utomo', 'Laki-laki', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 656),
(42, '3101001042', 'Fahmi Pratama', 'Laki-laki', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 657),
(43, '3101001043', 'Naufal Nugroho', 'Laki-laki', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 658),
(44, '3101001044', 'Rian Asturi', 'Laki-laki', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 659),
(45, '3101001045', 'Pratiwi Wulandari', 'Perempuan', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 660),
(46, '3101001046', 'Agus Dewi', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 661),
(47, '3101001047', 'Rizky Setiawan', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 662),
(48, '3101001048', 'Rina Wibowo', 'Perempuan', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 663),
(49, '3101001049', 'Dhea Wulandari', 'Perempuan', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 664),
(50, '3101001050', 'Irfan Lestari', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 665),
(51, '3101001051', 'Eko Purnomo', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 666),
(52, '3101001052', 'Gita Wijaya', 'Perempuan', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 667),
(53, '3101001053', 'Fitri Pratiwi', 'Perempuan', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 668),
(54, '3101001054', 'Olivia Permata', 'Perempuan', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 669),
(55, '3101001055', 'Rizky Gunawan', 'Laki-laki', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 670),
(56, '3101001056', 'Lukman Siregar', 'Laki-laki', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 671),
(57, '3101001057', 'Andi Ramadhan', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 672),
(58, '3101001058', 'Hafiz Kusuma', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 673),
(59, '3101001059', 'Putri Utami', 'Perempuan', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 674),
(60, '3101001060', 'Bambang Asturi', 'Laki-laki', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 675),
(61, '3101001061', 'Sari Asturi', 'Perempuan', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 676),
(62, '3101001062', 'Nadia Pratama', 'Perempuan', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 677),
(63, '3101001063', 'Laras Pratiwi', 'Perempuan', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 678),
(64, '3101001064', 'Chandra Rahmawati', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 679),
(65, '3101001065', 'Fahmi Setiawan', 'Laki-laki', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 680),
(66, '3101001066', 'Gita Kusuma', 'Perempuan', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 681),
(67, '3101001067', 'Rina Budiman', 'Perempuan', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 682),
(68, '3101001068', 'Joko Fitriani', 'Laki-laki', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 683),
(69, '3101001069', 'Hendra Hidayat', 'Laki-laki', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 684),
(70, '3101001070', 'Ayu Rahmawati', 'Perempuan', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 685),
(71, '3101001071', 'Joko Sari', 'Laki-laki', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 686),
(72, '3101001072', 'Gita Pratiwi', 'Perempuan', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 687),
(73, '3101001073', 'Elena Wibowo', 'Perempuan', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 688),
(74, '3101001074', 'Irfan Wibowo', 'Laki-laki', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 689),
(75, '3101001075', 'Tania Saputra', 'Perempuan', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 690),
(76, '3101001076', 'Oki Nasution', 'Laki-laki', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 691),
(77, '3101001077', 'Indah Wijaya', 'Perempuan', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 692),
(78, '3101001078', 'Sari Asturi', 'Perempuan', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 693),
(79, '3101001079', 'Citra Lestari', 'Perempuan', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 694),
(80, '3101001080', 'Satria Pratiwi', 'Laki-laki', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 695),
(81, '3101001081', 'Rendra Purnomo', 'Laki-laki', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 696),
(82, '3101001082', 'Dhea Asturi', 'Perempuan', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 697),
(83, '3101001083', 'Rina Amalia', 'Perempuan', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 698),
(84, '3101001084', 'Panji Nugroho', 'Laki-laki', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 699),
(85, '3101001085', 'Ayu Fitriani', 'Perempuan', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 700),
(86, '3101001086', 'Budi Asturi', 'Laki-laki', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 701),
(87, '3101001087', 'Farida Kusuma', 'Perempuan', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 702),
(88, '3101001088', 'Yanti Ramadhan', 'Perempuan', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 703),
(89, '3101001089', 'Rian Utami', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 704),
(90, '3101001090', 'Anisa Hidayat', 'Perempuan', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 705),
(91, '3101001091', 'Olivia Rahmawati', 'Perempuan', NULL, 'XI IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 706),
(92, '3101001092', 'Gita Putri', 'Perempuan', NULL, 'XI IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 707),
(93, '3101001093', 'Siti Ramadhan', 'Perempuan', NULL, 'XI IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 708),
(94, '3101001094', 'Olivia Kusuma', 'Perempuan', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 709),
(95, '3101001095', 'Zahra Wulandari', 'Perempuan', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 710),
(96, '3101001096', 'Zahra Purnomo', 'Perempuan', NULL, 'XI IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 711),
(97, '3101001097', 'Rizky Purnomo', 'Laki-laki', NULL, 'XI IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 712),
(98, '3101001098', 'Hafiz Putri', 'Laki-laki', NULL, 'XI IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 713),
(99, '3101001099', 'Ayu Setiawan', 'Perempuan', NULL, 'XI IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 714),
(100, '3101001100', 'Pratiwi Budiman', 'Perempuan', NULL, 'XI IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 715),
(101, '3101001101', 'Joko Kusuma', 'Laki-laki', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 716),
(102, '3101001102', 'Oki Hayati', 'Laki-laki', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 717),
(103, '3101001103', 'Naufal Setiawan', 'Laki-laki', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 718),
(104, '3101001104', 'Dani Rahmawati', 'Laki-laki', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 719),
(105, '3101001105', 'Olivia Utami', 'Perempuan', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 720),
(106, '3101001106', 'Rani Situmorang', 'Perempuan', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 721),
(107, '3101001107', 'Muhammad Purnomo', 'Laki-laki', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 722),
(108, '3101001108', 'Fahmi Utomo', 'Laki-laki', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 723),
(109, '3101001109', 'Indah Amalia', 'Perempuan', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 724),
(110, '3101001110', 'Wulan Fitriani', 'Perempuan', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 725),
(111, '3101001111', 'Gita Santoso', 'Perempuan', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 726),
(112, '3101001112', 'Fitri Hayati', 'Perempuan', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 727),
(113, '3101001113', 'Yanti Utomo', 'Perempuan', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 728),
(114, '3101001114', 'Dinda Wibowo', 'Perempuan', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 729),
(115, '3101001115', 'Dedi Utomo', 'Laki-laki', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 730),
(116, '3101001116', 'Ahmad Purnomo', 'Laki-laki', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 731),
(117, '3101001117', 'Anisa Setiawan', 'Perempuan', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 732),
(118, '3101001118', 'Panji Utami', 'Laki-laki', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 733),
(119, '3101001119', 'Siti Nasution', 'Perempuan', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 734),
(120, '3101001120', 'Tania Dewi', 'Perempuan', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 735),
(121, '3101001121', 'Dinda Wibowo', 'Perempuan', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 736),
(122, '3101001122', 'Laras Asturi', 'Perempuan', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 737),
(123, '3101001123', 'Oki Budiman', 'Laki-laki', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 738),
(124, '3101001124', 'Utami Putri', 'Perempuan', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 739),
(125, '3101001125', 'Indah Wulandari', 'Perempuan', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 740),
(126, '3101001126', 'Nadia Siregar', 'Perempuan', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 741),
(127, '3101001127', 'Citra Utami', 'Perempuan', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 742),
(128, '3101001128', 'Elena Kusuma', 'Perempuan', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 743),
(129, '3101001129', 'Dinda Sari', 'Perempuan', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 744),
(130, '3101001130', 'Fajar Setiawan', 'Laki-laki', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 745),
(131, '3101001131', 'Dedi Nugroho', 'Laki-laki', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 746),
(132, '3101001132', 'Amalia Wibowo', 'Perempuan', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 747),
(133, '3101001133', 'Muhammad Fitriani', 'Laki-laki', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 748),
(134, '3101001134', 'Gilang Saputra', 'Laki-laki', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 749),
(135, '3101001135', 'Amalia Setiawan', 'Perempuan', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 750),
(136, '3101001136', 'Kevin Hayati', 'Laki-laki', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 751),
(137, '3101001137', 'Aditya Lestari', 'Laki-laki', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 752),
(138, '3101001138', 'Eka Sari', 'Laki-laki', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 753),
(139, '3101001139', 'Putri Purnomo', 'Perempuan', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 754),
(140, '3101001140', 'Bambang Santoso', 'Laki-laki', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 755),
(141, '3101001141', 'Pratiwi Purnomo', 'Perempuan', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 756),
(142, '3101001142', 'Farida Utomo', 'Perempuan', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 757),
(143, '3101001143', 'Gita Budiman', 'Perempuan', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 758),
(144, '3101001144', 'Laras Saputra', 'Perempuan', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 759),
(145, '3101001145', 'Dani Setiawan', 'Laki-laki', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 760),
(146, '3101001146', 'Fitri Utami', 'Perempuan', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 761),
(147, '3101001147', 'Eka Setiawan', 'Laki-laki', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 762),
(148, '3101001148', 'Tania Hayati', 'Perempuan', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 763),
(149, '3101001149', 'Pratiwi Amalia', 'Perempuan', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 764),
(150, '3101001150', 'Agus Permata', 'Laki-laki', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 765),
(151, '3101001151', 'Tania Ramadhan', 'Perempuan', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 766),
(152, '3101001152', 'Amalia Budiman', 'Perempuan', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 767),
(153, '3101001153', 'Rian Dewi', 'Laki-laki', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 768),
(154, '3101001154', 'Rizky Setiawan', 'Laki-laki', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 769),
(155, '3101001155', 'Putri Fitriani', 'Perempuan', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 770),
(156, '3101001156', 'Rina Gunawan', 'Perempuan', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 771),
(157, '3101001157', 'Anisa Wijaya', 'Perempuan', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 772),
(158, '3101001158', 'Putri Wulandari', 'Perempuan', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 773),
(159, '3101001159', 'Rani Budiman', 'Perempuan', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 774),
(160, '3101001160', 'Farida Nugroho', 'Perempuan', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 775),
(161, '3101001161', 'Rani Kusuma', 'Perempuan', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 776),
(162, '3101001162', 'Dedi Amalia', 'Laki-laki', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 777),
(163, '3101001163', 'Fajar Hidayat', 'Laki-laki', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 778),
(164, '3101001164', 'Muhammad Ramadhan', 'Laki-laki', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 779),
(165, '3101001165', 'Farida Putri', 'Perempuan', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 780),
(166, '3101001166', 'Hafiz Dewi', 'Laki-laki', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 781),
(167, '3101001167', 'Hendra Asturi', 'Laki-laki', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 782),
(168, '3101001168', 'Fahmi Kusuma', 'Laki-laki', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 783),
(169, '3101001169', 'Amalia Rahmawati', 'Perempuan', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 784),
(170, '3101001170', 'Dimas Permata', 'Laki-laki', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 785),
(171, '3101001171', 'Joko Utomo', 'Laki-laki', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 786),
(172, '3101001172', 'Putri Lestari', 'Perempuan', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 787),
(173, '3101001173', 'Elena Pratama', 'Perempuan', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 788),
(174, '3101001174', 'Wulan Dewi', 'Perempuan', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 789),
(175, '3101001175', 'Putri Budiman', 'Perempuan', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 790),
(176, '3101001176', 'Shinta Lestari', 'Perempuan', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 791),
(177, '3101001177', 'Rendra Purnomo', 'Laki-laki', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 792),
(178, '3101001178', 'Ahmad Utomo', 'Laki-laki', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 793),
(179, '3101001179', 'Utami Wijaya', 'Perempuan', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 794),
(180, '3101001180', 'Shinta Sari', 'Perempuan', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 795),
(181, '3101001181', 'Gilang Purnomo', 'Laki-laki', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 796),
(182, '3101001182', 'Dani Nasution', 'Laki-laki', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 797),
(183, '3101001183', 'Panji Santoso', 'Laki-laki', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 798),
(184, '3101001184', 'Zahra Situmorang', 'Perempuan', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 799),
(185, '3101001185', 'Dewi Siregar', 'Perempuan', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 800),
(186, '3101001186', 'Farida Ramadhan', 'Perempuan', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:41', '2026-06-27 03:17:29', 801),
(187, '3101001187', 'Olivia Wijaya', 'Perempuan', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 802),
(188, '3101001188', 'Yanti Budiman', 'Perempuan', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 803),
(189, '3101001189', 'Tania Pratama', 'Perempuan', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 804),
(190, '3101001190', 'Putri Saputra', 'Perempuan', NULL, 'XII IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 805),
(191, '3101001191', 'Dimas Lestari', 'Laki-laki', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 806),
(192, '3101001192', 'Fajar Fitriani', 'Laki-laki', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 807),
(193, '3101001193', 'Irfan Fitriani', 'Laki-laki', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 808),
(194, '3101001194', 'Olivia Fitriani', 'Perempuan', NULL, 'XII IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 809),
(195, '3101001195', 'Chandra Lestari', 'Laki-laki', NULL, 'XII IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 810),
(196, '3101001196', 'Panji Kusuma', 'Laki-laki', NULL, 'XII IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 811),
(197, '3101001197', 'Hesti Amalia', 'Perempuan', NULL, 'XII IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 812),
(198, '3101001198', 'Bella Gunawan', 'Perempuan', NULL, 'XII IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 813),
(199, '3101001199', 'Chandra Lestari', 'Laki-laki', NULL, 'XII IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 814),
(200, '3101001200', 'Pratiwi Siregar', 'Perempuan', NULL, 'XII IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:29', 815),
(201, '3101001201', 'Dinda Wulandari', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 816),
(202, '3101001202', 'Bella Nugroho', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 817),
(203, '3101001203', 'Zahra Amalia', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 818),
(204, '3101001204', 'Anisa Pratama', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 819),
(205, '3101001205', 'Panji Wulandari', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 820),
(206, '3101001206', 'Lukman Pratama', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 821),
(207, '3101001207', 'Dani Amalia', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 822),
(208, '3101001208', 'Yanti Kusuma', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 823),
(209, '3101001209', 'Yanti Permata', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 824),
(210, '3101001210', 'Hafiz Kusuma', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 825),
(211, '3101001211', 'Lukman Kusuma', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 826),
(212, '3101001212', 'Chandra Santoso', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 827),
(213, '3101001213', 'Arif Amalia', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 828),
(214, '3101001214', 'Olivia Pratama', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 829),
(215, '3101001215', 'Eko Santoso', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 830),
(216, '3101001216', 'Dani Pratiwi', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 831),
(217, '3101001217', 'Yanti Wibowo', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 832),
(218, '3101001218', 'Gita Gunawan', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 833),
(219, '3101001219', 'Chandra Nasution', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 834),
(220, '3101001220', 'Amalia Wibowo', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 835),
(221, '3101001221', 'Agus Wulandari', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 836),
(222, '3101001222', 'Utami Nasution', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 837),
(223, '3101001223', 'Oki Asturi', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 838),
(224, '3101001224', 'Satria Rahmawati', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 839),
(225, '3101001225', 'Hafiz Amalia', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 840),
(226, '3101001226', 'Zahra Hayati', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 841),
(227, '3101001227', 'Rendra Sari', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 842),
(228, '3101001228', 'Anisa Putri', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 843),
(229, '3101001229', 'Satria Gunawan', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 844),
(230, '3101001230', 'Rizky Pratama', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 845),
(231, '3101001231', 'Elena Santoso', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 846),
(232, '3101001232', 'Bella Wulandari', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 847),
(233, '3101001233', 'Dewi Pratama', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 848),
(234, '3101001234', 'Farida Amalia', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 849),
(235, '3101001235', 'Siti Wibowo', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 850),
(236, '3101001236', 'Zahra Dewi', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 851),
(237, '3101001237', 'Putri Asturi', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 852),
(238, '3101001238', 'Hesti Rahmawati', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 853),
(239, '3101001239', 'Hesti Permata', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 854),
(240, '3101001240', 'Dedi Wijaya', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 855),
(241, '3101001241', 'Putri Hidayat', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 856),
(242, '3101001242', 'Pratiwi Nasution', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 857),
(243, '3101001243', 'Rendra Purnomo', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 858),
(244, '3101001244', 'Fitri Wijaya', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 859),
(245, '3101001245', 'Pratiwi Utomo', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 860),
(246, '3101001246', 'Tania Utami', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 861),
(247, '3101001247', 'Agus Wibowo', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 862),
(248, '3101001248', 'Dewi Asturi', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 863),
(249, '3101001249', 'Naufal Siregar', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 864),
(250, '3101001250', 'Ahmad Fitriani', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 865),
(251, '3101001251', 'Oki Wulandari', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 866),
(252, '3101001252', 'Hendra Wulandari', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 867),
(253, '3101001253', 'Dhea Santoso', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 868),
(254, '3101001254', 'Budi Nasution', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 869),
(255, '3101001255', 'Siti Santoso', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 870),
(256, '3101001256', 'Shinta Hidayat', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 871),
(257, '3101001257', 'Citra Nasution', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 872),
(258, '3101001258', 'Shinta Utomo', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 873),
(259, '3101001259', 'Pratiwi Sari', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 874),
(260, '3101001260', 'Farida Situmorang', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 875),
(261, '3101001261', 'Amalia Pratiwi', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 876),
(262, '3101001262', 'Wulan Pratama', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 877),
(263, '3101001263', 'Nadia Rahmawati', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 878),
(264, '3101001264', 'Putri Amalia', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 879),
(265, '3101001265', 'Pratiwi Utami', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 880),
(266, '3101001266', 'Nadia Purnomo', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 881),
(267, '3101001267', 'Laras Asturi', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 882),
(268, '3101001268', 'Dewi Kusuma', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 883),
(269, '3101001269', 'Putri Dewi', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 884),
(270, '3101001270', 'Gilang Lestari', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 885),
(271, '3101001271', 'Mega Wulandari', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 886),
(272, '3101001272', 'Dimas Rahmawati', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 887),
(273, '3101001273', 'Dedi Asturi', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 888),
(274, '3101001274', 'Farida Lestari', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 889),
(275, '3101001275', 'Naufal Purnomo', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 890),
(276, '3101001276', 'Siti Santoso', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 891),
(277, '3101001277', 'Mega Saputra', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 892),
(278, '3101001278', 'Dewi Pratama', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 893),
(279, '3101001279', 'Lukman Ramadhan', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 894),
(280, '3101001280', 'Laras Santoso', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 895),
(281, '3101001281', 'Rendra Wijaya', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 896),
(282, '3101001282', 'Hendra Budiman', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 897),
(283, '3101001283', 'Olivia Wibowo', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 898),
(284, '3101001284', 'Olivia Hidayat', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 899),
(285, '3101001285', 'Anisa Utomo', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 900),
(286, '3101001286', 'Rizky Gunawan', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 901),
(287, '3101001287', 'Ayu Siregar', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 902),
(288, '3101001288', 'Rina Pratama', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 903),
(289, '3101001289', 'Dewi Situmorang', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 904),
(290, '3101001290', 'Siti Budiman', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 905),
(291, '3101001291', 'Utami Situmorang', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 906),
(292, '3101001292', 'Putri Situmorang', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 907),
(293, '3101001293', 'Naufal Rahmawati', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 908),
(294, '3101001294', 'Bambang Wulandari', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 909),
(295, '3101001295', 'Shinta Kusuma', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 910),
(296, '3101001296', 'Dinda Siregar', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 911),
(297, '3101001297', 'Eka Ramadhan', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 912),
(298, '3101001298', 'Bella Fitriani', 'Perempuan', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 913),
(299, '3101001299', 'Rian Pratama', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 914),
(300, '3101001300', 'Muhammad Hayati', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 'lulus', NULL, '2026-06-27 03:13:42', '2026-06-27 03:17:03', 915),
(301, '4101001001', 'Ade Nuraini', 'Laki-laki', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2268),
(302, '4101001002', 'Fathonah Handayani', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2269),
(303, '4101001003', 'Capa Novitasari', 'Laki-laki', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2270),
(304, '4101001004', 'Mahfud Zulkarnain', 'Laki-laki', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2271),
(305, '4101001005', 'Prakosa Mandasari', 'Laki-laki', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2272),
(306, '4101001006', 'Laila Wulandari', 'Perempuan', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2273),
(307, '4101001007', 'Yusuf Mahendra', 'Laki-laki', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2274),
(308, '4101001008', 'Rafi Yolanda', 'Laki-laki', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2275),
(309, '4101001009', 'Jaka Sirait', 'Laki-laki', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2276),
(310, '4101001010', 'Pia Nurdiyanti', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2277),
(311, '4101001011', 'Galur Mandasari', 'Laki-laki', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2278),
(312, '4101001012', 'Darijan Kuswandari', 'Laki-laki', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2279),
(313, '4101001013', 'Aurora Rahmawati', 'Perempuan', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2280),
(314, '4101001014', 'Bancar Oktaviani', 'Laki-laki', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2281),
(315, '4101001015', 'Febi Yolanda', 'Perempuan', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2282),
(316, '4101001016', 'Olivia Nugroho', 'Perempuan', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2283),
(317, '4101001017', 'Hardana Uyainah', 'Laki-laki', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2284),
(318, '4101001018', 'Siti Rahmawati', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2285),
(319, '4101001019', 'Ida Hariyah', 'Perempuan', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2286),
(320, '4101001020', 'Wulan Susanti', 'Perempuan', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2287),
(321, '4101001021', 'Kamaria Laksita', 'Perempuan', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2288),
(322, '4101001022', 'Yuni Mustofa', 'Perempuan', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2289),
(323, '4101001023', 'Qori Wulandari', 'Perempuan', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2290),
(324, '4101001024', 'Rachel Najmudin', 'Perempuan', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2291),
(325, '4101001025', 'Intan Simanjuntak', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2292),
(326, '4101001026', 'Kiandra Putra', 'Perempuan', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2293),
(327, '4101001027', 'Gamanto Yuliarti', 'Laki-laki', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2294),
(328, '4101001028', 'Belinda Agustina', 'Perempuan', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2295),
(329, '4101001029', 'Shania Rajata', 'Perempuan', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2296),
(330, '4101001030', 'Betania Nuraini', 'Perempuan', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2297),
(331, '4101001031', 'Jindra Dabukke', 'Laki-laki', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2298),
(332, '4101001032', 'Michelle Irawan', 'Perempuan', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2299),
(333, '4101001033', 'Padmi Prakasa', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2300);
INSERT INTO `siswa` (`id`, `nis`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `kelas`, `nama_ortu`, `no_hp_ortu`, `alamat`, `status`, `tahun_lulus`, `created_at`, `updated_at`, `pengguna_id`) VALUES
(334, '4101001034', 'Tasdik Hassanah', 'Laki-laki', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2301),
(335, '4101001035', 'Martaka Pertiwi', 'Laki-laki', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2302),
(336, '4101001036', 'Ratna Adriansyah', 'Perempuan', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2303),
(337, '4101001037', 'Emin Anggraini', 'Laki-laki', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2304),
(338, '4101001038', 'Ami Wahyuni', 'Perempuan', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2305),
(339, '4101001039', 'Narji Winarno', 'Laki-laki', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2306),
(340, '4101001040', 'Rachel Prasasta', 'Perempuan', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2307),
(341, '4101001041', 'Ulva Puspasari', 'Perempuan', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2308),
(342, '4101001042', 'Hasan Halim', 'Laki-laki', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2309),
(343, '4101001043', 'Rahayu Nugroho', 'Perempuan', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2310),
(344, '4101001044', 'Adhiarja Oktaviani', 'Laki-laki', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2311),
(345, '4101001045', 'Qori Aryani', 'Perempuan', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2312),
(346, '4101001046', 'Hani Saragih', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2313),
(347, '4101001047', 'Diah Uwais', 'Perempuan', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2314),
(348, '4101001048', 'Genta Hidayanto', 'Perempuan', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2315),
(349, '4101001049', 'Ulya Tamba', 'Perempuan', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2316),
(350, '4101001050', 'Karimah Jailani', 'Perempuan', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2317),
(351, '4101001051', 'Lili Halimah', 'Perempuan', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2318),
(352, '4101001052', 'Gina Wasita', 'Perempuan', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2319),
(353, '4101001053', 'Mala Lailasari', 'Perempuan', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2320),
(354, '4101001054', 'Jati Sudiati', 'Laki-laki', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2321),
(355, '4101001055', 'Kadir Pertiwi', 'Laki-laki', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2322),
(356, '4101001056', 'Cemplunk Yuniar', 'Laki-laki', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2323),
(357, '4101001057', 'Alambana Siregar', 'Laki-laki', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2324),
(358, '4101001058', 'Dalimin Rajata', 'Laki-laki', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2325),
(359, '4101001059', 'Wirda Wijaya', 'Perempuan', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2326),
(360, '4101001060', 'Ibun Gunawan', 'Laki-laki', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2327),
(361, '4101001061', 'Jagapati Suartini', 'Laki-laki', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2328),
(362, '4101001062', 'Tedi Dongoran', 'Laki-laki', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2329),
(363, '4101001063', 'Jane Wibisono', 'Perempuan', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2330),
(364, '4101001064', 'Tari Laksita', 'Perempuan', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2331),
(365, '4101001065', 'Juli Wahyuni', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2332),
(366, '4101001066', 'Cahya Wasita', 'Laki-laki', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2333),
(367, '4101001067', 'Yunita Narpati', 'Perempuan', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2334),
(368, '4101001068', 'Gamblang Rahimah', 'Laki-laki', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2335),
(369, '4101001069', 'Asirwada Winarsih', 'Laki-laki', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2336),
(370, '4101001070', 'Harsaya Kusmawati', 'Laki-laki', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2337),
(371, '4101001071', 'Mutia Hutapea', 'Perempuan', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2338),
(372, '4101001072', 'Janet Gunawan', 'Perempuan', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2339),
(373, '4101001073', 'Jane Astuti', 'Perempuan', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2340),
(374, '4101001074', 'Ade Hasanah', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2341),
(375, '4101001075', 'Mursita Narpati', 'Laki-laki', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2342),
(376, '4101001076', 'Puji Pratama', 'Perempuan', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2343),
(377, '4101001077', 'Wisnu Nuraini', 'Laki-laki', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2344),
(378, '4101001078', 'Yulia Firgantoro', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2345),
(379, '4101001079', 'Lili Firmansyah', 'Perempuan', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2346),
(380, '4101001080', 'Artawan Pratiwi', 'Laki-laki', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2347),
(381, '4101001081', 'Gamanto Mansur', 'Laki-laki', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2348),
(382, '4101001082', 'Gantar Novitasari', 'Laki-laki', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2349),
(383, '4101001083', 'Rika Hasanah', 'Perempuan', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2350),
(384, '4101001084', 'Karsana Wastuti', 'Laki-laki', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2351),
(385, '4101001085', 'Dirja Iswahyudi', 'Laki-laki', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2352),
(386, '4101001086', 'Diana Hutasoit', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2353),
(387, '4101001087', 'Zelda Mayasari', 'Perempuan', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2354),
(388, '4101001088', 'Dalima Samosir', 'Perempuan', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2355),
(389, '4101001089', 'Banara Wijaya', 'Laki-laki', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2356),
(390, '4101001090', 'Cindy Simbolon', 'Perempuan', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2357),
(391, '4101001091', 'Nabila Novitasari', 'Perempuan', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2358),
(392, '4101001092', 'Gilda Prasetya', 'Perempuan', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2359),
(393, '4101001093', 'Irwan Dabukke', 'Laki-laki', NULL, 'X IPS 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2360),
(394, '4101001094', 'Cemplunk Mulyani', 'Laki-laki', NULL, 'X IPS 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2361),
(395, '4101001095', 'Ophelia Kusumo', 'Perempuan', NULL, 'X IPA 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2362),
(396, '4101001096', 'Ozy Yulianti', 'Laki-laki', NULL, 'X IPS 2', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2363),
(397, '4101001097', 'Julia Mulyani', 'Perempuan', NULL, 'X IPA 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2364),
(398, '4101001098', 'Lidya Wahyudin', 'Perempuan', NULL, 'X IPA 4', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2365),
(399, '4101001099', 'Juli Pradipta', 'Perempuan', NULL, 'X IPS 3', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2366),
(400, '4101001100', 'Jayeng Uwais', 'Laki-laki', NULL, 'X IPA 1', NULL, NULL, NULL, 'aktif', NULL, '2026-06-27 12:49:49', '2026-06-27 12:51:02', 2367),
(401, '4101001101', 'Andika Pratama', 'Laki-laki', '2010-06-16', 'X IPS 4', 'Budi Santoso', '081234567890', 'Jl. Merdeka No. 45, Cepogo, Boyolali', 'aktif', NULL, '2026-06-27 13:15:02', '2026-06-27 13:23:32', 2368);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text,
  `type` enum('essay','multiple_choice') NOT NULL DEFAULT 'essay',
  `deadline` datetime NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `answer_key` text,
  `dibuat_oleh` bigint UNSIGNED DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `max_score` int NOT NULL DEFAULT '100',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guru_id` bigint UNSIGNED DEFAULT NULL,
  `prasyarat_materi_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `mata_pelajaran_id`, `kelas_id`, `judul`, `deskripsi`, `type`, `deadline`, `lampiran`, `answer_key`, `dibuat_oleh`, `status`, `max_score`, `created_at`, `updated_at`, `guru_id`, `prasyarat_materi_id`) VALUES
(1, 7, 49, 'TUGAS PAI PERTEMUAN 1', 'Petunjuk Pengerjaan:\r\n1. 2. 3. 4. Bacalah setiap soal dengan teliti sebelum menjawab.\r\nJawablah pertanyaan secara mandiri dan jujur, bukan hasil menyalin pekerjaan teman.\r\nTulis jawaban dengan kalimat yang jelas dan disertai dalil/ayat jika diperlukan.\r\nKumpulkan jawaban dalam bentuk file (Word/PDF/foto tulisan tangan) melalui menu\r\nTugas di E-Learning sesuai batas waktu yang ditentukan oleh guru', 'essay', '2026-06-29 23:59:00', 'tugas/C7OaHSxafr7lCnObSamFsZEWpXOXII10xunMIGms.pdf', NULL, NULL, 'aktif', 100, '2026-06-27 15:04:48', '2026-06-27 17:16:23', 121, NULL),
(2, 8, 57, 'TUGAS PAI PERTEMUAN 1', 'Petunjuk Pengerjaan:\r\n1. 2. 3. 4. Bacalah setiap soal dengan teliti sebelum menjawab.\r\nJawablah pertanyaan secara mandiri dan jujur, bukan hasil menyalin pekerjaan teman.\r\nTulis jawaban dengan kalimat yang jelas dan disertai dalil/ayat jika diperlukan.\r\nKumpulkan jawaban dalam bentuk file (Word/PDF/foto tulisan tangan) melalui menu\r\nTugas di E-Learning sesuai batas waktu yang ditentukan oleh guru', 'essay', '2026-06-29 23:59:00', 'tugas/qAGs95LINIFHyWspM0Oh9PEzR3AznR7tkdZT4dqS.pdf', NULL, NULL, 'aktif', 100, '2026-06-27 15:07:12', '2026-06-27 17:16:23', 121, NULL),
(3, 7, 49, 'TUGAS PAI PERTEMUAN 1', 'Petunjuk Pengerjaan:\r\n1. Bacalah setiap soal dengan teliti sebelum menjawab.\r\n2. Jawablah pertanyaan secara mandiri dan jujur, bukan hasil menyalin pekerjaan teman.\r\n3. Tulis jawaban dengan kalimat yang jelas dan disertai dalil/ayat jika diperlukan.\r\n4. Kumpulkan jawaban dalam bentuk file (Word/PDF/foto tulisan tangan) melalui menu\r\nTugas di E-Learning sesuai batas waktu yang ditentukan oleh guru.', 'essay', '2026-06-28 23:59:00', 'tugas/RVJy1Z9pJ0MZbux1j04v0SbeqAXcrRKx4A9fouL8.pdf', NULL, NULL, 'aktif', 100, '2026-06-27 15:12:45', '2026-06-27 17:16:23', 121, NULL),
(4, 8, 57, 'Tugas Pertemuan 2', 'Kerjakan tugas ini secara mandiri untuk menguji pemahaman Anda mengenai materi Al-Qur\'an sebagai Pedoman Hidup. Jawablah setiap soal dengan benar, jelas, dan sesuai dengan materi pembelajaran, kemudian kumpulkan sebelum batas waktu yang telah ditentukan oleh guru.', 'essay', '2026-06-30 22:59:00', 'tugas/ndKcD6Bt4xkiKEfiWtqJ93VAOvjz1qdXd0YZWUeF.pdf', NULL, NULL, 'aktif', 100, '2026-06-28 11:06:07', '2026-06-28 11:06:07', 121, NULL);

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
  ADD UNIQUE KEY `guru_nip_unique` (`nip`),
  ADD UNIQUE KEY `guru_email_unique` (`email`),
  ADD KEY `fk_guru_pengguna` (`pengguna_id`),
  ADD KEY `fk_guru_specialization_id` (`specialization_id`);

--
-- Indexes for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_kelas_guru_id_foreign` (`guru_id`),
  ADD KEY `guru_kelas_kelas_id_foreign` (`kelas_id`),
  ADD KEY `guru_kelas_mata_pelajaran_id_foreign` (`mata_pelajaran_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelas_name_academic_year_unique` (`name`,`academic_year`),
  ADD KEY `kelas_homeroom_teacher_id_foreign` (`homeroom_teacher_id`);

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
  ADD KEY `materials_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelacakan_materi`
--
ALTER TABLE `pelacakan_materi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelacakan_materi_siswa_id_materi_id_unique` (`siswa_id`,`materi_id`),
  ADD KEY `pelacakan_materi_siswa_id_index` (`siswa_id`),
  ADD KEY `pelacakan_materi_materi_id_foreign` (`materi_id`);

--
-- Indexes for table `pemulihan_akses`
--
ALTER TABLE `pemulihan_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pemulihan_siswa` (`siswa_id`),
  ADD KEY `fk_pemulihan_tugas` (`tugas_id`);

--
-- Indexes for table `pengajuan_banding`
--
ALTER TABLE `pengajuan_banding`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_banding_siswa` (`siswa_id`),
  ADD KEY `fk_banding_tugas` (`tugas_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengumpulan_tugas` (`tugas_id`),
  ADD KEY `fk_pengumpulan_siswa` (`siswa_id`);

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
  ADD KEY `fk_siswa_pengguna` (`pengguna_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tugas_mapel` (`mata_pelajaran_id`),
  ADD KEY `fk_tugas_guru` (`guru_id`),
  ADD KEY `tugas_prasyarat_materi_id_foreign` (`prasyarat_materi_id`),
  ADD KEY `tugas_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1182;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelacakan_materi`
--
ALTER TABLE `pelacakan_materi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemulihan_akses`
--
ALTER TABLE `pemulihan_akses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_banding`
--
ALTER TABLE `pengajuan_banding`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2369;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `fk_guru_pengguna` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`),
  ADD CONSTRAINT `fk_guru_specialization_id` FOREIGN KEY (`specialization_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD CONSTRAINT `guru_kelas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_kelas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_kelas_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_homeroom_teacher_id_foreign` FOREIGN KEY (`homeroom_teacher_id`) REFERENCES `guru` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materials_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `guru` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `fk_pemulihan_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`),
  ADD CONSTRAINT `fk_pemulihan_tugas` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);

--
-- Constraints for table `pengajuan_banding`
--
ALTER TABLE `pengajuan_banding`
  ADD CONSTRAINT `fk_banding_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`),
  ADD CONSTRAINT `fk_banding_tugas` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);

--
-- Constraints for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD CONSTRAINT `fk_pengumpulan_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`),
  ADD CONSTRAINT `fk_pengumpulan_tugas` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_siswa_pengguna` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `fk_tugas_guru` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`),
  ADD CONSTRAINT `fk_tugas_mapel` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `tugas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tugas_prasyarat_materi_id_foreign` FOREIGN KEY (`prasyarat_materi_id`) REFERENCES `materials` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
