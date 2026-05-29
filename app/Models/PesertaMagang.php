<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'magang_id',
        'is_ketua',
    ];

    # fungsi relasi belongsTo ke model Magang
    public function magang()
    {
        return $this->belongsTo(Magang::class, 'magang_id', 'id');
    }

    # fungsi relasi belongsTo ke model Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }
}
