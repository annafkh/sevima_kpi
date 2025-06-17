<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Grafik KPI Karyawan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto mb-6 text-2xl text-center text-gray-800 max-w-7xl">
            Grafik KPI Karyawan
        </div>

        <!-- Menampilkan Grafik KPI -->
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <canvas id="kpiChart"></canvas>
        </div>
    </div>

    <script>
        // Mengambil data chartData dari PHP
        const chartData = @json($chartData); // Mengirim data PHP ke JavaScript

        // Data untuk chart
        const karyawanNames = chartData.map(item => item.nama);
        const rataNilai = chartData.map(item => item.rata_nilai);

        // Inisialisasi grafik dengan Chart.js
        const ctx = document.getElementById('kpiChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Tipe chart (Bar Chart)
            data: {
                labels: karyawanNames, // Nama Karyawan sebagai label
                datasets: [{
                    label: 'Rata-rata Nilai KPI',
                    data: rataNilai, // Data nilai KPI
                    backgroundColor: '#4CAF50',
                    borderColor: '#388E3C',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
