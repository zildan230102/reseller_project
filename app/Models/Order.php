<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi (mass assignable).
     */
    protected $fillable = [
        'tanggal',
        'no_hp',
        'toko_id',
        'ekspedisi_id',
        'asal_penjualan',
        'penerima',
        'no_hp_penerima',
        'alamat_kirim',
        'catatan',
        'total_berat',
        'grand_total',
        'no_invoice',
        'kode_booking',
        'status',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'kecamatan',
        'kota',
        'kelurahan',
        'provinsi',
    ];

    /**
     * Cast kolom tertentu ke tipe data yang sesuai.
     */
    protected $casts = [
        'tanggal_pembayaran' => 'datetime',
        'tanggal' => 'datetime',
        'grand_total' => 'float',
        'total_berat' => 'float',
    ];

    /**
     * Boot method untuk model Order.
     */
    protected static function boot()
    {
        parent::boot();

        // Event sebelum order dibuat
        static::creating(function ($order) {
            if (!$order->toko) {
                throw new \Exception('Toko tidak ditemukan untuk menghasilkan nomor invoice.');
            }

            $order->no_invoice = $order->generateInvoiceNumber();
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
     */
    public function generateInvoiceNumber()
    {
        if (!$this->toko) {
            throw new \Exception('Toko tidak ditemukan untuk menghasilkan nomor invoice.');
        }

        // Ambil inisial nama toko
        $initials = Str::upper(
            collect(explode(' ', $this->toko->nama_toko))
                ->map(fn($word) => substr($word, 0, 1))
                ->implode('')
        );

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
     * Relasi ke lokasi administratif (Kelurahan).
     */
    public function village()
    {
        return $this->belongsTo(Village::class, 'kelurahan');
    }

    /**
     * Relasi ke lokasi administratif (Kecamatan).
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'kecamatan');
    }

    /**
     * Relasi ke lokasi administratif (Kabupaten/Kota).
     */
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kota');
    }

    /**
     * Relasi ke lokasi administratif (Provinsi).
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi');
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

    /**
     * Scope untuk filter berdasarkan tanggal.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('tanggal', $date);
    }
}
