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
                        Editar
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

            <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6">
                <h2 class="text-xl font-bold text-white mb-4">Bank</h2>

                @forelse ($character->bankItems as $bankItem)
                    <div class="flex justify-between py-3 border-b border-slate-800">
                        <span>{{ $bankItem->item->name }}</span>
                        <span>{{ number_format($bankItem->quantity) }}</span>
                    </div>
                @empty
                    <p class="text-slate-400">Bank Vazio.</p>
                @endforelse
            </div>

            <a href="{{ route('characters.index') }}" class="inline-block mt-6 text-blue-400 hover:text-blue-300">
                Voltar
            </a>
        </div>
    </div>
</x-app-layout>