<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Ukuran;
use App\Models\JenisKertas;
use App\Models\JenisSampul;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori', 'ukuran', 'jenisKertas', 'jenisSampul')->get();
        $kategoris = Kategori::all(); 
        $ukurans = Ukuran::all(); 
        $jenisKertas = JenisKertas::all();
        $jenisSampuls = JenisSampul::all();

        return view('buku.index', compact('bukus', 'kategoris', 'ukurans', 'jenisKertas', 'jenisSampuls'));
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        Buku::create($this->prepareData($request));
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function update(Request $request, Buku $buku)
    {
        $this->validateRequest($request, $buku->id);
        $buku->update($this->prepareData($request));
        return redirect()->route('bukus.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function getBukuForOrder()
    {
        return Buku::all(['id', 'judul_buku', 'berat', 'harga']);
    }

    private function validateRequest(Request $request, $id = null)
    {
        return $request->validate([
            'judul_buku' => 'required|string|max:255',
            'nama_penulis' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isbn' => 'required|string|max:13|unique:bukus,isbn',
            'tahun_terbit' => 'required|integer|digits:4',
            'ukuran_id' => 'required|exists:ukurans,id',
            'halaman' => 'required|integer|min:1',
            'jenis_kertas_id' => 'required|exists:jenis_kertas,id',
            'jenis_sampul_id' => 'required|exists:jenis_sampuls,id',
            'berat' => 'required|numeric|min:0.01',
            'harga' => 'required|numeric|min:0',
        ]);
    }

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
            'jenis_kertas_id' => $request->jenis_kertas_id,
            'jenis_sampul_id' => $request->jenis_sampul_id,
            'berat' => $request->berat,
            'harga' => $request->harga,
        ];
    }
}
