<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    // Helper untuk ubah jenis & sub jenis jadi rute
    public function routeName(){
        $jenisSlug = Str::snake(Str::lower(optional($this->jenis)->jenis ?? ''));
        $subJenisSlug = Str::snake(Str::lower($this->sub_jenis ?? ''));
        
        return "form_kp.{$jenisSlug}.{$subJenisSlug}.create";
    }

}
