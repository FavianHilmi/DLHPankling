<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataSPKUARequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'PM10' => 'required|numeric',
            'PM2_5' => 'required|numeric',
            'SO2' => 'required|numeric',
            'CO' => 'required|numeric',
            'O3' => 'required|numeric',
            'NO2' => 'required|numeric',
            'HC' => 'required|numeric',
        ];
    }
}
