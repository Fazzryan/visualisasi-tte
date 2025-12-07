<?php

namespace App\Http\Controllers\Be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('be.admin.pages.dashboard.index');
    }
    
    public function spesimen()
    {
        return view('be.admin.pages.dashboard.spesimen');
    }
}
