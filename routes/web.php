<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BukuController;


// Rute untuk homepage yang mengarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute untuk dashboard yang dilindungi otentikasi
Route::middleware('auth')->group(function () {
    // Dashboard utama
    Route::get('/dashboard', function () {
        return view('public.post.index'); // Halaman dashboard
    });

    // Rute untuk profil pengguna
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'view'])->name('profile.view'); // Melihat profil
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Form edit profil
        Route::post('/', [ProfileController::class, 'update'])->name('profile.update'); // Mengupdate profil
    });

    // Rute untuk pengelolaan Toko
    Route::prefix('toko')->group(function () {
        Route::get('/', [TokoController::class, 'index'])->name('toko.index'); // Menampilkan daftar toko
        Route::post('/', [TokoController::class, 'store'])->name('toko.store'); // Menyimpan toko baru
        Route::get('/{toko}/edit', [TokoController::class, 'edit'])->name('toko.edit'); // Form edit toko
        Route::put('/{toko}', [TokoController::class, 'update'])->name('toko.update'); // Mengupdate data toko
        Route::delete('/{toko}', [TokoController::class, 'destroy'])->name('toko.destroy'); // Menghapus toko
        Route::post('/{toko}/toggle-status', [TokoController::class, 'toggleStatus'])->name('toko.toggle-status'); // Mengubah status aktif/tidak aktif
    });
 
    // Rute untuk pengelolaan Orders
    Route::resource('orders', OrderController::class);
    Route::delete('orders/{order}', [OrderController::class, 'destroy']);


    // Rute untuk pengelolaan Buku
    Route::resource('bukus', BukuController::class);
    
    // Menambahkan rute untuk menyimpan buku
    Route::post('/bukus', [BukuController::class, 'store'])->name('bukus.store');


    // Rute untuk logout
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout'); // Logout pengguna
});

// Menonaktifkan rute Auth default dan menggunakan Livewire untuk guest
Auth::routes(['login' => false, 'register' => false]);

// Rute untuk guest
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login'); // Halaman login
    Route::get('/register', Register::class)->name('register'); // Halaman registrasi
});
