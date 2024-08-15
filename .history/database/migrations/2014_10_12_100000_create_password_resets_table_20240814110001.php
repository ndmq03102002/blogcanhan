<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp();
        });
    }
    database/migrations/2014_10_12_000000_create_users_table.php
    
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
};
