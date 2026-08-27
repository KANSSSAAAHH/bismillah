@extends('layouts.app')

@section('content')
    <div class="mb-6"><p class="text-xs uppercase tracking-[0.2em] text-blue-600 font-bold">Kelola postingan</p><h1 class="text-3xl font-bold text-[#0F172A] mt-1">Edit Barang</h1></div>

    <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data"
        class="bg-white border border-slate-200 rounded-xl p-5 sm:p-7 grid sm:grid-cols-2 gap-5 shadow-sm">
        @csrf
        @method('PUT')

        @include('items.partials.form', ['item' => $item, 'statusOptions' => $statusOptions])

        <div class="sm:col-span-2 flex flex-wrap gap-2">
            <button class="px-5 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition">Update</button>
        </div>
    </form>
@endsection