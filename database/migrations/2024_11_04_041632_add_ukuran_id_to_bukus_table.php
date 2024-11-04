<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUkuranIdToBukusTable extends Migration
{
    public function up()
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->unsignedBigInteger('ukuran_id')->nullable()->after('kategori_id');
            $table->foreign('ukuran_id')->references('id')->on('ukurans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropForeign(['ukuran_id']);
            $table->dropColumn('ukuran_id');
        });
    }
}

