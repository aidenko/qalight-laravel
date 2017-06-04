<?php

use Illuminate\Database\Seeder;

class ArticlesTablSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('articles')->insert([
            'title' => str_random(100),
            'slug' => str_random(100),
            'summary' => str_random(100),
            'content' => str_random(100),
            'active' => true
        ]);
    }
}
