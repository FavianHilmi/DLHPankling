<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPartikulat extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    use HasFactory;

    public function dataKawasan()
    {
        return $this->belongsTo(DataKawasan::class, 'kawasan_id');
    }

    protected $table = 'data_partikulats';
    protected $fillable = [
        'nama_lokasi',
        'longitude',
        'latitude',
        'tahun',
        'TPM',
        'PM10',
        'PM2_5',
        'kawasan_id',
        'user_id',
        'status'
    ];
    public $timestamps = true;
}
