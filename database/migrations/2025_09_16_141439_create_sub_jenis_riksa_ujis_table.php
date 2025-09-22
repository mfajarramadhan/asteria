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
        Schema::create('sub_jenis_riksa_ujis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_riksa_uji_id')->constrained('jenis_riksa_ujis')->onDelete('cascade');
            $table->string('sub_jenis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_jenis_riksa_ujis');
    }
};
