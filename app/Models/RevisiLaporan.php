<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevisiLaporan extends Model
{
    protected $table = 'revisi_laporan';
    protected $primaryKey = 'id_revisi';

    public $timestamps = false;

    protected $fillable = [
        'id_laporan',
        'bab_yang_diubah',
        'konten_lama',
        'konten_baru',
        'updated_by'
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
