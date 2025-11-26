<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKpHeatTreatment extends Model
{
    use HasFactory;

    protected $table = 'form_kp_heat_treatment';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'foto_informasi_umum' => 'array',
        'foto_billet' => 'array',
        'foto_shell' => 'array',
        'foto_jalur_furnace' => 'array',
        'foto_pembakaran' => 'array',
        'foto_pendingin' => 'array',
        'foto_konstruksi_pondasi_furnace' => 'array',
        'foto_furnace_shell' => 'array',
        'foto_sambungan_las' => 'array',
        'foto_tutup_furnace' => 'array',
        'foto_refractory' => 'array',
        'foto_sidewalls_refractory' => 'array',
        'foto_hearth_refractory' => 'array',
        'foto_clamping_hydraulic' => 'array',
        'foto_charging_table' => 'array',
        'foto_furnace_top_igniter' => 'array',
        'foto_burner' => 'array',
        'foto_conveyor' => 'array',
        'foto_control_room' => 'array',
        'foto_pipa_nosel' => 'array',
        'foto_nosel_ng' => 'array',
        'foto_pipa_ng' => 'array',
        'foto_nosel_oksigen' => 'array',
        'foto_pipa_oksigen' => 'array',
        'foto_nosel_n2' => 'array',
        'foto_pipa_n2' => 'array',
        'foto_safety_valve' => 'array',
        'foto_holder_cap' => 'array',
        'foto_sistem_pendingin' => 'array',
        'foto_sistem_pendingin_tutup' => 'array',
        'foto_sistem_pendingin_shell' => 'array',
        'foto_pipa_air_pendingin_shell' => 'array',
        'foto_sistem_pendingin_kejut' => 'array',
        'foto_sistem_kelistrikan' => 'array',
        'foto_mcb' => 'array',
        'foto_sambungan_bracket' => 'array',
        'foto_tahanan_isolasi' => 'array',
        'foto_safety_device' => 'array',
        'foto_pressure_gauge' => 'array',
        'foto_temp_idicator' => 'array',
        'foto_sensor_bahan_bakar' => 'array',
        'foto_thermocouple' => 'array',
        'foto_sistem_pembumian' => 'array',
        'foto_furnace_top_bleeding' => 'array',
        'foto_safety_valve_nitrogen_supply' => 'array',
        'foto_safety_valve_ng_cng' => 'array',
        'foto_safety_valve_oksigen' => 'array',
        'foto_safety_valve_n2' => 'array',
        'foto_dust_collector' => 'array',
        'foto_gas_stop_valve' => 'array',
        'foto_dust_remover' => 'array',
        'foto_electrostatis_precipitator_bag' => 'array',
        'foto_emergency_stop' => 'array',
        'foto_pagar_pengaman_lantai' => 'array',
        'foto_lantai_dapur' => 'array',
        'foto_pagar_pengaman_tangga' => 'array',
    ];

    // Relasi ke job_order_tool
    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class);
    }
}
