<?php

namespace App\Observers;

use App\Models\JobOrderTool;

class JobOrderToolObserver
{
    public function saving(JobOrderTool $jobOrderTool): void
    {
        // kalau status berubah ke "selesai" → set finished_at otomatis
        if ($jobOrderTool->isDirty('status') && $jobOrderTool->status === 'selesai') {
            $jobOrderTool->finished_at = now();
        }
    }   

    public function saved(JobOrderTool $jobOrderTool): void
    {
        // update status job order induk
        $jobOrderTool->jobOrder?->recalculateStatus();
    }

    public function deleted(JobOrderTool $jobOrderTool): void
    {
        // update status job order induk kalau pivot dihapus
        $jobOrderTool->jobOrder?->recalculateStatus();
    }
}