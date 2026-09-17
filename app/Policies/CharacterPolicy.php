<?php

namespace App\Policies;

use App\Models\Character;
use App\Models\User;

class CharacterPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Character $character): bool
    {
        if ($user->role === 'admin' || $user->role === 'moderator') {
            return true;
        }

        return $character->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Character $character): bool
    {
        if ($user->role === 'admin' || $user->role === 'moderator') {
            return true;
        }

        return $character->user_id === $user->id;
    }

    public function delete(User $user, Character $character): bool
    {
        return $user->role === 'admin';
    }
}