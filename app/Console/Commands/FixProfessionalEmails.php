<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FixProfessionalEmails extends Command
{
    protected $signature = 'data:fix-emails';
    protected $description = 'Ubah format email guru dan siswa menjadi lebih profesional dan regenerate file credentials_sementara.csv';

    public function handle()
    {
        $this->info('Memulai pembaruan format email...');

        $csvPath = public_path('credentials_sementara.csv');
        $csvFile = fopen($csvPath, 'w');
        fputcsv($csvFile, ['Role', 'Nama Asli', 'Email Login (Sementara)', 'Password Default']);

        DB::beginTransaction();
        try {
            $users = User::whereIn('role', ['guru', 'siswa'])->get();
            $count = 0;

            foreach ($users as $user) {
                $domain = $user->role === 'guru' ? 'smansago.com' : 'siswa.smansago.com';
                
                // Gunakan fungsi untuk men-generate email profesional
                $newEmail = $this->generateProfessionalEmail($user->nama, $domain);

                // Update user email
                $user->email = $newEmail;
                $user->save();

                // Tulis ke CSV (karena password di DB sudah di hash, kita asumsikan defaultnya 'password' jika ini hasil import)
                // Catatan: Jika password sudah pernah diubah user, maka CSV ini hanya representasi "default".
                fputcsv($csvFile, [ucfirst($user->role), $user->nama, $newEmail, 'password']);
                $count++;
            }

            DB::commit();
            fclose($csvFile);
            
            $this->info("Berhasil memperbarui $count email menjadi format profesional!");
            $this->info('File kredensial telah di-regenerate: public/credentials_sementara.csv');

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($csvFile);
            $this->error('Terjadi kesalahan: ' . $e->getMessage());
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
        // Pengecualian: jangan looping infinite jika kebetulan usernya sedang diupdate dan email sama.
        while (User::where('email', $email)->exists()) {
            $email = $baseEmail . $counter . '@' . $domain;
            $counter++;
        }

        return $email;
    }
}
