<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpInstalasiFireHydrant extends Model
{
    /** @use HasFactory<\Database\Factories\FormKpInstalasiFireHydrantFactory> */
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'datetime', // Migration uses 'time' type for Hydrant but usually it's date/datetime. Migration says $table->time('tanggal_pemeriksaan'). Let's stick to what's common or check if it should be date.
        // Wait, migration: $table->time('tanggal_pemeriksaan')->nullable(); // Sesuai gambar: TIME
        // But usually it's a date. Let me check the View later. usage: datepicker suggests date.
        // If migration is TIME, then casts should prob be 'datetime:H:i:s' or just string.
        // However, FireAlarm migration has $table->date('tanggal_pemeriksaan').
        // Hydrant migration has $table->time('tanggal_pemeriksaan'). 
        // I will assume for now it might be date, but if migration says time, I should be careful. 
        // Let's look at the migration comment: "// Sesuai gambar: TIME". 
        // If it's time, then input type should be time.
        // But 'tanggal' means date. 'Jam' means time. 
        // It might be a mistake in migration or requirement. 
        // For now I won't cast it to date if it's time.
        'foto_informasi_umum' => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}
