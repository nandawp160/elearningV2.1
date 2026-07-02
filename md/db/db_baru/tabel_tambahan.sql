-- =========================================================================
-- SQL Tambahan untuk Mempersiapkan Database Baru (db_elearning)
-- Jalankan query ini setelah mengimpor db_elearning.sql agar database 
-- memiliki 12 tabel lengkap yang dibutuhkan oleh sistem aktif.
-- =========================================================================

-- 1. Membuat tabel 'settings'
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 2. Membuat tabel 'kelas'
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `grade_level` enum('X','XI','XII') NOT NULL,
  `major` enum('IPA','IPS') NOT NULL,
  `homeroom_teacher_id` bigint UNSIGNED DEFAULT NULL,
  `academic_year` varchar(255) NOT NULL,
  `max_students` int NOT NULL DEFAULT '40',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas_homeroom_teacher_id_foreign` (`homeroom_teacher_id`),
  CONSTRAINT `kelas_homeroom_teacher_id_foreign` FOREIGN KEY (`homeroom_teacher_id`) REFERENCES `guru` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 3. Membuat tabel 'guru_kelas' (pivot guru mengajar kelas)
CREATE TABLE IF NOT EXISTS `guru_kelas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `guru_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_kelas_guru_id_foreign` (`guru_id`),
  KEY `guru_kelas_kelas_id_foreign` (`kelas_id`),
  KEY `guru_kelas_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  CONSTRAINT `guru_kelas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_kelas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guru_kelas_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 4. Membuat tabel 'grades' (nilai siswa)
CREATE TABLE IF NOT EXISTS `grades` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grades_submission_id_foreign` (`submission_id`),
  KEY `grades_subject_id_foreign` (`subject_id`),
  KEY `grades_student_id_foreign` (`student_id`),
  KEY `grades_graded_by_foreign` (`graded_by`),
  CONSTRAINT `grades_graded_by_foreign` FOREIGN KEY (`graded_by`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grades_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grades_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `mata_pelajaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grades_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `pengumpulan_tugas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 5. Membuat tabel 'sessions' (untuk penyimpanan session database)
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 6. Membuat tabel 'cache' (untuk caching database)
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 7. Membuat tabel 'cache_locks' (untuk locking cache database)
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
