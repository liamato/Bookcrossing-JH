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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('pass'),
        'super' => rand(0, 1),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Report::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->text(),
        'author' => $faker->name,
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->text(),
        'author' => $faker->name,
        'checked' => rand(0, 1),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2),
        'slug' => $faker->lexify('????????????????????????'),
    ];
});

$factory->define(App\Video::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->randomElement(['lxB3qXMX9IA', 'ZOk-L0LTKRw', 'WEwvFABA8rA', 'KYlQuwGGxJ0']),
        'trailer' => rand(0, 1),
        'author' => rand(0, 1) ? $faker->name : '',
    ];
});

$factory->define(App\School::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->word,
    ];
});

$factory->define(App\Book::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'author' => $faker->name,
        'catched' => rand(0, 1),
        'checked' => rand(0, 1),
    ];
});
