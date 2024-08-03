<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->input('post_id');
        $comment->user_id = auth()->id();
        $comment->content = $request->input('content');
        
        $comment->save();
    
        return response()->json([
            'avatar' => asset('storage/avatars/' . basename(auth()->user()->profile->avatar ?? 'default-avatar.png')),
            'username' => auth()->user()->username,
            'content' => $comment->content
        ]);
    }
    
}
