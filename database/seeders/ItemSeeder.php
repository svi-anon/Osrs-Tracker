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
            ['name' => 'Dragon scimitar', 'category' => 'Weapon', 'price' => 60000, 'image' => 'images/items/dragon-scimitar.png', 'popular' => true],
            ['name' => 'Abyssal whip', 'category' => 'Weapon', 'price' => 791000, 'image' => 'images/items/abyssal-whip.png', 'popular' => true],
            ['name' => 'Shark', 'category' => 'Food', 'price' => 758, 'image' => 'images/items/shark.png', 'popular' => true],
            ['name' => "Osmumten's fang", 'category' => 'Weapon', 'price' => 13000000, 'image' => 'images/items/osmumtens-fang.png'],
            ['name' => 'Scythe of vitur', 'category' => 'Weapon', 'price' => 1200000000, 'image' => 'images/items/scythe-of-vitur.png', 'valuable' => true],
            ['name' => 'Twisted bow', 'category' => 'Weapon', 'price' => 1700000000, 'image' => 'images/items/twisted-bow.png', 'valuable' => true],
            ['name' => "Tumeken's shadow", 'category' => 'Weapon', 'price' => 1100000000, 'image' => 'images/items/tumekens-shadow.png', 'valuable' => true],
            ['name' => 'Torva full helm', 'category' => 'Armour', 'price' => 260000000, 'image' => 'images/items/torva-full-helm.png', 'valuable' => true],
            ['name' => 'Torva platebody', 'category' => 'Armour', 'price' => 400000000, 'image' => 'images/items/torva-platebody.png', 'valuable' => true],
            ['name' => 'Torva platelegs', 'category' => 'Armour', 'price' => 350000000, 'image' => 'images/items/torva-platelegs.png', 'valuable' => true],
            ['name' => '3rd age pickaxe', 'category' => 'Tool', 'price' => 2100000000, 'image' => 'images/items/3rd-age-pickaxe.png', 'valuable' => true],
            ['name' => '3rd age axe', 'category' => 'Tool', 'price' => 1500000000, 'image' => 'images/items/3rd-age-axe.png', 'valuable' => true],
            ['name' => 'Mystic robe top', 'category' => 'Armour', 'price' => 70000, 'image' => 'images/items/mystic-robe-top.png', 'popular' => true],
            ['name' => 'Mystic robe bottom', 'category' => 'Armour', 'price' => 50000, 'image' => 'images/items/mystic-robe-bottom.png', 'popular' => true],
            ['name' => 'Helm of neitiznot', 'category' => 'Armour', 'price' => 50000, 'image' => 'images/items/helm-of-neitiznot.png', 'popular' => true],
            ['name' => 'Dragon pickaxe', 'category' => 'Tool', 'price' => 900000, 'image' => 'images/items/dragon-pickaxe.png', 'popular' => true],
            ['name' => 'Dragon axe', 'category' => 'Tool', 'price' => 60000, 'image' => 'images/items/dragon-axe.png', 'popular' => true],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}