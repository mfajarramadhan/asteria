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

            $table->date('tanggal_pemeriksaan');
            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat')->nullable();
            $table->string('jenis_bejana')->nullable();
            $table->string('lokasi')->nullable();
            $table->json('foto_shell')->nullable();
            $table->decimal('ketidakbulatan', 10, 4)->nullable();
            $table->decimal('ketebalan_shell', 10, 4)->nullable();
            $table->decimal('diameter_shell', 10, 4)->nullable();
            $table->decimal('panjang_shell', 10, 4)->nullable();
            $table->json('foto_head')->nullable();
            $table->decimal('diameter_head', 10, 4)->nullable();
            $table->decimal('ketebalan_head', 10, 4)->nullable();
            $table->json('foto_pipa')->nullable();
            $table->decimal('diameter_pipa', 10, 4)->nullable();
            $table->decimal('ketebalan_pipa', 10, 4)->nullable();
            $table->decimal('panjang_pipa', 10, 4)->nullable();
            $table->json('foto_instalasi')->nullable();
            $table->decimal('diameter_instalasi', 10, 4)->nullable();
            $table->decimal('ketebalan_instalasi', 10, 4)->nullable();
            $table->decimal('panjang_instalasi', 10, 4)->nullable();
            $table->boolean('safety_valv_cal')->nullable()->default(false);
            $table->decimal('tekanan_kerja', 10, 4)->nullable();
            $table->decimal('set_safety_valv', 10, 4)->nullable();
            $table->string('media_yang_diisikan')->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('form_kp_bejana_tekan');
    }
};
