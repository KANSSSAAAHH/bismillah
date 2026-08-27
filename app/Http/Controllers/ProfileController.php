<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $pengguna = $this->currentPengguna();

        return view('profile.edit', [
            'pengguna' => $pengguna,
        ]);
    }

    public function update(Request $request)
    {
        $pengguna = $this->currentPengguna();

        if (!$pengguna) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:100'],
            'nomor_whatsapp' => ['required', 'string', 'max:30'],
            'foto' => ['nullable', 'string', 'max:255'],
        ]);

        $pengguna->update($validated);

        session(['pengguna_nama' => $pengguna->nama]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    private function currentPengguna(): ?Pengguna
    {
        $id = session('pengguna_id');

        if (!$id) {
            return null;
        }

        return Pengguna::query()->find($id);
    }
}
