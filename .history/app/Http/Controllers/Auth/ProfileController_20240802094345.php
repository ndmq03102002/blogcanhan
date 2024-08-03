<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    public function edit()
    {
        $profile = UserProfile::where('user_id', Auth::user()->id)->first();
        return view('user.profile.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = UserProfile::updateOrCreate(
            ['user_id' => Auth::user()->id],
            [
                'name' => $request->name,
                'dateofbirth' => $request->dateofbirth,
                'sex' => $request->sex,
                'address' => $request->address,
                'avatar' => $this->handleAvatarUpload($request)
            ]
        );

        return redirect()->route('profile.view')->with('success', 'Profile updated successfully!');
    }

    private function handleAvatarUpload(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');
            return $path;
        }
        return null;
    }

    // Hiển thị form đổi mật khẩu
    public function showChangePasswordForm()
    {
        return view('user.profile.change-password');
    }

    // Xử lý yêu cầu đổi mật khẩu
    public function changePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'current_password' => 'required',
        'new_password' => 'required|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->route('profile.change-password')
                         ->withErrors($validator)
                         ->withInput();
    }

    $user = Auth::user();

    if (!Hash::check($request->input('current_password'), $user->password)) {
        return redirect()->route('profile.change-password')
                         ->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.'])
                         ->withInput();
    }

    $user->password = Hash::make($request->input('new_password'));

    return redirect()->route('profile.change-password')->with('status', 'Mật khẩu đã được cập nhật thành công.');
}

}
