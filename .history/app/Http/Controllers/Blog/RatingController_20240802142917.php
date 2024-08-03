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
        
        // Chuyển hướng về trang bài viết với thông báo thành công
        return redirect()->back();
    }
}

public function store(Request $request)
{
    $rating = new Rating();
    $rating->post_id = $request->input('post_id');
    $rating->user_id = auth()->id();
    $rating->rating = $request->input('rating');
    $rating->save();

    $averageRating = Rating::where('post_id', $request->input('post_id'))->average('rating');

    return response()->json([
        'averageRating' => number_format($averageRating, 1)
    ]);
}