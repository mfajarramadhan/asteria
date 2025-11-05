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
        Schema::table('form_kp_elevator', function (Blueprint $table) {
            $table->unsignedBigInteger('job_order_tool_id')->nullable()->after('id');
            $table->foreign('job_order_tool_id')
                ->references('id')->on('job_order_tools')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('form_kp_elevator', function (Blueprint $table) {
            $table->dropForeign(['job_order_tool_id']);
            $table->dropColumn('job_order_tool_id');
        });
    }
};
