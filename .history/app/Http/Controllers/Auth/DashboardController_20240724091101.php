<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $template = "dashboard.home.index";
        return view("dashboard.index",compact("template"));
    }
}
