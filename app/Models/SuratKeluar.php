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
        'tanggal_kirim' => 'date'
    ];

    // Status options
    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';
    const STATUS_DELIVERED = 'delivered';

    public function getStatusTextAttribute()
    {
        $statuses = [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_SENT => 'Terkirim',
            self::STATUS_DELIVERED => 'Diterima'
        ];

        return $statuses[$this->status] ?? $this->status;
    }
}