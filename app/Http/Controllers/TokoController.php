<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::all(); // Ambil semua data toko
        return view('toko.index', compact('tokos'));
    }

    public function create()
    {
        return view('toko.index');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        Toko::create($request->only(['nama_toko', 'marketplace', 'is_active']));

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Toko berhasil ditambahkan.',
            ]);
        }

        return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    public function edit(Toko $toko)
    {
        return view('toko.edit', compact('toko'));
    }

    public function update(Request $request, Toko $toko)
    {
        $request->validate($this->rules());
        $toko->update([
            'nama_toko' => $request->nama_toko,
            'marketplace' => $request->marketplace,
            'is_active' => $request->is_active,
        ]);
    
        // Redirect ke halaman daftar toko dengan pesan sukses
        return redirect()->route('toko.index')->with('success', 'Toko berhasil diperbarui.');
    }

    public function destroy(Toko $toko)
    {
        // Hapus data toko dari database
        $toko->delete();

        // Redirect ke halaman daftar toko dengan pesan sukses
        return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
    }

    public function toggleStatus(Toko $toko)
    {
        // Toggle status aktif
        $toko->is_active = !$toko->is_active;
        $toko->save(); // Simpan perubahan

        // Redirect ke halaman daftar toko dengan pesan sukses
        return redirect()->route('toko.index')->with('success', 'Status toko berhasil diubah.');
    }

    protected function rules()
    {
        return [
            'nama_toko' => 'required|string|max:255',
            'marketplace' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ];
    }
}
