<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_magang',
        'dosen_pembimbing_id',
        'tipe_magang',
        'konsentrasi',
        'perusahaan',
        'alamat',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_magang',
    ];

    public function peserta()
    {
        return $this->hasMany(PesertaMagang::class, 'magang_id', 'id');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id', 'id');
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'magang_id', 'id');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'magang_id', 'id');
    }
}
