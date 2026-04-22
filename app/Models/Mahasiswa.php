<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = ['user_id', 'nim', 'nama', 'prodi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesertaMagang()
    {
        return $this->hasMany(PesertaMagang::class, 'id_mahasiswa');
    }
}
