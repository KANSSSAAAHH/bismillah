<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->foreignId('penerima_id')->constrained('pengguna')->onDelete('cascade');
            $table->foreignId('pemilik_id')->constrained('pengguna')->onDelete('cascade');
            $table->text('pesan')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'dijadwalkan', 'selesai'])->default('menunggu');
            $table->string('lokasi_temu')->nullable();
            $table->dateTime('waktu_temu')->nullable();
            $table->boolean('notifikasi_terkirim')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};