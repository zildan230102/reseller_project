<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi massal
    protected $fillable = [
        'nama',    // Nama ukuran (contoh: A5)
        'dimensi'  // Dimensi ukuran (contoh: 13 x 19 cm), jika ada di tabel
    ];

    // Menambahkan relasi ke model Buku
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'ukuran_id'); // Relasi satu ukuran memiliki banyak buku
    }
}
