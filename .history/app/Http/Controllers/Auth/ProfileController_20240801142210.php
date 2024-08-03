<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
class ProfileController extends Controller
{
    public function edit()
    {
        $profile = UserProfile::where('user_id', Auth::id())->first();
        return view('user.profile.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = UserProfile::where('user_id', Auth::id())->first();
        $profile->update($request->all());
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
