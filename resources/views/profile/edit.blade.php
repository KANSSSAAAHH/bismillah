@extends('layouts.app')

@section('content')
    <div class="mb-6"><p class="text-xs uppercase tracking-[0.2em] text-blue-600 font-bold">Akun kamu</p><h1 class="text-3xl font-bold text-[#0F172A] mt-1">Profil Pengguna</h1></div>

    @if (!$pengguna)
        <div class="bg-white border border-slate-200 rounded-xl p-6 text-slate-600">
            Anda belum login. Silakan masuk untuk mengelola profil.
        </div>
    @else
        <form action="{{ route('profile.update') }}" method="POST"
            class="bg-white border border-slate-200 rounded-xl p-5 sm:p-7 grid sm:grid-cols-2 gap-5 shadow-sm">
            @csrf

            <div>
                <label class="text-sm font-semibold text-slate-700">Nama</label>
                <input name="nama" value="{{ old('nama', $pengguna->nama) }}" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    required>
                @error('nama')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Kelas</label>
                <input name="kelas" value="{{ old('kelas', $pengguna->kelas) }}" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    required>
                @error('kelas')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Nomor WhatsApp</label>
                <input name="nomor_whatsapp" value="{{ old('nomor_whatsapp', $pengguna->nomor_whatsapp) }}"
                    class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                @error('nomor_whatsapp')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">URL Foto Profil</label>
                <input name="foto" value="{{ old('foto', $pengguna->foto) }}" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                @error('foto')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-2">
                <button class="px-5 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition">Simpan Profil</button>
            </div>
        </form>
    @endif
@endsection