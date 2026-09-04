@extends('layouts.app')

@section('content')
    <div class="flex items-end justify-between gap-3 mb-6">
        <div><p class="text-xs uppercase tracking-[0.2em] text-blue-600 font-bold">Ruang personal</p><h1 class="text-3xl font-bold text-[#0F172A] mt-1">Barang Saya</h1></div>
        <a href="{{ route('items.create') }}" class="px-4 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition">+ Tambah</a>
    </div>

    @if ($items->isEmpty())
        <div class="bg-white border border-slate-200 rounded-xl p-6 text-slate-600">Anda belum memposting barang.</div>
    @else
        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
            <table class="w-full min-w-[760px] text-left text-sm">
                <thead class="bg-[#0F172A] text-xs uppercase tracking-wider text-slate-200">
                    <tr>
                        <th class="px-5 py-4">Barang</th><th class="px-3 py-4">Kategori</th><th class="px-3 py-4">Metode</th><th class="px-3 py-4">Status</th><th class="px-3 py-4">Tanggal</th><th class="px-5 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($items as $item)
                        <tr class="hover:bg-blue-50/50 transition">
                            <td class="px-5 py-4"><div class="flex items-center gap-3"><img src="{{ $item->image_url }}" alt="{{ $item->nama_barang }}" class="h-12 w-12 rounded-lg object-cover"><span class="font-semibold text-slate-900">{{ $item->nama_barang }}</span></div></td>
                            <td class="px-3 py-4 text-slate-600">{{ str_replace('_', ' ', $item->kategori) }}</td>
                            <td class="px-3 py-4 text-slate-600">{{ $item->metode }}</td>
                            <td class="px-3 py-4"><div class="flex items-center gap-2"><span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">{{ $item->status }}</span><form action="{{ route('items.status', $item) }}" method="POST" class="flex items-center gap-1">@csrf @method('PATCH')<select name="status" class="rounded-lg border-slate-300 py-1 text-xs">@foreach (\App\Models\Barang::STATUS as $status)<option value="{{ $status }}" @selected($item->status === $status)>{{ $status }}</option>@endforeach</select><button class="text-xs font-semibold text-blue-600 hover:text-blue-500">Ubah</button></form></div></td>
                            <td class="px-3 py-4 text-slate-400">-</td>
                            <td class="px-5 py-4"><div class="flex justify-end gap-2"><a href="{{ route('items.show', $item) }}" class="rounded-lg bg-slate-100 px-2.5 py-1.5 text-slate-700 hover:bg-blue-100 hover:text-blue-700" aria-label="Lihat detail">↗</a><a href="{{ route('items.edit', $item) }}" class="rounded-lg bg-blue-50 px-2.5 py-1.5 text-blue-700 hover:bg-blue-100" aria-label="Edit barang">✎</a><form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">@csrf @method('DELETE')<button class="rounded-lg bg-red-50 px-2.5 py-1.5 text-red-700 hover:bg-red-100" aria-label="Hapus barang">×</button></form></div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $items->links() }}</div>
    @endif
@endsection