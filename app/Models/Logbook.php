<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'magang_id',
        'tanggal',
        'kegiatan',
        'catatan_dosen',
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'magang_id', 'id');
    }
}
