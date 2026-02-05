<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'nomor_surat',
        'tanggal_terima',
        'pengirim',
        'perihal',
        'status',
        'catatan',
        'file_path'
    ];

    protected $casts = [
        'tanggal_terima' => 'date',
    ];

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'badge-warning',
            'processed' => 'badge-success',
            'archived' => 'badge-info'
        ];
        return $badges[$this->status] ?? 'badge-secondary';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'pending' => 'Belum Diproses',
            'processed' => 'Sudah Diproses',
            'archived' => 'Diarsipkan'
        ];
        return $texts[$this->status] ?? $this->status;
    }
}