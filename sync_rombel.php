<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Support\Facades\DB;

try {
    DB::beginTransaction();

    $inputFileType = IOFactory::identify('md/data_rill/ROMBEL.xlsx');
    $reader = IOFactory::createReader($inputFileType);
    $spreadsheet = $reader->load('md/data_rill/ROMBEL.xlsx');
    
    $sheet = $spreadsheet->getSheetByName('Rombongan Belajar')->toArray(null, true, true, true);
    
    $classesUpdated = 0;
    
    foreach ($sheet as $rowIndex => $row) {
        if ($rowIndex < 8) continue; // Skip headers
        
        $namaRombel = $row['B']; // e.g. "X 1"
        $tingkatKelas = $row['C']; // "10", "11", "12"
        $waliKelasName = $row['G']; // e.g. "Susilawati"
        
        if (empty($namaRombel)) continue;
        
        // Map grade level
        $gradeLevel = 'X';
        if ($tingkatKelas == '11') $gradeLevel = 'XI';
        if ($tingkatKelas == '12') $gradeLevel = 'XII';
        
        // Find existing class by normalizing names (remove dots and spaces for comparison)
        $normalizedExcelName = strtolower(str_replace(['.', ' '], '', $namaRombel));
        
        $kelas = Kelas::get()->first(function($k) use ($normalizedExcelName) {
            $normalizedDbName = strtolower(str_replace(['.', ' '], '', $k->name));
            // Edge case: XII F.4 vs XII F 4
            return $normalizedDbName === $normalizedExcelName;
        });
        
        if (!$kelas) {
            // Create if not exists
            $kelas = new Kelas();
        }
        
        $kelas->name = $namaRombel;
        $kelas->grade_level = $gradeLevel;
        
        // Find Wali Kelas
        if (!empty($waliKelasName)) {
            // Find guru by name (exact or like)
            $guru = Guru::where('nama', 'LIKE', '%' . trim($waliKelasName) . '%')->first();
            if ($guru) {
                $kelas->homeroom_teacher_id = $guru->id;
            }
        }
        
        $kelas->save();
        $classesUpdated++;
    }

    DB::commit();
    echo "Success: Updated $classesUpdated classes and homeroom teachers.\n";
} catch (\Exception $e) {
    DB::rollBack();
    echo "Error: " . $e->getMessage() . "\n";
}
