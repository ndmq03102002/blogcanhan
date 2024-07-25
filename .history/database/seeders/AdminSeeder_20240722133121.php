<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App

class AdminSeeder extends Seeder
{
    // Tạo tài khoản admin mới
    User::create([
        'username' => 'admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('yourpassword'), // Thay 'yourpassword' bằng mật khẩu bạn muốn
        'role' => 'admin',
    ]);
            
}
