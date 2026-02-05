<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'tanggal_kirim',
        'tujuan',
        'alamat_tujuan',
        'perihal',
        'isi_surat',
        'status',
        'penandatangan',
        'file_path'
    ];

    protected $casts = [
        'tanggal_kirim' => 'date',
    ];

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => 'badge-warning',
            'sent' => 'badge-primary',
            'delivered' => 'badge-success'
        ];
        return $badges[$this->status] ?? 'badge-secondary';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'draft' => 'Draft',
            'sent' => 'Terkirim',
            'delivered' => 'Diterima'
        ];
        return $texts[$this->status] ?? $this->status;
    }
}