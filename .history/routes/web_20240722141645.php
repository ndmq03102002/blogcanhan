<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DashboardController;

Route::get('/', function () {
    return view('auth.index');
});

Route::get('/viewlogin', [LoginController::class, 'viewlogin'])->name('auth.login');

Route::get('/viewregister', [RegisterController::class, 'viewregister'])->name('auth.register');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// Route::get('/customer/home', [DashboardController::class, 'index'])->name('customer.home');
