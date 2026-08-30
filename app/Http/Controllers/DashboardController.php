<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengguna;

class DashboardController extends Controller
{
    public function index()
    {
        $isLoggedIn = session()->has('pengguna_id');
        $role = (string) session('pengguna_role', 'pengguna');
        $penggunaId = session('pengguna_id');

        $featuredItems = Barang::query()
            ->where('status', 'tersedia')
            ->latest('id')
            ->take(6)
            ->get();

        $viewData = [
            'featuredItems' => $featuredItems,
            'isLoggedIn' => $isLoggedIn,
            'userName' => session('pengguna_nama'),
            'role' => $role,
        ];

        if (!$isLoggedIn) {
            return view('welcome', $viewData);
        }

        $viewData['myItemsCount'] = Barang::query()
            ->where('pengguna_id', $penggunaId)
            ->count();
        $viewData['myCompleted'] = Barang::query()
            ->where('pengguna_id', $penggunaId)
            ->where('status', 'selesai')
            ->count();
        $viewData['myItems'] = Barang::query()
            ->where('pengguna_id', $penggunaId)
            ->latest('id')
            ->take(3)
            ->get();

        if ($role === 'admin') {
            $viewData['totalBarang'] = Barang::query()->count();
            $viewData['totalSelesai'] = Barang::query()->where('status', 'selesai')->count();
            $viewData['totalTersedia'] = Barang::query()->where('status', 'tersedia')->count();
            $viewData['totalPengguna'] = Pengguna::query()->count();
            $viewData['totalSekolah'] = Pengguna::query()->where('role', 'sekolah')->count();
        }

        return view('dashboard', $viewData);
    }
}