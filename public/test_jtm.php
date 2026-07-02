<?php
require __DIR__.'/../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$file = __DIR__.'/../md/data_rill/DAFTAR GURU MAPEL.xlsx';
$spreadsheet = IOFactory::load($file);
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();

echo "HEADERS:\n";
foreach($rows as $i => $row) {
    if ($i >= 3 && $i <= 6) { // rows 4, 5, 6, 7 (0-indexed)
        echo "Row " . ($i + 1) . ":\n";
        foreach ($row as $j => $col) {
            if ($col !== null && $col !== '') {
                echo "  Col $j: $col\n";
            }
        }
    }
}
