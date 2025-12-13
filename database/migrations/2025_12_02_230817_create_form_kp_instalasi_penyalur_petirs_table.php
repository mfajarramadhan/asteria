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
        Schema::create('form_kp_instalasi_penyalur_petir', function (Blueprint $table) {
            $table->id();

            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');

            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();

            $table->string('air_terminal1', 100)->nullable();
            $table->string('air_terminal2', 100)->nullable();
            $table->string('jarak_radius_proteksi', 100)->nullable();
            $table->string('tinggi_tiang', 100)->nullable();
            $table->string('jumlah_dan_jarak', 100)->nullable();
            $table->string('keadaan_visual_air', 100)->nullable();

            $table->string('down_conductor', 100)->nullable();
            $table->string('jumlah_down_conductor', 100)->nullable();
            $table->string('jarak_antar_kaki_penerima', 100)->nullable();

            $table->string('titik_percabangan', 100)->nullable();
            $table->string('luas_penampang', 100)->nullable();
            $table->string('tebal_penampang', 100)->nullable();

            $table->string('jarak_antar_penghantar', 100)->nullable();
            $table->string('jenis_penghantar', 100)->nullable();
            $table->string('tinggi_bangunan', 100)->nullable();

            $table->string('luas_bangunan', 100)->nullable();
            $table->string('earth_electrode', 100)->nullable();

            $table->string('batang_pita_mesh', 100)->nullable();
            $table->string('diameter_penampang', 100)->nullable();
            $table->string('kedalaman_elektroda', 100)->nullable();

            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_instalasi_penyalur_petir');
    }
};
