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
        Schema::create('form_kp_tangki_timbun', function (Blueprint $table) {
            $table->id();
            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan')->nullable();

            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();
            $table->string('tempat_pembuatan', 100)->nullable();
            $table->string('tekanan', 100)->nullable();
            $table->string('suhu', 100)->nullable();
            $table->string('media_yang_diisikan', 100)->nullable();

            $table->json('foto_visual')->nullable();
            $table->string('tanda_kebocoran', 100)->nullable();
            $table->string('tanda_kebocoran_keterangan', 100)->nullable();
            $table->string('kondisi_tangki', 100)->nullable();
            $table->string('kondisi_tangki_keterangan', 100)->nullable();
            $table->string('komponen_sambungan', 100)->nullable();
            $table->string('komponen_sambungan_keterangan', 100)->nullable();
            $table->string('penopang_tangki', 100)->nullable();
            $table->string('penopang_tangki_keterangan', 100)->nullable();
            $table->string('pondasi_tangki', 100)->nullable();
            $table->string('pondasi_tangki_keterangan', 100)->nullable();
            $table->string('pengukur_ketinggian', 100)->nullable();
            $table->string('pengukur_ketinggian_keterangan', 100)->nullable();
            $table->string('ventilasi_terhalang', 100)->nullable();
            $table->string('ventilasi_terhalang_keterangan', 100)->nullable();
            $table->string('segel_katup', 100)->nullable();
            $table->string('segel_katup_keterangan', 100)->nullable();
            $table->string('jalur_pemipaan', 100)->nullable();
            $table->string('jalur_pemipaan_keterangan', 100)->nullable();
            $table->string('jalur_pipa', 100)->nullable();
            $table->string('jalur_pipa_keterangan', 100)->nullable();
            $table->string('area_bongkar', 100)->nullable();
            $table->string('area_bongkar_keterangan', 100)->nullable();
            $table->string('sambungan_flense', 100)->nullable();
            $table->string('sambungan_flense_keterangan', 100)->nullable();
            $table->string('secondary_containtment_rusak', 100)->nullable();
            $table->string('secondary_containtment_keterangan', 100)->nullable();
            $table->string('katup_drainase', 100)->nullable();
            $table->string('katup_drainase_keterangan', 100)->nullable();
            $table->string('pagar_gerbang', 100)->nullable();
            $table->string('pagar_gerbang_keterangan', 100)->nullable();
            $table->string('kotak_peralatan', 100)->nullable();
            $table->string('kotak_peralatan_keterangan', 100)->nullable();

            $table->json('foto_pengukuran')->nullable();
            $table->string('grounding1_hasil', 100)->nullable();
            $table->string('grounding2_hasil', 100)->nullable();
            $table->json('foto_komponen')->nullable();
            $table->string('shell1', 100)->nullable();
            $table->string('shell2', 100)->nullable();
            $table->string('shell3', 100)->nullable();
            $table->string('shell4', 100)->nullable();
            $table->string('shell5', 100)->nullable();
            $table->string('shell6', 100)->nullable();
            $table->string('tebal_pelat_atap1', 100)->nullable();
            $table->string('tebal_pelat_atap2', 100)->nullable();
            $table->string('tebal_pelat_bottom1', 100)->nullable();
            $table->string('tebal_pelat_bottom2', 100)->nullable();
            $table->string('tebal_pipa_channel', 100)->nullable();
            $table->string('tebal_instalasi_pipa', 100)->nullable();

            $table->json('foto_tangki')->nullable();
            $table->decimal('diameter_tangki', 15, 4)->nullable();
            $table->decimal('tinggi_tangki', 15, 4)->nullable();
            $table->decimal('secondary_containtment', 15, 4)->nullable();
            $table->decimal('tinggi_pagar_atap', 15, 4)->nullable();
            $table->decimal('tinggi_panjang_pipa', 15, 4)->nullable();
            $table->decimal('tinggi_panjang_instalasi_pipa', 15, 4)->nullable();
            $table->string('tinggi_panjang_shell1', 100)->nullable();
            $table->string('tinggi_panjang_shell2', 100)->nullable();
            $table->string('tinggi_panjang_shell3', 100)->nullable();
            $table->string('tinggi_panjang_shell4', 100)->nullable();
            $table->string('tinggi_panjang_shell5', 100)->nullable();
            $table->string('tinggi_panjang_shell6', 100)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_tangki_timbun');
    }
};
