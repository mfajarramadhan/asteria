<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpDumpTrailer extends Model
{
    use HasFactory;

    protected $table = 'form_kp_dump_trailer';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        // 'foto_mesin' => 'array',
        // 'foto_generator' => 'array',
        // 'foto_pengukuran' => 'array',
        // 'foto_pengujian' => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}

