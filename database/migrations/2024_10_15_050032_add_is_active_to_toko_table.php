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
        Schema::table('toko', function (Blueprint $table) {
            $table->boolean('is_active')->default(true); // Menambahkan kolom is_active
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('toko', function (Blueprint $table) {
            $table->dropColumn('is_active'); // Menghapus kolom is_active
        });
    }
};
