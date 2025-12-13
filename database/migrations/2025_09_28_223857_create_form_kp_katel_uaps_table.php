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
            
            $table->json('foto_informasi_umum')->nullable();
            $table->string('pabrik_pembuat', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();
            $table->string('tempat_pembuatan', 100)->nullable();
            $table->decimal('tekanan_desain', 15, 4)->nullable();
            $table->decimal('tekanan_kerja', 15, 4)->nullable();
            $table->decimal('luas_pemanasan', 15, 4)->nullable();
            $table->decimal('work_temperature', 15, 4)->nullable();
            $table->string('bahan_bakar')->nullable();

            $table->json('foto_safety_valve')->nullable();
            $table->decimal('safety_valve1_membuka', 15, 4)->nullable();
            $table->decimal('safety_valve1_menutup', 15, 4)->nullable();
            $table->decimal('safety_valve2_membuka', 15, 4)->nullable();
            $table->decimal('safety_valve2_menutup', 15, 4)->nullable();
            $table->text('catatan_safety_valve')->nullable();

            $table->json('foto_pressure_switch')->nullable();
            $table->decimal('pressure_switch_on_set', 15, 4)->nullable();
            $table->decimal('pressure_switch_on_hasil', 15, 4)->nullable();
            $table->decimal('pressure_switch_off_set', 15, 4)->nullable();
            $table->decimal('pressure_switch_off_hasil', 15, 4)->nullable();
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
