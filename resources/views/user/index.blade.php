<x-app-layout>
    <!-- HERO SECTION -->
    <div class="bg-[#1e385c] text-white py-16 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <span class="bg-slate-800 text-[#ccff00] text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest border border-slate-700">
                Official Court Booking
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold mt-6 tracking-tight">
                SEWA LAPANGAN TENIS <br>
                <span class="text-[#ccff00]">STAN PARAMOUNT</span>
            </h1>
            <p class="mt-4 text-slate-300 max-w-2xl mx-auto">
                Main tenis makin gampang. Pilih lapangan favoritmu, booking jadwal, dan langsung main!
            </p>
            <div class="mt-8">
                <a href="#daftar-lapangan" class="bg-[#ccff00] text-slate-900 font-bold px-6 py-3 rounded-full shadow-lg hover:bg-lime-300 transition-all inline-flex items-center space-x-2">
                    <span>Lihat Lapangan</span>
                    <span>↓</span>
                </a>
            </div>
        </div>
    </div>

    <!-- DAFTAR LAPANGAN -->
    <div id="daftar-lapangan" class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Lapangan</h2>
        <p class="text-gray-500 text-sm mb-8">Pilih lapangan yang tersedia untuk dijadwalkan</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($courts as $court)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 flex flex-col justify-between transition-all hover:shadow-lg">
                    <!-- GAMBAR LAPANGAN -->
                    <div class="relative h-48 bg-gray-200">
                        @if($court->image && file_exists(public_path('images/' . $court->image)))
                            <img src="{{ asset('images/' . $court->image) }}" alt="{{ $court->name }}" class="w-full h-full object-cover">
                        @elseif($court->image && file_exists(public_path('storage/' . $court->image)))
                            <img src="{{ asset('storage/' . $court->image) }}" alt="{{ $court->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-700 text-slate-400">
                                <span class="text-xs font-semibold">No Image Available</span>
                            </div>
                        @endif

                        <span class="absolute top-3 right-3 bg-slate-900/80 text-[#ccff00] text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm border border-slate-700">
                            {{ strtoupper($court->type ?? 'Hardcourt') }}
                        </span>
                    </div>

                    <!-- INFORMASI LAPANGAN -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $court->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                {{ $court->description ?? 'Lapangan tenis standar internasional dengan fasilitas lengkap.' }}
                            </p>
                        </div>

                        <div class="mt-6 flex items-center justify-between border-t border-gray-100 pt-4">
                            <div>
                                <span class="text-xs text-gray-400 block">Harga / Jam</span>
                                <span class="text-lg font-extrabold text-slate-900">
                                    Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}
                                </span>
                            </div>
                            
                            <a href="{{ route('booking.create', $court->id) }}" class="bg-[#1e385c] hover:bg-slate-800 text-[#ccff00] font-bold text-xs px-5 py-2.5 rounded-full transition-all shadow-sm">
                                Pilih Jam & Booking
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
                    <p class="text-gray-500 font-medium">Belum ada lapangan yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>