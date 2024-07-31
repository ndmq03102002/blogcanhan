<?php
// app/Http/Controllers/PostController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    
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
