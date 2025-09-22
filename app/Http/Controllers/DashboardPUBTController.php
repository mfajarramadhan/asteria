<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPUBTController extends Controller
{
    public function index(){
        return view('form_kp.pubt.index', [
            'title' => 'Dashboard Pesawat Uap dan Bejana Tekan',
            'subtitle' => '',
        ]);
    }
}
