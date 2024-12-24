<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataKawasanRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Bisa add logic authorization kalau perlu
    }

    public function rules()
    {
        return [
            'kawasan' => 'required|string',
            'deskripsi' => 'required|string',
        ];
    }
}
