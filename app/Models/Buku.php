<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Menentukan kolom yang bisa diisi
    protected $fillable = [
        'nama_buku',
        'nama_penulis',
        'kategori_id',
        'isbn',
        'tahun_terbit',
        'ukuran_id',
        'halaman',
        'jenis_kertas',
        'jenis_sampul',
        'berat', 
        'harga',
    ];

    // Menentukan tipe data untuk beberapa kolom
    protected $casts = [
        'berat' => 'float',
        'harga' => 'float',
    ];
   
    // Relasi dengan model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi dengan model Ukuran
    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class);
    }

    // Menambahkan aksesori untuk mendapatkan nama kategori
    public function getNamaKategoriAttribute()
    {
        return $this->kategori ? $this->kategori->nama_kategori : 'Tidak tersedia';
    }

    // Menambahkan aksesori untuk mendapatkan ukuran lengkap
    public function getUkuranDetailsAttribute()
    {
        return $this->ukuran ? $this->ukuran->ukuran . ' (' . $this->ukuran->dimensi . ')' : 'Tidak tersedia';
    }

    // Menambahkan aksesori untuk mendapatkan harga dalam format IDR
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
