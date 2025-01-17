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
        Schema::create('daftar_hadir', function (Blueprint $table) {
            $table->id();
            // Foreign key ke notulensi
            $table->foreignId('notulensi_id')
                ->constrained('notulensi') // memastikan referensi ke tabel 'notulensi'
                ->onDelete('cascade') // ketika data notulensi dihapus, data daftar_hadir terkait akan terhapus
                ->comment('ID notulensi yang terkait');
            
            // Kolom untuk nama, jabatan, dan paraf
            $table->string('nama', 255)->comment('Nama peserta');
            $table->string('jabatan', 255)->comment('Jabatan peserta');
            $table->string('paraf', 255)->nullable()->comment('Paraf peserta (opsional)');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_hadir');
    }
};
