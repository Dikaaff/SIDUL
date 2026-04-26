<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory;
    protected $fillable = [
        'magang_id',
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
        return $this->belongsTo(Magang::class);
    }

    public function komentar()
    {
        return $this->hasMany(KomentarLaporan::class);
    }

    public function revisi()
    {
        return $this->hasMany(RevisiLaporan::class);
    }
}
