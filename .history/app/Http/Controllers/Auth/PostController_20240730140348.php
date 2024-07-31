<?php
// app/Http/Controllers/PostController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\Interfaces\CatServiceInterface as CatService;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('categories')->paginate(5);
        $config['seo'] = config('apps.post');
        $config['method'] = 'index';
        $template = 'post.index';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'posts',
        ));
    }
    public function search(Request $request){
        // Lấy các tham số từ request
        $keyword = $request->input('keyword');
        $catId = $request->input('parent_id');
        $perPage = $request->input('perpage');
        $rootCategories = Category::whereNull('parent_id')->get();
        // Gọi phương thức filter từ service
        $categories = $this->catService->filter($keyword, $catId, $perPage);

        $config['seo'] = config('apps.cats');
        $template = "category.index";  

        return view("dashboard.layout", compact("template", "config","categories","rootCategories" ,"keyword", "catId", "perPage"));
    }
    public function create()
    {
        $posts = Post::all();
        $categories = Category::all();
        $config['seo'] = config('apps.post');
        $config['method'] = 'create';
        $template = 'post.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'posts',
            'categories',
        ));
    }

    public function store(Request $request, $id = null)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|array',
        ]);

        // Xử lý ảnh đại diện nếu có
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($image);
        } else {
            $imageUrl = null;
        }

        // Tạo bài viết mới
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imageUrl, // Lưu đường dẫn ảnh vào cột image
            'user_id' => Auth::user()->id,
        ]);

        // Gán danh mục cho bài viết
        $post->categories()->sync($request->input('category_id', []));

        return redirect()->route('post.create')->with('success', 'Thêm bài viết thành công');
    }
}
