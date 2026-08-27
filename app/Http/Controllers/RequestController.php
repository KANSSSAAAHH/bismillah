<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PermintaanBarang;
use App\Models\Transaksi;
use App\Services\AuthorizedRoles;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RequestController extends Controller
{
    use AuthorizedRoles;

    public function index()
    {
        $penggunaId = (int) session('pengguna_id');

        $incoming = Transaksi::query()
            ->with(['barang', 'penerima'])
            ->where('pemilik_id', $penggunaId)
            ->whereIn('status', ['menunggu', 'disetujui', 'dijadwalkan'])
            ->latest('id')
            ->get();

        $outgoing = Transaksi::query()
            ->with(['barang', 'pemilik'])
            ->where('penerima_id', $penggunaId)
            ->latest('id')
            ->get();

        $wishlists = PermintaanBarang::query()
            ->with('pengguna')
            ->where('status', 'aktif')
            ->latest('id')
            ->take(10)
            ->get();

        $myWishlists = PermintaanBarang::query()
            ->where('pengguna_id', $penggunaId)
            ->latest('id')
            ->get();

        return view('requests.index', [
            'incoming' => $incoming,
            'outgoing' => $outgoing,
            'wishlists' => $wishlists,
            'myWishlists' => $myWishlists,
            'kategoriOptions' => Barang::KATEGORI,
        ]);
    }

    public function simpan(Request $request)
    {
        $penggunaId = (int) session('pengguna_id');

        $validated = $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori' => ['required', Rule::in(Barang::KATEGORI)],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
        ]);

        PermintaanBarang::query()->create([
            'pengguna_id' => $penggunaId,
            'nama_barang' => $validated['nama_barang'],
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'status' => 'aktif',
        ]);

        return back()->with('success', 'Permintaan barang ditambahkan.');
    }

    public function tutup(PermintaanBarang $permintaan)
    {
        $this->ensureOwner($permintaan->pengguna_id, (int) session('pengguna_id'), 'Anda hanya dapat menutup permintaan milik sendiri.');
        $permintaan->update(['status' => 'ditutup']);

        return back()->with('success', 'Permintaan ditutup.');
    }
}
