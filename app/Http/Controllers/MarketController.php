<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\GrandExchangeService;

class MarketController extends Controller
{
    public function index()
    {
        $valuableItems = Item::where('valuable', true)
            ->orderByDesc('price')
            ->get();

        $popularItems = Item::where('popular', true)
            ->orderBy('name')
            ->get();

        return view('market.index', compact('valuableItems', 'popularItems'));
    }

    public function updatePrices(GrandExchangeService $grandExchange)
    {
        $updated = $grandExchange->updatePrices();

        if ($updated === 0) {
            return redirect()->route('market.index')
                ->with('error', 'Nao foi possivel atualizar os precos.');
        }

        return redirect()->route('market.index')
            ->with('success', $updated . ' itens atualizados.');
    }
}