<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class HomeController extends Controller
{
   
    public function index()
    {
        $post = Post::with('categories','user')->findOrFail(1);
        return view('blog.home', compact('post'));
    }
}
