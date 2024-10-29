<?php

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
        'no_invoice',
        'kode_booking', // Tambahkan kode_booking di sini
    ];

    public static function boot()
    {
        parent::boot();

        // Menggunakan event `creating` untuk menghasilkan no_invoice
        static::creating(function ($order) {
            // Pastikan toko terkait sudah ada sebelum menghasilkan nomor invoice
            if ($order->toko) {
                $order->no_invoice = $order->generateInvoiceNumber();
            }
        });
    }

    public function generateInvoiceNumber()
    {
        // Ambil inisial dari setiap kata di nama toko
        $words = explode(' ', $this->toko->nama_toko);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1)); // Ambil huruf pertama setiap kata dan jadikan huruf besar
        }

        // Format tanggal saat ini menjadi DDMMYYYY
        $date = now()->format('dmY');

        // Ambil ID order dan format menjadi 3 digit dengan leading zero jika perlu
        $id = str_pad($this->id, 3, '0', STR_PAD_LEFT);

        return "{$initials}-{$date}-{$id}";
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
