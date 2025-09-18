<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubJenisRiksaUji extends Model
{
    /** @use HasFactory<\Database\Factories\SubJenisRiksaUjiFactory> */
    use HasFactory;

    protected $table = 'sub_jenis_riksa_ujis';
    protected $fillable = [
        'id'
    ];

    // Relasi ke Jenis
    public function jenis()
    {
        return $this->belongsTo(JenisRiksaUji::class, 'jenis_riksa_uji_id', 'id');
    }

    // Relasi ke Tools
    public function tools()
    {
        return $this->hasMany(Tool::class, 'sub_jenis_riksa_uji_id');
    }
}
