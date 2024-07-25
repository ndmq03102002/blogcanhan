<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AuthRequest;

class LoginController extends Controller
{
    public function viewlogin(){
        return view("auth.login");
    }

    public function login(AuthRequest $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Check credentials
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect() -> route('auth.dashboard')->with('success', 'Đăng nhập thành công');
        }
        return redirect() -> route('auth.login')->with('error', 'Email hoặc mật khẩu không đúng');
        
    }
}
