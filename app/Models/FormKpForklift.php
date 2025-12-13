<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpForklift extends Model
{
    use HasFactory;

    protected $table = 'form_kp_forklift';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'foto_informasi_umum' => 'array',
        'foto_kecepatan' => 'array',
        'foto_radius' => 'array',
        'foto_dimensi_forklift' => 'array',
        'foto_garpu' => 'array',
        'foto_pagar' => 'array',
        'foto_mast' => 'array',
        'foto_torak' => 'array',
        'foto_jarak_antarroda' => 'array',
        'foto_load_test' => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}
