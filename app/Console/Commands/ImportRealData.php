<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

class ImportRealData extends Command
{
    protected $signature = 'data:import-real';
    protected $description = 'Import data real dari Excel (Dapodik), kosongkan database, dan set data.';

    public function handle()
    {
        $this->info('Mengosongkan database dan menjalankan migrasi ulang...');
        Artisan::call('migrate:fresh');
        $this->info('Database berhasil dikosongkan.');

        $this->info('Membuat Super Admin...');
        User::create([
            'nama' => 'Super Admin',
            'email' => 'admin@admin.smansago.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::create([
            'nama' => 'Staf TU',
            'email' => 'tu@admin.smansago.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        $this->info('Super Admin berhasil dibuat.');

        $guruFile = base_path('md/data_rill/DAFTAR GURU MAPEL.xlsx');
        $siswaFile = base_path('md/data_rill/DAFTAR PESERTA DIDIK.xls');
        $rombelFile = base_path('md/data_rill/ROMBEL.xlsx');

        if (!file_exists($guruFile) || !file_exists($siswaFile) || !file_exists($rombelFile)) {
            $this->error('File Excel tidak ditemukan di md/data_rill/');
            return;
        }

        $csvPath = public_path('credentials_sementara.csv');
        $csvFile = fopen($csvPath, 'w');
        fputcsv($csvFile, ['Role', 'Nama Asli', 'Email Login', 'Password']);

        DB::beginTransaction();
        try {
            $this->importGuru($guruFile, $csvFile);
            $this->importSiswa($siswaFile, $csvFile);
            $this->importRombel($rombelFile);
            DB::commit();
            fclose($csvFile);
            $this->info('Import data berhasil disimpan ke database!');
            $this->info('File kredensial login telah dibuat di: public/credentials_sementara.csv');
        } catch (\Exception $e) {
            DB::rollBack();
            fclose($csvFile);
            $this->error('Gagal import data: ' . $e->getMessage());
        }
    }

    private function generateProfessionalEmail($nama, $domain)
    {
        $cleanName = preg_replace('/(S\.Pd|M\.Pd|Drs\.|Dra\.|H\.|Hj\.|S\.Ag|M\.Ag|S\.Kom|M\.Kom)/i', '', $nama);
        $cleanName = preg_replace('/[^a-zA-Z\s]/', '', $cleanName);
        $cleanName = trim(strtolower($cleanName));
        $cleanName = preg_replace('/\s+/', ' ', $cleanName);
        $parts = explode(' ', $cleanName);
        
        if (count($parts) > 1) {
            $baseEmail = $parts[0] . '.' . end($parts);
        } else {
            $baseEmail = $parts[0];
        }

        if (empty($baseEmail)) {
            $baseEmail = 'user.' . Str::random(4);
        }
        
        $email = $baseEmail . '@' . $domain;
        $counter = 1;

        while (User::where('email', $email)->exists()) {
            $email = $baseEmail . $counter . '@' . $domain;
            $counter++;
        }

        return $email;
    }

    private function importGuru($file, $csvFile)
    {
        $this->info('Mengimport Data Guru...');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $count = 0;
        foreach ($rows as $index => $row) {
            if ($index < 3) continue; // Skip headers

            $nama = trim($row[1] ?? '');
            $gelar = trim($row[4] ?? '');
            $mapelName = trim($row[5] ?? '');

            if (empty($nama) || strtolower($nama) === 'nama' || strtolower($nama) === 'nama pendidik') continue;

            $namaLengkap = $nama . (!empty($gelar) ? ', ' . $gelar : '');

            // Handle Mata Pelajaran
            $mapelId = null;
            if (!empty($mapelName)) {
                $mapel = MataPelajaran::firstOrCreate(
                    ['nama' => $mapelName],
                    [
                        'kode' => strtoupper(substr($mapelName, 0, 3)) . '-' . Str::random(3),
                        'deskripsi' => 'Mata Pelajaran ' . $mapelName,
                        'tingkat' => null,
                        'status' => 'aktif'
                    ]
                );
                $mapelId = $mapel->id;
            }

            $exists = Guru::where('nama', $namaLengkap)->exists();
            if (!$exists) {
                $email = $this->generateProfessionalEmail($nama, 'guru.smansago.com');
                $password = 'password';

                $user = User::create([
                    'nama' => $namaLengkap,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => 'guru'
                ]);

                Guru::create([
                    'nama' => $namaLengkap,
                    'spesialisasi' => $mapelName,
                    'specialization_id' => $mapelId,
                    'status' => 'aktif',
                    'nip' => null,
                    'email' => $email,
                    'pengguna_id' => $user->id
                ]);

                fputcsv($csvFile, ['Guru', $namaLengkap, $email, $password]);
                $count++;
            }
        }
        $this->info("Berhasil menambahkan $count guru baru.");
    }

    private function importSiswa($file, $csvFile)
    {
        $this->info('Mengimport Data Siswa...');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $count = 0;
        foreach ($rows as $index => $row) {
            if ($index < 5) continue; // Skip headers

            $nama = trim($row[1] ?? '');
            
            if (empty($nama) || strtolower($nama) === 'nama' || strtolower($nama) === 'nama peserta didik') continue;

            $tempatLahir = trim($row[2] ?? '');
            $tanggalLahirRaw = trim($row[3] ?? '');
            
            $tanggalLahir = null;
            if (!empty($tanggalLahirRaw) && strtotime($tanggalLahirRaw)) {
                $tanggalLahir = date('Y-m-d', strtotime($tanggalLahirRaw));
            }

            $kelas = trim($row[4] ?? '');

            $exists = Siswa::where('nama', $nama)->where('kelas', $kelas)->exists();
            if (!$exists) {
                $email = $this->generateProfessionalEmail($nama, 'siswa.smansago.com');
                $password = 'password';

                $user = User::create([
                    'nama' => $nama,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => 'siswa'
                ]);

                $siswa = Siswa::create([
                    'nama' => $nama,
                    'tempat_lahir' => $tempatLahir,
                    'tanggal_lahir' => $tanggalLahir ?: null,
                    'kelas' => $kelas,
                    'status' => 'aktif',
                    'nis' => null,
                    'pengguna_id' => $user->id
                ]);

                fputcsv($csvFile, ['Siswa', $nama, $email, $password]);
                $count++;
            }
        }
        $this->info("Berhasil menambahkan $count siswa baru.");
    }

    private function importRombel($file)
    {
        $this->info('Mengimport Data Rombel...');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $count = 0;
        foreach ($rows as $index => $row) {
            if ($index < 5) continue;

            $namaRombel = trim($row[1] ?? '');
            if (empty($namaRombel) || strtolower($namaRombel) === 'nama rombel') continue;

            $tingkat = trim($row[2] ?? '');
            $waliKelasNama = trim($row[6] ?? '');

            $guruId = null;
            if (!empty($waliKelasNama)) {
                // Cari guru berdasarkan nama (karena format di Rombel mungkin tanpa gelar)
                $guru = Guru::where('nama', 'LIKE', '%' . $waliKelasNama . '%')->first();
                if ($guru) {
                    $guruId = $guru->id;
                }
            }
            
            $grade = 'X';
            if ($tingkat == '11') $grade = 'XI';
            if ($tingkat == '12') $grade = 'XII';
            
            // Major fallback since not defined in excel exactly, parse from name if possible
            $major = 'IPA'; 
            if (stripos($namaRombel, 'IPS') !== false) {
                $major = 'IPS';
            }

            Kelas::firstOrCreate([
                'name' => $namaRombel,
            ], [
                'grade_level' => $grade,
                'major' => $major,
                'homeroom_teacher_id' => $guruId,
                'academic_year' => '2026/2027',
                'max_students' => 40
            ]);

            $count++;
        }
        $this->info("Berhasil menambahkan $count rombel.");
    }
}
