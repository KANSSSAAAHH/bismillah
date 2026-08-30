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
<body class="min-h-screen bg-slate-100 text-slate-800">
    <div class="flex min-h-screen items-center justify-center p-4 sm:p-6 lg:p-8">
        <main class="w-full">
            @yield('content')
        </main>
    </div>
</body>
</html>
