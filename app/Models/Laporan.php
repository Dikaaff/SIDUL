<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'catatan_dosen',
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'magang_id', 'id');
    }

    public function komentar()
    {
        return $this->hasMany(KomentarLaporan::class, 'laporan_id', 'id');
    }

    public function revisi()
    {
        return $this->hasMany(RevisiLaporan::class, 'laporan_id', 'id');
    }
}
