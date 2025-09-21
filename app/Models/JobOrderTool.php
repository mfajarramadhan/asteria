<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderTool extends Model
{
    /** @use HasFactory<\Database\Factories\JobOrderToolFactory> */
    use HasFactory;

    protected $table = 'job_order_tools';

    protected $fillable = [
        'job_order_id',
        'tool_id',
        'qty',
        'status',
        'kapasitas',
        'model',
        'no_seri',
        'status_tool',
        'finished_at',
    ];

    protected $casts = [
        'tool_id'   => 'integer',
        'qty'       => 'integer',
            'finished_at' => 'datetime',
    ];

    protected $primaryKey = 'id';
    public $incrementing = true;

    // Relasi ke Daftar Alat
    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }

    // Relasi ke JO
    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class, 'job_order_id');
    }

     // Relasi ke Form KP Forklift
    public function formKpForklift()
    {
        return $this->hasOne(FormKpBejanaTekan::class, 'job_order_tool_id');
    }
}
