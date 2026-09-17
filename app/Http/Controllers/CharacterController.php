<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Models\Character;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Character::class);

        if ($request->user()->role === 'admin' || $request->user()->role === 'moderator') {
            $characters = Character::with('user')->get();
        } else {
            $characters = Character::where('user_id', $request->user()->id)->get();
        }

        return view('characters.index', compact('characters'));
    }

    public function create()
    {
        Gate::authorize('create', Character::class);

        return view('characters.create');
    }

    public function store(StoreCharacterRequest $request)
    {
        Gate::authorize('create', Character::class);

        Character::create([
            'user_id' => $request->user()->id,
            ...$request->validated(),
        ]);

        return redirect()->route('characters.index')
            ->with('success', 'Char criado com sucesso.');
    }

    public function show(Character $character)
    {
        Gate::authorize('view', $character);

        $character->load('bankItems.item');

        $items = Item::orderBy('name')->get();

        return view('characters.show', compact('character', 'items'));
    }

    public function edit(Character $character)
    {
        Gate::authorize('update', $character);

        return view('characters.edit', compact('character'));
    }

    public function update(UpdateCharacterRequest $request, Character $character)
    {
        Gate::authorize('update', $character);

        $character->update($request->validated());

        return redirect()->route('characters.show', $character)
            ->with('success', 'Char atualizado com sucesso.');
    }

    public function destroy(Character $character)
    {
        Gate::authorize('delete', $character);

        $character->delete();

        return redirect()->route('characters.index')
            ->with('success', 'Char excluido com sucesso.');
    }
}