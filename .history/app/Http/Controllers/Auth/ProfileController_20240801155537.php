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
        $profile = UserProfile::where('user_id', Auth::user->id)->first();
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

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
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
}
