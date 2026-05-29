<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'konsentrasi',
        'status_magang',
        'dosen_wali_id',
    ];

    # fungsi relasi belongsTo ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    # fungsi relasi belongsTo ke model Dosen sebagai wali
    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'dosen_wali_id', 'id');
    }

    # fungsi relasi hasOne ke model PesertaMagang
    public function pesertaMagang()
    {
        return $this->hasOne(PesertaMagang::class, 'mahasiswa_id', 'id');
    }
}
