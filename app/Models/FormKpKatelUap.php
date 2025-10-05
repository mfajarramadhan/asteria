<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpKatelUap extends Model
{
    /** @use HasFactory<\Database\Factories\FormKpKatelUapFactory> */
    use HasFactory;

    protected $table = 'form_kp_katel_uap';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'foto_informasi_umum' => 'array',
        'foto_safety_valve' => 'array',
        'foto_pressure_switch' => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}
