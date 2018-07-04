<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function dd(){
    	$json_string = json_encode(Request("commands"));
    	die($json_string);
    }
}
