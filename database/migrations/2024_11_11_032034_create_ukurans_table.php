<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ukurans', function (Blueprint $table) {
            $table->id();
            $table->string('ukuran');    // Kolom untuk nama ukuran
            $table->string('dimensi');   // Kolom untuk dimensi ukuran
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ukurans');
    }
};
