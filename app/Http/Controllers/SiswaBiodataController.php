<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use App\Models\PasswordChangeHistory;

class SiswaBiodataController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $student = $user->student;

        // Hitung kuota ganti password
        $passwordChangesCount = $user->passwordHistories()
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        $passwordChangesLeft = max(0, 2 - $passwordChangesCount);

        $classrooms = Kelas::withoutGlobalScopes()
            ->orderBy('grade_level')
            ->orderBy('major')
            ->orderBy('name')
            ->get()
            ->groupBy(['grade_level', 'major']);

        // Data default untuk form (jika siswa lama)
        $data = [
            'classrooms' => $classrooms,
            'student' => $student,
            'isUpdate' => (bool)$student,
            'passwordChangesLeft' => $passwordChangesLeft
        ];

        return view('siswa.biodata', $data);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // 1. Cek batasan (rate limiting)
        $changesCount = $user->passwordHistories()
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        if ($changesCount >= 2) {
            return back()->with('error', 'Anda telah mencapai batas maksimal pergantian kata sandi (2 kali) dalam 30 hari terakhir. Silakan coba lagi bulan depan atau hubungi admin.');
        }

        // 2. Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // 3. Verifikasi password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Kata sandi saat ini tidak cocok.');
        }

        // 4. Update password
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        // 5. Rekam histori
        PasswordChangeHistory::create([
            'pengguna_id' => $user->id
        ]);

        return back()->with('success', 'Kata sandi berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $isUpdate = (bool)$user->student_id;

        $request->validate([
            'nis' => 'required|string|unique:siswa,nis,' . ($user->student_id ?? 'NULL'),
            'gender' => 'required|in:Laki-laki,Perempuan',
            'date_of_birth' => 'required|date',
            'entry_year' => 'required|integer',
            'address' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            
            // Logika Status yang Aman: 
            // Jika siswa sudah ada, ikuti status yang sudah ada (mencegah aktivasi mandiri).
            // Jika siswa baru (pendaftaran pertama), status adalah 'inactive'.
            $status = $user->student ? $user->student->status : 'inactive';

            // Create or Update Student
            $student = Siswa::updateOrCreate(
                ['id' => $user->student_id],
                [
                    'nis' => $request->nis,
                    'name' => $user->name,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'entry_year' => $request->entry_year,
                    'address' => $request->address,
                    'status' => $status, 
                ]
            );


            // Update User linkage if new
            if (!$isUpdate) {
                $user->update(['student_id' => $student->id]);
            }

            DB::commit();

            $message = $isUpdate 
                ? 'Data berhasil diperbarui. Selamat belajar di kelas baru!' 
                : 'Biodata berhasil disimpan. Silakan tunggu admin untuk memberikan persetujuan (ACC).';

            return redirect()->route('dashboard')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
