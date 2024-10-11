<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the logout process.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();  // Menggunakan facade Auth untuk logout pengguna

        // Menghapus semua session yang ada
        $request->session()->invalidate();

        // Membuat session baru
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login setelah logout
        return redirect('/login');
    }
}
