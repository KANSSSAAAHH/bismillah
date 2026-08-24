<?php

use Illuminate\Support\Facades\Route;

// ==========================================
// 1. HALAMAN UTAMA & AUTH
// ==========================================

// Beranda / Dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Halaman Login (GET)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses Login (POST - Simulasi sementara)
Route::post('/login', function () {
    // Nanti di sini kita buat logic autentikasi ke tabel 'pengguna'
    return redirect()->route('dashboard');
})->name('login.post');

// Proses Logout (POST)
Route::post('/logout', function () {
    // Nanti di sini kita buat logic logout
    return redirect()->route('dashboard');
})->name('logout');


// ==========================================
// 2. PLACEHOLDER ROUTE (Agar Sidebar Tidak Error)
// ==========================================
// Kita akan isi halaman-halaman ini satu per satu nanti

Route::get('/items', function () {
    return view('items.index'); // Nanti kita buat
})->name('items.index');

Route::get('/my-items', function () {
    return view('my-items.index'); // Nanti kita buat
})->name('my-items.index');

Route::get('/requests', function () {
    return view('requests.index'); // Nanti kita buat
})->name('requests.index');

Route::get('/impact', function () {
    return view('impact.index'); // Nanti kita buat
})->name('impact.index');

Route::get('/profile', function () {
    return view('profile.edit'); // Nanti kita buat
})->name('profile.edit');