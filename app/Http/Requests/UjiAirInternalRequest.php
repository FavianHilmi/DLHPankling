<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UjiAirInternalRequest extends FormRequest
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
            'titik_koordinat' => 'required|string',
            'pH' => 'required|numeric',
            'DO' => 'required|numeric',
            'BOD' => 'required|numeric',
            'COD' => 'required|numeric',
            'TSS' => 'required|numeric',
            'nitrat' => 'required|numeric',
            'fosfat' => 'required|numeric',
            'fecal_coli' => 'required|numeric',
            'kelas' => 'required|numeric'


        ];
    }
}
