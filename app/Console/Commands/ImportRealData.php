<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ImportRealData extends Command
{
    protected $signature = 'data:import-real';
    protected $description = 'Import data real Guru dan Siswa dari file Excel dan buat akun login sementara';

    public function handle()
    {
        $this->info('Memulai import data...');

        $guruFile = base_path('md/data_rill/DAFTAR GURU MAPEL.xlsx');
        $siswaFile = base_path('md/data_rill/DAFTAR PESERTA DIDIK.xls');

        if (!file_exists($guruFile) || !file_exists($siswaFile)) {
            $this->error('File Excel tidak ditemukan di md/data_rill/');
            return;
        }

        // Siapkan file CSV untuk credentials
        $csvPath = public_path('credentials_sementara.csv');
        $csvFile = fopen($csvPath, 'w');
        fputcsv($csvFile, ['Role', 'Nama Asli', 'Email Login (Sementara)', 'Password Default']);

        DB::beginTransaction();
        try {
            $this->importGuru($guruFile, $csvFile);
            $this->importSiswa($siswaFile, $csvFile);
            DB::commit();
            fclose($csvFile);
            $this->info('Import data berhasil disimpan ke database!');
            $this->info('File kredensial login sementara telah dibuat di: public/credentials_sementara.csv');
        } catch (\Exception $e) {
            DB::rollBack();
            fclose($csvFile);
            $this->error('Gagal import data: ' . $e->getMessage());
        }
    }

    private function generateProfessionalEmail($nama, $domain)
    {
        // Hilangkan gelar gelar (titik, koma, gelar-gelar umum)
        $cleanName = preg_replace('/(S\.Pd|M\.Pd|Drs\.|Dra\.|H\.|Hj\.|S\.Ag|M\.Ag|S\.Kom|M\.Kom)/i', '', $nama);
        // Hapus karakter non-alfabet
        $cleanName = preg_replace('/[^a-zA-Z\s]/', '', $cleanName);
        $cleanName = trim(strtolower($cleanName));
        // Hapus spasi ganda
        $cleanName = preg_replace('/\s+/', ' ', $cleanName);

        $parts = explode(' ', $cleanName);
        
        // Ambil maksimal 2 kata: nama depan & kata berikutnya (atau belakang)
        if (count($parts) > 1) {
            $baseEmail = $parts[0] . '.' . end($parts); // pakai nama depan.belakang
        } else {
            $baseEmail = $parts[0];
        }

        // Jika string kosong karena suatu alasan, fallback
        if (empty($baseEmail)) {
            $baseEmail = 'user.' . Str::random(4);
        }
        
        $email = $baseEmail . '@' . $domain;
        $counter = 1;

        // Pastikan email benar-benar unik di database
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
            if ($index === 0) continue; // Skip header

            $no = trim($row[0] ?? '');
            $nama = trim($row[1] ?? '');
            $mapel = trim($row[2] ?? '');

            if (empty($nama) || strtolower($nama) === 'nama') continue;

            $exists = Guru::where('nama', $nama)->exists();
            if (!$exists) {
                // Buat akun user sementara (dengan format email profesional)
                $email = $this->generateProfessionalEmail($nama, 'smansago.com');
                $password = 'password';

                $user = User::create([
                    'nama' => $nama,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => 'guru'
                ]);

                Guru::create([
                    'nama' => $nama,
                    'spesialisasi' => $mapel,
                    'status' => 'aktif',
                    'nip' => null,
                    'email' => null,
                    'pengguna_id' => $user->id
                ]);

                fputcsv($csvFile, ['Guru', $nama, $email, $password]);
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
            $no = trim($row[0] ?? '');
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
                // Buat akun user sementara (dengan format email profesional)
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

                // Update foreign key di users jika User model punya relasi balik
                if (in_array('student_id', \Illuminate\Support\Facades\Schema::getColumnListing('pengguna'))) {
                    $user->update(['student_id' => $siswa->id]);
                }

                fputcsv($csvFile, ['Siswa', $nama, $email, $password]);
                $count++;
            }
        }
        $this->info("Berhasil menambahkan $count siswa baru.");
    }
}
