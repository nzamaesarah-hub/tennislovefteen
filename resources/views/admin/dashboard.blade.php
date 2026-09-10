<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Panel Admin - Verifikasi & Pemantauan Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-100 text-emerald-800 rounded-xl font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-200">
                <h3 class="text-lg font-bold text-[#1D2A44] mb-4">Daftar Penyewa Lapangan</h3>

                @if($bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 uppercase text-[11px] font-bold">
                                    <th class="p-4">Penyewa (User)</th>
                                    <th class="p-4">Lapangan & Jadwal</th>
                                    <th class="p-4">Total Biaya</th>
                                    <th class="p-4">Bukti Bayar</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4">Aksi Admin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td class="p-4 font-bold text-[#1D2A44]">
                                            {{ $booking->user->name }} <br>
                                            <span class="text-xs text-slate-400 font-normal">{{ $booking->user->email }}</span>
                                        </td>
                                        <td class="p-4 text-slate-600">
                                            <span class="font-bold text-[#2B5B84]">{{ $booking->court->name }}</span> <br>
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }} <br>
                                            <span class="text-xs text-slate-400 font-medium">
                                                {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }} WIB
                                            </span>
                                        </td>
                                        <td class="p-4 font-black text-[#2B5B84]">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="p-4">
                                            @if($booking->proof_of_payment)
                                                <a href="{{ asset('storage/' . $booking->proof_of_payment) }}" target="_blank" class="text-xs text-indigo-600 underline font-bold">
                                                    Lihat Bukti
                                                </a>
                                            @else
                                                <span class="text-xs text-amber-600 font-semibold">Belum Upload</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            @if($booking->status == 'pending')
                                                <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-bold uppercase">Belum Bayar</span>
                                            @elseif($booking->status == 'waiting_confirmation')
                                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold uppercase">Menunggu Verifikasi</span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold uppercase">Disetujui</span>
                                            @else
                                                <span class="px-3 py-1 bg-rose-100 text-rose-800 rounded-full text-xs font-bold uppercase">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            @if($booking->status == 'waiting_confirmation')
                                                <form action="{{ route('admin.booking.updateStatus', $booking->id) }}" method="POST" class="flex items-center gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" name="status" value="confirmed" class="bg-emerald-600 text-white text-xs px-2.5 py-1.5 rounded-lg hover:bg-emerald-700 font-bold transition">
                                                        Setujui
                                                    </button>
                                                    <button type="submit" name="status" value="rejected" class="bg-rose-600 text-white text-xs px-2.5 py-1.5 rounded-lg hover:bg-rose-700 font-bold transition">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-slate-400 font-medium">Selesai / Diproses</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-slate-400 font-medium text-center py-8">Belum ada data penyewaan lapangan.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>