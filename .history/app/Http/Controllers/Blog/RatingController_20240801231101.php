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
    

        // Lưu đánh giá vào cơ sở dữ liệu
        Rating::updateOrCreate(
            ['post_id' => $request->input('post_id'), 'user_id' => Auth::id()],
            ['rating' => $request->input('rating')]
        );
        $averageRating = $post->ratings()->avg('rating');
        $averageRating = number_format($averageRating, 1); // Làm tròn đến 1 chữ số
        // Chuyển hướng về trang bài viết với thông báo thành công
        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi thành công.');
    }
}