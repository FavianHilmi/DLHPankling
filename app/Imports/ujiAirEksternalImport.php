<?php

namespace App\Imports;

use App\Models\UjiAirEksternal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ujiAirEksternalImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new UjiAirEksternal([
            'tanggal' => $row['tanggal'],
            'nama_lokasi' => $row['nama_lokasi'],
            // 'wilayah_lokasi' => $row['wilayah_lokasi'],
            'longitude' => $row['longitude'] ?? null,
            'latitude' => $row['latitude'] ?? null,
            'temperature' => $row['temperature'] ?? null,
            'TDS' => $row['TDS'] ?? null,
            'TSS' => $row['TSS'] ?? null,
            'colour' => $row['colour'] ?? null,
            'pH' => $row['pH'] ?? null,
            'BOD' => $row['BOD'] ?? null,
            'COD' => $row['COD'] ?? null,
            'DO' => $row['DO'] ?? null,
            'sulfate' => $row['sulfate'] ?? null,
            'chloride' => $row['chloride'] ?? null,
            'nitrate' => $row['nitrate'] ?? null,
            'nitrite' => $row['nitrite'] ?? null,
            'ammonia' => $row['ammonia'] ?? null,
            'total_n' => $row['total_n'] ?? null,
            'total_phosphate' => $row['total_phosphate'] ?? null,
            'fluoride' => $row['fluoride'] ?? null,
            'sulfide' => $row['sulfide'] ?? null,
            'cyanide' => $row['cyanide'] ?? null,
            'free_chlorine' => $row['free_chlorine'] ?? null,
            'boron' => $row['boron'] ?? null,
            'mercury' => $row['mercury'] ?? null,
            'arsenic' => $row['arsenic'] ?? null,
            'selenium' => $row['selenium'] ?? null,
            'cadmium' => $row['cadmium'] ?? null,
            'cobalt' => $row['cobalt'] ?? null,
            'nickel' => $row['nickel'] ?? null,
            'zinc' => $row['zinc'] ?? null,
            'copper' => $row['copper'] ?? null,
            'lead' => $row['lead'] ?? null,
            'hexavalent_chromium' => $row['hexavalent_chromium'] ?? null,
            'oil_and_grease' => $row['oil_and_grease'] ?? null,
            'surfactants' => $row['surfactants'] ?? null,
            'phenol' => $row['phenol'] ?? null,
            'fecal_coli' => $row['fecal_coli'] ?? null,
            'total_coli' => $row['total_coli'] ?? null,
            'waste' => $row['waste'] ?? null,
            'isMarker' => $row['isMarker'] ?? '0',
            'status' => 'Sedang Diajukan',
            'user_id' => Auth::id(),
        ]);
    }
}
