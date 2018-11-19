<?php
/**
 * Created by PhpStorm.
 * User: benjaminfajic
 * Date: 19/11/2018
 * Time: 19:00
 */

use Faker\Generator as Faker;

$factory->define(App\Book::class, function(Faker $faker) {
    return [
        'author' => $faker->name,
        'title' => $faker->title,
        'isbn' => $faker->isbn13,
        'publisher' => $faker->name,
        'available' => $faker->boolean,
        'code' => $faker->numberBetween(1000000, 9999999),
        'pages' => $faker->numberBetween(50, 400),
        'price' => $faker->numberBetween(5, 200),
        'language' => $faker->languageCode,
        'edition' => $faker->title,
        'description' => $faker->text,
        'user_id' => App\User::inRandomOrder()->first()->id,
    ];
});