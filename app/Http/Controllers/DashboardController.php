<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $sales = DB::table('transaction_items')->count();
        $ordered = DB::table('transactions')->count();
        $products = DB::table('products')->count();
        $users = DB::table('users')->count();
        return view('dashboard',compact('sales','ordered','products','users'));
    }

    public function dashboardPegawai(){
        $sales = DB::table('transaction_items')->count();
        $ordered = DB::table('transactions')->count();
        $products = DB::table('products')->count();
        $users = DB::table('users')->count();
        return view('dashboardPegawai',compact('sales','ordered','products','users'));
    }

    public function dashboardKoki(){
        return view('dashboardKoki');
    }
    
}
