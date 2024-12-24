<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipUjiAir extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    use HasFactory;

    protected $table = 'arsip_data_air_internals';

    protected $fillable = [
        'bulan',
        'tahun',
        'nama_lokasi',
        'longitude',
        'latitude',
        'pH',
        'DO',
        'BOD',
        'COD',
        'TSS',
        'total_coli',
        'fecal_coli',
        'status',
        'isMarker',
        'user_id'

    ];
    public $timestamps = true;
}
