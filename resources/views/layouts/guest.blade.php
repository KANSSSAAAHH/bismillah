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

    <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-[1440px] items-center gap-6 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard') }}" class="flex items-center" aria-label="LOOPIN Beranda">
                <img src="{{ asset('images/loopin1.png') }}" alt="Loopin" class="h-8 w-auto">
            </a>

            <nav class="ml-4 hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Beranda</a>
                <a href="#cara-kerja" class="hover:text-blue-600 transition">Cara Kerja</a>
                <a href="#kategori" class="hover:text-blue-600 transition">Kategori</a>
                <a href="#tentang" class="hover:text-blue-600 transition">Tentang</a>
            </nav>

            <div class="ml-auto flex items-center gap-3">
                <a href="{{ route('login') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-blue-500 hover:text-blue-600 transition">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 transition">Mulai</a>
            </div>
        </div>
    </header>

    <main class="mx-auto w-full max-w-[1440px] px-4 py-6 sm:px-6 lg:px-8 lg:py-10">
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
                <img src="{{ asset('images/loopin2.png') }}" alt="Loopin" class="h-8 w-auto">
                <p class="mt-3 max-w-xs text-xs leading-5 text-slate-400">Platform donasi dan barter siswa SMK Telkom Sidoarjo.</p>
            </div>
            <div><p class="mb-3 text-xs font-bold uppercase tracking-widest text-white">Platform</p><p class="text-sm text-slate-400">Jelajahi barang</p><p class="mt-2 text-sm text-slate-400">Dampak LOOPIN</p></div>
            <div><p class="mb-3 text-xs font-bold uppercase tracking-widest text-white">Akun</p><p class="text-sm text-slate-400">Masuk</p><p class="mt-2 text-sm text-slate-400">Daftar</p></div>
            <div><p class="mb-3 text-xs font-bold uppercase tracking-widest text-white">Dropzone</p><p class="text-sm text-slate-400">Serah terima aman</p><p class="mt-2 text-sm text-slate-400">SMK Telkom Sidoarjo</p></div>
        </div>
    </footer>

</body>
</html>