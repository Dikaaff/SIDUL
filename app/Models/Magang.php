<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_magang',
        'status_magang',
        'perusahaan',
        'alamat',
        'tanggal_mulai',
        'tanggal_selesai',
        'dosen_pembimbing_id',
        'tipe_magang',
        'konsentrasi',
    ];

    # fungsi relasi hasMany ke model PesertaMagang
    public function peserta()
    {
        return $this->hasMany(PesertaMagang::class, 'magang_id', 'id');
    }

    # fungsi relasi belongsTo ke model Dosen sebagai pembimbing
    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id', 'id');
    }

    # fungsi relasi hasMany ke model Logbook
    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'magang_id', 'id');
    }

    # fungsi relasi hasOne ke model Laporan
    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'magang_id', 'id');
    }
}
