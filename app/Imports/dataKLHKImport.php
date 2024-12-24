<?php

namespace App\Imports;

use App\Models\DataKLHK;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class dataKLHKImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new DataKLHK([
            'tanggal' => $row['tanggal'],
            'longitude' => $row['longitude'] ?? null,
            'latitude' => $row['latitude'] ?? null,
            'SO2' => $row['SO2'],
            'CO' => $row['CO'],
            'O3' => $row['O3'],
            'NO2' => $row['NO2'],
            'HC' => $row['HC'],
            'PM10' => $row['PM10'],
            'PM2_5' => $row['PM2_5'],
            'user_id' => Auth::id(),
            'status' => 'Sedang Diajukan',
        ]);
    }
}
