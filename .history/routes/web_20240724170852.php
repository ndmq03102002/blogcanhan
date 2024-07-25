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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/index', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->where(['id' => '[0-9]+'])->name('user.edit');
        Route::put('{id}/update', [UserController::class, 'update'])->where(['id' => '[0-9]+'])->name('user.update');
        Route::get('/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('blog.home');


});


