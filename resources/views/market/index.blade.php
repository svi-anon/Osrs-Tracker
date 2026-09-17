<x-app-layout>
    <div class="min-h-screen bg-[#050914] text-slate-200" style="font-family: Arial, sans-serif;">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Market</h1>
                    <p class="text-slate-400 mt-1">Precos dos itens no Grand Exchange.</p>
                </div>

                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
                    <form method="POST" action="{{ route('market.update') }}">
                        @csrf

                        <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                            Atualizar precos
                        </button>
                    </form>
                @endif
            </div>

            @if (session('success'))
                <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-md mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded-md mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-5">Mais valiosos</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($valuableItems as $item)
                            <div class="bg-[#111a2b] rounded-lg p-4">
                                <div class="h-28 bg-[#070c16] rounded-md mb-4 flex items-center justify-center text-slate-600">
                                    Imagem do item
                                </div>

                                <p class="font-bold text-white">{{ $item->name }}</p>
                                <p class="text-slate-400 mt-1">
                                    {{ number_format($item->price) }} gp
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-[#0b1220] border border-slate-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-5">Itens populares</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($popularItems as $item)
                            <div class="bg-[#111a2b] rounded-lg p-4">
                                <div class="h-28 bg-[#070c16] rounded-md mb-4 flex items-center justify-center text-slate-600">
                                    Imagem do item
                                </div>

                                <p class="font-bold text-white">{{ $item->name }}</p>
                                <p class="text-slate-400 mt-1">
                                    {{ number_format($item->price) }} gp
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <a href="{{ route('dashboard') }}" class="inline-block mt-6 text-blue-400 hover:text-blue-300">
                Voltar
            </a>
        </div>
    </div>
</x-app-layout>