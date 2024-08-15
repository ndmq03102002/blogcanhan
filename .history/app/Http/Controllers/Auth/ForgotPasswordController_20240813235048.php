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
use App\Mail\OtpEmail;
class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Tạo mã OTP số ngẫu nhiên
    $otp = rand(100000, 999999); // Tạo mã OTP 6 chữ số

    // Tìm user và lưu OTP
    $user = User::where('email', $request->email)->firstOrFail();
    $user->otp = $otp; // Lưu mã OTP vào cơ sở dữ liệu
    
    $user->otp_expires_at = now()->addMinutes(10); // Thay đổi thêm cột để lưu thời gian hết hạn
    $user->save();

    // Gửi email với mã OTP
    Mail::to($request->email)->send(new OtpEmail($otp));

    return redirect()->route('password.reset')->compact('otp', 'email')
            ->with('status', 'OTP đã được gửi tới email của bạn.');
    }
    public function showResetPasswordForm(Request $request)
    {
        // // Lấy user theo OTP từ request
        $user = User::where('otp', $request->input('otp'))->first();

        // if (!$user) {
        //     return redirect()->route('password.request')->withErrors(['token' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
        // }

        return view('auth.reset-password', ['otp' => $request->input('token')]);
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
