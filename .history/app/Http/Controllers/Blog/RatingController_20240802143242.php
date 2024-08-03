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
    // Xác định điều kiện tìm kiếm: kết hợp `post_id` và `user_id`
    $attributes = [
        'post_id' => $request->input('post_id'),
        'user_id' => auth()->id(),
    ];

    // Xác định các giá trị cần cập nhật hoặc tạo mới
    $values = [
        'rating' => $request->input('rating'),
    ];

    // Tìm kiếm hoặc tạo mới bản ghi
    Rating::updateOrCreate($attributes, $values);

    // Tính toán điểm trung bình
    $averageRating = Rating::where('post_id', $request->input('post_id'))->average('rating');

    return response()->json([
        'averageRating' => number_format($averageRating, 1)
    ]);
}

}

