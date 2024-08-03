<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
class HomeController extends Controller
{
   
    public function index()
    {
        // $post = Post::with('categories','user')->findOrFail(1);
        $categories = Category::with('children')->get();
        // $categories = Category::with('children')->whereNull('parent_id')->get();
        // $formattedDate = ucwords($post->updated_at->locale('vi')->translatedFormat('l, d/m/Y - H:i'));
        return view('blog.home', compact('formattedDate', 'categories'));
    }

  
}
