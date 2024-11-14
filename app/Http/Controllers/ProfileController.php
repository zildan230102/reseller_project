<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function view()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('profile.view', compact('user'));
    }

    // Menampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('profile.edit', compact('user'));
    }

    // Memproses pembaruan profil
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'fullName' => 'required|string|max:255',
            'joinDate' => 'required|date',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'profilePicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
        $user->name = $request->fullName;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->join_date = $request->joinDate;

        // Mengunggah dan menyimpan foto profil baru
        if ($request->hasFile('profilePicture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            // Simpan foto baru
            $path = $request->file('profilePicture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
        
        // Simpan perubahan profil
        $user->save();

        return redirect()->route('profile.view')->with('success', 'Profil berhasil diperbarui!');
    }
}
