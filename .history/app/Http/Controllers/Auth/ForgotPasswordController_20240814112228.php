<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\PasswordReset;
use App\Mail\ForgotPassword;
class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function checkForgotPassword(Request $request)
{
    $request->validate(['email' => 'required|email|exists:users,email']);


    // Tìm user và lưu OTP
    $user = User::where('email', $request->email)->firstOrFail();

    $token = Str::random(40);

    $tokenData = [
        'email' => $request->email,
        'token' => $token
    ];
    if(PasswordReset::create($tokenData)){
        Mail::to($request->email)->send(new ForgotPassword($user,$token));
        return redirect()->back()->with('success', 'Chúng tôi đã gửi email hãy xác nhận.');
    }
    

    return redirect()->back()->with('error', 'Lỗi! Vui lòng thử lại.');
           
    }
    public function showResetPasswordForm()
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request , $token)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);
        $tokenData = PasswordReset::where('token', $token)->firstOrFail();
        $user = User::where('email', $tokenData->email)->firstOrFail();
        $data = [
            
            'password' => Hash::make($request->password)
        ];
        $check = $user->update($data);

        if($check){
            
        }

    }


}
