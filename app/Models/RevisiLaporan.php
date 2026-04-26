<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RevisiLaporan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'laporan_id',
        'bab_yang_diubah',
        'konten_lama',
        'konten_baru',
        'updated_by'
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
