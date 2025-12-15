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
        Schema::create('form_kp_scissor_lift', function (Blueprint $table) {
             $table->id();

            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');

            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();

            // $table->json('foto_data_scissor_lift')->nullable();
            $table->string('kapasitas_angkat', 50)->nullable();
            $table->string('tinggi_angkat_maksimum', 50)->nullable();
            $table->string('kecepatan_angkat_naik', 50)->nullable();
            $table->string('kecepatan_angkat_turun', 50)->nullable();
            $table->string('tiang_penyangga_panjang', 50)->nullable();
            $table->string('tiang_penyangga_lebar', 50)->nullable();
            $table->string('tiang_penyangga_tebal', 50)->nullable();
            $table->string('platform_panjang', 50)->nullable();
            $table->string('platform_lebar', 50)->nullable();
            $table->string('platform_tinggi', 50)->nullable();
            $table->string('torak_hidrolik_dalam', 50)->nullable();
            $table->string('torak_hidrolik_luar', 50)->nullable();
            $table->string('torak_hidrolik_tinggi', 50)->nullable();
            $table->string('jig_panjang', 50)->nullable();
            $table->string('jig_lebar', 50)->nullable();
            $table->string('jig_tebal', 50)->nullable();
            $table->string('jig_diameter', 50)->nullable();
            $table->string('rem_macam', 50)->nullable();
            $table->string('rem_type', 50)->nullable();

            $table->json('foto_engine')->nullable();
            $table->string('item', 50)->nullable();
            $table->string('voltage', 50)->nullable();
            $table->string('daya', 50)->nullable();
            $table->string('frequency', 50)->nullable();
            $table->string('phase', 50)->nullable();
            $table->string('arus', 50)->nullable();
            $table->string('beban', 50)->nullable();
            $table->string('putaran', 50)->nullable();

            $table->json('foto_loadtest')->nullable();
            $table->string('swl_tinggi_angkat1', 50)->nullable();
            $table->string('beban_uji_load_chard1', 50)->nullable();
            $table->string('lifting1', 50)->nullable();
            $table->string('hasil1', 50)->nullable();
            $table->string('keterangan1', 50)->nullable();

            $table->string('swl_tinggi_angkat2', 50)->nullable();
            $table->string('beban_uji_load_chard2', 50)->nullable();
            $table->string('lifting2', 50)->nullable();
            $table->string('hasil2', 50)->nullable();
            $table->string('keterangan2', 50)->nullable();
            $table->string('radius_putaran_kiri', 25)->nullable();

            $table->string('swl_tinggi_angkat3', 50)->nullable();
            $table->string('beban_uji_load_chard3', 50)->nullable();
            $table->string('lifting3', 50)->nullable();
            $table->string('hasil3', 50)->nullable();
            $table->string('keterangan3', 50)->nullable();

            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_scissor_lift');
    }
};
