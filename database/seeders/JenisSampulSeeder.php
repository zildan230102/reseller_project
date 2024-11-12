<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSampul;

class JenisSampulSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data jenis sampul default
        JenisSampul::create([
            'nama_sampul' => 'Hardcover',
        ]);

        JenisSampul::create([
            'nama_sampul' => 'Softcover',
        ]);

        JenisSampul::create([
            'nama_sampul' => 'Paperback',
        ]);

        JenisSampul::create([
            'nama_sampul' => 'Jacketed',
        ]);

        JenisSampul::create([
            'nama_sampul' => 'Flexi',
        ]);
    }
}
