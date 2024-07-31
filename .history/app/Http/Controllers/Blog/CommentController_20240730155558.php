<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class CommentController extends Controller
{
   
    public function index()
    {
        $post = Post::with('categories')->findOrFail(5);
        return view('blog.home', compact('post'));
    }
}
