<x-app-layout>
    <div class="min-h-screen bg-[#050914] text-slate-200" style="font-family: Arial, sans-serif;">
        <div class="max-w-5xl mx-auto px-6 py-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-white">Characters</h1>
                    <p class="text-slate-400 mt-1">Gerencie seus chars do OSRS.</p>
                </div>

                <a href="{{ route('characters.create') }}" class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    Novo char
                </a>
            </div>

            @if (session('success'))
                <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-md mb-5">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                @forelse ($characters as $character)
                    <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-5 flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold text-white">{{ $character->name }}</h2>
                            <p class="text-slate-400">Combat {{ $character->combatLevel() }}</p>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('characters.show', $character) }}" class="text-blue-400 hover:text-blue-300">
                                Ver
                            </a>

                            <a href="{{ route('characters.edit', $character) }}" class="text-yellow-400 hover:text-yellow-300">
                                Editar
                            </a>

                            <form method="POST" action="{{ route('characters.destroy', $character) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-400 hover:text-red-300">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6 text-slate-400">
                        Nenhum char cadastrado.
                    </div>
                @endforelse
            </div>

            <a href="{{ route('dashboard') }}" class="inline-block mt-6 text-blue-400 hover:text-blue-300">
                Voltar
            </a>
        </div>
    </div>
</x-app-layout>