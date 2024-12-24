<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataPassiveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function messages()
    {
        return [
            'pemasangan.required' => 'Tanggal pemasangan wajib diisi.',
            'pelepasan.required' => 'Tanggal pelepasan wajib diisi.',
            // other custom messages
        ];
    }
    public function rules(): array
    {
        return [
            'pemasangan' => 'required|date',
            'pelepasan' => 'required|date',
            'semester' => 'required|string',
            'lokasi' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'kawasan_id' => 'nullable|exists:data_kawasans,id',
            'SO2' => 'required|numeric',
            'NO2' => 'required|numeric',
        ];
    }
}
