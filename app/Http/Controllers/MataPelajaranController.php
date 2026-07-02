<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $courses = MataPelajaran::all();
        return view('mata_pelajaran.index', compact('courses'));
    }

    public function create()
    {
        return view('mata_pelajaran.create');
    }

    public function store(Request $request)
    {
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

        MataPelajaran::create($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function show(MataPelajaran $course)
    {
        $course->loadCount('subjects');
        return view('mata_pelajaran.show', compact('course'));
    }

    public function edit(MataPelajaran $course)
    {
        return view('mata_pelajaran.edit', compact('course'));
    }

    public function update(Request $request, MataPelajaran $course)
    {
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
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
