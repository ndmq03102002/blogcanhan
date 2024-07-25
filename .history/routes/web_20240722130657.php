<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('auth.index');
});

Route::('/', function () {
    return view('auth.index');
});

// Route::post('/register', [RegisterController::class, 'register']);
// Route::post('/viewlogin', [LoginController::class, 'login']);
// Route::post('/login', [LoginController::class, 'login']);

