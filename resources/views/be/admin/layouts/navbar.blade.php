<header class="bg-white border-b border-gray-100">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
        <!-- Left side -->
        <div class="flex items-center">
            <!-- Mobile menu button -->
            <button @click="sidebarOpen = true"
                class="p-2 text-gray-400 rounded-md lg:hidden hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Right side -->
        <div class="flex items-center space-x-4">
            <div class="relative" x-data="{ open: false }" x-cloak>
                <button @click="open = !open"
                    class="flex items-center p-2 space-x-2 text-sm rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-400">
                    <div
                        class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-300">
                        <span class="text-xs font-medium text-white">{{ $initials }}</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95" @click.away="open = false"
                    class="absolute right-0 z-50 w-48 mt-2 bg-white border border-gray-100 rounded-xl shadow-sm">
                    <div class="py-2">
                        {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Settings</a>
                        <hr class="my-1"> --}}
                        <a href="{{ route('auth.logout') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
