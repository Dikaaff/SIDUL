<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $table = 'magang';
    protected $primaryKey = 'id_magang';

    protected $fillable = ['kode_magang', 'id_dosen_pembimbing', 'status_magang'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_pembimbing');
    }

    public function peserta()
    {
        return $this->hasMany(PesertaMagang::class, 'id_magang');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'id_magang');
    }
}
