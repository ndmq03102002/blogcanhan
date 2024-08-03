<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
   
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập và có vai trò chính xác chưa
        if (Auth::check() && $role == "admin") {
            return redirect->route('dashboard.index');
        }

        // Nếu người dùng không có quyền truy cập, chuyển hướng về trang home hoặc trang lỗi
        return redirect()->route('auth.login')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}
