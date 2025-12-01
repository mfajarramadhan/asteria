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
        Schema::create('form_kp_forklift', function (Blueprint $table) {
            $table->id();
            // Relasi ke job_order_tools
            $table->foreignId('job_order_tool_id')->constrained('job_order_tools')->onDelete('cascade');

            $table->date('tanggal_pemeriksaan');
            $table->string('pabrik_pembuat')->nullable();
            $table->string('jenis')->nullable();
            $table->string('lokasi')->nullable();
            $table->json('foto_informasi_umum')->nullable();
            
            // Kolom Kecepatan
            $table->json('foto_kecepatan')->nullable();
            $table->string('kecepatan_angkat', 25)->nullable();
            $table->string('kecepatan_ungkit', 25)->nullable();
            $table->string('kecepatan_jalan', 25)->nullable();
            
            // Kolom Umum & Operator
            $table->json('foto_radius')->nullable();
            $table->string('radius_putaran_kiri', 25)->nullable();
            $table->string('radius_putaran_kanan', 25)->nullable();
            $table->string('penggerak', 100)->nullable();
            $table->string('nama_operator', 100)->nullable();
            $table->string('sertifikat_operator_sio', 100)->nullable();

            // Kolom Dimensi Forklift
            $table->json('foto_dimensi_forklift')->nullable();
            $table->string('panjang_dimensi_forklift', 25)->nullable();
            $table->string('lebar_dimensi_forklift', 25)->nullable();
            $table->string('tinggi_dimensi_forklift', 25)->nullable();
            
            // Dimensi Garpu
            $table->json('foto_garpu')->nullable();
            $table->string('tinggi_garpu', 50)->nullable();
            $table->string('lebar_garpu', 50)->nullable();
            $table->string('tebal_garpu1', 50)->nullable();
            $table->string('tebal_garpu2', 50)->nullable();
            $table->string('tebal_garpu3', 50)->nullable();
            
            // Back Rest (Pagar)
            $table->json('foto_pagar')->nullable();
            $table->string('tinggi_pagar', 50)->nullable();
            $table->string('lebar_pagar', 50)->nullable();
            
            // Mast (Tiang)
            $table->json('foto_mast')->nullable(); 
            $table->string('tinggi_mast', 50)->nullable();
            $table->string('lebar_mast', 50)->nullable();
            $table->string('tebal_mast', 50)->nullable();
            
            // Torak
            $table->json('foto_torak')->nullable(); 
            $table->string('torak_dalam', 50)->nullable();
            $table->string('torak_luar', 50)->nullable();
            $table->string('tinggi_torak', 50)->nullable();

            // Jarak Roda
            $table->json('foto_jarak_antarroda')->nullable();
            $table->string('jarak_roda_depan', 50)->nullable();
            $table->string('jarak_roda_belakang', 50)->nullable();
            $table->string('jarak_as_roda_depan_belakang', 50)->nullable();

            $table->json('foto_load_test')->nullable();

            // Load Test 1
            $table->string('tinggi_angkat_hook1', 100)->nullable();
            $table->string('swl_beban_uji1', 100)->nullable();
            $table->string('travelling_kecepatan1', 100)->nullable();
            $table->string('gerakan1', 100)->nullable();
            $table->string('hasil1', 100)->nullable();
            $table->string('keterangan1', 100)->nullable();

            // Load Test 2
            $table->string('tinggi_angkat_hook2', 100)->nullable();
            $table->string('swl_beban_uji2', 100)->nullable();
            $table->string('travelling_kecepatan2', 100)->nullable();
            $table->string('gerakan2', 100)->nullable();
            $table->string('hasil2', 100)->nullable();
            $table->string('keterangan2', 100)->nullable();

            // Load Test 3
            $table->string('tinggi_angkat_hook3', 100)->nullable();
            $table->string('swl_beban_uji3', 100)->nullable();
            $table->string('travelling_kecepatan3', 100)->nullable();
            $table->string('gerakan3', 100)->nullable();
            $table->string('hasil3', 100)->nullable();
            $table->string('keterangan3', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kp_forklift');
    }
};
