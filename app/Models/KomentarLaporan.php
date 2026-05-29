<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarLaporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'user_id',
        'bab_ke',
        'komentar',
    ];

    # fungsi relasi belongsTo ke model Laporan
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id', 'id');
    }

    # fungsi relasi belongsTo ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
