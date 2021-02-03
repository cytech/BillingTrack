<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace database\factories;

use Faker\Factory as Faker;
use BT\Http\Controllers\Controller;
use BT\Modules\Clients\Models\Client;
use BT\Modules\Clients\Models\Contact;
use BT\Modules\Employees\Models\Employee;
use BT\Modules\Products\Models\Product;

/*
 * or run in tinker
 *  factory(\BT\Modules\Clients\Models\Client::class, 25)->create();
 * factory(\BT\Modules\Products\Models\Product::class, 20)->create();
 *  factory(\BT\Modules\Employees\Models\Employee::class, 10)->create();
 *
 * */


class TestController extends Controller
{
    public function test()
    {
        //clientfactory change between company and name, run twice
//        $client = factory(Client::class, 25)->create();
//        $employee = factory(Employee::class, 10)->create();
//        $product = factory(Product::class, 20)->create();

//        $companies = \BT\Modules\Clients\Models\Client::where('is_company', 1)->get();
//
//        foreach ($companies as $company){
//            $contact = factory(Contact::class,1 )->create(['client_id' => $company->id]);
//
//        }


        $faker = Faker::create();

        $companies = \BT\Modules\Clients\Models\Client::where('is_company', 1)->get();

        foreach ($companies as $company){
            $company->address_2 = $faker->streetAddress;
            $company->city_2 = $faker->city;
            $company->state_2 = $faker->stateAbbr;
            $company->zip_2 = $faker->postcode;
            $company->save();
        }
    }

}
