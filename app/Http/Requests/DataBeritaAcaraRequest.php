<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataBeritaAcaraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'nama_kolom_penguji' => 'required|string',
            'penguji.*.nama_penguji' => 'required|string',
            'penguji.*.instansi' => 'required|string',
            'penguji.*.ttd' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',

        ];
    }

}
