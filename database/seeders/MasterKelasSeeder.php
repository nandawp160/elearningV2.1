<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterKelas;

class MasterKelasSeeder extends Seeder
{
    public function run(): void
    {
        $masterClasses = [
            // Kelas X (Fase E / Umum)
            ['name' => 'X 1', 'grade_level' => 'X', 'major' => 'Umum', 'entry_academic_year' => '2025/2026'],
            ['name' => 'X 2', 'grade_level' => 'X', 'major' => 'Umum', 'entry_academic_year' => '2025/2026'],
            ['name' => 'X 3', 'grade_level' => 'X', 'major' => 'Umum', 'entry_academic_year' => '2025/2026'],
            ['name' => 'X 4', 'grade_level' => 'X', 'major' => 'Umum', 'entry_academic_year' => '2025/2026'],
            ['name' => 'X 5', 'grade_level' => 'X', 'major' => 'Umum', 'entry_academic_year' => '2025/2026'],
            ['name' => 'X 6', 'grade_level' => 'X', 'major' => 'Umum', 'entry_academic_year' => '2025/2026'],
            ['name' => 'X 7', 'grade_level' => 'X', 'major' => 'Umum', 'entry_academic_year' => '2025/2026'],
            ['name' => 'X 8', 'grade_level' => 'X', 'major' => 'Fase E', 'entry_academic_year' => '2025/2026'],

            // Kelas XI (Fase F)
            ['name' => 'XI F 1', 'grade_level' => 'XI', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XI F 2.1', 'grade_level' => 'XI', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XI F 2.2', 'grade_level' => 'XI', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XI F 3.1', 'grade_level' => 'XI', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XI F 3.2', 'grade_level' => 'XI', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XI F 4.1', 'grade_level' => 'XI', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XI F 4.2', 'grade_level' => 'XI', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],

            // Kelas XII (Fase F)
            ['name' => 'XII F 1', 'grade_level' => 'XII', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XII F 2.1', 'grade_level' => 'XII', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XII F 2.2', 'grade_level' => 'XII', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XII F 3.1', 'grade_level' => 'XII', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XII F 3.2', 'grade_level' => 'XII', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XII F 4.1', 'grade_level' => 'XII', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
            ['name' => 'XII F 4.2', 'grade_level' => 'XII', 'major' => 'Fase F', 'entry_academic_year' => '2025/2026'],
        ];

        foreach ($masterClasses as $class) {
            MasterKelas::updateOrCreate(
                ['name' => $class['name']],
                [
                    'grade_level' => $class['grade_level'],
                    'major' => $class['major'],
                    'entry_academic_year' => $class['entry_academic_year'] ?? '2025/2026',
                ]
            );
        }

        $this->command->info('Data Master Kelas berhasil dibuat/diperbarui (' . count($masterClasses) . ' kelas).');
    }
}
