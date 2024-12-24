<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSPKUA extends Model
{
    use HasFactory;

    protected $table = 'data_spkuas';

    protected $fillable = [
        'tanggal',
        'lokasi',
        'longitude',
        'latitude',
        'PM10',
        'PM2_5',
        'SO2',
        'CO',
        'O3',
        'NO2',
        'HC',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
