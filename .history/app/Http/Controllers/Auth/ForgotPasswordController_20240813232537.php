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
use App\Mail\OtpEMail;
class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Tạo mã OTP và lưu vào cơ sở dữ liệu hoặc lưu trữ tạm thời
    $user = User::where('email', $request->email)->firstOrFail();
    $token = Str::random(60); // Token tạm thời
    $user->otp = $token; // Lưu token vào cơ sở dữ liệu
    $user->save();

    // Gửi email với liên kết reset password
    Mail::to($request->email)->send(new OtpEmail($token));

    return back()->with('status', 'Mã OTP đã được gửi đến email của bạn.');
}

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|size:6',
            'password' => 'required|min:6|confirmed',
        ]);

        $reset = DB::table('password_resets')->where('email', $request->email)->where('token', $request->otp)->first();

        if (!$reset) {
            return back()->withErrors(['otp' => 'Mã OTP không hợp lệ.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Mật khẩu đã được thay đổi thành công.');
    }
}
