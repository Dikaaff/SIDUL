<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Magang;
class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';

    protected $fillable = ['user_id','nik','nama'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function magang()
    {
        return $this->hasMany(Magang::class, 'id_dosen_pembimbing');
    }
}