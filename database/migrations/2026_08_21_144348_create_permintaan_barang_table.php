<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permintaan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');
            $table->string('nama_barang');
            $table->enum('kategori', [
                'elektronik_komputer',
                'jaringan',
                'perlengkapan_praktik',
                'seragam_pakaian',
                'referensi_modul',
                'kreatif_multimedia',
                'lainnya'
            ]);
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['aktif', 'terpenuhi', 'ditutup'])->default('aktif');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permintaan_barang');
    }
};