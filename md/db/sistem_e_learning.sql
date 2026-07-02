-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 24, 2026 at 12:11 AM
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
-- Database: `sistem_e_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hadir',
  `notes` text COLLATE utf8mb4_unicode_ci,
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
  `qr_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `type` enum('assignment','quiz','midterm','final') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'assignment',
  `score` decimal(5,2) NOT NULL,
  `max_score` int NOT NULL DEFAULT '100',
  `feedback` text COLLATE utf8mb4_unicode_ci,
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
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spesialisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization_id` bigint UNSIGNED DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `pengguna_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama`, `email`, `no_hp`, `spesialisasi`, `specialization_id`, `alamat`, `status`, `pengguna_id`, `created_at`, `updated_at`) VALUES
(1, '197001011995031001', 'Pak Budi Santoso', 'budi@guru.smansago.com', '081234567890', 'Matematika', 1, NULL, 'aktif', 1, '2026-06-07 05:14:27', '2026-06-07 05:14:27'),
(2, '197505051996032002', 'Ibu Siti Aminah Test', 'siti@guru.smansago.com.test', '081234567891', 'Fisika', 2, NULL, 'aktif', 2, '2026-06-07 05:14:27', '2026-06-19 09:09:20'),
(3, '198002021997031003', 'Pak Ahmad Yani', 'ahmad@guru.smansago.com', '081234567892', 'Kimia', 3, NULL, 'aktif', 3, '2026-06-07 05:14:27', '2026-06-07 05:14:27'),
(4, '200008232020109847', 'Ilham, S.M', 'ilham@guru.smansago.com', '08767846372', 'BAHASA INDONESIA', 5, 'Kota Pontianak', 'aktif', 14, '2026-06-19 18:16:33', '2026-06-19 18:16:33');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xendit_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(15,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('unpaid','partial','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_level` enum('X','XI','XII') COLLATE utf8mb4_unicode_ci NOT NULL,
  `major` enum('IPA','IPS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `homeroom_teacher_id` bigint UNSIGNED DEFAULT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_students` int NOT NULL DEFAULT '40',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `name`, `grade_level`, `major`, `homeroom_teacher_id`, `academic_year`, `max_students`, `created_at`, `updated_at`) VALUES
(1, 'X IPA 1', 'X', 'IPA', 1, '2025/2026', 38, '2026-06-19 08:30:37', '2026-06-19 08:35:30'),
(2, 'X IPA 2', 'X', 'IPA', 3, '2025/2026', 36, '2026-06-19 08:30:37', '2026-06-19 18:11:14'),
(3, 'X IPA 3', 'X', 'IPA', 4, '2025/2026', 36, '2026-06-19 08:30:37', '2026-06-19 18:16:46'),
(4, 'X IPA 4', 'X', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:37', '2026-06-19 08:30:37'),
(5, 'X IPA 5', 'X', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:37', '2026-06-19 08:30:37'),
(6, 'X IPS 1', 'X', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:37', '2026-06-19 08:30:37'),
(7, 'X IPS 2', 'X', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:37', '2026-06-19 08:30:37'),
(8, 'X IPS 3', 'X', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:37', '2026-06-19 08:30:37'),
(9, 'X IPS 4', 'X', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:37', '2026-06-19 08:30:37'),
(10, 'X IPS 5', 'X', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:37', '2026-06-19 08:30:37'),
(11, 'XI IPA 1', 'XI', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(12, 'XI IPA 2', 'XI', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(13, 'XI IPA 3', 'XI', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(14, 'XI IPA 4', 'XI', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(15, 'XI IPA 5', 'XI', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(16, 'XI IPS 1', 'XI', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(17, 'XI IPS 2', 'XI', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(18, 'XI IPS 3', 'XI', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(19, 'XI IPS 4', 'XI', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(20, 'XI IPS 5', 'XI', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(21, 'XII IPA 1', 'XII', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(22, 'XII IPA 2', 'XII', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(23, 'XII IPA 3', 'XII', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(24, 'XII IPA 4', 'XII', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(25, 'XII IPA 5', 'XII', 'IPA', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(26, 'XII IPS 1', 'XII', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(27, 'XII IPS 2', 'XII', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(28, 'XII IPS 3', 'XII', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(29, 'XII IPS 4', 'XII', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(30, 'XII IPS 5', 'XII', 'IPS', NULL, '2025/2026', 36, '2026-06-19 08:30:49', '2026-06-19 08:30:49'),
(31, 'X IPA 6', 'X', 'IPA', 2, '2025/2026', 36, '2026-06-19 08:32:54', '2026-06-19 08:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `tingkat` enum('X','XI','XII') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `kode`, `nama`, `deskripsi`, `tingkat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MTK-X', 'Matematika X', 'Matematika Wajib Kelas X', 'X', 'aktif', '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(2, 'FIS-X', 'Fisika X', 'Fisika Kelas X', 'X', 'aktif', '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(3, 'KIM-X', 'Kimia X', 'Kimia Kelas X', 'X', 'aktif', '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(4, 'TIK-X', 'TIK 1', 'Teknologi Informasi dan Komunikasi 1', 'X', 'aktif', '2026-06-19 18:16:33', '2026-06-19 18:16:33'),
(5, 'BINDX', 'Bahasa Indonesia X', 'Bahasa Indonesia Kelas X', 'X', 'aktif', '2026-06-19 18:16:33', '2026-06-19 18:16:33'),
(6, 'TIK-XI', 'TIK LANJUTAN', 'TIK Lanjutan Kelas XI', 'XI', 'aktif', '2026-06-19 18:16:33', '2026-06-19 18:16:33');

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
(32, '2026_06_07_125438_create_kelas_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `payment_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` enum('cash','transfer','qris') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
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
  `status_pemulihan` enum('aktif','selesai','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `durasi_jam` int NOT NULL DEFAULT '48',
  `tugas_id` bigint UNSIGNED DEFAULT NULL,
  `mulai_pemulihan` timestamp NULL DEFAULT NULL,
  `batas_pemulihan` timestamp NULL DEFAULT NULL,
  `selesai_pemulihan` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_banding`
--

CREATE TABLE `pengajuan_banding` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggapan_guru` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ditinjau','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ditinjau',
  `disetujui_oleh` bigint UNSIGNED DEFAULT NULL,
  `tanggal_persetujuan` timestamp NULL DEFAULT NULL,
  `tugas_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guru','siswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pak Budi Santoso', 'budi@guru.smansago.com', NULL, '$2y$12$BiP3occJOx.R01Zp820weuBe/nVwhPub0lwU56cVfqWbPHD6Y9F.a', 'guru', NULL, '2026-06-07 05:14:27', '2026-06-07 05:14:27'),
(2, 'Ibu Siti Aminah Test', 'siti@guru.smansago.com.test', NULL, '$2y$12$FnSw8JLMpDmRvgQ/CHpLy.WX/3JNCGjJMW8Le4PYQOe7ENA7wWra6', 'guru', NULL, '2026-06-07 05:14:27', '2026-06-19 09:09:20'),
(3, 'Pak Ahmad Yani', 'ahmad@guru.smansago.com', NULL, '$2y$12$hVyaZPRnphAY3W.98.XkseGgDtBVz8h8QOsr4Payw266WZoGyL5xW', 'guru', NULL, '2026-06-07 05:14:27', '2026-06-07 05:14:27'),
(4, 'Andi Pratama', 'andi@siswa.smansago.com', NULL, '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NULL, '2026-06-07 05:14:27', '2026-06-07 05:14:27'),
(5, 'Budi Santoso', 'budi@siswa.smansago.com', NULL, '$2y$12$FxPPrkCzBn9oC6Qp6mSFqO7ktTDJ9dwjvlh15sGtBaOc/9XhOuVq2', 'siswa', NULL, '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(6, 'Super Admin', 'admin@admin.smansago.com', NULL, '$2y$12$LwN6FHA5reNjKdsWLEZpNe2LwgY.szZC7hzuhzWC8OFPfkvfFfWLe', 'admin', NULL, '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(8, 'Staf Tata Usaha', 'tu@admin.smansago.com', NULL, '$2y$12$EZhO2283GKr8/9aMMTlUZ.cLdt6TixxI6wkiUTOKX2kiSkvflwOD.', 'admin', NULL, '2026-06-19 09:00:19', '2026-06-19 09:00:19'),
(10, 'Wahyu', '2025003@siswa.smansago.com', NULL, '$2y$12$9qxXyLvalxdmtpVSmRn8KOsHsOVSftqjVBeVP6cb2ewEyYqMFsGN.', 'siswa', NULL, '2026-06-19 17:40:45', '2026-06-19 17:40:45'),
(11, 'homsi', '2025004@siswa.smansago.com', NULL, '$2y$12$9DxAspfFXEM6aBTHHZMLaOqfXEncxByJYRKwh4E.2jpwlIMd93p0.', 'siswa', NULL, '2026-06-19 17:42:47', '2026-06-19 17:42:47'),
(13, 'Wahyu test dropdown', '2025005@siswa.smansago.com', NULL, '$2y$12$pPkpHLDGo80PH/bFSIeFy.Qcd2hh3bBEnJIEACMZxoP0bsbDOnBzi', 'siswa', NULL, '2026-06-19 17:59:45', '2026-06-19 17:59:45'),
(14, 'Ilham, S.M', 'ilham@guru.smansago.com', NULL, '$2y$12$6WVlOtLDX2/xJwR7GYSfAOYKAwqs2O2Ch/brMRbkbSkuN6.vXcXtG', 'guru', NULL, '2026-06-19 18:16:33', '2026-06-19 18:16:33');

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
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint UNSIGNED DEFAULT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drive_link` text COLLATE utf8mb4_unicode_ci,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('terkumpul','terlambat','belum','graded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `entry_year` year DEFAULT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ortu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_ortu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `acc_batch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengguna_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `entry_year`, `kelas`, `nama_ortu`, `no_hp_ortu`, `alamat`, `photo`, `status`, `acc_batch_id`, `pengguna_id`, `created_at`, `updated_at`) VALUES
(1, '2025001', 'Andi Pratama', 'Laki-laki', '2009-05-15', NULL, 'X IPA 1', 'Bapak Pratama', '081234567801', 'Jl. Merdeka No. 1, Boyolali', NULL, 'aktif', NULL, 4, '2026-06-07 05:14:27', '2026-06-07 05:14:27'),
(2, '2025002', 'Budi Santoso', 'Laki-laki', '2009-03-20', NULL, 'X IPA 1', 'Bapak Santoso', '081234567802', 'Jl. Sudirman No. 2, Boyolali', NULL, 'aktif', NULL, 5, '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(4, '2025003', 'Wahyu', 'Laki-laki', '2009-01-01', NULL, 'X IPA 1', NULL, NULL, NULL, NULL, 'aktif', NULL, 10, '2026-06-19 17:40:45', '2026-06-19 17:40:45'),
(5, '2025004', 'homsi', 'Laki-laki', '2000-06-20', NULL, 'X IPA 1', 'John Cena', '08765746352', 'Kota Magelang', NULL, 'aktif', NULL, 11, '2026-06-19 17:42:47', '2026-06-19 17:42:47'),
(7, '2025005', 'Wahyu test dropdown', 'Laki-laki', '2003-08-14', NULL, 'X IPA 2', 'Orang Tua', '08768571232', 'Klaten', NULL, 'aktif', NULL, 13, '2026-06-19 17:59:45', '2026-06-19 17:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `type` enum('essay','multiple_choice') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'essay',
  `deadline` datetime NOT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_key` text COLLATE utf8mb4_unicode_ci,
  `guru_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `max_score` int NOT NULL DEFAULT '100',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `mata_pelajaran_id`, `judul`, `deskripsi`, `type`, `deadline`, `lampiran`, `answer_key`, `guru_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tugas Matematika Logika', 'Kerjakan latihan soal bab 1 nomor 1-10.', 'essay', '2026-06-12 12:14:28', NULL, NULL, 1, 'aktif', '2026-06-07 05:14:28', '2026-06-07 05:14:28'),
(2, 2, 'Tugas Fisika Kinematika', 'Kerjakan laporan praktikum Gerak Lurus Beraturan.', 'essay', '2026-06-10 12:14:28', NULL, NULL, 2, 'aktif', '2026-06-07 05:14:28', '2026-06-07 05:14:28');

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `guru_nip_unique` (`nip`),
  ADD UNIQUE KEY `guru_email_unique` (`email`),
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
  ADD KEY `tugas_guru_id_foreign` (`guru_id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `materials_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materials_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `guru` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tugas_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
