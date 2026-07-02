<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$faker = \Faker\Factory::create('id_ID');

$sql = "";
$passwordHash = '$2y$12$gpMditjdy5xTeetLcVUxEeQyRkPePHE53HQs.QRF57O4EuXd59CQa'; // default password

// NIS starts from a given number to avoid collision
$baseNis = 4101001000;

for ($i = 1; $i <= 100; $i++) {
    $nis = $baseNis + $i;
    $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
    
    // Generate name based on gender
    if ($gender == 'Laki-laki') {
        $nama = $faker->firstNameMale . ' ' . $faker->lastName;
    } else {
        $nama = $faker->firstNameFemale . ' ' . $faker->lastName;
    }
    // Clean up name quotes
    $nama = str_replace("'", "''", $nama);
    
    $email = $nis . '@siswa.smansago.com';
    $kelas = $faker->randomElement(['X IPA', 'X IPS']);
    
    $sql .= "-- Student: $nama ($nis) - $kelas\n";
    $sql .= "INSERT INTO `pengguna` (`nama`, `email`, `password`, `role`, `created_at`, `updated_at`)\n";
    $sql .= "VALUES ('$nama', '$email', '$passwordHash', 'siswa', NOW(), NOW())\n";
    $sql .= "ON DUPLICATE KEY UPDATE `id` = LAST_INSERT_ID(`id`), `nama` = VALUES(`nama`), `updated_at` = NOW();\n";
    
    $sql .= "INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `kelas`, `status`, `pengguna_id`, `created_at`, `updated_at`)\n";
    $sql .= "VALUES ('$nis', '$nama', '$gender', '$kelas', 'aktif', (SELECT `id` FROM `pengguna` WHERE `email` = '$email'), NOW(), NOW())\n";
    $sql .= "ON DUPLICATE KEY UPDATE `nama` = VALUES(`nama`), `jenis_kelamin` = VALUES(`jenis_kelamin`), `kelas` = VALUES(`kelas`), `pengguna_id` = VALUES(`pengguna_id`), `updated_at` = NOW();\n\n";
}

file_put_contents('database/siswa_import_x.sql', $sql);
echo "Generated 100 students in database/siswa_import_x.sql";
