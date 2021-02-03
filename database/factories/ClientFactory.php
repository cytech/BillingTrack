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

$factory->define(\BT\Modules\Clients\Models\Client::class, function (Faker $faker) {
    return [
        //for company
//        'name' => $faker->company,
//        'is_company' => 1,
//        'address' => $faker->streetAddress,
//        'city' => $faker->city,
//        'state' => $faker->stateAbbr,
//        'zip' => $faker->postcode,
//        'address_2' => $faker->streetAddress,
//        'city_2' => $faker->city,
//        'state_2' => $faker->stateAbbr,
//        'zip_2' => $faker->postcode,
//        'industry_id' => $faker->numberBetween(2,34),
//        'size_id' => $faker->numberBetween(2,7),
//        'phone' => $faker->numerify('(###) ###-####'),
//        'fax' => $faker->numerify('(###) ###-####'),
//        'mobile' => $faker->numerify('(###) ###-####'),
//        'email' => $faker->unique()->safeEmail,
        //for individual
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'is_company' => 0,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip' => $faker->postcode,
        'industry_id' => $faker->numberBetween(2,34),
        'size_id' => $faker->numberBetween(2,7),
        'phone' => $faker->numerify('(###) ###-####'),
        'fax' => $faker->numerify('(###) ###-####'),
        'mobile' => $faker->numerify('(###) ###-####'),
        'email' => $faker->unique()->safeEmail,

    ];
});
