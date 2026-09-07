<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Love - 15 Tennis Court Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 antialiased font-sans min-h-screen flex flex-col">

    <nav class="bg-[#1D2A44] text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#CCFF00] rounded-full flex items-center justify-center font-black text-[#1D2A44] text-xl shadow">
                    🎾
                </div>
                <div>
                    <span class="text-2xl font-extrabold tracking-wider text-white">LOVE - 15</span>
                    <span class="block text-[10px] text-[#CCFF00] font-semibold uppercase tracking-widest">Tennis Club</span>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-[#2B5B84] hover:bg-[#1D2A44] text-white font-semibold px-5 py-2.5 rounded-xl transition shadow">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-200 hover:text-white font-medium px-4 py-2 transition">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-[#CCFF00] hover:bg-[#bce600] text-[#1D2A44] font-bold px-5 py-2.5 rounded-xl transition shadow">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <header class="bg-[#2B5B84] text-white py-16 px-6 text-center relative overflow-hidden shadow-inner">
        <div class="max-w-4xl mx-auto relative z-10">
            <span class="inline-block bg-[#1D2A44] text-[#CCFF00] font-bold text-xs uppercase px-4 py-1.5 rounded-full mb-4 shadow">
                Official Court Booking
            </span>
            <h1 class="text-4xl md:text-6xl font-black tracking-tight mb-4 leading-tight">
                SEWA LAPANGAN TENIS <br><span class="text-[#CCFF00]">STAN PARAMOUNT</span>
            </h1>
            <p class="text-lg text-slate-200 max-w-2xl mx-auto mb-8 font-light">
                Main tenis makin gampang. Pilih lapangan favoritmu, booking jadwal, dan langsung main!
            </p>
            <a href="#courts" class="inline-flex items-center gap-2 bg-[#CCFF00] hover:bg-[#bce600] text-[#1D2A44] font-extrabold text-base px-8 py-3.5 rounded-xl transition transform hover:-translate-y-0.5 shadow-lg">
                Lihat Lapangan 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </header>

    <main id="courts" class="max-w-7xl mx-auto px-6 py-16 flex-grow w-full">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-[#1D2A44]">Daftar Lapangan</h2>
                <p class="text-slate-500 text-sm mt-1">Pilih lapangan yang tersedia untuk dijadwalkan</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($courts as $court)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-md hover:shadow-2xl transition duration-300 flex flex-col justify-between overflow-hidden group">
                    <div>
                        <div class="relative h-48 overflow-hidden bg-slate-900">
                            @if($court->name == 'Center Court - Royal Blue')
                                <img src="{{ asset('images/center-court.jpg') }}" 
                                     alt="{{ $court->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @elseif($court->name == 'Grandstand Court - Ocean')
                                <img src="{{ asset('images/grandstand-court.jpg') }}" 
                                     alt="{{ $court->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <img src="{{ asset('images/practice-court.jpg') }}" 
                                     alt="{{ $court->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @endif

                            <div class="absolute top-4 left-4">
                                <span class="text-xs font-bold uppercase tracking-wider bg-[#1D2A44]/90 text-white px-3 py-1 rounded-md backdrop-blur-sm">
                                    {{ $court->type }}
                                </span>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="text-xs font-bold text-emerald-400 bg-emerald-950/80 border border-emerald-500/30 px-2.5 py-1 rounded-md backdrop-blur-sm">
                                    ● {{ ucfirst($court->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-2xl font-extrabold text-[#1D2A44] group-hover:text-[#2B5B84] transition mb-2">
                                {{ $court->name }}
                            </h3>

                            <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                                @if($court->name == 'Center Court - Royal Blue')
                                    Lapangan outdoor eksklusif dengan pemandangan lanskap kota yang indah, permukaan hardcourt presisi, dan pencahayaan LED malam hari.
                                @elseif($court->type == 'Indoor Hardcourt')
                                    Atap pelindung bebas cuaca hujan/panas, pencahayaan anti-silau, dan lantai karpet ramah sendi.
                                @else
                                    Sangat cocok untuk latihan privat, drilling dengan pelatih, atau sekadar pemanasan pemain pemula.
                                @endif
                            </p>

                            <p class="text-xs text-slate-400 uppercase font-bold tracking-wider mb-1">Harga Sewa</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl font-black text-[#2B5B84]">
                                    Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}
                                </span>
                                <span class="text-slate-500 font-medium text-sm">/ jam</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 pt-0">
                        @auth
                            <a href="{{ route('booking.create', $court->id) }}" class="block text-center w-full bg-[#2B5B84] hover:bg-[#1D2A44] text-white font-bold py-3 rounded-xl transition shadow">
                                Booking Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block text-center w-full bg-slate-100 hover:bg-[#1D2A44] hover:text-white text-slate-700 font-bold py-3 rounded-xl transition border border-slate-200">
                                Login untuk Booking
                            </a>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                    <p class="text-slate-500 font-medium">Belum ada lapangan yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-[#1D2A44] text-slate-400 text-center py-6 text-sm mt-auto border-t border-slate-800">
        <p>&copy; {{ date('Y') }} <span class="text-[#CCFF00] font-bold">Love - 15</span> Tennis Court. All rights reserved.</p>
    </footer>

</body>
</html>