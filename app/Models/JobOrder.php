<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    /** @use HasFactory<\Database\Factories\JobOrderFactory> */
    use HasFactory;
    protected $fillable = [
        'nomor_jo',
        'tanggal_kunjungan',
        'nama_perusahaan',
        'alamat_perusahaan',
        'status'    
    ];

    public function tools(){
        return $this->hasMany(JobOrderTool::class);
    }

    public function responsibles(){
        return $this->hasMany(JobOrderResponsible::class);
    }

    //Logic cek status JO
    public function recalculateStatus(): void
    {
        $total = $this->tools()->count();
        $done  = $this->tools()->where('status', 'selesai')->count();
        $anyProses = $this->tools()->where('status', 'proses')->exists();

        if ($total === 0) {
            $newStatus = 'belum';
        } elseif ($done === $total) {
            $newStatus = 'selesai';
        } elseif ($anyProses || $done > 0) {
            $newStatus = 'proses';
        } else {
            $newStatus = 'belum';
        }

        if ($this->status !== $newStatus) {
            $this->update(['status' => $newStatus]);
        }
    }

}
