<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id(); // ID buku
            $table->string('judul_buku'); // Nama buku
            $table->string('nama_penulis'); // Nama penulis
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade'); // ID kategori
            $table->string('isbn')->unique(); // ISBN buku
            $table->year('tahun_terbit'); // Tahun terbit
            $table->integer('halaman'); // Jumlah halaman
            $table->foreignId('jenis_kertas_id')->constrained('jenis_kertas')->onDelete('cascade'); // ID jenis kertas
            $table->foreignId('jenis_sampul_id')->constrained('jenis_sampuls')->onDelete('cascade'); // Relasi ke jenis_sampul
            $table->decimal('berat', 8, 2); // Berat dalam kg
            $table->decimal('harga', 10, 2); // Harga buku
            $table->foreignId('ukuran_id')->nullable()->constrained('ukurans')->onDelete('set null'); // ID ukuran (opsional)
            $table->timestamps(); // Kolom timestamps (created_at, updated_at)
        });
    }

    public function down()
    {
        // Drop tabel bukus
        Schema::dropIfExists('bukus');
    }
}
