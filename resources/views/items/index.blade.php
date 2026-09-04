@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap items-end justify-between gap-3 mb-6">
        <div><p class="text-xs uppercase tracking-[0.2em] text-blue-600 font-bold">Siklus berbagi</p><h1 class="text-3xl font-bold text-[#0F172A] mt-1">Katalog Barang</h1></div>
        <a href="{{ route('items.create') }}" class="px-4 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition">+ Posting Barang</a>
    </div>

    <form method="GET" action="{{ route('items.index') }}"
        class="bg-white border border-slate-200 rounded-xl p-4 grid sm:grid-cols-3 gap-3 mb-7 shadow-sm">
        <input name="q" value="{{ $search }}" placeholder="Cari nama, deskripsi, lokasi"
            class="rounded-lg border-slate-300 px-4 py-3 sm:col-span-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
        <div class="flex gap-2">
            <select name="kategori" class="rounded-lg border-slate-300 w-full px-3 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                <option value="">Semua kategori</option>
                @foreach ($kategoriOptions as $opt)
                    <option value="{{ $opt }}" @selected($kategori === $opt)>{{ str_replace('_', ' ', $opt) }}</option>
                @endforeach
            </select>
            <button class="px-4 rounded-lg bg-[#0F172A] text-white font-semibold hover:bg-blue-600 transition">Filter</button>
        </div>
    </form>

    @if ($items->isEmpty())
        <div class="bg-white border border-slate-200 rounded-xl p-6 text-slate-600">Belum ada data sesuai filter.</div>
    @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($items as $item)
                <article class="flex flex-col bg-white border border-slate-200 rounded-xl p-3 hover:border-blue-400 hover:shadow-lg transition">
                    <div class="relative"><img src="{{ $item->image_url }}" alt="{{ $item->nama_barang }}" class="w-full h-44 rounded-lg object-cover"><span class="absolute right-2 top-2 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-bold text-blue-700">{{ $item->status }}</span></div>
                    <h2 class="mt-3 font-semibold">{{ $item->nama_barang }}</h2>
                    <a href="{{ route('items.show', $item) }}" class="mt-4 w-full rounded-lg bg-[#0F172A] py-2.5 text-center text-sm font-semibold text-white hover:bg-blue-600 transition">Lihat Detail</a>
                </article>
            @endforeach
        </div>

        <div class="mt-5">{{ $items->links() }}</div>
    @endif
@endsection