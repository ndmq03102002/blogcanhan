<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Re;
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

    public function store(CatRequest $request)
    {
        // Tạo danh mục mới
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Nếu có parent_id và parent_id không phải là 0, thì đặt danh mục này là con của danh mục đó
        if ($request->input('parent_id')) {
            $parentCategory = Category::find($request->input('parent_id'));
                // Đặt danh mục mới làm con của danh mục cha
                $category->appendToNode($parentCategory)->save();
        }

        // Redirect hoặc thông báo thành công
        return redirect()->route('cat.create')->with('success', 'Danh mục đã được tạo thành công!');
    }
}
