<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE notifikasi MODIFY COLUMN tipe ENUM('permintaan_baru','permintaan_disetujui','permintaan_ditolak','jadwal_dibuat','pengingat_temu','transaksi_selesai') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE notifikasi MODIFY COLUMN tipe ENUM('permintaan_baru','permintaan_disetujui','jadwal_dibuat','pengingat_temu','transaksi_selesai') NOT NULL");
    }
};