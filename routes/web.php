<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImpactController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. HALAMAN UTAMA & AUTH
// ==========================================

// Beranda / Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Login (dibatasi rate untuk cegah brute-force)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:auth');

// Registrasi
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post')->middleware('throttle:auth');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// 2. KATALOG (PUBLIK)
// ==========================================

Route::get('/items', [ItemController::class, 'index'])->name('items.index');


// ==========================================
// 3. ROUTE YANG WAJIB LOGIN
// (Didaftarkan dulu daripada /items/{barang}
//  agar /items/create tidak tertangkap sebagai detail barang)
// ==========================================

Route::middleware('login')->group(function () {

    // CRUD Barang (kepemilikan dicek di controller)
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{barang}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{barang}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{barang}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::patch('/items/{barang}/status', [ItemController::class, 'updateStatus'])->name('items.status');

    // Ajukan permintaan atas sebuah barang
    Route::post('/items/{barang}/request', [TransaksiController::class, 'minta'])->name('items.request');

    // Barang Saya
    Route::get('/my-items', [ItemController::class, 'mine'])->name('my-items.index');

    // Respect + alur transaksi
    Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
    Route::post('/requests', [RequestController::class, 'simpan'])->name('requests.store');
    Route::post('/requests/{permintaan}/close', [RequestController::class, 'tutup'])->name('requests.close');

    // Aksi transaksi (hanya pemilik barang)
    Route::post('/transaksi/{transaksi}/approve', [TransaksiController::class, 'setujui'])->name('transaksi.approve');
    Route::post('/transaksi/{transaksi}/reject', [TransaksiController::class, 'tolak'])->name('transaksi.reject');
    Route::post('/transaksi/{transaksi}/schedule', [TransaksiController::class, 'jadwalkan'])->name('transaksi.schedule');
    Route::post('/transaksi/{transaksi}/complete', [TransaksiController::class, 'selesai'])->name('transaksi.complete');

    // Notifikasi
    Route::get('/notifications', [NotifikasiController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read-all', [NotifikasiController::class, 'bacaSemua'])->name('notifications.read-all');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


// ==========================================
// 4. DETAIL BARANG (PUBLIK — paling akhir)
// ==========================================

Route::get('/items/{barang}', [ItemController::class, 'show'])->name('items.show');

// Dampak (publik)
Route::get('/impact', [ImpactController::class, 'index'])->name('impact.index');


// ==========================================
// 5. AREA ADMIN (wajib login + role admin)
// ==========================================

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['login', 'role:admin'])
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::put('/users/{pengguna}', [AdminController::class, 'updateRole'])->name('users.role');

        Route::get('/items', [AdminController::class, 'items'])->name('items');
        Route::delete('/items/{barang}', [AdminController::class, 'destroyItem'])->name('items.destroy');

        Route::get('/requests', [AdminController::class, 'requests'])->name('requests');
    });