<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'nama',
    ];

    # fungsi relasi belongsTo ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    # fungsi relasi hasMany ke model Mahasiswa sebagai wali
    public function mahasiswaWali()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_wali_id', 'id');
    }

    # fungsi relasi hasMany ke model Magang sebagai pembimbing
    public function bimbinganMagang()
    {
        return $this->hasMany(Magang::class, 'dosen_pembimbing_id', 'id');
    }
}
