<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = \App\Models\User::where('email', 'sari.wahyuni@sekolah.sch.id')->first();
if (!$u) die("User not found");

$teacherId = $u->teacher_id;
echo "User: " . $u->name . " (Teacher ID: " . $teacherId . ")\n";

$class = \App\Models\Kelas::where('homeroom_teacher_id', $teacherId)->first();
if ($class) {
    echo "Class Found: " . $class->name . "\n";
    echo "Total Students: " . $class->students()->count() . "\n";
    echo "Subjects: " . $class->subjects()->count() . "\n";
} else {
    echo "NO CLASS FOUND for this teacher ID.\n";
    
    // Let's see what classes exist
    $allClasses = \App\Models\Kelas::all();
    echo "Total Classes in DB: " . $allClasses->count() . "\n";
    foreach ($allClasses as $c) {
        echo "- " . $c->name . " (Homeroom ID: " . $c->homeroom_teacher_id . ")\n";
    }
}
