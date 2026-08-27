<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LOOPIN' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">
    @php
        $loggedIn = session('pengguna_id');
        $role = (string) session('pengguna_role', '');
        $unread = $loggedIn ? app(\App\Services\NotifikasiService::class)->unreadCount((int) $loggedIn) : 0;
    @endphp

    <header class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-tight text-emerald-700">LOOPIN</a>
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded hover:bg-slate-100">Beranda</a>
                <a href="{{ route('items.index') }}" class="px-3 py-2 rounded hover:bg-slate-100">Katalog</a>
                <a href="{{ route('impact.index') }}" class="px-3 py-2 rounded hover:bg-slate-100">Dampak</a>

                @if ($loggedIn)
                    @if (in_array($role, ['pengguna', 'sekolah']))
                        <a href="{{ route('items.create') }}"
                            class="px-3 py-2 rounded bg-emerald-100 text-emerald-800 font-semibold hover:bg-emerald-200">Posting
                            Barang</a>
                    @endif

                    @if (in_array($role, ['pengguna', 'sekolah', 'admin']))
                        <a href="{{ route('my-items.index') }}" class="px-3 py-2 rounded hover:bg-slate-100">Barang Saya</a>
                    @endif

                    @if (in_array($role, ['pengguna', 'sekolah', 'admin']))
                        <a href="{{ route('requests.index') }}" class="px-3 py-2 rounded hover:bg-slate-100">Permintaan</a>
                    @endif

                    @if ($role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-3 py-2 rounded bg-rose-100 text-rose-800 font-semibold hover:bg-rose-200">Admin</a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="px-3 py-2 rounded hover:bg-slate-100">Profil</a>

                    <a href="{{ route('notifications.index') }}"
                        class="px-3 py-2 rounded hover:bg-slate-100 relative">
                        Notifikasi
                        @if ($unread > 0)
                            <span data-notif-count
                                class="absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 rounded-full bg-red-500 text-white text-[10px] flex items-center justify-center font-bold">{{ $unread }}</span>
                        @endif
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-3 py-2 rounded bg-slate-900 text-white hover:bg-black">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-3 py-2 rounded bg-slate-900 text-white hover:bg-black">Daftar</a>
                @endif
            </nav>
        </div>
    </header>

    <main class="max-w-6xl mx-auto p-4 sm:p-6">
        @if (session('success'))
            <div class="mb-4 rounded border border-emerald-200 bg-emerald-50 text-emerald-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded border border-red-200 bg-red-50 text-red-700 px-4 py-3">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>

</html>