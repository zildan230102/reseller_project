<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;

class TokoController extends Controller
{
    /**
     * Tampilkan daftar toko.
     */
    public function index()
    {
        $tokos = Toko::all();
        return view('toko.index', compact('tokos'));
    }

    /**
     * Simpan data toko baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'marketplace' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        try {
            Toko::create($request->all());
            return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('toko.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update data toko.
     */
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

    /**
     * Hapus toko.
     */
    public function destroy(Toko $toko)
    {
        try {
            $toko->delete();
            return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('toko.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Ubah status aktif/nonaktif toko.
     */
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
