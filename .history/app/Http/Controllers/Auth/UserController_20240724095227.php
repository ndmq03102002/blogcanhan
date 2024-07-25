<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $config = $this->config();
        $template = "user.index";
        return view("dashboard.layout",compact("template","config"));
    }

    private function config(){
        return [
            'js' => [
                'template/js/plugins/switchery/switchery.js',
            ],
            'css' => [
                    'tempalte/css/plugins/switchery/switchery.css'
                ]
        ];
    }
}
