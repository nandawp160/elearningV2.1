<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $teacher = \App\Models\Teacher::where('email', 'sari.wahyuni@sekolah.sch.id')->first();
    if (!$teacher) {
        die("Teacher NOT FOUND\n");
    }

    echo "Teacher found: " . $teacher->name . "\n";

    $user = \App\Models\User::updateOrCreate(
        ['email' => $teacher->email],
        [
            'name' => $teacher->name,
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'teacher',
            'teacher_id' => $teacher->id,
        ]
    );
    echo "User created: " . $user->email . "\n";

    $class = \App\Models\Kelas::where('name', 'X IPA 1')->first();
    if (!$class) {
        $class = \App\Models\Kelas::first();
    }
    
    if ($class) {
        $class->update(['homeroom_teacher_id' => $teacher->id]);
        echo "Assigned as Wali Kelas for: " . $class->name . "\n";
    }

    echo "DONE\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
