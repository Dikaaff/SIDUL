<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaMagang extends Model
{
    protected $table = 'peserta_magang';

    protected $fillable = ['id_magang', 'id_mahasiswa', 'is_ketua'];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'id_magang');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
}
