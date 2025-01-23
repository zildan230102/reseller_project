<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;

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

        try {
            $toko = Toko::create($request->all());
            return redirect()->route('toko.index')->with([
                'success' => 'Toko berhasil ditambahkan.',
                'new_toko_id' => $toko->id,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('toko.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Toko $toko)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'marketplace' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        try {
            $toko->update($request->all());
            return redirect()->route('toko.index')->with('success', 'Toko berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('toko.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Toko $toko)
    {
        try {
            $toko->delete();
            return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('toko.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Toko $toko)
    {
        try {
            $toko->update(['is_active' => !$toko->is_active]);
            $status = $toko->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->route('toko.index')->with('success', "Toko berhasil $status.");
        } catch (\Exception $e) {
            return redirect()->route('toko.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
