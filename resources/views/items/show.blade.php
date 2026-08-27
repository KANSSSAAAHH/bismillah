@extends('layouts.app')

@section('content')
    <div class="grid lg:grid-cols-2 gap-6 lg:gap-10">
        <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">
            <img src="{{ $item->foto ?: 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=900&q=85' }}" alt="{{ $item->nama_barang }}" class="w-full h-[360px] object-cover rounded-lg">
            <div class="mt-3 grid grid-cols-3 gap-3"><img src="{{ $item->foto ?: 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=240&q=80' }}" alt="" class="h-20 w-full rounded-lg object-cover ring-2 ring-blue-500"><img src="{{ $item->foto ?: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=240&q=80' }}" alt="" class="h-20 w-full rounded-lg object-cover"><img src="{{ $item->foto ?: 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=240&q=80' }}" alt="" class="h-20 w-full rounded-lg object-cover"></div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
            <span class="inline-flex px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">{{ $item->status }}</span>
            <h1 class="text-3xl font-bold text-[#0F172A] mt-3">{{ $item->nama_barang }}</h1>
            <p class="text-sm text-slate-600 mt-1">{{ str_replace('_', ' ', $item->kategori) }}</p>

            <dl class="mt-5 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="font-semibold text-slate-500">Kondisi</dt>
                    <dd>{{ $item->kondisi }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-500">Metode</dt>
                    <dd>{{ $item->metode }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-500">Harga</dt>
                    <dd>{{ $item->harga ? 'Rp ' . number_format($item->harga, 0, ',', '.') : '-' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-500">Lokasi</dt>
                    <dd>{{ $item->lokasi }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-500">Status</dt>
                    <dd>{{ $item->status }}</dd>
                </div>
            </dl>

            <p class="mt-6 rounded-xl bg-blue-50 p-4 text-sm leading-6 text-blue-900">{{ $item->deskripsi }}</p>

            @php
                $loggedId = (int) session('pengguna_id');
                $isOwner = $loggedId === (int) $item->pengguna_id;
            @endphp

            <div class="mt-6 rounded-xl border border-blue-100 bg-blue-50/60 p-4">
                @if ($loggedId === 0)
                    <p class="text-sm text-slate-600 mb-3">Masuk untuk mengajukan permintaan barang ini.</p>
                    <a href="{{ route('login') }}"
                        class="inline-block px-4 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500">Masuk</a>
                @elseif ($isOwner)
                    <p class="text-sm text-slate-600">Ini barang milikmu. Kamu dapat mengelola lewat
                        <a href="{{ route('my-items.index') }}" class="text-blue-600 font-semibold">Barang Saya</a>.
                    </p>
                @elseif ($item->status !== 'tersedia')
                    <p class="text-sm text-slate-600">Barang ini sedang {{ $item->status }} dan tidak dapat diminta saat ini.</p>
                @else
                    <h2 class="font-bold mb-2 text-[#0F172A]">Masuk Kembali ke Siklus</h2>
                    <p class="mb-4 text-sm text-slate-600">Kirim pesan singkat kepada pemilik untuk mengatur serah terima di dropzone sekolah.</p>
                    <form action="{{ route('items.request', $item) }}" method="POST" class="space-y-2">
                        @csrf
                        <textarea name="pesan" rows="2" placeholder="Pesan singkat untuk pemilik (opsional)"
                            class="w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"></textarea>
                        <button class="px-4 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500">Kirim
                            Permintaan</button>
                    </form>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('items.index') }}" class="text-blue-600 font-semibold">← Kembali ke katalog</a>
            </div>
        </div>
    </div>
@endsection