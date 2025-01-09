<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kolom 'metode_pembayaran'
            $table->string('metode_pembayaran')->nullable()->after('grand_total');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus kolom 'metode_pembayaran'
            $table->dropColumn('metode_pembayaran');
        });
    }
};
