@extends('layouts.app')

@section('admin_title', 'Permintaan & Transaksi')

@section('content')
    <section class="mb-6">
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="px-5 py-3 border-b border-slate-100">
                <h2 class="font-bold">Permintaan Barang (Wishlist)</h2>
            </div>
            @if ($lists->isEmpty())
                <p class="text-sm text-slate-500 p-5">Belum ada permintaan barang.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-[#0F172A] text-left text-slate-200">
                            <tr>
                                <th class="px-5 py-3 font-medium">Pemohon</th>
                                <th class="px-3 py-3 font-medium">Barang yang Dicari</th>
                                <th class="px-3 py-3 font-medium">Kategori</th>
                                <th class="px-5 py-3 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr class="border-t border-slate-100 hover:bg-blue-50/60 transition">
                                    <td class="px-5 py-3">
                                        <div class="font-semibold">{{ $list->pengguna_nama ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $list->pengguna_email ?? '' }}</div>
                                    </td>
                                    <td class="px-3 py-3 text-slate-700">{{ $list->nama_barang }}</td>
                                    <td class="px-3 py-3 text-slate-600">{{ str_replace('_', ' ', $list->kategori) }}</td>
                                    <td class="px-5 py-3">{{ $list->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="px-5 py-3 border-t border-slate-100">{{ $lists->links() }}</div>
        </div>
    </section>

    <section>
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="px-5 py-3 border-b border-slate-100">
                <h2 class="font-bold">Transaksi</h2>
            </div>
            @if ($transaksi->isEmpty())
                <p class="text-sm text-slate-500 p-5">Belum ada transaksi.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-[#0F172A] text-left text-slate-200">
                            <tr>
                                <th class="px-5 py-3 font-medium">Barang</th>
                                <th class="px-3 py-3 font-medium">Pemilik</th>
                                <th class="px-3 py-3 font-medium">Penerima</th>
                                <th class="px-3 py-3 font-medium">Status</th>
                                <th class="px-5 py-3 font-medium">Lokasi Temu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $t)
                                <tr class="border-t border-slate-100 hover:bg-blue-50/60 transition">
                                    <td class="px-5 py-3 font-semibold">{{ $t->barang_nama }}</td>
                                    <td class="px-3 py-3 text-slate-600">{{ $t->pemilik_nama ?? '-' }}</td>
                                    <td class="px-3 py-3 text-slate-600">{{ $t->penerima_nama ?? '-' }}</td>
                                    <td class="px-3 py-3 text-slate-600">{{ $t->status }}</td>
                                    <td class="px-5 py-3 text-slate-600">{{ $t->lokasi_temu ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="px-5 py-3 border-t border-slate-100">{{ $transaksi->links() }}</div>
        </div>
    </section>
@endsection