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
        Schema::create('form_kp_bejana_tekan', function (Blueprint $table) {
            $table->id();

            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');

            // Field standar pemeriksaan
            $table->date('tanggal_pemeriksaan');
            $table->string('pemeriksa'); // nama petugas pemeriksa

            // Hasil pemeriksaan teknis (contoh)
            $table->boolean('pagar_pelindung')->default(false);
            $table->boolean('ban_pegangan')->default(false);
            $table->boolean('peralatan_pengaman')->default(false);

            // Catatan tambahan
            $table->text('catatan')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_bejana_tekans');
    }
};
