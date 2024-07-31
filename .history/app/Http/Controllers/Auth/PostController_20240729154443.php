<?php

namespace App\Http\Controllers\Auth;
use App\Services\Interfaces\CatServiceInterface as CatService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CatRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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
        // Xác thực dữ liệu nhập vào
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'content' => 'required|string',
        ]);

        // Lưu ảnh đại diện nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        // Nếu có ID thì cập nhật bài viết hiện tại, ngược lại tạo mới
        if ($id) {
            $post = Post::findOrFail($id);
            $post->update([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'image' => $imagePath,
                'user_id' => Auth::id(),
            ]);
        } else {
            $post = Post::create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'image' => $imagePath,
                'user_id' => Auth::id(),
            ]);
        }

        // Xử lý các danh mục liên kết với bài viết
        $post->categories()->sync($validatedData['category_id']);

        // Quay lại trang trước đó với thông báo thành công
        return redirect()->back()->with('success', 'Bài viết đã được lưu thành công!');
    }



}
