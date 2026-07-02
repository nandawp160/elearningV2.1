<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function landing()
    {
        $totalStudents = \Illuminate\Support\Facades\Cache::remember('total_students', 60, function () {
            return \App\Models\Siswa::count();
        });

        $totalTeachers = \Illuminate\Support\Facades\Cache::remember('total_teachers', 60, function () {
            return \App\Models\Guru::count();
        });

        return view('super_admin.landing', compact('totalStudents', 'totalTeachers'));
    }
}
