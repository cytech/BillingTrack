<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BT\Modules\Sizes\Models\Size;
use Eloquent;

class SizeSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        $sizes = [
            ['name' => ''],
            ['name' => '1 - 3'],
            ['name' => '4 - 10'],
            ['name' => '11 - 50'],
            ['name' => '51 - 100'],
            ['name' => '101 - 500'],
            ['name' => '500+'],
        ];

        foreach ($sizes as $size) {
            $record = Size::whereName($size['name'])->first();
            if (! $record) {
                Size::create($size);
            }
        }

        Eloquent::reguard();
    }
}
