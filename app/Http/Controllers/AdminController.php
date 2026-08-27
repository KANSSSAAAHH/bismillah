<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        // Statistik Barang
        $totalBarang = Barang::query()->count();
        $tersedia = Barang::query()->where('status', 'tersedia')->count();
        $diminta = Barang::query()->where('status', 'diminta')->count();
        $dipesan = Barang::query()->where('status', 'dipesan')->count();
        $selesai = Barang::query()->where('status', 'selesai')->count();

        // Statistik Pengguna
        $totalPengguna = Pengguna::query()->count();
        $totalSiswa = Pengguna::query()->where('role', 'pengguna')->count();
        $totalSekolah = Pengguna::query()->where('role', 'sekolah')->count();
        $totalAdmin = Pengguna::query()->where('role', 'admin')->count();

        // Statistik Transaksi & Permintaan
        $permintaanAktif = DB::table('permintaan_barang')->where('status', 'aktif')->count();
        $transaksiMenunggu = DB::table('transaksi')->where('status', 'menunggu')->count();

        $recentItems = Barang::query()
            ->with('pengguna')
            ->latest('id')
            ->take(5)
            ->get();

        $recentUsers = Pengguna::query()
            ->latest('id')
            ->take(5)
            ->get();

        return view('admin.index', [
            'totalBarang' => $totalBarang,
            'tersedia' => $tersedia,
            'diminta' => $diminta,
            'dipesan' => $dipesan,
            'selesai' => $selesai,
            'totalPengguna' => $totalPengguna,
            'totalSiswa' => $totalSiswa,
            'totalSekolah' => $totalSekolah,
            'totalAdmin' => $totalAdmin,
            'permintaanAktif' => $permintaanAktif,
            'transaksiMenunggu' => $transaksiMenunggu,
            'recentItems' => $recentItems,
            'recentUsers' => $recentUsers,
        ]);
    }

    public function users()
    {
        $users = Pengguna::query()
            ->with('barang')
            ->latest('id')
            ->paginate(15);

        return view('admin.users', [
            'users' => $users,
            'roles' => Pengguna::ROLES,
        ]);
    }

    public function updateRole(Request $request, Pengguna $pengguna)
    {
        if ((int) $pengguna->id === (int) session('pengguna_id')) {
            return back()->with('error', 'Anda tidak dapat mengubah role akun sendiri.');
        }

        $validated = $request->validate([
            'role' => ['required', Rule::in(array_keys(Pengguna::ROLES))],
        ]);

        $pengguna->update(['role' => $validated['role']]);

        return back()->with('success', "Role {$pengguna->nama} berhasil diperbarui.");
    }

    public function items()
    {
        $items = Barang::query()
            ->with('pengguna')
            ->latest('id')
            ->paginate(15);

        return view('admin.items', [
            'items' => $items,
            'statusOptions' => Barang::STATUS,
        ]);
    }

    public function destroyItem(Barang $barang)
    {
        $barang->delete();

        return back()->with('success', 'Barang berhasil dihapus admin.');
    }

    public function requests()
    {
        $lists = DB::table('permintaan_barang')
            ->leftJoin('pengguna', 'pengguna.id', '=', 'permintaan_barang.pengguna_id')
            ->select(
                'permintaan_barang.*',
                'pengguna.nama as pengguna_nama',
                'pengguna.email as pengguna_email'
            )
            ->orderByDesc('permintaan_barang.id')
            ->paginate(15);

        $transaksi = DB::table('transaksi')
            ->join('barang', 'barang.id', '=', 'transaksi.barang_id')
            ->leftJoin('pengguna as penerima', 'penerima.id', '=', 'transaksi.penerima_id')
            ->leftJoin('pengguna as pemilik', 'pemilik.id', '=', 'transaksi.pemilik_id')
            ->select(
                'transaksi.*',
                'barang.nama_barang as barang_nama',
                'penerima.nama as penerima_nama',
                'pemilik.nama as pemilik_nama'
            )
            ->orderByDesc('transaksi.id')
            ->paginate(15);

        return view('admin.requests', [
            'lists' => $lists,
            'transaksi' => $transaksi,
        ]);
    }
}