<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function view()
{
    $user = Auth::user(); // Mengambil data pengguna yang sedang login
    return view('profile.view', compact('user'));
}

public function edit()
{
    $user = Auth::user(); // Mengambil data pengguna yang sedang login
    return view('profile.edit', compact('user'));
}

public function update(Request $request)
{
    $request->validate([
        'fullName' => 'required|string|max:255',
        'joinDate' => 'required|date',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|string|email|max:255',
        'profilePicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();
    $user->name = $request->fullName;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->join_date = $request->joinDate;

    // Mengunggah foto profil
    if ($request->hasFile('profilePicture')) {
        $path = $request->file('profilePicture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
    }

    $user->save();

    return redirect()->route('profile.view')->with('success', 'Profil berhasil diperbarui!');
}

    
}
