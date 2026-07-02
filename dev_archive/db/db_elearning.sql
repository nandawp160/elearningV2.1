-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2026 at 11:36 AM
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
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `spesialisasi` varchar(255) DEFAULT NULL,
  `alamat` text,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pengguna_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `tugas_id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `file_tugas` varchar(255) DEFAULT NULL,
  `tanggal_pengumpulan` datetime DEFAULT NULL,
  `status` enum('terkumpul','terlambat','belum') DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pengguna_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text,
  `deadline` datetime NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guru_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_guru_pengguna` (`pengguna_id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_siswa_pengguna` (`pengguna_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tugas_mapel` (`mata_pelajaran_id`),
  ADD KEY `fk_tugas_guru` (`guru_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `fk_guru_pengguna` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`);

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
  ADD CONSTRAINT `fk_tugas_mapel` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
