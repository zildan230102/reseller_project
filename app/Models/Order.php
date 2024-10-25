<?php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'no_hp',
        'toko_id',
        'asal_penjualan',
        'penerima',
        'no_hp_penerima',
        'alamat_kirim',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'catatan',
        'total_berat',
        'grand_total',
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}

