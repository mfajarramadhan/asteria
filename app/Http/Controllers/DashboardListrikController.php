<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardListrikController extends Controller
{
    public function index(){
        return view('form_kp.listrik.index', [
            'title' => 'Dashboard Listrik',
            'subtitle' => '',
        ]);
    }
}
