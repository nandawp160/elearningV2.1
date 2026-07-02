<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\JadwalPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view_tugas');

        $user = auth()->user();
        $query = Materi::with(['subject', 'uploader']);

        if ($user->isTeacher()) {
            $query->where('uploaded_by', $user->teacher_id);
        } elseif ($user->isStudent()) {
            $student = $user->student;
            $kelasName = $student?->kelas;
            $tingkat = 'X';
            if ($kelasName) {
                $tingkat = explode(' ', $kelasName)[0];
                
                // Filter by teachers assigned to student's class
                $kelas = \App\Models\Kelas::where('name', $kelasName)->first();
                if ($kelas) {
                    $teacherIds = $kelas->guruPengampu()->pluck('guru.id')->toArray();
                    $query->whereIn('uploaded_by', $teacherIds);
                }
            }
            $query->whereHas('subject', function ($q) use ($tingkat) {
                $q->where('tingkat', $tingkat);
            });
        }

        if ($request->has('subject_id') && $request->subject_id) {
            $query->where('subject_id', $request->subject_id);
        }

        $materials = $query->latest()->get();

        if ($user->isTeacher()) {
            $guru = $user->guru;
            $subjects = collect();
            if ($guru) {
                foreach ($guru->kelasDiampu as $kelas) {
                    $resolvedSubject = $guru->getSubjectForClass($kelas);
                    if ($resolvedSubject) {
                        $cloned = clone $resolvedSubject;
                        $kelas->student_count = \App\Models\Siswa::where('kelas', $kelas->name)->where('status', 'aktif')->count();
                        $cloned->setRelation('classRoom', $kelas);
                        $subjects->push($cloned);
                    }
                }
                $subjects = $subjects->sortBy(function($s) {
                    $name = $s->classRoom->name ?? '';
                    $name = preg_replace('/\bXII\b/', '12', $name);
                    $name = preg_replace('/\bXI\b/', '11', $name);
                    $name = preg_replace('/\bX\b/', '10', $name);
                    $name = preg_replace('/\bIX\b/', '09', $name);
                    $name = preg_replace('/\bVIII\b/', '08', $name);
                    $name = preg_replace('/\bVII\b/', '07', $name);
                    return $name;
                }, SORT_NATURAL)->values();
            }
        } else {
            $subjectsQuery = JadwalPelajaran::with(['classRoom']);
            if ($user->isStudent()) {
                $student = $user->student;
                $kelas = $student->kelas;
                $tingkat = 'X';
                if ($kelas) {
                    $tingkat = explode(' ', $kelas)[0];
                }
                $subjectsQuery->where('tingkat', $tingkat);
            }
            $subjects = $subjectsQuery->get();
        }

        $completedMaterialIds = [];
        if ($user->isStudent() && $user->student) {
            $completedMaterialIds = \App\Models\PelacakanMateri::where('siswa_id', $user->student->id)->pluck('materi_id')->toArray();
        }

        return view('materi.index', compact('materials', 'subjects', 'completedMaterialIds'));
    }


    public function create(Request $request)
    {
        Gate::authorize('create_tugas');

        $user = auth()->user();
        if ($user->isStudent()) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($user->isTeacher()) {
            $guru = $user->guru;
            $subjects = collect();
            if ($guru) {
                foreach ($guru->kelasDiampu as $kelas) {
                    $resolvedSubject = $guru->getSubjectForClass($kelas);
                    if ($resolvedSubject) {
                        $cloned = clone $resolvedSubject;
                        $cloned->setRelation('classRoom', $kelas);
                        $subjects->push($cloned);
                    }
                }
            }
        } else {
            $subjects = JadwalPelajaran::with(['classRoom'])->get();
        }
        $teachers = $user->isSuperAdmin() ? Guru::orderBy('name')->get() : collect();

        return view('materi.create', compact('subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        if (\App\Models\Pengaturan::getValue('storage_frozen', '0') === '1') {
            return redirect()->back()->with('error', 'Sistem terkunci (Read-Only). Anda tidak dapat menambah materi baru saat ini.');
        }

        Gate::authorize('create_tugas');

        $user = auth()->user();
        if ($user->isStudent()) {
            abort(403, 'Unauthorized action.');
        }

        $type = $request->input('type', 'pdf');

        $rules = [
            'subject_id' => 'required|exists:mata_pelajaran,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'uploaded_by' => $user->isSuperAdmin() ? 'required|exists:guru,id' : 'nullable',
            'type' => 'required|in:pdf,docx,pptx,video,link',
        ];

        if ($type === 'link') {
            $rules['link_url'] = 'required|url|max:2048';
            $rules['file'] = 'nullable';
        } else {
            if ($type === 'pdf') {
                $rules['file'] = 'required|file|max:10240|mimes:pdf';
            } elseif ($type === 'docx') {
                $rules['file'] = 'required|file|max:10240|mimes:doc,docx';
            } elseif ($type === 'pptx') {
                $rules['file'] = 'required|file|max:10240|mimes:ppt,pptx';
            } elseif ($type === 'video') {
                $rules['file'] = 'required|file|max:10240|mimes:mp4,mov,avi,mkv,webm';
            }
            $rules['link_url'] = 'nullable';
        }

        $request->validate($rules);

        $data = [
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $type,
            'file_path' => null,
            'url' => null,
            'uploaded_by' => $user->isTeacher() ? $user->teacher_id : $request->input('uploaded_by', 1)
        ];

        if ($type === 'link') {
            $data['url'] = $request->input('link_url');
        } elseif ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('materi');
        }

        Materi::create($data);

        \App\Models\ActivityLog::log('ASSIGNMENT', 'Membuat materi baru: ' . $request->title);

        return redirect()->route('materials.index', ['subject_id' => $request->subject_id])
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show($id)
    {
        Gate::authorize('view_tugas');

        $material = Materi::with(['subject', 'uploader'])->findOrFail($id);
        $user = auth()->user();

        // Validasi: Siswa hanya boleh akses materi dari guru pengampu kelasnya
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
                    
                    // Juga pastikan materi ini ditujukan untuk tingkat kelas siswa (X/XI/XII)
                    if ($allowed && $material->subject) {
                        $allowed = ($material->subject->tingkat === $tingkat);
                    }
                }
            }
            if (!$allowed) {
                abort(403, 'Anda tidak memiliki akses ke materi ini (Beda Kelas/Tingkat).');
            }
        }

        $isCompleted = false;
        if ($user->isStudent() && $user->student) {
            $isCompleted = \App\Models\PelacakanMateri::where('siswa_id', $user->student->id)
                ->where('materi_id', $material->id)
                ->exists();
        }

        return view('materi.show', compact('material', 'isCompleted'));
    }

    public function edit($id)
    {
        Gate::authorize('edit_tugas');

        $user = auth()->user();
        if ($user->isStudent()) {
            abort(403, 'Unauthorized action.');
        }
        
        $material = Materi::findOrFail($id);
        if ($user->isTeacher() && $material->uploaded_by !== $user->teacher_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit materi ini.');
        }
        if ($user->isTeacher()) {
            $guru = $user->guru;
            $subjects = collect();
            if ($guru) {
                foreach ($guru->kelasDiampu as $kelas) {
                    $resolvedSubject = $guru->getSubjectForClass($kelas);
                    if ($resolvedSubject) {
                        $cloned = clone $resolvedSubject;
                        $cloned->setRelation('classRoom', $kelas);
                        $subjects->push($cloned);
                    }
                }
            }
        } else {
            $subjects = JadwalPelajaran::with(['classRoom'])->get();
        }
        $teachers = $user->isSuperAdmin() ? Guru::orderBy('name')->get() : collect();

        return view('materi.edit', compact('material', 'subjects', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        if (\App\Models\Pengaturan::getValue('storage_frozen', '0') === '1') {
            return redirect()->back()->with('error', 'Sistem terkunci (Read-Only). Anda tidak dapat mengubah materi saat ini.');
        }

        Gate::authorize('edit_tugas');

        $user = auth()->user();
        if ($user->isStudent()) {
            abort(403, 'Unauthorized action.');
        }

        $material = Materi::findOrFail($id);
        if ($user->isTeacher() && $material->uploaded_by !== $user->teacher_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit materi ini.');
        }
        $type = $request->input('type');
        if (!$type) {
            $type = $material->type;
            if ($type === 'document') {
                $type = 'pdf';
            }
        }

        $hasExistingFile = $material->file_path && !filter_var($material->file_path, FILTER_VALIDATE_URL) && !str_starts_with($material->file_path, 'http://') && !str_starts_with($material->file_path, 'https://');
        
        $fileRequirement = 'nullable';
        if ($type !== 'link') {
            if (!$hasExistingFile) {
                $fileRequirement = 'required';
            } else {
                // Check if existing file's extension matches the chosen type
                $extension = strtolower(pathinfo($material->file_path, PATHINFO_EXTENSION));
                $matches = false;
                if ($type === 'pdf' && $extension === 'pdf') $matches = true;
                elseif ($type === 'docx' && in_array($extension, ['doc', 'docx'])) $matches = true;
                elseif ($type === 'pptx' && in_array($extension, ['ppt', 'pptx'])) $matches = true;
                elseif ($type === 'video' && in_array($extension, ['mp4', 'mov', 'avi', 'mkv', 'webm'])) $matches = true;
                
                if (!$matches) {
                    $fileRequirement = 'required';
                }
            }
        }

        $rules = [
            'subject_id' => 'required|exists:mata_pelajaran,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'uploaded_by' => $user->isSuperAdmin() ? 'required|exists:guru,id' : 'nullable',
            'type' => 'required|in:pdf,docx,pptx,video,link',
        ];

        if ($type === 'link') {
            $rules['link_url'] = 'required|url|max:2048';
            $rules['file'] = 'nullable';
        } else {
            if ($type === 'pdf') {
                $rules['file'] = "{$fileRequirement}|file|max:10240|mimes:pdf";
            } elseif ($type === 'docx') {
                $rules['file'] = "{$fileRequirement}|file|max:10240|mimes:doc,docx";
            } elseif ($type === 'pptx') {
                $rules['file'] = "{$fileRequirement}|file|max:10240|mimes:ppt,pptx";
            } elseif ($type === 'video') {
                $rules['file'] = "{$fileRequirement}|file|max:10240|mimes:mp4,mov,avi,mkv,webm";
            }
            $rules['link_url'] = 'nullable';
        }

        $request->validate($rules);

        $data = [
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $type,
        ];

        if ($type === 'link') {
            // Delete old file if it was a stored file
            if ($material->file_path && !filter_var($material->file_path, FILTER_VALIDATE_URL) && !str_starts_with($material->file_path, 'http://') && !str_starts_with($material->file_path, 'https://')) {
                Storage::disk('public')->delete($material->file_path);
            }
            $data['url'] = $request->input('link_url');
            $data['file_path'] = null;
        } elseif ($request->hasFile('file')) {
            // Delete old file if it was a stored file
            if ($material->file_path && !filter_var($material->file_path, FILTER_VALIDATE_URL) && !str_starts_with($material->file_path, 'http://') && !str_starts_with($material->file_path, 'https://')) {
                Storage::disk('public')->delete($material->file_path);
            }
            $data['file_path'] = $request->file('file')->store('materi');
            $data['url'] = null;
        }

        if ($user->isSuperAdmin()) {
            $data['uploaded_by'] = $request->input('uploaded_by');
        }

        $material->update($data);

        \App\Models\ActivityLog::log('ASSIGNMENT', 'Memperbarui materi: ' . $material->title);

        return redirect()->route('materials.index', ['subject_id' => $material->subject_id])
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Gate::authorize('delete_tugas');

        $user = auth()->user();
        if ($user->isStudent()) {
            abort(403, 'Unauthorized action.');
        }

        $material = Materi::findOrFail($id);
        if ($user->isTeacher() && $material->uploaded_by !== $user->teacher_id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus materi ini.');
        }
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }

        $subjectId = $material->subject_id;
        $title = $material->title;

        $material->delete();

        \App\Models\ActivityLog::log('DELETION', 'Menghapus materi: ' . $title);

        return redirect()->route('materials.index', ['subject_id' => $subjectId])
            ->with('success', 'Materi berhasil dihapus.');
    }

    public function complete($id)
    {
        $user = auth()->user();
        if (!$user->isStudent()) {
            return redirect()->back()->with('error', 'Hanya siswa yang dapat menandai materi selesai.');
        }

        $student = $user->student;
        if (!$student) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $material = Materi::findOrFail($id);

        $exists = \App\Models\PelacakanMateri::where('siswa_id', $student->id)
            ->where('materi_id', $material->id)
            ->exists();

        if (!$exists) {
            \App\Models\PelacakanMateri::create([
                'siswa_id' => $student->id,
                'materi_id' => $material->id,
                'tanggal_selesai' => now(),
            ]);
            \App\Models\ActivityLog::log('STUDENT_ACTIVITY', 'Menandai materi selesai: ' . $material->title);
        }

        return redirect()->back()->with('success', 'Materi berhasil ditandai selesai.');
    }

    public function incomplete($id)
    {
        $user = auth()->user();
        if (!$user->isStudent()) {
            return redirect()->back()->with('error', 'Hanya siswa yang dapat membatalkan penyelesaian materi.');
        }

        $student = $user->student;
        if (!$student) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $material = Materi::findOrFail($id);

        \App\Models\PelacakanMateri::where('siswa_id', $student->id)
            ->where('materi_id', $material->id)
            ->delete();

        \App\Models\ActivityLog::log('STUDENT_ACTIVITY', 'Membatalkan penyelesaian materi: ' . $material->title);

        return redirect()->back()->with('success', 'Penyelesaian materi berhasil dibatalkan.');
    }
}
