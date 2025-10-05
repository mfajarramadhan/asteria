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
        Schema::create('form_kp_screw_compressor', function (Blueprint $table) {
            $table->id();
            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->json('foto_shell_separator')->nullable();
            $table->decimal('ketebalan_shell_separator', 10, 3)->nullable();
            $table->decimal('diameter_shell_separator', 10, 3)->nullable();
            $table->decimal('panjang_shell_separator', 10, 3)->nullable();
            $table->json('foto_instalasi_pipa')->nullable();
            $table->decimal('diameter_instalasi_pipa', 10, 3)->nullable();
            $table->decimal('ketebalan_instalasi_pipa', 10, 3)->nullable();
            $table->decimal('panjang_instalasi_pipa', 10, 3)->nullable();
            $table->json('foto_casing_screw')->nullable();
            $table->decimal('panjang_casing_screw', 10, 3)->nullable();
            $table->decimal('lebar_casing_screw', 10, 3)->nullable();
            $table->decimal('tinggi_casing_screw', 10, 3)->nullable();
            $table->json('foto_pondasi_screw')->nullable();
            $table->decimal('panjang_pondasi_screw', 10, 3)->nullable();
            $table->decimal('lebar_pondasi_screw', 10, 3)->nullable();
            $table->json('foto_safety_device')->nullable();
            $table->decimal('safety_valve_separator_membuka', 10, 3)->nullable();
            $table->decimal('safety_valve_separator_menutup', 10, 3)->nullable();
            $table->text('catatan_safety_valve')->nullable();
            $table->json('foto_pressure_switch')->nullable();
            $table->decimal('pressure_switch_on_set', 10, 3)->nullable();
            $table->decimal('pressure_switch_on_hasil', 10, 3)->nullable();
            $table->decimal('pressure_switch_off_set', 10, 3)->nullable();
            $table->decimal('pressure_switch_off_hasil', 10, 3)->nullable();
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
        Schema::dropIfExists('form_kp_screw_compressor');
    }
};
