<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataPartikulatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Change this to true
    }

    public function rules(): array
    {
        return [
            // Optional: You might want to comment this out since you assign user_id in the controller
            // 'user_id' => 'required|exists:users,id',
            'nama_lokasi' => 'required|string|max:255',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'tahun' => 'required|string',
            'TPM' => 'required|numeric',
            'PM10' => 'required|numeric',
            'PM2_5' => 'required|numeric',
            'kawasan_id' => 'nullable|exists:data_kawasans,id',
        ];
    }
}
