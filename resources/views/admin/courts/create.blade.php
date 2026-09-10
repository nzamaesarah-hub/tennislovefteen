<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Lapangan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-200">
                <form action="{{ route('admin.courts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama Lapangan</label>
                        <input type="text" name="name" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500" placeholder="contoh: Lapangan Utama A" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Tipe Lapangan</label>
                        <input type="text" name="type" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500" placeholder="contoh: Indoor / Hard Court / Rumput" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Harga per Jam (Rp)</label>
                        <input type="number" name="price_per_hour" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500" placeholder="150000" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Status Lapangan</label>
                        <select name="status" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="available">Tersedia (Available)</option>
                            <option value="maintenance">Perbaikan (Maintenance)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Deskripsi / Fasilitas</label>
                        <textarea name="description" rows="3" class="w-full rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500" placeholder="Fasilitas: Lampu LED, Tribun, dll..."></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Foto Lapangan</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" required>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-5 py-2.5 rounded-xl shadow transition">Simpan Lapangan</button>
                        <a href="{{ route('admin.courts.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs px-5 py-2.5 rounded-xl transition">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>