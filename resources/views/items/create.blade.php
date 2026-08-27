@extends('layouts.app')

@section('content')
    <div class="mb-6"><p class="text-xs uppercase tracking-[0.2em] text-blue-600 font-bold">Bagikan barang</p><h1 class="text-3xl font-bold text-[#0F172A] mt-1">Posting Barang Baru</h1></div>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white border border-slate-200 rounded-xl p-5 sm:p-7 grid sm:grid-cols-2 gap-5 shadow-sm">
        @csrf

        @include('items.partials.form', ['item' => null, 'statusOptions' => []])

        <div class="sm:col-span-2">
            <button class="px-5 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition">Simpan</button>
        </div>
    </form>
@endsection