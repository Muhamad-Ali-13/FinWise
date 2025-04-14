<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('pengeluaran.store') }}" method="POST">
                    @csrf

                    <!-- User ID -->
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label for="kategori_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="mb-4">
                        <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pembayaran</label>
                        <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-4">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-sky-400 text-white px-4 py-2 rounded-xl hover:bg-sky-500">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>