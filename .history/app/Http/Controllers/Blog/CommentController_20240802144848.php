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

    public function update(Request $request, Comment $comment)
    {
        // Kiểm tra xem người dùng hiện tại có phải là người sở hữu comment không
        if ($comment->user_id !== auth()->id()) {
            return response()->json([
                'error' => 'Bạn không có quyền sửa bình luận này.'
            ], 403);
        }

        // Cập nhật nội dung comment
        $request->validate([
            'content' => 'required|string|max:1000', // Thay đổi quy tắc validate nếu cần
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return response()->json([
            'success' => 'Bình luận đã được cập nhật thành công.',
            'content' => $comment->content
        ]);
    }
    
}
