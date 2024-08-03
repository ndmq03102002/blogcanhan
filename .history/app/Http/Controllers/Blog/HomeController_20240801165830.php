<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
class HomeController extends Controller
{
   
    // public function index()
    // {
    //     // $post = Post::with('categories','user')->findOrFail(1);
    //     $categories = Category::with('children')->get();
    //     // $categories = Category::with('children')->whereNull('parent_id')->get();
    //     // $formattedDate = ucwords($post->updated_at->locale('vi')->translatedFormat('l, d/m/Y - H:i'));
    //     return view('blog.home', compact('categories'));
    // }

    public function index()
    {
        // Lấy bài viết đại diện (ví dụ bài viết mới nhất)
        $mainPost = Post::with('categories', 'user')
                        ->latest()
                        ->first();

        // Lấy 4 bài viết phụ (ví dụ các bài viết sau bài viết đại diện)
        $relatedPosts = Post::with('categories', 'user')
                            ->where('id', '!=', $mainPost->id)
                            ->latest()
                            ->take(4)
                            ->get();

        $categories = Category::with('children')->get();

        return view('blog.home', compact('mainPost', 'relatedPosts', 'categories'));
    }
}
