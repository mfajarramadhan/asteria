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
        Schema::create('form_kp_instalasi_fire_hydrants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_order_id');
            $table->unsignedBigInteger('job_order_tool_id');

            // Informasi Pemeriksaan
            $table->date('tanggal_pemeriksaan')->nullable(); // Corrected to DATE
            $table->json('foto_informasi_umum')->nullable();
            $table->string('nama_perusahaan', 150)->nullable();
            $table->string('kapasitas', 100)->nullable();
            $table->string('model_unit', 100)->nullable();
            $table->string('nomor_seri', 100)->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 255)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 50)->nullable();

            // Spesifikasi Fisik & Bangunan
            $table->decimal('luas_lahan', 15, 4)->nullable();
            $table->decimal('total_luas_bangunan', 15, 4)->nullable();
            $table->string('struktur_utama', 150)->nullable();
            $table->string('struktur_lantai', 150)->nullable(); // Duplikat di gambar, cukup satu
            $table->string('dinding_luar', 150)->nullable();
            $table->string('dinding_dalam', 150)->nullable();
            $table->string('rangka_plafond', 150)->nullable();
            $table->string('penutup_plafond', 150)->nullable();
            $table->string('rangka_atap', 150)->nullable();
            $table->string('penutup_atap', 150)->nullable();
            $table->decimal('tinggi_bangunan', 15, 4)->nullable();
            $table->integer('jumlah_lantai')->nullable();
            $table->decimal('jumlah_luas_lantai', 15, 4)->nullable();

            // Instalasi & Sumber Air
            $table->year('tahun_pemasangan')->nullable();
            $table->string('instalatir', 150)->nullable();
            $table->string('sumber_air_baku', 150)->nullable();
            $table->decimal('kapasitas_ground_tank', 15, 4)->nullable();
            $table->string('siamese_connection', 150)->nullable();
            $table->string('priming_tank', 150)->nullable();

            // Spesifikasi Teknis Bejana & Valve
            $table->decimal('bejana_liter', 15, 4)->nullable();
            $table->decimal('bejana_tk_kg', 15, 4)->nullable();
            $table->decimal('bejana_tk_uji', 15, 4)->nullable();
            $table->decimal('pressure_relief_valve', 15, 4)->nullable();
            $table->decimal('test_valve', 15, 4)->nullable();

            // Komponen Hydrant
            $table->string('jumlah_hydrant_gedung', 150)->nullable();
            $table->string('jumlah_hydrant_halaman', 150)->nullable();
            $table->string('jumlah_hydrant_pillar', 150)->nullable();
            $table->integer('jumlah_landing_valve')->nullable();

            // Spesifikasi Pompa (Jockey, Utama, Diesel)
            $table->string('merk_model_pompa_jockey', 100)->nullable();
            $table->string('merk_model_pompa_utama', 100)->nullable();
            $table->string('merk_model_pompa_diesel', 100)->nullable();
            $table->string('nomor_seri_pompa_jockey', 100)->nullable();
            $table->string('nomor_seri_pompa_utama', 100)->nullable();
            $table->string('nomor_seri_pompa_diesel', 100)->nullable();
            $table->string('kapasitas_pompa_jockey', 100)->nullable();
            $table->string('kapasitas_pompa_utama', 100)->nullable();
            $table->string('kapasitas_pompa_diesel', 100)->nullable();
            $table->string('daya_pompa_jockey', 100)->nullable();
            $table->string('daya_pompa_utama', 100)->nullable();
            $table->string('daya_pompa_diesel', 100)->nullable();

            // Spesifikasi Pipa & Tekanan
            $table->string('pipa_header_diameter', 100)->nullable();
            $table->string('pipa_hisap_diameter', 100)->nullable();
            $table->string('pipa_penyalur_utama_diameter', 100)->nullable();
            $table->string('pipa_tegak_diameter', 100)->nullable();
            $table->string('catatan_diameter_pipa', 255)->nullable();
            $table->string('tekanan_titik1', 100)->nullable();
            $table->string('tekanan_titik2', 100)->nullable();
            $table->string('tekanan_titik3', 100)->nullable();
            $table->string('keterangan_tekanan', 255)->nullable();
            $table->string('catatan', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_instalasi_fire_hydrants');
    }
};
