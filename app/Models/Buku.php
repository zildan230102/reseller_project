<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Menentukan kolom yang bisa diisi
    protected $fillable = [
        'judul_buku',
        'nama_penulis',
        'kategori_id',
        'isbn',
        'tahun_terbit',
        'ukuran_id',
        'halaman',
        'jenis_kertas_id',
        'jenis_sampul_id',
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

    // Relasi dengan model JenisKertas
    public function jenisKertas()
    {
        return $this->belongsTo(JenisKertas::class, 'jenis_kertas_id');
    }

    // Relasi dengan model JenisSampul
    public function jenisSampul()
    {
        return $this->belongsTo(JenisSampul::class, 'jenis_sampul_id');
    }

    // Relasi dengan model Order melalui tabel pivot order_buku
    // app/Models/Buku.php

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_buku', 'buku_id', 'order_id')
                    ->withPivot('jumlah');  // Jika ada field tambahan di tabel pivot, misalnya jumlah
    }


    // Aksesori untuk mendapatkan nama kategori
    public function getNamaKategoriAttribute()
    {
        return $this->kategori ? $this->kategori->nama_kategori : 'Tidak tersedia';
    }

    // Aksesori untuk mendapatkan ukuran lengkap
    public function getUkuranDetailsAttribute()
    {
        return $this->ukuran ? $this->ukuran->ukuran . ' (' . $this->ukuran->dimensi . ')' : 'Tidak tersedia';
    }

    // Aksesori untuk mendapatkan nama jenis kertas
    public function getNamaJenisKertasAttribute()
    {
        return $this->jenisKertas ? $this->jenisKertas->nama_kertas : 'Tidak tersedia';
    }

    // Aksesori untuk mendapatkan nama jenis sampul
    public function getNamaJenisSampulAttribute()
    {
        return $this->jenisSampul ? $this->jenisSampul->nama_sampul : 'Tidak tersedia';
    }

    // Aksesori untuk mendapatkan harga dalam format IDR
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Aksesori untuk mendapatkan berat dalam format kg
    public function getFormattedBeratAttribute()
    {
        return number_format($this->berat, 2) . ' kg';
    }
}
