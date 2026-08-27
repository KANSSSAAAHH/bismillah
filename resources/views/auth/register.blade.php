@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white border border-slate-200 rounded-2xl p-6">
        <h1 class="text-xl font-bold mb-1">Daftar Akun LOOPIN</h1>
        <p class="text-sm text-slate-600 mb-5">Mulai sirkulasikan perlengkapan sekolahmu.</p>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm font-medium">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    class="mt-1 w-full rounded-lg border-slate-300" required>
                @error('nama')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="mt-1 w-full rounded-lg border-slate-300" required>
                @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">Saya bertindak sebagai</label>
                <select name="role" class="mt-1 w-full rounded-lg border-slate-300">
                    <option value="pengguna" {{ old('role') === 'pengguna' ? 'selected' : '' }}>Siswa / Orang Tua</option>
                    <option value="sekolah" {{ old('role') === 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                </select>
                @error('role')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">Kelas / Unit</label>
                <input type="text" name="kelas" value="{{ old('kelas') }}"
                    class="mt-1 w-full rounded-lg border-slate-300"
                    placeholder="siswa: 10 RPL · sekolah: Nama Unit" required>
                @error('kelas')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">Nomor WhatsApp</label>
                <input type="text" name="nomor_whatsapp" value="{{ old('nomor_whatsapp') }}"
                    class="mt-1 w-full rounded-lg border-slate-300" required>
                @error('nomor_whatsapp')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">Password</label>
                <input type="password" name="password" class="mt-1 w-full rounded-lg border-slate-300" required>
                @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">Ulangi Password</label>
                <input type="password" name="password_confirmation"
                    class="mt-1 w-full rounded-lg border-slate-300" required>
            </div>

            <button type="submit"
                class="w-full py-2.5 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700">
                Daftar
            </button>
        </form>

        <p class="text-sm text-center text-slate-600 mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-emerald-700 font-semibold">Masuk di sini</a>
        </p>
    </div>
@endsection