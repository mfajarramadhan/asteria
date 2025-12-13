<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpCrane extends Model
{
    use HasFactory;

    protected $table = 'form_kp_crane';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'foto_informasi_umum' => 'array',
        'foto_rantai' => 'array',
        'foto_wire_rope' => 'array',
        'foto_hook' => 'array',
        'foto_pulley' => 'array',
        'foto_loadtest' => 'array',
        'foto_defleksi' => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}
