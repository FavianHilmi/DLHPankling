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
            'nama_penguji' => 'required|string',
            'instansi' => 'required|string',
            'berita_id' => 'nullable|exists:beritas,id',
            'ttd' => 'nullable|string',
        ];
    }
}
