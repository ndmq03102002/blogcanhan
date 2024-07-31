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
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id['id'],
            'image' => $request->image,
            'user_id' => Auth::user()->id,

        ]);

        // Redirect to login with success message
        return redirect()->route('post.create')->with('success', '.');
    }


}
