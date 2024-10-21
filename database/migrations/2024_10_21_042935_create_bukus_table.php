<?php

// database/migrations/xxxx_xx_xx_create_bukus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id(); // ID buku
            $table->string('nama_buku'); // Nama buku
            $table->string('nama_penulis'); // Nama penulis
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade'); // ID kategori
            $table->string('isbn')->unique(); // ISBN buku
            $table->year('tahun_terbit'); // Tahun terbit
            $table->string('ukuran'); // Ukuran buku
            $table->integer('halaman'); // Jumlah halaman
            $table->string('jenis_kertas'); // Jenis kertas
            $table->string('jenis_sampul'); // Jenis sampul
            $table->decimal('berat', 8, 2); // Berat dalam kg
            $table->decimal('harga', 10, 2); // Harga buku
            $table->timestamps(); // Kolom timestamps (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('bukus');
    }
}


