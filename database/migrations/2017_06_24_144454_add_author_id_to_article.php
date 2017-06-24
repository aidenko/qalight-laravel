<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthorIdToArticle extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('articles', function(Blueprint $table) {
            $table->integer('author_id')->unsigned()->nullable()->index();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('articles', function(Blueprint $table) {
            $table->dropForeign('author_id');
            $table->dropIndex('author_id');
            $table->dropColumn('author_id');
        });
    }
}
