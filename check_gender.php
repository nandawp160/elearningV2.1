<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$genders = \App\Models\Siswa::groupBy('jenis_kelamin')->select('jenis_kelamin', \DB::raw('count(*) as total'))->get()->toArray();
print_r($genders);
