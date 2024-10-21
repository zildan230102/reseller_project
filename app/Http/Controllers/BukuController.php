<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori; // Mengambil model Kategori
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
{
    // Mengambil semua buku beserta kategorinya
    $bukus = Buku::with('kategori')->get();
    
    // Mengambil semua kategori untuk ditampilkan pada form create/edit
    $kategoris = Kategori::all(); 

    // Mengembalikan view dengan data buku dan kategori
    return view('buku.index', compact('bukus', 'kategoris'));
}

    public function store(Request $request)
    {
        // Validasi input, termasuk berat dalam kg
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'nama_penulis' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isbn' => 'required|string|max:13',
            'tahun_terbit' => 'required|date_format:Y',
            'ukuran' => 'required|string',
            'halaman' => 'required|integer',
            'jenis_kertas' => 'required|string',
            'jenis_sampul' => 'required|string',
            'berat' => 'required|numeric|min:0', // Berat dalam kg
            'harga' => 'required|numeric|min:0',
        ]);

        // Simpan buku dengan berat dalam gram (konversi dari kg ke gram)
        Buku::create([
            'nama_buku' => $request->nama_buku,
            'nama_penulis' => $request->nama_penulis,
            'kategori_id' => $request->kategori_id,
            'isbn' => $request->isbn,
            'tahun_terbit' => $request->tahun_terbit,
            'ukuran' => $request->ukuran,
            'halaman' => $request->halaman,
            'jenis_kertas' => $request->jenis_kertas,
            'jenis_sampul' => $request->jenis_sampul,
            'berat' => $request->berat * 1000, // Konversi kg ke gram
            'harga' => $request->harga,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan');
    }

    public function update(Request $request, Buku $buku)
    {
        // Validasi input termasuk berat dalam kg
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'nama_penulis' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isbn' => 'required|string|max:13',
            'tahun_terbit' => 'required|date_format:Y',
            'ukuran' => 'required|string',
            'halaman' => 'required|integer',
            'jenis_kertas' => 'required|string',
            'jenis_sampul' => 'required|string',
            'berat' => 'required|numeric|min:0', // Berat dalam kg
            'harga' => 'required|numeric|min:0',
        ]);

        // Update data buku dengan berat yang sudah dikonversi ke gram
        $buku->update([
            'nama_buku' => $request->nama_buku,
            'nama_penulis' => $request->nama_penulis,
            'kategori_id' => $request->kategori_id,
            'isbn' => $request->isbn,
            'tahun_terbit' => $request->tahun_terbit,
            'ukuran' => $request->ukuran,
            'halaman' => $request->halaman,
            'jenis_kertas' => $request->jenis_kertas,
            'jenis_sampul' => $request->jenis_sampul,
            'berat' => $request->berat * 1000, // Konversi kg ke gram
            'harga' => $request->harga,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Buku $buku)
    {
        // Hapus buku dari database
        $buku->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Buku berhasil dihapus');
    }

    // Menambahkan metode untuk mendapatkan semua buku
    public function getBukuForOrder()
    {
        return Buku::all(['id', 'nama_buku', 'berat', 'harga']); // Mengambil ID, nama buku, berat, dan harga
    }
}
