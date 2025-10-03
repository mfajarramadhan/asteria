<?php

namespace App\Http\Controllers;

use App\Models\JobOrderTool;
use Illuminate\Http\Request;

class RiksaUjiController extends Controller
{
    public function index()
    {
        // ambil semua alat yg sudah selesai diperiksa
        $tools = JobOrderTool::with(['tool.jenis.subJenis', 'jobOrder',])
            ->where('status_tool', 'selesai')
            ->latest()
            ->get();

        return view('riksa_uji.index', [
            'title'    => 'Daftar Alat Selesai Diperiksa',
            'subtitle' => 'Semua Jenis Riksa Uji',
            'tools'    => $tools,
        ]);
    }
}
