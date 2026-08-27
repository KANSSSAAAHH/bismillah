@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
        <h1 class="text-2xl font-bold">Katalog Barang</h1>
        <a href="{{ route('items.create') }}" class="px-4 py-2 rounded-lg bg-emerald-600 text-white">+ Posting Barang</a>
    </div>

    <form method="GET" action="{{ route('items.index') }}"
        class="bg-white border border-slate-200 rounded-xl p-4 grid sm:grid-cols-3 gap-3 mb-5">
        <input name="q" value="{{ $search }}" placeholder="Cari nama, deskripsi, lokasi"
            class="rounded-lg border-slate-300 sm:col-span-2">
        <div class="flex gap-2">
            <select name="kategori" class="rounded-lg border-slate-300 w-full">
                <option value="">Semua kategori</option>
                @foreach ($kategoriOptions as $opt)
                    <option value="{{ $opt }}" @selected($kategori === $opt)>{{ str_replace('_', ' ', $opt) }}</option>
                @endforeach
            </select>
            <button class="px-4 rounded-lg bg-slate-900 text-white">Filter</button>
        </div>
    </form>

    @if ($items->isEmpty())
        <div class="bg-white border border-slate-200 rounded-xl p-6 text-slate-600">Belum ada data sesuai filter.</div>
    @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($items as $item)
                <article class="bg-white border border-slate-200 rounded-xl p-4">
                    <img src="{{ $item->foto }}" alt="{{ $item->nama_barang }}" class="w-full h-40 rounded-lg object-cover">
                    <h2 class="mt-3 font-semibold">{{ $item->nama_barang }}</h2>
                    <p class="text-sm text-slate-500">{{ str_replace('_', ' ', $item->kategori) }}</p>
                    <p class="text-sm mt-2 line-clamp-2">{{ $item->deskripsi }}</p>
                    <div class="mt-3 flex items-center justify-between text-sm">
                        <span class="px-2 py-1 rounded bg-slate-100">{{ $item->status }}</span>
                        <a href="{{ route('items.show', $item) }}" class="text-emerald-700 font-semibold">Detail</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-5">{{ $items->links() }}</div>
    @endif
@endsection