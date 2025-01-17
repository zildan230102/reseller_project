<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'agenda';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'notulensi_id',
        'judul_agenda',
        'pembahasan',
        'keputusan_bersama',
        'keterangan',
    ];

    // Relasi: Agenda dimiliki oleh satu Notulensi
    public function notulensi()
    {
        return $this->belongsTo(Notulensi::class, 'notulensi_id', 'id');
    }
}
