<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Referensi Beban Jam Pelajaran (JP) mengacu pada standar Kurikulum SMA di Indonesia (K13 / Kurikulum Merdeka).
     */
    public function run()
    {
        $subjects = [
            // ==========================================
            // KELOMPOK A (UMUM / WAJIB)
            // ==========================================
            ['kode' => 'PAI', 'nama' => 'Pendidikan Agama dan Budi Pekerti', 'deskripsi' => 'Mata Pelajaran Wajib', 'beban_jp' => 3],
            ['kode' => 'PPKN', 'nama' => 'Pendidikan Pancasila dan Kewarganegaraan', 'deskripsi' => 'Mata Pelajaran Wajib', 'beban_jp' => 2],
            ['kode' => 'B-IND', 'nama' => 'Bahasa Indonesia', 'deskripsi' => 'Mata Pelajaran Wajib', 'beban_jp' => 4],
            ['kode' => 'MTK-W', 'nama' => 'Matematika (Wajib)', 'deskripsi' => 'Mata Pelajaran Wajib', 'beban_jp' => 4],
            ['kode' => 'SEJ-IND', 'nama' => 'Sejarah Indonesia', 'deskripsi' => 'Mata Pelajaran Wajib', 'beban_jp' => 2],
            ['kode' => 'B-ING', 'nama' => 'Bahasa Inggris', 'deskripsi' => 'Mata Pelajaran Wajib', 'beban_jp' => 2],

            // ==========================================
            // KELOMPOK B (UMUM / KEWILAYAHAN)
            // ==========================================
            ['kode' => 'SBD', 'nama' => 'Seni Budaya', 'deskripsi' => 'Mata Pelajaran Wajib B', 'beban_jp' => 2],
            ['kode' => 'PJOK', 'nama' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'deskripsi' => 'Mata Pelajaran Wajib B', 'beban_jp' => 3],
            ['kode' => 'PKWU', 'nama' => 'Prakarya dan Kewirausahaan', 'deskripsi' => 'Mata Pelajaran Wajib B', 'beban_jp' => 2],
            ['kode' => 'MULOK', 'nama' => 'Muatan Lokal (Bahasa Daerah)', 'deskripsi' => 'Mata Pelajaran Wajib B', 'beban_jp' => 2],

            // ==========================================
            // KELOMPOK C (PEMINATAN MIPA)
            // ==========================================
            ['kode' => 'MTK-P', 'nama' => 'Matematika Peminatan', 'deskripsi' => 'Peminatan MIPA', 'beban_jp' => 4],
            ['kode' => 'BIO', 'nama' => 'Biologi', 'deskripsi' => 'Peminatan MIPA', 'beban_jp' => 4],
            ['kode' => 'FIS', 'nama' => 'Fisika', 'deskripsi' => 'Peminatan MIPA', 'beban_jp' => 4],
            ['kode' => 'KIM', 'nama' => 'Kimia', 'deskripsi' => 'Peminatan MIPA', 'beban_jp' => 4],

            // ==========================================
            // KELOMPOK C (PEMINATAN IPS)
            // ==========================================
            ['kode' => 'GEO', 'nama' => 'Geografi', 'deskripsi' => 'Peminatan IPS', 'beban_jp' => 4],
            ['kode' => 'SEJ-P', 'nama' => 'Sejarah Peminatan', 'deskripsi' => 'Peminatan IPS', 'beban_jp' => 4],
            ['kode' => 'SOS', 'nama' => 'Sosiologi', 'deskripsi' => 'Peminatan IPS', 'beban_jp' => 4],
            ['kode' => 'EKO', 'nama' => 'Ekonomi', 'deskripsi' => 'Peminatan IPS', 'beban_jp' => 4],

            // ==========================================
            // LINTAS MINAT / LAINNYA
            // ==========================================
            ['kode' => 'TIK', 'nama' => 'Informatika', 'deskripsi' => 'Lintas Minat / Pilihan', 'beban_jp' => 3],
        ];

        // Karena satu mata pelajaran bisa diajarkan di tingkat X, XI, XII
        // Kita akan menduplikasi referensi di atas untuk setiap tingkat kelas.
        $tingkatKelas = ['X', 'XI', 'XII'];

        foreach ($tingkatKelas as $tingkat) {
            foreach ($subjects as $subject) {
                // Modifikasi kode agar unik per tingkat (Contoh: MTK-W-X)
                $kodeUnik = $subject['kode'] . '-' . $tingkat;
                $namaMapel = $subject['nama'] . ' Kelas ' . $tingkat;

                MataPelajaran::updateOrCreate(
                    [
                        'kode' => $kodeUnik,
                    ],
                    [
                        'nama' => $namaMapel,
                        'deskripsi' => $subject['deskripsi'],
                        'tingkat' => $tingkat,
                        'beban_jp' => $subject['beban_jp'],
                        'status' => 'aktif'
                    ]
                );
            }
        }
        
        echo "\n✅ Berhasil melakukan R&D (Seeding) data Mata Pelajaran beserta Beban JP Standar Nasional SMA.\n";
    }
}
