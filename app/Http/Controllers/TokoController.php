<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::all();
        return view('toko.index', compact('tokos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'marketplace' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        Toko::create($request->all());

        return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    public function update(Request $request, Toko $toko)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'marketplace' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $toko->update($request->all());

        return redirect()->route('toko.index')->with('success', 'Toko berhasil diperbarui.');
    }

    public function destroy(Toko $toko)
    {
        $toko->delete();

        return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
    }

    public function toggleStatus(Toko $toko)
    {
        $toko->is_active = !$toko->is_active;
        $toko->save();

        return redirect()->route('toko.index')->with('success', 'Status toko berhasil diubah.');
    }
}
