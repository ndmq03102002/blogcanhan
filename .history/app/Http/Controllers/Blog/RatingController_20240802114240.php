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
