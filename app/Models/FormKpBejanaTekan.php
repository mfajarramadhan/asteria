<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormKpBejanaTekan extends Model
{
    use HasFactory;

    protected $table = 'form_kp_bejana_tekan';

    protected $fillable = [
        'job_order_tool_id',
        'tanggal_pemeriksaan',
        'pemeriksa',
        'pagar_pelindung',
        'ban_pegangan',
        'peralatan_pengaman',
        'catatan',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}

