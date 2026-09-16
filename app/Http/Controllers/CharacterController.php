<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        $characters = Character::where('user_id', $request->user()->id)->get();

        return view('characters.index', compact('characters'));
    }

    public function create()
    {
        return view('characters.create');
    }

    public function store(StoreCharacterRequest $request)
    {
        Character::create([
            'user_id' => $request->user()->id,
            ...$request->validated(),
        ]);

        return redirect()->route('characters.index')
            ->with('success', 'Personagem criado com sucesso.');
    }

    public function show(Request $request, Character $character)
    {
        abort_unless($character->user_id === $request->user()->id, 403);

        $character->load('bankItems.item');

        return view('characters.show', compact('character'));
    }

    public function edit(Request $request, Character $character)
    {
        abort_unless($character->user_id === $request->user()->id, 403);

        return view('characters.edit', compact('character'));
    }

    public function update(UpdateCharacterRequest $request, Character $character)
    {
        abort_unless($character->user_id === $request->user()->id, 403);

        $character->update($request->validated());

        return redirect()->route('characters.show', $character)
            ->with('success', 'Personagem atualizado com sucesso.');
    }

    public function destroy(Request $request, Character $character)
    {
        abort_unless($character->user_id === $request->user()->id, 403);

        $character->delete();

        return redirect()->route('characters.index')
            ->with('success', 'Personagem excluido com sucesso.');
    }
}