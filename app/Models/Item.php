<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'category', 'price', 'image', 'popular', 'valuable'])]
class Item extends Model
{
    public function bankItems(): HasMany
    {
        return $this->hasMany(BankItem::class);
    }
}