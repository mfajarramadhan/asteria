<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpElevator extends Model
{
    use HasFactory;

    protected $table = 'form_kp_elevator';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',

        // Foto (JSON)
        'foto_mesin' => 'array',
        'foto_tali_penggantung' => 'array',
        'foto_teromol' => 'array',
        'foto_bangun_ruang_luncur' => 'array',
        'foto_komponen_kereta' => 'array',
    ];

    // Relasi ke job_order_tools
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class, 'job_order_tool_id');
    }
}
