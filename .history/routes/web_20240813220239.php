<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\CategoryController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\CKEditorController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Blog\HomeController;
use App\Http\Controllers\Blog\CustomerController;
use App\Http\Controllers\Blog\RatingController;


Route::group(['middleware' => ['checklogin']], function () {  
Route::get('/viewlogin', [LoginController::class, 'viewlogin'])->name('auth.login');
Route::get('/viewregister', [RegisterController::class, 'viewregister'])->name('auth.register');
Route::get('/', [CustomerController::class, 'index'])->name('customer.home');
Route::get('{id}/show', [CustomerController::class, 'show'])->name('customer.show');
Route::get('/search', [CustomerController::class, 'search'])->name('customer.search');
});

// Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])-> name('auth.logout');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

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
        Route::get('/index', [PostController::class, 'index'])->name('post.index');
        Route::get('/search', [PostController::class, 'search'])->name('post.search');
        Route::get('/create', [PostController::class,'create'])->name('post.create');
        Route::post('/store', [PostController::class,'store'])->name('post.store');
        Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

        Route::get('/{id}/edit', [PostController::class, 'edit'])->where(['id' => '[0-9]+'])->name('post.edit');
        Route::post('{id}/update', [PostController::class, 'update'])->name('post.update');
        Route::get('{id}/delete', [PostController::class, 'delete'])->where(['id' => '[0-9]+'])->name('post.delete');
        Route::delete('{id}/destroy', [PostController::class, 'destroy'])->where(['id' => '[0-9]+'])->name('post.destroy');
    });

    });
    Route::group(['prefix'=> 'blog'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('blog.home');
    Route::get('{id}/show', [HomeController::class, 'show'])->name('blog.show');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::get('/search', [HomeController::class, 'search'])->name('blog.search');
    });
    Route::get('viewprofile', [ProfileController::class, 'edit'])->name('profile.view');
    
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.change-password');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.update-password');
});



