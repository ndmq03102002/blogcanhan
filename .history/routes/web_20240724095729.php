<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Blog\HomeController;

Route::get('/', function () {
    return view('auth.index');
});

Route::get('/viewlogin', [LoginController::class, 'viewlogin'])->name('auth.login');
Route::get('/viewregister', [RegisterController::class, 'viewregister'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])-> name('auth.logout');

Route::group(['middleware' => ['authenticate']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/user/index', [UserController::class, 'index'])->name('auth.user');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('blog.home');


});


