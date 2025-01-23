<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function view()
    {
        $user = Auth::user(); 
        return view('profile.view', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user(); 
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
        
        if ($request->hasFile('profilePicture')) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            $path = $request->file('profilePicture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
        
        $user->save();
        return redirect()->route('profile.view')->with('success', 'Profil berhasil diperbarui!');
    }
}
