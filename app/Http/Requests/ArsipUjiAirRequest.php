<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArsipUjiAirRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Bisa add logic authorization kalau perlu
    }

    public function rules()
    {
        return [
            'bulan' => 'required|string',
            'tahun' => 'required|string',
            'nama_lokasi' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'BOD' => 'required|numeric',
            'COD' => 'required|numeric',
            'TSS' => 'required|numeric',
            'DO' => 'required|numeric',
            'pH' => 'required|numeric',
            'total_coli' => 'required|numeric',
            'fecal_coli' => 'required|numeric',
            'isMarker' => 'required|string',
        ];
    }
}
