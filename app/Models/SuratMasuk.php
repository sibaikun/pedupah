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
        'tanggal_terima' => 'date'
    ];

    // Status options
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSED = 'processed';
    const STATUS_ARCHIVED = 'archived';

    public function getStatusTextAttribute()
    {
        $statuses = [
            self::STATUS_PENDING => 'Belum Diproses',
            self::STATUS_PROCESSED => 'Sudah Diproses',
            self::STATUS_ARCHIVED => 'Diarsipkan'
        ];

        return $statuses[$this->status] ?? $this->status;
    }
}