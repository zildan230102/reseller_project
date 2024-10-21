<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        Kategori::create(['nama_kategori' => 'Fiksi']);
        Kategori::create(['nama_kategori' => 'Non-Fiksi']);
        Kategori::create(['nama_kategori' => 'Komik']);
        Kategori::create(['nama_kategori' => 'Teknologi']);
        Kategori::create(['nama_kategori' => 'Karya Ilmiah']);
        Kategori::create(['nama_kategori' => 'Sejarah']);
        Kategori::create(['nama_kategori' => 'Novel']);
        Kategori::create(['nama_kategori' => 'Buku Panduan']);
        Kategori::create(['nama_kategori' => 'E-Book']);
        Kategori::create(['nama_kategori' => 'Budaya']);
        Kategori::create(['nama_kategori' => 'Antalogi']);
        Kategori::create(['nama_kategori' => 'Sains']);
        
        
    }
}
