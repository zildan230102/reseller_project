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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate($this->rules());

        // Simpan data toko baru ke database, created_at otomatis diisi oleh Laravel
        $toko = Toko::create($request->only(['nama_toko', 'marketplace', 'is_active']));

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

        // Update data toko
        $toko->update($request->only(['nama_toko', 'marketplace', 'is_active']));

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
