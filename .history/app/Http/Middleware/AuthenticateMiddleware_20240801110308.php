<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::id() == null ){
            return redirect()->route('auth.login')-> with('error','Bạn cần đăng nhập để truy cập trang này');
        } 
        if(Auth::){
            return redirect()->route('blog.home')-> with('error','Bạn không có quyền truy cập vào trang này');
        }
        return $next($request);
    }
}
