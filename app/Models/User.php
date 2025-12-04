<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke Surat Pengajuan
    public function suratPengajuans()
    {
        return $this->hasMany(SuratPengajuan::class, 'user_id');
    }

    // Relasi ke Pengaduan
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'user_id');
    }
}