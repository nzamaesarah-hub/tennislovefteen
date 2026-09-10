<x-app-layout>

    <div class="py-10 bg-slate-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-[#1e385c]">
                            Detail Pengguna
                        </h2>
                        <p class="text-sm text-slate-500 mt-1">
                            Informasi lengkap akun pengguna
                        </p>
                    </div>

                    <a href="{{ route('admin.users.index') }}"
                       class="px-4 py-2 rounded-lg bg-slate-100 text-slate-600 font-semibold text-sm hover:bg-slate-200">
                        &larr; Kembali
                    </a>
                </div>

                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase mb-1">Nama</dt>
                        <dd class="text-sm font-semibold text-[#1e385c]">{{ $user->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase mb-1">Email</dt>
                        <dd class="text-sm text-slate-700">{{ $user->email }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase mb-1">Role</dt>
                        <dd>
                            @if($user->role === 'admin')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#ccff00] text-slate-900">
                                    ADMIN
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700">
                                    USER
                                </span>
                            @endif
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase mb-1">Terdaftar Sejak</dt>
                        <dd class="text-sm text-slate-700">
                            {{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }}
                        </dd>
                    </div>

                </dl>

                <div class="pt-6 flex gap-3">
                    <a href="{{ route('admin.users.edit', $user) }}"
                       class="px-4 py-2 rounded-lg bg-yellow-100 text-yellow-700 font-semibold text-sm hover:bg-yellow-200">
                        Edit Pengguna
                    </a>

                    @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="px-4 py-2 rounded-lg bg-red-100 text-red-700 font-semibold text-sm hover:bg-red-200">
                                Hapus Pengguna
                            </button>
                        </form>
                    @endif
                </div>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold text-[#1e385c] mb-4">
                    Riwayat Booking
                </h3>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        <thead class="bg-slate-50 text-[#1e385c]">
                            <tr>
                                <th class="px-4 py-3">Lapangan</th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Jam</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200">

                            @forelse($user->bookings as $booking)

                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-3 font-semibold text-[#1e385c]">
                                        {{ $booking->court->name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-slate-500">
                                        {{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') : '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-slate-500">
                                        {{ $booking->start_time }} - {{ $booking->end_time }}
                                    </td>

                                    <td class="px-4 py-3 text-slate-500">
                                        Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-3">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-700',
                                                'confirmed' => 'bg-green-100 text-green-700',
                                                'rejected' => 'bg-red-100 text-red-700',
                                            ];
                                            $statusColor = $statusColors[$booking->status] ?? 'bg-slate-200 text-slate-700';
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                                            {{ strtoupper($booking->status) }}
                                        </span>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">
                                        Pengguna ini belum pernah melakukan booking.
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