@extends('layouts.app')

@section('content')
    <section class="bg-gradient-to-r from-emerald-700 to-cyan-700 text-white rounded-2xl p-6 sm:p-10 mb-6">
        <p class="text-xs uppercase tracking-[0.2em] text-emerald-100">Keep It in Circulation</p>
        <h1 class="text-2xl sm:text-4xl font-black mt-2">Sirkulasikan perlengkapan sekolah, bantu sesama siswa.</h1>
        <p class="mt-3 text-emerald-50 max-w-2xl">
            LOOPIN memfasilitasi donasi dan distribusi barang sekolah layak pakai agar akses belajar lebih merata dan limbah
            sekolah berkurang.
        </p>
        <div class="mt-5 flex flex-wrap gap-3">
            <a href="{{ route('items.index') }}" class="px-4 py-2 rounded bg-white text-emerald-700 font-semibold">Lihat
                Katalog</a>
            @if ($isLoggedIn)
                <a href="{{ route('items.create') }}"
                    class="px-4 py-2 rounded bg-emerald-900/50 border border-emerald-200/30">Posting Barang</a>
            @else
                <a href="{{ route('register') }}"
                    class="px-4 py-2 rounded bg-emerald-900/50 border border-emerald-200/30">Daftar & Mulai</a>
            @endif
        </div>
    </section>

    @if ($isLoggedIn)
        {{-- Role: Siswa / Orang Tua (pengguna) --}}
        @if ($role === 'pengguna')
            <section class="grid sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <p class="text-sm text-slate-500">Barang kamu</p>
                    <p class="text-3xl font-black mt-1">{{ $myItemsCount }}</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <p class="text-sm text-slate-500">Sudah selesai</p>
                    <p class="text-3xl font-black mt-1 text-emerald-600">{{ $myCompleted }}</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-xl p-5 flex flex-col justify-center">
                    <a href="{{ route('items.create') }}" class="text-emerald-700 font-semibold">+ Posting barang baru</a>
                </div>
            </section>

            @if (isset($myItems) && $myItems->isNotEmpty())
                <section class="mb-6">
                    <h2 class="text-lg font-bold mb-3">Barang Terakhir Kamu</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($myItems as $item)
                            <article class="bg-white border border-slate-200 rounded-xl p-4">
                                <img src="{{ $item->foto }}" alt="{{ $item->nama_barang }}"
                                    class="w-full h-36 object-cover rounded-lg">
                                <h3 class="font-semibold mt-3">{{ $item->nama_barang }}</h3>
                                <p class="text-sm text-slate-600 mt-1">Status: {{ $item->status }}</p>
                                <a href="{{ route('items.show', $item) }}"
                                    class="inline-block mt-3 text-sm text-emerald-700 font-semibold">Lihat detail</a>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        @endif

        {{-- Role: SEKOLAH --}}
        @if ($role === 'sekolah')
            <section class="bg-white border border-slate-200 rounded-xl p-5 mb-6">
                <h2 class="font-bold text-lg">Halo, {{ $userName }}</h2>
                <p class="text-sm text-slate-600 mt-1">Kelola sirkulasi perlengkapan sekolahmu dari halaman permintaan dan
                    katalog.</p>
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('requests.index') }}"
                        class="px-4 py-2 rounded bg-emerald-600 text-white font-semibold">Kelola Permintaan</a>
                    <a href="{{ route('items.create') }}"
                        class="px-4 py-2 rounded bg-slate-900 text-white font-semibold">Posting Barang</a>
                </div>
            </section>
        @endif

        {{-- Role: ADMIN --}}
        @if ($role === 'admin')
            <section class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <p class="text-sm text-slate-500">Total Barang</p>
                    <p class="text-3xl font-black mt-1">{{ $totalBarang }}</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <p class="text-sm text-slate-500">Tersedia</p>
                    <p class="text-3xl font-black mt-1 text-emerald-600">{{ $totalTersedia }}</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <p class="text-sm text-slate-500">Selesai</p>
                    <p class="text-3xl font-black mt-1 text-emerald-600">{{ $totalSelesai }}</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-xl p-5">
                    <p class="text-sm text-slate-500">Pengguna terdaftar</p>
                    <p class="text-3xl font-black mt-1">{{ $totalPengguna }}</p>
                </div>
            </section>
        @endif
    @else
        <section class="bg-white border border-slate-200 rounded-xl p-5 mb-6">
            <h2 class="font-bold text-lg">Bergabung untuk mulai berbagi</h2>
            <p class="text-sm text-slate-600 mt-1">Daftar gratis untuk memposting barang donasi/barter atau mengajukan
                permintaan perlengkapan sekolah.</p>
            <div class="mt-3 flex gap-2">
                <a href="{{ route('register') }}"
                    class="px-4 py-2 rounded bg-emerald-600 text-white font-semibold">Daftar Sekarang</a>
                <a href="{{ route('login') }}" class="px-4 py-2 rounded bg-slate-100 font-semibold">Masuk</a>
            </div>
        </section>
    @endif

    <section>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-bold">Barang Tersedia Terbaru</h2>
            @if ($isLoggedIn)
                <p class="text-sm text-slate-600">Masuk sebagai: {{ $userName }}</p>
            @endif
        </div>

        @if ($featuredItems->isEmpty())
            <div class="bg-white border border-slate-200 rounded-xl p-5 text-slate-600">
                Belum ada barang yang diposting.
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($featuredItems as $item)
                    <article class="bg-white border border-slate-200 rounded-xl p-4">
                        <img src="{{ $item->foto }}" alt="{{ $item->nama_barang }}" class="w-full h-40 object-cover rounded-lg">
                        <h3 class="font-semibold mt-3">{{ $item->nama_barang }}</h3>
                        <p class="text-sm text-slate-600 mt-1">{{ str_replace('_', ' ', $item->kategori) }}</p>
                        <a href="{{ route('items.show', $item) }}"
                            class="inline-block mt-3 text-sm text-emerald-700 font-semibold">Lihat detail</a>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection