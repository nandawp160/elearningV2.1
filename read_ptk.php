<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileType = IOFactory::identify('md/data_rill/ROMBEL.xlsx');
$reader = IOFactory::createReader($inputFileType);
$spreadsheet = $reader->load('md/data_rill/ROMBEL.xlsx');

$sheetData = $spreadsheet->getSheetByName('PTK')->toArray(null, true, true, true);

echo json_encode(array_slice($sheetData, 0, 15));
exit;
