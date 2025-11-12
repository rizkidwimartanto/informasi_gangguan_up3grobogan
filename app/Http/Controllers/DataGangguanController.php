<?php

namespace App\Http\Controllers;

use App\Models\DataGangguan;
use App\Imports\DataGangguanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DataGangguanController extends Controller
{
    public function index()
    {
        $data_gangguan = DataGangguan::all();
        return view('index', compact('data_gangguan'));
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getRealPath());

        // === SHEET JUMLAH TRAFO ===
        $trafoSheet = $spreadsheet->getSheetByName('JUMLAH TRAFO');
        if ($trafoSheet) {
            $rows = $trafoSheet->toArray(null, true, true, true);
            foreach ($rows as $index => $row) {
                if ($index == 1) continue; // Lewati header

                $penyulang = trim($row['C'] ?? '');
                $keypoint = trim($row['D'] ?? '');
                $jumlahTrafo = (int) ($row['E'] ?? 0);

                if (empty($penyulang)) continue;

                \App\Models\DataGangguan::updateOrCreate(
                    [
                        'penyulang' => $penyulang,
                        'keypoint' => $keypoint
                    ],
                    [
                        'jumlah_trafo' => $jumlahTrafo
                    ]
                );
            }
        }

        return back()->with('success', '✅ Data dari sheet JUMLAH TRAFO berhasil diimpor!');
    }
}
