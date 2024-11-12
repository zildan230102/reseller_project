<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    use HasFactory;

    protected $table = 'ukurans';

    protected $fillable = [
        'ukuran',
        'dimensi',
    ];

    // Relasi dengan model Buku
    public function bukus()
    {
        return $this->hasMany(Buku::class);
    }
}
