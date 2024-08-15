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

    public function login(Request $request)
    {
        
        // Check credentials
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // 
            if ($user->role == 'admin') {
                return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công');;
            } else {
                return redirect()->route('blog.home')->with('success', 'Đăng nhập thành công');;
            }
    }
    return back()->withErrors(['login' => 'Username hoặc password không chính xác!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect() -> route('auth.login');
    }
}
