<?php

namespace App\Imports;

use App\Models\UjiAirInternal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ujiAirInternalImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new UjiAirInternal([
            'tanggal' => $row['tanggal'],
            'nama_lokasi' => $row['nama_lokasi'],
            // 'wilayah_lokasi' => $row['wilayah_lokasi'],
            'longitude' => $row['longitude'],
            'latitude' => $row['latitude'],
            'pH' => $row['pH'],
            'DO' => $row['DO'],
            'BOD' => $row['BOD'],
            'COD' => $row['COD'],
            'TSS' => $row['TSS'],
            'nitrat' => $row['nitrat'],
            'fosfat' => $row['fosfat'],
            'fecal_coli' => $row['fecal_coli'],
            'kelas' => $row['kelas'],
            'isMarker' => $row['isMarker'] ?? '0',
            'status' => 'Sedang Diajukan',
            'user_id' => Auth::id(),
        ]);
    }
}
