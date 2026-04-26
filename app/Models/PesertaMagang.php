<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  

class PesertaMagang extends Model
{
    use HasFactory;
    protected $fillable = ['magang_id', 'mahasiswa_id', 'is_ketua'];

    public function magang()
    {
        return $this->belongsTo(Magang::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
