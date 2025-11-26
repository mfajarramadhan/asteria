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
            $table->string('pabrik_pembuat')->nullable();
            $table->json('foto_informasi_umum')->nullable();
            $table->string('nama_mesin')->nullable();
            $table->string('fungsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->json('foto_device')->nullable();
            $table->string('safety_device1')->nullable();
            $table->string('safety_device2')->nullable();
            $table->string('safety_device3')->nullable();
            $table->string('safety_device4')->nullable();
            $table->string('safety_device5')->nullable();
            $table->string('safety_device6')->nullable();
            $table->string('safety_device7')->nullable();
            $table->string('safety_device8')->nullable();
            $table->string('safety_device9')->nullable();
            $table->string('safety_device10')->nullable();
            $table->string('komponen_utama1')->nullable();
            $table->string('komponen_utama2')->nullable();
            $table->string('komponen_utama3')->nullable();
            $table->string('komponen_utama4')->nullable();
            $table->string('komponen_utama5')->nullable();
            $table->string('komponen_utama6')->nullable();
            $table->string('komponen_utama7')->nullable();
            $table->string('komponen_utama8')->nullable();
            $table->string('komponen_utama9')->nullable();
            $table->string('komponen_utama10')->nullable();
            $table->string('pendukung_mesin1')->nullable();
            $table->string('pendukung_mesin2')->nullable();
            $table->string('pendukung_mesin3')->nullable();
            $table->string('pendukung_mesin4')->nullable();
            $table->string('pendukung_mesin5')->nullable();
            $table->string('pendukung_mesin6')->nullable();
            $table->string('pendukung_mesin7')->nullable();
            $table->string('pendukung_mesin8')->nullable();
            $table->string('pendukung_mesin9')->nullable();
            $table->string('pendukung_mesin10')->nullable();
            $table->json('foto_pengukuran')->nullable();
            $table->decimal('pengukuran_grounding', 10, 4)->nullable();
            $table->decimal('pengukuran_pencahayaan', 10, 4)->nullable();
            $table->decimal('pengukuran_suhu', 10, 4)->nullable();
            $table->decimal('pengukuran_kebisingan', 10, 4)->nullable();
            $table->json('foto_pengujian')->nullable();
            $table->string('emergency_stop')->nullable();
            $table->string('emergency_stop_hasil')->nullable();
            $table->text('ket_emergency_stop')->nullable();
            $table->string('blank')->nullable();
            $table->string('blank_hasil')->nullable();
            $table->text('ket_blank')->nullable();
            $table->string('blank2')->nullable();
            $table->string('blank2_hasil')->nullable();
            $table->text('ket_blank2')->nullable();
            $table->string('blank3')->nullable();
            $table->string('blank3_hasil')->nullable();
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
