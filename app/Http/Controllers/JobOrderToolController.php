<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;

class JobOrderToolController extends Controller
{
    /**
     * Mulai pemeriksaan alat → status = belum
     */
    public function setBelum(JobOrderTool $jobOrderTool)
    {
        $jobOrderTool->update(['status' => 'belum', 'finished_at' => null]);

        return back()->with('success', 'Status alat diubah ke belum diperiksa.');
    }

    /**
     * Selesaikan pemeriksaan alat → status = selesai
     */
    public function setSelesai(JobOrderTool $jobOrderTool)
    {
        $jobOrderTool->update(['status' => 'selesai']);

        return back()->with('success', 'Alat berhasil diselesaikan.');
    }
}
