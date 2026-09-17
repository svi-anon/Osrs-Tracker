<x-app-layout>
    <div class="min-h-screen bg-[#050914] text-slate-200" style="font-family: Arial, sans-serif;">
        <div class="max-w-6xl mx-auto px-6 py-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">Admin</h1>
                <p class="text-slate-400 mt-1">Gerencie as roles dos usuarios.</p>
            </div>

            @if (session('success'))
                <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-md mb-5">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded-md mb-5">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-[#0b1220] border border-slate-800 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-800 text-left text-slate-400">
                            <th class="p-4">Nome</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Role</th>
                            <th class="p-4">Acao</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-slate-800">
                                <td class="p-4 text-white">
                                    {{ $user->name }}
                                </td>

                                <td class="p-4 text-slate-300">
                                    {{ $user->email }}
                                </td>

                                <td class="p-4">
                                    @if (auth()->id() === $user->id)
                                        <span class="text-blue-400">
                                            {{ $user->role }}
                                        </span>
                                    @else
                                        <form method="POST" action="{{ route('admin.users.role', $user) }}" class="flex items-center gap-3">
                                            @csrf
                                            @method('PUT')

                                            <select
                                                name="role"
                                                class="bg-[#111a2b] border-slate-700 text-white rounded-md"
                                            >
                                                <option value="admin" @selected($user->role === 'admin')>
                                                    admin
                                                </option>

                                                <option value="moderator" @selected($user->role === 'moderator')>
                                                    moderator
                                                </option>

                                                <option value="user" @selected($user->role === 'user')>
                                                    user
                                                </option>
                                            </select>

                                            <button
                                                type="submit"
                                                class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2 rounded-md"
                                            >
                                                Salvar
                                            </button>
                                        </form>
                                    @endif
                                </td>

                                <td class="p-4 text-slate-400">
                                    @if (auth()->id() === $user->id)
                                        Usuario atual
                                    @else
                                        Editavel
                                    @endif
                                </td>
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