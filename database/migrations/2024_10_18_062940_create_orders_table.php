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
            $table->string('no_invc')->unique();
            $table->foreignId('toko_id')->constrained()->onDelete('cascade');
            $table->string('no_hp');
            $table->string('asal_penjualan');
            $table->string('kode_booking');
            $table->string('ekspedisi');
            $table->string('penerima');
            $table->string('no_hp_penerima');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->text('alamat_kirim');
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
