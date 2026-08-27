@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dampak LOOPIN</h1>

    <div class="grid sm:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-200 rounded-xl p-5">
            <p class="text-sm text-slate-500">Total Barang Diposting</p>
            <p class="text-3xl font-black mt-1">{{ $totalBarang }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5">
            <p class="text-sm text-slate-500">Barang Selesai Tersalurkan</p>
            <p class="text-3xl font-black mt-1">{{ $totalSelesai }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5">
            <p class="text-sm text-slate-500">Barang Masih Tersedia</p>
            <p class="text-3xl font-black mt-1">{{ $totalTersedia }}</p>
        </div>
    </div>
@endsection