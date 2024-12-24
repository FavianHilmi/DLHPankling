<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataKLHKRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Bisa add logic authorization kalau perlu
    }

    public function rules()
    {
        return [
            'tanggal' => 'required|date',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'SO2'  => 'required|numeric',
            'CO' => 'required|numeric',
            'O3' => 'required|numeric',
            'NO2' => 'required|numeric',
            'HC' => 'required|numeric',
            'PM10' => 'required|numeric',
            'PM2_5' => 'required|numeric',
        ];
    }
}
