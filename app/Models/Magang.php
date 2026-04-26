<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

class Magang extends Model
{
    use HasFactory;
    protected $fillable = ['kode_magang', 'dosen_pembimbing_id', 'status_magang'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id');
    }

    public function peserta()
    {
        return $this->hasMany(PesertaMagang::class);
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class);
    }
}
