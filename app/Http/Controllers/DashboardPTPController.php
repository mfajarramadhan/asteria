<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPTPController extends Controller
{
    public function index(){
        return view('form_kp.ptp.index', [
            'title' => 'Dashboard Pesawat Tenaga Produksi',
            'subtitle' => '',
        ]);
    }
}
