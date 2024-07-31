<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class CommentController extends Controller
{
   
    public function store()
    {
        Comment::create([
            'post_id' => $request->input('post_id'),
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        // Chuyển hướng về trang bài viết với thông báo thành công
        return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi thành công.');
    }
}
