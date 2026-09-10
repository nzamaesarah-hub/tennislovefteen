<x-app-layout>

    <div class="py-10 bg-slate-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-[#1e385c]">
                        Edit Pengguna
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Perbarui data akun {{ $user->name }}
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full rounded-lg border-slate-300 text-sm focus:ring-[#1e385c] focus:border-[#1e385c]"
                               required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full rounded-lg border-slate-300 text-sm focus:ring-[#1e385c] focus:border-[#1e385c]"
                               required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Role</label>

                        @if($user->id === auth()->id())
                            <input type="text" value="{{ ucfirst($user->role) }}" disabled
                                   class="w-full rounded-lg border-slate-200 bg-slate-100 text-sm text-slate-500">
                            <input type="hidden" name="role" value="{{ $user->role }}">
                            <p class="text-xs text-slate-400 mt-1">
                                Role akun sendiri tidak dapat diubah dari sini.
                            </p>
                        @else
                            <select name="role"
                                    class="w-full rounded-lg border-slate-300 text-sm focus:ring-[#1e385c] focus:border-[#1e385c]">
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        @endif
                    </div>

                    <div class="pt-2 border-t border-slate-100">
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1 mt-4">Password Baru</label>
                        <input type="password" name="password"
                               class="w-full rounded-lg border-slate-300 text-sm focus:ring-[#1e385c] focus:border-[#1e385c]"
                               placeholder="Biarkan kosong jika tidak diubah">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation"
                               class="w-full rounded-lg border-slate-300 text-sm focus:ring-[#1e385c] focus:border-[#1e385c]"
                               placeholder="Ulangi password baru">
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit"
                                class="px-5 py-2.5 rounded-lg bg-[#1e385c] hover:bg-[#16294a] text-white font-bold text-xs shadow transition">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('admin.users.index') }}"
                           class="px-5 py-2.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs transition">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>