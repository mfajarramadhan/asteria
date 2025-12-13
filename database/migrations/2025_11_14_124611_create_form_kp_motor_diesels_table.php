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
        Schema::create('form_kp_motor_diesel', function (Blueprint $table) {
            $table->id();
            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');

            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();

            $table->json('foto_mesin')->nullable();
            $table->string('pabrik_pembuat_mesin', 100)->nullable();
            $table->string('nomor_seri_mesin', 100)->nullable();
            $table->decimal('daya_mesin', 15, 4)->nullable();
            $table->string('jumlah_silinder', 100)->nullable();
            $table->json('foto_generator')->nullable();
            $table->string('pabrik_pembuat_generator', 100)->nullable();
            $table->string('nomor_seri_generator', 100)->nullable();
            $table->json('foto_pengukuran')->nullable();        
            $table->string('grounding1', 100)->nullable();
            $table->string('grounding2', 100)->nullable();
            $table->string('pondasi', 100)->nullable();
            $table->string('rangka', 100)->nullable();
            $table->string('cover_kipas', 100)->nullable();
            $table->string('pencahayaan_depan', 100)->nullable();
            $table->string('pencahayaan_belakang', 100)->nullable();
            $table->string('pencahayaan_tengah', 100)->nullable();
            $table->string('pencahayaan_depan_panel', 100)->nullable();
            $table->string('kebisingan_ruang_pltd', 100)->nullable();
            $table->string('kebisingan_ruang_kontrol', 100)->nullable();
            $table->string('kebisingan_luar_ruang_pltd', 100)->nullable();
            $table->string('kebisingan_area_kerja', 100)->nullable();
            $table->json('foto_pengujian')->nullable();        
            $table->string('emergency_stop', 100)->nullable();
            $table->string('emergency_stop_ket', 100)->nullable();
            $table->text('catatan')->nullable();      
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_motor_diesel');
    }
};
