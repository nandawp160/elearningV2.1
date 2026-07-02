-- SQL IMPORT DATA SISWA (EXCEL TO DATABASE)
-- Generated on 2026-06-26 01:01:40
-- Total Students to import: 300

-- Student: Budi Dewi (3101001001) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Budi Dewi', '3101001001@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001001', 'Budi Dewi', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001001@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lukman Hidayat (3101001002) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lukman Hidayat', '3101001002@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001002', 'Lukman Hidayat', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001002@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Anisa Saputra (3101001003) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Anisa Saputra', '3101001003@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001003', 'Anisa Saputra', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001003@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fahmi Setiawan (3101001004) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fahmi Setiawan', '3101001004@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001004', 'Fahmi Setiawan', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001004@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Chandra Putri (3101001005) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Chandra Putri', '3101001005@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001005', 'Chandra Putri', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001005@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Kevin Purnomo (3101001006) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Kevin Purnomo', '3101001006@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001006', 'Kevin Purnomo', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001006@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Muhammad Siregar (3101001007) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Muhammad Siregar', '3101001007@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001007', 'Muhammad Siregar', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001007@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Aditya Wulandari (3101001008) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Aditya Wulandari', '3101001008@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001008', 'Aditya Wulandari', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001008@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lukman Budiman (3101001009) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lukman Budiman', '3101001009@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001009', 'Lukman Budiman', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001009@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fahmi Gunawan (3101001010) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fahmi Gunawan', '3101001010@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001010', 'Fahmi Gunawan', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001010@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Kevin Kusuma (3101001011) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Kevin Kusuma', '3101001011@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001011', 'Kevin Kusuma', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001011@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dewi Wulandari (3101001012) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dewi Wulandari', '3101001012@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001012', 'Dewi Wulandari', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001012@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fitri Budiman (3101001013) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fitri Budiman', '3101001013@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001013', 'Fitri Budiman', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001013@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Aditya Nasution (3101001014) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Aditya Nasution', '3101001014@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001014', 'Aditya Nasution', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001014@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hafiz Sari (3101001015) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hafiz Sari', '3101001015@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001015', 'Hafiz Sari', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001015@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Chandra Situmorang (3101001016) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Chandra Situmorang', '3101001016@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001016', 'Chandra Situmorang', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001016@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Elena Hayati (3101001017) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Elena Hayati', '3101001017@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001017', 'Elena Hayati', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001017@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Naufal Siregar (3101001018) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Naufal Siregar', '3101001018@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001018', 'Naufal Siregar', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001018@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Satria Putri (3101001019) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Satria Putri', '3101001019@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001019', 'Satria Putri', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001019@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Irfan Nugroho (3101001020) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Irfan Nugroho', '3101001020@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001020', 'Irfan Nugroho', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001020@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hendra Pratama (3101001021) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hendra Pratama', '3101001021@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001021', 'Hendra Pratama', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001021@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gita Putri (3101001022) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gita Putri', '3101001022@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001022', 'Gita Putri', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001022@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Eka Nugroho (3101001023) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eka Nugroho', '3101001023@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001023', 'Eka Nugroho', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001023@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dedi Sari (3101001024) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dedi Sari', '3101001024@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001024', 'Dedi Sari', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001024@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Agus Situmorang (3101001025) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Agus Situmorang', '3101001025@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001025', 'Agus Situmorang', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001025@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tania Wulandari (3101001026) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tania Wulandari', '3101001026@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001026', 'Tania Wulandari', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001026@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Citra Sari (3101001027) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Citra Sari', '3101001027@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001027', 'Citra Sari', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001027@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rina Budiman (3101001028) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rina Budiman', '3101001028@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001028', 'Rina Budiman', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001028@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Eka Pratiwi (3101001029) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eka Pratiwi', '3101001029@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001029', 'Eka Pratiwi', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001029@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dedi Nasution (3101001030) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dedi Nasution', '3101001030@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001030', 'Dedi Nasution', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001030@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rani Saputra (3101001031) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rani Saputra', '3101001031@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001031', 'Rani Saputra', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001031@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dinda Wijaya (3101001032) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dinda Wijaya', '3101001032@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001032', 'Dinda Wijaya', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001032@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lukman Nugroho (3101001033) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lukman Nugroho', '3101001033@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001033', 'Lukman Nugroho', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001033@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Joko Nugroho (3101001034) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Joko Nugroho', '3101001034@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001034', 'Joko Nugroho', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001034@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Shinta Wulandari (3101001035) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Shinta Wulandari', '3101001035@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001035', 'Shinta Wulandari', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001035@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Kevin Gunawan (3101001036) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Kevin Gunawan', '3101001036@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001036', 'Kevin Gunawan', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001036@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gita Ramadhan (3101001037) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gita Ramadhan', '3101001037@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001037', 'Gita Ramadhan', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001037@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ahmad Siregar (3101001038) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ahmad Siregar', '3101001038@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001038', 'Ahmad Siregar', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001038@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Budi Kusuma (3101001039) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Budi Kusuma', '3101001039@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001039', 'Budi Kusuma', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001039@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ahmad Utami (3101001040) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ahmad Utami', '3101001040@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001040', 'Ahmad Utami', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001040@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Eka Utomo (3101001041) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eka Utomo', '3101001041@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001041', 'Eka Utomo', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001041@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fahmi Pratama (3101001042) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fahmi Pratama', '3101001042@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001042', 'Fahmi Pratama', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001042@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Naufal Nugroho (3101001043) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Naufal Nugroho', '3101001043@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001043', 'Naufal Nugroho', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001043@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rian Asturi (3101001044) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rian Asturi', '3101001044@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001044', 'Rian Asturi', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001044@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pratiwi Wulandari (3101001045) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pratiwi Wulandari', '3101001045@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001045', 'Pratiwi Wulandari', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001045@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Agus Dewi (3101001046) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Agus Dewi', '3101001046@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001046', 'Agus Dewi', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001046@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rizky Setiawan (3101001047) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rizky Setiawan', '3101001047@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001047', 'Rizky Setiawan', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001047@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rina Wibowo (3101001048) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rina Wibowo', '3101001048@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001048', 'Rina Wibowo', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001048@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dhea Wulandari (3101001049) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dhea Wulandari', '3101001049@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001049', 'Dhea Wulandari', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001049@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Irfan Lestari (3101001050) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Irfan Lestari', '3101001050@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001050', 'Irfan Lestari', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001050@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Eko Purnomo (3101001051) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eko Purnomo', '3101001051@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001051', 'Eko Purnomo', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001051@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gita Wijaya (3101001052) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gita Wijaya', '3101001052@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001052', 'Gita Wijaya', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001052@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fitri Pratiwi (3101001053) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fitri Pratiwi', '3101001053@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001053', 'Fitri Pratiwi', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001053@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Permata (3101001054) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Permata', '3101001054@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001054', 'Olivia Permata', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001054@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rizky Gunawan (3101001055) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rizky Gunawan', '3101001055@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001055', 'Rizky Gunawan', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001055@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lukman Siregar (3101001056) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lukman Siregar', '3101001056@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001056', 'Lukman Siregar', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001056@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Andi Ramadhan (3101001057) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Andi Ramadhan', '3101001057@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001057', 'Andi Ramadhan', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001057@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hafiz Kusuma (3101001058) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hafiz Kusuma', '3101001058@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001058', 'Hafiz Kusuma', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001058@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Utami (3101001059) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Utami', '3101001059@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001059', 'Putri Utami', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001059@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Bambang Asturi (3101001060) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Bambang Asturi', '3101001060@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001060', 'Bambang Asturi', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001060@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Sari Asturi (3101001061) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Sari Asturi', '3101001061@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001061', 'Sari Asturi', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001061@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Nadia Pratama (3101001062) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Nadia Pratama', '3101001062@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001062', 'Nadia Pratama', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001062@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Laras Pratiwi (3101001063) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Laras Pratiwi', '3101001063@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001063', 'Laras Pratiwi', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001063@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Chandra Rahmawati (3101001064) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Chandra Rahmawati', '3101001064@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001064', 'Chandra Rahmawati', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001064@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fahmi Setiawan (3101001065) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fahmi Setiawan', '3101001065@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001065', 'Fahmi Setiawan', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001065@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gita Kusuma (3101001066) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gita Kusuma', '3101001066@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001066', 'Gita Kusuma', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001066@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rina Budiman (3101001067) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rina Budiman', '3101001067@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001067', 'Rina Budiman', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001067@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Joko Fitriani (3101001068) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Joko Fitriani', '3101001068@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001068', 'Joko Fitriani', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001068@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hendra Hidayat (3101001069) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hendra Hidayat', '3101001069@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001069', 'Hendra Hidayat', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001069@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ayu Rahmawati (3101001070) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ayu Rahmawati', '3101001070@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001070', 'Ayu Rahmawati', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001070@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Joko Sari (3101001071) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Joko Sari', '3101001071@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001071', 'Joko Sari', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001071@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gita Pratiwi (3101001072) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gita Pratiwi', '3101001072@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001072', 'Gita Pratiwi', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001072@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Elena Wibowo (3101001073) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Elena Wibowo', '3101001073@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001073', 'Elena Wibowo', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001073@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Irfan Wibowo (3101001074) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Irfan Wibowo', '3101001074@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001074', 'Irfan Wibowo', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001074@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tania Saputra (3101001075) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tania Saputra', '3101001075@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001075', 'Tania Saputra', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001075@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Oki Nasution (3101001076) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Oki Nasution', '3101001076@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001076', 'Oki Nasution', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001076@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Indah Wijaya (3101001077) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Indah Wijaya', '3101001077@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001077', 'Indah Wijaya', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001077@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Sari Asturi (3101001078) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Sari Asturi', '3101001078@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001078', 'Sari Asturi', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001078@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Citra Lestari (3101001079) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Citra Lestari', '3101001079@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001079', 'Citra Lestari', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001079@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Satria Pratiwi (3101001080) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Satria Pratiwi', '3101001080@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001080', 'Satria Pratiwi', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001080@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rendra Purnomo (3101001081) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rendra Purnomo', '3101001081@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001081', 'Rendra Purnomo', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001081@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dhea Asturi (3101001082) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dhea Asturi', '3101001082@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001082', 'Dhea Asturi', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001082@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rina Amalia (3101001083) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rina Amalia', '3101001083@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001083', 'Rina Amalia', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001083@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Panji Nugroho (3101001084) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Panji Nugroho', '3101001084@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001084', 'Panji Nugroho', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001084@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ayu Fitriani (3101001085) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ayu Fitriani', '3101001085@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001085', 'Ayu Fitriani', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001085@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Budi Asturi (3101001086) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Budi Asturi', '3101001086@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001086', 'Budi Asturi', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001086@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Farida Kusuma (3101001087) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Farida Kusuma', '3101001087@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001087', 'Farida Kusuma', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001087@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yanti Ramadhan (3101001088) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yanti Ramadhan', '3101001088@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001088', 'Yanti Ramadhan', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001088@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rian Utami (3101001089) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rian Utami', '3101001089@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001089', 'Rian Utami', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001089@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Anisa Hidayat (3101001090) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Anisa Hidayat', '3101001090@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001090', 'Anisa Hidayat', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001090@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Rahmawati (3101001091) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Rahmawati', '3101001091@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001091', 'Olivia Rahmawati', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001091@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gita Putri (3101001092) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gita Putri', '3101001092@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001092', 'Gita Putri', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001092@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Siti Ramadhan (3101001093) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Siti Ramadhan', '3101001093@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001093', 'Siti Ramadhan', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001093@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Kusuma (3101001094) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Kusuma', '3101001094@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001094', 'Olivia Kusuma', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001094@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Zahra Wulandari (3101001095) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Zahra Wulandari', '3101001095@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001095', 'Zahra Wulandari', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001095@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Zahra Purnomo (3101001096) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Zahra Purnomo', '3101001096@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001096', 'Zahra Purnomo', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001096@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rizky Purnomo (3101001097) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rizky Purnomo', '3101001097@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001097', 'Rizky Purnomo', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001097@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hafiz Putri (3101001098) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hafiz Putri', '3101001098@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001098', 'Hafiz Putri', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001098@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ayu Setiawan (3101001099) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ayu Setiawan', '3101001099@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001099', 'Ayu Setiawan', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001099@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pratiwi Budiman (3101001100) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pratiwi Budiman', '3101001100@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001100', 'Pratiwi Budiman', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001100@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Joko Kusuma (3101001101) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Joko Kusuma', '3101001101@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001101', 'Joko Kusuma', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001101@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Oki Hayati (3101001102) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Oki Hayati', '3101001102@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001102', 'Oki Hayati', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001102@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Naufal Setiawan (3101001103) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Naufal Setiawan', '3101001103@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001103', 'Naufal Setiawan', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001103@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dani Rahmawati (3101001104) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dani Rahmawati', '3101001104@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001104', 'Dani Rahmawati', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001104@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Utami (3101001105) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Utami', '3101001105@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001105', 'Olivia Utami', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001105@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rani Situmorang (3101001106) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rani Situmorang', '3101001106@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001106', 'Rani Situmorang', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001106@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Muhammad Purnomo (3101001107) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Muhammad Purnomo', '3101001107@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001107', 'Muhammad Purnomo', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001107@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fahmi Utomo (3101001108) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fahmi Utomo', '3101001108@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001108', 'Fahmi Utomo', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001108@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Indah Amalia (3101001109) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Indah Amalia', '3101001109@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001109', 'Indah Amalia', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001109@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Wulan Fitriani (3101001110) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Wulan Fitriani', '3101001110@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001110', 'Wulan Fitriani', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001110@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gita Santoso (3101001111) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gita Santoso', '3101001111@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001111', 'Gita Santoso', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001111@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fitri Hayati (3101001112) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fitri Hayati', '3101001112@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001112', 'Fitri Hayati', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001112@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yanti Utomo (3101001113) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yanti Utomo', '3101001113@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001113', 'Yanti Utomo', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001113@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dinda Wibowo (3101001114) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dinda Wibowo', '3101001114@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001114', 'Dinda Wibowo', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001114@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dedi Utomo (3101001115) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dedi Utomo', '3101001115@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001115', 'Dedi Utomo', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001115@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ahmad Purnomo (3101001116) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ahmad Purnomo', '3101001116@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001116', 'Ahmad Purnomo', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001116@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Anisa Setiawan (3101001117) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Anisa Setiawan', '3101001117@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001117', 'Anisa Setiawan', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001117@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Panji Utami (3101001118) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Panji Utami', '3101001118@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001118', 'Panji Utami', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001118@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Siti Nasution (3101001119) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Siti Nasution', '3101001119@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001119', 'Siti Nasution', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001119@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tania Dewi (3101001120) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tania Dewi', '3101001120@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001120', 'Tania Dewi', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001120@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dinda Wibowo (3101001121) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dinda Wibowo', '3101001121@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001121', 'Dinda Wibowo', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001121@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Laras Asturi (3101001122) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Laras Asturi', '3101001122@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001122', 'Laras Asturi', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001122@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Oki Budiman (3101001123) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Oki Budiman', '3101001123@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001123', 'Oki Budiman', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001123@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Utami Putri (3101001124) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Utami Putri', '3101001124@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001124', 'Utami Putri', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001124@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Indah Wulandari (3101001125) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Indah Wulandari', '3101001125@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001125', 'Indah Wulandari', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001125@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Nadia Siregar (3101001126) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Nadia Siregar', '3101001126@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001126', 'Nadia Siregar', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001126@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Citra Utami (3101001127) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Citra Utami', '3101001127@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001127', 'Citra Utami', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001127@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Elena Kusuma (3101001128) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Elena Kusuma', '3101001128@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001128', 'Elena Kusuma', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001128@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dinda Sari (3101001129) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dinda Sari', '3101001129@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001129', 'Dinda Sari', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001129@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fajar Setiawan (3101001130) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fajar Setiawan', '3101001130@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001130', 'Fajar Setiawan', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001130@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dedi Nugroho (3101001131) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dedi Nugroho', '3101001131@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001131', 'Dedi Nugroho', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001131@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Amalia Wibowo (3101001132) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Amalia Wibowo', '3101001132@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001132', 'Amalia Wibowo', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001132@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Muhammad Fitriani (3101001133) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Muhammad Fitriani', '3101001133@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001133', 'Muhammad Fitriani', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001133@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gilang Saputra (3101001134) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gilang Saputra', '3101001134@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001134', 'Gilang Saputra', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001134@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Amalia Setiawan (3101001135) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Amalia Setiawan', '3101001135@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001135', 'Amalia Setiawan', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001135@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Kevin Hayati (3101001136) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Kevin Hayati', '3101001136@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001136', 'Kevin Hayati', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001136@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Aditya Lestari (3101001137) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Aditya Lestari', '3101001137@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001137', 'Aditya Lestari', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001137@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Eka Sari (3101001138) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eka Sari', '3101001138@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001138', 'Eka Sari', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001138@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Purnomo (3101001139) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Purnomo', '3101001139@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001139', 'Putri Purnomo', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001139@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Bambang Santoso (3101001140) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Bambang Santoso', '3101001140@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001140', 'Bambang Santoso', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001140@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pratiwi Purnomo (3101001141) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pratiwi Purnomo', '3101001141@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001141', 'Pratiwi Purnomo', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001141@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Farida Utomo (3101001142) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Farida Utomo', '3101001142@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001142', 'Farida Utomo', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001142@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gita Budiman (3101001143) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gita Budiman', '3101001143@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001143', 'Gita Budiman', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001143@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Laras Saputra (3101001144) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Laras Saputra', '3101001144@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001144', 'Laras Saputra', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001144@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dani Setiawan (3101001145) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dani Setiawan', '3101001145@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001145', 'Dani Setiawan', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001145@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fitri Utami (3101001146) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fitri Utami', '3101001146@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001146', 'Fitri Utami', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001146@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Eka Setiawan (3101001147) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eka Setiawan', '3101001147@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001147', 'Eka Setiawan', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001147@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tania Hayati (3101001148) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tania Hayati', '3101001148@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001148', 'Tania Hayati', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001148@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pratiwi Amalia (3101001149) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pratiwi Amalia', '3101001149@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001149', 'Pratiwi Amalia', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001149@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Agus Permata (3101001150) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Agus Permata', '3101001150@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001150', 'Agus Permata', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001150@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tania Ramadhan (3101001151) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tania Ramadhan', '3101001151@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001151', 'Tania Ramadhan', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001151@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Amalia Budiman (3101001152) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Amalia Budiman', '3101001152@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001152', 'Amalia Budiman', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001152@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rian Dewi (3101001153) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rian Dewi', '3101001153@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001153', 'Rian Dewi', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001153@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rizky Setiawan (3101001154) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rizky Setiawan', '3101001154@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001154', 'Rizky Setiawan', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001154@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Fitriani (3101001155) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Fitriani', '3101001155@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001155', 'Putri Fitriani', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001155@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rina Gunawan (3101001156) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rina Gunawan', '3101001156@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001156', 'Rina Gunawan', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001156@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Anisa Wijaya (3101001157) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Anisa Wijaya', '3101001157@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001157', 'Anisa Wijaya', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001157@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Wulandari (3101001158) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Wulandari', '3101001158@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001158', 'Putri Wulandari', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001158@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rani Budiman (3101001159) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rani Budiman', '3101001159@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001159', 'Rani Budiman', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001159@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Farida Nugroho (3101001160) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Farida Nugroho', '3101001160@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001160', 'Farida Nugroho', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001160@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rani Kusuma (3101001161) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rani Kusuma', '3101001161@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001161', 'Rani Kusuma', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001161@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dedi Amalia (3101001162) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dedi Amalia', '3101001162@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001162', 'Dedi Amalia', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001162@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fajar Hidayat (3101001163) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fajar Hidayat', '3101001163@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001163', 'Fajar Hidayat', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001163@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Muhammad Ramadhan (3101001164) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Muhammad Ramadhan', '3101001164@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001164', 'Muhammad Ramadhan', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001164@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Farida Putri (3101001165) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Farida Putri', '3101001165@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001165', 'Farida Putri', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001165@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hafiz Dewi (3101001166) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hafiz Dewi', '3101001166@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001166', 'Hafiz Dewi', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001166@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hendra Asturi (3101001167) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hendra Asturi', '3101001167@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001167', 'Hendra Asturi', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001167@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fahmi Kusuma (3101001168) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fahmi Kusuma', '3101001168@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001168', 'Fahmi Kusuma', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001168@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Amalia Rahmawati (3101001169) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Amalia Rahmawati', '3101001169@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001169', 'Amalia Rahmawati', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001169@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dimas Permata (3101001170) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dimas Permata', '3101001170@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001170', 'Dimas Permata', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001170@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Joko Utomo (3101001171) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Joko Utomo', '3101001171@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001171', 'Joko Utomo', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001171@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Lestari (3101001172) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Lestari', '3101001172@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001172', 'Putri Lestari', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001172@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Elena Pratama (3101001173) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Elena Pratama', '3101001173@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001173', 'Elena Pratama', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001173@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Wulan Dewi (3101001174) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Wulan Dewi', '3101001174@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001174', 'Wulan Dewi', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001174@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Budiman (3101001175) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Budiman', '3101001175@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001175', 'Putri Budiman', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001175@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Shinta Lestari (3101001176) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Shinta Lestari', '3101001176@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001176', 'Shinta Lestari', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001176@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rendra Purnomo (3101001177) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rendra Purnomo', '3101001177@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001177', 'Rendra Purnomo', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001177@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ahmad Utomo (3101001178) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ahmad Utomo', '3101001178@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001178', 'Ahmad Utomo', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001178@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Utami Wijaya (3101001179) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Utami Wijaya', '3101001179@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001179', 'Utami Wijaya', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001179@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Shinta Sari (3101001180) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Shinta Sari', '3101001180@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001180', 'Shinta Sari', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001180@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gilang Purnomo (3101001181) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gilang Purnomo', '3101001181@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001181', 'Gilang Purnomo', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001181@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dani Nasution (3101001182) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dani Nasution', '3101001182@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001182', 'Dani Nasution', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001182@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Panji Santoso (3101001183) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Panji Santoso', '3101001183@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001183', 'Panji Santoso', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001183@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Zahra Situmorang (3101001184) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Zahra Situmorang', '3101001184@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001184', 'Zahra Situmorang', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001184@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dewi Siregar (3101001185) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dewi Siregar', '3101001185@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001185', 'Dewi Siregar', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001185@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Farida Ramadhan (3101001186) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Farida Ramadhan', '3101001186@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001186', 'Farida Ramadhan', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001186@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Wijaya (3101001187) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Wijaya', '3101001187@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001187', 'Olivia Wijaya', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001187@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yanti Budiman (3101001188) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yanti Budiman', '3101001188@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001188', 'Yanti Budiman', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001188@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tania Pratama (3101001189) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tania Pratama', '3101001189@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001189', 'Tania Pratama', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001189@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Saputra (3101001190) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Saputra', '3101001190@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001190', 'Putri Saputra', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001190@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dimas Lestari (3101001191) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dimas Lestari', '3101001191@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001191', 'Dimas Lestari', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001191@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fajar Fitriani (3101001192) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fajar Fitriani', '3101001192@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001192', 'Fajar Fitriani', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001192@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Irfan Fitriani (3101001193) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Irfan Fitriani', '3101001193@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001193', 'Irfan Fitriani', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001193@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Fitriani (3101001194) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Fitriani', '3101001194@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001194', 'Olivia Fitriani', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001194@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Chandra Lestari (3101001195) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Chandra Lestari', '3101001195@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001195', 'Chandra Lestari', 'Laki-laki', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001195@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Panji Kusuma (3101001196) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Panji Kusuma', '3101001196@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001196', 'Panji Kusuma', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001196@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hesti Amalia (3101001197) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hesti Amalia', '3101001197@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001197', 'Hesti Amalia', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001197@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Bella Gunawan (3101001198) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Bella Gunawan', '3101001198@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001198', 'Bella Gunawan', 'Perempuan', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001198@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Chandra Lestari (3101001199) - XI IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Chandra Lestari', '3101001199@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001199', 'Chandra Lestari', 'Laki-laki', 'XI IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001199@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pratiwi Siregar (3101001200) - XI IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pratiwi Siregar', '3101001200@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001200', 'Pratiwi Siregar', 'Perempuan', 'XI IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001200@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dinda Wulandari (3101001201) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dinda Wulandari', '3101001201@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001201', 'Dinda Wulandari', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001201@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Bella Nugroho (3101001202) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Bella Nugroho', '3101001202@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001202', 'Bella Nugroho', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001202@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Zahra Amalia (3101001203) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Zahra Amalia', '3101001203@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001203', 'Zahra Amalia', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001203@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Anisa Pratama (3101001204) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Anisa Pratama', '3101001204@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001204', 'Anisa Pratama', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001204@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Panji Wulandari (3101001205) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Panji Wulandari', '3101001205@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001205', 'Panji Wulandari', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001205@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lukman Pratama (3101001206) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lukman Pratama', '3101001206@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001206', 'Lukman Pratama', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001206@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dani Amalia (3101001207) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dani Amalia', '3101001207@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001207', 'Dani Amalia', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001207@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yanti Kusuma (3101001208) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yanti Kusuma', '3101001208@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001208', 'Yanti Kusuma', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001208@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yanti Permata (3101001209) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yanti Permata', '3101001209@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001209', 'Yanti Permata', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001209@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hafiz Kusuma (3101001210) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hafiz Kusuma', '3101001210@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001210', 'Hafiz Kusuma', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001210@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lukman Kusuma (3101001211) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lukman Kusuma', '3101001211@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001211', 'Lukman Kusuma', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001211@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Chandra Santoso (3101001212) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Chandra Santoso', '3101001212@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001212', 'Chandra Santoso', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001212@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Arif Amalia (3101001213) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Arif Amalia', '3101001213@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001213', 'Arif Amalia', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001213@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Pratama (3101001214) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Pratama', '3101001214@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001214', 'Olivia Pratama', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001214@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Eko Santoso (3101001215) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eko Santoso', '3101001215@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001215', 'Eko Santoso', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001215@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dani Pratiwi (3101001216) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dani Pratiwi', '3101001216@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001216', 'Dani Pratiwi', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001216@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yanti Wibowo (3101001217) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yanti Wibowo', '3101001217@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001217', 'Yanti Wibowo', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001217@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gita Gunawan (3101001218) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gita Gunawan', '3101001218@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001218', 'Gita Gunawan', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001218@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Chandra Nasution (3101001219) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Chandra Nasution', '3101001219@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001219', 'Chandra Nasution', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001219@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Amalia Wibowo (3101001220) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Amalia Wibowo', '3101001220@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001220', 'Amalia Wibowo', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001220@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Agus Wulandari (3101001221) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Agus Wulandari', '3101001221@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001221', 'Agus Wulandari', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001221@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Utami Nasution (3101001222) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Utami Nasution', '3101001222@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001222', 'Utami Nasution', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001222@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Oki Asturi (3101001223) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Oki Asturi', '3101001223@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001223', 'Oki Asturi', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001223@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Satria Rahmawati (3101001224) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Satria Rahmawati', '3101001224@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001224', 'Satria Rahmawati', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001224@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hafiz Amalia (3101001225) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hafiz Amalia', '3101001225@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001225', 'Hafiz Amalia', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001225@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Zahra Hayati (3101001226) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Zahra Hayati', '3101001226@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001226', 'Zahra Hayati', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001226@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rendra Sari (3101001227) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rendra Sari', '3101001227@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001227', 'Rendra Sari', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001227@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Anisa Putri (3101001228) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Anisa Putri', '3101001228@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001228', 'Anisa Putri', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001228@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Satria Gunawan (3101001229) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Satria Gunawan', '3101001229@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001229', 'Satria Gunawan', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001229@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rizky Pratama (3101001230) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rizky Pratama', '3101001230@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001230', 'Rizky Pratama', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001230@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Elena Santoso (3101001231) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Elena Santoso', '3101001231@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001231', 'Elena Santoso', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001231@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Bella Wulandari (3101001232) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Bella Wulandari', '3101001232@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001232', 'Bella Wulandari', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001232@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dewi Pratama (3101001233) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dewi Pratama', '3101001233@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001233', 'Dewi Pratama', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001233@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Farida Amalia (3101001234) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Farida Amalia', '3101001234@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001234', 'Farida Amalia', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001234@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Siti Wibowo (3101001235) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Siti Wibowo', '3101001235@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001235', 'Siti Wibowo', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001235@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Zahra Dewi (3101001236) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Zahra Dewi', '3101001236@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001236', 'Zahra Dewi', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001236@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Asturi (3101001237) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Asturi', '3101001237@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001237', 'Putri Asturi', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001237@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hesti Rahmawati (3101001238) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hesti Rahmawati', '3101001238@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001238', 'Hesti Rahmawati', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001238@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hesti Permata (3101001239) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hesti Permata', '3101001239@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001239', 'Hesti Permata', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001239@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dedi Wijaya (3101001240) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dedi Wijaya', '3101001240@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001240', 'Dedi Wijaya', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001240@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Hidayat (3101001241) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Hidayat', '3101001241@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001241', 'Putri Hidayat', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001241@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pratiwi Nasution (3101001242) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pratiwi Nasution', '3101001242@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001242', 'Pratiwi Nasution', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001242@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rendra Purnomo (3101001243) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rendra Purnomo', '3101001243@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001243', 'Rendra Purnomo', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001243@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fitri Wijaya (3101001244) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fitri Wijaya', '3101001244@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001244', 'Fitri Wijaya', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001244@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pratiwi Utomo (3101001245) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pratiwi Utomo', '3101001245@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001245', 'Pratiwi Utomo', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001245@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tania Utami (3101001246) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tania Utami', '3101001246@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001246', 'Tania Utami', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001246@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Agus Wibowo (3101001247) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Agus Wibowo', '3101001247@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001247', 'Agus Wibowo', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001247@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dewi Asturi (3101001248) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dewi Asturi', '3101001248@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001248', 'Dewi Asturi', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001248@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Naufal Siregar (3101001249) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Naufal Siregar', '3101001249@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001249', 'Naufal Siregar', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001249@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ahmad Fitriani (3101001250) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ahmad Fitriani', '3101001250@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001250', 'Ahmad Fitriani', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001250@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Oki Wulandari (3101001251) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Oki Wulandari', '3101001251@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001251', 'Oki Wulandari', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001251@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hendra Wulandari (3101001252) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hendra Wulandari', '3101001252@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001252', 'Hendra Wulandari', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001252@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dhea Santoso (3101001253) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dhea Santoso', '3101001253@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001253', 'Dhea Santoso', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001253@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Budi Nasution (3101001254) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Budi Nasution', '3101001254@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001254', 'Budi Nasution', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001254@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Siti Santoso (3101001255) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Siti Santoso', '3101001255@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001255', 'Siti Santoso', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001255@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Shinta Hidayat (3101001256) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Shinta Hidayat', '3101001256@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001256', 'Shinta Hidayat', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001256@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Citra Nasution (3101001257) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Citra Nasution', '3101001257@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001257', 'Citra Nasution', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001257@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Shinta Utomo (3101001258) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Shinta Utomo', '3101001258@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001258', 'Shinta Utomo', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001258@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pratiwi Sari (3101001259) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pratiwi Sari', '3101001259@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001259', 'Pratiwi Sari', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001259@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Farida Situmorang (3101001260) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Farida Situmorang', '3101001260@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001260', 'Farida Situmorang', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001260@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Amalia Pratiwi (3101001261) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Amalia Pratiwi', '3101001261@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001261', 'Amalia Pratiwi', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001261@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Wulan Pratama (3101001262) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Wulan Pratama', '3101001262@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001262', 'Wulan Pratama', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001262@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Nadia Rahmawati (3101001263) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Nadia Rahmawati', '3101001263@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001263', 'Nadia Rahmawati', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001263@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Amalia (3101001264) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Amalia', '3101001264@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001264', 'Putri Amalia', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001264@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pratiwi Utami (3101001265) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pratiwi Utami', '3101001265@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001265', 'Pratiwi Utami', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001265@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Nadia Purnomo (3101001266) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Nadia Purnomo', '3101001266@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001266', 'Nadia Purnomo', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001266@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Laras Asturi (3101001267) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Laras Asturi', '3101001267@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001267', 'Laras Asturi', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001267@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dewi Kusuma (3101001268) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dewi Kusuma', '3101001268@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001268', 'Dewi Kusuma', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001268@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Dewi (3101001269) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Dewi', '3101001269@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001269', 'Putri Dewi', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001269@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gilang Lestari (3101001270) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gilang Lestari', '3101001270@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001270', 'Gilang Lestari', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001270@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Mega Wulandari (3101001271) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Mega Wulandari', '3101001271@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001271', 'Mega Wulandari', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001271@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dimas Rahmawati (3101001272) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dimas Rahmawati', '3101001272@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001272', 'Dimas Rahmawati', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001272@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dedi Asturi (3101001273) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dedi Asturi', '3101001273@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001273', 'Dedi Asturi', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001273@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Farida Lestari (3101001274) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Farida Lestari', '3101001274@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001274', 'Farida Lestari', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001274@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Naufal Purnomo (3101001275) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Naufal Purnomo', '3101001275@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001275', 'Naufal Purnomo', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001275@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Siti Santoso (3101001276) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Siti Santoso', '3101001276@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001276', 'Siti Santoso', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001276@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Mega Saputra (3101001277) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Mega Saputra', '3101001277@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001277', 'Mega Saputra', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001277@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dewi Pratama (3101001278) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dewi Pratama', '3101001278@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001278', 'Dewi Pratama', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001278@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lukman Ramadhan (3101001279) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lukman Ramadhan', '3101001279@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001279', 'Lukman Ramadhan', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001279@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Laras Santoso (3101001280) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Laras Santoso', '3101001280@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001280', 'Laras Santoso', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001280@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rendra Wijaya (3101001281) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rendra Wijaya', '3101001281@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001281', 'Rendra Wijaya', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001281@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hendra Budiman (3101001282) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hendra Budiman', '3101001282@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001282', 'Hendra Budiman', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001282@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Wibowo (3101001283) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Wibowo', '3101001283@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001283', 'Olivia Wibowo', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001283@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Hidayat (3101001284) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Hidayat', '3101001284@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001284', 'Olivia Hidayat', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001284@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Anisa Utomo (3101001285) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Anisa Utomo', '3101001285@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001285', 'Anisa Utomo', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001285@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rizky Gunawan (3101001286) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rizky Gunawan', '3101001286@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001286', 'Rizky Gunawan', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001286@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ayu Siregar (3101001287) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ayu Siregar', '3101001287@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001287', 'Ayu Siregar', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001287@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rina Pratama (3101001288) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rina Pratama', '3101001288@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001288', 'Rina Pratama', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001288@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dewi Situmorang (3101001289) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dewi Situmorang', '3101001289@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001289', 'Dewi Situmorang', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001289@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Siti Budiman (3101001290) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Siti Budiman', '3101001290@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001290', 'Siti Budiman', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001290@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Utami Situmorang (3101001291) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Utami Situmorang', '3101001291@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001291', 'Utami Situmorang', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001291@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Putri Situmorang (3101001292) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Putri Situmorang', '3101001292@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001292', 'Putri Situmorang', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001292@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Naufal Rahmawati (3101001293) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Naufal Rahmawati', '3101001293@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001293', 'Naufal Rahmawati', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001293@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Bambang Wulandari (3101001294) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Bambang Wulandari', '3101001294@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001294', 'Bambang Wulandari', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001294@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Shinta Kusuma (3101001295) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Shinta Kusuma', '3101001295@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001295', 'Shinta Kusuma', 'Perempuan', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001295@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dinda Siregar (3101001296) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dinda Siregar', '3101001296@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001296', 'Dinda Siregar', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001296@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Eka Ramadhan (3101001297) - XII IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eka Ramadhan', '3101001297@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001297', 'Eka Ramadhan', 'Laki-laki', 'XII IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001297@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Bella Fitriani (3101001298) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Bella Fitriani', '3101001298@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001298', 'Bella Fitriani', 'Perempuan', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001298@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rian Pratama (3101001299) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rian Pratama', '3101001299@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001299', 'Rian Pratama', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001299@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Muhammad Hayati (3101001300) - XII IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Muhammad Hayati', '3101001300@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('3101001300', 'Muhammad Hayati', 'Laki-laki', 'XII IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '3101001300@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();
