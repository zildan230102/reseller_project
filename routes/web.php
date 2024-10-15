<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokoController;

// Rute untuk homepage yang mengarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute untuk dashboard yang dilindungi otentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('public.post.index');
    });

    // Rute untuk profil pengguna
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'view'])->name('profile.view');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/', [ProfileController::class, 'update'])->name('profile.update');
    });

    // Rute untuk Toko
    Route::resource('toko', TokoController::class);
    Route::post('/toko/{toko}/toggle-status', [TokoController::class, 'toggleStatus'])->name('toko.toggle-status');

    // Rute untuk logout
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

// Menonaktifkan rute Auth default dan menggunakan Livewire untuk guest
Auth::routes(['login' => false, 'register' => false]);

// Rute untuk guest
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});
