-- Consolidated Database Restore for Sistem E-Learning
-- Created for manual import via phpMyAdmin

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- CREATE DATABASE IF NOT EXISTS `sistem_e_learning` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE `sistem_e_learning`;

-- --------------------------------------------------------

-- Table structure for table `migrations`
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('0001_01_01_000000_create_users_table', 1),
('0001_01_01_000001_create_cache_table', 1),
('0001_01_01_000002_create_jobs_table', 1),
('2026_01_12_092142_create_students_table', 1),
('2026_01_12_092759_create_invoices_table', 1),
('2026_01_12_102013_create_payments_table', 1),
('2026_01_12_121925_create_settings_table', 1),
('2026_01_12_144528_add_batch_id_to_invoices_table', 1),
('2026_01_12_155334_add_xendit_fields_to_invoices_table', 1),
('2026_01_13_030201_create_courses_table', 1),
('2026_01_13_033132_create_teachers_table', 1),
('2026_01_13_033139_create_class_rooms_table', 1),
('2026_01_13_033143_create_subjects_table', 1),
('2026_01_13_033151_create_enrollments_table', 1),
('2026_01_13_033159_create_assignments_table', 1),
('2026_01_13_033203_create_submissions_table', 1),
('2026_01_13_033207_create_grades_table', 1),
('2026_01_13_033211_create_materials_table', 1),
('2026_01_13_033214_create_attendances_table', 1),
('2026_01_13_033217_add_elearning_fields_to_students_table', 1),
('2026_01_13_064808_remove_status_from_class_rooms_table', 1),
('2026_01_13_105327_create_attendance_sessions_table', 1),
('2026_01_13_110105_create_personal_access_tokens_table', 1),
('2026_01_13_161500_add_type_and_answer_key_to_assignments_table', 1);

-- --------------------------------------------------------

-- Table structure for table `cache`
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `cache_locks`
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `jobs`
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `job_batches`
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `failed_jobs`
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `teachers`
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_nip_unique` (`nip`),
  UNIQUE KEY `teachers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `students`
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Laki-laki', 'Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `entry_year` year DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_nis_unique` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `users`
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('super_admin', 'teacher', 'student') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `courses`
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `credits` int(11) NOT NULL DEFAULT '2',
  `grade_level` enum('X', 'XI', 'XII') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `class_rooms`
DROP TABLE IF EXISTS `class_rooms`;
CREATE TABLE `class_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_level` enum('X', 'XI', 'XII') COLLATE utf8mb4_unicode_ci NOT NULL,
  `major` enum('IPA', 'IPS', 'Bahasa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `homeroom_teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_students` int(11) NOT NULL DEFAULT '36',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_rooms_homeroom_teacher_id_foreign` (`homeroom_teacher_id`),
  CONSTRAINT `class_rooms_homeroom_teacher_id_foreign` FOREIGN KEY (`homeroom_teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `subjects`
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `class_room_id` bigint(20) UNSIGNED NOT NULL,
  `day` enum('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` enum('1', '2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subjects_course_id_foreign` (`course_id`),
  KEY `subjects_teacher_id_foreign` (`teacher_id`),
  KEY `subjects_class_room_id_foreign` (`class_room_id`),
  CONSTRAINT `subjects_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subjects_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subjects_class_room_id_foreign` FOREIGN KEY (`class_room_id`) REFERENCES `class_rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `enrollments`
DROP TABLE IF EXISTS `enrollments`;
CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `class_room_id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_date` date NOT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active', 'inactive', 'graduated', 'dropped') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enrollments_student_id_foreign` (`student_id`),
  KEY `enrollments_class_room_id_foreign` (`class_room_id`),
  CONSTRAINT `enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `enrollments_class_room_id_foreign` FOREIGN KEY (`class_room_id`) REFERENCES `class_rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `assignments`
DROP TABLE IF EXISTS `assignments`;
CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('essay', 'multiple_choice') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'essay',
  `due_date` datetime NOT NULL,
  `max_score` int(11) NOT NULL DEFAULT '100',
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_key` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active', 'inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignments_subject_id_foreign` (`subject_id`),
  KEY `assignments_created_by_foreign` (`created_by`),
  CONSTRAINT `assignments_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assignments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `submissions`
DROP TABLE IF EXISTS `submissions`;
CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `assignment_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `submission_date` datetime NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('submitted', 'graded', 'late') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `submissions_assignment_id_student_id_unique` (`assignment_id`, `student_id`),
  KEY `submissions_student_id_foreign` (`student_id`),
  CONSTRAINT `submissions_assignment_id_foreign` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `submissions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `grades`
DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `submission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('assignment', 'quiz', 'midterm', 'final') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'assignment',
  `score` decimal(5,2) NOT NULL,
  `max_score` int(11) NOT NULL DEFAULT '100',
  `feedback` text COLLATE utf8mb4_unicode_ci,
  `graded_by` bigint(20) UNSIGNED NOT NULL,
  `graded_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grades_submission_id_foreign` (`submission_id`),
  KEY `grades_subject_id_foreign` (`subject_id`),
  KEY `grades_student_id_foreign` (`student_id`),
  KEY `grades_graded_by_foreign` (`graded_by`),
  CONSTRAINT `grades_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `submissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grades_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grades_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grades_graded_by_foreign` FOREIGN KEY (`graded_by`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `materials`
DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('pdf', 'video', 'link', 'document', 'other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'document',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materials_subject_id_foreign` (`subject_id`),
  KEY `materials_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `materials_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `materials_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `attendances`
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('Hadir', 'Izin', 'Sakit', 'Alpa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hadir',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `marked_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendances_subject_id_student_id_date_unique` (`subject_id`, `student_id`, `date`),
  KEY `attendances_student_id_foreign` (`student_id`),
  KEY `attendances_marked_by_foreign` (`marked_by`),
  CONSTRAINT `attendances_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendances_marked_by_foreign` FOREIGN KEY (`marked_by`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `attendance_sessions`
DROP TABLE IF EXISTS `attendance_sessions`;
CREATE TABLE `attendance_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `qr_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendance_sessions_qr_token_unique` (`qr_token`),
  KEY `attendance_sessions_subject_id_foreign` (`subject_id`),
  KEY `attendance_sessions_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `attendance_sessions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendance_sessions_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `invoices`
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xendit_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(15,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('unpaid', 'partial', 'paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  KEY `invoices_student_id_foreign` (`student_id`),
  KEY `invoices_batch_id_index` (`batch_id`),
  CONSTRAINT `invoices_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `payments`
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `payment_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` enum('cash', 'transfer', 'qris') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_payment_number_unique` (`payment_number`),
  KEY `payments_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `settings`
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `personal_access_tokens`
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `sessions`
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `password_reset_tokens`
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- SEED DATA
-- --------------------------------------------------------

-- INSERT Teachers
INSERT INTO `teachers` (`id`, `nip`, `name`, `email`, `phone`, `specialization`, `status`, `created_at`, `updated_at`) VALUES
(1, '197001011995031001', 'Pak Budi Santoso', 'budi@edulearn.com', '081234567890', 'Matematika', 'active', NOW(), NOW()),
(2, '197505051996032002', 'Ibu Siti Aminah', 'siti@edulearn.com', '081234567891', 'Fisika', 'active', NOW(), NOW()),
(3, '198002021997031003', 'Pak Ahmad Yani', 'ahmad@edulearn.com', '081234567892', 'Kimia', 'active', NOW(), NOW());

-- INSERT Students (From insert_students_phpmyadmin.sql)
INSERT INTO `students` (`id`, `nis`, `name`, `gender`, `date_of_birth`, `entry_year`, `class`, `parent_name`, `parent_phone`, `parent_email`, `address`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, '2025001', 'Andi Pratama', 'Laki-laki', '2009-05-15', 2025, 'X IPA 1', 'Bapak Pratama', '081234567801', 'pratama@email.com', 'Jl. Merdeka No. 1, Jakarta', NULL, 'active', NOW(), NOW()),
(2, '2025002', 'Budi Santoso', 'Laki-laki', '2009-03-20', 2025, 'X IPA 1', 'Bapak Santoso', '081234567802', 'santoso@email.com', 'Jl. Sudirman No. 2, Jakarta', NULL, 'active', NOW(), NOW()),
(3, '2025003', 'Citra Dewi', 'Perempuan', '2009-07-10', 2025, 'X IPA 1', 'Ibu Dewi', '081234567803', 'dewi@email.com', 'Jl. Gatot Subroto No. 3, Jakarta', NULL, 'active', NOW(), NOW()),
(4, '2025004', 'Dian Puspita', 'Perempuan', '2009-09-25', 2025, 'X IPA 2', 'Bapak Puspita', '081234567804', 'puspita@email.com', 'Jl. Ahmad Yani No. 4, Jakarta', NULL, 'active', NOW(), NOW()),
(5, '2025005', 'Eko Prasetyo', 'Laki-laki', '2009-11-30', 2025, 'X IPA 2', 'Ibu Prasetyo', '081234567805', 'prasetyo@email.com', 'Jl. Diponegoro No. 5, Jakarta', NULL, 'active', NOW(), NOW()),
(6, '2025006', 'Farah Wijaya', 'Perempuan', '2009-02-14', 2025, 'X IPA 2', 'Bapak Wijaya', '081234567806', 'wijaya@email.com', 'Jl. Thamrin No. 6, Jakarta', NULL, 'active', NOW(), NOW()),
(7, '2025007', 'Gilang Kusuma', 'Laki-laki', '2009-06-18', 2025, 'X IPS 1', 'Ibu Kusuma', '081234567807', 'kusuma@email.com', 'Jl. Rasuna Said No. 7, Jakarta', NULL, 'active', NOW(), NOW()),
(8, '2025008', 'Hana Permata', 'Perempuan', '2009-04-22', 2025, 'X IPS 1', 'Bapak Permata', '081234567808', 'permata@email.com', 'Jl. Kuningan No. 8, Jakarta', NULL, 'active', NOW(), NOW()),
(9, '2025009', 'Indra Saputra', 'Laki-laki', '2009-08-05', 2025, 'X IPS 1', 'Ibu Saputra', '081234567809', 'saputra@email.com', 'Jl. Senayan No. 9, Jakarta', NULL, 'active', NOW(), NOW()),
(10, '2025010', 'Joko Lestari', 'Laki-laki', '2009-10-12', 2025, 'XI IPA 1', 'Bapak Lestari', '081234567810', 'lestari@email.com', 'Jl. Menteng No. 10, Jakarta', NULL, 'active', NOW(), NOW()),
(11, '2025011', 'Kartika Hakim', 'Perempuan', '2009-01-08', 2025, 'XI IPA 1', 'Ibu Hakim', '081234567811', 'hakim@email.com', 'Jl. Kebayoran No. 11, Jakarta', NULL, 'active', NOW(), NOW()),
(12, '2025012', 'Lina Nugroho', 'Perempuan', '2009-12-17', 2025, 'XI IPA 1', 'Bapak Nugroho', '081234567812', 'nugroho@email.com', 'Jl. Blok M No. 12, Jakarta', NULL, 'active', NOW(), NOW()),
(13, '2025013', 'Maya Sari', 'Perempuan', '2009-03-28', 2025, 'XI IPA 2', 'Ibu Sari', '081234567813', 'sari@email.com', 'Jl. Kemang No. 13, Jakarta', NULL, 'active', NOW(), NOW()),
(14, '2025014', 'Nanda Ramadhan', 'Laki-laki', '2009-05-11', 2025, 'XI IPA 2', 'Bapak Ramadhan', '081234567814', 'ramadhan@email.com', 'Jl. Pondok Indah No. 14, Jakarta', NULL, 'active', NOW(), NOW()),
(15, '2025015', 'Oscar Hidayat', 'Laki-laki', '2009-07-19', 2025, 'XI IPA 2', 'Ibu Hidayat', '081234567815', 'hidayat@email.com', 'Jl. Cilandak No. 15, Jakarta', NULL, 'active', NOW(), NOW()),
(16, '2025016', 'Putri Wijaya', 'Perempuan', '2009-09-03', 2025, 'XI IPS 1', 'Bapak Wijaya', '081234567816', 'pwijaya@email.com', 'Jl. Fatmawati No. 16, Jakarta', NULL, 'active', NOW(), NOW()),
(17, '2025017', 'Qori Pratama', 'Laki-laki', '2009-11-21', 2025, 'XI IPS 1', 'Ibu Pratama', '081234567817', 'qpratama@email.com', 'Jl. Tebet No. 17, Jakarta', NULL, 'active', NOW(), NOW()),
(18, '2025018', 'Rani Santoso', 'Perempuan', '2009-02-27', 2025, 'XI IPS 1', 'Bapak Santoso', '081234567818', 'rsantoso@email.com', 'Jl. Cikini No. 18, Jakarta', NULL, 'active', NOW(), NOW()),
(19, '2025019', 'Sinta Dewi', 'Perempuan', '2009-04-15', 2025, 'XII IPA 1', 'Ibu Dewi', '081234567819', 'sdewi@email.com', 'Jl. Gondangdia No. 19, Jakarta', NULL, 'active', NOW(), NOW()),
(20, '2025020', 'Toni Kusuma', 'Laki-laki', '2009-06-09', 2025, 'XII IPA 1', 'Bapak Kusuma', '081234567820', 'tkusuma@email.com', 'Jl. Cempaka Putih No. 20, Jakarta', NULL, 'active', NOW(), NOW()),
(21, '2025021', 'Umar Lestari', 'Laki-laki', '2009-08-23', 2025, 'XII IPA 1', 'Ibu Lestari', '081234567821', 'ulestari@email.com', 'Jl. Senen No. 21, Jakarta', NULL, 'active', NOW(), NOW()),
(22, '2025022', 'Vina Hakim', 'Perempuan', '2009-10-07', 2025, 'XII IPA 2', 'Bapak Hakim', '081234567822', 'vhakim@email.com', 'Jl. Manggarai No. 22, Jakarta', NULL, 'active', NOW(), NOW()),
(23, '2025023', 'Wahyu Nugroho', 'Laki-laki', '2009-12-31', 2025, 'XII IPA 2', 'Ibu Nugroho', '081234567823', 'wnugroho@email.com', 'Jl. Pancoran No. 23, Jakarta', NULL, 'active', NOW(), NOW()),
(24, '2025024', 'Yuni Sari', 'Perempuan', '2009-01-16', 2025, 'XII IPA 2', 'Bapak Sari', '081234567824', 'ysari@email.com', 'Jl. Kalibata No. 24, Jakarta', NULL, 'active', NOW(), NOW()),
(25, '2025025', 'Zahra Ramadhan', 'Perempuan', '2009-03-04', 2025, 'XII IPS 1', 'Ibu Ramadhan', '081234567825', 'zramadhan@email.com', 'Jl. Pasar Minggu No. 25, Jakarta', NULL, 'active', NOW(), NOW()),
(26, '2025026', 'Aldi Hidayat', 'Laki-laki', '2009-05-29', 2025, 'XII IPS 1', 'Bapak Hidayat', '081234567826', 'ahidayat@email.com', 'Jl. Ragunan No. 26, Jakarta', NULL, 'active', NOW(), NOW()),
(27, '2025027', 'Bella Puspita', 'Perempuan', '2009-07-13', 2025, 'XII IPS 1', 'Ibu Puspita', '081234567827', 'bpuspita@email.com', 'Jl. Jagakarsa No. 27, Jakarta', NULL, 'active', NOW(), NOW()),
(28, '2025028', 'Candra Prasetyo', 'Laki-laki', '2009-09-26', 2025, 'X IPA 1', 'Bapak Prasetyo', '081234567828', 'cprasetyo@email.com', 'Jl. Lenteng Agung No. 28, Jakarta', NULL, 'active', NOW(), NOW()),
(29, '2025029', 'Desi Wijaya', 'Perempuan', '2009-11-10', 2025, 'X IPA 2', 'Ibu Wijaya', '081234567829', 'dwijaya@email.com', 'Jl. Cinere No. 29, Jakarta', NULL, 'active', NOW(), NOW()),
(30, '2025030', 'Erwin Kusuma', 'Laki-laki', '2009-02-02', 2025, 'X IPA 2', 'Bapak Kusuma', '081234567830', 'ekusuma@email.com', 'Jl. Depok No. 30, Jakarta', NULL, 'active', NOW(), NOW()),
(31, '2025031', 'Fitri Permata', 'Perempuan', '2009-04-24', 2025, 'X IPS 1', 'Ibu Permata', '081234567831', 'fpermata@email.com', 'Jl. Tangerang No. 31, Jakarta', NULL, 'active', NOW(), NOW()),
(32, '2025032', 'Gita Saputra', 'Perempuan', '2009-06-18', 2025, 'X IPS 1', 'Bapak Saputra', '081234567832', 'gsaputra@email.com', 'Jl. Bekasi No. 32, Jakarta', NULL, 'active', NOW(), NOW()),
(33, '2025033', 'Hendra Lestari', 'Laki-laki', '2009-08-01', 2025, 'X IPS 1', 'Ibu Lestari', '081234567833', 'hlestari@email.com', 'Jl. Bogor No. 33, Jakarta', NULL, 'active', NOW(), NOW()),
(34, '2025034', 'Intan Hakim', 'Perempuan', '2009-10-15', 2025, 'XI IPA 1', 'Bapak Hakim', '081234567834', 'ihakim@email.com', 'Jl. Cibubur No. 34, Jakarta', NULL, 'active', NOW(), NOW()),
(35, '2025035', 'Johan Nugroho', 'Laki-laki', '2009-12-29', 2025, 'XI IPA 2', 'Ibu Nugroho', '081234567835', 'jnugroho@email.com', 'Jl. Cileungsi No. 35, Jakarta', NULL, 'active', NOW(), NOW()),
(36, '2025036', 'Kirana Sari', 'Perempuan', '2009-01-21', 2025, 'XI IPA 2', 'Bapak Sari', '081234567836', 'ksari@email.com', 'Jl. Cibinong No. 36, Jakarta', NULL, 'active', NOW(), NOW()),
(37, '2025037', 'Lutfi Ramadhan', 'Laki-laki', '2009-03-14', 2025, 'XI IPS 1', 'Ibu Ramadhan', '081234567837', 'lramadhan@email.com', 'Jl. Sentul No. 37, Jakarta', NULL, 'active', NOW(), NOW()),
(38, '2025038', 'Mira Hidayat', 'Perempuan', '2009-05-08', 2025, 'XI IPS 1', 'Bapak Hidayat', '081234567838', 'mhidayat@email.com', 'Jl. Jonggol No. 38, Jakarta', NULL, 'active', NOW(), NOW()),
(39, '2025039', 'Noval Pratama', 'Laki-laki', '2009-07-22', 2025, 'XII IPA 1', 'Ibu Pratama', '081234567839', 'npratama@email.com', 'Jl. Cariu No. 39, Jakarta', NULL, 'active', NOW(), NOW()),
(40, '2025040', 'Olivia Santoso', 'Perempuan', '2009-09-05', 2025, 'XII IPA 2', 'Bapak Santoso', '081234567840', 'osantoso@email.com', 'Jl. Karawang No. 40, Jakarta', NULL, 'active', NOW(), NOW());

-- INSERT Users
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `teacher_id`, `student_id`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@edulearn.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'super_admin', NULL, NULL, NOW(), NOW(), NOW()),
(2, 'Pak Budi Santoso', 'budi@edulearn.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'teacher', 1, NULL, NOW(), NOW(), NOW()),
(3, 'Ibu Siti Aminah', 'siti@edulearn.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'teacher', 2, NULL, NOW(), NOW(), NOW()),
(4, 'Pak Ahmad Yani', 'ahmad@edulearn.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'teacher', 3, NULL, NOW(), NOW(), NOW()),
(5, 'Andi Pratama', 'andi@student.edulearn.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', NULL, 1, NOW(), NOW(), NOW()),
(6, 'Budi Santoso', 'budis@student.edulearn.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', NULL, 2, NOW(), NOW(), NOW());

-- INSERT Courses
INSERT INTO `courses` (`id`, `code`, `name`, `description`, `credits`, `grade_level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MTK', 'Matematika', 'Matematika Wajib', 4, 'X', 'active', NOW(), NOW()),
(2, 'FIS', 'Fisika', 'Ilmu Fisika', 4, 'X', 'active', NOW(), NOW()),
(3, 'KIM', 'Kimia', 'Ilmu Kimia', 4, 'X', 'active', NOW(), NOW());

-- INSERT Class Rooms
INSERT INTO `class_rooms` (`id`, `name`, `grade_level`, `major`, `homeroom_teacher_id`, `academic_year`, `max_students`, `created_at`, `updated_at`) VALUES
(1, 'X IPA 1', 'X', 'IPA', 1, '2025/2026', 36, NOW(), NOW()),
(2, 'X IPA 2', 'X', 'IPA', 2, '2025/2026', 36, NOW(), NOW()),
(3, 'X IPS 1', 'X', 'IPS', 3, '2025/2026', 36, NOW(), NOW()),
(4, 'XI IPA 1', 'XI', 'IPA', 1, '2025/2026', 36, NOW(), NOW());

-- INSERT Enrollments
INSERT INTO `enrollments` (`id`, `student_id`, `class_room_id`, `enrollment_date`, `academic_year`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-07-15', '2025/2026', 'active', NOW(), NOW()),
(2, 2, 1, '2025-07-15', '2025/2026', 'active', NOW(), NOW()),
(3, 3, 2, '2025-07-15', '2025/2026', 'active', NOW(), NOW()),
(4, 4, 3, '2025-07-15', '2025/2026', 'active', NOW(), NOW());

-- INSERT Subjects
INSERT INTO `subjects` (`id`, `course_id`, `teacher_id`, `class_room_id`, `day`, `start_time`, `end_time`, `room`, `semester`, `academic_year`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Senin', '07:00:00', '08:30:00', 'R101', '1', '2025/2026', NOW(), NOW()),
(2, 1, 1, 2, 'Selasa', '07:00:00', '08:30:00', 'R102', '1', '2025/2026', NOW(), NOW()),
(3, 1, 1, 4, 'Rabu', '07:00:00', '08:30:00', 'R103', '1', '2025/2026', NOW(), NOW()),
(4, 2, 2, 1, 'Kamis', '07:00:00', '08:30:00', 'Lab Fisika', '1', '2025/2026', NOW(), NOW()),
(5, 2, 2, 2, 'Jumat', '07:00:00', '08:30:00', 'Lab Fisika', '1', '2025/2026', NOW(), NOW()),
(6, 3, 3, 1, 'Senin', '09:00:00', '10:30:00', 'Lab Kimia', '1', '2025/2026', NOW(), NOW());

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;
