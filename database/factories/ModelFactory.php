<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Article::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->text(100),
        'summary' => $faker->text(255),
        'content' => $faker->text(1000),
        'user_id' => rand(1, 103),
        'author_id' => rand(1, 103),
        'category_id' => rand(1, 2),
        'active' => (boolean)rand(0,1)
    ];
});
