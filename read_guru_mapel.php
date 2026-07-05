<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileType = IOFactory::identify('md/data_rill/DAFTAR GURU MAPEL.xlsx');
$reader = IOFactory::createReader($inputFileType);
$spreadsheet = $reader->load('md/data_rill/DAFTAR GURU MAPEL.xlsx');

$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

echo json_encode(array_slice($sheetData, 0, 15));
exit;
