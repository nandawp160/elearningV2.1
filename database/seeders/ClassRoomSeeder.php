<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class ClassRoomSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            'X' => ['X.1', 'X.2', 'X.3', 'X.4', 'X.5', 'X.6', 'X.7'],
            'XI' => ['XI F 1', 'XI F 2.1', 'XI F 2.2', 'XI F 3.1', 'XI F 3.2', 'XI F 4.1', 'XI F 4.2'],
            'XII' => ['XII F 1', 'XII F 2.1', 'XII F 2.2', 'XII F 3.1', 'XII F 3.2', 'XII F.4']
        ];
        
        $academicYear = '2026/2027';

        // Bersihkan data kelas lama dengan mengabaikan foreign key constraints
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Kelas::withoutGlobalScopes()->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        foreach ($classes as $grade => $roomNames) {
            foreach ($roomNames as $name) {
                // Tentukan major/jurusan jika diperlukan
                $major = str_contains($name, 'F') ? 'Fase F' : 'Fase E';

                Kelas::withoutGlobalScopes()->create([
                    'name' => $name,
                    'academic_year' => $academicYear,
                    'grade_level' => $grade,
                    'major' => $major,
                    'max_students' => 36,
                ]);
            }
        }
        
        $this->command->info('Master data Kelas (Sesuai Rombel Real) berhasil dibuat!');
    }
}
