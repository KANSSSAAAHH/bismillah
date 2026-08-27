<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $pengguna = Pengguna::query()
            ->where('email', $credentials['email'])
            ->first();

        if (!$pengguna) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.'])->withInput();
        }

        $passwordOk = Hash::check($credentials['password'], $pengguna->password)
            || hash_equals($pengguna->password, $credentials['password']);

        if (!$passwordOk) {
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }

        $request->session()->regenerate();
        $this->putSession($pengguna);

        return redirect()->route('dashboard')->with('success', 'Login berhasil.');
    }

    public function showRegister()
    {
        return view('auth.register', [
            'roles' => Pengguna::REGISTERABLE_ROLES,
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('pengguna', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['nullable', Rule::in(Pengguna::REGISTERABLE_ROLES)],
            'kelas' => ['required', 'string', 'max:100'],
            'nomor_whatsapp' => ['required', 'string', 'max:30'],
        ]);

        $validated['role'] = $validated['role'] ?? 'pengguna';
        $validated['password'] = Hash::make($validated['password']);

        $pengguna = Pengguna::query()->create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'kelas' => $validated['kelas'],
            'nomor_whatsapp' => $validated['nomor_whatsapp'],
        ]);

        $request->session()->regenerate();
        $this->putSession($pengguna);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil. Selamat datang di LOOPIN!');
    }

    public function logout()
    {
        session()->forget(['pengguna_id', 'pengguna_nama', 'pengguna_role']);

        return redirect()->route('dashboard')->with('success', 'Anda sudah logout.');
    }

    private function putSession(Pengguna $pengguna): void
    {
        session([
            'pengguna_id' => $pengguna->id,
            'pengguna_nama' => $pengguna->nama,
            'pengguna_role' => $pengguna->role ?? 'pengguna',
        ]);
    }
}
