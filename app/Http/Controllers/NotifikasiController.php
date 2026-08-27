<?php

namespace App\Http\Controllers;

use App\Services\NotifikasiService;

class NotifikasiController extends Controller
{
    public function __construct(private NotifikasiService $service)
    {
    }

    public function index()
    {
        $penggunaId = (int) session('pengguna_id');

        return view('notifications.index', [
            'notifications' => $this->service->list($penggunaId),
        ]);
    }

    public function bacaSemua()
    {
        $this->service->markAllRead((int) session('pengguna_id'));

        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}