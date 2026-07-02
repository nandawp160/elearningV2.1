<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class DummyTeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            [
                'nip' => '198801012015011001',
                'name' => 'Drs. H. Mulyadi, M.Pd.',
                'email' => 'mulyadi@guru.smansago.com',
                'phone' => '081299887766',
                'specialization' => 'Bahasa Indonesia',
                'address' => 'Jl. Pendidikan No. 12, Jakarta',
                'status' => 'active'
            ],
            [
                'nip' => '199012122018032005',
                'name' => 'Sari Wahyuni, S.Pd.',
                'email' => 'sari.wahyuni@guru.smansago.com',
                'phone' => '085711223344',
                'specialization' => 'Bahasa Inggris',
                'address' => 'Perum Griya Indah Blok C/15, Bogor',
                'status' => 'active'
            ],
            [
                'nip' => '198505202010011003',
                'name' => 'Bambang Sudarsono, S.T.',
                'email' => 'bambang.s@guru.smansago.com',
                'phone' => '082155667788',
                'specialization' => 'Informatika',
                'address' => 'Jl. Teknologi No. 45, Depok',
                'status' => 'active'
            ],
            [
                'nip' => '199207152019012008',
                'name' => 'Dewi Lestari, M.Si.',
                'email' => 'dewi.lestari@guru.smansago.com',
                'phone' => '081388990011',
                'specialization' => 'Biologi',
                'address' => 'Apartemen Mentari Tower A No. 102',
                'status' => 'active'
            ],
            [
                'nip' => '198003102005011002',
                'name' => 'Eko Prasetyo, S.Pd.',
                'email' => 'eko.prasetyo@guru.smansago.com',
                'phone' => '089844556677',
                'specialization' => 'Sejarah',
                'address' => 'Jl. Pahlawan No. 7, Bekasi',
                'status' => 'inactive'
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::updateOrCreate(['nip' => $teacher['nip']], $teacher);
        }

        echo "✅ 5 data dummy guru berhasil ditambahkan.\n";
    }
}
