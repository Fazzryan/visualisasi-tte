<div class="fixed inset-y-0 left-0 z-40 flex flex-col w-64 transition-transform duration-300 ease-in-out transform bg-white shadow lg:relative lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-6 border-b border-slate-100">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-10 h-10">
                <img src="{{ asset('assets/img/logo/logokabtasik.png') }}" alt="Logo" class="w-full h-full">
            </div>
            <span class="ml-3 text-base md:text-xl font-semibold text-slate-700">Visualisasi TTE</span>
        </div>
        <button @click="sidebarOpen = false" class="text-slate-700 lg:hidden hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </button>
    </div>

    @php
        $active = 'bg-green-100 text-green-600 border border-green-200';
        $inactive = 'text-gray-600 hover:text-green-400 hover:bg-green-50';
    @endphp

    <nav class="flex-1 px-3 mt-6 overflow-y-auto">
        <div class="space-y-2">

            {{-- Tampilkan Dashboard HANYA untuk role 'superadmin' atau 'kominfo_admin' --}}
            @if (Auth::check() && in_array(Auth::user()->role, ['superadmin', 'admin']))
                <a href="{{ route('be.dashboard') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 group rounded-xl {{ request()->routeIs('be.dashboard') ? $active : $inactive }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="w-5 h-5 mr-2 icon icon-tabler icons-tabler-outline icon-tabler-layers-subtract">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                        <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2" />
                    </svg>
                    Dashboard
                </a>
            @endif

            {{-- Tampilkan untuk SEMUA user yang sudah login (admin Kominfo) --}}
            @if (Auth::check())
                <a href="{{ route('be.spesimen') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 group rounded-xl {{ request()->routeIs('be.spesimen') ? $active : $inactive }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="w-5 h-6 mr-2 icon icon-tabler icons-tabler-outline icon-tabler-signature">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M3 17c3.333 -3.333 5 -6 5 -8c0 -3 -1 -3 -2 -3s-2.032 1.085 -2 3c.034 2.048 1.658 4.877 2.5 6c1.5 2 2.5 2.5 3.5 1l2 -3c.333 2.667 1.333 4 3 4c.53 0 2.639 -2 3 -2c.517 0 1.517 .667 3 2" />
                    </svg>
                    Visualisasi Generator
                </a>
            @endif

            {{-- Tampilkan Akun HANYA untuk role 'superadmin' --}}
            @if (Auth::check() && Auth::user()->role === 'superadmin')
                <a href="{{ route('be.akun.index') }}"
                    class="flex items-center px-3 py-3 text-sm font-medium transition-all duration-200 group rounded-xl {{ request()->routeIs('be.akun.index') ? $active : $inactive }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="w-5 h-6 mr-2 icon icon-tabler icons-tabler-outline icon-tabler-users">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                    Akun
                </a>
            @endif
        </div>
    </nav>

    <!-- User Profile Section -->
    <!-- <div class="p-4 mt-auto border-t border-gray-100">
        <div class="flex items-center space-x-3">

            <div
                class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-green-300">
                <span class="text-sm font-medium text-white">{{ $initials }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div> -->
</div>
