<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBeritaAcara extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'status',
        'nama_kolom_penguji',
        'pdf_file',
        'approved_by',
        'user_id'
    ];
    public $timestamps = true;


    public function penguji()
    {
        return $this->hasMany(DataPenguji::class);
    }
}
