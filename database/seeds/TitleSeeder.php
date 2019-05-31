<?php

use Illuminate\Database\Seeder;
use FI\Modules\Titles\Models\Title;

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
            ['name' => 'Customer service'],
            ['name' => 'Director'],
            ['name' => 'IT Professional'],
            ['name' => 'Manager'],
            ['name' => 'Marketing'],
            ['name' => 'Other'],
            ['name' => 'President'],
            ['name' => 'Sales'],
            ['name' => 'Secretary'],
            ['name' => 'Software Developer'],
            ['name' => 'Supervisor'],
            ['name' => 'Vice President'],
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
