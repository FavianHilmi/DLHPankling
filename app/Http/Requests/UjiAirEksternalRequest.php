<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UjiAirEksternalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal' => 'required|date',
            'nama_lokasi' => 'required|string',
            'wilayah_lokasi' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'temperature'=> 'required|numeric',
            'TDS'=> 'required|numeric',
            'TSS'=> 'required|numeric',
            'colour'=> 'required|numeric',
            'pH'=> 'required|numeric',
            'BOD'=> 'required|numeric',
            'COD'=> 'required|numeric',
            'DO'=> 'required|numeric',
            'sulfate'=> 'required|numeric',
            'chloride'=> 'required|numeric',
            'nitrate'=> 'required|numeric',
            'nitrite'=> 'required|numeric',
            'ammonia'=> 'required|numeric',
            'total_n'=> 'required|numeric',
            'total_phosphate'=> 'required|numeric',
            'fluoride'=> 'required|numeric',
            'sulfide'=> 'required|numeric',
            'cyanide'=> 'required|numeric',
            'free_chlorine'=> 'required|numeric',
            'boron'=> 'required|numeric',
            'mercury'=> 'required|numeric',
            'arsenic'=> 'required|numeric',
            'selenium'=> 'required|numeric',
            'cadmium'=> 'required|numeric',
            'cobalt'=> 'required|numeric',
            'nickel'=> 'required|numeric',
            'zinc'=> 'required|numeric',
            'copper'=> 'required|numeric',
            'lead'=> 'required|numeric',
            'hexavalent_chromium'=> 'required|numeric',
            'oil_and_grease'=> 'required|numeric',
            'surfactants'=> 'required|numeric',
            'phenol'=> 'required|numeric',
            'fecal_coli'=> 'required|numeric',
            'total_coli'=> 'required|numeric',
            'waste'=> 'required|numeric',
            'isMarker' => 'required|string'

        ];
    }
}
