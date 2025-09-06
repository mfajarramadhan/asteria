<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderResponsible extends Model
{
    /** @use HasFactory<\Database\Factories\JobOrderResponsibleFactory> */
    use HasFactory;
     protected $fillable = [
        'job_order_id',
        'user_id',
        'role',
    ];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
