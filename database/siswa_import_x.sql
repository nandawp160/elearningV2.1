-- Student: Ade Nuraini (4101001001) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ade Nuraini', '4101001001@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001001', 'Ade Nuraini', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001001@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Fathonah Handayani (4101001002) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Fathonah Handayani', '4101001002@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001002', 'Fathonah Handayani', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001002@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Capa Novitasari (4101001003) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Capa Novitasari', '4101001003@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001003', 'Capa Novitasari', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001003@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Mahfud Zulkarnain (4101001004) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Mahfud Zulkarnain', '4101001004@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001004', 'Mahfud Zulkarnain', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001004@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Prakosa Mandasari (4101001005) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Prakosa Mandasari', '4101001005@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001005', 'Prakosa Mandasari', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001005@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Laila Wulandari (4101001006) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Laila Wulandari', '4101001006@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001006', 'Laila Wulandari', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001006@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yusuf Mahendra (4101001007) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yusuf Mahendra', '4101001007@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001007', 'Yusuf Mahendra', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001007@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rafi Yolanda (4101001008) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rafi Yolanda', '4101001008@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001008', 'Rafi Yolanda', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001008@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Jaka Sirait (4101001009) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Jaka Sirait', '4101001009@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001009', 'Jaka Sirait', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001009@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Pia Nurdiyanti (4101001010) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Pia Nurdiyanti', '4101001010@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001010', 'Pia Nurdiyanti', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001010@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Galur Mandasari (4101001011) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Galur Mandasari', '4101001011@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001011', 'Galur Mandasari', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001011@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Darijan Kuswandari (4101001012) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Darijan Kuswandari', '4101001012@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001012', 'Darijan Kuswandari', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001012@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Aurora Rahmawati (4101001013) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Aurora Rahmawati', '4101001013@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001013', 'Aurora Rahmawati', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001013@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Bancar Oktaviani (4101001014) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Bancar Oktaviani', '4101001014@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001014', 'Bancar Oktaviani', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001014@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Febi Yolanda (4101001015) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Febi Yolanda', '4101001015@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001015', 'Febi Yolanda', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001015@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Olivia Nugroho (4101001016) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Olivia Nugroho', '4101001016@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001016', 'Olivia Nugroho', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001016@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hardana Uyainah (4101001017) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hardana Uyainah', '4101001017@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001017', 'Hardana Uyainah', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001017@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Siti Rahmawati (4101001018) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Siti Rahmawati', '4101001018@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001018', 'Siti Rahmawati', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001018@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ida Hariyah (4101001019) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ida Hariyah', '4101001019@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001019', 'Ida Hariyah', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001019@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Wulan Susanti (4101001020) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Wulan Susanti', '4101001020@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001020', 'Wulan Susanti', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001020@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Kamaria Laksita (4101001021) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Kamaria Laksita', '4101001021@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001021', 'Kamaria Laksita', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001021@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yuni Mustofa (4101001022) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yuni Mustofa', '4101001022@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001022', 'Yuni Mustofa', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001022@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Qori Wulandari (4101001023) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Qori Wulandari', '4101001023@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001023', 'Qori Wulandari', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001023@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rachel Najmudin (4101001024) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rachel Najmudin', '4101001024@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001024', 'Rachel Najmudin', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001024@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Intan Simanjuntak (4101001025) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Intan Simanjuntak', '4101001025@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001025', 'Intan Simanjuntak', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001025@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Kiandra Putra (4101001026) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Kiandra Putra', '4101001026@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001026', 'Kiandra Putra', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001026@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gamanto Yuliarti (4101001027) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gamanto Yuliarti', '4101001027@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001027', 'Gamanto Yuliarti', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001027@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Belinda Agustina (4101001028) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Belinda Agustina', '4101001028@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001028', 'Belinda Agustina', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001028@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Shania Rajata (4101001029) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Shania Rajata', '4101001029@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001029', 'Shania Rajata', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001029@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Betania Nuraini (4101001030) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Betania Nuraini', '4101001030@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001030', 'Betania Nuraini', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001030@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Jindra Dabukke (4101001031) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Jindra Dabukke', '4101001031@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001031', 'Jindra Dabukke', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001031@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Michelle Irawan (4101001032) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Michelle Irawan', '4101001032@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001032', 'Michelle Irawan', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001032@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Padmi Prakasa (4101001033) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Padmi Prakasa', '4101001033@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001033', 'Padmi Prakasa', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001033@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tasdik Hassanah (4101001034) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tasdik Hassanah', '4101001034@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001034', 'Tasdik Hassanah', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001034@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Martaka Pertiwi (4101001035) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Martaka Pertiwi', '4101001035@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001035', 'Martaka Pertiwi', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001035@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ratna Adriansyah (4101001036) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ratna Adriansyah', '4101001036@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001036', 'Ratna Adriansyah', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001036@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Emin Anggraini (4101001037) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Emin Anggraini', '4101001037@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001037', 'Emin Anggraini', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001037@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ami Wahyuni (4101001038) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ami Wahyuni', '4101001038@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001038', 'Ami Wahyuni', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001038@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Narji Winarno (4101001039) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Narji Winarno', '4101001039@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001039', 'Narji Winarno', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001039@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rachel Prasasta (4101001040) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rachel Prasasta', '4101001040@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001040', 'Rachel Prasasta', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001040@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ulva Puspasari (4101001041) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ulva Puspasari', '4101001041@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001041', 'Ulva Puspasari', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001041@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hasan Halim (4101001042) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hasan Halim', '4101001042@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001042', 'Hasan Halim', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001042@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rahayu Nugroho (4101001043) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rahayu Nugroho', '4101001043@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001043', 'Rahayu Nugroho', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001043@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Adhiarja Oktaviani (4101001044) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Adhiarja Oktaviani', '4101001044@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001044', 'Adhiarja Oktaviani', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001044@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Qori Aryani (4101001045) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Qori Aryani', '4101001045@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001045', 'Qori Aryani', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001045@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Hani Saragih (4101001046) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hani Saragih', '4101001046@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001046', 'Hani Saragih', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001046@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Diah Uwais (4101001047) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Diah Uwais', '4101001047@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001047', 'Diah Uwais', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001047@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Genta Hidayanto (4101001048) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Genta Hidayanto', '4101001048@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001048', 'Genta Hidayanto', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001048@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ulya Tamba (4101001049) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ulya Tamba', '4101001049@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001049', 'Ulya Tamba', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001049@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Karimah Jailani (4101001050) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Karimah Jailani', '4101001050@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001050', 'Karimah Jailani', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001050@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lili Halimah (4101001051) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lili Halimah', '4101001051@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001051', 'Lili Halimah', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001051@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gina Wasita (4101001052) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gina Wasita', '4101001052@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001052', 'Gina Wasita', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001052@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Mala Lailasari (4101001053) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Mala Lailasari', '4101001053@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001053', 'Mala Lailasari', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001053@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Jati Sudiati (4101001054) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Jati Sudiati', '4101001054@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001054', 'Jati Sudiati', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001054@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Kadir Pertiwi (4101001055) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Kadir Pertiwi', '4101001055@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001055', 'Kadir Pertiwi', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001055@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Cemplunk Yuniar (4101001056) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Cemplunk Yuniar', '4101001056@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001056', 'Cemplunk Yuniar', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001056@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Alambana Siregar (4101001057) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Alambana Siregar', '4101001057@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001057', 'Alambana Siregar', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001057@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dalimin Rajata (4101001058) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dalimin Rajata', '4101001058@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001058', 'Dalimin Rajata', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001058@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Wirda Wijaya (4101001059) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Wirda Wijaya', '4101001059@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001059', 'Wirda Wijaya', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001059@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ibun Gunawan (4101001060) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ibun Gunawan', '4101001060@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001060', 'Ibun Gunawan', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001060@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Jagapati Suartini (4101001061) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Jagapati Suartini', '4101001061@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001061', 'Jagapati Suartini', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001061@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tedi Dongoran (4101001062) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tedi Dongoran', '4101001062@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001062', 'Tedi Dongoran', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001062@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Jane Wibisono (4101001063) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Jane Wibisono', '4101001063@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001063', 'Jane Wibisono', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001063@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Tari Laksita (4101001064) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Tari Laksita', '4101001064@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001064', 'Tari Laksita', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001064@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Juli Wahyuni (4101001065) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Juli Wahyuni', '4101001065@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001065', 'Juli Wahyuni', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001065@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Cahya Wasita (4101001066) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Cahya Wasita', '4101001066@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001066', 'Cahya Wasita', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001066@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yunita Narpati (4101001067) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yunita Narpati', '4101001067@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001067', 'Yunita Narpati', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001067@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gamblang Rahimah (4101001068) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gamblang Rahimah', '4101001068@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001068', 'Gamblang Rahimah', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001068@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Asirwada Winarsih (4101001069) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Asirwada Winarsih', '4101001069@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001069', 'Asirwada Winarsih', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001069@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Harsaya Kusmawati (4101001070) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Harsaya Kusmawati', '4101001070@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001070', 'Harsaya Kusmawati', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001070@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Mutia Hutapea (4101001071) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Mutia Hutapea', '4101001071@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001071', 'Mutia Hutapea', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001071@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Janet Gunawan (4101001072) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Janet Gunawan', '4101001072@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001072', 'Janet Gunawan', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001072@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Jane Astuti (4101001073) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Jane Astuti', '4101001073@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001073', 'Jane Astuti', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001073@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ade Hasanah (4101001074) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ade Hasanah', '4101001074@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001074', 'Ade Hasanah', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001074@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Mursita Narpati (4101001075) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Mursita Narpati', '4101001075@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001075', 'Mursita Narpati', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001075@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Puji Pratama (4101001076) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Puji Pratama', '4101001076@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001076', 'Puji Pratama', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001076@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Wisnu Nuraini (4101001077) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Wisnu Nuraini', '4101001077@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001077', 'Wisnu Nuraini', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001077@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Yulia Firgantoro (4101001078) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yulia Firgantoro', '4101001078@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001078', 'Yulia Firgantoro', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001078@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lili Firmansyah (4101001079) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lili Firmansyah', '4101001079@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001079', 'Lili Firmansyah', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001079@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Artawan Pratiwi (4101001080) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Artawan Pratiwi', '4101001080@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001080', 'Artawan Pratiwi', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001080@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gamanto Mansur (4101001081) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gamanto Mansur', '4101001081@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001081', 'Gamanto Mansur', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001081@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gantar Novitasari (4101001082) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gantar Novitasari', '4101001082@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001082', 'Gantar Novitasari', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001082@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Rika Hasanah (4101001083) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rika Hasanah', '4101001083@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001083', 'Rika Hasanah', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001083@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Karsana Wastuti (4101001084) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Karsana Wastuti', '4101001084@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001084', 'Karsana Wastuti', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001084@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dirja Iswahyudi (4101001085) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dirja Iswahyudi', '4101001085@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001085', 'Dirja Iswahyudi', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001085@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Diana Hutasoit (4101001086) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Diana Hutasoit', '4101001086@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001086', 'Diana Hutasoit', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001086@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Zelda Mayasari (4101001087) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Zelda Mayasari', '4101001087@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001087', 'Zelda Mayasari', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001087@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Dalima Samosir (4101001088) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dalima Samosir', '4101001088@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001088', 'Dalima Samosir', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001088@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Banara Wijaya (4101001089) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Banara Wijaya', '4101001089@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001089', 'Banara Wijaya', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001089@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Cindy Simbolon (4101001090) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Cindy Simbolon', '4101001090@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001090', 'Cindy Simbolon', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001090@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Nabila Novitasari (4101001091) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Nabila Novitasari', '4101001091@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001091', 'Nabila Novitasari', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001091@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Gilda Prasetya (4101001092) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Gilda Prasetya', '4101001092@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001092', 'Gilda Prasetya', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001092@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Irwan Dabukke (4101001093) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Irwan Dabukke', '4101001093@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001093', 'Irwan Dabukke', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001093@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Cemplunk Mulyani (4101001094) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Cemplunk Mulyani', '4101001094@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001094', 'Cemplunk Mulyani', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001094@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ophelia Kusumo (4101001095) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ophelia Kusumo', '4101001095@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001095', 'Ophelia Kusumo', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001095@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Ozy Yulianti (4101001096) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ozy Yulianti', '4101001096@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001096', 'Ozy Yulianti', 'Laki-laki', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001096@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Julia Mulyani (4101001097) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Julia Mulyani', '4101001097@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001097', 'Julia Mulyani', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001097@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Lidya Wahyudin (4101001098) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Lidya Wahyudin', '4101001098@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001098', 'Lidya Wahyudin', 'Perempuan', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001098@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Juli Pradipta (4101001099) - X IPS
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Juli Pradipta', '4101001099@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001099', 'Juli Pradipta', 'Perempuan', 'X IPS', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001099@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

-- Student: Jayeng Uwais (4101001100) - X IPA
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Jayeng Uwais', '4101001100@siswa.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)
VALUES ('4101001100', 'Jayeng Uwais', 'Laki-laki', 'X IPA', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '4101001100@siswa.smansago.com'), NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();

