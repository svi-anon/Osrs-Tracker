<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id',
    'name',
    'attack',
    'strength',
    'defence',
    'hitpoints',
    'prayer',
    'magic',
    'ranged'
])]
class Character extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bankItems(): HasMany
    {
        return $this->hasMany(BankItem::class);
    }

    public function combatLevel(): int
    {
        $base = 0.25 * ($this->defence + $this->hitpoints + floor($this->prayer / 2));

        $melee = 0.325 * ($this->attack + $this->strength);
        $ranged = 0.325 * floor($this->ranged * 1.5);
        $magic = 0.325 * floor($this->magic * 1.5);

        return (int) floor($base + max($melee, $ranged, $magic));
    }
}