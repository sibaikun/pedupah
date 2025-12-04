<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengajuan extends Model
{
    use HasFactory;

    protected $table = 'surat_pengajuans'; // pastikan sama dengan nama tabel di DB

    protected $fillable = [
        'user_id',
        'nama_pemohon',
        'nik',
        'alamat',
        'nomor_telepon',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'jenis_surat',
        'keperluan',
        'file_pendukung',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke User (many-to-one)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}