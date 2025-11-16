<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardIPKController extends Controller
{
    public function index()
    {
        return view('form_kp.ipk.index', [
            'title' => 'Dashboard Instalasi Fire Alarm dan Instalasi Fire Hydrant',
            'subtitle' => '',
        ]);
    }
}
