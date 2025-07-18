<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        
        return view('backoffice.dashboard');
        
    }
}

