<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderTool extends Model
{
    /** @use HasFactory<\Database\Factories\JobOrderToolFactory> */
    use HasFactory;
    protected $filable = [
        'job_order_id',
        'tool_id',
        'qty',
        'status_pemeriksaan',
        'status',
        'kelengkapan',
        'finished_at',
    ];

    protected $casts = [
        'kelengkapan' => 'array',
    ];

    protected $dates = ['finished_at'];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class, 'job_order_id');
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }
}
