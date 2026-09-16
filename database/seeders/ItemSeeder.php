<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Coins', 'category' => 'Currency', 'price' => 1],
            ['name' => 'Dragon scimitar', 'category' => 'Weapon', 'price' => 60000, 'popular' => true],
            ['name' => 'Abyssal whip', 'category' => 'Weapon', 'price' => 791000, 'popular' => true],
            ['name' => 'Shark', 'category' => 'Food', 'price' => 758, 'popular' => true],
            ['name' => "Osmumten's fang", 'category' => 'Weapon', 'price' => 13000000],
            ['name' => 'Scythe of vitur', 'category' => 'Weapon', 'price' => 1200000000, 'valuable' => true],
            ['name' => 'Twisted bow', 'category' => 'Weapon', 'price' => 1700000000, 'valuable' => true],
            ['name' => "Tumeken's shadow", 'category' => 'Weapon', 'price' => 1100000000, 'valuable' => true],
            ['name' => 'Torva full helm', 'category' => 'Armour', 'price' => 260000000, 'valuable' => true],
            ['name' => 'Torva platebody', 'category' => 'Armour', 'price' => 400000000, 'valuable' => true],
            ['name' => 'Torva platelegs', 'category' => 'Armour', 'price' => 350000000, 'valuable' => true],
            ['name' => '3rd age pickaxe', 'category' => 'Tool', 'price' => 2100000000, 'valuable' => true],
            ['name' => '3rd age axe', 'category' => 'Tool', 'price' => 1500000000, 'valuable' => true],
            ['name' => 'Mystic robe top', 'category' => 'Armour', 'price' => 70000, 'popular' => true],
            ['name' => 'Mystic robe bottom', 'category' => 'Armour', 'price' => 50000, 'popular' => true],
            ['name' => 'Helm of neitiznot', 'category' => 'Armour', 'price' => 50000, 'popular' => true],
            ['name' => 'Dragon pickaxe', 'category' => 'Tool', 'price' => 900000, 'popular' => true],
            ['name' => 'Dragon axe', 'category' => 'Tool', 'price' => 60000, 'popular' => true],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}