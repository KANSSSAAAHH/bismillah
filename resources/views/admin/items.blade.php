@extends('layouts.app')

@section('admin_title', 'Manajemen Barang')

@section('content')
    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="px-5 py-3 border-b border-slate-100">
            <h2 class="font-bold">Semua Barang</h2>
        </div>

        @if ($items->isEmpty())
            <p class="text-sm text-slate-500 p-5">Belum ada barang.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#0F172A] text-left text-slate-200">
                        <tr>
                            <th class="px-5 py-3 font-medium">Barang</th>
                            <th class="px-3 py-3 font-medium">Pemilik</th>
                            <th class="px-3 py-3 font-medium">Kategori</th>
                            <th class="px-3 py-3 font-medium">Status</th>
                            <th class="px-5 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr class="border-t border-slate-100 hover:bg-blue-50/60 transition">
                                <td class="px-5 py-3">
                                    <div class="font-semibold">{{ $item->nama_barang }}</div>
                                    <div class="text-xs text-slate-500">{{ $item->metode }}</div>
                                </td>
                                <td class="px-3 py-3 text-slate-600">{{ $item->pengguna?->nama ?? '-' }}</td>
                                <td class="px-3 py-3 text-slate-600">{{ str_replace('_', ' ', $item->kategori) }}</td>
                                <td class="px-3 py-3">
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold
                                        {{ $item->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' : ($item->status === 'tersedia' ? 'bg-cyan-100 text-cyan-700' : 'bg-amber-100 text-amber-700') }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <a href="{{ route('items.show', $item) }}"
                                        class="text-sm text-blue-600 font-semibold hover:text-blue-500 mr-2">Lihat</a>
                                    <form action="{{ route('admin.items.destroy', $item) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Hapus barang ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600 font-semibold hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="px-5 py-3 border-t border-slate-100">
            {{ $items->links() }}
        </div>
    </div>
@endsection