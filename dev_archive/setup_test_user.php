<?php

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\JadwalPelajaran;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$teacher = Guru::where('email', 'sari.wahyuni@sekolah.sch.id')->first();

if (!$teacher) {
    echo "Guru Sari Wahyuni tidak ditemukan.\n";
    exit;
}

echo "Guru dtemukan: " . $teacher->name . " (ID: " . $teacher->id . ")\n";

// 1. Setup User Account
$user = User::updateOrCreate(
    ['email' => $teacher->email],
    [
        'name' => $teacher->name,
        'password' => Hash::make('password123'),
        'role' => 'teacher',
        'teacher_id' => $teacher->id,
    ]
);

echo "User akun siap: " . $user->email . " / password123\n";

// 2. Setup as Wali Kelas (Ensure she is assigned to a class)
$class = Kelas::first(); // Let's take the first class available
if ($class) {
    $class->update(['homeroom_teacher_id' => $teacher->id]);
    echo "Ditugaskan sebagai Wali Kelas: " . $class->name . "\n";
} else {
    $class = Kelas::create([
        'name' => 'X IPA 1',
        'grade_level' => '10',
        'major' => 'IPA',
        'homeroom_teacher_id' => $teacher->id,
        'academic_year' => '2025/2026',
        'max_students' => 36
    ]);
    echo "Kelas baru dibuat & ditugaskan sebagai Wali Kelas: " . $class->name . "\n";
}

// 3. Setup as Guru Pengajar (Ensure she has a subject to teach)
$course = MataPelajaran::where('name', 'LIKE', '%Bahasa Inggris%')->first();
if (!$course) {
    $course = MataPelajaran::create(['name' => 'Bahasa Inggris', 'code' => 'ING-10']);
}

JadwalPelajaran::updateOrCreate(
    [
        'course_id' => $course->id,
        'teacher_id' => $teacher->id,
        'class_room_id' => $class->id,
    ],
    [
        'day' => 'Senin',
        'start_time' => '08:00',
        'end_time' => '09:30',
        'academic_year' => '2025/2026',
        'semester' => 'Ganjil'
    ]
);

echo "Ditugaskan mengajar: " . $course->name . " di kelas " . $class->name . "\n";
echo "\nKONFIGURASI SELESAI. Silakan login dengan:\n";
echo "Email: " . $user->email . "\n";
echo "Password: password123\n";
