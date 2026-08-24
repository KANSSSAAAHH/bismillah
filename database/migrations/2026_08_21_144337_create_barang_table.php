<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
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
            $table->string('foto');
            $table->text('deskripsi');
            $table->enum('kondisi', ['baru', 'bekas_layak', 'rusak_ringan']);
            $table->enum('metode', ['donasi', 'harga']);
            $table->unsignedInteger('harga')->nullable();
            $table->string('lokasi');
            $table->enum('status', ['tersedia', 'diminta', 'dipesan', 'selesai'])->default('tersedia');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};