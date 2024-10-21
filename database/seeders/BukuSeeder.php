<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run()
    {
        Buku::create([
            'nama_buku' => 'Judul Buku 1',
            'nama_penulis' => 'Penulis 1',
            'kategori_id' => 1, // Pastikan kategori dengan ID ini ada
            'isbn' => '1234567890123',
            'tahun_terbit' => 2023,
            'ukuran' => 'A5',
            'halaman' => 200,
            'jenis_kertas' => 'HVS',
            'jenis_sampul' => 'Softcover',
            'harga' => 150000,
        ]);
        // Tambahkan data buku lainnya sesuai kebutuhan
    }
}
