<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardEskalatorController extends Controller
{
    public function index()
    {
        return view('form_kp.eskalator.index', [
            'title' => 'Dashboard Eskalator dan Elevator',
            'subtitle' => '',
        ]);
    }
}
