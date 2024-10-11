<?php

use App\Http\Controllers\ProfilController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LogoutController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', function () { 
    return view('public.post.index');
})->middleware('auth');

Auth::routes(['login' => false,'register' => false]);
Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');