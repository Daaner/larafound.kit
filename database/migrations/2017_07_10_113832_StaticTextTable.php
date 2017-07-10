<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaticTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Multi Pivot
      Schema::create('statictexts', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->comment('Название в админке');
          $table->string('alias');
          $table->boolean('published')->index('published')->default(true);
          $table->integer('ru')->nullable()->unsigned();
          $table->integer('en')->nullable()->unsigned();
          // add next lng

          $table->timestamps();
          $table->softDeletes();
      });

        // lng database
      Schema::create('static_en', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title', 75);
          $table->boolean('published')->index('published')->default(true);
          $table->string('keywords', 250)->nullable();
          $table->string('description', 200)->nullable();
          $table->text('preview_text')->nullable();
          $table->longText('full_text')->nullable();
          $table->string('picture')->nullable();
          $table->string('video')->nullable();

          $table->timestamps();
          $table->softDeletes();
      });

      Schema::create('static_ru', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title', 75);
          $table->boolean('published')->index('published')->default(true);
          $table->string('keywords', 250)->nullable();
          $table->string('description', 200)->nullable();
          $table->text('preview_text')->nullable();
          $table->longText('full_text')->nullable();
          $table->string('picture')->nullable();
          $table->string('video')->nullable();

          $table->timestamps();
          $table->softDeletes();
      });

      // add next lng

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statictexts');
        Schema::dropIfExists('static_ru');
        Schema::dropIfExists('static_en');
        // add next
    }
}
