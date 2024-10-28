<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_hp');
            $table->foreignId('toko_id')->constrained();
            $table->string('asal_penjualan');
            $table->string('penerima');
            $table->string('no_hp_penerima');
            $table->text('alamat_kirim');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->text('catatan')->nullable();
            $table->decimal('total_berat', 8, 2);
            $table->decimal('grand_total', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
