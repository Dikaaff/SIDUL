<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'dosen_wali_id',
        'status_magang',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'dosen_wali_id', 'id_dosen');
    }

    public function pesertaMagang()
    {
        return $this->hasOne(PesertaMagang::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
