<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Magang;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','nik','nama'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_wali_id');
    }
    public function magang()
    {
        return $this->hasMany(Magang::class, 'dosen_pembimbing_id');
    }
}