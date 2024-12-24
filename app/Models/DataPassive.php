<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPassive extends Model
{
    use HasFactory;

    protected $table = 'data_passives';

    protected $fillable = [
        'pemasangan',
        'pelepasan',
        'semester',
        'lokasi',
        'kawasan_id',
        'longitude',
        'latitude',
        'SO2',
        'NO2',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dataKawasan()
    {
        return $this->belongsTo(DataKawasan::class, 'kawasan_id');
    }
}
