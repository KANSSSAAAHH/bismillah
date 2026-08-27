<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class ImpactController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::query()->count();
        $totalSelesai = Barang::query()->where('status', 'selesai')->count();
        $totalTersedia = Barang::query()->where('status', 'tersedia')->count();

        return view('impact.index', [
            'totalBarang' => $totalBarang,
            'totalSelesai' => $totalSelesai,
            'totalTersedia' => $totalTersedia,
        ]);
    }
}
