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
        'status',             // Status pesanan (e.g., pending, paid, shipped, etc.)
        'metode_pembayaran',  // Metode pembayaran (e.g., cash, transfer)
        'tanggal_pembayaran', // Tanggal pembayaran (nullable)
    ];

    /**
     * Boot method untuk model Order.
     */
    protected static function boot()
    {
        parent::boot();

        // Event sebelum order dibuat
        static::creating(function ($order) {
            // Generate nomor invoice secara otomatis jika toko valid
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
     * - INISIALTOKO: Inisial nama toko.
     * - DDMMYYYY: Tanggal order dibuat.
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
        $initials = collect(explode(' ', $this->toko->nama_toko))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->implode('');

        // Format tanggal
        $date = now()->format('dmY');

        // Hitung jumlah order dari toko ini pada tanggal yang sama
        $count = self::where('toko_id', $this->toko_id)
            ->whereDate('created_at', now()->toDateString())
            ->count() + 1;

        // Tambahkan 3 digit nomor urut
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
    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'order_buku', 'order_id', 'buku_id')
                    ->withPivot('jumlah');  // Jika tabel pivot memiliki kolom tambahan, seperti jumlah
    }

    /**
     * Scope untuk mengambil pesanan berdasarkan status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
