<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('news_articles_ru', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title', 75);
          $table->string('alias')->unique();
          $table->integer('category')->unsigned()->default(0);
          $table->string('image')->nullable();

          $table->string('keywords', 250)->nullable();
          $table->string('description', 200)->nullable();
          $table->string('tags')->nullable();

          $table->text('preview_text')->nullable();
          $table->longText('full_text')->nullable();
          $table->string('video')->nullable();
          $table->text('images')->nullable();
          $table->text('gallery')->nullable();
          $table->string('links')->nullable();

          $table->boolean('published')->index('published')->default(true);
          $table->timestamp('publish_up')->nullable();
          $table->timestamp('publish_down')->nullable();
          $table->integer('user_id')->unsigned()->nullable();
          $table->timestamps();
          $table->softDeletes();
      });

      Schema::create('news_articles_en', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title', 75);
          $table->string('alias')->unique();
          $table->integer('category')->unsigned()->default(0);
          $table->string('image')->nullable();

          $table->string('keywords', 250)->nullable();
          $table->string('description', 200)->nullable();
          $table->string('tags')->nullable();

          $table->text('preview_text')->nullable();
          $table->longText('full_text')->nullable();
          $table->string('video')->nullable();
          $table->text('images')->nullable();
          $table->text('gallery')->nullable();
          $table->string('links')->nullable();

          $table->boolean('published')->index('published')->default(true);
          $table->timestamp('publish_up')->nullable();
          $table->timestamp('publish_down')->nullable();
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
        Schema::dropIfExists('news_articles_ru');
        Schema::dropIfExists('news_articles_en');
    }
}
