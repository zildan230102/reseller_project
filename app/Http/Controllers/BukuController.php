<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Ukuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk mengimpor Log

class BukuController extends Controller
{
    // Menampilkan semua buku beserta kategori dan ukuran
    public function index()
    {
        // Mengambil semua buku beserta kategori dan ukuran
        $bukus = Buku::with(['kategori', 'ukuran'])->get();
        
        // Mengambil semua kategori dan ukuran untuk ditampilkan pada form create/edit
        $kategoris = Kategori::all(); 
        $ukurans = Ukuran::all(); // Menambahkan ukuran untuk opsi pada form

        // Mengembalikan view dengan data buku, kategori, dan ukuran
        return view('buku.index', compact('bukus', 'kategoris', 'ukurans'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        // Log data yang diterima
        Log::info('Data yang diterima:', $request->all()); // Gunakan Log yang telah diimpor

        // Validasi input
        $validatedData = $request->validate([
            'nama_buku' => 'required|string|max:255',
            'nama_penulis' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isbn' => 'required|string|max:20',
            'tahun_terbit' => 'required|integer',
            'ukuran_id' => 'required|exists:ukurans,id', // Menggunakan ukuran_id sebagai relasi
            'halaman' => 'required|integer',
            'jenis_kertas' => 'required|string|max:50',
            'jenis_sampul' => 'required|string|max:50',
            'berat' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        // Simpan data ke dalam database
        Buku::create($validatedData);

        // Redirect atau memberikan feedback
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Memperbarui buku yang sudah ada
    public function update(Request $request, Buku $buku)
    {
        // Validasi input untuk memperbarui buku
        $this->validateRequest($request);

        // Update data buku
        $buku->update($this->prepareData($request));

        // Redirect kembali dengan pesan sukses
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diperbarui'); // Ganti dengan rute index
    }

    // Menghapus buku dari database
    public function destroy(Buku $buku)
    {
        // Cek jika buku ada sebelum menghapus
        if ($buku) {
            $buku->delete();
            return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus'); // Ganti dengan rute index
        }

        return redirect()->route('bukus.index')->with('error', 'Buku tidak ditemukan'); // Ganti dengan rute index
    }

    // Menambahkan metode untuk mendapatkan semua buku (misalnya untuk pesanan)
    public function getBukuForOrder()
    {
        return Buku::all(['id', 'nama_buku', 'berat', 'harga']);
    }

    // Metode untuk validasi request
    private function validateRequest(Request $request)
    {
        $request->validate([
            'nama_buku' => 'required|string|max:255',
            'nama_penulis' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isbn' => 'required|string|max:20',
            'tahun_terbit' => 'required|integer',
            'ukuran_id' => 'required|exists:ukurans,id', // Menggunakan ukuran_id sebagai relasi
            'halaman' => 'required|integer',
            'jenis_kertas' => 'required|string|max:50',
            'jenis_sampul' => 'required|string|max:50',
            'berat' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
        ]);
    }

    // Metode untuk menyiapkan data sebelum disimpan
    private function prepareData(Request $request)
    {
        return [
            'nama_buku' => $request->nama_buku,
            'nama_penulis' => $request->nama_penulis,
            'kategori_id' => $request->kategori_id,
            'isbn' => $request->isbn,
            'tahun_terbit' => $request->tahun_terbit,
            'ukuran_id' => $request->ukuran_id, // Pastikan ini adalah ID, bukan objek
            'halaman' => $request->halaman,
            'jenis_kertas' => $request->jenis_kertas,
            'jenis_sampul' => $request->jenis_sampul,
            'berat' => $request->berat,
            'harga' => $request->harga,
        ];
    }
}
