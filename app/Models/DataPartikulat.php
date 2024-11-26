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

    protected $table = 'data_partikulats';

    protected $fillable = [
        'tahun',
        'TPM',
        'PM10',
        'PM2_5',
        'user_id',
        'nama_lokasi',
        'titik_koordinat',
        'status'
    ];
    public $timestamps = true;
}
