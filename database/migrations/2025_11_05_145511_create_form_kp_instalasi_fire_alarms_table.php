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
        Schema::create('form_kp_instalasi_fire_alarms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_order_id');
            $table->unsignedBigInteger('job_order_tool_id');

            // Data Informasi Umum
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->json('foto_informasi_umum')->nullable();
            $table->string('nama_perusahaan', 150)->nullable();
            $table->string('kapasitas', 100)->nullable();
            $table->string('model_unit', 100)->nullable();
            $table->string('nomor_seri', 100)->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 255)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 50)->nullable();
            $table->string('pengguna_bangunan', 100)->nullable();
            $table->string('tahun_instalasi', 50)->nullable();
            $table->string('instalatir', 150)->nullable();

            // Spesifikasi Bangunan (Decimal)
            $table->decimal('luas_lahan', 15, 4)->nullable();
            $table->decimal('luas_bangunan', 15, 4)->nullable();
            $table->decimal('tinggi_bangunan', 15, 4)->nullable();
            $table->decimal('luas_lantai', 15, 4)->nullable();
            $table->decimal('jumlah_lantai', 15, 4)->nullable();

            // Detail Perangkat Fire Alarm
            $table->string('panel_control_mcfa', 150)->nullable();
            $table->string('annuciator', 150)->nullable();
            $table->string('detektor_panas_ror', 150)->nullable();
            $table->string('jumlah_detektor_nyala_api_fix', 150)->nullable();
            $table->string('detektor_asap', 150)->nullable();
            $table->string('detektor_gas', 150)->nullable();
            $table->string('tombol_manual_breakglass', 150)->nullable();
            $table->string('combination_box', 150)->nullable();

            // Spesifikasi Detektor
            $table->string('jenis_detektor', 255)->nullable();
            $table->string('lokasi_detektor', 255)->nullable();
            $table->string('no_zone_detektor', 255)->nullable();
            $table->string('hasil_detektor', 255)->nullable();
            $table->string('open_circuit_test_detektor', 255)->nullable();
            $table->string('keterangan_detektor', 255)->nullable();
            $table->string('catatan_fire_alarm', 255)->nullable();

            // File Dokumen & Gambar (Varchar 255 biasanya untuk path file)
            $table->string('gambar_layout_gedung_perusahaan', 255)->nullable();
            $table->string('gambar_instalasi', 255)->nullable();
            $table->string('dokumen_spesifikasi_peralatan', 255)->nullable();
            $table->string('dokumen_pemeliharaan', 255)->nullable();
            $table->string('surat_keterangan_berkala', 255)->nullable();
            $table->string('laporan_pemeriksaan_berkala', 255)->nullable();

            // Timestamps (Opsional, tapi disarankan di Laravel)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_instalasi_fire_alarms');
    }
};
