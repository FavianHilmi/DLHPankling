<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKLHK extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    use HasFactory;

    protected $table = 'data_klhks';

    protected $fillable = [
        'tanggal',
        'SO2',
        'CO',
        'O3',
        'NO2',
        'HC',
        'PM10',
        'PM2_5',
        'user_id',
        'status'
    ];
    public $timestamps = true;
}
