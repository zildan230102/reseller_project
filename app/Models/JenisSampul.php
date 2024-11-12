<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSampul extends Model
{
    use HasFactory;

    // Nama tabel yang sesuai dengan konvensi
    protected $table = 'jenis_sampuls';

    // Daftar kolom yang dapat diisi
    protected $fillable = [
        'nama_sampul', // Sesuaikan dengan kolom yang ada di tabel
    ];

    // Relasi dengan tabel Buku
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'jenis_sampul_id');
    }
}
