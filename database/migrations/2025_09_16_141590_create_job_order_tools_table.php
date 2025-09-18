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
        Schema::create('job_order_tools', function (Blueprint $table) {
        $table->id();
        $table->foreignId('job_order_id')->constrained('job_orders')->onDelete('cascade');
        $table->foreignId('tool_id')->constrained('tools')->onDelete('cascade');

        // Detail tambahan
        $table->integer('qty')->default(1);
        $table->string('status')->default('pertama'); // pertama / resertifikasi
        $table->string('kapasitas')->nullable();
        $table->string('model')->nullable();
        $table->string('no_seri')->nullable();
        $table->string('status_tool')->default('belum'); // belum / on proses / selesai
        $table->timestamp('finished_at')->nullable(); // di isi otomatis saat status selesai
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_order_tools');
    }
};
