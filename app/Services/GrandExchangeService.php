<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Http;

class GrandExchangeService
{
    private string $baseUrl = 'https://prices.runescape.wiki/api/v1/osrs';

    public function updatePrices(): int
    {
        $mappingResponse = Http::withHeaders([
            'User-Agent' => 'OSRS Bank Tracker - github.com/svi-anon/Osrs-Tracker',
        ])->get($this->baseUrl . '/mapping');

        $pricesResponse = Http::withHeaders([
            'User-Agent' => 'OSRS Bank Tracker - github.com/svi-anon/Osrs-Tracker',
        ])->get($this->baseUrl . '/latest');

        if ($mappingResponse->failed() || $pricesResponse->failed()) {
            return 0;
        }

        $mapping = $mappingResponse->json();
        $prices = $pricesResponse->json('data');

        $updated = 0;

        foreach (Item::all() as $item) {
            if ($item->name === 'Coins') {
                continue;
            }

            $mappedItem = collect($mapping)->firstWhere('name', $item->name);

            if (!$mappedItem) {
                continue;
            }

            $priceData = $prices[(string) $mappedItem['id']] ?? null;

            if (!$priceData) {
                continue;
            }

            $high = $priceData['high'] ?? null;
            $low = $priceData['low'] ?? null;

            if ($high && $low) {
                $price = (int) round(($high + $low) / 2);
            } elseif ($high) {
                $price = $high;
            } elseif ($low) {
                $price = $low;
            } else {
                continue;
            }

            $item->update([
                'price' => $price,
            ]);

            $updated++;
        }

        return $updated;
    }
}