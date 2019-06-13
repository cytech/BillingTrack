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

$factory->define(\BT\Modules\Clients\Models\Contact::class, function (Faker $faker, $company_id) {

    $firstname = $faker->firstName;
    $lastname = $faker->lastName;

    return [
        'client_id' => $company_id,
        'first_name' => $firstname,
        'last_name' => $lastname,
        'name' => $firstname . ' ' . $lastname,
        'phone' => $faker->numerify('(###) ###-####'),
        'fax' => $faker->numerify('(###) ###-####'),
        'mobile' => $faker->numerify('(###) ###-####'),
        'email' => $faker->unique()->safeEmail,
        'title_id' => $faker->numberBetween(2,17),
        'is_primary' => 1,
        'optin' => 1,
        'default_to' => 1

    ];
});
