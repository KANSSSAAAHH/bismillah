<?php

namespace App\Services;

use App\Models\Notifikasi;
use Illuminate\Support\Collection;

class NotifikasiService
{
    public function buat(
        int $penggunaId,
        string $tipe,
        string $judul,
        string $pesan,
        ?int $barangId = null,
        ?int $transaksiId = null,
    ): Notifikasi {
        return Notifikasi::query()->create([
            'pengguna_id' => $penggunaId,
            'tipe' => $tipe,
            'judul' => $judul,
            'pesan' => $pesan,
            'barang_id' => $barangId,
            'transaksi_id' => $transaksiId,
            'sudah_dibaca' => false,
        ]);
    }

    public function unreadCount(int $penggunaId): int
    {
        return Notifikasi::query()
            ->where('pengguna_id', $penggunaId)
            ->where('sudah_dibaca', false)
            ->count();
    }

    public function list(int $penggunaId, int $take = 20): Collection
    {
        return Notifikasi::query()
            ->where('pengguna_id', $penggunaId)
            ->latest('id')
            ->take($take)
            ->get();
    }

    public function markAllRead(int $penggunaId): int
    {
        return Notifikasi::query()
            ->where('pengguna_id', $penggunaId)
            ->where('sudah_dibaca', false)
            ->update(['sudah_dibaca' => true]);
    }
}