<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking {{ $court->name }} - Love-15 Tennis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-white antialiased font-sans min-h-screen flex flex-col">

    <nav class="bg-slate-800 border-b border-slate-700">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-lime-400 rounded-full flex items-center justify-center font-black text-slate-900 text-xl shadow">
                    🎾
                </div>
                <div>
                    <span class="text-2xl font-extrabold tracking-wider text-white">LOVE - 15</span>
                    <span class="block text-[10px] text-lime-400 font-semibold uppercase tracking-widest">Tennis Club</span>
                </div>
            </a>
            <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-white font-medium text-sm flex items-center gap-1 transition">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-6 py-12 flex-grow w-full">
        <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden">
            <div class="bg-slate-700/50 p-6 md:p-8 border-b border-slate-700">
                <span class="text-xs font-bold uppercase tracking-widest bg-lime-400 text-slate-900 px-3 py-1 rounded-md">
                    Form Pemesanan
                </span>
                <h1 class="text-2xl md:text-3xl font-black mt-3 text-white">{{ $court->name }}</h1>
                <p class="text-slate-400 text-sm mt-1">Tarif: <strong class="text-lime-400">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }} / jam</strong></p>
            </div>

            <form action="{{ route('booking.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
                @csrf
                <input type="hidden" name="court_id" value="{{ $court->id }}">

                @if ($errors->any())
                    <div class="bg-red-950/50 border border-red-800 text-red-300 p-4 rounded-xl text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>⚠️ {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div>
                    <label for="booking_date" class="block text-sm font-bold text-slate-300 mb-2">Tanggal Main</label>
                    <input type="date" id="booking_date" name="booking_date" min="{{ date('Y-m-d') }}" value="{{ old('booking_date', date('Y-m-d')) }}" required
                        class="w-full bg-slate-900 rounded-xl border-slate-700 text-white focus:border-lime-400 focus:ring-lime-400 p-3 shadow-sm">
                </div>

                <div>
                    <label for="start_time" class="block text-sm font-bold text-slate-300 mb-2">Jam Mulai</label>
                    <select id="start_time" name="start_time" required
                        class="w-full bg-slate-900 rounded-xl border-slate-700 text-white focus:border-lime-400 focus:ring-lime-400 p-3 shadow-sm">
                        <option value="">-- Pilih Jam Mulai --</option>
                        @for ($i = 6; $i <= 21; $i++)
                            @php $time = sprintf('%02d:00', $i); @endphp
                            <option value="{{ $time }}" {{ old('start_time') == $time ? 'selected' : '' }}>
                                {{ $time }} WIB
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label for="duration_hours" class="block text-sm font-bold text-slate-300 mb-2">Durasi (Jam)</label>
                    <select id="duration_hours" name="duration_hours" required
                        class="w-full bg-slate-900 rounded-xl border-slate-700 text-white focus:border-lime-400 focus:ring-lime-400 p-3 shadow-sm">
                        <option value="1" {{ old('duration_hours') == '1' ? 'selected' : '' }}>1 Jam</option>
                        <option value="2" {{ old('duration_hours') == '2' ? 'selected' : '' }}>2 Jam</option>
                        <option value="3" {{ old('duration_hours') == '3' ? 'selected' : '' }}>3 Jam</option>
                        <option value="4" {{ old('duration_hours') == '4' ? 'selected' : '' }}>4 Jam</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-lime-400 hover:bg-lime-300 text-slate-900 font-extrabold py-4 rounded-xl transition shadow-lg text-base">
                    Lanjut ke Pembayaran 💳
                </button>
            </form>
        </div>
    </main>

</body>
</html>