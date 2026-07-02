<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class StudentLoginSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'andi@siswa.smansago.com';
        
        // Ensure student exists
        $student = Siswa::firstOrCreate(
            ['email' => $email],
            [
                'nis' => '2025001',
                'name' => 'Andi Pratama',
                'phone' => '081234560001',
                'address' => 'Jl. Merdeka No. 1',
                'gender' => 'L',
                'date_of_birth' => '2009-05-15',
                'entry_year' => '2025',
                'status' => 'active'
            ]
        );

        $class = Kelas::where('name', 'X IPA 1')->first() ?? Kelas::first();
        if ($class) {
            $student->update(['kelas' => $class->name]);
        }

        // Create/Update user
        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Andi Pratama',
                'password' => Hash::make('password'),
                'role' => 'student',
                'student_id' => $student->id,
                'email_verified_at' => now(),
            ]
        );
    }
}
