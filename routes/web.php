<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { 
    return view('public.post.index');
});

use App\Http\Controllers\ProfilController;

Route::get('profil', [ProfilController::class, 'data'])->name('public.post.profil');
