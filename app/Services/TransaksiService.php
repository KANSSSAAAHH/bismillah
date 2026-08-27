<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

/**
 * Service untuk seluruh alur permintaan & transaksi barang.
 * Semua perubahan status item + notifikasi dibungkus dalam transaksi DB (atomik).
 */
class TransaksiService
{
    public function __construct(private NotifikasiService $notifikasi)
    {
    }

    /**
     * Penerima mengajukan permintaan atas sebuah barang.
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \RuntimeException
     */
    public function buatPermintaan(int $penerimaId, Barang $barang, array $data): Transaksi
    {
        if ($barang->pengguna_id === $penerimaId) {
            throw new \RuntimeException('Anda tidak dapat meminta barang milik sendiri.');
        }

        if ($barang->status !== 'tersedia') {
            throw new \RuntimeException('Barang ini sedang tidak tersedia untuk diminta.');
        }

        return DB::transaction(function () use ($penerimaId, $barang, $data) {
            $transaksi = Transaksi::query()->create([
                'barang_id' => $barang->id,
                'penerima_id' => $penerimaId,
                'pemilik_id' => $barang->pengguna_id,
                'pesan' => $data['pesan'] ?? null,
                'status' => 'menunggu',
                'notifikasi_terkirim' => false,
            ]);

            $barang->update(['status' => 'diminta']);

            $this->notifikasi->buat(
                penggunaId: $barang->pengguna_id,
                tipe: 'permintaan_baru',
                judul: 'Ada permintaan barang baru',
                pesan: "Barang \"{$barang->nama_barang}\" baru saja diminta oleh pengguna.",
                barangId: $barang->id,
                transaksiId: $transaksi->id,
            );

            return $transaksi;
        });
    }

    public function setujui(Transaksi $transaksi): Transaksi
    {
        return DB::transaction(function () use ($transaksi) {
            $transaksi->update(['status' => 'disetujui', 'notifikasi_terkirim' => true]);
            $transaksi->barang()->update(['status' => 'dipesan']);

            $this->notifikasi->buat(
                penggunaId: $transaksi->penerima_id,
                tipe: 'permintaan_disetujui',
                judul: 'Permintaan disetujui',
                pesan: "Permintaan barang \"{$transaksi->barang->nama_barang}\" disetujui oleh pemilik.",
                barangId: $transaksi->barang_id,
                transaksiId: $transaksi->id,
            );

            return $transaksi;
        });
    }

    public function tolak(Transaksi $transaksi): Transaksi
    {
        return DB::transaction(function () use ($transaksi) {
            $transaksi->update(['status' => 'ditolak']);
            $transaksi->barang()->update(['status' => 'tersedia']);

            $this->notifikasi->buat(
                penggunaId: $transaksi->penerima_id,
                tipe: 'permintaan_ditolak',
                judul: 'Permintaan ditolak',
                pesan: "Permintaan barang \"{$transaksi->barang->nama_barang}\" tidak dapat diproses.",
                barangId: $transaksi->barang_id,
                transaksiId: $transaksi->id,
            );

            return $transaksi;
        });
    }

    public function jadwalkan(Transaksi $transaksi, string $lokasi, string $waktu): Transaksi
    {
        return DB::transaction(function () use ($transaksi, $lokasi, $waktu) {
            $transaksi->update([
                'status' => 'dijadwalkan',
                'lokasi_temu' => $lokasi,
                'waktu_temu' => $waktu,
            ]);

            $this->notifikasi->buat(
                penggunaId: $transaksi->penerima_id,
                tipe: 'jadwal_dibuat',
                judul: 'Jadwal temu dibuat',
                pesan: "Temu untuk \"{$transaksi->barang->nama_barang}\" dijadwalkan di {$lokasi}.",
                barangId: $transaksi->barang_id,
                transaksiId: $transaksi->id,
            );

            return $transaksi;
        });
    }

    public function selesai(Transaksi $transaksi): Transaksi
    {
        return DB::transaction(function () use ($transaksi) {
            $transaksi->update(['status' => 'selesai']);
            $transaksi->barang()->update(['status' => 'selesai']);

            $this->notifikasi->buat(
                penggunaId: $transaksi->penerima_id,
                tipe: 'transaksi_selesai',
                judul: 'Transaksi selesai',
                pesan: "Barang \"{$transaksi->barang->nama_barang}\" berhasil diterima. Terima kasih telah berbagi!",
                barangId: $transaksi->barang_id,
                transaksiId: $transaksi->id,
            );

            return $transaksi;
        });
    }
}