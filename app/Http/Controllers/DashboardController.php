<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function dashboardPegawai(){
        return view('dashboardPegawai');
    }

    public function dashboardKoki(){
        return view('dashboardKoki');
    }
    
}
