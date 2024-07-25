<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $template = "dashboard.user.index";
        return view("dashboard.layout",compact("template","config"));
    }

    private
}
