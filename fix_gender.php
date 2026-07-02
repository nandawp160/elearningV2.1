<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$students = \App\Models\Siswa::all();
$lakilaki = 0;
$perempuan = 0;

foreach ($students as $student) {
    if (empty($student->jenis_kelamin)) {
        // Randomly assign Laki-laki or Perempuan
        $gender = rand(0, 1) ? 'Laki-laki' : 'Perempuan';
        $student->jenis_kelamin = $gender;
        $student->save();
        if ($gender == 'Laki-laki') $lakilaki++;
        else $perempuan++;
    }
}

echo "Assigned Laki-laki: $lakilaki\n";
echo "Assigned Perempuan: $perempuan\n";
