<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Services\Interfaces\PostServiceInterface as PostService;
class HomeController extends Controller
{
    protected  $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function show($id)
    {
        $post = Post::with('categories','user')->findOrFail($id);
        $categories = Category::with('children')->get();
        // $categories = Category::with('children')->whereNull('parent_id')->get();
        $formattedDate = ucwords($post->updated_at->locale('vi')->translatedFormat('l, d/m/Y - H:i'));
        return view('blog.index', compact('categories','post','formattedDate'));
    }

    public function index()
    {
        // Lấy tất cả bài viết với phân trang
        $posts = Post::with('user')->paginate(5); // Mỗi trang có 6 bài viết, 1 bài chính và 5 bài phụ

        // Tính toán bài viết chính và bài viết phụ
        $allPosts = $posts->items(); // Lấy tất cả bài viết trong trang hiện tại
        $mainPost = !empty($allPosts) ? $allPosts[0] : null; // Bài viết chính
        $additionalPosts = array_slice($allPosts, 1, 4); // 4 bài viết phụ

        // Lấy danh sách danh mục
        $categories = Category::with('children')->get();

        return view('blog.home', compact('posts', 'mainPost', 'additionalPosts', 'categories'));
    }

    public function search(Request $request)
{
    $categoryId = $request->input('category_id');
    $perpage = 5; // Số bài viết trên mỗi trang

    // Sử dụng PostService để tìm kiếm bài viết
    $postService = app(PostService::class);
    $posts = $postService->filter($categoryId, $perpage);

    // Tính toán bài viết chính và bài viết phụ
    $allPosts = $posts->items(); // Lấy tất cả bài viết trong trang hiện tại
    $mainPost = !empty($allPosts) ? $allPosts[0] : null; // Bài viết chính
    $additionalPosts = array_slice($allPosts, 1, 4); // 4 bài viết phụ

    // Lấy danh sách danh mục
    $categories = Category::with('children')->get();

    return view('blog.home', compact('posts', 'mainPost', 'additionalPosts', 'categories'));
}
}