<?php

// app/Imports/DataGangguanImport.php
namespace App\Imports;

use App\Models\DataGangguan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataGangguanImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            // Sheet kedua tempat keypoint & jumlah trafo
            2 => new DataGangguanSheetImport(),
        ];
    }
}

class DataGangguanSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Pastikan heading di Excel: PENYULANG | KEYPOINT | JUMLAH TRAFO
        if (empty($row['penyulang'])) {
            return null;
        }

        return new DataGangguan([
            'penyulang' => $row['penyulang'],
            'keypoint' => $row['keypoint'] ?? null,
            'jumlah_trafo' => $row['jumlah trafo'] ?? 0,
        ]);
    }
}
