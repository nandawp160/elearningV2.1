<?php

require 'c:\\laragon\\www\\sistem-e_learningV1\\vendor\\autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$excelPath = 'c:\\laragon\\www\\sistem-e_learningV1\\md\\data\\siswa\\Dataset_Siswa_SMA_Plotting_Otomatis.xlsx';

if (!file_exists($excelPath)) {
    die("Error: Excel file not found at $excelPath\n");
}

$spreadsheet = IOFactory::load($excelPath);
$allNisn = [];
$duplicates = [];

foreach ($spreadsheet->getSheetNames() as $sheetName) {
    $sheet = $spreadsheet->getSheetByName($sheetName);
    $rows = $sheet->toArray();
    
    foreach ($rows as $idx => $row) {
        if ($idx < 4) continue; // Skip headers
        if (empty($row[0]) || !is_numeric(trim($row[0]))) continue;
        
        $nisn = trim($row[1]);
        $name = trim($row[2]);
        
        if (isset($allNisn[$nisn])) {
            $duplicates[] = [
                'nisn' => $nisn,
                'name' => $name,
                'sheet' => $sheetName,
                'first_seen' => $allNisn[$nisn]
            ];
        } else {
            $allNisn[$nisn] = [
                'name' => $name,
                'sheet' => $sheetName
            ];
        }
    }
}

echo "=== Excel Duplicates Check ===\n";
echo "Total parsed student rows in Excel: " . count($allNisn) + count($duplicates) . "\n";
echo "Unique NISNs: " . count($allNisn) . "\n";
echo "Duplicate entries found: " . count($duplicates) . "\n\n";

foreach ($duplicates as $d) {
    echo "Duplicate NISN: {$d['nisn']} - Name: {$d['name']} (Sheet: {$d['sheet']}) \n";
    echo " -> First seen as: {$d['first_seen']['name']} (Sheet: {$d['first_seen']['sheet']})\n\n";
}
