-- SQL IMPORT DATA GURU (EXCEL TO DATABASE)
-- Generated on 2026-06-25 23:36:19
-- Total Teachers to import: 30

-- Teacher: Diah Gunawan, S.Pd., M.Si. (197610162010122798) - Specialization: Pendidikan Agama & Budi Pekerti (ID: 7)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Diah Gunawan, S.Pd., M.Si.', 'diah.2798@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('197610162010122798', 'Diah Gunawan, S.Pd., M.Si.', 'diah.2798@guru.smansago.com', 'Pendidikan Agama & Budi Pekerti', 'aktif', LAST_INSERT_ID(), 7, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Irwan Purnama, S.Pd., M.Pd. (199512192005111578) - Specialization: Pendidikan Pancasila & Kewarganegaraan (PPKn) (ID: 10)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Irwan Purnama, S.Pd., M.Pd.', 'irwan.1578@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('199512192005111578', 'Irwan Purnama, S.Pd., M.Pd.', 'irwan.1578@guru.smansago.com', 'Pendidikan Pancasila & Kewarganegaraan (PPKn)', 'aktif', LAST_INSERT_ID(), 10, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Hendra Nugroho, S.Pd., M.Pd. (198512242014111187) - Specialization: Bahasa Indonesia (ID: 5)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Hendra Nugroho, S.Pd., M.Pd.', 'hendra.1187@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198512242014111187', 'Hendra Nugroho, S.Pd., M.Pd.', 'hendra.1187@guru.smansago.com', 'Bahasa Indonesia', 'aktif', LAST_INSERT_ID(), 5, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Diah Gunawan, S.Pd., M.Si. (199111192007122764) - Specialization: Matematika (Wajib) (ID: 15)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Diah Gunawan, S.Pd., M.Si.', 'diah.2764@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('199111192007122764', 'Diah Gunawan, S.Pd., M.Si.', 'diah.2764@guru.smansago.com', 'Matematika (Wajib)', 'aktif', LAST_INSERT_ID(), 15, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Yuli Setiawan, S.Pd. (197611202007112199) - Specialization: Sejarah Indonesia (Wajib) (ID: 17)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yuli Setiawan, S.Pd.', 'yuli.2199@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('197611202007112199', 'Yuli Setiawan, S.Pd.', 'yuli.2199@guru.smansago.com', 'Sejarah Indonesia (Wajib)', 'aktif', LAST_INSERT_ID(), 17, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Anwar Gunawan, S.Pd., M.Pd. (198511182013101195) - Specialization: Bahasa Inggris (Wajib) (ID: 20)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Anwar Gunawan, S.Pd., M.Pd.', 'anwar.1195@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198511182013101195', 'Anwar Gunawan, S.Pd., M.Pd.', 'anwar.1195@guru.smansago.com', 'Bahasa Inggris (Wajib)', 'aktif', LAST_INSERT_ID(), 20, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Nining Sudarsono, S.Pd., M.Si. (198011162009112617) - Specialization: Seni Budaya (ID: 23)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Nining Sudarsono, S.Pd., M.Si.', 'nining.2617@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198011162009112617', 'Nining Sudarsono, S.Pd., M.Si.', 'nining.2617@guru.smansago.com', 'Seni Budaya', 'aktif', LAST_INSERT_ID(), 23, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Ani Purnama, S.Pd., M.Si. (198710122009112420) - Specialization: Pendidikan Jasmani, Olahraga & Kesehatan (PJOK) (ID: 26)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ani Purnama, S.Pd., M.Si.', 'ani.2420@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198710122009112420', 'Ani Purnama, S.Pd., M.Si.', 'ani.2420@guru.smansago.com', 'Pendidikan Jasmani, Olahraga & Kesehatan (PJOK)', 'aktif', LAST_INSERT_ID(), 26, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Taufik Prasetyo, S.Si. (198210252016111356) - Specialization: Matematika Peminatan (ID: 29)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Taufik Prasetyo, S.Si.', 'taufik.1356@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198210252016111356', 'Taufik Prasetyo, S.Si.', 'taufik.1356@guru.smansago.com', 'Matematika Peminatan', 'aktif', LAST_INSERT_ID(), 29, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Irwan Gunawan, S.Si., M.Pd. (198010212006101991) - Specialization: Fisika (ID: 2)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Irwan Gunawan, S.Si., M.Pd.', 'irwan.1991@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198010212006101991', 'Irwan Gunawan, S.Si., M.Pd.', 'irwan.1991@guru.smansago.com', 'Fisika', 'aktif', LAST_INSERT_ID(), 2, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Eni Rahardjo, S.Pd., M.Pd. (198410112007112828) - Specialization: Kimia (ID: 3)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eni Rahardjo, S.Pd., M.Pd.', 'eni.2828@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198410112007112828', 'Eni Rahardjo, S.Pd., M.Pd.', 'eni.2828@guru.smansago.com', 'Kimia', 'aktif', LAST_INSERT_ID(), 3, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Nining Kusumo, S.Pd., M.Pd. (198812232017102388) - Specialization: Biologi (ID: 36)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Nining Kusumo, S.Pd., M.Pd.', 'nining.2388@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198812232017102388', 'Nining Kusumo, S.Pd., M.Pd.', 'nining.2388@guru.smansago.com', 'Biologi', 'aktif', LAST_INSERT_ID(), 36, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Dewi Mulyadi, S.Pd., M.Si. (198012122005112656) - Specialization: Ekonomi & Akuntansi (ID: 39)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Dewi Mulyadi, S.Pd., M.Si.', 'dewi.2656@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198012122005112656', 'Dewi Mulyadi, S.Pd., M.Si.', 'dewi.2656@guru.smansago.com', 'Ekonomi & Akuntansi', 'aktif', LAST_INSERT_ID(), 39, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Irwan Subagyo, S.Si., M.Pd. (198212222014111561) - Specialization: Sosiologi (ID: 42)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Irwan Subagyo, S.Si., M.Pd.', 'irwan.1561@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198212222014111561', 'Irwan Subagyo, S.Si., M.Pd.', 'irwan.1561@guru.smansago.com', 'Sosiologi', 'aktif', LAST_INSERT_ID(), 42, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Yuli Purnama, S.S. (198012102017102592) - Specialization: Geografi (ID: 45)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yuli Purnama, S.S.', 'yuli.2592@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198012102017102592', 'Yuli Purnama, S.S.', 'yuli.2592@guru.smansago.com', 'Geografi', 'aktif', LAST_INSERT_ID(), 45, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Nining Wibowo, S.Pd., M.Si. (199510142011112236) - Specialization: Sejarah Peminatan (ID: 48)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Nining Wibowo, S.Pd., M.Si.', 'nining.2236@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('199510142011112236', 'Nining Wibowo, S.Pd., M.Si.', 'nining.2236@guru.smansago.com', 'Sejarah Peminatan', 'aktif', LAST_INSERT_ID(), 48, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Toto Susanto, S.Pd. (197210172005121817) - Specialization: Prakarya & Kewirausahaan (PKWU) (ID: 51)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Toto Susanto, S.Pd.', 'toto.1817@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('197210172005121817', 'Toto Susanto, S.Pd.', 'toto.1817@guru.smansago.com', 'Prakarya & Kewirausahaan (PKWU)', 'aktif', LAST_INSERT_ID(), 51, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Sri Sudarsono, S.S. (199511132010102244) - Specialization: Pendidikan Agama & Budi Pekerti (ID: 7)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Sri Sudarsono, S.S.', 'sri.2244@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('199511132010102244', 'Sri Sudarsono, S.S.', 'sri.2244@guru.smansago.com', 'Pendidikan Agama & Budi Pekerti', 'aktif', LAST_INSERT_ID(), 7, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Rudi Purnama, S.Si., M.Pd. (198612192013121769) - Specialization: Pendidikan Pancasila & Kewarganegaraan (PPKn) (ID: 10)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Rudi Purnama, S.Si., M.Pd.', 'rudi.1769@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198612192013121769', 'Rudi Purnama, S.Si., M.Pd.', 'rudi.1769@guru.smansago.com', 'Pendidikan Pancasila & Kewarganegaraan (PPKn)', 'aktif', LAST_INSERT_ID(), 10, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Siti Subagyo, S.Pd., M.Pd. (198312142015102295) - Specialization: Bahasa Indonesia (ID: 5)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Siti Subagyo, S.Pd., M.Pd.', 'siti.2295@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198312142015102295', 'Siti Subagyo, S.Pd., M.Pd.', 'siti.2295@guru.smansago.com', 'Bahasa Indonesia', 'aktif', LAST_INSERT_ID(), 5, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Agus Sudarsono, S.Si., M.Pd. (198011172009101202) - Specialization: Matematika (Wajib) (ID: 15)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Agus Sudarsono, S.Si., M.Pd.', 'agus.1202@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198011172009101202', 'Agus Sudarsono, S.Si., M.Pd.', 'agus.1202@guru.smansago.com', 'Matematika (Wajib)', 'aktif', LAST_INSERT_ID(), 15, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Eni Subagyo, S.Pd., M.Si. (197811122011102485) - Specialization: Sejarah Indonesia (Wajib) (ID: 17)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Eni Subagyo, S.Pd., M.Si.', 'eni.2485@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('197811122011102485', 'Eni Subagyo, S.Pd., M.Si.', 'eni.2485@guru.smansago.com', 'Sejarah Indonesia (Wajib)', 'aktif', LAST_INSERT_ID(), 17, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Ika Rahardjo, S.Pd., M.Pd. (199210112010102936) - Specialization: Bahasa Inggris (Wajib) (ID: 20)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Ika Rahardjo, S.Pd., M.Pd.', 'ika.2936@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('199210112010102936', 'Ika Rahardjo, S.Pd., M.Pd.', 'ika.2936@guru.smansago.com', 'Bahasa Inggris (Wajib)', 'aktif', LAST_INSERT_ID(), 20, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Irwan Hartono, S.Pd., M.Pd. (197010182014111795) - Specialization: Seni Budaya (ID: 23)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Irwan Hartono, S.Pd., M.Pd.', 'irwan.1795@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('197010182014111795', 'Irwan Hartono, S.Pd., M.Pd.', 'irwan.1795@guru.smansago.com', 'Seni Budaya', 'aktif', LAST_INSERT_ID(), 23, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Yusuf Rahardjo, S.Si. (197711252014101347) - Specialization: Pendidikan Jasmani, Olahraga & Kesehatan (PJOK) (ID: 26)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yusuf Rahardjo, S.Si.', 'yusuf.1347@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('197711252014101347', 'Yusuf Rahardjo, S.Si.', 'yusuf.1347@guru.smansago.com', 'Pendidikan Jasmani, Olahraga & Kesehatan (PJOK)', 'aktif', LAST_INSERT_ID(), 26, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Yuli Gunawan, S.S. (197711172017112176) - Specialization: Matematika Peminatan (ID: 29)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Yuli Gunawan, S.S.', 'yuli.2176@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('197711172017112176', 'Yuli Gunawan, S.S.', 'yuli.2176@guru.smansago.com', 'Matematika Peminatan', 'aktif', LAST_INSERT_ID(), 29, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Aris Hidayat, S.Si., M.Pd. (198111252018101134) - Specialization: Fisika (ID: 2)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Aris Hidayat, S.Si., M.Pd.', 'aris.1134@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198111252018101134', 'Aris Hidayat, S.Si., M.Pd.', 'aris.1134@guru.smansago.com', 'Fisika', 'aktif', LAST_INSERT_ID(), 2, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Agus Nugroho, S.Pd. (199411272007121774) - Specialization: Kimia (ID: 3)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Agus Nugroho, S.Pd.', 'agus.1774@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('199411272007121774', 'Agus Nugroho, S.Pd.', 'agus.1774@guru.smansago.com', 'Kimia', 'aktif', LAST_INSERT_ID(), 3, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Wahyuni Setiawan, S.Pd., M.Si. (198110132011122358) - Specialization: Biologi (ID: 36)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Wahyuni Setiawan, S.Pd., M.Si.', 'wahyuni.2358@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('198110132011122358', 'Wahyuni Setiawan, S.Pd., M.Si.', 'wahyuni.2358@guru.smansago.com', 'Biologi', 'aktif', LAST_INSERT_ID(), 36, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();

-- Teacher: Retno Mulyadi, S.Pd., M.Pd. (197910192009112725) - Specialization: Ekonomi & Akuntansi (ID: 39)
INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)
VALUES ('Retno Mulyadi, S.Pd., M.Pd.', 'retno.2725@guru.smansago.com', '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa', 'guru', NOW(), NOW())
ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();
INSERT INTO `guru` (`nip`, `nama`, `email`, `spesialisasi`, `status`, `pengguna_id`, `specialization_id`, `created_at`, `updated_at`)
VALUES ('197910192009112725', 'Retno Mulyadi, S.Pd., M.Pd.', 'retno.2725@guru.smansago.com', 'Ekonomi & Akuntansi', 'aktif', LAST_INSERT_ID(), 39, NOW(), NOW())
ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `email` = VALUES(`email`), `spesialisasi` = VALUES(`spesialisasi`), `pengguna_id` = VALUES(`pengguna_id`), `specialization_id` = VALUES(`specialization_id`), `updated_at` = NOW();
