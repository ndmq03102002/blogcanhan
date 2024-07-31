<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class HomeController extends Controller
{
   
    public function index($id)
    {
        $post = Post::with('categories')->findOrFail($id);
        return view('blog.home', compact('post'));
    }
}
