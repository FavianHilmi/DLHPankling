<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjiAirInternal extends Model
{
    use HasFactory;

    protected $table = 'uji_air_internals';
    protected $fillable = [
        'tanggal',
        'nama_lokasi',
        'wilayah_lokasi',
        'titik_koordinat',
        'pH',
        'DO',
        'BOD',
        'COD',
        'TSS',
        'nitrat',
        'fosfat',
        'fecal_coli',
        'kelas'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
