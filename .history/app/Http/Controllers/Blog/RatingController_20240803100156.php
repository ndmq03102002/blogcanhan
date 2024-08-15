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
    Rating::updateOrCreate(
        [
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
        ],
        [
            'rating' => $request->rating,
        ]
    );

    return redirect()->back()

    
}

}

