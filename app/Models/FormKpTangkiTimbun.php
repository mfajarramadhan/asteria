<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpTangkiTimbun extends Model
{
    /** @use HasFactory<\Database\Factories\FormKpTangkiTimbunFactory> */
    use HasFactory;

    protected $table = 'form_kp_tangki_timbun';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'foto_visual' => 'array',
        'foto_pengukuran' => 'array',
        'foto_komponen' => 'array',
        'foto_tangki' => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}
