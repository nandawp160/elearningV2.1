<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiswaBiodataController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $student = $user->student;

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
            'isUpdate' => (bool)$student
        ];

        return view('siswa.biodata', $data);
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
            'class_room_id' => 'required|exists:kelas,id',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'parent_email' => 'nullable|email|max:255',
            'address' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $classroom = Kelas::withoutGlobalScopes()->findOrFail($request->class_room_id);
            
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
                    'class' => $classroom->name, 
                    'parent_name' => $request->parent_name,
                    'parent_phone' => $request->parent_phone,
                    'parent_email' => $request->parent_email,
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
