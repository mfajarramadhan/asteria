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
        Schema::create('form_kp_katel_uap', function (Blueprint $table) {
            $table->id();
            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('pabrik_pembuat')->nullable();
            $table->json('foto_informasi_umum')->nullable();
            $table->string('jenis_alat')->nullable();
            $table->string('merk_model')->nullable();
            $table->string('tempat_tahun_pembuatan')->nullable();
            $table->string('no_seri_unit')->nullable();
            $table->decimal('tekanan_desain', 10, 4)->nullable();
            $table->decimal('tekanan_kerja', 10, 4)->nullable();
            $table->string('kapasitas_uap')->nullable();
            $table->decimal('luas_pemanasan', 10, 4)->nullable();
            $table->decimal('work_temperature', 10, 4)->nullable();
            $table->string('bahan_bakar')->nullable();
            $table->string('lokasi')->nullable();
            $table->json('foto_safety_valve')->nullable();
            $table->decimal('safety_valve1_membuka', 10, 4)->nullable();
            $table->decimal('safety_valve1_menutup', 10, 4)->nullable();
            $table->decimal('safety_valve2_membuka', 10, 4)->nullable();
            $table->decimal('safety_valve2_menutup', 10, 4)->nullable();
            $table->text('catatan_safety_valve')->nullable();
            $table->json('foto_pressure_switch')->nullable();
            $table->decimal('pressure_switch_on_set', 10, 4)->nullable();
            $table->decimal('pressure_switch_on_hasil', 10, 4)->nullable();
            $table->decimal('pressure_switch_off_set', 10, 4)->nullable();
            $table->decimal('pressure_switch_off_hasil', 10, 4)->nullable();
            $table->text('catatan_pressure_switch')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_katel_uap');
    }
};
