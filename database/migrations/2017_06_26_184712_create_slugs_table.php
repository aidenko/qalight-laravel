<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlugsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('slugs', function(Blueprint $table) {
            $table->increments('id');
            $table->text('slug');
            $table->integer('sluggable_id')->unsigned()->index();
            $table->string('sluggable_type')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('slugs');
    }
}
