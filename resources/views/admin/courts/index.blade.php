<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Lapangan Tenis') }}
            </h2>
            <a href="{{ route('admin.courts.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-4 py-2 rounded-xl shadow transition">
                + Tambah Lapangan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="p-4 mb-6 bg-emerald-100 text-emerald-800 rounded-xl font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-200">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 uppercase text-[11px] font-bold">
                            <th class="p-4">Foto</th>
                            <th class="p-4">Nama Lapangan</th>
                            <th class="p-4">Tipe</th>
                            <th class="p-4">Harga / Jam</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($courts as $court)
                            <tr>
                                <td class="p-4">
                                    @php
                                        $imageUrl = filter_var($court->image, FILTER_VALIDATE_URL) 
                                            ? $court->image 
                                            : asset('storage/' . $court->image);
                                    @endphp
                                    <img src="{{ $imageUrl }}" class="w-16 h-12 object-cover rounded-lg border border-slate-200" alt="{{ $court->name }}">
                                </td>
                                <td class="p-4 font-bold text-[#1D2A44]">
                                    {{ $court->name }}
                                    <p class="text-xs text-slate-400 font-normal line-clamp-1">{{ $court->description }}</p>
                                </td>
                                <td class="p-4 font-semibold text-slate-600">
                                    {{ $court->type }}
                                </td>
                                <td class="p-4 font-black text-[#2B5B84]">
                                    Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}
                                </td>
                                <td class="p-4">
                                    @if($court->status == 'available')
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold">Tersedia</span>
                                    @else
                                        <span class="px-3 py-1 bg-rose-100 text-rose-800 rounded-full text-xs font-bold">Perbaikan</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.courts.edit', $court->id) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1.5 rounded-lg">Edit</a>
                                        <form action="{{ route('admin.courts.destroy', $court->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lapangan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-900 bg-rose-50 px-3 py-1.5 rounded-lg">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-slate-400 font-medium">Belum ada data lapangan. Silakan tambah data baru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>