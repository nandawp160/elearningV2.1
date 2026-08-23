<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\RiwayatKelasSiswa;
use App\Models\Pengaturan;

class RiwayatKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activeYear = Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
        
        $students = Siswa::whereNotNull('kelas')->get();
        $count = 0;

        foreach ($students as $student) {
            // Check if record already exists to avoid duplicates
            $exists = RiwayatKelasSiswa::where('siswa_id', $student->id)
                ->where('academic_year', $activeYear)
                ->exists();

            if (!$exists) {
                RiwayatKelasSiswa::create([
                    'siswa_id' => $student->id,
                    'kelas_name' => $student->kelas,
                    'academic_year' => $activeYear,
                ]);
                $count++;
            }
        }

        $this->command->info("Berhasil menambahkan {$count} riwayat kelas untuk tahun ajaran {$activeYear}.");
    }
}
