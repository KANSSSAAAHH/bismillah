@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Barang</h1>

    <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data"
        class="bg-white border border-slate-200 rounded-xl p-5 grid sm:grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        @include('items.partials.form', ['item' => $item, 'statusOptions' => $statusOptions])

        <div class="sm:col-span-2 flex flex-wrap gap-2">
            <button class="px-4 py-2 rounded-lg bg-emerald-600 text-white">Update</button>
        </div>
    </form>
@endsection