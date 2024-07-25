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
        $template = 'user.user.create';
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
        return redirect()->route('auth.login')->with('suscess', 'Đăng ký thành công! Bạn có thể đăng nhập ngay.');
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
