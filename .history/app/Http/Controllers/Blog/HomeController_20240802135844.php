<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Services\Interfaces\PostServiceInterface as PostService;
class HomeController extends Controller
{
    protected  $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function show($id, Request $request)
{
    $post = Post::with('categories', 'user.profile', 'comments.user.profile')->findOrFail($id);
    $categories = Category::with('children')->get();
    $formattedDate = ucwords($post->updated_at->locale('vi')->translatedFormat('l, d/m/Y - H:i'));

    // Lấy trang hiện tại từ query string hoặc mặc định là trang 1
    $currentPage = $request->get('page', 1);
    
    // Phân trang bình luận
    $cmt = $post->comments()->with('user.profile')->paginate(10, ['*'], 'page', $currentPage);
    
    $template = 'blog.index';
    return view('blog.home', compact('categories', 'post', 'formattedDate', 'template', 'cmt'));
}


    public function index()
    {
        // Lấy tất cả bài viết với phân trang
        $posts = Post::with('user')->paginate(5); // Mỗi trang có 6 bài viết, 1 bài chính và 5 bài phụ

        // Tính toán bài viết chính và bài viết phụ
        $allPosts = $posts->items(); // Lấy tất cả bài viết trong trang hiện tại
        $mainPost = !empty($allPosts) ? $allPosts[0] : null; // Bài viết chính
        $additionalPosts = array_slice($allPosts, 1, 4); // 4 bài viết phụ
        $template = 'blog.content';
        // Lấy danh sách danh mục
        $categories = Category::with('children')->get();

        return view('blog.home', compact('posts', 'mainPost', 'additionalPosts', 'categories', 'template'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category_id', null); // Nếu có category_id, có thể truyền vào hàm tìm kiếm
    
        // Sử dụng PostService để tìm kiếm bài viết theo từ khóa
        $postService = app(PostService::class);
        $posts = $postService->filter($keyword, $categoryId, 5);
    
        // Tính toán bài viết chính và bài viết phụ
        $allPosts = $posts->items(); // Lấy tất cả bài viết trong trang hiện tại
        $mainPost = !empty($allPosts) ? $allPosts[0] : null; // Bài viết chính
        $additionalPosts = array_slice($allPosts, 1, 4); // 4 bài viết phụ
    
        // Lấy danh sách danh mục
        $categories = Category::with('children')->get();
    
        return view('blog.home', compact('posts', 'mainPost', 'additionalPosts', 'categories'));
    }
    
}
