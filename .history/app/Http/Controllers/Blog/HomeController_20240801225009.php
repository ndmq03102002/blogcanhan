<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
class HomeController extends Controller
{
   
    public function show($id)
    {
        $post = Post::with('categories','user')->findOrFail($id);
        // $categories = Category::with('children')->get();
        // $categories = Category::with('children')->whereNull('parent_id')->get();
        $formattedDate = ucwords($post->updated_at->locale('vi')->translatedFormat('l, d/m/Y - H:i'));
        return view('blog.index', compact('categories','post','formattedDate'));
    }

    public function index()
    {
        // Lấy tất cả bài viết với phân trang
        $posts = Post::withpaginate(5); // Mỗi trang có 6 bài viết, 1 bài chính và 5 bài phụ

        // Tính toán bài viết chính và bài viết phụ
        $mainPost = $posts->first(); // Bài viết chính trên trang hiện tại
        $additionalPosts = $posts->slice(1, 5); // 5 bài viết phụ

        // Lấy danh sách danh mục
        $categories = Category::with('children')->get();

        return view('blog.home', compact('posts', 'mainPost', 'additionalPosts', 'categories'));
    }
}
