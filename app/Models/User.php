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

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    /**
     * Relationships with role-specific profiles
     */
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id', 'id_user');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'user_id', 'id_user');
    }

    /**
     * Role checking helpers
     */
    public function isMahasiswa() { return $this->role === 'mahasiswa'; }
    public function isDosen() { return $this->role === 'dosen'; }
    public function isOperator() { return $this->role === 'operator'; }
    public function isAdmin() { return $this->role === 'admin'; }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
