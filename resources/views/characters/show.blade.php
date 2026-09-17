<x-app-layout>
    <div class="min-h-screen bg-[#050914] text-slate-200" style="font-family: Arial, sans-serif;">
        <div class="max-w-5xl mx-auto px-6 py-8">
            @if (session('success'))
                <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-md mb-5">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $character->name }}</h1>
                    <p class="text-slate-400">Combat {{ $character->combatLevel() }}</p>
                </div>

                @can('update', $character)
                    <a href="{{ route('characters.edit', $character) }}" class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        Editar char
                    </a>
                @endcan
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                @foreach (['attack', 'strength', 'defence', 'hitpoints', 'prayer', 'magic', 'ranged'] as $stat)
                    <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-4">
                        <p class="text-slate-400">{{ ucfirst($stat) }}</p>
                        <p class="text-2xl font-bold text-white">{{ $character->$stat }}</p>
                    </div>
                @endforeach

                <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-4">
                    <p class="text-slate-400">Combat</p>
                    <p class="text-2xl font-bold text-white">{{ $character->combatLevel() }}</p>
                </div>
            </div>

            <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Adicionar item ao Bank</h2>

                <form method="POST" action="{{ route('bank.store', $character) }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf

                    <select name="item_id" class="bg-[#111a2b] border-slate-700 rounded-md text-white">
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>

                    <input
                        type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        class="bg-[#111a2b] border-slate-700 rounded-md text-white"
                    >

                    <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white rounded-md">
                        Adicionar
                    </button>
                </form>

                @error('item_id')
                    <p class="text-red-400 mt-2">{{ $message }}</p>
                @enderror

                @error('quantity')
                    <p class="text-red-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6">
                <h2 class="text-xl font-bold text-white mb-4">Bank</h2>

                <div class="space-y-3">
                    @forelse ($character->bankItems as $bankItem)
                        <div class="bg-[#111a2b] rounded-md p-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <p class="font-bold text-white">{{ $bankItem->item->name }}</p>
                                <p class="text-sm text-slate-400">
                                    {{ number_format($bankItem->item->price) }} gp cada
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <form method="POST" action="{{ route('bank.update', $bankItem) }}" class="flex gap-2">
                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $bankItem->quantity }}"
                                        min="1"
                                        class="w-28 bg-[#070c16] border-slate-700 rounded-md text-white"
                                    >

                                    <button type="submit" class="text-blue-400 hover:text-blue-300">
                                        Salvar
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('bank.destroy', $bankItem) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-400 hover:text-red-300">
                                        Remover
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-400">Bank vazio.</p>
                    @endforelse
                </div>
            </div>

            <a href="{{ route('characters.index') }}" class="inline-block mt-6 text-blue-400 hover:text-blue-300">
                Voltar
            </a>
        </div>
    </div>
</x-app-layout>