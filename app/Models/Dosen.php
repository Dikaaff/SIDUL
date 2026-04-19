<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'user_id',
        'nik',
        'nama',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function mahasiswaWali()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_wali_id', 'id_dosen');
    }

    public function bimbinganMagang()
    {
        return $this->hasMany(Magang::class, 'dosen_pembimbing_id', 'id_dosen');
    }
}
