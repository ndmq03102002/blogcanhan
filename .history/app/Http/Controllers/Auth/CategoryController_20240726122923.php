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
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id'
        ]);

        // Tạo danh mục mới
        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description'); // Thêm trường description nếu cần
        $category->save();

        // Nếu có parent_id và parent_id không phải là 0, thì đặt danh mục này là con của danh mục đó
        if ($request->input('parent_id') != 0) {
            $parentCategory = Category::find($request->input('parent_id'));
            if ($parentCategory) {
                $category->appendToNode($parentCategory)->save();
            }
        }

        // Redirect hoặc thông báo thành công
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được tạo thành công!');
    }
}
