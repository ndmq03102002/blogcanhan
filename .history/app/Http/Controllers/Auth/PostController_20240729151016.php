<?php

namespace App\Http\Controllers\Auth;
use App\Services\Interfaces\CatServiceInterface as CatService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CatRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
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

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
        ]);

        // Xử lý ảnh đại diện
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
        }

        // Tạo mới bài viết
        $post = new Post();
        $post->title = $request->input('title');
        $post->image = $imagePath;
        $post->content = $request->input('content');
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->input('category_id');
        $post->save();

        // Lưu danh mục bài viết
        $post->categories()->sync($request->input('category_id'));

        return redirect()->route('post.create')->with('success', 'Bài viết đã được lưu thành công!');
    }



}
