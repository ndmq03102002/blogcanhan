<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\User;
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

    private function handleAvatarUpload(Request $request, $currentAvatarPath = null)
{
    // Kiểm tra nếu có file ảnh trong request
    if ($request->hasFile('avatar')) {
        // Xóa ảnh cũ nếu có
        if ($currentAvatarPath && \Storage::disk('public')->exists($currentAvatarPath)) {
            \Storage::disk('public')->delete($currentAvatarPath);
        }

        // Lưu ảnh mới
        $file = $request->file('avatar');
        $path = $file->store('avatars', 'public');
        return $path;
    }

    // Nếu không có file ảnh mới, giữ ảnh cũ
    return $currentAvatarPath;
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

    $id = Auth::user()->id;
    $user = User::find($id);
    if (!Hash::check($request->input('current_password'), $user->password)) {
        return redirect()->route('profile.change-password')
                         ->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.'])
                         ->withInput();
    }

    $user->password = Hash::make($request->input('new_password'));
    $user->save();
    return redirect()->route('blog.home')->with('status', 'Mật khẩu đã được cập nhật thành công.');
}

}
