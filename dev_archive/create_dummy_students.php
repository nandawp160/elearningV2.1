<?php

// Script untuk generate 40 siswa dummy
// Run dengan: php artisan tinker < create_dummy_students.php

use App\Models\Student;
use Illuminate\Support\Facades\DB;

echo "Creating 40 dummy students...\n";

$namaDepan = ['Andi', 'Budi', 'Citra', 'Dian', 'Eko', 'Farah', 'Gilang', 'Hana', 'Indra', 'Joko', 'Kartika', 'Lina', 'Maya', 'Nanda', 'Oscar', 'Putri', 'Qori', 'Rani', 'Sinta', 'Toni', 'Umar', 'Vina', 'Wahyu', 'Yuni', 'Zahra'];
$namaBelakang = ['Pratama', 'Santoso', 'Dewi', 'Puspita', 'Prasetyo', 'Wijaya', 'Kusuma', 'Permata', 'Saputra', 'Lestari', 'Hakim', 'Nugroho', 'Sari', 'Ramadhan', 'Hidayat'];

for ($i = 1; $i <= 40; $i++) {
    $depan = $namaDepan[array_rand($namaDepan)];
    $belakang = $namaBelakang[array_rand($namaBelakang)];
    $nama = $depan . ' ' . $belakang;
    
    $nis = '2025' . str_pad($i, 3, '0', STR_PAD_LEFT);
    $gender = ($i % 2 == 0) ? 'P' : 'L';
    $tahun = 2009;
    $bulan = rand(1, 12);
    $hari = rand(1, 28);
    
    Student::create([
        'nis' => $nis,
        'name' => $nama,
        'email' => strtolower(str_replace(' ', '', $depan)) . $i . '@student.edulearn.com',
        'phone' => '08' . rand(1000000000, 9999999999),
        'gender' => $gender,
        'date_of_birth' => sprintf('%d-%02d-%02d', $tahun, $bulan, $hari),
        'entry_year' => 2025,
        'address' => 'Jl. Pendidikan No. ' . rand(1, 100) . ', Jakarta',
        'status' => 'active',
    ]);
    
    if ($i % 10 == 0) {
        echo "Created $i students...\n";
    }
}

echo "✅ Successfully created 40 dummy students!\n";
echo "You can now see them in the students page.\n";
