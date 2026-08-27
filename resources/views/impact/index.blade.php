@extends('layouts.app')

@section('content')
    <div class="mb-6"><p class="text-xs uppercase tracking-[0.2em] text-blue-600 font-bold">Jejak sirkulasi</p><h1 class="text-3xl font-bold text-[#0F172A] mt-1">Dampak LOOPIN</h1></div>

    <div class="grid sm:grid-cols-3 gap-4">
        <div class="bg-white border-t-4 border-blue-600 border-x border-b border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Barang Diposting</p>
            <p class="text-4xl font-bold mt-1 text-[#0F172A]">{{ $totalBarang }}</p>
        </div>
        <div class="bg-white border-t-4 border-blue-600 border-x border-b border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Barang Selesai Tersalurkan</p>
            <p class="text-4xl font-bold mt-1 text-[#0F172A]">{{ $totalSelesai }}</p>
        </div>
        <div class="bg-white border-t-4 border-blue-600 border-x border-b border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Barang Masih Tersedia</p>
            <p class="text-4xl font-bold mt-1 text-[#0F172A]">{{ $totalTersedia }}</p>
        </div>
    </div>
@endsection