<?php

namespace App\Http\Controllers\Auth;
use App\Services\Interfaces\CatServiceInterface as CatService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CatRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
class PostController extends Controller
{
    
    public function create()
    {
        $posts = Post::all();
        $config['seo'] = config('apps.post');
        $config['method'] = 'create';
        $template = 'post.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'posts',
        ));
    }

    public function store(CatRequest $request)
    {
        // Tạo danh mục mới
        $post = Post::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Nếu có parent_id và parent_id không phải là 0, thì đặt danh mục này là con của danh mục đó
        if ($request->input('parent_id')) {
            $parentPost = Post::find($request->input('parent_id'));
                // Đặt danh mục mới làm con của danh mục cha
                $post->appendToNode($parentPost)->save();
        }

        // Redirect hoặc thông báo thành công
        return redirect()->route('post.create')->with('success', 'Danh mục đã được tạo thành công!');
    }




}
