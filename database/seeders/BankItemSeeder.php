<?php

namespace Database\Seeders;

use App\Models\BankItem;
use App\Models\Character;
use App\Models\Item;
use Illuminate\Database\Seeder;

class BankItemSeeder extends Seeder
{
    public function run(): void
    {
        $char1 = Character::where('name', 'Char1')->first();
        $char2 = Character::where('name', 'Char2')->first();
        $char3 = Character::where('name', 'Char3')->first();

        $this->addItem($char1, 'Coins', 12500000);
        $this->addItem($char1, 'Scythe of vitur', 1);
        $this->addItem($char1, 'Twisted bow', 1);
        $this->addItem($char1, "Tumeken's shadow", 1);
        $this->addItem($char1, 'Torva full helm', 1);
        $this->addItem($char1, 'Torva platebody', 1);
        $this->addItem($char1, 'Torva platelegs', 1);
        $this->addItem($char1, "Osmumten's fang", 1);
        $this->addItem($char1, 'Shark', 500);

        $this->addItem($char2, 'Coins', 5000000);
        $this->addItem($char2, 'Abyssal whip', 1);
        $this->addItem($char2, 'Dragon scimitar', 1);
        $this->addItem($char2, 'Helm of neitiznot', 1);
        $this->addItem($char2, 'Dragon pickaxe', 1);
        $this->addItem($char2, 'Dragon axe', 1);

        $this->addItem($char3, 'Coins', 2500000);
        $this->addItem($char3, 'Dragon scimitar', 1);
        $this->addItem($char3, 'Mystic robe top', 1);
        $this->addItem($char3, 'Mystic robe bottom', 1);
        $this->addItem($char3, 'Shark', 300);
    }

    private function addItem(Character $character, string $itemName, int $quantity): void
    {
        $item = Item::where('name', $itemName)->first();

        BankItem::create([
            'character_id' => $character->id,
            'item_id' => $item->id,
            'quantity' => $quantity,
        ]);
    }
}