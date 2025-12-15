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
        Schema::create('form_kp_pesawat_tenaga_produksi', function (Blueprint $table) {
            $table->id();
            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan');

            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();
            $table->string('nama_mesin', 100)->nullable();
            $table->string('fungsi', 100)->nullable();

            $table->json('foto_device')->nullable();
            $table->string('safety_device1', 100)->nullable();
            $table->string('safety_device2', 100)->nullable();
            $table->string('safety_device3', 100)->nullable();
            $table->string('safety_device4', 100)->nullable();
            $table->string('safety_device5', 100)->nullable();
            $table->string('safety_device6', 100)->nullable();
            $table->string('safety_device7', 100)->nullable();
            $table->string('safety_device8', 100)->nullable();
            $table->string('safety_device9', 100)->nullable();
            $table->string('safety_device10', 100)->nullable();
            $table->string('komponen_utama1', 100)->nullable();
            $table->string('komponen_utama2', 100)->nullable();
            $table->string('komponen_utama3', 100)->nullable();
            $table->string('komponen_utama4', 100)->nullable();
            $table->string('komponen_utama5', 100)->nullable();
            $table->string('komponen_utama6', 100)->nullable();
            $table->string('komponen_utama7', 100)->nullable();
            $table->string('komponen_utama8', 100)->nullable();
            $table->string('komponen_utama9', 100)->nullable();
            $table->string('komponen_utama10', 100)->nullable();
            $table->string('pendukung_mesin1', 100)->nullable();
            $table->string('pendukung_mesin2', 100)->nullable();
            $table->string('pendukung_mesin3', 100)->nullable();
            $table->string('pendukung_mesin4', 100)->nullable();
            $table->string('pendukung_mesin5', 100)->nullable();
            $table->string('pendukung_mesin6', 100)->nullable();
            $table->string('pendukung_mesin7', 100)->nullable();
            $table->string('pendukung_mesin8', 100)->nullable();
            $table->string('pendukung_mesin9', 100)->nullable();
            $table->string('pendukung_mesin10', 100)->nullable();

            $table->json('foto_pengukuran')->nullable();
            $table->decimal('pengukuran_grounding', 15, 4)->nullable();
            $table->decimal('pengukuran_pencahayaan', 15, 4)->nullable();
            $table->decimal('pengukuran_suhu', 15, 4)->nullable();
            $table->decimal('pengukuran_kebisingan', 15, 4)->nullable();
            
            $table->json('foto_pengujian')->nullable();
            $table->string('emergency_stop', 100)->nullable();
            $table->string('emergency_stop_hasil', 100)->nullable();
            $table->text('ket_emergency_stop')->nullable();
            $table->string('blank', 100)->nullable();
            $table->string('blank_hasil', 100)->nullable();
            $table->text('ket_blank')->nullable();
            $table->string('blank2', 100)->nullable();
            $table->string('blank2_hasil', 100)->nullable();
            $table->text('ket_blank2')->nullable();
            $table->string('blank3', 100)->nullable();
            $table->string('blank3_hasil', 100)->nullable();
            $table->text('ket_blank3')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_pesawat_tenaga_produksi');
    }
};
