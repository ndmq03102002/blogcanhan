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
        $formattedDate = $post->created_at->locale('vi')->translatedFormat('l, d/m/Y - H:i');

        return view('blog.home', compact('post',));
    }
}
