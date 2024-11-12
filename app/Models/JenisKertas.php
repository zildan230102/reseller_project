<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKertas extends Model
{
    use HasFactory;

    // Nama tabel secara eksplisit (opsional, Laravel akan otomatis mendeteksi)
    protected $table = 'jenis_kertas';

    // Kolom-kolom yang bisa diisi (mass assignable)
    protected $fillable = ['nama_kertas'];

    /**
     * Relasi ke model Buku
     * Setiap jenis kertas bisa digunakan oleh banyak buku.
     */
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'jenis_kertas_id');
    }
}
