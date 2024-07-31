<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $config['seo'] = config('apps.cats');
        $config['method'] = 'create';
        $template = 'category.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $user = Category::find($id);
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect hoặc thông báo thành công
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được tạo thành công!');
    }
}
