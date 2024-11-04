<?php

namespace App\Http\Controllers;

use App\Models\Ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
{
    /**
     * Menampilkan daftar ukuran.
     */
    public function index()
    {
        $ukurans = Ukuran::all(); // Mengambil semua data ukuran
        return view('ukurans.index', compact('ukurans')); // Pastikan view 'ukurans.index' sesuai
    }

    /**
     * Menampilkan form untuk menambah ukuran baru.
     */
    public function create()
    {
        return view('ukurans.create'); // Pastikan view 'ukurans.create' sesuai
    }

    /**
     * Menyimpan ukuran baru.
     */
    public function store(Request $request)
    {
        // Validasi input ukuran
        $request->validate([
            'nama' => 'required|string|max:255',
            'dimensi' => 'required|string|max:255',
        ]);

        // Menyimpan data ukuran baru ke dalam database
        Ukuran::create([
            'nama' => $request->nama,
            'dimensi' => $request->dimensi,
        ]);

        return redirect()->route('ukurans.index')->with('success', 'Ukuran berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail ukuran tertentu.
     */
    public function show(Ukuran $ukuran)
    {
        return view('ukurans.show', compact('ukuran')); // Pastikan view 'ukurans.show' sesuai
    }

    /**
     * Menampilkan form untuk mengedit ukuran.
     */
    public function edit(Ukuran $ukuran)
    {
        return view('ukurans.edit', compact('ukuran')); // Pastikan view 'ukurans.edit' sesuai
    }

    /**
     * Mengupdate data ukuran yang sudah ada.
     */
    public function update(Request $request, Ukuran $ukuran)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'dimensi' => 'required|string|max:255',
        ]);

        // Mengupdate data ukuran di database
        $ukuran->update([
            'nama' => $request->nama,
            'dimensi' => $request->dimensi,
        ]);

        return redirect()->route('ukurans.index')->with('success', 'Ukuran berhasil diupdate.');
    }

    /**
     * Menghapus ukuran dari database.
     */
    public function destroy(Ukuran $ukuran)
    {
        $ukuran->delete(); // Menghapus data ukuran

        return redirect()->route('ukurans.index')->with('success', 'Ukuran berhasil dihapus.');
    }
}
