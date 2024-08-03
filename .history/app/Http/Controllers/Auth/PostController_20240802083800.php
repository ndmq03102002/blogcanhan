<?php
// app/Http/Controllers/PostController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\Interfaces\PostServiceInterface as PostService;
class PostController extends Controller
{
    protected  $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index()
    {
        $posts = Post::with('categories')->paginate(5);
        $cats = Category::with('children')->defaultOrder()->get();
        $config['seo'] = config('apps.post');
        $config['method'] = 'index';
        $template = 'post.index';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'posts',
            'cats',
        ));
    }
    public function search(Request $request){
        // Lấy các tham số từ request
        $keyword = $request->input('keyword');
        $catId = $request->input('parent_id');
        $perPage = $request->input('perpage',);
        $rootCategories = Category::whereNull('parent_id')->get();
        $cats = Category::with('children')->defaultOrder()->get();
        // Gọi phương thức filter từ service
        $posts = $this->postService->filter($keyword, $catId, $perPage);
        $config['seo'] = config('apps.post');
        $template = "post.index";  
        return view("dashboard.layout", compact("template", "config","rootCategories" ,"keyword", "catId", "perPage","cats","posts"));
    }
    public function create()
    {
        $posts = Post::all();
        $cats = Category::all();
        $config['seo'] = config('apps.post');
        $config['method'] = 'create';
        $template = 'post.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'posts',
            'cats',
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


    public function edit($id){
        $post = Post::with('categories')->findOrFail($id);
        $cats = Category::all();
        $config['seo'] = config('apps.post');
        $config['method'] = 'edit';
        $template = 'post.store';
        return view('dashboard.layout', compact(
            'template',
            'post',
            'config',
            "cats"
        ));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Xử lý ảnh đại diện nếu có ảnh mới được tải lên
        if ($request->hasFile('image')) {
            // Loại bỏ tiền tố "/storage/" để tạo đường dẫn đúng
            // dd($post->image);
            $fileToDelete = str_replace('/storage/', 'public/', $post->image);
            Storage::delete($fileToDelete);

            $image = $request->file('image')->store('public/images/');
            $imageUrl = Storage::url($image);
        } else {
            // Giữ ảnh hiện tại nếu không có ảnh mới
            $imageUrl = $post->image;
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imageUrl,
        ]);

        // Đồng bộ các danh mục
        $post->categories()->sync($request->input('category_id', []));

        return redirect()->route('post.index')->with('success', 'Bài viết đã được cập nhật!');
    }


    public function delete($id){
        $post = Post::with('categories')->findOrFail($id);
        $cats = Category::all();
        $config['seo'] = config('apps.post');
        $template = 'post.delete';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'post',
            'cats',
        ));
    }

    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('post.index')->with('success','Bạn đã xóa thành công');
    }
}
