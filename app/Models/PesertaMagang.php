<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaMagang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_peserta_magang';

    protected $fillable = [
        'id_mahasiswa',
        'id_magang',
        'nim',
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'id_magang', 'id_magang');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
