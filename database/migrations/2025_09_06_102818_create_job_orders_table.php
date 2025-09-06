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
        Schema::create('job_orders', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal_pembuatan');
        $table->string('nomor_jo')->unique();
        $table->date('tanggal_kunjungan')->nullable();
        $table->string('nama_perusahaan');
        $table->string('alamat_perusahaan')->nullable();
        $table->string('status')->default('belum'); // belum, on proses, selesai
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_orders');
    }
};
