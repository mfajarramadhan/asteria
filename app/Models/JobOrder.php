<?php

namespace App\Models;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOrder extends Model
{
    /** @use HasFactory<\Database\Factories\JobOrderFactory> */
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'kelengkapan'                    => 'array', // parsing json menjadi array
        'tanggal_dibuat'                 => 'date',
        'tanggal_selesai'                => 'date',
        'tanggal_pemeriksaan1'           => 'date',
        'tanggal_pemeriksaan2'           => 'date',
        'tanggal_pemeriksaan3'           => 'date',
        'tanggal_pemeriksaan4'           => 'date',
        'tanggal_pemeriksaan5'           => 'date',
        'kelengkapan_manual_book'        => 'boolean',
        'kelengkapan_layout'             => 'boolean',
        'kelengkapan_maintenance_report' => 'boolean',
        'kelengkapan_surat_permohonan'   => 'boolean',
    ];

    public function tools()
    {
        return $this->belongsToMany(Tool::class, 'job_order_tools')
                    ->withPivot(['qty', 'status', 'kapasitas', 'model', 'no_seri', 'status_tool']);
    }


    public function responsibles(){
        return $this->belongsToMany(User::class, 'job_order_responsibles')->withTimestamps();
    }

    //Logic cek status JO
    public function recalculateStatus(): void
    {
        $total = $this->tools()->count();
        $done  = $this->tools()->where('status_tool', 'selesai')->count();

        if ($total === 0) {
            $newStatus = 'belum';
        } elseif ($done === 0) {
            $newStatus = 'belum'; // ada tool tapi belum ada yg selesai
        } elseif ($done === $total) {
            $newStatus = 'selesai';
        } else {
            $newStatus = 'proses'; // ada yg selesai, ada yg belum
        }

        if ($this->status_jo !== $newStatus) {
            $this->update(['status_jo' => $newStatus]);
        }
    }


}
