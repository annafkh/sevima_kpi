<x-app-layout>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50">

        <!-- Navbar -->
        <header class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-6 h-16 bg-white border-b shadow-md">
            <!-- Hamburger -->
            <button 
                @click="sidebarOpen = !sidebarOpen" 
                class="p-2 rounded-md text-gray-600 hover:text-white hover:bg-blue-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-300"
                aria-label="Toggle sidebar"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-auto h-9">
                </a>
                <span class="text-2xl font-bold text-gray-800 tracking-wide select-none">SEVIMA KPI</span>
            </div>

            <div class="relative" x-data="{ profileOpen: false }">
                <button 
                    @click="profileOpen = !profileOpen" 
                    class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded"
                    aria-label="User menu"
                >
                    <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" 
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
        
                <div 
                    x-show="profileOpen" 
                    @click.outside="profileOpen = false"
                    x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50"
                    style="display: none;"
                >
                    <a href="{{ route('profile.show') }}" 
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <!-- Sidebar -->
        <div 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
            class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-64px)] overflow-y-auto transition-transform duration-300 transform bg-white border-r shadow-md rounded-r-xl"
        >
            <div class="h-16 flex items-center justify-center border-b">
                <span class="text-lg font-semibold text-gray-700">MENU</span>
            </div>

            <nav class="px-4 py-6 space-y-2">
                @php
                    $navItems = [
                        ['label' => 'KPI Indikator', 'route' => 'kpi_indicators.*', 'icon' => 'fas fa-bolt', 'href' => route('kpi_indicators.index')],
                        ['label' => 'Progress Pekerjaan', 'route' => 'progress.*', 'icon' => 'fas fa-tasks', 'href' => route('progress.index')],
                        ['label' => 'KPI Score', 'route' => 'kpi.summary', 'icon' => 'fas fa-chart-bar', 'href' => route('kpi.summary')],

                    ];
                @endphp

                @foreach ($navItems as $item)
                    @php
                        $isActive = request()->routeIs($item['route']);
                    @endphp
                    <a href="{{ $item['href'] }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200
                       {{ $isActive ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="{{ $item['icon'] }} w-5 mr-3 text-sm {{ $isActive ? 'text-white' : 'text-blue-600' }}"></i>
                        <span class="text-sm font-medium">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <!-- Overlay -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-30 bg-black bg-opacity-50"
            x-transition.opacity></div>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto mt-16">
            <!-- Welcome Animation -->
            <div 
                class="mb-12 text-4xl font-extrabold text-center text-blue-700 animate-fadeInUp"
                x-data 
                x-init="$el.classList.add('opacity-100')"
                style="opacity: 0; transition: opacity 0.7s ease, transform 0.7s ease; transform: translateY(20px);"
            >
                Selamat datang, <span class="text-blue-900">{{ Auth::user()->name }}</span>!
            </div>

<br>
            <form method="GET" action="{{ route('dashboard') }}" class="mb-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm mb-1">Tahun</label>
                    <select name="tahun" class="w-full border rounded px-4 py-2 text-sm">
                        @for ($i = 2023; $i <= now()->year; $i++)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm mb-1">Semester</label>
                    <select name="semester" class="w-full border rounded px-4 py-2 text-sm">
                        <option value="1" {{ $semester == 1 ? 'selected' : '' }}>Semester 1 (Jan - Jun)</option>
                        <option value="2" {{ $semester == 2 ? 'selected' : '' }}>Semester 2 (Jul - Des)</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                        Tampilkan
                    </button>
                </div>
            </form>
            <button id="backButton" class="hidden px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 mb-4">
                ← Kembali ke Rangkuman Semester
            </button>
            <div class="relative w-full max-w-full h-[400px]">
                <canvas id="myChart" class="w-full h-full"></canvas>
            </div>            
            </div>
        </main>
    </div>

    <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.7s ease forwards;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('myChart').getContext('2d');
    const backBtn = document.getElementById('backButton');
    let chart;
    let originalData = [];
    let currentState = 'semester';

    function renderChart(labels, data, title = 'Rata-rata KPI', onClick = null) {
    if (chart) chart.destroy();

            chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                }]
            },
            options: {
                maintainAspectRatio: false, // 👈 penting ini
                responsive: true,
                onClick: onClick,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5,
                        ticks: { stepSize: 1 }
                    }
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: value => {
                            return typeof value === 'number'
                                ? value.toLocaleString('id-ID', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                })
                                : value;
                        },
                        font: {
                            weight: 'bold',
                            size: 12
                        },
                        color: '#000',
                        display: true
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    fetch(`/leader/chart-data/semester`)
        .then(res => res.json())
        .then(data => {
            originalData = data;
            const labels = data.map(d => d.label);
            const values = data.map(d => d.avg_score);

            renderChart(labels, values, 'Rata-rata KPI per Semester', (e, elements) => {
                if (elements.length > 0) {
                    const i = elements[0].index;
                    const { tahun, semester } = data[i];
                    drillDown(tahun, semester, data[i].label);
                }
            });
        });

    function drillDown(tahun, semester, label) {
        fetch(`/leader/chart-detail/${tahun}/${semester}`)
            .then(res => res.json())
            .then(data => {
                const labels = data.map(d => d.nama);
                const values = data.map(d => d.avg_score);

                renderChart(labels, values, `Detail KPI - ${label}`);
                currentState = 'detail';
                backBtn.classList.remove('hidden');
            });
    }

    backBtn.addEventListener('click', () => {
        const labels = originalData.map(d => d.label);
        const values = originalData.map(d => d.avg_score);

        renderChart(labels, values, 'Rata-rata KPI per Semester', (e, elements) => {
            if (elements.length > 0) {
                const i = elements[0].index;
                const { tahun, semester } = originalData[i];
                drillDown(tahun, semester, originalData[i].label);
            }
        });

        backBtn.classList.add('hidden');
        currentState = 'semester';
    });
});
        </script>            
</x-app-layout>
