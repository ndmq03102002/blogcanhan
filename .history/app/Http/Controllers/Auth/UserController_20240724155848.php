<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface as UserService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
class UserController extends Controller
{
    protected  $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(){
        $users = $this->userService->paginate();
        $config = $this->config();
        $config['seo'] = config('apps.user');
        $template = "user.user.index";
        return view("dashboard.layout",compact("template","config","users"));
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
        return redirect()->route('user.create')->with('suscess', 'Đăng ký thành công!');
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

    public function update($id, UpdateUserRequest $request){
        if($this->userService->update($id, $request)){
            return redirect()->route('user.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('user.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
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
