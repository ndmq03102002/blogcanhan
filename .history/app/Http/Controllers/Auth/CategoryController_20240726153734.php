<?php

namespace App\Http\Controllers\Auth;
use App\Services\Interfaces\CatServiceInterface as CatService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CatRequest;
use App\Models\Category;
class CategoryController extends Controller
{
    protected  $catService;
    public function __construct(CatService $catService)
    {
        $this->CatService = $catService;
    }
    public function index()
    {
        // Lấy danh sách danh mục với phân trang
        $categories = Category::with('children')->defaultOrder()->paginate(10);

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
        $userCatalogueId = $request->input('user_catalogue_id');
        $perPage = $request->input('perpage');

        // Gọi phương thức filter từ service
        $users = $this->CatService->filter($keyword, $userCatalogueId, $perPage);

        $config = $this->config();
        $config['seo'] = config('apps.user');
        $template = "user.index";  

        return view("dashboard.layout", compact("template", "config", "users", "keyword", "userCatalogueId", "perPage"));
    }
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
