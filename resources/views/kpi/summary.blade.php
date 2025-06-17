<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-center text-gray-800">📋 Ringkasan KPI Karyawan</h2>
    </x-slot>
    
   


    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
             <form method="GET" class="mb-6">
    <div class="flex flex-wrap items-center gap-2">
        <label for="year" class="text-sm font-semibold">Tahun:</label>
        <input type="number" name="year" id="year" value="{{ request('year', now()->year) }}" class="px-2 py-1 border rounded">

        <label for="semester" class="text-sm font-semibold">Semester:</label>
        <select name="semester" id="semester" class="px-2 py-1 border rounded">
            <option value="1" {{ request('semester') == 1 ? 'selected' : '' }}>Semester 1</option>
            <option value="2" {{ request('semester') == 2 ? 'selected' : '' }}>Semester 2</option>
        </select>

        <button type="submit" class="px-3 py-1 text-black bg-blue-600 rounded hover:bg-blue-700">Tampilkan</button>
    </div>
</form>

            {{-- Grafik --}}
            <div class="p-6 mb-10 bg-white rounded-lg shadow">
                <h3 class="mb-4 text-lg font-semibold">📊 Grafik Total Nilai KPI</h3>
                <canvas id="kpiChart" height="100"></canvas>
            </div>

            {{-- Tabel --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 border-b">#</th>
                            <th class="px-4 py-3 border-b">Nama Karyawan</th>
                            <th class="px-4 py-3 border-b">Departemen</th>
                            <th class="px-4 py-3 border-b">Status Penilaian</th>
                            <th class="px-4 py-3 border-b">Total Nilai KPI</th>
                            <th class="px-4 py-3 border-b">Rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @php
                            $labels = [];
                            $data = [];
                        @endphp
                        @forelse ($kpiSummaries as $index => $summary)
                            @php
                                $labels[] = $summary['nama'];
                                $data[] = $summary['total'];
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">
                                    <a href="{{ route('kpi.summary.detail', [
                                        'karyawan_id' => $summary['karyawan_id'],
                                        'tahun' => request('tahun'),
                                        'semester' => request('semester')
                                    ]) }}" class="text-blue-600 hover:underline">
                                        {{ $summary['nama'] }}
                                    </a>                                    
                                </td>
                                <td class="px-4 py-3">{{ $summary['jabatan'] ?? 'Divisi' }}</td>
                                {{-- <td class="px-4 py-3">
                                    @if(!empty($summary['created_at']))
                                        {{ \Carbon\Carbon::parse($summary['created_at'])->format('d M Y') }}
                                    @else
                                        <span class="italic text-gray-400"></span>
                                    @endif
                                </td> --}}
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($summary['status'] === 'Selesai') bg-green-100 text-green-700
                                        @elseif($summary['status'] === 'Dalam Proses') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700 @endif">
                                        {{ $summary['status'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 font-semibold text-blue-700">{{ number_format($summary['total'], 2) }}</td>
                                <td class="px-4 py-3 italic">
                                    {{ $summary['status'] === 'Dalam Proses' ? 'Belum dinilai' : $summary['rekomendasi'] }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada data KPI.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Script Chart.js --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('kpiChart').getContext('2d');
            const kpiChart = new Chart(ctx, {
                type: 'line', // Ubah dari 'bar' ke 'line'
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Total Nilai KPI',
                        data: {!! json_encode($data) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.2)', // Set warna transparan untuk area bawah garis
                        borderColor: 'rgba(59, 130, 246, 1)', // Warna garis
                        borderWidth: 2, // Lebar garis
                        pointBackgroundColor: 'rgba(59, 130, 246, 1)', // Warna titik data
                        pointRadius: 5, // Ukuran titik
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    tension: 0.3 // Menambahkan kelengkungan pada garis
                }
            });
        </script>
    @endpush
</x-app-layout>
