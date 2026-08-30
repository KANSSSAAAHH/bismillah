<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LOOPIN' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, h4, .brand { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-[#F8FAFC] text-slate-800">
    @php
        $loggedIn = session('pengguna_id');
        $role = (string) session('pengguna_role', '');
        $unread = $loggedIn ? app(\App\Services\NotifikasiService::class)->unreadCount((int) $loggedIn) : 0;
    @endphp

    <div class="min-h-screen lg:flex">
        <div id="sidebar-backdrop" class="fixed inset-0 z-30 hidden bg-slate-950/60 lg:hidden" data-sidebar-close></div>
        <aside id="app-sidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col bg-[#0F172A] px-4 py-5 text-white shadow-2xl transition-transform duration-300 lg:translate-x-0">
            <a href="{{ route('dashboard') }}" class="flex items-center px-3 pb-7" aria-label="LOOPIN Beranda">
                <img src="{{ asset('images/loopin2.png') }}" alt="Loopin" class="h-16 w-auto">
            </a>
            <nav class="flex-1 overflow-y-auto text-sm font-medium">
                @if ($role === 'admin')
                    <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-blue-300">ADMIN</p>
                    <a href="{{ route('admin.dashboard') }}" class="mb-1 flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="mb-1 flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('admin.users') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Users</a>
                    <a href="{{ route('admin.items') }}" class="mb-1 flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('admin.items') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Items</a>
                    <a href="{{ route('admin.requests') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('admin.requests') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Requests</a>
                @else
                    <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">UTAMA</p>
                    <a href="{{ route('dashboard') }}" class="mb-1 flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Beranda</a>
                    <a href="{{ route('items.index') }}" class="mb-6 flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('items.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Jelajahi Barang</a>
                    <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">AKTIVITAS</p>
                    @if ($loggedIn)
                        <a href="{{ route('my-items.index') }}" class="mb-1 flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('my-items.index') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Barang Saya</a>
                        <a href="{{ route('requests.index') }}" class="mb-1 flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('requests.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Permintaan</a>
                        <a href="{{ route('impact.index') }}" class="mb-6 flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('impact.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Dampak Saya</a>
                        <p class="px-3 pb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">AKUN</p>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 {{ request()->routeIs('profile.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }} transition">Profil</a>
                    @else
                        <a href="{{ route('login') }}" class="mb-1 flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-300 hover:bg-white/10 hover:text-white transition">Masuk</a>
                        <a href="{{ route('register') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-300 hover:bg-white/10 hover:text-white transition">Daftar</a>
                    @endif
                @endif
            </nav>
            <div class="border-t border-white/10 pt-4">
                @if ($loggedIn)
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-pink-200 hover:bg-pink-500/15 transition">Keluar</button>
                    </form>
                @else
                    <p class="px-3 text-xs leading-5 text-slate-500">Berbagi barang layak pakai untuk teman satu sekolah.</p>
                @endif
            </div>
        </aside>

        <div class="flex min-h-screen min-w-0 flex-1 flex-col lg:ml-64">
            <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
                <div class="flex min-h-[72px] items-center gap-3 px-4 sm:px-6 lg:px-8">
                    <button type="button" class="rounded-lg border border-slate-200 p-2 text-slate-700 lg:hidden" data-sidebar-open aria-label="Buka menu">
                        <span class="block h-0.5 w-5 bg-current"></span><span class="mt-1 block h-0.5 w-5 bg-current"></span><span class="mt-1 block h-0.5 w-5 bg-current"></span>
                    </button>
                    <div class="relative hidden max-w-xl flex-1 sm:block">
                        <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">⌕</span>
                        <input type="search" placeholder="Cari barang yang kamu butuhkan..." class="w-full rounded-full border-slate-200 bg-slate-50 py-2.5 pl-9 pr-4 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                    </div>
                    <div class="ml-auto flex items-center gap-3">
                        @if ($loggedIn)
                            <a href="{{ route('notifications.index') }}" class="relative rounded-lg p-2 text-slate-500 hover:bg-slate-100 hover:text-blue-600 transition" aria-label="Notifikasi">
                                <span class="text-xl">♧</span>
                                @if ($unread > 0)<span data-notif-count class="absolute right-1 top-1 h-2 w-2 rounded-full bg-red-500"></span>@endif
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2">
                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">{{ strtoupper(substr((string) session('pengguna_nama', 'U'), 0, 1)) }}</span>
                                <span class="hidden text-left sm:block"><span class="block max-w-[10rem] truncate text-sm font-semibold text-slate-800">{{ session('pengguna_nama') }}</span><span class="block text-xs text-slate-500">{{ ucfirst($role) }}</span></span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 transition">Masuk</a>
                        @endif
                    </div>
                </div>
            </header>

            <main class="mx-auto w-full max-w-[1440px] flex-1 px-4 py-6 sm:px-6 lg:px-8 lg:py-10">
        @if (session('success'))
            <div class="mb-5 rounded-xl border border-blue-200 bg-blue-50 text-blue-800 px-4 py-3 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 text-red-700 px-4 py-3 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

                @yield('content')
            </main>

            <footer class="bg-[#0F172A] text-slate-300">
        <div class="mx-auto grid max-w-[1440px] grid-cols-2 gap-8 px-4 py-10 sm:grid-cols-4 sm:px-6 lg:px-8">
            <div class="col-span-2 sm:col-span-1">
                <img src="{{ asset('images/loopin2.png') }}" alt="Loopin" class="h-12 w-auto">
                <p class="mt-3 max-w-xs text-xs leading-5 text-slate-400">Platform donasi dan barter siswa SMK Telkom Sidoarjo.</p>
            </div>
            <div><p class="mb-3 text-xs font-bold uppercase tracking-widest text-white">Platform</p><p class="text-sm text-slate-400">Jelajahi barang</p><p class="mt-2 text-sm text-slate-400">Dampak LOOPIN</p></div>
            <div><p class="mb-3 text-xs font-bold uppercase tracking-widest text-white">Akun</p><p class="text-sm text-slate-400">Profil pengguna</p><p class="mt-2 text-sm text-slate-400">Pusat notifikasi</p></div>
            <div><p class="mb-3 text-xs font-bold uppercase tracking-widest text-white">Area</p><p class="text-sm text-slate-400">Serah terima aman</p><p class="mt-2 text-sm text-slate-400">SMK Telkom Sidoarjo</p></div>
        </div>
            </footer>
        </div>
    </div>
    <script>
        (() => {
            const sidebar = document.getElementById('app-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const toggle = (open) => { sidebar?.classList.toggle('-translate-x-full', !open); backdrop?.classList.toggle('hidden', !open); };
            document.querySelector('[data-sidebar-open]')?.addEventListener('click', () => toggle(true));
            document.querySelector('[data-sidebar-close]')?.addEventListener('click', () => toggle(false));
        })();
    </script>
</body>

</html>