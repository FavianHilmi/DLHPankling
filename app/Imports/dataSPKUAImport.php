<?php

namespace App\Imports;

use App\Models\DataSPKUA;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class dataSPKUAImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new DataSPKUA([
            'tanggal' => $row['tanggal'],
            'lokasi' => $row['lokasi'],
            'longitude' => $row['longitude'] ?? null,
            'latitude' => $row['latitude'] ?? null,
            'PM10' => $row['PM10'],
            'PM2_5' => $row['PM2_5'],
            'SO2' => $row['SO2'],
            'CO' => $row['CO'],
            'O3' => $row['O3'],
            'NO2' => $row['NO2'],
            'HC' => $row['HC'],
            'user_id' => Auth::id(),
            'status' => 'Sedang Diajukan',
        ]);
    }
}
