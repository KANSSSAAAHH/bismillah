<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Services\AuthorizedRoles;
use App\Services\TransaksiService;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    use AuthorizedRoles;

    public function __construct(private TransaksiService $service)
    {
    }

    public function minta(Request $request, Barang $barang)
    {
        $penerimaId = (int) session('pengguna_id');
        $data = $request->validate([
            'pesan' => ['nullable', 'string', 'max:2000'],
        ]);

        try {
            $this->service->buatPermintaan($penerimaId, $barang, $data);
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Permintaan terkirim ke pemilik. Pantau lewat menu Permintaan.');
    }

    public function setujui(Transaksi $transaksi)
    {
        $this->ensureOwner($transaksi->pemilik_id, (int) session('pengguna_id'));
        $this->service->setujui($transaksi);

        return back()->with('success', 'Permintaan disetujui.');
    }

    public function tolak(Transaksi $transaksi)
    {
        $this->ensureOwner($transaksi->pemilik_id, (int) session('pengguna_id'));
        $this->service->tolak($transaksi);

        return back()->with('success', 'Permintaan ditolak.');
    }

    public function jadwalkan(Request $request, Transaksi $transaksi)
    {
        $this->ensureOwner($transaksi->pemilik_id, (int) session('pengguna_id'));

        $data = $request->validate([
            'lokasi_temu' => ['required', 'string', 'max:255'],
            'waktu_temu' => ['required', 'date', 'after:now'],
        ]);

        $this->service->jadwalkan($transaksi, $data['lokasi_temu'], $data['waktu_temu']);

        return back()->with('success', 'Jadwal temu dibuat.');
    }

    public function selesai(Transaksi $transaksi)
    {
        $this->ensureOwner($transaksi->pemilik_id, (int) session('pengguna_id'));
        $this->service->selesai($transaksi);

        return back()->with('success', 'Transaksi ditandai selesai.');
    }
}