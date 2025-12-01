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
        Schema::create('form_kp_cargo_lift', function (Blueprint $table) {
            $table->id();
            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');

            $table->date('tanggal_pemeriksaan');
            $table->string('pabrik_pembuat')->nullable();
            $table->string('jenis_alat')->nullable();
            $table->string('lokasi')->nullable();
            // $table->string('kapasitas')->nullable();

            $table->decimal('tinggi_angkat_meter', 10, 4)->nullable();
            $table->decimal('tinggi_angkat_lantai', 10, 4)->nullable();
            $table->decimal('kecepatan_angkat', 10, 4)->nullable();
            $table->string('dimensi_pondasi')->nullable();
            $table->string('dimensi_sangkar')->nullable();
            $table->string('dimensi_ruang_luncur')->nullable();

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

            // Uji performance
            $table->json('foto_performance')->nullable();
            $table->string('hoisting_naik_turun1', 100)->nullable();
            $table->string('jenis_uji1', 100)->nullable();
            $table->string('bobot_beban1', 100)->nullable();
            $table->string('indikasi_kerusakan1', 100)->nullable();
            $table->string('hasil_performance1', 100)->nullable();

            $table->string('hoisting_naik_turun2', 100)->nullable();
            $table->string('jenis_uji2', 100)->nullable();
            $table->string('bobot_beban2', 100)->nullable();
            $table->string('indikasi_kerusakan2', 100)->nullable();
            $table->string('hasil_performance2', 100)->nullable();

            $table->string('hoisting_naik_turun3', 100)->nullable();
            $table->string('jenis_uji3', 100)->nullable();
            $table->string('bobot_beban3', 100)->nullable();
            $table->string('indikasi_kerusakan3', 100)->nullable();
            $table->string('hasil_performance3', 100)->nullable();

            // LoadTest 1
            $table->json('foto_loadtest')->nullable();
            $table->string('statis_dinamis1', 100)->nullable();
            $table->string('tinggi_angkat_hook1', 100)->nullable();
            $table->string('swl_beban_uji1', 100)->nullable();
            $table->string('hoisting1', 100)->nullable();
            $table->string('hasil1', 100)->nullable();
            $table->string('keterangan1', 100)->nullable();

            // LoadTest 2
            $table->string('statis_dinamis2', 100)->nullable();
            $table->string('tinggi_angkat_hook2', 100)->nullable();
            $table->string('swl_beban_uji2', 100)->nullable();
            $table->string('hoisting2', 100)->nullable();
            $table->string('hasil2', 100)->nullable();
            $table->string('keterangan2', 100)->nullable();

            // LoadTest 3
            $table->string('statis_dinamis3', 100)->nullable();
            $table->string('tinggi_angkat_hook3', 100)->nullable();
            $table->string('swl_beban_uji3', 100)->nullable();
            $table->string('hoisting3', 100)->nullable();
            $table->string('hasil3', 100)->nullable();
            $table->string('keterangan3', 100)->nullable(); 

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
        Schema::dropIfExists('form_kp_cargo_lift');
    }
};
