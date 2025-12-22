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
            $table->text('pabrik_pembuat')->nullable();
            $table->text('jenis')->nullable();
            $table->text('lokasi')->nullable();
            $table->text('tahun_pembuatan')->nullable();

            // $table->json('foto_data_scissor_lift')->nullable();
            $table->text('kapasitas_angkat')->nullable();
            $table->text('tinggi_angkat_maksimum')->nullable();
            $table->text('kecepatan_angkat_naik')->nullable();
            $table->text('kecepatan_angkat_turun')->nullable();
            $table->text('tiang_penyangga_panjang')->nullable();
            $table->text('tiang_penyangga_lebar')->nullable();
            $table->text('tiang_penyangga_tebal')->nullable();
            $table->text('platform_panjang')->nullable();
            $table->text('platform_lebar')->nullable();
            $table->text('platform_tinggi')->nullable();
            $table->text('torak_hidrolik_dalam')->nullable();
            $table->text('torak_hidrolik_luar')->nullable();
            $table->text('torak_hidrolik_tinggi')->nullable();
            $table->text('jig_panjang')->nullable();
            $table->text('jig_lebar')->nullable();
            $table->text('jig_tebal')->nullable();
            $table->text('jig_diameter')->nullable();
            $table->text('rem_macam')->nullable();
            $table->text('rem_type')->nullable();

            $table->json('foto_engine')->nullable();
            $table->text('item')->nullable();
            $table->text('voltage')->nullable();
            $table->text('daya')->nullable();
            $table->text('frequency')->nullable();
            $table->text('phase')->nullable();
            $table->text('arus')->nullable();
            $table->text('beban')->nullable();
            $table->text('putaran')->nullable();

            $table->json('foto_loadtest')->nullable();
            $table->text('swl_tinggi_angkat1')->nullable();
            $table->text('beban_uji_load_chard1')->nullable();
            $table->text('lifting1')->nullable();
            $table->text('hasil1')->nullable();
            $table->text('keterangan1')->nullable();

            $table->text('swl_tinggi_angkat2')->nullable();
            $table->text('beban_uji_load_chard2')->nullable();
            $table->text('lifting2')->nullable();
            $table->text('hasil2')->nullable();
            $table->text('keterangan2')->nullable();
            $table->text('radius_putaran_kiri')->nullable();

            $table->text('swl_tinggi_angkat3')->nullable();
            $table->text('beban_uji_load_chard3')->nullable();
            $table->text('lifting3')->nullable();
            $table->text('hasil3')->nullable();
            $table->text('keterangan3')->nullable();

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
