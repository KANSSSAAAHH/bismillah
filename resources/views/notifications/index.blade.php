@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <div><p class="text-xs uppercase tracking-[0.2em] text-blue-600 font-bold">Tetap terhubung</p><h1 class="text-3xl font-bold text-[#0F172A] mt-1">Notifikasi</h1></div>
        @if ($notifications->isNotEmpty())
            <form action="{{ route('notifications.read-all') }}" method="POST">@csrf
                <button class="px-3 py-2 rounded-lg bg-[#0F172A] text-white text-sm hover:bg-blue-600 transition">Tandai Semua Dibaca</button>
            </form>
        @endif
    </div>

    @if ($notifications->isEmpty())
        <div class="bg-white border border-slate-200 rounded-xl p-6 text-slate-600">Belum ada notifikasi.</div>
    @else
        <div class="space-y-3">
            @foreach ($notifications as $n)
                <div class="bg-white border {{ $n->sudah_dibaca ? 'border-slate-200' : 'border-blue-400' }} rounded-xl p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">{{ $n->judul }}</p>
                        @if (!$n->sudah_dibaca)
                            <span class="text-xs px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 font-semibold">Baru</span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-600 mt-1">{{ $n->pesan }}</p>
                    <p class="text-xs text-slate-400 mt-2">Tipe: {{ $n->tipe }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection