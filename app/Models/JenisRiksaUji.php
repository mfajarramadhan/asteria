<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRiksaUji extends Model
{
    /** @use HasFactory<\Database\Factories\JenisRiksaUjiFactory> */
    use HasFactory;

    protected $table = 'jenis_riksa_ujis';
    protected $guarded = [
        'id'
    ];

    // Relasi ke Sub Jenis
    public function subJenis()
    {
        return $this->hasMany(SubJenisRiksaUji::class, 'jenis_riksa_uji_id', 'id');
    }

    // Relasi ke Tools (via Sub Jenis)
    public function tools()
    {
        return $this->hasManyThrough(
            Tool::class,
            SubJenisRiksaUji::class,
            'jenis_riksa_uji_id',  // FK di sub_jenis
            'sub_jenis_riksa_uji_id', // FK di tools
            'id',
            'id'
        );
    }
}
