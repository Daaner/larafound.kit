<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('news_categories_ru', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('image')->nullable();
          $table->string('alias')->unique();
          $table->boolean('published')->index('published')->default(true);
          $table->integer('parent')->unsigned()->default(0);
          $table->integer('order')->unsigned()->default(0);
          $table->integer('user_id')->unsigned()->nullable();
          $table->timestamps();
          $table->softDeletes();
      });

      Schema::create('news_categories_en', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('image')->nullable();
          $table->string('alias')->unique();
          $table->boolean('published')->index('published')->default(true);
          $table->integer('parent')->unsigned()->default(0);
          $table->integer('order')->unsigned()->default(0);
          $table->integer('user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('news_categories_ru');
        Schema::dropIfExists('news_categories_en');
    }
}
