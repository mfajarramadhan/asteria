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
        Schema::table('form_kp_instalasi_fire_hydrants', function (Blueprint $table) {
            if (!Schema::hasColumn('form_kp_instalasi_fire_hydrants', 'job_order_tool_id')) {
                $table->unsignedBigInteger('job_order_tool_id')->after('job_order_id')->nullable(); 
                // Made nullable initially to avoid errors with existing data, but logic requires it. 
                // Ideally strict, but for fix safely nullable is better then update data if needed.
                // However model demands it. Let's make it not nullable if possible, or nullable.
                // The original schema had it not nullable.
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_kp_instalasi_fire_hydrants', function (Blueprint $table) {
            if (Schema::hasColumn('form_kp_instalasi_fire_hydrants', 'job_order_tool_id')) {
                $table->dropColumn('job_order_tool_id');
            }
        });
    }
};
