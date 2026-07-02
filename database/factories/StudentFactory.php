<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        $namaDepan = ['Andi', 'Budi', 'Citra', 'Dian', 'Eko', 'Farah', 'Gilang', 'Hana', 'Indra', 'Joko', 'Kartika', 'Lina', 'Maya', 'Nanda', 'Oscar', 'Putri', 'Qori', 'Rani', 'Sinta', 'Toni', 'Umar', 'Vina', 'Wahyu', 'Yuni', 'Zahra'];
        $namaBelakang = ['Pratama', 'Santoso', 'Dewi', 'Puspita', 'Prasetyo', 'Wijaya', 'Kusuma', 'Permata', 'Saputra', 'Lestari', 'Hakim', 'Nugroho', 'Sari', 'Ramadhan', 'Hidayat'];
        
        $depan = $namaDepan[array_rand($namaDepan)];
        $belakang = $namaBelakang[array_rand($namaBelakang)];
        $nama = $depan . ' ' . $belakang;
        
        return [
            'nis' => '2025' . $this->faker->unique()->numberBetween(100, 999),
            'name' => $nama,
            'email' => strtolower(str_replace(' ', '', $nama)) . rand(1, 999) . '@student.edulearn.com',
            'phone' => '08' . $this->faker->numberBetween(1000000000, 9999999999),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'date_of_birth' => $this->faker->date('Y-m-d', '2010-12-31'),
            'entry_year' => 2025,
            'address' => 'Jl. ' . $this->faker->streetName() . ' No. ' . $this->faker->buildingNumber() . ', Jakarta',
            'status' => 'active',
        ];
    }
}
