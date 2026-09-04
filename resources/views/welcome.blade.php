<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOOPIN | Bagikan Barang yang Masih Berguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="mx-auto max-w-[1280px] px-4 py-5 sm:px-6 lg:px-8">
        <header class="rounded-full border border-slate-200 bg-white/90 backdrop-blur">
            <nav class="mx-auto flex max-w-[1200px] items-center justify-between gap-3 px-4 py-3 sm:px-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('Images/loopin1.png') }}" alt="LOOPIN" class="h-12 w-auto sm:h-14">
                </div>
                <div class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
                    <a href="#" class="text-slate-900">Beranda</a>
                    <a href="#cara-kerja" class="hover:text-slate-900">Cara Kerja</a>
                    <a href="#kategori" class="hover:text-slate-900">Kategori</a>
                    <a href="#tentang" class="hover:text-slate-900">Tentang</a>
                </div>
                <div class="flex items-center gap-3">
                    @if ($isLoggedIn)
                        <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-blue-200 hover:text-blue-700">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-blue-200 hover:text-blue-700">Masuk</a>
                        <a href="{{ route('register') }}" class="rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500">Mulai</a>
                    @endif
                </div>
            </nav>
        </header>

        <main class="mt-8">
            <section class="overflow-hidden rounded-[32px] bg-[#F3F7FF] px-5 py-8 sm:px-8 lg:px-12 lg:py-12">
                <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr]">
                    <div>
                        <p class="mb-4 inline-flex rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-blue-700">
                            Platform Sirkulasi Barang Sekolah
                        </p>
                        <h1 class="max-w-xl text-4xl font-black leading-tight tracking-[-0.06em] text-slate-900 sm:text-5xl lg:text-6xl">
                            Barang lama,<br>manfaat baru.
                        </h1>
                        <p class="mt-5 max-w-lg text-base leading-7 text-slate-600">
                            Temukan, bagikan, dan manfaatkan perlengkapan sekolah yang masih layak pakai. LOOPIN membantu siswa dan sekolah mengurangi sampah dan membuat kebutuhan belajar lebih mudah dijangkau.
                        </p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('items.index') }}" class="rounded-full bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500">Jelajahi Barang</a>
                            <a href="{{ route('register') }}" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-blue-200 hover:text-blue-700">Bagikan Barang</a>
                        </div>
                        <div class="mt-10 grid max-w-lg grid-cols-3 gap-5">
                            <div>
                                <div class="text-3xl font-black text-slate-900">128</div>
                                <div class="mt-1 text-sm text-slate-500">Barang Berputar</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-slate-900">86</div>
                                <div class="mt-1 text-sm text-slate-500">Digunakan Kembali</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-slate-900">54</div>
                                <div class="mt-1 text-sm text-slate-500">Siswa Terhubung</div>
                            </div>
                        </div>
                    </div>
                    <div class="relative flex items-center justify-center">
                        <div class="relative grid w-full max-w-[440px] grid-cols-2 gap-4">
                            <div class="rounded-[28px] bg-white p-4 shadow-xl shadow-slate-200/70">
                                <img src="{{ asset('Images/kalkulator.png') }}" alt="Kalkulator" class="h-28 w-full rounded-2xl object-cover">
                                <div class="mt-3 text-center text-sm font-semibold text-slate-700">Kalkulator</div>
                            </div>
                            <div class="rounded-[28px] bg-white p-4 shadow-xl shadow-slate-200/70">
                                <img src="{{ asset('Images/seragam-kegiatan.jpeg') }}" alt="Seragam kegiatan" class="h-28 w-full rounded-2xl object-cover">
                                <div class="mt-3 text-center text-sm font-semibold text-slate-700">Seragam Kegiatan</div>
                            </div>
                            <div class="rounded-[28px] bg-white p-4 shadow-xl shadow-slate-200/70">
                                <img src="{{ asset('Images/seragam-sekolah.png') }}" alt="Seragam sekolah" class="h-28 w-full rounded-2xl object-cover">
                                <div class="mt-3 text-center text-sm font-semibold text-slate-700">Seragam Sekolah</div>
                            </div>
                            <div class="rounded-[28px] bg-white p-4 shadow-xl shadow-slate-200/70">
                                <img src="{{ asset('Images/tas.png') }}" alt="Tas" class="h-28 w-full rounded-2xl object-cover">
                                <div class="mt-3 text-center text-sm font-semibold text-slate-700">Tas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="cara-kerja" class="mt-16">
                <div class="mb-8 text-center">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-slate-500">Cara Kerja</p>
                    <h2 class="mt-3 text-3xl font-black tracking-[-0.05em] text-slate-900">Bagaimana LOOPIN Bekerja?</h2>
                </div>
                <div class="grid gap-5 md:grid-cols-3">
                    <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-xl font-black text-blue-700">01</div>
                        <h3 class="text-2xl font-bold text-slate-900">Bagikan</h3>
                        <p class="mt-3 text-slate-600">Unggah barang yang sudah tidak dipakai, namun masih layak dan bermanfaat untuk orang lain.</p>
                    </div>
                    <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-xl font-black text-blue-700">02</div>
                        <h3 class="text-2xl font-bold text-slate-900">Temukan</h3>
                        <p class="mt-3 text-slate-600">Jelajahi kebutuhan sekolahmu di katalog dan pilih barang yang benar-benar kamu butuhkan.</p>
                    </div>
                    <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-xl font-black text-blue-700">03</div>
                        <h3 class="text-2xl font-bold text-slate-900">Gunakan Kembali</h3>
                        <p class="mt-3 text-slate-600">Barang berpindah ke tangan yang tepat dan tetap membantu siswa lain tanpa terbuang sia-sia.</p>
                    </div>
                </div>
            </section>

            <section id="kategori" class="mt-16">
                <div class="mb-8">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-slate-500">Kategori</p>
                    <h2 class="mt-3 text-3xl font-black tracking-[-0.05em] text-slate-900">Temukan Barang yang Kamu Butuhkan</h2>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-7">
                    @php
                        $categories = [
                            ['name' => 'Elektronik', 'icon' => '💻'],
                            ['name' => 'Jaringan', 'icon' => '🔌'],
                            ['name' => 'Perlengkapan', 'icon' => '🧪'],
                            ['name' => 'Seragam', 'icon' => '👕'],
                            ['name' => 'Buku', 'icon' => '📚'],
                            ['name' => 'Multimedia', 'icon' => '🎧'],
                            ['name' => 'Lainnya', 'icon' => '📦'],
                        ];
                    @endphp
                    @foreach ($categories as $category)
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 text-center shadow-sm">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-xl">{{ $category['icon'] }}</div>
                            <div class="mt-3 text-sm font-semibold text-slate-700">{{ $category['name'] }}</div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="tentang" class="mt-16 rounded-[32px] bg-[#0B1220] px-6 py-10 text-white sm:px-10 lg:px-14">
                <div class="text-center">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-blue-300">LOOPIN</p>
                    <h2 class="mt-3 text-3xl font-black tracking-[-0.05em] text-white">Punya barang yang sudah tidak dipakai?</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-base text-slate-300">
                        Jangan biarkan barang layak pakai menumpuk di rumah. Sirkulasikan kembali ke siswa lain yang membutuhkannya agar manfaatnya terus terasa.
                    </p>
                    <a href="{{ route('register') }}" class="mt-8 inline-flex rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500">Mulai Bagikan</a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>