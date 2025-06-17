<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-center text-gray-800">📊 Evaluasi Nilai KPI Karyawan</h2>
    </x-slot>

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="mb-4 font-semibold text-gray-700">
                Rata-rata Nilai KPI: <span class="text-blue-600">{{ number_format($averageScore, 2) }}</span>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="w-full min-w-full text-sm text-gray-700">
                    <thead class="text-xs font-semibold text-gray-600 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left border-b">#</th>
                            <th class="px-4 py-3 text-left border-b">Karyawan</th>
                            <th class="px-4 py-3 text-left border-b">Indikator</th>
                            <th class="px-4 py-3 text-left border-b">Target</th>
                            <th class="px-4 py-3 text-left border-b">Bobot</th>
                            <th class="px-4 py-3 text-left border-b">Capaian</th>
                            <th class="px-4 py-3 text-left border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($scores as $karyawanScores)
                            @php
                                $karyawan = $karyawanScores->first()->karyawan;
                            @endphp
                            <tr class="align-top transition duration-150 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $karyawan->nama }}</div>
                                    <div class="text-xs text-gray-500">{{ $karyawan->jabatan ?? 'Divisi' }}</div>
                                </td>
                    
                                {{-- Kolom Indikator --}}
                                <td class="px-4 py-3">
                                    <ul class="space-y-1 list-disc list-inside">
                                        @foreach ($karyawanScores as $item)
                                            <li>{{ $item->kpiIndicator->nama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                    
                                {{-- Kolom Target --}}
                                <td class="px-4 py-3">
                                    <ul class="space-y-1">
                                        @foreach ($karyawanScores as $item)
                                            <li>{{ $item->kpiIndicator->target }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                    
                                {{-- Kolom Bobot --}}
                                <td class="px-4 py-3">
                                    <ul class="space-y-1">
                                        @foreach ($karyawanScores as $item)
                                            <li>{{ $item->kpiIndicator->bobot }}%</li>
                                        @endforeach
                                    </ul>
                                </td>
                    
                                {{-- Kolom Nilai --}}
                                <td class="px-4 py-3">
                                    <ul class="mb-2 space-y-1">
                                        @foreach ($karyawanScores as $item)
                                            <li>
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ getScoreClass($item->nilai) }}">
                                                    {{ $item->nilai }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                               
                             
                                <td class="px-4 py-3">
                                    <ul class="space-y-1">
                                        @foreach ($karyawanScores as $item)
                                            <li class="flex space-x-2">
                                                <a href="{{ route('kpi_scores.edit', $item->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                                <form action="{{ route('kpi_scores.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

{{-- Kolom Nilai --}}

                            </tr>
                            <tr>
                                <td colspan="5" class="px-4 py-2 font-semibold text-right text-gray-700">Total Nilai KPI:</td>
                                <td colspan="2" class="px-4 py-2 font-bold text-blue-700">
                                    @php
                                    
                                    $totalKpi = 0;
                                        foreach ($karyawanScores as $item) {
                                            $target = $item->kpiIndicator->target;
                                            $bobot = $item->kpiIndicator->bobot;
                                            $capaian = $item->nilai;
                                            $totalKpi += $target > 0 ? ($capaian / $target) * $bobot : 0;
                                        }
                                    @endphp
                                    {{ number_format($totalKpi, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="px-4 py-2 font-semibold text-right text-gray-700">Rekomendasi:</td>
                                <td colspan="2" class="px-4 py-2 italic text-gray-800">
                                    @php
                                        if ($totalKpi >= 90) {
                                            $rekomendasi = 'Promosi Jabatan';
                                        } elseif ($totalKpi >= 80) {
                                            $rekomendasi = 'Mendapatkan bonus sesuai kebijakan perusahaan';
                                        } elseif ($totalKpi >= 40) {
                                            $rekomendasi = 'Diberikan pelatihan atau bootcamp untuk peninjauan lebih lanjut dari perusahaan';
                                        } else {
                                            $rekomendasi = 'Mendapatkan punishment berupa peninjauan kontrak dan/atau surat peringatan dari perusahaan';
                                        }
                                    @endphp
                                    {{ $rekomendasi }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada data nilai KPI.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

@php
    function getScoreClass($score) {
        if ($score >= 85) return 'bg-green-100 text-green-800';
        if ($score >= 70) return 'bg-blue-100 text-blue-800';
        if ($score >= 60) return 'bg-yellow-100 text-yellow-800';
        return 'bg-red-100 text-red-800';
    }
@endphp
