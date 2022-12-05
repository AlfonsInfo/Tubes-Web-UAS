<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    
    //php artisan migrate
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->String('npm')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->nullable()->default(false);
            $table->boolean('role')->default(true);
            $table->integer('jumlah_sks');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    

    //php artisan migrate:rollback
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
