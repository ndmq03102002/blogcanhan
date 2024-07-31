<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\CategoryController;
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
    Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/index', [UserController::class, 'index'])->name('user.index');
        Route::get('/search', [UserController::class, 'search'])->name('user.search');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->where(['id' => '[0-9]+'])->name('user.edit');
        Route::post('{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::get('{id}/delete', [UserController::class, 'delete'])->where(['id' => '[0-9]+'])->name('user.delete');
        Route::delete('{id}/destroy', [UserController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('user.destroy');
        Route::post('/user/{id}/update-publish-status', [UserController::class, 'updatePublishStatus'])->name('user.updatePublishStatus');
    });

    Route::group(['prefix'=> 'category'], function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('cat.index');
        Route::get('/search', [CategoryController::class, 'search'])->name('cat.search');
        Route::get('/create', [CategoryController::class,'create'])->name('cat.create');
        Route::post('/store', [CategoryController::class,'store'])->name('cat.store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->where(['id' => '[0-9]+'])->name('cat.edit');
        Route::post('{id}/update', [CategoryController::class, 'update'])->name('cat.update');
        Route::get('{id}/delete', [CategoryController::class, 'delete'])->where(['id' => '[0-9]+'])->name('cat.delete');
        Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('cat.destroy');
    });

    Route::group(['prefix'=> 'post'], function () {
    //     Route::get('/categories', [PostController::class, 'index'])->name('cat.index');
    //     Route::get('/search', [PostController::class, 'search'])->name('cat.search');
        Route::get('/create', [PostController::class,'create'])->name('post.create');
        Route::post('/store', [PostController::class,'store'])->name('cat.store');
    //     Route::get('/{id}/edit', [PostController::class, 'edit'])->where(['id' => '[0-9]+'])->name('cat.edit');
    //     Route::post('{id}/update', [PostController::class, 'update'])->name('cat.update');
    //     Route::get('{id}/delete', [PostController::class, 'delete'])->where(['id' => '[0-9]+'])->name('cat.delete');
    //     Route::delete('{id}/destroy', [PostController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('cat.destroy');
    });

    });

    Route::get('/home', [HomeController::class, 'index'])->name('blog.home');


});


