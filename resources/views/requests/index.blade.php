@extends('layouts.app')

@section('content')
    <div class="mb-6"><p class="text-xs uppercase tracking-[0.2em] text-blue-600 font-bold">Hubungkan kebutuhan</p><h1 class="text-3xl font-bold text-[#0F172A] mt-1">Permintaan</h1></div>

    {{-- Form tambah wishlist (barang yang dicari) --}}
    <section class="bg-white border border-slate-200 rounded-xl p-5 sm:p-6 mb-6 shadow-sm">
        <h2 class="font-bold mb-3">Tambahkan Barang yang Kamu Cari (Wishlist)</h2>
        <form action="{{ route('requests.store') }}" method="POST" class="grid sm:grid-cols-3 gap-3">
            @csrf
            <input name="nama_barang" placeholder="Nama barang yang dicari" value="{{ old('nama_barang') }}"
                class="rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
            <select name="kategori" class="rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                <option value="">-- Kategori --</option>
                @foreach ($kategoriOptions as $kat)
                    <option value="{{ $kat }}" @selected(old('kategori') === $kat)>{{ str_replace('_', ' ', $kat) }}</option>
                @endforeach
            </select>
            <button class="rounded-lg bg-blue-600 text-white font-semibold py-2.5 hover:bg-blue-500 transition">Simpan
                Wishlist</button>
            <input name="deskripsi" placeholder="Deskripsi / alasan (opsional)" value="{{ old('deskripsi') }}"
                class="sm:col-span-3 rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
        </form>
    </section>
    {{-- Incoming: transaksi menuju barang milik saya --}}
    <section class="bg-white border border-slate-200 rounded-xl overflow-hidden mb-6 shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100 font-bold text-[#0F172A]">Permintaan Masuk (Barang Saya)</div>
        @if ($incoming->isEmpty())
            <p class="text-sm text-slate-500 p-5">Belum ada permintaan untuk barang kamu.</p>
        @else
            <div class="divide-y divide-slate-100">
                @foreach ($incoming as $tx)
                    <div class="p-4 flex flex-col sm:flex-row sm:items-center gap-3 sm:justify-between">
                        <div>
                            <p class="font-semibold">{{ $tx->barang->nama_barang }}</p>
                            <p class="text-sm text-slate-600">Dari: {{ $tx->penerima->nama }}</p>
                            <p class="text-sm text-slate-500">Status: <span class="font-semibold">{{ $tx->status }}</span>
                                @if ($tx->lokasi_temu) • Temu: {{ $tx->lokasi_temu }} @endif</p>
                        </div>
                        <div class="flex flex-wrap gap-2 text-sm">
                            @if ($tx->status === 'menunggu')
                                <form action="{{ route('transaksi.approve', $tx) }}" method="POST" class="inline">@csrf
                                    <button class="px-3 py-1.5 rounded-lg bg-blue-600 text-white">Setujui</button></form>
                                <form action="{{ route('transaksi.reject', $tx) }}" method="POST" class="inline">@csrf
                                    <button class="px-3 py-1.5 rounded bg-red-600 text-white">Tolak</button></form>
                            @elseif ($tx->status === 'disetujui')
                                <form action="{{ route('transaksi.schedule', $tx) }}" method="POST"
                                    class="flex flex-wrap gap-2 items-center">
                                    @csrf
                                    <input name="lokasi_temu" placeholder="Lokasi temu" required class="rounded border-slate-300 text-sm">
                                    <input type="datetime-local" name="waktu_temu" required class="rounded border-slate-300 text-sm">
                                    <button class="px-3 py-1.5 rounded-lg bg-blue-600 text-white">Buat Jadwal</button>
                                </form>
                            @elseif ($tx->status === 'dijadwalkan')
                                <form action="{{ route('transaksi.complete', $tx) }}" method="POST" class="inline">@csrf
                                    <button class="px-3 py-1.5 rounded-lg bg-blue-600 text-white">Tandai Selesai</button></form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
{{-- Outgoing: permintaanku atas barang orang lain --}}
    <section class="bg-white border border-slate-200 rounded-xl overflow-hidden mb-6 shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100 font-bold text-[#0F172A]">Permintaan yang Kukirim</div>
        @if ($outgoing->isEmpty())
            <p class="text-sm text-slate-500 p-5">Kamu belum mengirim permintaan.</p>
        @else
            <div class="divide-y divide-slate-100">
                @foreach ($outgoing as $tx)
                    <div class="p-4">
                        <p class="font-semibold">{{ $tx->barang->nama_barang }}</p>
                        <p class="text-sm text-slate-600">Pemilik: {{ $tx->pemilik->nama }}</p>
                        <p class="text-sm text-slate-500">Status: <span class="font-semibold">{{ $tx->status }}</span>
                            @if ($tx->status === 'dijadwalkan' && $tx->waktu_temu)
                                · Temu {{ \Carbon\Carbon::parse($tx->waktu_temu)->format('d M Y H:i') }} di {{ $tx->lokasi_temu }}
                            @endif</p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Wishlist publik --}}
    <section class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <div class="px-5 py-4 border-b border-slate-100 font-bold text-[#0F172A]">Wishlist Komunitas</div>
        @if ($wishlists->isEmpty())
            <p class="text-sm text-slate-500 p-6">Belum ada wishlist aktif. Tambahkan lewat form di atas.</p>
        @else
            <div class="divide-y divide-slate-100">
                @foreach ($wishlists as $w)
                    <div class="p-4 flex items-center justify-between gap-3">
                        <div>
                            <p class="font-semibold">{{ $w->nama_barang }}</p>
                            <p class="text-sm text-slate-600">{{ str_replace('_', ' ', $w->kategori) }} · oleh {{ $w->pengguna?->nama ?? '-' }}</p>
                        </div>
                        @if ($w->pengguna_id === (int) session('pengguna_id'))
                            <form action="{{ route('requests.close', $w) }}" method="POST">@csrf
                                <button class="text-sm px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200">Tutup</button></form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection