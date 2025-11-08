<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpElevator extends Model
{
    use HasFactory;

    protected $table = 'form_kp_elevator';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'foto_komponen_kereta' => 'array',
        'foto_panel_operasi' => 'array',
        'foto_atap_kereta' => 'array',
        'foto_governor_rem' => 'array',
        'foto_bobot_imbang' => 'array',
    ];

    // Relasi ke JobOrderTool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }

    // Optional: Helper untuk memudahkan akses foto
    public function getFotoKomponenKeretaUrlsAttribute()
    {
        return $this->foto_komponen_kereta ? array_map(fn($f) => asset("storage/$f"), $this->foto_komponen_kereta) : [];
    }

    public function getFotoPanelOperasiUrlsAttribute()
    {
        return $this->foto_panel_operasi ? array_map(fn($f) => asset("storage/$f"), $this->foto_panel_operasi) : [];
    }

    public function getFotoAtapKeretaUrlsAttribute()
    {
        return $this->foto_atap_kereta ? array_map(fn($f) => asset("storage/$f"), $this->foto_atap_kereta) : [];
    }

    public function getFotoGovernorRemUrlsAttribute()
    {
        return $this->foto_governor_rem ? array_map(fn($f) => asset("storage/$f"), $this->foto_governor_rem) : [];
    }

    public function getFotoBobotImbangUrlsAttribute()
    {
        return $this->foto_bobot_imbang ? array_map(fn($f) => asset("storage/$f"), $this->foto_bobot_imbang) : [];
    }
}
