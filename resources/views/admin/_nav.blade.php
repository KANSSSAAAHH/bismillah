@php
    $current = Route::currentRouteName();
@endphp

<header class="mb-6">
    <div class="flex items-center justify-between flex-wrap gap-2">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Panel Administrator</p>
            <h1 class="text-xl sm:text-2xl font-black">@yield('admin_title', 'Dashboard Admin')</h1>
        </div>
        <a href="{{ route('dashboard') }}"
            class="text-sm text-emerald-700 font-semibold hover:underline">← Kembali ke Beranda</a>
    </div>

    <nav class="mt-4 flex flex-wrap gap-2 text-sm">
        <a href="{{ route('admin.dashboard') }}"
            class="px-4 py-2 rounded {{ str_starts_with($current, 'admin.dashboard') ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 hover:bg-slate-100' }}">
            Ringkasan</a>
        <a href="{{ route('admin.users') }}"
            class="px-4 py-2 rounded {{ str_starts_with($current, 'admin.users') ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 hover:bg-slate-100' }}">
            Pengguna</a>
        <a href="{{ route('admin.items') }}"
            class="px-4 py-2 rounded {{ str_starts_with($current, 'admin.items') ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 hover:bg-slate-100' }}">
            Barang</a>
        <a href="{{ route('admin.requests') }}"
            class="px-4 py-2 rounded {{ str_starts_with($current, 'admin.requests') ? 'bg-slate-900 text-white' : 'bg-white border border-slate-200 hover:bg-slate-100' }}">
            Permintaan & Transaksi</a>
    </nav>
</header>