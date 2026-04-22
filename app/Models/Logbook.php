<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $table = 'logbook';
    protected $primaryKey = 'id_logbook';

    protected $fillable = [
        'id_magang','tanggal','kegiatan','catatan_dosen'
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'id_magang');
    }
}