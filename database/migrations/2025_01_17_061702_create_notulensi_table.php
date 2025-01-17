<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notulensi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->comment('Tanggal musyawarah');
            $table->time('waktu')->comment('Waktu musyawarah');
            $table->string('tempat', 255)->comment('Tempat musyawarah');
            $table->string('pemimpin_musyawarah', 255)->comment('Nama pemimpin musyawarah');
            $table->string('pimpinan_paraf', 255)->nullable()->comment('Paraf pemimpin musyawarah');
            $table->string('notulis', 255)->comment('Nama notulis');
            $table->string('notulis_paraf', 255)->nullable()->comment('Paraf notulis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notulensi');
    }
};
