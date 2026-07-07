<?php

namespace App\Http\Controllers;

use App\Models\MasterKelas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MasterKelasController extends Controller
{
    public function index()
    {
        Gate::authorize('view_kelas');
        
        $master_classes = MasterKelas::orderBy('grade_level', 'asc')->orderBy('name', 'asc')->get();
        return view('master_kelas.index', compact('master_classes'));
    }

    public function create()
    {
        Gate::authorize('create_kelas');
        return view('master_kelas.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create_kelas');

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:master_kelas,name',
            'grade_level' => 'required|string|max:50',
            'major' => 'nullable|string|max:255',
        ]);

        MasterKelas::create($validated);

        return redirect()->route('master-classes.index')->with('success', 'Master Kelas berhasil ditambahkan.');
    }

    public function edit(MasterKelas $masterClass)
    {
        Gate::authorize('edit_kelas');
        return view('master_kelas.edit', compact('masterClass'));
    }

    public function update(Request $request, MasterKelas $masterClass)
    {
        Gate::authorize('edit_kelas');

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:master_kelas,name,' . $masterClass->id,
            'grade_level' => 'required|string|max:50',
            'major' => 'nullable|string|max:255',
        ]);
        
        $oldName = $masterClass->name;

        $masterClass->update($validated);
        
        // Update name in existing rombels to keep it consistent
        if ($oldName !== $validated['name']) {
            Kelas::withoutGlobalScopes()->where('name', $oldName)->update([
                'name' => $validated['name'],
                'grade_level' => $validated['grade_level'],
                'major' => $validated['major']
            ]);
        }

        return redirect()->route('master-classes.index')->with('success', 'Master Kelas berhasil diperbarui.');
    }

    public function destroy(MasterKelas $masterClass)
    {
        Gate::authorize('delete_kelas');

        $used = Kelas::withoutGlobalScopes()->where('name', $masterClass->name)->exists();
        
        if ($used) {
            return redirect()->route('master-classes.index')->with('error', 'Gagal: Master Kelas ini tidak bisa dihapus karena sudah memiliki Rombel yang terhubung.');
        }

        $masterClass->delete();

        return redirect()->route('master-classes.index')->with('success', 'Master Kelas berhasil dihapus.');
    }

    public function exportExcel(Request $request)
    {
        Gate::authorize('view_kelas');

        $master_classes = MasterKelas::orderBy('grade_level', 'asc')->orderBy('name', 'asc')->get();
        $schoolName = \App\Models\Pengaturan::getValue('school_name', 'SMA Negeri 1 Cepogo');

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 1. Kop Surat
        $sheet->setCellValue('A1', 'DATA MASTER KELAS');
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getFont()->setName('Arial')->setSize(14)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', $schoolName);
        $sheet->mergeCells('A2:D2');
        $sheet->getStyle('A2')->getFont()->setName('Arial')->setSize(11)->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Diekspor oleh: ' . auth()->user()->name . ' pada ' . date('d/m/Y H:i') . ' WIB');
        $sheet->mergeCells('A3:D3');
        $sheet->getStyle('A3')->getFont()->setName('Arial')->setSize(10);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // 2. Header Tabel
        $headers = ['No', 'Nama Kelas', 'Tingkat', 'Fase / Jurusan'];
        $sheet->fromArray($headers, null, 'A5');

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'name' => 'Arial',
                'size' => 10
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '475569'] // slate-700
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A5:D5')->applyFromArray($headerStyle);

        // 3. Isi Data
        $data = [];
        $no = 1;
        foreach ($master_classes as $mk) {
            $data[] = [
                $no++,
                $mk->name,
                $mk->grade_level,
                $mk->major ?? '-'
            ];
        }
        
        if (count($data) > 0) {
            $sheet->fromArray($data, null, 'A6');
            $dataRange = 'A6:D' . (5 + count($data));
            
            $dataStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ];
            $sheet->getStyle($dataRange)->applyFromArray($dataStyle);
            $sheet->getStyle('A6:A' . (5 + count($data)))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C6:C' . (5 + count($data)))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        // Set Lebar Kolom
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(30);

        // Download Response
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Data_Master_Kelas_' . date('Ymd_His') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}
