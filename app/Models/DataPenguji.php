<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenguji extends Model
{
    use HasFactory;
    protected $fillable = [
        'berita_id',
        'nama_penguji',
        'instansi',
        'ttd'
    ];

    public function beritaAcara()
    {
        // return $this->belongsTo(DataBeritaAcara::class);
        return $this->belongsTo(DataBeritaAcara::class, 'berita_id');
    }
}
