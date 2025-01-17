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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            // Foreign key ke notulensi
            $table->foreignId('notulensi_id')
                ->constrained('notulensi') // memastikan referensi ke tabel 'notulensi'
                ->onDelete('cascade') // ketika data notulensi dihapus, data agenda terkait akan terhapus
                ->comment('ID notulensi yang terkait');
            
            // Kolom untuk judul, pembahasan, keputusan bersama, dan keterangan
            $table->string('judul_agenda')->comment('Judul agenda musyawarah');
            $table->text('pembahasan')->comment('Pembahasan dari agenda');
            $table->text('keputusan_bersama')->comment('Keputusan bersama yang diambil');
            $table->string('keterangan')->nullable()->comment('Keterangan tambahan (opsional)');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
