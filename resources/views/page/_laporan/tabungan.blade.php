<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="gap-5 items-start flex">
                <!-- Card Container -->
                <div class="bg-gray-800 dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg w-full p-6">
                    <!-- Card Title -->
                    <div class="p-4 bg-gray-700 mb-4 rounded-lg font-semibold text-white">
                        <div class="flex items-center justify-between">
                            <div class="w-full text-center">
                                LAPORAN TABUNGAN
                            </div>
                        </div>
                    </div>
                    <!-- Form for Date Range -->
                    <form class="w-full mx-auto my-5" method="POST" action="{{ route('laporanTabungan.store') }}">
                        @csrf
                        <div class="w-full flex gap-6 mb-4">
                            <!-- Date Range: Dari -->
                            <div class="mb-5 w-full">
                                <label for="dari"
                                    class="block mb-2 text-sm font-medium text-gray-300 dark:text-white">Dari</label>
                                <input type="date" id="dari" name="dari" value="{{ date('Y-m-d') }}"
                                    class="bg-gray-700 text-gray-200 border border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required />
                            </div>
                            <!-- Date Range: Sampai -->
                            <div class="mb-5 w-full">
                                <label for="sampai"
                                    class="block mb-2 text-sm font-medium text-gray-300 dark:text-white">Sampai</label>
                                <input type="date" id="sampai" name="sampai" value="{{ date('Y-m-d') }}"
                                    class="bg-gray-700 text-gray-200 border border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required />
                            </div>
                        </div>
                        <!-- Action Buttons -->
                        <div class="w-full flex gap-5">
                            <button type="submit"
                                class="text-dark bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Cetak Laporan
                            </button>
                            <button type="reset"
                                class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
