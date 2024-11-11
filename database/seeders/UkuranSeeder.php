<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UkuranSeeder extends Seeder
{
    public function run()
    {
        DB::table('ukurans')->insert([
            ['ukuran' => 'A4', 'dimensi' => '21.0 x 29.7 cm'],
            ['ukuran' => 'A5', 'dimensi' => '14.8 x 21.0 cm'],
            ['ukuran' => 'B5', 'dimensi' => '17.6 x 25.0 cm'],
            ['ukuran' => 'Letter', 'dimensi' => '21.6 x 27.9 cm'],
            ['ukuran' => 'Legal', 'dimensi' => '21.6 x 35.6 cm'],
        ]);
    }
}
