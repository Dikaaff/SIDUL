<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staff_id',
    ];

    # fungsi relasi belongsTo ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
