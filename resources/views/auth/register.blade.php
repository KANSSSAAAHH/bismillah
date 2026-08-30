@extends('layouts.auth')

@section('content')
    <div class="max-w-5xl mx-auto grid lg:grid-cols-2 bg-white rounded-2xl overflow-hidden shadow-xl shadow-slate-200/70 border border-slate-200">
        <div class="p-6 sm:p-10 lg:p-12">
            <a href="{{ route('dashboard') }}" class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-blue-600 transition">← Kembali</a>
            <div class="mb-7">
                <p class="text-xs uppercase tracking-[0.22em] text-blue-600 font-bold">Bergabung dalam siklus</p>
            <h1 class="text-3xl font-bold text-[#0F172A] mt-2">Buat akunmu</h1>
            <p class="text-sm text-slate-500 mt-2">Mulai sirkulasikan perlengkapan sekolahmu.</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="text-sm font-semibold text-slate-700">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                @error('nama')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Saya bertindak sebagai</label>
                <select name="role" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                    <option value="pengguna" {{ old('role') === 'pengguna' ? 'selected' : '' }}>Siswa / Orang Tua</option>
                    <option value="sekolah" {{ old('role') === 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                </select>
                @error('role')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-slate-400 mt-1.5">Pilih peran yang paling sesuai dengan aktivitasmu.</p>
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Kelas / Unit</label>
                <input type="text" name="kelas" value="{{ old('kelas') }}"
                    class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    placeholder="siswa: 10 RPL · sekolah: Nama Unit" required>
                @error('kelas')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Nomor WhatsApp</label>
                <input type="text" name="nomor_whatsapp" value="{{ old('nomor_whatsapp') }}"
                    class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                @error('nomor_whatsapp')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Password</label>
                <input type="password" name="password" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Ulangi Password</label>
                <input type="password" name="password_confirmation"
                    class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
            </div>

            <button type="submit"
                class="w-full py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition shadow-lg shadow-blue-600/20">
                Daftar
            </button>
        </form>

        <p class="text-sm text-center text-slate-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:text-blue-500">Masuk di sini</a>
        </p>
        </div>
        <aside class="hidden lg:flex relative overflow-hidden bg-[#0F172A] p-12 text-white items-end">
            <div class="absolute inset-0 opacity-30" style="background-image: linear-gradient(135deg, transparent 30%, #2563EB 30%, #2563EB 31%, transparent 31%), linear-gradient(45deg, transparent 64%, #3B82F6 64%, #3B82F6 65%, transparent 65%); background-size: 42px 42px;"></div>
            <div class="absolute right-12 top-16 h-36 w-36 rounded-full border-[20px] border-blue-500/40"></div>
            <div class="relative">
                <img src="{{ asset('images/loopin2.png') }}" alt="Loopin" class="h-14 w-auto">
                <p class="text-xl font-semibold mt-4 max-w-xs">Satu barang, satu kesempatan baru.</p>
                <p class="text-sm text-slate-300 mt-3 max-w-sm">Bangun budaya berbagi yang lebih dekat, praktis, dan berdampak di sekolah.</p>
            </div>
        </aside>
    </div>
@endsection