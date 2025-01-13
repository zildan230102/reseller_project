<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->date('tanggal'); // Tanggal order
            $table->string('no_hp'); // Nomor handphone pemesan
            $table->unsignedBigInteger('toko_id'); // ID toko (foreign key)
            $table->string('asal_penjualan'); // Asal penjualan
            $table->string('penerima'); // Nama penerima
            $table->string('no_hp_penerima'); // Nomor handphone penerima
            $table->string('alamat_kirim'); // Alamat pengiriman
            $table->string('kelurahan')->nullable(); // Kelurahan (opsional)
            $table->string('kecamatan')->nullable(); // Kecamatan (opsional)
            $table->string('kota')->nullable(); // Kota (opsional)
            $table->string('provinsi')->nullable(); // Provinsi (opsional)
            $table->text('catatan')->nullable(); // Catatan (opsional)
            $table->decimal('total_berat', 8, 2); // Total berat dalam satuan kg
            $table->decimal('grand_total', 10, 2); // Total harga
            $table->string('metode_pembayaran')->default('Belum Ditentukan'); // Metode pembayaran
            $table->timestamp('tanggal_pembayaran')->nullable(); // Tanggal pembayaran (opsional)
            $table->string('no_invoice')->unique(); // Nomor invoice yang unik
            $table->string('kode_booking')->nullable(); // Kode booking (opsional)
            $table->unsignedBigInteger('ekspedisi_id'); // ID ekspedisi (foreign key)
            $table->string('status')->default('pending'); // Status order
            $table->string('status_pembayaran')->default('Belum Lunas'); // Status pembayaran
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key toko_id
            $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('cascade');
            $table->index('toko_id'); // Index untuk performa

            // Foreign key ekspedisi_id
            $table->foreign('ekspedisi_id')->references('id')->on('ekspedisis')->onDelete('cascade');
            $table->index('ekspedisi_id'); // Index untuk performa
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
