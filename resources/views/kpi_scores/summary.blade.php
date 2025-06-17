<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-center text-gray-800">📋 Ringkasan KPI Karyawan</h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 border-b">#</th>
                            <th class="px-4 py-3 border-b">Nama Karyawan</th>
                            <th class="px-4 py-3 border-b">Departemen</th>
                            <th class="px-4 py-3 border-b">Total Nilai KPI</th>
                            <th class="px-4 py-3 border-b">Rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($kpiSummaries as $index => $summary)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $summary['nama'] }}</td>
                                <td class="px-4 py-3">{{ $summary['departemen'] ?? 'Divisi' }}</td>
                                <td class="px-4 py-3 font-semibold text-blue-700">{{ number_format($summary['total'], 2) }}</td>
                                <td class="px-4 py-3 italic">{{ $summary['rekomendasi'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada data KPI.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
