<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarLaporan extends Model
{
    protected $table = 'komentar_laporan';
    protected $primaryKey = 'id_komentar';

    protected $fillable = ['id_laporan', 'id_user', 'bab_ke', 'komentar'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
