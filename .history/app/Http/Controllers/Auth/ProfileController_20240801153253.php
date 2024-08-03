<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    public function edit()
    {
        $profile = UserProfile::where('user_id', Auth::id())->first();
        return view('user.profile.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        if ($request->hasFile('image')) {
           
            $fileToDelete = str_replace('/storage/', 'public/', $post->image);
            Storage::delete($fileToDelete);

            $image = $request->file('image')->store('public/images/');
            $imageUrl = Storage::url($image);
        } else {
            // Giữ ảnh hiện tại nếu không có ảnh mới
            $imageUrl = $post->image;
        }
        $profile = UserProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $request->name,
                'dateofbirth' => $request->dateofbirth,
                'sex' => $request->sex,
                'address' => $request->address,
                'avatar' => $this->handleAvatarUpload($request)
            ]
        );

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
