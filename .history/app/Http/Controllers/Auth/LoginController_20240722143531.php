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
        

        // Check credentials
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('auth.dashboard');
            } else {
                return redirect()->route('blog.home');
            }
    }
    return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
