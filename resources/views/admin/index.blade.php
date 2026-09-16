<x-app-layout>
    <div class="min-h-screen bg-[#050914] text-slate-200" style="font-family: Arial, sans-serif;">
        <div class="max-w-5xl mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-white mb-6">Area de admin</h1>

            <div class="bg-[#0b1220] border border-slate-800 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-800 text-left text-slate-400">
                            <th class="p-4">Nome</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Role</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-slate-800">
                                <td class="p-4">{{ $user->name }}</td>
                                <td class="p-4">{{ $user->email }}</td>
                                <td class="p-4">{{ $user->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ route('dashboard') }}" class="inline-block mt-6 text-blue-400 hover:text-blue-300">
                Voltar
            </a>
        </div>
    </div>
</x-app-layout>