<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@osrs.com')->first();

        Character::create([
            'user_id' => $user->id,
            'name' => 'Char1',
            'attack' => 99,
            'strength' => 99,
            'defence' => 99,
            'hitpoints' => 99,
            'prayer' => 99,
            'magic' => 99,
            'ranged' => 99,
        ]);

        Character::create([
            'user_id' => $user->id,
            'name' => 'Char2',
            'attack' => 99,
            'strength' => 99,
            'defence' => 45,
            'hitpoints' => 99,
            'prayer' => 52,
            'magic' => 99,
            'ranged' => 99,
        ]);

        Character::create([
            'user_id' => $user->id,
            'name' => 'Char3',
            'attack' => 75,
            'strength' => 99,
            'defence' => 1,
            'hitpoints' => 99,
            'prayer' => 52,
            'magic' => 99,
            'ranged' => 99,
        ]);
    }
}