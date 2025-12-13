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
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();

            $table->json('foto_shell')->nullable();
            $table->decimal('ketidakbulatan', 15, 4)->nullable();
            $table->decimal('ketebalan_shell', 15, 4)->nullable();
            $table->decimal('diameter_shell', 15, 4)->nullable();
            $table->decimal('panjang_shell', 15, 4)->nullable();

            $table->json('foto_head')->nullable();
            $table->decimal('diameter_head', 15, 4)->nullable();
            $table->decimal('ketebalan_head', 15, 4)->nullable();

            $table->json('foto_pipa')->nullable();
            $table->decimal('diameter_pipa', 15, 4)->nullable();
            $table->decimal('ketebalan_pipa', 15, 4)->nullable();
            $table->decimal('panjang_pipa', 15, 4)->nullable();
            
            $table->json('foto_instalasi')->nullable();
            $table->decimal('diameter_instalasi', 15, 4)->nullable();
            $table->decimal('ketebalan_instalasi', 15, 4)->nullable();
            $table->decimal('panjang_instalasi', 15, 4)->nullable();
            $table->boolean('safety_valv_cal')->nullable()->default(false);
            $table->decimal('tekanan_kerja', 15, 4)->nullable();
            $table->decimal('set_safety_valv', 15, 4)->nullable();
            $table->string('media_yang_diisikan', 100)->nullable();
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
