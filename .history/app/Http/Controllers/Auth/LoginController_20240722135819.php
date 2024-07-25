<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function viewlogin(){
        return view("auth.login");
    }
    public function login(Request $request)
    {
        // Validate input
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required|string',
        //     'password' => 'required|string'
        // ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($credentials)) {
            dd('');
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('auth.dashboard'); // Đổi thành route của bạn
            } else {
                return redirect()->route('blog.home'); // Đổi thành route của bạn
            }
        }

        
    }
}