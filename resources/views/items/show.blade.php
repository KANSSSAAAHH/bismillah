@extends('layouts.app')

@section('content')
    <div class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white border border-slate-200 rounded-xl p-4">
            <img src="{{ $item->foto }}" alt="{{ $item->nama_barang }}" class="w-full h-[360px] object-cover rounded-lg">
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-6">
            <h1 class="text-2xl font-bold">{{ $item->nama_barang }}</h1>
            <p class="text-sm text-slate-600 mt-1">{{ str_replace('_', ' ', $item->kategori) }}</p>

            <dl class="mt-4 space-y-2 text-sm">
                <div>
                    <dt class="font-semibold">Kondisi</dt>
                    <dd>{{ $item->kondisi }}</dd>
                </div>
                <div>
                    <dt class="font-semibold">Metode</dt>
                    <dd>{{ $item->metode }}</dd>
                </div>
                <div>
                    <dt class="font-semibold">Harga</dt>
                    <dd>{{ $item->harga ? 'Rp ' . number_format($item->harga, 0, ',', '.') : '-' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold">Lokasi</dt>
                    <dd>{{ $item->lokasi }}</dd>
                </div>
                <div>
                    <dt class="font-semibold">Status</dt>
                    <dd>{{ $item->status }}</dd>
                </div>
            </dl>

            <p class="mt-4 text-slate-700">{{ $item->deskripsi }}</p>

            @php
                $loggedId = (int) session('pengguna_id');
                $isOwner = $loggedId === (int) $item->pengguna_id;
            @endphp

            <div class="mt-6">
                @if ($loggedId === 0)
                    <p class="text-sm text-slate-600 mb-3">Masuk untuk mengajukan permintaan barang ini.</p>
                    <a href="{{ route('login') }}"
                        class="inline-block px-4 py-2 rounded bg-emerald-600 text-white font-semibold">Masuk</a>
                @elseif ($isOwner)
                    <p class="text-sm text-slate-600">Ini barang milikmu. Kamu dapat mengelola lewat
                        <a href="{{ route('my-items.index') }}" class="text-emerald-700 font-semibold">Barang Saya</a>.
                    </p>
                @elseif ($item->status !== 'tersedia')
                    <p class="text-sm text-slate-600">Barang ini sedang {{ $item->status }} dan tidak dapat diminta saat ini.</p>
                @else
                    <h2 class="font-bold mb-2">Ajukan Permintaan</h2>
                    <form action="{{ route('items.request', $item) }}" method="POST" class="space-y-2">
                        @csrf
                        <textarea name="pesan" rows="2" placeholder="Pesan singkat untuk pemilik (opsional)"
                            class="w-full rounded-lg border-slate-300"></textarea>
                        <button class="px-4 py-2 rounded bg-emerald-600 text-white font-semibold hover:bg-emerald-700">Kirim
                            Permintaan</button>
                    </form>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('items.index') }}" class="text-emerald-700 font-semibold">Kembali ke katalog</a>
            </div>
        </div>
    </div>
@endsection