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
    'foto_informasi_umum' => 'array',
    'foto_informasi_umum' => 'array',
            'foto_mesin' => 'array',
            'foto_tali_penggantung' => 'array',
            'foto_teromol' => 'array',
            'foto_bangun_ruang_luncur' => 'array',
            'foto_komponen_kereta' => 'array',
            'foto_governor_rem' => 'array',
            'foto_bobot_imbang' => 'array',
            'foto_instalasi_listrik'=> 'array'
];



    public function jobOrderTool()
    {
        return $this->belongsTo(JobOrderTool::class, 'job_order_tool_id');
    }
}
