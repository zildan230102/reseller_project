<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'no_invc',
        'toko_id',
        'no_hp',
        'asal_penjualan',
        'kode_booking',
        'ekspedisi',
        'penerima',
        'no_hp_penerima',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'alamat_kirim',
        'catatan',
        'total_berat',
        'grand_total',
    ];

    // Relasi dengan model Toko
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    // Method untuk membuat nomor invoice otomatis
    public static function generateInvoiceNumber()
    {
        // Format: INV-YYYYMMDD-XXXX
        $prefix = 'INV-';
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', now())->count() + 1; // Menghitung jumlah order hari ini

        return $prefix . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT); // Menghasilkan nomor invoice
    }
}
