<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\FI\Modules\Products\Models\Product::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word),
        'description' => $faker->sentence,
        'serialnum' => $faker->randomNumber(9),
        'active' => 1,
        'cost' => $faker->randomFloat(2, 19, 150),
        'category' => 'Product',
        'type' => 'Product Type',
        'numstock' => $faker->numberBetween(1,10),
    ];
});
