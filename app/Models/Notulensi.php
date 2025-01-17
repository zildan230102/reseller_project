<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulensi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'notulensi';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'tanggal',
        'waktu',
        'tempat',
        'pemimpin_musyawarah',
        'pimpinan_paraf',
        'notulis',
        'notulis_paraf',
    ];

    // Relasi: Satu Notulensi memiliki banyak Daftar Hadir
    public function daftarHadir()
    {
        return $this->hasMany(DaftarHadir::class, 'notulensi_id', 'id');
    }

    // Relasi: Satu Notulensi memiliki banyak Agenda
    public function agenda()
    {
        return $this->hasMany(Agenda::class, 'notulensi_id', 'id');
    }
}
