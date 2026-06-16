<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    public function getDisplayNameAttribute(): string
    {
        return match ($this->role) {
            'mahasiswa' => $this->mahasiswa->nama,
            'dosen'     => $this->dosen->nama,
            default     => $this->username,
        };
    }

    # fungsi relasi hasOne ke model Mahasiswa
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id', 'id');
    }

    # fungsi relasi hasOne ke model Dosen
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'user_id', 'id');
    }

    # fungsi untuk mengecek apakah user adalah mahasiswa
    public function isMahasiswa() { return $this->role === 'mahasiswa'; }
    # fungsi untuk mengecek apakah user adalah dosen
    public function isDosen() { return $this->role === 'dosen'; }
    # fungsi untuk mengecek apakah user adalah operator
    public function isOperator() { return $this->role === 'operator'; }
    # fungsi untuk mengecek apakah user adalah admin
    public function isAdmin() { return $this->role === 'admin'; }

    # fungsi untuk mendefinisikan casting atribut
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
