<x-app-layout>
    <div x-data="{ sidebarOpen: false, profileOpen: false }" class="flex h-screen bg-gray-50">

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
        
            <!-- Profile dropdown -->
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
                        ['label' => 'Penilaian Anda', 'route' => 'dashboard.kpikaryawan', 'icon' => 'fas fa-bolt', 'href' => route('dashboard.kpikaryawan')],
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
            <div 
                class="mb-12 text-4xl font-extrabold text-center text-blue-700 animate-fadeInUp"
                x-data 
                x-init="$el.classList.add('opacity-100')"
                style="opacity: 0; transition: opacity 0.7s ease, transform 0.7s ease; transform: translateY(20px);"
            >
                Selamat datang, <span class="text-blue-900">{{ Auth::user()->name }}</span>!
            </div>

            {{--
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @php
                    $cards = [
                        ['label' => 'KPI Indikator Aktif', 'value' => $totalIndikatorAktif, 'icon' => 'fas fa-bolt', 'color' => 'bg-yellow-400', 'hover' => 'bg-yellow-500'],
                        ['label' => 'KPI Score Rata-rata', 'value' => $rataRataScore, 'icon' => 'fas fa-chart-bar', 'color' => 'bg-indigo-600', 'hover' => 'bg-indigo-700'],
                    ];
                @endphp

                @foreach($cards as $card)
                    <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 cursor-pointer group">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 text-white {{ $card['color'] }} rounded-full group-hover:{{ $card['hover'] }}">
                                <i class="{{ $card['icon'] }} fa-lg"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-semibold text-gray-900">{{ $card['value'] }}</p>
                                <p class="mt-1 text-sm text-gray-500">{{ $card['label'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}

            <!-- Grafik -->
            <div class="mt-12 bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold mb-4 text-gray-700">KPI Score Semester ({{ date('Y') }})</h3>
                <canvas id="myChart" height="100"></canvas>
            </div>
        </main>
    </div>

    <!-- Animasi -->
    <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.7s ease forwards;
        }
    </style>

    <!-- Chart.js -->
    <canvas id="myChart" height="100"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/chart-data')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.nama);
                    const scores = data.map(item => parseFloat(item.avg_score));
    
                    const ctx = document.getElementById('myChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Nilai Saya',
                                data: scores,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    min: 1,
                                    max: 5,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Gagal ambil data chart:', error);
                });
        });
    </script>
    
    
</x-app-layout>
