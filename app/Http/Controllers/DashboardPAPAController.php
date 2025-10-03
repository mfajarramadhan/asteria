<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPAPAController extends Controller
{
    public function index(){
        return view('form_kp.papa.index', [
            'title' => 'Dashboard Pesawat Angkat Pesawat Angkut',
            'subtitle' => '',
        ]);
    }
}
