@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Profil Pengguna</h1>

    @if (!$pengguna)
        <div class="bg-white border border-slate-200 rounded-xl p-6 text-slate-600">
            Anda belum login. Silakan masuk untuk mengelola profil.
        </div>
    @else
        <form action="{{ route('profile.update') }}" method="POST"
            class="bg-white border border-slate-200 rounded-xl p-5 grid sm:grid-cols-2 gap-4">
            @csrf

            <div>
                <label class="text-sm font-medium">Nama</label>
                <input name="nama" value="{{ old('nama', $pengguna->nama) }}" class="mt-1 w-full rounded-lg border-slate-300"
                    required>
                @error('nama')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">Kelas</label>
                <input name="kelas" value="{{ old('kelas', $pengguna->kelas) }}" class="mt-1 w-full rounded-lg border-slate-300"
                    required>
                @error('kelas')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">Nomor WhatsApp</label>
                <input name="nomor_whatsapp" value="{{ old('nomor_whatsapp', $pengguna->nomor_whatsapp) }}"
                    class="mt-1 w-full rounded-lg border-slate-300" required>
                @error('nomor_whatsapp')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">URL Foto Profil</label>
                <input name="foto" value="{{ old('foto', $pengguna->foto) }}" class="mt-1 w-full rounded-lg border-slate-300">
                @error('foto')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-2">
                <button class="px-4 py-2 rounded-lg bg-emerald-600 text-white">Simpan Profil</button>
            </div>
        </form>
    @endif
@endsection