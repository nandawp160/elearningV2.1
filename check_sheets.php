<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileType = IOFactory::identify('md/data_rill/ROMBEL.xlsx');
$reader = IOFactory::createReader($inputFileType);
$spreadsheet = $reader->load('md/data_rill/ROMBEL.xlsx');

$sheetNames = $spreadsheet->getSheetNames();
echo json_encode($sheetNames);
exit;
