<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('form_kp_eskalator', function (Blueprint $table) {
            $table->id();

            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');

            // Informasi umum
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('jenis_eskalator')->nullable();
            $table->string('merk_eskalator')->nullable();
            $table->string('nomor_seri')->nullable();
            $table->string('kapasitas')->nullable();
            $table->string('melayani')->nullable();
            $table->string('lokasi_eskalator')->nullable();

            // Upload foto
            $table->json('pagar_pelindung')->nullable();
            $table->json('ban_pegangan_foto')->nullable();
            $table->json('peralatan_pengaman_foto')->nullable();

            // Pemeriksaan Dimensi dan Keamanan
            $table->decimal('tinggi', 10, 4)->nullable();
            $table->string('tinggi_keterangan')->nullable();
            $table->decimal('tekanan_samping', 10, 4)->nullable();
            $table->string('tekanan_samping_keterangan')->nullable();
            $table->decimal('tekanan_vertikal', 10, 4)->nullable();
            $table->string('tekanan_vertikal_keterangan')->nullable();
            $table->string('pelindung_bawah')->nullable();
            $table->string('pelindung_bawah_keterangan')->nullable();
            $table->string('kelenturan_pelindung_bawah')->nullable();
            $table->string('kelenturan_pelindung_bawah_keterangan')->nullable();
            $table->string('celah_anak_tangga')->nullable();
            $table->string('celah_anak_tangga_keterangan')->nullable();

            // Pemeriksaan Ban Pegangan
            $table->string('kondisi_ban_pegangan')->nullable();
            $table->string('kondisi_ban_pegangan_keterangan')->nullable();
            $table->decimal('kecepatan_ban_pegangan', 10, 4)->nullable();
            $table->string('kecepatan_ban_pegangan_keterangan')->nullable();
            $table->decimal('lebar_ban_pegangan', 10, 4)->nullable();
            $table->string('lebar_ban_pegangan_keterangan')->nullable();

            // Pemeriksaan Peralatan Pengaman
            $table->string('kunci_pengendali')->nullable();
            $table->string('kunci_pengendali_keterangan')->nullable();
            $table->string('saklar_henti')->nullable();
            $table->string('saklar_henti_keterangan')->nullable();
            $table->string('pengaman_rantai')->nullable();
            $table->string('pengaman_rantai_keterangan')->nullable();
            $table->string('rantai_penarik')->nullable();
            $table->string('rantai_penarik_keterangan')->nullable();
            $table->string('pengaman_anak_tangga')->nullable();
            $table->string('pengaman_anak_tangga_keterangan')->nullable();
            $table->string('pengaman_ban_pegangan')->nullable();
            $table->string('pengaman_ban_pegangan_keterangan')->nullable();
            $table->string('pengaman_pencegah_balik_arah')->nullable();
            $table->string('pengaman_pencegah_balik_arah_keterangan')->nullable();
            $table->string('pengaman_area_masuk_ban')->nullable();
            $table->string('pengaman_area_masuk_ban_keterangan')->nullable();
            $table->string('pengaman_pelat_sisir')->nullable();
            $table->string('pengaman_pelat_sisir_keterangan')->nullable();
            $table->string('sikat_pelindung_dalam')->nullable();
            $table->string('sikat_pelindung_dalam_keterangan')->nullable();
            $table->string('tombol_penghenti')->nullable();
            $table->string('tombol_penghenti_keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_eskalator');
    }
};
