<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@osrs.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Moderator',
            'email' => 'moderator@osrs.com',
            'password' => Hash::make('12345678'),
            'role' => 'moderator',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@osrs.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);
    }
}