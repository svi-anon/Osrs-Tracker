<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $characters = Character::where('user_id', $request->user()->id)
            ->with('bankItems.item')
            ->get();

        $selectedCharacter = null;

        if ($characters->isNotEmpty()) {
            $selectedCharacter = $characters->first();

            if ($request->filled('character')) {
                $selectedCharacter = $characters
                    ->firstWhere('id', (int) $request->character) ?? $characters->first();
            }
        }

        $allBank = [];

        foreach ($characters as $character) {
            foreach ($character->bankItems as $bankItem) {
                $item = $bankItem->item;

                if (!isset($allBank[$item->id])) {
                    $allBank[$item->id] = [
                        'name' => $item->name,
                        'quantity' => 0,
                        'price' => $item->price,
                        'total' => 0,
                    ];
                }

                $allBank[$item->id]['quantity'] += $bankItem->quantity;
                $allBank[$item->id]['total'] += $bankItem->quantity * $item->price;
            }
        }

        $allBank = collect($allBank)->sortByDesc('total');

        $bankValue = $allBank->sum('total');

        $valuableItems = Item::where('valuable', true)
            ->orderByDesc('price')
            ->get();

        $popularItems = Item::where('popular', true)
            ->orderBy('name')
            ->get();

        return view('dashboard', compact(
            'characters',
            'selectedCharacter',
            'allBank',
            'bankValue',
            'valuableItems',
            'popularItems'
        ));
    }
}