<?php

namespace Database\Seeders;

use BT\Modules\Products\Models\InventoryType;
use Illuminate\Database\Seeder;
use Eloquent;

class InventoryTypesSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        $inventorytypes = [
            ['name' => '', 'tracked' => 0],
            ['name' => 'Rental', 'tracked' => 1],
            ['name' => 'Resale', 'tracked' => 1],
            ['name' => 'Labor', 'tracked' => 0],
            ['name' => 'Asset', 'tracked' => 0],
            ['name' => 'Non-Inventory', 'tracked' => 0],
            ['name' => 'Other', 'tracked' => 0],
            ['name' => 'Raw Materials', 'tracked' => 1],
            ['name' => 'W.I.P.', 'tracked' => 1],
            ['name' => 'Finished Goods', 'tracked' => 1],
        ];

        foreach ($inventorytypes as $inventorytype) {
            $record = InventoryType::whereName($inventorytype['name'])->first();
            if (! $record) {
                InventoryType::create($inventorytype);
            }
        }

        Eloquent::reguard();
    }
}
