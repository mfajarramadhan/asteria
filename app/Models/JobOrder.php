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

    protected $casts = [
        'kelengkapan' => 'array', // parsing json menjadi array
    ];

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
