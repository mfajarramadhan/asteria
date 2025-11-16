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
            $table->string('pabrik_pembuat')->nullable();
            $table->string('lokasi')->nullable();
            $table->json('foto_mesin')->nullable();
            $table->decimal('daya_mesin', 10, 4)->nullable();
            $table->decimal('jumlah_silinder', 10, 4)->nullable();
            $table->json('foto_generator')->nullable();
            $table->string('nama_pabrik_pembuat')->nullable();
            $table->string('no_seri_generator')->nullable();
            $table->json('foto_pengukuran')->nullable();        
            $table->string('grounding1')->nullable();
            $table->string('grounding2')->nullable();
            $table->string('pondasi')->nullable();
            $table->string('rangka')->nullable();
            $table->string('cover_kipas')->nullable();
            $table->string('pencahayaan_depan')->nullable();
            $table->string('pencahayaan_belakang')->nullable();
            $table->string('pencahayaan_tengah')->nullable();
            $table->string('pencahayaan_depan_panel')->nullable();
            $table->string('kebisingan_ruang_pltd')->nullable();
            $table->string('kebisingan_ruang_kontrol')->nullable();
            $table->string('kebisingan_luar_ruang_pltd')->nullable();
            $table->string('kebisingan_area_kerja')->nullable();
            $table->json('foto_pengujian')->nullable();        
            $table->string('emergency_stop')->nullable();
            $table->string('emergency_stop_ket')->nullable();
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
