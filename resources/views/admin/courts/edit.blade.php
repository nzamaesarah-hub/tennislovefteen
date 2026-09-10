<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-200">
                <form action="{{ route('admin.courts.update', $court->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama Lapangan</label>
                        <input type="text" name="name" value="{{ old('name', $court->name) }}" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Tipe Lapangan</label>
                        <input type="text" name="type" value="{{ old('type', $court->type) }}" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Harga per Jam (Rp)</label>
                        <input type="number" name="price_per_hour" value="{{ old('price_per_hour', $court->price_per_hour) }}" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Status Lapangan</label>
                        <select name="status" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="available" {{ $court->status == 'available' ? 'selected' : '' }}>Tersedia (Available)</option>
                            <option value="maintenance" {{ $court->status == 'maintenance' ? 'selected' : '' }}>Perbaikan (Maintenance)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Deskripsi / Fasilitas</label>
                        <textarea name="description" rows="3" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('description', $court->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Foto Lapangan (Biarkan kosong jika tidak diubah)</label>
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $court->image) }}" class="w-24 h-16 object-cover rounded-lg border border-slate-200" alt="Current Image">
                        </div>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs px-5 py-2.5 rounded-xl shadow transition">Perbarui Lapangan</button>
                        <a href="{{ route('admin.courts.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs px-5 py-2.5 rounded-xl transition">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>