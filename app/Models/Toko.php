<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Toko extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nama_toko',
        'marketplace',
        'is_active',
    ];

    // Casting created_at dan updated_at ke Carbon instance
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

        // Relasi dengan model Ekspedisi
       
    /**
     * Getter untuk mengakses tanggal_dibuat yang diambil dari created_at.
     *
     * @return string
     */
    public function getTanggalDibuatAttribute()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d');
    }
}
