<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ekspedisi',
        'kode_ekspedisi',
    ];

    // Hubungan dengan model Order
    public function orders()
    {
        return $this->hasMany(Order::class); // Hubungan dengan model Order
    }
}
