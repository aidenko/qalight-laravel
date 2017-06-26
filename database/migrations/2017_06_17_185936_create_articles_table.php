<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('articles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('summary')->nullable();
            $table->text('content');
            $table->boolean('active')->default(false);
            $table->integer('category_id')->unsigned()->nullable()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('author_id')->unsigned()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('articles');
    }
}
