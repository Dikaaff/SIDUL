<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_magang',
        'laporan',
        'status_laporan',
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'id_magang', 'id_magang');
    }
}
