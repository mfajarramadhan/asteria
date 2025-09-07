<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    /** @use HasFactory<\Database\Factories\JobOrderFactory> */
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    // protected $fillable = [
    //     'nama_perusahaan',
    //     'alamat_perusahaan',
    //     'pic_order',
    //     'email',
    //     'contact_person',
    //     'no_penawaran',
    //     'no_purcash_order',
    //     'tanggal_pemeriksaan',
    //     'nomor_jo',
    //     'status'    
    // ];

    public function tools(){
        return $this->hasMany(JobOrderTool::class);
    }

    public function responsibles(){
        return $this->belongsToMany(User::class, 'job_order_responsibles')->withTimestamps();
    }

    //Logic cek status JO
    public function recalculateStatus(): void
    {
        $total = $this->tools()->count();
        $done  = $this->tools()->where('status', 'selesai')->count();

        if ($total === 0) {
            $newStatus = 'belum';
        } elseif ($done === $total) {
            $newStatus = 'selesai';
        } else {
            $newStatus = 'proses'; // ada sebagian selesai, sebagian belum
        }

        if ($this->status !== $newStatus) {
            $this->update(['status' => $newStatus]);
        }
    }

}
