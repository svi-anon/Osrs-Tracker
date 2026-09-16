<x-app-layout>
    <div class="min-h-screen bg-[#050914] text-slate-200" style="font-family: Arial, sans-serif;">
        <div class="max-w-3xl mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-white mb-6">Editar personagem</h1>

            <form method="POST" action="{{ route('characters.update', $character) }}" class="bg-[#0b1220] border border-slate-800 rounded-lg p-6">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label class="block mb-2">Nome</label>
                    <input type="text" name="name" value="{{ old('name', $character->name) }}" class="w-full bg-[#111a2b] border-slate-700 rounded-md text-white">
                    @error('name')
                        <p class="text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @foreach (['attack', 'strength', 'defence', 'hitpoints', 'prayer', 'magic', 'ranged'] as $stat)
                        <div>
                            <label class="block mb-2">{{ ucfirst($stat) }}</label>
                            <input type="number" name="{{ $stat }}" value="{{ old($stat, $character->$stat) }}" class="w-full bg-[#111a2b] border-slate-700 rounded-md text-white">
                            @error($stat)
                                <p class="text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        Salvar
                    </button>

                    <a href="{{ route('characters.show', $character) }}" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-md">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>