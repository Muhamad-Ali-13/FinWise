<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-700">Dashboard - {{ ucfirst($ringkasan['akses']) }}</h2>
                <p class="text-gray-500">{{ $ringkasan['label'] }}</p>
            </div>

            <!-- Ringkasan Keuangan -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 transition-all hover:shadow-xl">
                    <h3 class="text-base font-medium text-gray-500 mb-3">Total Pemasukan</h3>
                    <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 transition-all hover:shadow-xl">
                    <h3 class="text-base font-medium text-gray-500 mb-3">Total Pengeluaran</h3>
                    <p class="text-3xl font-bold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 transition-all hover:shadow-xl">
                    <h3 class="text-base font-medium text-gray-500 mb-3">Total Tabungan</h3>
                    <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($totalTabungan, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Grafik Ringkasan -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-6">Grafik Ringkasan Transaksi</h3>
                <div class="h-96">
                    <canvas id="summaryChart"></canvas>
                </div>
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
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(59, 130, 246, 0.7)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(59, 130, 246, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 8,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            },
                            font: {
                                size: 15
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 15
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 15
                            }
                        }
                    },
                    tooltip: {
                        bodyFont: {
                            size: 15
                        },
                        callbacks: {
                            label: function(context) {
                                return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
