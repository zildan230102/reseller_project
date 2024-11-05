<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUkuransTable extends Migration
{
    public function up()
    {
        Schema::create('ukurans', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama ukuran (contoh: A5, A4, dll)
            $table->string('dimensi'); // Dimensi ukuran (contoh: 13 x 19 cm)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ukurans');
    }
}

