@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Notifikasi</h1>
        @if ($notifications->isNotEmpty())
            <form action="{{ route('notifications.read-all') }}" method="POST">@csrf
                <button class="px-3 py-1.5 rounded bg-slate-900 text-white text-sm">Tandai Semua Dibaca</button>
            </form>
        @endif
    </div>

    @if ($notifications->isEmpty())
        <div class="bg-white border border-slate-200 rounded-xl p-6 text-slate-600">Belum ada notifikasi.</div>
    @else
        <div class="space-y-3">
            @foreach ($notifications as $n)
                <div class="bg-white border {{ $n->sudah_dibaca ? 'border-slate-200' : 'border-emerald-300' }} rounded-xl p-4">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">{{ $n->judul }}</p>
                        @if (!$n->sudah_dibaca)
                            <span class="text-xs px-2 py-0.5 rounded bg-emerald-100 text-emerald-700 font-semibold">Baru</span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-600 mt-1">{{ $n->pesan }}</p>
                    <p class="text-xs text-slate-400 mt-2">Tipe: {{ $n->tipe }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection