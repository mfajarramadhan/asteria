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
        Schema::create('form_kp_wheel_loader', function (Blueprint $table) {
            $table->id();

            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');

            $table->date('tanggal_pemeriksaan');
            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();
            $table->decimal('panjang_keseluruhan', 15, 4)->nullable();
            $table->decimal('tinggi_keseluruhan', 15, 4)->nullable();
            $table->decimal('lebar_keseluruhan', 15, 4)->nullable();
            // $table->decimal('kapasitas_bucket', 15, 4)->nullable();
            $table->decimal('jarak_track_roda', 15, 4)->nullable();
            $table->decimal('ukuran_lebar_roda', 15, 4)->nullable();
            $table->decimal('kecepatan_maks_travelling', 15, 4)->nullable();
            $table->decimal('kecepatan_mundur', 15, 4)->nullable();
            $table->string('rem_macam', 50)->nullable();
            $table->string('rem_type', 50)->nullable();
            $table->decimal('radius_putaran_kiri', 15, 4)->nullable();
            $table->decimal('radius_putaran_kanan', 15, 4)->nullable();
            
            $table->json('foto_mesin')->nullable();
            $table->string('tipe_mesin', 50)->nullable();
            $table->string('nomor_seri', 50)->nullable();
            $table->bigInteger('jumlah_silinder')->unsigned()->nullable();
            $table->decimal('daya_bersih', 15, 4)->nullable();
            $table->string('merek', 50)->nullable();
            $table->string('tahun_pembuatan_mesin', 50)->nullable();
            $table->string('pabrik_pembuat_mesin', 50)->nullable();
            
            $table->json('foto_pompa_hydraulik')->nullable();
            $table->string('pompa_hydraulik_type', 50)->nullable();
            $table->string('pompa_hydraulik_tekanan', 50)->nullable();
            
            $table->json('foto_pengujian')->nullable();
            $table->string('fungsi_travelling_kecepatan', 100)->nullable();
            $table->string('travelling_gerakan_maju', 100)->nullable();
            $table->string('travelling_gerakan_mundur', 100)->nullable();
            $table->string('travelling_beban', 100)->nullable();
            $table->string('travelling_hasil', 100)->nullable();
            $table->string('travelling_keterangan', 100)->nullable();

            $table->string('fungsi_belok_kecepatan', 100)->nullable();
            $table->string('belok_gerakan_maju', 100)->nullable();
            $table->string('belok_gerakan_mundur', 100)->nullable();
            $table->string('belok_beban', 100)->nullable();
            $table->string('belok_hasil', 100)->nullable();
            $table->string('belok_keterangan', 100)->nullable();

            $table->string('fungsi_lengan_kecepatan', 100)->nullable();
            $table->string('lengan_gerakan_maju', 100)->nullable();
            $table->string('lengan_gerakan_mundur', 100)->nullable();
            $table->string('lengan_beban', 100)->nullable();
            $table->string('lengan_hasil', 100)->nullable();
            $table->string('lengan_keterangan', 100)->nullable();

            $table->string('fungsi_bucket_kecepatan', 100)->nullable();
            $table->string('bucket_gerakan_maju', 100)->nullable();
            $table->string('bucket_gerakan_mundur', 100)->nullable();
            $table->string('bucket_beban', 100)->nullable();
            $table->string('bucket_hasil', 100)->nullable();
            $table->string('bucket_keterangan', 100)->nullable();

            $table->string('fungsi_loading_kecepatan', 100)->nullable();
            $table->string('loading_gerakan_maju', 100)->nullable();
            $table->string('loading_gerakan_mundur', 100)->nullable();
            $table->string('loading_beban', 100)->nullable();
            $table->string('loading_hasil', 100)->nullable();
            $table->string('loading_keterangan', 100)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_wheel_loader');
    }
};
