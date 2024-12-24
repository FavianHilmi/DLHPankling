<?php

namespace App\Imports;

use App\Models\DataPassive;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class dataPassiveImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new DataPassive([
            'pemasangan' => $row['pemasangan'],
            'pelepasan' => $row['pelepasan'],
            'semester' => $row['semester'],
            'lokasi' => $row['lokasi'],
            'longitude' => $row['longitude'] ?? null,
            'latitude' => $row['latitude'] ?? null,
            'kawasan_id' => $row['kawasan_id'] ?? null,
            'SO2' => $row['SO2'],
            'NO2' => $row['NO2'],
            'user_id' => Auth::id(),
            'status' => 'Sedang Diajukan',
        ]);
    }
}
