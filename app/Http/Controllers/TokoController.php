<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    /**
     * Tampilkan daftar toko.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tokos = Toko::all(); // Ambil semua data toko
        return view('toko.index', compact('tokos'));
    }

    /**
     * Tampilkan form untuk menambahkan toko baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('toko.create');
    }

    /**
     * Simpan data toko baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());
        Toko::create($request->only(['nama_toko', 'marketplace', 'is_active']));
        return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit toko.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\View\View
     */
    public function edit(Toko $toko)
    {
        return view('toko.edit', compact('toko'));
    }

    /**
     * Perbarui data toko yang ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Toko $toko)
    {
        $request->validate($this->rules());
        $toko->update($request->only(['nama_toko', 'marketplace', 'is_active']));
        return redirect()->route('toko.index')->with('success', 'Toko berhasil diperbarui.');
    }

    /**
     * Hapus toko dari database.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Toko $toko)
    {
        // Hapus data toko dari database
        $toko->delete();

        // Redirect ke halaman daftar toko dengan pesan sukses
        return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
    }

    /**
     * Ubah status toko (aktif/non-aktif).
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(Toko $toko)
    {
        // Toggle status aktif
        $toko->is_active = !$toko->is_active;
        $toko->save(); // Simpan perubahan

        // Redirect ke halaman daftar toko dengan pesan sukses
        return redirect()->route('toko.index')->with('success', 'Status toko berhasil diubah.');
    }

    /**
     * Rules untuk validasi input.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'nama_toko' => 'required|string|max:255',
            'marketplace' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ];
    }
}
