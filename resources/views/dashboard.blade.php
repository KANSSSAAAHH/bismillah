@extends('layouts.app')

@section('content')
    {{-- HERO --}}
    <section class="bg-[#0F172A] text-white rounded-2xl p-6 sm:p-10 mb-10 relative overflow-hidden shadow-xl shadow-slate-900/10">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl"></div>
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-blue-500/10 rounded-full blur-2xl"></div>

        <div class="relative">
            <img src="{{ asset('Images/loopin2.png') }}" alt="Loopin" class="h-10 mb-5">

            <p class="text-xs uppercase tracking-[0.25em] text-blue-400 font-semibold">Keep It in Circulation</p>
            <h1 class="text-3xl sm:text-5xl font-bold mt-3 leading-tight max-w-3xl">
                Sirkulasikan perlengkapan sekolah, bantu sesama siswa.
            </h1>
            <p class="mt-3 text-slate-300 max-w-2xl">
                LOOPIN memfasilitasi donasi dan distribusi barang sekolah layak pakai agar akses belajar lebih merata
                dan limbah sekolah berkurang.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('items.index') }}"
                    class="px-5 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition shadow-lg shadow-blue-900/30">
                    Lihat Katalog
                </a>
                <a href="{{ route('items.create') }}"
                    class="px-5 py-3 rounded-lg border border-slate-600 text-slate-200 font-semibold hover:border-blue-400 hover:text-white transition">
                    Posting Barang
                </a>
            </div>
        </div>
    </section>

    {{-- Role: Siswa / Orang Tua (pengguna) --}}
    @if ($role === 'pengguna')
        <section class="grid sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <p class="text-sm text-slate-500">Barang kamu</p>
                <p class="text-3xl font-black mt-1 text-slate-900">{{ $myItemsCount }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <p class="text-sm text-slate-500">Sudah selesai</p>
                <p class="text-3xl font-black mt-1 text-blue-600">{{ $myCompleted }}</p>
            </div>
            <div class="bg-slate-900 rounded-xl p-5 flex flex-col justify-center">
                <a href="{{ route('items.create') }}" class="text-blue-400 font-semibold hover:text-blue-300">
                    + Posting barang baru
                </a>
            </div>
        </section>

        @if (isset($myItems) && $myItems->isNotEmpty())
            <section class="mb-8">
                <h2 class="text-lg font-bold mb-3 text-slate-900">Barang Terakhir Kamu</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ($myItems as $item)
                        <article class="bg-white border border-slate-200 rounded-xl p-4 hover:border-blue-400 transition">
                            <img src="{{ $item->image_url }}" alt="{{ $item->nama_barang }}"
                                class="w-full h-36 object-cover rounded-lg">
                            <h3 class="font-semibold mt-3 text-slate-900">{{ $item->nama_barang }}</h3>
                            <span class="inline-flex mt-2 px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">{{ $item->status }}</span>
                            <a href="{{ route('items.show', $item) }}"
                                class="inline-block mt-3 text-sm text-blue-600 font-semibold hover:text-blue-800">
                                Lihat detail
                            </a>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    @endif

    {{-- Role: SEKOLAH --}}
    @if ($role === 'sekolah')
        <section class="bg-slate-900 text-white rounded-xl p-6 mb-8">
            <h2 class="font-bold text-lg">Halo, {{ $userName }}</h2>
            <p class="text-sm text-slate-300 mt-1">
                Kelola sirkulasi perlengkapan sekolahmu dari halaman permintaan dan katalog.
            </p>
            <div class="mt-4 flex gap-2">
                <a href="{{ route('requests.index') }}"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition">
                    Kelola Permintaan
                </a>
                <a href="{{ route('items.create') }}"
                    class="px-4 py-2 rounded-lg border border-slate-600 text-slate-200 hover:border-blue-500 transition">
                    Posting Barang
                </a>
            </div>
        </section>
    @endif

    {{-- Role: ADMIN --}}
    @if ($role === 'admin')
        <section class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Barang</p>
                <p class="text-3xl font-black mt-1 text-slate-900">{{ $totalBarang }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <p class="text-sm text-slate-500">Tersedia</p>
                <p class="text-3xl font-black mt-1 text-blue-600">{{ $totalTersedia }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <p class="text-sm text-slate-500">Selesai</p>
                <p class="text-3xl font-black mt-1 text-blue-600">{{ $totalSelesai }}</p>
            </div>
            <div class="bg-slate-900 rounded-xl p-5">
                <p class="text-sm text-slate-400">Pengguna terdaftar</p>
                <p class="text-3xl font-black mt-1 text-white">{{ $totalPengguna }}</p>
            </div>
        </section>
    @endif

    {{-- KATEGORI BARANG YANG TERSEDIA --}}
    <section class="mb-8">
        <h2 class="text-lg font-bold mb-3 text-slate-900">Kategori Barang</h2>
        <div class="flex flex-wrap gap-2">
            @foreach ([
                'Seragam Kekecilan', 'Seragam Kegiatan', 'Sepatu Sekolah', 'Tas',
                'Buku Referensi', 'Modul/Paper Book', 'Kalkulator', 'Flashdisk', 'Mouse',
                'Keyboard', 'Kabel', 'Adaptor', 'Headset', 'Perangkat Elektronik Sederhana',
                'Perlengkapan Praktik',
            ] as $kategori)
                <span
                    class="px-3 py-1.5 rounded-full bg-white border border-slate-200 text-sm text-slate-700 hover:bg-blue-50 hover:border-blue-300 hover:text-blue-700 transition cursor-default shadow-sm">
                    {{ $kategori }}
                </span>
            @endforeach
        </div>
    </section>

    {{-- BARANG TERSEDIA TERBARU --}}
    <section>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-bold text-slate-900">Barang Tersedia Terbaru</h2>
            <p class="text-sm text-slate-500">Masuk sebagai: <span class="text-slate-900 font-medium">{{ $userName }}</span></p>
        </div>

        @if ($featuredItems->isEmpty())
            <div class="bg-white border border-dashed border-slate-300 rounded-xl p-8 text-center text-slate-500">
                Belum ada barang yang diposting.
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($featuredItems as $item)
                    <article class="flex flex-col bg-white border border-slate-200 rounded-xl p-3 hover:border-blue-400 hover:shadow-md transition">
                        <div class="relative"><img src="{{ $item->image_url }}" alt="{{ $item->nama_barang }}" class="w-full h-40 object-cover rounded-lg"><span class="absolute right-2 top-2 rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-700">Tersedia</span></div>
                        <h3 class="font-semibold mt-3 text-slate-900">{{ $item->nama_barang }}</h3>
                        <a href="{{ route('items.show', $item) }}" class="mt-4 w-full rounded-lg bg-[#0F172A] py-2 text-center text-sm font-semibold text-white hover:bg-blue-600 transition">Lihat Detail</a>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection