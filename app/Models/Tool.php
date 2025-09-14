<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Tool extends Model
{
    /** @use HasFactory<\Database\Factories\ToolFactory> */
    use HasFactory, HasRoles;

    protected $guarded = [
        'id',
    ];

    // Cast ke array otomatis saat diambil dari DB
    // protected $casts = [
    //     'lampiran' => 'array',
    // ];

    public function jobOrders()
    {
        return $this->hasMany(JobOrderTool::class);
    }
}
