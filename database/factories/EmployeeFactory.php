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

$factory->define(\BT\Modules\Employees\Models\Employee::class, function (Faker $faker) {
    return [
        'number' => $faker->unique()->randomNumber(3),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'full_name' => null,
        'short_name' => null,
        'title' => 'Worker',
        'billing_rate' => '20.00',
        'schedule' => '1',
        'active' => '1',
        'driver' => $faker->numberBetween(0,1),

    ];
});
