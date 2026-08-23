<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Akses khusus Administrator.');
        }

        $selectedYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');
        $selectedStartYear = (int) explode('/', $selectedYear)[0];

        $courses = MataPelajaran::all()->filter(function($course) use ($selectedStartYear) {
            if (!$course->entry_academic_year) return true;
            $courseStartYear = (int) explode('/', $course->entry_academic_year)[0];
            return $courseStartYear <= $selectedStartYear;
        });

        return view('mata_pelajaran.index', compact('courses'));
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Akses khusus Administrator.');
        }

        return view('mata_pelajaran.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Akses khusus Administrator.');
        }

        $request->validate([
            'code' => 'required|unique:mata_pelajaran,kode',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'grade_level' => 'required|in:X,XI,XII',
            'status' => 'required|in:active,inactive',
            'beban_jp' => 'required|integer|min:1|max:10',
        ], [
            'code.required' => 'Kode mata pelajaran wajib diisi.',
            'code.unique' => 'Kode mata pelajaran sudah digunakan.',
            'name.required' => 'Nama mata pelajaran wajib diisi.',
            'grade_level.required' => 'Tingkat kelas wajib dipilih.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $activeYear = \App\Models\Pengaturan::getValue('tahun_ajaran_aktif', '2025/2026');

        $data = $request->all();
        $data['entry_academic_year'] = $activeYear;

        MataPelajaran::create($data);

        return redirect()->route('courses.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function show(MataPelajaran $course)
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Akses khusus Administrator.');
        }

        $course->loadCount('subjects');
        return view('mata_pelajaran.show', compact('course'));
    }

    public function edit(MataPelajaran $course)
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Akses khusus Administrator.');
        }

        return view('mata_pelajaran.edit', compact('course'));
    }

    public function update(Request $request, MataPelajaran $course)
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Akses khusus Administrator.');
        }

        $request->validate([
            'code' => 'required|unique:mata_pelajaran,kode,' . $course->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'grade_level' => 'required|in:X,XI,XII',
            'status' => 'required|in:active,inactive',
            'beban_jp' => 'required|integer|min:1|max:10',
        ], [
            'code.required' => 'Kode mata pelajaran wajib diisi.',
            'code.unique' => 'Kode mata pelajaran sudah digunakan.',
            'name.required' => 'Nama mata pelajaran wajib diisi.',
            'grade_level.required' => 'Tingkat kelas wajib dipilih.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy(MataPelajaran $course)
    {
        $user = auth()->user();
        if (!$user || !$user->isSuperAdmin()) {
            abort(403, 'Akses khusus Administrator.');
        }

        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
