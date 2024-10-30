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
        'is_active',
    ];

 


    /**
     * Hubungan dengan model Order jika diperlukan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
