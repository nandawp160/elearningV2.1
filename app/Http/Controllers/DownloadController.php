<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class DownloadController extends Controller
{
    /**
     * Download material file
     */
    public function material(\App\Models\Materi $material)
    {
        Gate::authorize('view_tugas');
        
        $user = auth()->user();
        
        // Student class validation
        if ($user->isStudent()) {
            $student = $user->student;
            $kelasName = $student?->kelas;
            $allowed = false;
            if ($kelasName) {
                $tingkat = explode(' ', $kelasName)[0]; // e.g., 'X' from 'X IPA 1'
                $kelas = \App\Models\Kelas::where('name', $kelasName)->first();
                if ($kelas) {
                    $teacherIds = $kelas->guruPengampu()->pluck('guru.id')->toArray();
                    $allowed = in_array($material->uploaded_by, $teacherIds);
                    
                    if ($allowed && $material->subject) {
                        $allowed = ($material->subject->tingkat === $tingkat);
                    }
                }
            }
            if (!$allowed) {
                abort(403, 'Anda tidak memiliki akses ke materi ini (Beda Kelas/Tingkat).');
            }
        }
        
        return $this->downloadFile($material->file_path);
    }

    /**
     * Preview material file
     */
    public function previewMaterial(\App\Models\Materi $material)
    {
        Gate::authorize('view_tugas');
        
        $user = auth()->user();
        
        // Student class validation
        if ($user->isStudent()) {
            $student = $user->student;
            $kelasName = $student?->kelas;
            $allowed = false;
            if ($kelasName) {
                $tingkat = explode(' ', $kelasName)[0]; // e.g., 'X' from 'X IPA 1'
                $kelas = \App\Models\Kelas::where('name', $kelasName)->first();
                if ($kelas) {
                    $teacherIds = $kelas->guruPengampu()->pluck('guru.id')->toArray();
                    $allowed = in_array($material->uploaded_by, $teacherIds);
                    
                    if ($allowed && $material->subject) {
                        $allowed = ($material->subject->tingkat === $tingkat);
                    }
                }
            }
            if (!$allowed) {
                abort(403, 'Anda tidak memiliki akses ke materi ini (Beda Kelas/Tingkat).');
            }
        }
        
        return $this->serveFile($material->file_path);
    }

    /**
     * Download assignment attachment
     */
    public function assignment(\App\Models\Tugas $assignment)
    {
        Gate::authorize('view_tugas');
        return $this->downloadFile($assignment->attachment);
    }

    /**
     * Download student submission
     */
    public function submission(\App\Models\Pengumpulan $submission)
    {
        $user = auth()->user();
        $assignment = $submission->assignment;
        
        $isOwner = $user->isStudent() && $user->student_id === $submission->siswa_id;
        $isTeacher = $user->isTeacher() && $assignment->guru_id == $user->teacher_id;
        
        if (!$isOwner && !$isTeacher && !$user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki akses ke file pengumpulan ini.');
        }
        
        return $this->downloadFile($submission->file_tugas, $submission->original_name);
    }

    /**
     * Download appeal evidence
     */
    public function appeal(\App\Models\Banding $appeal)
    {
        $user = auth()->user();
        
        $isOwner = $user->isStudent() && $user->student_id === $appeal->siswa_id;
        $isTeacher = $user->isTeacher(); // Teacher can view appeal evidence if they are assigned
        $isAdmin = $user->isSuperAdmin();
        
        if (!$isOwner && !$isTeacher && !$isAdmin) {
            abort(403, 'Anda tidak memiliki akses ke bukti banding ini.');
        }
        
        return $this->downloadFile($appeal->bukti_pendukung);
    }

    /**
     * Helper to download file from either local or public disk
     */
    private function downloadFile($path, $filename = null)
    {
        if (!$path) {
            abort(404, 'File tidak ditemukan.');
        }

        // Check in public disk first (legacy files)
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path, $filename);
        }
        
        // Check in local disk (new private files)
        if (Storage::disk('local')->exists($path)) {
            return Storage::disk('local')->download($path, $filename);
        }

        abort(404, 'File tidak ditemukan di server.');
    }

    /**
     * Helper to serve file inline from either local or public disk
     */
    private function serveFile($path)
    {
        if (!$path) {
            abort(404, 'File tidak ditemukan.');
        }

        // Check in public disk first (legacy files)
        if (Storage::disk('public')->exists($path)) {
            return response()->file(Storage::disk('public')->path($path));
        }
        
        // Check in local disk (new private files)
        if (Storage::disk('local')->exists($path)) {
            return response()->file(Storage::disk('local')->path($path));
        }

        abort(404, 'File tidak ditemukan di server.');
    }
}
