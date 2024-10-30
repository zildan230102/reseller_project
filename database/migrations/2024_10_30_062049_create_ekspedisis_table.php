<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkspedisisTable extends Migration
{
    public function up()
    {
        Schema::create('ekspedisis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ekspedisi');
            $table->string('kode_ekspedisi')->unique();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ekspedisis');
    }
}
