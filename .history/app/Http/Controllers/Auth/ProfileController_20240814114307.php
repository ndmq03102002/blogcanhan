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
    // Lấy thông tin hồ sơ của người dùng hiện tại
    $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();

    // Lấy đường dẫn ảnh hiện tại
    $currentAvatarPath = $userProfile ? $userProfile->avatar : null;

    // Xử lý việc tải ảnh lên và giữ ảnh cũ nếu không có ảnh mới
    $avatarPath = $this->handleAvatarUpload($request, $currentAvatarPath);

    // Cập nhật hoặc tạo mới hồ sơ người dùng
    UserProfile::updateOrCreate(
        ['user_id' => Auth::user()->id],
        [
            'name' => $request->name,
            'dateofbirth' => $request->dateofbirth,
            'sex' => $request->sex,
            'address' => $request->address,
            'avatar' => $avatarPath
        ]
    );

    return redirect()->route('profile.view')->with('success', 'Profile updated successfully!');
}

private function handleAvatarUpload(Request $request, $currentAvatarPath = null)
{
    // Kiểm tra nếu có file ảnh trong request
    if ($request->hasFile('avatar')) {
        // Xóa ảnh cũ nếu có
        if ($currentAvatarPath && Storage::disk('public')->exists($currentAvatarPath)) {
            Storage::disk('public')->delete($currentAvatarPath);
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
        'new_password' => 'required|confirmed|min:6',
        ''
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
