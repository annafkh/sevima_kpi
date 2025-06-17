<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-center text-gray-800">📊 Hasil KPI Anda</h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 font-semibold text-green-600">
                    {{ session('success') }}
                </div>
            @endif
                    <div class="px-4 py-3 text-left bg-gray-100">
                        <span class="font-semibold text-gray-700">Total KPI Berdasarkan Bobot: </span>
                        <span class="text-lg font-bold text-blue-700">
                            @php
                                $totalKpi = 0;
                                foreach ($kpiScores as $item) {
                                    $target = $item->indicator->target ?? 0;
                                    $bobot = $item->indicator->bobot ?? 0;
                                    $capaian = $item->nilai ?? 0;

                                    if ($target > 0) {
                                        $totalKpi += ($capaian / $target) * $bobot;
                                    }
                                }
                            @endphp
                            {{ number_format($totalKpi, 2) }}
                        </span>
                    </div>
                @endif
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full min-w-full text-sm text-gray-700">
                    <thead class="text-xs font-semibold text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left border-b">#</th>
                            <th class="px-4 py-3 text-left border-b">Indicator</th>
                            <th class="px-4 py-3 text-left border-b">Nilai</th>
                            <th class="px-4 py-3 text-left border-b">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($kpiScores as $score)
                            <tr class="transition duration-150 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $score->indicator->nama ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $score->nilai }}</td>
                                <td class="px-4 py-3">{{ $score->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-gray-500">Belum ada nilai KPI.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($kpiScores->isNotEmpty())
                    <div class="px-4 py-3 text-right bg-gray-100">
                        {{-- <span class="font-semibold text-gray-700">Total Nilai KPI: </span> --}}
                        <span class="text-lg font-bold text-gray-900">
                            {{-- {{ number_format($kpiScores->sum('nilai'), 2) }} --}}
                        </span>
                    </div>
            </div>

        </div>
    </div>
</x-app-layout>
