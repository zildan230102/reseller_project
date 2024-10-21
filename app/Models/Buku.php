<?php

// app/Models/Buku.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_buku',
        'nama_penulis',
        'kategori_id',
        'isbn',
        'tahun_terbit',
        'ukuran',
        'halaman',
        'jenis_kertas',
        'jenis_sampul',
        'berat',
        'harga',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
