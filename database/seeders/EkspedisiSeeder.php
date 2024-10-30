<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekspedisi;

class EkspedisiSeeder extends Seeder
{
    public function run()
    {
        Ekspedisi::create([
            'nama_ekspedisi' => 'JNE',
            'kode_ekspedisi' => 'jne',
        ]);

        Ekspedisi::create([
            'nama_ekspedisi' => 'Tiki',
            'kode_ekspedisi' => 'tiki',
        ]);

        Ekspedisi::create([
            'nama_ekspedisi' => 'JNT',
            'kode_ekspedisi' => 'jnt',
        ]);

        Ekspedisi::create([
            'nama_ekspedisi' => 'Sicepat',
            'kode_ekspedisi' => 'sicepat',
        ]);

        Ekspedisi::create([
            'nama_ekspedisi' => 'Ninja Express',
            'kode_ekspedisi' => 'ninja express',
        ]);

        Ekspedisi::create([
            'nama_ekspedisi' => 'Gosend',
            'kode_ekspedisi' => 'gosend',
        ]);

        Ekspedisi::create([
            'nama_ekspedisi' => 'SPX Express',
            'kode_ekspedisi' => 'spx express',
        ]);

        // Tambahkan lebih banyak ekspedisi jika diperlukan
    }
}

