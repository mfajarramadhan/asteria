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
            $table->string('tipe_tangki')->nullable();
            $table->string('pabrik_pembuat')->nullable();
            $table->string('tempat')->nullable();
            $table->string('tahun_pembuat')->nullable();
            $table->string('tekanan')->nullable();
            $table->string('suhu')->nullable();
            $table->string('media_yang_diisikan')->nullable();
            $table->string('lokasi_tangki')->nullable();
            $table->json('foto_visual')->nullable();
            $table->string('tanda_kebocoran')->nullable();
            $table->string('tanda_kebocoran_keterangan')->nullable();
            $table->string('kondisi_tangki')->nullable();
            $table->string('kondisi_tangki_keterangan')->nullable();
            $table->string('komponen_sambungan')->nullable();
            $table->string('komponen_sambungan_keterangan')->nullable();
            $table->string('penopang_tangki')->nullable();
            $table->string('penopang_tangki_keterangan')->nullable();
            $table->string('pondasi_tangki')->nullable();
            $table->string('pondasi_tangki_keterangan')->nullable();
            $table->string('pengukur_ketinggian')->nullable();
            $table->string('pengukur_ketinggian_keterangan')->nullable();
            $table->string('ventilasi_terhalang')->nullable();
            $table->string('ventilasi_terhalang_keterangan')->nullable();
            $table->string('segel_katup')->nullable();
            $table->string('segel_katup_keterangan')->nullable();
            $table->string('jalur_pemipaan')->nullable();
            $table->string('jalur_pemipaan_keterangan')->nullable();
            $table->string('jalur_pipa')->nullable();
            $table->string('jalur_pipa_keterangan')->nullable();
            $table->string('area_bongkar')->nullable();
            $table->string('area_bongkar_keterangan')->nullable();
            $table->string('sambungan_flense')->nullable();
            $table->string('sambungan_flense_keterangan')->nullable();
            $table->string('secondary_containtment_rusak')->nullable();
            $table->string('secondary_containtment_keterangan')->nullable();
            $table->string('katup_drainase')->nullable();
            $table->string('katup_drainase_keterangan')->nullable();
            $table->string('pagar_gerbang')->nullable();
            $table->string('pagar_gerbang_keterangan')->nullable();
            $table->string('kotak_peralatan')->nullable();
            $table->string('kotak_peralatan_keterangan')->nullable();
            $table->json('foto_pengukuran')->nullable();
            $table->string('grounding1_hasil')->nullable();
            $table->string('grounding2_hasil')->nullable();
            $table->json('foto_komponen')->nullable();
            $table->string('shell1')->nullable();
            $table->string('shell2')->nullable();
            $table->string('shell3')->nullable();
            $table->string('shell4')->nullable();
            $table->string('shell5')->nullable();
            $table->string('shell6')->nullable();
            $table->string('tebal_pelat_atap1')->nullable();
            $table->string('tebal_pelat_atap2')->nullable();
            $table->string('tebal_pelat_bottom1')->nullable();
            $table->string('tebal_pelat_bottom2')->nullable();
            $table->string('tebal_pipa_channel')->nullable();
            $table->string('tebal_instalasi_pipa')->nullable();
            $table->json('foto_tangki')->nullable();
            $table->decimal('diameter_tangki', 10, 4)->nullable();
            $table->decimal('tinggi_tangki', 10, 4)->nullable();
            $table->decimal('secondary_containtment', 10, 4)->nullable();
            $table->decimal('tinggi_pagar_atap', 10, 4)->nullable();
            $table->decimal('tinggi_panjang_pipa', 10, 4)->nullable();
            $table->decimal('tinggi_panjang_instalasi_pipa', 10, 4)->nullable();
            $table->string('tinggi_panjang_shell1')->nullable();
            $table->string('tinggi_panjang_shell2')->nullable();
            $table->string('tinggi_panjang_shell3')->nullable();
            $table->string('tinggi_panjang_shell4')->nullable();
            $table->string('tinggi_panjang_shell5')->nullable();
            $table->string('tinggi_panjang_shell6')->nullable();
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
