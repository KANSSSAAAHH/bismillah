@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white border border-slate-200 rounded-2xl p-6">
        <h1 class="text-xl font-bold mb-1">Masuk ke LOOPIN</h1>
        <p class="text-sm text-slate-600 mb-5">Gunakan akun yang sudah terdaftar.</p>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-lg border-slate-300"
                    required>
                @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium">Password</label>
                <input type="password" name="password" class="mt-1 w-full rounded-lg border-slate-300" required>
                @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit"
                class="w-full py-2.5 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700">
                Masuk
            </button>
        </form>

        <p class="text-sm text-center text-slate-600 mt-5">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-emerald-700 font-semibold">Daftar di sini</a>
        </p>
    </div>
@endsection