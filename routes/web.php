<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

dashboard_page
Route::get('/dashboard', function () {
    return view('public.post.index');
});

