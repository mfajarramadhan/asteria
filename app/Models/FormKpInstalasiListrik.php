<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpInstalasiListrik extends Model
{
    use HasFactory;

    protected $table = 'form_kp_instalasi_listrik';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        // 'foto_informasi_umum' => 'array',
        // 'foto_device' => 'array',
        // 'foto_pengukuran' => 'array',
        // 'foto_pengujian' => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}
