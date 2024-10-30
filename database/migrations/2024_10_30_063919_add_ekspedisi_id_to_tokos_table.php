<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tokos', function (Blueprint $table) {
            $table->foreignId('ekspedisi_id')->constrained('ekspedisis')->onDelete('cascade'); // Add foreign key
        });
    }
    
    public function down()
    {
        Schema::table('tokos', function (Blueprint $table) {
            $table->dropForeign(['ekspedisi_id']);
            $table->dropColumn('ekspedisi_id');
        });
    }
    
};
