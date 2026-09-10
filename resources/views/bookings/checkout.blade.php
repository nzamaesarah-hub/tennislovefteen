<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Pembayaran - Love-15 Tennis</title>

    <!-- Load Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 font-sans antialiased text-white">

    <div class="py-12 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tombol Kembali -->
            <div class="mb-4">
                <a href="{{ route('dashboard') }}" class="text-sm text-slate-400 hover:text-white transition">
                    &larr; Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-slate-800 rounded-2xl shadow-xl overflow-hidden border border-slate-700">
                
                <!-- Header -->
                <div class="bg-slate-700/50 p-6 border-b border-slate-700 text-center">
                    <span class="inline-block bg-lime-400 text-slate-900 text-xs font-black uppercase px-3 py-1 rounded-full mb-2">
                        Pembayaran
                    </span>

                    <h2 class="text-2xl font-bold text-white">
                        Selesaikan Pembayaran Anda
                    </h2>

                    <p class="text-slate-400 text-sm mt-1">
                        Transfer sesuai nominal ke salah satu rekening di bawah ini
                    </p>
                </div>

                <div class="p-6 md:p-8 space-y-8">

                    <!-- Detail Ringkasan Pesanan -->
                    <div class="bg-slate-900/60 p-5 rounded-xl border border-slate-700/60">
                        <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-3">
                            Ringkasan Pesanan
                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">

                            <!-- Lapangan -->
                            <div>
                                <p class="text-slate-400">Lapangan</p>

                                <p class="font-semibold text-white">
                                    {{ $court->name }}
                                </p>
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <p class="text-slate-400">Tanggal Main</p>

                                <p class="font-semibold text-white">
                                    {{ \Carbon\Carbon::parse($pendingBooking['booking_date'])->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            <!-- Waktu -->
                            <div>
                                <p class="text-slate-400">Waktu</p>

                                <p class="font-semibold text-white">
                                    {{ $pendingBooking['start_time'] }} -
                                    {{ $pendingBooking['end_time'] }}
                                </p>
                            </div>

                            <!-- Total -->
                            <div>
                                <p class="text-slate-400">Total Tagihan</p>

                                <p class="font-extrabold text-lime-400 text-lg">
                                    Rp {{ number_format($pendingBooking['total_price'], 0, ',', '.') }}
                                </p>
                            </div>

                        </div>
                    </div>


                    <!-- Informasi Rekening Bank Tujuan -->
                    <div>
                        <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-3">
                            Rekening Bank Tujuan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            @foreach($banks as $bank)

                                <div class="bg-slate-900 p-4 rounded-xl border border-slate-700 flex flex-col justify-between">

                                    <div>

                                        <span class="text-xs font-bold text-white px-2 py-0.5 rounded {{ $bank['logo_color'] }} inline-block mb-2">
                                            {{ $bank['name'] }}
                                        </span>

                                        <p class="text-xs text-slate-400">
                                            Atas Nama:
                                        </p>

                                        <p class="text-sm font-semibold text-slate-200 mb-2">
                                            {{ $bank['account_name'] }}
                                        </p>

                                    </div>

                                    <div class="pt-2 border-t border-slate-800">

                                        <p class="text-xs text-slate-400">
                                            No. Rekening:
                                        </p>

                                        <p class="text-lg font-mono font-bold text-lime-400 tracking-wider">
                                            {{ $bank['account_number'] }}
                                        </p>

                                    </div>

                                </div>

                            @endforeach

                        </div>
                    </div>


                    <!-- Form Upload Bukti Transfer -->
                    <div class="bg-slate-900/80 p-6 rounded-xl border border-slate-700">

                        <h3 class="text-base font-semibold text-white mb-2">
                            Unggah Bukti Transfer
                        </h3>

                        <p class="text-slate-400 text-xs mb-4">
                            Format gambar: JPG, PNG, JPEG (Maks. 2MB)
                        </p>


                        <!--
                            Karena booking BELUM dibuat di database,
                            route upload tidak lagi membutuhkan ID booking.
                        -->
                        <form
                            action="{{ route('booking.uploadProof') }}"
                            method="POST"
                            enctype="multipart/form-data"
                            class="space-y-4"
                        >

                            @csrf

                            <div>

                                <input
                                    type="file"
                                    name="proof_of_payment"
                                    id="proof_of_payment"
                                    required
                                    accept="image/jpeg, image/png, image/jpg"
                                    class="block w-full text-sm text-slate-400
                                           file:mr-4 file:py-2.5 file:px-4 file:rounded-lg
                                           file:border-0 file:text-xs file:font-semibold
                                           file:bg-lime-400 file:text-slate-900
                                           hover:file:bg-lime-300 transition cursor-pointer"
                                >

                                @error('proof_of_payment')
                                    <p class="text-red-400 text-xs mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            <div class="pt-2">

                                <button
                                    type="submit"
                                    class="w-full bg-lime-400 hover:bg-lime-300 text-slate-900 font-extrabold py-3 px-4 rounded-xl shadow-lg transition duration-200"
                                >
                                    Kirim Bukti Pembayaran 📤
                                </button>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>