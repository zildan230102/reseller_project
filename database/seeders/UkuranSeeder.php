<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ukuran;

class UkuranSeeder extends Seeder
{
    public function run()
    {
        $ukurans = [
            ['nama' => 'A5', 'dimensi' => '13 x 19 cm'],
            ['nama' => 'A4', 'dimensi' => '21 x 29.7 cm'],
            ['nama' => 'A6', 'dimensi' => '10.5 x 14.8 cm'],
            ['nama' => 'B5', 'dimensi' => '17.5 x 25 cm'],
            ['nama' => 'Folio F4', 'dimensi' => '21.5 x 33 cm'],
            ['nama' => 'UNESCO', 'dimensi' => '15.5 x 23 cm'],
        ];

        foreach ($ukurans as $ukuran) {
            Ukuran::create($ukuran);
        }
    }
}

