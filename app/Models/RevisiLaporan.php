<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisiLaporan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'laporan_id',
        'bab_yang_diubah',
        'konten_lama',
        'konten_baru',
        'updated_by',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
