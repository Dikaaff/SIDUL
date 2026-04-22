<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_magang',
        'judul',
        'bab1',
        'bab2',
        'bab3',
        'bab4',
        'status',
        'catatan_dosen'
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'id_magang');
    }

    public function komentar()
    {
        return $this->hasMany(KomentarLaporan::class, 'id_laporan');
    }

    public function revisi()
    {
        return $this->hasMany(RevisiLaporan::class, 'id_laporan');
    }
}
