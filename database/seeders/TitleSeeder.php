<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BT\Modules\Titles\Models\Title;
use Eloquent;

class TitleSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        $titles = [
            ['name' => ''],
            ['name' => 'Accountant'],
            ['name' => 'Administrative Assistant'],
            ['name' => 'Administrator'],
            ['name' => 'CEO'],
            ['name' => 'Consultant'],
            ['name' => 'Customer Service'],
            ['name' => 'Director'],
            ['name' => 'Driver'],
            ['name' => 'IT Professional'],
            ['name' => 'Manager'],
            ['name' => 'Marketing'],
            ['name' => 'Other'],
            ['name' => 'Owner'],
            ['name' => 'President'],
            ['name' => 'Sales'],
            ['name' => 'Secretary'],
            ['name' => 'Software Developer'],
            ['name' => 'Supervisor'],
            ['name' => 'Technician'],
            ['name' => 'Vice President'],
            ['name' => 'Worker'],
        ];

        foreach ($titles as $title) {
            $record = Title::whereName($title['name'])->first();
            if (! $record) {
                Title::create($title);
            }
        }

        Eloquent::reguard();
    }
}
