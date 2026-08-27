@extends('layouts.app')

@section('admin_title', 'Ringkasan Platform')

@section('content')
    <section class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white border-t-4 border-blue-600 border-x border-b border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Barang</p>
            <p class="text-3xl font-bold mt-1 text-[#0F172A]">{{ $totalBarang }}</p>
            <p class="text-xs text-slate-400 mt-1">Tersedia {{ $tersedia }} · Diminta {{ $diminta }}</p>
        </div>
        <div class="bg-white border-t-4 border-blue-600 border-x border-b border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Dipesan / Proses</p>
            <p class="text-3xl font-bold mt-1 text-blue-600">{{ $dipesan }}</p>
        </div>
        <div class="bg-white border-t-4 border-blue-600 border-x border-b border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Selesai</p>
            <p class="text-3xl font-bold mt-1 text-blue-600">{{ $selesai }}</p>
        </div>
        <div class="bg-[#0F172A] rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Pengguna</p>
            <p class="text-3xl font-black mt-1">{{ $totalPengguna }}</p>
            <p class="text-xs text-slate-400 mt-1">Siswa {{ $totalSiswa }} · Sekolah {{ $totalSekolah }} · Admin {{ $totalAdmin }}</p>
        </div>
    </section>

    <section class="grid sm:grid-cols-2 gap-4 mb-6">
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Permintaan Barang Aktif</p>
            <p class="text-3xl font-bold mt-1 text-blue-600">{{ $permintaanAktif }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Transaksi Menunggu Persetujuan</p>
            <p class="text-3xl font-bold mt-1 text-blue-600">{{ $transaksiMenunggu }}</p>
        </div>
    </section>

    <section class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
            <div class="px-5 py-3 border-b border-slate-100 flex items-center justify-between">
                <h2 class="font-bold">Barang Terbaru</h2>
                <a href="{{ route('admin.items') }}" class="text-sm text-blue-600 font-semibold hover:text-blue-500">Lihat semua</a>
            </div>
            @if ($recentItems->isEmpty())
                <p class="text-sm text-slate-500 p-5">Belum ada barang.</p>
            @else
                <table class="w-full text-sm">
                    <tbody>
                        @foreach ($recentItems as $item)
                            <tr class="border-b border-slate-100 last:border-0">
                                <td class="px-5 py-3 font-semibold">{{ $item->nama_barang }}</td>
                                <td class="px-3 py-3 text-slate-500">{{ $item->pengguna?->nama ?? '-' }}</td>
                                <td class="px-5 py-3">{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
            <div class="px-5 py-3 border-b border-slate-100 flex items-center justify-between">
                <h2 class="font-bold">Pengguna Terbaru</h2>
                <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 font-semibold hover:text-blue-500">Lihat semua</a>
            </div>
            @if ($recentUsers->isEmpty())
                <p class="text-sm text-slate-500 p-5">Belum ada pengguna.</p>
            @else
                <table class="w-full text-sm">
                    <tbody>
                        @foreach ($recentUsers as $u)
                            <tr class="border-b border-slate-100 last:border-0">
                                <td class="px-5 py-3 font-semibold">{{ $u->nama }}</td>
                                <td class="px-3 py-3 text-slate-500 truncate max-w-[12rem]">{{ $u->email }}</td>
                                <td class="px-5 py-3">{{ $u->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
@endsection