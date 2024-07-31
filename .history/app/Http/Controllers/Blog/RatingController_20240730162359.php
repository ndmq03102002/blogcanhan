<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Xác thực người dùng đã đăng nhập
        if (!Auth::check()) {
            return redirect()->back()->withErrors('Bạn cần đăng nhập để đánh giá bài viết.');
        }

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Lưu đánh giá vào cơ sở dữ liệu
        Rating::updateOrCreate(
            ['post_id' => $request->input('post_id'), 'user_id' => Auth::id()],
            ['rating' => $request->input('rating')]
        );

        // Chuyển hướng về trang bài viết với thông báo thành công
        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi thành công.');
    }
}