<?php

use App\Http\Controllers\ProfilController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { 
    return view('public.post.index');
});


Route::get('profil', [ProfilController::class, 'data'])->name('public.post.profil');

Auth::routes(['login' => false,'register' => false]);
Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
