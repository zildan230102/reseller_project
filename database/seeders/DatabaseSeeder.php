<?php

namespace Database\Seeders;

use App\Models\Ukuran;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UkuranSeeder; // Pastikan untuk mengimpor UkuranSeeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            EkspedisiSeeder::class,
            IndoRegionSeeder::class, 
            JenisKertasSeeder::class,
            JenisSampulSeeder::class,
            KategoriSeeder::class,
            UkuranSeeder::class
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            // Memanggil UkuranSeeder
            $this->call(UkuranSeeder::class);
    }
}
