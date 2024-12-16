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
            $table->unsignedBigInteger('village_id'); // ID Kelurahan
            $table->unsignedBigInteger('district_id'); // ID Kecamatan
            $table->unsignedBigInteger('regency_id'); // ID Kota/Kabupaten
            $table->unsignedBigInteger('province_id'); // ID Provinsi
            $table->text('catatan')->nullable(); // Catatan (opsional)
            $table->decimal('total_berat', 8, 2); // Total berat dalam satuan kg
            $table->decimal('grand_total', 10, 2); // Total harga
            $table->string('no_invoice')->unique(); // Nomor invoice yang unik
            $table->string('kode_booking')->nullable(); // Kode booking (opsional)
            $table->unsignedBigInteger('ekspedisi_id'); // ID ekspedisi (foreign key)
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key toko_id
            $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('cascade');

            // Foreign key ekspedisi_id
            $table->foreign('ekspedisi_id')->references('id')->on('ekspedisis')->onDelete('cascade');

            // Foreign keys untuk lokasi administratif
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('restrict');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('restrict');
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('restrict');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
 