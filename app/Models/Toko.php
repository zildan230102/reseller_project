<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Toko extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_toko',
        'marketplace',
        'tanggal_dibuat',
        'is_active',
    ];

    // Tentukan bahwa tanggal_dibuat harus di-cast ke Carbon
    protected $casts = [
        'tanggal_dibuat' => 'datetime',
    ];
}
