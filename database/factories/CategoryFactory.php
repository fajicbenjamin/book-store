<?php
/**
 * Created by PhpStorm.
 * User: benjaminfajic
 * Date: 19/11/2018
 * Time: 19:01
 */

use Faker\Generator as Faker;

$factory->define(App\Category::class, function(Faker $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->text
    ];
});