<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisKertas = [
            ['nama_kertas' => 'HVS'],
            ['nama_kertas' => 'Art Paper'],
            ['nama_kertas' => 'Matt Paper'],
            ['nama_kertas' => 'Ivory'],
            ['nama_kertas' => 'Book Paper'],
            ['nama_kertas' => 'Samson Kraft'],
            ['nama_kertas' => 'BC (Blues Check)'],
            ['nama_kertas' => 'Duplex'],
        ];

        DB::table('jenis_kertas')->insert($jenisKertas);
    }
}
