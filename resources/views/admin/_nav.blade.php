@php
    $current = Route::currentRouteName();
@endphp

<header class="mb-8 bg-[#0F172A] text-white rounded-2xl p-5 sm:p-6 shadow-lg shadow-slate-900/10">
    <div class="flex items-center justify-between flex-wrap gap-2">
        <div>
            <div class="flex items-center gap-3"><img src="{{ asset('Images/loopin2.png') }}" alt="Loopin" class="h-8 w-auto"><div><p class="text-xs uppercase tracking-[0.2em] text-blue-300">Panel Administrator</p>
            <h1 class="text-xl sm:text-2xl font-bold">@yield('admin_title', 'Dashboard Admin')</h1></div></div>
        </div>
        <a href="{{ route('dashboard') }}"
            class="text-sm text-blue-300 font-semibold hover:text-white">← Kembali ke Beranda</a>
    </div>

    <nav class="mt-4 flex flex-wrap gap-2 text-sm">
        <a href="{{ route('admin.dashboard') }}"
            class="px-4 py-2 rounded-lg {{ str_starts_with($current, 'admin.dashboard') ? 'bg-blue-600 text-white' : 'bg-white/10 text-slate-300 hover:bg-white/20' }}">
            Ringkasan</a>
        <a href="{{ route('admin.users') }}"
            class="px-4 py-2 rounded-lg {{ str_starts_with($current, 'admin.users') ? 'bg-blue-600 text-white' : 'bg-white/10 text-slate-300 hover:bg-white/20' }}">
            Pengguna</a>
        <a href="{{ route('admin.items') }}"
            class="px-4 py-2 rounded-lg {{ str_starts_with($current, 'admin.items') ? 'bg-blue-600 text-white' : 'bg-white/10 text-slate-300 hover:bg-white/20' }}">
            Barang</a>
        <a href="{{ route('admin.requests') }}"
            class="px-4 py-2 rounded-lg {{ str_starts_with($current, 'admin.requests') ? 'bg-blue-600 text-white' : 'bg-white/10 text-slate-300 hover:bg-white/20' }}">
            Permintaan & Transaksi</a>
    </nav>
</header>