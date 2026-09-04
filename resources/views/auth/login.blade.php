@extends('layouts.auth')

@section('content')
    <div class="max-w-5xl mx-auto grid lg:grid-cols-2 bg-white rounded-2xl overflow-hidden shadow-xl shadow-slate-200/70 border border-slate-200">
        <div class="p-6 sm:p-10 lg:p-12">
            <a href="{{ route('dashboard') }}" class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-blue-600 transition">← Kembali</a>
            <div class="mb-8">
                <p class="text-xs uppercase tracking-[0.22em] text-blue-600 font-bold">Selamat datang kembali</p>
                <h1 class="text-3xl font-bold text-[#0F172A] mt-2">Masuk ke akunmu</h1>
                <p class="text-sm text-slate-500 mt-2">Gunakan akun yang sudah terdaftar untuk melanjutkan sirkulasi.</p>
            </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="text-sm font-semibold text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    required>
                @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Password</label>
                <input type="password" name="password" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit"
                class="w-full py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition shadow-lg shadow-blue-600/20">
                Masuk
            </button>
        </form>

        <p class="text-sm text-center text-slate-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:text-blue-500">Daftar di sini</a>
        </p>
        </div>
        <aside class="hidden lg:flex relative overflow-hidden bg-[#0F172A] p-12 text-white items-end">
            <div class="absolute inset-0 opacity-30" style="background-image: linear-gradient(135deg, transparent 30%, #2563EB 30%, #2563EB 31%, transparent 31%), linear-gradient(45deg, transparent 64%, #3B82F6 64%, #3B82F6 65%, transparent 65%); background-size: 42px 42px;"></div>
            <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full border-[32px] border-blue-600/30"></div>
            <div class="relative">
                <img src="{{ asset('Images/loopin2.png') }}" alt="Loopin" class="h-14 w-auto">
                <p class="text-xl font-semibold mt-4 max-w-xs">Barang berputar, kesempatan belajar terus tumbuh.</p>
                <p class="text-sm text-slate-300 mt-3 max-w-sm">Temukan perlengkapan sekolah layak pakai dari teman-teman di komunitasmu.</p>
            </div>
        </aside>
    </div>
@endsection