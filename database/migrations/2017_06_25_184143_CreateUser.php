<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('users', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name');
             $table->string('username')->unique();
             $table->string('email')->unique();
             $table->string('password');
             $table->integer('role_id')->default(1)->unsigned()->nullable();
             $table->ipAddress('signup_ip')->nullable();
             $table->ipAddress('confirm_ip')->nullable();
             $table->string('token')->nullable();
             $table->boolean('active')->index('active')->default(false);
             $table->rememberToken();
             $table->timestamps();
             $table->softDeletes();
         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
         Schema::dropIfExists('users');
     }
}
