<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarHadir extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'daftar_hadir';

    // Menentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'notulensi_id',
        'nama',
        'jabatan',
        'paraf',
    ];

    // Definisi relasi: Daftar Hadir dimiliki oleh satu Notulensi
    public function notulensi()
    {
        return $this->belongsTo(Notulensi::class, 'notulensi_id', 'id');
    }
}
