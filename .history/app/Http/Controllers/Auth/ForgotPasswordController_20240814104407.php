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
        return redirect()->back('auth.login')->with('status', 'Chúng tôi đã gửi email chứa mã OTP để bạn đặt lại mật khẩu.');
    }
    

    return view("auth.reset-password",compact("otp")); 
           
    }
    public function showResetPasswordForm(Request $request)
    {
        // // Lấy user theo OTP từ request
        $user = User::where('otp', $request->input('otp'))->first();

        // if (!$user) {
        //     return redirect()->route('password.request')->withErrors(['token' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
        // }

        return view('auth.reset-password', ['otp' => $request->input('otp')]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'otp' => 'required'
        ]);

        $user = User::where('otp', $request->opt)->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors(['token' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
        }

        // Cập nhật mật khẩu và xóa OTP
        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->save();

        return redirect()->route('auth.login')->with('status', 'Mật khẩu đã được cập nhật thành công.');
    }


}
