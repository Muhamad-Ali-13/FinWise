<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="text-white text-lg font-semibold">
                    {{ __('FinWise') }}
                </a>
            </div>

            <!-- Navigation Links for Larger Screens -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4 lg:space-x-6">
                <!-- Dashboard Link (Accessible to all roles) -->
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="text-white hover:bg-gray-700 hover:text-white px-3 py-1 rounded-md text-sm font-medium transition duration-300 ease-in-out">
                    {{ __('Beranda') }}
                </x-nav-link>

                <!-- Master Dropdown (Accessible only to Role-A) -->
                @can('role-A')
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 hover:text-white focus:outline-none transition ease-in-out duration-300">
                            <div>Master</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('kategori.index')" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                            {{ __('Data Kategori') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('metode_pembayaran.index')" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                            {{ __('Metode Pembayaran') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('tabungan.index')" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                            {{ __('Tabungan') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @endcan

                <!-- Transaksi Dropdown (Accessible to Role-A and Role-U) -->
                @canany(['role-A', 'role-U'])
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 hover:text-white focus:outline-none transition ease-in-out duration-300">
                            <div>Transaksi</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('pemasukan.index')" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                            {{ __('Pemasukan') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('pengeluaran.index')" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                            {{ __('Pengeluaran') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @endcanany

                <!-- Laporan Dropdown (Accessible to all roles) -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 hover:text-white focus:outline-none transition ease-in-out duration-300">
                            <div>Laporan</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                            {{ __('Laporan') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 hover:text-white focus:outline-none transition ease-in-out duration-300">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Dashboard Link (Accessible to all roles) -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                {{ __('Beranda') }}
            </x-responsive-nav-link>

            <!-- Master Dropdown (Accessible only to Role-A) -->
            @can('role-A')
            <x-responsive-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.index')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                {{ __('Data Kategori') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('metode_pembayaran.index')" :active="request()->routeIs('metode_pembayaran.index')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                {{ __('Metode Pembayaran') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tabungan.index')" :active="request()->routeIs('tabungan.index')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                {{ __('Tabungan') }}
            </x-responsive-nav-link>
            @endcan

            <!-- Transaksi Dropdown (Accessible to Role-A and Role-U) -->
            @canany(['role-A', 'role-U'])
            <x-responsive-nav-link :href="route('pemasukan.index')" :active="request()->routeIs('pemasukan.index')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                {{ __('Pemasukan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pengeluaran.index')" :active="request()->routeIs('pengeluaran.index')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                {{ __('Pengeluaran') }}
            </x-responsive-nav-link>
            @endcanany

            <!-- Laporan Dropdown (Accessible to all roles) -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                {{ __('Laporan') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>