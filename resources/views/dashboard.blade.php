<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-6 bg-gray-100">
        <!-- Ringkasan Keuangan -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Total Pemasukan</h3>
                <p class="text-2xl font-bold text-green-600 mt-2">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Total Pengeluaran</h3>
                <p class="text-2xl font-bold text-red-600 mt-2">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Total Tabungan</h3>
                <p class="text-2xl font-bold text-blue-600 mt-2">Rp {{ number_format($totalTabungan, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Grafik Ringkasan -->
        <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik Ringkasan Transaksi</h3>
            <div class="h-56">
                <canvas id="summaryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('summaryChart').getContext('2d');
        const summaryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pemasukan', 'Pengeluaran', 'Tabungan'],
                datasets: [{
                    label: 'Jumlah (Rp)',
                    data: [
                        {{ $totalPemasukan }},
                        {{ $totalPengeluaran }},
                        {{ $totalTabungan }}
                    ],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.6)',
                        'rgba(239, 68, 68, 0.6)',
                        'rgba(59, 130, 246, 0.6)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(59, 130, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
