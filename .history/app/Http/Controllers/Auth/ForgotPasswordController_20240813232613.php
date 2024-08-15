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

public function showResetPasswordForm(Request $request)
{
    // Lấy user theo OTP từ request
    $user = User::where('otp', $request->input('token'))->first();

    if (!$user) {
        return redirect()->route('password.request')->withErrors(['token' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
    }

    return view('auth.reset-password', ['token' => $request->input('token')]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
        'token' => 'required'
    ]);

    $user = User::where('otp', $request->token)->first();

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
