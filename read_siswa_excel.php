<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('md/data_rill/DAFTAR PESERTA DIDIK.xls');
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();

print_r(array_slice($rows, 0, 10)); // Print first 10 rows
