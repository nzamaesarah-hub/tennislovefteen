<nav class="bg-[#1e385c] border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- LOGO KIRI -->
            <div class="flex items-center space-x-3">
                <a href="/" class="flex items-center space-x-3">
                    <div class="bg-[#ccff00] p-2.5 rounded-full flex items-center justify-center shadow-md">
                        <span class="text-xl">🎾</span>
                    </div>
                    <div>
                        <span class="text-white font-extrabold text-xl tracking-wider block leading-none">LOVE - 15</span>
                        <span class="text-[#ccff00] text-[10px] font-bold tracking-widest uppercase block mt-1">TENNIS CLUB</span>
                    </div>
                </a>
            </div>

            <!-- MENU NAVIGASI KANAN -->
            <div class="flex items-center">
                @auth

                    @if(auth()->user()->role === 'admin')

                        <!-- NAVBAR ADMIN -->
                        <div class="bg-slate-900/60 p-1.5 rounded-full border border-slate-700/60 flex items-center space-x-1">

                            <a href="{{ route('admin.dashboard') }}" 
                               class="{{ request()->routeIs('admin.dashboard') ? 'bg-[#ccff00] text-slate-900' : 'text-slate-300 hover:text-white' }} font-bold text-xs px-5 py-2 rounded-full transition-all">
                                Dashboard
                            </a>

                            <a href="{{ route('admin.courts.index') }}" 
                               class="{{ request()->routeIs('admin.courts.*') ? 'bg-[#ccff00] text-slate-900' : 'text-slate-300 hover:text-white' }} font-bold text-xs px-5 py-2 rounded-full transition-all">
                                Lapangan
                            </a>

                            <a href="{{ route('admin.users.index') }}" 
                               class="{{ request()->routeIs('admin.users.*') ? 'bg-[#ccff00] text-slate-900' : 'text-slate-300 hover:text-white' }} font-bold text-xs px-5 py-2 rounded-full transition-all">
                                Pengguna
                            </a>

                        </div>

                    @else

                        <!-- NAVBAR USER -->
                        <div class="bg-slate-900/60 p-1.5 rounded-full border border-slate-700/60 flex items-center space-x-1">

                            <a href="{{ route('dashboard') }}" 
                               class="{{ request()->routeIs('dashboard') ? 'bg-[#ccff00] text-slate-900' : 'text-slate-300 hover:text-white' }} font-bold text-xs px-5 py-2 rounded-full transition-all">
                                Booking
                            </a>

                            <a href="{{ route('history') }}" 
                               class="{{ request()->routeIs('history') ? 'bg-[#ccff00] text-slate-900' : 'text-slate-300 hover:text-white' }} font-bold text-xs px-5 py-2 rounded-full transition-all">
                                History
                            </a>

                            <a href="{{ route('profile.edit') }}" 
                               class="{{ request()->routeIs('profile.*') ? 'bg-[#ccff00] text-slate-900' : 'text-slate-300 hover:text-white' }} font-bold text-xs px-5 py-2 rounded-full transition-all">
                                Profile
                            </a>

                        </div>

                    @endif

                @else

                    <!-- JIKA BELUM LOGIN: TAMPILKAN TOMBOL LOGIN & REGISTER -->
                    <div class="flex items-center space-x-3">

                        <a href="{{ route('login') }}" 
                           class="text-white hover:text-[#ccff00] font-bold text-xs px-5 py-2.5 rounded-full transition-all">
                            Log in
                        </a>

                        <a href="{{ route('register') }}" 
                           class="bg-[#ccff00] hover:bg-lime-300 text-slate-900 font-bold text-xs px-5 py-2.5 rounded-full transition-all shadow-md">
                            Register
                        </a>

                    </div>

                @endauth
            </div>

        </div>
    </div>
</nav>