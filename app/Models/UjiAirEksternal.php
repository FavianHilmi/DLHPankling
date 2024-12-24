<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjiAirEksternal extends Model
{
    use HasFactory;

    protected $table = 'uji_air_eksternals';
    protected $fillable = [
        'tanggal',
        'nama_lokasi',
        'wilayah_lokasi',
        'longitude',
        'latitude',
        'temperature',
        'TDS',
        'TSS',
        'colour',
        'pH',
        'BOD',
        'COD',
        'DO',
        'sulfate',
        'chloride',
        'nitrate',
        'nitrite',
        'ammonia',
        'total_n',
        'total_phosphate',
        'fluoride',
        'sulfide',
        'cyanide',
        'free_chlorine',
        'boron',
        'mercury',
        'arsenic',
        'selenium',
        'cadmium',
        'cobalt',
        'nickel',
        'zinc',
        'copper',
        'lead',
        'hexavalent_chromium',
        'oil_and_grease',
        'surfactants',
        'phenol',
        'fecal_coli',
        'total_coli',
        'waste',
        'isMarker'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
