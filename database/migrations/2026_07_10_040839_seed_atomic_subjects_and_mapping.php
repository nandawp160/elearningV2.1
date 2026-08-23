<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Define Atomic Subjects
        $atomicSubjects = [
            'Ekonomi', 'Seni dan Budaya', 'Bahasa Inggris', 'Geografi',
            'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'Pendidikan Pancasila',
            'Sosiologi', 'Fisika', 'Bahasa Indonesia', 'Matematika Tingkat Lanjut',
            'Matematika (Umum)', 'Informatika', 'Kimia', 'Prakarya dan Kewirausahaan',
            'Pendidikan Agama Islam dan Budi Pekerti', 'Bahasa Indonesia Tingkat Lanjut',
            'Bahasa Inggris Tingkat Lanjut', 'Bimbingan dan Konseling/Konselor (BP/BK)',
            'Muatan Lokal Bahasa Daerah', 'Sejarah', 'Biologi'
        ];

        $subjectMap = [];
        foreach ($atomicSubjects as $nama) {
            $mapel = DB::table('mata_pelajaran')->where('nama', $nama)->first();
            if (!$mapel) {
                // Insert if not exist
                $id = DB::table('mata_pelajaran')->insertGetId([
                    'kode' => 'MPL-' . strtoupper(substr(md5($nama), 0, 5)),
                    'nama' => $nama,
                    'status' => 'aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $subjectMap[$nama] = $id;
            } else {
                $subjectMap[$nama] = $mapel->id;
            }
        }

        // 2. Mapping Guru to Atomic Subjects based on exact Dapodik data
        $guruMapping = [
            'Abdul Rouf, S.Pd' => ['Ekonomi'],
            'Agung Srihartono, S.Pd' => ['Seni dan Budaya'],
            'Ardjanto, S.Pd' => ['Bahasa Inggris'],
            'ARIEF DARMAYANTI, S.Pd' => ['Bahasa Inggris'],
            'Arik Andriyani, S.S.' => ['Geografi'],
            'Djoko Heriyanto, S.Pd, M.Pd' => ['Pendidikan Jasmani, Olahraga, dan Kesehatan'],
            'Endah Wahyuningsih, S.Pd' => ['Pendidikan Pancasila'],
            'Endang Widayanti, S.Sos' => ['Sosiologi'],
            'Eri Kriswanti, S.Pd' => ['Fisika'],
            'Ervhiendri Ali Akhmad, S.Pd' => ['Pendidikan Jasmani, Olahraga, dan Kesehatan'],
            'Heni Setyarini, S.Pd' => ['Bahasa Indonesia'],
            'Heru Rismawan, S.Pd' => ['Matematika Tingkat Lanjut', 'Matematika (Umum)'],
            'Iis Lestari, S.Kom' => ['Informatika'],
            'Is Imanah, S.Pd, M.Pd' => ['Kimia', 'Prakarya dan Kewirausahaan'],
            'Joko Widodo, S.Pd' => ['Pendidikan Jasmani, Olahraga, dan Kesehatan', 'Matematika (Umum)'],
            'Khoirul Umam, S.Pd' => ['Pendidikan Agama Islam dan Budi Pekerti'],
            'Lanjar Setyowati, S.Pd' => ['Bahasa Indonesia Tingkat Lanjut', 'Bahasa Inggris Tingkat Lanjut', 'Bahasa Inggris'],
            'Murdananto' => ['Bimbingan dan Konseling/Konselor (BP/BK)'],
            'Murtini Ningsih, S.Si' => ['Matematika Tingkat Lanjut', 'Matematika (Umum)'],
            'Oryza Hesak Karismaningtyas, S.Pd' => ['Prakarya dan Kewirausahaan', 'Fisika'],
            'Puput Rika Harjani, S.Pd' => ['Muatan Lokal Bahasa Daerah', 'Bahasa Inggris'],
            'Ratna Suryani, S.Pd' => ['Sejarah'],
            'Septa Falintina, S.Pd, M.T' => ['Kimia', 'Informatika'],
            'Sri Kundarti, S.Pd' => ['Ekonomi'],
            'Sri Widyastuti, S.Pd.I' => ['Pendidikan Agama Islam dan Budi Pekerti'],
            'Sunarno, S.Pd' => ['Matematika (Umum)'],
            'Susilawati' => ['Bahasa Indonesia', 'Matematika (Umum)'],
            'Syamsudin, S.Pd' => ['Biologi'],
            'Teguh, S.Pd' => ['Bahasa Indonesia Tingkat Lanjut', 'Bahasa Indonesia'],
            'Tiyastuti Nur Cahyani, S.Pd' => ['Geografi', 'Matematika (Umum)'],
            'Tutik Mahendra Dewi, S.Pd' => ['Biologi'],
            'Umi Farichah, S.Pd, M.Pd' => ['Kimia'],
            'Widodo, S.Pd' => ['Matematika Tingkat Lanjut', 'Matematika (Umum)'],
        ];

        foreach ($guruMapping as $namaGuru => $mapels) {
            $guru = DB::table('guru')->where('nama', $namaGuru)->first();
            if ($guru) {
                foreach ($mapels as $mapelNama) {
                    $mapelId = $subjectMap[$mapelNama] ?? null;
                    if ($mapelId) {
                        DB::table('guru_mata_pelajaran')->updateOrInsert(
                            ['guru_id' => $guru->id, 'mata_pelajaran_id' => $mapelId],
                            ['created_at' => now(), 'updated_at' => now()]
                        );
                    }
                }
            }
        }
    }

    public function down(): void
    {
        DB::table('guru_mata_pelajaran')->truncate();
    }
};
