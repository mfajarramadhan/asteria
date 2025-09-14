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
        $table->string('nama_perusahaan');
        $table->string('alamat_perusahaan');
        $table->string('pic_order');
        $table->string('email')->nullable();
        $table->string('contact_person')->nullable();
        $table->string('no_penawaran')->nullable();
        $table->string('no_purcash_order')->nullable();
        $table->date('tanggal_pemeriksaan1')->nullable();
        $table->date('tanggal_pemeriksaan2')->nullable();
        $table->date('tanggal_pemeriksaan3')->nullable();
        $table->date('tanggal_pemeriksaan4')->nullable();
        $table->date('tanggal_pemeriksaan5')->nullable();
        $table->integer('jumlah_hari_pemeriksaan');
        $table->date('tanggal_selesai')->nullable();
        $table->time('jam_bertemu')->nullable();
        $table->time('jam_selesai')->nullable();
        $table->string('pic_ditemui')->nullable();
        $table->string('contact_person2')->nullable();
        $table->date('tanggal_dibuat')->nullable(); 
        $table->string('nomor_jo')->unique();
        $table->string('status_jo')->default('belum'); // belum, proses, selesai
        $table->boolean('kelengkapan_manual_book')->default(false);
        $table->integer('qty_manual_book')->nullable();
        $table->boolean('kelengkapan_layout')->default(false);
        $table->integer('qty_layout')->nullable();
        $table->boolean('kelengkapan_maintenance_report')->default(false);
        $table->integer('qty_maintenance_report')->nullable();
        $table->boolean('kelengkapan_surat_permohonan')->default(false);
        $table->integer('qty_surat_permohonan')->nullable();
        $table->text('catatan')->nullable();
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
