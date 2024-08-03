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
        $post = Post::findOrFail($id);

        // Xử lý ảnh đại diện nếu có ảnh mới được tải lên
        if ($request->hasFile('image')) {
            // Loại bỏ tiền tố "/storage/" để tạo đường dẫn đúng
            // dd($post->image);
            $fileToDelete = str_replace('/storage/', 'public/', $post->image);
            Storage::delete($fileToDelete);

            $image = $request->file('image')->store('public/images/');
            $imageUrl = Storage::url($image);
        } else {
            // Giữ ảnh hiện tại nếu không có ảnh mới
            $imageUrl = $post->image;
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imageUrl,
        ]);

        // Đồng bộ các danh mục
        $post->categories()->sync($request->input('category_id', []));

        return redirect()->route('post.index')->with('success', 'Bài viết đã được cập nhật!');
    }
}
