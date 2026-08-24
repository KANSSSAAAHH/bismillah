<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');
            $table->enum('tipe', [
                'permintaan_baru',
                'permintaan_disetujui',
                'jadwal_dibuat',
                'pengingat_temu',
                'transaksi_selesai'
            ]);
            $table->string('judul');
            $table->text('pesan');
            $table->foreignId('barang_id')->nullable()->constrained('barang')->onDelete('cascade');
            $table->foreignId('transaksi_id')->nullable()->constrained('transaksi')->onDelete('cascade');
            $table->boolean('sudah_dibaca')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};