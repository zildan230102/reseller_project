<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;

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


Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');




Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');