<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="p-6">
        <!-- Row Pertama: Pemasukan -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <!-- Card Pemasukan Harian -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Pemasukan Harian</h3>
                <p class="text-xl font-bold text-green-600 mt-2">Rp 500.000</p>
            </div>
    
            <!-- Card Pemasukan Mingguan -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Pemasukan Mingguan</h3>
                <p class="text-xl font-bold text-green-600 mt-2">Rp 3.500.000</p>
            </div>
    
            <!-- Card Pemasukan Bulanan -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Pemasukan Bulanan</h3>
                <p class="text-xl font-bold text-green-600 mt-2">Rp 15.000.000</p>
            </div>
    
            <!-- Card Pemasukan Tahunan -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Pemasukan Tahunan</h3>
                <p class="text-xl font-bold text-green-600 mt-2">Rp 180.000.000</p>
            </div>
    
            <!-- Card Total Pemasukan -->
            <div class="bg-green-100 rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-green-700">Total Pemasukan</h3>
                <p class="text-xl font-bold text-green-900 mt-2">Rp 200.000.000</p>
            </div>
        </div>
    
        <!-- Row Kedua: Pengeluaran -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <!-- Card Pengeluaran Harian -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Pengeluaran Harian</h3>
                <p class="text-xl font-bold text-red-600 mt-2">Rp 200.000</p>
            </div>
    
            <!-- Card Pengeluaran Mingguan -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Pengeluaran Mingguan</h3>
                <p class="text-xl font-bold text-red-600 mt-2">Rp 1.200.000</p>
            </div>
    
            <!-- Card Pengeluaran Bulanan -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Pengeluaran Bulanan</h3>
                <p class="text-xl font-bold text-red-600 mt-2">Rp 5.000.000</p>
            </div>
    
            <!-- Card Pengeluaran Tahunan -->
            <div class="bg-white rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-gray-500">Pengeluaran Tahunan</h3>
                <p class="text-xl font-bold text-red-600 mt-2">Rp 60.000.000</p>
            </div>
    
            <!-- Card Total Pengeluaran -->
            <div class="bg-red-100 rounded-lg shadow-md p-4 text-center">
                <h3 class="text-sm font-medium text-red-700">Total Pengeluaran</h3>
                <p class="text-xl font-bold text-red-900 mt-2">Rp 70.000.000</p>
            </div>
        </div>
    
        <!-- Diagram Kurva -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Diagram Kurva</h3>
            <div class="h-48">
                <!-- Placeholder untuk diagram kurva -->
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    
        <!-- Diagram Batang -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Diagram Batang</h3>
            <div class="h-48">
                <!-- Placeholder untuk diagram batang -->
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Diagram Kurva
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Pemasukan',
                    data: [500000, 600000, 700000, 800000, 900000, 1000000],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false,
                }, {
                    label: 'Pengeluaran',
                    data: [300000, 400000, 500000, 600000, 700000, 800000],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    
        // Diagram Batang
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Pemasukan',
                    data: [500000, 600000, 700000, 800000, 900000, 1000000],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }, {
                    label: 'Pengeluaran',
                    data: [300000, 400000, 500000, 600000, 700000, 800000],
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    </script> --}}
</x-app-layout>
