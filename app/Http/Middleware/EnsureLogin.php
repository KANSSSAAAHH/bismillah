<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! session('pengguna_id')) {
            return redirect()->route('login')->with('error', 'Silakan login dulu untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}