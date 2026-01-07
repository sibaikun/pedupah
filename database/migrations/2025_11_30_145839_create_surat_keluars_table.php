<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->date('tanggal_kirim');
            $table->string('tujuan');
            $table->text('alamat_tujuan');
            $table->string('perihal');
            $table->text('isi_surat');
            $table->enum('status', ['draft', 'sent', 'delivered'])->default('draft');
            $table->string('penandatangan')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};