<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankItemRequest;
use App\Http\Requests\UpdateBankItemRequest;
use App\Models\BankItem;
use App\Models\Character;

class BankItemController extends Controller
{
    public function store(StoreBankItemRequest $request, Character $character)
    {
        $this->checkAccess($request->user(), $character);

        $bankItem = BankItem::where('character_id', $character->id)
            ->where('item_id', $request->item_id)
            ->first();

        if ($bankItem) {
            $bankItem->quantity += $request->quantity;
            $bankItem->save();
        } else {
            BankItem::create([
                'character_id' => $character->id,
                'item_id' => $request->item_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('characters.show', $character)
            ->with('success', 'Item adicionado ao Bank.');
    }

    public function update(UpdateBankItemRequest $request, BankItem $bankItem)
    {
        $this->checkAccess($request->user(), $bankItem->character);

        $bankItem->update($request->validated());

        return redirect()->route('characters.show', $bankItem->character)
            ->with('success', 'Quantidade atualizada.');
    }

    public function destroy(BankItem $bankItem)
    {
        $this->checkAccess(request()->user(), $bankItem->character);

        $character = $bankItem->character;

        $bankItem->delete();

        return redirect()->route('characters.show', $character)
            ->with('success', 'Item removido do Bank.');
    }

    private function checkAccess($user, Character $character): void
    {
        if (
            $user->role !== 'admin' &&
            $user->role !== 'moderator' &&
            $character->user_id !== $user->id
        ) {
            abort(403);
        }
    }
}