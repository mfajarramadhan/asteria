<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total semua Job Order
        $totalJobOrder = JobOrder::count();

        // Riksa Uji Berjalan (misal status = 'proses')
        $riksaBerjalan = JobOrder::where('status_jo', 'proses')->count();

        // Riksa Uji Selesai (misal status = 'selesai')
        $riksaSelesai = JobOrder::where('status_jo', 'selesai')->count();

        return view('main-dashboard', [
            'title' => 'Dashboard',
            'subtitle' => 'Ringkasan laporan riksa uji PT. Asteria Riksa Indonesia',
            'totalJobOrder' => $totalJobOrder,
            'riksaBerjalan' => $riksaBerjalan,
            'riksaSelesai' => $riksaSelesai,
        ]);
    }
}
