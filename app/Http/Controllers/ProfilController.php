<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Mengirim data user ke view profil
        return view('public.post.profil', compact('user'));
    }
}

