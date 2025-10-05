<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpScrewCompressor extends Model
{
    /** @use HasFactory<\Database\Factories\FormKpScrewCompressorFactory> */
    use HasFactory;
    protected $table = 'form_kp_screw_compressor';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan'   => 'date',
        'foto_shell_separator'  => 'array',
        'foto_instalasi_pipa'   => 'array',
        'foto_casing_screw'     => 'array',
        'foto_pondasi_screw'    => 'array',
        'foto_safety_device'    => 'array',
        'foto_pressure_switch'  => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}
