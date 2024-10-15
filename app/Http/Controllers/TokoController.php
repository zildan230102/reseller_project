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
        // Ambil semua data toko dari database
        $tokos = Toko::all();

        // Kembalikan view index dengan data toko
        return view('toko.index', compact('tokos'));
    }

    /**
     * Tampilkan form untuk menambahkan toko baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Kembalikan view form tambah toko
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
    // Validasi input
    $request->validate($this->rules());

    // Simpan data toko baru ke database
    $toko = Toko::create($request->only(['nama_toko', 'marketplace', 'tanggal_dibuat', 'is_active']));

    // Kembalikan respons JSON
    return response()->json(['success' => true, 'data' => $toko]);
}


    
    
    /**
     * Tampilkan form untuk mengedit toko.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\View\View
     */
    public function edit(Toko $toko)
    {
        // Kembalikan view edit dengan data toko
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
        // Validasi input
        $request->validate($this->rules());

        // Tentukan marketplace yang akan disimpan
        $marketplace = $request->marketplace === 'lainnya' ? $request->custom_marketplace : $request->marketplace;

        // Update data toko
        $toko->update(array_merge(
            $request->only(['nama_toko', 'tanggal_dibuat', 'is_active']),
            ['marketplace' => $marketplace] // Update marketplace
        ));

        // Redirect ke halaman daftar toko dengan pesan sukses
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
        $toko->is_active = !$toko->is_active; // Ganti status
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
        'marketplace' => 'required|string|max:255', // Hapus pilihan 'lainnya'
        'tanggal_dibuat' => 'required|date',
    ];
}

}
