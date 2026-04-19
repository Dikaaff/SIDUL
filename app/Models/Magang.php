<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_magang';

    protected $fillable = [
        'kode_magang',
        'nim',
        'perusahaan',
        'alamat',
        'tanggal_mulai',
        'tanggal_selesai',
        'konsentrasi',
        'tipe_magang',
        'link_bukti_magang',
        'link_survey_perusahaan',
        'dosen_pembimbing_id',
        'status_magang',
    ];

    public function peserta()
    {
        return $this->hasMany(PesertaMagang::class, 'id_magang', 'id_magang');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id', 'id_dosen');
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'id_magang', 'id_magang');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'id_magang', 'id_magang');
    }
}
