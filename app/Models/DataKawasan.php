<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKawasan extends Model
{
    use HasFactory;

    protected $table = 'data_kawasans';

    protected $fillable = ['kawasan', 'deskripsi'];


    public function passives()
    {
        return $this->hasMany(DataPassive::class, 'kawasan_id');
    }


    public function partikulats()
    {
        return $this->hasMany(DataPartikulat::class, 'kawasan_id');
    }

}
