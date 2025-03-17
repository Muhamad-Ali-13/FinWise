<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center h-16">
            <div class="flex items-center justify-between w-full">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-4 sm:space-x-6">

                    <!-- Dashboard Link -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="hover:bg-gray-200 hover:text-gray-600 transition duration-300 ease-in-out transform hover:scale-105 active:scale-95">
                        {{ __('Beranda') }}
                    </x-nav-link>

                    <!-- Master Dropdown -->
                    @can('role-A')
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-200 hover:text-gray-600 focus:outline-none transition ease-in-out duration-300 transform hover:scale-105 active:scale-95">
                                <div>Master</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('kategori.index')" class="hover:bg-gray-100 hover:text-gray-600 transition duration-200">
                                {{ __('Data Kategori') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('metode_pembayaran.index')" class="hover:bg-gray-100 hover:text-gray-600 transition duration-200">
                                {{ __('Metode Pembayaran') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('tabungan.index')" class="hover:bg-gray-100 hover:text-gray-600 transition duration-200">
                                {{ __('Tabungan') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    @endcan

                    <!-- Transaksi Dropdown -->
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-200 hover:text-gray-600 focus:outline-none transition ease-in-out duration-300 transform hover:scale-105 active:scale-95">
                                <div>Transaksi</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('pemasukan.index')" class="hover:bg-gray-100 hover:text-gray-600 transition duration-200">
                                {{ __('Pemasukan') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('pengeluaran.index')" class="hover:bg-gray-100 hover:text-gray-600 transition duration-200">
                                {{ __('Pengeluaran') }}
                            </x-dropdown-link>
                           
                        </x-slot>
                    </x-dropdown>

                    @can('role-A')
                    <!-- Laporan Dropdown -->
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-200 hover:text-gray-600 focus:outline-none transition ease-in-out duration-300 transform hover:scale-105 active:scale-95">
                                <div>Laporan</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')" class="hover:bg-gray-100 hover:text-gray-600 transition duration-200">
                                {{ __('Laporan') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    @endcan

                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-200 hover:text-gray-600 focus:outline-none transition ease-in-out duration-300 transform hover:scale-105 active:scale-95">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-gray-100 hover:text-gray-600 transition duration-200">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-gray-100 hover:text-red-600 transition duration-200">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

            </div>
        </div>
    </div>
</nav>
