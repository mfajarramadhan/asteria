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
        Schema::create('form_kp_crane', function (Blueprint $table) {
            $table->id();
            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');

            $table->date('tanggal_pemeriksaan');
            $table->string('pabrik_pembuat')->nullable();
            $table->string('jenis_alat')->nullable();
            $table->string('lokasi')->nullable();
            // $table->string('kapasitas')->nullable();

            $table->decimal('tinggi_angkat_maksimum', 10, 4)->nullable();
            $table->decimal('kecepatan_hosting', 10, 4)->nullable();
            $table->decimal('kecepatan_treversing', 10, 4)->nullable();
            $table->decimal('kecepatan_travelling', 10, 4)->nullable();
            $table->decimal('panjang_span', 10, 4)->nullable();

            // Rantai
            $table->json('foto_rantai')->nullable();
            $table->decimal('panjang_rantai1', 10, 4)->nullable();
            $table->decimal('panjang_rantai2', 10, 4)->nullable();
            $table->decimal('panjang_rantai3', 10, 4)->nullable();
            $table->decimal('panjang_rantai4', 10, 4)->nullable();
            $table->decimal('panjang_rantai5', 10, 4)->nullable();
            $table->decimal('panjang_rantai6', 10, 4)->nullable();

            // Wire Rope
            $table->json('foto_wire_rope')->nullable();
            $table->decimal('panjang_wire_rope1', 10, 4)->nullable();
            $table->decimal('panjang_wire_rope2', 10, 4)->nullable();
            $table->decimal('panjang_wire_rope3', 10, 4)->nullable();
            $table->decimal('panjang_wire_rope4', 10, 4)->nullable();
            $table->decimal('panjang_wire_rope5', 10, 4)->nullable();
            $table->decimal('panjang_wire_rope6', 10, 4)->nullable();
            
            // Hook (Detail Dimensi)
            $table->json('foto_hook')->nullable();
            $table->decimal('panjang_hookA', 10, 4)->nullable();
            $table->decimal('panjang_hookAi', 10, 4)->nullable();
            $table->decimal('panjang_hookHa', 10, 4)->nullable();
            $table->decimal('panjang_hookB', 10, 4)->nullable();
            $table->decimal('panjang_hookBi', 10, 4)->nullable();
            $table->decimal('panjang_hookHb', 10, 4)->nullable();
            $table->decimal('panjang_hookW_C', 10, 4)->nullable();
            $table->decimal('panjang_hookD', 10, 4)->nullable();

            // Pulley
            $table->json('foto_pulley')->nullable();
            $table->decimal('panjang_pulleyA', 10, 4)->nullable();
            $table->decimal('panjang_pulleyB', 10, 4)->nullable();
            $table->decimal('panjang_pulleyC', 10, 4)->nullable();
            $table->decimal('panjang_pulleyD', 10, 4)->nullable();
            $table->decimal('panjang_pulleyE', 10, 4)->nullable();
            $table->json('foto_loadtest')->nullable();

            // Load Test 1
            $table->string('swl_tinggi_angkat_hook1', 25)->nullable();
            $table->string('beban_uji_load_chard1', 25)->nullable();
            $table->string('travelling1', 25)->nullable();
            $table->string('traversing1', 25)->nullable();
            $table->string('hasil1', 25)->nullable();
            $table->text('keterangan1')->nullable(); 

            // Load Test 2
            $table->string('swl_tinggi_angkat_hook2', 25)->nullable();
            $table->string('beban_uji_load_chard2', 25)->nullable();
            $table->string('travelling2', 25)->nullable();
            $table->string('traversing2', 25)->nullable();
            $table->string('hasil2', 25)->nullable();
            $table->text('keterangan2')->nullable(); 

            // Load Test 3
            $table->string('swl_tinggi_angkat_hook3', 25)->nullable();
            $table->string('beban_uji_load_chard3', 25)->nullable();
            $table->string('travelling3', 25)->nullable();
            $table->string('traversing3', 25)->nullable();
            $table->string('hasil3', 25)->nullable();
            $table->text('keterangan3')->nullable(); 

            // Defleksi
            $table->json('foto_defleksi')->nullable();
            $table->string('posisi_defleksi', 255)->nullable(); 
            $table->string('single_girder_beban', 100)->nullable();
            $table->string('single_girder_tanpa_beban', 100)->nullable();
            $table->string('posisi_defleksi_dua', 255)->nullable();
            $table->string('double_girder_beban', 100)->nullable();
            $table->string('double_girder_tanpa_beban', 100)->nullable();

            $table->text('catatan')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_crane');
    }
};
