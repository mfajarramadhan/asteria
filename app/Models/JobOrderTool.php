<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrderTool extends Model
{
    /** @use HasFactory<\Database\Factories\JobOrderToolFactory> */
    use HasFactory;

    protected $table = 'job_order_tools';

    protected $fillable = [
        'job_order_id',
        'tool_id',
        'qty',
        'status',
        'kapasitas',
        'model',
        'no_seri',
        'status_tool',
        'finished_at',
    ];

    protected $casts = [
        'tool_id'   => 'integer',
        'qty'       => 'integer',
        'finished_at' => 'datetime',
    ];

    protected $primaryKey = 'id';
    public $incrementing = true;

    // Relasi ke Daftar Alat
    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }

    // Relasi ke JO
    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class, 'job_order_id');
    }

    // Relasi ke Form KP PUBT
    public function formKpBejanaTekan()
    {
        return $this->hasOne(FormKpBejanaTekan::class, 'job_order_tool_id');
    }

    public function formKpKatelUap()
    {
        return $this->hasOne(FormKpKatelUap::class, 'job_order_tool_id');
    }

    public function formKpScrewCompressor()
    {
        return $this->hasOne(FormKpScrewCompressor::class, 'job_order_tool_id');
    }

    public function formKpTangkiTimbun()
    {
        return $this->hasOne(FormKpTangkiTimbun::class, 'job_order_tool_id');
    }
    
    // Relasi ke Form KP PTP
    public function formKpPesawatTenagaProduksi()
    {
        return $this->hasOne(FormKpPesawatTenagaProduksi::class, 'job_order_tool_id');
    }
    
    public function formKpMotorDiesel()
    {
        return $this->hasOne(FormKpMotorDiesel::class, 'job_order_tool_id');
    }
    
    public function formKpHeatTreatment()
    {
        return $this->hasOne(FormKpHeatTreatment::class, 'job_order_tool_id');
    }

    // Relasi ke Form KP PAPA
    public function formKpScissorLift()
    {
        return $this->hasOne(FormKpScissorLift::class, 'job_order_tool_id');
    }

    public function formKpWheelLoader()
    {
        return $this->hasOne(FormKpWheelLoader::class, 'job_order_tool_id');
    }

    public function formKpDumpTrailer()
    {
        return $this->hasOne(FormKpDumpTrailer::class, 'job_order_tool_id');
    }

    public function formKpCrane()
    {
        return $this->hasOne(FormKpCrane::class, 'job_order_tool_id');
    }

    public function formKpForklift()
    {
        return $this->hasOne(formKpForklift::class, 'job_order_tool_id');
    }

    public function formKpCargoLift()
    {
        return $this->hasOne(formKpCargoLift::class, 'job_order_tool_id');
    }
    
    // Relasi ke Form Listrik
    public function formKpInstalasiListrik()
    {
        return $this->hasOne(FormKpInstalasiListrik::class, 'job_order_tool_id');
    }
    
    public function formKpInstalasiPenyalurPetir()
    {
        return $this->hasOne(FormKpInstalasiPenyalurPetir::class, 'job_order_tool_id');
    }

    // Relasi ke Form Eskalator
    public function formKpEskalator()
    {
        return $this->hasOne(FormKpEskalator::class, 'job_order_tool_id');
    }

    public function formKpElevator()
    {
        return $this->hasOne(FormKpElevator::class, 'job_order_tool_id');
    }

    // Relasi ke Form IPK
    public function formKpInstalasiFireAlarm()
    {
        return $this->hasOne(FormKpInstalasiFireAlarm::class, 'job_order_tool_id');
    }
}
