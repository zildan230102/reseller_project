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
        'ekspedisi_id',
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
        'kode_booking',
    ];

    /**
     * Boot method untuk model Order.
     */
    public static function boot()
    {
        parent::boot();

        // Event saat model sedang dibuat
        static::creating(function ($order) {
            // Generate no_invoice hanya jika toko valid
            if ($order->toko) {
                $order->no_invoice = $order->generateInvoiceNumber();
            } else {
                throw new \Exception('Toko tidak ditemukan untuk menghasilkan nomor invoice.');
            }
        });
    }

    /**
     * Generate nomor invoice dengan format khusus.
     *
     * Format: INISIALTOKO-DDMMYYYY-XXX
     * - INISIALTOKO: Inisial nama toko (huruf besar dari setiap kata).
     * - DDMMYYYY: Tanggal pada saat order dibuat.
     * - XXX: Urutan order pada hari yang sama (3 digit).
     *
     * @return string
     * @throws \Exception
     */
    public function generateInvoiceNumber()
    {
        if (!$this->toko) {
            throw new \Exception('Toko tidak ditemukan untuk menghasilkan nomor invoice.');
        }

        // Ambil inisial nama toko
        $words = explode(' ', $this->toko->nama_toko);
        $initials = implode('', array_map(fn($word) => strtoupper(substr($word, 0, 1)), $words));

        // Format tanggal saat ini
        $date = now()->format('dmY');

        // Hitung jumlah order dari toko ini pada hari yang sama
        $count = self::where('toko_id', $this->toko_id)
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        // Format menjadi 3 digit
        $countFormatted = str_pad($count, 3, '0', STR_PAD_LEFT);

        return "{$initials}-{$date}-{$countFormatted}";
    }

    /**
     * Relasi ke model Toko.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    /**
     * Relasi ke model Ekspedisi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ekspedisi()
    {
        return $this->belongsTo(Ekspedisi::class);
    }

    /**
     * Relasi ke model Buku melalui tabel pivot order_buku.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
   // app/Models/Order.php

    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'order_buku', 'order_id', 'buku_id')
                    ->withPivot('jumlah');  // Jika ada field tambahan di tabel pivot, misalnya jumlah
    }

}
