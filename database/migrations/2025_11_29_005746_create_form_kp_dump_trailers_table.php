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
        Schema::create('form_kp_dump_trailer', function (Blueprint $table) {
            $table->id();
            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');

            $table->date('tanggal_pemeriksaan');
            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat')->nullable();            
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->json('foto_spesifikasi')->nullable();
            $table->decimal('kapasitas', 10, 4)->nullable();
            $table->decimal('panjang_keseluruhan', 10, 4)->nullable();
            $table->decimal('tinggi_keseluruhan', 10, 4)->nullable();
            $table->decimal('ketinggian_kabin', 10, 4)->nullable();
            $table->decimal('lebar_keseluruhan', 10, 4)->nullable();
            $table->decimal('kecepatan_angkat', 10, 4)->nullable();
            $table->decimal('kecepatan_turun', 10, 4)->nullable();
            $table->decimal('kecepatan_travelling', 10, 4)->nullable();
            $table->string('perlengkapan', 100)->nullable();
            $table->decimal('berat_kendaraan', 10, 4)->nullable();
            $table->json('foto_penggerak_utama')->nullable();
            $table->string('merk_type', 100)->nullable();
            $table->string('nomor_seri', 100)->nullable();
            $table->string('jumlah_silinder', 50)->nullable();
            $table->string('daya', 50)->nullable();
            $table->string('tahun_pembuatan', 50)->nullable();
            $table->string('pabrik_pembuatan', 50)->nullable();
            $table->json('foto_tekanan_roda')->nullable();
            $table->decimal('roda_penggerak', 10, 4)->nullable();
            $table->decimal('roda_kemudi', 10, 4)->nullable();
            $table->json('foto_roda_penggerak')->nullable();
            $table->string('ukuran', 50)->nullable();
            $table->string('tipe', 50)->nullable();
            $table->json('foto_roda_kemudi')->nullable();
            $table->string('ukuran2', 50)->nullable();
            $table->string('tipe2', 50)->nullable();
            $table->json('foto_pompa_hidrolik')->nullable();
            $table->string('tipe_pompa', 50)->nullable();
            $table->string('tekanan_pompa', 50)->nullable();
            $table->string('relief_valve_pompa', 50)->nullable();
            $table->json('foto_pengujian')->nullable();

            // Kolom Pengujian 1 (Test 1)
            $table->decimal('swt_tinggi_angkat1', 10, 4)->nullable();
            $table->decimal('beban_uji_load1', 10, 4)->nullable();
            $table->decimal('travelling_kecepatan1', 10, 4)->nullable();
            $table->decimal('gerakan1', 10, 4)->nullable();
            $table->decimal('hasil1', 10, 4)->nullable();
            $table->string('keterangan1', 100)->nullable();

            // Kolom Pengujian 2 (Test 2)
            $table->decimal('swt_tinggi_angkat2', 10, 4)->nullable();
            $table->decimal('beban_uji_load2', 10, 4)->nullable();
            $table->decimal('travelling_kecepatan2', 10, 4)->nullable();
            $table->decimal('gerakan2', 10, 4)->nullable();
            $table->decimal('hasil2', 10, 4)->nullable();
            $table->string('keterangan2', 100)->nullable();

            // Kolom Pengujian 3 (Test 3) 
            $table->decimal('swt_tinggi_angkat3', 10, 4)->nullable();
            $table->decimal('beban_uji_load3', 10, 4)->nullable();
            $table->decimal('travelling_kecepatan3', 10, 4)->nullable(); 
            $table->decimal('gerakan3', 10, 4)->nullable(); 
            $table->decimal('hasil3', 10, 4)->nullable(); 
            $table->string('keterangan3', 100)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_dump_trailer');
    }
};
