<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Tool extends Model
{
    /** @use HasFactory<\Database\Factories\ToolFactory> */
    use HasFactory, HasRoles;

    protected $table = 'tools';
    protected $guarded = [
        'id',
    ];

    // Relasi ke JO
    public function jobOrders()
    {
        return $this->hasMany(JobOrderTool::class);
    }

    // Relasi ke Jenis
    public function jenis()
    {
        return $this->belongsTo(JenisRiksaUji::class, 'jenis_riksa_uji_id', 'id');
    }

    // Relasi ke Sub Jenis
    public function subJenis()
    {
        return $this->belongsTo(SubJenisRiksaUji::class, 'sub_jenis_riksa_uji_id', 'id');
    }
}
