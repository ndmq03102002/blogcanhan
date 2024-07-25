<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface as UserService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
class UserController extends Controller
{
    protected  $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        // Lấy các tham số từ request
        $keyword = $request->input('keyword');
        $userCatalogueId = $request->input('user_catalogue_id');
        $perPage = 5;

        // Gọi phương thức filter từ service
        $users = $this->userService->filter($keyword, $userCatalogueId, $perPage);

        $config = $this->config();
        $config['seo'] = config('apps.user');
        $template = "user.user.index";

        return view("dashboard.layout", compact("template", "config", "users", "keyword", "userCatalogueId", "perPage"));
    }


    public function create(){
        $config = $this->config();
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';
        $template = 'user.user.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    public function store(RegisterRequest $request){
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Set role to 'customer'
        ]);
        return redirect()->route('user.create')->with('success', 'Đăng ký thành công!');
    }

    public function edit($id){
        $user = User::find($id);
        $config = $this->config();
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $template = 'user.user.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'user',
        ));
    }

    public function update($id,UpdateUserRequest $request, User $user){
        $user = User::find($id);
        // Lấy tất cả dữ liệu từ request, ngoại trừ password
        $data = $request->except('password');
        $user->fill($data);
        $user->save();
        return redirect()->route('user.index')->with('success','Bạn đã cập nhật thành công');
    }

    public function delete($id){
        $user = User::find($id);
        $config['seo'] = config('apps.user');
        $template = 'user.user.delete';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
            'user',
        ));
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success','Bạn đã xóa thành công');
    }
    private function config(){
        return [
            'js' => [
                'template/js/plugins/switchery/switchery.js',
            ],
            'css' => [
                    'template/css/plugins/switchery/switchery.css'
                ]
        ];
    }
}
