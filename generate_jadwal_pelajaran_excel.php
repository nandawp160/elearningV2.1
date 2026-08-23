<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\GuruKelas;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Font;

echo "=== STARTING JADWAL EXCEL GENERATOR ===\n";

// 18 Weekly Blocks definition:
// Senin (4 blocks): B0 (Jam 1-2), B1 (Jam 3-4), B2 (Jam 5-6), B3 (Jam 7-8)
// Selasa (4 blocks): B4 (Jam 1-2), B5 (Jam 3-4), B6 (Jam 5-6), B7 (Jam 7-8)
// Rabu (4 blocks): B8 (Jam 1-2), B9 (Jam 3-4), B10 (Jam 5-6), B11 (Jam 7-8)
// Kamis (4 blocks): B12 (Jam 1-2), B13 (Jam 3-4), B14 (Jam 5-6), B15 (Jam 7-8)
// Jumat (2 blocks): B16 (Jam 1-2), B17 (Jam 3-5 / 3 JP)

$blockDefs = [
    0  => ['day' => 'Senin',  'period_str' => 'Jam 1 - 2', 'time_str' => '07.45 - 09.15', 'jp_capacity' => 2],
    1  => ['day' => 'Senin',  'period_str' => 'Jam 3 - 4', 'time_str' => '09.15 - 11.05', 'jp_capacity' => 2],
    2  => ['day' => 'Senin',  'period_str' => 'Jam 5 - 6', 'time_str' => '11.05 - 13.15', 'jp_capacity' => 2],
    3  => ['day' => 'Senin',  'period_str' => 'Jam 7 - 8', 'time_str' => '13.15 - 14.45', 'jp_capacity' => 2],

    4  => ['day' => 'Selasa', 'period_str' => 'Jam 1 - 2', 'time_str' => '07.15 - 08.45', 'jp_capacity' => 2],
    5  => ['day' => 'Selasa', 'period_str' => 'Jam 3 - 4', 'time_str' => '08.45 - 10.35', 'jp_capacity' => 2],
    6  => ['day' => 'Selasa', 'period_str' => 'Jam 5 - 6', 'time_str' => '10.35 - 12.05', 'jp_capacity' => 2],
    7  => ['day' => 'Selasa', 'period_str' => 'Jam 7 - 8', 'time_str' => '12.45 - 14.15', 'jp_capacity' => 2],

    8  => ['day' => 'Rabu',   'period_str' => 'Jam 1 - 2', 'time_str' => '07.15 - 08.45', 'jp_capacity' => 2],
    9  => ['day' => 'Rabu',   'period_str' => 'Jam 3 - 4', 'time_str' => '08.45 - 10.35', 'jp_capacity' => 2],
    10 => ['day' => 'Rabu',   'period_str' => 'Jam 5 - 6', 'time_str' => '10.35 - 12.05', 'jp_capacity' => 2],
    11 => ['day' => 'Rabu',   'period_str' => 'Jam 7 - 8', 'time_str' => '12.45 - 14.15', 'jp_capacity' => 2],

    12 => ['day' => 'Kamis',  'period_str' => 'Jam 1 - 2', 'time_str' => '07.15 - 08.45', 'jp_capacity' => 2],
    13 => ['day' => 'Kamis',  'period_str' => 'Jam 3 - 4', 'time_str' => '08.45 - 10.35', 'jp_capacity' => 2],
    14 => ['day' => 'Kamis',  'period_str' => 'Jam 5 - 6', 'time_str' => '10.35 - 12.05', 'jp_capacity' => 2],
    15 => ['day' => 'Kamis',  'period_str' => 'Jam 7 - 8', 'time_str' => '12.45 - 14.15', 'jp_capacity' => 2],

    16 => ['day' => 'Jumat',  'period_str' => 'Jam 1 - 2', 'time_str' => '07.45 - 09.05', 'jp_capacity' => 2],
    17 => ['day' => 'Jumat',  'period_str' => 'Jam 3 - 5', 'time_str' => '09.25 - 11.25', 'jp_capacity' => 3],
];

$classes = Kelas::withoutGlobalScopes()->where('academic_year', '2026/2027')->get()->keyBy('name');
$plottings = GuruKelas::whereIn('kelas_id', $classes->pluck('id'))->with(['guru', 'subject', 'kelas'])->get();

// Wali kelas mapping from ROMBEL.xlsx
$waliKelas = [
    'X 1' => 'Susilawati, Dra',
    'X 2' => 'Ratna Suryani, S.Pd',
    'X 3' => 'Agung Srihartono, S.Pd',
    'X 4' => 'Murtini Ningsih, S.Si',
    'X 5' => 'Eri Kriswanti, S.Pd',
    'X 6' => 'Khoirul Umam, S.Pd',
    'X 7' => 'Tiyastuti Nur Cahyani, S.Pd',
    'XI F 1' => 'Widodo, S.Pd',
    'XI F 2.1' => 'Endah Wahyuningsih, S.Pd',
    'XI F 2.2' => 'Heru Rismawan, S.Pd',
    'XI F 3.1' => 'Heni Setyarini, S.Pd',
    'XI F 3.2' => 'Puput Rika Harjani, S.Pd',
    'XI F 4.1' => 'Abdul Rouf, S.Pd',
    'XI F 4.2' => 'Sri Widyastuti, S.Pd.I',
    'XII F 1' => 'Umi Farichah, S.Pd, M.Pd',
    'XII F 2.1' => 'Is Imanah, S.Pd, M.Pd',
    'XII F 2.2' => 'Ardjanto, S.Pd',
    'XII F 3.1' => 'Ervhiendri Ali Akhmad, S.Pd',
    'XII F 3.2' => 'Endang Widayanti, S.Sos',
    'XII F 4.1' => 'Sri Kundarti, S.Pd',
    'XII F 4.2' => 'Djoko Heriyanto, S.Pd, M.Pd',
];

// Room mapping
$ruanganKelas = [
    'X 1' => 'Ruang Kelas X.1',
    'X 2' => 'Ruang Kelas X.2',
    'X 3' => 'Ruang Kelas X.3',
    'X 4' => 'Ruang Kelas X.4',
    'X 5' => 'Ruang Kelas X.5',
    'X 6' => 'Ruang Kelas X.6',
    'X 7' => 'Ruang Kelas X.7',
    'XI F 1' => 'Ruang Kelas XI F 1',
    'XI F 2.1' => 'Ruang Kelas XI F 2.1',
    'XI F 2.2' => 'Ruang Kelas XI F 2.2',
    'XI F 3.1' => 'Ruang Kelas XI F 3.1',
    'XI F 3.2' => 'Ruang Kelas XI F 3.2',
    'XI F 4.1' => 'Ruang Kelas XI F 4.1',
    'XI F 4.2' => 'Ruang Kelas XI F 4.2',
    'XII F 1' => 'Ruang Kelas XII F 1',
    'XII F 2.1' => 'Ruang Kelas XII F 2.1',
    'XII F 2.2' => 'Ruang Kelas XII F 2.2',
    'XII F 3.1' => 'Ruang Kelas XII F 3.1',
    'XII F 3.2' => 'Ruang Kelas XII F 3.2',
    'XII F 4.1' => 'Ruang Kelas XII F 4.1',
    'XII F 4.2' => 'Ruang Kelas XII F 4.2',
];

// Prepare Class Blocks
$classBlocks = [];
foreach ($classes as $cName => $cls) {
    $cPlots = $plottings->where('kelas_id', $cls->id);
    $items = [];
    foreach ($cPlots as $p) {
        $jp = $p->subject->beban_jp ?? 2;
        $mName = $p->subject->nama;
        $gName = $p->guru->nama;
        $gId = $p->guru_id;

        if ($jp === 5) {
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 3, 'tag' => 'Peminatan (3 JP)'];
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 2, 'tag' => 'Peminatan (2 JP)'];
        } elseif ($jp === 4) {
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 2, 'tag' => 'Peminatan (2 JP)'];
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 2, 'tag' => 'Peminatan (2 JP)'];
        } elseif ($jp === 3) {
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 3, 'tag' => 'Wajib (3 JP)'];
        } else {
            $items[] = ['mapel' => $mName, 'guru' => $gName, 'guru_id' => $gId, 'jp' => 2, 'tag' => 'Wajib (2 JP)'];
        }
    }
    $classBlocks[$cls->id] = $items;
}

// Conflict-free assignment solver
echo "Solving 18-Block Timetable...\n";
$solved = false;
$finalSchedule = []; // [class_id][block_index] = item

for ($attempt = 1; $attempt <= 500; $attempt++) {
    $grid = []; // [class_id][block_idx] = item
    $teacherGrid = []; // [guru_id][block_idx] = class_name

    foreach ($classes as $cls) {
        $grid[$cls->id] = array_fill(0, 18, null);
    }
    foreach ($plottings->pluck('guru_id')->unique() as $gId) {
        $teacherGrid[$gId] = array_fill(0, 18, null);
    }

    $success = true;
    $orderedClasses = $classes->sortByDesc(fn($c) => count($classBlocks[$c->id]));

    foreach ($orderedClasses as $cls) {
        $items = $classBlocks[$cls->id];
        shuffle($items);
        // Put 3 JP items first into block 17 (Jumat Jam 3-5) or Friday/Thurs
        usort($items, fn($a, $b) => $b['jp'] <=> $a['jp']);

        $subjectAssignedDay = [];

        foreach ($items as $item) {
            $gId = $item['guru_id'];
            $mapel = $item['mapel'];
            $jp = $item['jp'];

            // Find valid blocks
            $validBlocks = [];
            for ($b = 0; $b < 18; $b++) {
                if ($grid[$cls->id][$b] !== null) continue;
                if ($teacherGrid[$gId][$b] !== null) continue;

                // Match 3 JP item to Block 17 (Jumat Jam 3-5) if available
                if ($jp === 3 && $b !== 17 && $grid[$cls->id][17] === null && $teacherGrid[$gId][17] === null) {
                    // strongly prefer 17
                }

                $bDay = $blockDefs[$b]['day'];
                $penalty = isset($subjectAssignedDay[$mapel][$bDay]) ? 100 : 0;
                if ($jp === 3 && $b === 17) $penalty -= 50;

                $validBlocks[] = [
                    'block' => $b,
                    'penalty' => $penalty + rand(0, 30),
                ];
            }

            if (empty($validBlocks)) {
                $success = false;
                break 2;
            }

            usort($validBlocks, fn($a, $b) => $a['penalty'] <=> $b['penalty']);
            $chosenBlock = $validBlocks[0]['block'];

            $grid[$cls->id][$chosenBlock] = $item;
            $teacherGrid[$gId][$chosenBlock] = $cls->name;
            $subjectAssignedDay[$mapel][$blockDefs[$chosenBlock]['day']] = true;
        }
    }

    if ($success) {
        echo "Timetable solved on attempt #{$attempt}!\n";
        $finalSchedule = $grid;
        $solved = true;
        break;
    }
}

if (!$solved) {
    die("Could not solve timetable.\n");
}

echo "Generating Rich Excel Workbook...\n";

$spreadsheet = new Spreadsheet();
$spreadsheet->removeSheetByIndex(0); // remove default sheet

// Color Palette
$cNavy = '1E3A8A';
$cBlueHeader = '2563EB';
$cLightBlue = 'EFF6FF';
$cBorder = 'CBD5E1';
$cDarkText = '1E293B';
$cWhite = 'FFFFFF';
$cGrayBg = 'F8FAFC';
$cEmerald = '059669';
$cAmber = 'D97706';

// Style presets
$headerStyle = [
    'font' => ['bold' => true, 'color' => ['argb' => $cWhite], 'size' => 11, 'name' => 'Calibri'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => $cNavy]],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => $cBorder]]],
];

$subHeaderStyle = [
    'font' => ['bold' => true, 'color' => ['argb' => $cWhite], 'size' => 10, 'name' => 'Calibri'],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => $cBlueHeader]],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => $cBorder]]],
];

$cellStyle = [
    'font' => ['size' => 9, 'name' => 'Calibri', 'color' => ['argb' => $cDarkText]],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => $cBorder]]],
];

// =========================================================================
// SHEET 1: JADWAL LENGKAP 21 KELAS (MASTER GRID)
// =========================================================================
$sheetMaster = $spreadsheet->createSheet();
$sheetMaster->setTitle('JADWAL MASTER 21 KELAS');
$sheetMaster->setShowGridLines(true);

// Title
$sheetMaster->mergeCells('A1:T1');
$sheetMaster->setCellValue('A1', 'JADWAL PELAJARAN SMA NEGERI 1 CEPOGO');
$sheetMaster->getStyle('A1')->getFont()->setBold(true)->setSize(16)->setColor(new Color($cNavy));
$sheetMaster->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheetMaster->mergeCells('A2:T2');
$sheetMaster->setCellValue('A2', 'TAHUN AJARAN 2026/2027 • 5 HARI KERJA (SENIN - JUMAT)');
$sheetMaster->getStyle('A2')->getFont()->setBold(true)->setSize(11)->setColor(new Color('64748B'));
$sheetMaster->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Row 4: Day Headers
$sheetMaster->setCellValue('A4', 'NO');
$sheetMaster->setCellValue('B4', 'KELAS / ROMBEL');
$sheetMaster->mergeCells('A4:A5');
$sheetMaster->mergeCells('B4:B5');
$sheetMaster->getStyle('A4:B5')->applyFromArray($headerStyle);

// Days columns
$colMap = [
    'Senin'  => ['start' => 'C', 'end' => 'F', 'blocks' => [0, 1, 2, 3]],
    'Selasa' => ['start' => 'G', 'end' => 'J', 'blocks' => [4, 5, 6, 7]],
    'Rabu'   => ['start' => 'K', 'end' => 'N', 'blocks' => [8, 9, 10, 11]],
    'Kamis'  => ['start' => 'O', 'end' => 'R', 'blocks' => [12, 13, 14, 15]],
    'Jumat'  => ['start' => 'S', 'end' => 'T', 'blocks' => [16, 17]],
];

foreach ($colMap as $dayName => $info) {
    $sheetMaster->mergeCells("{$info['start']}4:{$info['end']}4");
    $sheetMaster->setCellValue("{$info['start']}4", strtoupper($dayName));
    $sheetMaster->getStyle("{$info['start']}4:{$info['end']}4")->applyFromArray($headerStyle);
}

// Row 5: Period Subheaders
$colIdx = 3; // C is 3
for ($b = 0; $b < 18; $b++) {
    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
    $bInfo = $blockDefs[$b];
    $sheetMaster->setCellValue("{$colLetter}5", "{$bInfo['period_str']}\n({$bInfo['time_str']})");
    $sheetMaster->getStyle("{$colLetter}5")->applyFromArray($subHeaderStyle);
    $sheetMaster->getColumnDimension($colLetter)->setWidth(22);
    $colIdx++;
}
$sheetMaster->getColumnDimension('A')->setWidth(6);
$sheetMaster->getColumnDimension('B')->setWidth(18);
$sheetMaster->getRowDimension(4)->setRowHeight(25);
$sheetMaster->getRowDimension(5)->setRowHeight(32);

// Populate Classes Rows
$rowNum = 6;
$no = 1;
foreach ($classes as $cName => $cls) {
    $sheetMaster->setCellValue("A{$rowNum}", $no++);
    $sheetMaster->setCellValue("B{$rowNum}", "{$cls->name}\n({$cls->grade_level} {$cls->rumpun})");
    
    $sheetMaster->getStyle("A{$rowNum}")->applyFromArray($cellStyle);
    $sheetMaster->getStyle("B{$rowNum}")->applyFromArray($cellStyle)->getFont()->setBold(true);
    if ($rowNum % 2 === 0) {
        $sheetMaster->getStyle("A{$rowNum}:B{$rowNum}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($cLightBlue);
    }

    $colIdx = 3;
    for ($b = 0; $b < 18; $b++) {
        $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
        $item = $finalSchedule[$cls->id][$b] ?? null;
        if ($item) {
            $sheetMaster->setCellValue("{$colLetter}{$rowNum}", "{$item['mapel']}\n[{$item['guru']}]");
        } else {
            $sheetMaster->setCellValue("{$colLetter}{$rowNum}", "-");
        }
        $sheetMaster->getStyle("{$colLetter}{$rowNum}")->applyFromArray($cellStyle);
        if ($rowNum % 2 === 0) {
            $sheetMaster->getStyle("{$colLetter}{$rowNum}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($cLightBlue);
        }
        $colIdx++;
    }
    $sheetMaster->getRowDimension($rowNum)->setRowHeight(40);
    $rowNum++;
}

// =========================================================================
// SHEET 2: JADWAL PER KELAS (PRINT-READY CARDS)
// =========================================================================
$sheetPerKelas = $spreadsheet->createSheet();
$sheetPerKelas->setTitle('JADWAL PER KELAS');
$sheetPerKelas->setShowGridLines(true);

$kRow = 1;
foreach ($classes as $cName => $cls) {
    // Header Card
    $sheetPerKelas->mergeCells("A{$kRow}:G{$kRow}");
    $sheetPerKelas->setCellValue("A{$kRow}", "JADWAL PELAJARAN KELAS {$cls->name} (TA 2026/2027)");
    $sheetPerKelas->getStyle("A{$kRow}")->getFont()->setBold(true)->setSize(13)->setColor(new Color($cNavy));

    $kRow++;
    $sheetPerKelas->setCellValue("A{$kRow}", "Wali Kelas: " . ($waliKelas[$cls->name] ?? '-'));
    $sheetPerKelas->setCellValue("D{$kRow}", "Ruangan: " . ($ruanganKelas[$cls->name] ?? '-'));
    $sheetPerKelas->setCellValue("F{$kRow}", "Tingkat: {$cls->grade_level} {$cls->rumpun}");
    $sheetPerKelas->getStyle("A{$kRow}:G{$kRow}")->getFont()->setBold(true)->setSize(10);

    $kRow++;
    // Table Header
    $sheetPerKelas->setCellValue("A{$kRow}", "HARI");
    $sheetPerKelas->setCellValue("B{$kRow}", "JAM KE");
    $sheetPerKelas->setCellValue("C{$kRow}", "WAKTU");
    $sheetPerKelas->setCellValue("D{$kRow}", "MATA PELAJARAN");
    $sheetPerKelas->setCellValue("E{$kRow}", "GURU PENGAMPU");
    $sheetPerKelas->setCellValue("F{$kRow}", "BEBAN JP");
    $sheetPerKelas->setCellValue("G{$kRow}", "KETERANGAN");
    $sheetPerKelas->getStyle("A{$kRow}:G{$kRow}")->applyFromArray($headerStyle);
    $sheetPerKelas->getRowDimension($kRow)->setRowHeight(24);

    $kRow++;
    for ($b = 0; $b < 18; $b++) {
        $bInfo = $blockDefs[$b];
        $item = $finalSchedule[$cls->id][$b] ?? null;

        $sheetPerKelas->setCellValue("A{$kRow}", $bInfo['day']);
        $sheetPerKelas->setCellValue("B{$kRow}", $bInfo['period_str']);
        $sheetPerKelas->setCellValue("C{$kRow}", $bInfo['time_str']);
        $sheetPerKelas->setCellValue("D{$kRow}", $item ? $item['mapel'] : '-');
        $sheetPerKelas->setCellValue("E{$kRow}", $item ? $item['guru'] : '-');
        $sheetPerKelas->setCellValue("F{$kRow}", $item ? $item['jp'] . ' JP' : '-');
        $sheetPerKelas->setCellValue("G{$kRow}", $item ? $item['tag'] : 'Belajar Mandiri');

        $sheetPerKelas->getStyle("A{$kRow}:G{$kRow}")->applyFromArray($cellStyle);
        $sheetPerKelas->getStyle("D{$kRow}")->getFont()->setBold(true);
        $sheetPerKelas->getRowDimension($kRow)->setRowHeight(20);
        $kRow++;
    }
    $kRow += 2; // Spacing
}

$sheetPerKelas->getColumnDimension('A')->setWidth(14);
$sheetPerKelas->getColumnDimension('B')->setWidth(15);
$sheetPerKelas->getColumnDimension('C')->setWidth(18);
$sheetPerKelas->getColumnDimension('D')->setWidth(30);
$sheetPerKelas->getColumnDimension('E')->setWidth(32);
$sheetPerKelas->getColumnDimension('F')->setWidth(12);
$sheetPerKelas->getColumnDimension('G')->setWidth(20);

// =========================================================================
// SHEET 3: JADWAL MENGAJAR GURU (33 GURU)
// =========================================================================
$sheetGuru = $spreadsheet->createSheet();
$sheetGuru->setTitle('JADWAL MENGAJAR GURU');
$sheetGuru->setShowGridLines(true);

$sheetGuru->mergeCells('A1:T1');
$sheetGuru->setCellValue('A1', 'JADWAL MENGAJAR GURU SMA NEGERI 1 CEPOGO');
$sheetGuru->getStyle('A1')->getFont()->setBold(true)->setSize(16)->setColor(new Color($cNavy));
$sheetGuru->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheetGuru->mergeCells('A2:T2');
$sheetGuru->setCellValue('A2', 'DISTRIBUSI JADWAL MENGAJAR SENIN - JUMAT (TA 2026/2027)');
$sheetGuru->getStyle('A2')->getFont()->setBold(true)->setSize(11)->setColor(new Color('64748B'));
$sheetGuru->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$sheetGuru->setCellValue('A4', 'NO');
$sheetGuru->setCellValue('B4', 'NAMA GURU & SPESIALISASI');
$sheetGuru->mergeCells('A4:A5');
$sheetGuru->mergeCells('B4:B5');
$sheetGuru->getStyle('A4:B5')->applyFromArray($headerStyle);

foreach ($colMap as $dayName => $info) {
    $sheetGuru->mergeCells("{$info['start']}4:{$info['end']}4");
    $sheetGuru->setCellValue("{$info['start']}4", strtoupper($dayName));
    $sheetGuru->getStyle("{$info['start']}4:{$info['end']}4")->applyFromArray($headerStyle);
}

$colIdx = 3;
for ($b = 0; $b < 18; $b++) {
    $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
    $bInfo = $blockDefs[$b];
    $sheetGuru->setCellValue("{$colLetter}5", "{$bInfo['period_str']}\n({$bInfo['time_str']})");
    $sheetGuru->getStyle("{$colLetter}5")->applyFromArray($subHeaderStyle);
    $sheetGuru->getColumnDimension($colLetter)->setWidth(18);
    $colIdx++;
}
$sheetGuru->getColumnDimension('A')->setWidth(6);
$sheetGuru->getColumnDimension('B')->setWidth(35);
$sheetGuru->getRowDimension(4)->setRowHeight(25);
$sheetGuru->getRowDimension(5)->setRowHeight(32);

// Teacher rows
$gRow = 6;
$gNo = 1;
$allGurus = Guru::orderBy('nama')->get();

foreach ($allGurus as $guru) {
    $sheetGuru->setCellValue("A{$gRow}", $gNo++);
    $sheetGuru->setCellValue("B{$gRow}", "{$guru->nama}\nSpec: {$guru->spesialisasi}");
    $sheetGuru->getStyle("A{$gRow}")->applyFromArray($cellStyle);
    $sheetGuru->getStyle("B{$gRow}")->applyFromArray($cellStyle)->getFont()->setBold(true);

    if ($gRow % 2 === 0) {
        $sheetGuru->getStyle("A{$gRow}:B{$gRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($cLightBlue);
    }

    $colIdx = 3;
    for ($b = 0; $b < 18; $b++) {
        $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIdx);
        // Find if this guru teaches any class in block $b
        $assignedClass = null;
        $assignedMapel = null;
        foreach ($classes as $cName => $cls) {
            $item = $finalSchedule[$cls->id][$b] ?? null;
            if ($item && $item['guru_id'] == $guru->id) {
                $assignedClass = $cls->name;
                $assignedMapel = $item['mapel'];
                break;
            }
        }

        if ($assignedClass) {
            $sheetGuru->setCellValue("{$colLetter}{$gRow}", "{$assignedClass}\n({$assignedMapel})");
            $sheetGuru->getStyle("{$colLetter}{$gRow}")->applyFromArray($cellStyle)->getFont()->setBold(true);
            $sheetGuru->getStyle("{$colLetter}{$gRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DCFCE7'); // soft green
        } else {
            $sheetGuru->setCellValue("{$colLetter}{$gRow}", "-");
            $sheetGuru->getStyle("{$colLetter}{$gRow}")->applyFromArray($cellStyle);
            if ($gRow % 2 === 0) {
                $sheetGuru->getStyle("{$colLetter}{$gRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($cLightBlue);
            }
        }
        $colIdx++;
    }
    $sheetGuru->getRowDimension($gRow)->setRowHeight(36);
    $gRow++;
}

// =========================================================================
// SHEET 4: STRUKTUR KURIKULUM & REKAP
// =========================================================================
$sheetRekap = $spreadsheet->createSheet();
$sheetRekap->setTitle('REKAP KURIKULUM & ROMBEL');
$sheetRekap->setShowGridLines(true);

$sheetRekap->mergeCells('A1:G1');
$sheetRekap->setCellValue('A1', 'REKAPITULASI STRUKTUR ROMBEL & BEBAN KURIKULUM TA 2026/2027');
$sheetRekap->getStyle('A1')->getFont()->setBold(true)->setSize(15)->setColor(new Color($cNavy));

$sheetRekap->setCellValue('A3', 'NO');
$sheetRekap->setCellValue('B3', 'NAMA ROMBEL');
$sheetRekap->setCellValue('C3', 'TINGKAT & FASE');
$sheetRekap->setCellValue('D3', 'RUMPUN PEMINATAN');
$sheetRekap->setCellValue('E3', 'WALI KELAS');
$sheetRekap->setCellValue('F3', 'TOTAL MAPEL');
$sheetRekap->setCellValue('G3', 'TOTAL JP / MINGGU');
$sheetRekap->getStyle('A3:G3')->applyFromArray($headerStyle);
$sheetRekap->getRowDimension(3)->setRowHeight(25);

$rRow = 4;
$rNo = 1;
foreach ($classes as $cName => $cls) {
    $cPlots = $plottings->where('kelas_id', $cls->id);
    $totalJp = $cPlots->sum(fn($p) => $p->subject->beban_jp ?? 0);

    $sheetRekap->setCellValue("A{$rRow}", $rNo++);
    $sheetRekap->setCellValue("B{$rRow}", $cls->name);
    $sheetRekap->setCellValue("C{$rRow}", "Tingkat {$cls->grade_level} (" . ($cls->grade_level === 'X' ? 'Fase E' : 'Fase F') . ")");
    $sheetRekap->setCellValue("D{$rRow}", $cls->rumpun);
    $sheetRekap->setCellValue("E{$rRow}", $waliKelas[$cls->name] ?? '-');
    $sheetRekap->setCellValue("F{$rRow}", $cPlots->count() . ' Mapel');
    $sheetRekap->setCellValue("G{$rRow}", $totalJp . ' JP');

    $sheetRekap->getStyle("A{$rRow}:G{$rRow}")->applyFromArray($cellStyle);
    $sheetRekap->getStyle("B{$rRow}")->getFont()->setBold(true);
    if ($rRow % 2 === 0) {
        $sheetRekap->getStyle("A{$rRow}:G{$rRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($cLightBlue);
    }
    $sheetRekap->getRowDimension($rRow)->setRowHeight(22);
    $rRow++;
}

$sheetRekap->getColumnDimension('A')->setWidth(6);
$sheetRekap->getColumnDimension('B')->setWidth(18);
$sheetRekap->getColumnDimension('C')->setWidth(20);
$sheetRekap->getColumnDimension('D')->setWidth(20);
$sheetRekap->getColumnDimension('E')->setWidth(30);
$sheetRekap->getColumnDimension('F')->setWidth(16);
$sheetRekap->getColumnDimension('G')->setWidth(20);

// Save Excel File
$writer = new Xlsx($spreadsheet);
$outputDir = __DIR__ . '/data_rill';
$filePath1 = $outputDir . '/JADWAL_PELAJARAN_SMA_N_1_CEPOGO_2026_2027.xlsx';
$filePath2 = __DIR__ . '/JADWAL_PELAJARAN_SMA_N_1_CEPOGO_2026_2027.xlsx';

$writer->save($filePath1);
$writer->save($filePath2);

echo "SUCCESS! Excel files saved to:\n";
echo "- {$filePath1}\n";
echo "- {$filePath2}\n";
