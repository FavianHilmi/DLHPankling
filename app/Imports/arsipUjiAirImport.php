<?php

namespace App\Imports;

use App\Models\ArsipUjiAir;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class arsipUjiAirImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new ArsipUjiAir([
            'bulan' => $row['bulan'],
            'tahun' => $row['tahun'],
            'nama_lokasi' => $row['nama_lokasi'],
            'longitude' => $row['longitude'] ?? null,
            'latitude' => $row['latitude'] ?? null,
            'BOD' => $row['BOD'] ?? null,
            'COD' => $row['COD'] ?? null,
            'TSS' => $row['TSS'] ?? null,
            'DO' => $row['DO'] ?? null,
            'pH' => $row['pH'] ?? null,
            'total_coli' => $row['total_coli'] ?? null,
            'fecal_coli' => $row['fecal_coli'] ?? null,
            'isMarker' => $row['isMarker'] ?? '0',
            'status' => 'Sedang Diajukan',
            'user_id' => Auth::id(),
        ]);
    }
}
