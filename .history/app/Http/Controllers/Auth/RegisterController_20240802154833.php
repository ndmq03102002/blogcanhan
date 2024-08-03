<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AuthRequest;
class RegisterController extends Controller
{
    public function viewregister(){
        return view("auth.register");
    }
    public function register(ReRequest $request)
    {
        
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Set role to 'customer'
        ]);

        // Redirect to login with success message
        return redirect()->route('auth.login')->with('status', 'Đăng ký thành công! Bạn có thể đăng nhập ngay.');
        }
}
