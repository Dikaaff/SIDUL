<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KomentarLaporan extends Model
{
    use HasFactory;

    protected $fillable = ['laporan_id', 'user_id', 'bab_ke', 'komentar'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
