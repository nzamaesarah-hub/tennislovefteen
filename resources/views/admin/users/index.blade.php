<x-app-layout>

    <div class="py-10 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-[#1e385c]">
                            Data Pengguna
                        </h2>
                        <p class="text-sm text-slate-500 mt-1">
                            Daftar pengguna yang terdaftar di Love-15 Tennis
                        </p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        <thead class="bg-slate-50 text-[#1e385c]">
                            <tr>
                                <th class="px-4 py-4">No</th>
                                <th class="px-4 py-4">Nama</th>
                                <th class="px-4 py-4">Email</th>
                                <th class="px-4 py-4">Role</th>
                                <th class="px-4 py-4">Terdaftar</th>
                                <th class="px-4 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200">

                            @forelse($users as $user)

                                <tr class="hover:bg-slate-50">

                                    <td class="px-4 py-4">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-4 py-4 font-semibold text-[#1e385c]">
                                        {{ $user->name }}
                                    </td>

                                    <td class="px-4 py-4 text-slate-500">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-4 py-4">
                                        @if($user->role === 'admin')
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#ccff00] text-slate-900">
                                                ADMIN
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700">
                                                USER
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 text-slate-500">
                                        {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                    </td>

                                    <td class="px-4 py-4">

                                        <div class="flex justify-center items-center gap-2">

                                            <a href="{{ route('admin.users.show', $user) }}"
                                               class="px-3 py-2 rounded-lg bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200">
                                                Lihat
                                            </a>

                                            <a href="{{ route('admin.users.edit', $user) }}"
                                               class="px-3 py-2 rounded-lg bg-yellow-100 text-yellow-700 font-semibold hover:bg-yellow-200">
                                                Edit
                                            </a>

                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="px-3 py-2 rounded-lg bg-red-100 text-red-700 font-semibold hover:bg-red-200">
                                                        Hapus
                                                    </button>

                                                </form>
                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">
                                        Belum ada pengguna yang terdaftar.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>