<?php

namespace App\Http\Controllers\Auth;
use App\Services\Interfaces\CatServiceInterface as CatService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CatRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
class CategoryController extends Controller
{
    protected  $catService;
    public function __construct(CatService $catService)
    {
        $this->catService = $catService;
    }
    public function index()
    {
        // Lấy danh sách danh mục với phân trang
        $categories = Category::with('children')->defaultOrder( )->paginate(5);

        $config['seo'] = config('apps.cats');
        $config['method'] = 'index';
        $template = 'category.index'; // Tên view cho danh sách danh mục

        return view('dashboard.layout', compact(
            'template',
            'config',
            'categories'
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
        $cats = Category::all();
        $category = $cats;
        $config['seo'] = config('apps.cats');
        $config['method'] = 'create';
        $template = 'category.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'cats'
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


    public function edit($id){
        $category = Category::find($id);
        $cats = Category::all();
        $config['seo'] = config('apps.cats');
        $config['method'] = 'edit';
        $template = 'category.store';
        return view('dashboard.layout', compact(
            'template',
            'category',
            'config',
            "cats"
        ));
    }

    public function update($id,UpdateCategoryRequest $request, Category $cat){
        $cat = Category::find($id);
        // Lấy tất cả dữ liệu từ request, ngoại trừ password
        $data = $request->all();
        // if ($request->parent_id == $id || Category::where('parent_id', $id)->pluck('id')->contains($request->parent_id)) {
        //     return redirect()->back()->withErrors(['parent_id' => 'Danh mục cha không thể là danh mục hiện tại hoặc danh mục con của nó.']);
        // }    
        $cat->fill($data);
        $cat->save();
        return redirect()->route('cat.index')->with('success','Bạn đã cập nhật thành công');
    }
}
