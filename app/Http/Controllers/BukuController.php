<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Ukuran;
use App\Models\JenisKertas;
use App\Models\JenisSampul; // Import model JenisSampul
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        // Mengambil semua data buku beserta relasi kategori, ukuran, jenis kertas, dan jenis sampul
        $bukus = Buku::with('kategori', 'ukuran', 'jenisKertas', 'jenisSampul')->get();
        
        // Mengambil semua data kategori, ukuran, jenis kertas, dan jenis sampul untuk dropdown pada form create/edit
        $kategoris = Kategori::all(); 
        $ukurans = Ukuran::all(); 
        $jenisKertas = JenisKertas::all();
        $jenisSampuls = JenisSampul::all(); // Ambil semua data jenis sampul

        // Mengembalikan view 'buku.index' dengan data buku, kategori, ukuran, jenis kertas, dan jenis sampul
        return view('buku.index', compact('bukus', 'kategoris', 'ukurans', 'jenisKertas', 'jenisSampuls'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk menambah buku
        $this->validateRequest($request);

        // Simpan data buku ke database
        Buku::create($this->prepareData($request));

        // Redirect kembali ke halaman index buku dengan pesan sukses
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function update(Request $request, Buku $buku)
    {
        // Validasi inputan untuk update buku
        $this->validateRequest($request, $buku->id); // Memasukkan id untuk pengecualian ISBN saat update

        // Update data buku
        $buku->update($this->prepareData($request));

        // Kembalikan ke halaman index buku dengan pesan sukses
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Buku $buku)
    {
        // Hapus buku dari database
        $buku->delete();

        // Redirect kembali ke halaman index buku dengan pesan sukses
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus');
    }

    public function getBukuForOrder()
    {
        // Mengambil informasi dasar buku yang dibutuhkan untuk pemesanan
        return Buku::all(['id', 'judul_buku', 'berat', 'harga']);
    }

    // Metode untuk validasi input dari request
    private function validateRequest(Request $request, $id = null)
    {
        // Validasi input dengan pengecualian ISBN saat melakukan update
        return $request->validate([
            'judul_buku' => 'required|string|max:255',
            'nama_penulis' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isbn' => 'required|string|max:13|unique:bukus,isbn,' . $id, // Menghindari validasi ISBN yang sama saat update
            'tahun_terbit' => 'required|integer|digits:4',  // Validasi tahun harus 4 digit
            'ukuran_id' => 'required|exists:ukurans,id',
            'halaman' => 'required|integer|min:1',
            'jenis_kertas_id' => 'required|exists:jenis_kertas,id', // Memastikan jenis kertas valid
            'jenis_sampul_id' => 'required|exists:jenis_sampuls,id', // Validasi untuk jenis sampul menggunakan ID
            'berat' => 'required|numeric|min:0.01',
            'harga' => 'required|numeric|min:0',
        ]);
    }

    // Menyiapkan data dari request untuk penyimpanan atau update
    private function prepareData(Request $request)
    {
        return [
            'judul_buku' => $request->judul_buku,
            'nama_penulis' => $request->nama_penulis,
            'kategori_id' => $request->kategori_id,
            'isbn' => $request->isbn,
            'tahun_terbit' => $request->tahun_terbit,
            'ukuran_id' => $request->ukuran_id,
            'halaman' => $request->halaman,
            'jenis_kertas_id' => $request->jenis_kertas_id, // Memastikan jenis_kertas_id sesuai dengan relasi
            'jenis_sampul_id' => $request->jenis_sampul_id, // Menggunakan ID untuk jenis sampul
            'berat' => $request->berat,
            'harga' => $request->harga,
        ];
    }
}
