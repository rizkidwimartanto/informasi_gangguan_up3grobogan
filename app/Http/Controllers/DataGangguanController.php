<?php

namespace App\Http\Controllers;

use App\Models\DataGangguan;
use App\Imports\DataGangguanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DataGangguanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
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
