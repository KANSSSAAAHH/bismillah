@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Barang Saya</h1>
        <a href="{{ route('items.create') }}" class="px-4 py-2 rounded-lg bg-emerald-600 text-white">+ Tambah</a>
    </div>

    @if ($items->isEmpty())
        <div class="bg-white border border-slate-200 rounded-xl p-6 text-slate-600">Anda belum memposting barang.</div>
    @else
        <div class="space-y-3">
            @foreach ($items as $item)
                <article
                    class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-between">
                    <div>
                        <h2 class="font-semibold">{{ $item->nama_barang }}</h2>
                        <p class="text-sm text-slate-600">{{ str_replace('_', ' ', $item->kategori) }} • {{ $item->status }}</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('items.show', $item) }}" class="px-3 py-1.5 rounded bg-slate-100">Detail</a>
                        <a href="{{ route('items.edit', $item) }}" class="px-3 py-1.5 rounded bg-amber-100 text-amber-800">Edit</a>

                        <form action="{{ route('items.status', $item) }}" method="POST" class="flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="rounded border-slate-300 text-sm">
                                @foreach (\App\Models\Barang::STATUS as $status)
                                    <option value="{{ $status }}" @selected($item->status === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                            <button class="px-3 py-1.5 rounded bg-sky-100 text-sky-800">Ubah Status</button>
                        </form>

                        <form action="{{ route('items.destroy', $item) }}" method="POST"
                            onsubmit="return confirm('Hapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1.5 rounded bg-red-100 text-red-700">Hapus</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-5">{{ $items->links() }}</div>
    @endif
@endsection