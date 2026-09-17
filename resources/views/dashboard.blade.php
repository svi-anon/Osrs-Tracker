<x-app-layout>
    <div class="min-h-screen bg-[#050914] text-slate-200" style="font-family: Arial, sans-serif;">
        <div class="max-w-7xl mx-auto px-6 py-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">OSRS Bank Tracker</h1>
                <p class="text-slate-400 mt-1">Dashboard</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

                <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Characters</h2>

                    <div class="space-y-2">
                        @forelse ($characters as $character)
                            <a
                                href="{{ route('dashboard', ['character' => $character->id]) }}"
                                class="block px-4 py-3 rounded-md bg-[#111a2b] hover:bg-[#17243a] transition"
                            >
                                {{ $character->name }}
                            </a>
                        @empty
                            <p class="text-slate-500">No characters found.</p>
                        @endforelse
                    </div>
                </div>

                <div class="lg:col-span-2 bg-[#0b1220] border border-slate-800 rounded-lg p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xl font-bold text-white">
                            {{ $selectedCharacter ? $selectedCharacter->name . ' Stats' : 'Stats' }}
                        </h2>

                        @if ($characters->isNotEmpty())
                            <form method="GET" action="{{ route('dashboard') }}">
                                <select
                                    name="character"
                                    onchange="this.form.submit()"
                                    class="bg-[#111a2b] border-slate-700 text-white rounded-md"
                                >
                                    @foreach ($characters as $character)
                                        <option
                                            value="{{ $character->id }}"
                                            @selected($selectedCharacter && $selectedCharacter->id === $character->id)
                                        >
                                            {{ $character->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        @endif
                    </div>

                    @if ($selectedCharacter)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-[#111a2b] rounded-md p-4">
                                <span class="text-slate-400">Attack</span>
                                <p class="text-xl font-bold">{{ $selectedCharacter->attack }}</p>
                            </div>

                            <div class="bg-[#111a2b] rounded-md p-4">
                                <span class="text-slate-400">Strength</span>
                                <p class="text-xl font-bold">{{ $selectedCharacter->strength }}</p>
                            </div>

                            <div class="bg-[#111a2b] rounded-md p-4">
                                <span class="text-slate-400">Defence</span>
                                <p class="text-xl font-bold">{{ $selectedCharacter->defence }}</p>
                            </div>

                            <div class="bg-[#111a2b] rounded-md p-4">
                                <span class="text-slate-400">Hitpoints</span>
                                <p class="text-xl font-bold">{{ $selectedCharacter->hitpoints }}</p>
                            </div>

                            <div class="bg-[#111a2b] rounded-md p-4">
                                <span class="text-slate-400">Prayer</span>
                                <p class="text-xl font-bold">{{ $selectedCharacter->prayer }}</p>
                            </div>

                            <div class="bg-[#111a2b] rounded-md p-4">
                                <span class="text-slate-400">Magic</span>
                                <p class="text-xl font-bold">{{ $selectedCharacter->magic }}</p>
                            </div>

                            <div class="bg-[#111a2b] rounded-md p-4">
                                <span class="text-slate-400">Ranged</span>
                                <p class="text-xl font-bold">{{ $selectedCharacter->ranged }}</p>
                            </div>

                            <div class="bg-[#111a2b] rounded-md p-4">
                                <span class="text-slate-400">Combat</span>
                                <p class="text-xl font-bold">{{ $selectedCharacter->combatLevel() }}</p>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

            <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-5">
                    <h2 class="text-xl font-bold text-white">All Bank</h2>

                    <div class="text-right">
                        <span class="text-sm text-slate-400">Bank Value</span>
                        <p class="text-xl font-bold text-white">
                            {{ number_format($bankValue) }} gp
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-800 text-left text-slate-400">
                                <th class="py-3">Item</th>
                                <th class="py-3">Quantity</th>
                                <th class="py-3">Price</th>
                                <th class="py-3">Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($allBank as $bankItem)
                                <tr class="border-b border-slate-800">
                                    <td class="py-4 font-semibold">{{ $bankItem['name'] }}</td>
                                    <td class="py-4">{{ number_format($bankItem['quantity']) }}</td>
                                    <td class="py-4">{{ number_format($bankItem['price']) }} gp</td>
                                    <td class="py-4">{{ number_format($bankItem['total']) }} gp</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-5 text-slate-500">
                                        Bank is empty.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-5">Most Valuable</h2>

                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($valuableItems as $item)
                            <div class="bg-[#111a2b] rounded-md p-4">
                                <div class="h-24 bg-[#070c16] rounded-md mb-3 flex items-center justify-center">
                                    @if ($item->image && file_exists(public_path($item->image)))
                                        <img
                                            src="{{ asset($item->image) }}"
                                            alt="{{ $item->name }}"
                                            class="max-h-20 max-w-20 object-contain"
                                        >
                                    @else
                                        <span class="text-slate-600">Sem imagem</span>
                                    @endif
                                </div>

                                <p class="font-bold text-white">{{ $item->name }}</p>
                                <p class="text-sm text-slate-400 mt-1">
                                    {{ number_format($item->price) }} gp
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-5">Popular Items</h2>

                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($popularItems as $item)
                            <div class="bg-[#111a2b] rounded-md p-4">
                                <div class="h-24 bg-[#070c16] rounded-md mb-3 flex items-center justify-center">
                                    @if ($item->image && file_exists(public_path($item->image)))
                                        <img
                                            src="{{ asset($item->image) }}"
                                            alt="{{ $item->name }}"
                                            class="max-h-20 max-w-20 object-contain"
                                        >
                                    @else
                                        <span class="text-slate-600">Sem imagem</span>
                                    @endif
                                </div>

                                <p class="font-bold text-white">{{ $item->name }}</p>
                                <p class="text-sm text-slate-400 mt-1">
                                    {{ number_format($item->price) }} gp
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>